<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\Appointment;
use Illuminate\Support\Facades\Mail;

#[Layout('components.layouts.admin')]
#[Title('Appointment Details | Repairmax')]
class AppointmentDetails extends Component
{
    // Appointment ID from URL parameter
    public $appointmentId;
    
    // Appointment data
    public $appointment = null;
    
    // Email modal state
    public $showEmailModal = false;
    public $emailSubject = '';
    public $emailBody = '';
    public $emailType = 'receipt'; // 'receipt', 'invoice', 'custom'
    
    // Status update
    public $newStatus = '';
    public $showStatusModal = false;

    public function mount($id)
    {
        $this->appointmentId = $id;
        $this->loadAppointment();
    }

    public function loadAppointment()
    {
        $this->appointment = Appointment::with('user')->findOrFail($this->appointmentId);
        $this->newStatus = $this->appointment->status;
    }

    public function render()
    {
        return view('livewire.admin.appointment-details', [
            'appointment' => $this->appointment,
        ]);
    }

    // Open the email modal
    public function openEmailModal($type = 'receipt')
    {
        $this->emailType = $type;
        
        // Pre-fill the subject based on the type
        if ($type === 'receipt') {
            $this->emailSubject = 'Service Receipt - Appointment #' . $this->appointment->tracking_code;
            $this->emailBody = $this->generateReceiptTemplate();
        } elseif ($type === 'invoice') {
            $this->emailSubject = 'Invoice - Appointment #' . $this->appointment->tracking_code;
            $this->emailBody = $this->generateInvoiceTemplate();
        }
        
        $this->showEmailModal = true;
    }

    // Generate receipt template
    private function generateReceiptTemplate()
    {
        $finalCost = $this->appointment->final_cost ?? 'Pending';
        $description = $this->appointment->description ?? 'N/A';
        
        return <<<HTML
Dear Valued Customer,

Here is your SERVICE RECEIPT for confirmation:

📌 Booking Reference: {$this->appointment->booking_number}
📌 Device: {$this->appointment->device_brand} {$this->appointment->device_model}
📌 Issue: {$this->appointment->fault_category}
📌 Status: {$this->appointment->status}

💰 Quote Price: ₱{$this->appointment->quote}
💰 Final Cost: ₱{$finalCost}

🔧 Description: {$description}

Thank you for choosing our service!

Best regards,
RepairMax Team
HTML;
    }

    // Generate the invoice template
    private function generateInvoiceTemplate()
    {
        $invoiceNumber = $this->appointment->invoice_number ?? 'N/A';
        $createdDate = $this->appointment->created_at ? $this->appointment->created_at->format('M d, Y') : 'N/A';
        $userName = $this->appointment->user ? $this->appointment->user->getFullName() : 'Guest Customer';
        $userEmail = $this->appointment->user ? $this->appointment->user->email : 'N/A';
        $userPhone = $this->appointment->user ? $this->appointment->user->phone : 'N/A';
        $description = $this->appointment->description ?? 'N/A';
        $finalCost = $this->appointment->final_cost ?? $this->appointment->quote;
        $additionalFees = max(0, ($this->appointment->final_cost ?? 0) - ($this->appointment->quote ?? 0));
        
        return <<<HTML
OFFICIAL INVOICE

Booking Reference: {$this->appointment->booking_number}
Invoice Number: {$invoiceNumber}
Date: {$createdDate}

========================================
CUSTOMER INFORMATION
========================================
Name: {$userName}
Email: {$userEmail}
Phone: {$userPhone}

========================================
SERVICE DETAILS
========================================
Device: {$this->appointment->device_brand} {$this->appointment->device_model}
Issue: {$this->appointment->fault_category}
Description: {$description}

========================================
PRICING BREAKDOWN
========================================
Service Quote: ₱{$this->appointment->quote}
Final Cost: ₱{$finalCost}
Additional Fees: ₱{$additionalFees}

TOTAL AMOUNT DUE: ₱{$finalCost}

========================================

Thank you for choosing RepairMax!

Best regards,
RepairMax Administrative Team
HTML;
    }

    // Send the email
    public function sendEmail()
    {
        // Validate
        $this->validate([
            'emailSubject' => 'required|string|max:255',
            'emailBody' => 'required|string|max:5000',
        ]);

        try {
            // Get the customer's email
            $recipientEmail = $this->appointment->user?->email;
            
            if (!$recipientEmail) {
                session()->flash('error', 'No email address for this customer.');
                return;
            }

            // Send using Mail class
            Mail::raw($this->emailBody, function ($message) use ($recipientEmail) {
                $message->to($recipientEmail)
                    ->subject($this->emailSubject)
                    ->from(config('mail.from.address'), 'RepairMax');
            });

            // Reset the form
            $this->showEmailModal = false;
            $this->emailSubject = '';
            $this->emailBody = '';
            $this->emailType = 'receipt';

            session()->flash('message', 'Email successfully sent to ' . $recipientEmail);
        } catch (\Exception $e) {
            session()->flash('error', 'Failed to send email: ' . $e->getMessage());
        }
    }

    // Close the email modal
    public function closeEmailModal()
    {
        $this->showEmailModal = false;
    }

    // Update the status
    public function updateStatus()
    {
        $this->validate([
            'newStatus' => 'required|string|in:Pending,Scheduled,In Progress,Ready for Pickup,Completed,Cancelled',
        ]);

        try {
            $this->appointment->update(['status' => $this->newStatus]);

            // Create a notification for the user
            if ($this->appointment->user_id) {
                \App\Models\Notification::create([
                    'user_id' => $this->appointment->user_id,
                    'admin_id' => auth()->id(),
                    'title' => 'Appointment Status Updated',
                    'message' => "Your appointment status has been updated to: {$this->newStatus}",
                    'type' => 'appointment_confirmation',
                    'related_model' => 'Appointment',
                    'related_id' => $this->appointment->id,
                ]);
            }

            $this->loadAppointment();
            $this->showStatusModal = false;
            session()->flash('message', 'Status successfully updated!');
        } catch (\Exception $e) {
            session()->flash('error', 'Failed to update status: ' . $e->getMessage());
        }
    }

    // Delete the appointment
    public function deleteAppointment()
    {
        try {
            $this->appointment->delete();
            session()->flash('message', 'Appointment successfully deleted.');
            return redirect()->route('admin.appointment');
        } catch (\Exception $e) {
            session()->flash('error', 'Failed to delete appointment: ' . $e->getMessage());
        }
    }
}

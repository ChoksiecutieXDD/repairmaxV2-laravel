<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\Appointment;
use Illuminate\Support\Facades\Mail;
use App\Mail\GeneralEmail;

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

    // Finance update
    public $showFinanceModal = false;
    public $formServiceCost = 0;
    public $formPartsUnitPrice = 0;
    public $formPartsCost = 0;
    public $formAdditionalFee = 0;
    public $formInvoiceNumber = '';

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
        $refNumber = $this->appointment->booking_number ?: $this->appointment->tracking_code;
        
        // Pre-fill the subject based on the type
        if ($type === 'receipt') {
            $this->emailSubject = 'Service Receipt - Booking Reference #' . $refNumber;
            $this->emailBody = $this->generateReceiptTemplate();
        } elseif ($type === 'invoice') {
            $this->emailSubject = 'Invoice - Booking Reference #' . $refNumber;
            $this->emailBody = $this->generateInvoiceTemplate();
        }
        
        $this->showEmailModal = true;
    }

    // Generate receipt template
    private function generateReceiptTemplate()
    {
        $refNumber = $this->appointment->booking_number ?: $this->appointment->tracking_code;
        $quoteVal = is_numeric($this->appointment->quote) 
            ? '₱' . number_format((float)$this->appointment->quote, 2) 
            : ($this->appointment->pricing_confirmed ? '₱0.00' : 'Pending');
        $finalCost = $this->appointment->final_cost;
        $finalCostVal = is_numeric($finalCost) 
            ? '₱' . number_format((float)$finalCost, 2) 
            : ($this->appointment->pricing_confirmed ? '₱0.00' : 'Pending');
        $description = $this->appointment->description ?? 'N/A';
        
        $invoiceLine = $this->appointment->invoice_number ? "\n📌 Invoice Number: " . $this->appointment->invoice_number : "";
        
        return <<<HTML
Dear Valued Customer,

Here is your SERVICE RECEIPT for confirmation:

📌 Booking Reference: {$refNumber}{$invoiceLine}
📌 Device: {$this->appointment->device_brand} {$this->appointment->device_model}
📌 Issue: {$this->appointment->fault_category}
📌 Status: {$this->appointment->status}

💰 Quote Price: {$quoteVal}
💰 Final Cost: {$finalCostVal}

🔧 Description: {$description}

Thank you for choosing our service!

Best regards,
RepairMax Team
HTML;
    }

    // Generate the invoice template
    private function generateInvoiceTemplate()
    {
        $refNumber = $this->appointment->booking_number ?: $this->appointment->tracking_code;
        $invoiceNumber = $this->appointment->invoice_number ?? 'N/A';
        $createdDate = $this->appointment->created_at ? $this->appointment->created_at->format('M d, Y') : 'N/A';
        $userName = $this->appointment->user ? $this->appointment->user->getFullName() : 'Guest Customer';
        $userEmail = $this->appointment->user ? $this->appointment->user->email : 'N/A';
        $userPhone = $this->appointment->user ? $this->appointment->user->phone : 'N/A';
        $description = $this->appointment->description ?? 'N/A';
        
        $quoteVal = is_numeric($this->appointment->quote) 
            ? '₱' . number_format((float)$this->appointment->quote, 2) 
            : ($this->appointment->pricing_confirmed ? '₱0.00' : 'Pending');
        $finalCost = $this->appointment->final_cost ?? $this->appointment->quote;
        $finalCostVal = is_numeric($finalCost) 
            ? '₱' . number_format((float)$finalCost, 2) 
            : ($this->appointment->pricing_confirmed ? '₱0.00' : 'Pending');
        $additionalFees = max(0, ($this->appointment->final_cost ?? 0) - ($this->appointment->quote ?? 0));
        $additionalFeesVal = '₱' . number_format((float)$additionalFees, 2);
        
        return <<<HTML
OFFICIAL INVOICE

Booking Reference: {$refNumber}
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
Service Quote: {$quoteVal}
Final Cost: {$finalCostVal}
Additional Fees: {$additionalFeesVal}

TOTAL AMOUNT DUE: {$finalCostVal}

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
                $this->dispatch('toast', message: 'No email address for this customer.', type: 'error');
                return;
            }

            $pdfData = null;
            $pdfFileName = null;

            if ($this->emailType === 'receipt') {
                $html = view('livewire.pdf.receipt-pdf-print', [
                    'appointment' => $this->appointment,
                    'user' => $this->appointment->user,
                    'type' => 'receipt'
                ])->render();
                
                $pdf = app('dompdf.wrapper');
                $pdf->loadHTML($html);
                $pdf->setPaper('A4', 'portrait');
                $pdfData = $pdf->output();
                $pdfFileName = 'receipt-' . $this->appointment->tracking_code . '.pdf';
            } elseif ($this->emailType === 'invoice') {
                $html = view('livewire.pdf.receipt-pdf-print', [
                    'appointment' => $this->appointment,
                    'user' => $this->appointment->user,
                    'type' => 'invoice'
                ])->render();
                
                $pdf = app('dompdf.wrapper');
                $pdf->loadHTML($html);
                $pdf->setPaper('A4', 'portrait');
                $pdfData = $pdf->output();
                $pdfFileName = 'invoice-' . ($this->appointment->invoice_number ?? $this->appointment->tracking_code) . '.pdf';
            }

            // Send using GeneralEmail Mailable (HTML Template) with PDF attachment if available
            Mail::to($recipientEmail)->send(new GeneralEmail($this->emailSubject, $this->emailBody, $pdfData, $pdfFileName));

            // Reset the form
            $this->showEmailModal = false;
            $this->emailSubject = '';
            $this->emailBody = '';
            $this->emailType = 'receipt';

            $this->dispatch('toast', message: 'Email successfully sent to ' . $recipientEmail, type: 'success');
        } catch (\Exception $e) {
            $this->dispatch('toast', message: 'Failed to send email: ' . $e->getMessage(), type: 'error');
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
            // If marking as Completed, require costs to be filled
            if (strtolower($this->newStatus) === 'completed') {
                if (!$this->appointment->service_cost || !$this->appointment->parts_unit_price || !$this->appointment->parts_cost) {
                    $this->dispatch('toast', message: 'Please enter Service Cost, Parts Unit Price, and Parts Cost before marking as Completed.', type: 'error');
                    return;
                }
            }

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
            
            // Dispatch event for real-time reports update
            if (strtolower($this->newStatus) === 'completed') {
                $this->dispatch('appointmentCompleted');
            }
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

    // Detect template selector change to update subject and body
    public function updatedEmailType($value)
    {
        $refNumber = $this->appointment->booking_number ?: $this->appointment->tracking_code;
        if ($value === 'receipt') {
            $this->emailSubject = 'Service Receipt - Booking Reference #' . $refNumber;
            $this->emailBody = $this->generateReceiptTemplate();
        } elseif ($value === 'invoice') {
            $this->emailSubject = 'Invoice - Booking Reference #' . $refNumber;
            $this->emailBody = $this->generateInvoiceTemplate();
        } else {
            $this->emailSubject = '';
            $this->emailBody = '';
        }
    }

    // Open the finance modal
    public function openFinanceModal()
    {
        $this->formQuote = $this->appointment->quote;
        $this->formFinalCost = $this->appointment->final_cost ?? '';
        $this->formServiceCost = $this->appointment->service_cost ?? 0;
        $this->formPartsCost = $this->appointment->parts_cost ?? 0;
        $this->formAdditionalFee = $this->appointment->additional_fee;
        $this->formInvoiceNumber = $this->appointment->invoice_number ?? '';
        $this->showFinanceModal = true;
    }

    // Save edited financial details
    public function updateFinance()
    {
        $this->validate([
            'formServiceCost' => 'required|numeric|min:0',
            'formPartsUnitPrice' => 'required|numeric|min:0',
            'formPartsCost' => 'required|numeric|min:0',
            'formAdditionalFee' => 'nullable|numeric|min:0',
            'formInvoiceNumber' => 'nullable|string|max:255',
        ]);

        try {
            // Calculate Final Cost (auto) = Service Cost + Parts Unit Price
            $finalCost = $this->formServiceCost + $this->formPartsUnitPrice;
            
            // Calculate Profits
            $serviceProfit = $this->formServiceCost; // Service charge is the profit from service
            $partsProfit = $this->formPartsUnitPrice - $this->formPartsCost; // Parts Unit Price - Cost = Profit
            $totalProfit = $serviceProfit + $partsProfit; // Total = Service Profit + Parts Profit
            
            // Total Cost for reference
            $totalCost = $this->formPartsCost; // Just the cost price of parts

            $this->appointment->update([
                'final_cost' => $finalCost,
                'service_cost' => $this->formServiceCost,
                'parts_unit_price' => $this->formPartsUnitPrice,
                'parts_cost' => $this->formPartsCost,
                'total_cost' => $totalCost,
                'profit' => $totalProfit,
                'additional_fee' => $this->formAdditionalFee,
                'invoice_number' => $this->formInvoiceNumber ?: null,
                'pricing_confirmed' => true,
            ]);

            $this->loadAppointment();
            $this->showFinanceModal = false;
            $partsMessage = '(Service: ₱' . number_format($serviceProfit, 2) . ' + Parts: ₱' . number_format($partsProfit, 2) . ')';
            $this->dispatch('toast', message: 'Financial details updated! Total Profit: ₱' . number_format($totalProfit, 2) . ' ' . $partsMessage, type: 'success');
            
            // Dispatch event for real-time reports update
            $this->dispatch('appointmentFinanceUpdated');
        } catch (\Exception $e) {
            $this->dispatch('toast', message: 'Failed to update financial details: ' . $e->getMessage(), type: 'error');
        }
    }

    // Confirm the pricing directly
    public function confirmPricing()
    {
        try {
            $this->appointment->update(['pricing_confirmed' => true]);
            $this->loadAppointment();
            $this->dispatch('toast', message: 'Pricing successfully confirmed!', type: 'success');
        } catch (\Exception $e) {
            $this->dispatch('toast', message: 'Failed to confirm pricing: ' . $e->getMessage(), type: 'error');
        }
    }
}

<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Appointment;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('components.layouts.admin')]
#[Title('Appointment Management | Repairmax')]
class AppointmentManagement extends Component
{
    use WithPagination;

    public $statusFilter = 'all';
    public $search = '';
    public $showCompleteModal = false;
    public $selectedAppointment = null;
    public $finalCost = null;
    public $completionNotes = null;

    public function updatingStatusFilter()
    {
        $this->resetPage();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function openCompleteModal($appointmentId)
    {
        $appointment = Appointment::findOrFail($appointmentId);
        $this->selectedAppointment = $appointment;
        $this->finalCost = $appointment->quote;
        $this->completionNotes = $appointment->completion_notes ?? '';
        $this->showCompleteModal = true;
    }

    public function completeAppointment()
    {
        if (!$this->selectedAppointment || $this->finalCost === null) {
            session()->flash('error', 'Please enter the final cost.');
            return;
        }

        try {
            $appointment = $this->selectedAppointment;
            
            // Ensure status is exactly 'Completed' with proper capitalization
            $appointment->update([
                'status' => 'Completed',  // IMPORTANT: Capitalized
                'final_cost' => (float)$this->finalCost,
                'completion_notes' => trim($this->completionNotes),
                'invoice_number' => 'INV-' . strtoupper(uniqid()),
                'completed_at' => now(),
            ]);
            
            // Force refresh from database
            $appointment->refresh();

            $this->showCompleteModal = false;
            $this->selectedAppointment = null;
            $this->finalCost = null;
            $this->completionNotes = null;
            
            // Emit event that all user appointment history components will listen to
            $this->dispatch('appointmentCompleted')->to('livewire.user.appointment-history');
            
            session()->flash('message', 'Appointment marked as completed successfully.');
        } catch (\Exception $e) {
            session()->flash('error', 'Error completing appointment: ' . $e->getMessage());
        }
    }

    public function updateStatus($appointmentId, $newStatus)
    {
        if ($newStatus === 'Completed') {
            // Open modal for completion details
            $this->openCompleteModal($appointmentId);
        } else {
            // Direct status update for other statuses
            $appointment = Appointment::findOrFail($appointmentId);
            $appointment->update(['status' => $newStatus]);
            session()->flash('message', 'Appointment status updated successfully.');
        }
    }

    public function deleteAppointment($appointmentId)
    {
        $appointment = Appointment::findOrFail($appointmentId);
        $appointment->delete();
        session()->flash('message', 'Appointment deleted successfully.');
    }

    public function closeModal()
    {
        $this->showCompleteModal = false;
        $this->selectedAppointment = null;
    }

    public function render()
    {
        $query = Appointment::with('user');

        // Apply status filter
        if ($this->statusFilter !== 'all') {
            $query->where('status', $this->statusFilter);
        }

        // Apply search
        if ($this->search) {
            $query->whereHas('user', function ($q) {
                $q->where('first_name', 'like', "%{$this->search}%")
                  ->orWhere('last_name', 'like', "%{$this->search}%");
            })->orWhere('device_brand', 'like', "%{$this->search}%");
        }

        $appointments = $query->latest()->paginate(10);

        return view('livewire.admin.appointment-management', [
            'appointments' => $appointments,
        ]);
    }
}

<?php

namespace App\Livewire\User;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Appointment;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('layouts.user')]
#[Title('Upcoming Appointments | Repairmax')]
class UpcomingAppointments extends Component
{
    public $selectedAppointment = null;
    public $showDetailsModal = false;
    public $showRescheduleModal = false;
    public $showEditModal = false;
    public $rescheduleDate = null;
    public $rescheduleTime = null;
    public $editDeviceBrand = null;
    public $editDeviceModel = null;
    public $editFaultCategory = null;
    public $editDescription = null;

    public function cancelAppointment($id)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        // Now the IDE knows $user has the 'appointments' relationship
        $appointment = $user->appointments()->findOrFail($id);

        $appointment->update(['status' => 'Cancelled']);

        session()->flash('message', 'Appointment cancelled successfully.');
        $this->dispatch('refresh-appointments');
    }

    public function openEdit($id)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        
        $this->selectedAppointment = $user->appointments()->findOrFail($id);
        $this->editDeviceBrand = $this->selectedAppointment->device_brand;
        $this->editDeviceModel = $this->selectedAppointment->device_model;
        $this->editFaultCategory = $this->selectedAppointment->fault_category;
        $this->editDescription = $this->selectedAppointment->description;
        $this->showEditModal = true;
    }

    public function saveEdit()
    {
        if (!$this->selectedAppointment || !$this->editDeviceBrand || !$this->editFaultCategory) {
            session()->flash('error', 'Please fill in all required fields.');
            return;
        }

        $this->selectedAppointment->update([
            'device_brand' => $this->editDeviceBrand,
            'device_model' => $this->editDeviceModel,
            'fault_category' => $this->editFaultCategory,
            'description' => $this->editDescription,
        ]);

        $this->showEditModal = false;
        session()->flash('message', 'Appointment updated successfully.');
        $this->dispatch('refresh-appointments');
    }

    public function showDetails($id)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        
        $this->selectedAppointment = $user->appointments()->findOrFail($id);
        $this->showDetailsModal = true;
    }

    public function openReschedule($id)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        
        $this->selectedAppointment = $user->appointments()->findOrFail($id);
        $this->rescheduleDate = $this->selectedAppointment->pref_date;
        $this->rescheduleTime = $this->selectedAppointment->pref_time;
        $this->showRescheduleModal = true;
    }

    public function saveReschedule()
    {
        if (!$this->selectedAppointment || !$this->rescheduleDate || !$this->rescheduleTime) {
            session()->flash('error', 'Please select both date and time.');
            return;
        }

        $this->selectedAppointment->update([
            'pref_date' => $this->rescheduleDate,
            'pref_time' => $this->rescheduleTime,
        ]);

        $this->showRescheduleModal = false;
        session()->flash('message', 'Appointment rescheduled successfully.');
        $this->dispatch('refresh-appointments');
    }

    public function closeModals()
    {
        $this->showDetailsModal = false;
        $this->showRescheduleModal = false;
        $this->showEditModal = false;
        $this->selectedAppointment = null;
    }

    public function render()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        // Get appointments that are Pending or In Progress
        $appointments = $user->appointments()
            ->whereIn('status', ['Pending', 'In Progress', 'Approved'])
            ->orderBy('pref_date', 'asc')
            ->get();

        return view('livewire.user.upcoming-appointments', [
            'appointments' => $appointments
        ]);
    }
}

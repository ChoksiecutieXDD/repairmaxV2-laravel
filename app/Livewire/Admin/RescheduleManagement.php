<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\Appointment;
use App\Models\AppointmentReschedule;
use Livewire\WithPagination;
use Carbon\Carbon;

#[Layout('components.layouts.admin')]
#[Title('Reschedule Management | Repairmax')]
class RescheduleManagement extends Component
{
    use WithPagination;

    public $filter = 'all';
    public $searchTerm = '';
    public $showRescheduleModal = false;
    public $selectedAppointment;
    public $rescheduleReason;
    public $rescheduleDate;
    public $rescheduleTime;
    public $rescheduleType = 'user_no_show';

    public function rescheduleAppointment($appointmentId)
    {
        $this->selectedAppointment = Appointment::findOrFail($appointmentId);
        $this->showRescheduleModal = true;
    }

    public function confirmReschedule()
    {
        $this->validate([
            'rescheduleDate' => 'required|date|after:today',
            'rescheduleTime' => 'required|date_format:H:i',
            'rescheduleReason' => 'nullable|string',
            'rescheduleType' => 'required|in:user_no_show,technician_unavailable,admin_initiated',
        ]);

        $newDateTime = Carbon::parse($this->rescheduleDate . ' ' . $this->rescheduleTime);

        // Create reschedule record
        AppointmentReschedule::create([
            'appointment_id' => $this->selectedAppointment->id,
            'rescheduled_by' => auth()->id(),
            'original_date' => $this->selectedAppointment->pref_date,
            'new_date' => $newDateTime,
            'reason' => $this->rescheduleReason,
            'reschedule_type' => $this->rescheduleType,
            'notes' => 'Admin initiated reschedule',
        ]);

        // Update appointment
        $this->selectedAppointment->update([
            'pref_date' => $newDateTime->date(),
            'pref_time' => $newDateTime->format('H:i'),
            'cancellation_reason' => $this->rescheduleType,
            'reschedule_count' => $this->selectedAppointment->reschedule_count + 1,
            'is_rescheduled' => true,
            'status' => 'scheduled',
        ]);

        session()->flash('success', 'Appointment rescheduled successfully!');
        $this->showRescheduleModal = false;
        $this->reset(['rescheduleReason', 'rescheduleDate', 'rescheduleTime', 'rescheduleType']);
    }

    public function markAsNoShow($appointmentId)
    {
        $appointment = Appointment::findOrFail($appointmentId);
        $appointment->update([
            'status' => 'no_show',
            'cancellation_reason' => 'user_no_show',
        ]);

        session()->flash('success', 'Appointment marked as no-show.');
    }

    public function cancelAppointment($appointmentId)
    {
        $appointment = Appointment::findOrFail($appointmentId);
        $appointment->update([
            'status' => 'cancelled',
        ]);

        session()->flash('success', 'Appointment cancelled.');
    }

    public function render()
    {
        $query = Appointment::with('user', 'reschedules')
            ->where(function($q) {
                if ($this->searchTerm) {
                    $q->whereHas('user', function($u) {
                        $u->where('first_name', 'like', '%' . $this->searchTerm . '%')
                          ->orWhere('last_name', 'like', '%' . $this->searchTerm . '%')
                          ->orWhere('email', 'like', '%' . $this->searchTerm . '%');
                    })->orWhere('booking_number', 'like', '%' . $this->searchTerm . '%');
                }
            });

        if ($this->filter === 'reschedulable') {
            $query->where('reschedule_count', '<', 3)
                  ->whereIn('status', ['scheduled', 'pending']);
        } elseif ($this->filter === 'rescheduled') {
            $query->where('is_rescheduled', true);
        } elseif ($this->filter === 'no_show') {
            $query->where('status', 'no_show');
        }

        $appointments = $query->orderBy('pref_date', 'desc')->paginate(10);

        return view('livewire.admin.reschedule-management', [
            'appointments' => $appointments,
        ]);
    }
}

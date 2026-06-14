<?php

namespace App\Livewire\User;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\Appointment;
use App\Models\AppointmentReschedule;
use Carbon\Carbon;

#[Layout('components.layouts.app')]
#[Title('Reschedule Appointment | Repairmax')]
class RescheduleAppointment extends Component
{
    public $appointment_id;
    public $appointment;
    public $new_date;
    public $new_time;
    public $reason;
    public $notes;
    public $showModal = false;

    public function mount($appointment_id)
    {
        $this->appointment_id = $appointment_id;
        $this->appointment = Appointment::findOrFail($appointment_id);
        
        // Check if user owns this appointment
        if ($this->appointment->user_id !== auth()->id()) {
            abort(403);
        }
    }

    public function rescheduleAppointment()
    {
        $this->validate([
            'new_date' => 'required|date|after:today',
            'new_time' => 'required|date_format:H:i',
            'reason' => 'nullable|string|max:500',
        ]);

        $newDateTime = Carbon::parse($this->new_date . ' ' . $this->new_time);

        // Create reschedule record
        AppointmentReschedule::create([
            'appointment_id' => $this->appointment_id,
            'rescheduled_by' => auth()->id(),
            'original_date' => $this->appointment->pref_date,
            'new_date' => $newDateTime,
            'reason' => $this->reason,
            'reschedule_type' => 'user_requested',
            'notes' => $this->notes,
        ]);

        // Update appointment
        $this->appointment->update([
            'pref_date' => $newDateTime->date(),
            'pref_time' => $newDateTime->format('H:i'),
            'reschedule_count' => $this->appointment->reschedule_count + 1,
            'is_rescheduled' => true,
        ]);

        session()->flash('success', 'Appointment rescheduled successfully!');
        $this->redirect(route('user.appointments'));
    }

    public function render()
    {
        return view('livewire.user.reschedule-appointment', [
            'appointment' => $this->appointment,
            'minDate' => now()->addDay()->format('Y-m-d'),
        ]);
    }
}

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
    public function cancelAppointment($id)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        // Now the IDE knows $user has the 'appointments' relationship
        $appointment = $user->appointments()->findOrFail($id);

        $appointment->update(['status' => 'Cancelled']);

        session()->flash('message', 'Appointment cancelled successfully.');
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

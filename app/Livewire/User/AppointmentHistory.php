<?php

namespace App\Livewire\User;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('layouts.user')]
#[Title('Appointment History | Repairmax')]
class AppointmentHistory extends Component
{
    use WithPagination;

    public function render()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        // Get Completed or Cancelled appointments with pagination
        $history = $user->appointments()
            ->whereIn('status', ['Completed', 'Cancelled'])
            ->latest()
            ->paginate(10);

        return view('livewire.user.appointment-history', [
            'history' => $history
        ]);
    }
}

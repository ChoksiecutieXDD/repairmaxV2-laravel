<?php

namespace App\Livewire\User;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\Appointment;

#[Layout('layouts.user')]
#[Title('My Dashboard | Repairmax')]
class Dashboard extends Component
{
    public bool $showDetailsModal = false;
    public ?Appointment $selectedAppointment = null;

    public function viewDetails(int|string $appointmentId)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        
        $this->selectedAppointment = $user->appointments()->findOrFail($appointmentId);
        $this->showDetailsModal = true;
    }

    public function closeDetails()
    {
        $this->showDetailsModal = false;
        $this->selectedAppointment = null;
    }

    public function render()
    {
        // 1. Get the currently logged-in user
        // We add this docblock to tell VS Code that $user is specifically App\Models\User
        /** @var \App\Models\User $user */
        $user = Auth::user();

        // 2. Fetch the dynamic counts from the database using Eloquent
        // Use case-insensitive queries since database stores lowercase status values
        $activeRepairsCount = $user->appointments()
            ->whereRaw('LOWER(status) IN (?, ?)', ['in progress', 'scheduled'])
            ->count();
        
        $completedCount = $user->appointments()
            ->whereRaw('LOWER(status) = ?', ['completed'])
            ->count();
        
        $upcomingCount = $user->appointments()
            ->whereRaw('LOWER(status) IN (?, ?)', ['pending', 'pending review'])
            ->count();
        
        // Total count of all appointments
        $totalCount = $user->appointments()->count();

        // 3. Fetch the 5 most recent appointments for the data table
        $recentRepairs = $user->appointments()->latest()->take(5)->get();

        // 4. Pass the real data to the view
        return view('livewire.user.dashboard', [
            'totalCount' => $totalCount,
            'activeRepairsCount' => $activeRepairsCount,
            'upcomingCount' => $upcomingCount,
            'completedCount' => $completedCount,
            'recentRepairs' => $recentRepairs,
        ]);
    }
}

<?php

namespace App\Livewire\User;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('layouts.user')]
#[Title('My Dashboard | Repairmax')]
class Dashboard extends Component
{
    public function render()
    {
        // 1. Get the currently logged-in user
        // We add this docblock to tell VS Code that $user is specifically App\Models\User
        /** @var \App\Models\User $user */
        $user = Auth::user();

        // 2. Fetch the dynamic counts from the database using Eloquent
        $activeRepairsCount = $user->repairs()->where('status', 'In Progress')->count();
        $completedCount = $user->repairs()->where('status', 'Completed')->count();
        $upcomingCount = $user->repairs()->where('status', 'Pending')->count();

        // 3. Fetch the 5 most recent repairs for the data table
        $recentRepairs = $user->repairs()->latest()->take(5)->get();

        // 4. Pass the real data to the view
        return view('livewire.user.dashboard', [
            'activeRepairsCount' => $activeRepairsCount,
            'upcomingCount' => $upcomingCount,
            'completedCount' => $completedCount,
            'recentRepairs' => $recentRepairs,
        ]);
    }
}

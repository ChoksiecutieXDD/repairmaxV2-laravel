<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\User;

#[Layout('components.layouts.admin')]
#[Title('Admin Dashboard | Repairmax')]
class Dashboard extends Component
{
    public $totalUsers = 0;
    public $totalAppointments = 0;
    public $pendingRepairs = 0;
    public $monthlyRevenue = 0;

    public function mount()
    {
        $this->totalUsers = User::where('role', 'user')->count();
        $this->totalAppointments = 156; // Will be replaced with real data
        $this->pendingRepairs = 12;
        $this->monthlyRevenue = 5240;
    }

    public function render()
    {
        return view('livewire.admin.dashboard');
    }
}

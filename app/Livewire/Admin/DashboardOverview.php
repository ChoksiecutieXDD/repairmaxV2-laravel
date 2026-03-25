<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('components.layouts.admin')]
#[Title('System Overview | Repairmax')]
class DashboardOverview extends Component
{
    public $systemUptime = '99.8%';
    public $totalUsers = 1247;
    public $adminCount = 5;
    public $userCount = 1242;
    public $pendingTasks = 23;
    public $storageUsed = '45.2 GB';

    public function render()
    {
        return view('livewire.admin.dashboard-overview');
    }
}

<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\User;
use App\Models\Appointment;
use Carbon\Carbon;

#[Layout('components.layouts.admin')]
#[Title('System Settings | Repairmax')]
class SystemSettings extends Component
{
    public $activeTab = 'settings';
    public $maintenanceMode = false;
    public $emailNotifications = true;
    public $dataBackup = true;
    public $autoBackupTime = '02:00';
    public $systemVersion = '1.0.0';

    public function mount()
    {
        $tab = \Illuminate\Support\Facades\Request::query('tab');
        if ($tab && in_array($tab, ['settings', 'overview'])) {
            $this->activeTab = $tab;
        }
    }

    public function toggleMaintenance()
    {
        $this->maintenanceMode = !$this->maintenanceMode;
    }

    public function toggleEmailNotifications()
    {
        $this->emailNotifications = !$this->emailNotifications;
    }

    public function toggleDataBackup()
    {
        $this->dataBackup = !$this->dataBackup;
    }

    public function saveSettings()
    {
        \Illuminate\Support\Facades\Session::flash('success', 'System settings updated successfully!');
    }

    private function getAppointmentTrend()
    {
        $days = [];
        $counts = [];

        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $count = Appointment::whereDate('pref_date', $date)->count();
            
            $days[] = $date->format('M d');
            $counts[] = $count;
        }

        return [
            'labels' => $days,
            'data' => $counts,
        ];
    }

    private function getUserGrowth()
    {
        $days = [];
        $counts = [];

        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $count = User::whereDate('created_at', '<=', $date)->count();
            
            $days[] = $date->format('M d');
            $counts[] = $count;
        }

        return [
            'labels' => $days,
            'data' => $counts,
        ];
    }

    public function render()
    {
        $data = [];

        if ($this->activeTab === 'overview') {
            // Real Database Queries
            $totalUsers = User::count();
            $adminCount = User::where('role', 'admin')->count();
            $userCount = User::where('role', 'user')->count();

            $pendingTasks = Appointment::where('status', 'Pending')->count();

            // Fetch Today's Appointments (Real Data)
            $todaysAppointments = Appointment::whereDate('pref_date', Carbon::today())
                ->take(5)
                ->get();

            // Chart Data
            $appointmentTrend = $this->getAppointmentTrend();
            $userGrowth = $this->getUserGrowth();

            // Static Stats
            $systemUptime = "99.8%";
            $storageUsed = "42.5GB";

            $data = [
                'totalUsers' => $totalUsers,
                'adminCount' => $adminCount,
                'userCount' => $userCount,
                'pendingTasks' => $pendingTasks,
                'todaysAppointments' => $todaysAppointments,
                'systemUptime' => $systemUptime,
                'storageUsed' => $storageUsed,
                'appointmentTrend' => $appointmentTrend,
                'userGrowth' => $userGrowth,
            ];
        }

        return view('livewire.admin.system-settings', $data);
    }
}

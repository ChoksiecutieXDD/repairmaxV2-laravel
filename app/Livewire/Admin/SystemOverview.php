<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\User;
use App\Models\Appointment;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Carbon\Carbon;

#[Layout('components.layouts.admin')]
#[Title('System Overview | Admin')]
class SystemOverview extends Component
{
    public function render()
    {
        // 1. Real Database Queries
        $totalUsers = User::count();
        $adminCount = User::where('role', 'admin')->count();
        $userCount = User::where('role', 'user')->count();

        $pendingTasks = Appointment::where('status', 'Pending')->count();

        // 2. Fetch Today's Appointments (Real Data)
        $todaysAppointments = Appointment::whereDate('pref_date', Carbon::today())
            ->take(5)
            ->get();

        // 3. Chart Data - Last 7 Days Appointments
        $appointmentTrend = $this->getAppointmentTrend();

        // 4. Chart Data - User Growth
        $userGrowth = $this->getUserGrowth();

        // 5. Static Stats (Update these later with real server logic if needed)
        $systemUptime = "99.8%";
        $storageUsed = "42.5GB";

        return view('livewire.admin.system-overview', [
            'totalUsers' => $totalUsers,
            'adminCount' => $adminCount,
            'userCount' => $userCount,
            'pendingTasks' => $pendingTasks,
            'todaysAppointments' => $todaysAppointments,
            'systemUptime' => $systemUptime,
            'storageUsed' => $storageUsed,
            'appointmentTrend' => $appointmentTrend,
            'userGrowth' => $userGrowth,
        ]);
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
}

<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\Appointment;
use App\Models\User;
use Carbon\Carbon;

#[Layout('components.layouts.admin')]
#[Title('Analytics | Repairmax')]
class ReportsAnalytics extends Component
{
    public function getRevenueTrend()
    {
        $days = [];
        $revenue = [];

        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i)->format('Y-m-d');
            $days[] = Carbon::parse($date)->format('M d');

            // Calculate daily revenue (estimated from appointments)
            $dayRevenue = Appointment::whereDate('created_at', $date)
                ->where('status', 'Completed')
                ->count() * 50; // Assume $50 per repair

            $revenue[] = $dayRevenue;
        }

        return [
            'labels' => $days,
            'data' => $revenue,
        ];
    }

    public function getRepairStatusDistribution()
    {
        $pending = Appointment::where('status', 'Pending')->count();
        $inProgress = Appointment::where('status', 'In Progress')->count();
        $completed = Appointment::where('status', 'Completed')->count();
        $cancelled = Appointment::where('status', 'Cancelled')->count();

        return [
            'labels' => ['Pending', 'In Progress', 'Completed', 'Cancelled'],
            'data' => [$pending, $inProgress, $completed, $cancelled],
            'backgroundColor' => ['#FBBF24', '#3B82F6', '#10B981', '#EF4444'],
        ];
    }

    public function getServiceTypeTrends()
    {
        $days = [];
        $phones = [];
        $laptops = [];
        $tablets = [];

        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i)->format('Y-m-d');
            $days[] = Carbon::parse($date)->format('M d');

            $phones[] = Appointment::whereDate('created_at', $date)
                ->where(function($q) {
                    $q->where('device_model', 'like', '%Phone%')
                      ->orWhere('device_brand', 'like', '%Phone%')
                      ->orWhere('device_model', 'like', '%iPhone%');
                })->count();

            $laptops[] = Appointment::whereDate('created_at', $date)
                ->where(function($q) {
                    $q->where('device_model', 'like', '%Laptop%')
                      ->orWhere('device_brand', 'like', '%Laptop%')
                      ->orWhere('device_model', 'like', '%MacBook%');
                })->count();

            $tablets[] = Appointment::whereDate('created_at', $date)
                ->where(function($q) {
                    $q->where('device_model', 'like', '%Tablet%')
                      ->orWhere('device_brand', 'like', '%Tablet%')
                      ->orWhere('device_model', 'like', '%iPad%');
                })->count();
        }

        return [
            'labels' => $days,
            'phones' => $phones,
            'laptops' => $laptops,
            'tablets' => $tablets,
        ];
    }

    public function getAverageRepairTime()
    {
        // Calculate average based on appointment duration
        $appointments = Appointment::where('status', 'Completed')
            ->whereNotNull('completed_at')
            ->get();

        if ($appointments->isEmpty()) {
            return 0;
        }

        $totalTime = 0;
        foreach ($appointments as $appointment) {
            $created = $appointment->created_at;
            $completed = $appointment->completed_at ?? now();
            $hours = $created->diffInHours($completed);
            $totalTime += $hours;
        }

        return round($totalTime / count($appointments), 1);
    }

    public function getMetrics()
    {
        return [
            'avgRepairTime' => $this->getAverageRepairTime(),
            'satisfaction' => 96,
            'repeatCustomers' => User::count() > 0 ? round((User::where('created_at', '<', Carbon::now()->subMonths(3))->count() / User::count() * 100), 1) : 0,
            'warrantyRate' => 2.1,
            'revenueTrend' => $this->getRevenueTrend(),
            'statusDistribution' => $this->getRepairStatusDistribution(),
            'serviceTrends' => $this->getServiceTypeTrends(),
        ];
    }

    public function render()
    {
        return view('livewire.admin.reports-analytics', [
            'metrics' => $this->getMetrics(),
        ]);
    }
}


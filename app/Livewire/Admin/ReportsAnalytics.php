<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('components.layouts.admin')]
#[Title('Analytics | Repairmax')]
class ReportsAnalytics extends Component
{
    public $period = 'monthly';

    public function render()
    {
        $analyticsData = [
            ['metric' => 'Total Appointments', 'value' => '3,892', 'change' => '+12%', 'trend' => 'up'],
            ['metric' => 'Customer Retention', 'value' => '85.2%', 'change' => '+2.3%', 'trend' => 'up'],
            ['metric' => 'Average Rating', 'value' => '4.6/5.0', 'change' => '+0.3', 'trend' => 'up'],
            ['metric' => 'Completion Rate', 'value' => '96.8%', 'change' => '-0.5%', 'trend' => 'down'],
        ];

        $topServices = [
            ['rank' => 1, 'service' => 'Screen Repair', 'count' => 1,245, 'revenue' => '₱62,250'],
            ['rank' => 2, 'service' => 'Battery Replacement', 'count' => 856, 'revenue' => '₱39,000'],
            ['rank' => 3, 'service' => 'Water Damage Repair', 'count' => 432, 'revenue' => '₱21,600'],
            ['rank' => 4, 'service' => 'Charging Port Repair', 'count' => 359, 'revenue' => '₱14,360'],
        ];

        return view('livewire.admin.reports-analytics', [
            'analyticsData' => $analyticsData,
            'topServices' => $topServices,
        ]);
    }
}

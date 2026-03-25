<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('components.layouts.admin')]
#[Title('Reports | Repairmax')]
class Reports extends Component
{
    public $reportType = 'monthly';
    public $dateFrom = '';
    public $dateTo = '';

    public function render()
    {
        $reports = [
            ['id' => 1, 'title' => 'Monthly Revenue Report', 'description' => 'Total revenue for March 2026', 'date' => '2026-03-26', 'status' => 'Completed', 'amount' => '₱145,000'],
            ['id' => 2, 'title' => 'Customer Satisfaction Report', 'description' => 'Customer feedback and ratings', 'date' => '2026-03-20', 'status' => 'Completed', 'rating' => '4.5/5.0'],
            ['id' => 3, 'title' => 'Service Performance Report', 'description' => 'Repair completion and turnaround times', 'date' => '2026-03-15', 'status' => 'Completed', 'metric' => '98.5%'],
            ['id' => 4, 'title' => 'Growth Analytics', 'description' => 'Monthly growth metrics and projections', 'date' => '2026-03-10', 'status' => 'Draft', 'growth' => '+12%'],
        ];

        return view('livewire.admin.reports', [
            'reports' => $reports,
        ]);
    }
}

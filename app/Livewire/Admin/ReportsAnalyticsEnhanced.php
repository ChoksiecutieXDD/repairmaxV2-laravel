<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\Appointment;
use App\Models\RepairItem;
use App\Models\InventoryItem;
use App\Models\User;
use Carbon\Carbon;

#[Layout('components.layouts.admin')]
#[Title('Analytics & Reports | Repairmax')]
class ReportsAnalyticsEnhanced extends Component
{
    public $timeframe = 'daily'; // daily, weekly, monthly, yearly
    public $selectedPeriod = null;

    public function mount()
    {
        $this->selectedPeriod = now()->format('Y-m-d');
    }

    // ============ PROFIT & SALES CALCULATIONS ============

    public function getSalesAndProfitData($timeframe = 'daily')
    {
        $query = Appointment::where('status', 'completed')->where('final_cost', '>', 0);

        $sales = 0;
        $partsCharge = 0;
        $serviceCharge = 0;
        $totalCosts = 0;
        $profit = 0;

        switch ($timeframe) {
            case 'daily':
                $date = Carbon::parse($this->selectedPeriod)->format('Y-m-d');
                $query->whereDate('completed_at', $date);
                break;
            case 'weekly':
                $startDate = Carbon::parse($this->selectedPeriod)->startOfWeek();
                $endDate = $startDate->copy()->endOfWeek();
                $query->whereBetween('completed_at', [$startDate, $endDate]);
                break;
            case 'monthly':
                $date = Carbon::parse($this->selectedPeriod)->format('Y-m');
                $query->whereRaw("DATE_FORMAT(completed_at, '%Y-%m') = ?", [$date]);
                break;
            case 'yearly':
                $year = Carbon::parse($this->selectedPeriod)->format('Y');
                $query->whereRaw("YEAR(completed_at) = ?", [$year]);
                break;
        }

        $appointments = $query->get();

        foreach ($appointments as $appointment) {
            // Sales = final_cost charged to customer
            $sales += $appointment->final_cost;

            // Service charge
            $serviceCharge += $appointment->service_cost;

            // Parts used
            $repairItems = $appointment->repairItems()->sum('total_cost');
            $partsCharge += $appointment->parts_cost;
            $totalCosts += $appointment->service_cost + $appointment->parts_cost;

            // Profit = final_cost - (service_cost + parts_cost)
            $profit += $appointment->calculateProfit();
        }

        return [
            'sales' => round($sales, 2),
            'service_charge' => round($serviceCharge, 2),
            'parts_cost' => round($partsCharge, 2),
            'total_costs' => round($totalCosts, 2),
            'profit' => round($profit, 2),
            'profit_margin' => $sales > 0 ? round(($profit / $sales * 100), 2) : 0,
            'appointments_count' => count($appointments),
        ];
    }

    public function getTrendData()
    {
        $labels = [];
        $sales = [];
        $profits = [];

        if ($this->timeframe === 'daily') {
            for ($i = 6; $i >= 0; $i--) {
                $date = now()->subDays($i)->format('Y-m-d');
                $labels[] = Carbon::parse($date)->format('M d');

                $this->selectedPeriod = $date;
                $data = $this->getSalesAndProfitData('daily');
                $sales[] = $data['sales'];
                $profits[] = $data['profit'];
            }
        } elseif ($this->timeframe === 'weekly') {
            for ($i = 11; $i >= 0; $i--) {
                $startDate = now()->subWeeks($i)->startOfWeek();
                $labels[] = $startDate->format('M d') . ' - ' . $startDate->copy()->endOfWeek()->format('M d');

                $this->selectedPeriod = $startDate->format('Y-m-d');
                $data = $this->getSalesAndProfitData('weekly');
                $sales[] = $data['sales'];
                $profits[] = $data['profit'];
            }
        } elseif ($this->timeframe === 'monthly') {
            for ($i = 11; $i >= 0; $i--) {
                $date = now()->subMonths($i);
                $labels[] = $date->format('M Y');

                $this->selectedPeriod = $date->format('Y-m-d');
                $data = $this->getSalesAndProfitData('monthly');
                $sales[] = $data['sales'];
                $profits[] = $data['profit'];
            }
        } elseif ($this->timeframe === 'yearly') {
            for ($i = 4; $i >= 0; $i--) {
                $year = now()->subYears($i)->year;
                $labels[] = strval($year);

                $this->selectedPeriod = $year . '-01-01';
                $data = $this->getSalesAndProfitData('yearly');
                $sales[] = $data['sales'];
                $profits[] = $data['profit'];
            }
        }

        return [
            'labels' => $labels,
            'sales' => $sales,
            'profits' => $profits,
        ];
    }

    // ============ REVENUE & PERFORMANCE ============

    public function getRevenueTrend()
    {
        $trend = $this->getTrendData();
        return [
            'labels' => $trend['labels'],
            'data' => $trend['sales'],
        ];
    }

    public function getProfitTrend()
    {
        $trend = $this->getTrendData();
        return [
            'labels' => $trend['labels'],
            'data' => $trend['profits'],
        ];
    }

    public function getRepairStatusDistribution()
    {
        $pending = Appointment::where('status', 'pending')->count();
        $scheduled = Appointment::where('status', 'scheduled')->count();
        $inProgress = Appointment::where('status', 'in_progress')->count();
        $completed = Appointment::where('status', 'completed')->count();
        $cancelled = Appointment::where('status', 'cancelled')->count();

        return [
            'labels' => ['Pending', 'Scheduled', 'In Progress', 'Completed', 'Cancelled'],
            'data' => [$pending, $scheduled, $inProgress, $completed, $cancelled],
            'backgroundColor' => ['#FBBF24', '#60A5FA', '#3B82F6', '#10B981', '#EF4444'],
        ];
    }

    public function getServiceTypeTrends()
    {
        $days = [];
        $phones = [];
        $laptops = [];
        $tablets = [];
        $others = [];

        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i)->format('Y-m-d');
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

            $others[] = Appointment::whereDate('created_at', $date)
                ->whereNotIn('device_model', ['Phone', 'Laptop', 'Tablet', 'iPhone', 'MacBook', 'iPad'])
                ->count();
        }

        return [
            'labels' => $days,
            'phones' => $phones,
            'laptops' => $laptops,
            'tablets' => $tablets,
            'others' => $others,
        ];
    }

    public function getInventoryMetrics()
    {
        $totalInventoryValue = InventoryItem::sum(\DB::raw('quantity * unit_price'));
        $totalInventoryCost = InventoryItem::sum(\DB::raw('quantity * cost_price'));
        $lowStock = InventoryItem::where('quantity', '<=', 10)->count();
        $outOfStock = InventoryItem::where('quantity', '<=', 0)->count();

        return [
            'total_items' => InventoryItem::count(),
            'total_value' => round($totalInventoryValue, 2),
            'total_cost' => round($totalInventoryCost, 2),
            'potential_profit' => round($totalInventoryValue - $totalInventoryCost, 2),
            'low_stock' => $lowStock,
            'out_of_stock' => $outOfStock,
        ];
    }

    public function getMetrics()
    {
        $currentData = $this->getSalesAndProfitData($this->timeframe);
        $trendData = $this->getTrendData();

        return [
            'current' => $currentData,
            'revenue_trend' => $this->getRevenueTrend(),
            'profit_trend' => $this->getProfitTrend(),
            'status_distribution' => $this->getRepairStatusDistribution(),
            'service_trends' => $this->getServiceTypeTrends(),
            'inventory' => $this->getInventoryMetrics(),
        ];
    }

    public function render()
    {
        return view('livewire.admin.reports-analytics-enhanced', [
            'metrics' => $this->getMetrics(),
            'timeframe' => $this->timeframe,
        ]);
    }
}

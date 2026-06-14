<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\On;
use App\Models\Repair;
use App\Models\Appointment;
use App\Models\User;
use App\Models\InventoryItem;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

#[Layout('components.layouts.admin')]
#[Title('Reports | Repairmax')]
class Reports extends Component
{
    public $reportType = 'summary';
    public $startDate;
    public $endDate;
    public $timeframe = 'weekly';

    protected $listeners = ['appointmentCompleted' => 'refreshReports', 'appointmentFinanceUpdated' => 'refreshReports'];

    public function mount()
    {
        $this->startDate = now()->startOfMonth()->format('Y-m-d');
        $this->endDate = now()->format('Y-m-d');
    }

    public function refreshReports()
    {
        // This method is triggered by event when appointment is completed
        $this->dispatch('$refresh');
    }

    public function updatedTimeframe($value)
    {
        // Just by updating this property, Livewire automatically re-renders the component
        // No need to dispatch anything - the reactive binding handles it
    }

    public function getSalesAndProfitData($timeframe)
    {
        $query = Appointment::whereRaw('LOWER(status) = ?', ['completed']);

        // Determine database driver and use appropriate date format function
        $driver = DB::getDriverName();
        
        $dateFormat = match(true) {
            $driver === 'sqlite' => match($timeframe) {
                'weekly' => "strftime('%Y-W%W', created_at)",
                'monthly' => "strftime('%Y-%m', created_at)",
                'yearly' => "strftime('%Y', created_at)",
                default => "strftime('%Y-%m-%d', created_at)", // daily
            },
            default => match($timeframe) { // MySQL
                'weekly' => "DATE_FORMAT(created_at, '%Y-W%w')",
                'monthly' => "DATE_FORMAT(created_at, '%Y-%m')",
                'yearly' => "DATE_FORMAT(created_at, '%Y')",
                default => "DATE_FORMAT(created_at, '%Y-%m-%d')", // daily
            }
        };

        $data = $query->select(
                DB::raw("$dateFormat as period"),
                DB::raw('SUM(final_cost) as sales'),
                DB::raw('SUM(COALESCE(service_cost, 0)) as service_charge'),
                DB::raw('SUM(COALESCE(parts_cost, 0)) as parts_cost'),
                DB::raw('SUM(COALESCE(service_cost, 0) + COALESCE(parts_cost, 0)) as total_costs'),
                DB::raw('SUM(final_cost) - SUM(COALESCE(service_cost, 0) + COALESCE(parts_cost, 0)) as profit'),
                DB::raw('COUNT(*) as appointments_count')
            )
            ->groupByRaw("$dateFormat")
            ->orderBy('period')
            ->get();

        if ($data->isEmpty()) {
            return [
                'sales' => 0,
                'service_charge' => 0,
                'parts_cost' => 0,
                'total_costs' => 0,
                'profit' => 0,
                'profit_margin' => 0,
                'appointments_count' => 0,
            ];
        }

        $totalSales = (float) $data->sum('sales');
        $totalProfit = (float) $data->sum('profit');
        $margin = $totalSales > 0 ? round(($totalProfit / $totalSales) * 100, 1) : 0;

        return [
            'sales' => $totalSales,
            'service_charge' => (float) $data->sum('service_charge'),
            'parts_cost' => (float) $data->sum('parts_cost'),
            'total_costs' => (float) $data->sum('total_costs'),
            'profit' => $totalProfit,
            'profit_margin' => $margin,
            'appointments_count' => (int) $data->sum('appointments_count'),
        ];
    }

    public function getProfitTrend()
    {
        $labels = [];
        $data = [];
        $baseDate = now();

        if ($this->timeframe === 'daily') {
            // Per Hour for today
            for ($hour = 0; $hour < 24; $hour++) {
                $startTime = $baseDate->copy()->setHour($hour)->setMinute(0)->setSecond(0);
                $endTime = $baseDate->copy()->setHour($hour)->setMinute(59)->setSecond(59);
                $labels[] = ($hour + 1) . ':00';

                $profit = Appointment::whereRaw('LOWER(status) = ?', ['completed'])
                    ->whereBetween('created_at', [$startTime, $endTime])
                    ->selectRaw('SUM(COALESCE(profit, 0)) as profit')
                    ->value('profit') ?? 0;

                $data[] = (float) $profit;
            }
        } elseif ($this->timeframe === 'weekly') {
            // Per Day for this week (Mon-Sun)
            $weekStart = $baseDate->copy()->startOfWeek();
            for ($day = 0; $day < 7; $day++) {
                $currentDay = $weekStart->copy()->addDays($day);
                $labels[] = 'Day ' . ($day + 1);

                $profit = Appointment::whereRaw('LOWER(status) = ?', ['completed'])
                    ->whereDate('created_at', $currentDay->format('Y-m-d'))
                    ->selectRaw('SUM(COALESCE(profit, 0)) as profit')
                    ->value('profit') ?? 0;

                $data[] = (float) $profit;
            }
        } elseif ($this->timeframe === 'monthly') {
            // Per Week for this month
            $monthStart = $baseDate->copy()->startOfMonth();
            $monthEnd = $baseDate->copy()->endOfMonth();
            $weekCount = 0;

            for ($week = 0; $week < 4; $week++) {
                $weekStart = $monthStart->copy()->addWeeks($week)->startOfWeek();
                $weekEnd = $weekStart->copy()->endOfWeek();

                // Ensure we don't go beyond the month
                if ($weekStart > $monthEnd) break;
                if ($weekEnd > $monthEnd) $weekEnd = $monthEnd;

                $labels[] = 'Week ' . ($week + 1);
                $weekCount++;

                $profit = Appointment::whereRaw('LOWER(status) = ?', ['completed'])
                    ->whereBetween('created_at', [$weekStart, $weekEnd])
                    ->selectRaw('SUM(COALESCE(profit, 0)) as profit')
                    ->value('profit') ?? 0;

                $data[] = (float) $profit;
            }
        } else { // yearly
            // Per Month for this year
            for ($month = 1; $month <= 12; $month++) {
                $monthStart = $baseDate->copy()->setMonth($month)->startOfMonth();
                $monthEnd = $monthStart->copy()->endOfMonth();
                $labels[] = $month . ' Month';

                $profit = Appointment::whereRaw('LOWER(status) = ?', ['completed'])
                    ->whereBetween('created_at', [$monthStart, $monthEnd])
                    ->selectRaw('SUM(COALESCE(profit, 0)) as profit')
                    ->value('profit') ?? 0;

                $data[] = (float) $profit;
            }
        }

        return [
            'labels' => $labels,
            'data' => $data,
        ];
    }

    public function getRevenueTrendWithCosts()
    {
        $labels = [];
        $sales = [];
        $costs = [];
        $baseDate = now();

        if ($this->timeframe === 'daily') {
            // Per Hour for today
            for ($hour = 0; $hour < 24; $hour++) {
                $startTime = $baseDate->copy()->setHour($hour)->setMinute(0)->setSecond(0);
                $endTime = $baseDate->copy()->setHour($hour)->setMinute(59)->setSecond(59);
                $labels[] = ($hour + 1) . ':00';

                $appointmentData = Appointment::whereRaw('LOWER(status) = ?', ['completed'])
                    ->whereBetween('created_at', [$startTime, $endTime])
                    ->selectRaw('SUM(COALESCE(final_cost, 0)) as revenue, SUM(COALESCE(service_cost, 0) + COALESCE(parts_cost, 0)) as costs')
                    ->first();

                $sales[] = (float) ($appointmentData->revenue ?? 0);
                $costs[] = (float) ($appointmentData->costs ?? 0);
            }
        } elseif ($this->timeframe === 'weekly') {
            // Per Day for this week (Mon-Sun)
            $weekStart = $baseDate->copy()->startOfWeek();
            for ($day = 0; $day < 7; $day++) {
                $currentDay = $weekStart->copy()->addDays($day);
                $labels[] = 'Day ' . ($day + 1);

                $appointmentData = Appointment::whereRaw('LOWER(status) = ?', ['completed'])
                    ->whereDate('created_at', $currentDay->format('Y-m-d'))
                    ->selectRaw('SUM(COALESCE(final_cost, 0)) as revenue, SUM(COALESCE(service_cost, 0) + COALESCE(parts_cost, 0)) as costs')
                    ->first();

                $sales[] = (float) ($appointmentData->revenue ?? 0);
                $costs[] = (float) ($appointmentData->costs ?? 0);
            }
        } elseif ($this->timeframe === 'monthly') {
            // Per Week for this month
            $monthStart = $baseDate->copy()->startOfMonth();
            $monthEnd = $baseDate->copy()->endOfMonth();

            for ($week = 0; $week < 4; $week++) {
                $weekStart = $monthStart->copy()->addWeeks($week)->startOfWeek();
                $weekEnd = $weekStart->copy()->endOfWeek();

                // Ensure we don't go beyond the month
                if ($weekStart > $monthEnd) break;
                if ($weekEnd > $monthEnd) $weekEnd = $monthEnd;

                $labels[] = 'Week ' . ($week + 1);

                $appointmentData = Appointment::whereRaw('LOWER(status) = ?', ['completed'])
                    ->whereBetween('created_at', [$weekStart, $weekEnd])
                    ->selectRaw('SUM(COALESCE(final_cost, 0)) as revenue, SUM(COALESCE(service_cost, 0) + COALESCE(parts_cost, 0)) as costs')
                    ->first();

                $sales[] = (float) ($appointmentData->revenue ?? 0);
                $costs[] = (float) ($appointmentData->costs ?? 0);
            }
        } else { // yearly
            // Per Month for this year
            for ($month = 1; $month <= 12; $month++) {
                $monthStart = $baseDate->copy()->setMonth($month)->startOfMonth();
                $monthEnd = $monthStart->copy()->endOfMonth();
                $labels[] = $month . ' Month';

                $appointmentData = Appointment::whereRaw('LOWER(status) = ?', ['completed'])
                    ->whereBetween('created_at', [$monthStart, $monthEnd])
                    ->selectRaw('SUM(COALESCE(final_cost, 0)) as revenue, SUM(COALESCE(service_cost, 0) + COALESCE(parts_cost, 0)) as costs')
                    ->first();

                $sales[] = (float) ($appointmentData->revenue ?? 0);
                $costs[] = (float) ($appointmentData->costs ?? 0);
            }
        }

        return [
            'labels' => $labels,
            'sales' => $sales,
            'costs' => $costs,
        ];
    }

    public function render()
    {
        $repairStats = [
            'total' => Repair::count(),
            'pending' => Repair::where('status', 'Pending')->count(),
            'in_progress' => Repair::where('status', 'In Progress')->count(),
            'completed' => Repair::where('status', 'Completed')->count(),
        ];

        $appointmentStats = [
            'total' => Appointment::count(),
            'pending' => Appointment::whereRaw('LOWER(status) = ?', ['pending'])->count(),
            'scheduled' => Appointment::whereRaw('LOWER(status) = ?', ['scheduled'])->count(),
            'completed' => Appointment::whereRaw('LOWER(status) = ?', ['completed'])->count(),
            'cancelled' => Appointment::whereRaw('LOWER(status) = ?', ['cancelled'])->count(),
        ];

        $userStats = [
            'total_users' => User::where('role', 'user')->count(),
            'active_users' => User::where('role', 'user')->where('is_active', true)->count(),
            'total_admins' => User::where('role', 'admin')->count(),
        ];

        $inventoryStats = [
            'total_items' => InventoryItem::count(),
            'low_stock' => InventoryItem::where('quantity', '<=', 10)->count(),
            'out_of_stock' => InventoryItem::where('quantity', '<=', 0)->count(),
            'total_value' => InventoryItem::sum(\DB::raw('quantity * unit_price')),
        ];

        // Get sales and profit data
        $salesAndProfitData = $this->getSalesAndProfitData($this->timeframe);
        $profitTrend = $this->getProfitTrend();
        $revenueTrendWithCosts = $this->getRevenueTrendWithCosts();

        $recentRepairs = Repair::with('user')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        $recentAppointments = Appointment::with('user')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        return view('livewire.admin.reports', array_merge(compact(
            'repairStats',
            'appointmentStats',
            'userStats',
            'inventoryStats',
            'recentRepairs',
            'recentAppointments',
            'salesAndProfitData',
            'profitTrend',
            'revenueTrendWithCosts'
        ), [
            'metrics' => $this->getMetrics()
        ]));
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
        ];
    }

    public function exportReport()
    {
        try {
            $fileName = 'repair-report-' . date('Y-m-d-His') . '.csv';
            
            // Get data
            $repairs = Repair::with('user')
                ->whereBetween('created_at', [$this->startDate, $this->endDate])
                ->get();

            // Create CSV content
            $csv = "Repair Report\n";
            $csv .= "Generated: " . now()->format('Y-m-d H:i:s') . "\n";
            $csv .= "Period: {$this->startDate} to {$this->endDate}\n\n";
            
            $csv .= "Tracking Code,Customer,Device,Issue Type,Status,Quote,Created Date\n";

            foreach($repairs as $repair) {
                $csv .= "\"{$repair->tracking_code}\",";
                $csv .= "\"{$repair->user->getFullName()}\",";
                $csv .= "\"{$repair->device_name}\",";
                $csv .= "\"{$repair->issue_type}\",";
                $csv .= "\"{$repair->status}\",";
                $csv .= "\"₱{$repair->quote}\",";
                $csv .= "\"{$repair->created_at->format('Y-m-d')}\"\n";
            }

            // Create temporary file
            $path = storage_path('app/temp/' . $fileName);
            if (!file_exists(storage_path('app/temp'))) {
                mkdir(storage_path('app/temp'), 0755, true);
            }

            file_put_contents($path, $csv);

            // Download and delete
            session()->flash('success', 'Report exported successfully!');
            
            return response()->download($path)->deleteFileAfterSend(true);
        } catch (\Exception $e) {
            session()->flash('error', 'Failed to export report: ' . $e->getMessage());
        }
    }

    public function exportAppointmentReport()
    {
        try {
            $fileName = 'appointment-report-' . date('Y-m-d-His') . '.csv';
            
            $appointments = Appointment::with('user')
                ->whereBetween('created_at', [$this->startDate, $this->endDate])
                ->get();

            $csv = "Appointment Report\n";
            $csv .= "Generated: " . now()->format('Y-m-d H:i:s') . "\n";
            $csv .= "Period: {$this->startDate} to {$this->endDate}\n\n";
            
            $csv .= "Tracking Code,Customer,Device,Fault Category,Preferred Date,Status,Created Date\n";

            foreach($appointments as $appointment) {
                $csv .= "\"{$appointment->tracking_code}\",";
                $csv .= "\"{$appointment->user->getFullName()}\",";
                $csv .= "\"{$appointment->device_brand} {$appointment->device_model}\",";
                $csv .= "\"{$appointment->fault_category}\",";
                $csv .= "\"{$appointment->pref_date}\",";
                $csv .= "\"{$appointment->status}\",";
                $csv .= "\"{$appointment->created_at->format('Y-m-d')}\"\n";
            }

            $path = storage_path('app/temp/' . $fileName);
            if (!file_exists(storage_path('app/temp'))) {
                mkdir(storage_path('app/temp'), 0755, true);
            }

            file_put_contents($path, $csv);
            
            session()->flash('success', 'Appointment report exported successfully!');
            
            return response()->download($path)->deleteFileAfterSend(true);
        } catch (\Exception $e) {
            session()->flash('error', 'Failed to export report: ' . $e->getMessage());
        }
    }
}

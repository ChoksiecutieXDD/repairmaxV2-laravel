<div class="w-full" wire:key="reports-{{ $timeframe }}">
    <div class="mb-8 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="text-3xl font-bold text-gray-900 tracking-tight">Reports</h1>
            <p class="text-gray-500 mt-1">Generate business and operational reports.</p>
        </div>
        <div class="flex gap-2">
            <button wire:click="exportReport" class="inline-flex items-center gap-2 bg-green-600 text-white hover:bg-green-700 px-4 py-2 rounded-full font-bold shadow-md transition-colors">
                <span class="material-symbols-outlined text-[20px]">download</span>
                Export Repairs
            </button>
            <button wire:click="exportAppointmentReport" class="inline-flex items-center gap-2 bg-blue-600 text-white hover:bg-blue-700 px-4 py-2 rounded-full font-bold shadow-md transition-colors">
                <span class="material-symbols-outlined text-[20px]">download</span>
                Export Appointments
            </button>
        </div>
    </div>

    @if (session()->has('success'))
        <div class="mb-4 p-4 rounded-lg bg-green-50 border border-green-200 text-green-700">{{ session('success') }}</div>
    @endif

    @if (session()->has('error'))
        <div class="mb-4 p-4 rounded-lg bg-red-50 border border-red-200 text-red-700">{{ session('error') }}</div>
    @endif

    <!-- Timeframe Selector for Sales & Profit -->
    <div class="mb-6 flex gap-2 border-b pb-4">
        <button wire:click="$set('timeframe', 'daily')" 
                class="px-4 py-2 {{ $timeframe === 'daily' ? 'bg-blue-600 text-white' : 'bg-gray-200' }} rounded">
            Daily
        </button>
        <button wire:click="$set('timeframe', 'weekly')" 
                class="px-4 py-2 {{ $timeframe === 'weekly' ? 'bg-blue-600 text-white' : 'bg-gray-200' }} rounded">
            Weekly
        </button>
        <button wire:click="$set('timeframe', 'monthly')" 
                class="px-4 py-2 {{ $timeframe === 'monthly' ? 'bg-blue-600 text-white' : 'bg-gray-200' }} rounded">
            Monthly
        </button>
        <button wire:click="$set('timeframe', 'yearly')" 
                class="px-4 py-2 {{ $timeframe === 'yearly' ? 'bg-blue-600 text-white' : 'bg-gray-200' }} rounded">
            Yearly
        </button>
    </div>

    <!-- Sales & Profit Metrics -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4 mb-8">
        <div class="bg-gradient-to-br from-green-500 to-green-600 text-white p-4 rounded-lg shadow">
            <div class="text-sm font-semibold opacity-90">Total Sales</div>
            <div class="text-3xl font-bold">₱{{ number_format($salesAndProfitData['sales'], 2) }}</div>
            <div class="text-xs opacity-75 mt-1">{{ $salesAndProfitData['appointments_count'] }} repairs</div>
        </div>

        <div class="bg-gradient-to-br from-blue-500 to-blue-600 text-white p-4 rounded-lg shadow">
            <div class="text-sm font-semibold opacity-90">Total Costs</div>
            <div class="text-3xl font-bold">₱{{ number_format($salesAndProfitData['total_costs'], 2) }}</div>
            <div class="text-xs opacity-75 mt-1">Service + Parts</div>
        </div>

        <div class="bg-gradient-to-br from-purple-500 to-purple-600 text-white p-4 rounded-lg shadow">
            <div class="text-sm font-semibold opacity-90">Total Profit</div>
            <div class="text-3xl font-bold">₱{{ number_format($salesAndProfitData['profit'], 2) }}</div>
            <div class="text-xs opacity-75 mt-1">{{ $salesAndProfitData['profit_margin'] }}% margin</div>
        </div>

        <div class="bg-gradient-to-br from-orange-500 to-orange-600 text-white p-4 rounded-lg shadow">
            <div class="text-sm font-semibold opacity-90">Service Charge</div>
            <div class="text-3xl font-bold">₱{{ number_format($salesAndProfitData['service_charge'], 2) }}</div>
            <div class="text-xs opacity-75 mt-1">Labor cost</div>
        </div>

        <div class="bg-gradient-to-br from-red-500 to-red-600 text-white p-4 rounded-lg shadow">
            <div class="text-sm font-semibold opacity-90">Parts Cost</div>
            <div class="text-3xl font-bold">₱{{ number_format($salesAndProfitData['parts_cost'], 2) }}</div>
            <div class="text-xs opacity-75 mt-1">Inventory used</div>
        </div>
    </div>

    <!-- Sales & Profit Charts -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        <!-- Revenue vs Costs Chart -->
        <div class="bg-white rounded-[1.25rem] border border-gray-200 shadow-sm p-6" 
             data-chart="salesAndCosts"
             data-chart-data='{!! json_encode($revenueTrendWithCosts) !!}'>
            <h3 class="text-lg font-bold text-gray-900 mb-6">Sales vs Costs</h3>
            <canvas id="salesAndCostsChart"></canvas>
        </div>

        <!-- Profit Trend Chart -->
        <div class="bg-white rounded-[1.25rem] border border-gray-200 shadow-sm p-6"
             data-chart="profitTrend"
             data-chart-data='{!! json_encode($profitTrend) !!}'>
            <h3 class="text-lg font-bold text-gray-900 mb-6">Profit Trend</h3>
            <canvas id="profitTrendChart"></canvas>
        </div>
    </div>

    @if (session()->has('error'))
        <div class="mb-4 p-4 rounded-lg bg-red-50 border border-red-200 text-red-700">{{ session('error') }}</div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-10">
        <!-- Repair Statistics -->
        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-6">
            <h3 class="text-lg font-bold text-gray-900 mb-4">Repair Statistics</h3>
            <div class="space-y-3">
                <div class="flex items-center justify-between">
                    <span class="text-gray-600">Total Repairs</span>
                    <span class="text-lg font-bold text-gray-900">{{ $repairStats['total'] }}</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-gray-600">Pending</span>
                    <span class="text-lg font-bold text-yellow-600">{{ $repairStats['pending'] }}</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-gray-600">In Progress</span>
                    <span class="text-lg font-bold text-orange-600">{{ $repairStats['in_progress'] }}</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-gray-600">Completed</span>
                    <span class="text-lg font-bold text-green-600">{{ $repairStats['completed'] }}</span>
                </div>
            </div>
        </div>

        <!-- Appointment Statistics -->
        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-6">
            <h3 class="text-lg font-bold text-gray-900 mb-4">Appointment Statistics</h3>
            <div class="space-y-3">
                <div class="flex items-center justify-between">
                    <span class="text-gray-600">Total Appointments</span>
                    <span class="text-lg font-bold text-gray-900">{{ $appointmentStats['total'] }}</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-gray-600">Pending</span>
                    <span class="text-lg font-bold text-yellow-600">{{ $appointmentStats['pending'] }}</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-gray-600">Scheduled</span>
                    <span class="text-lg font-bold text-blue-600">{{ $appointmentStats['scheduled'] }}</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-gray-600">Completed</span>
                    <span class="text-lg font-bold text-green-600">{{ $appointmentStats['completed'] }}</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-gray-600">Cancelled</span>
                    <span class="text-lg font-bold text-red-600">{{ $appointmentStats['cancelled'] }}</span>
                </div>
            </div>
        </div>

        <!-- User Statistics -->
        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-6">
            <h3 class="text-lg font-bold text-gray-900 mb-4">User Statistics</h3>
            <div class="space-y-3">
                <div class="flex items-center justify-between">
                    <span class="text-gray-600">Total Users</span>
                    <span class="text-lg font-bold text-gray-900">{{ $userStats['total_users'] }}</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-gray-600">Active Users</span>
                    <span class="text-lg font-bold text-green-600">{{ $userStats['active_users'] }}</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-gray-600">Total Admins</span>
                    <span class="text-lg font-bold text-blue-600">{{ $userStats['total_admins'] }}</span>
                </div>
            </div>
        </div>

        <!-- Inventory Statistics -->
        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-6">
            <h3 class="text-lg font-bold text-gray-900 mb-4">Inventory Statistics</h3>
            <div class="space-y-3">
                <div class="flex items-center justify-between">
                    <span class="text-gray-600">Total Items</span>
                    <span class="text-lg font-bold text-gray-900">{{ $inventoryStats['total_items'] }}</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-gray-600">Low Stock</span>
                    <span class="text-lg font-bold text-yellow-600">{{ $inventoryStats['low_stock'] }}</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-gray-600">Out of Stock</span>
                    <span class="text-lg font-bold text-red-600">{{ $inventoryStats['out_of_stock'] }}</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-gray-600">Total Value</span>
                    <span class="text-lg font-bold text-green-600">₱{{ number_format($inventoryStats['total_value'], 2) }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Key Metrics from Analytics -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
        <div class="bg-white p-6 rounded-[1.25rem] border border-gray-200 shadow-sm">
            <div class="flex items-start justify-between mb-4">
                <div>
                    <p class="text-xs font-bold text-gray-500 uppercase tracking-wider">Avg Repair Time</p>
                    <h3 class="text-3xl font-extrabold text-gray-900 mt-1">{{ $metrics['avgRepairTime'] }}h</h3>
                </div>
                <div class="w-12 h-12 flex items-center justify-center bg-blue-50 text-blue-600 rounded-xl">
                    <span class="material-symbols-outlined text-2xl">schedule</span>
                </div>
            </div>
            <p class="text-sm text-gray-600">Average service duration</p>
        </div>

        <div class="bg-white p-6 rounded-[1.25rem] border border-gray-200 shadow-sm">
            <div class="flex items-start justify-between mb-4">
                <div>
                    <p class="text-xs font-bold text-gray-500 uppercase tracking-wider">Customer Satisfaction</p>
                    <h3 class="text-3xl font-extrabold text-gray-900 mt-1">{{ $metrics['satisfaction'] }}%</h3>
                </div>
                <div class="w-12 h-12 flex items-center justify-center bg-green-50 text-green-600 rounded-xl">
                    <span class="material-symbols-outlined text-2xl">sentiment_satisfied</span>
                </div>
            </div>
            <p class="text-sm text-gray-600">Based on reviews</p>
        </div>

        <div class="bg-white p-6 rounded-[1.25rem] border border-gray-200 shadow-sm">
            <div class="flex items-start justify-between mb-4">
                <div>
                    <p class="text-xs font-bold text-gray-500 uppercase tracking-wider">Repeat Customers</p>
                    <h3 class="text-3xl font-extrabold text-gray-900 mt-1">{{ $metrics['repeatCustomers'] }}%</h3>
                </div>
                <div class="w-12 h-12 flex items-center justify-center bg-purple-50 text-purple-600 rounded-xl">
                    <span class="material-symbols-outlined text-2xl">people</span>
                </div>
            </div>
            <p class="text-sm text-gray-600">Customer retention rate</p>
        </div>

        <div class="bg-white p-6 rounded-[1.25rem] border border-gray-200 shadow-sm">
            <div class="flex items-start justify-between mb-4">
                <div>
                    <p class="text-xs font-bold text-gray-500 uppercase tracking-wider">Warranty Claims</p>
                    <h3 class="text-3xl font-extrabold text-gray-900 mt-1">{{ $metrics['warrantyRate'] }}%</h3>
                </div>
                <div class="w-12 h-12 flex items-center justify-center bg-red-50 text-red-600 rounded-xl">
                    <span class="material-symbols-outlined text-2xl">verified</span>
                </div>
            </div>
            <p class="text-sm text-gray-600">Return rate</p>
        </div>
    </div>



    <!-- Recent Data -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Recent Repairs -->
        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
            <div class="px-6 py-5 border-b border-gray-100">
                <h3 class="text-lg font-bold text-gray-900">Recent Repairs</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-gray-100 bg-gray-50">
                            <th class="px-4 py-3 text-left text-xs font-bold text-gray-700">Device</th>
                            <th class="px-4 py-3 text-left text-xs font-bold text-gray-700">Customer</th>
                            <th class="px-4 py-3 text-left text-xs font-bold text-gray-700">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse ($recentRepairs as $repair)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3 text-sm font-medium text-gray-900">{{ $repair->device_name }}</td>
                                <td class="px-4 py-3 text-sm text-gray-600">{{ $repair->user->getFullName() }}</td>
                                <td class="px-4 py-3">
                                    <span class="inline-flex px-2 py-1 text-xs font-bold rounded {{ 
                                        $repair->status === 'Completed' ? 'bg-green-50 text-green-700' :
                                        ($repair->status === 'In Progress' ? 'bg-orange-50 text-orange-700' : 'bg-yellow-50 text-yellow-700')
                                    }}">
                                        {{ $repair->status }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-4 py-4 text-center text-gray-500">No repairs found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Recent Appointments -->
        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
            <div class="px-6 py-5 border-b border-gray-100">
                <h3 class="text-lg font-bold text-gray-900">Recent Appointments</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-gray-100 bg-gray-50">
                            <th class="px-4 py-3 text-left text-xs font-bold text-gray-700">Device</th>
                            <th class="px-4 py-3 text-left text-xs font-bold text-gray-700">Customer</th>
                            <th class="px-4 py-3 text-left text-xs font-bold text-gray-700">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse ($recentAppointments as $appointment)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3 text-sm font-medium text-gray-900">{{ $appointment->device_brand }} {{ $appointment->device_model }}</td>
                                <td class="px-4 py-3 text-sm text-gray-600">{{ $appointment->user?->getFullName() ?? 'Unknown Customer' }}</td>
                                <td class="px-4 py-3">
                                    <span class="inline-flex px-2 py-1 text-xs font-bold rounded {{ 
                                        $appointment->status === 'completed' ? 'bg-green-50 text-green-700' :
                                        ($appointment->status === 'scheduled' ? 'bg-blue-50 text-blue-700' :
                                        ($appointment->status === 'cancelled' ? 'bg-red-50 text-red-700' : 'bg-yellow-50 text-yellow-700'))
                                    }}">
                                        {{ ucfirst($appointment->status) }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-4 py-4 text-center text-gray-500">No appointments found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.js"></script>
<script>
    let charts = {};

    function initializeCharts() {
        try {
            console.log('initializeCharts called');
            
            // Destroy existing charts before creating new ones
            Object.values(charts).forEach(chart => {
                if (chart && typeof chart.destroy === 'function') {
                    chart.destroy();
                }
            });
            charts = {};

            // Wait for Chart library to be available
            if (typeof Chart === 'undefined') {
                setTimeout(initializeCharts, 100);
                return;
            }

            // Profit Trend Chart
            const profitTrendContainer = document.querySelector('[data-chart="profitTrend"]');
            if (profitTrendContainer) {
                const profitTrendCtx = document.getElementById('profitTrendChart');
                const chartDataJson = profitTrendContainer.getAttribute('data-chart-data');
                console.log('Profit Trend Data:', chartDataJson);
                const chartData = chartDataJson ? JSON.parse(chartDataJson) : null;
                console.log('Profit Trend Parsed:', chartData);
                
                if (profitTrendCtx && chartData && chartData.labels && chartData.labels.length > 0) {
                    console.log('Creating Profit Trend chart with labels:', chartData.labels);
                    charts.profitTrend = new Chart(profitTrendCtx.getContext('2d'), {
                        type: 'bar',
                        data: {
                            labels: chartData.labels,
                            datasets: [{
                                label: 'Profit',
                                data: chartData.data,
                                backgroundColor: '#a855f7',
                                borderColor: '#9333ea',
                                borderWidth: 2,
                                borderRadius: 6,
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: true,
                            plugins: {
                                legend: {
                                    display: true,
                                    labels: { color: '#6B7280', font: { size: 12, weight: '600' } }
                                }
                            },
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    grid: { color: '#E5E7EB' },
                                    ticks: { color: '#6B7280', callback: function(value) { return '₱' + value.toLocaleString(); } }
                                },
                                x: {
                                    grid: { display: false },
                                    ticks: { color: '#6B7280' }
                                }
                            }
                        }
                    });
                }
            }

            // Sales vs Costs Chart
            const salesAndCostsContainer = document.querySelector('[data-chart="salesAndCosts"]');
            if (salesAndCostsContainer) {
                const salesAndCostsCtx = document.getElementById('salesAndCostsChart');
                const chartDataJson = salesAndCostsContainer.getAttribute('data-chart-data');
                console.log('Sales & Costs Data:', chartDataJson);
                const chartData = chartDataJson ? JSON.parse(chartDataJson) : null;
                console.log('Sales & Costs Parsed:', chartData);
                
                if (salesAndCostsCtx && chartData && chartData.labels && chartData.labels.length > 0) {
                    console.log('Creating Sales & Costs chart with labels:', chartData.labels);
                    charts.salesAndCosts = new Chart(salesAndCostsCtx.getContext('2d'), {
                        type: 'bar',
                        data: {
                            labels: chartData.labels,
                            datasets: [
                                {
                                    label: 'Sales',
                                    data: chartData.sales || [],
                                    backgroundColor: '#10b981',
                                    borderColor: '#059669',
                                    borderWidth: 2,
                                    borderRadius: 6,
                                },
                                {
                                    label: 'Costs',
                                    data: chartData.costs || [],
                                    backgroundColor: '#ef4444',
                                    borderColor: '#dc2626',
                                    borderWidth: 2,
                                    borderRadius: 6,
                                }
                            ]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: true,
                            plugins: {
                                legend: {
                                    display: true,
                                    labels: { color: '#6B7280', font: { size: 12, weight: '600' } }
                                }
                            },
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    grid: { color: '#E5E7EB' },
                                    ticks: { color: '#6B7280', callback: function(value) { return '₱' + value.toLocaleString(); } }
                                },
                                x: {
                                    grid: { display: false },
                                    ticks: { color: '#6B7280' }
                                }
                            }
                        }
                    });
                }
            }
        } catch (error) {
            console.error('Error initializing charts:', error);
        }
    }

    // Initialize on DOMContentLoaded
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', () => {
            setTimeout(initializeCharts, 300);
        });
    } else {
        setTimeout(initializeCharts, 300);
    }

    // Reinitialize when Livewire updates
    document.addEventListener('livewire:updated', () => {
        console.log('Livewire updated event fired');
        setTimeout(initializeCharts, 100);
    });

    // Also listen for Livewire updates using the newer event system
    if (typeof Livewire !== 'undefined' && Livewire.hook) {
        Livewire.hook('updated', () => {
            console.log('Livewire hook updated fired');
            setTimeout(initializeCharts, 100);
        });
    }
</script>

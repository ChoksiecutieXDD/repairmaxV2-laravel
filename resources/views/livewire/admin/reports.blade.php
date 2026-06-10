<div class="w-full">
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

    <!-- Charts -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-10">
        <!-- Revenue Trend -->
        <div class="bg-white rounded-[1.25rem] border border-gray-200 shadow-sm p-6">
            <h3 class="text-lg font-bold text-gray-900 mb-6">Revenue Trend (7 Days)</h3>
            <canvas id="revenueChart"></canvas>
        </div>

        <!-- Repair Status Distribution -->
        <div class="bg-white rounded-[1.25rem] border border-gray-200 shadow-sm p-6">
            <h3 class="text-lg font-bold text-gray-900 mb-6">Repair Status Distribution</h3>
            <canvas id="statusChart"></canvas>
        </div>
    </div>

    <!-- Service Type Trends -->
    <div class="bg-white rounded-[1.25rem] border border-gray-200 shadow-sm p-6 mb-10">
        <h3 class="text-lg font-bold text-gray-900 mb-6">Service Type Trends (7 Days)</h3>
        <canvas id="serviceChart"></canvas>
    </div>

    <!-- Hidden Data Container for Charts -->
    <div id="chartData" class="hidden"
        data-revenue-labels="{{ Js::from($metrics['revenueTrend']['labels'] ?? []) }}"
        data-revenue-data="{{ Js::from($metrics['revenueTrend']['data'] ?? []) }}"
        data-status-labels="{{ Js::from($metrics['statusDistribution']['labels'] ?? []) }}"
        data-status-data="{{ Js::from($metrics['statusDistribution']['data'] ?? []) }}"
        data-status-colors="{{ Js::from($metrics['statusDistribution']['backgroundColor'] ?? []) }}"
        data-service-labels="{{ Js::from($metrics['serviceTrends']['labels'] ?? []) }}"
        data-service-phones="{{ Js::from($metrics['serviceTrends']['phones'] ?? []) }}"
        data-service-laptops="{{ Js::from($metrics['serviceTrends']['laptops'] ?? []) }}"
        data-service-tablets="{{ Js::from($metrics['serviceTrends']['tablets'] ?? []) }}"
    ></div>

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
    document.addEventListener('DOMContentLoaded', function() {
        try {
            const dataContainer = document.getElementById('chartData');
            if (!dataContainer) return;

            const parseData = (attr) => JSON.parse(dataContainer.getAttribute(attr) || '[]');

            // Revenue Trend Chart
            const revenueCtx = document.getElementById('revenueChart');
            if (revenueCtx) {
                new Chart(revenueCtx.getContext('2d'), {
                    type: 'line',
                    data: {
                        labels: parseData('data-revenue-labels'),
                        datasets: [{
                            label: 'Revenue ($)',
                            data: parseData('data-revenue-data'),
                            borderColor: '#3B82F6',
                            backgroundColor: 'rgba(59, 130, 246, 0.1)',
                            borderWidth: 2,
                            tension: 0.4,
                            fill: true,
                            pointBackgroundColor: '#3B82F6',
                            pointBorderColor: '#fff',
                            pointRadius: 5,
                            pointHoverRadius: 7,
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: true,
                        plugins: {
                            legend: {
                                display: true,
                                labels: {
                                    color: '#6B7280',
                                    font: { size: 12, weight: '600' }
                                }
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                grid: { color: '#E5E7EB' },
                                ticks: { color: '#6B7280' }
                            },
                            x: {
                                grid: { display: false },
                                ticks: { color: '#6B7280' }
                            }
                        }
                    }
                });
            }

            // Repair Status Distribution Chart
            const statusCtx = document.getElementById('statusChart');
            if (statusCtx) {
                new Chart(statusCtx.getContext('2d'), {
                    type: 'doughnut',
                    data: {
                        labels: parseData('data-status-labels'),
                        datasets: [{
                            data: parseData('data-status-data'),
                            backgroundColor: parseData('data-status-colors'),
                            borderColor: '#fff',
                            borderWidth: 2,
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: true,
                        plugins: {
                            legend: {
                                position: 'bottom',
                                labels: {
                                    color: '#6B7280',
                                    font: { size: 12, weight: '600' },
                                    padding: 15
                                }
                            }
                        }
                    }
                });
            }

            // Service Type Trends Chart
            const serviceCtx = document.getElementById('serviceChart');
            if (serviceCtx) {
                new Chart(serviceCtx.getContext('2d'), {
                    type: 'line',
                    data: {
                        labels: parseData('data-service-labels'),
                        datasets: [
                            {
                                label: 'Phones',
                                data: parseData('data-service-phones'),
                                borderColor: '#3B82F6',
                                backgroundColor: 'rgba(59, 130, 246, 0.05)',
                                borderWidth: 2,
                                tension: 0.4,
                                pointBackgroundColor: '#3B82F6',
                                pointRadius: 4,
                            },
                            {
                                label: 'Laptops',
                                data: parseData('data-service-laptops'),
                                borderColor: '#10B981',
                                backgroundColor: 'rgba(16, 185, 129, 0.05)',
                                borderWidth: 2,
                                tension: 0.4,
                                pointBackgroundColor: '#10B981',
                                pointRadius: 4,
                            },
                            {
                                label: 'Tablets',
                                data: parseData('data-service-tablets'),
                                borderColor: '#F59E0B',
                                backgroundColor: 'rgba(245, 158, 11, 0.05)',
                                borderWidth: 2,
                                tension: 0.4,
                                pointBackgroundColor: '#F59E0B',
                                pointRadius: 4,
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: true,
                        plugins: {
                            legend: {
                                display: true,
                                labels: {
                                    color: '#6B7280',
                                    font: { size: 12, weight: '600' }
                                }
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                grid: { color: '#E5E7EB' },
                                ticks: { color: '#6B7280' }
                            },
                            x: {
                                grid: { display: false },
                                ticks: { color: '#6B7280' }
                            }
                        }
                    }
                });
            }
        } catch (error) {
            console.error('Error initializing charts:', error);
        }
    });
</script>

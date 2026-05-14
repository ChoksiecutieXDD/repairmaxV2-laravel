<div class="w-full">
    <div class="mb-8 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="text-3xl font-bold text-gray-900 tracking-tight">Analytics</h1>
            <p class="text-gray-500 mt-1">Business analytics and performance metrics.</p>
        </div>
    </div>

    <!-- Key Metrics -->
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


<div class="container mx-auto px-4 py-6">
    <div class="bg-white rounded-lg shadow-lg p-6">
        <h1 class="text-3xl font-bold mb-6">Sales & Profit Analytics</h1>

        <!-- Timeframe Selector -->
        <div class="flex gap-2 mb-6 border-b pb-4">
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

        <!-- Key Metrics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4 mb-8">
            <div class="bg-gradient-to-br from-green-500 to-green-600 text-white p-4 rounded-lg shadow">
                <div class="text-sm font-semibold opacity-90">Total Sales</div>
                <div class="text-3xl font-bold">₱{{ number_format($metrics['current']['sales'], 2) }}</div>
                <div class="text-xs opacity-75 mt-1">{{ $metrics['current']['appointments_count'] }} repairs</div>
            </div>

            <div class="bg-gradient-to-br from-blue-500 to-blue-600 text-white p-4 rounded-lg shadow">
                <div class="text-sm font-semibold opacity-90">Total Costs</div>
                <div class="text-3xl font-bold">₱{{ number_format($metrics['current']['total_costs'], 2) }}</div>
                <div class="text-xs opacity-75 mt-1">Service + Parts</div>
            </div>

            <div class="bg-gradient-to-br from-purple-500 to-purple-600 text-white p-4 rounded-lg shadow">
                <div class="text-sm font-semibold opacity-90">Total Profit</div>
                <div class="text-3xl font-bold">₱{{ number_format($metrics['current']['profit'], 2) }}</div>
                <div class="text-xs opacity-75 mt-1">{{ $metrics['current']['profit_margin'] }}% margin</div>
            </div>

            <div class="bg-gradient-to-br from-orange-500 to-orange-600 text-white p-4 rounded-lg shadow">
                <div class="text-sm font-semibold opacity-90">Service Charge</div>
                <div class="text-3xl font-bold">₱{{ number_format($metrics['current']['service_charge'], 2) }}</div>
                <div class="text-xs opacity-75 mt-1">Labor cost</div>
            </div>

            <div class="bg-gradient-to-br from-red-500 to-red-600 text-white p-4 rounded-lg shadow">
                <div class="text-sm font-semibold opacity-90">Parts Cost</div>
                <div class="text-3xl font-bold">₱{{ number_format($metrics['current']['parts_cost'], 2) }}</div>
                <div class="text-xs opacity-75 mt-1">Inventory used</div>
            </div>
        </div>

        <!-- Charts Row 1 -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
            <!-- Revenue Trend Chart -->
            <div class="bg-gray-50 p-4 rounded-lg shadow">
                <h3 class="text-lg font-bold mb-4">Sales Trend</h3>
                <canvas id="revenueChart"></canvas>
            </div>

            <!-- Profit Trend Chart -->
            <div class="bg-gray-50 p-4 rounded-lg shadow">
                <h3 class="text-lg font-bold mb-4">Profit Trend</h3>
                <canvas id="profitChart"></canvas>
            </div>
        </div>

        <!-- Charts Row 2 -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
            <!-- Repair Status Distribution -->
            <div class="bg-gray-50 p-4 rounded-lg shadow">
                <h3 class="text-lg font-bold mb-4">Repair Status Distribution</h3>
                <canvas id="statusChart"></canvas>
            </div>

            <!-- Service Type Trends -->
            <div class="bg-gray-50 p-4 rounded-lg shadow">
                <h3 class="text-lg font-bold mb-4">Service Type Trends</h3>
                <canvas id="serviceChart"></canvas>
            </div>
        </div>

        <!-- Inventory Metrics -->
        <div class="bg-blue-50 p-4 rounded-lg shadow mb-6">
            <h3 class="text-lg font-bold mb-4">Inventory Metrics</h3>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div>
                    <span class="text-gray-600">Total Items:</span>
                    <div class="text-2xl font-bold">{{ $metrics['inventory']['total_items'] }}</div>
                </div>
                <div>
                    <span class="text-gray-600">Total Inventory Value:</span>
                    <div class="text-2xl font-bold">₱{{ number_format($metrics['inventory']['total_value'], 2) }}</div>
                </div>
                <div>
                    <span class="text-gray-600">Total Cost:</span>
                    <div class="text-2xl font-bold">₱{{ number_format($metrics['inventory']['total_cost'], 2) }}</div>
                </div>
                <div>
                    <span class="text-gray-600">Potential Profit:</span>
                    <div class="text-2xl font-bold text-green-600">₱{{ number_format($metrics['inventory']['potential_profit'], 2) }}</div>
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4 pt-4 border-t">
                <div>
                    <span class="text-gray-600">Low Stock Items:</span>
                    <div class="text-2xl font-bold text-orange-600">{{ $metrics['inventory']['low_stock'] }}</div>
                </div>
                <div>
                    <span class="text-gray-600">Out of Stock:</span>
                    <div class="text-2xl font-bold text-red-600">{{ $metrics['inventory']['out_of_stock'] }}</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart.js Script -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.js"></script>
    <script>
        // Revenue Chart
        new Chart(document.getElementById('revenueChart'), {
            type: 'line',
            data: {
                labels: @json($metrics['revenue_trend']['labels']),
                datasets: [{
                    label: 'Sales',
                    data: @json($metrics['revenue_trend']['data']),
                    borderColor: '#10b981',
                    backgroundColor: 'rgba(16, 185, 129, 0.1)',
                    tension: 0.4,
                    fill: true,
                }]
            },
            options: {
                responsive: true,
                plugins: { legend: { display: true } },
                scales: { y: { beginAtZero: true } }
            }
        });

        // Profit Chart
        new Chart(document.getElementById('profitChart'), {
            type: 'line',
            data: {
                labels: @json($metrics['profit_trend']['labels']),
                datasets: [{
                    label: 'Profit',
                    data: @json($metrics['profit_trend']['data']),
                    borderColor: '#a855f7',
                    backgroundColor: 'rgba(168, 85, 247, 0.1)',
                    tension: 0.4,
                    fill: true,
                }]
            },
            options: {
                responsive: true,
                plugins: { legend: { display: true } },
                scales: { y: { beginAtZero: true } }
            }
        });

        // Status Distribution Chart
        new Chart(document.getElementById('statusChart'), {
            type: 'doughnut',
            data: {
                labels: @json($metrics['status_distribution']['labels']),
                datasets: [{
                    data: @json($metrics['status_distribution']['data']),
                    backgroundColor: @json($metrics['status_distribution']['backgroundColor']),
                }]
            },
            options: {
                responsive: true,
                plugins: { legend: { position: 'bottom' } }
            }
        });

        // Service Type Chart
        new Chart(document.getElementById('serviceChart'), {
            type: 'bar',
            data: {
                labels: @json($metrics['service_trends']['labels']),
                datasets: [
                    {
                        label: 'Phones',
                        data: @json($metrics['service_trends']['phones']),
                        backgroundColor: '#3b82f6',
                    },
                    {
                        label: 'Laptops',
                        data: @json($metrics['service_trends']['laptops']),
                        backgroundColor: '#10b981',
                    },
                    {
                        label: 'Tablets',
                        data: @json($metrics['service_trends']['tablets']),
                        backgroundColor: '#f59e0b',
                    },
                    {
                        label: 'Others',
                        data: @json($metrics['service_trends']['others']),
                        backgroundColor: '#8b5cf6',
                    }
                ]
            },
            options: {
                responsive: true,
                scales: { x: { stacked: false }, y: { stacked: false } }
            }
        });
    </script>
</div>

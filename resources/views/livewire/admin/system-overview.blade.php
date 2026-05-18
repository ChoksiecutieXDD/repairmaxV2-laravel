<div class="w-full" wire:poll.5s>
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900 tracking-tight">
            System Overview
        </h1>
        <p class="text-gray-500 font-bold uppercase tracking-widest text-[10px]">Real-time system performance metrics and key indicators.</p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="system-stat-card">
            <div class="flex items-center justify-between mb-2">
                <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">System Uptime</p>
                <div class="w-10 h-10 bg-green-50 rounded-xl flex items-center justify-center shadow-sm border border-green-100">
                    <span class="material-symbols-outlined text-green-600 text-[20px]">cloud_done</span>
                </div>
            </div>
            <div>
                <p class="text-3xl font-black text-gray-900 tracking-tighter">{{ $systemUptime }}</p>
                <p class="text-[10px] font-black text-green-600 mt-2 uppercase tracking-widest flex items-center gap-1">
                    <span class="w-1.5 h-1.5 bg-green-600 rounded-full animate-pulse"></span>
                    Excellent
                </p>
            </div>
        </div>

        <div class="system-stat-card">
            <div class="flex items-center justify-between mb-2">
                <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Total Users</p>
                <div class="w-10 h-10 bg-blue-50 rounded-xl flex items-center justify-center shadow-sm border border-blue-100">
                    <span class="material-symbols-outlined text-blue-600 text-[20px]">group</span>
                </div>
            </div>
            <div>
                <p class="text-3xl font-black text-gray-900 tracking-tighter">{{ $totalUsers }}</p>
                <p class="text-[10px] font-bold text-gray-400 mt-2 uppercase tracking-tight">{{ $adminCount }} admins • {{ $userCount }} users</p>
            </div>
        </div>

        <div class="system-stat-card">
            <div class="flex items-center justify-between mb-2">
                <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Pending Tasks</p>
                <div class="w-10 h-10 bg-orange-50 rounded-xl flex items-center justify-center shadow-sm border border-orange-100">
                    <span class="material-symbols-outlined text-orange-600 text-[20px]">assignment</span>
                </div>
            </div>
            <div>
                <p class="text-3xl font-black text-gray-900 tracking-tighter">{{ $pendingTasks }}</p>
                <p class="text-[10px] font-black text-orange-600 mt-2 uppercase tracking-widest flex items-center gap-1">
                    <span class="material-symbols-outlined text-[14px]">warning</span>
                    Attention
                </p>
            </div>
        </div>

        <div class="system-stat-card">
            <div class="flex items-center justify-between mb-2">
                <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Storage Used</p>
                <div class="w-10 h-10 bg-purple-50 rounded-xl flex items-center justify-center shadow-sm border border-purple-100">
                    <span class="material-symbols-outlined text-purple-600 text-[20px]">storage</span>
                </div>
            </div>
            <div>
                <p class="text-3xl font-black text-gray-900 tracking-tighter">{{ $storageUsed }}</p>
                <p class="text-[10px] font-bold text-gray-400 mt-2 uppercase tracking-widest">Capacity: 100GB</p>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8"
        x-data="{ 
            appointmentTrend: @js($appointmentTrend),
            userGrowth: @js($userGrowth),
            init() {
                // Appointment Trend Chart
                new Chart(this.$refs.appointmentChart, {
                    type: 'line',
                    data: {
                        labels: this.appointmentTrend.labels,
                        datasets: [{
                            label: 'Appointments',
                            data: this.appointmentTrend.data,
                            borderColor: '#3b82f6',
                            backgroundColor: 'rgba(59, 130, 246, 0.1)',
                            borderWidth: 2,
                            fill: true,
                            tension: 0.4,
                            pointBackgroundColor: '#3b82f6',
                            pointBorderColor: '#fff',
                            pointBorderWidth: 2,
                            pointRadius: 5,
                            pointHoverRadius: 7,
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: true,
                        plugins: { legend: { display: false } },
                        scales: {
                            y: {
                                beginAtZero: true,
                                grid: { color: 'rgba(0, 0, 0, 0.05)', drawBorder: false },
                                ticks: { color: '#999', font: { size: 10, weight: 'bold' } }
                            },
                            x: {
                                grid: { display: false, drawBorder: false },
                                ticks: { color: '#999', font: { size: 10, weight: 'bold' } }
                            }
                        }
                    }
                });

                // User Growth Chart
                new Chart(this.$refs.userGrowthChart, {
                    type: 'line',
                    data: {
                        labels: this.userGrowth.labels,
                        datasets: [{
                            label: 'Total Users',
                            data: this.userGrowth.data,
                            borderColor: '#10b981',
                            backgroundColor: 'rgba(16, 185, 129, 0.1)',
                            borderWidth: 2,
                            fill: true,
                            tension: 0.4,
                            pointBackgroundColor: '#10b981',
                            pointBorderColor: '#fff',
                            pointBorderWidth: 2,
                            pointRadius: 5,
                            pointHoverRadius: 7,
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: true,
                        plugins: { legend: { display: false } },
                        scales: {
                            y: {
                                beginAtZero: true,
                                grid: { color: 'rgba(0, 0, 0, 0.05)', drawBorder: false },
                                ticks: { color: '#999', font: { size: 10, weight: 'bold' } }
                            },
                            x: {
                                grid: { display: false, drawBorder: false },
                                ticks: { color: '#999', font: { size: 10, weight: 'bold' } }
                            }
                        }
                    }
                });
            }
         }">
        <div class="bg-white rounded-[1.25rem] border border-gray-200 shadow-sm p-6">
            <h3 class="text-sm font-black text-gray-900 mb-6 flex items-center gap-2 uppercase tracking-widest">
                <span class="material-symbols-outlined text-gray-400">trending_up</span>
                Appointments Trend
            </h3>
            <canvas x-ref="appointmentChart" height="100"></canvas>
        </div>

        <div class="bg-white rounded-[1.25rem] border border-gray-200 shadow-sm p-6">
            <h3 class="text-sm font-black text-gray-900 mb-6 flex items-center gap-2 uppercase tracking-widest">
                <span class="material-symbols-outlined text-gray-400">group</span>
                User Growth
            </h3>
            <canvas x-ref="userGrowthChart" height="100"></canvas>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
        <div class="bg-white rounded-[1.25rem] border border-gray-200 shadow-sm p-6">
            <h3 class="text-sm font-black text-gray-900 mb-6 flex items-center gap-2 uppercase tracking-widest">
                <span class="material-symbols-outlined text-gray-400">event</span>
                Today's Appointments
            </h3>
            <div class="space-y-2">
                @forelse($todaysAppointments as $app)
                <div class="flex items-center justify-between p-4 hover:bg-gray-50 rounded-[1.25rem] transition-all group">
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 bg-blue-50 rounded-xl flex items-center justify-center font-black text-blue-600 text-xs shadow-sm">
                            {{ substr($app->pref_time, 0, 5) }}
                        </div>
                        <div>
                            <p class="font-black text-gray-900 text-sm tracking-tight leading-none">{{ $app->user->first_name ?? 'Guest' }} • {{ $app->device_brand }}</p>
                            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mt-1.5">{{ $app->fault_category }}</p>
                        </div>
                    </div>
                    <span class="px-3 py-1 bg-blue-50 text-blue-700 rounded-full text-[10px] font-black uppercase tracking-widest">{{ $app->status }}</span>
                </div>
                @empty
                <div class="p-10 text-center text-gray-400 text-[10px] font-black uppercase tracking-[0.2em] italic bg-gray-50/50 rounded-[1.25rem]">
                    No appointments scheduled for today
                </div>
                @endforelse
            </div>
        </div>

        <div class="bg-white rounded-[1.25rem] border border-gray-200 shadow-sm p-6">
            <h3 class="text-sm font-black text-gray-900 mb-6 flex items-center gap-2 uppercase tracking-widest">
                <span class="material-symbols-outlined text-gray-400">health_and_safety</span>
                Engine Health
            </h3>
            <div class="space-y-2">
                @php
                $services = [
                ['name' => 'Web Server', 'status' => 'Running', 'icon' => 'public'],
                ['name' => 'Database Engine', 'status' => 'Connected', 'icon' => 'database'],
                ['name' => 'Mail Service', 'status' => 'Operational', 'icon' => 'mail'],
                ['name' => 'API Gateway', 'status' => 'Running', 'icon' => 'api'],
                ];
                @endphp

                @foreach($services as $service)
                <div class="system-health-item">
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 flex-shrink-0 bg-white rounded-xl flex items-center justify-center shadow-sm">
                            <span class="material-symbols-outlined text-gray-400 group-hover:text-green-600 transition-colors text-[20px]">{{ $service['icon'] }}</span>
                        </div>
                        <div>
                            <p class="font-black text-gray-900 text-sm tracking-tight leading-[1.1]">{{ $service['name'] }}</p>
                            <div class="flex items-center gap-1.5 mt-0.5">
                                <span class="w-1.5 h-1.5 bg-green-600 rounded-full animate-pulse"></span>
                                <span class="text-[10px] font-black text-green-600 uppercase tracking-widest leading-none">Active</span>
                            </div>
                        </div>
                    </div>
                    <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest group-hover:text-gray-900 transition-colors">{{ $service['status'] }}</span>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
<div class="w-full">
    <div class="mb-8">
        <h1 class="text-3xl font-black text-gray-900 tracking-tight">System Settings</h1>
        <p class="text-gray-500 mt-1">Manage system configurations and monitor server performance.</p>
    </div>

    @if (session()->has('success'))
    <div class="mb-8 p-5 bg-green-50 border border-green-200 rounded-[1.25rem] flex items-center gap-3">
        <span class="material-symbols-outlined text-green-600">check_circle</span>
        <p class="text-green-800 font-bold text-sm tracking-tight">{{ session('success') }}</p>
    </div>
    @endif

    <!-- Horizontal Tabs -->
    <div class="flex space-x-1 bg-gray-900 p-1.5 rounded-[1.25rem] mb-8 w-fit border border-black shadow-xl">
        <button wire:click="$set('activeTab', 'settings')"
            class="px-8 py-2.5 rounded-[1rem] text-sm font-black transition-all duration-300 {{ $activeTab === 'settings' ? 'bg-white text-gray-900 shadow-lg transform scale-105' : 'bg-transparent text-white hover:bg-white/10' }}">
            Settings
        </button>
        <button wire:click="$set('activeTab', 'overview')"
            class="px-8 py-2.5 rounded-[1rem] text-sm font-black transition-all duration-300 {{ $activeTab === 'overview' ? 'bg-white text-gray-900 shadow-lg transform scale-105' : 'bg-transparent text-white hover:bg-white/10' }}">
            System Overview
        </button>
    </div>

    @if($activeTab === 'settings')
    <div class="bg-white rounded-[1.25rem] border border-gray-200 shadow-sm overflow-hidden">
        <div class="px-8 py-6 border-b border-gray-100 flex items-center gap-4">
            <div class="w-10 h-10 bg-blue-50 rounded-xl flex items-center justify-center">
                <span class="material-symbols-outlined text-blue-600">settings</span>
            </div>
            <h2 class="text-xl font-black text-gray-900 tracking-tight">System Configuration</h2>
        </div>
        <div class="p-8 space-y-8">
            <!-- Maintenance Mode Toggle -->
            <div class="flex items-center justify-between pb-8 border-b border-gray-100">
                <div class="flex-1">
                    <p class="text-base font-black text-gray-900">Maintenance Mode</p>
                    <p class="text-xs font-bold text-gray-400 mt-1 uppercase tracking-widest">Global Access Control</p>
                </div>
                <button wire:click="toggleMaintenance"
                    class="relative inline-flex h-7 w-14 items-center rounded-full transition-all duration-300 {{ $maintenanceMode ? 'bg-red-500 shadow-lg shadow-red-100' : 'bg-gray-200' }} focus:outline-none">
                    <span class="inline-block h-5 w-5 transform rounded-full bg-white transition-transform duration-300 {{ $maintenanceMode ? 'translate-x-8 shadow-sm' : 'translate-x-1' }}"></span>
                </button>
            </div>

            <!-- Email Notifications Toggle -->
            <div class="flex items-center justify-between pb-8 border-b border-gray-100">
                <div class="flex-1">
                    <p class="text-base font-black text-gray-900">Email Notifications</p>
                    <p class="text-xs font-bold text-gray-400 mt-1 uppercase tracking-widest">Admin Alerts & Reports</p>
                </div>
                <button wire:click="toggleEmailNotifications"
                    class="relative inline-flex h-7 w-14 items-center rounded-full transition-all duration-300 {{ $emailNotifications ? 'bg-blue-600 shadow-lg shadow-blue-100' : 'bg-gray-200' }} focus:outline-none">
                    <span class="inline-block h-5 w-5 transform rounded-full bg-white transition-transform duration-300 {{ $emailNotifications ? 'translate-x-8 shadow-sm' : 'translate-x-1' }}"></span>
                </button>
            </div>

            <!-- Data Backup Toggle -->
            <div class="flex items-center justify-between pb-8 border-b border-gray-100">
                <div class="flex-1">
                    <p class="text-base font-black text-gray-900">Data Backup</p>
                    <p class="text-xs font-bold text-gray-400 mt-1 uppercase tracking-widest">Automated System Security</p>
                </div>
                <button wire:click="toggleDataBackup"
                    class="relative inline-flex h-7 w-14 items-center rounded-full transition-all duration-300 {{ $dataBackup ? 'bg-blue-600 shadow-lg shadow-blue-100' : 'bg-gray-200' }} focus:outline-none">
                    <span class="inline-block h-5 w-5 transform rounded-full bg-white transition-transform duration-300 {{ $dataBackup ? 'translate-x-8 shadow-sm' : 'translate-x-1' }}"></span>
                </button>
            </div>

            <!-- Backup Time Setting -->
            <div class="pb-8 border-b border-gray-100">
                <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-3 ml-1">Backup Schedule Time</label>
                <div class="relative w-full max-w-xs">
                    <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">schedule</span>
                    <input type="time" wire:model="autoBackupTime"
                        class="w-full pl-12 pr-4 py-3.5 border border-gray-200 rounded-[1.25rem] bg-gray-50 focus:bg-white focus:ring-4 focus:ring-blue-100 transition-all outline-none font-bold text-gray-900" />
                </div>
                <p class="text-[10px] font-black mt-3 ml-1 {{ $dataBackup ? 'text-green-500' : 'text-gray-400' }} uppercase tracking-widest">
                    {{ $dataBackup ? '✓ Daily Sync active at ' . $autoBackupTime : '✗ Automated backup inactive' }}
                </p>
            </div>

            <!-- System Version Info -->
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Engine Build</p>
                    <p class="text-xl font-black text-gray-900 mt-1">{{ $systemVersion }}</p>
                </div>
                <div class="text-right">
                    <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Status</p>
                    <span class="inline-flex items-center px-3 py-1 rounded-full bg-green-50 text-green-600 text-[10px] font-black uppercase tracking-widest mt-1">Operational</span>
                </div>
            </div>
        </div>

        <!-- Save Button -->
        <div class="px-8 py-6 bg-gray-50 border-t border-gray-100 flex gap-4">
            <button wire:click="saveSettings"
                class="px-10 py-4 bg-gray-900 text-white rounded-[1.25rem] font-black text-sm hover:bg-blue-600 transition-all shadow-xl shadow-gray-200 active:scale-95 flex items-center gap-3">
                <span class="material-symbols-outlined text-[20px]">save</span>
                Save Configuration
            </button>
            <button
                class="px-10 py-4 bg-white text-gray-900 border border-gray-200 rounded-[1.25rem] font-black text-sm hover:bg-gray-100 transition-all active:scale-95">
                Cancel
            </button>
        </div>
    </div>
    @else
    <!-- System Overview Tab Content -->
    <div wire:poll.5s>
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
    @endif
</div>
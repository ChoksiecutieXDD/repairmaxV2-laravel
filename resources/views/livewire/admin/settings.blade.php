<div class="w-full">
    <!-- Header Section -->
    <div class="mb-8 flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-3xl font-black text-gray-900 tracking-tight flex items-center gap-2">
                <span class="material-symbols-outlined text-gray-900 text-3xl">settings_applications</span>
                System Settings
            </h1>
            <p class="text-gray-500 mt-1">Manage all system and business configuration settings, chatbot models, and track server vitals.</p>
        </div>
        <div class="flex items-center gap-2 bg-gray-50 border border-gray-200 px-4 py-2 rounded-xl">
            <span class="w-2.5 h-2.5 bg-green-500 rounded-full animate-pulse"></span>
            <span class="text-xs font-bold text-gray-700 uppercase tracking-wider">System: Active & Operational</span>
        </div>
    </div>

    <!-- Flash Messages -->
    @if (session()->has('success'))
        <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-[1.25rem] flex items-center gap-3">
            <span class="material-symbols-outlined text-green-600">check_circle</span>
            <span class="text-green-700 font-medium">{{ session('success') }}</span>
        </div>
    @endif

    @if (session()->has('error'))
        <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-[1.25rem] flex items-center gap-3">
            <span class="material-symbols-outlined text-red-600">error</span>
            <span class="text-red-700 font-medium">{{ session('error') }}</span>
        </div>
    @endif

    <!-- Tabs Navigation -->
    <div x-data="{ activeTab: @entangle('activeTab') }" class="space-y-6">
        <div class="bg-white p-1.5 rounded-[1.25rem] border border-gray-200 shadow-sm w-full overflow-x-auto no-scrollbar">
            <div class="flex min-w-full space-x-1">
                <button @click="activeTab = 'overview'" 
                    :class="activeTab === 'overview' ? 'bg-gray-900 text-white shadow-lg transform scale-105' : 'text-gray-500 hover:bg-gray-50'" 
                    class="px-6 py-3 rounded-[1rem] font-black transition-all duration-300 flex items-center gap-2 text-sm whitespace-nowrap">
                    <span class="material-symbols-outlined text-[20px]">grid_view</span>
                    Overview
                </button>
                <button @click="activeTab = 'general'" 
                    :class="activeTab === 'general' ? 'bg-gray-900 text-white shadow-lg transform scale-105' : 'text-gray-500 hover:bg-gray-50'" 
                    class="px-6 py-3 rounded-[1rem] font-black transition-all duration-300 flex items-center gap-2 text-sm whitespace-nowrap">
                    <span class="material-symbols-outlined text-[20px]">business</span>
                    General
                </button>
                <button @click="activeTab = 'email'" 
                    :class="activeTab === 'email' ? 'bg-gray-900 text-white shadow-lg transform scale-105' : 'text-gray-500 hover:bg-gray-50'" 
                    class="px-6 py-3 rounded-[1rem] font-black transition-all duration-300 flex items-center gap-2 text-sm whitespace-nowrap">
                    <span class="material-symbols-outlined text-[20px]">mail</span>
                    Email SMTP
                </button>
                <button @click="activeTab = 'notifications'" 
                    :class="activeTab === 'notifications' ? 'bg-gray-900 text-white shadow-lg transform scale-105' : 'text-gray-500 hover:bg-gray-50'" 
                    class="px-6 py-3 rounded-[1rem] font-black transition-all duration-300 flex items-center gap-2 text-sm whitespace-nowrap">
                    <span class="material-symbols-outlined text-[20px]">notifications</span>
                    Notifications
                </button>
                <button @click="activeTab = 'payment'" 
                    :class="activeTab === 'payment' ? 'bg-gray-900 text-white shadow-lg transform scale-105' : 'text-gray-500 hover:bg-gray-50'" 
                    class="px-6 py-3 rounded-[1rem] font-black transition-all duration-300 flex items-center gap-2 text-sm whitespace-nowrap">
                    <span class="material-symbols-outlined text-[20px]">payment</span>
                    Payment
                </button>
                <button @click="activeTab = 'hours'" 
                    :class="activeTab === 'hours' ? 'bg-gray-900 text-white shadow-lg transform scale-105' : 'text-gray-500 hover:bg-gray-50'" 
                    class="px-6 py-3 rounded-[1rem] font-black transition-all duration-300 flex items-center gap-2 text-sm whitespace-nowrap">
                    <span class="material-symbols-outlined text-[20px]">schedule</span>
                    Hours
                </button>
                <button @click="activeTab = 'security'" 
                    :class="activeTab === 'security' ? 'bg-gray-900 text-white shadow-lg transform scale-105' : 'text-gray-500 hover:bg-gray-50'" 
                    class="px-6 py-3 rounded-[1rem] font-black transition-all duration-300 flex items-center gap-2 text-sm whitespace-nowrap">
                    <span class="material-symbols-outlined text-[20px]">security</span>
                    Security
                </button>
                <button @click="activeTab = 'system'" 
                    :class="activeTab === 'system' ? 'bg-gray-900 text-white shadow-lg transform scale-105' : 'text-gray-500 hover:bg-gray-50'" 
                    class="px-6 py-3 rounded-[1rem] font-black transition-all duration-300 flex items-center gap-2 text-sm whitespace-nowrap">
                    <span class="material-symbols-outlined text-[20px]">tune</span>
                    System Controls
                </button>
                <button @click="activeTab = 'chatbot'" 
                    :class="activeTab === 'chatbot' ? 'bg-gray-900 text-white shadow-lg transform scale-105' : 'text-gray-500 hover:bg-gray-50'" 
                    class="px-6 py-3 rounded-[1rem] font-black transition-all duration-300 flex items-center gap-2 text-sm whitespace-nowrap">
                    <span class="material-symbols-outlined text-[20px]">smart_toy</span>
                    n8n Chatbot
                </button>
                <button @click="activeTab = 'resources'" 
                    :class="activeTab === 'resources' ? 'bg-gray-900 text-white shadow-lg transform scale-105' : 'text-gray-500 hover:bg-gray-50'" 
                    class="px-6 py-3 rounded-[1rem] font-black transition-all duration-300 flex items-center gap-2 text-sm whitespace-nowrap">
                    <span class="material-symbols-outlined text-[20px]">database</span>
                    Resources
                </button>
                <button @click="activeTab = 'health'" 
                    :class="activeTab === 'health' ? 'bg-gray-900 text-white shadow-lg transform scale-105' : 'text-gray-500 hover:bg-gray-50'" 
                    class="px-6 py-3 rounded-[1rem] font-black transition-all duration-300 flex items-center gap-2 text-sm whitespace-nowrap">
                    <span class="material-symbols-outlined text-[20px]">monitoring</span>
                    Health Pulse
                </button>
                <button @click="activeTab = 'env'" 
                    :class="activeTab === 'env' ? 'bg-gray-900 text-white shadow-lg transform scale-105' : 'text-gray-500 hover:bg-gray-50'" 
                    class="px-6 py-3 rounded-[1rem] font-black transition-all duration-300 flex items-center gap-2 text-sm whitespace-nowrap">
                    <span class="material-symbols-outlined text-[20px]">lock</span>
                    Env Vars
                </button>
                <button @click="activeTab = 'maintenance'" 
                    :class="activeTab === 'maintenance' ? 'bg-gray-900 text-white shadow-lg transform scale-105' : 'text-gray-500 hover:bg-gray-50'" 
                    class="px-6 py-3 rounded-[1rem] font-black transition-all duration-300 flex items-center gap-2 text-sm whitespace-nowrap">
                    <span class="material-symbols-outlined text-[20px]">build</span>
                    Maintenance
                </button>
            </div>
        </div>

        <!-- Overview Tab -->
        <div x-show="activeTab === 'overview'" class="space-y-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
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

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6"
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

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
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
                        <div class="system-health-item font-sans">
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

        <!-- General Settings Tab -->
        <div x-show="activeTab === 'general'" class="bg-white rounded-[1.25rem] border border-gray-200 p-8 shadow-sm space-y-8">
            <div>
                <h2 class="text-xl font-bold text-gray-900">Business Information</h2>
                <p class="text-gray-500 text-sm mt-1">Basic identification and contact details for your business.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Business Name</label>
                    <input type="text" wire:model="businessName" class="w-full px-4 py-3 border border-gray-200 rounded-[1.25rem] bg-gray-50 focus:bg-white focus:ring-4 focus:ring-blue-100 transition-all text-sm outline-none" />
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Email Address</label>
                    <input type="email" wire:model="businessEmail" class="w-full px-4 py-3 border border-gray-200 rounded-[1.25rem] bg-gray-50 focus:bg-white focus:ring-4 focus:ring-blue-100 transition-all text-sm outline-none" />
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Phone Number</label>
                    <input type="tel" wire:model="businessPhone" class="w-full px-4 py-3 border border-gray-200 rounded-[1.25rem] bg-gray-50 focus:bg-white focus:ring-4 focus:ring-blue-100 transition-all text-sm outline-none" />
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Website</label>
                    <input type="url" wire:model="businessWebsite" placeholder="https://example.com" class="w-full px-4 py-3 border border-gray-200 rounded-[1.25rem] bg-gray-50 focus:bg-white focus:ring-4 focus:ring-blue-100 transition-all text-sm outline-none" />
                </div>
                <div class="lg:col-span-2">
                    <label class="block text-sm font-bold text-gray-700 mb-2">Street Address</label>
                    <input type="text" wire:model="businessAddress" placeholder="e.g., 123 Tech Lane" class="w-full px-4 py-3 border border-gray-200 rounded-[1.25rem] bg-gray-50 focus:bg-white focus:ring-4 focus:ring-blue-100 transition-all text-sm outline-none" />
                </div>
            </div>
            <div class="pt-6 border-t border-gray-100 flex justify-end">
                <button wire:click="saveGeneralSettings" class="px-10 py-3 bg-gray-900 text-white rounded-[1.25rem] font-black text-sm hover:bg-blue-600 transition-all shadow-xl shadow-gray-200 active:scale-95 flex items-center gap-2">
                    <span class="material-symbols-outlined text-[20px]">save</span>
                    Save Changes
                </button>
            </div>
        </div>

        <!-- Email Settings Tab -->
        <div x-show="activeTab === 'email'" class="bg-white rounded-[1.25rem] border border-gray-200 p-8 shadow-sm space-y-8">
            <div>
                <h2 class="text-xl font-bold text-gray-900">Email Configuration</h2>
                <p class="text-gray-500 text-sm mt-1">Configure SMTP settings for system outgoing emails.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">SMTP Host</label>
                    <input type="text" wire:model="smtpHost" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" />
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">SMTP Port</label>
                    <input type="number" wire:model="smtpPort" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" />
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">From Email Address</label>
                    <input type="email" wire:model="emailFromAddress" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" />
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">From Name</label>
                    <input type="text" wire:model="emailFromName" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" />
                </div>
                <div class="lg:col-span-2">
                    <label class="flex items-center gap-3 cursor-pointer group">
                        <div class="relative">
                            <input type="checkbox" wire:model="emailNotificationsEnabled" class="sr-only peer" />
                            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-0.5 after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-gray-900"></div>
                        </div>
                        <span class="text-sm font-bold text-gray-700 group-hover:text-gray-900 transition-colors">Enable Email Notifications</span>
                    </label>
                </div>
            </div>
            <div class="pt-6 border-t border-gray-100 flex justify-end">
                <button wire:click="saveEmailSettings" class="px-8 py-2.5 bg-gray-900 text-white rounded-xl font-bold hover:bg-gray-800 transition-all shadow-md active:scale-95">Save Changes</button>
            </div>
        </div>

        <!-- Notifications Settings Tab -->
        <div x-show="activeTab === 'notifications'" class="bg-white rounded-[1.25rem] border border-gray-200 p-8 shadow-sm space-y-8">
            <div>
                <h2 class="text-xl font-bold text-gray-900">Notification Preferences</h2>
                <p class="text-gray-500 text-sm mt-1">Control how and when you receive system alerts.</p>
            </div>
            <div class="space-y-6 max-w-2xl">
                <label class="flex items-center gap-3 cursor-pointer">
                    <input type="checkbox" wire:model="appointmentReminders" class="w-5 h-5 border-gray-300 rounded focus:ring-2 focus:ring-blue-500" />
                    <span class="text-sm font-medium text-gray-700">Send Appointment Reminders</span>
                </label>
                <div class="ml-8">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Reminder Time (hours before appointment)</label>
                    <select wire:model="appointmentReminderTime" class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                        <option value="1">1 hour</option>
                        <option value="6">6 hours</option>
                        <option value="12">12 hours</option>
                        <option value="24">24 hours</option>
                        <option value="48">48 hours</option>
                    </select>
                </div>
                <label class="flex items-center gap-3 cursor-pointer group">
                    <div class="relative">
                        <input type="checkbox" wire:model="statusUpdateNotifications" class="sr-only peer" />
                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-0.5 after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-gray-900"></div>
                    </div>
                    <span class="text-sm font-bold text-gray-700 group-hover:text-gray-900 transition-colors">Send Status Update Notifications</span>
                </label>
                <label class="flex items-center gap-3 cursor-pointer group">
                    <div class="relative">
                        <input type="checkbox" wire:model="adminAlerts" class="sr-only peer" />
                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-0.5 after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-gray-900"></div>
                    </div>
                    <span class="text-sm font-bold text-gray-700 group-hover:text-gray-900 transition-colors">Send Admin Alerts for New Orders</span>
                </label>
            </div>
            <div class="pt-6 border-t border-gray-100 flex justify-end">
                <button wire:click="saveNotificationSettings" class="px-8 py-2.5 bg-gray-900 text-white rounded-xl font-bold hover:bg-gray-800 transition-all shadow-md active:scale-95">Save Changes</button>
            </div>
        </div>

        <!-- Payment Settings Tab -->
        <div x-show="activeTab === 'payment'" class="bg-white rounded-[1.25rem] border border-gray-200 p-8 shadow-sm space-y-8">
            <div>
                <h2 class="text-xl font-bold text-gray-900">Payment Configuration</h2>
                <p class="text-gray-500 text-sm mt-1">Manage your payment gateways and currency settings.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Payment Gateway</label>
                    <div class="relative">
                        <select wire:model="paymentGateway" class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent appearance-none bg-white">
                            <option value="stripe">Stripe</option>
                            <option value="paypal">PayPal</option>
                        </select>
                        <span class="material-symbols-outlined absolute left-3 top-2.5 text-gray-400 text-sm">payments</span>
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Currency Code</label>
                    <input type="text" wire:model="currencyCode" placeholder="PHP" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" />
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Tax Percentage (%)</label>
                    <input type="number" wire:model="taxPercentage" step="0.01" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" />
                </div>
            </div>
            <div class="pt-6 border-t border-gray-100 flex justify-end">
                <button wire:click="savePaymentSettings" class="px-8 py-2.5 bg-gray-900 text-white rounded-xl font-bold hover:bg-gray-800 transition-all shadow-md active:scale-95">Save Changes</button>
            </div>
        </div>

        <!-- Business Hours Tab -->
        <div x-show="activeTab === 'hours'" class="bg-white rounded-[1.25rem] border border-gray-200 p-8 shadow-sm space-y-8">
            <div>
                <h2 class="text-xl font-bold text-gray-900">Business Operating Hours</h2>
                <p class="text-gray-500 text-sm mt-1">Set your standard opening and closing times for each day.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @foreach(['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'] as $day)
                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-2xl border border-transparent hover:border-gray-200 hover:bg-white transition-all duration-200">
                        <label class="w-24 text-sm font-bold text-gray-700 capitalize">{{ $day }}</label>
                        <div class="flex items-center gap-3">
                            <input type="time" wire:model="{{ $day }}Open" class="px-3 py-1.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 text-sm bg-white" />
                            <span class="text-gray-400 font-medium text-xs">to</span>
                            <input type="time" wire:model="{{ $day }}Close" class="px-3 py-1.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 text-sm bg-white" />
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="pt-6 border-t border-gray-100 flex justify-end">
                <button wire:click="saveBusinessHours" class="px-8 py-2.5 bg-gray-900 text-white rounded-xl font-bold hover:bg-gray-800 transition-all shadow-md active:scale-95">Save Changes</button>
            </div>
        </div>

        <!-- Security Settings Tab -->
        <div x-show="activeTab === 'security'" class="bg-white rounded-[1.25rem] border border-gray-200 p-8 shadow-sm space-y-8">
            <div>
                <h2 class="text-xl font-bold text-gray-900">Security Configuration</h2>
                <p class="text-gray-500 text-sm mt-1">Enhance your application security with advanced authentication rules.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Min Password Length</label>
                    <input type="number" wire:model="passwordMinLength" min="6" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" />
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Session Timeout (min)</label>
                    <input type="number" wire:model="sessionTimeout" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" />
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Max Login Attempts</label>
                    <input type="number" wire:model="maxLoginAttempts" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" />
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Password Expiry (days)</label>
                    <input type="number" wire:model="passwordExpireDays" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" />
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 py-8 border-y border-gray-100">
                <label class="flex items-center gap-3 cursor-pointer group">
                    <div class="relative">
                        <input type="checkbox" wire:model="passwordRequireNumbers" class="sr-only peer" />
                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-0.5 after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-gray-900"></div>
                    </div>
                    <span class="text-sm font-bold text-gray-700 group-hover:text-gray-900 transition-colors">Require numbers</span>
                </label>
                <label class="flex items-center gap-3 cursor-pointer group">
                    <div class="relative">
                        <input type="checkbox" wire:model="passwordRequireSpecialChars" class="sr-only peer" />
                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-0.5 after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-gray-900"></div>
                    </div>
                    <span class="text-sm font-bold text-gray-700 group-hover:text-gray-900 transition-colors">Require special characters</span>
                </label>
                <label class="flex items-center gap-3 cursor-pointer group">
                    <div class="relative">
                        <input type="checkbox" wire:model="twoFactorAuthRequired" class="sr-only peer" />
                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-0.5 after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-gray-900"></div>
                    </div>
                    <span class="text-sm font-bold text-gray-700 group-hover:text-gray-900 transition-colors">Require 2FA for Admins</span>
                </label>
            </div>
            <div class="pt-6 flex justify-end">
                <button wire:click="saveSecuritySettings" class="px-8 py-2.5 bg-gray-900 text-white rounded-xl font-bold hover:bg-gray-800 transition-all shadow-md active:scale-95">Save Changes</button>
            </div>
        </div>

        <!-- System Controls Tab -->
        <div x-show="activeTab === 'system'" class="bg-white rounded-[1.25rem] border border-gray-200 p-8 shadow-sm space-y-8">
            <div class="flex items-center gap-4">
                <div class="w-10 h-10 bg-blue-50 rounded-xl flex items-center justify-center">
                    <span class="material-symbols-outlined text-blue-600">tune</span>
                </div>
                <div>
                    <h2 class="text-xl font-bold text-gray-900">System Controls</h2>
                    <p class="text-gray-500 text-sm mt-1">Configure global access control parameters and notification behaviors.</p>
                </div>
            </div>

            <div class="space-y-8">
                <!-- Maintenance Mode Toggle -->
                <div class="flex items-center justify-between pb-6 border-b border-gray-100">
                    <div class="flex-1">
                        <p class="text-base font-black text-gray-900">Maintenance Mode</p>
                        <p class="text-xs font-bold text-gray-400 mt-1 uppercase tracking-widest">Global Access Control</p>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" wire:click="toggleMaintenance" {{ $maintenanceMode ? 'checked' : '' }} class="sr-only peer">
                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-0.5 after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-gray-900"></div>
                    </label>
                </div>

                <!-- Email Notifications Toggle -->
                <div class="flex items-center justify-between pb-6 border-b border-gray-100">
                    <div class="flex-1">
                        <p class="text-base font-black text-gray-900">System Email Alerts</p>
                        <p class="text-xs font-bold text-gray-400 mt-1 uppercase tracking-widest">Admin Alerts & Reports</p>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" wire:click="toggleEmailNotifications" {{ $emailNotifications ? 'checked' : '' }} class="sr-only peer">
                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-0.5 after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-gray-900"></div>
                    </label>
                </div>

                <!-- Data Backup Toggle -->
                <div class="flex items-center justify-between pb-6 border-b border-gray-100">
                    <div class="flex-1">
                        <p class="text-base font-black text-gray-900">Data Backup</p>
                        <p class="text-xs font-bold text-gray-400 mt-1 uppercase tracking-widest">Automated System Security</p>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" wire:click="toggleDataBackup" {{ $dataBackup ? 'checked' : '' }} class="sr-only peer">
                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-0.5 after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-gray-900"></div>
                    </label>
                </div>

                <!-- Backup Time Setting -->
                <div class="pb-6 border-b border-gray-100">
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
            <div class="pt-6 border-t border-gray-100 flex justify-end">
                <button wire:click="saveSystemSettings" class="px-10 py-3 bg-gray-900 text-white rounded-[1.25rem] font-black text-sm hover:bg-blue-600 transition-all shadow-xl shadow-gray-200 active:scale-95 flex items-center gap-2 border-none cursor-pointer">
                    <span class="material-symbols-outlined text-[20px]">save</span>
                    Save System Settings
                </button>
            </div>
        </div>

        <!-- n8n Chatbot Tab -->
        <div x-show="activeTab === 'chatbot'" class="bg-white rounded-[1.25rem] border border-gray-200 p-8 shadow-sm space-y-8">
            <div class="flex items-center gap-4">
                <div class="w-10 h-10 bg-purple-50 rounded-xl flex items-center justify-center">
                    <span class="material-symbols-outlined text-purple-600">smart_toy</span>
                </div>
                <div>
                    <h2 class="text-xl font-bold text-gray-900">n8n AI Chatbot Settings</h2>
                    <p class="text-gray-500 text-sm mt-1">Configure connection endpoints and credentials to link n8n AI workflows.</p>
                </div>
            </div>

            <div class="space-y-6">
                <!-- Docker connection tips warning panel -->
                <div class="p-4 bg-amber-50 border border-amber-200 rounded-[1.25rem] flex items-start gap-3">
                    <span class="material-symbols-outlined text-amber-600 mt-0.5">info</span>
                    <div>
                        <h4 class="font-bold text-amber-800 text-sm">Docker & Local Networking Tip:</h4>
                        <p class="text-xs text-amber-700 leading-relaxed mt-1">
                            Since n8n is running in Docker, it must communicate with your host computer's database and API. 
                            Make sure n8n refers to the Laravel API as <strong>http://host.docker.internal:8000</strong> instead of <strong>http://localhost:8000</strong>.
                        </p>
                    </div>
                </div>

                <!-- Webhook URL Input -->
                <div>
                    <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2.5 ml-1">n8n Chatbot Webhook URL</label>
                    <div class="relative w-full">
                        <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">link</span>
                        <input type="text" wire:model="n8nWebhookUrl"
                            placeholder="http://localhost:5678/webhook-test/chatbot"
                            class="w-full pl-12 pr-4 py-3.5 border border-gray-200 rounded-[1.25rem] bg-gray-50 focus:bg-white focus:ring-4 focus:ring-blue-100 transition-all outline-none font-bold text-gray-900" />
                    </div>
                    <span class="text-[10px] text-gray-400 mt-2 block ml-1 leading-relaxed">
                        💡 Use <code>/webhook-test/chatbot</code> during testing in n8n and switch to <code>/webhook/chatbot</code> once workflow is Activated/Published.
                    </span>
                </div>

                <!-- Secret Key -->
                <div>
                    <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2.5 ml-1">X-N8N-SECRET Headers Auth Token</label>
                    <div class="relative w-full">
                        <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">key</span>
                        <input type="text" wire:model="n8nWebhookSecret"
                            placeholder="Secret Token for Headers Verification"
                            class="w-full pl-12 pr-4 py-3.5 border border-gray-200 rounded-[1.25rem] bg-gray-50 focus:bg-white focus:ring-4 focus:ring-blue-100 transition-all outline-none font-bold text-gray-900" />
                    </div>
                </div>

                <!-- Connection Testing UI -->
                <div class="pt-4 flex flex-col gap-4">
                    <button wire:click="testN8nConnection"
                        class="px-6 py-3 bg-gray-900 hover:bg-purple-600 text-white rounded-[1.25rem] font-bold text-xs shadow-md transition-all active:scale-95 flex items-center gap-2 w-fit border-none cursor-pointer">
                        <span class="material-symbols-outlined text-[18px]">cell_tower</span>
                        <span wire:loading.remove wire:target="testN8nConnection">Test Connection to n8n Webhook</span>
                        <span wire:loading wire:target="testN8nConnection" class="flex items-center gap-1">
                            <svg class="animate-spin h-4.5 w-4.5 text-white" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            Sending Ping...
                        </span>
                    </button>

                    @if ($n8nConnectionStatus)
                    <div class="p-4 rounded-xl text-xs font-bold flex items-center gap-2.5 shadow-sm transition-all duration-300 {{ $n8nConnectionStatusClass }}">
                        <span class="material-symbols-outlined text-lg">info</span>
                        <span>{{ $n8nConnectionStatus }}</span>
                    </div>
                    @endif
                </div>
            </div>
            <div class="pt-6 border-t border-gray-100 flex justify-end">
                <button wire:click="saveSystemSettings" class="px-10 py-3 bg-gray-900 text-white rounded-[1.25rem] font-black text-sm hover:bg-blue-600 transition-all shadow-xl shadow-gray-200 active:scale-95 flex items-center gap-2 border-none cursor-pointer">
                    <span class="material-symbols-outlined text-[20px]">save</span>
                    Save System Settings
                </button>
            </div>
        </div>

        <!-- Resources & Queues Tab -->
        <div x-show="activeTab === 'resources'" class="bg-white rounded-[1.25rem] border border-gray-200 p-8 shadow-sm space-y-8">
            <div class="flex items-center gap-4">
                <div class="w-10 h-10 bg-green-50 rounded-xl flex items-center justify-center">
                    <span class="material-symbols-outlined text-green-600">database</span>
                </div>
                <div>
                    <h2 class="text-xl font-bold text-gray-900">Resources & Queues</h2>
                    <p class="text-gray-500 text-sm mt-1">Monitor queue jobs, database connections, and session driver pools.</p>
                </div>
            </div>

            <div class="space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Queue Driver State -->
                    <div class="p-6 bg-gray-50 border border-gray-100 rounded-[1.25rem]">
                        <span class="text-[10px] font-black uppercase text-gray-400 tracking-widest block">Queue Connection</span>
                        <span class="text-2xl font-black text-gray-900 mt-2 block capitalize font-mono">{{ $queueDriver }}</span>
                    </div>

                    <!-- Session Store State -->
                    <div class="p-6 bg-gray-50 border border-gray-100 rounded-[1.25rem]">
                        <span class="text-[10px] font-black uppercase text-gray-400 tracking-widest block">Session Store Driver</span>
                        <span class="text-2xl font-black text-gray-900 mt-2 block capitalize font-mono">{{ $sessionDriver }}</span>
                    </div>

                    <!-- Active Jobs Status -->
                    <div class="p-6 bg-gray-50 border border-gray-100 rounded-[1.25rem] flex items-center justify-between">
                        <div>
                            <span class="text-[10px] font-black uppercase text-gray-400 tracking-widest block">Pending Queue Jobs</span>
                            <span class="text-3xl font-black text-blue-600 mt-1 block">{{ $activeJobsCount }}</span>
                        </div>
                        <span class="material-symbols-outlined text-blue-500 text-3xl opacity-40">pending_actions</span>
                    </div>

                    <!-- Failed Jobs Counter -->
                    <div class="p-6 bg-gray-50 border border-gray-100 rounded-[1.25rem] flex items-center justify-between">
                        <div>
                            <span class="text-[10px] font-black uppercase text-gray-400 tracking-widest block">Failed Queue Jobs</span>
                            <span class="text-3xl font-black text-red-600 mt-1 block">{{ $failedJobsCount }}</span>
                        </div>
                        <span class="material-symbols-outlined text-red-500 text-3xl opacity-40">warning_amber</span>
                    </div>
                </div>

                <!-- Informational Box -->
                <div class="p-4.5 bg-blue-50 border border-blue-200 rounded-xl">
                    <p class="text-xs text-blue-700 leading-relaxed">
                        💡 The application uses <strong>database</strong> queues for local testing. In production, we recommend shifting to a <strong>Redis</strong> or <strong>SQS</strong> server for extreme high-frequency load handling.
                    </p>
                </div>
            </div>
        </div>

        <!-- Health Pulse Tab -->
        <div x-show="activeTab === 'health'" class="bg-white rounded-[1.25rem] border border-gray-200 p-8 shadow-sm space-y-8">
            <div class="flex items-center gap-4">
                <div class="w-10 h-10 bg-rose-50 rounded-xl flex items-center justify-center">
                    <span class="material-symbols-outlined text-rose-600">monitoring</span>
                </div>
                <div>
                    <h2 class="text-xl font-bold text-gray-900">Health Pulse Diagnostic</h2>
                    <p class="text-gray-500 text-sm mt-1">Monitor real-time engine health statistics and latencies.</p>
                </div>
            </div>

            <div class="space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <!-- Database Size Card -->
                    <div class="bg-gray-50 p-6 rounded-[1.25rem] border border-gray-100">
                        <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Database Storage</span>
                        <p class="text-2xl font-black text-gray-900 mt-1.5">{{ $dbSize }}</p>
                        
                        <!-- Capacity progress bar -->
                        <div class="w-full bg-gray-200 rounded-full h-1.5 mt-3.5">
                            <div class="bg-blue-600 h-1.5 rounded-full" style="width: {{ $dbCapacity }}"></div>
                        </div>
                        <span class="text-[10px] font-bold text-gray-500 mt-1.5 block uppercase tracking-wider">{{ $dbCapacity }} utilized</span>
                    </div>

                    <!-- Latency Card -->
                    <div class="bg-gray-50 p-6 rounded-[1.25rem] border border-gray-100">
                        <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Average Ping</span>
                        <p class="text-2xl font-black text-green-600 mt-1.5">{{ $averageLatency }}</p>
                        <span class="inline-flex px-2 py-0.5 bg-green-100 text-green-700 text-[10px] font-bold rounded-md mt-4 uppercase tracking-wide">Excellent</span>
                    </div>

                    <!-- Active Sessions Card -->
                    <div class="bg-gray-50 p-6 rounded-[1.25rem] border border-gray-100">
                        <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Active User Sessions</span>
                        <p class="text-2xl font-black text-purple-600 mt-1.5">{{ $activeSessionsCount }}</p>
                        <span class="text-[10px] text-gray-400 mt-4 block">Connected clients right now</span>
                    </div>
                </div>

                <!-- Extra details (Memory/Disk usage gauges) -->
                <div class="border border-gray-100 rounded-[1.25rem] p-6 space-y-5">
                    <h4 class="font-bold text-xs uppercase tracking-wider text-gray-400">Server Hardware Resource Gauges</h4>
                    
                    <!-- Memory Usage -->
                    <div>
                        <div class="flex justify-between text-xs font-bold text-gray-700 mb-2">
                            <span>Memory Allocation</span>
                            <span>{{ $memoryUsage }}</span>
                        </div>
                        <div class="w-full bg-gray-100 rounded-full h-2">
                            <div class="bg-indigo-600 h-2 rounded-full" style="width: 25%"></div>
                        </div>
                    </div>

                    <!-- Disk Usage -->
                    <div>
                        <div class="flex justify-between text-xs font-bold text-gray-700 mb-2">
                            <span>Primary Disk Utilization</span>
                            <span>{{ $diskUsage }}</span>
                        </div>
                        <div class="w-full bg-gray-100 rounded-full h-2">
                            <div class="bg-indigo-600 h-2 rounded-full" style="width: 32%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Environment Variables Tab -->
        <div x-show="activeTab === 'env'" class="bg-white rounded-[1.25rem] border border-gray-200 p-8 shadow-sm space-y-8">
            <div class="flex items-center gap-4">
                <div class="w-10 h-10 bg-amber-50 rounded-xl flex items-center justify-center">
                    <span class="material-symbols-outlined text-amber-600">lock</span>
                </div>
                <div>
                    <h2 class="text-xl font-bold text-gray-900">Environment Variables</h2>
                    <p class="text-gray-500 text-sm mt-1">Review running server environment properties and authorization scopes.</p>
                </div>
            </div>

            <div class="space-y-6">
                <div class="divide-y divide-gray-100 border border-gray-100 rounded-[1.25rem] overflow-hidden">
                    
                    <!-- APP_ENV details -->
                    <div class="p-5 flex justify-between items-center bg-gray-50/50">
                        <div>
                            <span class="font-black text-sm text-gray-900 block font-mono">APP_ENV</span>
                            <span class="text-xs text-gray-400">Current hosting application profile</span>
                        </div>
                        <span class="px-3.5 py-1.5 rounded-full text-xs font-bold tracking-widest uppercase bg-indigo-50 text-indigo-600 border border-indigo-100 font-mono">{{ $appEnv }}</span>
                    </div>

                    <!-- APP_DEBUG details -->
                    <div class="p-5 flex justify-between items-center">
                        <div>
                            <span class="font-black text-sm text-gray-900 block font-mono">APP_DEBUG</span>
                            <span class="text-xs text-gray-400">Controls displaying verbose system details on failures</span>
                        </div>
                        <span class="px-3.5 py-1.5 rounded-full text-xs font-bold tracking-widest uppercase {{ $appDebug ? 'bg-amber-50 text-amber-700 border border-amber-100' : 'bg-green-50 text-green-700 border border-green-100' }} font-mono">
                            {{ $appDebug ? 'Enabled' : 'Disabled' }}
                        </span>
                    </div>

                    <!-- SSL Config details -->
                    <div class="p-5 flex justify-between items-center bg-gray-50/50">
                        <div>
                            <span class="font-black text-sm text-gray-900 block font-mono">HTTPS SSL / TLS Protocol</span>
                            <span class="text-xs text-gray-400">Forced secure cookie protocols</span>
                        </div>
                        <span class="px-3.5 py-1.5 rounded-full text-xs font-bold tracking-widest uppercase {{ $sslEnabled ? 'bg-green-50 text-green-700 border border-green-100' : 'bg-gray-100 text-gray-500' }}">
                            {{ $sslEnabled ? 'SSL Enforced' : 'Inactive (HTTP)' }}
                        </span>
                    </div>

                    <!-- APP_KEY details -->
                    <div class="p-5 flex justify-between items-center">
                        <div>
                            <span class="font-black text-sm text-gray-900 block font-mono">APP_KEY Hash</span>
                            <span class="text-xs text-gray-400">Standard system cookies payload encryptor code</span>
                        </div>
                        <span class="px-3.5 py-1.5 rounded-full text-xs font-bold tracking-widest uppercase bg-green-50 text-green-700 border border-green-100 font-mono">{{ $appKeyStatus }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- System Maintenance Tab -->
        <div x-show="activeTab === 'maintenance'" class="bg-white rounded-[1.25rem] border border-gray-200 p-8 shadow-sm space-y-8">
            <div class="flex items-center gap-4">
                <div class="w-10 h-10 bg-indigo-50 rounded-xl flex items-center justify-center">
                    <span class="material-symbols-outlined text-indigo-600">build</span>
                </div>
                <div>
                    <h2 class="text-xl font-bold text-gray-900">System Maintenance Panel</h2>
                    <p class="text-gray-500 text-sm mt-1">Run direct administrative actions to flush logs, rebuild configurations, and release files.</p>
                </div>
            </div>

            <div class="space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    
                    <!-- Optimize Application Cache Card -->
                    <div class="p-6 bg-white border border-gray-200 hover:border-indigo-200 rounded-[1.25rem] flex flex-col justify-between shadow-sm hover:shadow-md transition-all">
                        <div>
                            <div class="w-10 h-10 rounded-lg bg-indigo-50 text-indigo-600 flex items-center justify-center mb-4">
                                <span class="material-symbols-outlined text-xl">cached</span>
                            </div>
                            <h3 class="font-bold text-sm text-gray-800">Clear Application Caches</h3>
                            <p class="text-xs text-gray-400 mt-1 leading-relaxed">
                                Clear all compiled config, cached database results, custom views, and routing cache indexes.
                            </p>
                        </div>
                        <button wire:click="clearCache"
                            class="w-full mt-6 py-3 bg-gray-900 hover:bg-indigo-600 text-white rounded-xl font-bold text-xs shadow-md transition-all cursor-pointer border-none focus:outline-none">
                            Run Clear Cache
                        </button>
                    </div>

                    <!-- Optimize Application Code Card -->
                    <div class="p-6 bg-white border border-gray-200 hover:border-indigo-200 rounded-[1.25rem] flex flex-col justify-between shadow-sm hover:shadow-md transition-all">
                        <div>
                            <div class="w-10 h-10 rounded-lg bg-indigo-50 text-indigo-600 flex items-center justify-center mb-4">
                                <span class="material-symbols-outlined text-xl">bolt</span>
                            </div>
                            <h3 class="font-bold text-sm text-gray-800">Optimize Application</h3>
                            <p class="text-xs text-gray-400 mt-1 leading-relaxed">
                                Recompile configs, clear cache files and pre-compile routes for high-speed performance loading.
                            </p>
                        </div>
                        <button wire:click="optimizeApp"
                            class="w-full mt-6 py-3 bg-gray-900 hover:bg-indigo-600 text-white rounded-xl font-bold text-xs shadow-md transition-all cursor-pointer border-none focus:outline-none">
                            Run Optimize App
                        </button>
                    </div>

                    <!-- Maintenance Mode Status & Control Card -->
                    <div class="p-6 bg-white border border-gray-200 hover:border-red-200 rounded-[1.25rem] flex flex-col justify-between shadow-sm hover:shadow-md transition-all">
                        <div>
                            <div class="flex items-center justify-between mb-4">
                                <div class="w-10 h-10 rounded-lg bg-red-50 text-red-600 flex items-center justify-center">
                                    <span class="material-symbols-outlined text-xl">construction</span>
                                </div>
                                <span class="px-2.5 py-1 rounded-full text-[10px] font-black uppercase tracking-wider {{ $maintenanceMode ? 'bg-red-100 text-red-700' : 'bg-green-100 text-green-700' }}">
                                    {{ $maintenanceMode ? 'Active (Down)' : 'Inactive (Live)' }}
                                </span>
                            </div>
                            <h3 class="font-bold text-sm text-gray-800">Maintenance Mode</h3>
                            <p class="text-xs text-gray-400 mt-1 leading-relaxed">
                                Global system block mode. Activating this will restrict application access to all end users. Admins can bypass using a system bypass token.
                            </p>
                        </div>
                        <button wire:click="toggleMaintenance"
                            class="w-full mt-6 py-3 {{ $maintenanceMode ? 'bg-green-600 hover:bg-green-700' : 'bg-red-600 hover:bg-red-700' }} text-white rounded-xl font-bold text-xs shadow-md transition-all cursor-pointer border-none focus:outline-none">
                            {{ $maintenanceMode ? 'Deactivate Maintenance' : 'Activate Maintenance Mode' }}
                        </button>
                    </div>

                    <!-- App Environment & Debug Mode Card -->
                    <div class="p-6 bg-white border border-gray-200 hover:border-amber-200 rounded-[1.25rem] flex flex-col justify-between shadow-sm hover:shadow-md transition-all">
                        <div>
                            <div class="flex items-center justify-between mb-4">
                                <div class="w-10 h-10 rounded-lg bg-amber-50 text-amber-600 flex items-center justify-center">
                                    <span class="material-symbols-outlined text-xl">dns</span>
                                </div>
                                <div class="flex items-center gap-1.5">
                                    <span class="px-2.5 py-1 rounded-full text-[10px] font-black uppercase tracking-wider bg-amber-100 text-amber-700 font-mono">
                                        {{ $appEnv }}
                                    </span>
                                    <span class="px-2.5 py-1 rounded-full text-[10px] font-black uppercase tracking-wider {{ $appDebug ? 'bg-red-100 text-red-700' : 'bg-gray-100 text-gray-700' }} font-mono">
                                        Debug: {{ $appDebug ? 'ON' : 'OFF' }}
                                    </span>
                                </div>
                            </div>
                            <h3 class="font-bold text-sm text-gray-800">App Environment</h3>
                            <p class="text-xs text-gray-400 mt-1 leading-relaxed">
                                Manage system execution environment profiles and toggle diagnostic error screen visibility.
                            </p>
                            
                            <div class="mt-4 space-y-3">
                                <div>
                                    <label class="block text-[10px] font-black text-gray-400 uppercase tracking-wider mb-1">Hosting Profile</label>
                                    <select wire:model="appEnv" class="w-full bg-gray-50 border border-gray-200 rounded-lg px-3 py-2 text-xs font-bold text-gray-800 focus:outline-none focus:border-amber-400">
                                        <option value="local">Local (Development)</option>
                                        <option value="production">Production (Live)</option>
                                        <option value="staging">Staging (Pre-release)</option>
                                        <option value="testing">Testing</option>
                                    </select>
                                </div>
                                
                                <div class="flex items-center justify-between pt-1">
                                    <span class="text-xs font-bold text-gray-600">Verbose Debug Output</span>
                                    <label class="relative inline-flex items-center cursor-pointer">
                                        <input type="checkbox" wire:click="$set('appDebug', {{ !$appDebug ? 'true' : 'false' }})" {{ $appDebug ? 'checked' : '' }} class="sr-only peer">
                                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-0.5 after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-gray-900"></div>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <button wire:click="updateEnvironmentSettings"
                            class="w-full mt-6 py-3 bg-gray-900 hover:bg-amber-600 text-white rounded-xl font-bold text-xs shadow-md transition-all cursor-pointer border-none focus:outline-none">
                            Save Environment Configuration
                        </button>
                    </div>

                    <!-- Log Pruner Utilities Card -->
                    <div class="p-6 bg-white border border-gray-200 hover:border-indigo-200 rounded-[1.25rem] flex flex-col justify-between shadow-sm hover:shadow-md transition-all md:col-span-2">
                        <div class="flex flex-col md:flex-row gap-4 items-start">
                            <div class="w-10 h-10 rounded-lg bg-indigo-50 text-indigo-600 flex items-center justify-center shrink-0">
                                <span class="material-symbols-outlined text-xl">delete_sweep</span>
                            </div>
                            <div>
                                <h3 class="font-bold text-sm text-gray-800">Clear laravel.log file</h3>
                                <p class="text-xs text-gray-400 mt-1 leading-relaxed">
                                    Permanently clears the primary local laravel.log file to release disk space. Best to run regularly if log files exceed 100MB+ in capacity.
                                </p>
                            </div>
                        </div>
                        <button wire:click="clearLogs"
                            class="w-full md:w-fit mt-6 px-8 py-3 bg-red-600 hover:bg-red-700 text-white rounded-xl font-bold text-xs shadow-md transition-all cursor-pointer border-none focus:outline-none self-end">
                            Clear log file
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

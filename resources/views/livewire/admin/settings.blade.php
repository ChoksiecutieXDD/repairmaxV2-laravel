<div class="w-full">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900 tracking-tight">Settings</h1>
        <p class="text-gray-500 mt-1">Manage all system and business configuration settings.</p>
    </div>

    <!-- Flash Messages -->
    @if (session()->has('success'))
        <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg flex items-center gap-3">
            <span class="material-symbols-outlined text-green-600">check_circle</span>
            <span class="text-green-700 font-medium">{{ session('success') }}</span>
        </div>
    @endif

    <!-- Tabs Navigation -->
    <div x-data="{ activeTab: 'overview' }" class="space-y-6">
        <div class="bg-white p-1.5 rounded-[1.25rem] border border-gray-200 shadow-sm w-full overflow-x-auto no-scrollbar">
            <div class="flex min-w-full lg:min-w-0 space-x-1">
                <button @click="activeTab = 'overview'" 
                    :class="activeTab === 'overview' ? 'bg-gray-900 text-white shadow-lg transform scale-105' : 'text-gray-500 hover:bg-gray-50'" 
                    class="px-8 py-3 rounded-[1rem] font-black transition-all duration-300 flex items-center gap-2 text-sm whitespace-nowrap">
                    <span class="material-symbols-outlined text-[20px]">grid_view</span>
                    Overview
                </button>
                <button @click="activeTab = 'general'" 
                    :class="activeTab === 'general' ? 'bg-gray-900 text-white shadow-lg transform scale-105' : 'text-gray-500 hover:bg-gray-50'" 
                    class="px-8 py-3 rounded-[1rem] font-black transition-all duration-300 flex items-center gap-2 text-sm whitespace-nowrap">
                    <span class="material-symbols-outlined text-[20px]">business</span>
                    General
                </button>
                <button @click="activeTab = 'email'" 
                    :class="activeTab === 'email' ? 'bg-gray-900 text-white shadow-lg transform scale-105' : 'text-gray-500 hover:bg-gray-50'" 
                    class="px-8 py-3 rounded-[1rem] font-black transition-all duration-300 flex items-center gap-2 text-sm whitespace-nowrap">
                    <span class="material-symbols-outlined text-[20px]">mail</span>
                    Email
                </button>
                <button @click="activeTab = 'notifications'" 
                    :class="activeTab === 'notifications' ? 'bg-gray-900 text-white shadow-lg transform scale-105' : 'text-gray-500 hover:bg-gray-50'" 
                    class="px-8 py-3 rounded-[1rem] font-black transition-all duration-300 flex items-center gap-2 text-sm whitespace-nowrap">
                    <span class="material-symbols-outlined text-[20px]">notifications</span>
                    Notifications
                </button>
                <button @click="activeTab = 'payment'" 
                    :class="activeTab === 'payment' ? 'bg-gray-900 text-white shadow-lg transform scale-105' : 'text-gray-500 hover:bg-gray-50'" 
                    class="px-8 py-3 rounded-[1rem] font-black transition-all duration-300 flex items-center gap-2 text-sm whitespace-nowrap">
                    <span class="material-symbols-outlined text-[20px]">payment</span>
                    Payment
                </button>
                <button @click="activeTab = 'hours'" 
                    :class="activeTab === 'hours' ? 'bg-gray-900 text-white shadow-lg transform scale-105' : 'text-gray-500 hover:bg-gray-50'" 
                    class="px-8 py-3 rounded-[1rem] font-black transition-all duration-300 flex items-center gap-2 text-sm whitespace-nowrap">
                    <span class="material-symbols-outlined text-[20px]">schedule</span>
                    Hours
                </button>
                <button @click="activeTab = 'security'" 
                    :class="activeTab === 'security' ? 'bg-gray-900 text-white shadow-lg transform scale-105' : 'text-gray-500 hover:bg-gray-50'" 
                    class="px-8 py-3 rounded-[1rem] font-black transition-all duration-300 flex items-center gap-2 text-sm whitespace-nowrap">
                    <span class="material-symbols-outlined text-[20px]">security</span>
                    Security
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
                            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
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
                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                    </div>
                    <span class="text-sm font-bold text-gray-700 group-hover:text-gray-900 transition-colors">Send Status Update Notifications</span>
                </label>
                <label class="flex items-center gap-3 cursor-pointer group">
                    <div class="relative">
                        <input type="checkbox" wire:model="adminAlerts" class="sr-only peer" />
                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
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
                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                    </div>
                    <span class="text-sm font-bold text-gray-700 group-hover:text-gray-900 transition-colors">Require numbers</span>
                </label>
                <label class="flex items-center gap-3 cursor-pointer group">
                    <div class="relative">
                        <input type="checkbox" wire:model="passwordRequireSpecialChars" class="sr-only peer" />
                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                    </div>
                    <span class="text-sm font-bold text-gray-700 group-hover:text-gray-900 transition-colors">Require special characters</span>
                </label>
                <label class="flex items-center gap-3 cursor-pointer group">
                    <div class="relative">
                        <input type="checkbox" wire:model="twoFactorAuthRequired" class="sr-only peer" />
                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                    </div>
                    <span class="text-sm font-bold text-gray-700 group-hover:text-gray-900 transition-colors">Require 2FA for Admins</span>
                </label>
            </div>
            <div class="pt-6 flex justify-end">
                <button wire:click="saveSecuritySettings" class="px-8 py-2.5 bg-gray-900 text-white rounded-xl font-bold hover:bg-gray-800 transition-all shadow-md active:scale-95">Save Changes</button>
            </div>
        </div>
    </div>
</div>
    </div>
</div>

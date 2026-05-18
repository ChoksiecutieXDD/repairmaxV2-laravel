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
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <div class="bg-white p-8 rounded-[1.25rem] border border-gray-200 shadow-sm">
            <div class="w-12 h-12 bg-blue-50 rounded-2xl flex items-center justify-center mb-6">
                <span class="material-symbols-outlined text-blue-600">database</span>
            </div>
            <h3 class="text-lg font-black text-gray-900">Database Size</h3>
            <p class="text-3xl font-black text-blue-600 mt-2">1.2 GB</p>
            <p class="text-xs font-bold text-gray-400 mt-2 uppercase tracking-widest">85% Capacity Used</p>
        </div>
        <div class="bg-white p-8 rounded-[1.25rem] border border-gray-200 shadow-sm">
            <div class="w-12 h-12 bg-green-50 rounded-2xl flex items-center justify-center mb-6">
                <span class="material-symbols-outlined text-green-600">speed</span>
            </div>
            <h3 class="text-lg font-black text-gray-900">Average Latency</h3>
            <p class="text-3xl font-black text-green-600 mt-2">124 ms</p>
            <p class="text-xs font-bold text-gray-400 mt-2 uppercase tracking-widest">Optimal Performance</p>
        </div>
        <div class="bg-white p-8 rounded-[1.25rem] border border-gray-200 shadow-sm">
            <div class="w-12 h-12 bg-purple-50 rounded-2xl flex items-center justify-center mb-6">
                <span class="material-symbols-outlined text-purple-600">group</span>
            </div>
            <h3 class="text-lg font-black text-gray-900">Active Sessions</h3>
            <p class="text-3xl font-black text-purple-600 mt-2">42</p>
            <p class="text-xs font-bold text-gray-400 mt-2 uppercase tracking-widest">Real-time Users</p>
        </div>
    </div>
    @endif
</div>
<div class="w-full max-w-3xl">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">System Settings</h1>
        <p class="text-gray-600 mt-1">Advanced system configuration and maintenance options.</p>
    </div>

    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden mb-8">
        <div class="px-8 py-6 border-b border-gray-200 bg-gray-50">
            <h2 class="text-lg font-bold text-gray-900">System Information</h2>
        </div>

        <div class="p-8 space-y-4">
            @foreach($systemInfo as $info)
                <div class="flex justify-between items-center p-4 bg-gray-50 rounded-lg border border-gray-100">
                    <span class="text-gray-700 font-medium">{{ $info['label'] }}</span>
                    <span class="text-gray-900 font-bold">{{ $info['value'] }}</span>
                </div>
            @endforeach
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden mb-8">
        <div class="px-8 py-6 border-b border-gray-200 bg-gray-50">
            <h2 class="text-lg font-bold text-gray-900">System Mode</h2>
        </div>

        <div class="p-8 space-y-6">
            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                <div>
                    <p class="font-semibold text-gray-900">Maintenance Mode</p>
                    <p class="text-sm text-gray-600">Put application in maintenance mode</p>
                </div>
                <label class="flex items-center cursor-pointer">
                    <input type="checkbox" wire:model="maintenanceMode" class="sr-only peer">
                    <div class="relative w-11 h-6 bg-gray-300 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                </label>
            </div>

            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                <div>
                    <p class="font-semibold text-gray-900">Debug Mode</p>
                    <p class="text-sm text-gray-600">Enable debug information and error reporting</p>
                </div>
                <label class="flex items-center cursor-pointer">
                    <input type="checkbox" wire:model="debugMode" class="sr-only peer">
                    <div class="relative w-11 h-6 bg-gray-300 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                </label>
            </div>

            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                <div>
                    <p class="font-semibold text-gray-900">Cache Enabled</p>
                    <p class="text-sm text-gray-600">Use caching to improve performance</p>
                </div>
                <label class="flex items-center cursor-pointer">
                    <input type="checkbox" wire:model="cacheEnabled" class="sr-only peer">
                    <div class="relative w-11 h-6 bg-gray-300 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                </label>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden mb-8">
        <div class="px-8 py-6 border-b border-gray-200 bg-gray-50">
            <h2 class="text-lg font-bold text-gray-900">Backup & Maintenance</h2>
        </div>

        <div class="p-8 space-y-6">
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Backup Frequency</label>
                <select wire:model="backupFrequency" class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                    <option value="hourly">Hourly</option>
                    <option value="daily">Daily</option>
                    <option value="weekly">Weekly</option>
                    <option value="monthly">Monthly</option>
                </select>
            </div>

            <div class="pt-4 border-t border-gray-200 space-y-3">
                <button class="w-full px-4 py-3 bg-blue-50 text-blue-600 hover:bg-blue-100 rounded-lg font-medium transition-colors flex items-center justify-center gap-2">
                    <span class="material-symbols-outlined text-[18px]">backup</span>
                    Backup Database Now
                </button>
                <button class="w-full px-4 py-3 bg-amber-50 text-amber-600 hover:bg-amber-100 rounded-lg font-medium transition-colors flex items-center justify-center gap-2">
                    <span class="material-symbols-outlined text-[18px]">memory</span>
                    Clear Cache
                </button>
                <button class="w-full px-4 py-3 bg-purple-50 text-purple-600 hover:bg-purple-100 rounded-lg font-medium transition-colors flex items-center justify-center gap-2">
                    <span class="material-symbols-outlined text-[18px]">refresh</span>
                    Optimize Database
                </button>
            </div>
        </div>
    </div>

    <div class="bg-red-50 rounded-2xl border border-red-200 shadow-sm overflow-hidden">
        <div class="px-8 py-6 border-b border-red-200 bg-red-100">
            <h2 class="text-lg font-bold text-red-900">Danger Zone</h2>
        </div>

        <div class="p-8">
            <p class="text-sm text-red-800 mb-4">These actions are irreversible. Proceed with caution.</p>
            <button class="w-full px-4 py-3 bg-red-600 text-white hover:bg-red-700 rounded-lg font-medium transition-colors flex items-center justify-center gap-2">
                <span class="material-symbols-outlined text-[18px]">delete_forever</span>
                Reset System
            </button>
        </div>
    </div>
</div>

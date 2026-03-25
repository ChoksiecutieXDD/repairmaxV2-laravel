<div class="w-full">
    <div class="mb-8">
        <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-2 flex items-center gap-2">
            <span class="material-symbols-outlined">dashboard</span>
            System Overview
        </h1>
        <p class="text-gray-600">Real-time system performance metrics and key indicators.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-6 hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600 mb-1">System Uptime</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $systemUptime }}</p>
                    <p class="text-xs text-green-600 mt-1 font-medium">✓ Excellent</p>
                </div>
                <div class="w-12 h-12 flex items-center justify-center bg-green-50 rounded-lg">
                    <span class="material-symbols-outlined text-[32px] text-green-600">cloud_done</span>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-6 hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600 mb-1">Total Users</p>
                    <p class="text-3xl font-bold text-gray-900">{{ number_format($totalUsers) }}</p>
                    <p class="text-xs text-gray-500 mt-1">{{ $adminCount }} admins, {{ $userCount }} users</p>
                </div>
                <div class="w-12 h-12 flex items-center justify-center bg-blue-50 rounded-lg">
                    <span class="material-symbols-outlined text-[32px] text-blue-600">group</span>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-6 hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600 mb-1">Pending Tasks</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $pendingTasks }}</p>
                    <p class="text-xs text-orange-600 mt-1 font-medium">⚠ Needs attention</p>
                </div>
                <div class="w-12 h-12 flex items-center justify-center bg-orange-50 rounded-lg">
                    <span class="material-symbols-outlined text-[32px] text-orange-600">assignment</span>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-6 hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600 mb-1">Storage Used</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $storageUsed }}</p>
                    <p class="text-xs text-gray-500 mt-1">Capacity: 100GB</p>
                </div>
                <div class="w-12 h-12 flex items-center justify-center bg-purple-50 rounded-lg">
                    <span class="material-symbols-outlined text-[32px] text-purple-600">storage</span>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                <h3 class="font-bold text-gray-900 flex items-center gap-2">
                    <span class="material-symbols-outlined">trending_up</span>
                    Performance Metrics
                </h3>
            </div>
            <div class="p-6 space-y-4">
                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                    <span class="text-gray-700">Response Time</span>
                    <span class="text-green-600 font-bold">245ms</span>
                </div>
                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                    <span class="text-gray-700">Error Rate</span>
                    <span class="text-green-600 font-bold">0.05%</span>
                </div>
                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                    <span class="text-gray-700">Cache Hit Rate</span>
                    <span class="text-green-600 font-bold">94.2%</span>
                </div>
                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                    <span class="text-gray-700">Database Queries/s</span>
                    <span class="text-green-600 font-bold">125</span>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                <h3 class="font-bold text-gray-900 flex items-center gap-2">
                    <span class="material-symbols-outlined">notifications_active</span>
                    Active Services
                </h3>
            </div>
            <div class="p-6 space-y-4">
                <div class="flex items-center justify-between p-3 bg-green-50 border border-green-100 rounded-lg">
                    <div class="flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-green-500"></span>
                        <span class="text-gray-700 font-medium">Database Server</span>
                    </div>
                    <span class="text-xs font-bold text-green-600">RUNNING</span>
                </div>
                <div class="flex items-center justify-between p-3 bg-green-50 border border-green-100 rounded-lg">
                    <div class="flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-green-500"></span>
                        <span class="text-gray-700 font-medium">Cache Service</span>
                    </div>
                    <span class="text-xs font-bold text-green-600">RUNNING</span>
                </div>
                <div class="flex items-center justify-between p-3 bg-green-50 border border-green-100 rounded-lg">
                    <div class="flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-green-500"></span>
                        <span class="text-gray-700 font-medium">Queue Service</span>
                    </div>
                    <span class="text-xs font-bold text-green-600">RUNNING</span>
                </div>
                <div class="flex items-center justify-between p-3 bg-green-50 border border-green-100 rounded-lg">
                    <div class="flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-green-500"></span>
                        <span class="text-gray-700 font-medium">Email Service</span>
                    </div>
                    <span class="text-xs font-bold text-green-600">RUNNING</span>
                </div>
            </div>
        </div>
    </div>
</div>

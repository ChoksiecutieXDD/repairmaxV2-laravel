<div class="w-full">

    <div class="mb-8">
        <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-2 flex items-center gap-2">
            <span class="material-symbols-outlined">dashboard</span>
            System Overview
        </h1>
        <p class="text-gray-600">Real-time system performance metrics and key indicators.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600 mb-1">System Uptime</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $systemUptime }}</p>
                    <p class="text-xs text-green-600 mt-1">✓ Excellent</p>
                </div>
                <span class="material-symbols-outlined text-[40px] text-green-600">cloud_done</span>
            </div>
        </div>

        <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600 mb-1">Total Users</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $totalUsers }}</p>
                    <p class="text-xs text-gray-500 mt-1">{{ $adminCount }} admins, {{ $userCount }} users</p>
                </div>
                <span class="material-symbols-outlined text-[40px] text-blue-600">group</span>
            </div>
        </div>

        <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600 mb-1">Pending Tasks</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $pendingTasks }}</p>
                    <p class="text-xs text-orange-600 mt-1">⚠ Needs attention</p>
                </div>
                <span class="material-symbols-outlined text-[40px] text-orange-600">assignment</span>
            </div>
        </div>

        <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600 mb-1">Storage Used</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $storageUsed }}</p>
                    <p class="text-xs text-gray-500 mt-1">Capacity: 100GB</p>
                </div>
                <span class="material-symbols-outlined text-[40px] text-purple-600">storage</span>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-6 mb-8">
        <h3 class="font-bold text-gray-900 mb-4 flex items-center gap-2">
            <span class="material-symbols-outlined">notifications</span>
            System Alerts
        </h3>
        <div class="space-y-3">
            <div class="flex items-start gap-3 p-3 bg-blue-50 border border-blue-200 rounded-lg">
                <span class="material-symbols-outlined text-blue-600 mt-1">info</span>
                <div class="flex-1">
                    <p class="font-bold text-gray-900 text-sm">Database Maintenance Scheduled</p>
                    <p class="text-xs text-gray-600">Scheduled for March 30, 2026 at 2:00 AM</p>
                </div>
            </div>
            <div class="flex items-start gap-3 p-3 bg-yellow-50 border border-yellow-200 rounded-lg">
                <span class="material-symbols-outlined text-yellow-600 mt-1">warning</span>
                <div class="flex-1">
                    <p class="font-bold text-gray-900 text-sm">Optimization Suggestion</p>
                    <p class="text-xs text-gray-600">Server memory usage stable at 78%</p>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-6">
            <h3 class="font-bold text-gray-900 mb-4 flex items-center gap-2">
                <span class="material-symbols-outlined">event</span>
                Today's Appointments
            </h3>
            <div class="space-y-1">
                @forelse($todaysAppointments as $app)
                <div class="flex items-center justify-between p-3 hover:bg-gray-50 rounded-lg transition-colors">
                    <div class="flex-1">
                        <p class="font-bold text-gray-900 text-sm">{{ $app->user->first_name ?? 'Guest' }} - {{ $app->device_brand }}</p>
                        <p class="text-xs text-gray-500">{{ $app->pref_time }} • {{ $app->fault_category }}</p>
                    </div>
                    <span class="px-2 py-1 bg-blue-50 text-blue-700 rounded text-[10px] font-bold uppercase">{{ $app->status }}</span>
                </div>
                @empty
                <div class="p-6 text-center text-gray-400 text-sm italic">
                    No appointments scheduled for today.
                </div>
                @endforelse
            </div>
        </div>

        <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-6">
            <h3 class="font-bold text-gray-900 mb-4 flex items-center gap-2">
                <span class="material-symbols-outlined">health_and_safety</span>
                Service Status
            </h3>
            <div class="space-y-2">
                @php
                $services = [
                ['name' => 'Web Server', 'status' => 'Running'],
                ['name' => 'Database', 'status' => 'Connected'],
                ['name' => 'Email Service', 'status' => 'Operational'],
                ['name' => 'API Service', 'status' => 'Running'],
                ];
                @endphp

                @foreach($services as $service)
                <div class="flex items-center justify-between p-3 hover:bg-gray-50 rounded-lg transition-colors border border-transparent">
                    <div class="flex items-center gap-2">
                        <span class="w-2 h-2 bg-green-600 rounded-full animate-pulse"></span>
                        <p class="font-medium text-gray-900 text-sm">{{ $service['name'] }}</p>
                    </div>
                    <span class="text-xs text-gray-500 font-bold uppercase">{{ $service['status'] }}</span>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
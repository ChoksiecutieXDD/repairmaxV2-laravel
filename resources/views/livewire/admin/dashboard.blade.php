<div class="w-full">
    <div class="mb-8 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="text-3xl font-bold text-gray-900 tracking-tight">Admin Dashboard</h1>
            <p class="text-gray-500 mt-1">Welcome back, {{ Auth::user()->first_name }}! Manage your repair service platform here.</p>
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
        <div class="bg-white p-6 rounded-2xl border border-gray-200 shadow-sm transition-shadow hover:shadow-md">
            <div class="flex items-start justify-between mb-4">
                <div>
                    <p class="text-xs font-bold text-gray-500 uppercase tracking-wider">Total Users</p>
                    <h3 class="text-3xl font-extrabold text-gray-900 mt-1">{{ $totalUsers }}</h3>
                </div>
                <div class="w-12 h-12 flex items-center justify-center bg-blue-50 text-blue-600 rounded-xl">
                    <span class="material-symbols-outlined text-2xl">group</span>
                </div>
            </div>
            <p class="text-sm font-medium text-blue-600 flex items-center gap-1">
                <span class="material-symbols-outlined text-[16px]">trending_up</span>
                Active users
            </p>
        </div>

        <div class="bg-white p-6 rounded-2xl border border-gray-200 shadow-sm transition-shadow hover:shadow-md">
            <div class="flex items-start justify-between mb-4">
                <div>
                    <p class="text-xs font-bold text-gray-500 uppercase tracking-wider">Appointments</p>
                    <h3 class="text-3xl font-extrabold text-gray-900 mt-1">{{ $totalAppointments }}</h3>
                </div>
                <div class="w-12 h-12 flex items-center justify-center bg-green-50 text-green-600 rounded-xl">
                    <span class="material-symbols-outlined text-2xl">calendar_month</span>
                </div>
            </div>
            <p class="text-sm font-medium text-gray-500">This month</p>
        </div>

        <div class="bg-white p-6 rounded-2xl border border-gray-200 shadow-sm transition-shadow hover:shadow-md">
            <div class="flex items-start justify-between mb-4">
                <div>
                    <p class="text-xs font-bold text-gray-500 uppercase tracking-wider">Pending Repairs</p>
                    <h3 class="text-3xl font-extrabold text-gray-900 mt-1">{{ $pendingRepairs }}</h3>
                </div>
                <div class="w-12 h-12 flex items-center justify-center bg-yellow-50 text-yellow-600 rounded-xl">
                    <span class="material-symbols-outlined text-2xl">build</span>
                </div>
            </div>
            <p class="text-sm font-medium text-yellow-600 flex items-center gap-1">
                <span class="material-symbols-outlined text-[16px]">warning</span>
                Awaiting status
            </p>
        </div>

        <div class="bg-white p-6 rounded-2xl border border-gray-200 shadow-sm transition-shadow hover:shadow-md">
            <div class="flex items-start justify-between mb-4">
                <div>
                    <p class="text-xs font-bold text-gray-500 uppercase tracking-wider">Monthly Revenue</p>
                    <h3 class="text-3xl font-extrabold text-gray-900 mt-1">₱{{ number_format($monthlyRevenue) }}</h3>
                </div>
                <div class="w-12 h-12 flex items-center justify-center bg-purple-50 text-purple-600 rounded-xl">
                    <span class="material-symbols-outlined text-2xl">payments</span>
                </div>
            </div>
            <p class="text-sm font-medium text-green-600 flex items-center gap-1">
                <span class="material-symbols-outlined text-[16px]">north</span>
                This month
            </p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
            <div class="px-6 py-5 border-b border-gray-100 flex items-center justify-between">
                <h2 class="text-lg font-bold text-gray-900 flex items-center gap-2">
                    <span class="material-symbols-outlined text-gray-400">receipt_long</span>
                    Recent Appointments
                </h2>
            </div>
            <div class="divide-y divide-gray-100">
                <div class="px-6 py-4 flex items-center justify-between hover:bg-gray-50 transition-colors cursor-pointer group">
                    <div>
                        <p class="text-sm font-bold text-gray-900 group-hover:text-blue-600 transition-colors">iPhone 14 Pro - Screen</p>
                        <p class="text-xs text-gray-500">John Doe • <span class="font-medium">Today</span></p>
                    </div>
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-green-50 text-green-700 border border-green-100 rounded-lg text-xs font-bold">In Progress</span>
                </div>
                <div class="px-6 py-4 flex items-center justify-between hover:bg-gray-50 transition-colors cursor-pointer group">
                    <div>
                        <p class="text-sm font-bold text-gray-900 group-hover:text-blue-600 transition-colors">Samsung A50 - Battery</p>
                        <p class="text-xs text-gray-500">Jane Smith • <span class="font-medium">Yesterday</span></p>
                    </div>
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-blue-50 text-blue-700 border border-blue-100 rounded-lg text-xs font-bold">Pending</span>
                </div>
                <div class="px-6 py-4 flex items-center justify-between hover:bg-gray-50 transition-colors cursor-pointer group">
                    <div>
                        <p class="text-sm font-bold text-gray-900 group-hover:text-blue-600 transition-colors">iPad Air - Charging Port</p>
                        <p class="text-xs text-gray-500">Mike Johnson • <span class="font-medium">2 days ago</span></p>
                    </div>
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-gray-50 text-gray-700 border border-gray-100 rounded-lg text-xs font-bold">Completed</span>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-6">
            <h2 class="text-lg font-bold text-gray-900 mb-6 flex items-center gap-2">
                <span class="material-symbols-outlined text-gray-400">info</span>
                System Stats
            </h2>
            <ul class="space-y-4">
                <li class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                    <span class="text-gray-700 font-medium">System Uptime</span>
                    <span class="text-gray-900 font-bold">99.9%</span>
                </li>
                <li class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                    <span class="text-gray-700 font-medium">Average Response Time</span>
                    <span class="text-gray-900 font-bold">245ms</span>
                </li>
                <li class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                    <span class="text-gray-700 font-medium">Database Status</span>
                    <span class="text-green-600 font-bold flex items-center gap-1">
                        <span class="w-2 h-2 rounded-full bg-green-500"></span>
                        Healthy
                    </span>
                </li>
                <li class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                    <span class="text-gray-700 font-medium">Disk Usage</span>
                    <span class="text-gray-900 font-bold">45.2 GB / 100 GB</span>
                </li>
            </ul>
        </div>
    </div>
</div>

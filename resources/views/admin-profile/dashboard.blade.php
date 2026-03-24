<x-layouts.admin title="Admin Dashboard | Repairmax Admin">

    <div class="mb-8">
        <h1 class="text-2xl font-bold text-gray-900">Admin Dashboard</h1>
        <p class="text-gray-600 mt-1">Welcome back, {{ Auth::user()->first_name }}! Manage your repair service platform here.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm">
            <h3 class="text-gray-500 text-sm font-semibold mb-2">Total Users</h3>
            <p class="text-3xl font-bold text-gray-900">24</p>
            <p class="text-sm text-gray-500 mt-2">Active users</p>
        </div>

        <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm">
            <h3 class="text-gray-500 text-sm font-semibold mb-2">Total Appointments</h3>
            <p class="text-3xl font-bold text-gray-900">156</p>
            <p class="text-sm text-gray-500 mt-2">This month</p>
        </div>

        <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm">
            <h3 class="text-gray-500 text-sm font-semibold mb-2">Pending Repairs</h3>
            <p class="text-3xl font-bold text-gray-900">12</p>
            <p class="text-sm text-gray-500 mt-2">Awaiting status</p>
        </div>

        <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm">
            <h3 class="text-gray-500 text-sm font-semibold mb-2">Revenue</h3>
            <p class="text-3xl font-bold text-gray-900">$5,240</p>
            <p class="text-sm text-gray-500 mt-2">This month</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
            <h2 class="text-lg font-bold text-gray-900 mb-4">Recent Appointments</h2>
            <div class="space-y-3">
                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                    <div>
                        <p class="font-semibold text-gray-900">iPhone Screen Repair</p>
                        <p class="text-sm text-gray-500">John Doe • 2 hours ago</p>
                    </div>
                    <span class="px-3 py-1 bg-blue-100 text-blue-800 text-xs font-semibold rounded-full">In Progress</span>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
            <h2 class="text-lg font-bold text-gray-900 mb-4">System Stats</h2>
            <ul class="space-y-3">
                <li class="flex justify-between items-center">
                    <span class="text-gray-700">Uptime</span>
                    <span class="text-gray-900 font-semibold">99.9%</span>
                </li>
                <li class="flex justify-between items-center">
                    <span class="text-gray-700">Response Time</span>
                    <span class="text-gray-900 font-semibold">245ms</span>
                </li>
                <li class="flex justify-between items-center">
                    <span class="text-gray-700">Database Status</span>
                    <span class="text-green-600 font-semibold">Healthy</span>
                </li>
            </ul>
        </div>
    </div>

</x-layouts.admin>

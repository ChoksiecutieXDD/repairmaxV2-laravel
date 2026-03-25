<div class="w-full">

    <div class="mb-8 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="text-3xl font-bold text-gray-900 tracking-tight">Admin Dashboard</h1>
            <p class="text-gray-500 mt-1">System-wide overview and real-time management.</p>
        </div>
        <div class="flex gap-3">
            <a href="#" class="inline-flex items-center gap-2 bg-white border border-gray-200 text-gray-700 hover:bg-gray-50 px-4 py-2 rounded-lg font-bold shadow-sm transition-colors shrink-0">
                <span class="material-symbols-outlined text-[20px]">analytics</span>
                Reports
            </a>
            <a href="#" class="inline-flex items-center gap-2 bg-gray-900 text-white hover:bg-gray-800 px-4 py-2 rounded-lg font-bold shadow-md transition-colors shrink-0">
                <span class="material-symbols-outlined text-[20px]">settings_suggest</span>
                Manage All
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
        <div class="bg-white p-6 rounded-2xl border border-gray-200 shadow-sm transition-shadow hover:shadow-md">
            <div class="flex items-start justify-between mb-4">
                <div>
                    <p class="text-xs font-bold text-gray-500 uppercase tracking-wider">Total Users</p>
                    <h3 class="text-3xl font-extrabold text-gray-900 mt-1">1,247</h3>
                </div>
                <div class="w-12 h-12 flex items-center justify-center bg-blue-50 text-blue-600 rounded-xl">
                    <span class="material-symbols-outlined text-2xl">group</span>
                </div>
            </div>
            <p class="text-sm font-medium text-blue-600 flex items-center gap-1">
                <span class="material-symbols-outlined text-[16px]">trending_up</span>
                +45 new members
            </p>
        </div>

        <div class="bg-white p-6 rounded-2xl border border-gray-200 shadow-sm transition-shadow hover:shadow-md">
            <div class="flex items-start justify-between mb-4">
                <div>
                    <p class="text-xs font-bold text-gray-500 uppercase tracking-wider">Appointments</p>
                    <h3 class="text-3xl font-extrabold text-gray-900 mt-1">3,892</h3>
                </div>
                <div class="w-12 h-12 flex items-center justify-center bg-green-50 text-green-600 rounded-xl">
                    <span class="material-symbols-outlined text-2xl">calendar_month</span>
                </div>
            </div>
            <p class="text-sm font-medium text-gray-500">421 completed today</p>
        </div>

        <div class="bg-white p-6 rounded-2xl border border-gray-200 shadow-sm transition-shadow hover:shadow-md">
            <div class="flex items-start justify-between mb-4">
                <div>
                    <p class="text-xs font-bold text-gray-500 uppercase tracking-wider">Monthly Revenue</p>
                    <h3 class="text-3xl font-extrabold text-gray-900 mt-1">₱145k</h3>
                </div>
                <div class="w-12 h-12 flex items-center justify-center bg-yellow-50 text-yellow-600 rounded-xl">
                    <span class="material-symbols-outlined text-2xl">payments</span>
                </div>
            </div>
            <p class="text-sm font-medium text-green-600 flex items-center gap-1">
                <span class="material-symbols-outlined text-[16px]">north</span>
                12% growth
            </p>
        </div>

        <div class="bg-white p-6 rounded-2xl border border-gray-200 shadow-sm transition-shadow hover:shadow-md">
            <div class="flex items-start justify-between mb-4">
                <div>
                    <p class="text-xs font-bold text-gray-500 uppercase tracking-wider">System Health</p>
                    <h3 class="text-3xl font-extrabold text-gray-900 mt-1">99.8%</h3>
                </div>
                <div class="w-12 h-12 flex items-center justify-center bg-purple-50 text-purple-600 rounded-xl">
                    <span class="material-symbols-outlined text-2xl">dns</span>
                </div>
            </div>
            <p class="text-sm font-bold text-green-600 flex items-center gap-1">
                <span class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></span>
                Operational
            </p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-10">

        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
            <div class="px-6 py-5 border-b border-gray-100 flex items-center justify-between">
                <h2 class="text-lg font-bold text-gray-900 flex items-center gap-2">
                    <span class="material-symbols-outlined text-gray-400">receipt_long</span>
                    Recent Bookings
                </h2>
            </div>
            <div class="divide-y divide-gray-100">
                <div class="px-6 py-4 flex items-center justify-between hover:bg-gray-50 transition-colors cursor-pointer group">
                    <div>
                        <p class="text-sm font-bold text-gray-900 group-hover:text-blue-600 transition-colors">iPhone 14 Pro - Screen</p>
                        <p class="text-xs text-gray-500">John Doe • <span class="font-medium">Feb 25, 2026</span></p>
                    </div>
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-green-50 text-green-700 border border-green-100 rounded-lg text-xs font-bold">Completed</span>
                </div>
                <div class="px-6 py-4 flex items-center justify-between hover:bg-gray-50 transition-colors cursor-pointer group">
                    <div>
                        <p class="text-sm font-bold text-gray-900 group-hover:text-blue-600 transition-colors">Galaxy S23 - Battery</p>
                        <p class="text-xs text-gray-500">Jane Smith • <span class="font-medium">Feb 26, 2026</span></p>
                    </div>
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-orange-50 text-orange-700 border border-orange-100 rounded-lg text-xs font-bold">In Progress</span>
                </div>
            </div>
            <div class="px-6 py-4 border-t border-gray-100 bg-gray-50/50">
                <a href="#" class="text-sm font-bold text-blue-600 hover:text-blue-800 flex items-center gap-1">
                    View All Appointments <span class="material-symbols-outlined text-sm">arrow_forward</span>
                </a>
            </div>
        </div>

        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
            <div class="px-6 py-5 border-b border-gray-100 flex items-center justify-between">
                <h2 class="text-lg font-bold text-gray-900 flex items-center gap-2">
                    <span class="material-symbols-outlined text-gray-400">group</span>
                    New Registrations
                </h2>
            </div>
            <div class="divide-y divide-gray-100">
                <div class="px-6 py-4 flex items-center justify-between hover:bg-gray-50 transition-colors cursor-pointer">
                    <div class="flex items-center gap-3">
                        <img src="https://ui-avatars.com/api/?name=John+Doe&background=f3f4f6&color=212529" class="w-10 h-10 rounded-full border border-gray-200">
                        <div>
                            <p class="text-sm font-bold text-gray-900">John Doe</p>
                            <p class="text-xs text-gray-500 font-medium">Joined 2 days ago</p>
                        </div>
                    </div>
                    <span class="px-2.5 py-1 bg-green-50 text-green-700 border border-green-100 rounded-lg text-[10px] uppercase font-extrabold tracking-wider">Verified</span>
                </div>
            </div>
            <div class="px-6 py-4 border-t border-gray-100 bg-gray-50/50">
                <a href="{{ route('admin.user-management') }}" class="text-sm font-bold text-blue-600 hover:text-blue-800 flex items-center gap-1">
                    Manage User Access <span class="material-symbols-outlined text-sm">arrow_forward</span>
                </a>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden mb-10">
        <div class="px-6 py-5 border-b border-gray-100 flex items-center justify-between bg-white">
            <h2 class="text-lg font-bold text-gray-900 flex items-center gap-2">
                <span class="material-symbols-outlined text-gray-400">inventory_2</span>
                Inventory Status
            </h2>
            <a href="#" class="inline-flex items-center justify-center bg-gray-100 text-gray-800 text-xs font-bold px-4 py-2 rounded-lg hover:bg-gray-200 transition-colors">Manage Stock</a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left whitespace-nowrap">
                <thead class="bg-gray-50 text-gray-500 text-xs uppercase tracking-wider font-bold border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-4">Component Item</th>
                        <th class="px-6 py-4">Category</th>
                        <th class="px-6 py-4 text-center">Stock Level</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4 text-right">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-sm font-medium">
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4 text-gray-900 font-bold">iPhone 14 Screen</td>
                        <td class="px-6 py-4 text-gray-600">Display Parts</td>
                        <td class="px-6 py-4 text-center text-gray-900">24</td>
                        <td class="px-6 py-4"><span class="px-2.5 py-1 bg-green-50 text-green-700 rounded-lg text-xs font-bold border border-green-100">In Stock</span></td>
                        <td class="px-6 py-4 text-right"><a href="#" class="text-blue-600 hover:underline">Adjust</a></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

</div>
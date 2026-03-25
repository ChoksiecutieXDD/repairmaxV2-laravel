<div class="w-full">

    <div class="mb-8 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="text-3xl font-bold text-gray-900 tracking-tight">Welcome back, {{ Auth::user()->first_name ?? Auth::user()->name ?? 'User' }}!</h1>
            <p class="text-gray-500 mt-1">Here's a quick overview of your device repairs.</p>
        </div>
        <a href="/user/book-appointment" class="inline-flex items-center justify-center gap-2 bg-gray-900 hover:bg-gray-800 text-white px-5 py-2.5 rounded-lg font-semibold transition-colors shadow-md">
            <span class="material-symbols-outlined text-[20px]">add</span>
            New Repair
        </a>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">

        <div class="bg-white p-6 rounded-2xl border border-gray-200 shadow-sm flex flex-col justify-between">
            <div class="flex items-start justify-between mb-4">
                <div>
                    <p class="text-xs font-bold text-gray-500 uppercase tracking-wider">Total Repairs</p>
                    <h3 class="text-3xl font-extrabold text-gray-900 mt-1">{{ ($activeRepairsCount ?? 0) + ($completedCount ?? 0) }}</h3>
                </div>
                <div class="w-12 h-12 flex items-center justify-center bg-blue-50 text-blue-600 rounded-xl">
                    <span class="material-symbols-outlined text-2xl">calendar_today</span>
                </div>
            </div>
            <div class="flex items-center text-sm">
                <span class="text-blue-600 font-bold flex items-center"><span class="material-symbols-outlined text-[18px] mr-1">trending_up</span>+2</span>
                <span class="text-gray-400 ml-2 font-medium">this month</span>
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl border border-gray-200 shadow-sm flex flex-col justify-between">
            <div class="flex items-start justify-between mb-4">
                <div>
                    <p class="text-xs font-bold text-gray-500 uppercase tracking-wider">Completed</p>
                    <h3 class="text-3xl font-extrabold text-gray-900 mt-1">{{ $completedCount ?? 0 }}</h3>
                </div>
                <div class="w-12 h-12 flex items-center justify-center bg-green-50 text-green-600 rounded-xl">
                    <span class="material-symbols-outlined text-2xl">task_alt</span>
                </div>
            </div>
            <div class="flex items-center text-sm">
                <span class="text-green-600 font-bold flex items-center"><span class="material-symbols-outlined text-[18px] mr-1">verified</span>100%</span>
                <span class="text-gray-400 ml-2 font-medium">success rate</span>
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl border border-gray-200 shadow-sm flex flex-col justify-between">
            <div class="flex items-start justify-between mb-4">
                <div>
                    <p class="text-xs font-bold text-gray-500 uppercase tracking-wider">In Progress</p>
                    <h3 class="text-3xl font-extrabold text-gray-900 mt-1">{{ $activeRepairsCount ?? 0 }}</h3>
                </div>
                <div class="w-12 h-12 flex items-center justify-center bg-orange-50 text-orange-600 rounded-xl">
                    <span class="material-symbols-outlined text-2xl">build</span>
                </div>
            </div>
            <div class="flex items-center text-sm">
                <span class="text-orange-600 font-bold flex items-center"><span class="material-symbols-outlined text-[18px] mr-1">sync</span>Action Required</span>
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl border border-gray-200 shadow-sm flex flex-col justify-between">
            <div class="flex items-start justify-between mb-4">
                <div>
                    <p class="text-xs font-bold text-gray-500 uppercase tracking-wider">Pending</p>
                    <h3 class="text-3xl font-extrabold text-gray-900 mt-1">{{ $upcomingCount ?? 0 }}</h3>
                </div>
                <div class="w-12 h-12 flex items-center justify-center bg-purple-50 text-purple-600 rounded-xl">
                    <span class="material-symbols-outlined text-2xl">pending_actions</span>
                </div>
            </div>
            <div class="flex items-center text-sm font-medium">
                <span class="text-gray-400 flex items-center"><span class="material-symbols-outlined text-[18px] mr-1">hourglass_empty</span>Awaiting approval</span>
            </div>
        </div>

    </div>

    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden transition-shadow hover:shadow-md duration-300 w-full">

        <div class="px-6 py-5 border-b border-gray-100 flex items-center justify-between bg-white">
            <h2 class="text-lg font-bold text-gray-900 flex items-center gap-2">
                <span class="material-symbols-outlined text-gray-400">history</span>
                Recent Activity
            </h2>
            <a href="/user/upcoming-appointments" class="text-sm font-bold text-blue-600 hover:text-blue-800 transition-colors hidden sm:block">View all</a>
        </div>

        <div class="overflow-x-auto w-full">
            <table class="w-full text-left whitespace-nowrap min-w-[800px]">
                <thead class="bg-gray-50 text-gray-500 text-xs uppercase tracking-wider font-bold border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-4">Device</th>
                        <th class="px-6 py-4">Service Required</th>
                        <th class="px-6 py-4">Date Submitted</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4">Quote</th>
                        <th class="px-6 py-4 text-right">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-sm">

                    {{-- Dynamic Livewire Loop --}}
                    @forelse($recentRepairs as $repair)
                    <tr class="hover:bg-gray-50 transition-colors group">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center flex-shrink-0">
                                    <span class="material-symbols-outlined text-[20px] text-gray-600">smartphone</span>
                                </div>
                                <span class="font-bold text-gray-900">{{ $repair->device_name ?? 'Unknown Device' }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-gray-600 font-medium">{{ $repair->issue_type ?? 'General Service' }}</td>
                        <td class="px-6 py-4 text-gray-500">
                            {{ $repair->created_at ? \Carbon\Carbon::parse($repair->created_at)->format('M d, Y') : 'Unknown Date' }}
                        </td>
                        <td class="px-6 py-4">
                            @if(isset($repair->status) && strtolower($repair->status) === 'completed')
                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-bold bg-green-50 text-green-700 border border-green-200">
                                <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span> Completed
                            </span>
                            @elseif(isset($repair->status) && strtolower($repair->status) === 'in progress')
                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-bold bg-orange-50 text-orange-700 border border-orange-200">
                                <span class="w-1.5 h-1.5 rounded-full bg-orange-500 animate-pulse"></span> In Progress
                            </span>
                            @else
                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-bold bg-gray-100 text-gray-700 border border-gray-200">
                                <span class="w-1.5 h-1.5 rounded-full bg-gray-500"></span> Pending
                            </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 font-bold text-gray-900">₱{{ number_format($repair->quote ?? 0, 2) }}</td>
                        <td class="px-6 py-4 text-right">
                            <a href="/user/appointment/{{ $repair->id ?? 1 }}" class="text-blue-600 hover:text-blue-800 font-bold group-hover:underline">Details</a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                            No recent activity found.
                        </td>
                    </tr>
                    @endforelse

                </tbody>
            </table>
        </div>

        <div class="px-6 py-4 border-t border-gray-100 bg-gray-50 text-center sm:hidden">
            <a href="/user/upcoming-appointments" class="text-sm text-blue-600 font-bold block w-full py-2 bg-white rounded-lg border border-gray-200 shadow-sm">
                View All Appointments
            </a>
        </div>

    </div>

</div>
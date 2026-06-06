<div class="w-full">
    {{-- Custom Alpine Toast --}}
    @if (session('success'))
        <div x-data="{ show: true }" 
            x-init="setTimeout(() => show = false, 5000)" 
            x-show="show" 
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 -translate-y-4"
            x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 -translate-y-4"
            class="fixed top-6 left-1/2 -translate-x-1/2 z-[200] max-w-sm w-full bg-white border border-blue-100 shadow-2xl rounded-2xl p-4 flex items-center gap-4 border-l-4 border-l-blue-500">
            <div class="w-10 h-10 bg-blue-50 text-blue-600 rounded-full flex items-center justify-center shrink-0">
                <span class="material-symbols-outlined text-[20px]">check_circle</span>
            </div>
            <div class="flex-1">
                <h4 class="text-sm font-bold text-gray-900 leading-none">Booking Confirmed!</h4>
                <p class="text-[11px] text-gray-500 mt-1.5 leading-snug">{{ session('success') }}</p>
            </div>
            <button @click="show = false" class="text-gray-300 hover:text-gray-500 shrink-0">
                <span class="material-symbols-outlined text-[18px]">close</span>
            </button>
        </div>
    @endif

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

        <div class="bg-white p-5 rounded-2xl border border-brand-200 shadow-sm flex items-center gap-4 hover:-translate-y-0.5 transition-all duration-300">
            <div class="w-12 h-12 flex items-center justify-center bg-blue-50 text-blue-600 rounded-xl shrink-0">
                <span class="material-symbols-outlined text-[24px]">calendar_today</span>
            </div>
            <div class="overflow-hidden">
                <p class="text-[11px] font-black text-gray-500 uppercase tracking-widest leading-none">Total Repairs</p>
                <h3 class="text-xl font-black text-gray-900 mt-1.5 leading-none">{{ $totalCount ?? 0 }}</h3>
            </div>
        </div>

        <div class="bg-white p-5 rounded-2xl border border-brand-200 shadow-sm flex items-center gap-4 hover:-translate-y-0.5 transition-all duration-300">
            <div class="w-12 h-12 flex items-center justify-center bg-green-50 text-green-600 rounded-xl shrink-0">
                <span class="material-symbols-outlined text-[24px]">task_alt</span>
            </div>
            <div class="overflow-hidden">
                <p class="text-[11px] font-black text-gray-500 uppercase tracking-widest leading-none">Completed</p>
                <h3 class="text-xl font-black text-gray-900 mt-1.5 leading-none">{{ $completedCount ?? 0 }}</h3>
            </div>
        </div>

        <div class="bg-white p-5 rounded-2xl border border-brand-200 shadow-sm flex items-center gap-4 hover:-translate-y-0.5 transition-all duration-300">
            <div class="w-12 h-12 flex items-center justify-center bg-orange-50 text-orange-600 rounded-xl shrink-0">
                <span class="material-symbols-outlined text-[24px]">build</span>
            </div>
            <div class="overflow-hidden">
                <p class="text-[11px] font-black text-gray-500 uppercase tracking-widest leading-none">In Progress</p>
                <h3 class="text-xl font-black text-gray-900 mt-1.5 leading-none">{{ $activeRepairsCount ?? 0 }}</h3>
            </div>
        </div>

        <div class="bg-white p-5 rounded-2xl border border-brand-200 shadow-sm flex items-center gap-4 hover:-translate-y-0.5 transition-all duration-300">
            <div class="w-12 h-12 flex items-center justify-center bg-purple-50 text-purple-600 rounded-xl shrink-0">
                <span class="material-symbols-outlined text-[24px]">pending_actions</span>
            </div>
            <div class="overflow-hidden">
                <p class="text-[11px] font-black text-gray-500 uppercase tracking-widest leading-none">Pending</p>
                <h3 class="text-xl font-black text-gray-900 mt-1.5 leading-none">{{ $upcomingCount ?? 0 }}</h3>
            </div>
        </div>

    </div>

    <div class="bg-white rounded-2xl border border-brand-200 shadow-sm overflow-hidden transition-shadow hover:shadow-md duration-300 w-full">

        <div class="px-6 py-5 border-b border-brand-100 flex items-center justify-between bg-white">
            <h2 class="text-lg font-bold text-gray-900 flex items-center gap-2">
                <span class="material-symbols-outlined text-gray-400">history</span>
                Recent Activity
            </h2>
            <a href="/user/upcoming-appointments" class="text-sm font-bold text-blue-600 hover:text-blue-800 transition-colors hidden sm:block">View all</a>
        </div>

        <div class="overflow-x-auto w-full">
            <table class="w-full text-left whitespace-nowrap min-w-[800px]">
                <thead class="bg-gray-50 text-gray-500 text-xs uppercase tracking-wider font-bold border-b border-brand-200">
                    <tr>
                        <th class="px-6 py-4">Device</th>
                        <th class="px-6 py-4">Service Required</th>
                        <th class="px-6 py-4">Date Submitted</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4">Quote</th>
                        <th class="px-6 py-4 text-right">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-brand-100 text-sm">

                    {{-- Dynamic Livewire Loop --}}
                    @forelse($recentRepairs as $repair)
                    <tr class="hover:bg-gray-50 transition-colors group">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center flex-shrink-0">
                                    <span class="material-symbols-outlined text-[20px] text-gray-600">smartphone</span>
                                </div>
                                <span class="font-bold text-gray-900">{{ $repair->device_brand ?? 'Unknown Device' }} {{ $repair->device_model ?? '' }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-gray-600 font-medium">{{ $repair->fault_category ?? 'General Service' }}</td>
                        <td class="px-6 py-4 text-gray-500">
                            {{ $repair->created_at ? \Carbon\Carbon::parse($repair->created_at)->format('M d, Y') : 'Unknown Date' }}
                        </td>
                        <td class="px-6 py-4">
                            @if(isset($repair->status) && strtolower($repair->status) === 'completed')
                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-bold bg-green-50 text-green-700 border border-green-200">
                                <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span> Completed
                            </span>
                            @elseif(isset($repair->status) && (strtolower($repair->status) === 'in progress' || strtolower($repair->status) === 'scheduled'))
                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-bold bg-orange-50 text-orange-700 border border-orange-200">
                                <span class="w-1.5 h-1.5 rounded-full bg-orange-500 animate-pulse"></span> {{ ucfirst($repair->status) }}
                            </span>
                            @else
                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-bold bg-gray-100 text-gray-700 border border-brand-200">
                                <span class="w-1.5 h-1.5 rounded-full bg-gray-500"></span> Pending
                            </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 font-bold text-gray-900">₱{{ number_format($repair->quote ?? 0, 2) }}</td>
                        <td class="px-6 py-4 text-right">
                            <a href="{{ route('user.booked-details', $repair->id) }}" class="inline-flex items-center justify-center bg-gray-900 hover:bg-gray-850 text-white px-4 py-2 rounded-xl text-xs font-bold transition-all shadow-sm transform hover:-translate-y-0.5 active:translate-y-0">Details</a>
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

        <div class="px-6 py-4 border-t border-brand-100 bg-gray-50 text-center sm:hidden">
            <a href="/user/upcoming-appointments" class="text-sm text-blue-600 font-bold block w-full py-2 bg-white rounded-lg border border-brand-200 shadow-sm">
                View All Appointments
            </a>
        </div>

    </div>


</div>
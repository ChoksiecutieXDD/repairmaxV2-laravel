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

        <div class="bg-white p-6 rounded-2xl border border-gray-200 shadow-sm flex flex-col justify-between">
            <div class="flex items-start justify-between mb-4">
                <div>
                    <p class="text-xs font-bold text-gray-500 uppercase tracking-wider">Total Repairs</p>
                    <h3 class="text-3xl font-extrabold text-gray-900 mt-1">{{ $totalCount ?? 0 }}</h3>
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
                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-bold bg-gray-100 text-gray-700 border border-gray-200">
                                <span class="w-1.5 h-1.5 rounded-full bg-gray-500"></span> Pending
                            </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 font-bold text-gray-900">₱{{ number_format($repair->quote ?? 0, 2) }}</td>
                        <td class="px-6 py-4 text-right">
                            <button wire:click="viewDetails({{ $repair->id }})" class="inline-flex items-center justify-center bg-gray-900 hover:bg-gray-850 text-white px-4 py-2 rounded-xl text-xs font-bold transition-all shadow-sm transform hover:-translate-y-0.5 active:translate-y-0">Details</button>
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

    <!-- Appointment Details Modal -->
    <div x-data="{ open: @entangle('showDetailsModal') }"
         x-show="open"
         x-cloak
         class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-gray-900/60 backdrop-blur-md"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         @keydown.escape.window="open = false; $wire.closeDetails()">

        <div class="bg-white rounded-[2rem] shadow-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto transform transition-all flex flex-col" 
             x-show="open"
             @click.outside="open = false; $wire.closeDetails()"
             x-transition:enter="ease-out duration-300"
             x-transition:enter-start="opacity-0 scale-95 translate-y-4"
             x-transition:enter-end="opacity-100 scale-100 translate-y-0"
             x-transition:leave="ease-in duration-200"
             x-transition:leave-start="opacity-100 scale-100 translate-y-0"
             x-transition:leave-end="opacity-0 scale-95 translate-y-4">
            
            @if($selectedAppointment)
                <!-- Modal Header -->
                <div class="sticky top-0 bg-gray-900 border-b border-gray-800 px-6 py-5 flex items-center justify-between shrink-0 rounded-t-[2rem] z-10">
                    <h2 class="text-xl font-bold text-white">Appointment Details</h2>
                    <button wire:click="closeDetails()" class="text-gray-400 hover:text-white transition-colors">
                        <span class="material-symbols-outlined text-[24px]">close</span>
                    </button>
                </div>

                <!-- Modal Body -->
                <div class="p-6 space-y-6 flex-1 overflow-y-auto">
                    <!-- Device Information Section -->
                    <div class="bg-gray-50 rounded-2xl p-5 border border-gray-200">
                        <h3 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-4">Device Information</h3>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <p class="text-xs text-gray-500 font-medium mb-1">Brand</p>
                                <p class="text-gray-900 font-semibold">{{ $selectedAppointment->device_brand ?? 'N/A' }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 font-medium mb-1">Model</p>
                                <p class="text-gray-900 font-semibold">{{ $selectedAppointment->device_model ?? 'N/A' }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Service Information Section -->
                    <div class="bg-gray-50 rounded-2xl p-5 border border-gray-200">
                        <h3 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-4">Service Information</h3>
                        <div class="space-y-3">
                            <div>
                                <p class="text-xs text-gray-500 font-medium mb-1">Issue Category</p>
                                <p class="text-gray-900 font-semibold">{{ $selectedAppointment->fault_category ?? 'N/A' }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 font-medium mb-1">Description</p>
                                <p class="text-gray-700 leading-relaxed text-sm">{{ $selectedAppointment->description ?? 'No description provided' }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Appointment Details Section -->
                    <div class="bg-gray-50 rounded-2xl p-5 border border-gray-200">
                        <h3 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-4">Appointment Details</h3>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <p class="text-xs text-gray-500 font-medium mb-1">Tracking Code</p>
                                <p class="text-gray-900 font-mono font-bold">{{ $selectedAppointment->tracking_code ?? 'N/A' }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 font-medium mb-1">Status</p>
                                <div class="mt-1">
                                    @if($selectedAppointment->status == 'Completed')
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-bold bg-green-50 text-green-700 border border-green-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span>
                                        Completed
                                    </span>
                                    @elseif($selectedAppointment->status == 'In Progress' || $selectedAppointment->status == 'Scheduled')
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-bold bg-orange-50 text-orange-700 border border-orange-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-orange-500 animate-pulse"></span>
                                        {{ $selectedAppointment->status }}
                                    </span>
                                    @else
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-bold bg-gray-100 text-gray-700 border border-gray-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-gray-500"></span>
                                        {{ $selectedAppointment->status ?? 'Pending' }}
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 font-medium mb-1">Scheduled Date & Time</p>
                                <p class="text-gray-900 font-semibold">
                                    {{ $selectedAppointment->pref_date ? \Carbon\Carbon::parse($selectedAppointment->pref_date)->format('M d, Y') : 'N/A' }}
                                    <br>
                                    <span class="text-sm font-normal text-gray-500">{{ $selectedAppointment->pref_time ? \Carbon\Carbon::parse($selectedAppointment->pref_time)->format('h:i A') : 'N/A' }}</span>
                                </p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 font-medium mb-1">Quote Amount</p>
                                <p class="text-gray-900 font-bold text-lg">₱{{ number_format($selectedAppointment->quote ?? 0, 2) }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Cost Information (if completed) -->
                    @if($selectedAppointment->status == 'Completed')
                    <div class="bg-blue-50/50 rounded-2xl p-5 border border-blue-150">
                        <h3 class="text-xs font-bold text-blue-500 uppercase tracking-wider mb-4">Completion Details</h3>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <p class="text-xs text-gray-500 font-medium mb-1">Final Cost</p>
                                <p class="text-gray-900 font-bold text-lg">₱{{ number_format($selectedAppointment->final_cost ?? 0, 2) }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 font-medium mb-1">Completed Date</p>
                                <p class="text-gray-900 font-semibold">
                                    {{ $selectedAppointment->completed_at ? \Carbon\Carbon::parse($selectedAppointment->completed_at)->format('M d, Y') : 'N/A' }}
                                </p>
                            </div>
                            @if($selectedAppointment->invoice_number)
                            <div>
                                <p class="text-xs text-gray-500 font-medium mb-1">Invoice Number</p>
                                <p class="text-gray-900 font-mono font-bold">{{ $selectedAppointment->invoice_number }}</p>
                            </div>
                            @endif
                            @if($selectedAppointment->completion_notes)
                            <div class="col-span-2">
                                <p class="text-xs text-gray-500 font-medium mb-1">Technician Notes</p>
                                <p class="text-gray-700 text-sm leading-relaxed">{{ $selectedAppointment->completion_notes }}</p>
                            </div>
                            @endif
                        </div>
                    </div>
                    @endif
                </div>

                <!-- Modal Footer -->
                <div class="sticky bottom-0 bg-gray-50 border-t border-gray-100 px-6 py-5 flex items-center justify-between gap-3 flex-wrap shrink-0 rounded-b-[2rem]">
                    <div class="flex gap-2 flex-wrap">
                        @if($selectedAppointment->status == 'Completed' && $selectedAppointment->invoice_number)
                        <a href="{{ route('user.appointment.invoice-view', $selectedAppointment->id) }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2.5 rounded-xl font-bold transition-all text-sm shadow-md shadow-emerald-100 hover:shadow-none">
                            <span class="material-symbols-outlined text-[18px]">receipt</span>
                            View Invoice
                        </a>
                        @endif
                        @if($selectedAppointment->status == 'Completed')
                        <a href="{{ route('user.appointment.receipt-view', $selectedAppointment->id) }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2.5 rounded-xl font-bold transition-all text-sm shadow-md shadow-blue-100 hover:shadow-none">
                            <span class="material-symbols-outlined text-[18px]">receipt_long</span>
                            View Receipt
                        </a>
                        @endif
                    </div>
                    <button wire:click="closeDetails()" class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-5 py-2.5 rounded-xl font-bold transition-all text-sm">
                        Close
                    </button>
                </div>
            @endif
        </div>
    </div>

</div>
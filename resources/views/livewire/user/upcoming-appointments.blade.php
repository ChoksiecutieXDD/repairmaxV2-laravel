<div class="w-full">

    <div class="mb-8 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="text-3xl font-bold text-gray-900 tracking-tight">Upcoming Appointments</h1>
            <p class="text-gray-500 mt-1">Manage and track your scheduled device repairs.</p>
        </div>
        <a href="{{ route('user.book-appointment') }}" class="inline-flex items-center justify-center gap-2 bg-gray-900 hover:bg-gray-800 text-white px-5 py-2.5 rounded-lg font-semibold transition-colors shadow-md shrink-0">
            <span class="material-symbols-outlined text-[20px]">add</span>
            Book New Repair
        </a>
    </div>

    @if (session()->has('message'))
    <div class="mb-6 p-4 bg-blue-50 text-blue-700 rounded-xl border border-blue-100 flex items-center gap-2">
        <span class="material-symbols-outlined">info</span>
        {{ session('message') }}
    </div>
    @endif

    <div class="grid grid-cols-1 xl:grid-cols-2 gap-6">

        @forelse($appointments as $app)
        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm hover:shadow-md transition-all overflow-hidden">

            <div class="p-6 border-b border-gray-100 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-xl bg-gray-50 flex items-center justify-center flex-shrink-0 text-gray-600 border border-gray-100">
                        <span class="material-symbols-outlined text-[28px]">
                            {{ $app->device_brand == 'Apple' ? 'laptop_mac' : 'smartphone' }}
                        </span>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-gray-900 leading-tight">{{ $app->device_brand }} {{ $app->device_model }}</h3>
                        <p class="text-gray-500 text-sm font-medium mt-0.5">{{ $app->fault_category }}</p>
                    </div>
                </div>

                @php
                $statusClasses = [
                'In Progress' => 'bg-orange-50 text-orange-700 border-orange-200',
                'Pending' => 'bg-gray-100 text-gray-700 border-gray-200',
                'Approved' => 'bg-green-50 text-green-700 border-green-200',
                'Cancelled' => 'bg-red-50 text-red-700 border-red-200',
                ];
                $badgeClass = $statusClasses[$app->status] ?? $statusClasses['Pending'];
                @endphp

                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-bold border {{ $badgeClass }} shrink-0">
                    <span class="w-1.5 h-1.5 rounded-full {{ $app->status == 'In Progress' ? 'bg-orange-500 animate-pulse' : 'bg-current' }}"></span>
                    {{ $app->status }}
                </span>
            </div>

            <div class="p-6 bg-gray-50/30">
                <div class="flex items-center gap-2 mb-5 text-gray-900">
                    <span class="material-symbols-outlined text-gray-400 text-[20px]">calendar_clock</span>
                    <p class="font-bold text-sm">Scheduled for:
                        <span class="font-medium text-gray-600 ml-1">
                            {{ \Carbon\Carbon::parse($app->pref_date)->format('M d, Y') }} at {{ \Carbon\Carbon::parse($app->pref_time)->format('h:i A') }}
                        </span>
                    </p>
                </div>

                <div class="grid grid-cols-3 gap-4 bg-white p-4 rounded-xl border border-gray-200 shadow-sm">
                    <div>
                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Service ID</p>
                        <p class="font-mono font-bold text-gray-900 text-sm">{{ $app->tracking_code }}</p>
                    </div>
                    <div>
                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Est. Duration</p>
                        <p class="font-bold text-gray-900 text-sm flex items-center gap-1">
                            <span class="material-symbols-outlined text-[16px] text-gray-400">timer</span>
                            --
                        </p>
                    </div>
                    <div>
                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Technician</p>
                        <p class="font-bold text-gray-400 text-sm italic">Assigning...</p>
                    </div>
                </div>

                <div class="mt-6 flex justify-end gap-3">
                    @if($app->status == 'Pending')
                    <button
                        wire:click="cancelAppointment({{ $app->id }})"
                        wire:confirm="Are you sure you want to cancel this appointment?"
                        class="px-4 py-2 text-sm font-bold text-red-600 bg-white border border-red-100 rounded-lg hover:bg-red-50 transition-colors">
                        Cancel
                    </button>
                    @endif
                    <a href="#" class="px-4 py-2 text-sm font-bold text-gray-600 bg-white border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors">Reschedule</a>
                    <a href="#" class="px-4 py-2 text-sm font-bold text-blue-700 bg-blue-50 border border-blue-100 rounded-lg hover:bg-blue-100 transition-colors">View Details</a>
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-full py-20 bg-white rounded-3xl border border-dashed border-gray-300 flex flex-col items-center justify-center text-center px-6">
            <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mb-4">
                <span class="material-symbols-outlined text-gray-300 text-5xl">event_busy</span>
            </div>
            <h3 class="text-xl font-bold text-gray-900">No upcoming appointments</h3>
            <p class="text-gray-500 mt-2 max-w-sm">You don't have any repairs scheduled at the moment. Need help with a device?</p>
            <a href="{{ route('user.book-appointment') }}" class="mt-6 font-bold text-blue-600 hover:text-blue-800 flex items-center gap-2">
                Book a new repair now <span class="material-symbols-outlined text-sm">arrow_forward</span>
            </a>
        </div>
        @endforelse

    </div>
</div>
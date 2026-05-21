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

    @if (session()->has('error'))
    <div class="mb-6 p-4 bg-red-50 text-red-700 rounded-xl border border-red-100 flex items-center gap-2">
        <span class="material-symbols-outlined">error</span>
        {{ session('error') }}
    </div>
    @endif

    <div class="grid grid-cols-1 xl:grid-cols-2 gap-6">

        @forelse($appointments as $app)
        <div class="bg-white rounded-2xl border border-brand-200 shadow-sm hover:shadow-md transition-all overflow-hidden">

            <div class="p-6 border-b border-brand-100 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-xl bg-gray-50 flex items-center justify-center flex-shrink-0 text-gray-600 border border-brand-100">
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
                'Pending' => 'bg-gray-100 text-gray-700 border-brand-200',
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
                    <p class="font-bold text-sm mb-0">Scheduled for:
                        <span class="font-medium text-gray-600 ml-1">
                            {{ \Carbon\Carbon::parse($app->pref_date)->format('M d, Y') }} at {{ \Carbon\Carbon::parse($app->pref_time)->format('h:i A') }}
                        </span>
                    </p>
                </div>

                <div class="grid grid-cols-3 gap-4 bg-white p-4 rounded-xl border border-brand-200 shadow-sm">
                    <div>
                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Booking Ref</p>
                        <p class="font-mono font-bold text-gray-900 text-sm mb-0">{{ $app->booking_number ?? $app->tracking_code }}</p>
                    </div>
                    <div>
                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Est. Duration</p>
                        <p class="font-bold text-gray-900 text-sm flex items-center gap-1 mb-0">
                            <span class="material-symbols-outlined text-[16px] text-gray-400">timer</span>
                            --
                        </p>
                    </div>
                    <div>
                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Technician</p>
                        <p class="font-bold text-gray-400 text-sm italic mb-0">Assigning...</p>
                    </div>
                </div>

                <!-- Financial Overview -->
                <div class="mt-6 bg-white p-4 rounded-xl border border-brand-200 shadow-sm">
                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-3">Pricing Breakdown</p>
                    <div class="space-y-2.5">
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-600">Base Service Price</span>
                            <span class="text-sm font-bold text-gray-900">₱{{ number_format($app->quote - ($app->additional_fee ?? 0), 2) }}</span>
                        </div>
                        @if($app->additional_fee > 0)
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-600">Service Method ({{ $app->service_method ?? 'N/A' }})</span>
                            <span class="text-sm font-bold text-gray-900">₱{{ number_format($app->additional_fee ?? 0, 2) }}</span>
                        </div>
                        @endif
                        <div class="border-t border-brand-200 pt-2.5">
                            <div class="flex justify-between items-center">
                                <span class="text-sm font-bold text-gray-900">Estimated Total</span>
                                <span class="text-base font-extrabold text-brand-600">₱{{ number_format($app->quote ?? 0, 2) }}</span>
                            </div>
                        </div>
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
                    <a href="{{ route('user.booked-details', $app->id) }}"
                        class="px-4 py-2 text-sm font-bold text-blue-700 bg-blue-50 border border-blue-100 rounded-lg hover:bg-blue-100 transition-colors inline-flex items-center">
                        View Details
                    </a>
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-full py-20 bg-white rounded-3xl border border-dashed border-brand-300 flex flex-col items-center justify-center text-center px-6">
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

    <!-- Details Modal Removed (Redirected to BookedDetails) -->

    <!-- Reschedule Modal -->
    @if($showRescheduleModal && $selectedAppointment)
    <div class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/60 backdrop-blur-sm">
        <div class="bg-white rounded-3xl shadow-2xl max-w-2xl w-full border border-brand-100 overflow-hidden transform transition-all duration-300 scale-100">
            <div class="border-b border-brand-100 px-6 py-5 flex items-center justify-between bg-gray-50/50">
                <h2 class="text-xl font-extrabold text-gray-900 tracking-tight">Reschedule Appointment</h2>
                <button
                    wire:click="closeModals()"
                    class="text-gray-400 hover:text-gray-600 transition-colors bg-transparent border-0 cursor-pointer p-0 shadow-none">
                    <span class="material-symbols-outlined text-[28px]">close</span>
                </button>
            </div>

            <div class="p-6 space-y-6">
                <!-- Week Navigator -->
                <div class="flex items-center justify-between py-2 border-b border-brand-100">
                    <button type="button" wire:click="prevWeek" @disabled($calendar_week_offset <= 0)
                        class="flex items-center gap-1.5 text-xs font-bold px-3 py-1.5 rounded-xl border border-brand-200 transition-all 
                        {{ $calendar_week_offset <= 0 ? 'text-gray-300 cursor-not-allowed bg-gray-50' : 'bg-white text-gray-900 hover:bg-gray-50 hover:border-brand-300' }}">
                        <span class="material-symbols-outlined text-[16px] leading-none">chevron_left</span>
                        Prev Week
                    </button>
                    <div class="text-center">
                        <span class="text-xs font-black text-gray-700">
                            @if($calendar_week_offset === 0) This Week
                            @elseif($calendar_week_offset === 1) Next Week
                            @else {{ $calendar_week_offset }} Weeks Ahead
                            @endif
                        </span>
                        @if($calendar_week_offset > 0)
                        <button type="button" wire:click="$set('calendar_week_offset', 0); $wire.generateAvailableDays()" class="ml-2 bg-transparent text-[9px] font-black text-blue-600 uppercase tracking-wider hover:text-blue-800 shadow-none hover:shadow-none p-0 inline-block border-0 cursor-pointer">Back to Now</button>
                        @endif
                    </div>
                    <button type="button" wire:click="nextWeek"
                        class="flex items-center gap-1.5 text-xs font-bold px-3 py-1.5 rounded-xl border border-brand-200 bg-white text-gray-900 hover:bg-gray-50 hover:border-brand-300 transition-all">
                        Next Week
                        <span class="material-symbols-outlined text-[16px] leading-none">chevron_right</span>
                    </button>
                </div>

                <!-- Date Cards -->
                <div>
                    <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-3">Select New Date</label>
                    <div class="grid grid-cols-5 gap-2.5">
                        @foreach($available_days as $index => $day)
                        <button type="button"
                            wire:click="{{ $day['slots_left'] > 0 ? 'selectRescheduleDate(' . $index . ')' : '' }}"
                            @disabled($day['slots_left'] <= 0)
                            class="flex flex-col items-center justify-center py-3 px-1.5 rounded-2xl border-2 transition-all transform active:scale-95 relative outline-none
                                {{ $rescheduleDate === $day['full']
                                    ? 'border-blue-500 bg-blue-500 text-white shadow-lg shadow-blue-100'
                                    : ($day['slots_left'] <= 0
                                        ? 'border-red-100 bg-red-50/50 cursor-not-allowed opacity-50'
                                        : 'border-brand-100 bg-gray-50/50 hover:bg-white hover:border-brand-300 hover:scale-[1.03] shadow-sm cursor-pointer') }}">

                            <span class="text-[9px] font-black uppercase tracking-widest mb-0.5
                                {{ $rescheduleDate === $day['full'] ? 'text-blue-100' : ($day['slots_left'] <= 0 ? 'text-red-300' : 'text-gray-400') }}">
                                {{ $day['month'] }}
                            </span>
                            <span class="text-xl font-black mb-0.5
                                {{ $rescheduleDate === $day['full'] ? 'text-white' : ($day['slots_left'] <= 0 ? 'text-red-300' : 'text-gray-900') }}">
                                {{ $day['date'] }}
                            </span>
                            <span class="text-[9px] font-bold mb-2
                                {{ $rescheduleDate === $day['full'] ? 'text-blue-200' : ($day['slots_left'] <= 0 ? 'text-red-300' : 'text-gray-500') }}">
                                {{ $day['day'] }}
                            </span>
                            <div class="flex items-center gap-0.5 py-0.5 px-1.5 rounded-full text-[8px] font-black uppercase
                                {{ $rescheduleDate === $day['full'] ? 'bg-white/20 text-white'
                                    : ($day['slots_left'] <= 0 ? 'bg-red-100 text-red-500'
                                    : ($day['slots_left'] <= 3 ? 'bg-orange-100 text-orange-600'
                                    : 'bg-green-100 text-green-700')) }}">
                                @if($day['slots_left'] <= 0)
                                    FULL
                                @elseif($day['slots_left'] === 1)
                                    1 LEFT
                                @else
                                    {{ $day['slots_left'] }} LEFT
                                @endif
                            </div>
                        </button>
                        @endforeach
                    </div>
                </div>

                <!-- Time Slots -->
                @php
                    $selectedDay = null;
                    if ($rescheduleDate) {
                        foreach ($available_days as $d) {
                            if ($d['full'] === $rescheduleDate) {
                                $selectedDay = $d;
                                break;
                            }
                        }
                    }
                @endphp
                @if($selectedDay)
                <div>
                    <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-3">Select New Time</label>
                    <div class="grid grid-cols-5 gap-2.5">
                        @foreach($available_slots as $slot)
                        @php
                        $bookedCount = $selectedDay['slot_status'][$slot] ?? 0;
                        $isFull = $bookedCount >= 1;
                        $isSelected = $rescheduleTime === $slot;
                        $spotsLeft = 1 - $bookedCount;
                        @endphp
                        <button type="button"
                            @if(!$isFull) wire:click="selectRescheduleTime('{{ $slot }}')" @endif
                            @disabled($isFull)
                            class="py-4 px-2 rounded-2xl border-2 font-black text-sm transition-all flex items-center justify-center gap-2 outline-none
                                {{ $isSelected
                                    ? 'border-blue-500 bg-white text-blue-700 shadow-md ring-2 ring-blue-100 scale-[1.02]'
                                    : ($isFull
                                        ? 'border-red-100 bg-red-50 text-red-300 cursor-not-allowed opacity-50'
                                        : 'border-brand-100 bg-gray-50/50 text-gray-500 hover:bg-white hover:border-brand-300 hover:scale-[1.02] cursor-pointer') }}">
                            @if($isSelected)
                            <span class="w-2 h-2 rounded-full bg-blue-500 inline-block animate-pulse"></span>
                            @endif
                            {{ $slot }}
                        </button>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Preview Selected Time -->
                @if($rescheduleDate && $rescheduleTime)
                <div class="bg-blue-50 border border-blue-100 rounded-2xl p-4 flex items-center gap-3">
                    <span class="material-symbols-outlined text-blue-600 text-[28px]">schedule</span>
                    <div>
                        <p class="text-[10px] text-blue-650 font-bold uppercase tracking-wider">New Appointment Time</p>
                        <p class="font-extrabold text-blue-900 text-sm">
                            {{ \Carbon\Carbon::parse($rescheduleDate)->format('M d, Y') }} at {{ \Carbon\Carbon::parse($rescheduleTime)->format('h:i A') }}
                        </p>
                    </div>
                </div>
                @endif
            </div>

            <div class="bg-gray-50 border-t border-brand-100 px-6 py-4 flex justify-end gap-3">
                <button
                    wire:click="closeModals()"
                    class="px-5 py-2.5 text-sm font-bold text-gray-700 bg-white border border-brand-300 rounded-xl hover:bg-gray-50 hover:border-brand-400 transition-all">
                    Cancel
                </button>
                <button
                    wire:click="saveReschedule()"
                    @disabled(!$rescheduleDate || !$rescheduleTime)
                    class="px-5 py-2.5 text-sm font-bold text-white bg-blue-600 rounded-xl hover:bg-blue-700 transition-all shadow-md shadow-blue-100 disabled:opacity-50 disabled:cursor-not-allowed">
                    Save Changes
                </button>
            </div>
        </div>
    </div>
    @endif

    <!-- Edit Modal -->
    @if($showEditModal && $selectedAppointment)
    <div class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black bg-opacity-50">
        <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full border border-brand-100 overflow-hidden">
            <div class="border-b border-brand-200 px-6 py-5 flex items-center justify-between bg-gray-50/50">
                <h2 class="text-xl font-bold text-gray-900">Edit Appointment</h2>
                <button
                    wire:click="closeModals()"
                    class="text-gray-400 hover:text-gray-600 transition-colors">
                    <span class="material-symbols-outlined text-[28px]">close</span>
                </button>
            </div>

            <div class="p-6 space-y-4">
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Device Brand <span class="text-red-500">*</span></label>
                    <input
                        type="text"
                        wire:model="editDeviceBrand"
                        placeholder="e.g., Apple, Samsung"
                        class="w-full px-4 py-2.5 border border-brand-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Device Model</label>
                    <input
                        type="text"
                        wire:model="editDeviceModel"
                        placeholder="e.g., iPhone 14, Galaxy S23"
                        class="w-full px-4 py-2.5 border border-brand-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Issue Category <span class="text-red-500">*</span></label>
                    <select
                        wire:model="editFaultCategory"
                        class="w-full px-4 py-2.5 border border-brand-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="">Select issue category</option>
                        <option value="Screen">Screen</option>
                        <option value="Battery">Battery</option>
                        <option value="Charging">Charging</option>
                        <option value="Software">Software</option>
                        <option value="Hardware">Hardware</option>
                        <option value="Water Damage">Water Damage</option>
                        <option value="Other">Other</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Description</label>
                    <textarea
                        wire:model="editDescription"
                        placeholder="Describe the issue in detail..."
                        rows="3"
                        class="w-full px-4 py-2.5 border border-brand-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent resize-none"></textarea>
                </div>
            </div>

            <div class="bg-gray-50 border-t border-brand-200 px-6 py-4 flex justify-end gap-3">
                <button
                    wire:click="closeModals()"
                    class="px-4 py-2 text-sm font-bold text-gray-700 bg-white border border-brand-300 rounded-lg hover:bg-gray-50 transition-colors">
                    Cancel
                </button>
                <button
                    wire:click="saveEdit()"
                    class="px-4 py-2 text-sm font-bold text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition-colors">
                    Save Changes
                </button>
            </div>
        </div>
    </div>
    @endif
</div>
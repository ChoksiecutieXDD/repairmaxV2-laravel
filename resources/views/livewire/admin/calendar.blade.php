<div class="w-full" wire:poll.10s>
    <!-- Header Section -->
    <div class="mb-8 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <div>
            <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">Appointment Calendar</h1>
            <p class="text-gray-500 mt-1">Track and manage the schedule for all repair appointments</p>
        </div>
    </div>

    <!-- Calendar Layout Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        
        <!-- Left: The Calendar Grid (8 cols) -->
        <div class="lg:col-span-8 bg-white rounded-3xl border border-gray-200 shadow-sm overflow-hidden flex flex-col justify-between">
            <div>
                <!-- Calendar Month Controls Header -->
                <div class="px-6 py-5 border-b border-gray-100 bg-gray-50 flex items-center justify-between">
                    <h2 class="text-xl font-extrabold text-gray-900 tracking-tight">{{ $monthName }}</h2>
                    <div class="flex gap-2">
                        <button wire:click="prevMonth" class="p-2.5 bg-white border border-gray-300 rounded-xl hover:bg-gray-50 hover:border-gray-400 active:scale-95 transition-all text-gray-700 flex items-center justify-center shrink-0 shadow-sm">
                            <span class="material-symbols-outlined text-[20px] font-bold">chevron_left</span>
                        </button>
                        <button wire:click="nextMonth" class="p-2.5 bg-white border border-gray-300 rounded-xl hover:bg-gray-50 hover:border-gray-400 active:scale-95 transition-all text-gray-700 flex items-center justify-center shrink-0 shadow-sm">
                            <span class="material-symbols-outlined text-[20px] font-bold">chevron_right</span>
                        </button>
                    </div>
                </div>

                <!-- Calendar Table Header (Weekdays) -->
                <div class="grid grid-cols-7 border-b border-gray-100 bg-white">
                    @foreach(['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'] as $dayName)
                        <div class="py-3 text-center text-xs font-bold text-gray-400 uppercase tracking-wider">
                            {{ $dayName }}
                        </div>
                    @endforeach
                </div>

                <!-- Calendar Monthly Cells Grid -->
                <div class="grid grid-cols-7 bg-gray-100 gap-[1px]">
                    @foreach($allDays as $day)
                        @php
                            $hasAppointments = isset($appointments[$day['date']]);
                            $isSelected = $selectedDate === $day['date'];
                            $isToday = $day['date'] === now()->format('Y-m-d');
                            
                            $cellBg = $day['isCurrentMonth'] 
                                ? ($isSelected ? 'bg-blue-50/50' : 'bg-white') 
                                : 'bg-gray-50/70 text-gray-400';
                                
                            $borderClass = $isSelected 
                                ? 'ring-2 ring-blue-600 ring-inset z-10' 
                                : ($isToday ? 'ring-2 ring-gray-900 ring-inset z-10' : '');
                        @endphp
                        
                        <div wire:click="selectDate('{{ $day['date'] }}')" 
                            class="min-h-[110px] {{ $cellBg }} {{ $borderClass }} p-2.5 transition-all duration-200 cursor-pointer hover:bg-blue-50/30 flex flex-col justify-between group relative">
                            
                            <!-- Day Number & Indicators -->
                            <div class="flex justify-between items-center">
                                <span class="text-xs font-bold 
                                    @if($isToday && !$isSelected) bg-gray-900 text-white w-6 h-6 rounded-full flex items-center justify-center @elseif($isSelected) text-blue-600 font-extrabold @elseif(!$day['isCurrentMonth']) text-gray-400 @else text-gray-900 @endif">
                                    {{ $day['day'] }}
                                </span>
                                
                                @if($hasAppointments)
                                    <span class="text-[10px] font-black bg-blue-100 text-blue-700 px-1.5 py-0.5 rounded-full shrink-0">
                                        {{ $appointments[$day['date']]->count() }}
                                    </span>
                                @endif
                            </div>

                            <!-- List of appointments for desktop -->
                            <div class="mt-2 flex-1 flex flex-col justify-end gap-1">
                                @if($hasAppointments)
                                    <div class="flex flex-col gap-1 overflow-hidden">
                                        @foreach($appointments[$day['date']]->take(2) as $app)
                                            @php
                                                $statusColor = match($app->status) {
                                                    'Completed' => 'bg-green-100 text-green-700 border-green-200',
                                                    'In Progress' => 'bg-orange-100 text-orange-700 border-orange-200',
                                                    'Ready for Pickup' => 'bg-blue-100 text-blue-700 border-blue-200',
                                                    'Scheduled' => 'bg-indigo-100 text-indigo-700 border-indigo-200',
                                                    'Pending' => 'bg-yellow-100 text-yellow-700 border-yellow-200',
                                                    'Cancelled' => 'bg-red-100 text-red-700 border-red-200',
                                                    default => 'bg-gray-100 text-gray-700 border-gray-200'
                                                };
                                            @endphp
                                            <span class="hidden md:inline-block text-[9px] font-extrabold px-1.5 py-0.5 rounded border {{ $statusColor }} truncate shadow-sm transition-transform group-hover:translate-x-0.5">
                                                {{ $app->device_brand }} - {{ $app->fault_category }}
                                            </span>
                                        @endforeach
                                        
                                        @if($appointments[$day['date']]->count() > 2)
                                            <span class="hidden md:block text-[8px] text-gray-500 font-bold text-center uppercase tracking-wider">
                                                +{{ $appointments[$day['date']]->count() - 2 }} more
                                            </span>
                                        @endif
                                        
                                        <!-- Mobile Dot Indicators -->
                                        <div class="flex md:hidden gap-0.5 justify-center mt-1">
                                            @foreach($appointments[$day['date']]->take(3) as $app)
                                                @php
                                                    $dotColor = match($app->status) {
                                                        'Completed' => 'bg-green-500',
                                                        'In Progress' => 'bg-orange-500',
                                                        'Ready for Pickup' => 'bg-blue-500',
                                                        'Scheduled' => 'bg-indigo-500',
                                                        'Pending' => 'bg-yellow-500',
                                                        'Cancelled' => 'bg-red-500',
                                                        default => 'bg-gray-500'
                                                    };
                                                @endphp
                                                <span class="w-1.5 h-1.5 rounded-full {{ $dotColor }}"></span>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            </div>

                        </div>
                    @endforeach
                </div>
            </div>
            
            <!-- Bottom Legend -->
            <div class="px-6 py-4 bg-gray-50 border-t border-gray-100 flex flex-wrap gap-4 items-center justify-start text-[11px] font-bold uppercase tracking-wider text-gray-400">
                <span class="text-gray-500 mr-2">Legend:</span>
                <span class="flex items-center gap-1.5"><span class="w-2.5 h-2.5 rounded-full bg-yellow-400 inline-block"></span> Pending</span>
                <span class="flex items-center gap-1.5"><span class="w-2.5 h-2.5 rounded-full bg-indigo-500 inline-block"></span> Scheduled</span>
                <span class="flex items-center gap-1.5"><span class="w-2.5 h-2.5 rounded-full bg-orange-500 inline-block"></span> In Progress</span>
                <span class="flex items-center gap-1.5"><span class="w-2.5 h-2.5 rounded-full bg-blue-500 inline-block"></span> Ready</span>
                <span class="flex items-center gap-1.5"><span class="w-2.5 h-2.5 rounded-full bg-green-500 inline-block"></span> Completed</span>
                <span class="flex items-center gap-1.5"><span class="w-2.5 h-2.5 rounded-full bg-red-500 inline-block"></span> Cancelled</span>
            </div>
        </div>
        
        <!-- Right: Day Details Agenda Panel (4 cols) -->
        <div class="lg:col-span-4 flex flex-col gap-6">
            
            <!-- Summary Info Box -->
            <div class="bg-gradient-to-r from-blue-500 to-indigo-600 rounded-3xl p-6 text-white shadow-md">
                <div class="flex items-center justify-between mb-4">
                    <span class="material-symbols-outlined text-[32px] font-black opacity-80">calendar_month</span>
                    <span class="text-xs uppercase font-mono tracking-widest bg-white/20 px-2.5 py-1 rounded-full">
                        {{ now()->format('Y') }}
                    </span>
                </div>
                <h3 class="text-xl font-black tracking-tight mb-1 text-white">Schedule Overview</h3>
                <p class="text-sm text-blue-100 leading-relaxed">Select a day on the calendar to view the full agenda details and manage repair tickets.</p>
            </div>

            <!-- Selected Day Agenda Card -->
            <div class="bg-white rounded-3xl border border-gray-200 shadow-sm overflow-hidden flex-1 flex flex-col">
                <div class="px-6 py-5 border-b border-gray-100 bg-gray-50 flex items-center justify-between">
                    <div>
                        <h3 class="text-lg font-extrabold text-gray-900 tracking-tight">Agenda Details</h3>
                        <p class="text-xs text-gray-500 font-bold uppercase tracking-wider mt-0.5">
                            {{ $selectedDate ? date('F d, Y', strtotime($selectedDate)) : 'No Date Selected' }}
                        </p>
                    </div>
                    <span class="material-symbols-outlined text-gray-400">event_note</span>
                </div>

                <div class="p-6 flex-1 overflow-y-auto space-y-4 max-h-[500px]">
                    @if($selectedDate)
                        @forelse($selectedDateAppointments as $app)
                            @php
                                $statusColor = match($app->status) {
                                    'Completed' => 'green',
                                    'In Progress' => 'orange',
                                    'Ready for Pickup' => 'blue',
                                    'Scheduled' => 'indigo',
                                    'Pending' => 'yellow',
                                    'Cancelled' => 'red',
                                    default => 'gray'
                                };
                                $statusBg = "bg-{$statusColor}-50 text-{$statusColor}-700 border-{$statusColor}-100";
                            @endphp
                            
                            <div class="p-4 rounded-2xl border border-gray-200 hover:border-blue-400 hover:shadow-md transition-all duration-300 flex flex-col justify-between gap-4 group">
                                <div class="flex justify-between items-start gap-2">
                                    <div class="min-w-0">
                                        <div class="flex items-center gap-2 mb-1.5 flex-wrap">
                                            <span class="inline-flex items-center px-2 py-0.5 {{ $statusBg }} border rounded-lg text-[10px] font-bold uppercase tracking-wide">
                                                {{ $app->status }}
                                            </span>
                                            <span class="text-xs font-mono font-bold text-gray-400">
                                                {{ date('h:i A', strtotime($app->pref_time)) }}
                                            </span>
                                        </div>
                                        <h4 class="font-extrabold text-gray-900 group-hover:text-blue-600 transition-colors text-base leading-snug truncate">
                                            {{ $app->device_brand }} {{ $app->device_model }}
                                        </h4>
                                        <p class="text-xs text-gray-500 font-semibold mt-1">
                                            {{ $app->fault_category }}
                                        </p>
                                    </div>
                                </div>
                                
                                <div class="border-t border-gray-100 pt-3 flex items-center justify-between text-xs">
                                    <div class="flex items-center gap-2 text-gray-600 min-w-0">
                                        <span class="material-symbols-outlined text-[16px] shrink-0 text-gray-400">person</span>
                                        <span class="truncate font-medium text-gray-700">{{ $app->user?->getFullName() ?? 'Guest Customer' }}</span>
                                    </div>
                                    <div class="flex items-center gap-3">
                                        <button wire:click="openReschedule({{ $app->id }})" class="inline-flex items-center gap-1 font-bold text-orange-600 hover:text-orange-800 tracking-tight transition-colors shrink-0 bg-transparent border-0 cursor-pointer p-0 shadow-none">
                                            <span class="material-symbols-outlined text-[15px]">calendar_today</span>
                                            <span>Reschedule</span>
                                        </button>
                                        <a href="{{ route('admin.appointment.details', ['id' => $app->id]) }}" class="inline-flex items-center gap-1 font-bold text-blue-600 hover:text-blue-800 tracking-tight transition-colors shrink-0">
                                            <span>Details</span>
                                            <span class="material-symbols-outlined text-[14px]">arrow_forward</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="py-12 text-center text-gray-500">
                                <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <span class="material-symbols-outlined text-gray-300 text-4xl">event_busy</span>
                                </div>
                                <h4 class="font-extrabold text-gray-900">No Appointments</h4>
                                <p class="text-sm text-gray-400 mt-1 max-w-[200px] mx-auto leading-normal">This day is clear! No scheduled repairs.</p>
                            </div>
                        @endforelse
                    @else
                        <div class="py-12 text-center text-gray-500">
                            <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4">
                                <span class="material-symbols-outlined text-gray-300 text-4xl">click_to_select</span>
                            </div>
                            <h4 class="font-extrabold text-gray-900">Select a Date</h4>
                            <p class="text-sm text-gray-400 mt-1 max-w-[200px] mx-auto leading-normal">Click any day on the calendar to view the scheduled repairs.</p>
                        </div>
                    @endif
                </div>
            </div>

        </div>

    </div>

    <!-- Reschedule / Move Appointment Modal -->
    @if($showRescheduleModal && $selectedAppointment)
    <div class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/60 backdrop-blur-sm">
        <div class="bg-white rounded-3xl shadow-2xl max-w-2xl w-full border border-gray-100 overflow-hidden transform transition-all duration-300 scale-100">
            <div class="border-b border-gray-100 px-6 py-5 flex items-center justify-between bg-gray-50/50">
                <h2 class="text-xl font-extrabold text-gray-900 tracking-tight">Move / Reschedule</h2>
                <button
                    wire:click="closeModals()"
                    class="text-gray-400 hover:text-gray-600 transition-colors bg-transparent border-0 cursor-pointer p-0 shadow-none">
                    <span class="material-symbols-outlined text-[28px]">close</span>
                </button>
            </div>

            <div class="p-6 space-y-6">
                <!-- Week Navigator -->
                <div class="flex items-center justify-between py-2 border-b border-gray-100">
                    <button type="button" wire:click="prevWeek" @disabled($calendar_week_offset <= 0)
                        class="flex items-center gap-1.5 text-xs font-bold px-3 py-1.5 rounded-xl border border-gray-200 transition-all 
                        {{ $calendar_week_offset <= 0 ? 'text-gray-300 cursor-not-allowed bg-gray-50' : 'bg-white text-gray-900 hover:bg-gray-50 hover:border-gray-300' }}">
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
                        class="flex items-center gap-1.5 text-xs font-bold px-3 py-1.5 rounded-xl border border-gray-200 bg-white text-gray-900 hover:bg-gray-50 hover:border-gray-300 transition-all">
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
                                        : 'border-gray-100 bg-gray-50/50 hover:bg-white hover:border-gray-300 hover:scale-[1.03] shadow-sm cursor-pointer') }}">

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
                                        : 'border-gray-100 bg-gray-50/50 text-gray-500 hover:bg-white hover:border-gray-300 hover:scale-[1.02] cursor-pointer') }}">
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
                        <p class="text-[10px] text-blue-600 font-bold uppercase tracking-wider">New Appointment Time</p>
                        <p class="font-extrabold text-blue-900 text-sm">
                            {{ \Carbon\Carbon::parse($rescheduleDate)->format('M d, Y') }} at {{ \Carbon\Carbon::parse($rescheduleTime)->format('h:i A') }}
                        </p>
                    </div>
                </div>
                @endif
            </div>

            <div class="bg-gray-50 border-t border-gray-100 px-6 py-4 flex justify-end gap-3">
                <button
                    wire:click="closeModals()"
                    class="px-5 py-2.5 text-sm font-bold text-gray-700 bg-white border border-gray-300 rounded-xl hover:bg-gray-50 hover:border-gray-400 transition-all">
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
</div>

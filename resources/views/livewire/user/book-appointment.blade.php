<div class="w-full" x-data="{ infoModal: false, calendarModal: false }">

    <!-- ===== INFO MODAL ===== -->
    <div x-show="infoModal"
        class="fixed inset-0 z-[100] flex items-center justify-center p-4 sm:p-6 bg-gray-900/60 backdrop-blur-md"
        x-cloak
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0">
        <div class="fixed inset-0" @click="infoModal = false"></div>
        <div class="bg-white rounded-[2.5rem] shadow-2xl max-w-2xl w-full relative overflow-hidden flex flex-col max-h-[90vh] transform transition-all"
            x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0 scale-95 translate-y-4"
            x-transition:enter-end="opacity-100 scale-100 translate-y-0"
            x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100 scale-100 translate-y-0"
            x-transition:leave-end="opacity-0 scale-95 translate-y-4">
            <!-- Modal Header -->
            <div class="px-8 pt-12 pb-6 flex flex-col items-center text-center bg-white relative">
                <button type="button" @click="infoModal = false"
                    class="absolute top-6 right-6 p-2 bg-gray-50 text-gray-400 hover:text-gray-900 hover:bg-gray-100 rounded-[1.25rem] transition-all focus:outline-none focus:ring-0 group">
                    <span class="material-symbols-outlined text-[20px] leading-none group-hover:rotate-90 transition-transform duration-300">close</span>
                </button>
                <div class="w-16 h-16 bg-blue-50 text-blue-600 rounded-[1.5rem] flex items-center justify-center mb-5 shadow-sm border border-blue-100/50">
                    <span class="material-symbols-outlined text-[32px] leading-none">info</span>
                </div>
                <h3 class="text-2xl font-black text-gray-900 tracking-tighter">Repair Guidelines</h3>
                <p class="text-sm text-gray-400 font-medium mt-2">Essential steps for a smooth repair process</p>
            </div>
            <div class="p-8 overflow-y-auto space-y-10">
                <section>
                    <h4 class="text-sm font-black text-gray-400 uppercase tracking-widest mb-6 px-1">What Happens Next?</h4>
                    <ul class="space-y-6">
                        <li class="flex gap-4 items-start">
                            <span class="flex items-center justify-center w-8 h-8 rounded-full bg-blue-600 text-white font-bold shadow-lg shadow-blue-200 shrink-0 mt-0.5">1</span>
                            <div>
                                <p class="font-bold text-gray-900">Reserve your Slot</p>
                                <p class="text-sm text-gray-500 mt-1">Submit this form to reserve your drop-off time. You'll receive a unique tracking code (e.g., RM-XXXXX).</p>
                            </div>
                        </li>
                        <li class="flex gap-4 items-start">
                            <span class="flex items-center justify-center w-8 h-8 rounded-full bg-blue-600 text-white font-bold shadow-lg shadow-blue-200 shrink-0 mt-0.5">2</span>
                            <div>
                                <p class="font-bold text-gray-900">Drop-off Device</p>
                                <p class="text-sm text-gray-500 mt-1">Visit our shop at the scheduled time. Bring your device and show your tracking code to our receptionist.</p>
                            </div>
                        </li>
                        <li class="flex gap-4 items-start">
                            <span class="flex items-center justify-center w-8 h-8 rounded-full bg-blue-600 text-white font-bold shadow-lg shadow-blue-200 shrink-0 mt-0.5">3</span>
                            <div>
                                <p class="font-bold text-gray-900">Professional Diagnostic</p>
                                <p class="text-sm text-gray-500 mt-1">We'll run a quick diagnostic and provide a final, binding quote before starting any work.</p>
                            </div>
                        </li>
                    </ul>
                </section>
            </div>
            <div class="p-6 bg-gray-50 border-t border-gray-100">
                <button type="button" @click="infoModal = false" class="w-full py-4 bg-gray-900 text-white font-bold rounded-[1.25rem] hover:bg-black transition-all">Got it, thanks!</button>
            </div>
        </div>
    </div>

    <!-- ===== LIVE AVAILABILITY CALENDAR MODAL ===== -->
    <div x-show="calendarModal"
        class="fixed inset-0 z-[100] flex items-center justify-center p-4 sm:p-6 bg-gray-900/60 backdrop-blur-md"
        x-cloak
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0">
        <div class="fixed inset-0" @click="calendarModal = false"></div>
        <div class="bg-white rounded-[2.5rem] shadow-2xl max-w-4xl w-full relative overflow-hidden flex flex-col max-h-[92vh] transform transition-all"
            x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0 scale-95 translate-y-10"
            x-transition:enter-end="opacity-100 scale-100 translate-y-0"
            x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100 scale-100 translate-y-0"
            x-transition:leave-end="opacity-0 scale-95 translate-y-10">

            <!-- Modal Header -->
            <!-- Modal Header -->
            <div class="px-8 pt-12 pb-8 flex flex-col items-center text-center bg-white relative border-b border-gray-50">
                <button type="button" @click="calendarModal = false"
                    class="absolute top-6 right-6 p-2 bg-gray-50 text-gray-400 hover:text-gray-900 hover:bg-gray-100 rounded-[1.25rem] transition-all focus:outline-none focus:ring-0 group">
                    <span class="material-symbols-outlined text-[20px] leading-none group-hover:rotate-90 transition-transform duration-300">close</span>
                </button>
                <div class="w-16 h-16 bg-blue-50 text-blue-600 rounded-[1.5rem] flex items-center justify-center mb-5 shadow-sm border border-blue-100/50">
                    <span class="material-symbols-outlined text-[32px] leading-none">calendar_month</span>
                </div>
                <h3 class="text-2xl font-black text-gray-900 tracking-tighter">Live Availability Calendar</h3>
                <p class="text-sm text-gray-400 font-medium mt-2">Click any open slot to auto-fill your selection</p>
            </div>

            <!-- Week Navigator -->
            <div class="flex items-center justify-between px-8 py-4 bg-gray-50/50 border-b border-gray-100">
                <button type="button" wire:click="prevWeek" @disabled($calendar_week_offset <=0)
                    class="flex items-center gap-2 text-sm font-bold px-4 py-2 rounded-[1.25rem] border border-gray-200 transition-all 
                    {{ $calendar_week_offset <= 0 ? 'text-gray-300 cursor-not-allowed bg-gray-50' : 'bg-white text-gray-900 hover:bg-gray-50 hover:border-gray-300 hover:shadow-sm' }}">
                    <span class="material-symbols-outlined text-[18px] leading-none">chevron_left</span>
                    Previous Week
                </button>
                <div class="text-center">
                    <span class="text-sm font-black text-gray-700">
                        @if($calendar_week_offset === 0) This Week
                        @elseif($calendar_week_offset === 1) Next Week
                        @else {{ $calendar_week_offset }} Weeks Ahead
                        @endif
                    </span>
                    @if($calendar_week_offset > 0)
                    <button type="button" wire:click="$set('calendar_week_offset', 0); $wire.generateAvailableDays()" class="ml-2 bg-transparent text-[10px] font-black text-blue-600 uppercase tracking-wider hover:text-blue-800 shadow-none hover:shadow-none translate-y-0 hover:translate-y-0">Back to Now</button>
                    @endif
                </div>
                <button type="button" wire:click="nextWeek"
                    class="flex items-center gap-2 text-sm font-bold px-4 py-2 rounded-[1.25rem] border border-gray-200 bg-white text-gray-900 hover:bg-gray-50 hover:border-gray-300 hover:shadow-sm transition-all">
                    Next Week
                    <span class="material-symbols-outlined text-[18px] leading-none">chevron_right</span>
                </button>
            </div>

            <div class="p-8 overflow-y-auto">
                <!-- Legend -->
                <div class="flex items-center gap-6 mb-6 px-1">
                    <div class="flex items-center gap-2 text-xs font-bold text-gray-500"><span class="w-2.5 h-2.5 rounded-full bg-green-400 inline-block"></span> Available</div>
                    <div class="flex items-center gap-2 text-xs font-bold text-gray-500"><span class="w-2.5 h-2.5 rounded-full bg-red-400 inline-block"></span> Booked / Full</div>
                    <div class="flex items-center gap-2 text-xs font-bold text-gray-500"><span class="w-2.5 h-2.5 rounded-full bg-blue-500 inline-block"></span> Your Selection</div>
                </div>

                <!-- Calendar Table -->
                <div class="overflow-x-auto">
                    <table class="w-full border-collapse">
                        <thead>
                            <tr>
                                <th class="w-32 pb-4 pr-4 text-left text-xs font-black text-gray-400 uppercase tracking-widest">Time</th>
                                @foreach($available_days as $day)
                                <th class="pb-4 px-2 text-center min-w-[110px]">
                                    <div class="text-[10px] font-black text-gray-400 uppercase tracking-widest">{{ $day['month'] }}</div>
                                    <div class="text-2xl font-black text-gray-900 leading-tight">{{ $day['date'] }}</div>
                                    <div class="text-[11px] font-bold text-gray-500">{{ $day['day'] }}</div>
                                    @if($day['slots_left'] <= 0)
                                        <div class="inline-flex items-center gap-1 mt-1 px-2 py-0.5 rounded-full bg-red-100 text-red-500 text-[9px] font-black uppercase"><span class="w-1 h-1 bg-red-400 rounded-full animate-pulse"></span> FULL
                </div>
                @elseif($day['slots_left'] <= 1)
                    <div class="inline-flex items-center gap-1 mt-1 px-2 py-0.5 rounded-full bg-orange-100 text-orange-500 text-[9px] font-black uppercase"><span class="w-1 h-1 bg-orange-400 rounded-full animate-pulse"></span> {{ $day['slots_left'] }} LEFT
            </div>
            @else
            <div class="inline-flex items-center gap-1 mt-1 px-2 py-0.5 rounded-full bg-green-100 text-green-600 text-[9px] font-black uppercase"><span class="w-1 h-1 bg-green-400 rounded-full"></span> {{ $day['slots_left'] }} LEFT</div>
            @endif
            </th>
            @endforeach
            </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @foreach($available_slots as $slot)
                <tr>
                    <td class="py-2 pr-4 text-xs font-bold text-gray-500 whitespace-nowrap">{{ $slot }}</td>
                    @foreach($available_days as $dayIndex => $day)
                    @php
                    $bookedCount = $day['slot_status'][$slot] ?? 0;
                    $isBooked = $bookedCount > 0;
                    $isSelected = ($selected_index === $dayIndex && $pref_time === $slot);
                    @endphp
                    <td class="py-2 px-2 text-center">
                        <button type="button"
                            @if(!$isBooked)
                            wire:click="selectDateAndTime({{ $dayIndex }}, '{{ $slot }}')"
                            @click="calendarModal = false"
                            @endif
                            class="w-full h-11 rounded-[1.25rem] border-2 text-[10px] font-black uppercase tracking-wider transition-all flex items-center justify-center gap-1.5
                                                {{ $isSelected ? 'bg-blue-500 border-blue-500 text-white shadow-lg shadow-blue-200'
                                                    : ($isBooked ? 'bg-red-50 border-red-100 text-red-300 cursor-not-allowed'
                                                    : 'bg-gray-50 border-gray-100 text-gray-400 hover:bg-green-50 hover:border-green-300 hover:text-green-600 cursor-pointer') }}">
                            @if($isSelected)
                            <span class="material-symbols-outlined text-[14px] leading-none">check</span> Set
                            @elseif($isBooked)
                            <span class="w-1.5 h-1.5 bg-red-400 rounded-full inline-block"></span> Full
                            @else
                            <span class="w-1.5 h-1.5 bg-green-400 rounded-full inline-block"></span> Open
                            @endif
                        </button>
                    </td>
                    @endforeach
                </tr>
                @endforeach
            </tbody>
            </table>
        </div>
    </div>

    <div class="p-6 bg-gray-50 border-t border-gray-100 flex justify-between items-center">
        <p class="text-xs text-gray-400 font-medium">Selecting a slot closes this modal and fills in your booking.</p>
        <button type="button" @click="calendarModal = false" class="px-6 py-3 bg-gray-900 text-white font-bold rounded-[1.25rem] hover:bg-black transition-all text-sm">Close</button>
    </div>
</div>
</div>

<div class="mb-8">
    <div class="flex items-center gap-3">
        <h1 class="text-3xl font-bold text-gray-900 tracking-tight">Book a Repair</h1>
        <button type="button" @click="infoModal = true"
            class="p-0 bg-transparent text-gray-300 hover:text-blue-600 transition-all transform hover:scale-110 active:scale-95 outline-none ring-0 focus:ring-0 focus:outline-none flex items-center justify-center -translate-y-[4px]"
            title="View Guidelines">
            <span class="material-symbols-outlined text-[28px] leading-none">info</span>
        </button>
    </div>
    <p class="text-gray-500 mt-2 font-medium">Provide details about your device and schedule a drop-off time.</p>
</div>

<!-- ===== BOOKING SUMMARY (top, full-width) ===== -->
<div class="bg-white border border-gray-200 shadow-sm rounded-2xl p-6 mb-6">
    <div class="mb-6 pb-3 border-b border-gray-100">
        <h3 class="font-bold text-gray-900">Booking Summary</h3>
    </div>

    <div class="grid grid-cols-2 md:grid-cols-5 gap-4 text-sm mb-5">
        <!-- Booking ID -->
        <div class="bg-blue-50 rounded-xl p-3 border border-blue-100">
            <p class="text-[10px] font-black text-blue-400 uppercase tracking-wider mb-1">Booking ID</p>
            <p class="font-bold text-blue-700 text-xs leading-snug">
                @if($pref_date)
                    {{ $tracking_code }}
                @else
                    <span class="text-blue-300 font-normal italic">Select a date</span>
                @endif
            </p>
        </div>
        <!-- Device -->
        <div class="bg-gray-50 rounded-xl p-3 border border-gray-100">
            <p class="text-[10px] font-black text-gray-400 uppercase tracking-wider mb-1">Device</p>
            <p class="font-bold text-gray-900 text-xs leading-snug">
                @if($device_brand || $device_model)
                {{ $device_brand }} {{ $device_model }}
                @else
                <span class="text-gray-300 font-normal italic">Not set</span>
                @endif
            </p>
        </div>
        <!-- Issue -->
        <div class="bg-gray-50 rounded-xl p-3 border border-gray-100">
            <p class="text-[10px] font-black text-gray-400 uppercase tracking-wider mb-1">Issue</p>
            <p class="font-bold text-gray-900 text-xs leading-snug">
                @if($fault_category)
                {{ $fault_category }}
                @else
                <span class="text-gray-300 font-normal italic">Not set</span>
                @endif
            </p>
        </div>
        <!-- Date & Time -->
        <div class="bg-gray-50 rounded-xl p-3 border border-gray-100">
            <p class="text-[10px] font-black text-gray-400 uppercase tracking-wider mb-1">Date & Time</p>
            <p class="font-bold text-gray-900 text-xs leading-snug">
                @if($pref_date && $pref_time)
                {{ \Carbon\Carbon::parse($pref_date)->format('M d, Y') }}<br>
                <span class="text-gray-500 font-medium">{{ $pref_time }}</span>
                @elseif($pref_date)
                {{ \Carbon\Carbon::parse($pref_date)->format('M d, Y') }}
                @else
                <span class="text-gray-300 font-normal italic">Not set</span>
                @endif
            </p>
        </div>
        <!-- Estimated Price -->
        <div class="rounded-xl p-3 border
                @if($fault_category && ($fault_catalogue[$fault_category]['price'] ?? null))
                    bg-blue-50 border-blue-100
                @else
                    bg-gray-50 border-gray-100
                @endif">
            <p class="text-[10px] font-black uppercase tracking-wider mb-1
                    @if($fault_category && ($fault_catalogue[$fault_category]['price'] ?? null)) text-blue-400 @else text-gray-400 @endif">Est. Price</p>
            @php
            $summaryFaultInfo = $fault_catalogue[$fault_category] ?? null;
            $summaryPrice = $summaryFaultInfo['price'] ?? null;
            @endphp
            @if($fault_category && $summaryPrice)
            <p class="font-black text-blue-700 text-base leading-none">₱{{ number_format($summaryPrice) }}</p>
            <p class="text-[9px] text-blue-400 mt-1">Starting from</p>
            @elseif($fault_category)
            <p class="font-bold text-gray-600 text-xs">After inspection</p>
            @else
            <p class="text-gray-300 font-normal italic text-xs">Not set</p>
            @endif
        </div>
    </div>

    <!-- Diagnostic Fee Note -->
    <div class="flex items-center gap-2 text-xs text-gray-400 bg-gray-50 rounded-xl px-4 py-2.5 border border-gray-100">
        <span class="material-symbols-outlined text-[16px] leading-none text-gray-400 shrink-0">info</span>
        <span class="leading-none">A <strong class="text-gray-500">₱150 diagnostic fee</strong> applies if you decline the repair quote after inspection.</span>
    </div>
</div>

<!-- ===== MAIN FORM (full-width single column) ===== -->
<div class="">
    <div class="bg-white border border-gray-200 shadow-sm rounded-2xl p-6 md:p-10 mb-8">
        <form wire:submit="submit" class="space-y-12">

            <!-- Device Information -->
            <section>
                <h3 class="text-lg font-bold text-gray-900 border-b border-gray-100 pb-3 mb-6 flex items-center gap-2.5">
                    <span class="material-symbols-outlined text-[20px] leading-none text-blue-500 bg-blue-50 p-1.5 rounded-xl shrink-0 transform translate-y-[1px]">devices</span>
                    <span class="leading-none">Device Information</span>
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label for="device_brand" class="block text-sm font-bold text-gray-800 mb-2 ml-1">Brand</label>
                        <select id="device_brand" wire:model.live="device_brand" class="w-full px-4 py-3.5 border border-gray-200 rounded-[1.25rem] bg-gray-50/50 focus:bg-white focus:outline-none focus:border-blue-400 focus:ring-4 focus:ring-blue-100 transition-all text-sm font-medium" required>
                            <option value="" disabled selected>Select Brand</option>
                            @foreach($this->brands as $brand)
                                <option value="{{ $brand->name }}">{{ $brand->name }}</option>
                            @endforeach
                        </select>
                        @error('device_brand') <span class="text-xs text-red-500 mt-1 block ml-1">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label for="device_model" class="block text-sm font-bold text-gray-800 mb-2 ml-1">Exact Model</label>
                        <select id="device_model" wire:model="device_model" class="w-full px-4 py-3.5 border border-gray-200 rounded-[1.25rem] bg-gray-50/50 focus:bg-white focus:outline-none focus:border-blue-400 focus:ring-4 focus:ring-blue-100 transition-all text-sm font-medium" required {{ !$device_brand ? 'disabled' : '' }}>
                            <option value="" disabled selected>{{ !$device_brand ? 'Select brand first' : 'Select Model' }}</option>
                            @foreach($this->models as $model)
                                <option value="{{ $model->name }}">{{ $model->name }}</option>
                            @endforeach
                            <option value="Other">Other</option>
                        </select>
                        @error('device_model') <span class="text-xs text-red-500 mt-1 block ml-1">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- Fault Category with prices -->
                <div>
                    <label for="fault_category" class="block text-sm font-bold text-gray-800 mb-2 ml-1">Fault / Issue Type</label>
                    <select id="fault_category" wire:model.live="fault_category" class="w-full px-4 py-3.5 border border-gray-200 rounded-[1.25rem] bg-gray-50/50 focus:bg-white focus:outline-none focus:border-blue-400 focus:ring-4 focus:ring-blue-100 transition-all text-sm font-medium" required>
                        <option value="" disabled selected>Select the primary issue…</option>
                        @foreach($this->faultTypes as $fault)
                            <option value="{{ $fault->name }}">
                                {{ $fault->name }} — ₱{{ number_format($fault->base_price, 2) }}
                            </option>
                        @endforeach
                    </select>
                    @error('fault_category') <span class="text-xs text-red-500 mt-1 block ml-1">{{ $message }}</span> @enderror

                    @if($fault_category)
                    @php $selectedFault = \App\Models\FaultType::where('name', $fault_category)->first(); @endphp
                    @if($selectedFault)
                    <div class="mt-3 flex items-center gap-2.5 px-4 py-2.5 bg-blue-50 border border-blue-100 rounded-xl">
                        <span class="material-symbols-outlined text-[18px] leading-none text-blue-500 shrink-0">sell</span>
                        <span class="text-sm font-bold text-blue-700 leading-none">
                            Est. starting price:
                            <span class="text-blue-600">₱{{ number_format($selectedFault->base_price, 2) }}</span>
                        </span>
                        <span class="text-xs text-blue-400 leading-none">· May vary</span>
                    </div>
                    @endif
                    @endif
                </div>
            </section>

            <!-- Issue Description -->
            <section>
                <h3 class="text-lg font-bold text-gray-900 border-b border-gray-100 pb-3 mb-6 flex items-center gap-2.5">
                    <span class="material-symbols-outlined text-[20px] leading-none text-blue-500 bg-blue-50 p-1.5 rounded-xl shrink-0 transform translate-y-[1px]">description</span>
                    <span class="leading-none">Issue Description</span>
                </h3>
                <div class="mb-8">
                    <label for="description" class="block text-sm font-bold text-gray-800 mb-2 ml-1">Describe the problem in detail</label>
                    <textarea id="description" wire:model="description" rows="4" placeholder="How did it happen? Are there any secondary issues?" class="w-full px-4 py-3.5 border border-gray-200 rounded-[1.25rem] bg-gray-50/50 focus:bg-white focus:outline-none focus:border-blue-400 focus:ring-4 focus:ring-blue-100 transition-all text-sm font-medium resize-none" required></textarea>
                    @error('description') <span class="text-xs text-red-500 mt-1 block ml-1">{{ $message }}</span> @enderror
                </div>

                <!-- Photo Upload -->
                <div>
                    <label class="block text-sm font-bold text-gray-800 mb-4 ml-1">Upload Photos of Damage <span class="text-gray-400 font-normal">(Max 5)</span></label>
                    <div class="grid grid-cols-5 gap-3">
                        @for ($i = 0; $i < 5; $i++)
                            <div class="aspect-square relative group">
                            @if(isset($photos[$i]))
                            <div class="w-full h-full rounded-2xl overflow-hidden border-2 border-blue-100 shadow-md relative">
                                <img src="{{ $photos[$i]->temporaryUrl() }}" class="w-full h-full object-cover">
                                <div class="absolute inset-0 bg-black/20 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                                <button type="button" wire:click="$set('photos.{{ $i }}', null)"
                                    class="absolute top-2 right-2 bg-red-500 text-white w-6 h-6 rounded-full shadow-xl flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all">
                                    <span class="material-symbols-outlined text-[14px] leading-none">close</span>
                                </button>
                            </div>
                            @else
                            <label class="w-full h-full flex flex-col items-center justify-center border-2 border-dashed border-gray-200 rounded-[1.25rem] bg-gray-50/50 hover:bg-white hover:border-blue-400 transition-all cursor-pointer group hover:shadow-lg transform hover:-translate-y-0.5">
                                <input type="file" wire:model="photos.{{ $i }}" class="hidden" accept="image/*">
                                <span class="material-symbols-outlined text-[28px] leading-none text-gray-300 group-hover:text-blue-400 transition-colors">add_a_photo</span>
                                <span class="text-[9px] font-black text-gray-400 mt-1.5 group-hover:text-blue-500 uppercase">Slot {{ $i + 1 }}</span>
                            </label>
                            @endif
                            <div wire:loading wire:target="photos.{{ $i }}" class="absolute inset-0 bg-white/80 backdrop-blur-[2px] rounded-2xl flex items-center justify-center z-10">
                                <span class="material-symbols-outlined animate-spin text-blue-600 text-2xl leading-none">progress_activity</span>
                            </div>
                    </div>
                    @endfor
                </div>
                <p class="text-[11px] text-gray-400 mt-3 px-1 font-medium flex items-center gap-1.5">
                    <span class="material-symbols-outlined text-[14px] leading-none text-blue-400 shrink-0">tips_and_updates</span>
                    <span class="leading-none">Multi-angle photos help our technicians give you a more precise quote.</span>
                </p>
                @error('photos.*') <span class="text-xs text-red-500 mt-1 block ml-1">{{ $message }}</span> @enderror
    </div>
    </section>

    <!-- Schedule Drop-off -->
    <section>
        <div class="flex items-center justify-between gap-3 border-b border-gray-100 pb-3 mb-6">
            <h3 class="text-lg font-bold text-gray-900 flex items-center gap-2.5">
                <span class="material-symbols-outlined text-[20px] leading-none text-blue-500 bg-blue-50 p-1.5 rounded-xl shrink-0 transform translate-y-[1px]">calendar_month</span>
                <span class="leading-none">Schedule Drop-off</span>
            </h3>
            <button type="button" @click="calendarModal = true"
                class="w-8 h-8 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center hover:bg-blue-600 hover:text-white transition-all transform hover:scale-110 active:scale-95 shadow-sm shrink-0"
                title="Open Live Availability Calendar">
                <span class="material-symbols-outlined text-[18px] leading-none">open_in_full</span>
            </button>
        </div>

        <div class="space-y-8">
            <!-- Date Cards -->
            <div>
                <label class="block text-sm font-bold text-gray-800 mb-4 ml-1">Select Available Date</label>
                <div class="grid grid-cols-5 gap-3">
                    @foreach($available_days as $index => $day)
                    <button type="button"
                        wire:click="{{ $day['slots_left'] > 0 ? 'selectDate(' . $index . ')' : '' }}"
                        @disabled($day['slots_left'] <=0)
                        class="flex flex-col items-center justify-center py-4 px-2 rounded-[1.25rem] border-2 transition-all transform active:scale-95 relative
                                            {{ $selected_index === $index
                                                ? 'border-blue-500 bg-blue-500 shadow-xl shadow-blue-200'
                                                : ($day['slots_left'] <= 0
                                                    ? 'border-red-100 bg-red-50 cursor-not-allowed opacity-50'
                                                    : 'border-gray-100 bg-gray-50/50 hover:bg-white hover:border-gray-300 hover:scale-[1.03] shadow-sm cursor-pointer') }}">

                        <span class="text-[9px] font-black uppercase tracking-widest mb-0.5
                                                {{ $selected_index === $index ? 'text-blue-100' : ($day['slots_left'] <= 0 ? 'text-red-300' : 'text-gray-400') }}">
                            {{ $day['month'] }}
                        </span>
                        <span class="text-2xl font-black mb-0.5
                                                {{ $selected_index === $index ? 'text-white' : ($day['slots_left'] <= 0 ? 'text-red-300' : 'text-gray-900') }}">
                            {{ $day['date'] }}
                        </span>
                        <span class="text-[10px] font-bold mb-2
                                                {{ $selected_index === $index ? 'text-blue-200' : ($day['slots_left'] <= 0 ? 'text-red-300' : 'text-gray-500') }}">
                            {{ $day['day'] }}
                        </span>
                        <div class="flex items-center gap-1 py-0.5 px-2 rounded-full text-[8px] font-black uppercase
                                                {{ $selected_index === $index ? 'bg-white/25 text-white'
                                                    : ($day['slots_left'] <= 0 ? 'bg-red-100 text-red-400'
                                                    : ($day['slots_left'] <= 1 ? 'bg-orange-100 text-orange-600'
                                                    : 'bg-green-100 text-green-700')) }}">
                            @if($day['slots_left'] <= 0)
                                <span class="w-1 h-1 bg-red-400 rounded-full animate-pulse"></span> FULL
                                @elseif($day['slots_left'] <= 1)
                                    <span class="w-1 h-1 bg-orange-400 rounded-full animate-pulse"></span> 1 SLOT
                                    @else
                                    <span class="w-1 h-1 bg-green-400 rounded-full"></span> {{ $day['slots_left'] }}
                                    @endif
                        </div>
                    </button>
                    @endforeach
                </div>
                @error('pref_date') <span class="text-xs text-red-500 mt-2 block ml-1">{{ $message }}</span> @enderror
            </div>

            <!-- Time Slots -->
            @if($selected_index !== null)
            @php $selectedDay = $available_days[$selected_index] ?? null; @endphp
            @if($selectedDay)
            <div>
                <label class="block text-sm font-bold text-gray-800 mb-4 ml-1">Select Preferred Time Slot</label>
                <div class="grid grid-cols-5 gap-3">
                    @foreach($available_slots as $slot)
                    @php
                    $bookedCount = $selectedDay['slot_status'][$slot] ?? 0;
                    $isBooked = $bookedCount > 0;
                    $isSelected = $pref_time === $slot;
                    @endphp
                    <button type="button"
                        @if(!$isBooked) wire:click="selectTime('{{ $slot }}')" @endif
                        @disabled($isBooked)
                        class="py-4 px-2 rounded-[1.25rem] border-2 font-black text-xs uppercase tracking-wider transition-all flex flex-col items-center gap-1
                                                    {{ $isSelected
                                                        ? 'border-blue-500 bg-white text-blue-700 shadow-lg ring-4 ring-blue-50/50 scale-[1.02]'
                                                        : ($isBooked
                                                            ? 'border-red-100 bg-red-50 text-red-300 cursor-not-allowed'
                                                            : 'border-gray-100 bg-gray-50/50 text-gray-500 hover:bg-white hover:border-gray-300 hover:scale-[1.02] cursor-pointer') }}">
                        <div class="flex items-center gap-1">
                            @if($isBooked)
                            <span class="w-1.5 h-1.5 rounded-full bg-red-400 animate-pulse inline-block"></span>
                            @elseif($isSelected)
                            <span class="w-1.5 h-1.5 rounded-full bg-blue-500 inline-block"></span>
                            @else
                            <span class="w-1.5 h-1.5 rounded-full bg-green-400 inline-block"></span>
                            @endif
                            {{ $slot }}
                        </div>
                        <span class="text-[8px] font-bold tracking-wider
                                                        {{ $isBooked ? 'text-red-300' : ($isSelected ? 'text-blue-400' : 'text-gray-300') }}">
                            {{ $isBooked ? 'BOOKED' : ($isSelected ? 'SELECTED' : 'OPEN') }}
                        </span>
                    </button>
                    @endforeach
                </div>
                @error('pref_time') <span class="text-xs text-red-500 mt-2 block ml-1">{{ $message }}</span> @enderror
            </div>
            @endif
            @endif
        </div>
    </section>

    <!-- Submit -->
    <div class="pt-6 border-t border-gray-100 flex justify-end">
        <button type="submit" class="flex items-center justify-center gap-2 bg-gray-900 text-white hover:bg-black w-full sm:w-auto px-10 py-4 text-base rounded-[1.25rem] font-bold transition-all shadow-lg hover:shadow-gray-200 disabled:opacity-70" wire:loading.attr="disabled">
            <span class="material-symbols-outlined text-[20px] leading-none" wire:loading.remove wire:target="submit">check_circle</span>
            <span class="material-symbols-outlined text-[20px] animate-spin leading-none" wire:loading wire:target="submit">progress_activity</span>
            Confirm Repair Booking
        </button>
    </div>

    </form>
</div>
</div>
</div>

</div>
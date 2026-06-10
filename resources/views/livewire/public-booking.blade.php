<div class="w-full" x-data="{ infoModal: false, calendarModal: false, reviewModal: @entangle('showReviewModal') }">

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
        <div class="bg-white modal-content rounded-[2.5rem] shadow-2xl max-w-2xl w-full relative overflow-hidden flex flex-col max-h-[90vh] transform transition-all"
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
                            <span class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-blue-600 text-white font-bold shrink-0 text-center leading-none">1</span>
                            <div class="flex-1">
                                <div class="flex items-center min-h-8">
                                    <h4 class="font-bold text-gray-900 leading-none mb-0">Reserve your Slot</h4>
                                </div>
                                <p class="text-sm text-gray-500 mt-2 leading-relaxed mb-0">Submit this form to reserve your drop-off time. You'll receive a unique tracking code (e.g., RM-XXXXX).</p>
                            </div>
                        </li>
                        <li class="flex gap-4 items-start">
                            <span class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-blue-600 text-white font-bold shrink-0 text-center leading-none">2</span>
                            <div class="flex-1">
                                <div class="flex items-center min-h-8">
                                    <h4 class="font-bold text-gray-900 leading-none mb-0">Drop-off Device</h4>
                                </div>
                                <p class="text-sm text-gray-500 mt-2 leading-relaxed mb-0">Visit our shop at the scheduled time. Bring your device and show your tracking code to our receptionist.</p>
                            </div>
                        </li>
                        <li class="flex gap-4 items-start">
                            <span class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-blue-600 text-white font-bold shrink-0 text-center leading-none">3</span>
                            <div class="flex-1">
                                <div class="flex items-center min-h-8">
                                    <h4 class="font-bold text-gray-900 leading-none mb-0">Professional Diagnostic</h4>
                                </div>
                                <p class="text-sm text-gray-500 mt-2 leading-relaxed mb-0">We'll run a quick diagnostic and provide a final, binding quote before starting any work.</p>
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
        <div class="bg-white modal-content rounded-[2.5rem] shadow-2xl max-w-4xl w-full relative overflow-hidden flex flex-col max-h-[92vh] transform transition-all"
            x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0 scale-95 translate-y-10"
            x-transition:enter-end="opacity-100 scale-100 translate-y-0"
            x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100 scale-100 translate-y-0"
            x-transition:leave-end="opacity-0 scale-95 translate-y-10">

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
                                        <div class="inline-flex items-center gap-1 mt-1 px-2 py-0.5 rounded-full bg-red-100 text-red-500 text-[9px] font-black uppercase"><span class="w-1 h-1 bg-red-400 rounded-full animate-pulse"></span> FULL</div>
                                    @elseif($day['slots_left'] <= 1)
                                        <div class="inline-flex items-center gap-1 mt-1 px-2 py-0.5 rounded-full bg-orange-100 text-orange-500 text-[9px] font-black uppercase"><span class="w-1 h-1 bg-orange-400 rounded-full animate-pulse"></span> {{ $day['slots_left'] }} LEFT</div>
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
                                $isFull = $bookedCount >= 1;
                                $isSelected = ($pref_date === $day['full'] && $pref_time === $slot);
                                $spotsLeft = 1 - $bookedCount;
                                @endphp
                                <td class="py-2 px-2 text-center">
                                    <button type="button"
                                        @if(!$isFull)
                                        wire:click="selectDateAndTime({{ $dayIndex }}, '{{ $slot }}')"
                                        @click="calendarModal = false"
                                        @endif
                                        class="w-full h-11 rounded-[1.25rem] border-2 text-[10px] font-black uppercase tracking-wider transition-all flex items-center justify-center gap-1.5
                                                            {{ $isSelected ? 'bg-blue-500 border-blue-500 text-white shadow-lg shadow-blue-500/20'
                                                                : ($isFull ? 'bg-red-50 border-red-100 text-red-300 cursor-not-allowed'
                                                                : 'bg-gray-50 border-gray-100 text-gray-400 hover:bg-green-50 hover:border-green-300 hover:text-green-600 cursor-pointer') }}">
                                        @if($isSelected)
                                        <span class="material-symbols-outlined text-[14px] leading-none">check</span> Set
                                        @elseif($isFull)
                                        <span class="w-1.5 h-1.5 bg-red-400 rounded-full inline-block"></span> Full
                                        @else
                                        Select
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

            <div class="p-6 bg-gray-50 border-t border-gray-100 flex justify-between items-center shrink-0">
                <p class="text-xs text-gray-400 font-medium">Selecting a slot closes this modal and fills in your booking.</p>
                <button type="button" @click="calendarModal = false" class="px-6 py-3 bg-gray-900 text-white font-bold rounded-[1.25rem] hover:bg-black transition-all text-sm">Close</button>
            </div>
        </div>
    </div>

    <!-- ===== REVIEW DETAILS MODAL ===== -->
    <div x-show="reviewModal"
        class="fixed inset-0 z-[100] flex items-center justify-center p-4 sm:p-6 bg-gray-900/60 backdrop-blur-md"
        x-cloak
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0">
        <div class="fixed inset-0" @click="reviewModal = false"></div>
        <div class="bg-white modal-content rounded-[2.5rem] shadow-2xl max-w-2xl w-full relative overflow-hidden flex flex-col max-h-[90vh] transform transition-all"
            x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0 scale-95 translate-y-4"
            x-transition:enter-end="opacity-100 scale-100 translate-y-0"
            x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100 scale-100 translate-y-0"
            x-transition:leave-end="opacity-0 scale-95 translate-y-4">
            
            <!-- Modal Header -->
            <div class="px-8 pt-10 pb-6 flex flex-col items-center text-center bg-white relative border-b border-gray-100">
                <button type="button" @click="reviewModal = false"
                    class="absolute top-6 right-6 p-2 bg-gray-50 text-gray-400 hover:text-gray-900 hover:bg-gray-100 rounded-[1.25rem] transition-all focus:outline-none focus:ring-0 group">
                    <span class="material-symbols-outlined text-[20px] leading-none group-hover:rotate-90 transition-transform duration-300">close</span>
                </button>
                <div class="w-16 h-16 bg-blue-50 text-blue-600 rounded-[1.5rem] flex items-center justify-center mb-4 shadow-sm border border-blue-100/50">
                    <span class="material-symbols-outlined text-[32px] leading-none">rate_review</span>
                </div>
                <h3 class="text-2xl font-black text-gray-900 tracking-tighter">Review Details</h3>
                <p class="text-sm text-gray-400 font-medium mt-1">Please verify your booking details before submitting</p>
            </div>

            <!-- Modal Content (Scrollable) -->
            <div class="p-8 overflow-y-auto space-y-6">
                <!-- Reference Codes Grid (Logistics vs Substance) -->
            <div class="bg-blue-50/30 dark:bg-blue-500/10 border border-blue-100/50 dark:border-blue-500/20 rounded-[1.25rem] p-4 text-left">
                <span class="text-[9px] uppercase font-black tracking-widest text-blue-600 dark:text-blue-400 block">Ticket Number</span>
                <span class="text-sm md:text-base font-black text-blue-900 dark:text-blue-300 mt-1 block font-mono">{{ $tracking_code }}</span>
            </div>

                <!-- Personal details section -->
                <div class="bg-gray-50 rounded-[1.5rem] p-5 border border-gray-100">
                    <h4 class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-4 flex items-center gap-1.5">
                        <span class="material-symbols-outlined text-[16px]">person</span> Personal Details
                    </h4>
                    <div class="grid grid-cols-2 gap-4 text-sm">
                        <div>
                            <p class="text-xs text-gray-400 font-bold uppercase tracking-wider">Full Name</p>
                            <p class="font-bold text-gray-900 mt-0.5">{{ $first_name }} {{ $last_name }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 font-bold uppercase tracking-wider">Phone Number</p>
                            <p class="font-bold text-gray-900 mt-0.5">{{ $phone }}</p>
                        </div>
                        <div class="col-span-2">
                            <p class="text-xs text-gray-400 font-bold uppercase tracking-wider">Email Address</p>
                            <p class="font-bold text-gray-900 mt-0.5">{{ $email }}</p>
                        </div>
                    </div>
                </div>

                <!-- Device & service details section -->
                <div class="bg-gray-50 rounded-[1.5rem] p-5 border border-gray-100">
                    <h4 class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-4 flex items-center gap-1.5">
                        <span class="material-symbols-outlined text-[16px]">devices</span> Device & Service
                    </h4>
                    <div class="grid grid-cols-2 gap-4 text-sm">
                        <div>
                            <p class="text-xs text-gray-400 font-bold uppercase tracking-wider">Device</p>
                            <p class="font-bold text-gray-900 mt-0.5">
                                @if($device_brand === 'Other')
                                    {{ $custom_brand }} {{ $custom_model }}
                                @else
                                    {{ $device_brand }} {{ $device_model === 'Other' ? $custom_model : $device_model }}
                                @endif
                            </p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 font-bold uppercase tracking-wider">Service Type</p>
                            <p class="font-bold text-gray-900 mt-0.5">
                                @if($fault_category === 'Other')
                                    {{ $custom_service }}
                                @else
                                    {{ $fault_category }}
                                @endif
                            </p>
                        </div>
                        <div class="col-span-2">
                            <p class="text-xs text-gray-400 font-bold uppercase tracking-wider">Problem Description</p>
                            <p class="text-gray-700 mt-1 leading-relaxed whitespace-pre-line">{{ $description }}</p>
                        </div>
                    </div>
                </div>

                <!-- Method and Address section -->
                <div class="bg-gray-50 rounded-[1.5rem] p-5 border border-gray-100">
                    <h4 class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-4 flex items-center gap-1.5">
                        <span class="material-symbols-outlined text-[16px]">local_shipping</span> Service Method & Schedule
                    </h4>
                    <div class="grid grid-cols-2 gap-4 text-sm">
                        <div>
                            <p class="text-xs text-gray-400 font-bold uppercase tracking-wider">Service Method</p>
                            <p class="font-bold text-gray-900 mt-0.5">
                                {{ $pickup_option === 'Pickup' ? 'Home Pickup & Return' : 'Drop-off at Shop' }}
                            </p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 font-bold uppercase tracking-wider">Scheduled Date & Time</p>
                            <p class="font-bold text-gray-900 mt-0.5">
                                @if($pref_date)
                                    {{ \Carbon\Carbon::parse($pref_date)->format('M d, Y') }} at {{ $pref_time }}
                                @endif
                            </p>
                        </div>
                        <div class="col-span-2">
                            <p class="text-xs text-gray-400 font-bold uppercase tracking-wider">Address</p>
                            <p class="font-bold text-gray-900 mt-0.5">{{ $address }}, {{ $city }}</p>
                        </div>
                        @if($other_details)
                        <div class="col-span-2">
                            <p class="text-xs text-gray-400 font-bold uppercase tracking-wider">Special Instructions</p>
                            <p class="text-gray-700 mt-0.5">{{ $other_details }}</p>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Financial Overview section -->
                <div class="bg-[#121622] rounded-[1.5rem] p-5 border border-white/5">
                    <h4 class="text-[10px] font-black text-blue-400 uppercase tracking-widest mb-4 flex items-center gap-1.5">
                        <span class="material-symbols-outlined text-[16px]">payments</span> Financial Overview
                    </h4>
                    
                    @php
                    $selectedFault = ($fault_category && $fault_category !== 'Other') ? \App\Models\FaultType::where('name', $fault_category)->first() : null;
                    $basePrice = $selectedFault ? $selectedFault->base_price : null;
                    @endphp

                    <div class="space-y-3 text-sm">
                        <div class="flex justify-between items-center text-gray-400">
                            <span>Base Service Price ({{ $fault_category === 'Other' ? ($custom_service ?: 'Custom Service') : $fault_category }})</span>
                            <span class="font-bold text-white">
                                @if($fault_category === 'Other')
                                    Quote after inspection
                                @elseif($basePrice)
                                    ₱{{ number_format($basePrice, 2) }}
                                @else
                                    Pending diagnostic
                                @endif
                            </span>
                        </div>

                        <div class="flex justify-between items-center text-gray-400">
                            <span>Service Method ({{ $pickup_option === 'Pickup' ? 'Home Pickup' : 'Shop Drop-off' }})</span>
                            <span class="font-bold text-white">
                                @if($additional_fee > 0)
                                    ₱{{ number_format($additional_fee, 2) }}
                                @else
                                    Free
                                @endif
                            </span>
                        </div>

                        <div class="flex justify-between items-center text-gray-400 border-b border-white/5 pb-3">
                            <span class="flex items-center gap-1">
                                Diagnostic Fee 
                                <span class="text-[10px] font-black text-blue-400 bg-blue-500/10 px-1.5 py-0.5 rounded uppercase" title="Charged only if you decline repair after diagnostic check">Conditional</span>
                            </span>
                            <span class="font-bold text-white">₱150.00</span>
                        </div>

                        <div class="flex justify-between items-center pt-1">
                            <span class="text-base font-black text-white">Estimated Total</span>
                            <span class="text-lg font-black text-blue-400">
                                @if($fault_category === 'Other')
                                    ₱{{ number_format($additional_fee, 2) }} + Diagnostic / Quote
                                @elseif($basePrice)
                                    ₱{{ number_format($basePrice + $additional_fee, 2) }}
                                @else
                                    ₱{{ number_format($additional_fee, 2) }}
                                @endif
                            </span>
                        </div>
                    </div>

                    <div class="mt-5 p-3.5 bg-amber-50 dark:bg-amber-500/10 border border-amber-100 dark:border-amber-500/20 rounded-xl flex items-start gap-2.5">
                        <span class="material-symbols-outlined text-amber-600 dark:text-amber-400 text-[18px] shrink-0 mt-0.5 animate-pulse">warning</span>
                        <div class="text-xs text-amber-800 dark:text-amber-300 leading-relaxed font-semibold">
                            <strong class="font-black uppercase tracking-wider block mb-1">Pricing Notice (Subject to Final Inspection)</strong>
                            This estimated total is not complete. The final cost will be determined after a technical diagnostic check of your device's actual condition. Additional fees may apply for secondary issues (e.g. internal hardware damages, bloated battery, water exposure) discovered during the repair process.
                        </div>
                    </div>
                </div>

                <!-- Email Active & Inbox Notice -->
                <div class="p-4 bg-blue-50 border border-blue-100 rounded-[1.25rem] flex items-start gap-3 shadow-sm shadow-blue-50/50">
                    <span class="material-symbols-outlined text-blue-600 text-[20px] shrink-0 mt-0.5">mail</span>
                    <div class="text-xs text-blue-800 leading-relaxed font-medium">
                        <strong class="font-black uppercase tracking-wider block mb-1">Active Email & Inbox Verification Required</strong>
                        Please ensure your email (<span class="font-bold underline text-blue-900">{{ $email }}</span>) is active and correct. A detailed booking receipt and repair tracking credentials will be sent directly to your inbox. Please check your Inbox (and Spam/Junk folder) shortly.
                    </div>
                </div>
            </div>

            <!-- Modal Footer -->
            <div class="p-6 bg-gray-50 border-t border-gray-100 flex flex-col sm:flex-row gap-3">
                <button type="button" @click="reviewModal = false"
                    class="w-full sm:w-1/2 py-4 bg-white border border-gray-200 text-gray-700 font-bold rounded-[1.25rem] hover:bg-gray-50 transition-all text-sm">
                    Edit Details
                </button>
                <button type="button" wire:click="submit" wire:loading.attr="disabled"
                    class="w-full sm:w-1/2 py-4 bg-gray-900 text-white font-bold rounded-[1.25rem] hover:bg-black transition-all text-sm flex items-center justify-center gap-2">
                    <span class="material-symbols-outlined text-[18px] leading-none" wire:loading.remove wire:target="submit">check_circle</span>
                    <span class="material-symbols-outlined text-[18px] animate-spin leading-none" wire:loading wire:target="submit">progress_activity</span>
                    Confirm Booking
                </button>
            </div>
        </div>
    </div>

    <!-- ===== BOOKING SUMMARY (top, full-width) ===== -->
    <div class="bg-white/3 backdrop-blur-md border border-white/10 shadow-2xl rounded-3xl p-6 mb-6">
        <div class="mb-6 pb-3 border-b border-white/5 flex justify-between items-center">
            <h3 class="font-bold text-white mb-0">Booking Summary</h3>
            <button type="button" @click="infoModal = true"
                class="p-0 bg-transparent text-gray-400 hover:text-blue-400 transition-all flex items-center gap-1.5 text-xs font-black uppercase tracking-wider outline-none ring-0">
                <span class="material-symbols-outlined text-[18px]">info</span> Repair Guidelines
            </button>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-5 gap-4 text-sm mb-5">
            <!-- Ticket Number -->
            <div class="bg-blue-500/10 rounded-xl p-3 border border-blue-500/20">
                <p class="text-[10px] font-black text-blue-400 uppercase tracking-wider mb-1">Ticket Number</p>
                <p class="font-bold text-blue-300 text-xs leading-snug font-mono">
                    @if($pref_date)
                        {{ $tracking_code }}
                    @else
                        <span class="text-blue-500/50 font-normal italic">Select a date</span>
                    @endif
                </p>
            </div>
            <!-- Device -->
            <div class="bg-white/5 rounded-xl p-3 border border-white/5">
                <p class="text-[10px] font-black text-gray-400 uppercase tracking-wider mb-1">Device</p>
                <p class="font-bold text-white text-xs leading-snug">
                    @if($device_brand === 'Other')
                        {{ $custom_brand ?: 'Custom' }} {{ $custom_model ?: 'Device' }}
                    @elseif($device_brand)
                        {{ $device_brand }} {{ $device_model === 'Other' ? ($custom_model ?: 'Custom Model') : $device_model }}
                    @else
                        <span class="text-gray-500 font-normal italic">Not set</span>
                    @endif
                </p>
            </div>
            <!-- Issue / Service -->
            <div class="bg-white/5 rounded-xl p-3 border border-white/5">
                <p class="text-[10px] font-black text-gray-400 uppercase tracking-wider mb-1">Service / Issue</p>
                <p class="font-bold text-white text-xs leading-snug">
                    @if($fault_category === 'Other')
                        {{ $custom_service ?: 'Custom Service' }}
                    @elseif($fault_category)
                        {{ $fault_category }}
                    @else
                        <span class="text-gray-500 font-normal italic">Not set</span>
                    @endif
                </p>
            </div>
            <!-- Date & Time -->
            <div class="bg-white/5 rounded-xl p-3 border border-white/5">
                <p class="text-[10px] font-black text-gray-400 uppercase tracking-wider mb-1">Date & Time</p>
                <p class="font-bold text-white text-xs leading-snug">
                    @if($pref_date && $pref_time)
                    {{ \Carbon\Carbon::parse($pref_date)->format('M d, Y') }}<br>
                    <span class="text-gray-400 font-medium">{{ $pref_time }}</span>
                    @elseif($pref_date)
                    {{ \Carbon\Carbon::parse($pref_date)->format('M d, Y') }}
                    @else
                    <span class="text-gray-500 font-normal italic">Not set</span>
                    @endif
                </p>
            </div>
            <!-- Estimated Price -->
            <div class="rounded-xl p-3 border
                    @if($fault_category && $fault_category !== 'Other' && \App\Models\FaultType::where('name', $fault_category)->first())
                        bg-blue-500/10 border-blue-500/20
                    @else
                        bg-white/5 border-white/5
                    @endif">
                <p class="text-[10px] font-black uppercase tracking-wider mb-1
                        @if($fault_category && $fault_category !== 'Other' && \App\Models\FaultType::where('name', $fault_category)->first()) text-blue-400 @else text-gray-400 @endif">Est. Price</p>
                @php
                $selectedFault = ($fault_category && $fault_category !== 'Other') ? \App\Models\FaultType::where('name', $fault_category)->first() : null;
                $summaryPrice = $selectedFault ? $selectedFault->base_price : null;
                @endphp
                @if($fault_category === 'Other')
                <p class="font-bold text-gray-300 text-xs leading-tight mt-1">Custom Quote</p>
                <p class="text-[9px] text-gray-500 mt-1">After diagnostic</p>
                @elseif($fault_category && $summaryPrice)
                <p class="font-black text-blue-400 text-base leading-none">₱{{ number_format($summaryPrice) }}</p>
                <p class="text-[9px] text-blue-500 mt-1">Starting from</p>
                @elseif($fault_category)
                <p class="font-bold text-gray-300 text-xs leading-tight mt-1">After inspection</p>
                @else
                <p class="text-gray-500 font-normal italic text-xs">Not set</p>
                @endif
            </div>
        </div>

        <!-- Diagnostic Fee Note -->
        <div class="flex items-center gap-2 text-xs text-gray-300 bg-white/5 rounded-xl px-4 py-2.5 border border-white/5">
            <span class="material-symbols-outlined text-[16px] leading-none text-gray-400 shrink-0">info</span>
            <span class="leading-none">A <strong class="text-white font-bold">₱150 diagnostic fee</strong> applies if you decline the repair quote after inspection.</span>
        </div>
    </div>

    @if($this->activeAnnouncement)
        <div class="mb-8 p-6 rounded-3xl border flex items-start gap-4 animate-fade-in shadow-sm
            @if($this->activeAnnouncement->style === 'warning') bg-amber-50 border-amber-200 text-amber-900
            @elseif($this->activeAnnouncement->style === 'success') bg-emerald-50 border-emerald-200 text-emerald-900
            @elseif($this->activeAnnouncement->style === 'danger') bg-red-50 border-red-200 text-red-900
            @else bg-blue-50 border-blue-200 text-blue-900
            @endif">
            <span class="material-symbols-outlined text-[28px] shrink-0 mt-0.5
                @if($this->activeAnnouncement->style === 'warning') text-amber-600
                @elseif($this->activeAnnouncement->style === 'success') text-emerald-600
                @elseif($this->activeAnnouncement->style === 'danger') text-red-600
                @else text-blue-600
                @endif">
                @if($this->activeAnnouncement->style === 'warning') warning
                @elseif($this->activeAnnouncement->style === 'success') check_circle
                @elseif($this->activeAnnouncement->style === 'danger') error
                @else info
                @endif
            </span>
            <div class="flex-1">
                <h4 class="text-sm font-black uppercase tracking-wider mb-1">Notice Update</h4>
                <p class="text-sm leading-relaxed font-semibold whitespace-pre-line">{{ $this->activeAnnouncement->content }}</p>
            </div>
        </div>
    @endif

    <!-- ===== MAIN FORM ===== -->
    <div class="bg-white/3 backdrop-blur-md border border-white/10 shadow-2xl rounded-[2.5rem] p-6 md:p-10 mb-8">
        <form wire:submit.prevent="prepareReview" class="space-y-12" novalidate>

            <!-- Personal Details -->
            <section>
                <h3 class="text-lg font-bold text-white border-b border-white/5 pb-3 mb-6 flex items-center gap-2.5">
                    <span class="material-symbols-outlined text-[20px] leading-none text-blue-400 bg-blue-500/10 p-1.5 rounded-xl shrink-0 transform translate-y-[1px]">person</span>
                    <span class="leading-none">Personal Details</span>
                </h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label for="first_name" class="block text-sm font-bold text-gray-300 mb-2 ml-1">First Name <span class="text-red-500">*</span></label>
                        <input type="text" id="first_name" wire:model="first_name" placeholder="e.g. Jane" autocomplete="given-name" style="color-scheme: dark; caret-color: #fff" class="w-full px-4 py-3.5 border border-white/10 rounded-[1.25rem] bg-white/5 text-white placeholder-gray-500 focus:bg-white/10 focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all text-sm font-medium" required>
                        @error('first_name') <span class="text-xs text-red-500 mt-1 block ml-1">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label for="last_name" class="block text-sm font-bold text-gray-300 mb-2 ml-1">Last Name <span class="text-red-500">*</span></label>
                        <input type="text" id="last_name" wire:model="last_name" placeholder="e.g. Doe" autocomplete="family-name" style="color-scheme: dark; caret-color: #fff" class="w-full px-4 py-3.5 border border-white/10 rounded-[1.25rem] bg-white/5 text-white placeholder-gray-500 focus:bg-white/10 focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all text-sm font-medium" required>
                        @error('last_name') <span class="text-xs text-red-500 mt-1 block ml-1">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label for="email" class="block text-sm font-bold text-gray-300 mb-2 ml-1">Email Address <span class="text-red-500">*</span></label>
                        <input type="email" id="email" wire:model="email" placeholder="e.g. jane@example.com" autocomplete="email" style="color-scheme: dark; caret-color: #fff" class="w-full px-4 py-3.5 border border-white/10 rounded-[1.25rem] bg-white/5 text-white placeholder-gray-500 focus:bg-white/10 focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all text-sm font-medium" required>
                        @error('email') <span class="text-xs text-red-500 mt-1 block ml-1">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label for="phone" class="block text-sm font-bold text-gray-300 mb-2 ml-1">Phone Number <span class="text-red-500">*</span></label>
                        <input type="tel" id="phone" wire:model="phone" placeholder="e.g. (555) 123-4567" autocomplete="tel" style="color-scheme: dark; caret-color: #fff" class="w-full px-4 py-3.5 border border-white/10 rounded-[1.25rem] bg-white/5 text-white placeholder-gray-500 focus:bg-white/10 focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all text-sm font-medium" required>
                        @error('phone') <span class="text-xs text-red-500 mt-1 block ml-1">{{ $message }}</span> @enderror
                    </div>

                    <!-- Create Account Checkbox Option -->
                    <div class="col-span-1 md:col-span-2 mt-2">
                        <label class="flex items-start gap-3 p-4 rounded-2xl border border-white/5 bg-white/3 hover:bg-white/5 cursor-pointer transition-all">
                            <input type="checkbox" wire:model="create_account" class="w-5 h-5 rounded border-white/10 bg-transparent text-blue-600 focus:ring-blue-500 focus:ring-offset-0 mt-0.5">
                            <div class="flex flex-col">
                                <span class="text-sm font-bold text-white">Register a customer account with these details</span>
                        <span class="text-xs text-gray-400 mt-0.5">Recommended. Checking this will register your profile in our system, allowing you to access a personalized customer dashboard to track active repairs, view invoice history, and manage multiple booking requests.</span>
                            </div>
                        </label>
                    </div>
                </div>
            </section>

            <!-- Service & Pickup Details -->
            <section>
                <h3 class="text-lg font-bold text-white border-b border-white/5 pb-3 mb-6 flex items-center gap-2.5">
                    <span class="material-symbols-outlined text-[20px] leading-none text-blue-400 bg-blue-500/10 p-1.5 rounded-xl shrink-0 transform translate-y-[1px]">local_shipping</span>
                    <span class="leading-none">Service Method & Address</span>
                </h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <!-- Pickup Option (Radio Buttons) -->
                    <div class="col-span-1 md:col-span-2">
                        <label class="block text-sm font-bold text-gray-300 mb-3 ml-1">How would you like to get your device to us? <span class="text-red-500">*</span></label>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <!-- Option 1: Drop-off -->
                            <label class="flex items-center gap-3.5 p-4 rounded-2xl border-2 cursor-pointer transition-all
                                {{ $pickup_option === 'Drop-off'
                                    ? 'border-blue-500 bg-blue-500/10 hover:bg-blue-500/15'
                                    : 'border-white/10 bg-white/3 hover:bg-white/8' }}">
                                <input type="radio" wire:model.live="pickup_option" value="Drop-off" class="w-4 h-4 text-blue-600 border-white/10 focus:ring-blue-500 bg-transparent">
                                <div>
                                    <p class="text-sm font-bold text-white">Drop-off at Shop</p>
                                    <p class="text-xs text-gray-400 mt-0.5">Bring your device directly to our repair store.</p>
                                </div>
                            </label>

                            <!-- Option 2: Home Pickup -->
                            <label class="flex items-center gap-3.5 p-4 rounded-2xl border-2 cursor-pointer transition-all
                                {{ $pickup_option === 'Pickup'
                                    ? 'border-blue-500 bg-blue-500/10 hover:bg-blue-500/15'
                                    : 'border-white/10 bg-white/3 hover:bg-white/8' }}">
                                <input type="radio" wire:model.live="pickup_option" value="Pickup" class="w-4 h-4 text-blue-600 border-white/10 focus:ring-blue-500 bg-transparent">
                                <div>
                                    <p class="text-sm font-bold text-white">Home Pickup & Return</p>
                                    <p class="text-xs text-gray-400 mt-0.5">We will collect and return the device to your door.</p>
                                </div>
                            </label>
                        </div>

                        <!-- Shop Address Card (Drop-off only) -->
                        @if($pickup_option === 'Drop-off')
                        <div x-data="{ showMap: false }" class="mt-4 p-5 bg-blue-50 border border-blue-200 dark:bg-blue-950/20 dark:border-blue-500/20 rounded-[1.25rem] flex flex-col gap-4 mb-6">
                            <div class="flex items-start justify-between gap-3">
                                <div class="flex items-start gap-3">
                                    <span class="material-symbols-outlined text-blue-600 dark:text-blue-400 text-[20px] shrink-0 mt-0.5">pin_drop</span>
                                    <div>
                                        <h4 class="text-xs font-bold text-blue-700 dark:text-blue-400 uppercase tracking-wider mb-0.5">Shop Drop-off Location</h4>
                                        <p class="text-xs text-blue-600 dark:text-blue-300 font-medium leading-relaxed">Commonwealth Ave. Cor. IBP Road (Litex Junction), Quezon City, Metro Manila, Philippines</p>
                                    </div>
                                </div>
                                <button type="button" @click="showMap = !showMap" class="text-xs font-black text-blue-700 hover:text-blue-800 dark:text-blue-300 dark:hover:text-blue-400 flex items-center gap-1 bg-blue-100 hover:bg-blue-200 dark:bg-blue-500/20 dark:hover:bg-blue-500/30 px-3 py-1.5 rounded-lg transition-all shrink-0 border-none outline-none focus:outline-none cursor-pointer">
                                    <span class="material-symbols-outlined text-[16px]" x-show="!showMap">map</span>
                                    <span class="material-symbols-outlined text-[16px]" x-show="showMap" x-cloak>close</span>
                                    <span x-text="showMap ? 'Hide Map' : 'Show Map'">Show Map</span>
                                </button>
                            </div>
                            
                            <!-- Map Container -->
                            <div x-show="showMap" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 max-h-0" x-transition:enter-end="opacity-100 max-h-[300px]" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 max-h-[300px]" x-transition:leave-end="opacity-0 max-h-0" class="overflow-hidden rounded-xl border border-blue-200 dark:border-blue-500/20 shadow-sm w-full h-[250px]">
                                <iframe class="w-full h-full border-none" src="https://maps.google.com/maps?q=Commonwealth%20Ave.%20Cor.%20IBP%20Road%20(Litex%20Junction),%20Quezon%20City,%20Metro%20Manila,%20Philippines&t=&z=15&ie=UTF8&iwloc=&output=embed" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                            </div>
                        </div>
                        @endif

                        <!-- Geomap address locator (Pickup only) -->
                        @if($pickup_option === 'Pickup')
                        <div x-data="pickupMapComponent($wire)" class="mt-4 p-5 bg-blue-50 border border-blue-200 dark:bg-blue-950/20 dark:border-blue-500/20 rounded-[1.25rem] flex flex-col gap-4 mb-6">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-2">
                                    <span class="material-symbols-outlined text-blue-600 dark:text-blue-400">pin_drop</span>
                                    <span class="text-xs font-bold text-blue-700 dark:text-blue-400 uppercase tracking-wider">Locate Pickup Address on Map</span>
                                </div>
                                <span class="text-[9px] font-black text-blue-700 dark:text-blue-300 bg-blue-100 dark:bg-blue-500/20 px-2 py-0.5 rounded uppercase">Draggable Marker</span>
                            </div>
                            <div id="pickup-map" class="w-full h-[250px] rounded-xl border border-blue-200 dark:border-blue-500/20 shadow-sm overflow-hidden" wire:ignore></div>
                            <p class="text-[10px] text-gray-500 dark:text-gray-400 font-medium leading-relaxed">
                                Drag the marker or click on the map to set your exact location. This will automatically fill in your Barangay, Street and City inputs below.
                            </p>
                        </div>
                        @endif

                        @error('pickup_option') <span class="text-xs text-red-500 mt-1 block ml-1">{{ $message }}</span> @enderror
                    </div>

                    <!-- Pickup Address & City -->
                    <div class="col-span-1 md:col-span-2 grid grid-cols-1 md:grid-cols-3 gap-6" x-data="addressSearch($wire)">
                        <!-- Search Address -->
                        <div class="col-span-1 md:col-span-3 mb-2 relative">
                            <label class="block text-sm font-bold text-gray-300 mb-2 ml-1">Search Address (Auto-fill)</label>
                            <div class="relative">
                                <input type="text" x-model="query" @input.debounce.500ms="search" @input="searched = false; results = []" placeholder="Type to search for your address..." class="w-full px-4 py-3 border border-white/10 rounded-[1.25rem] bg-white/5 text-white placeholder-gray-500 focus:bg-white/10 focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all text-sm font-medium">
                                <div x-show="loading" x-cloak class="absolute right-4 top-1/2 -translate-y-1/2">
                                    <span class="material-symbols-outlined animate-spin text-blue-400">progress_activity</span>
                                </div>
                            </div>
                            <div x-show="results.length > 0 || (searched && results.length === 0 && query.length >= 3)" @click.away="results = []; searched = false" class="absolute z-[200] w-full mt-1 bg-[#0d1527] border border-white/10 rounded-[1.25rem] shadow-lg max-h-60 overflow-y-auto">
                                <div x-show="results.length > 0">
                                    <template x-for="result in results" :key="result.place_id">
                                        <div @click="select(result)" class="px-4 py-3 hover:bg-white/5 cursor-pointer border-b border-white/5 last:border-0 transition-colors">
                                            <p class="text-sm font-bold text-white truncate" x-text="result.display_name"></p>
                                        </div>
                                    </template>
                                </div>
                                <div x-show="searched && results.length === 0 && query.length >= 3" class="px-4 py-4.5 text-gray-400 text-xs font-semibold leading-relaxed text-center">
                                    <span class="material-symbols-outlined text-[20px] text-gray-500 mb-1 block">sentiment_dissatisfied</span>
                                    No addresses found. <br>
                                    Please enter your address manually below or select it on the map.
                                </div>
                            </div>
                        </div>

                        <div>
                            <label for="address" class="block text-sm font-bold text-gray-300 mb-2 ml-1">Street Address <span class="text-red-500">*</span></label>
                            <input type="text" id="address" wire:model="address" placeholder="Enter Street name, Building, House No..." class="w-full px-4 py-3.5 border border-white/10 rounded-[1.25rem] bg-white/5 text-white placeholder-gray-500 focus:bg-white/10 focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all text-sm font-medium" required>
                            @error('address') <span class="text-xs text-red-500 mt-1 block ml-1">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label for="city" class="block text-sm font-bold text-gray-300 mb-2 ml-1">City / Municipality <span class="text-red-500">*</span></label>
                            <div class="relative w-full">
                                <select id="city" wire:model.live="city" class="w-full pl-4 pr-10 py-3.5 border border-white/10 rounded-[1.25rem] bg-white/5 text-white placeholder-gray-500 focus:bg-white/10 focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all text-sm font-medium appearance-none cursor-pointer" required>
                                    <option value="" disabled selected class="bg-[#020617] text-white">Select City...</option>
                                    @foreach($this->cities as $c)
                                        <option value="{{ $c->name }}" class="bg-[#020617] text-white">{{ $c->name }}</option>
                                    @endforeach
                                </select>
                                <span class="material-symbols-outlined absolute right-3.5 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none text-[20px]">unfold_more</span>
                            </div>
                            @if($additional_fee > 0)
                                <span class="text-xs font-bold text-blue-400 block mt-2 ml-1 animate-fade-in">+ ₱{{ number_format($additional_fee, 2) }} Shipping Fee</span>
                            @elseif($city)
                                <span class="text-xs font-bold text-emerald-400 block mt-2 ml-1 animate-fade-in">Free Shipping</span>
                            @endif
                            @error('city') <span class="text-xs text-red-500 mt-1 block ml-1">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label for="barangay" class="block text-sm font-bold text-gray-300 mb-2 ml-1">Barangay <span class="text-red-500">*</span></label>
                            <div class="relative w-full">
                                <select id="barangay" wire:model="barangay" class="w-full pl-4 pr-10 py-3.5 border border-white/10 rounded-[1.25rem] bg-white/5 text-white placeholder-gray-500 focus:bg-white/10 focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all text-sm font-medium appearance-none cursor-pointer" required :disabled="!$wire.city">
                                    <option value="" disabled selected class="bg-[#020617] text-white">Select Barangay...</option>
                                    <template x-for="b in barangays" :key="b">
                                        <option :value="b" x-text="b" class="bg-[#020617] text-white" :selected="$wire.barangay === b"></option>
                                    </template>
                                </select>
                                <span class="material-symbols-outlined absolute right-3.5 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none text-[20px]">unfold_more</span>
                            </div>
                            @error('barangay') <span class="text-xs text-red-500 mt-1 block ml-1">{{ $message }}</span> @enderror
                        </div>

                        <!-- Alternate Address Toggle -->
                        <div class="col-span-1 md:col-span-3 mt-2 flex items-center gap-3">
                            <input type="checkbox" id="use_same_address" wire:model.live="use_same_address" class="w-5 h-5 text-blue-600 border-white/10 rounded bg-white/5 focus:ring-blue-500 cursor-pointer">
                            <label for="use_same_address" class="text-sm font-bold text-gray-300 cursor-pointer select-none">Alternative address is the same as current address</label>
                        </div>

                        <!-- Alternative Address Fields -->
                        <div class="col-span-1 md:col-span-3 grid grid-cols-1 md:grid-cols-3 gap-6 mt-4 pt-4 border-t border-white/10" x-show="!$wire.use_same_address" x-transition>
                            <h4 class="col-span-1 md:col-span-3 text-xs font-black text-gray-300 uppercase tracking-wider mb-1">Alternative Address</h4>
                            <div>
                                <label for="alt_address" class="block text-sm font-bold text-gray-300 mb-2 ml-1">Street Address <span class="text-red-500">*</span></label>
                                <input type="text" id="alt_address" wire:model="alt_address" placeholder="Enter Street name, Building, House No..." class="w-full px-4 py-3.5 border border-white/10 rounded-[1.25rem] bg-white/5 text-white placeholder-gray-500 focus:bg-white/10 focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all text-sm font-medium" :required="!$wire.use_same_address">
                                @error('alt_address') <span class="text-xs text-red-500 mt-1 block ml-1">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label for="alt_city" class="block text-sm font-bold text-gray-300 mb-2 ml-1">City / Municipality <span class="text-red-500">*</span></label>
                                <div class="relative w-full">
                                    <select id="alt_city" wire:model.live="alt_city" class="w-full pl-4 pr-10 py-3.5 border border-white/10 rounded-[1.25rem] bg-white/5 text-white placeholder-gray-500 focus:bg-white/10 focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all text-sm font-medium appearance-none cursor-pointer" :required="!$wire.use_same_address">
                                        <option value="" disabled selected class="bg-[#020617] text-white">Select City...</option>
                                        @foreach($this->cities as $c)
                                            <option value="{{ $c->name }}" class="bg-[#020617] text-white">{{ $c->name }}</option>
                                        @endforeach
                                    </select>
                                    <span class="material-symbols-outlined absolute right-3.5 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none text-[20px]">unfold_more</span>
                                </div>
                                @error('alt_city') <span class="text-xs text-red-500 mt-1 block ml-1">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label for="alt_barangay" class="block text-sm font-bold text-gray-300 mb-2 ml-1">Barangay <span class="text-red-500">*</span></label>
                                <div class="relative w-full">
                                    <select id="alt_barangay" wire:model="alt_barangay" class="w-full pl-4 pr-10 py-3.5 border border-white/10 rounded-[1.25rem] bg-white/5 text-white placeholder-gray-500 focus:bg-white/10 focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all text-sm font-medium appearance-none cursor-pointer" :required="!$wire.use_same_address" :disabled="!$wire.alt_city">
                                        <option value="" disabled selected class="bg-[#020617] text-white">Select Barangay...</option>
                                        <template x-for="b in altBarangays" :key="b">
                                            <option :value="b" x-text="b" class="bg-[#020617] text-white" :selected="$wire.alt_barangay === b"></option>
                                        </template>
                                    </select>
                                    <span class="material-symbols-outlined absolute right-3.5 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none text-[20px]">unfold_more</span>
                                </div>
                                @error('alt_barangay') <span class="text-xs text-red-500 mt-1 block ml-1">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Other Details / Special Instructions -->
                    <div class="col-span-1 md:col-span-2">
                        <label for="other_details" class="block text-sm font-bold text-gray-300 mb-2 ml-1">Other Details / Special Instructions <span class="text-gray-400 font-normal">(Optional)</span></label>
                        <textarea id="other_details" wire:model="other_details" rows="2" placeholder="e.g. Best time for pickup, gate code, secondary contact details..." class="w-full px-4 py-3.5 border border-white/10 rounded-[1.25rem] bg-white/5 text-white placeholder-gray-500 focus:bg-white/10 focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all text-sm font-medium resize-none"></textarea>
                        @error('other_details') <span class="text-xs text-red-500 mt-1 block ml-1">{{ $message }}</span> @enderror
                    </div>
                </div>
            </section>

            <!-- Device Information -->
            <section>
                <h3 class="text-lg font-bold text-white border-b border-white/5 pb-3 mb-6 flex items-center gap-2.5">
                    <span class="material-symbols-outlined text-[20px] leading-none text-blue-400 bg-blue-500/10 p-1.5 rounded-xl shrink-0 transform translate-y-[1px]">devices</span>
                    <span class="leading-none">Device Information</span>
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    @if($device_brand !== 'Other')
                        <div>
                            <label for="device_brand" class="block text-sm font-bold text-gray-800 mb-2 ml-1">Brand</label>
                            <select id="device_brand" wire:model.live="device_brand" class="w-full px-4 py-3.5 border border-white/10 rounded-[1.25rem] bg-white/5 text-white placeholder-gray-500 focus:bg-white/10 focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all text-sm font-medium" required>
                                <option value="" disabled selected class="bg-[#020617] text-white">Select Brand</option>
                                @foreach($this->brands as $brand)
                                    <option value="{{ $brand->name }}" class="bg-[#020617] text-white">{{ $brand->name }}</option>
                                @endforeach
                                <option value="Other" class="bg-[#020617] text-white">Other</option>
                            </select>
                            @error('device_brand') <span class="text-xs text-red-500 mt-1 block ml-1">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label for="device_model" class="block text-sm font-bold text-gray-300 mb-2 ml-1">Exact Model</label>
                            <select id="device_model" wire:model.live="device_model" class="w-full px-4 py-3.5 border border-white/10 rounded-[1.25rem] bg-white/5 text-white placeholder-gray-500 focus:bg-white/10 focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all text-sm font-medium" required {{ !$device_brand ? 'disabled' : '' }}>
                                <option value="" disabled selected class="bg-[#020617] text-white">{{ !$device_brand ? 'Select brand first' : 'Select Model' }}</option>
                                @foreach($this->models as $model)
                                    <option value="{{ $model->name }}" class="bg-[#020617] text-white">{{ $model->name }}</option>
                                @endforeach
                                <option value="Other" class="bg-[#020617] text-white">Other</option>
                            </select>
                            @error('device_model') <span class="text-xs text-red-500 mt-1 block ml-1">{{ $message }}</span> @enderror
                        </div>
                    @else
                        <!-- If Other Brand is selected, allow Custom input for both Brand and Model -->
                        <div class="col-span-1 md:col-span-2">
                            <div class="flex items-center justify-between mb-2">
                                <label class="block text-sm font-bold text-gray-300 ml-1">Brand</label>
                                <button type="button" wire:click="$set('device_brand', '')" class="text-xs font-black text-blue-400 hover:text-blue-300 flex items-center gap-1">
                                    <span class="material-symbols-outlined text-[14px]">arrow_back</span> Choose standard brand
                                </button>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="custom_brand" class="block text-xs font-bold text-gray-400 mb-2 ml-1">Custom Brand Name</label>
                                    <input type="text" id="custom_brand" wire:model="custom_brand" placeholder="e.g., Nothing, Motorola..." class="w-full px-4 py-3.5 border border-white/10 rounded-[1.25rem] bg-white/5 text-white placeholder-gray-500 focus:bg-white/10 focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all text-sm font-medium" required>
                                    @error('custom_brand') <span class="text-xs text-red-500 mt-1 block ml-1">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label for="custom_model" class="block text-xs font-bold text-gray-400 mb-2 ml-1">Exact Model Name</label>
                                    <input type="text" id="custom_model" wire:model="custom_model" placeholder="e.g., Phone (2), Edge 40..." class="w-full px-4 py-3.5 border border-white/10 rounded-[1.25rem] bg-white/5 text-white placeholder-gray-500 focus:bg-white/10 focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all text-sm font-medium" required>
                                    @error('custom_model') <span class="text-xs text-red-500 mt-1 block ml-1">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Custom model input if standard brand is selected, but "Other" model is chosen -->
                @if($device_brand && $device_brand !== 'Other' && $device_model === 'Other')
                <div class="mb-6">
                    <label for="custom_model_only" class="block text-sm font-bold text-gray-300 mb-2 ml-1">Specify Your Model Name</label>
                    <input type="text" id="custom_model_only" wire:model="custom_model" placeholder="e.g., iPhone 16 Pro Max, Galaxy S25 Ultra..." class="w-full px-4 py-3.5 border border-white/10 rounded-[1.25rem] bg-white/5 text-white placeholder-gray-500 focus:bg-white/10 focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all text-sm font-medium" required>
                    @error('custom_model') <span class="text-xs text-red-500 mt-1 block ml-1">{{ $message }}</span> @enderror
                </div>
                @endif
            </section>



            <!-- Service Details -->
            <section>
                <h3 class="text-lg font-bold text-white border-b border-white/5 pb-3 mb-6 flex items-center gap-2.5">
                    <span class="material-symbols-outlined text-[20px] leading-none text-blue-400 bg-blue-500/10 p-1.5 rounded-xl shrink-0 transform translate-y-[1px]">build</span>
                    <span class="leading-none">Service Details</span>
                </h3>

                <!-- Fault Category with prices -->
                <div>
                    <label for="fault_category" class="block text-sm font-bold text-gray-300 mb-2 ml-1">Service / Issue Type</label>
                    <select id="fault_category" wire:model.live="fault_category" class="w-full px-4 py-3.5 border border-white/10 rounded-[1.25rem] bg-white/5 text-white placeholder-gray-500 focus:bg-white/10 focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all text-sm font-medium" required>
                        <option value="" disabled selected class="bg-[#020617] text-white">Select the service or issue…</option>
                        @foreach($this->faultTypes as $fault)
                            <option value="{{ $fault->name }}" class="bg-[#020617] text-white">
                                {{ $fault->name }} — ₱{{ number_format($fault->base_price, 2) }}
                            </option>
                        @endforeach
                        <option value="Other" class="bg-[#020617] text-white">Other / Custom Service</option>
                    </select>
                    @error('fault_category') <span class="text-xs text-red-500 mt-1 block ml-1">{{ $message }}</span> @enderror

                    @if($fault_category === 'Other')
                    <div class="mt-4">
                        <label for="custom_service" class="block text-sm font-bold text-gray-300 mb-2 ml-1">Custom Service Name / Describe Issue</label>
                        <input type="text" id="custom_service" wire:model.live="custom_service" placeholder="e.g. Broken hinge, Water damage repair, Custom housing mod..." class="w-full px-4 py-3.5 border border-white/10 rounded-[1.25rem] bg-white/5 text-white placeholder-gray-500 focus:bg-white/10 focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all text-sm font-medium" required>
                        @error('custom_service') <span class="text-xs text-red-500 mt-1 block ml-1">{{ $message }}</span> @enderror
                    </div>
                    @elseif($fault_category)
                    @php $selectedFault = \App\Models\FaultType::where('name', $fault_category)->first(); @endphp
                    @if($selectedFault)
                    <div class="mt-3 flex items-center gap-2.5 px-4 py-2.5 bg-blue-500/10 border border-blue-500/20 rounded-xl">
                        <span class="material-symbols-outlined text-[18px] leading-none text-blue-400 shrink-0">sell</span>
                        <span class="text-sm font-bold text-blue-300 leading-none">
                            Est. starting price:
                            <span class="text-blue-400">₱{{ number_format($selectedFault->base_price, 2) }}</span>
                        </span>
                        <span class="text-xs text-blue-500 leading-none">· May vary</span>
                    </div>
                    @endif
                    @endif
                </div>
            </section>

            <!-- Issue Description -->
            <section>
                <h3 class="text-lg font-bold text-white border-b border-white/5 pb-3 mb-6 flex items-center gap-2.5">
                    <span class="material-symbols-outlined text-[20px] leading-none text-blue-400 bg-blue-500/10 p-1.5 rounded-xl shrink-0 transform translate-y-[1px]">description</span>
                    <span class="leading-none">Issue Description</span>
                </h3>
                <div class="mb-8">
                    <label for="description" class="block text-sm font-bold text-gray-300 mb-2 ml-1">Describe the problem in detail</label>
                    <textarea id="description" wire:model="description" rows="4" placeholder="How did it happen? Are there any secondary issues?" class="w-full px-4 py-3.5 border border-white/10 rounded-[1.25rem] bg-white/5 text-white placeholder-gray-500 focus:bg-white/10 focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all text-sm font-medium resize-none" required></textarea>
                    @error('description') <span class="text-xs text-red-500 mt-1 block ml-1">{{ $message }}</span> @enderror
                </div>

                <!-- Media Upload (1 Video Max 100MB, 4 Photos Max 2MB each) -->
                <div>
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 mb-4 ml-1">
                        <label class="block text-sm font-bold text-gray-300">Upload Device Media <span class="text-gray-400 font-normal">(Optional)</span></label>
                        <span class="text-[10px] font-black text-blue-400 bg-blue-500/10 border border-blue-500/20 rounded-full px-3 py-1 uppercase tracking-wider w-max">
                            Storage Limits: 1 Video (100MB max - MP4, WEBM) & 4 Photos (2MB each max - JPEG, JPG, PNG)
                        </span>
                    </div>

                    <div class="grid grid-cols-2 md:grid-cols-5 gap-4">
                        <!-- Video Slot (Slot 1) -->
                        <div class="aspect-square relative group col-span-1">
                            @if($video)
                            <div class="w-full h-full rounded-2xl overflow-hidden border-2 border-blue-500/30 shadow-md relative flex items-center justify-center bg-black">
                                <video src="{{ $video->temporaryUrl() }}" class="w-full h-full object-cover" muted playsinline></video>
                                <span class="material-symbols-outlined absolute text-white/85 text-[32px] pointer-events-none">play_circle</span>
                                <div class="absolute inset-0 bg-black/20 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                                <button type="button" wire:click="$set('video', null)"
                                    class="absolute top-2 right-2 text-red-500 hover:text-red-700 w-6 h-6 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-200 z-20 shrink-0">
                                    <span class="material-symbols-outlined text-[20px] leading-none font-black select-none">close</span>
                                </button>
                            </div>
                            @else
                            <label class="w-full h-full flex flex-col items-center justify-center border-2 border-dashed border-blue-500/30 rounded-[1.25rem] bg-[#0d1527]/50 hover:bg-[#0d1527]/80 hover:border-blue-500 transition-all cursor-pointer group hover:shadow-lg transform hover:-translate-y-0.5">
                                <input type="file" wire:model="video" class="hidden" accept="video/mp4,video/webm">
                                <span class="material-symbols-outlined text-[32px] leading-none text-blue-400 group-hover:text-blue-500 transition-colors">videocam</span>
                                <span class="text-[9px] font-black text-blue-400 mt-1.5 uppercase tracking-wider text-center px-1">Upload Video</span>
                                <span class="text-[8px] font-bold text-gray-400 mt-0.5">Max 100MB (MP4, WEBM)</span>
                            </label>
                            @endif
                            <div wire:loading.flex wire:target="video" class="absolute inset-0 w-full h-full bg-black/80 backdrop-blur-[2px] rounded-2xl flex items-center justify-center z-30">
                                <span class="material-symbols-outlined animate-spin text-blue-500 text-2xl leading-none">progress_activity</span>
                            </div>
                        </div>

                        <!-- Photo Slots (Slots 2-5) -->
                        @for ($i = 0; $i < 4; $i++)
                        <div class="aspect-square relative group col-span-1">
                            @if(isset($photos[$i]) && $photos[$i])
                            <div class="w-full h-full rounded-2xl overflow-hidden border-2 border-white/10 shadow-md relative">
                                <img src="{{ $photos[$i]->temporaryUrl() }}" class="w-full h-full object-cover">
                                <div class="absolute inset-0 bg-black/20 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                                <button type="button" wire:click="$set('photos.{{ $i }}', null)"
                                    class="absolute top-2 right-2 text-red-500 hover:text-red-700 w-6 h-6 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-200 z-20 shrink-0">
                                    <span class="material-symbols-outlined text-[20px] leading-none font-black select-none">close</span>
                                </button>
                            </div>
                            @else
                            <label class="w-full h-full flex flex-col items-center justify-center border-2 border-dashed border-white/10 rounded-[1.25rem] bg-[#0d1527]/50 hover:bg-[#0d1527]/80 hover:border-blue-500 transition-all cursor-pointer group hover:shadow-lg transform hover:-translate-y-0.5">
                                <input type="file" wire:model="photos.{{ $i }}" class="hidden" accept="image/jpeg,image/png,image/jpg">
                                <span class="material-symbols-outlined text-[28px] leading-none text-gray-400 group-hover:text-blue-400 transition-colors">add_a_photo</span>
                                <span class="text-[9px] font-black text-gray-400 mt-1.5 group-hover:text-blue-500 uppercase tracking-wider">Photo Slot {{ $i + 1 }}</span>
                                <span class="text-[8px] font-bold text-gray-400 mt-0.5">Max 2MB (JPEG, JPG, PNG)</span>
                            </label>
                            @endif
                            <div wire:loading.flex wire:target="photos.{{ $i }}" class="absolute inset-0 w-full h-full bg-black/80 backdrop-blur-[2px] rounded-2xl flex items-center justify-center z-30">
                                <span class="material-symbols-outlined animate-spin text-blue-500 text-2xl leading-none">progress_activity</span>
                            </div>
                        </div>
                        @endfor
                    </div>

                    <p class="text-[11px] text-gray-400 mt-4 px-1 font-medium flex items-center gap-1.5">
                        <span class="material-symbols-outlined text-[14px] leading-none text-blue-400 shrink-0">tips_and_updates</span>
                        <span class="leading-none">Adding a short video showing the boot loop, screen flicker, or damage, plus close-up photos, helps our team analyze your issue faster!</span>
                    </p>
                    @error('video') <span class="text-xs text-red-500 mt-1 block ml-1">{{ $message }}</span> @enderror
                    @error('photos.*') <span class="text-xs text-red-500 mt-1 block ml-1">{{ $message }}</span> @enderror
                </div>
            </section>

            <!-- Schedule Drop-off -->
            <section>
                <div class="flex items-center justify-between gap-3 border-b border-white/5 pb-3 mb-6">
                    <h3 class="text-lg font-bold text-white flex items-center gap-2.5">
                        <span class="material-symbols-outlined text-[20px] leading-none text-blue-400 bg-blue-500/10 p-1.5 rounded-xl shrink-0 transform translate-y-[1px]">calendar_month</span>
                        <span class="leading-none">Schedule Drop-off</span>
                    </h3>
                    <button type="button" @click="calendarModal = true"
                        class="w-8 h-8 rounded-full bg-blue-500/10 text-blue-400 flex items-center justify-center hover:bg-blue-600 hover:text-white transition-all transform hover:scale-110 active:scale-95 shadow-sm shrink-0"
                        title="Open Live Availability Calendar">
                        <span class="material-symbols-outlined text-[18px] leading-none">open_in_full</span>
                    </button>
                </div>

                <div class="space-y-8">
                    <!-- Date Cards -->
                    <div>
                        <label class="block text-sm font-bold text-gray-300 mb-4 ml-1">Select Available Date</label>
                        <div class="grid grid-cols-5 gap-3">
                            @foreach($available_days as $index => $day)
                            <button type="button"
                                wire:click="{{ $day['slots_left'] > 0 ? 'selectDate(' . $index . ')' : '' }}"
                                @disabled($day['slots_left'] <=0)
                                class="flex flex-col items-center justify-center py-4 px-2 rounded-[1.25rem] border-2 transition-all transform active:scale-95 relative
                                                     {{ $pref_date === $day['full']
                                                         ? 'border-blue-600 bg-blue-600 shadow-lg shadow-blue-900/30'
                                                         : ($day['slots_left'] <= 0
                                                             ? 'border-red-500/20 bg-red-950/10 cursor-not-allowed opacity-50'
                                                             : 'border-white/10 bg-white/3 hover:bg-white/5 hover:border-white/20 hover:scale-[1.03] shadow-sm cursor-pointer') }}">

                                <span class="text-[9px] font-black uppercase tracking-widest mb-0.5
                                                        {{ $pref_date === $day['full'] ? 'text-blue-200' : ($day['slots_left'] <= 0 ? 'text-red-400/40' : 'text-gray-400') }}">
                                    {{ $day['month'] }}
                                </span>
                                <span class="text-2xl font-black mb-0.5
                                                        {{ $pref_date === $day['full'] ? 'text-white' : ($day['slots_left'] <= 0 ? 'text-red-400/40' : 'text-white') }}">
                                    {{ $day['date'] }}
                                </span>
                                <span class="text-[10px] font-bold mb-2
                                                        {{ $pref_date === $day['full'] ? 'text-blue-100' : ($day['slots_left'] <= 0 ? 'text-red-400/40' : 'text-gray-400') }}">
                                    {{ $day['day'] }}
                                </span>
                                <div class="flex items-center gap-1 py-0.5 px-2 rounded-full text-[8px] font-black uppercase
                                                        {{ $pref_date === $day['full'] ? 'bg-white/25 text-white'
                                                            : ($day['slots_left'] <= 0 ? 'bg-red-500/20 text-red-400'
                                                            : ($day['slots_left'] <= 1 ? 'bg-orange-500/20 text-orange-400'
                                                            : 'bg-emerald-500/20 text-emerald-400')) }}">
                                    @if($day['slots_left'] <= 0)
                                        <span class="w-1 h-1 bg-red-400 rounded-full animate-pulse"></span> FULL
                                    @elseif($day['slots_left'] <= 1)
                                        <span class="w-1 h-1 bg-orange-400 rounded-full animate-pulse"></span> 1 SLOT
                                    @else
                                        <span class="w-1 h-1 bg-emerald-400 rounded-full"></span> {{ $day['slots_left'] }}
                                    @endif
                                </div>
                            </button>
                            @endforeach
                        </div>
                        @error('pref_date') <span class="text-xs text-red-500 mt-2 block ml-1">{{ $message }}</span> @enderror
                    </div>

                    <!-- Time Slots -->
                    @php
                        $selectedDay = null;
                        if ($pref_date) {
                            foreach ($available_days as $d) {
                                if ($d['full'] === $pref_date) {
                                    $selectedDay = $d;
                                    break;
                                }
                            }
                        }
                    @endphp
                    @if($selectedDay)
                    <div>
                        <label class="block text-sm font-bold text-gray-300 mb-4 ml-1">Select Preferred Time Slot</label>
                        <div class="grid grid-cols-5 gap-3">
                            @foreach($available_slots as $slot)
                            @php
                            $bookedCount = $selectedDay['slot_status'][$slot] ?? 0;
                            $isFull = $bookedCount >= 1;
                            $isSelected = $pref_time === $slot;
                            @endphp
                            <button type="button"
                                 @if(!$isFull) wire:click="selectTime('{{ $slot }}')" @endif
                                 @disabled($isFull)
                                 class="py-4 px-2 rounded-[1.25rem] border-2 font-black text-sm transition-all flex items-center justify-center gap-2 outline-none
                                                             {{ $isSelected
                                                                 ? 'border-blue-600 bg-blue-600 text-white shadow-lg shadow-blue-900/30 scale-[1.02]'
                                                                 : ($isFull
                                                                     ? 'border-red-500/20 bg-red-950/10 text-red-400/40 cursor-not-allowed opacity-50'
                                                                     : 'border-white/10 bg-white/3 text-gray-300 hover:bg-white/5 hover:border-white/20 hover:scale-[1.02] cursor-pointer') }}">
                                 @if($isSelected)
                                 <span class="w-2 h-2 rounded-full bg-white inline-block animate-pulse"></span>
                                 @endif
                                 {{ $slot }}
                             </button>
                            @endforeach
                        </div>
                        @error('pref_time') <span class="text-xs text-red-500 mt-2 block ml-1">{{ $message }}</span> @enderror
                    </div>
                    @endif
                </div>
            </section>

            <!-- Submit -->
            <div class="pt-6 border-t border-white/5 flex justify-end">
                <button type="submit" class="flex items-center justify-center gap-2 bg-blue-600 text-white hover:bg-blue-500 w-full sm:w-auto px-10 py-4 text-base rounded-[1.25rem] font-bold transition-all shadow-lg shadow-blue-600/20 hover:shadow-blue-500/20 disabled:opacity-70" wire:loading.attr="disabled">
                    <span class="material-symbols-outlined text-[20px] leading-none" wire:loading.remove wire:target="prepareReview">rate_review</span>
                    <span class="material-symbols-outlined text-[20px] animate-spin leading-none" wire:loading wire:target="prepareReview">progress_activity</span>
                    Review Details
                </button>
            </div>

        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            window.addEventListener('toast', event => {
                let detail = event.detail || {};
                if (Array.isArray(detail)) {
                    detail = detail[0] || {};
                } else if (detail.message === undefined && detail[0]) {
                    detail = detail[0];
                }
                
                if (detail.type === 'error') {
                    // Wait for Livewire to inject error text elements
                    setTimeout(() => {
                        // Look for the first element with text-red-500 containing error message (excluding asterisks)
                        const firstErrorLabel = Array.from(document.querySelectorAll('.text-red-500')).find(el => el.textContent.trim() !== '*');
                        if (firstErrorLabel) {
                            const parentDiv = firstErrorLabel.closest('div') || firstErrorLabel;
                            parentDiv.scrollIntoView({ behavior: 'smooth', block: 'center' });
                            
                            // Try to find the associated input/select/textarea in the same div and focus it
                            const associatedInput = parentDiv.querySelector('input, select, textarea');
                            if (associatedInput) {
                                associatedInput.focus({ preventScroll: true });
                            }
                            return;
                        }

                        // Fallback: look for blank required elements
                        const requiredFields = Array.from(document.querySelectorAll('form[novalidate] input[required], form[novalidate] select[required], form[novalidate] textarea[required]'));
                        const firstBlankField = requiredFields.find(el => !el.value.trim());
                        if (firstBlankField) {
                            const parentDiv = firstBlankField.closest('div') || firstBlankField;
                            parentDiv.scrollIntoView({ behavior: 'smooth', block: 'center' });
                            firstBlankField.focus({ preventScroll: true });
                        }
                    }, 150);
                }
            });
        });
        
        function addressSearch(wire) {
            return {
                query: '',
                results: [],
                loading: false,
                searched: false,
                barangays: [],
                altBarangays: [],
                get useSameAddress() {
                    return wire.get('use_same_address');
                },
                async init() {
                    this.$watch('$wire.city', async (newCity) => {
                        this.barangays = await this.loadBarangays(newCity);
                        if (this.useSameAddress) {
                            this.syncAddresses();
                        }
                    });

                    this.$watch('$wire.alt_city', async (newCity) => {
                        if (!this.useSameAddress) {
                            this.altBarangays = await this.loadBarangays(newCity);
                        }
                    });

                    this.$watch('$wire.address', () => { if (this.useSameAddress) this.syncAddresses(); });
                    this.$watch('$wire.barangay', (value) => {
                        if (value && !this.barangays.includes(value)) {
                            this.barangays.push(value);
                        }
                        if (this.useSameAddress) this.syncAddresses();
                    });

                    this.$watch('$wire.use_same_address', (val) => {
                        if (val) {
                            this.syncAddresses();
                        }
                    });
                    
                    if (wire.get('city')) {
                        this.barangays = await this.loadBarangays(wire.get('city'));
                    }
                    if (wire.get('barangay')) {
                        const b = wire.get('barangay');
                        if (b && !this.barangays.includes(b)) {
                            this.barangays.push(b);
                        }
                    }
                    if (wire.get('alt_city')) {
                        this.altBarangays = await this.loadBarangays(wire.get('alt_city'));
                    }
                    if (wire.get('alt_barangay')) {
                        const ab = wire.get('alt_barangay');
                        if (ab && !this.altBarangays.includes(ab)) {
                            this.altBarangays.push(ab);
                        }
                    }
                    if (this.useSameAddress) {
                        this.syncAddresses();
                    }
                },
                async getCityCode(cityName) {
                    try {
                        const response = await fetch('https://psgc.gitlab.io/api/regions/130000000/cities-municipalities/');
                        const cities = await response.json();
                        const normalizedInput = cityName.toLowerCase().replace(/city of|city/g, '').trim();
                        const found = cities.find(c => {
                            const normalizedName = c.name.toLowerCase().replace(/city of|city/g, '').trim();
                            return normalizedName === normalizedInput;
                        });
                        return found ? found.code : null;
                    } catch (e) {
                        console.error('Error fetching city code:', e);
                        return null;
                    }
                },
                async loadBarangays(cityName) {
                    if (!cityName) return [];
                    const cityCode = await this.getCityCode(cityName);
                    if (!cityCode) return [];
                    try {
                        const response = await fetch(`https://psgc.gitlab.io/api/cities-municipalities/${cityCode}/barangays/`);
                        const list = await response.json();
                        return list.map(b => b.name).sort((a, b) => a.localeCompare(b));
                    } catch (e) {
                        console.error('Error loading barangays:', e);
                        return [];
                    }
                },
                syncAddresses() {
                    wire.set('alt_address', wire.get('address'));
                    wire.set('alt_barangay', wire.get('barangay'));
                    wire.set('alt_city', wire.get('city'));
                    this.altBarangays = this.barangays;
                },
                async search() {
                    if (this.query.length < 3) {
                        this.results = [];
                        this.loading = false;
                        this.searched = false;
                        return;
                    }
                    this.loading = true;
                    this.searched = false;
                    try {
                        const selectedCity = wire.get('city');
                        let searchQuery = this.query;
                        if (selectedCity) {
                            searchQuery += ', ' + selectedCity;
                        }
                        const response = await fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(searchQuery)}&countrycodes=ph&limit=5&addressdetails=1`);
                        this.results = await response.json();
                    } catch(e) {
                        this.results = [];
                    }
                    this.loading = false;
                    this.searched = true;
                },
                select(result) {
                    this.query = result.display_name;
                    this.results = [];
                    this.searched = false;
                    
                    const addr = result.address || {};
                    const barangay = addr.quarter || addr.suburb || addr.neighbourhood || addr.village || addr.hamlet || '';
                    const road = addr.road || '';
                    const houseNumber = addr.house_number || '';
                    
                    let streetAddress = '';
                    if (houseNumber) streetAddress += houseNumber + ' ';
                    if (road) streetAddress += road;
                    
                    const city = addr.city || addr.town || addr.municipality || addr.province || '';
                    
                    if (streetAddress) {
                        wire.set('address', streetAddress);
                    }
                    if (city) {
                        wire.set('city', city);
                    }
                    if (barangay) {
                        if (!this.barangays.includes(barangay)) {
                            this.barangays.push(barangay);
                        }
                        wire.set('barangay', barangay);
                    }
                    
                    window.dispatchEvent(new CustomEvent('location-selected', { detail: { lat: result.lat, lng: result.lon } }));
                }
            }
        }

        function pickupMapComponent(wire) {
            return {
                map: null,
                marker: null,
                init() {
                    if (!document.getElementById('leaflet-css')) {
                        const css = document.createElement('link');
                        css.id = 'leaflet-css';
                        css.rel = 'stylesheet';
                        css.href = 'https://unpkg.com/leaflet@1.9.4/dist/leaflet.css';
                        document.head.appendChild(css);
                    }
                    if (typeof L === 'undefined') {
                        const script = document.createElement('script');
                        script.src = 'https://unpkg.com/leaflet@1.9.4/dist/leaflet.js';
                        script.onload = () => this.initMap();
                        document.head.appendChild(script);
                    } else {
                        this.initMap();
                    }
                    
                    this.$watch('$wire.city', (value) => {
                        if (value && this.map && this.marker) {
                            this.centerMapOnCity(value);
                        }
                    });
                    
                    window.addEventListener('location-selected', (e) => {
                        if (this.map && this.marker) {
                            const latlng = e.detail;
                            this.map.setView(latlng, 17);
                            this.marker.setLatLng(latlng);
                            this.geocodePosition(latlng);
                        }
                    });
                },
                initMap() {
                    const defaultLat = 14.6956;
                    const defaultLng = 121.0950;
                    
                    setTimeout(() => {
                        this.map = L.map('pickup-map').setView([defaultLat, defaultLng], 15);
                        
                        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                            maxZoom: 19,
                            attribution: '© OpenStreetMap'
                        }).addTo(this.map);
                        
                        this.marker = L.marker([defaultLat, defaultLng], {
                            draggable: true
                        }).addTo(this.map);
                        
                        this.marker.on('dragend', () => {
                            const position = this.marker.getLatLng();
                            this.geocodePosition(position);
                        });
                        
                        this.map.on('click', (e) => {
                            this.marker.setLatLng(e.latlng);
                            this.geocodePosition(e.latlng);
                        });
                    }, 300);
                },
                async centerMapOnCity(cityName) {
                    try {
                        const response = await fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(cityName)}&countrycodes=ph&limit=1`);
                        const data = await response.json();
                        if (data && data.length > 0) {
                            const latlng = { lat: parseFloat(data[0].lat), lng: parseFloat(data[0].lon) };
                            this.map.setView(latlng, 14);
                            this.marker.setLatLng(latlng);
                        }
                    } catch (e) {
                        console.error('Error centering map on city:', e);
                    }
                },
                async geocodePosition(latlng) {
                    try {
                        const response = await fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${latlng.lat}&lon=${latlng.lng}&zoom=18&addressdetails=1&countrycodes=ph`);
                        const data = await response.json();
                        if (data && data.address) {
                            const addr = data.address;
                            const barangay = addr.quarter || addr.suburb || addr.neighbourhood || addr.village || addr.hamlet || '';
                            const road = addr.road || '';
                            const houseNumber = addr.house_number || '';
                            
                            let streetAddress = '';
                            if (houseNumber) streetAddress += houseNumber + ' ';
                            if (road) streetAddress += road;
                            
                            const city = addr.city || addr.town || addr.municipality || addr.province || '';
                            
                            if (streetAddress) {
                                wire.set('address', streetAddress);
                            }
                            if (city) {
                                wire.set('city', city);
                            }
                            if (barangay) {
                                wire.set('barangay', barangay);
                            }
                        }
                    } catch (error) {
                        console.error('Geocoding error:', error);
                    }
                }
            };
        }
    </script>
</div>

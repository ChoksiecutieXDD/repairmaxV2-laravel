<div class="w-full max-w-7xl mx-auto px-4 py-2">
    <!-- Top Nav / Back & Actions Header -->
    <div class="mb-8 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 bg-white p-6 rounded-2xl border border-brand-200 shadow-sm">
        <div class="flex items-center gap-3">
            <a href="{{ route('user.upcoming-appointments') }}" class="w-10 h-10 rounded-full bg-gray-50 hover:bg-gray-100 flex items-center justify-center border border-brand-200 transition-colors text-gray-500 hover:text-gray-900" title="Back to Upcoming Appointments">
                <span class="material-symbols-outlined text-[20px]">arrow_back</span>
            </a>
            <div>
                <div class="flex items-center gap-2 flex-wrap">
                    <h1 class="text-2xl font-black text-gray-900 tracking-tight mb-0">Appointment Details</h1>
                    <span class="font-mono text-xs bg-gray-100 text-gray-600 px-3 py-1 rounded-lg font-bold border border-brand-200">
                        {{ $appointment->booking_number }}
                    </span>
                </div>
                <p class="text-xs text-gray-400 mt-1">Booked on {{ $appointment->created_at->format('M d, Y \a\t h:i A') }} ({{ $appointment->created_at->diffForHumans() }})</p>
            </div>
        </div>

        <div class="flex items-center gap-2 flex-wrap">
            @php
                $statusClasses = [
                    'Completed' => 'bg-green-50 text-green-700 border-green-200',
                    'In Progress' => 'bg-orange-50 text-orange-700 border-orange-200',
                    'Ready for Pickup' => 'bg-blue-50 text-blue-700 border-blue-200',
                    'Scheduled' => 'bg-indigo-50 text-indigo-700 border-indigo-200',
                    'Pending' => 'bg-gray-100 text-gray-700 border-brand-200',
                    'Cancelled' => 'bg-red-50 text-red-700 border-red-200',
                ];
                $badgeClass = $statusClasses[$appointment->status] ?? $statusClasses['Pending'];
            @endphp
            <span class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl text-xs font-black border {{ $badgeClass }} uppercase tracking-wider">
                <span class="w-2 h-2 rounded-full {{ $appointment->status == 'In Progress' ? 'bg-orange-500 animate-pulse' : 'bg-current' }}"></span>
                {{ $appointment->status }}
            </span>
        </div>
    </div>

    @if (session()->has('success'))
        <div class="mb-6 p-4 rounded-xl bg-green-50 border border-green-200 text-green-700 font-bold text-sm flex items-center gap-2">
            <span class="material-symbols-outlined text-green-600 text-lg">check_circle</span>
            {{ session('success') }}
        </div>
    @endif

    <!-- Main Grid Content -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">
        
        <!-- Left Column: Device Info & Attached Media -->
        <div class="col-span-1 lg:col-span-7 space-y-6">
            
            <!-- Device & Service Details Card -->
            <div class="bg-white border border-brand-200 rounded-3xl overflow-hidden shadow-sm">
                <div class="px-6 py-4 bg-gray-50 border-b border-brand-100 flex items-center">
                    <h3 class="font-bold text-gray-900 text-sm mb-0 flex items-center gap-2">
                        <span class="material-symbols-outlined text-gray-400 text-[20px]">devices</span>
                        Device & Problem Breakdown
                    </h3>
                </div>
                <div class="p-6 space-y-5">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <div class="bg-gray-50 p-4 rounded-2xl border border-brand-100">
                            <span class="text-[10px] uppercase font-mono font-bold text-gray-400 block tracking-wider">Device Brand</span>
                            <span class="font-bold text-gray-900 mt-1 block">{{ $appointment->device_brand ?? 'N/A' }}</span>
                        </div>
                        <div class="bg-gray-50 p-4 rounded-2xl border border-brand-100">
                            <span class="text-[10px] uppercase font-mono font-bold text-gray-400 block tracking-wider">Device Model</span>
                            <span class="font-bold text-gray-900 mt-1 block">{{ $appointment->device_model ?? 'N/A' }}</span>
                        </div>
                        <div class="bg-gray-50 p-4 rounded-2xl border border-brand-100 sm:col-span-2">
                            <span class="text-[10px] uppercase font-mono font-bold text-gray-400 block tracking-wider">Issue Category</span>
                            <span class="font-bold text-gray-900 mt-1 block">{{ $appointment->fault_category ?? 'N/A' }}</span>
                        </div>
                    </div>

                    <div class="bg-gray-50 p-5 rounded-2xl border border-brand-100">
                        <span class="text-[10px] uppercase font-mono font-bold text-gray-400 block tracking-wider mb-2">Description of the issue</span>
                        @php
                            $rawDesc = $appointment->description ?? '';
                            $descClean = str_replace(["\r\n", "\r"], "\n", $rawDesc);
                            
                            $parsedIssue = 'No description provided.';
                            if (preg_match('/Issue\s+Description\s*:\s*(.*?)(?=\s*(?:Service\s+Method\s*:|Pickup\s+Address\s*:|$))/is', $descClean, $match)) {
                                $parsedIssue = trim($match[1]);
                            } else {
                                $parsedIssue = $descClean ?: 'No description provided.';
                            }
                        @endphp
                        @if(!empty(trim($parsedIssue)) && strtolower(trim($parsedIssue)) !== 'n/a')
                            <p class="text-gray-700 leading-relaxed text-sm whitespace-pre-wrap">{{ $parsedIssue }}</p>
                        @else
                            <div class="flex items-center gap-2 text-gray-400 py-1">
                                <span class="material-symbols-outlined text-base">info</span>
                                <span class="text-xs font-semibold italic">No description provided</span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Attached Media Files -->
            <div class="bg-white border border-brand-200 rounded-3xl overflow-hidden shadow-sm">
                <div class="px-6 py-4 bg-gray-50 border-b border-brand-100 flex items-center">
                    <h3 class="font-bold text-gray-900 text-sm mb-0 flex items-center gap-2">
                        <span class="material-symbols-outlined text-gray-400 text-[20px]">attach_file</span>
                        Attached Media Uploads
                    </h3>
                </div>
                <div class="p-6">
                    @if($appointment->photo_paths && count($appointment->photo_paths) > 0)
                        <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
                            @foreach($appointment->photo_paths as $photo)
                                @php
                                    $isVideo = in_array(strtolower(pathinfo($photo, PATHINFO_EXTENSION)), ['mp4', 'mov', 'avi', 'webm', 'mpeg', 'mkv', '3gp']);
                                @endphp
                                @if($isVideo)
                                    <div class="aspect-square bg-gray-100 rounded-2xl border border-brand-200 overflow-hidden relative flex items-center justify-center shadow-sm hover:shadow transition-shadow">
                                        <video src="{{ asset('storage/' . $photo) }}" class="w-full h-full object-cover" controls muted playsinline></video>
                                    </div>
                                @else
                                    <div class="aspect-square bg-gray-100 rounded-2xl border border-brand-200 overflow-hidden group shadow-sm hover:shadow transition-shadow relative">
                                        <a href="{{ asset('storage/' . $photo) }}" target="_blank" class="block w-full h-full">
                                            <img src="{{ asset('storage/' . $photo) }}" alt="Device photo" class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-300">
                                        </a>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-10 text-gray-400 bg-gray-55/5 rounded-2xl border border-dashed border-brand-200">
                            <span class="material-symbols-outlined text-4xl mb-2">image_not_supported</span>
                            <p class="text-sm font-medium">No media uploaded for this appointment.</p>
                        </div>
                    @endif
                </div>
            </div>

        </div>

        <!-- Right Column: Logistics, Financials & Actions -->
        <div class="col-span-1 lg:col-span-5 space-y-6">
            
            <!-- Schedule & Timing Details -->
            <div class="bg-white border border-brand-200 rounded-3xl overflow-hidden shadow-sm">
                <div class="px-6 py-4 bg-gray-50 border-b border-brand-100 flex items-center">
                    <h3 class="font-bold text-gray-900 text-sm mb-0 flex items-center gap-2">
                        <span class="material-symbols-outlined text-gray-400 text-[20px]">calendar_clock</span>
                        Schedule & Tracking
                    </h3>
                </div>
                <div class="p-6 space-y-4">
                    <div class="flex items-center gap-3 bg-blue-50/50 p-4 rounded-2xl border border-blue-100">
                        <span class="material-symbols-outlined text-blue-600 text-[28px]">schedule</span>
                        <div>
                            <span class="text-[10px] text-blue-600 font-bold uppercase tracking-wider block">Preferred Schedule Date</span>
                            <span class="font-extrabold text-blue-900 text-sm">
                                {{ $appointment->pref_date ? \Carbon\Carbon::parse($appointment->pref_date)->format('M d, Y') : 'N/A' }} 
                                @ {{ $appointment->pref_time ? \Carbon\Carbon::parse($appointment->pref_time)->format('h:i A') : 'N/A' }}
                            </span>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-gray-50 p-4 rounded-xl border border-brand-100">
                            <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest block">Booking No.</span>
                            <span class="font-mono font-bold text-gray-900 text-sm mt-1 block">{{ $appointment->booking_number ?? 'N/A' }}</span>
                        </div>
                        <div class="bg-gray-50 p-4 rounded-xl border border-brand-100">
                            <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest block">Service Method</span>
                            <span class="font-bold text-gray-900 text-sm mt-1 block">{{ $appointment->service_method === 'Pickup' ? 'Home Pickup' : 'Shop Drop-off' }}</span>
                        </div>
                    </div>

                    @if($appointment->service_method === 'Pickup')
                        @if(!empty(trim($appointment->address ?? '')))
                            <div class="bg-gray-50 p-4 rounded-2xl border border-brand-100">
                                <span class="text-[10px] uppercase font-mono font-bold text-gray-400 block tracking-wider mb-1">Pickup Address</span>
                                <p class="font-semibold text-gray-800 text-sm leading-relaxed">
                                    {{ $appointment->address }}
                                    @if($appointment->barangay), Brgy. {{ $appointment->barangay }}@endif
                                    @if($appointment->city), {{ $appointment->city }}@endif
                                </p>
                                @if($appointment->alt_address && ($appointment->alt_address !== $appointment->address || $appointment->alt_barangay !== $appointment->barangay || $appointment->alt_city !== $appointment->city))
                                    <div class="mt-2.5 pt-2.5 border-t border-gray-200/50">
                                        <span class="text-[9px] uppercase font-mono font-bold text-gray-400 block tracking-wider mb-0.5">Alternative Address</span>
                                        <p class="font-semibold text-gray-650 text-xs leading-relaxed">
                                            {{ $appointment->alt_address }}
                                            @if($appointment->alt_barangay), Brgy. {{ $appointment->alt_barangay }}@endif
                                            @if($appointment->alt_city), {{ $appointment->alt_city }}@endif
                                        </p>
                                    </div>
                                @endif
                            </div>
                        @else
                            <div class="bg-red-50/50 p-4 rounded-2xl border border-red-200/60">
                                <span class="text-[10px] uppercase font-mono font-bold text-red-600 block tracking-wider mb-1">Pickup Address</span>
                                <div class="mb-2">
                                    <span class="inline-flex items-center gap-1 bg-red-100 text-red-700 px-2 py-0.5 rounded text-[10px] font-bold uppercase tracking-wider">Missing Address</span>
                                </div>
                                <p class="text-xs text-red-500 leading-relaxed">
                                    Please edit your appointment details below to provide a pickup address.
                                </p>
                            </div>
                        @endif
                    @else
                        <div class="bg-gray-50/50 p-4 rounded-2xl border border-brand-100 opacity-80">
                            <span class="text-[10px] uppercase font-mono font-bold text-gray-400 block tracking-wider mb-1">Pickup Address</span>
                            <div class="mb-2">
                                <span class="inline-flex items-center gap-1 bg-gray-150 text-gray-550 px-2 py-0.5 rounded text-[10px] font-bold uppercase tracking-wider">Not Required</span>
                            </div>
                            <p class="text-xs text-gray-400 leading-relaxed italic">
                                Shop Drop-off selected; no address is needed.
                            </p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Logistics & Financial Breakdown -->
            <div class="bg-white border border-brand-200 rounded-3xl overflow-hidden shadow-sm">
                <div class="px-6 py-4 bg-gray-50 border-b border-brand-100 flex items-center">
                    <h3 class="font-bold text-gray-900 text-sm mb-0 flex items-center gap-2">
                        <span class="material-symbols-outlined text-gray-400 text-[20px]">payments</span>
                        Financial Estimate Summary
                    </h3>
                </div>
                <div class="p-6">
                    @php
                        $pickupFee = $appointment->additional_fee ?? (($appointment->service_method === 'Pickup') ? 150 : 0);
                        $basePrice = ($appointment->quote ?? 0) - $pickupFee;
                        $isCustom = ($appointment->fault_category === 'Other' || str_contains(strtolower($appointment->description), 'custom service'));
                    @endphp
                    <div class="space-y-4 text-sm">
                        <div class="flex justify-between items-center text-gray-650">
                            <span>Base Service Quote ({{ $appointment->fault_category }})</span>
                            <span class="font-bold text-gray-900">
                                @if($isCustom && $basePrice <= 0)
                                    Pending diagnostic
                                @else
                                    ₱{{ number_format($basePrice, 2) }}
                                @endif
                            </span>
                        </div>
                        <div class="flex justify-between items-center text-gray-655">
                            <span>Service Method Fee</span>
                            <span class="font-bold text-gray-900">
                                @if($pickupFee > 0)
                                    ₱{{ number_format($pickupFee, 2) }}
                                @else
                                    Free
                                @endif
                            </span>
                        </div>
                        <div class="flex justify-between items-center text-gray-655 border-b border-brand-100 pb-4">
                            <span class="flex items-center gap-1">
                                Diagnostic Fee 
                                <span class="text-[9px] font-black text-blue-500 bg-blue-50 px-1.5 py-0.5 rounded uppercase" title="Charged only if you decline repair after diagnostic check">Conditional</span>
                            </span>
                            <span class="font-bold text-gray-900">₱150.00</span>
                        </div>
                        <div class="flex justify-between items-center pt-2">
                            <span class="text-base font-black text-gray-900">Estimated Total</span>
                            <span class="text-xl font-black text-blue-700">
                                @if($isCustom && $basePrice <= 0)
                                    ₱{{ number_format($pickupFee, 2) }} + Diagnostic / Quote
                                @else
                                    ₱{{ number_format(($appointment->quote ?? 0), 2) }}
                                @endif
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Completion Info (notes, final cost, invoice/receipt downloads) -->
            @if($appointment->status === 'Completed')
                <div class="bg-gradient-to-br from-emerald-50 to-white border border-emerald-200 rounded-3xl overflow-hidden shadow-sm">
                    <div class="px-6 py-4 bg-emerald-500 text-white flex items-center">
                        <h3 class="font-bold text-white text-sm mb-0 flex items-center gap-2">
                            <span class="material-symbols-outlined text-white text-[20px]">verified</span>
                            Completion Overview
                        </h3>
                    </div>
                    <div class="p-6 space-y-5">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div class="bg-white p-4 rounded-xl border border-emerald-100/60 shadow-sm">
                                <span class="text-[10px] text-gray-400 font-bold block uppercase tracking-wider">Final Paid Cost</span>
                                <span class="font-black text-gray-900 text-xl mt-1 block">₱{{ number_format($appointment->final_cost ?? 0, 2) }}</span>
                            </div>
                            <div class="bg-white p-4 rounded-xl border border-emerald-100/60 shadow-sm">
                                <span class="text-[10px] text-gray-400 font-bold block uppercase tracking-wider">Completed On</span>
                                <span class="font-bold text-gray-900 text-sm mt-1.5 block">
                                    {{ $appointment->completed_at ? \Carbon\Carbon::parse($appointment->completed_at)->format('M d, Y') : 'N/A' }}
                                </span>
                            </div>
                        </div>

                        @if($appointment->completion_notes)
                            <div class="bg-white p-4 rounded-2xl border border-emerald-100/60 shadow-sm">
                                <span class="text-[10px] text-gray-400 font-bold block uppercase tracking-wider mb-1">Technician Notes</span>
                                <p class="text-gray-700 text-sm leading-relaxed">{{ $appointment->completion_notes }}</p>
                            </div>
                        @endif

                        <div class="pt-2 flex flex-col gap-2.5">
                            @if($appointment->invoice_number)
                                <a href="{{ route('user.appointment.invoice-view', $appointment->id) }}" target="_blank" class="w-full inline-flex items-center justify-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white px-5 py-3 rounded-2xl font-bold transition-all text-xs uppercase tracking-wider shadow-md shadow-emerald-100">
                                    <span class="material-symbols-outlined text-[18px]">receipt</span>
                                    Download Invoice PDF
                                </a>
                            @endif
                            <a href="{{ route('user.appointment.receipt-view', $appointment->id) }}" target="_blank" class="w-full inline-flex items-center justify-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-5 py-3 rounded-2xl font-bold transition-all text-xs uppercase tracking-wider shadow-md shadow-blue-100">
                                    <span class="material-symbols-outlined text-[18px]">receipt_long</span>
                                    Download Receipt PDF
                            </a>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Interactive Actions Menu -->
            @if($appointment->status === 'Pending' || $appointment->status === 'Scheduled' || $appointment->status === 'Approved')
                <div class="bg-white border border-brand-200 rounded-3xl overflow-hidden shadow-sm">
                    <div class="px-6 py-4 bg-gray-50 border-b border-brand-100 flex items-center">
                        <h3 class="font-bold text-gray-900 text-sm mb-0 flex items-center gap-2">
                            <span class="material-symbols-outlined text-gray-400 text-[20px]">tune</span>
                            Appointment Controls
                        </h3>
                    </div>
                    <div class="p-6 flex flex-col gap-3">
                        <div class="grid grid-cols-2 gap-3">
                            <button wire:click="openEdit" class="inline-flex items-center justify-center gap-2 bg-white border border-brand-200 hover:bg-gray-50 text-gray-700 px-4 py-3 rounded-full text-xs font-bold transition-all shadow-sm">
                                <span class="material-symbols-outlined text-[18px] text-blue-500">edit</span>
                                Edit Details
                            </button>
                            <button wire:click="openReschedule" class="inline-flex items-center justify-center gap-2 bg-white border border-brand-200 hover:bg-gray-50 text-gray-700 px-4 py-3 rounded-full text-xs font-bold transition-all shadow-sm">
                                <span class="material-symbols-outlined text-[18px] text-indigo-500">calendar_month</span>
                                Reschedule
                            </button>
                        </div>
                        @if($appointment->status === 'Pending' || $appointment->status === 'Scheduled')
                            <button 
                                wire:click="cancelAppointment"
                                wire:confirm="Are you sure you want to cancel this scheduled appointment?"
                                class="w-full inline-flex items-center justify-center gap-2 bg-red-50 hover:bg-red-100 text-red-700 border border-red-200 px-4 py-3.5 rounded-full text-xs font-black transition-all">
                                <span class="material-symbols-outlined text-[18px]">cancel</span>
                                Cancel Scheduled Repair
                            </button>
                        @endif
                    </div>
                </div>
            @endif

        </div>

    </div>

    <!-- Edit Details Modal -->
    @if($showEditModal)
    <div class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black bg-opacity-50">
        <div class="bg-white modal-content rounded-[2.5rem] shadow-2xl max-w-md w-full border border-brand-100 overflow-hidden transform transition-all duration-300 scale-100">
            <div class="border-b border-brand-200 px-6 py-5 flex items-center justify-between bg-gray-50/50">
                <h2 class="text-xl font-bold text-gray-900">Edit Appointment</h2>
                <button wire:click="closeModals()" class="text-gray-400 hover:text-gray-600 transition-colors">
                    <span class="material-symbols-outlined text-[28px]">close</span>
                </button>
            </div>

            <div class="p-6 space-y-4">
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Device Brand <span class="text-red-500">*</span></label>
                    <input type="text" wire:model="editDeviceBrand" placeholder="e.g., Apple, Samsung"
                        class="w-full px-4 py-2.5 border border-brand-300 rounded-lg focus:border-blue-500 focus:ring-4 focus:ring-blue-500/15 dark:focus:!border-blue-500 dark:focus:!ring-4 dark:focus:!ring-blue-500/25">
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Device Model</label>
                    <input type="text" wire:model="editDeviceModel" placeholder="e.g., iPhone 14, Galaxy S23"
                        class="w-full px-4 py-2.5 border border-brand-300 rounded-lg focus:border-blue-500 focus:ring-4 focus:ring-blue-500/15 dark:focus:!border-blue-500 dark:focus:!ring-4 dark:focus:!ring-blue-500/25">
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Issue Category <span class="text-red-500">*</span></label>
                    <select wire:model="editFaultCategory"
                        class="w-full px-4 py-2.5 border border-brand-300 rounded-lg focus:border-blue-500 focus:ring-4 focus:ring-blue-500/15 dark:focus:!border-blue-500 dark:focus:!ring-4 dark:focus:!ring-blue-500/25">
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
                    <textarea wire:model="editDescription" placeholder="Describe the issue in detail..." rows="3"
                        class="w-full px-4 py-2.5 border border-brand-300 rounded-lg focus:border-blue-500 focus:ring-4 focus:ring-blue-500/15 dark:focus:!border-blue-500 dark:focus:!ring-4 dark:focus:!ring-blue-500/25 resize-none"></textarea>
                </div>
            </div>

            <div class="bg-gray-50 border-t border-brand-200 px-6 py-4 flex justify-end gap-3">
                <button wire:click="closeModals()" class="px-4 py-2 text-sm font-bold text-gray-700 bg-white border border-brand-300 rounded-full hover:bg-gray-50 transition-colors">
                    Cancel
                </button>
                <button wire:click="saveEdit()" class="px-4 py-2 text-sm font-bold text-white bg-blue-600 rounded-full hover:bg-blue-700 transition-colors">
                    Save Changes
                </button>
            </div>
        </div>
    </div>
    @endif

    <!-- Reschedule Modal -->
    @if($showRescheduleModal)
    <div class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/60 backdrop-blur-sm">
        <div class="bg-white modal-content rounded-[2rem] shadow-2xl max-w-2xl w-full border border-brand-100 overflow-hidden transform transition-all duration-300 scale-100">
            <div class="border-b border-brand-200 px-6 py-5 flex items-center justify-between bg-gray-50/50">
                <h2 class="text-xl font-extrabold text-gray-900 tracking-tight">Reschedule Appointment</h2>
                <button wire:click="closeModals()" class="text-gray-400 hover:text-gray-600 transition-colors">
                    <span class="material-symbols-outlined text-[28px]">close</span>
                </button>
            </div>

            <div class="p-6 space-y-6">
                <!-- Week Navigator -->
                <div class="flex items-center justify-between py-2 border-b border-brand-100">
                    <button type="button" wire:click="prevWeek" @disabled($calendar_week_offset <= 0)
                        class="flex items-center gap-1.5 text-xs font-bold px-3 py-1.5 rounded-full border border-brand-200 transition-all {{ $calendar_week_offset <= 0 ?'text-gray-300 cursor-not-allowed bg-gray-50' : 'bg-white text-gray-900 hover:bg-gray-50 hover:border-brand-300' }}">
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
                            <button type="button" wire:click="$set('calendar_week_offset', 0); $wire.generateAvailableDays()" class="ml-2 bg-transparent text-[9px] font-black text-blue-600 uppercase tracking-wider hover:text-blue-800 p-0 inline-block border-0 cursor-pointer shadow-none hover:shadow-none">Back to Now</button>
                        @endif
                    </div>
                    <button type="button" wire:click="nextWeek"
                        class="flex items-center gap-1.5 text-xs font-bold px-3 py-1.5 rounded-full border border-brand-200 bg-white text-gray-900 hover:bg-gray-50 hover:border-brand-300 transition-all">
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
                        @endphp
                        <button type="button"
                            @if(!$isFull) wire:click="selectRescheduleTime('{{ $slot }}')" @endif
                            @disabled($isFull)
                            class="py-4 px-2 rounded-full border-2 font-black text-sm transition-all flex items-center justify-center gap-2 outline-none {{ $isSelected ?'border-blue-500 bg-white text-blue-700 shadow-md ring-2 ring-blue-100 scale-[1.02]'
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
                        <p class="text-[10px] text-blue-600 font-bold uppercase tracking-wider">New Appointment Time</p>
                        <p class="font-extrabold text-blue-900 text-sm">
                            {{ \Carbon\Carbon::parse($rescheduleDate)->format('M d, Y') }} at {{ \Carbon\Carbon::parse($rescheduleTime)->format('h:i A') }}
                        </p>
                    </div>
                </div>
                @endif
            </div>

            <div class="bg-gray-50 border-t border-brand-200 px-6 py-4 flex justify-end gap-3">
                <button wire:click="closeModals()" class="px-5 py-2.5 text-sm font-bold text-gray-700 bg-white border border-brand-300 rounded-full hover:bg-gray-50 hover:border-brand-400 transition-all">
                    Cancel
                </button>
                <button wire:click="saveReschedule()" @disabled(!$rescheduleDate || !$rescheduleTime)
                    class="px-5 py-2.5 text-sm font-bold text-white bg-blue-600 rounded-full hover:bg-blue-700 transition-all shadow-md shadow-blue-100 disabled:opacity-50 disabled:cursor-not-allowed">
                    Save Changes
                </button>
            </div>
        </div>
    </div>
    @endif

</div>

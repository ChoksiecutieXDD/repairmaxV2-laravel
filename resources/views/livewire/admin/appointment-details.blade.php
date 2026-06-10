<div class="w-full" x-data="{ 
    showEmailModal: $wire.entangle('showEmailModal'),
    showStatusModal: $wire.entangle('showStatusModal')
}">
    <!-- Header Section -->
    <div class="mb-8 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="text-3xl font-bold text-gray-900 tracking-tight">Appointment Details</h1>
            <p class="text-gray-500 mt-1">View and manage appointment information</p>
        </div>
        <a href="{{ route('admin.appointment') }}" class="px-6 py-2 bg-gray-200 hover:bg-gray-300 text-gray-900 rounded-full font-bold transition-colors">
            ← Go Back
        </a>
    </div>

    @if (session()->has('message'))
        <div class="mb-4 p-4 rounded-lg bg-green-50 border border-green-200 text-green-700 font-medium">{{ session('message') }}</div>
    @endif
    @if (session()->has('error'))
        <div class="mb-4 p-4 rounded-lg bg-red-50 border border-red-200 text-red-700 font-medium">{{ session('error') }}</div>
    @endif

    @if ($appointment)
    <div class="space-y-6">
        <!-- Status & Type Indicator Card -->
        <div class="bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-dark-blue-from dark:to-dark-blue-to rounded-2xl border border-blue-200 dark:border-blue-500/20 p-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Status -->
                <div>
                    <p class="text-sm text-gray-600 font-semibold mb-1">Current Status</p>
                    <div class="flex items-center gap-2">
                        @php
                            $statusBgClass = match($appointment->status) {
                                'Completed' => 'bg-green-100 text-green-700 border-green-200 dark:bg-green-500/10 dark:text-green-400 dark:border-green-500/20',
                                'In Progress' => 'bg-orange-100 text-orange-700 border-orange-200 dark:bg-orange-500/10 dark:text-orange-400 dark:border-orange-500/20',
                                'Ready for Pickup' => 'bg-blue-100 text-blue-700 border-blue-200 dark:bg-blue-500/10 dark:text-blue-400 dark:border-blue-500/20',
                                'Scheduled' => 'bg-indigo-100 text-indigo-700 border-indigo-200 dark:bg-indigo-500/10 dark:text-indigo-400 dark:border-indigo-500/20',
                                'Pending' => 'bg-yellow-100 text-yellow-700 border-yellow-200 dark:bg-yellow-500/10 dark:text-yellow-450 dark:border-yellow-500/20',
                                'Cancelled' => 'bg-red-100 text-red-700 border-red-200 dark:bg-red-500/10 dark:text-red-400 dark:border-red-500/20',
                                default => 'bg-gray-100 text-gray-700 border-gray-200 dark:bg-white/5 dark:text-gray-400 dark:border-white/10'
                            };
                        @endphp
                        <span class="inline-flex items-center gap-1.5 px-4 py-2 {{ $statusBgClass }} border rounded-xl text-sm font-bold capitalize">
                            <span class="material-symbols-outlined text-base">info</span>
                            {{ $appointment->status }}
                        </span>
                        <button @click="showStatusModal = true" class="text-blue-600 hover:text-blue-800 font-semibold text-sm ml-2">
                            Change
                        </button>
                    </div>
                </div>

                <!-- Customer Type -->
                <div>
                    <p class="text-sm text-gray-600 font-semibold mb-1">Customer Type</p>
                    @if($appointment->user?->role === 'user')
                        <span class="inline-flex items-center gap-2 px-4 py-2 bg-green-100 dark:bg-green-500/10 text-green-700 dark:text-green-400 border border-green-200 dark:border-green-500/20 rounded-xl text-sm font-bold">
                            <span class="material-symbols-outlined text-base">person_check</span>
                            Registered User
                        </span>
                    @else
                        <span class="inline-flex items-center gap-2 px-4 py-2 bg-orange-100 dark:bg-orange-500/10 text-orange-700 dark:text-orange-400 border border-orange-200 dark:border-orange-500/20 rounded-xl text-sm font-bold">
                            <span class="material-symbols-outlined text-base">person_add</span>
                            Guest Customer
                        </span>
                    @endif
                </div>

                <!-- Booking Reference -->
                <div>
                    <p class="text-sm text-gray-600 font-semibold mb-1">Booking Reference</p>
                    <p class="text-lg font-bold text-blue-900 dark:text-blue-400 font-mono">{{ $appointment->booking_number ?? 'N/A' }}</p>
                </div>
            </div>
        </div>

        <!-- Action Buttons Section -->
        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
            <div class="px-6 py-5 border-b border-gray-100 dark:border-white/5 bg-gray-50 dark:bg-white/[0.02]">
                <h2 class="text-lg font-bold text-gray-900">Actions</h2>
            </div>
            <div class="p-6 flex flex-wrap gap-4">
                <button wire:click="openEmailModal('receipt')" class="flex items-center gap-2 px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-full font-bold transition-colors">
                    <span class="material-symbols-outlined">mail</span>
                    Send Receipt
                </button>
                <button wire:click="openEmailModal('invoice')" class="flex items-center gap-2 px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white rounded-full font-bold transition-colors">
                    <span class="material-symbols-outlined">receipt_long</span>
                    Send Invoice
                </button>
                <button @click="showStatusModal = true" class="flex items-center gap-2 px-6 py-3 bg-amber-600 hover:bg-amber-700 text-white rounded-full font-bold transition-colors">
                    <span class="material-symbols-outlined">edit</span>
                    Change Status
                </button>
                <button wire:click="deleteAppointment" onclick="return confirm('Are you sure? This action cannot be undone.')" class="flex items-center gap-2 px-6 py-3 bg-red-600 hover:bg-red-700 text-white rounded-full font-bold transition-colors">
                    <span class="material-symbols-outlined">delete</span>
                    Delete
                </button>
            </div>
        </div>

        <!-- Pricing & Cost Section -->
        <div class="bg-gradient-to-br from-green-50 to-emerald-50 dark:from-dark-green-from dark:to-dark-green-to rounded-2xl border border-green-200 dark:border-green-500/20 p-6">
            <h2 class="text-lg font-bold text-gray-900 mb-4 flex items-center gap-2">
                <span class="material-symbols-outlined">attach_money</span>
                Pricing & Cost Details
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white dark:bg-[#020617]/40 rounded-xl p-4 border border-green-100 dark:border-green-500/10">
                    <p class="text-sm text-gray-600 font-semibold">Estimated Quote</p>
                    <p class="text-2xl font-bold text-green-600 dark:text-green-400 mt-2">₱{{ number_format((float)($appointment->quote ?? 0), 2) }}</p>
                </div>
                <div class="bg-white dark:bg-[#020617]/40 rounded-xl p-4 border border-green-100 dark:border-green-500/10">
                    <p class="text-sm text-gray-600 font-semibold">Final Cost</p>
                    <p class="text-2xl font-bold text-green-600 dark:text-green-400 mt-2">
                        @if(is_numeric($appointment->final_cost))
                            ₱{{ number_format((float)$appointment->final_cost, 2) }}
                        @else
                            TBD
                        @endif
                    </p>
                </div>
                <div class="bg-white dark:bg-[#020617]/40 rounded-xl p-4 border border-green-100 dark:border-green-500/10">
                    <p class="text-sm text-gray-600 font-semibold">Additional Fees</p>
                    <p class="text-2xl font-bold text-orange-600 dark:text-orange-400 mt-2">₱{{ number_format(max(0, (float)($appointment->final_cost ?? 0) - (float)($appointment->quote ?? 0)), 2) }}</p>
                </div>
            </div>
            @if($appointment->invoice_number)
            <div class="mt-4 p-4 bg-white dark:bg-[#020617]/40 rounded-lg border border-green-100 dark:border-green-500/10">
                <p class="text-sm text-gray-600">Invoice Number: <span class="font-mono font-bold text-gray-900 dark:text-white">{{ $appointment->invoice_number }}</span></p>
            </div>
            @endif
        </div>

        <!-- Appointment Timeline Section -->
        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
            <div class="px-6 py-5 border-b border-gray-100 dark:border-white/5 bg-gray-50 dark:bg-white/[0.02]">
                <h2 class="text-lg font-bold text-gray-900 flex items-center gap-2">
                    <span class="material-symbols-outlined">event</span>
                    Appointment Timeline
                </h2>
            </div>
            <div class="p-6 grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <p class="text-sm text-gray-600 font-semibold">Created Date</p>
                    <p class="text-lg font-bold text-gray-900 mt-1">{{ $appointment->created_at->format('M d, Y') }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600 font-semibold">Preferred Date</p>
                    <p class="text-lg font-bold text-gray-900 mt-1">{{ $appointment->pref_date?->format('M d, Y') ?? 'N/A' }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600 font-semibold">Preferred Time</p>
                    <p class="text-lg font-bold text-gray-900 mt-1">{{ $appointment->pref_time ?? 'N/A' }}</p>
                </div>
            </div>
        </div>

        <!-- Customer Information Section -->
        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
            <div class="px-6 py-5 border-b border-gray-100 dark:border-white/5 bg-gray-50 dark:bg-white/[0.02]">
                <h2 class="text-lg font-bold text-gray-900 flex items-center gap-2">
                    <span class="material-symbols-outlined">person</span>
                    Customer Information
                </h2>
            </div>
            <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <p class="text-sm text-gray-600 font-semibold">Full Name</p>
                    <p class="text-lg font-bold text-gray-900 mt-1">{{ $appointment->user?->getFullName() ?? 'N/A' }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600 font-semibold">Email</p>
                    <p class="text-lg font-bold text-gray-900 mt-1">{{ $appointment->user?->email ?? 'N/A' }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600 font-semibold">Phone</p>
                    <p class="text-lg font-bold text-gray-900 mt-1">{{ $appointment->user?->phone ?? 'N/A' }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600 font-semibold">City/Address</p>
                    <p class="text-lg font-bold text-gray-900 mt-1">{{ $appointment->user?->city ?? 'N/A' }}</p>
                </div>
            </div>
        </div>

        <!-- Device Information Section -->
        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
            <div class="px-6 py-5 border-b border-gray-100 dark:border-white/5 bg-gray-50 dark:bg-white/[0.02]">
                <h2 class="text-lg font-bold text-gray-900 flex items-center gap-2">
                    <span class="material-symbols-outlined">devices</span>
                    Device Information
                </h2>
            </div>
            <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <p class="text-sm text-gray-600 font-semibold">Brand</p>
                    <p class="text-lg font-bold text-gray-900 mt-1">{{ $appointment->device_brand }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600 font-semibold">Model</p>
                    <p class="text-lg font-bold text-gray-900 mt-1">{{ $appointment->device_model }}</p>
                </div>
                <div class="md:col-span-2">
                    <p class="text-sm text-gray-600 font-semibold">Fault/Issue Category</p>
                    <p class="text-lg font-bold text-gray-900 mt-1">{{ $appointment->fault_category }}</p>
                </div>
            </div>
        </div>

        <!-- Device Photos & Videos Section -->
        @if($appointment->photo_paths && count($appointment->photo_paths) > 0)
        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
            <div class="px-6 py-5 border-b border-gray-100 dark:border-white/5 bg-gray-50 dark:bg-white/[0.02]">
                <h2 class="text-lg font-bold text-gray-900 flex items-center gap-2">
                    <span class="material-symbols-outlined">perm_media</span>
                    Device Photos & Videos
                </h2>
            </div>
            <div class="p-6 grid grid-cols-2 md:grid-cols-4 gap-4">
                @foreach($appointment->photo_paths as $photo)
                    @php
                        $isVideo = in_array(strtolower(pathinfo($photo, PATHINFO_EXTENSION)), ['mp4', 'mov', 'avi', 'webm', 'mpeg', 'mkv', '3gp']);
                    @endphp
                    @if($isVideo)
                        <div class="relative rounded-lg border border-gray-200 overflow-hidden h-48 bg-gray-100 flex items-center justify-center shadow-sm">
                            <video src="{{ asset('storage/' . $photo) }}" class="w-full h-full object-cover" controls muted playsinline></video>
                        </div>
                    @else
                        <div class="relative group h-48">
                            <img src="{{ asset('storage/' . $photo) }}" alt="Device photo" class="w-full h-full object-cover rounded-lg border border-gray-200 hover:border-blue-500 transition-all">
                            <div class="absolute inset-0 bg-black/0 group-hover:bg-black/20 transition-colors rounded-lg flex items-center justify-center opacity-0 group-hover:opacity-100">
                                <a href="{{ asset('storage/' . $photo) }}" target="_blank" class="p-2 bg-white rounded-full text-gray-900 shadow-lg">
                                    <span class="material-symbols-outlined">zoom_in</span>
                                </a>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
        @endif

        <!-- Description & Details Section -->
        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
            <div class="px-6 py-5 border-b border-gray-100 dark:border-white/5 bg-gray-50 dark:bg-white/[0.02]">
                <h2 class="text-lg font-bold text-gray-900 flex items-center gap-2">
                    <span class="material-symbols-outlined">description</span>
                    Appointment Description
                </h2>
            </div>
            <div class="p-6">
                @php
                    $rawDesc = $appointment->description ?? '';
                    // Standardize carriage returns to newlines for cleaner regex parsing
                    $descClean = str_replace(["\r\n", "\r"], "\n", $rawDesc);
                    
                    $details = [];
                    // Extract Issue Description
                    if (preg_match('/Issue\s+Description\s*:\s*(.*?)(?=\s*(?:Service\s+Method\s*:|Pickup\s+Address\s*:|$))/is', $descClean, $match)) {
                        $details['Issue Description'] = trim($match[1]);
                    }
                    // Extract Service Method
                    if (preg_match('/Service\s+Method\s*:\s*(.*?)(?=\s*(?:Issue\s+Description\s*:|Pickup\s+Address\s*:|$))/is', $descClean, $match)) {
                        $details['Service Method'] = trim($match[1]);
                    }
                    // Extract Pickup Address
                    if (preg_match('/Pickup\s+Address\s*:\s*(.*?)(?=\s*(?:Issue\s+Description\s*:|Service\s+Method\s*:|$))/is', $descClean, $match)) {
                        $details['Pickup Address'] = trim($match[1]);
                    }
                @endphp

                @if(isset($details['Issue Description']) || isset($details['Service Method']) || isset($details['Pickup Address']))
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <!-- Issue Description -->
                        <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-white/5 rounded-2xl p-6 transition-all duration-300 shadow-sm hover:shadow-md hover:border-slate-350 dark:hover:border-white/10 transform hover:-translate-y-1">
                            <div class="flex items-center gap-2 mb-3 border-b border-slate-100 dark:border-white/5 pb-3">
                                <span class="material-symbols-outlined text-slate-500 bg-slate-50 dark:bg-white/5 border border-slate-200 dark:border-white/10 p-1.5 rounded-lg text-lg">construction</span>
                                <span class="text-xs uppercase font-mono font-bold text-slate-500 tracking-wider">Issue Description</span>
                            </div>
                            @if(!empty(trim($details['Issue Description'] ?? '')) && strtolower(trim($details['Issue Description'])) !== 'n/a')
                                <p class="text-gray-700 font-medium leading-relaxed text-sm whitespace-pre-wrap text-left mt-3">
                                    {{ $details['Issue Description'] }}
                                </p>
                            @else
                                <div class="flex items-center gap-2 text-slate-400 py-3 mt-1">
                                    <span class="material-symbols-outlined text-base">info</span>
                                    <span class="text-xs font-semibold italic">No description provided</span>
                                </div>
                            @endif
                        </div>

                        <!-- Service Method -->
                        @php
                            $isDropOff = str_contains(strtolower($details['Service Method'] ?? ''), 'drop');
                            $methodBg = $isDropOff ? 'bg-emerald-50/50 hover:bg-emerald-50 dark:bg-emerald-950/20 dark:hover:bg-emerald-950/30 border-emerald-200 dark:border-emerald-500/20 text-emerald-800 dark:text-emerald-300' : 'bg-sky-50/50 hover:bg-sky-50 dark:bg-sky-950/20 dark:hover:bg-sky-950/30 border-sky-200 dark:border-sky-500/20 text-sky-800 dark:text-sky-300';
                            $methodIcon = $isDropOff ? 'storefront' : 'local_shipping';
                            $methodBadgeColor = $isDropOff ? 'bg-emerald-100 text-emerald-700 border-emerald-250 dark:bg-emerald-500/10 dark:text-emerald-300 dark:border-emerald-500/20' : 'bg-sky-100 text-sky-700 border-sky-250 dark:bg-sky-500/10 dark:text-sky-300 dark:border-sky-500/20';
                        @endphp
                        <div class="{{ $methodBg }} border rounded-2xl p-6 transition-all duration-300 shadow-sm hover:shadow-md transform hover:-translate-y-1">
                            <div class="flex items-center gap-2 mb-3 border-b border-current/10 pb-3">
                                <span class="material-symbols-outlined {{ $methodBadgeColor }} p-1.5 rounded-lg text-lg border">{{ $methodIcon }}</span>
                                <span class="text-xs uppercase font-mono font-bold tracking-wider">Service Method</span>
                            </div>
                            <div class="mt-4">
                                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 {{ $methodBadgeColor }} border text-xs font-black rounded-xl uppercase tracking-wide">
                                    {{ $details['Service Method'] ?: 'N/A' }}
                                </span>
                            </div>
                                                <!-- Pickup Address -->
                        @php
                            $hasAddress = !empty(trim($details['Pickup Address'] ?? '')) && strtolower(trim($details['Pickup Address'])) !== 'n/a';
                        @endphp
                        @if($isDropOff)
                            <div class="bg-slate-50/50 hover:bg-slate-50 dark:bg-white/[0.02] dark:hover:bg-white/[0.04] border border-slate-250 dark:border-white/5 rounded-2xl p-6 transition-all duration-300 shadow-sm hover:shadow-md transform hover:-translate-y-1">
                                <div class="flex items-center gap-2 mb-3 border-b border-slate-200/60 dark:border-white/5 pb-3">
                                    <span class="material-symbols-outlined text-slate-400 dark:text-slate-500 bg-slate-100 dark:bg-white/5 border border-slate-200 dark:border-white/10 p-1.5 rounded-lg text-lg">location_off</span>
                                    <span class="text-xs uppercase font-mono font-bold text-slate-400 dark:text-slate-500 tracking-wider">Pickup/Delivery Address</span>
                                </div>
                                <div class="mt-4">
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-slate-100 dark:bg-white/5 text-slate-500 dark:text-slate-400 border border-slate-250 dark:border-white/10 text-xs font-bold rounded-xl uppercase tracking-wide">
                                        Not Required
                                    </span>
                                    <p class="text-slate-400 dark:text-slate-500 text-xs mt-3 leading-relaxed">
                                        Customer selected <strong class="text-slate-500 dark:text-slate-400">Shop Drop-off</strong>, so no pickup or delivery address is needed.
                                    </p>
                                </div>
                            </div>
                        @else
                            @if($hasAddress)
                                <div class="bg-indigo-50/40 hover:bg-indigo-50 dark:bg-indigo-500/5 dark:hover:bg-indigo-500/10 border border-indigo-200 dark:border-indigo-500/20 rounded-2xl p-6 transition-all duration-300 shadow-sm hover:shadow-md transform hover:-translate-y-1">
                                    <div class="flex items-center gap-2 mb-3 border-b border-indigo-100 dark:border-indigo-500/20 pb-3">
                                        <span class="material-symbols-outlined text-indigo-600 dark:text-indigo-400 bg-indigo-100 dark:bg-indigo-500/10 border border-indigo-200 dark:border-indigo-500/20 p-1.5 rounded-lg text-lg">location_on</span>n</span>
                                        <span class="text-xs uppercase font-mono font-bold text-indigo-600 dark:text-indigo-400 tracking-wider">Pickup/Delivery Address</span>
                                    </div>
                                    <p class="text-gray-700 dark:text-gray-300 font-medium leading-relaxed text-sm whitespace-pre-wrap text-left mt-3">
                                        {{ $details['Pickup Address'] }}
                                    </p>
                                </div>
                            @else
                                <div class="bg-rose-50/40 hover:bg-rose-50 border border-rose-200 rounded-2xl p-6 transition-all duration-300 shadow-sm hover:shadow-md transform hover:-translate-y-1">
                                    <div class="flex items-center gap-2 mb-3 border-b border-rose-100 pb-3">
                                        <span class="material-symbols-outlined text-rose-600 bg-rose-100 border border-rose-200 p-1.5 rounded-lg text-lg">error</span>
                                        <span class="text-xs uppercase font-mono font-bold text-rose-600 tracking-wider">Pickup/Delivery Address</span>
                                    </div>
                                    <div class="mt-4">
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-rose-100 text-rose-700 border border-rose-200 text-xs font-bold rounded-xl uppercase tracking-wide">
                                            Missing Address
                                        </span>
                                        <p class="text-rose-500 text-xs mt-3 leading-relaxed">
                                            This appointment is set for Home Pickup, but no address was provided.
                                        </p>
                                    </div>
                                </div>
                            @endif
                        @endif
                    </div>
                @else
                    <p class="text-gray-700 leading-relaxed whitespace-pre-wrap">
                        {{ $descClean ?: 'No description provided.' }}
                    </p>
                @endif
            </div>
        </div>

        <!-- Completion Notes Section -->
        @if($appointment->completion_notes)
        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
            <div class="px-6 py-5 border-b border-gray-100 dark:border-white/5 bg-gray-50 dark:bg-white/[0.02]">
                <h2 class="text-lg font-bold text-gray-900 flex items-center gap-2">
                    <span class="material-symbols-outlined">check_circle</span>
                    Completion Notes
                </h2>
            </div>
            <div class="p-6">
                <p class="text-gray-700 leading-relaxed whitespace-pre-wrap">{{ $appointment->completion_notes }}</p>
            </div>
        </div>
        @endif
    </div>

    <!-- Email Modal -->
    <div x-show="showEmailModal"
        class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-gray-900/60 backdrop-blur-md"
        x-cloak
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        @keydown.escape.window="showEmailModal = false">
        
        <div class="bg-white modal-content rounded-[2.5rem] shadow-2xl max-w-2xl w-full my-auto overflow-hidden flex flex-col max-h-[90vh] transform transition-all"
            @click.outside="showEmailModal = false"
            x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0 scale-95 translate-y-4"
            x-transition:enter-end="opacity-100 scale-100 translate-y-0"
            x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100 scale-100 translate-y-0"
            x-transition:leave-end="opacity-0 scale-95 translate-y-4">
            
            <div class="px-8 py-6 border-b border-gray-100 flex items-center justify-between shrink-0 bg-white">
                <h2 class="text-xl font-bold text-gray-900">Send Email</h2>
                <button @click="showEmailModal = false" class="text-gray-400 hover:text-gray-600 transition-colors">
                    <span class="material-symbols-outlined">close</span>
                </button>
            </div>

            <div class="p-8 space-y-6 overflow-y-auto">
                <!-- Email Type Badge -->
                <div class="inline-block px-4 py-2 rounded-xl 
                    @if($emailType === 'receipt') bg-blue-100 text-blue-700
                    @elseif($emailType === 'invoice') bg-indigo-100 text-indigo-700
                    @else bg-gray-100 text-gray-700 @endif
                    font-bold text-sm">
                    {{ ucfirst($emailType) }}
                </div>

                <!-- Subject Field -->
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Subject</label>
                    <input type="text" wire:model="emailSubject" placeholder="Email subject..." 
                        class="w-full px-4 py-3.5 border border-gray-200 rounded-xl focus:ring-4 focus:ring-blue-100 focus:border-blue-400 outline-none transition-all text-sm bg-gray-50/50">
                    @error('emailSubject')
                        <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Message Body Field -->
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Message Body</label>
                    <textarea wire:model="emailBody" placeholder="Type the email body here..." rows="10"
                        class="w-full px-4 py-3.5 border border-gray-200 rounded-xl focus:ring-4 focus:ring-blue-100 focus:border-blue-400 outline-none transition-all font-mono text-sm resize-none bg-gray-50/50"></textarea>
                    @error('emailBody')
                        <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Send To Info -->
                <div class="bg-blue-50 dark:bg-blue-955/20 border border-blue-100 dark:border-blue-500/20 rounded-2xl p-5">
                    <p class="text-sm text-gray-700 dark:text-gray-300 flex items-center gap-2">
                        <span class="font-bold text-gray-900 dark:text-white">Send to:</span> 
                        <span class="font-mono text-blue-600 dark:text-blue-400 bg-white dark:bg-[#020617]/50 px-3 py-1 rounded-lg border border-blue-200/50 dark:border-blue-500/20">{{ $appointment->user?->email ?? 'N/A' }}</span>
                    </p>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="px-8 py-6 border-t border-gray-100 flex flex-col sm:flex-row gap-3 bg-white shrink-0">
                <button @click="showEmailModal = false" class="flex-1 px-6 py-3.5 bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold rounded-full transition-colors">
                    Cancel
                </button>
                <button wire:click="sendEmail" class="flex-1 px-6 py-3.5 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-full transition-colors flex items-center justify-center gap-2 shadow-lg shadow-blue-200">
                    <span class="material-symbols-outlined text-[20px]">send</span>
                    Send
                </button>
            </div>
        </div>
    </div>

    <!-- Status Update Modal -->
    <div x-show="showStatusModal"
        class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-gray-900/60 backdrop-blur-md"
        x-cloak
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        @keydown.escape.window="showStatusModal = false">
        
        <div class="bg-white modal-content rounded-[2.5rem] shadow-2xl max-w-md w-full p-10 transform transition-all"
            @click.outside="showStatusModal = false"
            x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0 scale-95 translate-y-4"
            x-transition:enter-end="opacity-100 scale-100 translate-y-0"
            x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100 scale-100 translate-y-0"
            x-transition:leave-end="opacity-0 scale-95 translate-y-4">
            
            <div class="text-center mb-6">
                <div class="w-16 h-16 bg-blue-50 text-blue-600 rounded-full flex items-center justify-center mx-auto mb-4">
                    <span class="material-symbols-outlined text-3xl">edit_calendar</span>
                </div>
                <h2 class="text-2xl font-bold text-gray-900">Change Status</h2>
            </div>

            <div class="space-y-6">
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-3 text-center">Select New Status</label>
                    <select wire:model="newStatus" class="w-full px-4 py-3.5 border border-gray-200 rounded-xl focus:ring-4 focus:ring-blue-100 focus:border-blue-400 outline-none text-sm transition-all bg-gray-50/50">
                        <option value="">-- Select Status --</option>
                        <option value="Pending">Pending</option>
                        <option value="Scheduled">Scheduled</option>
                        <option value="In Progress">In Progress</option>
                        <option value="Ready for Pickup">Ready for Pickup</option>
                        <option value="Completed">Completed</option>
                        <option value="Cancelled">Cancelled</option>
                    </select>
                </div>

                <div class="flex flex-col sm:flex-row gap-3 pt-4 border-t border-gray-100">
                    <button @click="showStatusModal = false" class="flex-1 px-6 py-3.5 bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold rounded-full transition-colors">
                        Cancel
                    </button>
                    <button wire:click="updateStatus" class="flex-1 px-6 py-3.5 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-full transition-colors shadow-lg shadow-blue-200">
                        Update
                    </button>
                </div>
            </div>
        </div>
    </div>

    @else
    <div class="text-center py-12">
        <p class="text-gray-500 text-lg">Appointment not found</p>
    </div>
    @endif
</div>

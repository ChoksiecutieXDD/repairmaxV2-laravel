<x-layouts.landing title="Track Your Repair Status | Repairmax">
    <main class="pt-32 lg:pt-40 pb-20 md:pb-28 bg-[#F9FAFB] min-h-[90vh] flex flex-col justify-center">

        <!-- Hero Section -->
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-12 text-center">
            <h1 class="text-3xl md:text-5xl font-extrabold text-gray-900 mb-4 tracking-tight">Track Your Repair</h1>
            <p class="text-base text-gray-600 max-w-2xl mx-auto leading-relaxed">
                Enter your Booking Reference Number or Repair Ticket ID and email address below to get real-time tracking updates and technician reports.
            </p>
        </section>

        <!-- Tracking Content -->
        <section class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
            <div class="bg-white rounded-3xl p-8 md:p-12 shadow-sm border border-gray-200">
                
                <!-- Tracking Form -->
                <form action="/help/track" method="POST" class="space-y-6">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Booking Reference or Repair Ticket ID</label>
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <span class="material-symbols-outlined text-gray-400 group-focus-within:text-gray-900 transition-colors">tag</span>
                                </div>
                                <input type="text" name="ticket_id" placeholder="e.g. BK-20260519-00001 or RM-20260519-00001" value="{{ $ticket_id ?? '' }}" required 
                                    class="w-full pl-12 pr-4 py-3.5 bg-white border border-gray-200 rounded-xl outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all text-sm shadow-sm">
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Email Address</label>
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <span class="material-symbols-outlined text-gray-400 group-focus-within:text-gray-900 transition-colors">mail</span>
                                </div>
                                <input type="email" name="email" placeholder="juan@example.com" value="{{ $email ?? '' }}" required 
                                    class="w-full pl-12 pr-4 py-3.5 bg-white border border-gray-200 rounded-xl outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all text-sm shadow-sm">
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="w-full py-4 bg-gray-900 text-white font-bold rounded-xl transition-all shadow-md hover:bg-gray-800 text-base flex items-center justify-center gap-2">
                        <span class="material-symbols-outlined text-lg">search</span>
                        Check Repair Status
                    </button>
                </form>

                <!-- Error Notice -->
                @if(isset($error))
                <div class="mt-8 p-4 bg-red-50 border border-red-200 text-red-800 rounded-xl flex items-start gap-3 shadow-sm fade-in-element">
                    <span class="material-symbols-outlined shrink-0 text-red-600" style="font-size: 24px;">error</span>
                    <span class="font-medium text-sm leading-relaxed mt-0.5">{{ $error }}</span>
                </div>
                @endif

                <!-- Success Status & Live Timeline -->
                @if(isset($appointment))
                <div class="mt-12 pt-10 border-t border-gray-200 fade-in-element">
                    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
                        <div class="flex flex-col sm:flex-row gap-x-8 gap-y-4">
                            @if($appointment->tracking_code)
                            <div>
                                <span class="text-[10px] uppercase font-black tracking-widest text-blue-500 block">Booking Reference Number</span>
                                <h3 class="text-lg font-black text-gray-900 mt-0.5">{{ $appointment->tracking_code }}</h3>
                            </div>
                            @endif
                            @if($appointment->booking_number)
                            <div>
                                <span class="text-[10px] uppercase font-black tracking-widest text-indigo-500 block">Repair Ticket ID</span>
                                <h3 class="text-lg font-black text-gray-900 mt-0.5">{{ $appointment->booking_number }}</h3>
                            </div>
                            @endif
                        </div>
                        <div class="flex flex-col sm:flex-row gap-3 items-start sm:items-center">
                            <!-- Customer Type Indicator -->
                            @if($appointment->user_id)
                                <span class="inline-flex items-center gap-2 px-3 py-1.5 bg-green-50 text-green-700 border border-green-200 rounded-lg text-xs font-black uppercase tracking-wider">
                                    <span class="material-symbols-outlined text-[14px]">person_check</span>
                                    Registered User
                                </span>
                            @else
                                <span class="inline-flex items-center gap-2 px-3 py-1.5 bg-orange-50 text-orange-700 border border-orange-200 rounded-lg text-xs font-black uppercase tracking-wider">
                                    <span class="material-symbols-outlined text-[14px]">person_add</span>
                                    Guest Customer
                                </span>
                            @endif
                            
                            <!-- Status Badge -->
                            <div class="px-4 py-2 rounded-xl text-xs font-black uppercase tracking-wider inline-block w-fit
                                @if($appointment->status === 'Completed') bg-green-50 text-green-700 border border-green-200
                                @elseif($appointment->status === 'Cancelled') bg-red-50 text-red-700 border border-red-200
                                @elseif($appointment->status === 'Ready for Pickup') bg-blue-50 text-blue-700 border border-blue-200
                                @elseif($appointment->status === 'In Progress') bg-orange-50 text-orange-700 border border-orange-200
                                @else bg-yellow-50 text-yellow-700 border border-yellow-200 @endif">
                                {{ $appointment->status }}
                            </div>
                        </div>
                    </div>

                    <!-- Device summary card -->
                    <div class="bg-gray-50 border border-gray-200 rounded-2xl p-5 grid grid-cols-1 md:grid-cols-3 gap-4 mb-10 text-left">
                        <div>
                            <span class="text-[10px] uppercase font-black tracking-widest text-gray-400 block">Device</span>
                            <span class="text-sm font-bold text-gray-900 mt-0.5 block">{{ $appointment->device_brand }} {{ $appointment->device_model }}</span>
                        </div>
                        <div>
                            <span class="text-[10px] uppercase font-black tracking-widest text-gray-400 block">Issue Category</span>
                            <span class="text-sm font-bold text-gray-900 mt-0.5 block">{{ $appointment->fault_category }}</span>
                        </div>
                        <div>
                            <span class="text-[10px] uppercase font-black tracking-widest text-gray-400 block">Submission Date</span>
                            <span class="text-sm font-bold text-gray-900 mt-0.5 block">{{ $appointment->created_at->format('M d, Y') }}</span>
                        </div>
                    </div>

                    <!-- Device Photos Section -->
                    @if($appointment->photo_paths && count($appointment->photo_paths) > 0)
                    <div class="mb-10">
                        <h4 class="text-sm font-extrabold text-gray-900 uppercase tracking-widest mb-4">Device Photos</h4>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                            @foreach($appointment->photo_paths as $photo)
                                <div class="relative group overflow-hidden rounded-2xl border border-gray-200 hover:border-blue-500 transition-all">
                                    <img src="{{ asset($photo) }}" alt="Device photo" class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300">
                                    <a href="{{ asset($photo) }}" target="_blank" class="absolute inset-0 bg-black/0 group-hover:bg-black/30 transition-colors flex items-center justify-center opacity-0 group-hover:opacity-100">
                                        <span class="material-symbols-outlined text-white text-4xl">zoom_in</span>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <!-- Pricing & Cost Details Section -->
                    <div class="bg-gradient-to-br from-green-50 to-emerald-50 border border-green-200 rounded-2xl p-6 mb-10">
                        <h4 class="text-sm font-extrabold text-gray-900 uppercase tracking-widest mb-5 flex items-center gap-2">
                            <span class="material-symbols-outlined">attach_money</span>
                            Pricing & Cost Details
                        </h4>
                        
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                            <!-- Estimated Quote -->
                            <div class="bg-white rounded-xl p-4 border border-green-100">
                                <span class="text-[10px] uppercase font-black tracking-widest text-gray-500 block">Estimated Quote Price</span>
                                <span class="text-2xl font-black text-green-600 mt-2 block">₱{{ number_format($appointment->quote ?? 0, 2) }}</span>
                                <span class="text-xs text-gray-500 mt-1">Original estimate</span>
                            </div>
                            
                            <!-- Final Cost -->
                            <div class="bg-white rounded-xl p-4 border border-green-100">
                                <span class="text-[10px] uppercase font-black tracking-widest text-gray-500 block">Final Cost Price</span>
                                @if($appointment->final_cost)
                                    <span class="text-2xl font-black text-green-600 mt-2 block">₱{{ number_format($appointment->final_cost, 2) }}</span>
                                    <span class="text-xs text-gray-500 mt-1">Actual total paid</span>
                                @else
                                    <span class="text-lg font-bold text-gray-400 mt-2 block">Pending</span>
                                    <span class="text-xs text-gray-500 mt-1">Will be finalized upon completion</span>
                                @endif
                            </div>
                            
                            <!-- Additional Fees -->
                            <div class="bg-white rounded-xl p-4 border border-green-100">
                                <span class="text-[10px] uppercase font-black tracking-widest text-gray-500 block">Additional Fees</span>
                                @php
                                    $additionalFees = max(0, ($appointment->final_cost ?? 0) - ($appointment->quote ?? 0));
                                @endphp
                                <span class="text-2xl font-black text-orange-600 mt-2 block">₱{{ number_format($additionalFees, 2) }}</span>
                                <span class="text-xs text-gray-500 mt-1">Extra charges if any</span>
                            </div>
                        </div>

                        <!-- Invoice Info -->
                        @if($appointment->invoice_number)
                        <div class="bg-white rounded-xl p-4 border border-green-100">
                            <span class="text-xs uppercase font-black text-gray-500">Invoice Number</span>
                            <span class="text-lg font-mono font-bold text-gray-900 block mt-1">{{ $appointment->invoice_number }}</span>
                        </div>
                        @endif

                        <!-- Cost Breakdown Note -->
                        <div class="mt-4 p-4 bg-blue-50 border border-blue-200 rounded-lg text-sm text-blue-700">
                            <p class="font-semibold mb-1">📌 Pricing Clarification:</p>
                            <ul class="text-xs space-y-1">
                                <li>✓ <strong>Estimated Quote</strong> = Initial service estimate based on diagnostics</li>
                                <li>✓ <strong>Final Cost</strong> = Actual amount paid (may include parts, labor, other fees)</li>
                                <li>✓ <strong>Additional Fees</strong> = Any extra charges beyond the original quote</li>
                            </ul>
                        </div>
                    </div>

                    <!-- Visual Timeline -->
                    <div class="space-y-8">
                        <h4 class="text-sm font-extrabold text-gray-900 uppercase tracking-widest">Repair Journey Timeline</h4>
                        
                        <div class="relative pl-8 border-l-2 border-gray-200 space-y-8 text-left">
                            
                            <!-- Stage 1: Received / Pending -->
                            <div class="relative">
                                <div class="absolute -left-[41px] top-0.5 w-6 h-6 rounded-full flex items-center justify-center shadow-sm border-2
                                    @if(in_array($appointment->status, ['Pending', 'Approved', 'In Progress', 'Ready for Pickup', 'Completed'])) bg-green-500 border-green-500 text-white @else bg-white border-gray-300 text-gray-400 @endif">
                                    <span class="material-symbols-outlined text-[12px] font-black">check</span>
                                </div>
                                <div>
                                    <h5 class="text-sm font-bold @if(in_array($appointment->status, ['Pending', 'Approved', 'In Progress', 'Ready for Pickup', 'Completed'])) text-gray-900 @else text-gray-400 @endif">Repair Logged & Received</h5>
                                    <p class="text-xs text-gray-500 mt-1 leading-relaxed">Your device repair ticket has been successfully registered and queued in our system.</p>
                                </div>
                            </div>

                            <!-- Stage 2: Approved / Diagnosis -->
                            <div class="relative">
                                <div class="absolute -left-[41px] top-0.5 w-6 h-6 rounded-full flex items-center justify-center shadow-sm border-2
                                    @if(in_array($appointment->status, ['Approved', 'In Progress', 'Ready for Pickup', 'Completed'])) bg-green-500 border-green-500 text-white @else bg-white border-gray-300 text-gray-400 @endif">
                                    <span class="material-symbols-outlined text-[12px] font-black">check</span>
                                </div>
                                <div>
                                    <h5 class="text-sm font-bold @if(in_array($appointment->status, ['Approved', 'In Progress', 'Ready for Pickup', 'Completed'])) text-gray-900 @else text-gray-400 @endif">Technician Diagnosis</h5>
                                    <p class="text-xs text-gray-500 mt-1 leading-relaxed">Our certified hardware specialist has claimed your device to inspect symptoms and approve components replacement.</p>
                                </div>
                            </div>

                            <!-- Stage 3: In Progress / Repairing -->
                            <div class="relative">
                                <div class="absolute -left-[41px] top-0.5 w-6 h-6 rounded-full flex items-center justify-center shadow-sm border-2
                                    @if(in_array($appointment->status, ['In Progress', 'Ready for Pickup', 'Completed'])) bg-green-500 border-green-500 text-white @else bg-white border-gray-300 text-gray-400 @endif">
                                    <span class="material-symbols-outlined text-[12px] font-black">check</span>
                                </div>
                                <div>
                                    <h5 class="text-sm font-bold @if(in_array($appointment->status, ['In Progress', 'Ready for Pickup', 'Completed'])) text-gray-900 @else text-gray-400 @endif">Repair In Progress</h5>
                                    <p class="text-xs text-gray-500 mt-1 leading-relaxed">Technicians are carrying out internal repairs, replacing screens, installing battery packs, or running software operations.</p>
                                </div>
                            </div>

                            <!-- Stage 4: Ready for Pickup -->
                            <div class="relative">
                                <div class="absolute -left-[41px] top-0.5 w-6 h-6 rounded-full flex items-center justify-center shadow-sm border-2
                                    @if(in_array($appointment->status, ['Ready for Pickup', 'Completed'])) bg-green-500 border-green-500 text-white @else bg-white border-gray-300 text-gray-400 @endif">
                                    <span class="material-symbols-outlined text-[12px] font-black">check</span>
                                </div>
                                <div>
                                    <h5 class="text-sm font-bold @if(in_array($appointment->status, ['Ready for Pickup', 'Completed'])) text-gray-900 @else text-gray-400 @endif">Ready for Pickup</h5>
                                    <p class="text-xs text-gray-500 mt-1 leading-relaxed">Quality control tests passed successfully! Your device is packaged and fully ready for collection at our flagship branch.</p>
                                </div>
                            </div>

                            <!-- Stage 5: Completed -->
                            <div class="relative">
                                <div class="absolute -left-[41px] top-0.5 w-6 h-6 rounded-full flex items-center justify-center shadow-sm border-2
                                    @if($appointment->status === 'Completed') bg-green-500 border-green-500 text-white @else bg-white border-gray-300 text-gray-400 @endif">
                                    <span class="material-symbols-outlined text-[12px] font-black">check</span>
                                </div>
                                <div>
                                    <h5 class="text-sm font-bold @if($appointment->status === 'Completed') text-gray-900 @else text-gray-400 @endif">Repair Completed & Closed</h5>
                                    <p class="text-xs text-gray-500 mt-1 leading-relaxed">Device claimed. Your 90-day nationwide warranty is active starting today.</p>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                @endif

            </div>
        </section>

    </main>
</x-layouts.landing>

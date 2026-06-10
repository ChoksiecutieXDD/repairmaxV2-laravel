<x-layouts.landing title="Track Your Repair Status | Repairmax">
    <main class="relative pt-32 lg:pt-40 pb-20 md:pb-28 overflow-hidden min-h-[90vh] flex flex-col justify-center bg-[#020617]">
        <!-- Glow Effects -->
        <div class="absolute top-1/4 left-1/4 w-125 h-125 bg-blue-900/10 rounded-full blur-[120px] pointer-events-none"></div>
        <div class="absolute bottom-1/4 right-1/4 w-125 h-125 bg-indigo-900/10 rounded-full blur-[120px] pointer-events-none"></div>

        <!-- Hero Section -->
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-12 text-center relative z-10">
            <h1 class="text-3xl md:text-5xl font-extrabold text-white mb-4 tracking-tight">Track Your Repair</h1>
            <p class="text-base text-gray-400 max-w-2xl mx-auto leading-relaxed font-medium">
                Enter your Ticket Number below to get real-time tracking updates and technician reports.
            </p>
        </section>

        <!-- Tracking Content -->
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full relative z-10">
            <div class="bg-white/[0.03] backdrop-blur-md rounded-[2.5rem] p-8 md:p-12 border border-white/10 shadow-2xl">
                
                <!-- Tracking Form -->
                <form id="track-form" action="/help/track" method="POST" class="space-y-6"
                      data-verified="{{ session('track_verified') ? 'true' : 'false' }}"
                      data-verified-ticket="{{ session('track_verified_ticket_id') ?? '' }}"
                      data-verified-email="{{ session('track_verified_email') ?? '' }}">
                    @csrf
                    <!-- Hidden email field populated from modal -->
                    <input type="hidden" name="email" id="form-email-hidden" value="{{ $email ?? '' }}">

                    <div class="flex flex-col md:flex-row gap-4 items-end">
                        <div class="text-left flex-1">
                            <label class="block text-sm font-bold text-gray-400 mb-2 ml-1">Ticket Number</label>
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <span class="material-symbols-outlined text-gray-400 group-focus-within:text-white transition-colors">tag</span>
                                </div>
                                <input type="text" name="ticket_id" id="ticket-input" placeholder="e.g. RM-00001" value="{{ $ticket_id ?? '' }}" autocomplete="off" required 
                                    class="w-full pl-12 pr-4 py-3.5 bg-white/5 border border-white/10 text-white rounded-xl outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all text-sm shadow-sm placeholder-gray-500">
                            </div>
                        </div>

                        <button type="button" id="open-modal-btn" class="w-full md:w-auto px-8 py-3.5 bg-blue-600 hover:bg-blue-500 text-white font-bold rounded-full transition-all shadow-lg active:scale-95 text-base flex items-center justify-center gap-2 whitespace-nowrap">
                            <span class="material-symbols-outlined text-lg">search</span>
                            Check Repair Status
                        </button>
                    </div>
                </form>

                <!-- Error Notice -->
                @if(isset($error))
                <div class="mt-8 p-4 bg-red-500/10 border border-red-500/20 text-red-400 rounded-xl flex items-start gap-3 shadow-sm fade-in-element">
                    <span class="material-symbols-outlined shrink-0 text-red-400" style="font-size: 24px;">error</span>
                    <span class="font-medium text-sm leading-relaxed mt-0.5 text-left">{{ $error }}</span>
                </div>
                @endif

                <!-- Success Status & Live Timeline -->
                @if(isset($appointment))
                <div class="mt-12 pt-10 border-t border-white/5 fade-in-element">
                    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
                        <div class="flex flex-col sm:flex-row gap-x-8 gap-y-4">
                            @if($appointment->booking_number)
                            <div class="text-left">
                                <span class="text-[10px] uppercase font-black tracking-widest text-blue-400 block">Ticket Number</span>
                                <h3 class="text-lg font-black text-white mt-0.5 font-mono">{{ $appointment->booking_number }}</h3>
                            </div>
                            @endif
                        </div>
                        <div class="flex flex-col sm:flex-row gap-3 items-start sm:items-center">
                            <!-- Customer Type Indicator -->
                            @if($appointment->user?->role === 'user')
                                <span class="inline-flex items-center gap-2 px-3 py-1.5 bg-green-500/10 text-green-400 border border-green-500/20 rounded-lg text-xs font-black uppercase tracking-wider">
                                    <span class="material-symbols-outlined text-[14px]">person_check</span>
                                    Registered User
                                </span>
                            @else
                                <span class="inline-flex items-center gap-2 px-3 py-1.5 bg-amber-500/10 text-amber-400 border border-amber-500/20 rounded-lg text-xs font-black uppercase tracking-wider">
                                    <span class="material-symbols-outlined text-[14px]">person_add</span>
                                    Guest Customer
                                </span>
                            @endif
                            
                            <!-- Status Badge -->
                            <div class="px-4 py-2 rounded-xl text-xs font-black uppercase tracking-wider inline-block w-fit
                                @if($appointment->status === 'Completed') bg-green-500/10 text-green-400 border border-green-500/20
                                @elseif($appointment->status === 'Cancelled') bg-red-500/10 text-red-400 border border-red-500/20
                                @elseif($appointment->status === 'Ready for Pickup') bg-blue-500/10 text-blue-400 border border-blue-500/20
                                @elseif($appointment->status === 'In Progress') bg-amber-500/10 text-amber-400 border border-amber-500/20
                                @else bg-yellow-500/10 text-yellow-400 border border-yellow-500/20 @endif">
                                {{ $appointment->status }}
                            </div>
                        </div>
                    </div>

                    <!-- Device summary card -->
                    <div class="bg-white/[0.02] border border-white/5 rounded-2xl p-5 grid grid-cols-1 md:grid-cols-3 gap-4 mb-10 text-left">
                        <div>
                            <span class="text-[10px] uppercase font-black tracking-widest text-gray-500 block">Device</span>
                            <span class="text-sm font-bold text-white mt-0.5 block">{{ $appointment->device_brand }} {{ $appointment->device_model }}</span>
                        </div>
                        <div>
                            <span class="text-[10px] uppercase font-black tracking-widest text-gray-500 block">Issue Category</span>
                            <span class="text-sm font-bold text-white mt-0.5 block">{{ $appointment->fault_category }}</span>
                        </div>
                        <div>
                            <span class="text-[10px] uppercase font-black tracking-widest text-gray-500 block">Submission Date</span>
                            <span class="text-sm font-bold text-white mt-0.5 block">{{ $appointment->created_at->format('M d, Y') }}</span>
                        </div>
                    </div>

                    <!-- Device Photos & Videos Section -->
                    @if($appointment->photo_paths && count($appointment->photo_paths) > 0)
                    <div class="mb-10 text-left">
                        <h4 class="text-sm font-extrabold text-white uppercase tracking-widest mb-4">Device Photos & Videos</h4>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                            @foreach($appointment->photo_paths as $photo)
                                @php
                                    $isVideo = in_array(strtolower(pathinfo($photo, PATHINFO_EXTENSION)), ['mp4', 'mov', 'avi', 'webm', 'mpeg', 'mkv', '3gp']);
                                @endphp
                                @if($isVideo)
                                    <div class="relative rounded-2xl border border-white/10 overflow-hidden h-48 bg-slate-950/40 flex items-center justify-center shadow-sm">
                                        <video src="{{ asset('storage/' . $photo) }}" class="w-full h-full object-cover" controls muted playsinline></video>
                                    </div>
                                @else
                                    <div class="relative group overflow-hidden rounded-2xl border border-white/10 hover:border-blue-500/50 transition-all h-48">
                                        <img src="{{ asset('storage/' . $photo) }}" alt="Device photo" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                        <div class="absolute inset-0 bg-black/0 group-hover:bg-black/35 transition-colors flex items-center justify-center opacity-0 group-hover:opacity-100">
                                            <a href="{{ asset('storage/' . $photo) }}" target="_blank" class="p-3 bg-white rounded-full text-gray-900 shadow-lg hover:scale-110 transition-transform">
                                                <span class="material-symbols-outlined text-gray-900 text-2xl font-black">zoom_in</span>
                                            </a>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <!-- Pricing & Cost Details Section -->
                    <div class="bg-white/[0.02] border border-white/5 rounded-2xl p-6 mb-10 text-left">
                        <h4 class="text-sm font-extrabold text-white uppercase tracking-widest mb-5 flex items-center gap-2">
                            <span class="material-symbols-outlined text-blue-400">attach_money</span>
                            Pricing & Cost Details
                        </h4>
                        
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                            <!-- Estimated Quote -->
                            <div class="bg-[#020617]/40 rounded-xl p-4 border border-white/5">
                                <span class="text-[10px] uppercase font-black tracking-widest text-gray-500 block">Estimated Quote Price</span>
                                <span class="text-2xl font-black text-green-400 mt-2 block">₱{{ number_format($appointment->quote ?? 0, 2) }}</span>
                                <span class="text-xs text-gray-550 mt-1">Original estimate</span>
                            </div>
                            
                            <!-- Final Cost -->
                            <div class="bg-[#020617]/40 rounded-xl p-4 border border-white/5">
                                <span class="text-[10px] uppercase font-black tracking-widest text-gray-500 block">Final Cost Price</span>
                                @if($appointment->final_cost)
                                    <span class="text-2xl font-black text-green-400 mt-2 block">₱{{ number_format($appointment->final_cost, 2) }}</span>
                                    <span class="text-xs text-gray-550 mt-1">Actual total paid</span>
                                @else
                                    <span class="text-lg font-bold text-gray-500 mt-2 block">Pending</span>
                                    <span class="text-xs text-gray-550 mt-1">Will be finalized upon completion</span>
                                @endif
                            </div>
                            
                            <!-- Additional Fees -->
                            <div class="bg-[#020617]/40 rounded-xl p-4 border border-white/5">
                                <span class="text-[10px] uppercase font-black tracking-widest text-gray-500 block">Additional Fees</span>
                                @php
                                    $additionalFees = max(0, ($appointment->final_cost ?? 0) - ($appointment->quote ?? 0));
                                @endphp
                                <span class="text-2xl font-black text-amber-400 mt-2 block">₱{{ number_format($additionalFees, 2) }}</span>
                                <span class="text-xs text-gray-550 mt-1">Extra charges if any</span>
                            </div>
                        </div>

                        <!-- Invoice Info -->
                        @if($appointment->invoice_number)
                        <div class="bg-[#020617]/40 rounded-xl p-4 border border-white/5 mb-4">
                            <span class="text-xs uppercase font-black text-gray-500">Invoice Number</span>
                            <span class="text-lg font-mono font-bold text-white block mt-1">{{ $appointment->invoice_number }}</span>
                        </div>
                        @endif

                        <!-- Cost Breakdown Note -->
                        <div class="mt-4 p-4 bg-blue-500/10 border border-blue-500/20 rounded-lg text-sm text-blue-400">
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
                        <h4 class="text-sm font-extrabold text-white uppercase tracking-widest text-left">Repair Journey Timeline</h4>
                        
                        <div class="relative pl-8 border-l-2 border-white/5 space-y-8 text-left">
                            
                            <!-- Stage 1: Received / Pending -->
                            <div class="relative">
                                <div class="absolute -left-[41px] top-0.5 w-6 h-6 rounded-full flex items-center justify-center shadow-sm border-2
                                    @if(in_array($appointment->status, ['Pending', 'Approved', 'In Progress', 'Ready for Pickup', 'Completed'])) bg-green-500 border-green-500 text-white @else bg-slate-900 border-white/10 text-gray-550 @endif">
                                    <span class="material-symbols-outlined text-[12px] font-black">check</span>
                                </div>
                                <div>
                                    <h5 class="text-sm font-bold @if(in_array($appointment->status, ['Pending', 'Approved', 'In Progress', 'Ready for Pickup', 'Completed'])) text-white @else text-gray-500 @endif">Repair Logged & Received</h5>
                                    <p class="text-xs text-gray-400 mt-1 leading-relaxed">Your device repair ticket has been successfully registered and queued in our system.</p>
                                </div>
                            </div>

                            <!-- Stage 2: Approved / Diagnosis -->
                            <div class="relative">
                                <div class="absolute -left-[41px] top-0.5 w-6 h-6 rounded-full flex items-center justify-center shadow-sm border-2
                                    @if(in_array($appointment->status, ['Approved', 'In Progress', 'Ready for Pickup', 'Completed'])) bg-green-500 border-green-500 text-white @else bg-slate-900 border-white/10 text-gray-550 @endif">
                                    <span class="material-symbols-outlined text-[12px] font-black">check</span>
                                </div>
                                <div>
                                    <h5 class="text-sm font-bold @if(in_array($appointment->status, ['Approved', 'In Progress', 'Ready for Pickup', 'Completed'])) text-white @else text-gray-500 @endif">Technician Diagnosis</h5>
                                    <p class="text-xs text-gray-400 mt-1 leading-relaxed">Our certified hardware specialist has claimed your device to inspect symptoms and approve components replacement.</p>
                                </div>
                            </div>

                            <!-- Stage 3: In Progress / Repairing -->
                            <div class="relative">
                                <div class="absolute -left-[41px] top-0.5 w-6 h-6 rounded-full flex items-center justify-center shadow-sm border-2
                                    @if(in_array($appointment->status, ['In Progress', 'Ready for Pickup', 'Completed'])) bg-green-500 border-green-500 text-white @else bg-slate-900 border-white/10 text-gray-550 @endif">
                                    <span class="material-symbols-outlined text-[12px] font-black">check</span>
                                </div>
                                <div>
                                    <h5 class="text-sm font-bold @if(in_array($appointment->status, ['In Progress', 'Ready for Pickup', 'Completed'])) text-white @else text-gray-500 @endif">Repair In Progress</h5>
                                    <p class="text-xs text-gray-400 mt-1 leading-relaxed">Technicians are carrying out internal repairs, replacing screens, installing battery packs, or running software operations.</p>
                                </div>
                            </div>

                            <!-- Stage 4: Ready for Pickup -->
                            <div class="relative">
                                <div class="absolute -left-[41px] top-0.5 w-6 h-6 rounded-full flex items-center justify-center shadow-sm border-2
                                    @if(in_array($appointment->status, ['Ready for Pickup', 'Completed'])) bg-green-500 border-green-500 text-white @else bg-slate-900 border-white/10 text-gray-550 @endif">
                                    <span class="material-symbols-outlined text-[12px] font-black">check</span>
                                </div>
                                <div>
                                    <h5 class="text-sm font-bold @if(in_array($appointment->status, ['Ready for Pickup', 'Completed'])) text-white @else text-gray-500 @endif">Ready for Pickup</h5>
                                    <p class="text-xs text-gray-400 mt-1 leading-relaxed">Quality control tests passed successfully! Your device is packaged and fully ready for collection at our flagship branch.</p>
                                </div>
                            </div>

                            <!-- Stage 5: Completed -->
                            <div class="relative">
                                <div class="absolute -left-[41px] top-0.5 w-6 h-6 rounded-full flex items-center justify-center shadow-sm border-2
                                    @if($appointment->status === 'Completed') bg-green-500 border-green-500 text-white @else bg-slate-900 border-white/10 text-gray-550 @endif">
                                    <span class="material-symbols-outlined text-[12px] font-black">check</span>
                                </div>
                                <div>
                                    <h5 class="text-sm font-bold @if($appointment->status === 'Completed') text-white @else text-gray-500 @endif">Repair Completed & Closed</h5>
                                    <p class="text-xs text-gray-400 mt-1 leading-relaxed">Device claimed. Your 90-day nationwide warranty is active starting today.</p>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                @endif

            </div>
        </section>

        <!-- ============================================
             OTP VERIFICATION MODAL (Two-Step)
             Step 1: Email Input + Send Code
             Step 2: OTP Input + Verify
        ============================================ -->
        <div id="otp-modal" class="fixed inset-0 flex items-center justify-center bg-slate-950/85 backdrop-blur-md z-50 hidden" style="opacity:0; transition: opacity 0.25s ease;">
            <div id="otp-modal-box" class="bg-[#0c1428] border border-white/10 rounded-[2rem] w-full max-w-md mx-4 shadow-2xl relative overflow-hidden" style="transform: scale(0.94); transition: transform 0.25s ease;">

                <!-- Close Button -->
                <button id="close-otp-modal" class="absolute top-5 right-5 w-8 h-8 flex items-center justify-center text-gray-400 hover:text-white hover:bg-white/10 rounded-full transition-all">
                    <span class="material-symbols-outlined text-xl">close</span>
                </button>

                <div class="p-8">
                    <!-- Icon -->
                    <div class="mx-auto w-14 h-14 bg-blue-500/10 rounded-2xl flex items-center justify-center mb-5 border border-blue-500/20">
                        <span id="modal-icon" class="material-symbols-outlined text-blue-400 text-3xl">shield_lock</span>
                    </div>

                    <!-- Title / Subtitle (changes per step) -->
                    <h3 id="modal-title" class="text-xl font-extrabold text-white text-center mb-1">Verify Your Identity</h3>
                    <p id="modal-subtitle" class="text-sm text-gray-400 text-center mb-7 leading-relaxed">Enter your email address registered to this ticket to receive a verification code.</p>

                    <!-- Feedback Area -->
                    <div id="modal-feedback" class="hidden mb-5 p-3.5 rounded-xl text-xs font-semibold text-center"></div>

                    <!-- ========================
                         STEP 1: Email Input
                    ======================== -->
                    <div id="step-email">
                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Email Address</label>
                        <div class="relative group mb-4">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <span class="material-symbols-outlined text-gray-400 group-focus-within:text-blue-400 transition-colors" style="font-size:18px;">mail</span>
                            </div>
                            <input type="email" id="modal-email-input"
                                placeholder="your@email.com"
                                autocomplete="email"
                                class="w-full pl-12 pr-4 py-3.5 bg-white/5 border border-white/10 text-white rounded-xl outline-none focus:ring-2 focus:ring-blue-500/30 focus:border-blue-500/60 transition-all text-sm placeholder-gray-500">
                        </div>

                        <button id="send-code-btn" class="w-full py-3.5 bg-blue-600 hover:bg-blue-500 active:scale-95 text-white font-bold rounded-full transition-all shadow-lg text-sm flex items-center justify-center gap-2">
                            <span class="material-symbols-outlined text-base">send</span>
                            Send Verification Code
                        </button>
                    </div>

                    <!-- ========================
                         STEP 2: OTP Input
                    ======================== -->
                    <div id="step-otp" class="hidden">
                        <!-- Email display -->
                        <div class="flex items-center gap-2 mb-5 p-3 bg-blue-500/8 border border-blue-500/15 rounded-xl">
                            <span class="material-symbols-outlined text-blue-400 text-base shrink-0">mark_email_read</span>
                            <div class="text-left">
                                <p class="text-[10px] text-gray-500 uppercase tracking-wider font-bold">Code sent to</p>
                                <p id="otp-sent-email" class="text-sm font-semibold text-blue-300 font-mono"></p>
                            </div>
                            <button id="change-email-btn" class="ml-auto text-[10px] text-gray-400 hover:text-white font-bold uppercase tracking-wider transition-colors shrink-0">Change</button>
                        </div>

                        <!-- 6 digit boxes -->
                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-3 text-center">Enter 6-Digit Code</label>
                        <div class="flex justify-center gap-2 mb-5">
                            <input type="text" maxlength="1" class="otp-digit w-11 h-13 bg-white/5 border border-white/10 rounded-xl text-center text-xl font-black text-white focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500 outline-none transition-all" pattern="[0-9]*" inputmode="numeric">
                            <input type="text" maxlength="1" class="otp-digit w-11 h-13 bg-white/5 border border-white/10 rounded-xl text-center text-xl font-black text-white focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500 outline-none transition-all" pattern="[0-9]*" inputmode="numeric">
                            <input type="text" maxlength="1" class="otp-digit w-11 h-13 bg-white/5 border border-white/10 rounded-xl text-center text-xl font-black text-white focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500 outline-none transition-all" pattern="[0-9]*" inputmode="numeric">
                            <input type="text" maxlength="1" class="otp-digit w-11 h-13 bg-white/5 border border-white/10 rounded-xl text-center text-xl font-black text-white focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500 outline-none transition-all" pattern="[0-9]*" inputmode="numeric">
                            <input type="text" maxlength="1" class="otp-digit w-11 h-13 bg-white/5 border border-white/10 rounded-xl text-center text-xl font-black text-white focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500 outline-none transition-all" pattern="[0-9]*" inputmode="numeric">
                            <input type="text" maxlength="1" class="otp-digit w-11 h-13 bg-white/5 border border-white/10 rounded-xl text-center text-xl font-black text-white focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500 outline-none transition-all" pattern="[0-9]*" inputmode="numeric">
                        </div>

                        <button id="verify-otp-btn" class="w-full py-3.5 bg-blue-600 hover:bg-blue-500 active:scale-95 text-white font-bold rounded-full transition-all shadow-lg text-sm flex items-center justify-center gap-2 mb-4">
                            <span class="material-symbols-outlined text-base">verified_user</span>
                            Verify & View Status
                        </button>

                        <!-- Resend row -->
                        <p class="text-center text-xs text-gray-500">
                            Didn't receive it?
                            <button id="resend-otp-btn" class="text-blue-400 hover:text-blue-300 font-bold transition-colors focus:outline-none">Resend Code</button>
                            <span id="resend-cooldown" class="hidden text-gray-600">&nbsp;(wait <span id="cooldown-seconds">60</span>s)</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <script>
        document.addEventListener('DOMContentLoaded', function () {
            const trackForm   = document.getElementById('track-form');
            const ticketInput = document.getElementById('ticket-input');
            const openModalBtn = document.getElementById('open-modal-btn');
            const formEmailHidden = document.getElementById('form-email-hidden');

            // ─── Modal elements ───────────────────────────────
            const otpModal       = document.getElementById('otp-modal');
            const otpModalBox    = document.getElementById('otp-modal-box');
            const closeModalBtn  = document.getElementById('close-otp-modal');
            const modalFeedback  = document.getElementById('modal-feedback');

            const stepEmail      = document.getElementById('step-email');
            const stepOtp        = document.getElementById('step-otp');
            const modalEmailInput = document.getElementById('modal-email-input');
            const sendCodeBtn    = document.getElementById('send-code-btn');
            const otpSentEmail   = document.getElementById('otp-sent-email');
            const changeEmailBtn = document.getElementById('change-email-btn');
            const verifyOtpBtn   = document.getElementById('verify-otp-btn');
            const resendOtpBtn   = document.getElementById('resend-otp-btn');
            const resendCooldown = document.getElementById('resend-cooldown');
            const cooldownSeconds = document.getElementById('cooldown-seconds');
            const otpDigits      = document.querySelectorAll('.otp-digit');

            let currentTicketId = '';
            let currentEmail    = '';
            let isSending       = false;
            let isVerifying     = false;
            let cooldownTimer   = null;

            // ─── Modal open / close ───────────────────────────
            function openModal() {
                // Reset to step 1 each open
                goToStep(1);
                clearFeedback();
                clearOtpDigits();
                modalEmailInput.value = '';

                otpModal.classList.remove('hidden');
                requestAnimationFrame(() => {
                    otpModal.style.opacity = '1';
                    otpModalBox.style.transform = 'scale(1)';
                });
                setTimeout(() => modalEmailInput.focus(), 200);
            }

            function closeModal() {
                otpModal.style.opacity = '0';
                otpModalBox.style.transform = 'scale(0.94)';
                setTimeout(() => otpModal.classList.add('hidden'), 250);
                if (cooldownTimer) { clearInterval(cooldownTimer); cooldownTimer = null; }
            }

            // ─── Step switching ───────────────────────────────
            function goToStep(n) {
                if (n === 1) {
                    stepEmail.classList.remove('hidden');
                    stepOtp.classList.add('hidden');
                    document.getElementById('modal-title').textContent = 'Verify Your Identity';
                    document.getElementById('modal-subtitle').textContent = 'Enter your email address registered to this ticket to receive a verification code.';
                    document.getElementById('modal-icon').textContent = 'shield_lock';
                } else {
                    stepEmail.classList.add('hidden');
                    stepOtp.classList.remove('hidden');
                    document.getElementById('modal-title').textContent = 'Enter Your Code';
                    document.getElementById('modal-subtitle').textContent = 'Check your inbox and enter the 6-digit code we just sent.';
                    document.getElementById('modal-icon').textContent = 'mark_email_unread';
                    setTimeout(() => otpDigits[0]?.focus(), 150);
                }
            }

            // ─── Feedback helpers ─────────────────────────────
            function showFeedback(msg, type = 'error') {
                modalFeedback.textContent = msg;
                modalFeedback.className = type === 'success'
                    ? 'mb-5 p-3.5 rounded-xl text-xs font-semibold text-center bg-green-500/10 border border-green-500/20 text-green-400'
                    : 'mb-5 p-3.5 rounded-xl text-xs font-semibold text-center bg-red-500/10 border border-red-500/20 text-red-400';
                modalFeedback.classList.remove('hidden');
            }
            function clearFeedback() {
                modalFeedback.classList.add('hidden');
                modalFeedback.textContent = '';
            }
            function clearOtpDigits() {
                otpDigits.forEach(d => d.value = '');
            }

            // ─── Spinner helpers ──────────────────────────────
            function spinnerHTML(label) {
                return `<svg class="animate-spin mr-2 h-4 w-4 text-white inline-block" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>${label}`;
            }

            // ─── Send OTP ─────────────────────────────────────
            async function sendOtp(ticketId, email) {
                if (isSending) return false;
                isSending = true;
                clearFeedback();

                const origHTML = sendCodeBtn.innerHTML;
                sendCodeBtn.disabled = true;
                sendCodeBtn.innerHTML = spinnerHTML('Sending...');

                try {
                    const res = await fetch('/help/track/send-otp', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({ ticket_id: ticketId, email })
                    });
                    const data = await res.json();
                    if (res.ok) return true;
                    showFeedback(data.message || 'Failed to send code. Check your ticket number and email.');
                    return false;
                } catch (e) {
                    showFeedback('Network error. Please try again.');
                    return false;
                } finally {
                    isSending = false;
                    sendCodeBtn.disabled = false;
                    sendCodeBtn.innerHTML = origHTML;
                }
            }

            // ─── Verify OTP ───────────────────────────────────
            async function verifyOtp(code) {
                if (isVerifying) return;
                isVerifying = true;
                clearFeedback();

                const origHTML = verifyOtpBtn.innerHTML;
                verifyOtpBtn.disabled = true;
                verifyOtpBtn.innerHTML = spinnerHTML('Verifying...');

                try {
                    const res = await fetch('/help/track/verify-otp', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({ otp: code, ticket_id: currentTicketId, email: currentEmail })
                    });
                    const data = await res.json();

                    if (res.ok) {
                        // Success — inject email into hidden field and submit
                        formEmailHidden.value = currentEmail;
                        trackForm.setAttribute('data-verified', 'true');
                        trackForm.setAttribute('data-verified-ticket', currentTicketId);
                        trackForm.setAttribute('data-verified-email', currentEmail);
                        trackForm.submit();
                    } else {
                        showFeedback(data.message || 'Invalid code. Please try again.');
                        clearOtpDigits();
                        otpDigits[0]?.focus();
                    }
                } catch (e) {
                    showFeedback('Network error. Please try again.');
                } finally {
                    isVerifying = false;
                    verifyOtpBtn.disabled = false;
                    verifyOtpBtn.innerHTML = origHTML;
                }
            }

            // ─── Resend cooldown ──────────────────────────────
            function startCooldown() {
                resendOtpBtn.classList.add('hidden');
                resendCooldown.classList.remove('hidden');
                let secs = 60;
                cooldownSeconds.textContent = secs;
                if (cooldownTimer) clearInterval(cooldownTimer);
                cooldownTimer = setInterval(() => {
                    secs--;
                    cooldownSeconds.textContent = secs;
                    if (secs <= 0) {
                        clearInterval(cooldownTimer);
                        cooldownTimer = null;
                        resendOtpBtn.classList.remove('hidden');
                        resendCooldown.classList.add('hidden');
                    }
                }, 1000);
            }

            // ─── Event listeners ──────────────────────────────

            // Open modal when button clicked
            openModalBtn.addEventListener('click', function () {
                const ticketVal = ticketInput.value.trim();
                if (!ticketVal) {
                    ticketInput.focus();
                    ticketInput.classList.add('border-red-500/60', 'ring-2', 'ring-red-500/20');
                    setTimeout(() => ticketInput.classList.remove('border-red-500/60', 'ring-2', 'ring-red-500/20'), 2000);
                    return;
                }
                currentTicketId = ticketVal;
                openModal();
            });

            // Send Code button
            sendCodeBtn.addEventListener('click', async function () {
                const email = modalEmailInput.value.trim();
                if (!email || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
                    showFeedback('Please enter a valid email address.');
                    modalEmailInput.focus();
                    return;
                }
                currentEmail = email;
                const sent = await sendOtp(currentTicketId, currentEmail);
                if (sent) {
                    otpSentEmail.textContent = currentEmail;
                    goToStep(2);
                    startCooldown();
                }
            });

            // Allow pressing Enter in email input
            modalEmailInput.addEventListener('keydown', function (e) {
                if (e.key === 'Enter') { e.preventDefault(); sendCodeBtn.click(); }
            });

            // Change email (go back to step 1)
            changeEmailBtn.addEventListener('click', function () {
                clearFeedback();
                clearOtpDigits();
                goToStep(1);
                modalEmailInput.value = currentEmail;
                setTimeout(() => modalEmailInput.focus(), 150);
            });

            // OTP digit auto-advance
            otpDigits.forEach((input, i) => {
                input.addEventListener('input', function () {
                    this.value = this.value.replace(/[^0-9]/g, '').slice(0, 1);
                    if (this.value && i < otpDigits.length - 1) otpDigits[i + 1].focus();
                    const code = Array.from(otpDigits).map(d => d.value).join('');
                    if (code.length === 6) verifyOtp(code);
                });
                input.addEventListener('keydown', function (e) {
                    if (e.key === 'Backspace' && !this.value && i > 0) otpDigits[i - 1].focus();
                });
                input.addEventListener('paste', function (e) {
                    e.preventDefault();
                    const pasted = (e.clipboardData || window.clipboardData).getData('text').replace(/\D/g, '').slice(0, 6);
                    [...pasted].forEach((ch, idx) => { if (otpDigits[idx]) otpDigits[idx].value = ch; });
                    const last = Math.min(pasted.length, otpDigits.length - 1);
                    otpDigits[last].focus();
                    if (pasted.length === 6) verifyOtp(pasted);
                });
            });

            // Verify button
            verifyOtpBtn.addEventListener('click', function () {
                const code = Array.from(otpDigits).map(d => d.value).join('');
                if (code.length < 6) { showFeedback('Please enter all 6 digits.'); return; }
                verifyOtp(code);
            });

            // Resend button
            resendOtpBtn.addEventListener('click', async function (e) {
                e.preventDefault();
                const sent = await sendOtp(currentTicketId, currentEmail);
                if (sent) {
                    clearOtpDigits();
                    showFeedback('A new code has been sent to your email.', 'success');
                    setTimeout(clearFeedback, 4000);
                    startCooldown();
                }
            });

            // Close
            closeModalBtn.addEventListener('click', closeModal);
            otpModal.addEventListener('click', e => { if (e.target === otpModal) closeModal(); });
            document.addEventListener('keydown', e => { if (e.key === 'Escape' && !otpModal.classList.contains('hidden')) closeModal(); });

            // If session already verified, form submits normally
            trackForm.addEventListener('submit', function (e) {
                const ticketId = ticketInput.value.trim();
                const email    = formEmailHidden.value.trim();
                const isVerified      = trackForm.getAttribute('data-verified') === 'true';
                const verifiedTicket  = trackForm.getAttribute('data-verified-ticket');
                const verifiedEmail   = trackForm.getAttribute('data-verified-email');
                if (isVerified && verifiedTicket === ticketId && verifiedEmail === email) return; // allow submit
                e.preventDefault(); // block if not verified
            });
        });
        </script>
    </main>
</x-layouts.landing>

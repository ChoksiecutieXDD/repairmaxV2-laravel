<x-layouts.landing title="Track Status | Repairmax">
    <main class="relative pt-32 lg:pt-40 pb-20 md:pb-28 min-h-[90vh] flex flex-col justify-center overflow-hidden">
        <!-- Glow Effects -->
        <div class="absolute top-1/4 left-1/4 w-125 h-125 bg-blue-900/10 rounded-full blur-[120px] pointer-events-none"></div>
        <div class="absolute bottom-1/4 right-1/4 w-125 h-125 bg-indigo-900/10 rounded-full blur-[120px] pointer-events-none"></div>


        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-16 fade-in-element">
            <div class="text-center max-w-3xl mx-auto">
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold text-white mb-6 tracking-tight">Track Your Repair</h1>
                <p class="text-lg md:text-xl text-gray-400 leading-relaxed">
                    Enter your Ticket Number and email to get real-time updates on your device status.
                </p>
            </div>
        </section>

        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full fade-in-element mb-16">
            <div class="bg-white/3 backdrop-blur-md rounded-3xl p-8 md:p-12 border border-white/10 shadow-2xl">
                <form action="/track-status" method="POST" class="space-y-8">
                    @csrf
                    <div>
                        <label class="block text-sm font-bold text-gray-300 mb-3">Ticket Number</label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <span class="material-symbols-outlined text-gray-400 group-focus-within:text-blue-500 transition-colors">tag</span>
                            </div>
                            <input type="text" name="ticket_id" placeholder="e.g. RM-00001" autocomplete="off" required 
                                class="w-full pl-12 pr-4 py-4 bg-white/5 border border-white/10 rounded-[1.25rem] outline-none focus:bg-white/10 focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition-all text-base text-white shadow-inner">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-300 mb-3">Email Address</label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <span class="material-symbols-outlined text-gray-400 group-focus-within:text-blue-500 transition-colors">mail</span>
                            </div>
                            <input type="email" name="email" placeholder="hello@example.com" autocomplete="off" required 
                                class="w-full pl-12 pr-4 py-4 bg-white/5 border border-white/10 rounded-[1.25rem] outline-none focus:bg-white/10 focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition-all text-base text-white shadow-inner">
                        </div>
                    </div>

                    <button type="submit" class="w-full py-4 bg-blue-600 text-white font-bold rounded-[1.25rem] transition-all shadow-lg shadow-blue-500/20 hover:bg-blue-500 hover:-translate-y-0.5 text-base md:text-lg">
                        Check Status
                    </button>
                </form>

                @if(isset($status))
                <div class="mt-12 pt-12 border-t border-white/5 fade-in-element">
                    <div class="mb-6">
                        <div class="flex items-center gap-3 mb-4">
                            <span class="material-symbols-outlined text-emerald-400 text-2xl">check_circle</span>
                            <h3 class="text-2xl font-bold text-white">Repair Status</h3>
                        </div>
                        <div class="bg-emerald-500/10 backdrop-blur-sm border border-emerald-500/20 rounded-2xl p-6">
                            <p class="text-lg font-bold text-white">
                                <span class="text-emerald-400">Status:</span> {{ $status }}
                            </p>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </section>

        <!-- Additional Help Section -->
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
            <div class="bg-white/3 backdrop-blur-md rounded-2xl border border-white/10 p-8 shadow-2xl">
                <h3 class="text-lg font-bold text-white mb-4 flex items-center gap-2">
                    <span class="material-symbols-outlined text-gray-400">help</span>
                    Need Help?
                </h3>
                <p class="text-gray-400 mb-4">
                    If you can't find your ticket number, check your confirmation email or contact our support team.
                </p>
                <a href="/contact" class="inline-flex items-center gap-2 text-blue-400 hover:text-blue-300 font-bold">
                    <span>Contact Support</span>
                    <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
                </a>
            </div>
        </section>
    </main>
</x-layouts.landing>
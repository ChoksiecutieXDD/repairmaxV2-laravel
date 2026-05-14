<x-layouts.landing title="Track Status | Repairmax">
    <main class="pt-32 lg:pt-40 pb-20 md:pb-28 min-h-[90vh] flex flex-col justify-center bg-[#F3F4F6]">

        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-16 fade-in-element">
            <div class="text-center max-w-3xl mx-auto">
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold text-gray-900 mb-6 tracking-tight">Track Your Repair</h1>
                <p class="text-lg md:text-xl text-gray-600 leading-relaxed">
                    Enter your repair ticket ID and email to get real-time updates on your device status.
                </p>
            </div>
        </section>

        <section class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 w-full fade-in-element mb-16">
            <div class="bg-white rounded-3xl p-8 md:p-12 shadow-lg shadow-gray-200/50 border border-gray-100">
                <form action="/track-status" method="POST" class="space-y-8">
                    @csrf
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-3">Repair Ticket ID</label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <span class="material-symbols-outlined text-gray-400 group-focus-within:text-blue-500 transition-colors">tag</span>
                            </div>
                            <input type="text" name="ticket_id" placeholder="e.g. RM-84920" required 
                                class="w-full pl-12 pr-4 py-4 bg-white border border-gray-200 rounded-[1.25rem] outline-none focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition-all text-base shadow-sm">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-3">Email Address</label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <span class="material-symbols-outlined text-gray-400 group-focus-within:text-blue-500 transition-colors">mail</span>
                            </div>
                            <input type="email" name="email" placeholder="hello@example.com" required 
                                class="w-full pl-12 pr-4 py-4 bg-white border border-gray-200 rounded-[1.25rem] outline-none focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition-all text-base shadow-sm">
                        </div>
                    </div>

                    <button type="submit" class="w-full py-4 bg-gray-900 text-white font-bold rounded-[1.25rem] transition-all shadow-md hover:bg-gray-800 hover:-translate-y-0.5 text-base md:text-lg">
                        Check Status
                    </button>
                </form>

                @if(isset($status))
                <div class="mt-12 pt-12 border-t border-gray-100 fade-in-element">
                    <div class="mb-6">
                        <div class="flex items-center gap-3 mb-4">
                            <span class="material-symbols-outlined text-green-600 text-2xl">check_circle</span>
                            <h3 class="text-2xl font-bold text-gray-900">Repair Status</h3>
                        </div>
                        <div class="bg-gradient-to-r from-green-50 to-green-100/50 border border-green-200 rounded-2xl p-6">
                            <p class="text-lg font-bold text-gray-900">
                                <span class="text-green-600">Status:</span> {{ $status }}
                            </p>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </section>

        <!-- Additional Help Section -->
        <section class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
            <div class="bg-gray-50 rounded-2xl border border-gray-200 p-8">
                <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center gap-2">
                    <span class="material-symbols-outlined text-gray-600">help</span>
                    Need Help?
                </h3>
                <p class="text-gray-600 mb-4">
                    If you can't find your ticket ID, check your confirmation email or contact our support team.
                </p>
                <a href="/contact" class="inline-flex items-center gap-2 text-blue-600 hover:text-blue-700 font-bold">
                    <span>Contact Support</span>
                    <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
                </a>
            </div>
        </section>
    </main>
</x-layouts.landing>
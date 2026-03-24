<x-layouts.landing title="Track Status | Repairmax">
    <main class="pt-32 lg:pt-40 pb-16 md:pb-24 min-h-[80vh] flex flex-col justify-center">

        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-10 fade-in-element">
            <div class="text-center max-w-3xl mx-auto">
                <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 mb-4 tracking-tight">Track Your Repair</h1>
                <p class="text-lg text-gray-600 leading-relaxed">
                    Enter your repair ticket ID and email to get real-time updates.
                </p>
            </div>
        </section>

        <section class="max-w-2xl w-full mx-auto px-4 sm:px-6 lg:px-8 fade-in-element">
            <div class="bg-white rounded-3xl p-8 md:p-10 shadow-sm border border-gray-200">
                <form action="/track-status" method="POST" class="space-y-6">
                    @csrf
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Repair Ticket ID</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none material-symbols-outlined text-gray-400">tag</span>
                            <input type="text" name="ticket_id" placeholder="e.g. RM-84920" required class="w-full pl-12 pr-4 py-3.5 bg-gray-50 border border-gray-300 rounded-xl outline-none focus:ring-2 focus:ring-gray-900 transition-all">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none material-symbols-outlined text-gray-400">mail</span>
                            <input type="email" name="email" placeholder="hello@example.com" required class="w-full pl-12 pr-4 py-3.5 bg-gray-50 border border-gray-300 rounded-xl outline-none focus:ring-2 focus:ring-gray-900 transition-all">
                        </div>
                    </div>

                    <button type="submit" class="w-full py-4 bg-gray-900 text-white font-bold rounded-xl transition-all shadow-md hover:bg-gray-800 hover:-translate-y-0.5">
                        Check Status
                    </button>
                </form>

                @if(isset($status))
                <div class="mt-8 pt-8 border-t border-gray-100 fade-in-element">
                    <div class="flex items-center gap-3 mb-3">
                        <span class="material-symbols-outlined text-green-600">check_circle</span>
                        <h3 class="text-lg font-bold text-gray-900">Status: {{ $status }}</h3>
                    </div>
                </div>
                @endif
            </div>
        </section>
    </main>
</x-layouts.landing>
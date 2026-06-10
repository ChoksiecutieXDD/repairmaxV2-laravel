<x-layouts.landing title="Book a Repair | Repairmax">
    <main class="relative pt-24 lg:pt-28 pb-16 md:pb-24 overflow-hidden">
        <!-- Glow Effects -->
        <div class="absolute top-1/4 left-1/4 w-125 h-125 bg-blue-900/10 rounded-full blur-[120px] pointer-events-none"></div>
        <div class="absolute bottom-1/4 right-1/4 w-125 h-125 bg-indigo-900/10 rounded-full blur-[120px] pointer-events-none"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="mb-6 md:mb-8 text-center">
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold text-white mb-6 tracking-tight">
                Tell us about your device.
            </h1>
            <p class="text-lg md:text-xl text-gray-400 leading-relaxed max-w-2xl mx-auto font-medium">
                Skip the line and let us know exactly what is going on. Our technicians will be ready to bring your device back to life.
            </p>
            <div class="mt-4 flex items-center justify-center gap-1.5 text-[10px] sm:text-xs font-black text-blue-400 uppercase tracking-widest bg-blue-500/10 border border-blue-500/15 rounded-full px-5 py-2 w-max mx-auto shadow-sm">
                <span class="material-symbols-outlined text-[16px] shrink-0">pin_drop</span>
                Commonwealth Ave. Cor. IBP Road (Litex Junction), QC
            </div>
        </div>

        @if (session('success'))
            <!-- Custom Success Alert -->
            <div class="bg-emerald-500/10 backdrop-blur-md border border-emerald-500/20 rounded-4xl p-10 text-center max-w-2xl mx-auto shadow-2xl">
                <div class="w-20 h-20 bg-emerald-500/20 text-emerald-400 rounded-3xl flex items-center justify-center mx-auto mb-6 border border-emerald-500/30">
                    <span class="material-symbols-outlined text-[40px] leading-none">check_circle</span>
                </div>
                <h3 class="text-3xl font-black text-white tracking-tight mb-3">Booking Received!</h3>
                <p class="text-gray-400 text-sm leading-relaxed mb-8 max-w-md mx-auto">
                    {{ session('success_message') }}
                </p>
                <div class="flex flex-col sm:flex-row gap-3 justify-center">
                    <a href="{{ route('home') }}" class="px-8 py-3.5 bg-blue-600 text-white font-bold rounded-full hover:bg-blue-700 transition-all text-sm shadow-md">
                        Back to Home
                    </a>
                    <a href="/help/track" class="px-8 py-3.5 bg-white/5 border border-white/10 text-white font-bold rounded-full hover:bg-white/10 transition-all text-sm">
                        Track Repair
                    </a>
                </div>
            </div>
        @else
            @livewire('public-booking')
        @endif
    </main>
</x-layouts.landing>
<x-layouts.landing title="Book a Repair | Repairmax">
    <main class="pt-32 lg:pt-40 py-16 md:py-24 !pt-40">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="mb-6 md:mb-8 text-center">
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold text-gray-900 mb-6 tracking-tight">
                Tell us about your device.
            </h1>
            <p class="text-lg md:text-xl text-gray-600 leading-relaxed max-w-2xl mx-auto">
                Skip the line and let us know exactly what is going on. Our technicians will be ready to bring your device back to life.
            </p>
            <div class="mt-4 flex items-center justify-center gap-1.5 text-[10px] sm:text-xs font-black text-blue-600 uppercase tracking-widest bg-blue-50/50 border border-blue-100/40 rounded-full px-5 py-2 w-max mx-auto shadow-sm">
                <span class="material-symbols-outlined text-[16px] shrink-0">pin_drop</span>
                Commonwealth Ave. Cor. IBP Road (Litex Junction), QC
            </div>
        </div>

        @if (session('success'))
            <!-- Custom Success Alert -->
            <div class="bg-emerald-50 border border-emerald-100 rounded-[2rem] p-10 text-center max-w-2xl mx-auto shadow-lg shadow-emerald-50">
                <div class="w-20 h-20 bg-emerald-100 text-emerald-600 rounded-[1.5rem] flex items-center justify-center mx-auto mb-6 border border-emerald-200">
                    <span class="material-symbols-outlined text-[40px] leading-none">check_circle</span>
                </div>
                <h3 class="text-3xl font-black text-gray-900 tracking-tight mb-3">Booking Received!</h3>
                <p class="text-gray-600 text-sm leading-relaxed mb-8 max-w-md mx-auto">
                    {{ session('success_message') }}
                </p>
                <div class="flex flex-col sm:flex-row gap-3 justify-center">
                    <a href="{{ route('home') }}" class="px-8 py-3.5 bg-gray-900 text-white font-bold rounded-[1.25rem] hover:bg-black transition-all text-sm shadow-md">
                        Back to Home
                    </a>
                    <a href="/help/track" class="px-8 py-3.5 bg-white border border-gray-200 text-gray-700 font-bold rounded-[1.25rem] hover:bg-gray-50 transition-all text-sm">
                        Track Repair
                    </a>
                </div>
            </div>
        @else
            @livewire('public-booking')
        @endif
    </main>
</x-layouts.landing>
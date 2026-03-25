<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>403 - Access Denied</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="antialiased bg-brand-900 text-brand-100 font-sans selection:bg-brand-500 selection:text-brand-900 min-h-screen flex items-center overflow-hidden">

    <div class="absolute inset-0 z-0 opacity-10" style="background-image: linear-gradient(var(--color-brand-700) 1px, transparent 1px), linear-gradient(90deg, var(--color-brand-700) 1px, transparent 1px); background-size: 40px 40px;"></div>

    <div class="max-w-7xl mx-auto px-6 lg:px-8 w-full relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">

            <div x-data="{ show: false }" x-init="setTimeout(() => show = true, 100)"
                x-show="show"
                x-transition:enter="transition ease-out duration-700"
                x-transition:enter-start="opacity-0 -translate-x-8"
                x-transition:enter-end="opacity-100 translate-x-0"
                class="order-2 lg:order-1 text-center lg:text-left">

                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-brand-800 border border-brand-700 mb-8">
                    <span class="w-2 h-2 rounded-full bg-orange-500 animate-pulse"></span>
                    <span class="text-xs font-mono font-semibold text-brand-300 tracking-wider uppercase">Error 403</span>
                </div>

                <h1 class="text-5xl lg:text-7xl font-black tracking-tight text-brand-50 mb-6">
                    Access Denied.
                </h1>

                <p class="text-brand-400 text-lg lg:text-xl leading-relaxed max-w-lg mx-auto lg:mx-0 mb-10">
                    Security protocols have blocked your request. You currently lack the necessary clearance credentials to view this sector.
                </p>

                <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4">
                    <button @click="window.history.back()" class="w-full sm:w-auto px-8 py-4 bg-brand-100 text-brand-900 hover:bg-white font-bold rounded-lg shadow-lg transition-all duration-300 flex items-center justify-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Retreat to Safety
                    </button>
                    @guest
                    <a href="{{ route('login') }}" class="w-full sm:w-auto px-8 py-4 bg-transparent border-2 border-brand-700 text-brand-300 hover:text-brand-50 hover:border-brand-500 hover:bg-brand-800 font-bold rounded-lg transition-all duration-300 text-center">
                        Authenticate
                    </a>
                    @endguest
                </div>
            </div>

            <div class="order-1 lg:order-2 flex justify-center lg:justify-end"
                x-data="{ show: false }" x-init="setTimeout(() => show = true, 300)"
                x-show="show"
                x-transition:enter="transition ease-out duration-1000"
                x-transition:enter-start="opacity-0 scale-90"
                x-transition:enter-end="opacity-100 scale-100">

                <div class="relative w-64 h-64 md:w-80 md:h-80 flex items-center justify-center group">
                    <div class="absolute inset-0 rounded-full border-[6px] border-brand-800 border-t-brand-500 opacity-80 animate-[spin_4s_linear_infinite]"></div>
                    <div class="absolute inset-4 rounded-full border-4 border-brand-700 border-b-orange-500 opacity-60 animate-[spin_6s_linear_infinite_reverse]"></div>

                    <div class="absolute w-3/4 h-3/4 rounded-full bg-brand-800 shadow-inner flex items-center justify-center border border-brand-600 transition-transform duration-300 group-hover:scale-95">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-20 h-20 text-brand-400 group-hover:text-orange-400 transition-colors duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                        </svg>
                    </div>

                    <div class="absolute w-full h-1 bg-orange-500/50 blur-sm animate-[ping_2s_ease-in-out_infinite] top-1/2 -translate-y-1/2 z-20"></div>
                </div>
            </div>

        </div>
    </div>

</body>

</html>
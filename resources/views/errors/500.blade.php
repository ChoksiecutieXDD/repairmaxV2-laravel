<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>500 - System Failure</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="antialiased bg-brand-900 text-brand-100 font-sans selection:bg-brand-500 selection:text-brand-900 min-h-screen flex items-center">

    <div class="max-w-7xl mx-auto px-6 lg:px-8 w-full">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">

            <div x-data="{ show: false }" x-init="setTimeout(() => show = true, 100)"
                x-show="show"
                x-transition:enter="transition ease-out duration-700"
                x-transition:enter-start="opacity-0 -translate-x-8"
                x-transition:enter-end="opacity-100 translate-x-0"
                class="order-2 lg:order-1 text-center lg:text-left">

                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-brand-800 border border-brand-700 mb-8">
                    <span class="w-2 h-2 rounded-full bg-red-500 animate-pulse"></span>
                    <span class="text-xs font-mono font-semibold text-brand-300 tracking-wider uppercase">Error 500</span>
                </div>

                <h1 class="text-5xl lg:text-7xl font-black tracking-tight text-brand-50 mb-6">
                    System Failure.
                </h1>

                <p class="text-brand-400 text-lg lg:text-xl leading-relaxed max-w-lg mx-auto lg:mx-0 mb-10">
                    Our servers encountered an unexpected critical fault. Automated diagnostics have been triggered and our engineering team is actively working to restore the core.
                </p>

                <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4">
                    <button onclick="window.location.reload()" class="w-full sm:w-auto px-8 py-4 bg-brand-100 text-brand-900 hover:bg-white font-bold rounded-lg shadow-lg transition-all duration-300 flex items-center justify-center gap-2 group">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 transition-transform group-hover:rotate-180 duration-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                        </svg>
                        Reboot Connection
                    </button>
                    <a href="{{ route('contact') }}" class="w-full sm:w-auto px-8 py-4 bg-transparent border-2 border-brand-700 text-brand-300 hover:text-brand-50 hover:border-brand-500 hover:bg-brand-800 font-bold rounded-lg transition-all duration-300 text-center">
                        Contact Support
                    </a>
                </div>
            </div>

            <div class="order-1 lg:order-2 flex justify-center lg:justify-end"
                x-data="{ show: false }" x-init="setTimeout(() => show = true, 300)"
                x-show="show"
                x-transition:enter="transition ease-out duration-1000"
                x-transition:enter-start="opacity-0 scale-90"
                x-transition:enter-end="opacity-100 scale-100">

                <div class="relative w-64 h-64 md:w-80 md:h-80 flex flex-col items-center justify-center gap-4">
                    <div class="w-full h-16 bg-brand-800 border border-brand-600 rounded-md flex items-center px-4 shadow-lg relative overflow-hidden">
                        <div class="w-3 h-3 rounded-full bg-brand-400 absolute right-4"></div>
                        <div class="w-16 h-2 bg-brand-700 rounded-full"></div>
                    </div>

                    <div class="w-full h-16 bg-brand-800 border-2 border-red-900 rounded-md flex items-center px-4 shadow-[0_0_30px_rgba(220,38,38,0.2)] relative overflow-hidden transform translate-x-2">
                        <div class="absolute inset-0 bg-red-500 opacity-10 animate-pulse"></div>
                        <div class="w-3 h-3 rounded-full bg-red-500 absolute right-4 animate-ping"></div>
                        <div class="w-3 h-3 rounded-full bg-red-500 absolute right-4"></div>
                        <div class="w-16 h-2 bg-brand-600 rounded-full"></div>
                        <div class="w-8 h-2 bg-brand-600 rounded-full ml-2"></div>
                    </div>

                    <div class="w-full h-16 bg-brand-800 border border-brand-600 rounded-md flex items-center px-4 shadow-lg relative overflow-hidden">
                        <div class="w-3 h-3 rounded-full bg-brand-400 absolute right-4"></div>
                        <div class="w-24 h-2 bg-brand-700 rounded-full"></div>
                    </div>
                </div>
            </div>

        </div>
    </div>

</body>

</html>
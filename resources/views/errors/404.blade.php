<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Page Not Found</title>
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
                    <span class="w-2 h-2 rounded-full bg-brand-400 animate-pulse"></span>
                    <span class="text-xs font-mono font-semibold text-brand-300 tracking-wider uppercase">Error 404</span>
                </div>

                <h1 class="text-5xl lg:text-7xl font-black tracking-tight text-brand-50 mb-6">
                    Signal Lost.
                </h1>

                <p class="text-brand-400 text-lg lg:text-xl leading-relaxed max-w-lg mx-auto lg:mx-0 mb-10">
                    The coordinates you entered lead to a void. The page you are looking for may have been moved, deleted, or never existed in our database.
                </p>

                <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4">
                    <a href="{{ route('home') }}" class="w-full sm:w-auto px-8 py-4 bg-brand-100 text-brand-900 hover:bg-white font-bold rounded-lg shadow-lg transition-all duration-300 flex items-center justify-center gap-2 group">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 transition-transform group-hover:-translate-x-1" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                        </svg>
                        Return to Base
                    </a>
                    <a href="{{ route('contact') }}" class="w-full sm:w-auto px-8 py-4 bg-transparent border-2 border-brand-700 text-brand-300 hover:text-brand-50 hover:border-brand-500 hover:bg-brand-800 font-bold rounded-lg transition-all duration-300 text-center">
                        Report Issue
                    </a>
                </div>
            </div>

            <div class="order-1 lg:order-2 flex justify-center lg:justify-end"
                x-data="{ show: false }" x-init="setTimeout(() => show = true, 300)"
                x-show="show"
                x-transition:enter="transition ease-out duration-1000"
                x-transition:enter-start="opacity-0 scale-90"
                x-transition:enter-end="opacity-100 scale-100">

                <div class="relative w-64 h-64 md:w-80 md:h-80 flex items-center justify-center">
                    <div class="absolute inset-0 rounded-full border border-brand-700 animate-[ping_3s_cubic-bezier(0,0,0.2,1)_infinite] opacity-50"></div>

                    <div class="absolute w-3/4 h-3/4 rounded-full border border-brand-600 border-dashed opacity-50 animate-[spin_10s_linear_infinite]"></div>

                    <div class="absolute w-1/2 h-1/2 rounded-full border-2 border-brand-700 bg-brand-800 shadow-[0_0_40px_rgba(0,0,0,0.3)]"></div>

                    <div class="relative z-10 w-16 h-16 rounded-full bg-brand-900 border border-brand-600 flex items-center justify-center shadow-inner">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-brand-400 animate-pulse" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>

                    <div class="absolute top-0 right-10 text-brand-700 font-mono text-sm animate-bounce" style="animation-delay: 0.1s;">4</div>
                    <div class="absolute bottom-10 left-4 text-brand-700 font-mono text-sm animate-bounce" style="animation-delay: 0.5s;">0</div>
                    <div class="absolute top-20 left-0 text-brand-700 font-mono text-sm animate-bounce" style="animation-delay: 0.8s;">4</div>
                </div>
            </div>

        </div>
    </div>

</body>

</html>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'User Dashboard | Repairmax' }}</title>
    <link rel="icon" type="image/png" href="{{ asset('img/logo-r-blue.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('img/logo-r-blue.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" rel="stylesheet" />
    
    <!-- Cropper.js -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.1/cropper.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.1/cropper.min.js"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    <style>
        .no-transition * {
            transition: none !important;
        }
        [x-cloak] { display: none !important; }

        /* Scoped Dark Mode overrides for all User Dashboard Views */
        body.bg-\[\#020617\] {
            color: #cbd5e1 !important; /* text-gray-300 */
        }
        /* Convert generic white cards to glassmorphism */
        body.bg-\[\#020617\] .bg-white:not(aside):not(aside *):not(header):not(header *):not(.absolute):not(.fixed) {
            background-color: rgba(255, 255, 255, 0.03) !important;
            backdrop-filter: blur(12px) !important;
            -webkit-backdrop-filter: blur(12px) !important;
            border-color: rgba(255, 255, 255, 0.1) !important;
            color: #e2e8f0 !important;
        }
        body.bg-\[\#020617\] .bg-gray-50,
        body.bg-\[\#020617\] .bg-gray-50\/30,
        body.bg-\[\#020617\] .bg-gray-50\/50 {
            background-color: rgba(255, 255, 255, 0.02) !important;
            border-color: rgba(255, 255, 255, 0.05) !important;
        }
        /* Text overrides */
        body.bg-\[\#020617\] .text-gray-900,
        body.bg-\[\#020617\] .text-gray-800,
        body.bg-\[\#020617\] .text-gray-750,
        body.bg-\[\#020617\] .text-gray-700 {
            color: #ffffff !important;
        }
        body.bg-\[\#020617\] .text-gray-650,
        body.bg-\[\#020617\] .text-gray-600,
        body.bg-\[\#020617\] .text-gray-550,
        body.bg-\[\#020617\] .text-gray-500,
        body.bg-\[\#020617\] .text-gray-455 {
            color: #94a3b8 !important; /* text-gray-400 */
        }
        body.bg-\[\#020617\] .text-gray-400 {
            color: #cbd5e1 !important; /* text-gray-300 */
        }
        /* Borders */
        body.bg-\[\#020617\] .border-brand-200,
        body.bg-\[\#020617\] .border-brand-100,
        body.bg-\[\#020617\] .border-brand-250,
        body.bg-\[\#020617\] .border-gray-250,
        body.bg-\[\#020617\] .border-gray-200,
        body.bg-\[\#020617\] .border-gray-100,
        body.bg-\[\#020617\] .divide-brand-100,
        body.bg-\[\#020617\] .divide-brand-200,
        body.bg-\[\#020617\] .border-t,
        body.bg-\[\#020617\] .border-b,
        body.bg-\[\#020617\] .divide-y,
        body.bg-\[\#020617\] .divide-y > * {
            border-color: rgba(255, 255, 255, 0.08) !important;
        }
        /* Buttons styling */
        body.bg-\[\#020617\] .bg-gray-900 {
            background-color: #1e293b !important;
            color: #ffffff !important;
            border-color: rgba(255, 255, 255, 0.1) !important;
        }
        body.bg-\[\#020617\] .bg-gray-900:hover {
            background-color: #2b3a55 !important;
        }
        body.bg-\[\#020617\] .bg-gray-100 {
            background-color: rgba(255, 255, 255, 0.06) !important;
            color: #ffffff !important;
            border-color: rgba(255, 255, 255, 0.05) !important;
        }
        body.bg-\[\#020617\] .bg-gray-100:hover {
            background-color: rgba(255, 255, 255, 0.12) !important;
        }
        /* Badge colors */
        body.bg-\[\#020617\] .bg-blue-50 {
            background-color: rgba(59, 130, 246, 0.1) !important;
            color: #60a5fa !important;
        }
        body.bg-\[\#020617\] .bg-green-50 {
            background-color: rgba(16, 185, 129, 0.1) !important;
            color: #34d399 !important;
        }
        body.bg-\[\#020617\] .bg-orange-50 {
            background-color: rgba(249, 115, 22, 0.1) !important;
            color: #fb923c !important;
        }
        body.bg-\[\#020617\] .bg-purple-50 {
            background-color: rgba(139, 92, 246, 0.1) !important;
            color: #c084fc !important;
        }
        body.bg-\[\#020617\] .bg-amber-50 {
            background-color: rgba(245, 158, 11, 0.1) !important;
            color: #fbbf24 !important;
        }
        /* Inputs & forms styling */
        body.bg-\[\#020617\] input,
        body.bg-\[\#020617\] select,
        body.bg-\[\#020617\] textarea {
            background-color: rgba(255, 255, 255, 0.02) !important;
            border-color: rgba(255, 255, 255, 0.1) !important;
            color: #ffffff !important;
        }
        body.bg-\[\#020617\] input:focus,
        body.bg-\[\#020617\] select:focus,
        body.bg-\[\#020617\] textarea:focus {
            border-color: #3b82f6 !important;
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.15) !important;
        }
        body.bg-\[\#020617\] input::placeholder,
        body.bg-\[\#020617\] textarea::placeholder {
            color: #475569 !important;
        }
        /* Dropdowns list in select */
        body.bg-\[\#020617\] select option {
            background-color: #0b0f19 !important;
            color: #ffffff !important;
        }
        /* Labels */
        body.bg-\[\#020617\] label {
            color: #cbd5e1 !important;
        }
        /* Table rows hover and headers */
        body.bg-\[\#020617\] thead.bg-gray-50,
        body.bg-\[\#020617\] tr.bg-gray-50 {
            background-color: rgba(255, 255, 255, 0.04) !important;
        }
        body.bg-\[\#020617\] tr.hover\:bg-gray-50:hover {
            background-color: rgba(255, 255, 255, 0.05) !important;
        }
    </style>
</head>

<body class="font-sans antialiased no-transition transition-colors duration-300"
    :class="darkMode ? 'bg-[#020617] text-gray-300 dark' : 'bg-gray-50 text-gray-800'"
    x-data="{ 
        darkMode: localStorage.getItem('theme') !== 'light',
        toggleTheme() {
            this.darkMode = !this.darkMode;
            localStorage.setItem('theme', this.darkMode ? 'dark' : 'light');
            document.documentElement.classList.toggle('dark', this.darkMode);
        },
        currentToast: null,
        show: false,
        timeout: null,
        addToast(message, type = 'success') {
            if (this.show) {
                this.show = false;
                setTimeout(() => {
                    this.currentToast = { message, type };
                    this.show = true;
                    this.resetTimeout();
                }, 450);
            } else {
                this.currentToast = { message, type };
                this.show = true;
                this.resetTimeout();
            }
        },
        resetTimeout() {
            clearTimeout(this.timeout);
            this.timeout = setTimeout(() => { this.show = false }, 5000);
        }
    }"
    @toast.window="addToast($event.detail.message || $event.detail[0].message, $event.detail.type || $event.detail[0].type)">
    <script>
        // Inline script to prevent theme flashing on load
        (function() {
            const theme = localStorage.getItem('theme') || 'dark';
            const body = document.body;
            if (theme === 'dark') {
                body.classList.add('bg-[#020617]', 'text-gray-300', 'dark');
                document.documentElement.classList.add('dark');
            } else {
                body.classList.remove('bg-[#020617]', 'text-gray-300', 'dark');
                body.classList.add('bg-gray-50', 'text-gray-800');
                document.documentElement.classList.remove('dark');
            }
        })();
    </script>

    <!-- Toast Container -->
    <div class="fixed top-10 left-1/2 -translate-x-1/2 z-[100] flex flex-col pointer-events-none w-full max-w-sm px-4">
        <div x-show="show"
            x-transition:enter="transition ease-out duration-500"
            x-transition:enter-start="opacity-0 -translate-y-10 scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 scale-100"
            x-transition:leave="transition ease-in duration-400"
            x-transition:leave-start="opacity-100 translate-y-0 scale-100"
            x-transition:leave-end="opacity-0 -translate-y-10 scale-95"
            :class="{
                'bg-gray-900': currentToast?.type === 'success',
                'bg-red-600': currentToast?.type === 'error',
                'bg-blue-600': currentToast?.type === 'info',
                'bg-yellow-500': currentToast?.type === 'warning'
            }"
            class="pointer-events-auto w-full px-5 py-4 rounded-[1.25rem] text-white flex items-center justify-between gap-4 shadow-none border-none">
            <template x-if="currentToast">
                <div class="flex items-center gap-3">
                    <span class="material-symbols-outlined text-[22px]" x-text="currentToast.type === 'success' ? 'check_circle' : (currentToast.type === 'error' ? 'error' : 'info')"></span>
                    <span class="text-sm font-bold" x-text="currentToast.message"></span>
                </div>
            </template>
            <button @click="show = false" class="p-0 bg-transparent border-none shadow-none opacity-50 hover:opacity-100 transition-opacity">
                <span class="material-symbols-outlined text-[20px]">close</span>
            </button>
        </div>
    </div>
    <div x-data="{ 
            sidebarOpen: false
        }"
        @resize.window="if(window.innerWidth >= 1024) sidebarOpen = false"
        class="min-h-screen flex flex-col">

        <div x-show="sidebarOpen"
            x-transition:enter="transition-opacity ease-linear duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition-opacity ease-linear duration-300"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            @click="sidebarOpen = false"
            class="fixed inset-0 bg-gray-950/40 dark:bg-[#020617]/80 backdrop-blur-md lg:hidden z-30" style="display: none;"></div>

        <aside :class="{ 
                'translate-x-0': sidebarOpen, 
                '-translate-x-full': !sidebarOpen
            }"
            class="fixed left-0 top-0 h-screen w-64 bg-white dark:bg-[#020617] transition-transform duration-300 ease-in-out z-40 flex flex-col lg:translate-x-0">

            <div class="h-20 flex items-center justify-between px-6 bg-white dark:bg-[#020617] shrink-0 border-b border-gray-200/80 dark:border-none">
                <div class="flex items-center gap-2.5 select-none">
                    <img x-show="darkMode" src="{{ asset('img/logo-r-white.png') }}" alt="Repairmax Logo" class="h-8 w-auto">
                    <img x-show="!darkMode" x-cloak src="{{ asset('img/logo-r-blue.png') }}" alt="Repairmax Logo" class="h-8 w-auto">
                    <span class="font-[Montserrat] text-lg font-bold tracking-tight text-gray-900 dark:text-white">Repairmax</span>
                </div>

                <button @click="sidebarOpen = false" class="lg:hidden text-gray-400 hover:text-gray-900 dark:hover:text-white focus:outline-none bg-transparent border-0 p-0 shadow-none hover:shadow-none hover:translate-y-0 active:scale-100">
                    <span class="material-symbols-outlined text-[24px]">close</span>
                </button>
            </div>

            <nav id="sidebar-nav" class="flex-1 overflow-y-auto py-6 space-y-2 [-ms-overflow-style:none] [scrollbar-width:none] [&::-webkit-scrollbar]:hidden">
                <div class="mb-6">
                    <h3 class="px-6 py-2 text-xs font-bold text-gray-500 mb-1">Main</h3>
                    <x-sidebar.link href="/user/dashboard" icon="dashboard" :active="request()->is('user/dashboard')">Dashboard</x-sidebar.link>
                </div>

                <div class="mb-6">
                    <h3 class="px-6 py-2 text-xs font-bold text-gray-500 mb-1">Appointments</h3>
                    <x-sidebar.link href="/user/book-appointment" icon="add_circle" :active="request()->is('user/book-appointment')">Book Appointment</x-sidebar.link>
                    <x-sidebar.link href="/user/upcoming-appointments" icon="calendar_today" :active="request()->is('user/upcoming-appointments')">Upcoming</x-sidebar.link>
                    <x-sidebar.link href="/user/appointment-history" icon="history" :active="request()->is('user/appointment-history')">History</x-sidebar.link>
                </div>

                <div class="mb-6">
                    <h3 class="px-6 py-2 text-xs font-bold text-gray-500 mb-1">Services</h3>
                    <x-sidebar.link href="{{ route('user.services') }}" icon="handyman" :active="request()->routeIs('user.services')">Services</x-sidebar.link>
                </div>

                <div class="mb-6">
                    <h3 class="px-6 py-2 text-xs font-bold text-gray-500 mb-1">Help & Support</h3>
                    <x-sidebar.link href="/help" icon="help" :active="request()->is('help*')">Help Center</x-sidebar.link>
                    <x-sidebar.link href="{{ route('user.ai-support') }}" icon="smart_toy" :active="request()->routeIs('user.ai-support')">AI Support</x-sidebar.link>
                    <x-sidebar.link href="{{ route('user.support-message') }}" icon="mail" :active="request()->routeIs('user.support-message')">Contact Support</x-sidebar.link>
                </div>
            </nav>

        </aside>

        <header class="fixed top-0 right-0 left-0 lg:left-64 bg-white/90 dark:bg-[#020617]/90 backdrop-blur-md z-20 h-20 flex items-center dark:border-none">
            <div class="flex items-center px-4 md:px-8 w-full">
 
                <button @click="sidebarOpen = !sidebarOpen"
                    class="lg:hidden inline-flex items-center justify-center w-10 h-10 bg-transparent hover:bg-gray-100 dark:hover:bg-white/5 rounded-[1.25rem] transition-colors text-gray-700 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500/20 shrink-0">
                    <span class="material-symbols-outlined text-[26px]">menu</span>
                </button>
 
                <!-- Page Title -->
                <div class="ml-4 lg:ml-0 font-bold text-gray-900 dark:text-white text-lg tracking-tight truncate">
                    {{ $title ?? 'Dashboard' }}
                </div>
 
                <!-- User UI Dropdown -->
                <div class="ml-auto flex items-center gap-3">
                    @auth
                    <!-- Theme Toggle Button -->
                    <button @click="toggleTheme()" class="inline-flex items-center justify-center p-2 rounded-xl text-gray-500 hover:text-gray-950 dark:text-gray-400 dark:hover:text-white hover:bg-gray-100 dark:hover:bg-white/5 transition-all bg-transparent border-0 shadow-none hover:shadow-none hover:translate-y-0 active:scale-100 shrink-0">
                        <span class="material-symbols-outlined text-[24px]" x-text="darkMode ? 'light_mode' : 'dark_mode'"></span>
                    </button>
 
                    <!-- Notification Bell -->
                    <a href="{{ route('user.notifications') }}" class="relative inline-flex items-center justify-center p-2 rounded-xl text-gray-500 hover:text-gray-950 dark:text-gray-400 dark:hover:text-white hover:bg-gray-100 dark:hover:bg-white/5 transition-all group shrink-0 mr-1 bg-transparent border-0 shadow-none hover:shadow-none hover:translate-y-0 active:scale-100">
                        <span class="material-symbols-outlined text-[24px]">notifications</span>
                        <div class="absolute top-1.5 right-1.5">
                            @livewire('notification-badge', ['type' => 'user'])
                        </div>
                    </a>
 
                    <div x-data="{ open: false }" class="relative">
                        <button @click="open = !open" @click.outside="open = false" class="flex items-center gap-3 p-1.5 hover:bg-gray-100 dark:hover:bg-white/5 rounded-xl transition-all focus:outline-none group bg-transparent border-0 shadow-none hover:shadow-none hover:translate-y-0 active:scale-100">
                            @if(auth()->user()->profile_picture)
                                <img src="{{ asset('storage/' . auth()->user()->profile_picture) }}"
                                    alt="Profile"
                                    class="w-9 h-9 rounded-full border border-gray-700/50 object-cover shadow-sm bg-gray-900 shrink-0 group-hover:border-gray-500 transition-colors">
                            @else
                                <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->first_name ?? auth()->user()->name) }}&background=1e293b&color=cbd5e1&bold=true"
                                    alt="Profile"
                                    class="w-9 h-9 rounded-full border border-gray-700/50 object-cover shadow-sm bg-gray-900 shrink-0 group-hover:border-gray-500 transition-colors">
                            @endif
                            <div class="hidden sm:flex flex-col text-left">
                                <span class="text-sm font-semibold text-gray-700 dark:text-gray-200 leading-tight group-hover:text-gray-900 dark:group-hover:text-white transition-colors truncate max-w-[120px]">
                                    {{ auth()->user()->first_name ?? auth()->user()->name }}
                                </span>
                                <span class="text-[11px] text-gray-400 capitalize truncate">
                                    {{ auth()->user()->role ?? 'User' }}
                                </span>
                            </div>
                            <span class="material-symbols-outlined text-[18px] text-gray-455 group-hover:text-gray-900 dark:group-hover:text-white transition-colors">keyboard_arrow_down</span>
                        </button>
 
                        <!-- Dropdown Menu -->
                        <div x-show="open"
                            x-transition:enter="transition ease-out duration-100"
                            x-transition:enter-start="transform opacity-0 scale-95"
                            x-transition:enter-end="transform opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-75"
                            x-transition:leave-start="transform opacity-100 scale-100"
                            x-transition:leave-end="transform opacity-0 scale-95"
                            class="absolute right-0 mt-2 w-56 rounded-xl bg-white dark:bg-[#020617] border border-gray-200 dark:border-white/10 shadow-2xl py-1.5 z-50"
                            style="display: none;">
                            
                            <!-- User Info Header -->
                            <div class="px-4 py-2.5 border-b border-gray-100 dark:border-white/5 flex flex-col text-left">
                                <span class="text-sm font-bold text-gray-900 dark:text-white truncate">{{ auth()->user()->first_name ?? auth()->user()->name }} {{ auth()->user()->last_name ?? '' }}</span>
                                <span class="text-xs text-gray-500 dark:text-gray-400 truncate">{{ auth()->user()->email }}</span>
                            </div>
 
                            <!-- Links -->
                            <a href="/user/profile" class="flex items-center gap-2.5 px-4 py-2 text-sm text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white hover:bg-gray-50 dark:hover:bg-white/5 transition-colors">
                                <span class="material-symbols-outlined text-[18px] text-gray-400 dark:text-gray-400">person</span>
                                Profile
                            </a>
                            <a href="/user/system-settings" class="flex items-center gap-2.5 px-4 py-2 text-sm text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white hover:bg-gray-50 dark:hover:bg-white/5 transition-colors">
                                <span class="material-symbols-outlined text-[18px] text-gray-400 dark:text-gray-400">settings</span>
                                Settings
                            </a>
                            
                            <div class="border-t border-gray-100 dark:border-white/5 my-1"></div>
 
                            <!-- Logout -->
                            <a href="{{ route('logout') }}" class="flex items-center gap-2.5 px-4 py-2.5 text-sm text-red-600 dark:text-red-400 hover:text-red-750 dark:hover:text-white hover:bg-red-50 dark:hover:bg-red-500/10 transition-colors">
                                <span class="material-symbols-outlined text-[18px]">logout</span>
                                Logout
                            </a>
                        </div>
                    </div>
                    @endauth
                </div>

            </div>
        </header>

        <main class="lg:ml-64 pt-20 flex-1 flex flex-col">
            <div class="flex-1 flex flex-col border-t border-gray-200/80 lg:border-l lg:rounded-tl-[1.5rem] bg-gray-50 dark:border-white/15 dark:bg-[#020617]">
                <div class="w-full px-4 sm:px-6 lg:px-8 py-8 flex-1 text-gray-700 dark:text-gray-300">
                    {{ $slot }}
                </div>
            </div>
        </main>
    </div>

    @livewireScripts
    <script>
        // Disable transitions on page load
        window.addEventListener('load', () => {
            setTimeout(() => {
                document.body.classList.remove('no-transition');
            }, 50);
        });

        document.addEventListener('DOMContentLoaded', () => {
            const sidebar = document.getElementById('sidebar-nav');
            if (!sidebar) return;

            // Restore scroll position
            const scrollPos = sessionStorage.getItem('sidebar-scroll');
            if (scrollPos) sidebar.scrollTop = scrollPos;

            // Save scroll position before navigation
            window.addEventListener('beforeunload', () => {
                sessionStorage.setItem('sidebar-scroll', sidebar.scrollTop);
            });
        });
    </script>
</body>

</html>
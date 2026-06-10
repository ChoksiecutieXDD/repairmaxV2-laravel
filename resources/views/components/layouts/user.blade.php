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
        .no-transition,
        .no-transition *,
        .no-transition *::before,
        .no-transition *::after {
            transition: none !important;
            animation: none !important;
        }
        [x-cloak] { display: none !important; }

        body.dark input:focus,
        body.dark select:focus,
        body.dark textarea:focus,
        .dark input:focus,
        .dark select:focus,
        .dark textarea:focus {
            border-color: #3b82f6 !important;
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.35) !important;
            outline: none !important;
        }
    </style>
</head>

<body class="font-sans antialiased no-transition"
    :class="darkMode ? 'bg-[#020617] text-gray-300 dark' : 'bg-gray-50 text-gray-800'"
    x-data="{ 
        darkMode: localStorage.getItem('theme') !== 'light',
        logoutModal: false,
        isLoggingOut: false,
        triggerLogout() {
            this.logoutModal = false;
            this.isLoggingOut = true;
            setTimeout(() => {
                window.location.href = '{{ route('logout') }}';
            }, 1500);
        },
        toggleTheme() {
            document.documentElement.classList.add('no-transition');
            document.body.classList.add('no-transition');

            this.darkMode = !this.darkMode;
            localStorage.setItem('theme', this.darkMode ? 'dark' : 'light');
            document.documentElement.classList.toggle('dark', this.darkMode);
            const body = document.body;
            if (this.darkMode) {
                body.classList.add('bg-[#020617]', 'text-gray-300', 'dark');
                body.classList.remove('bg-gray-50', 'text-gray-800');
            } else {
                body.classList.remove('bg-[#020617]', 'text-gray-300', 'dark');
                body.classList.add('bg-gray-50', 'text-gray-800');
            }

            document.body.offsetHeight; // force reflow

            setTimeout(() => {
                document.documentElement.classList.remove('no-transition');
                document.body.classList.remove('no-transition');
            }, 50);
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

            <div class="h-20 flex items-center justify-between px-6 bg-white dark:bg-[#020617] shrink-0">
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

                <div class="mb-6" x-data="{ servicesOpen: {{ request()->routeIs('user.services') ? 'true' : 'false' }} }">
                    <h3 class="px-6 py-2 text-xs font-bold text-gray-500 mb-1">Services</h3>
                    
                    <div class="relative flex items-center justify-between mx-3.5 rounded-xl group transition-all duration-300
                        {{ request()->routeIs('user.services') 
                           ? 'bg-blue-600/10 text-blue-600 dark:text-blue-400 font-bold' 
                           : 'text-gray-500 hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-gray-200 dark:hover:bg-white/5' }}">
                        
                        <!-- Main Link -->
                        <a href="{{ route('user.services') }}" class="flex-1 flex items-center gap-3.5 px-4 py-3">
                            <span class="material-symbols-outlined text-[20px] transition-transform duration-300 group-hover:scale-105 {{ request()->routeIs('user.services') ? 'text-blue-600 dark:text-blue-400' : 'text-gray-400 dark:text-gray-500' }}">
                                handyman
                            </span>
                            <span class="text-sm font-medium truncate">Services</span>
                        </a>

                        <!-- Dropdown Arrow Button -->
                        <button @click.prevent="servicesOpen = !servicesOpen" 
                            class="px-3.5 py-3 hover:text-gray-955 dark:hover:text-white transition-all flex items-center justify-center bg-transparent shadow-none hover:shadow-none hover:translate-y-0 active:scale-100 cursor-pointer">
                            <span class="material-symbols-outlined text-[18px] transition-transform duration-300" :class="servicesOpen ? 'rotate-180' : ''">
                                keyboard_arrow_down
                            </span>
                        </button>
                    </div>

                    <!-- Dropdown Items -->
                    <div x-show="servicesOpen" 
                         x-transition:enter="transition ease-out duration-150" 
                         x-transition:enter-start="opacity-0 -translate-y-1" 
                         x-transition:enter-end="opacity-100 translate-y-0"
                         x-cloak 
                         class="mt-1 space-y-1 pl-12 pr-3.5">
                        <a href="{{ route('user.services') }}?selectedCategory=screen" 
                            class="flex items-center py-2 text-[13px] font-medium transition-all
                            {{ request()->query('selectedCategory') === 'screen' 
                               ? 'text-blue-600 dark:text-blue-400 font-bold' 
                               : 'text-gray-500 hover:text-gray-900 dark:text-gray-400 dark:hover:text-gray-200' }}">
                            Screen & Display
                        </a>
                        <a href="{{ route('user.services') }}?selectedCategory=power" 
                            class="flex items-center py-2 text-[13px] font-medium transition-all
                            {{ request()->query('selectedCategory') === 'power' 
                               ? 'text-blue-600 dark:text-blue-400 font-bold' 
                               : 'text-gray-500 hover:text-gray-900 dark:text-gray-400 dark:hover:text-gray-200' }}">
                            Power & Charging
                        </a>
                        <a href="{{ route('user.services') }}?selectedCategory=audio" 
                            class="flex items-center py-2 text-[13px] font-medium transition-all
                            {{ request()->query('selectedCategory') === 'audio' 
                               ? 'text-blue-600 dark:text-blue-400 font-bold' 
                               : 'text-gray-500 hover:text-gray-900 dark:text-gray-400 dark:hover:text-gray-200' }}">
                            Audio & Sound
                        </a>
                        <a href="{{ route('user.services') }}?selectedCategory=software" 
                            class="flex items-center py-2 text-[13px] font-medium transition-all
                            {{ request()->query('selectedCategory') === 'software' 
                               ? 'text-blue-600 dark:text-blue-400 font-bold' 
                               : 'text-gray-500 hover:text-gray-900 dark:text-gray-400 dark:hover:text-gray-200' }}">
                            Software & Systems
                        </a>
                        <a href="{{ route('user.services') }}?selectedCategory=hardware" 
                            class="flex items-center py-2 text-[13px] font-medium transition-all
                            {{ request()->query('selectedCategory') === 'hardware' 
                               ? 'text-blue-600 dark:text-blue-400 font-bold' 
                               : 'text-gray-500 hover:text-gray-900 dark:text-gray-400 dark:hover:text-gray-200' }}">
                            Hardware & Modules
                        </a>
                    </div>
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
            <div class="relative flex items-center px-4 md:px-8 w-full h-full">
 
                <button @click="sidebarOpen = !sidebarOpen"
                    class="lg:hidden inline-flex items-center justify-center w-10 h-10 bg-transparent hover:bg-gray-100 dark:hover:bg-white/5 rounded-[1.25rem] transition-colors text-gray-700 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500/20 shrink-0">
                    <span class="material-symbols-outlined text-[26px]">menu</span>
                </button>
 
                <!-- Search Bar -->
                <div class="absolute left-1/2 lg:left-[calc(50%-128px)] -translate-x-1/2 w-full max-w-[180px] min-[400px]:max-w-[240px] sm:max-w-sm md:max-w-md z-10">
                    <span class="material-symbols-outlined absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-450 dark:text-gray-500 text-[20px] pointer-events-none">search</span>
                    <input type="text" 
                        placeholder="Search repairs, services..." 
                        class="w-full pl-10 pr-4 py-2 bg-gray-50 hover:bg-gray-100/70 dark:bg-white/5 dark:hover:bg-white/10 text-gray-900 dark:text-white border border-gray-200 dark:border-white/10 rounded-xl text-xs sm:text-sm focus:outline-none transition-all placeholder:text-gray-450 dark:placeholder:text-gray-500 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 dark:focus:!border-blue-500 dark:focus:!ring-2 dark:focus:!ring-blue-500/25"
                        onkeydown="if(event.key === 'Enter') { window.location.href = '{{ route('user.services') }}?search=' + encodeURIComponent(this.value); }">
                </div>
 
                <!-- User UI Dropdown -->
                <div class="ml-auto flex items-center gap-3 z-20">
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
                            <a href="/user/profile#personal-info" class="flex items-center gap-2.5 px-4 py-2 text-sm text-gray-650 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white hover:bg-gray-50 dark:hover:bg-white/5 transition-colors">
                                <span class="material-symbols-outlined text-[18px] text-gray-400 dark:text-gray-450">badge</span>
                                Personal Information
                            </a>
                            <a href="/user/profile#edit-profile" class="flex items-center gap-2.5 px-4 py-2 text-sm text-gray-650 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white hover:bg-gray-50 dark:hover:bg-white/5 transition-colors">
                                <span class="material-symbols-outlined text-[18px] text-gray-400 dark:text-gray-455">manage_accounts</span>
                                Edit Profile
                            </a>
                            <a href="/user/profile#change-password" class="flex items-center gap-2.5 px-4 py-2 text-sm text-gray-650 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white hover:bg-gray-50 dark:hover:bg-white/5 transition-colors">
                                <span class="material-symbols-outlined text-[18px] text-gray-400 dark:text-gray-455">lock</span>
                                Change Password
                            </a>
                            <a href="/user/system-settings#two-factor" class="flex items-center gap-2.5 px-4 py-2 text-sm text-gray-650 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white hover:bg-gray-50 dark:hover:bg-white/5 transition-colors">
                                <span class="material-symbols-outlined text-[18px] text-gray-400 dark:text-gray-455">verified_user</span>
                                Two-Factor Auth
                            </a>
                            <a href="/user/system-settings#login-activity" class="flex items-center gap-2.5 px-4 py-2 text-sm text-gray-650 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white hover:bg-gray-50 dark:hover:bg-white/5 transition-colors">
                                <span class="material-symbols-outlined text-[18px] text-gray-400 dark:text-gray-455">devices</span>
                                Login Activity / Devices
                            </a>
                        </div>
                    </div>

                    <!-- Logout Button Beside User UI -->
                    <button @click="logoutModal = true" 
                        class="inline-flex items-center justify-center p-2 rounded-xl text-gray-500 hover:text-red-600 dark:text-gray-400 dark:hover:text-red-400 hover:bg-gray-100 dark:hover:bg-white/5 transition-all bg-transparent border-0 shadow-none hover:shadow-none hover:translate-y-0 active:scale-100 shrink-0 ml-1.5 cursor-pointer" 
                        title="Logout">
                        <span class="material-symbols-outlined text-[24px]">logout</span>
                    </button>
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

    <!-- ===== LOGOUT CONFIRMATION MODAL ===== -->
    <div x-show="logoutModal"
        class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-gray-900/60 backdrop-blur-md"
        x-cloak
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0">
        <div class="fixed inset-0" @click="logoutModal = false"></div>
        <div class="bg-white modal-content rounded-[2.5rem] shadow-2xl max-w-md w-full relative overflow-hidden flex flex-col transform transition-all"
            @click.outside="logoutModal = false"
            x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0 scale-95 translate-y-4"
            x-transition:enter-end="opacity-100 scale-100 translate-y-0"
            x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100 scale-100 translate-y-0"
            x-transition:leave-end="opacity-0 scale-95 translate-y-4">
            
            <div class="px-8 pt-10 pb-6 flex flex-col items-center text-center bg-white relative border-b border-gray-50">
                <div class="w-16 h-16 bg-red-50 text-red-600 rounded-3xl flex items-center justify-center mb-5 shadow-sm border border-red-200">
                    <span class="material-symbols-outlined text-[32px] leading-none">logout</span>
                </div>
                <h3 class="text-2xl font-black text-gray-900 tracking-tighter font-[Montserrat]">Sign Out?</h3>
                <p class="text-sm text-gray-400 font-medium mt-2">Are you sure you want to end your current session and log out of Repairmax?</p>
            </div>

            <div class="p-6 bg-gray-50 flex gap-3">
                <button type="button" @click="logoutModal = false" 
                    class="flex-1 py-4 bg-white border border-gray-200 text-gray-700 font-bold rounded-[1.25rem] hover:bg-gray-50 transition-all text-sm">
                    Cancel
                </button>
                <button type="button" @click="triggerLogout()" 
                    class="flex-1 py-4 bg-red-600 text-white font-bold rounded-[1.25rem] hover:bg-red-700 transition-all shadow-lg text-sm">
                    Logout
                </button>
            </div>
        </div>
    </div>

    <!-- Fullscreen Logout Loading Overlay -->
    <div x-show="isLoggingOut"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        class="fixed inset-0 z-[9999] flex flex-col items-center justify-center transition-colors duration-300"
        :class="darkMode ? 'bg-[#020617]' : 'bg-gray-50'"
        x-cloak
        style="display: none;">
        <div class="relative flex items-center justify-center">
            <!-- Subtle outer ring -->
            <div class="absolute h-32 w-32 rounded-full border border-blue-500/10"></div>
            <!-- Spinning loader ring -->
            <div class="animate-spin rounded-full h-32 w-32 border-t-2 border-r-2 border-transparent border-t-blue-500 border-r-blue-500"></div>
            <!-- Centered logo (Blue version) -->
            <img src="{{ asset('img/logo-r-blue.png') }}" class="absolute h-12 w-auto animate-pulse" alt="Logo">
        </div>
        <p class="mt-6 text-sm font-bold tracking-wider uppercase transition-colors duration-300"
           :class="darkMode ? 'text-gray-400' : 'text-gray-500'">
            Logging out...
        </p>
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
    <x-cookie-consent />
</body>

</html>
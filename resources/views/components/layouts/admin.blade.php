<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Admin Dashboard | Repairmax' }}</title>
    <link rel="icon" type="image/png" href="{{ asset('img/repair-square-icon.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('img/repair-square-icon.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.1/cropper.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.1/cropper.min.js"></script>
    <style>
        .no-transition * {
            transition: none !important;
        }
    </style>
</head>

<body class="font-sans antialiased text-gray-800 bg-gray-50 no-transition">
    <div x-data="{ 
            sidebarOpen: false, 
            sidebarCollapsed: localStorage.getItem('sidebar-collapsed') === 'true' 
        }"
        x-init="$watch('sidebarCollapsed', value => localStorage.setItem('sidebar-collapsed', value))"
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
            class="fixed inset-0 bg-gray-900/60 backdrop-blur-md lg:hidden z-30" style="display: none;"></div>

        <aside :class="{ 
                'translate-x-0': sidebarOpen, 
                '-translate-x-full': !sidebarOpen, 
                'lg:-translate-x-full': sidebarCollapsed, 
                'lg:translate-x-0': !sidebarCollapsed 
            }"
            class="fixed left-0 top-0 h-screen w-64 bg-gray-900 border-r border-gray-800 transition-transform duration-300 ease-in-out z-40 flex flex-col shadow-[4px_0_24px_rgba(0,0,0,0.1)] lg:shadow-none">

            <div class="h-20 flex items-center justify-between px-6 bg-gray-900 border-b border-gray-800 shrink-0">
                <a href="/" class="text-2xl font-bold text-white hover:text-gray-300 transition-colors tracking-tight flex items-center">
                    Repairmax
                    <span class="text-[10px] text-blue-500 font-mono ml-2 uppercase border border-blue-500 rounded px-1.5 py-0.5">Admin</span>
                </a>

                <button @click="sidebarOpen = false" class="lg:hidden text-gray-400 hover:text-white focus:outline-none bg-transparent border-0 p-0 shadow-none hover:shadow-none hover:translate-y-0 active:scale-100">
                    <span class="material-symbols-outlined text-[24px]">close</span>
                </button>
            </div>

            <nav id="sidebar-nav" class="flex-1 overflow-y-auto py-6 space-y-2 [-ms-overflow-style:none] [scrollbar-width:none] [&::-webkit-scrollbar]:hidden">
                <div class="mb-6">
                    <h3 class="px-6 py-2 text-xs font-bold text-gray-500 uppercase tracking-wider mb-1">Main</h3>
                    <x-sidebar.link href="/admin/dashboard" icon="dashboard" :active="request()->is('admin/dashboard')">Dashboard</x-sidebar.link>
                    <x-sidebar.link href="/admin/profile" icon="person" :active="request()->is('admin/profile')">Profile</x-sidebar.link>
                </div>

                <div class="mb-6">
                    <h3 class="px-6 py-2 text-xs font-bold text-gray-500 uppercase tracking-wider mb-1">Appointments</h3>
                    <x-sidebar.link href="/admin/appointment" icon="event" :active="request()->is('admin/appointment')">Appointments</x-sidebar.link>
                    <x-sidebar.link href="/admin/appointment-management" icon="calendar_month" :active="request()->is('admin/appointment-management')">Management</x-sidebar.link>
                </div>

                <div class="mb-6">
                    <h3 class="px-6 py-2 text-xs font-bold text-gray-500 uppercase tracking-wider mb-1">Inventory</h3>
                    <x-sidebar.link href="/admin/inventory" icon="inventory_2" :active="request()->is('admin/inventory') || request()->is('admin/inventory-management')">Inventory</x-sidebar.link>
                </div>

                <div class="mb-6">
                    <h3 class="px-6 py-2 text-xs font-bold text-gray-500 uppercase tracking-wider mb-1">Services</h3>
                    <x-sidebar.link href="/admin/services" icon="handyman" :active="request()->is('admin/services')">Services</x-sidebar.link>
                </div>

                <div class="mb-6">
                    <h3 class="px-6 py-2 text-xs font-bold text-gray-500 uppercase tracking-wider mb-1">Users</h3>
                    <x-sidebar.link href="/admin/user-management" icon="group" :active="request()->is('admin/user-management')">User Management</x-sidebar.link>
                </div>

                <div class="mb-6">
                    <h3 class="px-6 py-2 text-xs font-bold text-gray-500 uppercase tracking-wider mb-1">Notifications</h3>
                    <x-sidebar.link href="{{ route('admin.notifications') }}" icon="notifications" :active="request()->routeIs('admin.notifications')">
                        Notifications
                        @livewire('notification-badge', ['type' => 'admin'])
                    </x-sidebar.link>
                </div>

                <div class="mb-6">
                    <h3 class="px-6 py-2 text-xs font-bold text-gray-500 uppercase tracking-wider mb-1">Communications</h3>
                    <x-sidebar.link href="/admin/messages" icon="mail" :active="request()->is('admin/messages')">Messages</x-sidebar.link>
                    <x-sidebar.link href="/admin/messages-support" icon="support_agent" :active="request()->is('admin/messages-support')">Support Tickets</x-sidebar.link>
                </div>

                <div class="mb-6">
                    <h3 class="px-6 py-2 text-xs font-bold text-gray-500 uppercase tracking-wider mb-1">Reporting</h3>
                    <x-sidebar.link href="/admin/reports" icon="description" :active="request()->is('admin/reports')">Reports</x-sidebar.link>
                    <x-sidebar.link href="/admin/reports-analytics" icon="analytics" :active="request()->is('admin/reports-analytics')">Analytics</x-sidebar.link>
                </div>

                <div>
                    <h3 class="px-6 py-2 text-xs font-bold text-gray-500 uppercase tracking-wider mb-1">Settings</h3>
                    <x-sidebar.link href="/admin/settings" icon="settings" :active="request()->is('admin/settings') || request()->is('admin/system-settings')">System Settings</x-sidebar.link>
                </div>
            </nav>

            <div class="shrink-0 p-4 border-t border-gray-800 bg-gray-900">
                @auth
                <div class="flex items-center justify-between mb-4 px-2">
                    <div class="flex items-center gap-3 overflow-hidden">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name ?? 'Admin') }}&background=2563eb&color=ffffff&bold=true"
                            alt="Profile"
                            class="w-10 h-10 rounded-[1.25rem] border border-gray-600 object-cover shadow-sm bg-blue-600 shrink-0">
                        <div class="flex flex-col overflow-hidden">
                            <span class="text-sm font-semibold text-gray-100 leading-tight truncate">
                                {{ auth()->user()->first_name ?? auth()->user()->name ?? 'Admin User' }}
                            </span>
                            <span class="text-xs text-blue-400 capitalize truncate font-mono tracking-tighter">
                                {{ auth()->user()->role ?? 'Administrator' }}
                            </span>
                        </div>
                    </div>


                </div>
                @endauth

                <a href="{{ route('logout') }}" class="flex items-center gap-3 px-3 py-2.5 text-red-400 hover:text-white hover:bg-red-500/20 rounded-[1.25rem] transition-all duration-200 group">
                    <span class="material-symbols-outlined text-[22px]">logout</span>
                    <span class="font-medium text-sm">Logout</span>
                </a>
            </div>

        </aside>

        <header :class="{ 'lg:left-0': sidebarCollapsed, 'lg:left-64': !sidebarCollapsed }"
            class="fixed top-0 right-0 left-0 bg-gray-50/90 backdrop-blur-md z-20 transition-all duration-300 h-20 flex items-center">
            <div class="flex items-center px-4 md:px-8 w-full">

                <button @click="window.innerWidth >= 1024 ? sidebarCollapsed = !sidebarCollapsed : sidebarOpen = !sidebarOpen"
                    class="inline-flex items-center justify-center w-10 h-10 bg-transparent hover:bg-gray-200/50 rounded-[1.25rem] transition-colors text-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-300 shrink-0">
                    <span class="material-symbols-outlined text-[26px]"
                        x-text="(window.innerWidth >= 1024 ? !sidebarCollapsed : sidebarOpen) ? 'menu_open' : 'menu'">
                    </span>
                </button>

                <div class="ml-4 font-medium text-gray-600 truncate hidden sm:block">
                    {{ $title ?? '' }}
                </div>

            </div>
        </header>

        <main :class="{ 'lg:ml-0': sidebarCollapsed, 'lg:ml-64': !sidebarCollapsed }"
            class="pt-20 transition-all duration-300 flex-1 flex flex-col">

            <div class="w-full px-4 sm:px-6 lg:px-8 py-8 flex-1">
                {{ $slot }}
            </div>

        </main>
    </div>

    @livewireScripts
    <script>
        // Disable transitions on page load
        window.addEventListener('load', () => {
            setTimeout(() => {
                document.body.classList.remove('no-transition');
            }, 100);
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
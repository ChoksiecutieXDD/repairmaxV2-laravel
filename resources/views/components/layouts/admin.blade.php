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
            class="fixed left-0 top-0 h-screen w-64 bg-gray-900 border-r border-gray-800 transition-transform duration-300 ease-in-out z-40 flex flex-col shadow-[4px_0_24px_rgba(0,0,0,0.1)] lg:shadow-none"
            x-data="{
                notificationsOpen: false,
                notifications: [],
                unreadCount: 0,
                async loadNotifications() {
                    try {
                        const response = await fetch('/admin/api/notifications');
                        const data = await response.json();
                        this.notifications = data.notifications.slice(0, 5);
                        this.unreadCount = data.unreadCount;
                    } catch (error) {
                        console.error('Failed to load notifications:', error);
                    }
                }
            }"
            @load="loadNotifications()"
            @notify.window="unreadCount = $event.detail.count; loadNotifications()">

            <div class="h-20 flex items-center justify-between px-6 bg-gray-900 border-b border-gray-800 shrink-0">
                <a href="/" class="text-2xl font-bold text-white hover:text-gray-300 transition-colors tracking-tight flex items-center">
                    Repairmax
                    <span class="text-[10px] text-blue-500 font-mono ml-2 uppercase border border-blue-500 rounded px-1.5 py-0.5">Admin</span>
                </a>

                <button @click="sidebarOpen = false" class="lg:hidden text-gray-400 hover:text-white focus:outline-none">
                    <span class="material-symbols-outlined text-[24px]">close</span>
                </button>
            </div>

            <nav id="sidebar-nav" class="flex-1 overflow-y-auto py-6 space-y-2 [-ms-overflow-style:none] [scrollbar-width:none] [&::-webkit-scrollbar]:hidden">
                <div class="mb-6">
                    <h3 class="px-6 py-2 text-xs font-bold text-gray-500 uppercase tracking-wider mb-1">Main</h3>
                    <x-sidebar.link href="/admin/dashboard" icon="dashboard" :active="request()->is('admin/dashboard')">Dashboard</x-sidebar.link>
                    <x-sidebar.link href="{{ route('admin.overview') }}" icon="dashboard" :active="request()->routeIs('admin.overview')">Overview</x-sidebar.link>
                    <x-sidebar.link href="/admin/profile" icon="person" :active="request()->is('admin/profile')">Profile</x-sidebar.link>
                </div>

                <div class="mb-6">
                    <h3 class="px-6 py-2 text-xs font-bold text-gray-500 uppercase tracking-wider mb-1">Appointments</h3>
                    <x-sidebar.link href="/admin/appointment" icon="event" :active="request()->is('admin/appointment')">Appointments</x-sidebar.link>
                    <x-sidebar.link href="/admin/appointment-management" icon="calendar_month" :active="request()->is('admin/appointment-management')">Management</x-sidebar.link>
                </div>

                <div class="mb-6">
                    <h3 class="px-6 py-2 text-xs font-bold text-gray-500 uppercase tracking-wider mb-1">Inventory</h3>
                    <x-sidebar.link href="/admin/inventory" icon="inventory_2" :active="request()->is('admin/inventory')">Inventory</x-sidebar.link>
                    <x-sidebar.link href="/admin/inventory-management" icon="settings_applications" :active="request()->is('admin/inventory-management')">Management</x-sidebar.link>
                </div>

                <div class="mb-6">
                    <h3 class="px-6 py-2 text-xs font-bold text-gray-500 uppercase tracking-wider mb-1">Users</h3>
                    <x-sidebar.link href="/admin/user-management" icon="group" :active="request()->is('admin/user-management')">User Management</x-sidebar.link>
                </div>

                <div class="mb-6">
                    <h3 class="px-6 py-2 text-xs font-bold text-gray-500 uppercase tracking-wider mb-1">Notifications</h3>
                    <x-sidebar.link href="{{ route('admin.notifications') }}" icon="notifications" :active="request()->routeIs('admin.notifications')">Notifications</x-sidebar.link>
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
                    <h3 class="px-6 py-2 text-xs font-bold text-gray-500 uppercase tracking-wider mb-1">System</h3>
                    <x-sidebar.link href="/admin/settings" icon="tune" :active="request()->is('admin/settings')">Settings</x-sidebar.link>
                    <x-sidebar.link href="/admin/system-settings" icon="settings" :active="request()->is('admin/system-settings')">System</x-sidebar.link>
                </div>
            </nav>

            <div class="shrink-0 p-4 border-t border-gray-800 bg-gray-900">
                @auth
                <div class="flex items-center justify-between mb-4 px-2">
                    <div class="flex items-center gap-3 overflow-hidden">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name ?? 'Admin') }}&background=2563eb&color=ffffff&bold=true"
                            alt="Profile"
                            class="w-10 h-10 rounded-full border border-gray-600 object-cover shadow-sm bg-blue-600 shrink-0">
                        <div class="flex flex-col overflow-hidden">
                            <span class="text-sm font-semibold text-gray-100 leading-tight truncate">
                                {{ auth()->user()->first_name ?? auth()->user()->name ?? 'Admin User' }}
                            </span>
                            <span class="text-xs text-blue-400 capitalize truncate font-mono tracking-tighter">
                                {{ auth()->user()->role ?? 'Administrator' }}
                            </span>
                        </div>
                    </div>

                    <div class="relative" x-data="{ notifDropdown: false }">
                        <button @click="notifDropdown = !notifDropdown" class="relative p-1.5 hover:bg-gray-800 rounded-full transition-colors text-gray-400 hover:text-white focus:outline-none shrink-0" aria-label="Notifications" title="View notifications">
                            <span class="material-symbols-outlined text-[24px]">notifications</span>
                            <template x-if="unreadCount > 0">
                                <span class="absolute top-1.5 right-1.5 w-2 h-2 bg-red-500 rounded-full animate-pulse"></span>
                            </template>
                        </button>

                        <!-- Notification Dropdown -->
                        <div x-show="notifDropdown" @click.outside="notifDropdown = false"
                            class="absolute right-0 bottom-full mb-2 w-80 bg-white border border-gray-200 rounded-lg shadow-xl z-50 overflow-hidden"
                            x-cloak>
                            <div class="px-4 py-3 border-b border-gray-100 bg-gray-50 flex items-center justify-between">
                                <h3 class="font-bold text-gray-900">Notifications <span class="text-xs text-gray-500" x-show="unreadCount > 0" x-text="'(' + unreadCount + ' new)'"></span></h3>
                                <a href="/admin/notifications" class="text-xs text-blue-600 hover:text-blue-700 font-medium">View All</a>
                            </div>
                            <div class="max-h-96 overflow-y-auto divide-y divide-gray-100">
                                <template x-if="notifications.length > 0">
                                    <template x-for="notification in notifications" :key="notification.id">
                                        <div class="px-4 py-3 hover:bg-gray-50 transition-colors cursor-pointer" @click="window.location.href = '/admin/notifications'">
                                            <div class="flex gap-2">
                                                <div class="w-8 h-8 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center flex-shrink-0 text-sm">
                                                    <span class="material-symbols-outlined text-[16px]" x-text="notification.icon">notifications</span>
                                                </div>
                                                <div class="flex-1 min-w-0">
                                                    <p class="text-sm font-medium text-gray-900 truncate" x-text="notification.title"></p>
                                                    <p class="text-xs text-gray-500 truncate" x-text="notification.message"></p>
                                                    <p class="text-xs text-gray-400 mt-1" x-text="notification.time"></p>
                                                </div>
                                            </div>
                                        </div>
                                    </template>
                                </template>
                                <template x-if="notifications.length === 0">
                                    <div class="px-4 py-8 text-center text-gray-500">
                                        <span class="material-symbols-outlined text-4xl text-gray-300">notifications_off</span>
                                        <p class="text-sm mt-2">No new notifications</p>
                                    </div>
                                </template>
                            </div>
                            <div class="px-4 py-3 border-t border-gray-100 bg-gray-50">
                                <a href="/admin/notifications" class="block text-center text-sm text-blue-600 hover:text-blue-700 font-medium py-2">Go to Notifications</a>
                            </div>
                        </div>
                    </div>
                </div>
                @endauth

                <a href="{{ route('logout') }}" class="flex items-center gap-3 px-3 py-2.5 text-red-400 hover:text-white hover:bg-red-500/20 rounded-lg transition-all duration-200 group">
                    <span class="material-symbols-outlined text-[22px]">logout</span>
                    <span class="font-medium text-sm">Logout</span>
                </a>
            </div>

        </aside>

        <header :class="{ 'lg:left-0': sidebarCollapsed, 'lg:left-64': !sidebarCollapsed }"
            class="fixed top-0 right-0 left-0 bg-gray-50/90 backdrop-blur-md z-20 transition-all duration-300 h-20 flex items-center">
            <div class="flex items-center px-4 md:px-8 w-full">

                <button @click="window.innerWidth >= 1024 ? sidebarCollapsed = !sidebarCollapsed : sidebarOpen = !sidebarOpen"
                    class="inline-flex items-center justify-center w-10 h-10 bg-transparent hover:bg-gray-200/50 rounded-lg transition-colors text-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-300 shrink-0">
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
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Admin Dashboard | Repairmax' }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @livewireStyles
</head>

<body class="font-sans antialiased text-gray-800 bg-gray-50">
    <div x-data="{ sidebarOpen: false, sidebarCollapsed: false }"
        @resize.window="if(window.innerWidth >= 1024) sidebarOpen = false"
        class="min-h-screen">

        <div x-show="sidebarOpen"
            x-transition.opacity.duration.300ms
            @click="sidebarOpen = false"
            class="fixed inset-0 bg-gray-900/60 backdrop-blur-sm lg:hidden z-30" style="display: none;"></div>

        <aside :class="{ 
                'translate-x-0': sidebarOpen, 
                '-translate-x-full': !sidebarOpen, 
                'lg:-translate-x-full': sidebarCollapsed, 
                'lg:translate-x-0': !sidebarCollapsed 
            }"
            class="fixed left-0 top-0 h-screen w-64 bg-gray-900 border-r border-gray-800 transition-transform duration-300 ease-in-out z-40 flex flex-col">

            <div class="h-20 flex items-center px-6 bg-gray-900 border-b border-gray-800 shrink-0">
                <a href="/" class="text-2xl font-bold text-white hover:text-gray-300 transition-colors tracking-tight flex items-center">
                    Repairmax
                    <span class="text-[10px] text-blue-500 font-mono ml-2 uppercase border border-blue-500 rounded px-1.5 py-0.5">Admin</span>
                </a>
            </div>

            <nav class="flex-1 overflow-y-auto py-6 space-y-2 [-ms-overflow-style:none] [scrollbar-width:none] [&::-webkit-scrollbar]:hidden">
                <div class="mb-6">
                    <h3 class="px-6 py-2 text-xs font-bold text-gray-500 uppercase tracking-wider mb-1">Main</h3>
                    <x-sidebar.link href="/admin/dashboard" icon="dashboard" :active="request()->is('admin/dashboard')">Dashboard</x-sidebar.link>
                    <x-sidebar.link href="/admin/dashboard-overview" icon="overview" :active="request()->is('admin/dashboard-overview')">Overview</x-sidebar.link>
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

                    <a href="/logout" class="flex items-center gap-3 mx-3 mt-4 px-3 py-2.5 text-red-400 hover:text-white hover:bg-red-500/20 rounded-lg transition-all duration-200 group">
                        <span class="material-symbols-outlined text-[22px] group-hover:scale-110 transition-transform">logout</span>
                        <span class="font-medium text-sm">Logout</span>
                    </a>
                </div>
            </nav>
        </aside>

        <header :class="{ 'lg:left-0': sidebarCollapsed, 'lg:left-64': !sidebarCollapsed }"
            class="fixed top-0 right-0 left-0 bg-white/80 backdrop-blur-md border-b border-gray-200 z-20 transition-all duration-300 h-20">
            <div class="flex items-center justify-between px-4 md:px-8 h-full">

                <button @click="window.innerWidth >= 1024 ? sidebarCollapsed = !sidebarCollapsed : sidebarOpen = !sidebarOpen"
                    class="inline-flex items-center justify-center w-10 h-10 hover:bg-gray-100 rounded-lg transition-colors text-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-200">
                    <span class="material-symbols-outlined text-[26px]">menu</span>
                </button>

                <div class="flex items-center gap-3 md:gap-5 ml-auto">
                    <button class="relative p-2 hover:bg-gray-100 rounded-full transition-colors text-gray-600 focus:outline-none" aria-label="Notifications">
                        <span class="material-symbols-outlined text-[26px]">notifications</span>
                        <span class="absolute top-1.5 right-1.5 w-2.5 h-2.5 bg-red-500 border-2 border-white rounded-full"></span>
                    </button>

                    <div class="flex items-center gap-3 pl-3 md:pl-5 border-l border-gray-200 cursor-pointer hover:opacity-80 transition-opacity">
                        <div class="hidden md:block text-right">
                            <p class="text-sm font-semibold text-gray-900 leading-tight">Admin User</p>
                            <p class="text-xs text-gray-500">Administrator</p>
                        </div>
                        <img src="https://ui-avatars.com/api/?name=Admin+User&background=2563eb&color=ffffff&bold=true" alt="Admin" class="w-10 h-10 rounded-full border border-gray-200 object-cover shadow-sm bg-blue-600">
                    </div>
                </div>
            </div>
        </header>

        <main :class="{ 'lg:ml-0': sidebarCollapsed, 'lg:ml-64': !sidebarCollapsed }"
            class="pt-20 transition-all duration-300 min-h-screen">
            <div class="p-6 md:p-8 animate-fade-in">
                {{ $slot }}
            </div>
        </main>
    </div>

    @livewireScripts
</body>

</html>
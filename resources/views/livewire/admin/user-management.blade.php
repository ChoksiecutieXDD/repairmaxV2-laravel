<x-layouts.admin title="User Management | Repairmax Admin">

    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">User Management</h1>
            <p class="text-gray-600 mt-1">Manage customers, technicians, and system admins.</p>
        </div>

        <button class="bg-gray-900 text-white px-4 py-2 rounded-xl text-sm font-medium hover:bg-gray-800 transition-colors flex items-center gap-2">
            <span class="material-symbols-outlined text-[20px]">add</span>
            Add New User
        </button>
    </div>

    <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="p-6 border-b border-gray-100">
            <input type="text" placeholder="Search users..." class="w-full max-w-md px-4 py-2 bg-gray-50 border border-gray-200 rounded-lg outline-none focus:ring-2 focus:ring-blue-500 transition-all">
        </div>

        <div class="p-6 text-center text-gray-500">
            User table goes here...
        </div>
    </div>

</x-layouts.admin>
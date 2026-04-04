<div class="w-full">
    <!-- Header with Create Buttons -->
    <div class="mb-8 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="text-3xl font-bold text-gray-900 tracking-tight">User Management</h1>
            <p class="text-gray-500 mt-1">Manage all registered users and their access levels.</p>
        </div>
        <div class="flex gap-3">
            <button type="button" wire:click="openCreateUserModal" class="inline-flex items-center gap-2 bg-blue-600 text-white hover:bg-blue-700 px-4 py-2 rounded-lg font-bold shadow-md transition-colors">
                <span class="material-symbols-outlined text-[20px]">person_add</span>
                Create User
            </button>
            <button type="button" wire:click="openCreateAdminModal" class="inline-flex items-center gap-2 bg-green-600 text-white hover:bg-green-700 px-4 py-2 rounded-lg font-bold shadow-md transition-colors">
                <span class="material-symbols-outlined text-[20px]">add</span>
                Create Admin
            </button>
        </div>
    </div>

    <!-- Success Message (Top of page) -->
    @if($successMessage)
        <div class="mb-6 bg-green-50 border border-green-300 rounded-lg p-4 flex justify-between items-center animate-pulse">
            <div class="flex items-center gap-3">
                <span class="material-symbols-outlined text-green-600 text-[28px]">check_circle</span>
                <p class="text-green-800 font-bold text-lg">{{ $successMessage }}</p>
            </div>
            <button wire:click="$set('successMessage', '')" type="button" class="text-green-600 hover:text-green-800 font-bold">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>
    @endif

    <!-- Error Message (Top of page) -->
    @if($errorMessage)
        <div class="mb-6 bg-red-50 border border-red-300 rounded-lg p-4 flex justify-between items-center">
            <div class="flex items-center gap-3">
                <span class="material-symbols-outlined text-red-600 text-[28px]">error</span>
                <p class="text-red-800 font-bold text-lg">{{ $errorMessage }}</p>
            </div>
            <button wire:click="$set('errorMessage', '')" type="button" class="text-red-600 hover:text-red-800 font-bold">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>
    @endif

    <!-- Create Admin Modal -->
    <div>
        @if($showCreateAdminModal)
            <div class="fixed inset-0 bg-gray-900 bg-opacity-75 transition-opacity backdrop-blur-sm flex items-center justify-center z-50 p-4">
                <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full">
                    <!-- Modal Header -->
                    <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                        <h2 class="text-2xl font-bold text-gray-900">Create New Admin</h2>
                        <button type="button" wire:click="closeCreateAdminModal" class="text-gray-500 hover:text-gray-700 text-2xl font-bold">
                            ✕
                        </button>
                    </div>

                    <!-- Modal Body -->
                    <form wire:submit.prevent="createAdmin" class="p-6 space-y-5">
                        <!-- Email -->
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Email *</label>
                            <input 
                                type="email" 
                                wire:model="adminEmail" 
                                placeholder="admin@example.com" 
                                class="w-full px-4 py-2 border-2 border-gray-300 rounded-lg focus:border-blue-500 focus:outline-none transition-colors"
                            />
                        </div>

                        <!-- First Name & Last Name -->
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">First Name *</label>
                                <input 
                                    type="text" 
                                    wire:model="adminFirstName" 
                                    placeholder="John" 
                                    class="w-full px-4 py-2 border-2 border-gray-300 rounded-lg focus:border-blue-500 focus:outline-none transition-colors"
                                />
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">Last Name *</label>
                                <input 
                                    type="text" 
                                    wire:model="adminLastName" 
                                    placeholder="Doe" 
                                    class="w-full px-4 py-2 border-2 border-gray-300 rounded-lg focus:border-blue-500 focus:outline-none transition-colors"
                                />
                            </div>
                        </div>

                        <!-- Phone -->
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Phone</label>
                            <input 
                                type="tel" 
                                wire:model="adminPhone" 
                                placeholder="+1 (555) 000-0000" 
                                class="w-full px-4 py-2 border-2 border-gray-300 rounded-lg focus:border-blue-500 focus:outline-none transition-colors"
                            />
                        </div>

                        <!-- Department -->
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Department</label>
                            <input 
                                type="text" 
                                wire:model="adminDepartment" 
                                placeholder="e.g. Support" 
                                class="w-full px-4 py-2 border-2 border-gray-300 rounded-lg focus:border-blue-500 focus:outline-none transition-colors"
                            />
                        </div>

                        <!-- Admin Level -->
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Admin Level *</label>
                            <select 
                                wire:model="adminLevel" 
                                class="w-full px-4 py-2 border-2 border-gray-300 rounded-lg focus:border-blue-500 focus:outline-none transition-colors"
                            >
                                <option value="moderator">Moderator</option>
                                <option value="admin">Admin</option>
                                <option value="super_admin">Super Admin</option>
                            </select>
                        </div>

                        <!-- Password -->
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Password *</label>
                            <input 
                                type="password" 
                                wire:model="adminPassword" 
                                placeholder="Min 8 characters" 
                                class="w-full px-4 py-2 border-2 border-gray-300 rounded-lg focus:border-blue-500 focus:outline-none transition-colors"
                            />
                        </div>

                        <!-- Form Actions -->
                        <div class="flex gap-3 pt-6 border-t border-gray-200">
                            <button 
                                type="button" 
                                wire:click="closeCreateAdminModal" 
                                class="flex-1 px-4 py-3 border-2 border-gray-300 rounded-lg font-bold text-gray-700 hover:bg-gray-50 transition-colors"
                            >
                                Cancel
                            </button>
                            <button 
                                type="submit" 
                                class="flex-1 px-4 py-3 bg-green-600 text-white rounded-lg font-bold hover:bg-green-700 transition-colors flex items-center justify-center gap-2"
                            >
                                <span class="material-symbols-outlined text-[20px]">check</span>
                                Create Admin
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        @endif

        <!-- Create User Modal -->
        @if($showCreateUserModal)
            <div class="fixed inset-0 bg-gray-900 bg-opacity-75 transition-opacity backdrop-blur-sm flex items-center justify-center z-50 p-4">
                <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full">
                    <!-- Modal Header -->
                    <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                        <h2 class="text-2xl font-bold text-gray-900">Create New User</h2>
                        <button type="button" wire:click="closeCreateUserModal" class="text-gray-500 hover:text-gray-700 text-2xl font-bold">
                            ✕
                        </button>
                    </div>

                    <!-- Modal Body -->
                    <form wire:submit.prevent="createUser" class="p-6 space-y-5">
                        <!-- Email -->
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Email *</label>
                            <input 
                                type="email" 
                                wire:model="userEmail" 
                                placeholder="user@example.com" 
                                class="w-full px-4 py-2 border-2 border-gray-300 rounded-lg focus:border-blue-500 focus:outline-none transition-colors"
                            />
                        </div>

                        <!-- First Name & Last Name -->
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">First Name *</label>
                                <input 
                                    type="text" 
                                    wire:model="userFirstName" 
                                    placeholder="John" 
                                    class="w-full px-4 py-2 border-2 border-gray-300 rounded-lg focus:border-blue-500 focus:outline-none transition-colors"
                                />
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">Last Name *</label>
                                <input 
                                    type="text" 
                                    wire:model="userLastName" 
                                    placeholder="Doe" 
                                    class="w-full px-4 py-2 border-2 border-gray-300 rounded-lg focus:border-blue-500 focus:outline-none transition-colors"
                                />
                            </div>
                        </div>

                        <!-- Phone -->
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Phone</label>
                            <input 
                                type="tel" 
                                wire:model="userPhone" 
                                placeholder="+1 (555) 000-0000" 
                                class="w-full px-4 py-2 border-2 border-gray-300 rounded-lg focus:border-blue-500 focus:outline-none transition-colors"
                            />
                        </div>

                        <!-- Password -->
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Password *</label>
                            <input 
                                type="password" 
                                wire:model="userPassword" 
                                placeholder="Min 8 characters" 
                                class="w-full px-4 py-2 border-2 border-gray-300 rounded-lg focus:border-blue-500 focus:outline-none transition-colors"
                            />
                        </div>

                        <!-- Form Actions -->
                        <div class="flex gap-3 pt-6 border-t border-gray-200">
                            <button 
                                type="button" 
                                wire:click="closeCreateUserModal" 
                                class="flex-1 px-4 py-3 border-2 border-gray-300 rounded-lg font-bold text-gray-700 hover:bg-gray-50 transition-colors"
                            >
                                Cancel
                            </button>
                            <button 
                                type="submit" 
                                class="flex-1 px-4 py-3 bg-blue-600 text-white rounded-lg font-bold hover:bg-blue-700 transition-colors flex items-center justify-center gap-2"
                            >
                                <span class="material-symbols-outlined text-[20px]">check</span>
                                Create User
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        @endif
    </div>

    <!-- Users Table -->
    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
        <div class="px-6 py-5 border-b border-gray-100">
            <div class="flex flex-col sm:flex-row gap-4 items-start sm:items-center justify-between">
                <h2 class="text-lg font-bold text-gray-900">Active Users ({{ count($users) }})</h2>
                <div class="flex flex-col sm:flex-row w-full sm:w-auto gap-2">
                    <input 
                        type="text" 
                        wire:model.live="search" 
                        placeholder="Search users..." 
                        class="flex-1 px-4 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                    />
                    <select 
                        wire:model.live="filterRole" 
                        class="px-4 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500"
                    >
                        <option value="all">All Roles</option>
                        <option value="admin">Admin</option>
                        <option value="user">User</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-gray-100 bg-gray-50">
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">User</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Phone</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Role</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($users as $user)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <img 
                                        src="https://ui-avatars.com/api/?name={{ urlencode($user->first_name . ' ' . $user->last_name) }}&background=2563eb&color=fff" 
                                        alt="{{ $user->first_name }}"
                                        class="w-8 h-8 rounded-full" 
                                    />
                                    <span class="font-medium text-gray-900">{{ $user->first_name }} {{ $user->last_name }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4"><span class="text-gray-600">{{ $user->email }}</span></td>
                            <td class="px-6 py-4"><span class="text-gray-600">{{ $user->phone ?? 'N/A' }}</span></td>
                            <td class="px-6 py-4">
                                <span class="inline-flex px-2.5 py-1 {{ $user->role === 'admin' ? 'bg-red-50 text-red-700' : 'bg-blue-50 text-blue-700' }} rounded text-xs font-bold">
                                    {{ ucfirst($user->role) }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                @if($user->is_active)
                                    <span class="inline-flex items-center gap-1 text-sm font-medium text-green-600">
                                        <span class="w-2 h-2 rounded-full bg-green-500"></span>Active
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 text-sm font-medium text-red-600">
                                        <span class="w-2 h-2 rounded-full bg-red-500"></span>Inactive
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-sm">
                                <div class="flex gap-2">
                                    @if($user->is_active)
                                        <button wire:click="blockUser({{ $user->id }})" class="text-red-600 hover:text-red-800 font-bold">Block</button>
                                    @else
                                        <button wire:click="unblockUser({{ $user->id }})" class="text-green-600 hover:text-green-800 font-bold">Unblock</button>
                                    @endif
                                    <button 
                                        wire:click="deleteUser({{ $user->id }})" 
                                        wire:confirm="Are you absolutely sure you want to delete {{ $user->first_name }} {{ $user->last_name }}? This cannot be undone."
                                        class="text-red-700 hover:text-red-900 font-bold hover:underline"
                                    >
                                        Delete
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-8 text-center text-gray-500">
                                <span class="material-symbols-outlined text-5xl text-gray-300 block mb-2">person_off</span>
                                No users found
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($users->hasPages())
            <div class="px-6 py-4 border-t border-gray-100 bg-gray-50">
                {{ $users->links() }}
            </div>
        @endif
    </div>
</div>
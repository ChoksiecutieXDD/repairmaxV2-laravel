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
        <div class="mb-6 bg-green-50 border border-green-300 rounded-xl p-4 flex justify-between items-center animate-in fade-in duration-500">
            <div class="flex items-center gap-3">
                <span class="material-symbols-outlined text-green-600 text-[28px]">check_circle</span>
                <p class="text-green-800 font-bold text-lg">{{ $successMessage }}</p>
            </div>
            <button wire:click="$set('successMessage', '')" type="button" class="bg-transparent text-green-600 hover:text-green-800 font-bold p-2 rounded-full hover:bg-green-100 transition-all border-none shadow-none">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>
    @endif

    <!-- Error Message (Top of page) -->
    @if($errorMessage)
        <div class="mb-6 bg-red-50 border border-red-300 rounded-xl p-4 flex justify-between items-center animate-in fade-in duration-500">
            <div class="flex items-center gap-3">
                <span class="material-symbols-outlined text-red-600 text-[28px]">error</span>
                <p class="text-red-800 font-bold text-lg">{{ $errorMessage }}</p>
            </div>
            <button wire:click="$set('errorMessage', '')" type="button" class="bg-transparent text-red-600 hover:text-red-800 font-bold p-2 rounded-full hover:bg-red-100 transition-all border-none shadow-none">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>
    @endif

    <!-- Modals Section -->
    <div x-data="{ 
        showAdmin: @entangle('showCreateAdminModal'),
        showUser: @entangle('showCreateUserModal'),
        showDelete: @entangle('showDeleteConfirmationModal')
    }">
        <!-- Create Admin Modal -->
        <div x-show="showAdmin" 
            class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-gray-900/60 backdrop-blur-sm"
            x-cloak
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0">
            
            <div class="bg-white rounded-[1.25rem] shadow-2xl max-w-md w-full overflow-hidden transform transition-all"
                @click.outside="showAdmin = false"
                x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0 scale-95 translate-y-4"
                x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                x-transition:leave-end="opacity-0 scale-95 translate-y-4">
                
                <div class="px-8 py-6 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-green-50 rounded-xl flex items-center justify-center">
                            <span class="material-symbols-outlined text-green-600">person_add</span>
                        </div>
                        <h2 class="text-xl font-bold text-gray-900 tracking-tight">Create Admin</h2>
                    </div>
                    <button type="button" @click="showAdmin = false" class="bg-transparent text-gray-400 hover:text-gray-600 transition-colors border-none shadow-none p-1">
                        <span class="material-symbols-outlined">close</span>
                    </button>
                </div>

                <form wire:submit.prevent="createAdmin" class="p-8 space-y-5">
                    <div class="space-y-4">
                        <div>
                            <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1.5 ml-1">Email Address</label>
                            <input type="email" wire:model="adminEmail" placeholder="admin@repairmax.com" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:border-green-500 focus:ring-0 transition-all font-medium text-sm">
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1.5 ml-1">First Name</label>
                                <input type="text" wire:model="adminFirstName" placeholder="John" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:border-green-500 focus:ring-0 transition-all font-medium text-sm">
                            </div>
                            <div>
                                <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1.5 ml-1">Last Name</label>
                                <input type="text" wire:model="adminLastName" placeholder="Doe" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:border-green-500 focus:ring-0 transition-all font-medium text-sm">
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1.5 ml-1">Phone</label>
                                <input type="tel" wire:model="adminPhone" placeholder="09XX" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:border-green-500 focus:ring-0 transition-all font-medium text-sm">
                            </div>
                            <div>
                                <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1.5 ml-1">Admin Level</label>
                                <select wire:model="adminLevel" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:border-green-500 focus:ring-0 transition-all font-medium text-sm">
                                    <option value="moderator">Moderator</option>
                                    <option value="admin">Admin</option>
                                    <option value="super_admin">Super Admin</option>
                                </select>
                            </div>
                        </div>

                        <div>
                            <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1.5 ml-1">Password</label>
                            <input type="password" wire:model="adminPassword" placeholder="••••••••" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:border-green-500 focus:ring-0 transition-all font-medium text-sm">
                        </div>
                    </div>

                    <div class="flex gap-3 pt-4">
                        <button type="button" @click="showAdmin = false" class="flex-1 px-4 py-3 bg-gray-100 text-gray-600 rounded-xl font-bold hover:bg-gray-200 transition-all">Cancel</button>
                        <button type="submit" class="flex-1 px-4 py-3 bg-green-600 text-white rounded-xl font-bold hover:bg-green-700 shadow-lg shadow-green-200 transition-all flex items-center justify-center gap-2">
                            <span class="material-symbols-outlined text-sm">check</span>
                            Create Admin
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Create User Modal -->
        <div x-show="showUser" 
            class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-gray-900/60 backdrop-blur-sm"
            x-cloak
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0">
            
            <div class="bg-white rounded-[1.25rem] shadow-2xl max-w-md w-full overflow-hidden transform transition-all"
                @click.outside="showUser = false"
                x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0 scale-95 translate-y-4"
                x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                x-transition:leave-end="opacity-0 scale-95 translate-y-4">
                
                <div class="px-8 py-6 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-blue-50 rounded-xl flex items-center justify-center">
                            <span class="material-symbols-outlined text-blue-600">person_add</span>
                        </div>
                        <h2 class="text-xl font-bold text-gray-900 tracking-tight">Create New User</h2>
                    </div>
                    <button type="button" @click="showUser = false" class="bg-transparent text-gray-400 hover:text-gray-600 transition-colors border-none shadow-none p-1">
                        <span class="material-symbols-outlined">close</span>
                    </button>
                </div>

                <form wire:submit.prevent="createUser" class="p-8 space-y-5">
                    <div class="space-y-4">
                        <div>
                            <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1.5 ml-1">Email Address</label>
                            <input type="email" wire:model="userEmail" placeholder="user@example.com" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:border-blue-500 focus:ring-0 transition-all font-medium text-sm">
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1.5 ml-1">First Name</label>
                                <input type="text" wire:model="userFirstName" placeholder="John" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:border-blue-500 focus:ring-0 transition-all font-medium text-sm">
                            </div>
                            <div>
                                <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1.5 ml-1">Last Name</label>
                                <input type="text" wire:model="userLastName" placeholder="Doe" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:border-blue-500 focus:ring-0 transition-all font-medium text-sm">
                            </div>
                        </div>

                        <div>
                            <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1.5 ml-1">Phone Number</label>
                            <input type="tel" wire:model="userPhone" placeholder="09XX" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:border-blue-500 focus:ring-0 transition-all font-medium text-sm">
                        </div>

                        <div>
                            <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1.5 ml-1">Account Password</label>
                            <input type="password" wire:model="userPassword" placeholder="••••••••" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:border-blue-500 focus:ring-0 transition-all font-medium text-sm">
                        </div>
                    </div>

                    <div class="flex gap-3 pt-4">
                        <button type="button" @click="showUser = false" class="flex-1 px-4 py-3 bg-gray-100 text-gray-600 rounded-xl font-bold hover:bg-gray-200 transition-all">Cancel</button>
                        <button type="submit" class="flex-1 px-4 py-3 bg-blue-600 text-white rounded-xl font-bold hover:bg-blue-700 shadow-lg shadow-blue-200 transition-all flex items-center justify-center gap-2">
                            <span class="material-symbols-outlined text-sm">check</span>
                            Create User
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Delete Confirmation Modal -->
        <div x-show="showDelete" 
            class="fixed inset-0 z-[110] flex items-center justify-center p-4 bg-gray-900/60 backdrop-blur-sm"
            x-cloak
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0">
            
            <div class="bg-white rounded-[1.25rem] shadow-2xl max-w-sm w-full overflow-hidden transform transition-all"
                @click.outside="showDelete = false"
                x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0 scale-95 translate-y-4"
                x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                x-transition:leave-end="opacity-0 scale-95 translate-y-4">
                
                <div class="p-8 text-center">
                    <div class="w-20 h-20 bg-red-50 rounded-full flex items-center justify-center mx-auto mb-6">
                        <span class="material-symbols-outlined text-red-600 text-4xl">delete_forever</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2 tracking-tight">Confirm Deletion</h3>
                    <p class="text-gray-500 text-sm leading-relaxed mb-8">
                        Are you sure you want to delete <span class="font-bold text-gray-900">{{ $userToDeleteName }}</span>? This action cannot be undone and all associated data will be removed.
                    </p>
                    <div class="flex flex-col gap-3">
                        <button wire:click="deleteUser" class="w-full py-4 bg-red-600 text-white rounded-xl font-bold hover:bg-red-700 shadow-lg shadow-red-200 transition-all">
                            Yes, Delete Account
                        </button>
                        <button @click="showDelete = false" class="w-full py-4 bg-gray-100 text-gray-600 rounded-xl font-bold hover:bg-gray-200 transition-all">
                            No, Keep User
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Users Table -->
    <div class="bg-white rounded-[1.25rem] border border-gray-200 shadow-sm overflow-hidden">
        <div class="px-8 pt-6 pb-4 border-b border-gray-100">
            <div class="flex flex-col lg:flex-row gap-6 items-start lg:items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-gray-900 rounded-xl flex items-center justify-center">
                        <span class="material-symbols-outlined text-white">group</span>
                    </div>
                    <div class="flex flex-col gap-1.5">
                        <h2 class="text-lg font-bold text-gray-900 leading-none m-0 p-0">Registered Accounts</h2>
                        <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest leading-none m-0 p-0">Total: {{ count($users) }} Users</p>
                    </div>
                </div>
                
                <div class="flex flex-col sm:flex-row w-full lg:w-auto gap-3">
                    <div class="relative flex-1 sm:min-w-[300px]">
                        <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-xl">search</span>
                        <input type="text" wire:model.live="search" placeholder="Search by name or email..." class="w-full pl-11 pr-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:bg-white focus:border-blue-500 focus:ring-0 transition-all">
                    </div>
                    <select wire:model.live="filterRole" class="px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm font-bold text-gray-700 focus:bg-white transition-all min-w-[140px]">
                        <option value="all">All Roles</option>
                        <option value="admin">Admins Only</option>
                        <option value="user">Standard Users</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-gray-50/50 text-gray-500 text-[10px] uppercase font-black tracking-[0.15em] border-b border-gray-100">
                        <th class="px-8 py-3">User Identity</th>
                        <th class="px-8 py-4">Contact Detail</th>
                        <th class="px-8 py-4">Role Access</th>
                        <th class="px-8 py-4">System Status</th>
                        <th class="px-8 py-4 text-right">Administrative Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($users as $user)
                        <tr class="hover:bg-gray-50/80 transition-colors group">
                            <td class="px-8 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="relative">
                                        <img src="https://ui-avatars.com/api/?name={{ urlencode($user->first_name . ' ' . $user->last_name) }}&background={{ $user->role === 'admin' ? 'ef4444' : '2563eb' }}&color=fff" class="w-10 h-10 rounded-xl shadow-sm border border-white">
                                        @if($user->is_active)
                                            <span class="absolute -bottom-0.5 -right-0.5 w-3 h-3 bg-green-500 border-2 border-white rounded-full"></span>
                                        @endif
                                    </div>
                                    <div class="flex flex-col gap-1.5">
                                        <p class="font-bold text-gray-900 leading-none m-0 p-0">{{ $user->first_name }} {{ $user->last_name }}</p>
                                        <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest leading-none m-0 p-0">ID: #USR-{{ str_pad($user->id, 4, '0', STR_PAD_LEFT) }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-8 py-4">
                                <div class="flex flex-col gap-1.5">
                                    <p class="text-sm font-medium text-gray-700 leading-none m-0 p-0">{{ $user->email }}</p>
                                    <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest leading-none m-0 p-0">{{ $user->phone ?? 'No Phone Provided' }}</p>
                                </div>
                            </td>
                            <td class="px-8 py-4">
                                <span class="inline-flex px-3 py-1 rounded-lg text-[10px] font-black uppercase tracking-widest border {{ $user->role === 'admin' ? 'bg-red-50 text-red-600 border-red-100' : 'bg-blue-50 text-blue-600 border-blue-100' }}">
                                    {{ $user->role }}
                                </span>
                            </td>
                            <td class="px-8 py-4">
                                @if($user->is_active)
                                    <span class="inline-flex items-center gap-1.5 text-xs font-bold text-green-600 bg-green-50 px-2.5 py-1 rounded-lg border border-green-100">
                                        <span class="w-1.5 h-1.5 rounded-full bg-green-600"></span>
                                        Active
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 text-xs font-bold text-red-600 bg-red-50 px-2.5 py-1 rounded-lg border border-red-100">
                                        <span class="w-1.5 h-1.5 rounded-full bg-red-600"></span>
                                        Suspended
                                    </span>
                                @endif
                            </td>
                            <td class="px-8 py-4 text-right">
                                <div class="flex justify-end gap-2">
                                    @if($user->is_active)
                                        <button wire:click="blockUser({{ $user->id }})" class="bg-transparent px-3 py-1.5 rounded-lg text-xs font-black uppercase tracking-widest text-orange-600 hover:bg-orange-50 transition-all border border-transparent hover:border-orange-100">Block Access</button>
                                    @else
                                        <button wire:click="unblockUser({{ $user->id }})" class="bg-transparent px-3 py-1.5 rounded-lg text-xs font-black uppercase tracking-widest text-green-600 hover:bg-green-50 transition-all border border-transparent hover:border-green-100">Restore</button>
                                    @endif
                                    <button wire:click="confirmDeleteUser({{ $user->id }})" class="bg-transparent px-3 py-1.5 rounded-lg text-xs font-black uppercase tracking-widest text-red-600 hover:bg-red-50 transition-all border border-transparent hover:border-red-100">Delete</button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-8 py-20 text-center">
                                <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <span class="material-symbols-outlined text-gray-300 text-4xl">search_off</span>
                                </div>
                                <h3 class="text-gray-900 font-bold tracking-tight">No Users Found</h3>
                                <p class="text-gray-500 text-sm">Try adjusting your search or filters.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($users->hasPages())
            <div class="px-8 py-4 border-t border-gray-100 bg-gray-50/30">
                {{ $users->links() }}
            </div>
        @endif
    </div>
</div>
<div class="w-full" x-data="{ openModal: @entangle('isEditMode') }">
    <div class="mb-8 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <h1 class="text-3xl font-bold text-gray-900 tracking-tight">Supported Cities</h1>
            <p class="text-gray-500 mt-1">Configure active municipalities and locations supported for Home Pickup & Delivery services.</p>
        </div>
        <!-- Add Button -->
        <button wire:click="$set('isEditMode', true)" 
            class="bg-gray-900 text-white px-8 h-[52px] rounded-[1.25rem] font-black text-sm flex items-center justify-center gap-2 hover:bg-blue-600 transition-all shadow-md active:scale-95 group whitespace-nowrap shrink-0 border-none outline-none">
            <span class="material-symbols-outlined text-[20px]">add</span>
            Add Supported City
        </button>
    </div>

    @if (session()->has('message'))
        <div class="mb-6 p-4 rounded-xl bg-green-50 border border-green-200 text-green-700 font-bold text-sm flex items-center gap-2">
            <span class="material-symbols-outlined text-[20px]">check_circle</span>
            {{ session('message') }}
        </div>
    @endif

    <!-- Search / Controls -->
    <div class="flex flex-col md:flex-row items-center gap-4 mb-6 w-full">
        <div class="relative flex-1 w-full h-[60px]">
            <span class="material-symbols-outlined absolute left-5 top-1/2 -translate-y-1/2 text-gray-400 text-[24px]">search</span>
            <input type="text" wire:model.live="search" placeholder="Search cities/municipalities..." class="w-full h-full pl-14 pr-6 bg-white border border-gray-200 rounded-[1.25rem] focus:outline-none focus:ring-4 focus:ring-blue-100 focus:border-blue-400 transition-all text-sm font-black text-gray-900 shadow-sm placeholder:text-gray-400 placeholder:font-bold">
        </div>
    </div>

    <!-- Cities Table -->
    <div class="bg-white rounded-[1.25rem] border border-gray-200 shadow-sm overflow-hidden">
        <table class="w-full border-collapse">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-100">
                    <th class="px-6 py-4 text-left text-[10px] font-black text-gray-400 uppercase tracking-widest">City Name</th>
                    <th class="px-6 py-4 text-center text-[10px] font-black text-gray-400 uppercase tracking-widest w-48">Shipping Fee</th>
                    <th class="px-6 py-4 text-center text-[10px] font-black text-gray-400 uppercase tracking-widest w-48">Service Availability</th>
                    <th class="px-6 py-4 text-center text-[10px] font-black text-gray-400 uppercase tracking-widest w-48">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($cities as $city)
                    <tr class="hover:bg-gray-50/50 transition-all group">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3.5">
                                <div class="w-10 h-10 bg-blue-50/50 text-blue-600 rounded-xl flex items-center justify-center shrink-0">
                                    <span class="material-symbols-outlined text-[20px]">pin_drop</span>
                                </div>
                                <span class="font-bold text-gray-900 leading-snug">{{ $city->name }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-center font-bold text-gray-900">
                            ₱{{ number_format($city->shipping_fee, 2) }}
                        </td>
                        <td class="px-6 py-4 text-center">
                            <button wire:click="toggleStatus({{ $city->id }})" 
                                class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-wider border transition-all cursor-pointer bg-white shadow-sm
                                {{ $city->is_active ? 'bg-green-50 text-green-700 border-green-200 hover:bg-green-100' : 'bg-gray-50 text-gray-500 border-gray-200 hover:bg-gray-100' }}">
                                <span class="w-1.5 h-1.5 rounded-full {{ $city->is_active ? 'bg-green-500' : 'bg-gray-400' }}"></span>
                                {{ $city->is_active ? 'Service Available' : 'No Service' }}
                            </button>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <div class="flex items-center justify-center gap-1 opacity-0 group-hover:opacity-100 transition-opacity">
                                <button wire:click="edit({{ $city->id }})" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-all border-none bg-transparent cursor-pointer">
                                    <span class="material-symbols-outlined text-[20px]">edit</span>
                                </button>
                                <button wire:click="confirmDelete({{ $city->id }})" class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-all border-none bg-transparent cursor-pointer">
                                    <span class="material-symbols-outlined text-[20px]">delete</span>
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-12 text-center text-gray-400 italic text-sm">No cities found matching search rules.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        
        <div class="px-6 py-4 bg-gray-50 border-t border-gray-100">
            {{ $cities->links(data: ['scrollTo' => false]) }}
        </div>
    </div>

    <!-- Edit/Create Modal -->
    <div x-show="openModal" class="fixed inset-0 z-50 overflow-y-auto px-4 py-6 sm:px-0 flex items-center justify-center" x-cloak>
        <!-- Backdrop -->
        <div class="fixed inset-0 bg-gray-900/60 backdrop-blur-md" @click="$wire.resetFields()"></div>

        <!-- Modal Container -->
        <div x-show="openModal" 
             x-transition:enter="ease-out duration-300"
             x-transition:enter-start="opacity-0 scale-95 translate-y-4"
             x-transition:enter-end="opacity-100 scale-100 translate-y-0"
             x-transition:leave="ease-in duration-200"
             x-transition:leave-start="opacity-100 scale-100 translate-y-0"
             x-transition:leave-end="opacity-0 scale-95 translate-y-4"
             class="relative bg-white rounded-[2.5rem] shadow-2xl w-full max-w-md transform transition-all overflow-hidden flex flex-col z-10">
            
            <div class="flex justify-between items-center px-10 pt-10 pb-6 border-b border-gray-100">
                <div class="flex items-center gap-3.5">
                    <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center">
                        <span class="material-symbols-outlined text-[28px]">{{ $editingCityId ? 'edit_location' : 'add_location' }}</span>
                    </div>
                    <div>
                        <h2 class="text-2xl font-black text-gray-900 tracking-tight">{{ $editingCityId ? 'Edit' : 'Add' }} City</h2>
                        <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mt-1">Service Territories</p>
                    </div>
                </div>
                <button type="button" wire:click="resetFields" class="w-10 h-10 flex items-center justify-center text-gray-400 hover:text-gray-900 hover:bg-gray-100 rounded-full transition-all border-none bg-transparent cursor-pointer">
                    <span class="material-symbols-outlined text-[24px]">close</span>
                </button>
            </div>

            <form wire:submit.prevent="save" class="flex flex-col">
                <div class="p-10 space-y-6">
                    <!-- City Name -->
                    <div>
                        <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2 ml-1">City / Municipality Name</label>
                        <input type="text" wire:model="name" placeholder="e.g. Quezon City, Manila..." class="w-full px-5 py-4 border border-gray-200 rounded-[1.25rem] bg-gray-50 focus:bg-white focus:ring-4 focus:ring-blue-100 focus:border-blue-400 transition-all outline-none text-sm font-bold text-gray-900" required>
                        @error('name') <span class="text-xs text-red-500 mt-1 block ml-1">{{ $message }}</span> @enderror
                    </div>

                    <!-- Shipping Fee -->
                    <div>
                        <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2 ml-1">Shipping Fee (₱)</label>
                        <input type="number" step="0.01" wire:model="shipping_fee" placeholder="0.00" class="w-full px-5 py-4 border border-gray-200 rounded-[1.25rem] bg-gray-50 focus:bg-white focus:ring-4 focus:ring-blue-100 focus:border-blue-400 transition-all outline-none text-sm font-bold text-gray-900" required>
                        @error('shipping_fee') <span class="text-xs text-red-500 mt-1 block ml-1">{{ $message }}</span> @enderror
                    </div>

                    <!-- Status Toggle -->
                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-[1.25rem] border border-gray-100">
                        <div class="flex flex-col">
                            <span class="text-sm font-bold text-gray-800">Service Active</span>
                            <span class="text-xs text-gray-400">Allow users to select this city for bookings</span>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" wire:model="is_active" class="sr-only peer">
                            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                        </label>
                    </div>
                </div>

                <div class="px-10 py-6 border-t border-gray-100 bg-gray-50/50 flex justify-end gap-3 rounded-b-[2.5rem]">
                    <button type="button" wire:click="resetFields" class="px-6 py-3.5 border border-gray-200 text-gray-700 font-bold rounded-xl hover:bg-gray-100 transition-all text-xs bg-white cursor-pointer shadow-sm">Cancel</button>
                    <button type="submit" class="px-8 py-3.5 bg-gray-900 hover:bg-blue-600 text-white font-bold rounded-xl transition-all shadow-md active:scale-95 text-xs border-none cursor-pointer">
                        {{ $editingCityId ? 'Save Changes' : 'Add Territory' }}
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Confirm Delete Modal -->
    @if($confirmingDeletionId)
    <div class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-gray-900/60 backdrop-blur-md">
        <div class="bg-white rounded-[2rem] p-8 max-w-sm w-full text-center shadow-2xl border border-gray-100 animate-scale-in">
            <div class="w-16 h-16 bg-red-50 text-red-500 rounded-full flex items-center justify-center mx-auto mb-5">
                <span class="material-symbols-outlined text-[36px]">delete_forever</span>
            </div>
            <h3 class="text-xl font-black text-gray-900 mb-2">Remove Supported City?</h3>
            <p class="text-sm text-gray-500 mb-8 leading-relaxed">This action cannot be undone. Users will no longer be able to select this city.</p>
            <div class="flex gap-3 justify-center">
                <button wire:click="cancelDelete" class="px-6 py-3 border border-gray-200 text-gray-700 font-bold rounded-xl hover:bg-gray-100 transition-all text-xs bg-white cursor-pointer shadow-sm">Keep it</button>
                <button wire:click="delete" class="px-6 py-3 bg-red-600 hover:bg-red-700 text-white font-bold rounded-xl transition-all text-xs border-none cursor-pointer shadow-md">Delete</button>
            </div>
        </div>
    </div>
    @endif
</div>

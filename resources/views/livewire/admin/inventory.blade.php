<div class="w-full" x-data="{ openModal: @entangle('showEditModal'), openDeleteModal: @entangle('showDeleteModal') }">
    <div class="mb-8 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <h1 class="text-3xl font-bold text-gray-900 tracking-tight">Inventory Items</h1>
            <p class="text-gray-500 mt-1">Manage stock quantities, unit prices, and SKU codes for repair spare parts.</p>
        </div>
        <!-- Add Button -->
        <button wire:click="editRecord(0)" 
            class="bg-gray-900 text-white px-8 h-[52px] rounded-full font-black text-sm flex items-center justify-center gap-2 hover:bg-blue-600 transition-all shadow-md active:scale-95 group whitespace-nowrap shrink-0 border-none outline-none cursor-pointer">
            <span class="material-symbols-outlined text-[20px]">add</span>
            Add Inventory Item
        </button>
    </div>

    <!-- Stats Summary -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-10">
        <div class="bg-white p-6 rounded-[1.25rem] border border-gray-200 shadow-sm">
            <p class="text-xs font-bold text-gray-500 uppercase tracking-wider">Total SKUs</p>
            <h3 class="text-3xl font-extrabold text-gray-900 mt-1">{{ $totalItems }}</h3>
        </div>
        <div class="bg-white p-6 rounded-[1.25rem] border border-gray-200 shadow-sm">
            <p class="text-xs font-bold text-gray-500 uppercase tracking-wider">Low Stock</p>
            <h3 class="text-3xl font-extrabold text-gray-900 mt-1 text-yellow-600">{{ $lowStock }}</h3>
        </div>
        <div class="bg-white p-6 rounded-[1.25rem] border border-gray-200 shadow-sm">
            <p class="text-xs font-bold text-gray-500 uppercase tracking-wider">Total Value</p>
            <h3 class="text-3xl font-extrabold text-gray-900 mt-1 text-green-600">₱{{ number_format($totalValue, 2) }}</h3>
        </div>
    </div>

    @if (session()->has('message'))
        <div class="mb-6 p-4 rounded-xl bg-green-50 border border-green-200 text-green-700 font-bold text-sm flex items-center gap-2">
            <span class="material-symbols-outlined text-[20px]">check_circle</span>
            {{ session('message') }}
        </div>
    @endif

    <!-- Controls Row -->
    <div class="flex flex-col md:flex-row items-center gap-4 mb-6 w-full">
        <!-- Search Input -->
        <div class="relative flex-1 w-full h-[60px]">
            <span class="material-symbols-outlined absolute left-5 top-1/2 -translate-y-1/2 text-gray-400 text-[24px]">search</span>
            <input type="text" wire:model.live="search" placeholder="Search inventory items by name or SKU..." class="w-full h-full pl-14 pr-6 bg-white border border-gray-200 rounded-[1.25rem] focus:outline-none focus:ring-4 focus:ring-blue-100 focus:border-blue-400 transition-all text-sm font-black text-gray-900 shadow-sm placeholder:text-gray-400 placeholder:font-bold">
        </div>
        
        <!-- Sorting Dropdown -->
        <div class="relative w-full md:w-64 h-[60px]">
            <select wire:model.live="sortOrder" class="w-full h-full pl-6 pr-12 bg-white border border-gray-200 rounded-[1.25rem] focus:outline-none focus:ring-4 focus:ring-blue-100 focus:border-blue-400 transition-all text-sm font-black text-gray-900 shadow-sm appearance-none cursor-pointer">
                <option value="latest">Sort by: Latest</option>
                <option value="alpha_asc">Alphabetical (A - Z)</option>
                <option value="alpha_desc">Alphabetical (Z - A)</option>
                <option value="stock_asc">Stock: Low to High</option>
                <option value="stock_desc">Stock: High to Low</option>
            </select>
            <span class="material-symbols-outlined absolute right-5 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none">unfold_more</span>
        </div>
    </div>

    <!-- Records Table -->
    <div class="bg-white rounded-[1.25rem] border border-gray-200 shadow-sm overflow-hidden">
        <table class="w-full">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-100">
                    <th class="px-6 py-4 text-left text-[10px] font-black text-gray-400 uppercase tracking-widest">Item Name</th>
                    <th class="px-6 py-4 text-left text-[10px] font-black text-gray-400 uppercase tracking-widest w-48">Brand</th>
                    <th class="px-6 py-4 text-left text-[10px] font-black text-gray-400 uppercase tracking-widest w-48">SKU</th>
                    <th class="px-6 py-4 text-center text-[10px] font-black text-gray-400 uppercase tracking-widest w-32">Stock</th>
                    <th class="px-6 py-4 text-right text-[10px] font-black text-gray-400 uppercase tracking-widest w-36">Unit Price</th>
                    <th class="px-6 py-4 text-center text-[10px] font-black text-gray-400 uppercase tracking-widest w-36">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($records as $record)
                    <tr class="hover:bg-gray-50 transition-all group">
                        <td class="px-6 py-4">
                            <span class="font-bold text-gray-900 leading-snug">{{ $record->name }}</span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-2.5 py-0.5 bg-gray-105 text-gray-600 rounded-md text-[10px] font-black uppercase tracking-wider">{{ $record->brand->name ?? 'N/A' }}</span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="font-mono text-[10px] text-gray-400 bg-gray-50 border border-gray-100 rounded px-2 py-0.5 inline-block">{{ $record->sku }}</span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="font-bold text-sm {{ $record->quantity <= 10 ? 'text-red-650 font-black' : 'text-gray-900' }}">{{ $record->quantity }}</span>
                        </td>
                        <td class="px-6 py-4 text-right text-blue-600 font-black">
                            ₱{{ number_format($record->unit_price, 2) }}
                        </td>
                        <td class="px-6 py-4 text-center flex items-center justify-center space-x-2">
                            <button wire:click="editRecord({{ $record->id }})" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-all opacity-0 group-hover:opacity-100 border-none bg-transparent cursor-pointer">
                                <span class="material-symbols-outlined text-[20px]">edit</span>
                            </button>
                            <button wire:click="confirmDelete({{ $record->id }})" class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-all opacity-0 group-hover:opacity-100 border-none bg-transparent cursor-pointer">
                                <span class="material-symbols-outlined text-[20px]">delete</span>
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center text-gray-400 italic text-sm">No inventory items found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        
        @if($records->hasPages())
            <div class="laravel-pagination px-6 py-4 bg-gray-50 border-t border-gray-100">
                {{ $records->links(data: ['scrollTo' => false]) }}
            </div>
        @endif
    </div>

    <!-- Edit Modal -->
    <div x-show="openModal" 
        class="fixed inset-0 z-50 overflow-y-auto px-4 py-6 sm:px-0 flex items-center justify-center" 
        x-cloak>
        <div class="fixed inset-0 bg-gray-900/60 backdrop-blur-md" @click="openModal = false"></div>
        <div x-show="openModal"
            x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0 scale-95 translate-y-4"
            x-transition:enter-end="opacity-100 scale-100 translate-y-0"
            x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100 scale-100 translate-y-0"
            x-transition:leave-end="opacity-0 scale-95 translate-y-4"
            class="relative bg-white modal-content rounded-[2.5rem] shadow-2xl w-full max-w-md p-10 transform transition-all overflow-hidden flex flex-col z-10">
            
            <div class="flex justify-between items-center mb-8">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center">
                        <span class="material-symbols-outlined text-[28px]">{{ $editingId ? 'edit_note' : 'add_box' }}</span>
                    </div>
                    <div>
                        <h2 class="text-2xl font-black text-gray-900 tracking-tight leading-none">{{ $editingId ? 'Edit' : 'Add' }} Item</h2>
                        <p class="text-xs font-bold text-gray-400 mt-1 uppercase tracking-widest">Inventory Spare Parts</p>
                    </div>
                </div>
                <button @click="openModal = false" class="w-10 h-10 flex items-center justify-center text-gray-400 hover:text-gray-900 hover:bg-gray-100 rounded-full transition-all border-none bg-transparent cursor-pointer">
                    <span class="material-symbols-outlined text-[24px]">close</span>
                </button>
            </div>

            <form wire:submit.prevent="saveRecord" class="space-y-6">
                <div>
                    <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2 ml-1">Item Title / Name</label>
                    <input type="text" wire:model="formName" placeholder="e.g. iPhone 13 Screen Assembly..." class="w-full px-5 py-4 border border-gray-200 rounded-[1.25rem] bg-gray-50 focus:bg-white focus:ring-4 focus:ring-blue-100 focus:border-blue-400 transition-all outline-none text-sm font-bold text-gray-900" required>
                    @error('formName') <span class="text-xs text-red-500 mt-1 block ml-1">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2 ml-1">Associated Brand</label>
                    <div class="relative w-full">
                        <select wire:model="formBrandId" class="w-full pl-4 pr-10 py-3.5 border border-gray-200 rounded-[1.25rem] bg-gray-50 focus:bg-white focus:ring-4 focus:ring-blue-100 focus:border-blue-400 transition-all text-sm font-bold text-gray-900 appearance-none cursor-pointer">
                            <option value="">No Brand Linked</option>
                            @foreach($brands as $brand)
                                <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                            @endforeach
                        </select>
                        <span class="material-symbols-outlined absolute right-3.5 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none text-[20px]">unfold_more</span>
                    </div>
                    @error('formBrandId') <span class="text-xs text-red-500 mt-1 block ml-1">{{ $message }}</span> @enderror
                </div>

                <div class="grid grid-cols-2 gap-5">
                    <div>
                        <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2 ml-1">SKU Number</label>
                        <input type="text" wire:model="formSku" placeholder="RM-XXXX" class="w-full px-5 py-4 border border-gray-200 rounded-2xl bg-gray-50 focus:bg-white focus:ring-4 focus:ring-blue-100 transition-all outline-none text-sm font-bold text-gray-900" required>
                        @error('formSku') <span class="text-xs text-red-500 mt-1 block ml-1">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2 ml-1">Stock level</label>
                        <input type="number" wire:model="formQuantity" class="w-full px-5 py-4 border border-gray-200 rounded-2xl bg-gray-50 focus:bg-white focus:ring-4 focus:ring-blue-100 transition-all outline-none text-sm font-bold text-gray-900" required>
                        @error('formQuantity') <span class="text-xs text-red-500 mt-1 block ml-1">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div>
                    <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2 ml-1">Unit Selling Price</label>
                    <div class="relative w-full">
                        <span class="absolute left-5 top-1/2 -translate-y-1/2 text-gray-400 font-bold">₱</span>
                        <input type="number" step="0.01" wire:model="formUnitPrice" class="w-full pl-10 pr-5 py-4 border border-gray-200 rounded-2xl bg-gray-50 focus:bg-white focus:ring-4 focus:ring-blue-100 transition-all outline-none text-sm font-bold text-gray-900" required>
                    </div>
                    @error('formUnitPrice') <span class="text-xs text-red-500 mt-1 block ml-1">{{ $message }}</span> @enderror
                </div>

                <div class="pt-6">
                    <button type="submit" class="w-full bg-gray-900 text-white py-5 rounded-full font-black text-lg hover:bg-blue-600 transition-all shadow-xl dark:shadow-none active:scale-95 flex items-center justify-center gap-3 group border-none cursor-pointer">
                        <span class="material-symbols-outlined text-[20px] group-hover:scale-125 transition-transform">{{ $editingId ? 'save' : 'add_task' }}</span>
                        {{ $editingId ? 'Save Changes' : 'Create Item' }}
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div x-show="openDeleteModal" 
        class="fixed inset-0 z-50 overflow-y-auto px-4 py-6 sm:px-0 flex items-center justify-center" 
        x-cloak>
        <div class="fixed inset-0 bg-gray-900/60 backdrop-blur-md" @click="openDeleteModal = false"></div>
        <div x-show="openDeleteModal"
            x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            class="relative bg-white modal-content rounded-[2.5rem] shadow-2xl w-full max-w-sm p-8 transform transition-all overflow-hidden text-center z-10">
            
            <div class="w-16 h-16 bg-red-50 rounded-full flex items-center justify-center mx-auto mb-5">
                <span class="material-symbols-outlined text-red-650 text-[36px]">delete_forever</span>
            </div>
            
            <h2 class="text-xl font-black text-gray-900 tracking-tight leading-tight mb-2">Delete Confirmation</h2>
            <p class="text-xs font-bold text-gray-500 mb-6 leading-relaxed px-2">
                Are you sure you want to permanently delete <span class="text-red-600 font-extrabold">"{{ $deletingName }}"</span>? This action cannot be undone.
            </p>

            <div class="flex items-center gap-3">
                <button @click="openDeleteModal = false" type="button" class="w-1/2 bg-gray-105 text-gray-700 py-3.5 rounded-full font-black text-sm hover:bg-gray-200 transition-all border-none cursor-pointer">
                    Cancel
                </button>
                <button wire:click="deleteRecord" type="button" class="w-1/2 bg-red-600 text-white py-3.5 rounded-full font-black text-sm hover:bg-red-700 transition-all shadow-lg border-none cursor-pointer">
                    Delete
                </button>
            </div>
        </div>
    </div>
</div>

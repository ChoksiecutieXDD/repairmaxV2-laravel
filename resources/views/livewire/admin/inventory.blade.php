<div class="w-full" x-data="{ openModal: @entangle('showEditModal'), openDeleteModal: @entangle('showDeleteModal') }">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900 tracking-tight">Inventory</h1>
        <p class="text-gray-500 mt-1">Manage Brands, Exact Models, and Inventory Spare Parts.</p>
    </div>

    <!-- Stats Summary (Only for Items tab) -->
    @if($activeTab === 'items')
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-10">
        <div class="bg-white p-6 rounded-[1.25rem] border border-gray-200 shadow-sm">
            <p class="text-xs font-bold text-gray-500 uppercase tracking-wider">Total SKU</p>
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
    @endif

    <!-- Unified Control Bar - 2 Rows for visual clarity and spacing -->
    <div class="space-y-4 mb-6">
        <!-- Row 1: Tabs & Actions -->
        <div class="flex flex-col lg:flex-row items-center justify-between gap-4 w-full">
            <!-- Segments Toggle -->
            <div class="bg-gray-100/80 p-1.5 rounded-[1.25rem] flex items-center shrink-0 border border-gray-200/50 shadow-inner w-full lg:w-auto justify-between sm:justify-start gap-1">
                <button wire:click="$set('activeTab', 'brand')" 
                    class="flex items-center justify-center gap-2 px-6 py-3 rounded-[1rem] text-sm font-black transition-all duration-300 flex-1 sm:flex-none {{ $activeTab === 'brand' ? 'bg-gray-900 text-white shadow-md transform scale-102' : 'bg-transparent text-gray-400 hover:text-gray-700' }}">
                    <span class="material-symbols-outlined text-[20px]">branding_watermark</span>
                    Brands
                </button>
                <button wire:click="$set('activeTab', 'models')" 
                    class="flex items-center justify-center gap-2 px-6 py-3 rounded-[1rem] text-sm font-black transition-all duration-300 flex-1 sm:flex-none {{ $activeTab === 'models' ? 'bg-gray-900 text-white shadow-md transform scale-102' : 'bg-transparent text-gray-500 hover:text-gray-700' }}">
                    <span class="material-symbols-outlined text-[20px]">devices</span>
                    Exact Models
                </button>
                <button wire:click="$set('activeTab', 'items')" 
                    class="flex items-center justify-center gap-2 px-6 py-3 rounded-[1rem] text-sm font-black transition-all duration-300 flex-1 sm:flex-none {{ $activeTab === 'items' ? 'bg-gray-900 text-white shadow-md transform scale-102' : 'bg-transparent text-gray-500 hover:text-gray-700' }}">
                    <span class="material-symbols-outlined text-[20px]">inventory_2</span>
                    Inventory Items
                </button>
            </div>

            <!-- Sorting & Add Action Block -->
            <div class="flex flex-col sm:flex-row items-center gap-4 w-full lg:w-auto shrink-0">
                <!-- Sorting Dropdown -->
                <div class="relative w-full sm:w-60 h-[60px] shrink-0">
                    <select wire:model.live="sortOrder" class="w-full h-full pl-6 pr-12 bg-white border border-gray-200 rounded-[1.25rem] focus:outline-none focus:ring-4 focus:ring-blue-100 focus:border-blue-400 transition-all text-sm font-black text-gray-900 shadow-sm appearance-none cursor-pointer">
                        <option value="latest">Sort by: Latest</option>
                        <option value="alpha_asc">Alphabetical (A - Z)</option>
                        <option value="alpha_desc">Alphabetical (Z - A)</option>
                        @if($activeTab === 'items')
                            <option value="stock_asc">Stock: Low to High</option>
                            <option value="stock_desc">Stock: High to Low</option>
                        @endif
                    </select>
                    <span class="material-symbols-outlined absolute right-5 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none">unfold_more</span>
                </div>

                <!-- Add Button -->
                <button wire:click="editRecord('{{ $activeTab === 'brand' ? 'brand' : ($activeTab === 'models' ? 'model' : 'item') }}', 0)" 
                    class="w-full sm:w-auto bg-gray-900 text-white px-10 h-[60px] rounded-[1.25rem] font-black text-sm flex items-center justify-center gap-3 hover:bg-blue-600 transition-all shadow-xl hover:shadow-blue-100 active:scale-95 group whitespace-nowrap shrink-0">
                    <span class="material-symbols-outlined text-[24px] group-hover:rotate-90 transition-transform">add</span>
                    Add New {{ $activeTab === 'brand' ? 'Brand' : ($activeTab === 'models' ? 'Exact Model' : 'Inventory Item') }}
                </button>
            </div>
        </div>

        <!-- Row 2: Full-Width Search Input -->
        <div class="relative w-full h-[60px]">
            <span class="material-symbols-outlined absolute left-5 top-1/2 -translate-y-1/2 text-gray-400 text-[24px]">search</span>
            <input type="text" wire:model.live="search" placeholder="Search {{ $activeTab === 'brand' ? 'brands' : ($activeTab === 'models' ? 'exact models' : 'inventory items') }}..." class="w-full h-full pl-14 pr-6 bg-white border border-gray-200 rounded-[1.25rem] focus:outline-none focus:ring-4 focus:ring-blue-100 focus:border-blue-400 transition-all text-sm font-black text-gray-900 shadow-sm placeholder:text-gray-400 placeholder:font-bold">
        </div>
    </div>

    <!-- Records Table -->
    <div class="bg-white rounded-[1.25rem] border border-gray-200 shadow-sm overflow-hidden">
        <table class="w-full">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-100">
                    <th class="px-6 py-4 text-left text-[10px] font-black text-gray-400 uppercase tracking-widest flex-1">Name</th>
                    @if($activeTab === 'models')
                        <th class="px-6 py-4 text-left text-[10px] font-black text-gray-400 uppercase tracking-widest flex-1">Parent Brand</th>
                    @endif
                    @if($activeTab === 'items')
                        <th class="px-6 py-4 text-left text-[10px] font-black text-gray-400 uppercase tracking-widest flex-1">Brand</th>
                        <th class="px-6 py-4 text-left text-[10px] font-black text-gray-400 uppercase tracking-widest flex-1">SKU</th>
                        <th class="px-6 py-4 text-center text-[10px] font-black text-gray-400 uppercase tracking-widest flex-1">Stock</th>
                    @endif
                    <th class="px-6 py-4 text-center text-[10px] font-black text-gray-400 uppercase tracking-widest flex-1 w-36">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($records as $record)
                    <tr class="hover:bg-gray-50 transition-all group">
                        <td class="px-6 py-4 flex-1">
                            <span class="font-bold text-gray-900">{{ $record->name }}</span>
                        </td>
                        @if($activeTab === 'models')
                            <td class="px-6 py-4 flex-1 text-gray-600 text-sm">{{ $record->brand->name ?? 'N/A' }}</td>
                        @endif
                        @if($activeTab === 'items')
                            <td class="px-6 py-4 flex-1 text-gray-600 text-sm">{{ $record->brand->name ?? 'N/A' }}</td>
                            <td class="px-6 py-4 flex-1">
                                <span class="font-mono text-[10px] text-gray-400 bg-gray-50 border border-gray-100 rounded px-2 py-0.5 inline-block">{{ $record->sku }}</span>
                            </td>
                            <td class="px-6 py-4 flex-1 text-center">
                                <span class="font-bold text-sm {{ $record->quantity <= 10 ? 'text-red-600' : 'text-gray-900' }}">{{ $record->quantity }}</span>
                            </td>
                        @endif
                        <td class="px-6 py-4 text-center flex items-center justify-center space-x-2 w-36">
                            <button wire:click="editRecord('{{ $activeTab === 'brand' ? 'brand' : ($activeTab === 'models' ? 'model' : 'item') }}', {{ $record->id }})" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-all opacity-0 group-hover:opacity-100">
                                <span class="material-symbols-outlined text-[20px]">edit</span>
                            </button>
                            <button wire:click="confirmDelete('{{ $activeTab === 'brand' ? 'brand' : ($activeTab === 'models' ? 'model' : 'item') }}', {{ $record->id }})" class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-all opacity-0 group-hover:opacity-100">
                                <span class="material-symbols-outlined text-[20px]">delete</span>
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-10 text-center text-gray-400 italic text-sm">No records found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Edit Modal (Using Consistent UI Logic) -->
    <div x-show="openModal" 
        class="fixed inset-0 z-50 overflow-y-auto px-4 py-6 sm:px-0 flex items-center justify-center" 
        x-cloak>
        
        <!-- Consistent Backdrop -->
        <div x-show="openModal"
            x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 bg-gray-900/60 backdrop-blur-md" 
            @click="openModal = false"></div>

        <!-- Consistent Modal Container -->
        <div x-show="openModal"
            x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            class="relative bg-white rounded-[2.5rem] shadow-2xl w-full max-w-md p-10 transform transition-all overflow-hidden">
            
            <div class="flex justify-between items-center mb-8">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-blue-50 rounded-2xl flex items-center justify-center">
                        <span class="material-symbols-outlined text-blue-600 text-[28px]">{{ $editingId ? 'edit' : 'add_circle' }}</span>
                    </div>
                    <div>
                        <h2 class="text-2xl font-black text-gray-900 tracking-tight leading-none">{{ $editingId ? 'Edit' : 'Add' }} {{ $editingType === 'brand' ? 'Brand' : ($editingType === 'model' ? 'Exact Model' : 'Inventory Item') }}</h2>
                        <p class="text-xs font-bold text-gray-400 mt-1 uppercase tracking-widest">Inventory Management</p>
                    </div>
                </div>
                <button @click="openModal = false" class="w-10 h-10 flex items-center justify-center text-gray-400 hover:text-gray-900 hover:bg-gray-100 rounded-full transition-all">
                    <span class="material-symbols-outlined text-[24px]">close</span>
                </button>
            </div>

            <form wire:submit="saveRecord" class="space-y-6">
                <div>
                    <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2 ml-1">
                        @if($editingType === 'brand')
                            Brand Name
                        @elseif($editingType === 'model')
                            Exact Model Name
                        @else
                            Item Name / Title
                        @endif
                    </label>
                    <input type="text" wire:model="formName" placeholder="@if($editingType === 'brand') Enter brand name... @elseif($editingType === 'model') Enter model name (e.g. iPhone 14)... @else Enter item name... @endif" class="w-full px-5 py-4 border border-gray-200 rounded-[1.25rem] bg-gray-50 focus:bg-white focus:ring-4 focus:ring-blue-100 focus:border-blue-400 transition-all outline-none text-sm font-bold text-gray-900">
                    @error('formName') <span class="text-[10px] text-red-500 mt-2 font-bold block ml-1 uppercase tracking-tighter">{{ $message }}</span> @enderror
                </div>

                @if($editingType === 'model' || $editingType === 'item')
                    <div>
                        <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2 ml-1">Associated Brand</label>
                        <select wire:model="formBrandId" class="w-full px-5 py-4 border border-gray-200 rounded-[1.25rem] bg-gray-50 focus:bg-white focus:ring-4 focus:ring-blue-100 focus:border-blue-400 transition-all outline-none text-sm font-bold text-gray-900">
                            <option value="">No Brand Linked</option>
                            @foreach($brands as $brand)
                                <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                            @endforeach
                        </select>
                        @error('formBrandId') <span class="text-[10px] text-red-500 mt-2 font-bold block ml-1 uppercase tracking-tighter">{{ $message }}</span> @enderror
                    </div>
                @endif

                @if($editingType === 'item')
                    <div class="grid grid-cols-2 gap-5">
                        <div>
                            <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2 ml-1">SKU Number</label>
                            <input type="text" wire:model="formSku" placeholder="RM-..." class="w-full px-5 py-4 border border-gray-200 rounded-2xl bg-gray-50 focus:bg-white focus:ring-4 focus:ring-blue-100 transition-all outline-none text-sm font-bold text-gray-900">
                            @error('formSku') <span class="text-[10px] text-red-500 mt-2 font-bold block ml-1 uppercase tracking-tighter">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2 ml-1">Stock Level</label>
                            <input type="number" wire:model="formQuantity" class="w-full px-5 py-4 border border-gray-200 rounded-2xl bg-gray-50 focus:bg-white focus:ring-4 focus:ring-blue-100 transition-all outline-none text-sm font-bold text-gray-900">
                        </div>
                    </div>
                    <div>
                        <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2 ml-1">Unit Selling Price</label>
                        <div class="relative">
                            <span class="absolute left-5 top-1/2 -translate-y-1/2 text-gray-400 font-bold">₱</span>
                            <input type="number" step="0.01" wire:model="formUnitPrice" class="w-full pl-10 pr-5 py-4 border border-gray-200 rounded-2xl bg-gray-50 focus:bg-white focus:ring-4 focus:ring-blue-100 transition-all outline-none text-sm font-bold text-gray-900">
                        </div>
                    </div>
                @endif

                <div class="pt-6">
                    <button type="submit" class="w-full bg-gray-900 text-white py-5 rounded-2xl font-black text-lg hover:bg-blue-600 transition-all shadow-xl shadow-gray-200 active:scale-95 flex items-center justify-center gap-3 group">
                        <span class="material-symbols-outlined text-[20px] group-hover:scale-125 transition-transform">{{ $editingId ? 'save' : 'add_task' }}</span>
                        {{ $editingId ? 'Save Changes' : 'Create Record' }}
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div x-show="openDeleteModal" 
        class="fixed inset-0 z-50 overflow-y-auto px-4 py-6 sm:px-0 flex items-center justify-center" 
        x-cloak>
        
        <!-- Backdrop -->
        <div x-show="openDeleteModal"
            x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 bg-gray-900/60 backdrop-blur-md" 
            @click="openDeleteModal = false"></div>

        <!-- Modal Container -->
        <div x-show="openDeleteModal"
            x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            class="relative bg-white rounded-[2.5rem] shadow-2xl w-full max-w-sm p-8 transform transition-all overflow-hidden text-center">
            
            <!-- Warning Icon -->
            <div class="w-16 h-16 bg-red-50 rounded-full flex items-center justify-center mx-auto mb-5">
                <span class="material-symbols-outlined text-red-600 text-[36px]">warning</span>
            </div>
            
            <h2 class="text-xl font-black text-gray-900 tracking-tight leading-tight mb-2">Delete Confirmation</h2>
            <p class="text-xs font-bold text-gray-500 mb-6 leading-relaxed px-2">
                Are you sure you want to permanently delete <span class="text-red-600 font-extrabold">"{{ $deletingName }}"</span>? This action cannot be undone.
            </p>

            <div class="flex items-center gap-3">
                <button @click="openDeleteModal = false" type="button" class="w-1/2 bg-gray-100 text-gray-700 py-3.5 rounded-xl font-black text-sm hover:bg-gray-200 transition-all active:scale-95">
                    Cancel
                </button>
                <button wire:click="deleteRecord" type="button" class="w-1/2 bg-red-600 text-white py-3.5 rounded-xl font-black text-sm hover:bg-red-700 transition-all shadow-lg shadow-red-100 active:scale-95">
                    Delete
                </button>
            </div>
        </div>
    </div>
</div>

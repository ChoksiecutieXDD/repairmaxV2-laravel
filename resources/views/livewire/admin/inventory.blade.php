<div class="w-full" x-data="{ openModal: @entangle('showEditModal') }">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900 tracking-tight">Inventory</h1>
        <p class="text-gray-500 mt-1">Manage Brands, Items/Models, and Fault types.</p>
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

    <!-- Horizontal Tabs -->
    <div class="bg-white p-1.5 rounded-[1.25rem] mb-8 w-full border border-gray-200 shadow-sm flex items-center overflow-x-auto no-scrollbar">
        <div class="flex space-x-1 min-w-full lg:min-w-0">
            <button wire:click="$set('activeTab', 'brand')" 
                class="flex items-center gap-2 px-8 py-3 rounded-[1rem] text-sm font-black transition-all duration-300 {{ $activeTab === 'brand' ? 'bg-gray-900 text-white shadow-lg transform scale-105' : 'bg-transparent text-gray-500 hover:bg-gray-50' }}">
                <span class="material-symbols-outlined text-[20px]">branding_watermark</span>
                Brand
            </button>
            <button wire:click="$set('activeTab', 'items')" 
                class="flex items-center gap-2 px-8 py-3 rounded-[1rem] text-sm font-black transition-all duration-300 {{ $activeTab === 'items' ? 'bg-gray-900 text-white shadow-lg transform scale-105' : 'bg-transparent text-gray-500 hover:bg-gray-50' }}">
                <span class="material-symbols-outlined text-[20px]">inventory_2</span>
                Items
            </button>
            <button wire:click="$set('activeTab', 'fault')" 
                class="flex items-center gap-2 px-8 py-3 rounded-[1rem] text-sm font-black transition-all duration-300 {{ $activeTab === 'fault' ? 'bg-gray-900 text-white shadow-lg transform scale-105' : 'bg-transparent text-gray-500 hover:bg-gray-50' }}">
                <span class="material-symbols-outlined text-[20px]">report_problem</span>
                Fault
            </button>
        </div>
    </div>

    <!-- Search & Add -->
    <div class="flex flex-col md:flex-row justify-between items-center gap-4 mb-6">
        <div class="relative flex-1 w-full h-[60px]">
            <span class="material-symbols-outlined absolute left-5 top-1/2 -translate-y-1/2 text-gray-400 text-[24px]">search</span>
            <input type="text" wire:model.live="search" placeholder="Search brands, items, or fault types..." class="w-full h-full pl-14 pr-6 bg-white border border-gray-200 rounded-[1.25rem] focus:outline-none focus:ring-4 focus:ring-blue-100 focus:border-blue-400 transition-all text-sm font-black text-gray-900 shadow-sm placeholder:text-gray-400 placeholder:font-bold">
        </div>
        <button wire:click="editRecord('{{ $activeTab === 'items' ? 'item' : $activeTab }}', 0)" 
            class="bg-gray-900 text-white px-10 h-[60px] rounded-[1.25rem] font-black text-sm flex items-center justify-center gap-3 hover:bg-blue-600 transition-all shadow-xl hover:shadow-blue-100 active:scale-95 group whitespace-nowrap">
            <span class="material-symbols-outlined text-[24px] group-hover:rotate-90 transition-transform">add</span>
            Add New {{ ucfirst($activeTab) }}
        </button>
    </div>

    <!-- Records Table -->
    <div class="bg-white rounded-[1.25rem] border border-gray-200 shadow-sm overflow-hidden">
        <table class="min-w-full">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-100">
                    <th class="px-6 py-4 text-left text-[10px] font-black text-gray-400 uppercase tracking-widest">Name</th>
                    @if($activeTab === 'items')
                        <th class="px-6 py-4 text-left text-[10px] font-black text-gray-400 uppercase tracking-widest">Brand</th>
                        <th class="px-6 py-4 text-left text-[10px] font-black text-gray-400 uppercase tracking-widest">SKU</th>
                        <th class="px-6 py-4 text-left text-[10px] font-black text-gray-400 uppercase tracking-widest">Stock</th>
                    @elseif($activeTab === 'fault')
                        <th class="px-6 py-4 text-left text-[10px] font-black text-gray-400 uppercase tracking-widest">Base Price</th>
                    @endif
                    <th class="px-6 py-4 text-right text-[10px] font-black text-gray-400 uppercase tracking-widest">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($records as $record)
                    <tr class="hover:bg-gray-50 transition-all group">
                        <td class="px-6 py-4">
                            <span class="font-bold text-gray-900">{{ $record->name }}</span>
                        </td>
                        @if($activeTab === 'items')
                            <td class="px-6 py-4 text-gray-600 text-sm">{{ $record->brand->name ?? 'N/A' }}</td>
                            <td class="px-6 py-4 font-mono text-[10px] text-gray-400 bg-gray-50/50 rounded px-2 py-0.5 inline-block mt-3.5 ml-6">{{ $record->sku }}</td>
                            <td class="px-6 py-4">
                                <span class="font-bold text-sm {{ $record->quantity <= 10 ? 'text-red-600' : 'text-gray-900' }}">{{ $record->quantity }}</span>
                            </td>
                        @elseif($activeTab === 'fault')
                            <td class="px-6 py-4 text-blue-600 font-black">₱{{ number_format($record->base_price, 2) }}</td>
                        @endif
                        <td class="px-6 py-4 text-right space-x-2">
                            <button wire:click="editRecord('{{ $activeTab === 'items' ? 'item' : $activeTab }}', {{ $record->id }})" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-all opacity-0 group-hover:opacity-100">
                                <span class="material-symbols-outlined text-[20px]">edit</span>
                            </button>
                            <button wire:confirm="Are you sure you want to delete this?" wire:click="deleteRecord('{{ $activeTab === 'items' ? 'item' : $activeTab }}', {{ $record->id }})" class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-all opacity-0 group-hover:opacity-100">
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
                        <h2 class="text-2xl font-black text-gray-900 tracking-tight leading-none">{{ $editingId ? 'Edit' : 'Add' }} {{ ucfirst($editingType) }}</h2>
                        <p class="text-xs font-bold text-gray-400 mt-1 uppercase tracking-widest">Inventory Management</p>
                    </div>
                </div>
                <button @click="openModal = false" class="w-10 h-10 flex items-center justify-center text-gray-400 hover:text-gray-900 hover:bg-gray-100 rounded-full transition-all">
                    <span class="material-symbols-outlined text-[24px]">close</span>
                </button>
            </div>

            <form wire:submit="saveRecord" class="space-y-6">
                <div>
                    <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2 ml-1">Name / Title</label>
                    <input type="text" wire:model="formName" placeholder="Enter name..." class="w-full px-5 py-4 border border-gray-200 rounded-[1.25rem] bg-gray-50 focus:bg-white focus:ring-4 focus:ring-blue-100 focus:border-blue-400 transition-all outline-none text-sm font-bold text-gray-900">
                    @error('formName') <span class="text-[10px] text-red-500 mt-2 font-bold block ml-1 uppercase tracking-tighter">{{ $message }}</span> @enderror
                </div>

                @if($editingType === 'item')
                    <div>
                        <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2 ml-1">Associated Brand</label>
                        <select wire:model="formBrandId" class="w-full px-5 py-4 border border-gray-200 rounded-[1.25rem] bg-gray-50 focus:bg-white focus:ring-4 focus:ring-blue-100 focus:border-blue-400 transition-all outline-none text-sm font-bold text-gray-900">
                            <option value="">No Brand Linked</option>
                            @foreach($brands as $brand)
                                <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                            @endforeach
                        </select>
                    </div>
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
                @elseif($editingType === 'fault')
                    <div>
                        <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2 ml-1">Service Base Price</label>
                        <div class="relative">
                            <span class="absolute left-5 top-1/2 -translate-y-1/2 text-gray-400 font-bold">₱</span>
                            <input type="number" step="0.01" wire:model="formBasePrice" class="w-full pl-10 pr-5 py-4 border border-gray-200 rounded-2xl bg-gray-50 focus:bg-white focus:ring-4 focus:ring-blue-100 focus:border-blue-400 transition-all outline-none text-sm font-bold text-gray-900">
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
</div>

</div>

</div>

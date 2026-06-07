<div class="w-full" x-data="{ brandModal: @entangle('showBrandModal'), modelModal: @entangle('showModelModal') }">
    
    <!-- Title Header -->
    <div class="mb-8 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <h1 class="text-3xl font-bold text-gray-900 tracking-tight">Brands & Models</h1>
            <p class="text-gray-500 mt-1">Manage manufacturer brands and exact device models supported for repair services.</p>
        </div>
    </div>

    <!-- Grid Split Screens -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
        
        <!-- ==================== LEFT COLUMN: BRANDS ==================== -->
        <div class="lg:col-span-5 bg-white rounded-3xl border border-gray-200 shadow-sm overflow-hidden flex flex-col">
            <div class="px-6 py-5 border-b border-gray-100 bg-gray-50/50 flex justify-between items-center">
                <div>
                    <h2 class="text-lg font-bold text-gray-900">Brands</h2>
                    <p class="text-xs text-gray-400 mt-0.5">Device Manufacturers</p>
                </div>
                <button wire:click="$set('showBrandModal', true)" class="bg-gray-900 hover:bg-blue-600 text-white text-xs font-bold px-4 py-2.5 rounded-xl flex items-center gap-1.5 shadow-sm transition-all border-none outline-none cursor-pointer">
                    <span class="material-symbols-outlined text-[16px]">add</span>
                    New Brand
                </button>
            </div>

            <div class="p-6 space-y-4">
                <!-- Search bar for Brands -->
                <div class="relative w-full h-11">
                    <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 text-lg">search</span>
                    <input type="text" wire:model.live="brandSearch" placeholder="Search brands..." class="w-full h-full pl-11 pr-4 bg-white border border-gray-200 rounded-xl focus:outline-none focus:ring-4 focus:ring-blue-100 focus:border-blue-400 transition-all text-xs font-bold text-gray-900 shadow-sm placeholder:text-gray-400">
                </div>

                @if (session()->has('brand_message'))
                    <div class="p-3.5 rounded-xl bg-green-50 border border-green-200 text-green-700 font-bold text-xs flex items-center gap-2">
                        <span class="material-symbols-outlined text-[18px]">check_circle</span>
                        {{ session('brand_message') }}
                    </div>
                @endif

                <!-- Brands Table/List -->
                <div class="border border-gray-100 rounded-2xl overflow-hidden shadow-sm">
                    <table class="w-full border-collapse">
                        <thead>
                            <tr class="bg-gray-50/70 border-b border-gray-100">
                                <th class="px-4 py-3 text-left text-[9px] font-black text-gray-400 uppercase tracking-widest">Brand Name</th>
                                <th class="px-4 py-3 text-center text-[9px] font-black text-gray-400 uppercase tracking-widest w-24">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($brands as $brand)
                                <tr class="hover:bg-gray-50/50 transition-all group">
                                    <td class="px-4 py-3">
                                        <div class="flex items-center gap-2.5">
                                            <span class="material-symbols-outlined text-gray-400 text-base">branding_watermark</span>
                                            <span class="font-bold text-gray-900 text-sm leading-snug">{{ $brand->name }}</span>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3 text-center">
                                        <div class="flex items-center justify-center gap-1 opacity-0 group-hover:opacity-100 transition-opacity">
                                            <button wire:click="editBrand({{ $brand->id }})" class="p-1.5 text-blue-600 hover:bg-blue-50 rounded-lg transition-all border-none bg-transparent cursor-pointer">
                                                <span class="material-symbols-outlined text-base">edit</span>
                                            </button>
                                            <button wire:click="confirmDeleteBrand({{ $brand->id }})" class="p-1.5 text-red-600 hover:bg-red-50 rounded-lg transition-all border-none bg-transparent cursor-pointer">
                                                <span class="material-symbols-outlined text-base">delete</span>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="2" class="px-4 py-8 text-center text-gray-400 italic text-xs">No brands found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    
                    @if($brands->hasPages())
                        <div class="px-4 py-3 bg-gray-50 border-t border-gray-100">
                            {{ $brands->links(data: ['scrollTo' => false]) }}
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- ==================== RIGHT COLUMN: MODELS ==================== -->
        <div class="lg:col-span-7 bg-white rounded-3xl border border-gray-200 shadow-sm overflow-hidden flex flex-col">
            <div class="px-6 py-5 border-b border-gray-100 bg-gray-50/50 flex justify-between items-center">
                <div>
                    <h2 class="text-lg font-bold text-gray-900">Exact Models</h2>
                    <p class="text-xs text-gray-400 mt-0.5">Device Model Directory</p>
                </div>
                <button wire:click="$set('showModelModal', true)" class="bg-gray-900 hover:bg-blue-600 text-white text-xs font-bold px-4 py-2.5 rounded-xl flex items-center gap-1.5 shadow-sm transition-all border-none outline-none cursor-pointer">
                    <span class="material-symbols-outlined text-[16px]">add</span>
                    New Model
                </button>
            </div>

            <div class="p-6 space-y-4">
                <!-- Search & Filter Controls -->
                <div class="flex flex-col sm:flex-row gap-3 w-full">
                    <div class="relative flex-1 h-11">
                        <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 text-lg">search</span>
                        <input type="text" wire:model.live="modelSearch" placeholder="Search models..." class="w-full h-full pl-11 pr-4 bg-white border border-gray-200 rounded-xl focus:outline-none focus:ring-4 focus:ring-blue-100 focus:border-blue-400 transition-all text-xs font-bold text-gray-900 shadow-sm placeholder:text-gray-400">
                    </div>
                    <div class="relative w-full sm:w-48 h-11">
                        <select wire:model.live="filterBrandId" class="w-full h-full pl-4 pr-10 bg-white border border-gray-200 rounded-xl focus:outline-none focus:ring-4 focus:ring-blue-100 focus:border-blue-400 transition-all text-xs font-bold text-gray-900 shadow-sm appearance-none cursor-pointer">
                            <option value="">All Brands</option>
                            @foreach($allBrands as $b)
                                <option value="{{ $b->id }}">{{ $b->name }}</option>
                            @endforeach
                        </select>
                        <span class="material-symbols-outlined absolute right-3.5 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none text-base">unfold_more</span>
                    </div>
                </div>

                @if (session()->has('model_message'))
                    <div class="p-3.5 rounded-xl bg-green-50 border border-green-200 text-green-700 font-bold text-xs flex items-center gap-2">
                        <span class="material-symbols-outlined text-[18px]">check_circle</span>
                        {{ session('model_message') }}
                    </div>
                @endif

                <!-- Models Table -->
                <div class="border border-gray-100 rounded-2xl overflow-hidden shadow-sm">
                    <table class="w-full border-collapse">
                        <thead>
                            <tr class="bg-gray-50/70 border-b border-gray-100">
                                <th class="px-4 py-3 text-left text-[9px] font-black text-gray-400 uppercase tracking-widest">Model Name</th>
                                <th class="px-4 py-3 text-left text-[9px] font-black text-gray-400 uppercase tracking-widest w-36">Brand</th>
                                <th class="px-4 py-3 text-center text-[9px] font-black text-gray-400 uppercase tracking-widest w-24">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($models as $model)
                                <tr class="hover:bg-gray-50/50 transition-all group">
                                    <td class="px-4 py-3">
                                        <div class="flex items-center gap-2.5">
                                            <span class="material-symbols-outlined text-gray-400 text-base">devices</span>
                                            <span class="font-bold text-gray-900 text-sm leading-snug">{{ $model->name }}</span>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3">
                                        <span class="px-2.5 py-0.5 bg-gray-100 text-gray-600 rounded-md text-[10px] font-black uppercase tracking-wider">{{ $model->brand->name ?? 'N/A' }}</span>
                                    </td>
                                    <td class="px-4 py-3 text-center">
                                        <div class="flex items-center justify-center gap-1 opacity-0 group-hover:opacity-100 transition-opacity">
                                            <button wire:click="editModel({{ $model->id }})" class="p-1.5 text-blue-600 hover:bg-blue-50 rounded-lg transition-all border-none bg-transparent cursor-pointer">
                                                <span class="material-symbols-outlined text-base">edit</span>
                                            </button>
                                            <button wire:click="confirmDeleteModel({{ $model->id }})" class="p-1.5 text-red-600 hover:bg-red-50 rounded-lg transition-all border-none bg-transparent cursor-pointer">
                                                <span class="material-symbols-outlined text-base">delete</span>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="px-4 py-8 text-center text-gray-400 italic text-xs">No models found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    
                    @if($models->hasPages())
                        <div class="px-4 py-3 bg-gray-50 border-t border-gray-100">
                            {{ $models->links(data: ['scrollTo' => false]) }}
                        </div>
                    @endif
                </div>
            </div>
        </div>

    </div>

    <!-- ==================== MODALS & POPUPS ==================== -->
    
    <!-- 1. Brand Creation/Edit Modal -->
    <div x-show="brandModal" class="fixed inset-0 z-50 overflow-y-auto px-4 py-6 sm:px-0 flex items-center justify-center" x-cloak>
        <div class="fixed inset-0 bg-gray-900/60 backdrop-blur-md" @click="$wire.resetBrandFields()"></div>
        <div x-show="brandModal" 
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
                        <span class="material-symbols-outlined text-[28px]">{{ $editingBrandId ? 'edit_note' : 'add_circle' }}</span>
                    </div>
                    <div>
                        <h2 class="text-2xl font-black text-gray-900 tracking-tight">{{ $editingBrandId ? 'Edit' : 'Add' }} Brand</h2>
                        <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mt-1">Manufacturer Profile</p>
                    </div>
                </div>
                <button type="button" wire:click="resetBrandFields" class="w-10 h-10 flex items-center justify-center text-gray-400 hover:text-gray-900 hover:bg-gray-100 rounded-full transition-all border-none bg-transparent cursor-pointer">
                    <span class="material-symbols-outlined text-[24px]">close</span>
                </button>
            </div>

            <form wire:submit.prevent="saveBrand" class="flex flex-col">
                <div class="p-10 space-y-6">
                    <div>
                        <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2 ml-1">Brand Name</label>
                        <input type="text" wire:model="brandName" placeholder="e.g. Apple, Samsung, Google..." class="w-full px-5 py-4 border border-gray-200 rounded-[1.25rem] bg-gray-50 focus:bg-white focus:ring-4 focus:ring-blue-100 focus:border-blue-400 transition-all outline-none text-sm font-bold text-gray-900" required>
                        @error('brandName') <span class="text-xs text-red-500 mt-1 block ml-1">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="px-10 py-6 border-t border-gray-100 bg-gray-50/50 flex justify-end gap-3 rounded-b-[2.5rem]">
                    <button type="button" wire:click="resetBrandFields" class="px-6 py-3.5 border border-gray-200 text-gray-700 font-bold rounded-xl hover:bg-gray-100 transition-all text-xs bg-white cursor-pointer shadow-sm">Cancel</button>
                    <button type="submit" class="px-8 py-3.5 bg-gray-900 hover:bg-blue-600 text-white font-bold rounded-xl transition-all shadow-md active:scale-95 text-xs border-none cursor-pointer">
                        {{ $editingBrandId ? 'Save Changes' : 'Create Brand' }}
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- 2. Model Creation/Edit Modal -->
    <div x-show="modelModal" class="fixed inset-0 z-50 overflow-y-auto px-4 py-6 sm:px-0 flex items-center justify-center" x-cloak>
        <div class="fixed inset-0 bg-gray-900/60 backdrop-blur-md" @click="$wire.resetModelFields()"></div>
        <div x-show="modelModal" 
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
                        <span class="material-symbols-outlined text-[28px]">{{ $editingModelId ? 'devices' : 'add_to_queue' }}</span>
                    </div>
                    <div>
                        <h2 class="text-2xl font-black text-gray-900 tracking-tight">{{ $editingModelId ? 'Edit' : 'Add' }} Model</h2>
                        <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mt-1">Device Profile</p>
                    </div>
                </div>
                <button type="button" wire:click="resetModelFields" class="w-10 h-10 flex items-center justify-center text-gray-400 hover:text-gray-900 hover:bg-gray-100 rounded-full transition-all border-none bg-transparent cursor-pointer">
                    <span class="material-symbols-outlined text-[24px]">close</span>
                </button>
            </div>

            <form wire:submit.prevent="saveModel" class="flex flex-col">
                <div class="p-10 space-y-6">
                    <div>
                        <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2 ml-1">Associated Brand</label>
                        <div class="relative w-full">
                            <select wire:model="modelBrandId" class="w-full pl-4 pr-10 py-3.5 border border-gray-200 rounded-[1.25rem] bg-gray-50 focus:bg-white focus:ring-4 focus:ring-blue-100 focus:border-blue-400 transition-all text-sm font-bold text-gray-900 appearance-none cursor-pointer" required>
                                <option value="" disabled selected>Select Parent Brand...</option>
                                @foreach($allBrands as $b)
                                    <option value="{{ $b->id }}">{{ $b->name }}</option>
                                @endforeach
                            </select>
                            <span class="material-symbols-outlined absolute right-3.5 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none text-[20px]">unfold_more</span>
                        </div>
                        @error('modelBrandId') <span class="text-xs text-red-500 mt-1 block ml-1">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2 ml-1">Model Name</label>
                        <input type="text" wire:model="modelName" placeholder="e.g. iPhone 13 Pro Max, Galaxy S22..." class="w-full px-5 py-4 border border-gray-200 rounded-[1.25rem] bg-gray-50 focus:bg-white focus:ring-4 focus:ring-blue-100 focus:border-blue-400 transition-all outline-none text-sm font-bold text-gray-900" required>
                        @error('modelName') <span class="text-xs text-red-500 mt-1 block ml-1">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="px-10 py-6 border-t border-gray-100 bg-gray-50/50 flex justify-end gap-3 rounded-b-[2.5rem]">
                    <button type="button" wire:click="resetModelFields" class="px-6 py-3.5 border border-gray-200 text-gray-700 font-bold rounded-xl hover:bg-gray-100 transition-all text-xs bg-white cursor-pointer shadow-sm">Cancel</button>
                    <button type="submit" class="px-8 py-3.5 bg-gray-900 hover:bg-blue-600 text-white font-bold rounded-xl transition-all shadow-md active:scale-95 text-xs border-none cursor-pointer">
                        {{ $editingModelId ? 'Save Changes' : 'Create Model' }}
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- 3. Confirm Delete Brand Modal -->
    @if($confirmingBrandDeletionId)
    <div class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-gray-900/60 backdrop-blur-md">
        <div class="bg-white rounded-[2rem] p-8 max-w-sm w-full text-center shadow-2xl border border-gray-100 animate-scale-in">
            <div class="w-16 h-16 bg-red-50 text-red-500 rounded-full flex items-center justify-center mx-auto mb-5">
                <span class="material-symbols-outlined text-[36px]">delete_forever</span>
            </div>
            <h3 class="text-xl font-black text-gray-900 mb-2">Remove Brand?</h3>
            <p class="text-sm text-gray-500 mb-8 leading-relaxed">This action will delete the Brand. Exact models linked to this brand might lose their parent reference.</p>
            <div class="flex gap-3 justify-center">
                <button wire:click="resetBrandFields" class="px-6 py-3 border border-gray-200 text-gray-700 font-bold rounded-xl hover:bg-gray-100 transition-all text-xs bg-white cursor-pointer shadow-sm">Cancel</button>
                <button wire:click="deleteBrand" class="px-6 py-3 bg-red-600 hover:bg-red-700 text-white font-bold rounded-xl transition-all text-xs border-none cursor-pointer shadow-md">Delete</button>
            </div>
        </div>
    </div>
    @endif

    <!-- 4. Confirm Delete Model Modal -->
    @if($confirmingModelDeletionId)
    <div class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-gray-900/60 backdrop-blur-md">
        <div class="bg-white rounded-[2rem] p-8 max-w-sm w-full text-center shadow-2xl border border-gray-100 animate-scale-in">
            <div class="w-16 h-16 bg-red-50 text-red-500 rounded-full flex items-center justify-center mx-auto mb-5">
                <span class="material-symbols-outlined text-[36px]">delete_forever</span>
            </div>
            <h3 class="text-xl font-black text-gray-900 mb-2">Remove Device Model?</h3>
            <p class="text-sm text-gray-500 mb-8 leading-relaxed">This action cannot be undone. Users will no longer see this model in booking dropdown options.</p>
            <div class="flex gap-3 justify-center">
                <button wire:click="resetModelFields" class="px-6 py-3 border border-gray-200 text-gray-700 font-bold rounded-xl hover:bg-gray-100 transition-all text-xs bg-white cursor-pointer shadow-sm">Cancel</button>
                <button wire:click="deleteModel" class="px-6 py-3 bg-red-600 hover:bg-red-700 text-white font-bold rounded-xl transition-all text-xs border-none cursor-pointer shadow-md">Delete</button>
            </div>
        </div>
    </div>
    @endif

</div>

<div class="w-full" x-data="{ openModal: @entangle('showEditModal') }">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900 tracking-tight">Services</h1>
        <p class="text-gray-500 mt-1">Manage Repair Services, Diagnostic Charges, and Base Pricing.</p>
    </div>

    <!-- Stats Summary -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
        <div class="bg-white p-6 rounded-[1.25rem] border border-gray-200 shadow-sm flex items-center justify-between">
            <div>
                <p class="text-xs font-bold text-gray-500 uppercase tracking-wider">Total Services Offered</p>
                <h3 class="text-3xl font-extrabold text-gray-900 mt-1">{{ $totalServices }}</h3>
            </div>
            <div class="w-12 h-12 bg-blue-50 rounded-2xl flex items-center justify-center">
                <span class="material-symbols-outlined text-blue-600 text-2xl">handyman</span>
            </div>
        </div>
        <div class="bg-white p-6 rounded-[1.25rem] border border-gray-200 shadow-sm flex items-center justify-between">
            <div>
                <p class="text-xs font-bold text-gray-500 uppercase tracking-wider">Average Service Cost</p>
                <h3 class="text-3xl font-extrabold text-green-600 mt-1">₱{{ number_format($avgPrice, 2) }}</h3>
            </div>
            <div class="w-12 h-12 bg-green-50 rounded-2xl flex items-center justify-center">
                <span class="material-symbols-outlined text-green-600 text-2xl">payments</span>
            </div>
        </div>
        <div class="bg-white p-6 rounded-[1.25rem] border border-gray-200 shadow-sm flex items-center justify-between">
            <div>
                <p class="text-xs font-bold text-gray-500 uppercase tracking-wider">Overall Service Cost</p>
                <h3 class="text-3xl font-extrabold text-indigo-600 mt-1">₱{{ number_format($overallPrice, 2) }}</h3>
            </div>
            <div class="w-12 h-12 bg-indigo-50 rounded-2xl flex items-center justify-center">
                <span class="material-symbols-outlined text-indigo-600 text-2xl">account_balance_wallet</span>
            </div>
        </div>
    </div>

    @if (session()->has('message'))
        <div class="mb-6 p-4 rounded-xl bg-green-50 border border-green-200 text-green-700 font-bold text-sm flex items-center gap-2">
            <span class="material-symbols-outlined text-[20px]">check_circle</span>
            {{ session('message') }}
        </div>
    @endif

    <!-- Search & Add - Horizontal Layout -->
    <div class="flex flex-col md:flex-row items-center gap-4 mb-6 w-full">
        <!-- Search Input -->
        <div class="relative flex-1 w-full h-[60px]">
            <span class="material-symbols-outlined absolute left-5 top-1/2 -translate-y-1/2 text-gray-400 text-[24px]">search</span>
            <input type="text" wire:model.live="search" placeholder="Search services..." class="w-full h-full pl-14 pr-6 bg-white border border-gray-200 rounded-[1.25rem] focus:outline-none focus:ring-4 focus:ring-blue-100 focus:border-blue-400 transition-all text-sm font-black text-gray-900 shadow-sm placeholder:text-gray-400 placeholder:font-bold">
        </div>
        
        <!-- Sorting Dropdown -->
        <div class="relative w-full md:w-64 h-[60px]">
            <select wire:model.live="sortOrder" class="w-full h-full pl-6 pr-12 bg-white border border-gray-200 rounded-[1.25rem] focus:outline-none focus:ring-4 focus:ring-blue-100 focus:border-blue-400 transition-all text-sm font-black text-gray-900 shadow-sm appearance-none cursor-pointer">
                <option value="latest">Sort by: Latest</option>
                <option value="alpha_asc">Alphabetical (A - Z)</option>
                <option value="alpha_desc">Alphabetical (Z - A)</option>
                <option value="price_asc">Price: Low to High</option>
                <option value="price_desc">Price: High to Low</option>
            </select>
            <span class="material-symbols-outlined absolute right-5 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none">unfold_more</span>
        </div>

        <!-- Add Button -->
        <button wire:click="editRecord(0)" 
            class="w-full md:w-auto bg-gray-900 text-white px-10 h-[60px] rounded-[1.25rem] font-black text-sm flex items-center justify-center gap-3 hover:bg-blue-600 transition-all shadow-xl hover:shadow-blue-100 active:scale-95 group whitespace-nowrap shrink-0">
            <span class="material-symbols-outlined text-[24px] group-hover:rotate-90 transition-transform">add</span>
            Add New Service
        </button>
    </div>

    <!-- Records Table -->
    <div class="bg-white rounded-[1.25rem] border border-gray-200 shadow-sm overflow-hidden">
        <table class="w-full">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-100">
                    <th class="px-6 py-4 text-left text-[10px] font-black text-gray-400 uppercase tracking-widest">Service Information</th>
                    <th class="px-6 py-4 text-left text-[10px] font-black text-gray-400 uppercase tracking-widest w-48">Category</th>
                    <th class="px-6 py-4 text-right text-[10px] font-black text-gray-400 uppercase tracking-widest w-48">Base Price</th>
                    <th class="px-6 py-4 text-center text-[10px] font-black text-gray-400 uppercase tracking-widest w-36">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($records as $record)
                    <tr class="hover:bg-gray-50 transition-all group">
                        <td class="px-6 py-4 flex items-center gap-4">
                            @if ($record->image_path)
                                <img src="{{ asset($record->image_path) }}" 
                                    @click="$dispatch('open-lightbox', '{{ asset($record->image_path) }}')"
                                    class="w-12 h-12 rounded-xl object-cover border border-gray-100 shadow-sm shrink-0 cursor-zoom-in hover:scale-110 active:scale-95 transition-all">
                            @else
                                <div class="w-12 h-12 bg-blue-50 rounded-xl flex items-center justify-center shrink-0">
                                    <span class="material-symbols-outlined text-blue-600 text-xl">handyman</span>
                                </div>
                            @endif
                            <div class="flex flex-col">
                                <span class="font-bold text-gray-900 leading-snug">{{ $record->name }}</span>
                                @if ($record->description)
                                    <span class="text-xs text-gray-400 font-medium line-clamp-1 mt-0.5">{{ $record->description }}</span>
                                @else
                                    <span class="text-xs text-gray-300 font-medium italic mt-0.5">No details provided</span>
                                @endif
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            @php
                                $categorySlug = $record->category ?: 'hardware';
                                $categoryName = match($categorySlug) {
                                    'screen' => 'Screen & Display',
                                    'power' => 'Power & Charging',
                                    'audio' => 'Audio & Sound',
                                    'software' => 'Software & Systems',
                                    default => 'Hardware & Modules',
                                };
                            @endphp
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-wider
                                @if($categorySlug === 'screen') bg-blue-50 text-blue-700 border border-blue-200
                                @elseif($categorySlug === 'power') bg-amber-50 text-amber-700 border border-amber-200
                                @elseif($categorySlug === 'audio') bg-emerald-50 text-emerald-700 border border-emerald-200
                                @elseif($categorySlug === 'software') bg-purple-50 text-purple-700 border border-purple-200
                                @else bg-indigo-50 text-indigo-700 border border-indigo-200
                                @endif shadow-sm bg-white">
                                <span class="w-1.5 h-1.5 rounded-full 
                                    @if($categorySlug === 'screen') bg-blue-500
                                    @elseif($categorySlug === 'power') bg-amber-500
                                    @elseif($categorySlug === 'audio') bg-emerald-500
                                    @elseif($categorySlug === 'software') bg-purple-500
                                    @else bg-indigo-500
                                    @endif"></span>
                                {{ $categoryName }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right text-blue-600 font-black">
                            ₱{{ number_format($record->base_price, 2) }}
                        </td>
                        <td class="px-6 py-4 text-center flex items-center justify-center space-x-2">
                            <button wire:click="editRecord({{ $record->id }})" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-all opacity-0 group-hover:opacity-100">
                                <span class="material-symbols-outlined text-[20px]">edit</span>
                            </button>
                            <button wire:confirm="Are you sure you want to delete this service?" wire:click="deleteRecord({{ $record->id }})" class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-all opacity-0 group-hover:opacity-100">
                                <span class="material-symbols-outlined text-[20px]">delete</span>
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-10 text-center text-gray-400 italic text-sm">No services found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Edit Modal -->
    <div x-show="openModal" 
        class="fixed inset-0 z-50 overflow-y-auto px-4 py-6 sm:px-0 flex items-center justify-center" 
        x-cloak>
        
        <!-- Backdrop -->
        <div x-show="openModal"
            x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 bg-gray-900/60 backdrop-blur-md" 
            @click="openModal = false"></div>

        <!-- Modal Container -->
        <div x-show="openModal"
            x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            class="relative bg-white rounded-[2.5rem] shadow-2xl w-full max-w-md transform transition-all overflow-hidden flex flex-col max-h-[85vh]">
            
            <!-- Fixed Header -->
            <div class="flex justify-between items-center px-10 pt-10 pb-6 shrink-0 border-b border-gray-100 bg-white">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-blue-50 rounded-2xl flex items-center justify-center">
                        <span class="material-symbols-outlined text-blue-600 text-[28px]">{{ $editingId ? 'edit' : 'add_circle' }}</span>
                    </div>
                    <div>
                        <h2 class="text-2xl font-black text-gray-900 tracking-tight leading-none">{{ $editingId ? 'Edit' : 'Add' }} Service</h2>
                        <p class="text-xs font-bold text-gray-400 mt-1 uppercase tracking-widest">Service Catalog</p>
                    </div>
                </div>
                <button @click="openModal = false" class="w-10 h-10 flex items-center justify-center text-gray-400 hover:text-gray-900 hover:bg-gray-100 rounded-full transition-all">
                    <span class="material-symbols-outlined text-[24px]">close</span>
                </button>
            </div>

            <!-- Form with scrollable middle area -->
            <form wire:submit="saveRecord" class="flex flex-col flex-1 overflow-hidden">
                <!-- Scrollable Body -->
                <div class="flex-1 overflow-y-auto px-10 py-6 space-y-6 [&::-webkit-scrollbar]:w-1.5 [&::-webkit-scrollbar-thumb]:bg-gray-200 [&::-webkit-scrollbar-thumb]:rounded-full">
                    <!-- Service Name -->
                    <div>
                        <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2 ml-1">Service Name</label>
                        <input type="text" wire:model="formName" placeholder="e.g. Screen Replacement..." class="w-full px-5 py-4 border border-gray-200 rounded-[1.25rem] bg-gray-50 focus:bg-white focus:ring-4 focus:ring-blue-100 focus:border-blue-400 transition-all outline-none text-sm font-bold text-gray-900">
                        @error('formName') <span class="text-[10px] text-red-500 mt-2 font-bold block ml-1 uppercase tracking-tighter">{{ $message }}</span> @enderror
                    </div>

                    <!-- Service Category -->
                    <div>
                        <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2 ml-1">Service Category</label>
                        <div class="relative w-full">
                            <select wire:model="formCategory" class="w-full pl-6 pr-12 py-4 bg-gray-50 border border-gray-200 rounded-[1.25rem] focus:bg-white focus:ring-4 focus:ring-blue-100 focus:border-blue-400 transition-all text-sm font-bold text-gray-900 outline-none appearance-none cursor-pointer">
                                <option value="screen">Screen & Display</option>
                                <option value="power">Power & Battery</option>
                                <option value="audio">Audio & Sound</option>
                                <option value="software">Software & OS</option>
                                <option value="hardware">Hardware & Modules</option>
                            </select>
                            <span class="material-symbols-outlined absolute right-5 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none">unfold_more</span>
                        </div>
                        @error('formCategory') <span class="text-[10px] text-red-500 mt-2 font-bold block ml-1 uppercase tracking-tighter">{{ $message }}</span> @enderror
                    </div>

                    <!-- Service Description (Information) -->
                    <div>
                        <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2 ml-1">Service Information</label>
                        <textarea wire:model="formDescription" placeholder="Enter details about this service..." rows="3" class="w-full px-5 py-4 border border-gray-200 rounded-[1.25rem] bg-gray-50 focus:bg-white focus:ring-4 focus:ring-blue-100 focus:border-blue-400 transition-all outline-none text-sm font-bold text-gray-900 resize-none"></textarea>
                        @error('formDescription') <span class="text-[10px] text-red-500 mt-2 font-bold block ml-1 uppercase tracking-tighter">{{ $message }}</span> @enderror
                    </div>

                    <!-- Service Picture -->
                    <div>
                        <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2 ml-1">Service Picture</label>
                        <div class="flex items-center gap-4 mt-2">
                            @if ($formImage)
                                <img src="{{ $formImage->temporaryUrl() }}" 
                                    @click="$dispatch('open-lightbox', '{{ $formImage->temporaryUrl() }}')"
                                    class="w-16 h-16 rounded-2xl object-cover border border-gray-200 shadow-sm shrink-0 cursor-zoom-in hover:scale-110 active:scale-95 transition-all">
                            @elseif ($currentImage)
                                <img src="{{ asset($currentImage) }}" 
                                    @click="$dispatch('open-lightbox', '{{ asset($currentImage) }}')"
                                    class="w-16 h-16 rounded-2xl object-cover border border-gray-200 shadow-sm shrink-0 cursor-zoom-in hover:scale-110 active:scale-95 transition-all">
                            @else
                                <div class="w-16 h-16 bg-gray-50 rounded-2xl border border-dashed border-gray-300 flex items-center justify-center shrink-0">
                                    <span class="material-symbols-outlined text-gray-400 text-2xl">image</span>
                                </div>
                            @endif
                            
                            <div class="relative">
                                <input type="file" wire:model="formImage" id="service-image" class="hidden" accept="image/*">
                                <label for="service-image" class="inline-flex items-center justify-center gap-2 px-5 py-3.5 bg-gray-900 text-white hover:bg-gray-800 active:scale-95 transition-all cursor-pointer shadow-md rounded-xl text-xs font-bold whitespace-nowrap">
                                    <span class="material-symbols-outlined text-[18px]">cloud_upload</span>
                                    Choose Picture
                                </label>
                            </div>
                        </div>
                        <p class="text-[9px] text-gray-400 font-bold uppercase tracking-widest mt-2 ml-20">PNG, JPG, or WEBP up to 2MB</p>
                        @error('formImage') <span class="text-[10px] text-red-500 mt-2 font-bold block ml-1 uppercase tracking-tighter">{{ $message }}</span> @enderror
                    </div>

                    <!-- Additional Service Gallery (Up to 5 images) -->
                    <div>
                        <div class="flex items-center mb-2">
                            <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Additional Gallery (Up to 5 pictures)</label>
                        </div>
                        <input type="file" wire:model="formGalleryImages" id="gallery-uploads" class="hidden" accept="image/*" multiple>
                        
                        <div class="grid grid-cols-5 gap-3 mt-2">
                            <!-- Render Current Gallery -->
                            @foreach($currentGallery as $index => $path)
                                <div class="relative group aspect-square bg-white border border-gray-100 rounded-2xl overflow-hidden shadow-sm flex items-center justify-center">
                                    <img src="{{ asset($path) }}" 
                                         @click="$dispatch('open-lightbox', '{{ asset($path) }}')"
                                         class="w-full h-full object-cover cursor-zoom-in group-hover:scale-105 transition-transform duration-300">
                                    
                                    <!-- Delete Button -->
                                    <button type="button" 
                                            wire:click="removeGalleryImage({{ $index }}, true)"
                                            class="absolute inset-0 !bg-transparent !p-0 !border-0 !shadow-none flex items-center justify-center text-red-500 hover:text-red-600 active:scale-95 opacity-0 group-hover:opacity-100 transition-opacity z-10 w-full h-full">
                                        <span class="material-symbols-outlined text-[24px] font-black">close</span>
                                    </button>
                                </div>
                            @endforeach

                            <!-- Render Temp Uploads -->
                            @foreach($formGalleryImages as $index => $img)
                                @if($img && method_exists($img, 'temporaryUrl'))
                                    <div class="relative group aspect-square bg-white border border-gray-100 rounded-2xl overflow-hidden shadow-sm flex items-center justify-center">
                                        <img src="{{ $img->temporaryUrl() }}" 
                                             @click="$dispatch('open-lightbox', '{{ $img->temporaryUrl() }}')"
                                             class="w-full h-full object-cover cursor-zoom-in group-hover:scale-105 transition-transform duration-300">
                                        
                                        <!-- Delete Button -->
                                        <button type="button" 
                                                wire:click="removeGalleryImage({{ $index }}, false)"
                                                class="absolute inset-0 !bg-transparent !p-0 !border-0 !shadow-none flex items-center justify-center text-red-500 hover:text-red-600 active:scale-95 opacity-0 group-hover:opacity-100 transition-opacity z-10 w-full h-full">
                                            <span class="material-symbols-outlined text-[24px] font-black">close</span>
                                        </button>
                                    </div>
                                @endif
                            @endforeach

                            <!-- Remaining Empty Slots -->
                            @for($i = (count($currentGallery) + count($formGalleryImages)); $i < 5; $i++)
                                <label for="gallery-uploads" class="aspect-square bg-gray-50 hover:bg-gray-100 border border-dashed border-gray-200 hover:border-blue-300 rounded-2xl flex flex-col items-center justify-center text-gray-400 hover:text-blue-500 cursor-pointer active:scale-95 transition-all">
                                    <span class="material-symbols-outlined text-lg">add_a_photo</span>
                                    <span class="text-[8px] font-black uppercase mt-1">Slot {{ $i + 1 }}</span>
                                </label>
                            @endfor
                        </div>
                        @error('formGalleryImages.*') <span class="text-[10px] text-red-500 mt-2 font-bold block ml-1 uppercase tracking-tighter">{{ $message }}</span> @enderror
                    </div>

                    <!-- Base Price -->
                    <div>
                        <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2 ml-1">Service Base Price</label>
                        <div class="relative">
                            <span class="absolute left-5 top-1/2 -translate-y-1/2 text-gray-400 font-bold">₱</span>
                            <input type="number" step="0.01" wire:model="formBasePrice" class="w-full pl-10 pr-5 py-4 border border-gray-200 rounded-[1.25rem] bg-gray-50 focus:bg-white focus:ring-4 focus:ring-blue-100 focus:border-blue-400 transition-all outline-none text-sm font-bold text-gray-900">
                        </div>
                        @error('formBasePrice') <span class="text-[10px] text-red-500 mt-2 font-bold block ml-1 uppercase tracking-tighter">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- Fixed Footer -->
                <div class="px-10 py-6 border-t border-gray-100 bg-gray-50/50 shrink-0">
                    <button type="submit" class="w-full bg-gray-900 text-white py-5 rounded-2xl font-black text-lg hover:bg-blue-600 transition-all shadow-xl shadow-gray-200 active:scale-95 flex items-center justify-center gap-3 group">
                        <span class="material-symbols-outlined text-[20px] group-hover:scale-125 transition-transform">{{ $editingId ? 'save' : 'add_task' }}</span>
                        {{ $editingId ? 'Save Changes' : 'Create Service' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
    <!-- Image Lightbox Modal -->
    <div x-data="{ openLightbox: false, imageUrl: '' }" 
         @keydown.escape.window="openLightbox = false"
         @open-lightbox.window="imageUrl = $event.detail; openLightbox = true">
         
         <div x-show="openLightbox" 
              class="fixed inset-0 z-[100] flex items-center justify-center p-4 sm:p-6" 
              x-cloak>
              
              <!-- Backdrop -->
              <div x-show="openLightbox"
                   x-transition:enter="ease-out duration-300"
                   x-transition:enter-start="opacity-0"
                   x-transition:enter-end="opacity-100"
                   x-transition:leave="ease-in duration-200"
                   x-transition:leave-start="opacity-100"
                   x-transition:leave-end="opacity-0"
                   class="fixed inset-0 bg-gray-950/80 backdrop-blur-xl" 
                   @click="openLightbox = false"></div>

              <!-- Content Card -->
              <div x-show="openLightbox"
                   x-transition:enter="ease-out duration-300"
                   x-transition:enter-start="opacity-0 scale-95"
                   x-transition:enter-end="opacity-100 scale-100"
                   x-transition:leave="ease-in duration-200"
                   x-transition:leave-start="opacity-100 scale-100"
                   x-transition:leave-end="opacity-0 scale-95"
                   class="relative bg-white/10 backdrop-blur-md rounded-[2.5rem] overflow-hidden max-w-2xl w-full p-4 border border-white/20 shadow-2xl flex flex-col items-center justify-center">
                   
                   <!-- Close Button -->
                   <button @click="openLightbox = false" class="absolute top-6 right-6 text-red-500 hover:text-red-600 active:scale-90 transition-all z-10">
                       <span class="material-symbols-outlined text-[36px] font-bold">close</span>
                   </button>

                   <!-- Image -->
                   <img :src="imageUrl" class="max-w-full max-h-[75vh] rounded-[2rem] object-contain shadow-2xl">
              </div>
         </div>
    </div>
</div>

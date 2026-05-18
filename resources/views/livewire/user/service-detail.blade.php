@php
    $badgeClass = match($service->category) {
        'screen' => 'bg-blue-50 text-blue-600 border border-blue-100',
        'power' => 'bg-amber-50 text-amber-600 border border-amber-100',
        'audio' => 'bg-emerald-50 text-emerald-600 border border-emerald-100',
        'software' => 'bg-purple-50 text-purple-600 border border-purple-100',
        default => 'bg-indigo-50 text-indigo-600 border border-indigo-100',
    };
    $categoryName = match($service->category) {
        'screen' => 'Screen & Display',
        'power' => 'Power & Charging',
        'audio' => 'Audio & Sound',
        'software' => 'Software & Systems',
        default => 'Hardware & Modules',
    };
@endphp

<div class="w-full" x-data="{ openLightbox: false, activeImage: '{{ asset($service->image_path) }}' }">
    <!-- Navigation & Header Row -->
    <div class="mb-8 flex flex-col md:flex-row md:items-center justify-between gap-6">
        <div>
            <nav class="flex items-center gap-2 text-[10px] font-black text-gray-400 uppercase tracking-widest mb-3">
                <a href="/user/dashboard" class="hover:text-gray-900 transition-colors">Dashboard</a>
                <span class="material-symbols-outlined text-[10px]">chevron_right</span>
                <span class="text-gray-900">Service Details</span>
            </nav>
            <div class="flex items-center gap-3">
                <span class="{{ $badgeClass }} px-3 py-1 rounded-full text-[9px] font-black uppercase tracking-widest bg-white">
                    {{ $categoryName }}
                </span>
            </div>
            <h2 class="text-2xl font-black text-gray-900 tracking-tight mt-2">
                {{ $service->name }}
            </h2>
        </div>

        <a href="/user/dashboard" class="inline-flex items-center justify-center gap-2 px-5 py-3.5 bg-gray-900 hover:bg-gray-800 text-white rounded-2xl text-xs font-black uppercase tracking-wider active:scale-95 transition-all shadow-md shadow-gray-200/50">
            <span class="material-symbols-outlined text-[18px]">arrow_back</span>
            Back to Dashboard
        </a>
    </div>

    <!-- Main Container Card -->
    <div class="bg-white rounded-[2.5rem] border border-gray-100 shadow-xl p-8 lg:p-10 mb-10">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start mb-8">
            
            <!-- Left: Interactive Image Block -->
            <div class="lg:col-span-5 flex flex-col items-center w-full justify-start">
                <div class="relative bg-white rounded-[2.5rem] p-4 border border-gray-100 shadow-lg overflow-hidden group w-full max-w-md">
                    <div class="aspect-[4/3] rounded-[2rem] overflow-hidden bg-gray-50 flex items-center justify-center p-2">
                        <img :src="activeImage" 
                             @click="openLightbox = true"
                             class="max-w-full max-h-full object-contain cursor-zoom-in group-hover:scale-102 transition-transform duration-500" 
                             alt="{{ $service->name }}">
                    </div>
                    <!-- Zoom Overlay -->
                    <div class="absolute inset-0 flex items-center justify-center bg-black/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none">
                        <span class="material-symbols-outlined text-[48px] text-white font-black drop-shadow-md">zoom_in</span>
                    </div>
                </div>

                <!-- Gallery Thumbnails -->
                @if(($service->gallery_paths && count($service->gallery_paths) > 0) || $service->image_path)
                    <div class="flex items-center gap-3 mt-4 overflow-x-auto py-2 px-2 w-full max-w-md justify-start shrink-0">
                        <!-- Main Image Thumbnail -->
                        <div @click="activeImage = '{{ asset($service->image_path) }}'" 
                             class="w-14 h-14 rounded-xl overflow-hidden border-2 transition-all shrink-0 active:scale-95 shadow-sm cursor-pointer"
                             :class="activeImage === '{{ asset($service->image_path) }}' ? 'border-blue-500 scale-105 shadow-md ring-2 ring-blue-100' : 'border-gray-200 hover:border-gray-300'">
                            <img src="{{ asset($service->image_path) }}" class="w-full h-full object-cover">
                        </div>
                        
                        <!-- Gallery Image Thumbnails -->
                        @if($service->gallery_paths)
                            @foreach($service->gallery_paths as $galleryPath)
                                <div @click="activeImage = '{{ asset($galleryPath) }}'" 
                                     class="w-14 h-14 rounded-xl overflow-hidden border-2 transition-all shrink-0 active:scale-95 shadow-sm cursor-pointer"
                                     :class="activeImage === '{{ asset($galleryPath) }}' ? 'border-blue-500 scale-105 shadow-md ring-2 ring-blue-100' : 'border-gray-200 hover:border-gray-300'">
                                    <img src="{{ asset($galleryPath) }}" class="w-full h-full object-cover">
                                </div>
                            @endforeach
                        @endif
                    </div>
                @endif
            </div>

            <!-- Right: Service Highlights & Description -->
            <div class="lg:col-span-7 space-y-8">
                <div>
                    <h3 class="text-xs font-black text-gray-400 uppercase tracking-widest mb-3">Service Details & Coverage</h3>
                    <!-- Long description wrapped in a clean container with auto scroll if huge -->
                    <div class="max-h-[220px] overflow-y-auto pr-2 [&::-webkit-scrollbar]:w-1.5 [&::-webkit-scrollbar-thumb]:bg-gray-200 [&::-webkit-scrollbar-thumb]:rounded-full">
                        <p class="text-base text-gray-650 leading-relaxed font-medium whitespace-pre-line text-gray-600">
                            {{ $service->description ?: 'No additional details provided for this repair. Rest assured that our team of certified specialists will thoroughly analyze and diagnose your device to ensure it is returned to perfect operational state.' }}
                        </p>
                    </div>
                </div>

                <!-- Warranty & Inspection Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 bg-gray-50/50 rounded-[2rem] border border-gray-100 p-8">
                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center shrink-0">
                            <span class="material-symbols-outlined text-xl">verified_user</span>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-900 text-sm">90-Day Warranty</h4>
                            <p class="text-xs text-gray-500 mt-0.5">Backed by our high-quality parts guarantee.</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0">
                            <span class="material-symbols-outlined text-xl">security</span>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-900 text-sm">OEM Quality Parts</h4>
                            <p class="text-xs text-gray-500 mt-0.5">Only original or premium quality parts used.</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center shrink-0">
                            <span class="material-symbols-outlined text-xl">query_builder</span>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-900 text-sm">Same-Day Repair</h4>
                            <p class="text-xs text-gray-500 mt-0.5">Most common repairs finished in under 2 hours.</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 rounded-xl bg-purple-50 text-purple-600 flex items-center justify-center shrink-0">
                            <span class="material-symbols-outlined text-xl">assignment_turned_in</span>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-900 text-sm">24-Point Inspection</h4>
                            <p class="text-xs text-gray-500 mt-0.5">Rigorous pre- & post-repair testing checklist.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pricing & Quick Booking Action -->
        <div class="pt-8 border-t border-gray-100 flex flex-col sm:flex-row sm:items-center justify-between gap-6 w-full">
            <div>
                <span class="text-[9px] font-black text-gray-400 uppercase tracking-widest leading-none">Estimated Price</span>
                <div class="flex items-baseline gap-1 mt-1">
                    <span class="text-3xl font-black text-gray-900">₱{{ number_format($service->base_price, 2) }}</span>
                </div>
                <span class="text-[8px] text-gray-400 font-bold uppercase mt-1 block font-semibold">Includes Free Diagnosis</span>
            </div>
            
            <a href="/user/book-appointment?service={{ urlencode($service->name) }}" class="inline-flex items-center justify-center gap-2 px-8 py-4 bg-gray-900 hover:bg-blue-600 text-white rounded-2xl font-black text-sm tracking-wide shadow-lg shadow-gray-200 active:scale-95 transition-all">
                <span class="material-symbols-outlined text-[20px]">calendar_month</span>
                Book This Repair Slot
            </a>
        </div>
    </div>

    <!-- Related Services Catalog Section -->
    @if($relatedServices && $relatedServices->count() > 0)
    <div class="mb-10">
        <h3 class="text-xl font-black text-gray-900 tracking-tight mb-6">
            You Might Also Be Interested In
        </h3>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($relatedServices as $related)
                @php
                    $relBadgeClass = match($related->category) {
                        'screen' => 'bg-blue-50 text-blue-600 border border-blue-100',
                        'power' => 'bg-amber-50 text-amber-600 border border-amber-100',
                        'audio' => 'bg-emerald-50 text-emerald-600 border border-emerald-100',
                        'software' => 'bg-purple-50 text-purple-600 border border-purple-100',
                        default => 'bg-indigo-50 text-indigo-600 border border-indigo-100',
                    };
                    $relCategoryName = match($related->category) {
                        'screen' => 'Screen & Display',
                        'power' => 'Power & Charging',
                        'audio' => 'Audio & Sound',
                        'software' => 'Software & Systems',
                        default => 'Hardware & Modules',
                    };
                @endphp
                
                <div class="bg-white rounded-[2rem] border border-gray-100 shadow-md hover:shadow-xl hover:-translate-y-1 transition-all duration-300 overflow-hidden flex flex-col group">
                    <div class="relative h-44 overflow-hidden bg-gray-50 shrink-0">
                        <img src="{{ asset($related->image_path) }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        <span class="absolute top-4 left-4 {{ $relBadgeClass }} px-2.5 py-0.5 rounded-full text-[8px] font-black uppercase tracking-widest bg-white shadow-sm">
                            {{ $relCategoryName }}
                        </span>
                    </div>

                    <div class="p-6 flex flex-col flex-1">
                        <h4 class="text-base font-extrabold text-gray-900 tracking-tight mb-2 group-hover:text-blue-600 transition-colors">
                            {{ $related->name }}
                        </h4>
                        <div class="relative h-12 overflow-hidden mb-4">
                            <p class="text-xs text-gray-500 leading-relaxed font-medium">
                                {{ $related->description }}
                            </p>
                            <div class="absolute bottom-0 left-0 right-0 h-6 bg-gradient-to-t from-white to-transparent pointer-events-none"></div>
                        </div>

                        <div class="flex items-center justify-between pt-4 border-t border-gray-50 mt-auto">
                            <div class="flex flex-col">
                                <span class="text-[9px] font-black text-gray-400 uppercase tracking-widest leading-none">Starting from</span>
                                <span class="text-base font-black text-gray-900 mt-0.5">₱{{ number_format($related->base_price, 2) }}</span>
                            </div>
                            <div class="flex items-center gap-2 shrink-0">
                                <a href="/user/services/{{ $related->id }}" class="inline-flex items-center justify-center px-3.5 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-xl font-bold text-[10px] active:scale-95 transition-all">
                                    Details
                                </a>
                                <a href="/user/book-appointment?service={{ urlencode($related->name) }}" class="inline-flex items-center justify-center gap-1 px-3.5 py-2.5 bg-gray-900 hover:bg-blue-650 text-white rounded-xl font-bold text-[10px] shadow-sm active:scale-95 transition-all">
                                    Book
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    @endif

    <!-- Dynamic Lightbox Modal -->
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
              <img :src="activeImage" class="max-w-full max-h-[75vh] rounded-[2rem] object-contain shadow-2xl">
         </div>
    </div>
</div>

@php
    $name = strtolower($service->name);
    if (str_contains($name, 'screen') || str_contains($name, 'glass') || str_contains($name, 'lcd')) {
        $category = 'Screen & Display';
        $badgeClass = 'bg-blue-500/10 text-blue-400 border border-blue-500/20';
    } elseif (str_contains($name, 'battery') || str_contains($name, 'charge') || str_contains($name, 'power')) {
        $category = 'Power & Charging';
        $badgeClass = 'bg-amber-500/10 text-amber-400 border border-amber-500/20';
    } elseif (str_contains($name, 'audio') || str_contains($name, 'speaker') || str_contains($name, 'microphone')) {
        $category = 'Audio & Sound';
        $badgeClass = 'bg-emerald-500/10 text-emerald-400 border border-emerald-500/20';
    } elseif (str_contains($name, 'software') || str_contains($name, 'system') || str_contains($name, 'boot') || str_contains($name, 'data')) {
        $category = 'Software & Systems';
        $badgeClass = 'bg-purple-500/10 text-purple-400 border border-purple-500/20';
    } else {
        $category = 'Hardware & Modules';
        $badgeClass = 'bg-indigo-500/10 text-indigo-400 border border-indigo-500/20';
    }
@endphp

<x-layouts.landing title="{{ $service->name }} | Repairmax">
    <main class="relative pt-32 lg:pt-40 pb-16 md:pb-24 overflow-hidden" x-data="{ openLightbox: false, activeImage: '{{ asset($service->image_path) }}' }">
        <!-- Glow Effects -->
        <div class="absolute top-1/4 left-1/4 w-[500px] h-[500px] bg-blue-900/10 rounded-full blur-[120px] pointer-events-none"></div>
        <div class="absolute bottom-1/4 right-1/4 w-[500px] h-[500px] bg-indigo-900/10 rounded-full blur-[120px] pointer-events-none"></div>

        
        <!-- Breadcrumbs & Heading -->
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-10 fade-in-element">
            <nav class="flex items-center gap-2 text-xs font-bold text-gray-400 uppercase tracking-widest mb-6">
                <a href="/" class="hover:text-white transition-colors">Home</a>
                <span class="material-symbols-outlined text-[12px]">chevron_right</span>
                <a href="/services" class="hover:text-white transition-colors">Services</a>
                <span class="material-symbols-outlined text-[12px]">chevron_right</span>
                <span class="text-white">{{ $service->name }}</span>
            </nav>

            <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
                <div>
                    <span class="{{ $badgeClass }} px-4 py-1.5 rounded-full text-[10px] font-black uppercase tracking-widest inline-block mb-3">
                        {{ $category }}
                    </span>
                    <h1 class="text-3xl md:text-5xl font-black text-white tracking-tight leading-none">
                        {{ $service->name }}
                    </h1>
                </div>
                <a href="/services" class="inline-flex items-center justify-center gap-2 px-6 py-4 bg-white/10 text-white hover:bg-white/20 border border-white/5 rounded-full text-xs font-black uppercase tracking-widest active:scale-95 transition-all shadow-none">
                    <span class="material-symbols-outlined text-[16px]">arrow_back</span>
                    Back to Services
                </a>
            </div>
        </section>

        <!-- Service Detail Content -->
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-12 fade-in-element">
            <div class="grid grid-cols-1 md:grid-cols-12 gap-12 items-start">
                
                <!-- Left: Interactive Image Block & Price/Actions -->
                <div class="md:col-span-5 flex flex-col items-start w-full justify-start">
                    <div class="relative bg-white/[0.03] backdrop-blur-md rounded-[2.5rem] p-4 border border-white/10 shadow-2xl overflow-hidden group max-w-md w-full">
                        <div class="aspect-4/3 rounded-4xl overflow-hidden bg-slate-950/20 flex items-center justify-center p-2">
                            <img :src="activeImage" 
                                 @click="openLightbox = true"
                                 class="max-w-full max-h-full object-contain cursor-zoom-in group-hover:scale-102 transition-transform duration-500" 
                                 alt="{{ $service->name }}">
                        </div>
                        
                        <!-- Hover Centered Magnifying Glass Overlay -->
                        <div class="absolute inset-0 flex items-center justify-center bg-black/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none">
                            <span class="material-symbols-outlined text-[48px] text-white font-black drop-shadow-md">zoom_in</span>
                        </div>
                    </div>

                    <!-- Gallery Thumbnails -->
                    @if($service->gallery_paths && count($service->gallery_paths) > 0)
                        <div class="flex items-center gap-3 mt-4 overflow-x-auto py-2 px-2 max-w-md w-full justify-start">
                            <!-- Main Image Thumbnail -->
                            <div @click="activeImage = '{{ asset($service->image_path) }}'" 
                                 class="w-14 h-14 rounded-xl overflow-hidden border-2 transition-all shrink-0 active:scale-95 shadow-sm cursor-pointer"
                                 :class="activeImage === '{{ asset($service->image_path) }}' ? 'border-blue-500 scale-105 shadow-md' : 'border-white/10 bg-white/5 hover:border-white/20'">
                                <img src="{{ asset($service->image_path) }}" class="w-full h-full object-cover">
                            </div>
                            
                            <!-- Gallery Image Thumbnails -->
                            @foreach($service->gallery_paths as $galleryPath)
                                <div @click="activeImage = '{{ asset($galleryPath) }}'" 
                                     class="w-14 h-14 rounded-xl overflow-hidden border-2 transition-all shrink-0 active:scale-95 shadow-sm cursor-pointer"
                                     :class="activeImage === '{{ asset($galleryPath) }}' ? 'border-blue-500 scale-105 shadow-md' : 'border-white/10 bg-white/5 hover:border-white/20'">
                                    <img src="{{ asset($galleryPath) }}" class="w-full h-full object-cover">
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                <!-- Right: Information & Service Highlights -->
                <div class="md:col-span-7 flex flex-col justify-between">
                    
                    <div class="space-y-8">
                        <div>
                            <h2 class="text-xs font-black text-gray-500 uppercase tracking-widest mb-3">Service Description</h2>
                            <p class="text-lg text-gray-300 leading-relaxed font-medium">
                                {{ $service->description ?: 'No additional details provided for this repair. Rest assured that our team of certified specialists will thoroughly analyze and diagnose your device to ensure it is returned to perfect operational state.' }}
                            </p>
                        </div>

                        <!-- Highlights list -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 bg-white/[0.03] backdrop-blur-md rounded-4xl border border-white/10 p-8 shadow-2xl">
                            <div class="flex items-start gap-4">
                                <div class="w-10 h-10 rounded-xl bg-blue-500/10 flex items-center justify-center shrink-0">
                                    <span class="material-symbols-outlined text-blue-400 text-xl">verified_user</span>
                                </div>
                                <div>
                                    <h4 class="font-bold text-white text-sm">90-Day Warranty</h4>
                                    <p class="text-xs text-gray-400 mt-0.5">Backed by our high-quality parts guarantee.</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-4">
                                <div class="w-10 h-10 rounded-xl bg-emerald-500/10 flex items-center justify-center shrink-0">
                                    <span class="material-symbols-outlined text-emerald-400 text-xl">security</span>
                                </div>
                                <div>
                                    <h4 class="font-bold text-white text-sm">OEM Quality Parts</h4>
                                    <p class="text-xs text-gray-400 mt-0.5">Only original or premium quality parts used.</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-4">
                                <div class="w-10 h-10 rounded-xl bg-amber-500/10 flex items-center justify-center shrink-0">
                                    <span class="material-symbols-outlined text-amber-400 text-xl">query_builder</span>
                                </div>
                                <div>
                                    <h4 class="font-bold text-white text-sm">Same-Day Repair</h4>
                                    <p class="text-xs text-gray-400 mt-0.5">Most common repairs finished in under 2 hours.</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-4">
                                <div class="w-10 h-10 rounded-xl bg-purple-500/10 flex items-center justify-center shrink-0">
                                    <span class="material-symbols-outlined text-purple-400 text-xl">assignment_turned_in</span>
                                </div>
                                <div>
                                    <h4 class="font-bold text-white text-sm">24-Point Inspection</h4>
                                    <p class="text-xs text-gray-400 mt-0.5">Rigorous pre- & post-repair testing checklist.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Pricing Box & Action Buttons -->
            <div class="mt-8 pt-8 border-t border-white/5 flex flex-row items-center justify-between w-full gap-6">
                <div class="flex flex-col text-left shrink-0">
                    <span class="text-[9px] font-black text-gray-500 uppercase tracking-widest leading-none">Estimate Base Price</span>
                    <span class="text-3xl font-black text-white mt-1.5">₱{{ number_format($service->base_price, 2) }}</span>
                    <span class="text-[8px] text-gray-500 font-bold uppercase mt-1">Includes Diagnostic Check</span>
                </div>
                <a href="/booking?service={{ urlencode($service->name) }}" class="inline-flex items-center justify-center gap-2.5 px-6 py-4 bg-blue-600 hover:bg-blue-500 text-white rounded-2xl font-black text-sm tracking-wide shadow-lg shadow-blue-500/20 active:scale-95 transition-all whitespace-nowrap">
                    <span class="material-symbols-outlined text-[18px]">calendar_month</span>
                    Book This Repair
                </a>
            </div>
        </section>

        <!-- Related Services Section -->
        @if($relatedServices && $relatedServices->count() > 0)
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-16 mb-0 fade-in-element">
            <h3 class="text-2xl font-black text-white tracking-tight mb-8">
                You Might Also Be Interested In
            </h3>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($relatedServices as $related)
                    @php
                        $relName = strtolower($related->name);
                        if (str_contains($relName, 'screen') || str_contains($relName, 'glass') || str_contains($relName, 'lcd')) {
                            $relCategory = 'Screen & Display';
                            $relBadgeClass = 'bg-blue-500/10 text-blue-400 border border-blue-500/20';
                        } elseif (str_contains($relName, 'battery') || str_contains($relName, 'charge') || str_contains($relName, 'power')) {
                            $relCategory = 'Power & Charging';
                            $relBadgeClass = 'bg-amber-500/10 text-amber-400 border border-amber-500/20';
                        } elseif (str_contains($relName, 'audio') || str_contains($relName, 'speaker') || str_contains($relName, 'microphone')) {
                            $relCategory = 'Audio & Sound';
                            $relBadgeClass = 'bg-emerald-500/10 text-emerald-400 border border-emerald-500/20';
                        } elseif (str_contains($relName, 'software') || str_contains($relName, 'system') || str_contains($relName, 'boot') || str_contains($relName, 'data')) {
                            $relCategory = 'Software & Systems';
                            $relBadgeClass = 'bg-purple-500/10 text-purple-400 border border-purple-500/20';
                        } else {
                            $relCategory = 'Hardware & Modules';
                            $relBadgeClass = 'bg-indigo-500/10 text-indigo-400 border border-indigo-500/20';
                        }
                    @endphp
                    
                    <div class="relative bg-white/[0.03] backdrop-blur-md rounded-[2.5rem] border border-white/10 shadow-2xl hover:shadow-3xl hover:bg-white/[0.05] hover:border-white/20 hover:-translate-y-2 transition-all duration-300 overflow-hidden flex flex-col group cursor-pointer">
                        
                        <!-- Card Image -->
                        <div class="relative h-48 overflow-hidden bg-slate-950/20 shrink-0">
                            <img src="{{ asset($related->image_path) }}" 
                                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" 
                                 alt="{{ $related->name }}">
                        </div>

                        <!-- Card Body -->
                        <div class="p-6 flex flex-col flex-1">
                            <!-- Category Badge -->
                            <span class="{{ $relBadgeClass }} px-3 py-1 rounded-full text-[9px] font-black uppercase tracking-widest inline-block mb-3 w-fit shadow-xs">
                                {{ $relCategory }}
                            </span>

                            <h4 class="text-lg font-extrabold text-white tracking-tight mb-2 group-hover:text-blue-400 transition-colors">
                                {{ $related->name }}
                            </h4>

                            <p class="text-xs text-gray-400 leading-relaxed font-medium line-clamp-2 mb-5">
                                {{ $related->description }}
                            </p>
                            
                            <div class="flex items-center justify-between pt-4 mt-auto">
                                <div class="flex flex-col">
                                    <span class="text-[9px] font-black text-gray-500 uppercase tracking-widest leading-none">Starting from</span>
                                    <span class="text-lg font-black text-white mt-0.5">₱{{ number_format($related->base_price, 2) }}</span>
                                </div>
                                <div class="flex items-center gap-2 shrink-0">
                                    <a href="/services/{{ $related->id }}" class="after:absolute after:inset-0 after:z-10"></a>
                                    <a href="/booking?service={{ urlencode($related->name) }}" class="inline-flex items-center justify-center gap-1 px-4 py-3 bg-blue-600 hover:bg-blue-500 text-white rounded-xl font-bold text-[10px] shadow-sm active:scale-95 transition-all whitespace-nowrap relative z-20">
                                        Book
                                        <span class="material-symbols-outlined text-[14px]">calendar_month</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
        @endif

        <!-- Dynamic Lightbox Modal -->
        <div x-show="openLightbox" 
             class="fixed inset-0 z-100 flex items-center justify-center p-4 sm:p-6" 
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

             <!-- Close Button -->
             <button @click="openLightbox = false" class="absolute top-6 right-6 sm:top-10 sm:right-10 text-white hover:text-red-500 transition-colors z-50 bg-transparent hover:bg-transparent shadow-none border-none p-0 cursor-pointer" aria-label="Close lightbox">
                 <span class="material-symbols-outlined text-[36px] sm:text-[40px] font-bold">close</span>
             </button>

             <!-- Content Card -->
             <div x-show="openLightbox"
                  x-transition:enter="ease-out duration-300"
                  x-transition:enter-start="opacity-0 scale-95"
                  x-transition:enter-end="opacity-100 scale-100"
                  x-transition:leave="ease-in duration-200"
                  x-transition:leave-start="opacity-100 scale-100"
                  x-transition:leave-end="opacity-0 scale-95"
                  class="relative bg-white/10 backdrop-blur-md rounded-[2.5rem] overflow-hidden max-w-2xl w-full p-4 border border-white/20 shadow-2xl flex flex-col items-center justify-center">

                  <!-- Image -->
                  <img :src="activeImage" class="max-w-full max-h-[75vh] rounded-4xl object-contain shadow-2xl">
             </div>
        </div>

    </main>
</x-layouts.landing>

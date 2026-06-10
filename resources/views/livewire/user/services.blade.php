<div class="w-full" x-data="{ openLightbox: false, imageUrl: '' }">
    <div class="mb-8">
        <h1 class="text-3xl font-[Montserrat] font-extrabold text-gray-900 dark:text-white tracking-tight">Services Catalog</h1>
        <p class="text-gray-500 dark:text-gray-400 mt-1 font-medium">Browse our repair services, check transparent pricing, and book your repair.</p>
    </div>
    <!-- Search & Filters -->
    <div class="bg-white dark:bg-white/3 border border-gray-200/80 dark:border-white/10 shadow-xl dark:shadow-2xl p-6 mb-8 space-y-6" style="border-radius: 2rem;">
        <div class="relative w-full max-w-xl mx-auto">
            <span class="absolute left-5 top-1/2 -translate-y-1/2 material-symbols-outlined text-gray-450 dark:text-gray-400 text-2xl">search</span>
            <input type="text" wire:model.live.debounce.300ms="search" placeholder="Search for screen replacement, battery service..." class="w-full pl-13 pr-10 py-3.5 bg-gray-50 dark:bg-white/5 border border-gray-200 dark:border-white/10 rounded-xl focus:bg-white dark:focus:bg-white/10 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/15 dark:focus:!border-blue-500 dark:focus:!ring-4 dark:focus:!ring-blue-500/25 transition-all outline-none text-sm font-semibold text-gray-900 dark:text-white shadow-inner">
            @if($search)
                <button type="button" wire:click="$set('search', '')" class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-450 hover:text-gray-700 dark:text-gray-400 dark:hover:text-white transition-colors">
                    <span class="material-symbols-outlined text-xl">close</span>
                </button>
            @endif
        </div>

        <!-- Category Filters -->
        <div class="flex flex-wrap items-center justify-center gap-2">
            <button type="button" wire:click="$set('selectedCategory', 'all')" 
                    class="px-4 py-2 rounded-full text-xs font-bold uppercase tracking-wider transition-all duration-200 active:scale-95 border {{ $selectedCategory ==='all' ? 'bg-blue-600 border-blue-500 text-white shadow-lg shadow-blue-500/20' : 'bg-gray-100 dark:bg-white/5 text-gray-650 dark:text-gray-400 border-gray-200 dark:border-white/5 hover:text-gray-900 hover:bg-gray-200 dark:hover:text-white dark:hover:bg-white/10' }}">
                All Repairs
            </button>
            <button type="button" wire:click="$set('selectedCategory', 'screen')" 
                    class="px-4 py-2 rounded-full text-xs font-bold uppercase tracking-wider transition-all duration-200 active:scale-95 border {{ $selectedCategory ==='screen' ? 'bg-blue-600 border-blue-500 text-white shadow-lg shadow-blue-500/20' : 'bg-gray-100 dark:bg-white/5 text-gray-650 dark:text-gray-400 border-gray-200 dark:border-white/5 hover:text-gray-900 hover:bg-gray-200 dark:hover:text-white dark:hover:bg-white/10' }}">
                Screen & Display
            </button>
            <button type="button" wire:click="$set('selectedCategory', 'power')" 
                    class="px-4 py-2 rounded-full text-xs font-bold uppercase tracking-wider transition-all duration-200 active:scale-95 border {{ $selectedCategory ==='power' ? 'bg-blue-600 border-blue-500 text-white shadow-lg shadow-blue-500/20' : 'bg-gray-100 dark:bg-white/5 text-gray-650 dark:text-gray-400 border-gray-200 dark:border-white/5 hover:text-gray-900 hover:bg-gray-200 dark:hover:text-white dark:hover:bg-white/10' }}">
                Power & Battery
            </button>
            <button type="button" wire:click="$set('selectedCategory', 'audio')" 
                    class="px-4 py-2 rounded-full text-xs font-bold uppercase tracking-wider transition-all duration-200 active:scale-95 border {{ $selectedCategory ==='audio' ? 'bg-blue-600 border-blue-500 text-white shadow-lg shadow-blue-500/20' : 'bg-gray-100 dark:bg-white/5 text-gray-650 dark:text-gray-400 border-gray-200 dark:border-white/5 hover:text-gray-900 hover:bg-gray-200 dark:hover:text-white dark:hover:bg-white/10' }}">
                Audio & Sound
            </button>
            <button type="button" wire:click="$set('selectedCategory', 'software')" 
                    class="px-4 py-2 rounded-full text-xs font-bold uppercase tracking-wider transition-all duration-200 active:scale-95 border {{ $selectedCategory ==='software' ? 'bg-blue-600 border-blue-500 text-white shadow-lg shadow-blue-500/20' : 'bg-gray-100 dark:bg-white/5 text-gray-650 dark:text-gray-400 border-gray-200 dark:border-white/5 hover:text-gray-900 hover:bg-gray-200 dark:hover:text-white dark:hover:bg-white/10' }}">
                Software & OS
            </button>
            <button type="button" wire:click="$set('selectedCategory', 'hardware')" 
                    class="px-4 py-2 rounded-full text-xs font-bold uppercase tracking-wider transition-all duration-200 active:scale-95 border {{ $selectedCategory ==='hardware' ? 'bg-blue-600 border-blue-500 text-white shadow-lg shadow-blue-500/20' : 'bg-gray-100 dark:bg-white/5 text-gray-650 dark:text-gray-400 border-gray-200 dark:border-white/5 hover:text-gray-900 hover:bg-gray-200 dark:hover:text-white dark:hover:bg-white/10' }}">
                Hardware & Modules
            </button>
        </div>
    </div>

    <!-- Services Grid -->
    <div class="relative min-h-60">
        <div wire:loading.remove wire:target="search, selectedCategory">
            @if($services->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($services as $service)
                        <div class="relative bg-white dark:bg-white/3 border border-gray-200/80 dark:border-white/10 shadow-lg dark:shadow-xl hover:shadow-xl dark:hover:shadow-2xl hover:bg-gray-50/50 dark:hover:bg-white/5 hover:border-gray-300 dark:hover:border-white/20 hover:-translate-y-1 transition-all duration-300 overflow-hidden flex flex-col group cursor-pointer" style="border-radius: 2rem;">
                            <!-- Clickable link wrapper for the whole card -->
                            <a href="{{ route('user.services.detail', $service->id) }}" class="absolute inset-0 z-20"></a>

                            <!-- Card Image -->
                            <div class="relative h-44 overflow-hidden bg-slate-950/20 shrink-0 z-10">
                                <img src="{{ asset($service->image_path) }}" 
                                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" 
                                     alt="{{ $service->name }}">
                            </div>

                            <!-- Card Body -->
                            <div class="p-6 flex flex-col flex-1 relative z-10">
                                <!-- Category Badge -->
                                <span class="px-3 py-1 rounded-full text-[9px] font-black uppercase tracking-widest inline-block mb-3 w-fit shadow-xs
                                    {{ match($service->category ?: 'hardware') {
                                        'screen' => 'bg-blue-50 dark:bg-blue-500/10 text-blue-600 dark:text-blue-400 border border-blue-100 dark:border-blue-500/20',
                                        'power' => 'bg-amber-50 dark:bg-amber-500/10 text-amber-600 dark:text-amber-400 border border-amber-100 dark:border-amber-500/20',
                                        'audio' => 'bg-emerald-50 dark:bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 border border-emerald-100 dark:border-emerald-500/20',
                                        'software' => 'bg-purple-50 dark:bg-purple-500/10 text-purple-600 dark:text-purple-400 border border-purple-100 dark:border-purple-500/20',
                                        default => 'bg-indigo-50 dark:bg-indigo-500/10 text-indigo-600 dark:text-indigo-400 border border-indigo-100 dark:border-indigo-500/20',
                                    } }}">
                                    {{ match($service->category ?: 'hardware') {
                                        'screen' => 'Screen & Display',
                                        'power' => 'Power & Charging',
                                        'audio' => 'Audio & Sound',
                                        'software' => 'Software & Systems',
                                        default => 'Hardware & Modules',
                                    } }}
                                </span>

                                <h3 class="text-lg font-extrabold text-gray-900 dark:text-white tracking-tight mb-2 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors">{{ $service->name }}</h3>
                                <p class="text-xs text-gray-505 dark:text-gray-400 leading-relaxed font-medium line-clamp-3 mb-5">{{ $service->description }}</p>
                                
                                <div class="flex items-center justify-between pt-4 mt-auto border-t border-gray-200/60 dark:border-white/5">
                                    <div class="flex flex-col">
                                        <span class="text-[9px] font-black text-gray-455 dark:text-gray-500 uppercase tracking-widest leading-none">Starting from</span>
                                        <span class="text-xl font-black text-gray-900 dark:text-white mt-1">₱{{ number_format($service->base_price) }}</span>
                                    </div>
                                    <a href="{{ route('user.book-appointment', ['service' => $service->name]) }}" class="inline-flex items-center justify-center gap-1.5 px-4 py-2.5 bg-blue-600 hover:bg-blue-500 text-white rounded-xl font-bold text-xs shadow-sm active:scale-95 transition-all relative z-30">
                                        Book
                                        <span class="material-symbols-outlined text-[16px]">calendar_month</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                @if($services->hasPages())
                    <div class="mt-8 flex justify-between items-center bg-white dark:bg-white/3 border border-gray-200/80 dark:border-white/10 shadow-lg p-4" style="border-radius: 1.5rem;">
                        <button type="button" 
                                wire:click="previousPage" 
                                @if($services->onFirstPage()) disabled @endif
                                class="px-5 py-2.5 bg-blue-600 border border-blue-500 disabled:bg-gray-100 dark:disabled:bg-white/5 text-white disabled:text-gray-400 dark:disabled:text-gray-500 disabled:border-gray-200 dark:disabled:border-white/5 rounded-xl font-bold text-xs uppercase tracking-wider transition-all duration-200 hover:bg-blue-500 disabled:hover:bg-gray-100 dark:disabled:hover:bg-white/5 active:scale-95 disabled:active:scale-100 flex items-center gap-1.5 shadow-sm disabled:shadow-none">
                            <span class="material-symbols-outlined text-[16px]">arrow_back</span>
                            Previous
                        </button>
                        
                        <span class="text-xs font-bold text-gray-500 dark:text-gray-400">
                            Page {{ $services->currentPage() }} of {{ $services->lastPage() }}
                        </span>
                        
                        <button type="button" 
                                wire:click="nextPage" 
                                @if(!$services->hasMorePages()) disabled @endif
                                class="px-5 py-2.5 bg-blue-600 border border-blue-500 disabled:bg-gray-100 dark:disabled:bg-white/5 text-white disabled:text-gray-400 dark:disabled:text-gray-500 disabled:border-gray-200 dark:disabled:border-white/5 rounded-xl font-bold text-xs uppercase tracking-wider transition-all duration-200 hover:bg-blue-500 disabled:hover:bg-gray-100 dark:disabled:hover:bg-white/5 active:scale-95 disabled:active:scale-100 flex items-center gap-1.5 shadow-sm disabled:shadow-none">
                            Next
                            <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                        </button>
                    </div>
                @endif
            @else
                <!-- Empty State -->
                <div class="flex flex-col items-center justify-center text-center py-20 px-4 bg-white dark:bg-white/3 border border-gray-200 dark:border-white/10 shadow-xl dark:shadow-2xl" style="border-radius: 2rem;">
                    <div class="w-16 h-16 bg-gray-50 dark:bg-white/5 border border-dashed border-gray-200 dark:border-white/10 rounded-2xl flex items-center justify-center mb-5">
                        <span class="material-symbols-outlined text-gray-400 dark:text-gray-550 text-3xl">search_off</span>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white tracking-tight">No Matching Services</h3>
                    <p class="text-xs text-gray-555 dark:text-gray-400 max-w-sm mt-2 leading-relaxed font-medium">
                        We couldn't find any repairs matching your search. Try adjusting your query or filters.
                    </p>
                    <button type="button" wire:click="$set('search', ''); $set('selectedCategory', 'all')" class="mt-5 px-5 py-2.5 bg-blue-600 hover:bg-blue-500 text-white text-xs font-bold rounded-full active:scale-95 transition-all shadow-md">
                        Clear Search & Filters
                    </button>
                </div>
            @endif
        </div>

        <div wire:loading wire:target="search, selectedCategory" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @for ($i = 0; $i < 6; $i++)
                <div class="animate-pulse bg-white dark:bg-white/3 border border-gray-200/80 dark:border-white/10 p-0 flex flex-col overflow-hidden shadow-lg" style="border-radius: 2rem;">
                    <div class="h-44 bg-gray-200 dark:bg-white/10 w-full shrink-0"></div>
                    <div class="p-6 flex flex-col flex-1 space-y-4">
                        <div class="h-5 w-24 bg-gray-200 dark:bg-white/10 rounded-full"></div>
                        <div class="h-6 w-3/4 bg-gray-250 dark:bg-white/15 rounded-xl"></div>
                        <div class="space-y-2">
                            <div class="h-3 bg-gray-200 dark:bg-white/10 rounded w-full"></div>
                            <div class="h-3 bg-gray-200 dark:bg-white/10 rounded w-5/6"></div>
                        </div>
                        <div class="flex justify-between items-center pt-4 border-t border-gray-200/60 dark:border-white/5 mt-auto">
                            <div class="space-y-1">
                                <div class="h-2 w-16 bg-gray-200 dark:bg-white/10 rounded"></div>
                                <div class="h-5 w-24 bg-gray-250 dark:bg-white/15 rounded"></div>
                            </div>
                            <div class="h-9 w-16 bg-gray-200 dark:bg-white/10 rounded-xl"></div>
                        </div>
                    </div>
                </div>
            @endfor
        </div>
    </div>

    <!-- Lightbox Modal -->
    <div x-show="openLightbox" 
         class="fixed inset-0 z-[200] flex items-center justify-center p-4 sm:p-6" 
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
         <button @click="openLightbox = false" class="absolute top-6 right-6 text-white hover:text-red-500 transition-colors z-50 bg-transparent hover:bg-transparent shadow-none border-none p-0 cursor-pointer">
             <span class="material-symbols-outlined text-[36px] font-bold">close</span>
         </button>

         <!-- Content -->
         <div x-show="openLightbox"
              x-transition:enter="ease-out duration-300"
              x-transition:enter-start="opacity-0 scale-95"
              x-transition:enter-end="opacity-100 scale-100"
              x-transition:leave="ease-in duration-200"
              x-transition:leave-start="opacity-100 scale-100"
              x-transition:leave-end="opacity-0 scale-95"
              class="relative bg-white/10 backdrop-blur-md rounded-[2rem] overflow-hidden max-w-2xl w-full p-4 border border-white/20 shadow-2xl flex flex-col items-center justify-center">
              <img :src="imageUrl" class="max-w-full max-h-[75vh] rounded-3xl object-contain shadow-2xl">
         </div>
    </div>
</div>

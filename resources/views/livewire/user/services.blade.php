<div class="w-full" x-data="{ openLightbox: false, imageUrl: '' }">
    <!-- Header Section -->
    <div class="mb-8">
        <h1 class="text-3xl font-[Montserrat] font-bold text-white tracking-tight">Services Catalog</h1>
        <p class="text-gray-400 mt-2 font-medium">Browse our repair services, check transparent pricing, and book your repair.</p>
    </div>

    <!-- Search & Filters -->
    <div class="bg-white/3 backdrop-blur-md rounded-[2rem] border border-white/10 shadow-2xl p-6 mb-8 space-y-6">
        <div class="relative w-full max-w-xl mx-auto">
            <span class="absolute left-5 top-1/2 -translate-y-1/2 material-symbols-outlined text-gray-400 text-2xl">search</span>
            <input type="text" wire:model.live.debounce.300ms="search" placeholder="Search for screen replacement, battery service..." class="w-full pl-13 pr-10 py-3.5 bg-white/5 border border-white/10 rounded-xl focus:bg-white/10 focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition-all outline-none text-sm font-semibold text-white shadow-inner">
            @if($search)
                <button type="button" wire:click="$set('search', '')" class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-white transition-colors">
                    <span class="material-symbols-outlined text-xl">close</span>
                </button>
            @endif
        </div>

        <!-- Category Filters -->
        <div class="flex flex-wrap items-center justify-center gap-2">
            <button type="button" wire:click="$set('selectedCategory', 'all')" 
                    class="px-4 py-2 rounded-xl text-xs font-bold uppercase tracking-wider transition-all duration-200 active:scale-95 border
                        {{ $selectedCategory === 'all' ? 'bg-blue-600 border-blue-500 text-white shadow-lg shadow-blue-500/20' : 'bg-white/5 text-gray-400 border-white/5 hover:text-white hover:bg-white/10' }}">
                All Repairs
            </button>
            <button type="button" wire:click="$set('selectedCategory', 'screen')" 
                    class="px-4 py-2 rounded-xl text-xs font-bold uppercase tracking-wider transition-all duration-200 active:scale-95 border
                        {{ $selectedCategory === 'screen' ? 'bg-blue-600 border-blue-500 text-white shadow-lg shadow-blue-500/20' : 'bg-white/5 text-gray-400 border-white/5 hover:text-white hover:bg-white/10' }}">
                Screen & Display
            </button>
            <button type="button" wire:click="$set('selectedCategory', 'power')" 
                    class="px-4 py-2 rounded-xl text-xs font-bold uppercase tracking-wider transition-all duration-200 active:scale-95 border
                        {{ $selectedCategory === 'power' ? 'bg-blue-600 border-blue-500 text-white shadow-lg shadow-blue-500/20' : 'bg-white/5 text-gray-400 border-white/5 hover:text-white hover:bg-white/10' }}">
                Power & Battery
            </button>
            <button type="button" wire:click="$set('selectedCategory', 'audio')" 
                    class="px-4 py-2 rounded-xl text-xs font-bold uppercase tracking-wider transition-all duration-200 active:scale-95 border
                        {{ $selectedCategory === 'audio' ? 'bg-blue-600 border-blue-500 text-white shadow-lg shadow-blue-500/20' : 'bg-white/5 text-gray-400 border-white/5 hover:text-white hover:bg-white/10' }}">
                Audio & Sound
            </button>
            <button type="button" wire:click="$set('selectedCategory', 'software')" 
                    class="px-4 py-2 rounded-xl text-xs font-bold uppercase tracking-wider transition-all duration-200 active:scale-95 border
                        {{ $selectedCategory === 'software' ? 'bg-blue-600 border-blue-500 text-white shadow-lg shadow-blue-500/20' : 'bg-white/5 text-gray-400 border-white/5 hover:text-white hover:bg-white/10' }}">
                Software & OS
            </button>
            <button type="button" wire:click="$set('selectedCategory', 'hardware')" 
                    class="px-4 py-2 rounded-xl text-xs font-bold uppercase tracking-wider transition-all duration-200 active:scale-95 border
                        {{ $selectedCategory === 'hardware' ? 'bg-blue-600 border-blue-500 text-white shadow-lg shadow-blue-500/20' : 'bg-white/5 text-gray-400 border-white/5 hover:text-white hover:bg-white/10' }}">
                Hardware & Modules
            </button>
        </div>
    </div>

    <!-- Services Grid -->
    <div class="relative min-h-60">
        @if($services->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($services as $service)
                    <div class="relative bg-white/3 backdrop-blur-md rounded-[2rem] border border-white/10 shadow-xl hover:shadow-2xl hover:bg-white/5 hover:border-white/20 hover:-translate-y-1 transition-all duration-300 overflow-hidden flex flex-col group cursor-pointer">
                        <!-- Clickable link wrapper for the whole card -->
                        <a href="{{ route('user.services.detail', $service->id) }}" class="absolute inset-0 z-10"></a>

                        <!-- Card Image -->
                        <div class="relative h-44 overflow-hidden bg-slate-950/20 shrink-0 z-20">
                            <img src="{{ asset($service->image_path) }}" 
                                 @click.prevent="imageUrl = '{{ asset($service->image_path) }}'; openLightbox = true"
                                 class="w-full h-full object-cover cursor-zoom-in group-hover:scale-105 transition-transform duration-500" 
                                 alt="{{ $service->name }}">
                        </div>

                        <!-- Card Body -->
                        <div class="p-6 flex flex-col flex-1 relative z-20">
                            <!-- Category Badge -->
                            <span class="px-3 py-1 rounded-full text-[9px] font-black uppercase tracking-widest inline-block mb-3 w-fit shadow-xs
                                {{ match($service->category ?: 'hardware') {
                                    'screen' => 'bg-blue-500/10 text-blue-400 border border-blue-500/20',
                                    'power' => 'bg-amber-500/10 text-amber-400 border border-amber-500/20',
                                    'audio' => 'bg-emerald-500/10 text-emerald-400 border border-emerald-500/20',
                                    'software' => 'bg-purple-500/10 text-purple-400 border border-purple-500/20',
                                    default => 'bg-indigo-500/10 text-indigo-400 border border-indigo-500/20',
                                } }}">
                                {{ match($service->category ?: 'hardware') {
                                    'screen' => 'Screen & Display',
                                    'power' => 'Power & Charging',
                                    'audio' => 'Audio & Sound',
                                    'software' => 'Software & Systems',
                                    default => 'Hardware & Modules',
                                } }}
                            </span>

                            <h3 class="text-lg font-extrabold text-white tracking-tight mb-2 group-hover:text-blue-400 transition-colors">{{ $service->name }}</h3>
                            <p class="text-xs text-gray-400 leading-relaxed font-medium line-clamp-3 mb-5">{{ $service->description }}</p>
                            
                            <div class="flex items-center justify-between pt-4 mt-auto border-t border-white/5">
                                <div class="flex flex-col">
                                    <span class="text-[9px] font-black text-gray-500 uppercase tracking-widest leading-none">Starting from</span>
                                    <span class="text-xl font-black text-white mt-1">₱{{ number_format($service->base_price) }}</span>
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
        @else
            <!-- Empty State -->
            <div class="flex flex-col items-center justify-center text-center py-20 px-4 bg-white/3 backdrop-blur-md border border-white/10 rounded-[2rem] shadow-2xl">
                <div class="w-16 h-16 bg-white/5 border border-dashed border-white/10 rounded-2xl flex items-center justify-center mb-5">
                    <span class="material-symbols-outlined text-gray-400 text-3xl">search_off</span>
                </div>
                <h3 class="text-lg font-bold text-white tracking-tight">No Matching Services</h3>
                <p class="text-xs text-gray-400 max-w-sm mt-2 leading-relaxed font-medium">
                    We couldn't find any repairs matching your search. Try adjusting your query or filters.
                </p>
                <button type="button" wire:click="$set('search', ''); $set('selectedCategory', 'all')" class="mt-5 px-5 py-2.5 bg-blue-600 hover:bg-blue-500 text-white text-xs font-bold rounded-xl active:scale-95 transition-all shadow-md">
                    Clear Search & Filters
                </button>
            </div>
        @endif
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

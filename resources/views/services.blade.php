<x-layouts.landing title="Our Services | Repairmax">
    <main class="pt-32 lg:pt-40 py-16 md:py-24 !pt-40" 
          x-data="{
              search: '',
              selectedCategory: 'all',
              openLightbox: false,
              imageUrl: '',
              services: [
                  @foreach($services as $service)
                  {
                      id: {{ $service->id }},
                      name: '{{ e($service->name) }}',
                      description: '{{ e($service->description) }}',
                      base_price: {{ $service->base_price }},
                      image_path: '{{ asset($service->image_path) }}',
                      category: '{{ $service->category ?: 'hardware' }}',
                      categoryName: '{{ match($service->category ?: 'hardware') {
                          'screen' => 'Screen & Display',
                          'power' => 'Power & Charging',
                          'audio' => 'Audio & Sound',
                          'software' => 'Software & Systems',
                          default => 'Hardware & Modules',
                      } }}',
                  },
                  @endforeach
              ],
              get filteredServices() {
                  return this.services.filter(s => {
                      const matchesSearch = s.name.toLowerCase().includes(this.search.toLowerCase()) || s.description.toLowerCase().includes(this.search.toLowerCase());
                      const matchesCategory = this.selectedCategory === 'all' || s.category === this.selectedCategory;
                      return matchesSearch && matchesCategory;
                  });
              }
          }">

        <!-- Hero Section -->
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-12 text-center fade-in-element">
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-black text-gray-900 mb-6 tracking-tight">
                Our Professional <span class="bg-clip-text text-transparent bg-gradient-to-r from-blue-600 to-indigo-600">Repair Services</span>
            </h1>
            <p class="text-lg md:text-xl text-gray-500 max-w-3xl mx-auto leading-relaxed font-medium">
                Explore our transparent pricing and catalog of expert repairs. Click on any picture to view details, or search for your specific issue below.
            </p>
        </section>

        <!-- Search, Quick Filters & Shortcuts -->
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-16 fade-in-element">
            <div class="bg-white rounded-[2.5rem] border border-gray-100 shadow-xl shadow-gray-100/40 p-6 md:p-8 space-y-6">
                <!-- Search input -->
                <div class="relative w-full max-w-2xl mx-auto">
                    <span class="absolute left-6 top-1/2 -translate-y-1/2 material-symbols-outlined text-gray-400 text-2xl">search</span>
                    <input type="text" x-model="search" placeholder="Search for screen replacement, battery service, data recovery..." class="w-full pl-15 pr-12 py-5 bg-gray-50 border border-gray-200 rounded-2xl focus:bg-white focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition-all outline-none text-sm font-bold text-gray-900">
                    <button x-show="search.length > 0" @click="search = ''" class="absolute right-6 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-900 transition-colors">
                        <span class="material-symbols-outlined text-xl">close</span>
                    </button>
                </div>

                <!-- Shortcuts (Categories) -->
                <div class="flex flex-wrap items-center justify-center gap-2.5 pt-2">
                    <button @click="selectedCategory = 'all'" 
                            :class="selectedCategory === 'all' ? 'bg-gray-900 text-white shadow-lg shadow-gray-900/10' : 'bg-gray-50 text-gray-600 hover:bg-gray-100 border border-gray-200'"
                            class="px-5 py-3 rounded-xl text-xs font-black uppercase tracking-widest transition-all duration-200 active:scale-95">
                        All Repairs
                    </button>
                    <button @click="selectedCategory = 'screen'" 
                            :class="selectedCategory === 'screen' ? 'bg-blue-600 text-white shadow-lg shadow-blue-600/10' : 'bg-gray-50 text-gray-600 hover:bg-gray-100 border border-gray-200'"
                            class="px-5 py-3 rounded-xl text-xs font-black uppercase tracking-widest transition-all duration-200 active:scale-95">
                        Screen & Display
                    </button>
                    <button @click="selectedCategory = 'power'" 
                            :class="selectedCategory === 'power' ? 'bg-amber-600 text-white shadow-lg shadow-amber-600/10' : 'bg-gray-50 text-gray-600 hover:bg-gray-100 border border-gray-200'"
                            class="px-5 py-3 rounded-xl text-xs font-black uppercase tracking-widest transition-all duration-200 active:scale-95">
                        Power & Battery
                    </button>
                    <button @click="selectedCategory = 'audio'" 
                            :class="selectedCategory === 'audio' ? 'bg-emerald-600 text-white shadow-lg shadow-emerald-600/10' : 'bg-gray-50 text-gray-600 hover:bg-gray-100 border border-gray-200'"
                            class="px-5 py-3 rounded-xl text-xs font-black uppercase tracking-widest transition-all duration-200 active:scale-95">
                        Audio & Sound
                    </button>
                    <button @click="selectedCategory = 'software'" 
                            :class="selectedCategory === 'software' ? 'bg-purple-600 text-white shadow-lg shadow-purple-600/10' : 'bg-gray-50 text-gray-600 hover:bg-gray-100 border border-gray-200'"
                            class="px-5 py-3 rounded-xl text-xs font-black uppercase tracking-widest transition-all duration-200 active:scale-95">
                        Software & OS
                    </button>
                    <button @click="selectedCategory = 'hardware'" 
                            :class="selectedCategory === 'hardware' ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-600/10' : 'bg-gray-50 text-gray-600 hover:bg-gray-100 border border-gray-200'"
                            class="px-5 py-3 rounded-xl text-xs font-black uppercase tracking-widest transition-all duration-200 active:scale-95">
                        Hardware & Modules
                    </button>
                </div>
            </div>
        </section>

        <!-- Services Grid -->
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-20 fade-in-element">
            <!-- Loading/State Wrapper -->
            <div class="relative min-h-[400px]">
                
                <!-- Card Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8" x-show="filteredServices.length > 0">
                    <template x-for="service in filteredServices" :key="service.id">
                        <div class="bg-white rounded-[2.5rem] border border-gray-100 shadow-lg hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 overflow-hidden flex flex-col group">
                            
                            <!-- Card Image -->
                            <div class="relative h-56 overflow-hidden bg-gray-50 shrink-0">
                                <img :src="service.image_path" 
                                     @click="imageUrl = service.image_path; openLightbox = true"
                                     class="w-full h-full object-cover cursor-zoom-in group-hover:scale-110 transition-transform duration-500" 
                                     :alt="service.name">
                                
                                <!-- Category Badge -->
                                <span :class="{
                                          'bg-blue-50 text-blue-600 border border-blue-100': service.category === 'screen',
                                          'bg-amber-50 text-amber-600 border border-amber-100': service.category === 'power',
                                          'bg-emerald-50 text-emerald-600 border border-emerald-100': service.category === 'audio',
                                          'bg-purple-50 text-purple-600 border border-purple-100': service.category === 'software',
                                          'bg-indigo-50 text-indigo-600 border border-indigo-100': service.category === 'hardware'
                                      }"
                                      class="absolute top-6 left-6 px-4 py-1.5 rounded-full text-[10px] font-black uppercase tracking-widest shadow-sm bg-white"
                                      x-text="service.categoryName">
                                </span>
                            </div>

                            <!-- Card Body -->
                            <div class="p-8 flex flex-col flex-1">
                                <h3 class="text-xl font-extrabold text-gray-900 tracking-tight mb-3 group-hover:text-blue-600 transition-colors" x-text="service.name"></h3>
                                <!-- Constrained Description with Premium Blend Fade -->
                                <div class="relative h-20 overflow-hidden mb-6">
                                    <p class="text-sm text-gray-500 leading-relaxed font-medium" x-text="service.description"></p>
                                    <!-- Blend / Fade mask at the bottom -->
                                    <div class="absolute bottom-0 left-0 right-0 h-10 bg-gradient-to-t from-white to-transparent pointer-events-none"></div>
                                </div>
                                
                                <div class="flex items-center justify-between pt-6 border-t border-gray-50 mt-auto">
                                    <div class="flex flex-col">
                                        <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest leading-none">Starting from</span>
                                        <span class="text-2xl font-black text-gray-900 mt-1" x-text="'₱' + Number(service.base_price).toLocaleString()"></span>
                                    </div>
                                    <div class="flex items-center gap-2 shrink-0">
                                        <a :href="'/services/' + service.id" class="inline-flex items-center justify-center px-4 py-3.5 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-xl font-bold text-[10px] active:scale-95 transition-all whitespace-nowrap">
                                            Details
                                        </a>
                                        <a :href="'/booking?service=' + encodeURIComponent(service.name)" class="inline-flex items-center justify-center gap-1 px-4 py-3.5 bg-gray-900 hover:bg-blue-600 text-white rounded-xl font-bold text-[10px] shadow-sm active:scale-95 transition-all whitespace-nowrap">
                                            Book
                                            <span class="material-symbols-outlined text-[14px]">calendar_month</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </template>
                </div>

                <!-- Empty State -->
                <div class="flex flex-col items-center justify-center text-center py-20 px-4 bg-white border border-gray-100 rounded-[2.5rem] shadow-sm"
                     x-show="filteredServices.length === 0" 
                     x-cloak>
                    <div class="w-20 h-20 bg-gray-50 border border-dashed border-gray-200 rounded-3xl flex items-center justify-center mb-6">
                        <span class="material-symbols-outlined text-gray-400 text-4xl">search_off</span>
                    </div>
                    <h3 class="text-xl font-extrabold text-gray-900 tracking-tight">No Matching Services</h3>
                    <p class="text-sm text-gray-500 max-w-sm mt-2 leading-relaxed font-medium">
                        We couldn't find any repairs matching "<span class="font-bold text-gray-700" x-text="search"></span>". Try checking your spelling or adjusting your category shortcut filter.
                    </p>
                    <button @click="search = ''; selectedCategory = 'all'" class="mt-6 px-6 py-3 bg-gray-900 text-white text-xs font-bold rounded-xl active:scale-95 transition-all shadow-md">
                        Clear Search & Filters
                    </button>
                </div>

            </div>
        </section>

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
                  <img :src="imageUrl" class="max-w-full max-h-[75vh] rounded-[2rem] object-contain shadow-2xl">
             </div>
        </div>

    </main>
</x-layouts.landing>
<div class="w-full">
    {{-- Custom Alpine Toast --}}
    @if (session('success'))
        <div x-data="{ show: true }" 
            x-init="setTimeout(() => show = false, 5000)" 
            x-show="show" 
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 -translate-y-4"
            x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 -translate-y-4"
            class="fixed top-6 left-1/2 -translate-x-1/2 z-[200] max-w-sm w-full bg-white border border-blue-100 shadow-2xl rounded-2xl p-4 flex items-center gap-4 border-l-4 border-l-blue-500">
            <div class="w-10 h-10 bg-blue-50 text-blue-600 rounded-full flex items-center justify-center shrink-0">
                <span class="material-symbols-outlined text-[20px]">check_circle</span>
            </div>
            <div class="flex-1">
                <h4 class="text-sm font-bold text-gray-900 leading-none">Booking Confirmed!</h4>
                <p class="text-[11px] text-gray-500 mt-1.5 leading-snug">{{ session('success') }}</p>
            </div>
            <button @click="show = false" class="text-gray-300 hover:text-gray-500 shrink-0">
                <span class="material-symbols-outlined text-[18px]">close</span>
            </button>
        </div>
    @endif

    <div class="mb-8 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="text-3xl font-bold text-gray-900 tracking-tight">Welcome back, {{ Auth::user()->first_name ?? Auth::user()->name ?? 'User' }}!</h1>
            <p class="text-gray-500 mt-1">Here's a quick overview of your device repairs.</p>
        </div>
        <a href="/user/book-appointment" class="inline-flex items-center justify-center gap-2 bg-gray-900 hover:bg-gray-800 text-white px-5 py-2.5 rounded-lg font-semibold transition-colors shadow-md">
            <span class="material-symbols-outlined text-[20px]">add</span>
            New Repair
        </a>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">

        <div class="bg-white p-6 rounded-2xl border border-gray-200 shadow-sm flex flex-col justify-between">
            <div class="flex items-start justify-between mb-4">
                <div>
                    <p class="text-xs font-bold text-gray-500 uppercase tracking-wider">Total Repairs</p>
                    <h3 class="text-3xl font-extrabold text-gray-900 mt-1">{{ $totalCount ?? 0 }}</h3>
                </div>
                <div class="w-12 h-12 flex items-center justify-center bg-blue-50 text-blue-600 rounded-xl">
                    <span class="material-symbols-outlined text-2xl">calendar_today</span>
                </div>
            </div>
            <div class="flex items-center text-sm">
                <span class="text-blue-600 font-bold flex items-center"><span class="material-symbols-outlined text-[18px] mr-1">trending_up</span>+2</span>
                <span class="text-gray-400 ml-2 font-medium">this month</span>
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl border border-gray-200 shadow-sm flex flex-col justify-between">
            <div class="flex items-start justify-between mb-4">
                <div>
                    <p class="text-xs font-bold text-gray-500 uppercase tracking-wider">Completed</p>
                    <h3 class="text-3xl font-extrabold text-gray-900 mt-1">{{ $completedCount ?? 0 }}</h3>
                </div>
                <div class="w-12 h-12 flex items-center justify-center bg-green-50 text-green-600 rounded-xl">
                    <span class="material-symbols-outlined text-2xl">task_alt</span>
                </div>
            </div>
            <div class="flex items-center text-sm">
                <span class="text-green-600 font-bold flex items-center"><span class="material-symbols-outlined text-[18px] mr-1">verified</span>100%</span>
                <span class="text-gray-400 ml-2 font-medium">success rate</span>
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl border border-gray-200 shadow-sm flex flex-col justify-between">
            <div class="flex items-start justify-between mb-4">
                <div>
                    <p class="text-xs font-bold text-gray-500 uppercase tracking-wider">In Progress</p>
                    <h3 class="text-3xl font-extrabold text-gray-900 mt-1">{{ $activeRepairsCount ?? 0 }}</h3>
                </div>
                <div class="w-12 h-12 flex items-center justify-center bg-orange-50 text-orange-600 rounded-xl">
                    <span class="material-symbols-outlined text-2xl">build</span>
                </div>
            </div>
            <div class="flex items-center text-sm">
                <span class="text-orange-600 font-bold flex items-center"><span class="material-symbols-outlined text-[18px] mr-1">sync</span>Action Required</span>
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl border border-gray-200 shadow-sm flex flex-col justify-between">
            <div class="flex items-start justify-between mb-4">
                <div>
                    <p class="text-xs font-bold text-gray-500 uppercase tracking-wider">Pending</p>
                    <h3 class="text-3xl font-extrabold text-gray-900 mt-1">{{ $upcomingCount ?? 0 }}</h3>
                </div>
                <div class="w-12 h-12 flex items-center justify-center bg-purple-50 text-purple-600 rounded-xl">
                    <span class="material-symbols-outlined text-2xl">pending_actions</span>
                </div>
            </div>
            <div class="flex items-center text-sm font-medium">
                <span class="text-gray-400 flex items-center"><span class="material-symbols-outlined text-[18px] mr-1">hourglass_empty</span>Awaiting approval</span>
            </div>
        </div>

    </div>

    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden transition-shadow hover:shadow-md duration-300 w-full">

        <div class="px-6 py-5 border-b border-gray-100 flex items-center justify-between bg-white">
            <h2 class="text-lg font-bold text-gray-900 flex items-center gap-2">
                <span class="material-symbols-outlined text-gray-400">history</span>
                Recent Activity
            </h2>
            <a href="/user/upcoming-appointments" class="text-sm font-bold text-blue-600 hover:text-blue-800 transition-colors hidden sm:block">View all</a>
        </div>

        <div class="overflow-x-auto w-full">
            <table class="w-full text-left whitespace-nowrap min-w-[800px]">
                <thead class="bg-gray-50 text-gray-500 text-xs uppercase tracking-wider font-bold border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-4">Device</th>
                        <th class="px-6 py-4">Service Required</th>
                        <th class="px-6 py-4">Date Submitted</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4">Quote</th>
                        <th class="px-6 py-4 text-right">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-sm">

                    {{-- Dynamic Livewire Loop --}}
                    @forelse($recentRepairs as $repair)
                    <tr class="hover:bg-gray-50 transition-colors group">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center flex-shrink-0">
                                    <span class="material-symbols-outlined text-[20px] text-gray-600">smartphone</span>
                                </div>
                                <span class="font-bold text-gray-900">{{ $repair->device_brand ?? 'Unknown Device' }} {{ $repair->device_model ?? '' }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-gray-600 font-medium">{{ $repair->fault_category ?? 'General Service' }}</td>
                        <td class="px-6 py-4 text-gray-500">
                            {{ $repair->created_at ? \Carbon\Carbon::parse($repair->created_at)->format('M d, Y') : 'Unknown Date' }}
                        </td>
                        <td class="px-6 py-4">
                            @if(isset($repair->status) && strtolower($repair->status) === 'completed')
                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-bold bg-green-50 text-green-700 border border-green-200">
                                <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span> Completed
                            </span>
                            @elseif(isset($repair->status) && (strtolower($repair->status) === 'in progress' || strtolower($repair->status) === 'scheduled'))
                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-bold bg-orange-50 text-orange-700 border border-orange-200">
                                <span class="w-1.5 h-1.5 rounded-full bg-orange-500 animate-pulse"></span> {{ ucfirst($repair->status) }}
                            </span>
                            @else
                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-bold bg-gray-100 text-gray-700 border border-gray-200">
                                <span class="w-1.5 h-1.5 rounded-full bg-gray-500"></span> Pending
                            </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 font-bold text-gray-900">₱{{ number_format($repair->quote ?? 0, 2) }}</td>
                        <td class="px-6 py-4 text-right">
                            <button wire:click="viewDetails({{ $repair->id }})" class="inline-flex items-center justify-center bg-gray-900 hover:bg-gray-850 text-white px-4 py-2 rounded-xl text-xs font-bold transition-all shadow-sm transform hover:-translate-y-0.5 active:translate-y-0">Details</button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                             No recent activity found.
                        </td>
                    </tr>
                    @endforelse

                </tbody>
            </table>
        </div>

        <div class="px-6 py-4 border-t border-gray-100 bg-gray-50 text-center sm:hidden">
            <a href="/user/upcoming-appointments" class="text-sm text-blue-600 font-bold block w-full py-2 bg-white rounded-lg border border-gray-200 shadow-sm">
                View All Appointments
            </a>
        </div>

    </div>

    <!-- ===== OUR REPAIR SERVICES CATALOG ===== -->
    <div class="mt-12 mb-12"
         x-data="{
             search: '',
             selectedCategory: 'all',
             openLightbox: false,
             imageUrl: '',
             services: [],
             get filteredServices() {
                 return this.services.filter(s => {
                     const matchesSearch = s.name.toLowerCase().includes(this.search.toLowerCase()) || s.description.toLowerCase().includes(this.search.toLowerCase());
                     const matchesCategory = this.selectedCategory === 'all' || s.category === this.selectedCategory;
                     return matchesSearch && matchesCategory;
                 });
             }
         }"
         x-init="services = JSON.parse($el.getAttribute('data-services'))"
         data-services="{{ json_encode(array_map(fn($s) => [
             'id' => $s->id,
             'name' => $s->name,
             'description' => $s->description,
             'base_price' => $s->base_price,
             'image_path' => asset($s->image_path),
             'gallery_paths' => array_map(fn($path) => asset($path), $s->gallery_paths ?: []),
             'category' => $s->category ?: 'hardware',
             'categoryName' => match($s->category ?: 'hardware') {
                 'screen' => 'Screen & Display',
                 'power' => 'Power & Charging',
                 'audio' => 'Audio & Sound',
                 'software' => 'Software & Systems',
                 default => 'Hardware & Modules',
             }
         ], $services->all())) }}">
    
    <!-- Heading & Search Bar Row -->
        <div class="mb-8 flex flex-col lg:flex-row lg:items-center justify-between gap-6">
            <div>
                <h2 class="text-2xl font-black text-gray-900 tracking-tight flex items-center gap-2">
                    <span class="material-symbols-outlined text-blue-650 bg-blue-50 p-2 rounded-2xl">build_circle</span>
                    Explore Repair Services
                </h2>
                <p class="text-sm text-gray-500 mt-1 font-medium">Explore transparent pricing and professional repair catalogs</p>
            </div>

            <!-- Sleek Search input -->
            <div class="relative w-full lg:max-w-md shrink-0">
                <span class="absolute left-4 top-1/2 -translate-y-1/2 material-symbols-outlined text-gray-400 text-[20px]">search</span>
                <input type="text" x-model="search" placeholder="Search for screens, battery replacement..." 
                    class="w-full pl-11 pr-10 py-3 bg-white border border-gray-200 rounded-[1.25rem] focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition-all outline-none text-xs font-bold text-gray-900 shadow-sm">
                <button x-show="search.length > 0" @click="search = ''" class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-900 transition-colors">
                    <span class="material-symbols-outlined text-sm">close</span>
                </button>
            </div>
        </div>

        <!-- Shortcut Filter Pills -->
        <div class="flex flex-wrap items-center gap-1.5 bg-white p-1.5 rounded-[1.25rem] mb-8 w-full border border-gray-200/80 shadow-sm">
            <button @click="selectedCategory = 'all'" 
                :class="selectedCategory === 'all' ? 'bg-[#111827] text-white shadow-md transform scale-105' : 'text-gray-550 hover:bg-gray-50 hover:text-gray-900 bg-transparent'"
                class="px-5 py-2.5 rounded-[1rem] text-[10px] font-black uppercase tracking-wider transition-all duration-300 active:scale-95 inline-flex items-center gap-2">
                <span class="material-symbols-outlined text-[18px]">grid_view</span>
                All Repairs
            </button>
            <button @click="selectedCategory = 'screen'" 
                :class="selectedCategory === 'screen' ? 'bg-[#111827] text-white shadow-md transform scale-105' : 'text-gray-550 hover:bg-gray-50 hover:text-gray-900 bg-transparent'"
                class="px-5 py-2.5 rounded-[1rem] text-[10px] font-black uppercase tracking-wider transition-all duration-300 active:scale-95 inline-flex items-center gap-2">
                <span class="material-symbols-outlined text-[18px]">smartphone</span>
                Screen & Display
            </button>
            <button @click="selectedCategory = 'power'" 
                :class="selectedCategory === 'power' ? 'bg-[#111827] text-white shadow-md transform scale-105' : 'text-gray-550 hover:bg-gray-50 hover:text-gray-900 bg-transparent'"
                class="px-5 py-2.5 rounded-[1rem] text-[10px] font-black uppercase tracking-wider transition-all duration-300 active:scale-95 inline-flex items-center gap-2">
                <span class="material-symbols-outlined text-[18px]">battery_charging_full</span>
                Power & Battery
            </button>
            <button @click="selectedCategory = 'audio'" 
                :class="selectedCategory === 'audio' ? 'bg-[#111827] text-white shadow-md transform scale-105' : 'text-gray-550 hover:bg-gray-50 hover:text-gray-900 bg-transparent'"
                class="px-5 py-2.5 rounded-[1rem] text-[10px] font-black uppercase tracking-wider transition-all duration-300 active:scale-95 inline-flex items-center gap-2">
                <span class="material-symbols-outlined text-[18px]">volume_up</span>
                Audio & Sound
            </button>
            <button @click="selectedCategory = 'software'" 
                :class="selectedCategory === 'software' ? 'bg-[#111827] text-white shadow-md transform scale-105' : 'text-gray-550 hover:bg-gray-50 hover:text-gray-900 bg-transparent'"
                class="px-5 py-2.5 rounded-[1rem] text-[10px] font-black uppercase tracking-wider transition-all duration-300 active:scale-95 inline-flex items-center gap-2">
                <span class="material-symbols-outlined text-[18px]">terminal</span>
                Software & OS
            </button>
            <button @click="selectedCategory = 'hardware'" 
                :class="selectedCategory === 'hardware' ? 'bg-[#111827] text-white shadow-md transform scale-105' : 'text-gray-550 hover:bg-gray-50 hover:text-gray-900 bg-transparent'"
                class="px-5 py-2.5 rounded-[1rem] text-[10px] font-black uppercase tracking-wider transition-all duration-300 active:scale-95 inline-flex items-center gap-2">
                <span class="material-symbols-outlined text-[18px]">memory</span>
                Hardware & Modules
            </button>
        </div>

        <!-- Services Card Grid -->
        <div class="relative min-h-[300px]">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" x-show="filteredServices.length > 0">
                <template x-for="service in filteredServices" :key="service.id">
                    <div class="bg-white rounded-[2rem] border border-gray-200 shadow-sm hover:shadow-lg hover:-translate-y-1.5 transition-all duration-300 overflow-hidden flex flex-col group">
                        
                        <!-- Image Container with Zoom -->
                        <div class="relative h-48 overflow-hidden bg-gray-50 shrink-0">
                            <img :src="service.image_path" 
                                 @click="imageUrl = service.image_path; openLightbox = true"
                                 class="w-full h-full object-cover cursor-zoom-in group-hover:scale-110 transition-transform duration-500" 
                                 :alt="service.name">
                            
                            <!-- Badges -->
                            <span :class="{
                                      'bg-blue-50 text-blue-600 border border-blue-100': service.category === 'screen',
                                      'bg-amber-50 text-amber-600 border border-amber-100': service.category === 'power',
                                      'bg-emerald-50 text-emerald-600 border border-emerald-100': service.category === 'audio',
                                      'bg-purple-50 text-purple-600 border border-purple-100': service.category === 'software',
                                      'bg-indigo-50 text-indigo-600 border border-indigo-100': service.category === 'hardware'
                                  }"
                                  class="absolute top-4 left-4 px-3.5 py-1.5 rounded-full text-[9px] font-black uppercase tracking-wider shadow-sm bg-white"
                                  x-text="service.categoryName">
                            </span>
                        </div>

                        <!-- Card Body -->
                        <div class="p-6 flex flex-col flex-1">
                            <h3 class="text-lg font-black text-gray-900 tracking-tight mb-2 group-hover:text-blue-600 transition-colors" x-text="service.name"></h3>
                            
                            <div class="relative h-16 overflow-hidden mb-4">
                                <p class="text-xs text-gray-500 leading-relaxed font-medium" x-text="service.description"></p>
                                <div class="absolute bottom-0 left-0 right-0 h-8 bg-gradient-to-t from-white to-transparent pointer-events-none"></div>
                            </div>
                            
                            <!-- Price & Call to Actions -->
                            <div class="flex items-center justify-between pt-4 border-t border-gray-100 mt-auto">
                                <div class="flex flex-col">
                                    <span class="text-[9px] font-black text-gray-400 uppercase tracking-wider leading-none">Starting from</span>
                                    <span class="text-xl font-black text-gray-900 mt-1" x-text="'₱' + Number(service.base_price).toLocaleString()"></span>
                                </div>
                                <div class="flex items-center gap-1.5 shrink-0">
                                    <a :href="'/user/services/' + service.id" class="inline-flex items-center justify-center px-3.5 py-3 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-xl font-bold text-[10px] active:scale-95 transition-all whitespace-nowrap">
                                        Details
                                    </a>
                                    <a :href="'/user/book-appointment?service=' + encodeURIComponent(service.name)" class="inline-flex items-center justify-center gap-1 px-3.5 py-3 bg-gray-900 hover:bg-blue-600 text-white rounded-xl font-bold text-[10px] shadow-sm active:scale-95 transition-all whitespace-nowrap">
                                        Book
                                        <span class="material-symbols-outlined text-[13px] leading-none">calendar_month</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </template>
            </div>

            <!-- Empty State -->
            <div class="flex flex-col items-center justify-center text-center py-16 px-4 bg-white border border-gray-200 rounded-[2rem] shadow-sm"
                 x-show="filteredServices.length === 0" 
                 x-cloak>
                <div class="w-16 h-16 bg-gray-50 border border-dashed border-gray-200 rounded-2xl flex items-center justify-center mb-4">
                    <span class="material-symbols-outlined text-gray-455 text-3xl">search_off</span>
                </div>
                <h4 class="text-base font-black text-gray-900 tracking-tight">No Matching Services</h4>
                <p class="text-xs text-gray-550 max-w-xs mt-1.5 leading-relaxed font-medium">
                    We couldn't find any repairs matching "<span class="font-bold text-gray-700" x-text="search"></span>". Try another term or reset categories!
                </p>
                <button @click="search = ''; selectedCategory = 'all'" class="mt-5 px-5 py-2.5 bg-gray-900 text-white text-[10px] font-black uppercase tracking-wider rounded-xl active:scale-95 transition-all shadow-md">
                    Clear Filters
                </button>
            </div>
        </div>

        <!-- Dynamic Lightbox Modal -->
        <div x-show="openLightbox" 
             class="fixed inset-0 z-[120] flex items-center justify-center p-4 sm:p-6" 
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
                  class="relative bg-white/10 backdrop-blur-md rounded-[2rem] overflow-hidden max-w-2xl w-full p-3 border border-white/20 shadow-2xl flex flex-col items-center justify-center z-30">
                  <button @click="openLightbox = false" class="absolute top-4 right-4 text-red-500 hover:text-red-650 active:scale-90 transition-all z-40">
                      <span class="material-symbols-outlined text-[32px] font-bold">close</span>
                  </button>
                  <img :src="imageUrl" class="max-w-full max-h-[70vh] rounded-xl object-contain shadow-2xl">
             </div>
        </div>
    </div>

    <!-- Appointment Details Modal -->
    <div x-data="{ open: @entangle('showDetailsModal') }"
         x-show="open"
         x-cloak
         class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-gray-900/60 backdrop-blur-md"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         @keydown.escape.window="open = false; $wire.closeDetails()">

        <div class="bg-white rounded-[2rem] shadow-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto transform transition-all flex flex-col" 
             x-show="open"
             @click.outside="open = false; $wire.closeDetails()"
             x-transition:enter="ease-out duration-300"
             x-transition:enter-start="opacity-0 scale-95 translate-y-4"
             x-transition:enter-end="opacity-100 scale-100 translate-y-0"
             x-transition:leave="ease-in duration-200"
             x-transition:leave-start="opacity-100 scale-100 translate-y-0"
             x-transition:leave-end="opacity-0 scale-95 translate-y-4">
            
            @if($selectedAppointment)
                <!-- Modal Header -->
                <div class="sticky top-0 bg-gray-900 border-b border-gray-800 px-6 py-5 flex items-center justify-between shrink-0 rounded-t-[2rem] z-10">
                    <h2 class="text-xl font-bold text-white">Appointment Details</h2>
                    <button wire:click="closeDetails()" class="text-gray-400 hover:text-white transition-colors">
                        <span class="material-symbols-outlined text-[24px]">close</span>
                    </button>
                </div>

                <!-- Modal Body -->
                <div class="p-6 space-y-6 flex-1 overflow-y-auto">
                    <!-- Device Information Section -->
                    <div class="bg-gray-50 rounded-2xl p-5 border border-gray-200">
                        <h3 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-4">Device Information</h3>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <p class="text-xs text-gray-500 font-medium mb-1">Brand</p>
                                <p class="text-gray-900 font-semibold">{{ $selectedAppointment->device_brand ?? 'N/A' }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 font-medium mb-1">Model</p>
                                <p class="text-gray-900 font-semibold">{{ $selectedAppointment->device_model ?? 'N/A' }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Service Information Section -->
                    <div class="bg-gray-50 rounded-2xl p-5 border border-gray-200">
                        <h3 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-4">Service Information</h3>
                        <div class="space-y-3">
                            <div>
                                <p class="text-xs text-gray-500 font-medium mb-1">Issue Category</p>
                                <p class="text-gray-900 font-semibold">{{ $selectedAppointment->fault_category ?? 'N/A' }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 font-medium mb-1">Description</p>
                                <p class="text-gray-700 leading-relaxed text-sm">{{ $selectedAppointment->description ?? 'No description provided' }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Appointment Details Section -->
                    <div class="bg-gray-50 rounded-2xl p-5 border border-gray-200">
                        <h3 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-4">Appointment Details</h3>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <p class="text-xs text-gray-500 font-medium mb-1">Tracking Code</p>
                                <p class="text-gray-900 font-mono font-bold">{{ $selectedAppointment->tracking_code ?? 'N/A' }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 font-medium mb-1">Status</p>
                                <div class="mt-1">
                                    @if($selectedAppointment->status == 'Completed')
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-bold bg-green-50 text-green-700 border border-green-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span>
                                        Completed
                                    </span>
                                    @elseif($selectedAppointment->status == 'In Progress' || $selectedAppointment->status == 'Scheduled')
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-bold bg-orange-50 text-orange-700 border border-orange-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-orange-500 animate-pulse"></span>
                                        {{ $selectedAppointment->status }}
                                    </span>
                                    @else
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-bold bg-gray-100 text-gray-700 border border-gray-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-gray-500"></span>
                                        {{ $selectedAppointment->status ?? 'Pending' }}
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 font-medium mb-1">Scheduled Date & Time</p>
                                <p class="text-gray-900 font-semibold">
                                    {{ $selectedAppointment->pref_date ? \Carbon\Carbon::parse($selectedAppointment->pref_date)->format('M d, Y') : 'N/A' }}
                                    <br>
                                    <span class="text-sm font-normal text-gray-500">{{ $selectedAppointment->pref_time ? \Carbon\Carbon::parse($selectedAppointment->pref_time)->format('h:i A') : 'N/A' }}</span>
                                </p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 font-medium mb-1">Quote Amount</p>
                                <p class="text-gray-900 font-bold text-lg">₱{{ number_format($selectedAppointment->quote ?? 0, 2) }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Cost Information (if completed) -->
                    @if($selectedAppointment->status == 'Completed')
                    <div class="bg-blue-50/50 rounded-2xl p-5 border border-blue-150">
                        <h3 class="text-xs font-bold text-blue-500 uppercase tracking-wider mb-4">Completion Details</h3>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <p class="text-xs text-gray-500 font-medium mb-1">Final Cost</p>
                                <p class="text-gray-900 font-bold text-lg">₱{{ number_format($selectedAppointment->final_cost ?? 0, 2) }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 font-medium mb-1">Completed Date</p>
                                <p class="text-gray-900 font-semibold">
                                    {{ $selectedAppointment->completed_at ? \Carbon\Carbon::parse($selectedAppointment->completed_at)->format('M d, Y') : 'N/A' }}
                                </p>
                            </div>
                            @if($selectedAppointment->invoice_number)
                            <div>
                                <p class="text-xs text-gray-500 font-medium mb-1">Invoice Number</p>
                                <p class="text-gray-900 font-mono font-bold">{{ $selectedAppointment->invoice_number }}</p>
                            </div>
                            @endif
                            @if($selectedAppointment->completion_notes)
                            <div class="col-span-2">
                                <p class="text-xs text-gray-500 font-medium mb-1">Technician Notes</p>
                                <p class="text-gray-700 text-sm leading-relaxed">{{ $selectedAppointment->completion_notes }}</p>
                            </div>
                            @endif
                        </div>
                    </div>
                    @endif
                </div>

                <!-- Modal Footer -->
                <div class="sticky bottom-0 bg-gray-50 border-t border-gray-100 px-6 py-5 flex items-center justify-between gap-3 flex-wrap shrink-0 rounded-b-[2rem]">
                    <div class="flex gap-2 flex-wrap">
                        @if($selectedAppointment->status == 'Completed' && $selectedAppointment->invoice_number)
                        <a href="{{ route('user.appointment.invoice-view', $selectedAppointment->id) }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2.5 rounded-xl font-bold transition-all text-sm shadow-md shadow-emerald-100 hover:shadow-none">
                            <span class="material-symbols-outlined text-[18px]">receipt</span>
                            View Invoice
                        </a>
                        @endif
                        @if($selectedAppointment->status == 'Completed')
                        <a href="{{ route('user.appointment.receipt-view', $selectedAppointment->id) }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2.5 rounded-xl font-bold transition-all text-sm shadow-md shadow-blue-100 hover:shadow-none">
                            <span class="material-symbols-outlined text-[18px]">receipt_long</span>
                            View Receipt
                        </a>
                        @endif
                    </div>
                    <button wire:click="closeDetails()" class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-5 py-2.5 rounded-xl font-bold transition-all text-sm">
                        Close
                    </button>
                </div>
            @endif
        </div>
    </div>

</div>
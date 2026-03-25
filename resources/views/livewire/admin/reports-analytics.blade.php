<div class="w-full">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Analytics</h1>
        <p class="text-gray-600 mt-1">Key metrics and performance insights for your business.</p>
    </div>

    <div class="mb-6 flex gap-2">
        <button wire:click="$set('period', 'daily')" :class="period === 'daily' ? 'bg-gray-900 text-white' : 'bg-gray-100 text-gray-700'" class="px-4 py-2 rounded-lg font-medium hover:opacity-80 transition-all text-sm">Daily</button>
        <button wire:click="$set('period', 'weekly')" :class="period === 'weekly' ? 'bg-gray-900 text-white' : 'bg-gray-100 text-gray-700'" class="px-4 py-2 rounded-lg font-medium hover:opacity-80 transition-all text-sm">Weekly</button>
        <button wire:click="$set('period', 'monthly')" :class="period === 'monthly' ? 'bg-gray-900 text-white' : 'bg-gray-100 text-gray-700'" class="px-4 py-2 rounded-lg font-medium hover:opacity-80 transition-all text-sm">Monthly</button>
        <button wire:click="$set('period', 'yearly')" :class="period === 'yearly' ? 'bg-gray-900 text-white' : 'bg-gray-100 text-gray-700'" class="px-4 py-2 rounded-lg font-medium hover:opacity-80 transition-all text-sm">Yearly</button>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        @foreach($analyticsData as $data)
            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-6 hover:shadow-md transition-shadow">
                <div class="flex items-start justify-between mb-2">
                    <h3 class="text-sm font-semibold text-gray-600">{{ $data['metric'] }}</h3>
                    @if($data['trend'] === 'up')
                        <span class="text-green-600 text-xs font-bold flex items-center gap-0.5">
                            <span class="material-symbols-outlined text-[14px]">trending_up</span>
                            {{ $data['change'] }}
                        </span>
                    @else
                        <span class="text-red-600 text-xs font-bold flex items-center gap-0.5">
                            <span class="material-symbols-outlined text-[14px]">trending_down</span>
                            {{ $data['change'] }}
                        </span>
                    @endif
                </div>
                <p class="text-3xl font-bold text-gray-900">{{ $data['value'] }}</p>
            </div>
        @endforeach
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                <h2 class="font-bold text-gray-900 flex items-center gap-2">
                    <span class="material-symbols-outlined">bar_chart</span>
                    Top Services by Revenue
                </h2>
            </div>
            <div class="p-6">
                <div class="space-y-4">
                    @foreach($topServices as $service)
                        <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                            <div class="flex-1">
                                <div class="flex items-center gap-3 mb-2">
                                    <span class="w-8 h-8 flex items-center justify-center bg-blue-600 text-white rounded-full text-xs font-bold">{{ $service['rank'] }}</span>
                                    <p class="font-semibold text-gray-900">{{ $service['service'] }}</p>
                                </div>
                                <p class="text-xs text-gray-500">{{ $service['count'] }} bookings</p>
                            </div>
                            <div class="text-right">
                                <p class="font-bold text-gray-900">{{ $service['revenue'] }}</p>
                                <div class="w-20 h-2 bg-gray-200 rounded-full mt-2 overflow-hidden">
                                    <div class="h-full bg-blue-600 rounded-full" style="width: {{ ($service['rank'] / count($topServices)) * 100 }}%"></div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                <h2 class="font-bold text-gray-900 flex items-center gap-2">
                    <span class="material-symbols-outlined">assessment</span>
                    Performance Summary
                </h2>
            </div>
            <div class="p-6 space-y-4">
                <div class="p-4 bg-green-50 border border-green-100 rounded-lg">
                    <div class="flex justify-between items-center mb-2">
                        <p class="font-semibold text-gray-900">Customer Satisfaction</p>
                        <span class="text-sm font-bold text-green-600">↑ 5.2%</span>
                    </div>
                    <div class="w-full h-2 bg-green-200 rounded-full overflow-hidden">
                        <div class="h-full bg-green-600 rounded-full" style="width: 92%"></div>
                    </div>
                    <p class="text-xs text-gray-600 mt-2">92% satisfaction rating</p>
                </div>

                <div class="p-4 bg-blue-50 border border-blue-100 rounded-lg">
                    <div class="flex justify-between items-center mb-2">
                        <p class="font-semibold text-gray-900">Service Efficiency</p>
                        <span class="text-sm font-bold text-blue-600">↑ 3.1%</span>
                    </div>
                    <div class="w-full h-2 bg-blue-200 rounded-full overflow-hidden">
                        <div class="h-full bg-blue-600 rounded-full" style="width: 88%"></div>
                    </div>
                    <p class="text-xs text-gray-600 mt-2">88% on-time completion</p>
                </div>

                <div class="p-4 bg-purple-50 border border-purple-100 rounded-lg">
                    <div class="flex justify-between items-center mb-2">
                        <p class="font-semibold text-gray-900">Growth Index</p>
                        <span class="text-sm font-bold text-purple-600">↑ 12%</span>
                    </div>
                    <div class="w-full h-2 bg-purple-200 rounded-full overflow-hidden">
                        <div class="h-full bg-purple-600 rounded-full" style="width: 85%"></div>
                    </div>
                    <p class="text-xs text-gray-600 mt-2">12% month-over-month growth</p>
                </div>
            </div>
        </div>
    </div>
</div>

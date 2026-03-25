<div class="w-full">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Reports</h1>
        <p class="text-gray-600 mt-1">View, generate, and download system reports.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
        <div>
            <label class="block text-sm font-bold text-gray-700 mb-2">Report Type</label>
            <select wire:model="reportType" class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                <option value="monthly">Monthly</option>
                <option value="quarterly">Quarterly</option>
                <option value="yearly">Yearly</option>
                <option value="custom">Custom Date Range</option>
            </select>
        </div>
        <div>
            <label class="block text-sm font-bold text-gray-700 mb-2">Date From</label>
            <input type="date" wire:model="dateFrom" class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
        </div>
        <div>
            <label class="block text-sm font-bold text-gray-700 mb-2">Date To</label>
            <input type="date" wire:model="dateTo" class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
        </div>
        <div class="flex items-end">
            <button class="w-full px-4 py-2.5 bg-gray-900 text-white rounded-lg font-medium hover:bg-gray-800 transition-colors flex items-center justify-center gap-2">
                <span class="material-symbols-outlined text-[18px]">search</span>
                Generate
            </button>
        </div>
    </div>

    <div class="grid grid-cols-1 gap-6">
        @forelse($reports as $report)
            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-6 hover:shadow-md transition-shadow">
                <div class="flex items-start justify-between mb-4">
                    <div>
                        <h3 class="text-lg font-bold text-gray-900">{{ $report['title'] }}</h3>
                        <p class="text-sm text-gray-600 mt-1">{{ $report['description'] }}</p>
                    </div>
                    <div class="text-right">
                        @if($report['status'] === 'Completed')
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-green-50 text-green-700 border border-green-100 rounded-lg text-xs font-bold">Completed</span>
                        @else
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-yellow-50 text-yellow-700 border border-yellow-100 rounded-lg text-xs font-bold">Draft</span>
                        @endif
                    </div>
                </div>

                <div class="bg-gray-50 rounded-lg p-4 mb-4">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <p class="text-xs text-gray-600">Generated</p>
                            <p class="text-sm font-semibold text-gray-900">{{ $report['date'] }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-600">Metric</p>
                            <p class="text-sm font-semibold text-gray-900">
                                {{ $report['amount'] ?? $report['rating'] ?? $report['metric'] ?? $report['growth'] }}
                            </p>
                        </div>
                    </div>
                </div>

                <div class="flex gap-2">
                    <button class="px-4 py-2 text-blue-600 bg-blue-50 hover:bg-blue-100 rounded-lg text-sm font-medium transition-colors flex items-center gap-2">
                        <span class="material-symbols-outlined text-[16px]">visibility</span>
                        View
                    </button>
                    <button class="px-4 py-2 text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-lg text-sm font-medium transition-colors flex items-center gap-2">
                        <span class="material-symbols-outlined text-[16px]">download</span>
                        Download
                    </button>
                </div>
            </div>
        @empty
            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-12 text-center">
                <span class="material-symbols-outlined text-[48px] text-gray-300 inline-block mb-2">description</span>
                <p class="text-gray-600">No reports found. Generate a report to get started.</p>
            </div>
        @endforelse
    </div>
</div>

<div class="w-full">

    <div class="mb-8 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="text-3xl font-bold text-gray-900 tracking-tight flex items-center gap-2">
                Appointment History
            </h1>
            <p class="text-gray-500 mt-1">Review all your past repair appointments and invoices.</p>
        </div>

        <button class="flex items-center gap-2 bg-white border border-gray-200 text-gray-700 hover:bg-gray-50 px-4 py-2 rounded-lg font-bold shadow-sm transition-colors shrink-0">
            <span class="material-symbols-outlined text-[20px]">download</span>
            Export Records
        </button>
    </div>

    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden transition-shadow hover:shadow-md duration-300">
        <div class="overflow-x-auto w-full">
            <table class="w-full text-left whitespace-nowrap">
                <thead class="bg-gray-50 text-gray-500 text-xs uppercase tracking-wider font-bold border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-5">Device</th>
                        <th class="px-6 py-5">Service Provided</th>
                        <th class="px-6 py-5">Date</th>
                        <th class="px-6 py-5">Status</th>
                        <th class="px-6 py-5">Final Cost</th>
                        <th class="px-6 py-5 text-right">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-sm">

                    @forelse($history as $item)
                    <tr class="hover:bg-gray-50 transition-colors group">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center flex-shrink-0 border border-gray-200">
                                    <span class="material-symbols-outlined text-[20px] text-gray-600">
                                        {{ str_contains(strtolower($item->device_brand), 'apple') ? 'laptop_mac' : 'smartphone' }}
                                    </span>
                                </div>
                                <div>
                                    <span class="block font-bold text-gray-900">{{ $item->device_brand }} {{ $item->device_model }}</span>
                                    <span class="block text-xs text-gray-500 font-medium">Ticket: #{{ $item->tracking_code }}</span>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-gray-600 font-medium">{{ $item->fault_category }}</td>
                        <td class="px-6 py-4 text-gray-500">{{ \Carbon\Carbon::parse($item->pref_date)->format('M d, Y') }}</td>
                        <td class="px-6 py-4">
                            @if($item->status == 'Completed')
                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-bold bg-green-50 text-green-700 border border-green-200">
                                <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span>
                                Completed
                            </span>
                            @else
                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-bold bg-red-50 text-red-700 border border-red-200">
                                <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span>
                                {{ $item->status }}
                            </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 font-bold text-gray-900">
                            {{ $item->status == 'Completed' ? '₱' . number_format($item->quote ?? 0, 2) : '₱0.00' }}
                        </td>
                        <td class="px-6 py-4 text-right">
                            <a href="#" class="inline-flex items-center text-blue-600 hover:text-blue-800 font-bold group-hover:underline">
                                View Receipt
                                <span class="material-symbols-outlined text-[16px] ml-1">receipt_long</span>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-20 text-center">
                            <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4">
                                <span class="material-symbols-outlined text-gray-300 text-4xl">folder_open</span>
                            </div>
                            <h3 class="text-lg font-bold text-gray-900">No history found</h3>
                            <p class="text-gray-500">You haven't completed any repair appointments yet.</p>
                        </td>
                    </tr>
                    @endforelse

                </tbody>
            </table>
        </div>

        <div class="px-6 py-4 border-t border-gray-100 bg-white">
            {{ $history->links() }}
        </div>

    </div>
</div>
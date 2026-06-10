<div class="w-full">

    <div class="mb-8 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="text-3xl font-[Montserrat] font-extrabold text-gray-900 dark:text-white tracking-tight flex items-center gap-2">
                Appointment History
            </h1>
            <p class="text-gray-500 dark:text-gray-400 mt-1 font-medium">Review all your past repair appointments and invoices.</p>
        </div>
        <button
            wire:click="exportRecords()"
            class="flex items-center gap-2 bg-white border border-brand-200 text-gray-700 hover:bg-gray-50 px-4 py-2 rounded-full font-bold shadow-sm transition-colors shrink-0">
            <span class="material-symbols-outlined text-[20px]">download</span>
            Export Records
        </button>
    </div>

    <div class="bg-white rounded-2xl border border-brand-200 shadow-sm overflow-hidden transition-shadow hover:shadow-md duration-300">
        <div class="overflow-x-auto w-full">
            <table class="w-full text-left whitespace-nowrap">
                <thead class="bg-gray-50 text-gray-500 text-xs uppercase tracking-wider font-bold border-b border-brand-200">
                    <tr>
                        <th class="px-6 py-5">Device</th>
                        <th class="px-6 py-5">Service Provided</th>
                        <th class="px-6 py-5">Date</th>
                        <th class="px-6 py-5">Status</th>
                        <th class="px-6 py-5">Final Cost</th>
                        <th class="px-6 py-5 text-right">Downloads</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-brand-100 text-sm" wire:loading.remove>

                    @forelse($history as $item)
                    <tr class="hover:bg-gray-50 transition-colors group">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center flex-shrink-0 border border-brand-200">
                                    <span class="material-symbols-outlined text-[20px] text-gray-600">
                                        {{ str_contains(strtolower($item->device_brand), 'apple') ? 'laptop_mac' : 'smartphone' }}
                                    </span>
                                </div>
                                <div>
                                    <span class="block font-bold text-gray-900">{{ $item->device_brand }} {{ $item->device_model }}</span>
                                    <span class="block text-xs text-gray-500 font-medium">Booking Ref: {{ $item->booking_number ?? $item->tracking_code }}</span>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-gray-600 font-medium">{{ $item->fault_category }}</td>
                        <td class="px-6 py-4 text-gray-500">{{ \Carbon\Carbon::parse($item->pref_date)->format('M d, Y') }}</td>
                        <td class="px-6 py-4">
                            @php
                                $statusLower = strtolower($item->status);
                            @endphp
                            @if($statusLower === 'completed')
                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-bold bg-green-50 text-green-700 border border-green-200 dark:bg-green-500/10 dark:text-green-400 dark:border-green-500/20">
                                <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span>
                                Completed
                            </span>
                            @elseif(in_array($statusLower, ['cancelled', 'rejected', 'failed']))
                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-bold bg-red-50 text-red-700 border border-red-200 dark:bg-red-500/10 dark:text-red-400 dark:border-red-500/20">
                                <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span>
                                {{ ucfirst($item->status) }}
                            </span>
                            @elseif(in_array($statusLower, ['in progress', 'processing', 'ongoing']))
                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-bold bg-blue-50 text-blue-700 border border-blue-200 dark:bg-blue-500/10 dark:text-blue-400 dark:border-blue-500/20">
                                <span class="w-1.5 h-1.5 rounded-full bg-blue-500"></span>
                                {{ ucfirst($item->status) }}
                            </span>
                            @elseif(in_array($statusLower, ['pending', 'scheduled', 'approved']))
                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-bold bg-amber-50 text-amber-700 border border-amber-200 dark:bg-amber-500/10 dark:text-amber-400 dark:border-amber-500/20">
                                <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                                {{ ucfirst($item->status) }}
                            </span>
                            @else
                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-bold bg-gray-50 text-gray-700 border border-gray-200 dark:bg-gray-500/10 dark:text-gray-400 dark:border-gray-500/20">
                                <span class="w-1.5 h-1.5 rounded-full bg-gray-500"></span>
                                {{ ucfirst($item->status) }}
                            </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 font-bold text-gray-900">
                            {{ strtolower($item->status) === 'completed' ? '₱' . number_format($item->final_cost ?? $item->quote ?? 0, 2) : '₱0.00' }}
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex items-center justify-end gap-2">
                                @if(strtolower($item->status) === 'completed' && $item->invoice_number)
                                <div class="group relative">
                                    <a href="javascript:void(0)" class="flex items-center justify-center w-8 h-8 rounded-full bg-emerald-50 hover:bg-emerald-100 dark:bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 border border-emerald-200/30 hover:scale-105 transition-all cursor-pointer">
                                        <span class="material-symbols-outlined text-[18px]">receipt</span>
                                    </a>
                                    <div class="absolute right-0 bottom-full mb-2 hidden group-hover:flex flex-col gap-0.5 bg-white dark:bg-[#0d1527] border border-gray-200/60 dark:border-white/5 text-gray-800 dark:text-gray-200 text-xs rounded-xl shadow-xl z-20 whitespace-nowrap p-1 min-w-[120px] transition-all">
                                        <a href="{{ route('user.appointment.invoice-view', $item->id) }}" target="_blank" rel="noopener noreferrer" class="px-3 py-2 hover:bg-gray-50 dark:hover:bg-white/5 rounded-lg text-left font-bold transition-colors text-gray-750 dark:text-gray-200">View Invoice</a>
                                        <a href="{{ route('user.appointment.invoice', $item->id) }}" class="px-3 py-2 hover:bg-gray-50 dark:hover:bg-white/5 rounded-lg text-left font-bold transition-colors text-gray-750 dark:text-gray-200">Download PDF</a>
                                    </div>
                                </div>
                                @endif
                                <div class="group relative">
                                    <a href="javascript:void(0)" class="flex items-center justify-center w-8 h-8 rounded-full bg-blue-50 hover:bg-blue-100 dark:bg-blue-500/10 text-blue-600 dark:text-blue-400 border border-blue-200/30 hover:scale-105 transition-all cursor-pointer">
                                        <span class="material-symbols-outlined text-[18px]">receipt_long</span>
                                    </a>
                                    <div class="absolute right-0 bottom-full mb-2 hidden group-hover:flex flex-col gap-0.5 bg-white dark:bg-[#0d1527] border border-gray-200/60 dark:border-white/5 text-gray-800 dark:text-gray-200 text-xs rounded-xl shadow-xl z-20 whitespace-nowrap p-1 min-w-[120px] transition-all">
                                        <a href="{{ route('user.appointment.receipt-view', $item->id) }}" target="_blank" rel="noopener noreferrer" class="px-3 py-2 hover:bg-gray-50 dark:hover:bg-white/5 rounded-lg text-left font-bold transition-colors text-gray-750 dark:text-gray-200">View Receipt</a>
                                        <a href="{{ route('user.appointment.receipt', $item->id) }}" class="px-3 py-2 hover:bg-gray-50 dark:hover:bg-white/5 rounded-lg text-left font-bold transition-colors text-gray-750 dark:text-gray-200">Download PDF</a>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-20 text-center">
                            <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4">
                                <span class="material-symbols-outlined text-gray-300 text-4xl">folder_open</span>
                            </div>
                            <h3 class="text-lg font-bold text-gray-900 mb-1">No history found</h3>
                            <p class="text-gray-500">You haven't completed any repair appointments yet.</p>
                        </td>
                    </tr>
                    @endforelse

                </tbody>

                <tbody class="divide-y divide-brand-100 dark:divide-white/5 text-sm" wire:loading>
                    @for ($i = 0; $i < 5; $i++)
                        <tr class="animate-pulse">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-full bg-gray-200 dark:bg-white/10 shrink-0"></div>
                                    <div class="space-y-1.5 flex-1">
                                        <div class="h-4 w-28 bg-gray-250 dark:bg-white/15 rounded"></div>
                                        <div class="h-3 w-36 bg-gray-200 dark:bg-white/10 rounded"></div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="h-4 w-24 bg-gray-200 dark:bg-white/10 rounded"></div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="h-4 w-20 bg-gray-200 dark:bg-white/10 rounded"></div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="h-6 w-16 bg-gray-200 dark:bg-white/10 rounded-lg"></div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="h-4 w-16 bg-gray-200 dark:bg-white/10 rounded"></div>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="h-8 w-16 bg-gray-200 dark:bg-white/10 rounded-lg ml-auto"></div>
                            </td>
                        </tr>
                    @endfor
                </tbody>
            </table>
        </div>

        <div class="laravel-pagination px-6 py-4 border-t border-brand-100 bg-white">
            {{ $history->links(data: ['scrollTo' => false]) }}
        </div>

    </div>
</div>
<div class="w-full">
    <div class="mb-8 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="text-3xl font-bold text-gray-900 tracking-tight">Appointments</h1>
            <p class="text-gray-500 mt-1">Tingnan lahat ng appointments at manage ang status</p>
        </div>
    </div>

    @if (session()->has('message'))
        <div class="mb-4 p-4 rounded-lg bg-green-50 border border-green-200 text-green-700 font-semibold">{{ session('message') }}</div>
    @endif

    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
        <div class="px-6 py-5 border-b border-gray-100 flex items-center justify-between gap-4">
            <h2 class="text-lg font-bold text-gray-900">Lahat ng Appointments</h2>
            <input wire:model.debounce.300ms="search" type="text" placeholder="Maghanap ng device, customer, ticket ID..." class="px-4 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent w-full md:max-w-sm" />
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-gray-100 bg-gray-50">
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Device</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Customer</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Ticket ID</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Issue</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Type</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse ($appointments as $appointment)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4">
                                <span class="font-medium text-gray-900 text-sm">{{ $appointment->device_brand }} {{ $appointment->device_model }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-gray-600 text-sm">{{ $appointment->user?->getFullName() ?? 'Guest' }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="font-mono text-sm font-bold text-gray-900">{{ $appointment->tracking_code }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-gray-600 text-sm">{{ $appointment->fault_category }}</span>
                            </td>
                            <td class="px-6 py-4">
                                @if($appointment->user_id)
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 bg-green-100 text-green-700 rounded text-xs font-semibold">
                                        <span class="material-symbols-outlined text-[14px]">person_check</span>
                                        User
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 bg-orange-100 text-orange-700 rounded text-xs font-semibold">
                                        <span class="material-symbols-outlined text-[14px]">person_add</span>
                                        Guest
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                @php
                                    $statusColor = match($appointment->status) {
                                        'Completed' => 'green',
                                        'In Progress' => 'orange',
                                        'Ready for Pickup' => 'blue',
                                        'Scheduled' => 'indigo',
                                        'Pending' => 'yellow',
                                        'Cancelled' => 'red',
                                        default => 'gray'
                                    };
                                    $statusBgClass = "bg-{$statusColor}-50 text-{$statusColor}-700 border-{$statusColor}-100";
                                @endphp
                                <span class="inline-flex items-center gap-1 px-3 py-1 {{ $statusBgClass }} border rounded-lg text-xs font-bold">
                                    {{ $appointment->status }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <a href="{{ route('admin.appointment.details', ['id' => $appointment->id]) }}" class="inline-flex items-center gap-1.5 px-3 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-bold text-xs transition-colors">
                                    <span class="material-symbols-outlined text-[16px]">open_in_new</span>
                                    View Details
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-8 text-center">
                                <div class="flex flex-col items-center gap-2">
                                    <span class="material-symbols-outlined text-gray-300 text-5xl">event_busy</span>
                                    <p class="text-gray-500 font-medium">Walang appointments na makita</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-6 py-4 border-t border-gray-100 bg-gray-50">
            {{ $appointments->links() }}
        </div>
    </div>
</div>

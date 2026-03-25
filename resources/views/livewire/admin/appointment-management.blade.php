<div class="w-full">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Appointment Management</h1>
        <p class="text-gray-600 mt-1">Assign staff and manage appointment schedules.</p>
    </div>

    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Customer</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Device • Service</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Date & Time</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Technician</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($appointments as $appointment)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($appointment['user']) }}&background=2563eb&color=ffffff" alt="{{ $appointment['user'] }}" class="w-10 h-10 rounded-full object-cover">
                                    <p class="font-semibold text-gray-900 text-sm">{{ $appointment['user'] }}</p>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-600">
                                <div>
                                    <p class="font-medium text-gray-900">{{ $appointment['device'] }}</p>
                                    <p class="text-xs text-gray-500">{{ $appointment['service'] }}</p>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-600">
                                <div>
                                    <p class="font-medium text-gray-900">{{ $appointment['date'] }}</p>
                                    <p class="text-xs text-gray-500">{{ $appointment['time'] }}</p>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-sm">
                                @if($appointment['technician'] === 'Unassigned')
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-gray-50 text-gray-700 border border-gray-100 rounded-lg text-xs font-bold">
                                        <span class="material-symbols-outlined text-[14px]">person_add</span>
                                        Unassigned
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 text-gray-900 font-medium text-sm">{{ $appointment['technician'] }}</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                @if($appointment['status'] === 'Completed')
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-green-50 text-green-700 border border-green-100 rounded-lg text-xs font-bold">Completed</span>
                                @elseif($appointment['status'] === 'In Progress')
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-blue-50 text-blue-700 border border-blue-100 rounded-lg text-xs font-bold">In Progress</span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-yellow-50 text-yellow-700 border border-yellow-100 rounded-lg text-xs font-bold">Pending</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-sm">
                                <div class="flex items-center gap-2">
                                    <button class="px-3 py-1.5 bg-blue-50 text-blue-600 hover:bg-blue-100 rounded-lg text-xs font-bold transition-colors">Assign</button>
                                    <button class="p-2 hover:bg-amber-50 text-amber-600 rounded-lg transition-colors" title="Edit">
                                        <span class="material-symbols-outlined text-[18px]">edit</span>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                                <p class="font-medium">No appointments found</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

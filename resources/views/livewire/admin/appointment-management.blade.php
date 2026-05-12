<div class="w-full">
    <div class="mb-8 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="text-3xl font-bold text-gray-900 tracking-tight">Appointment Management</h1>
            <p class="text-gray-500 mt-1">Manage and update appointment statuses.</p>
        </div>
    </div>

    @if (session()->has('message'))
        <div class="mb-4 p-4 rounded-lg bg-green-50 border border-green-200 text-green-700">{{ session('message') }}</div>
    @endif

    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
        <div class="px-6 py-5 border-b border-gray-100 flex items-center justify-between flex-wrap gap-4">
            <h2 class="text-lg font-bold text-gray-900">Manage Appointments</h2>
            <div class="flex gap-2 flex-wrap">
                <input
                    wire:model.live="search"
                    type="text"
                    placeholder="Search by customer or device..."
                    class="px-4 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500"
                />
                <select
                    wire:model.live="statusFilter"
                    class="px-4 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500">
                    <option value="all">All Status</option>
                    <option value="Completed">Completed</option>
                    <option value="In Progress">In Progress</option>
                    <option value="Pending">Pending</option>
                    <option value="Approved">Approved</option>
                    <option value="Cancelled">Cancelled</option>
                </select>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-gray-100 bg-gray-50">
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">ID</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Device</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Customer</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Date</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($appointments as $appointment)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4"><span class="font-medium text-gray-900">{{ $appointment->tracking_code }}</span></td>
                        <td class="px-6 py-4"><span class="text-gray-600">{{ $appointment->device_brand }} {{ $appointment->device_model }}</span></td>
                        <td class="px-6 py-4">
                            <div>
                                <span class="text-gray-900 font-medium">{{ ($appointment->user?->first_name ?? 'Unknown') . ' ' . ($appointment->user?->last_name ?? 'Customer') }}</span>
                                <p class="text-xs text-gray-500">{{ $appointment->user?->email ?? 'No Email' }}</p>
                            </div>
                        </td>
                        <td class="px-6 py-4"><span class="text-gray-600">{{ $appointment->pref_date?->format('M d, Y') }}</span></td>
                        <td class="px-6 py-4">
                            @php
                            $statusColors = [
                                'Completed' => 'bg-green-50 text-green-700 border-green-100',
                                'In Progress' => 'bg-orange-50 text-orange-700 border-orange-100',
                                'Pending' => 'bg-gray-100 text-gray-700 border-gray-200',
                                'Approved' => 'bg-blue-50 text-blue-700 border-blue-100',
                                'Cancelled' => 'bg-red-50 text-red-700 border-red-100',
                            ];
                            $colorClass = $statusColors[$appointment->status] ?? $statusColors['Pending'];
                            @endphp
                            <select
                                wire:change="updateStatus({{ $appointment->id }}, $event.target.value)"
                                class="px-3 py-1 text-xs font-bold border rounded-lg {{ $colorClass }} cursor-pointer">
                                <option value="Pending">Pending</option>
                                <option value="Approved">Approved</option>
                                <option value="In Progress">In Progress</option>
                                <option value="Completed">Completed</option>
                                <option value="Cancelled">Cancelled</option>
                            </select>
                        </td>
                        <td class="px-6 py-4">
                            <button
                                wire:click="deleteAppointment({{ $appointment->id }})"
                                wire:confirm="Are you sure you want to delete this appointment?"
                                class="text-red-600 hover:text-red-800 font-bold text-sm">Delete</button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-10 text-center text-gray-500">
                            <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4">
                                <span class="material-symbols-outlined text-gray-300 text-4xl">event_busy</span>
                            </div>
                            <h3 class="text-lg font-bold text-gray-900">No appointments found</h3>
                            <p class="text-sm">Try adjusting your search or filters.</p>
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

    <!-- Complete Appointment Modal -->
    @if($showCompleteModal && $selectedAppointment)
    <div class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black bg-opacity-50">
        <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full">
            <div class="border-b border-gray-200 px-6 py-5 flex items-center justify-between">
                <h2 class="text-xl font-bold text-gray-900">Complete Appointment</h2>
                <button
                    wire:click="closeModal()"
                    class="text-gray-400 hover:text-gray-600 transition-colors">
                    <span class="material-symbols-outlined text-[28px]">close</span>
                </button>
            </div>

            <div class="p-6 space-y-4">
                <div class="bg-gray-50 p-4 rounded-lg border border-gray-200 mb-4">
                    <p class="text-xs font-bold text-gray-500 uppercase mb-2">Appointment Details</p>
                    <p class="font-bold text-gray-900">{{ $selectedAppointment->device_brand }} {{ $selectedAppointment->device_model }}</p>
                    <p class="text-sm text-gray-600 mt-1">{{ $selectedAppointment->user?->first_name ?? 'Unknown' }} {{ $selectedAppointment->user?->last_name ?? 'Customer' }}</p>
                    <p class="text-xs text-gray-500 mt-1">{{ $selectedAppointment->fault_category }}</p>
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Final Cost <span class="text-red-500">*</span></label>
                    <div class="relative">
                        <span class="absolute left-4 top-2.5 text-lg text-gray-600">₱</span>
                        <input
                            type="number"
                            step="0.01"
                            min="0"
                            wire:model="finalCost"
                            placeholder="0.00"
                            class="w-full pl-8 pr-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Completion Notes</label>
                    <textarea
                        wire:model="completionNotes"
                        placeholder="Add any notes about the repair (e.g., parts replaced, work done)..."
                        rows="3"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent resize-none"></textarea>
                </div>

                @if($finalCost)
                <div class="bg-green-50 border border-green-200 rounded-lg p-3">
                    <p class="text-xs text-green-600 font-semibold mb-1">Total Amount</p>
                    <p class="font-bold text-lg text-green-900">₱{{ number_format($finalCost, 2) }}</p>
                </div>
                @endif
            </div>

            <div class="bg-gray-50 border-t border-gray-200 px-6 py-4 flex justify-end gap-3">
                <button
                    wire:click="closeModal()"
                    class="px-4 py-2 text-sm font-bold text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">
                    Cancel
                </button>
                <button
                    wire:click="completeAppointment()"
                    class="px-4 py-2 text-sm font-bold text-white bg-green-600 rounded-lg hover:bg-green-700 transition-colors">
                    Mark Complete
                </button>
            </div>
        </div>
    </div>
    @endif
</div>

<div class="w-full">
    <div class="mb-8 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="text-3xl font-bold text-gray-900 tracking-tight">Appointments</h1>
            <p class="text-gray-500 mt-1">View all customer repair appointments.</p>
        </div>
    </div>

    @if (session()->has('message'))
        <div class="mb-4 p-4 rounded-lg bg-green-50 border border-green-200 text-green-700">{{ session('message') }}</div>
    @endif

    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
        <div class="px-6 py-5 border-b border-gray-100 flex items-center justify-between">
            <h2 class="text-lg font-bold text-gray-900">All Appointments</h2>
            <input wire:model="search" type="text" placeholder="Search appointments..." class="px-4 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent" />
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-gray-100 bg-gray-50">
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Device</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Customer</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Issue</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Date</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse ($appointments as $appointment)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4"><span class="font-medium text-gray-900">{{ $appointment->device_brand }} {{ $appointment->device_model }}</span></td>
                            <td class="px-6 py-4"><span class="text-gray-600">{{ $appointment->user?->getFullName() ?? 'Unknown Customer' }}</span></td>
                            <td class="px-6 py-4"><span class="text-gray-600">{{ $appointment->fault_category }}</span></td>
                            <td class="px-6 py-4"><span class="text-gray-600">{{ $appointment->pref_date ? $appointment->pref_date->format('M d, Y') : 'N/A' }}</span></td>
                            <td class="px-6 py-4">
                                @php
                                    $statusColor = match($appointment->status) {
                                        'completed' => 'green',
                                        'scheduled' => 'blue', 
                                        'pending' => 'yellow',
                                        'cancelled' => 'red',
                                        default => 'gray'
                                    };
                                    $statusBgClass = "bg-{$statusColor}-50 text-{$statusColor}-700 border-{$statusColor}-100";
                                @endphp
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 {{ $statusBgClass }} border rounded-lg text-xs font-bold capitalize">
                                    {{ $appointment->status }}
                                </span>
                            </td>
                            <td class="px-6 py-4"><button wire:click="viewAppointment({{ $appointment->id }})" class="text-blue-600 hover:text-blue-800 font-bold text-sm">View</button></td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-center text-gray-500">No appointments found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-6 py-4 border-t border-gray-100">
            {{ $appointments->links() }}
        </div>
    </div>

    <!-- View Appointment Modal -->
    @if ($showViewModal && $selectedAppointment)
    <div class="fixed inset-0 bg-gray-900 bg-opacity-75 transition-opacity backdrop-blur-sm flex items-center justify-center z-50 p-4">
        <div class="bg-white rounded-2xl shadow-lg max-w-2xl w-full max-h-[90vh] overflow-y-auto">
            <div class="sticky top-0 px-6 py-5 border-b border-gray-100 flex items-center justify-between bg-white">
                <h2 class="text-xl font-bold text-gray-900">Appointment Details</h2>
                <button wire:click="closeModal" class="text-gray-500 hover:text-gray-700">
                    <span class="material-symbols-outlined">close</span>
                </button>
            </div>

            <div class="p-6 space-y-6">
                <!-- Customer Info -->
                <div>
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Customer Information</h3>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <p class="text-sm text-gray-600">Name</p>
                            <p class="font-medium text-gray-900">{{ $selectedAppointment->user?->getFullName() ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Email</p>
                            <p class="font-medium text-gray-900">{{ $selectedAppointment->user?->email ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Phone</p>
                            <p class="font-medium text-gray-900">{{ $selectedAppointment->user?->phone ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">City</p>
                            <p class="font-medium text-gray-900">{{ $selectedAppointment->user?->city ?? 'N/A' }}</p>
                        </div>
                    </div>
                </div>

                <!-- Device Info -->
                <div class="border-t border-gray-100 pt-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Device Information</h3>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <p class="text-sm text-gray-600">Brand</p>
                            <p class="font-medium text-gray-900">{{ $selectedAppointment->device_brand }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Model</p>
                            <p class="font-medium text-gray-900">{{ $selectedAppointment->device_model }}</p>
                        </div>
                        <div colspan="2">
                            <p class="text-sm text-gray-600">Fault Category</p>
                            <p class="font-medium text-gray-900">{{ $selectedAppointment->fault_category }}</p>
                        </div>
                    </div>
                </div>

                <!-- Appointment Details -->
                <div class="border-t border-gray-100 pt-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Appointment Details</h3>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <p class="text-sm text-gray-600">Tracking Code</p>
                            <p class="font-medium text-gray-900">{{ $selectedAppointment->tracking_code }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Preferred Date</p>
                            <p class="font-medium text-gray-900">{{ $selectedAppointment->pref_date->format('M d, Y') }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Preferred Time</p>
                            <p class="font-medium text-gray-900">{{ $selectedAppointment->pref_time }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Current Status</p>
                            <p class="font-medium text-gray-900 capitalize">{{ $selectedAppointment->status }}</p>
                        </div>
                    </div>
                    <div class="mt-4">
                        <p class="text-sm text-gray-600">Description</p>
                        <p class="font-medium text-gray-900">{{ $selectedAppointment->description ?? 'No description provided' }}</p>
                    </div>
                </div>

                <!-- Update Status -->
                <div class="border-t border-gray-100 pt-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Update Status</h3>
                    <div class="flex gap-2">
                        <button wire:click="updateStatus({{ $selectedAppointment->id }}, 'pending')" class="px-4 py-2 bg-yellow-100 text-yellow-700 rounded-lg hover:bg-yellow-200 font-medium text-sm">Pending</button>
                        <button wire:click="updateStatus({{ $selectedAppointment->id }}, 'scheduled')" class="px-4 py-2 bg-blue-100 text-blue-700 rounded-lg hover:bg-blue-200 font-medium text-sm">Scheduled</button>
                        <button wire:click="updateStatus({{ $selectedAppointment->id }}, 'completed')" class="px-4 py-2 bg-green-100 text-green-700 rounded-lg hover:bg-green-200 font-medium text-sm">Completed</button>
                        <button wire:click="updateStatus({{ $selectedAppointment->id }}, 'cancelled')" class="px-4 py-2 bg-red-100 text-red-700 rounded-lg hover:bg-red-200 font-medium text-sm">Cancelled</button>
                    </div>
                </div>

                <div class="border-t border-gray-100 pt-6 flex justify-end">
                    <button wire:click="closeModal" class="px-6 py-2 bg-gray-900 text-white rounded-lg font-bold hover:bg-gray-800">Close</button>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>

<div class="w-full">
    <div class="mb-8 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="text-3xl font-bold text-gray-900 tracking-tight">Reports</h1>
            <p class="text-gray-500 mt-1">Generate business and operational reports.</p>
        </div>
        <div class="flex gap-2">
            <button wire:click="exportReport" class="inline-flex items-center gap-2 bg-green-600 text-white hover:bg-green-700 px-4 py-2 rounded-lg font-bold shadow-md transition-colors">
                <span class="material-symbols-outlined text-[20px]">download</span>
                Export Repairs
            </button>
            <button wire:click="exportAppointmentReport" class="inline-flex items-center gap-2 bg-blue-600 text-white hover:bg-blue-700 px-4 py-2 rounded-lg font-bold shadow-md transition-colors">
                <span class="material-symbols-outlined text-[20px]">download</span>
                Export Appointments
            </button>
        </div>
    </div>

    @if (session()->has('success'))
        <div class="mb-4 p-4 rounded-lg bg-green-50 border border-green-200 text-green-700">{{ session('success') }}</div>
    @endif

    @if (session()->has('error'))
        <div class="mb-4 p-4 rounded-lg bg-red-50 border border-red-200 text-red-700">{{ session('error') }}</div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-10">
        <!-- Repair Statistics -->
        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-6">
            <h3 class="text-lg font-bold text-gray-900 mb-4">Repair Statistics</h3>
            <div class="space-y-3">
                <div class="flex items-center justify-between">
                    <span class="text-gray-600">Total Repairs</span>
                    <span class="text-lg font-bold text-gray-900">{{ $repairStats['total'] }}</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-gray-600">Pending</span>
                    <span class="text-lg font-bold text-yellow-600">{{ $repairStats['pending'] }}</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-gray-600">In Progress</span>
                    <span class="text-lg font-bold text-orange-600">{{ $repairStats['in_progress'] }}</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-gray-600">Completed</span>
                    <span class="text-lg font-bold text-green-600">{{ $repairStats['completed'] }}</span>
                </div>
            </div>
        </div>

        <!-- Appointment Statistics -->
        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-6">
            <h3 class="text-lg font-bold text-gray-900 mb-4">Appointment Statistics</h3>
            <div class="space-y-3">
                <div class="flex items-center justify-between">
                    <span class="text-gray-600">Total Appointments</span>
                    <span class="text-lg font-bold text-gray-900">{{ $appointmentStats['total'] }}</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-gray-600">Pending</span>
                    <span class="text-lg font-bold text-yellow-600">{{ $appointmentStats['pending'] }}</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-gray-600">Scheduled</span>
                    <span class="text-lg font-bold text-blue-600">{{ $appointmentStats['scheduled'] }}</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-gray-600">Completed</span>
                    <span class="text-lg font-bold text-green-600">{{ $appointmentStats['completed'] }}</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-gray-600">Cancelled</span>
                    <span class="text-lg font-bold text-red-600">{{ $appointmentStats['cancelled'] }}</span>
                </div>
            </div>
        </div>

        <!-- User Statistics -->
        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-6">
            <h3 class="text-lg font-bold text-gray-900 mb-4">User Statistics</h3>
            <div class="space-y-3">
                <div class="flex items-center justify-between">
                    <span class="text-gray-600">Total Users</span>
                    <span class="text-lg font-bold text-gray-900">{{ $userStats['total_users'] }}</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-gray-600">Active Users</span>
                    <span class="text-lg font-bold text-green-600">{{ $userStats['active_users'] }}</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-gray-600">Total Admins</span>
                    <span class="text-lg font-bold text-blue-600">{{ $userStats['total_admins'] }}</span>
                </div>
            </div>
        </div>

        <!-- Inventory Statistics -->
        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-6">
            <h3 class="text-lg font-bold text-gray-900 mb-4">Inventory Statistics</h3>
            <div class="space-y-3">
                <div class="flex items-center justify-between">
                    <span class="text-gray-600">Total Items</span>
                    <span class="text-lg font-bold text-gray-900">{{ $inventoryStats['total_items'] }}</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-gray-600">Low Stock</span>
                    <span class="text-lg font-bold text-yellow-600">{{ $inventoryStats['low_stock'] }}</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-gray-600">Out of Stock</span>
                    <span class="text-lg font-bold text-red-600">{{ $inventoryStats['out_of_stock'] }}</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-gray-600">Total Value</span>
                    <span class="text-lg font-bold text-green-600">₱{{ number_format($inventoryStats['total_value'], 2) }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Data -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Recent Repairs -->
        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
            <div class="px-6 py-5 border-b border-gray-100">
                <h3 class="text-lg font-bold text-gray-900">Recent Repairs</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-gray-100 bg-gray-50">
                            <th class="px-4 py-3 text-left text-xs font-bold text-gray-700">Device</th>
                            <th class="px-4 py-3 text-left text-xs font-bold text-gray-700">Customer</th>
                            <th class="px-4 py-3 text-left text-xs font-bold text-gray-700">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse ($recentRepairs as $repair)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3 text-sm font-medium text-gray-900">{{ $repair->device_name }}</td>
                                <td class="px-4 py-3 text-sm text-gray-600">{{ $repair->user->getFullName() }}</td>
                                <td class="px-4 py-3">
                                    <span class="inline-flex px-2 py-1 text-xs font-bold rounded {{ 
                                        $repair->status === 'Completed' ? 'bg-green-50 text-green-700' :
                                        ($repair->status === 'In Progress' ? 'bg-orange-50 text-orange-700' : 'bg-yellow-50 text-yellow-700')
                                    }}">
                                        {{ $repair->status }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-4 py-4 text-center text-gray-500">No repairs found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Recent Appointments -->
        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
            <div class="px-6 py-5 border-b border-gray-100">
                <h3 class="text-lg font-bold text-gray-900">Recent Appointments</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-gray-100 bg-gray-50">
                            <th class="px-4 py-3 text-left text-xs font-bold text-gray-700">Device</th>
                            <th class="px-4 py-3 text-left text-xs font-bold text-gray-700">Customer</th>
                            <th class="px-4 py-3 text-left text-xs font-bold text-gray-700">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse ($recentAppointments as $appointment)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3 text-sm font-medium text-gray-900">{{ $appointment->device_brand }} {{ $appointment->device_model }}</td>
                                <td class="px-4 py-3 text-sm text-gray-600">{{ $appointment->user?->getFullName() ?? 'Unknown Customer' }}</td>
                                <td class="px-4 py-3">
                                    <span class="inline-flex px-2 py-1 text-xs font-bold rounded {{ 
                                        $appointment->status === 'completed' ? 'bg-green-50 text-green-700' :
                                        ($appointment->status === 'scheduled' ? 'bg-blue-50 text-blue-700' :
                                        ($appointment->status === 'cancelled' ? 'bg-red-50 text-red-700' : 'bg-yellow-50 text-yellow-700'))
                                    }}">
                                        {{ ucfirst($appointment->status) }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-4 py-4 text-center text-gray-500">No appointments found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="container mx-auto px-4 py-6">
    <div class="bg-white rounded-lg shadow-lg p-6">
        <h1 class="text-3xl font-bold mb-6">Appointment Reschedule Management</h1>

        <!-- Filters -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
            <div>
                <select wire:model="filter" class="w-full border rounded px-3 py-2">
                    <option value="all">All Appointments</option>
                    <option value="reschedulable">Reschedulable</option>
                    <option value="rescheduled">Already Rescheduled</option>
                    <option value="no_show">No-Show</option>
                </select>
            </div>
            <div>
                <input type="text" wire:model="searchTerm" placeholder="Search by name, email, or booking #" 
                       class="w-full border rounded px-3 py-2">
            </div>
            <div class="text-right">
                <span class="text-gray-600">Showing {{ count($appointments) }} appointments</span>
            </div>
        </div>

        <!-- Appointments Table -->
        <div class="overflow-x-auto">
            <table class="min-w-full border-collapse border">
                <thead class="bg-blue-100">
                    <tr>
                        <th class="border px-4 py-2">Booking #</th>
                        <th class="border px-4 py-2">Customer</th>
                        <th class="border px-4 py-2">Device</th>
                        <th class="border px-4 py-2">Scheduled For</th>
                        <th class="border px-4 py-2">Status</th>
                        <th class="border px-4 py-2">Reschedules</th>
                        <th class="border px-4 py-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($appointments as $appointment)
                        <tr class="hover:bg-gray-50">
                            <td class="border px-4 py-2 font-bold">{{ $appointment->booking_number }}</td>
                            <td class="border px-4 py-2">{{ $appointment->user->first_name }} {{ $appointment->user->last_name }}</td>
                            <td class="border px-4 py-2">{{ $appointment->device_brand }} {{ $appointment->device_model }}</td>
                            <td class="border px-4 py-2">
                                {{ $appointment->pref_date->format('M d, Y') }}
                                @if (now()->gt($appointment->pref_date) && $appointment->status !== 'completed')
                                    <span class="text-red-600 text-xs">(Overdue)</span>
                                @endif
                            </td>
                            <td class="border px-4 py-2">
                                <span class="px-2 py-1 rounded text-xs font-bold
                                    {{ $appointment->status === 'completed' ? 'bg-green-200 text-green-800' : 
                                       ($appointment->status === 'scheduled' ? 'bg-blue-200 text-blue-800' : 
                                        ($appointment->status === 'cancelled' ? 'bg-red-200 text-red-800' : 'bg-yellow-200 text-yellow-800')) }}">
                                    {{ ucfirst($appointment->status) }}
                                </span>
                            </td>
                            <td class="border px-4 py-2 text-center">
                                <span class="px-2 py-1 rounded {{ $appointment->reschedule_count >= 2 ? 'bg-red-200' : 'bg-green-200' }}">
                                    {{ $appointment->reschedule_count }}
                                </span>
                            </td>
                            <td class="border px-4 py-2">
                                <div class="flex gap-2">
                                    @if ($appointment->status !== 'completed' && $appointment->reschedule_count < 3)
                                        <button wire:click="rescheduleAppointment({{ $appointment->id }})" 
                                                class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded text-sm">
                                            Reschedule
                                        </button>
                                    @endif
                                    @if (now()->gt($appointment->pref_date) && $appointment->status === 'scheduled')
                                        <button wire:click="markAsNoShow({{ $appointment->id }})" 
                                                class="bg-orange-600 hover:bg-orange-700 text-white px-3 py-1 rounded text-sm">
                                            No-Show
                                        </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-6">
            {{ $appointments->links() }}
        </div>

        <!-- Reschedule Modal -->
        @if ($showRescheduleModal && $selectedAppointment)
            <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
                <div class="bg-white rounded-lg p-6 max-w-md">
                    <h2 class="text-2xl font-bold mb-4">Reschedule Appointment</h2>
                    <p class="mb-4 text-gray-600">Booking: {{ $selectedAppointment->booking_number }}</p>

                    <form wire:submit="confirmReschedule">
                        <div class="mb-4">
                            <label class="block font-bold mb-2">Reschedule Reason</label>
                            <select wire:model="rescheduleType" class="w-full border rounded px-3 py-2">
                                <option value="user_no_show">User No-Show</option>
                                <option value="technician_unavailable">Technician Unavailable</option>
                                <option value="admin_initiated">Admin Initiated</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="block font-bold mb-2">New Date</label>
                            <input type="date" wire:model="rescheduleDate" class="w-full border rounded px-3 py-2">
                        </div>

                        <div class="mb-4">
                            <label class="block font-bold mb-2">New Time</label>
                            <input type="time" wire:model="rescheduleTime" class="w-full border rounded px-3 py-2">
                        </div>

                        <div class="mb-4">
                            <label class="block font-bold mb-2">Reason/Notes</label>
                            <textarea wire:model="rescheduleReason" rows="3" class="w-full border rounded px-3 py-2"></textarea>
                        </div>

                        <div class="flex gap-2">
                            <button type="submit" class="flex-1 bg-green-600 hover:bg-green-700 text-white font-bold py-2 rounded">
                                Confirm
                            </button>
                            <button type="button" wire:click="$set('showRescheduleModal', false)" 
                                    class="flex-1 bg-gray-400 hover:bg-gray-500 text-white font-bold py-2 rounded">
                                Cancel
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        @endif
    </div>
</div>

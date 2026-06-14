<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-lg shadow-lg p-6">
        <h1 class="text-3xl font-bold mb-6">Reschedule Appointment</h1>

        @if ($appointment)
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <div class="bg-blue-50 p-4 rounded-lg">
                    <h3 class="font-bold text-lg mb-4">Current Appointment Details</h3>
                    <p><strong>Booking Number:</strong> {{ $appointment->booking_number }}</p>
                    <p><strong>Device:</strong> {{ $appointment->device_brand }} {{ $appointment->device_model }}</p>
                    <p><strong>Issue:</strong> {{ $appointment->fault_category }}</p>
                    <p><strong>Scheduled Date:</strong> <span class="text-red-600">{{ $appointment->pref_date->format('M d, Y - H:i') }}</span></p>
                    <p><strong>Status:</strong> <span class="badge">{{ ucfirst($appointment->status) }}</span></p>
                </div>

                <form wire:submit="rescheduleAppointment" class="bg-green-50 p-4 rounded-lg">
                    <h3 class="font-bold text-lg mb-4">New Schedule</h3>

                    <div class="mb-4">
                        <label class="block font-semibold mb-2">New Date</label>
                        <input type="date" wire:model="new_date" min="{{ $minDate }}" 
                               class="w-full border rounded px-3 py-2" required>
                        @error('new_date') <span class="text-red-600">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block font-semibold mb-2">New Time</label>
                        <input type="time" wire:model="new_time" 
                               class="w-full border rounded px-3 py-2" required>
                        @error('new_time') <span class="text-red-600">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block font-semibold mb-2">Reason (Optional)</label>
                        <select wire:model="reason" class="w-full border rounded px-3 py-2">
                            <option value="">Select a reason...</option>
                            <option value="cant_come">I can't come at that time</option>
                            <option value="health_issue">Health issue</option>
                            <option value="work_conflict">Work conflict</option>
                            <option value="family_emergency">Family emergency</option>
                            <option value="transportation">Transportation issue</option>
                            <option value="other">Other</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block font-semibold mb-2">Additional Notes</label>
                        <textarea wire:model="notes" rows="3" class="w-full border rounded px-3 py-2"></textarea>
                    </div>

                    <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-2 rounded">
                        Confirm Reschedule
                    </button>
                </form>
            </div>

            @if ($appointment->reschedule_count > 0)
                <div class="bg-yellow-50 p-4 rounded-lg">
                    <h3 class="font-bold mb-2">Reschedule History</h3>
                    <p class="text-yellow-700">This appointment has been rescheduled {{ $appointment->reschedule_count }} time(s)</p>
                </div>
            @endif
        @endif
    </div>
</div>

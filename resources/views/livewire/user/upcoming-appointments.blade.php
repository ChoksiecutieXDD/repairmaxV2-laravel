<div class="w-full">

    <div class="mb-8 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="text-3xl font-bold text-gray-900 tracking-tight">Upcoming Appointments</h1>
            <p class="text-gray-500 mt-1">Manage and track your scheduled device repairs.</p>
        </div>
        <a href="{{ route('user.book-appointment') }}" class="inline-flex items-center justify-center gap-2 bg-gray-900 hover:bg-gray-800 text-white px-5 py-2.5 rounded-lg font-semibold transition-colors shadow-md shrink-0">
            <span class="material-symbols-outlined text-[20px]">add</span>
            Book New Repair
        </a>
    </div>

    @if (session()->has('message'))
    <div class="mb-6 p-4 bg-blue-50 text-blue-700 rounded-xl border border-blue-100 flex items-center gap-2">
        <span class="material-symbols-outlined">info</span>
        {{ session('message') }}
    </div>
    @endif

    <div class="grid grid-cols-1 xl:grid-cols-2 gap-6">

        @forelse($appointments as $app)
        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm hover:shadow-md transition-all overflow-hidden">

            <div class="p-6 border-b border-gray-100 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-xl bg-gray-50 flex items-center justify-center flex-shrink-0 text-gray-600 border border-gray-100">
                        <span class="material-symbols-outlined text-[28px]">
                            {{ $app->device_brand == 'Apple' ? 'laptop_mac' : 'smartphone' }}
                        </span>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-gray-900 leading-tight">{{ $app->device_brand }} {{ $app->device_model }}</h3>
                        <p class="text-gray-500 text-sm font-medium mt-0.5">{{ $app->fault_category }}</p>
                    </div>
                </div>

                @php
                $statusClasses = [
                'In Progress' => 'bg-orange-50 text-orange-700 border-orange-200',
                'Pending' => 'bg-gray-100 text-gray-700 border-gray-200',
                'Approved' => 'bg-green-50 text-green-700 border-green-200',
                'Cancelled' => 'bg-red-50 text-red-700 border-red-200',
                ];
                $badgeClass = $statusClasses[$app->status] ?? $statusClasses['Pending'];
                @endphp

                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-bold border {{ $badgeClass }} shrink-0">
                    <span class="w-1.5 h-1.5 rounded-full {{ $app->status == 'In Progress' ? 'bg-orange-500 animate-pulse' : 'bg-current' }}"></span>
                    {{ $app->status }}
                </span>
            </div>

            <div class="p-6 bg-gray-50/30">
                <div class="flex items-center gap-2 mb-5 text-gray-900">
                    <span class="material-symbols-outlined text-gray-400 text-[20px]">calendar_clock</span>
                    <p class="font-bold text-sm">Scheduled for:
                        <span class="font-medium text-gray-600 ml-1">
                            {{ \Carbon\Carbon::parse($app->pref_date)->format('M d, Y') }} at {{ \Carbon\Carbon::parse($app->pref_time)->format('h:i A') }}
                        </span>
                    </p>
                </div>

                <div class="grid grid-cols-3 gap-4 bg-white p-4 rounded-xl border border-gray-200 shadow-sm">
                    <div>
                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Service ID</p>
                        <p class="font-mono font-bold text-gray-900 text-sm">{{ $app->tracking_code }}</p>
                    </div>
                    <div>
                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Est. Duration</p>
                        <p class="font-bold text-gray-900 text-sm flex items-center gap-1">
                            <span class="material-symbols-outlined text-[16px] text-gray-400">timer</span>
                            --
                        </p>
                    </div>
                    <div>
                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Technician</p>
                        <p class="font-bold text-gray-400 text-sm italic">Assigning...</p>
                    </div>
                </div>

                <div class="mt-6 flex justify-end gap-3">
                    @if($app->status == 'Pending')
                    <button
                        wire:click="cancelAppointment({{ $app->id }})"
                        wire:confirm="Are you sure you want to cancel this appointment?"
                        class="px-4 py-2 text-sm font-bold text-red-600 bg-white border border-red-100 rounded-lg hover:bg-red-50 transition-colors">
                        Cancel
                    </button>
                    @endif
                    <button
                        wire:click="openEdit({{ $app->id }})"
                        class="px-4 py-2 text-sm font-bold text-gray-600 bg-white border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors flex items-center gap-2">
                        <span class="material-symbols-outlined text-[18px]">edit</span>
                        Edit
                    </button>
                    <button
                        wire:click="openReschedule({{ $app->id }})"
                        class="px-4 py-2 text-sm font-bold text-gray-600 bg-white border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors">
                        Reschedule
                    </button>
                    <button
                        wire:click="showDetails({{ $app->id }})"
                        class="px-4 py-2 text-sm font-bold text-blue-700 bg-blue-50 border border-blue-100 rounded-lg hover:bg-blue-100 transition-colors">
                        View Details
                    </button>
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-full py-20 bg-white rounded-3xl border border-dashed border-gray-300 flex flex-col items-center justify-center text-center px-6">
            <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mb-4">
                <span class="material-symbols-outlined text-gray-300 text-5xl">event_busy</span>
            </div>
            <h3 class="text-xl font-bold text-gray-900">No upcoming appointments</h3>
            <p class="text-gray-500 mt-2 max-w-sm">You don't have any repairs scheduled at the moment. Need help with a device?</p>
            <a href="{{ route('user.book-appointment') }}" class="mt-6 font-bold text-blue-600 hover:text-blue-800 flex items-center gap-2">
                Book a new repair now <span class="material-symbols-outlined text-sm">arrow_forward</span>
            </a>
        </div>
        @endforelse

    </div>

    <!-- View Details Modal -->
    @if($showDetailsModal && $selectedAppointment)
    <div class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black bg-opacity-50">
        <div class="bg-white rounded-2xl shadow-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto">
            <div class="sticky top-0 bg-white border-b border-gray-200 px-6 py-5 flex items-center justify-between">
                <h2 class="text-xl font-bold text-gray-900">Appointment Details</h2>
                <button
                    wire:click="closeModals()"
                    class="text-gray-400 hover:text-gray-600 transition-colors">
                    <span class="material-symbols-outlined text-[28px]">close</span>
                </button>
            </div>

            <div class="p-6 space-y-6">
                <!-- Device Information -->
                <div>
                    <h3 class="text-sm font-bold text-gray-500 uppercase tracking-wider mb-3">Device Information</h3>
                    <div class="bg-gray-50 rounded-xl p-4 border border-gray-200">
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <p class="text-xs text-gray-500 font-semibold mb-1">Brand</p>
                                <p class="font-bold text-gray-900">{{ $selectedAppointment->device_brand }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 font-semibold mb-1">Model</p>
                                <p class="font-bold text-gray-900">{{ $selectedAppointment->device_model }}</p>
                            </div>
                            <div class="col-span-2">
                                <p class="text-xs text-gray-500 font-semibold mb-1">Issue Category</p>
                                <p class="font-bold text-gray-900">{{ $selectedAppointment->fault_category }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Description -->
                <div>
                    <h3 class="text-sm font-bold text-gray-500 uppercase tracking-wider mb-3">Description</h3>
                    <div class="bg-gray-50 rounded-xl p-4 border border-gray-200">
                        <p class="text-gray-700">{{ $selectedAppointment->description ?? 'No description provided' }}</p>
                    </div>
                </div>

                <!-- Appointment Schedule -->
                <div>
                    <h3 class="text-sm font-bold text-gray-500 uppercase tracking-wider mb-3">Scheduled Appointment</h3>
                    <div class="bg-blue-50 rounded-xl p-4 border border-blue-200">
                        <div class="flex items-center gap-2 mb-2">
                            <span class="material-symbols-outlined text-blue-600">calendar_today</span>
                            <p class="font-bold text-gray-900">{{ \Carbon\Carbon::parse($selectedAppointment->pref_date)->format('M d, Y') }}</p>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-blue-600">schedule</span>
                            <p class="font-bold text-gray-900">{{ \Carbon\Carbon::parse($selectedAppointment->pref_time)->format('h:i A') }}</p>
                        </div>
                    </div>
                </div>

                <!-- Status & Tracking -->
                <div>
                    <h3 class="text-sm font-bold text-gray-500 uppercase tracking-wider mb-3">Status & Reference</h3>
                    <div class="bg-gray-50 rounded-xl p-4 border border-gray-200 space-y-3">
                        <div>
                            <p class="text-xs text-gray-500 font-semibold mb-1">Tracking Code</p>
                            <p class="font-mono font-bold text-gray-900">{{ $selectedAppointment->tracking_code }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 font-semibold mb-1">Status</p>
                            @php
                            $statusClasses = [
                            'In Progress' => 'bg-orange-50 text-orange-700 border-orange-200',
                            'Pending' => 'bg-gray-100 text-gray-700 border-gray-200',
                            'Approved' => 'bg-green-50 text-green-700 border-green-200',
                            'Cancelled' => 'bg-red-50 text-red-700 border-red-200',
                            ];
                            $badgeClass = $statusClasses[$selectedAppointment->status] ?? $statusClasses['Pending'];
                            @endphp
                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-bold border {{ $badgeClass }}">
                                <span class="w-1.5 h-1.5 rounded-full {{ $selectedAppointment->status == 'In Progress' ? 'bg-orange-500 animate-pulse' : 'bg-current' }}"></span>
                                {{ $selectedAppointment->status }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Attached Photos -->
                @if($selectedAppointment->photo_paths && count($selectedAppointment->photo_paths) > 0)
                <div>
                    <h3 class="text-sm font-bold text-gray-500 uppercase tracking-wider mb-3">Attached Photos</h3>
                    <div class="grid grid-cols-3 gap-3">
                        @foreach($selectedAppointment->photo_paths as $photo)
                        @php
                            $isVideo = in_array(pathinfo($photo, PATHINFO_EXTENSION), ['mp4', 'mov', 'avi', 'webm', 'mpeg', 'mkv', '3gp']);
                        @endphp
                        @if($isVideo)
                        <div class="aspect-square bg-gray-100 rounded-lg border border-gray-200 overflow-hidden relative flex items-center justify-center">
                            <video src="{{ asset('storage/' . $photo) }}" class="w-full h-full object-cover" controls muted playsinline></video>
                        </div>
                        @else
                        <div class="aspect-square bg-gray-100 rounded-lg border border-gray-200 overflow-hidden">
                            <img src="{{ asset('storage/' . $photo) }}" alt="Device photo" class="w-full h-full object-cover">
                        </div>
                        @endif
                        @endforeach
                    </div>
                </div>
                @endif
            </div>

            <div class="sticky bottom-0 bg-gray-50 border-t border-gray-200 px-6 py-4 flex justify-end gap-3">
                <button
                    wire:click="closeModals()"
                    class="px-4 py-2 text-sm font-bold text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">
                    Close
                </button>
            </div>
        </div>
    </div>
    @endif

    <!-- Reschedule Modal -->
    @if($showRescheduleModal && $selectedAppointment)
    <div class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black bg-opacity-50">
        <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full">
            <div class="border-b border-gray-200 px-6 py-5 flex items-center justify-between">
                <h2 class="text-xl font-bold text-gray-900">Reschedule Appointment</h2>
                <button
                    wire:click="closeModals()"
                    class="text-gray-400 hover:text-gray-600 transition-colors">
                    <span class="material-symbols-outlined text-[28px]">close</span>
                </button>
            </div>

            <div class="p-6 space-y-4">
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Select New Date</label>
                    <input
                        type="date"
                        wire:model="rescheduleDate"
                        min="{{ now()->format('Y-m-d') }}"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Select New Time</label>
                    <input
                        type="time"
                        wire:model="rescheduleTime"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>

                @if($rescheduleDate && $rescheduleTime)
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-3">
                    <p class="text-xs text-blue-600 font-semibold mb-1">New Appointment Time</p>
                    <p class="font-bold text-blue-900">
                        {{ \Carbon\Carbon::parse($rescheduleDate)->format('M d, Y') }} at {{ \Carbon\Carbon::parse($rescheduleTime)->format('h:i A') }}
                    </p>
                </div>
                @endif
            </div>

            <div class="bg-gray-50 border-t border-gray-200 px-6 py-4 flex justify-end gap-3">
                <button
                    wire:click="closeModals()"
                    class="px-4 py-2 text-sm font-bold text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">
                    Cancel
                </button>
                <button
                    wire:click="saveReschedule()"
                    class="px-4 py-2 text-sm font-bold text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition-colors">
                    Save Changes
                </button>
            </div>
        </div>
    </div>
    @endif

    <!-- Edit Modal -->
    @if($showEditModal && $selectedAppointment)
    <div class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black bg-opacity-50">
        <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full">
            <div class="border-b border-gray-200 px-6 py-5 flex items-center justify-between">
                <h2 class="text-xl font-bold text-gray-900">Edit Appointment</h2>
                <button
                    wire:click="closeModals()"
                    class="text-gray-400 hover:text-gray-600 transition-colors">
                    <span class="material-symbols-outlined text-[28px]">close</span>
                </button>
            </div>

            <div class="p-6 space-y-4">
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Device Brand <span class="text-red-500">*</span></label>
                    <input
                        type="text"
                        wire:model="editDeviceBrand"
                        placeholder="e.g., Apple, Samsung"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Device Model</label>
                    <input
                        type="text"
                        wire:model="editDeviceModel"
                        placeholder="e.g., iPhone 14, Galaxy S23"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Issue Category <span class="text-red-500">*</span></label>
                    <select
                        wire:model="editFaultCategory"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="">Select issue category</option>
                        <option value="Screen">Screen</option>
                        <option value="Battery">Battery</option>
                        <option value="Charging">Charging</option>
                        <option value="Software">Software</option>
                        <option value="Hardware">Hardware</option>
                        <option value="Water Damage">Water Damage</option>
                        <option value="Other">Other</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Description</label>
                    <textarea
                        wire:model="editDescription"
                        placeholder="Describe the issue in detail..."
                        rows="3"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent resize-none"></textarea>
                </div>
            </div>

            <div class="bg-gray-50 border-t border-gray-200 px-6 py-4 flex justify-end gap-3">
                <button
                    wire:click="closeModals()"
                    class="px-4 py-2 text-sm font-bold text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">
                    Cancel
                </button>
                <button
                    wire:click="saveEdit()"
                    class="px-4 py-2 text-sm font-bold text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition-colors">
                    Save Changes
                </button>
            </div>
        </div>
    </div>
    @endif
</div>
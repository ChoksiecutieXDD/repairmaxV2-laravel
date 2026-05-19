<div class="w-full max-w-5xl mx-auto">
    <!-- Header Section -->
    <div class="mb-8 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="text-3xl font-bold text-gray-900 tracking-tight">Appointment Details</h1>
            <p class="text-gray-500 mt-1">View at ma-manage ang appointment information</p>
        </div>
        <a href="{{ route('admin.appointment') }}" class="px-6 py-2 bg-gray-200 hover:bg-gray-300 text-gray-900 rounded-lg font-bold transition-colors">
            ← Bumalik
        </a>
    </div>

    @if (session()->has('message'))
        <div class="mb-4 p-4 rounded-lg bg-green-50 border border-green-200 text-green-700 font-medium">{{ session('message') }}</div>
    @endif
    @if (session()->has('error'))
        <div class="mb-4 p-4 rounded-lg bg-red-50 border border-red-200 text-red-700 font-medium">{{ session('error') }}</div>
    @endif

    @if ($appointment)
    <div class="space-y-6">
        <!-- Status & Type Indicator Card -->
        <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-2xl border border-blue-200 p-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Status -->
                <div>
                    <p class="text-sm text-gray-600 font-semibold mb-1">Current Status</p>
                    <div class="flex items-center gap-2">
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
                            $statusBgClass = "bg-{$statusColor}-100 text-{$statusColor}-700 border-{$statusColor}-200";
                        @endphp
                        <span class="inline-flex items-center gap-1.5 px-4 py-2 {{ $statusBgClass }} border rounded-xl text-sm font-bold capitalize">
                            <span class="material-symbols-outlined text-base">info</span>
                            {{ $appointment->status }}
                        </span>
                        <button wire:click="$set('showStatusModal', true)" class="text-blue-600 hover:text-blue-800 font-semibold text-sm ml-2">
                            Baguhin
                        </button>
                    </div>
                </div>

                <!-- Customer Type -->
                <div>
                    <p class="text-sm text-gray-600 font-semibold mb-1">Customer Type</p>
                    @if($appointment->user_id)
                        <span class="inline-flex items-center gap-2 px-4 py-2 bg-green-100 text-green-700 border border-green-200 rounded-xl text-sm font-bold">
                            <span class="material-symbols-outlined text-base">person_check</span>
                            Registered User
                        </span>
                    @else
                        <span class="inline-flex items-center gap-2 px-4 py-2 bg-orange-100 text-orange-700 border border-orange-200 rounded-xl text-sm font-bold">
                            <span class="material-symbols-outlined text-base">person_add</span>
                            Guest Customer
                        </span>
                    @endif
                </div>

                <!-- Tracking Code -->
                <div>
                    <p class="text-sm text-gray-600 font-semibold mb-1">Booking Reference</p>
                    <p class="text-lg font-bold text-gray-900 font-mono">{{ $appointment->tracking_code }}</p>
                </div>
            </div>
        </div>

        <!-- Customer Information Section -->
        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
            <div class="px-6 py-5 border-b border-gray-100 bg-gray-50">
                <h2 class="text-lg font-bold text-gray-900 flex items-center gap-2">
                    <span class="material-symbols-outlined">person</span>
                    Customer Information
                </h2>
            </div>
            <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <p class="text-sm text-gray-600 font-semibold">Full Name</p>
                    <p class="text-lg font-bold text-gray-900 mt-1">{{ $appointment->user?->getFullName() ?? 'N/A' }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600 font-semibold">Email</p>
                    <p class="text-lg font-bold text-gray-900 mt-1">{{ $appointment->user?->email ?? 'N/A' }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600 font-semibold">Phone</p>
                    <p class="text-lg font-bold text-gray-900 mt-1">{{ $appointment->user?->phone ?? 'N/A' }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600 font-semibold">City/Address</p>
                    <p class="text-lg font-bold text-gray-900 mt-1">{{ $appointment->user?->city ?? 'N/A' }}</p>
                </div>
            </div>
        </div>

        <!-- Device Information Section -->
        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
            <div class="px-6 py-5 border-b border-gray-100 bg-gray-50">
                <h2 class="text-lg font-bold text-gray-900 flex items-center gap-2">
                    <span class="material-symbols-outlined">devices</span>
                    Device Information
                </h2>
            </div>
            <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <p class="text-sm text-gray-600 font-semibold">Brand</p>
                    <p class="text-lg font-bold text-gray-900 mt-1">{{ $appointment->device_brand }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600 font-semibold">Model</p>
                    <p class="text-lg font-bold text-gray-900 mt-1">{{ $appointment->device_model }}</p>
                </div>
                <div class="md:col-span-2">
                    <p class="text-sm text-gray-600 font-semibold">Fault/Issue Category</p>
                    <p class="text-lg font-bold text-gray-900 mt-1">{{ $appointment->fault_category }}</p>
                </div>
            </div>
        </div>

        <!-- Device Photos Section -->
        @if($appointment->photo_paths && count($appointment->photo_paths) > 0)
        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
            <div class="px-6 py-5 border-b border-gray-100 bg-gray-50">
                <h2 class="text-lg font-bold text-gray-900 flex items-center gap-2">
                    <span class="material-symbols-outlined">image</span>
                    Device Photos
                </h2>
            </div>
            <div class="p-6 grid grid-cols-2 md:grid-cols-4 gap-4">
                @foreach($appointment->photo_paths as $photo)
                    <div class="relative group">
                        <img src="{{ asset($photo) }}" alt="Device photo" class="w-full h-48 object-cover rounded-lg border border-gray-200 hover:border-blue-500 transition-colors">
                        <div class="absolute inset-0 bg-black/0 group-hover:bg-black/20 transition-colors rounded-lg flex items-center justify-center opacity-0 group-hover:opacity-100">
                            <a href="{{ asset($photo) }}" target="_blank" class="p-2 bg-white rounded-full text-gray-900 shadow-lg">
                                <span class="material-symbols-outlined">zoom_in</span>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        @endif

        <!-- Description & Details Section -->
        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
            <div class="px-6 py-5 border-b border-gray-100 bg-gray-50">
                <h2 class="text-lg font-bold text-gray-900 flex items-center gap-2">
                    <span class="material-symbols-outlined">description</span>
                    Appointment Description
                </h2>
            </div>
            <div class="p-6">
                <p class="text-gray-700 leading-relaxed whitespace-pre-wrap">
                    {{ $appointment->description ?? 'Walang description' }}
                </p>
            </div>
        </div>

        <!-- Pricing & Cost Section -->
        <div class="bg-gradient-to-br from-green-50 to-emerald-50 rounded-2xl border border-green-200 p-6">
            <h2 class="text-lg font-bold text-gray-900 mb-4 flex items-center gap-2">
                <span class="material-symbols-outlined">attach_money</span>
                Pricing & Cost Details
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white rounded-xl p-4 border border-green-100">
                    <p class="text-sm text-gray-600 font-semibold">Estimated Quote</p>
                    <p class="text-2xl font-bold text-green-600 mt-2">₱{{ number_format($appointment->quote ?? 0, 2) }}</p>
                </div>
                <div class="bg-white rounded-xl p-4 border border-green-100">
                    <p class="text-sm text-gray-600 font-semibold">Final Cost</p>
                    <p class="text-2xl font-bold text-green-600 mt-2">₱{{ number_format($appointment->final_cost ?? 'TBD', 2) }}</p>
                </div>
                <div class="bg-white rounded-xl p-4 border border-green-100">
                    <p class="text-sm text-gray-600 font-semibold">Additional Fees</p>
                    <p class="text-2xl font-bold text-orange-600 mt-2">₱{{ number_format(max(0, ($appointment->final_cost ?? 0) - ($appointment->quote ?? 0)), 2) }}</p>
                </div>
            </div>
            @if($appointment->invoice_number)
            <div class="mt-4 p-4 bg-white rounded-lg border border-green-100">
                <p class="text-sm text-gray-600">Invoice Number: <span class="font-mono font-bold text-gray-900">{{ $appointment->invoice_number }}</span></p>
            </div>
            @endif
        </div>

        <!-- Completion Notes Section -->
        @if($appointment->completion_notes)
        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
            <div class="px-6 py-5 border-b border-gray-100 bg-gray-50">
                <h2 class="text-lg font-bold text-gray-900 flex items-center gap-2">
                    <span class="material-symbols-outlined">check_circle</span>
                    Completion Notes
                </h2>
            </div>
            <div class="p-6">
                <p class="text-gray-700 leading-relaxed whitespace-pre-wrap">{{ $appointment->completion_notes }}</p>
            </div>
        </div>
        @endif

        <!-- Appointment Dates Section -->
        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
            <div class="px-6 py-5 border-b border-gray-100 bg-gray-50">
                <h2 class="text-lg font-bold text-gray-900 flex items-center gap-2">
                    <span class="material-symbols-outlined">event</span>
                    Appointment Timeline
                </h2>
            </div>
            <div class="p-6 grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <p class="text-sm text-gray-600 font-semibold">Created Date</p>
                    <p class="text-lg font-bold text-gray-900 mt-1">{{ $appointment->created_at->format('M d, Y') }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600 font-semibold">Preferred Date</p>
                    <p class="text-lg font-bold text-gray-900 mt-1">{{ $appointment->pref_date?->format('M d, Y') ?? 'N/A' }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600 font-semibold">Preferred Time</p>
                    <p class="text-lg font-bold text-gray-900 mt-1">{{ $appointment->pref_time ?? 'N/A' }}</p>
                </div>
            </div>
        </div>

        <!-- Action Buttons Section -->
        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
            <div class="px-6 py-5 border-b border-gray-100 bg-gray-50">
                <h2 class="text-lg font-bold text-gray-900">Actions</h2>
            </div>
            <div class="p-6 flex flex-wrap gap-4">
                <button wire:click="openEmailModal('receipt')" class="flex items-center gap-2 px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-bold transition-colors">
                    <span class="material-symbols-outlined">mail</span>
                    Ipadala ang Receipt
                </button>
                <button wire:click="openEmailModal('invoice')" class="flex items-center gap-2 px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg font-bold transition-colors">
                    <span class="material-symbols-outlined">receipt_long</span>
                    Ipadala ang Invoice
                </button>
                <button wire:click="$set('showStatusModal', true)" class="flex items-center gap-2 px-6 py-3 bg-amber-600 hover:bg-amber-700 text-white rounded-lg font-bold transition-colors">
                    <span class="material-symbols-outlined">edit</span>
                    Baguhin ang Status
                </button>
                <button wire:click="deleteAppointment" onclick="return confirm('Sigurado ka ba? Hindi ito ma-undo.')" class="flex items-center gap-2 px-6 py-3 bg-red-600 hover:bg-red-700 text-white rounded-lg font-bold transition-colors">
                    <span class="material-symbols-outlined">delete</span>
                    Tanggalin
                </button>
            </div>
        </div>
    </div>

    <!-- Email Modal -->
    @if ($showEmailModal)
    <div class="fixed inset-0 bg-gray-900 bg-opacity-75 transition-opacity backdrop-blur-sm flex items-center justify-center z-50 p-4">
        <div class="bg-white rounded-2xl shadow-lg max-w-2xl w-full max-h-[90vh] overflow-y-auto">
            <div class="sticky top-0 px-6 py-5 border-b border-gray-100 flex items-center justify-between bg-white">
                <h2 class="text-xl font-bold text-gray-900">Magpadala ng Email</h2>
                <button wire:click="closeEmailModal" class="text-gray-500 hover:text-gray-700">
                    <span class="material-symbols-outlined">close</span>
                </button>
            </div>

            <div class="p-6 space-y-6">
                <!-- Email Type Badge -->
                <div class="inline-block px-4 py-2 rounded-lg 
                    @if($emailType === 'receipt') bg-blue-100 text-blue-700
                    @elseif($emailType === 'invoice') bg-indigo-100 text-indigo-700
                    @else bg-gray-100 text-gray-700 @endif
                    font-bold text-sm">
                    {{ ucfirst($emailType) }}
                </div>

                <!-- Subject Field -->
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Subject</label>
                    <input type="text" wire:model="emailSubject" placeholder="Email subject..." 
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition-all">
                    @error('emailSubject')
                        <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Body Field (Gmail-like) -->
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Message Body</label>
                    <textarea wire:model="emailBody" placeholder="I-type ang email body dito..." rows="12"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition-all font-mono text-sm resize-none"></textarea>
                    @error('emailBody')
                        <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Send To Info -->
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                    <p class="text-sm text-gray-700">
                        <span class="font-bold">Ipapadala sa:</span> 
                        <span class="font-mono text-blue-600">{{ $appointment->user?->email ?? 'N/A' }}</span>
                    </p>
                </div>

                <!-- Action Buttons -->
                <div class="flex gap-3 justify-end pt-4 border-t border-gray-100">
                    <button wire:click="closeEmailModal" class="px-6 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-900 rounded-lg font-bold transition-colors">
                        Cancel
                    </button>
                    <button wire:click="sendEmail" class="px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-bold transition-colors flex items-center gap-2">
                        <span class="material-symbols-outlined">send</span>
                        Ipadala
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Status Update Modal -->
    @if ($showStatusModal)
    <div class="fixed inset-0 bg-gray-900 bg-opacity-75 transition-opacity backdrop-blur-sm flex items-center justify-center z-50 p-4">
        <div class="bg-white rounded-2xl shadow-lg max-w-md w-full">
            <div class="px-6 py-5 border-b border-gray-100">
                <h2 class="text-xl font-bold text-gray-900">Baguhin ang Status</h2>
            </div>

            <div class="p-6 space-y-4">
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-3">Piliin ang Bagong Status</label>
                    <select wire:model="newStatus" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none">
                        <option value="">-- Pumili ng Status --</option>
                        <option value="Pending">Pending</option>
                        <option value="Scheduled">Scheduled</option>
                        <option value="In Progress">In Progress</option>
                        <option value="Ready for Pickup">Ready for Pickup</option>
                        <option value="Completed">Completed</option>
                        <option value="Cancelled">Cancelled</option>
                    </select>
                </div>

                <div class="flex gap-3 justify-end pt-4 border-t border-gray-100">
                    <button wire:click="$set('showStatusModal', false)" class="px-6 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-900 rounded-lg font-bold transition-colors">
                        Cancel
                    </button>
                    <button wire:click="updateStatus" class="px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-bold transition-colors">
                        I-update
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endif

    @else
    <div class="text-center py-12">
        <p class="text-gray-500 text-lg">Appointment not found</p>
    </div>
    @endif
</div>

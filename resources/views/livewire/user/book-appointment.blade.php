<div class="w-full max-w-7xl mx-auto">

    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900 tracking-tight">Book a Repair</h1>
        <p class="text-gray-500 mt-1">Provide details about your device and schedule a drop-off time.</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        <div class="lg:col-span-2">
            <div class="bg-white border border-gray-200 shadow-sm rounded-2xl p-6 md:p-10 mb-8">

                <form wire:submit="submit" class="space-y-8">

                    <div>
                        <h3 class="text-lg font-bold text-gray-900 border-b border-gray-100 pb-2 mb-4 flex items-center gap-2">
                            <span class="material-symbols-outlined text-gray-400">devices</span>
                            Device Information
                        </h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <label for="device_brand" class="block text-sm font-bold text-gray-700 mb-2">Brand</label>
                                <select id="device_brand" wire:model="device_brand" class="w-full px-4 py-3 border border-gray-200 rounded-lg bg-white focus:outline-none focus:border-gray-400 focus:ring-2 focus:ring-gray-100 transition-all text-sm" required>
                                    <option value="" disabled selected>Select Brand</option>
                                    <option value="Apple">Apple</option>
                                    <option value="Samsung">Samsung</option>
                                    <option value="Google">Google Pixel</option>
                                    <option value="OnePlus">OnePlus</option>
                                    <option value="Other">Other</option>
                                </select>
                                @error('device_brand') <span class="text-xs text-red-500 mt-1">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label for="device_model" class="block text-sm font-bold text-gray-700 mb-2">Exact Model</label>
                                <input type="text" id="device_model" wire:model="device_model" placeholder="e.g., iPhone 14 Pro Max" class="w-full px-4 py-3 border border-gray-200 rounded-lg bg-white focus:outline-none focus:border-gray-400 focus:ring-2 focus:ring-gray-100 transition-all text-sm" required>
                                @error('device_model') <span class="text-xs text-red-500 mt-1">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div>
                            <label for="fault_category" class="block text-sm font-bold text-gray-700 mb-2">Primary Fault Category</label>
                            <select id="fault_category" wire:model="fault_category" class="w-full px-4 py-3 border border-gray-200 rounded-lg bg-white focus:outline-none focus:border-gray-400 focus:ring-2 focus:ring-gray-100 transition-all text-sm" required>
                                <option value="" disabled selected>What seems to be the main issue?</option>
                                <option value="Screen">Broken/Cracked Screen</option>
                                <option value="Battery">Battery Draining Fast / Won't Charge</option>
                                <option value="Water Damage">Water or Liquid Damage</option>
                                <option value="Charging Port">Loose or Broken Charging Port</option>
                                <option value="Camera">Camera Lens / Focus Issues</option>
                                <option value="Software">Software / Bootloop / Stuck on Logo</option>
                                <option value="Other">Other / Not Sure</option>
                            </select>
                            @error('fault_category') <span class="text-xs text-red-500 mt-1">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div>
                        <h3 class="text-lg font-bold text-gray-900 border-b border-gray-100 pb-2 mb-4 flex items-center gap-2">
                            <span class="material-symbols-outlined text-gray-400">description</span>
                            Issue Description
                        </h3>

                        <div class="mb-6">
                            <label for="description" class="block text-sm font-bold text-gray-700 mb-2">Describe the problem in detail</label>
                            <textarea id="description" wire:model="description" rows="4" placeholder="How did it happen? Are there any secondary issues?" class="w-full px-4 py-3 border border-gray-200 rounded-lg bg-white focus:outline-none focus:border-gray-400 focus:ring-2 focus:ring-gray-100 transition-all text-sm resize-none" required></textarea>
                            @error('description') <span class="text-xs text-red-500 mt-1">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Upload Photo of Damage (Optional)</label>
                            <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-xl bg-gray-50 hover:bg-gray-100 transition-colors cursor-pointer group relative overflow-hidden">

                                @if ($photo)
                                <div class="relative w-full text-center">
                                    <img src="{{ $photo->temporaryUrl() }}" class="max-h-48 mx-auto rounded-lg shadow-sm">
                                    <p class="text-sm text-green-600 font-bold mt-2">Image attached successfully!</p>
                                </div>
                                @else
                                <div class="space-y-1 text-center">
                                    <span class="material-symbols-outlined text-4xl text-gray-400 group-hover:text-gray-500 mb-2">add_a_photo</span>
                                    <div class="flex text-sm text-gray-600 justify-center">
                                        <label for="file-upload" class="relative cursor-pointer bg-white rounded-md font-bold text-blue-600 hover:text-blue-500 px-2 py-0.5 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                                            <span>Upload a file</span>
                                            <input id="file-upload" wire:model="photo" type="file" class="sr-only" accept="image/png, image/jpeg, image/jpg">
                                        </label>
                                        <p class="pl-1">or drag and drop</p>
                                    </div>
                                    <p class="text-xs text-gray-500">PNG, JPG up to 5MB</p>
                                </div>
                                @endif

                                <div wire:loading wire:target="photo" class="absolute inset-0 bg-white/80 flex items-center justify-center">
                                    <span class="material-symbols-outlined animate-spin text-blue-500 text-3xl">progress_activity</span>
                                </div>
                            </div>
                            @error('photo') <span class="text-xs text-red-500 mt-1">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div>
                        <h3 class="text-lg font-bold text-gray-900 border-b border-gray-100 pb-2 mb-4 flex items-center gap-2">
                            <span class="material-symbols-outlined text-gray-400">event</span>
                            Schedule Drop-off
                        </h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="pref_date" class="block text-sm font-bold text-gray-700 mb-2">Preferred Date</label>
                                <input type="date" id="pref_date" wire:model="pref_date" class="w-full px-4 py-3 border border-gray-200 rounded-lg bg-white focus:outline-none focus:border-gray-400 focus:ring-2 focus:ring-gray-100 transition-all text-sm" required>
                                @error('pref_date') <span class="text-xs text-red-500 mt-1">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label for="pref_time" class="block text-sm font-bold text-gray-700 mb-2">Preferred Time</label>
                                <input type="time" id="pref_time" wire:model="pref_time" class="w-full px-4 py-3 border border-gray-200 rounded-lg bg-white focus:outline-none focus:border-gray-400 focus:ring-2 focus:ring-gray-100 transition-all text-sm" required>
                                @error('pref_time') <span class="text-xs text-red-500 mt-1">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="pt-4 border-t border-gray-100 flex justify-end">
                        <button type="submit" class="flex items-center justify-center gap-2 bg-gray-900 text-white hover:bg-gray-800 w-full sm:w-auto px-10 py-3.5 text-lg rounded-lg font-semibold transition-colors shadow-md disabled:opacity-70" wire:loading.attr="disabled">
                            <span class="material-symbols-outlined text-[22px]" wire:loading.remove wire:target="submit">check_circle</span>
                            <span class="material-symbols-outlined text-[22px] animate-spin" wire:loading wire:target="submit">progress_activity</span>
                            Confirm Appointment
                        </button>
                    </div>

                </form>
            </div>
        </div>

        <div class="lg:col-span-1 space-y-6">

            <div class="bg-blue-50/50 border border-blue-100 rounded-2xl p-6">
                <div class="flex items-center gap-3 mb-3">
                    <span class="material-symbols-outlined text-blue-600 text-[28px]">info</span>
                    <h3 class="font-bold text-gray-900">What Happens Next?</h3>
                </div>
                <ul class="space-y-3 text-sm font-medium text-gray-600">
                    <li class="flex gap-3 items-start">
                        <span class="flex items-center justify-center w-5 h-5 rounded-full bg-white border border-blue-200 text-blue-600 font-bold text-xs shrink-0 mt-0.5">1</span>
                        <p>Submit this form to reserve your drop-off slot.</p>
                    </li>
                    <li class="flex gap-3 items-start">
                        <span class="flex items-center justify-center w-5 h-5 rounded-full bg-white border border-blue-200 text-blue-600 font-bold text-xs shrink-0 mt-0.5">2</span>
                        <p>Bring your device in at the scheduled time.</p>
                    </li>
                    <li class="flex gap-3 items-start">
                        <span class="flex items-center justify-center w-5 h-5 rounded-full bg-white border border-blue-200 text-blue-600 font-bold text-xs shrink-0 mt-0.5">3</span>
                        <p>We'll run a quick diagnostic and provide a final, binding quote before doing any work.</p>
                    </li>
                </ul>
            </div>

            <div class="bg-white border border-gray-200 shadow-sm rounded-2xl p-6">
                <div class="flex items-center gap-3 mb-3">
                    <span class="material-symbols-outlined text-gray-600 text-[28px]">verified_user</span>
                    <h3 class="font-bold text-gray-900">Pre-Repair Checklist</h3>
                </div>
                <ul class="space-y-3 text-sm text-gray-600">
                    <li class="flex items-center gap-2">
                        <span class="w-1.5 h-1.5 bg-gray-400 rounded-full shrink-0"></span>
                        Back up your data to the cloud.
                    </li>
                    <li class="flex items-center gap-2">
                        <span class="w-1.5 h-1.5 bg-gray-400 rounded-full shrink-0"></span>
                        Remove your SIM and SD cards.
                    </li>
                    <li class="flex items-center gap-2">
                        <span class="w-1.5 h-1.5 bg-gray-400 rounded-full shrink-0"></span>
                        Ensure your device is charged to at least 20%.
                    </li>
                </ul>
            </div>

        </div>

    </div>

</div>
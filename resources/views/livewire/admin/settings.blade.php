<div class="w-full max-w-3xl">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Settings</h1>
        <p class="text-gray-600 mt-1">Manage application and company settings.</p>
    </div>

    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
        <div class="px-8 py-6 border-b border-gray-200 bg-gray-50">
            <h2 class="text-lg font-bold text-gray-900">Company Information</h2>
        </div>

        <div class="p-8 space-y-6">
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Company Name</label>
                <input type="text" wire:model="companyName" class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Admin Email</label>
                <input type="email" wire:model="companyEmail" class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Phone Number</label>
                <input type="tel" wire:model="companyPhone" class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Business Hours</label>
                <input type="text" wire:model="businessHours" placeholder="e.g., 9:00 AM - 6:00 PM" class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
            </div>

            <div class="pt-6 border-t border-gray-200 flex gap-3">
                <button wire:click="updateSettings" class="px-6 py-2.5 bg-gray-900 text-white rounded-lg font-medium hover:bg-gray-800 transition-colors flex items-center gap-2">
                    <span class="material-symbols-outlined text-[18px]">check</span>
                    Save Changes
                </button>
                <button class="px-6 py-2.5 bg-gray-100 text-gray-700 rounded-lg font-medium hover:bg-gray-200 transition-colors">
                    Cancel
                </button>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden mt-8">
        <div class="px-8 py-6 border-b border-gray-200 bg-gray-50">
            <h2 class="text-lg font-bold text-gray-900">Email Notifications</h2>
        </div>

        <div class="p-8 space-y-4">
            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                <div>
                    <p class="font-semibold text-gray-900">New Appointments</p>
                    <p class="text-sm text-gray-600">Get notified when new appointments are booked</p>
                </div>
                <label class="flex items-center cursor-pointer">
                    <input type="checkbox" checked class="sr-only peer">
                    <div class="relative w-11 h-6 bg-gray-300 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                </label>
            </div>

            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                <div>
                    <p class="font-semibold text-gray-900">Daily Report</p>
                    <p class="text-sm text-gray-600">Receive daily business summary</p>
                </div>
                <label class="flex items-center cursor-pointer">
                    <input type="checkbox" class="sr-only peer">
                    <div class="relative w-11 h-6 bg-gray-300 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                </label>
            </div>

            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                <div>
                    <p class="font-semibold text-gray-900">Support Tickets</p>
                    <p class="text-sm text-gray-600">Notifications for new support tickets</p>
                </div>
                <label class="flex items-center cursor-pointer">
                    <input type="checkbox" checked class="sr-only peer">
                    <div class="relative w-11 h-6 bg-gray-300 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                </label>
            </div>
        </div>
    </div>
</div>

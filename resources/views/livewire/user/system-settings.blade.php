<div class="w-full">

    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900 tracking-tight flex items-center gap-2">
            <span class="material-symbols-outlined text-[32px] text-gray-400">settings</span>
            System Settings
        </h1>
        <p class="text-gray-500 mt-1">Manage your notifications, security preferences, and privacy.</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 items-start">

        <div class="space-y-6">

            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-6 md:p-8">
                <h3 class="text-lg font-bold text-gray-900 border-b border-gray-100 pb-3 mb-5 flex items-center gap-2">
                    <span class="material-symbols-outlined text-gray-400">notifications_active</span>
                    Notifications
                </h3>

                <div class="space-y-5">
                    <div class="flex items-center justify-between hover:bg-gray-50 p-2 -mx-2 rounded-lg transition-colors">
                        <div>
                            <p class="text-sm font-bold text-gray-800">Email Updates</p>
                            <p class="text-xs text-gray-500">Receive emails regarding appointment status.</p>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer mr-2">
                            <input type="checkbox" wire:model="email_updates" class="sr-only peer">
                            <div class="w-11 h-6 bg-gray-300 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                        </label>
                    </div>

                    <div class="flex items-center justify-between hover:bg-gray-50 p-2 -mx-2 rounded-lg transition-colors">
                        <div>
                            <p class="text-sm font-bold text-gray-800">SMS Notifications</p>
                            <p class="text-xs text-gray-500">Get text alerts when repairs are completed.</p>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer mr-2">
                            <input type="checkbox" wire:model="sms_notifications" class="sr-only peer">
                            <div class="w-11 h-6 bg-gray-300 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                        </label>
                    </div>

                    <div class="flex items-center justify-between hover:bg-gray-50 p-2 -mx-2 rounded-lg transition-colors">
                        <div>
                            <p class="text-sm font-bold text-gray-800">Marketing & Offers</p>
                            <p class="text-xs text-gray-500">Receive promotional emails and discounts.</p>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer mr-2">
                            <input type="checkbox" wire:model="marketing_offers" class="sr-only peer">
                            <div class="w-11 h-6 bg-gray-300 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                        </label>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-6 md:p-8">
                <h3 class="text-lg font-bold text-gray-900 border-b border-gray-100 pb-3 mb-5 flex items-center gap-2">
                    <span class="material-symbols-outlined text-gray-400">privacy_tip</span>
                    Data & Privacy
                </h3>

                <div class="space-y-4">
                    <label class="flex items-start cursor-pointer hover:bg-gray-50 p-2 rounded-lg -mx-2 transition-colors">
                        <input type="checkbox" wire:model="share_history" class="mt-1 w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                        <div class="ml-3">
                            <span class="block text-sm font-bold text-gray-800">Share repair history</span>
                            <span class="block text-xs text-gray-500 mt-0.5">Allow technicians to view past repairs for faster diagnostics.</span>
                        </div>
                    </label>

                    <label class="flex items-start cursor-pointer hover:bg-gray-50 p-2 rounded-lg -mx-2 transition-colors">
                        <input type="checkbox" wire:model="analytics_tracking" class="mt-1 w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                        <div class="ml-3">
                            <span class="block text-sm font-bold text-gray-800">Analytics tracking</span>
                            <span class="block text-xs text-gray-500 mt-0.5">Allow data collection for service and UI improvements.</span>
                        </div>
                    </label>
                </div>
            </div>

        </div>

        <div class="space-y-6">

            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-6 md:p-8">
                <h3 class="text-lg font-bold text-gray-900 border-b border-gray-100 pb-3 mb-5 flex items-center gap-2">
                    <span class="material-symbols-outlined text-gray-400">security</span>
                    Security
                </h3>

                <div class="space-y-5">
                    <div>
                        <p class="text-sm font-bold text-gray-800 mb-2">Account Password</p>
                        <a href="{{ route('user.profile') }}" class="inline-block bg-gray-100 text-gray-700 hover:bg-gray-200 font-bold rounded-lg shadow-sm border border-gray-200 text-sm px-4 py-2 transition-colors">
                            Change Password
                        </a>
                    </div>

                    <div class="pt-4 border-t border-gray-100">
                        <p class="text-sm font-bold text-gray-800 mb-1">Two-Factor Authentication (2FA)</p>
                        <p class="text-xs text-gray-500 mb-3">Add an extra layer of security to your account.</p>
                        <button class="text-sm font-bold text-blue-600 hover:text-blue-800 transition-colors">Enable 2FA</button>
                    </div>

                    <div class="pt-4 border-t border-gray-100 bg-gray-50 p-3 rounded-lg">
                        <p class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-1">Last Login Activity</p>
                        <p class="text-sm font-medium text-gray-900">Feb 26, 2026 at 10:30 AM</p>
                        <p class="text-xs text-gray-500 mt-0.5">Chrome on Windows &bull; Quezon City, PH</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-6 md:p-8">
                <h3 class="text-lg font-bold text-gray-900 border-b border-gray-100 pb-3 mb-5 flex items-center gap-2">
                    <span class="material-symbols-outlined text-gray-400">account_circle</span>
                    Account
                </h3>

                <div class="space-y-5">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-bold text-gray-800">Profile Information</p>
                            <p class="text-xs text-gray-500">Update your name, address, and gender.</p>
                        </div>
                        <a href="{{ route('user.profile') }}" class="text-sm font-bold text-blue-600 hover:text-blue-800 transition-colors">Edit</a>
                    </div>

                    <div class="pt-4 border-t border-gray-100">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-bold text-red-600">Delete Account</p>
                                <p class="text-xs text-gray-500">This action is permanent and cannot be undone.</p>
                            </div>
                            <button class="text-sm font-bold text-red-600 hover:text-red-800 transition-colors">Delete</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
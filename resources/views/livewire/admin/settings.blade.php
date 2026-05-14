<div class="w-full">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900 tracking-tight">Settings</h1>
        <p class="text-gray-500 mt-1">Manage all system and business configuration settings.</p>
    </div>

    <!-- Flash Messages -->
    @if (session()->has('success'))
        <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg flex items-center gap-3">
            <span class="material-symbols-outlined text-green-600">check_circle</span>
            <span class="text-green-700 font-medium">{{ session('success') }}</span>
        </div>
    @endif

    <!-- Tabs Navigation -->
    <div x-data="{ activeTab: 'general' }" class="space-y-6">
        <div class="bg-white p-1.5 rounded-[1.25rem] border border-gray-200 shadow-sm w-full overflow-x-auto no-scrollbar">
            <div class="flex min-w-full lg:min-w-0 space-x-1">
                <button @click="activeTab = 'general'" 
                    :class="activeTab === 'general' ? 'bg-gray-900 text-white shadow-lg transform scale-105' : 'text-gray-500 hover:bg-gray-50'" 
                    class="px-8 py-3 rounded-[1rem] font-black transition-all duration-300 flex items-center gap-2 text-sm whitespace-nowrap">
                    <span class="material-symbols-outlined text-[20px]">business</span>
                    General
                </button>
                <button @click="activeTab = 'email'" 
                    :class="activeTab === 'email' ? 'bg-gray-900 text-white shadow-lg transform scale-105' : 'text-gray-500 hover:bg-gray-50'" 
                    class="px-8 py-3 rounded-[1rem] font-black transition-all duration-300 flex items-center gap-2 text-sm whitespace-nowrap">
                    <span class="material-symbols-outlined text-[20px]">mail</span>
                    Email
                </button>
                <button @click="activeTab = 'notifications'" 
                    :class="activeTab === 'notifications' ? 'bg-gray-900 text-white shadow-lg transform scale-105' : 'text-gray-500 hover:bg-gray-50'" 
                    class="px-8 py-3 rounded-[1rem] font-black transition-all duration-300 flex items-center gap-2 text-sm whitespace-nowrap">
                    <span class="material-symbols-outlined text-[20px]">notifications</span>
                    Notifications
                </button>
                <button @click="activeTab = 'payment'" 
                    :class="activeTab === 'payment' ? 'bg-gray-900 text-white shadow-lg transform scale-105' : 'text-gray-500 hover:bg-gray-50'" 
                    class="px-8 py-3 rounded-[1rem] font-black transition-all duration-300 flex items-center gap-2 text-sm whitespace-nowrap">
                    <span class="material-symbols-outlined text-[20px]">payment</span>
                    Payment
                </button>
                <button @click="activeTab = 'hours'" 
                    :class="activeTab === 'hours' ? 'bg-gray-900 text-white shadow-lg transform scale-105' : 'text-gray-500 hover:bg-gray-50'" 
                    class="px-8 py-3 rounded-[1rem] font-black transition-all duration-300 flex items-center gap-2 text-sm whitespace-nowrap">
                    <span class="material-symbols-outlined text-[20px]">schedule</span>
                    Hours
                </button>
                <button @click="activeTab = 'security'" 
                    :class="activeTab === 'security' ? 'bg-gray-900 text-white shadow-lg transform scale-105' : 'text-gray-500 hover:bg-gray-50'" 
                    class="px-8 py-3 rounded-[1rem] font-black transition-all duration-300 flex items-center gap-2 text-sm whitespace-nowrap">
                    <span class="material-symbols-outlined text-[20px]">security</span>
                    Security
                </button>
            </div>
        </div>

        <!-- General Settings Tab -->
        <div x-show="activeTab === 'general'" class="bg-white rounded-[1.25rem] border border-gray-200 p-8 shadow-sm space-y-8">
            <div>
                <h2 class="text-xl font-bold text-gray-900">Business Information</h2>
                <p class="text-gray-500 text-sm mt-1">Basic identification and contact details for your business.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Business Name</label>
                    <input type="text" wire:model="businessName" class="w-full px-4 py-3 border border-gray-200 rounded-[1.25rem] bg-gray-50 focus:bg-white focus:ring-4 focus:ring-blue-100 transition-all text-sm outline-none" />
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Email Address</label>
                    <input type="email" wire:model="businessEmail" class="w-full px-4 py-3 border border-gray-200 rounded-[1.25rem] bg-gray-50 focus:bg-white focus:ring-4 focus:ring-blue-100 transition-all text-sm outline-none" />
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Phone Number</label>
                    <input type="tel" wire:model="businessPhone" class="w-full px-4 py-3 border border-gray-200 rounded-[1.25rem] bg-gray-50 focus:bg-white focus:ring-4 focus:ring-blue-100 transition-all text-sm outline-none" />
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Website</label>
                    <input type="url" wire:model="businessWebsite" placeholder="https://example.com" class="w-full px-4 py-3 border border-gray-200 rounded-[1.25rem] bg-gray-50 focus:bg-white focus:ring-4 focus:ring-blue-100 transition-all text-sm outline-none" />
                </div>
                <div class="lg:col-span-2">
                    <label class="block text-sm font-bold text-gray-700 mb-2">Street Address</label>
                    <input type="text" wire:model="businessAddress" placeholder="e.g., 123 Tech Lane" class="w-full px-4 py-3 border border-gray-200 rounded-[1.25rem] bg-gray-50 focus:bg-white focus:ring-4 focus:ring-blue-100 transition-all text-sm outline-none" />
                </div>
            </div>
            <div class="pt-6 border-t border-gray-100 flex justify-end">
                <button wire:click="saveGeneralSettings" class="px-10 py-3 bg-gray-900 text-white rounded-[1.25rem] font-black text-sm hover:bg-blue-600 transition-all shadow-xl shadow-gray-200 active:scale-95 flex items-center gap-2">
                    <span class="material-symbols-outlined text-[20px]">save</span>
                    Save Changes
                </button>
            </div>
        </div>

        <!-- Email Settings Tab -->
        <div x-show="activeTab === 'email'" class="bg-white rounded-[1.25rem] border border-gray-200 p-8 shadow-sm space-y-8">
            <div>
                <h2 class="text-xl font-bold text-gray-900">Email Configuration</h2>
                <p class="text-gray-500 text-sm mt-1">Configure SMTP settings for system outgoing emails.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">SMTP Host</label>
                    <input type="text" wire:model="smtpHost" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" />
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">SMTP Port</label>
                    <input type="number" wire:model="smtpPort" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" />
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">From Email Address</label>
                    <input type="email" wire:model="emailFromAddress" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" />
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">From Name</label>
                    <input type="text" wire:model="emailFromName" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" />
                </div>
                <div class="lg:col-span-2">
                    <label class="flex items-center gap-3 cursor-pointer group">
                        <div class="relative">
                            <input type="checkbox" wire:model="emailNotificationsEnabled" class="sr-only peer" />
                            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                        </div>
                        <span class="text-sm font-bold text-gray-700 group-hover:text-gray-900 transition-colors">Enable Email Notifications</span>
                    </label>
                </div>
            </div>
            <div class="pt-6 border-t border-gray-100 flex justify-end">
                <button wire:click="saveEmailSettings" class="px-8 py-2.5 bg-gray-900 text-white rounded-xl font-bold hover:bg-gray-800 transition-all shadow-md active:scale-95">Save Changes</button>
            </div>
        </div>

        <!-- Notifications Settings Tab -->
        <div x-show="activeTab === 'notifications'" class="bg-white rounded-[1.25rem] border border-gray-200 p-8 shadow-sm space-y-8">
            <div>
                <h2 class="text-xl font-bold text-gray-900">Notification Preferences</h2>
                <p class="text-gray-500 text-sm mt-1">Control how and when you receive system alerts.</p>
            </div>
            <div class="space-y-6 max-w-2xl">
                <label class="flex items-center gap-3 cursor-pointer">
                    <input type="checkbox" wire:model="appointmentReminders" class="w-5 h-5 border-gray-300 rounded focus:ring-2 focus:ring-blue-500" />
                    <span class="text-sm font-medium text-gray-700">Send Appointment Reminders</span>
                </label>
                <div class="ml-8">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Reminder Time (hours before appointment)</label>
                    <select wire:model="appointmentReminderTime" class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                        <option value="1">1 hour</option>
                        <option value="6">6 hours</option>
                        <option value="12">12 hours</option>
                        <option value="24">24 hours</option>
                        <option value="48">48 hours</option>
                    </select>
                </div>
                <label class="flex items-center gap-3 cursor-pointer group">
                    <div class="relative">
                        <input type="checkbox" wire:model="statusUpdateNotifications" class="sr-only peer" />
                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                    </div>
                    <span class="text-sm font-bold text-gray-700 group-hover:text-gray-900 transition-colors">Send Status Update Notifications</span>
                </label>
                <label class="flex items-center gap-3 cursor-pointer group">
                    <div class="relative">
                        <input type="checkbox" wire:model="adminAlerts" class="sr-only peer" />
                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                    </div>
                    <span class="text-sm font-bold text-gray-700 group-hover:text-gray-900 transition-colors">Send Admin Alerts for New Orders</span>
                </label>
            </div>
            <div class="pt-6 border-t border-gray-100 flex justify-end">
                <button wire:click="saveNotificationSettings" class="px-8 py-2.5 bg-gray-900 text-white rounded-xl font-bold hover:bg-gray-800 transition-all shadow-md active:scale-95">Save Changes</button>
            </div>
        </div>

        <!-- Payment Settings Tab -->
        <div x-show="activeTab === 'payment'" class="bg-white rounded-[1.25rem] border border-gray-200 p-8 shadow-sm space-y-8">
            <div>
                <h2 class="text-xl font-bold text-gray-900">Payment Configuration</h2>
                <p class="text-gray-500 text-sm mt-1">Manage your payment gateways and currency settings.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Payment Gateway</label>
                    <div class="relative">
                        <select wire:model="paymentGateway" class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent appearance-none bg-white">
                            <option value="stripe">Stripe</option>
                            <option value="paypal">PayPal</option>
                        </select>
                        <span class="material-symbols-outlined absolute left-3 top-2.5 text-gray-400 text-sm">payments</span>
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Currency Code</label>
                    <input type="text" wire:model="currencyCode" placeholder="PHP" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" />
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Tax Percentage (%)</label>
                    <input type="number" wire:model="taxPercentage" step="0.01" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" />
                </div>
            </div>
            <div class="pt-6 border-t border-gray-100 flex justify-end">
                <button wire:click="savePaymentSettings" class="px-8 py-2.5 bg-gray-900 text-white rounded-xl font-bold hover:bg-gray-800 transition-all shadow-md active:scale-95">Save Changes</button>
            </div>
        </div>

        <!-- Business Hours Tab -->
        <div x-show="activeTab === 'hours'" class="bg-white rounded-[1.25rem] border border-gray-200 p-8 shadow-sm space-y-8">
            <div>
                <h2 class="text-xl font-bold text-gray-900">Business Operating Hours</h2>
                <p class="text-gray-500 text-sm mt-1">Set your standard opening and closing times for each day.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @foreach(['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'] as $day)
                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-2xl border border-transparent hover:border-gray-200 hover:bg-white transition-all duration-200">
                        <label class="w-24 text-sm font-bold text-gray-700 capitalize">{{ $day }}</label>
                        <div class="flex items-center gap-3">
                            <input type="time" wire:model="{{ $day }}Open" class="px-3 py-1.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 text-sm bg-white" />
                            <span class="text-gray-400 font-medium text-xs">to</span>
                            <input type="time" wire:model="{{ $day }}Close" class="px-3 py-1.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 text-sm bg-white" />
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="pt-6 border-t border-gray-100 flex justify-end">
                <button wire:click="saveBusinessHours" class="px-8 py-2.5 bg-gray-900 text-white rounded-xl font-bold hover:bg-gray-800 transition-all shadow-md active:scale-95">Save Changes</button>
            </div>
        </div>

        <!-- Security Settings Tab -->
        <div x-show="activeTab === 'security'" class="bg-white rounded-[1.25rem] border border-gray-200 p-8 shadow-sm space-y-8">
            <div>
                <h2 class="text-xl font-bold text-gray-900">Security Configuration</h2>
                <p class="text-gray-500 text-sm mt-1">Enhance your application security with advanced authentication rules.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Min Password Length</label>
                    <input type="number" wire:model="passwordMinLength" min="6" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" />
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Session Timeout (min)</label>
                    <input type="number" wire:model="sessionTimeout" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" />
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Max Login Attempts</label>
                    <input type="number" wire:model="maxLoginAttempts" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" />
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Password Expiry (days)</label>
                    <input type="number" wire:model="passwordExpireDays" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" />
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 py-8 border-y border-gray-100">
                <label class="flex items-center gap-3 cursor-pointer group">
                    <div class="relative">
                        <input type="checkbox" wire:model="passwordRequireNumbers" class="sr-only peer" />
                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                    </div>
                    <span class="text-sm font-bold text-gray-700 group-hover:text-gray-900 transition-colors">Require numbers</span>
                </label>
                <label class="flex items-center gap-3 cursor-pointer group">
                    <div class="relative">
                        <input type="checkbox" wire:model="passwordRequireSpecialChars" class="sr-only peer" />
                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                    </div>
                    <span class="text-sm font-bold text-gray-700 group-hover:text-gray-900 transition-colors">Require special characters</span>
                </label>
                <label class="flex items-center gap-3 cursor-pointer group">
                    <div class="relative">
                        <input type="checkbox" wire:model="twoFactorAuthRequired" class="sr-only peer" />
                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                    </div>
                    <span class="text-sm font-bold text-gray-700 group-hover:text-gray-900 transition-colors">Require 2FA for Admins</span>
                </label>
            </div>
            <div class="pt-6 flex justify-end">
                <button wire:click="saveSecuritySettings" class="px-8 py-2.5 bg-gray-900 text-white rounded-xl font-bold hover:bg-gray-800 transition-all shadow-md active:scale-95">Save Changes</button>
            </div>
        </div>
    </div>
</div>
    </div>
</div>

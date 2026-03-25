<div class="w-full max-w-2xl">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Admin Profile</h1>
        <p class="text-gray-600 mt-1">Manage your account information and preferences.</p>
    </div>

    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
        <div class="p-8 border-b border-gray-200">
            <div class="flex items-center gap-6 mb-8">
                <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->first_name . ' ' . Auth::user()->last_name) }}&background=2563eb&color=ffffff&bold=true&size=128" alt="Profile" class="w-24 h-24 rounded-full border-4 border-gray-200 object-cover">
                <div>
                    <h2 class="text-2xl font-bold text-gray-900">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</h2>
                    <p class="text-gray-600 mt-1">Administrator</p>
                    <p class="text-sm text-gray-500 mt-2">
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-green-50 text-green-700 border border-green-100 rounded-lg text-xs font-bold">
                            <span class="w-2 h-2 rounded-full bg-green-500"></span>
                            Active
                        </span>
                    </p>
                </div>
            </div>
        </div>

        <div class="p-8 space-y-6">
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">First Name</label>
                <input type="text" value="{{ Auth::user()->first_name }}" class="w-full px-4 py-2.5 border border-gray-200 rounded-lg bg-gray-50 text-gray-600" disabled>
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Last Name</label>
                <input type="text" value="{{ Auth::user()->last_name }}" class="w-full px-4 py-2.5 border border-gray-200 rounded-lg bg-gray-50 text-gray-600" disabled>
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Email Address</label>
                <input type="email" value="{{ Auth::user()->email }}" class="w-full px-4 py-2.5 border border-gray-200 rounded-lg bg-gray-50 text-gray-600" disabled>
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Phone Number</label>
                <input type="tel" value="{{ Auth::user()->phone ?? '-' }}" class="w-full px-4 py-2.5 border border-gray-200 rounded-lg bg-gray-50 text-gray-600" disabled>
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Address</label>
                <textarea class="w-full px-4 py-2.5 border border-gray-200 rounded-lg bg-gray-50 text-gray-600" rows="3" disabled>{{ Auth::user()->address ?? '-' }}</textarea>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">City</label>
                    <input type="text" value="{{ Auth::user()->city ?? '-' }}" class="w-full px-4 py-2.5 border border-gray-200 rounded-lg bg-gray-50 text-gray-600" disabled>
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">State</label>
                    <input type="text" value="{{ Auth::user()->state ?? '-' }}" class="w-full px-4 py-2.5 border border-gray-200 rounded-lg bg-gray-50 text-gray-600" disabled>
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Postal Code</label>
                    <input type="text" value="{{ Auth::user()->postal_code ?? '-' }}" class="w-full px-4 py-2.5 border border-gray-200 rounded-lg bg-gray-50 text-gray-600" disabled>
                </div>
            </div>

            <div class="pt-6 border-t border-gray-200">
                <button class="bg-gray-900 text-white px-6 py-2.5 rounded-lg font-medium hover:bg-gray-800 transition-colors">
                    Edit Profile
                </button>
            </div>
        </div>
    </div>
</div>

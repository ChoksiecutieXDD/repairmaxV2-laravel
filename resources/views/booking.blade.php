<x-layouts.landing title="Book a Repair | Repairmax">
    <main class="pt-32 lg:pt-40 py-16 md:py-24 !pt-40">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="mb-16 md:mb-24 text-center">
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold text-gray-900 mb-6 tracking-tight">
                Tell us about your device.
            </h1>
            <p class="text-lg md:text-xl text-gray-600 leading-relaxed max-w-2xl mx-auto">
                Skip the line and let us know exactly what is going on. Our technicians will be ready to bring your device back to life.
            </p>
        </div>

        <div class="bg-white p-8 md:p-12 rounded-3xl border border-gray-100 shadow-xl shadow-gray-200/50">
            <form action="/booking" method="POST" enctype="multipart/form-data" class="space-y-10">
                @csrf

                <section>
                    <h2 class="text-xl font-bold text-gray-900 mb-6 flex items-center gap-2 border-b border-gray-100 pb-4">
                        <span class="material-symbols-outlined text-gray-600">person</span>
                        Personal Details
                    </h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label for="first_name" class="block text-sm font-semibold text-gray-700">First Name <span class="text-red-500">*</span></label>
                            <input type="text" id="first_name" name="first_name" required
                                class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all"
                                placeholder="Jane">
                        </div>

                        <div class="space-y-2">
                            <label for="last_name" class="block text-sm font-semibold text-gray-700">Last Name <span class="text-red-500">*</span></label>
                            <input type="text" id="last_name" name="last_name" required
                                class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all"
                                placeholder="Doe">
                        </div>

                        <div class="space-y-2">
                            <label for="email" class="block text-sm font-semibold text-gray-700">Email Address <span class="text-red-500">*</span></label>
                            <input type="email" id="email" name="email" required
                                class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all"
                                placeholder="jane@example.com">
                        </div>

                        <div class="space-y-2">
                            <label for="phone" class="block text-sm font-semibold text-gray-700">Phone Number <span class="text-red-500">*</span></label>
                            <input type="tel" id="phone" name="phone" required
                                class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all"
                                placeholder="(555) 123-4567">
                        </div>
                    </div>
                </section>

                <section>
                    <h2 class="text-xl font-bold text-gray-900 mb-6 flex items-center gap-2 border-b border-gray-100 pb-4">
                        <span class="material-symbols-outlined text-gray-600">devices</span>
                        Device Information
                    </h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label for="device_type" class="block text-sm font-semibold text-gray-700">Device Type <span class="text-red-500">*</span></label>
                            <select id="device_type" name="device_type" required
                                class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all text-gray-700">
                                <option value="" disabled selected>Select Device Type</option>
                                <option value="smartphone">Smartphone</option>
                                <option value="tablet">Tablet</option>
                                <option value="laptop">Laptop</option>
                                <option value="other">Other</option>
                            </select>
                        </div>

                        <div class="space-y-2">
                            <label for="brand" class="block text-sm font-semibold text-gray-700">Brand <span class="text-red-500">*</span></label>
                            <input type="text" id="brand" name="brand" required
                                class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all"
                                placeholder="e.g. Apple, Samsung">
                        </div>

                        <div class="space-y-2 md:col-span-2">
                            <label for="model" class="block text-sm font-semibold text-gray-700">Device Model</label>
                            <input type="text" id="model" name="model"
                                class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all"
                                placeholder="e.g. iPhone 15 Pro, Galaxy S23">
                        </div>
                    </div>
                </section>

                <section class="space-y-6">
                    <div class="space-y-2">
                        <label for="issue" class="block text-sm font-semibold text-gray-700">Describe the Issue <span class="text-red-500">*</span></label>
                        <textarea id="issue" name="issue" required rows="4"
                            class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all resize-none"
                            placeholder="What symptoms are you experiencing? (e.g., Cracked screen, battery draining fast)"></textarea>
                    </div>

                    <div class="space-y-2">
                        <label for="device_image" class="block text-sm font-semibold text-gray-700">Upload Photo of Damage (Optional)</label>
                        <input type="file" id="device_image" name="device_image" accept="image/*"
                            class="block w-full text-sm text-gray-500
                                file:mr-4 file:py-2.5 file:px-4
                                file:rounded-xl file:border-0
                                file:text-sm file:font-semibold
                                file:bg-gray-100 file:text-gray-900
                                hover:file:bg-gray-200 transition-all cursor-pointer">
                    </div>
                </section>

                <button type="submit"
                    class="w-full py-4 bg-gray-900 text-white font-bold rounded-xl hover:bg-gray-800 focus:ring-4 focus:ring-gray-200 transition-all shadow-lg hover:-translate-y-0.5 flex justify-center items-center gap-2">
                    Submit Booking Request
                    <span class="material-symbols-outlined text-sm">arrow_forward</span>
                </button>
            </form>
        </div>
    </main>
</x-layouts.landing>
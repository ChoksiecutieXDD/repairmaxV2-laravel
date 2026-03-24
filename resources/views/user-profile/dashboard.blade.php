<x-layouts.user title="My Dashboard | Repairmax">

    <div class="mb-8">
        <h1 class="text-2xl font-bold text-gray-900">Welcome back, {{ Auth::user()->first_name }}!</h1>
        <p class="text-gray-600 mt-1">Here is what is happening with your devices today.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm">
            <h3 class="text-gray-500 text-sm font-semibold mb-2">Active Repairs</h3>
            <p class="text-3xl font-bold text-gray-900">2</p>
        </div>

        <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm">
            <h3 class="text-gray-500 text-sm font-semibold mb-2">Upcoming Appointments</h3>
            <p class="text-3xl font-bold text-gray-900">1</p>
        </div>
    </div>

</x-layouts.user>
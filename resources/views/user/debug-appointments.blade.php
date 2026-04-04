@php
    $user = Auth::user();
    $allAppointments = $user->appointments()->get();
    $completedAppointments = $user->appointments()->whereIn('status', ['Completed', 'Cancelled'])->get();
@endphp

<div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 mb-6">
    <p class="text-sm font-bold text-yellow-800 mb-2">🔍 Debug Information (Remove Before Production)</p>
    <ul class="text-xs text-yellow-700 space-y-1">
        <li>Total Appointments: {{ $allAppointments->count() }}</li>
        <li>Completed/Cancelled Appointments: {{ $completedAppointments->count() }}</li>
    </ul>
    @if($completedAppointments->count() > 0)
        <p class="text-xs text-yellow-700 font-bold mt-2">Completed appointments found:</p>
        @foreach($completedAppointments as $apt)
            <p class="text-xs text-yellow-700 ml-4">
                • {{ $apt->tracking_code }} - Status: <span class="font-mono">{{ $apt->status }}</span> - Cost: {{ $apt->final_cost ?? 'NULL' }}
            </p>
        @endforeach
    @endif
    @if($allAppointments->count() > 0)
        <p class="text-xs text-yellow-700 font-bold mt-2">All appointment statuses:</p>
        @foreach($allAppointments as $apt)
            <p class="text-xs text-yellow-700 ml-4">
                • {{ $apt->tracking_code }} - Status: <span class="font-mono">{{ $apt->status }}</span>
            </p>
        @endforeach
    @endif
</div>

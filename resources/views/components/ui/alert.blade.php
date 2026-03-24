@props(['type' => 'info', 'message'])

@php
$classes = match($type) {
'success' => 'bg-green-50 border-green-200 text-green-800',
'error' => 'bg-red-50 border-red-200 text-red-800',
'warning' => 'bg-yellow-50 border-yellow-200 text-yellow-800',
default => 'bg-gray-100 border-gray-300 text-gray-800',
};

$icon = match($type) {
'success' => 'check_circle',
'error' => 'cancel',
'warning' => 'warning',
default => 'info',
};
@endphp

<div x-data="{ show: true }" x-show="show" class="border rounded-md p-4 mb-4 flex items-start gap-3 {{ $classes }}">
    <span class="material-symbols-outlined mt-0.5">{{ $icon }}</span>
    <div class="flex-1">
        <p class="text-sm font-medium">{{ $message }}</p>
        @if(isset($slot) && $slot->isNotEmpty())
        <div class="mt-1 text-sm opacity-90">
            {{ $slot }}
        </div>
        @endif
    </div>
    <button @click="show = false" class="opacity-70 hover:opacity-100 transition-opacity">
        <span class="material-symbols-outlined">close</span>
    </button>
</div>
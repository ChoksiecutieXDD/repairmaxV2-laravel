@props(['name', 'maxWidth' => '2xl'])

@php
$maxWidthClass = match ($maxWidth) {
'sm' => 'sm:max-w-sm',
'md' => 'sm:max-w-md',
'lg' => 'sm:max-w-lg',
'xl' => 'sm:max-w-xl',
'2xl' => 'sm:max-w-2xl',
default => 'sm:max-w-2xl',
};
@endphp

<div x-data="{ show: false, name: '{{ $name }}' }"
    x-show="show"
    @open-modal.window="if ($event.detail === name) show = true"
    @close-modal.window="if ($event.detail === name) show = false"
    @keydown.escape.window="show = false"
    style="display: none;"
    class="fixed inset-0 z-50 overflow-y-auto px-4 py-6 sm:px-0 z-[100]"
    x-transition:enter="ease-out duration-300"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="ease-in duration-200"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0">

    <div x-show="show" class="fixed inset-0 transform transition-all" @click="show = false"
        x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0">
        <div class="absolute inset-0 bg-gray-900/50 backdrop-blur-sm"></div>
    </div>

    <div x-show="show"
        class="mb-6 bg-white rounded-3xl overflow-hidden shadow-xl transform transition-all sm:w-full sm:mx-auto {{ $maxWidthClass }}"
        x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
        x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
        x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
        x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
        {{ $slot }}
    </div>
</div>
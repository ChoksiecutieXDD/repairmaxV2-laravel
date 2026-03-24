@props(['href', 'icon', 'active' => false])

<a href="{{ $href }}"
    class="flex items-center gap-3 mx-3 px-3 py-2.5 rounded-lg transition-all duration-200 group 
          {{ $active ? 'bg-gray-800 text-white font-semibold' : 'text-gray-400 hover:text-white hover:bg-gray-800' }}">
    <span class="material-symbols-outlined text-[22px] transition-transform group-hover:scale-110 {{ $active ? 'text-blue-400' : '' }}">
        {{ $icon }}
    </span>
    <span class="font-medium text-sm truncate">{{ $slot }}</span>
</a>
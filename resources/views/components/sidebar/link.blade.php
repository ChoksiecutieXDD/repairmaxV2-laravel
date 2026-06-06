@props(['href', 'icon', 'active' => false])

<a href="{{ $href }}"
    class="relative flex items-center gap-3.5 mx-3.5 px-4 py-3 rounded-xl transition-all duration-300 group 
          {{ $active 
             ? 'bg-blue-600/10 text-blue-600 dark:text-blue-400 font-bold' 
             : 'text-gray-500 hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-gray-200 dark:hover:bg-white/5' }}">
    <span class="material-symbols-outlined text-[20px] transition-transform duration-300 group-hover:scale-105 {{ $active ? 'text-blue-600 dark:text-blue-400' : 'text-gray-400 dark:text-gray-500' }}">
        {{ $icon }}
    </span>
    <span class="text-sm font-medium truncate">{{ $slot }}</span>
    @if($active)
        <span class="absolute right-0 top-3 bottom-3 w-1 bg-blue-500 rounded-l-md"></span>
    @endif
</a>
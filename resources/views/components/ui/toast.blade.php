<div x-data="{ 
        show: {{ session()->has('message') ? 'true' : 'false' }}, 
        message: '{{ session('message') ?? '' }}', 
        type: 'success',
        timeout: null,
        
        init() {
            if (this.show) {
                this.startTimeout();
            }
        },
        
        showToast(event) {
            this.message = event.detail.message;
            this.type = event.detail.type || 'success';
            this.show = true;
            this.startTimeout();
        },

        startTimeout() {
            clearTimeout(this.timeout);
            this.timeout = setTimeout(() => { this.show = false }, 3000);
        }
    }"
    @notify.window="showToast"
    class="fixed top-10 left-1/2 -translate-x-1/2 z-[110]"
    style="display: none;"
    x-show="show"
    x-transition:enter="transition ease-out duration-500"
    x-transition:enter-start="opacity-0 -translate-y-10 scale-95"
    x-transition:enter-end="opacity-100 translate-y-0 scale-100"
    x-transition:leave="transition ease-in duration-400"
    x-transition:leave-start="opacity-100 translate-y-0 scale-100"
    x-transition:leave-end="opacity-0 -translate-y-10 scale-95">

    <div class="flex items-center gap-3 px-5 py-4 rounded-xl text-white shadow-none border-none"
        :class="{
            'bg-gray-900': type === 'success',
            'bg-red-600': type === 'error'
        }">
        <span class="material-symbols-outlined" x-text="type === 'success' ? 'check_circle' : 'error'"></span>
        <p class="font-medium text-sm" x-text="message"></p>
        <button @click="show = false" class="ml-4 p-0 bg-transparent opacity-70 hover:opacity-100 transition-opacity">
            <span class="material-symbols-outlined text-[20px]">close</span>
        </button>
    </div>
</div>
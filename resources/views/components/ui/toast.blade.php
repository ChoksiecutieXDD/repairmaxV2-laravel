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
    class="fixed bottom-5 right-5 z-[110]"
    style="display: none;"
    x-show="show"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 transform translate-y-4"
    x-transition:enter-end="opacity-100 transform translate-y-0"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100 transform translate-y-0"
    x-transition:leave-end="opacity-0 transform translate-y-4">

    <div class="flex items-center gap-3 px-5 py-4 rounded-xl shadow-lg border"
        :class="{
            'bg-gray-900 text-white border-gray-800': type === 'success',
            'bg-red-600 text-white border-red-700': type === 'error'
        }">
        <span class="material-symbols-outlined" x-text="type === 'success' ? 'check_circle' : 'error'"></span>
        <p class="font-medium text-sm" x-text="message"></p>
        <button @click="show = false" class="ml-4 opacity-70 hover:opacity-100">
            <span class="material-symbols-outlined text-sm">close</span>
        </button>
    </div>
</div>
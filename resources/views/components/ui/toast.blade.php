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
            let detail = event.detail || {};
            if (Array.isArray(detail)) {
                detail = detail[0] || {};
            } else if (detail.message === undefined && detail[0]) {
                detail = detail[0];
            }
            this.message = detail.message || '';
            this.type = detail.type || 'success';
            this.show = true;
            this.startTimeout();
        },

        startTimeout() {
            clearTimeout(this.timeout);
            this.timeout = setTimeout(() => { this.show = false }, 3000);
        }
    }"
    @notify.window="showToast"
    @toast.window="showToast"
    class="fixed top-10 left-1/2 -translate-x-1/2 z-[110]"
    style="display: none;"
    x-show="show"
    x-transition:enter="transition ease-out duration-500"
    x-transition:enter-start="opacity-0 -translate-y-10 scale-95"
    x-transition:enter-end="opacity-100 translate-y-0 scale-100"
    x-transition:leave="transition ease-in duration-400"
    x-transition:leave-start="opacity-100 translate-y-0 scale-100"
    x-transition:leave-end="opacity-0 -translate-y-10 scale-95">

    <div class="flex items-center justify-between gap-6 px-6 py-4 rounded-[1.25rem] text-white shadow-xl border-none min-w-[320px] sm:min-w-[450px] max-w-lg"
        :class="{
            'bg-gray-900': type === 'success',
            'bg-red-600': type === 'error'
        }"
        style="color: #ffffff !important; box-shadow: 0 20px 25px -5px rgb(0 0 0 / 0.1), 0 8px 10px -6px rgb(0 0 0 / 0.1) !important;">
        <div class="flex items-center gap-2.5 leading-none" style="color: #ffffff !important;">
            <span class="material-symbols-outlined text-white text-[20px] leading-none shrink-0" style="color: #ffffff !important; display: inline-flex; align-items: center; justify-content: center;" x-text="type === 'success' ? 'check_circle' : 'error'"></span>
            <p class="font-medium text-sm text-white leading-none m-0 p-0" style="color: #ffffff !important; margin: 0; padding: 0; display: inline-block;" x-text="message"></p>
        </div>
        <button @click="show = false" class="p-0 bg-transparent opacity-70 hover:opacity-100 transition-opacity shrink-0 flex items-center justify-center" style="color: #ffffff !important; border: none; background: transparent; box-shadow: none; outline: none;">
            <span class="material-symbols-outlined text-[18px] text-white leading-none" style="color: #ffffff !important; display: inline-flex; align-items: center; justify-content: center;">close</span>
        </button>
    </div>
</div>
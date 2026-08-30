<div x-data="{ 
        show: false, 
        message: '', 
        type: 'success',
        init() {
            window.addEventListener('toast', (e) => {
                this.message = e.detail.message;
                this.type = e.detail.type || 'success';
                this.show = true;
                setTimeout(() => this.show = false, 4000);
            });
            
            // Check for session flash messages
            @if(session('success'))
                this.message = '{{ session('success') }}';
                this.type = 'success';
                this.show = true;
                setTimeout(() => this.show = false, 4000);
            @endif
            
            @if(session('error'))
                this.message = '{{ session('error') }}';
                this.type = 'error';
                this.show = true;
                setTimeout(() => this.show = false, 5000);
            @endif
        }
     }"
     x-show="show"
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0 translate-y-2 sm:translate-y-0 sm:translate-x-2"
     x-transition:enter-end="opacity-100 translate-y-0 sm:translate-x-0"
     x-transition:leave="transition ease-in duration-200"
     x-transition:leave-start="opacity-100 translate-y-0 sm:translate-x-0"
     x-transition:leave-end="opacity-0 translate-y-2 sm:translate-y-0 sm:translate-x-2"
     style="display: none;"
     class="fixed bottom-5 right-5 z-[9999] rounded-lg border bg-black/80 px-4 py-3 text-sm shadow-[0_0_15px_rgba(255,255,255,0.1)] backdrop-blur-md"
     :class="{
         'border-amber-500/30 text-amber-400 shadow-[0_0_15px_rgba(217,119,6,0.3)]': type === 'success',
         'border-red-500/30 text-red-400 shadow-[0_0_15px_rgba(239,68,68,0.3)]': type === 'error'
     }">
    <span x-text="message"></span>
</div>

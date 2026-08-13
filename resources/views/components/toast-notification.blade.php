@if (session('success') || session('error'))
    <div x-data="{ 
            show: true, 
            init() { 
                setTimeout(() => this.show = false, 5000); 
            } 
        }"
        x-show="show"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 -translate-y-4 sm:translate-y-0 sm:-translate-x-4"
        x-transition:enter-end="opacity-100 translate-y-0 sm:translate-x-0"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 translate-y-0 sm:translate-x-0"
        x-transition:leave-end="opacity-0 -translate-y-4 sm:translate-y-0 sm:-translate-x-4"
        class="fixed top-5 right-5 z-50 max-w-sm w-full bg-slate-900 border text-white rounded-2xl shadow-2xl p-4 flex items-start gap-3 {{ session('success') ? 'border-emerald-500/30' : 'border-rose-500/30' }}">

        {{-- TOAST SUCCÈS (VERT) --}}
        @if(session('success'))
            <div class="flex-shrink-0 w-8 h-8 rounded-xl bg-emerald-500/20 border border-emerald-500/40 text-emerald-400 flex items-center justify-center">
                <svg class="w-5 h-5 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
            </div>
            <div class="flex-1 text-xs">
                <p class="font-bold text-emerald-400 text-sm mb-0.5">Succès !</p>
                <p class="text-slate-300 leading-relaxed">{{ session('success') }}</p>
            </div>
        @endif

        {{-- TOAST ERREUR (ROUGE) --}}
        @if(session('error'))
            <div class="flex-shrink-0 w-8 h-8 rounded-xl bg-rose-500/20 border border-rose-500/40 text-rose-400 flex items-center justify-center">
                <svg class="w-5 h-5 text-rose-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </div>
            <div class="flex-1 text-xs">
                <p class="font-bold text-rose-400 text-sm mb-0.5">Erreur !</p>
                <p class="text-slate-300 leading-relaxed">{{ session('error') }}</p>
            </div>
        @endif

        {{-- BOUTON FERMER --}}
        <button @click="show = false" class="text-slate-400 hover:text-white transition p-1">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>
@endif
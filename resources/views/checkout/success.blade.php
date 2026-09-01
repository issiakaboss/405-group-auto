<x-guest-layout>
    <div class="min-h-[60vh] flex flex-col justify-center items-center bg-gray-50/50 px-4 py-12">
        <div class="w-full sm:max-w-md bg-white border border-gray-100 shadow-sm rounded-2xl p-8 text-center space-y-6">

            <!-- Icône Succès -->
            <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-emerald-50 text-emerald-600 shadow-inner">
                <svg class="h-8 w-8" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                </svg>
            </div>

            <!-- Titre & Message -->
            <div class="space-y-2">
                <h2 class="text-2xl font-bold text-gray-900 tracking-tight">{{ __('public/success.title') }}</h2>
                <p class="text-xs text-gray-500 max-w-xs mx-auto leading-relaxed">
                    {{ __('public/success.subtitle') }}
                </p>
            </div>

            <!-- Prochaines étapes -->
            <div class="bg-gray-50 rounded-xl p-4 text-left border border-gray-100">
                <h4 class="text-xs font-bold text-gray-900 mb-2">{{ __('public/success.next_steps_title') }}</h4>
                <ul class="text-[11px] text-gray-500 space-y-1.5 list-disc pl-4 leading-relaxed">
                    <li>{{ __('public/success.step_1') }}</li>
                    <li>{{ __('public/success.step_2') }}</li>
                    <li>{{ __('public/success.step_3') }}</li>
                </ul>
            </div>

            <!-- Liens de redirection -->
            <div class="pt-2 flex flex-col space-y-2.5">
                <a href="{{ route('dashboard') }}" class="w-full py-3 bg-[#0F172A] hover:bg-slate-800 text-white font-semibold text-xs rounded-xl shadow-sm transition tracking-wide text-center uppercase">
                    {{ __('public/success.btn_dashboard') }}
                </a>
                <a href="{{ route('home') }}" class="w-full py-2.5 bg-white border border-gray-200 text-gray-700 font-semibold text-xs rounded-xl hover:bg-gray-50 transition text-center shadow-sm">
                    {{ __('public/success.btn_catalog') }}
                </a>
            </div>

        </div>
    </div>
</x-guest-layout>
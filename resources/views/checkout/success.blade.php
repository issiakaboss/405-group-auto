<x-guest-layout>
    <div class="min-h-[60vh] flex flex-col justify-center items-center bg-gray-50/50 px-4 py-12">
        <div class="w-full sm:max-w-md bg-white border border-gray-100 shadow-sm rounded-2xl p-8 text-center space-y-6">
            
            <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-emerald-50 text-emerald-600 shadow-inner">
                <svg class="h-8 w-8" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                </svg>
            </div>

            <div class="space-y-2">
                <h2 class="text-2xl font-bold text-gray-900 tracking-tight">Order Placed Successfully!</h2>
                <p class="text-xs text-gray-400 max-w-xs mx-auto leading-relaxed">
                    Thank you for your trust. Your transatlantic import request has been recorded and is now under premium review.
                </p>
            </div>

            <div class="bg-gray-50 rounded-xl p-4 text-left border border-gray-100">
                <h4 class="text-xs font-bold text-gray-900 mb-1">What happens next?</h4>
                <ul class="text-[11px] text-gray-500 space-y-1 list-disc pl-4 leading-relaxed">
                    <li>An automotive agent will verify auction and customs documentation.</li>
                    <li>You will receive a quote for freight tracking from the US ports.</li>
                    <li>Your dashboard will be updated with container tracking numbers.</li>
                </ul>
            </div>

            <div class="pt-2 flex flex-col space-y-2.5">
                <a href="{{ route('dashboard') }}" class="w-full py-3 bg-[#0F172A] hover:bg-gray-800 text-white font-semibold text-xs rounded-xl shadow-sm transition tracking-wide text-center uppercase">
                    Go to My Dashboard
                </a>
                <a href="{{ url('/') }}#catalog" class="w-full py-2.5 bg-white border border-gray-200 text-gray-700 font-semibold text-xs rounded-xl hover:bg-gray-50 transition text-center shadow-sm">
                    Back to Showroom
                </a>
            </div>

        </div>
    </div>
</x-guest-layout>
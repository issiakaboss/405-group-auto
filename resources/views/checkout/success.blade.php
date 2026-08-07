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
                <h2 class="text-2xl font-bold text-gray-900 tracking-tight">Reservation Request Received!</h2>
                <p class="text-xs text-gray-500 max-w-xs mx-auto leading-relaxed">
                    Thank you for your interest. Your vehicle inspection and quote request has been recorded and is now under review.
                </p>
            </div>

            <!-- Prochaines étapes -->
            <div class="bg-gray-50 rounded-xl p-4 text-left border border-gray-100">
                <h4 class="text-xs font-bold text-gray-900 mb-2">What happens next?</h4>
                <ul class="text-[11px] text-gray-500 space-y-1.5 list-disc pl-4 leading-relaxed">
                    <li>An advisor will verify vehicle availability and condition.</li>
                    <li>We will contact you via phone or email to confirm inspection or test-drive details.</li>
                    <li>You will receive a complete breakdown quote and next steps.</li>
                </ul>
            </div>

            <!-- Liens de redirection -->
            <div class="pt-2 flex flex-col space-y-2.5">
                <a href="{{ route('dashboard') }}" class="w-full py-3 bg-[#0F172A] hover:bg-slate-800 text-white font-semibold text-xs rounded-xl shadow-sm transition tracking-wide text-center uppercase">
                    Go to My Dashboard
                </a>
                <a href="{{ route('home') }}" class="w-full py-2.5 bg-white border border-gray-200 text-gray-700 font-semibold text-xs rounded-xl hover:bg-gray-50 transition text-center shadow-sm">
                    Back to Catalog
                </a>
            </div>

        </div>
    </div>
</x-guest-layout>
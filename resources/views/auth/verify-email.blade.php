<x-guest-layout>
    <div class="min-h-[55vh] flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-50/50 px-4">
        
        <div class="w-full sm:max-w-md mt-6 px-8 py-8 bg-white border border-gray-100 shadow-sm rounded-2xl">
            
            <div class="mb-6 text-center">
                <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-blue-50 text-blue-600 mb-4">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0l-7.5-4.615a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                    </svg>
                </div>
                <h2 class="text-xl font-bold text-gray-900 tracking-tight">Verify Your Email</h2>
                <p class="text-xs text-gray-400 mt-2 leading-relaxed">
                    Thanks for signing up! Please verify your email address by clicking on the link we just sent you. If you didn't receive it, we'll gladly send another.
                </p>
            </div>

            @if (session('status') == 'verification-link-sent')
                <div class="mb-6 bg-emerald-50 border border-emerald-100 text-emerald-800 px-4 py-3 rounded-xl text-xs font-medium text-center">
                    {{ __('A new verification link has been sent to your email address.') }}
                </div>
            @endif

            <div class="mt-4 flex flex-col space-y-3">
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf
                    <button type="submit" class="w-full py-3 bg-[#0F172A] hover:bg-gray-800 text-white font-semibold text-xs rounded-xl shadow-sm transition tracking-wide uppercase">
                        {{ __('Resend Verification Email') }}
                    </button>
                </form>

                <form method="POST" action="{{ route('logout') }}" class="text-center">
                    @csrf
                    <button type="submit" class="text-xs text-gray-400 hover:text-gray-900 transition underline font-medium">
                        {{ __('Log Out') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
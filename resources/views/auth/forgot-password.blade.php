<x-guest-layout>
    <div class="min-h-[55vh] flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-50/50 px-4">
        
        <div class="w-full sm:max-w-md mt-6 px-8 py-8 bg-white border border-gray-100 shadow-sm rounded-2xl">
            
            <div class="mb-6 text-center">
                <h2 class="text-2xl font-bold text-gray-900 tracking-tight">Forgot Password</h2>
                <p class="text-xs text-gray-400 mt-2 leading-relaxed">
                    No problem. Enter your email address and we will send you a link to choose a new one.
                </p>
            </div>

            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('password.email') }}" class="space-y-4">
                @csrf

                <div>
                    <label for="email" class="block text-xs font-semibold text-gray-700 mb-1">Email Address</label>
                    <input 
                        id="email" 
                        type="email" 
                        name="email" 
                        value="{{ old('email') }}" 
                        required 
                        autofocus
                        class="w-full text-xs px-3 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:border-gray-400 focus:ring-0 transition outline-none"
                    >
                    <x-input-error :messages="$errors->get('email')" class="mt-1" />
                </div>

                <div class="pt-2">
                    <button type="submit" class="w-full py-3 bg-[#0F172A] hover:bg-gray-800 text-white font-semibold text-xs rounded-xl shadow-sm transition tracking-wide uppercase">
                        {{ __('Email Password Reset Link') }}
                    </button>
                </div>

                <p class="text-center text-[11px] text-gray-400 pt-1">
                    <a href="{{ route('login') }}" class="text-gray-900 font-semibold hover:underline">Back to Login</a>
                </p>
            </form>
        </div>
    </div>
</x-guest-layout>
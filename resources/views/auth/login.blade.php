<x-guest-layout>
    <div class="min-h-[60vh] flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-50/50 px-4">

        <div class="w-full sm:max-w-md mt-6 px-8 py-8 bg-white border border-gray-100 shadow-sm rounded-2xl">

            <div class="mb-6 text-center">
                <h2 class="text-2xl font-bold text-gray-900 tracking-tight">Welcome Back</h2>
                <p class="text-xs text-gray-400 mt-1">Sign in to your account to manage orders</p>
            </div>

            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}" class="space-y-4">
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
                        autocomplete="username"
                        class="w-full text-xs px-3 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:border-gray-400 focus:ring-0 transition outline-none">
                    <x-input-error :messages="$errors->get('email')" class="mt-1" />
                </div>

                <div>
                    <div class="flex justify-between items-center mb-1">
                        <label for="password" class="text-xs font-semibold text-gray-700">Password</label>
                        @if (Route::has('password.request'))
                        <a class="text-[11px] text-gray-400 hover:text-gray-900 transition underline" href="{{ route('password.request') }}">
                            {{ __('Forgot password?') }}
                        </a>
                        @endif
                    </div>
                    <input
                        id="password"
                        type="password"
                        name="password"
                        required
                        autocomplete="current-password"
                        class="w-full text-xs px-3 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:border-gray-400 focus:ring-0 transition outline-none">
                    <x-input-error :messages="$errors->get('password')" class="mt-1" />
                </div>

                <div class="flex items-center justify-between pt-1">
                    <label for="remember_me" class="inline-flex items-center cursor-pointer">
                        <input
                            id="remember_me"
                            type="checkbox"
                            name="remember"
                            class="rounded border-gray-200 text-[#0F172A] focus:ring-0 focus:ring-offset-0 h-4 w-4 transition">
                        <span class="ms-2 text-xs text-gray-500 font-medium select-none">{{ __('Remember me') }}</span>
                    </label>
                </div>

                <div class="pt-2">
                    <button type="submit" class="w-full py-3 bg-[#0F172A] hover:bg-gray-800 text-white font-semibold text-xs rounded-xl shadow-sm transition tracking-wide uppercase">
                        {{ __('Log in') }}
                    </button>
                </div>

                @if (Route::has('register'))
                <p class="text-center text-[11px] text-gray-400 pt-2">
                    Don't have an account?
                    <a href="{{ route('register') }}" class="text-gray-900 font-semibold hover:underline">Create one</a>
                </p>
                @endif
            </form>
        </div>
    </div>
</x-guest-layout>
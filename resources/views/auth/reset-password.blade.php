<x-guest-layout>
    <div class="min-h-[60vh] flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-50/50 px-4">
        
        <div class="w-full sm:max-w-md mt-6 px-8 py-8 bg-white border border-gray-100 shadow-sm rounded-2xl">
            
            <div class="mb-6 text-center">
                <h2 class="text-2xl font-bold text-gray-900 tracking-tight">{{ __('public/auth.reset_title') }}</h2>
                <p class="text-xs text-gray-400 mt-1">{{ __('public/auth.reset_subtitle') }}</p>
            </div>

            <form method="POST" action="{{ route('password.store') }}" class="space-y-4">
                @csrf

                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <div>
                    <label for="email" class="block text-xs font-semibold text-gray-700 mb-1">{{ __('public/auth.email') }}</label>
                    <input 
                        id="email" 
                        type="email" 
                        name="email" 
                        value="{{ old('email', $request->email) }}" 
                        required 
                        autocomplete="username"
                        class="w-full text-xs px-3 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:border-gray-400 focus:ring-0 transition outline-none"
                    >
                    <x-input-error :messages="$errors->get('email')" class="mt-1" />
                </div>

                <div>
                    <label for="password" class="block text-xs font-semibold text-gray-700 mb-1">{{ __('public/auth.new_password') }}</label>
                    <input 
                        id="password" 
                        type="password" 
                        name="password" 
                        required 
                        autocomplete="new-password"
                        class="w-full text-xs px-3 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:border-gray-400 focus:ring-0 transition outline-none"
                    >
                    <x-input-error :messages="$errors->get('password')" class="mt-1" />
                </div>

                <div>
                    <label for="password_confirmation" class="block text-xs font-semibold text-gray-700 mb-1">{{ __('public/auth.confirm_new_password') }}</label>
                    <input 
                        id="password_confirmation" 
                        type="password" 
                        name="password_confirmation" 
                        required 
                        autocomplete="new-password"
                        class="w-full text-xs px-3 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:border-gray-400 focus:ring-0 transition outline-none"
                    >
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1" />
                </div>

                <div class="pt-2">
                    <button type="submit" class="w-full py-3 bg-[#0F172A] hover:bg-gray-800 text-white font-semibold text-xs rounded-xl shadow-sm transition tracking-wide uppercase">
                        {{ __('public/auth.reset_btn') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
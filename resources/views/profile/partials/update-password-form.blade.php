<section>
    <header>
        <h2 class="text-base font-bold text-white uppercase tracking-tight">
            {{ __('profile.password.title') }}
        </h2>

        <p class="mt-1 text-xs text-slate-400">
            {{ __('profile.password.subtitle') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-5">
        @csrf
        @method('put')

        <div>
            <label for="update_password_current_password" class="block text-xs font-semibold text-slate-300 mb-1.5">{{ __('profile.password.current_password') }}</label>
            <input id="update_password_current_password" name="current_password" type="password" 
                class="w-full text-xs bg-slate-800/80 border border-slate-700 rounded-lg px-3.5 py-2.5 text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-amber-500/50 focus:border-amber-500 transition" 
                autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-1.5 text-xs text-rose-400" />
        </div>

        <div>
            <label for="update_password_password" class="block text-xs font-semibold text-slate-300 mb-1.5">{{ __('profile.password.new_password') }}</label>
            <input id="update_password_password" name="password" type="password" 
                class="w-full text-xs bg-slate-800/80 border border-slate-700 rounded-lg px-3.5 py-2.5 text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-amber-500/50 focus:border-amber-500 transition" 
                autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-1.5 text-xs text-rose-400" />
        </div>

        <div>
            <label for="update_password_password_confirmation" class="block text-xs font-semibold text-slate-300 mb-1.5">{{ __('profile.password.confirm_password') }}</label>
            <input id="update_password_password_confirmation" name="password_confirmation" type="password" 
                class="w-full text-xs bg-slate-800/80 border border-slate-700 rounded-lg px-3.5 py-2.5 text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-amber-500/50 focus:border-amber-500 transition" 
                autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-1.5 text-xs text-rose-400" />
        </div>

        <div class="flex items-center gap-4 pt-2">
            <button type="submit" class="px-4 py-2 bg-amber-500 hover:bg-amber-400 text-slate-950 font-bold text-xs rounded-lg transition shadow-sm">
                {{ __('profile.password.update') }}
            </button>

            @if (session('status') === 'password-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2500)" class="text-xs font-semibold text-emerald-400">
                    ✓ {{ __('profile.saved') }}
                </p>
            @endif
        </div>
    </form>
</section>
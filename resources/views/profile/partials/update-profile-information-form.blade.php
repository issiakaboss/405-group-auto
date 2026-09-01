<section>
    <header>
        <h2 class="text-base font-bold text-white uppercase tracking-tight">
            {{ __('profile.info.title') }}
        </h2>

        <p class="mt-1 text-xs text-slate-400">
            {{ __('profile.info.subtitle') }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-5">
        @csrf
        @method('patch')

        <div>
            <label for="name" class="block text-xs font-semibold text-slate-300 mb-1.5">{{ __('profile.info.name') }}</label>
            <input id="name" name="name" type="text" 
                class="w-full text-xs bg-slate-800/80 border border-slate-700 rounded-lg px-3.5 py-2.5 text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-amber-500/50 focus:border-amber-500 transition" 
                value="{{ old('name', $user->name) }}" required autofocus autocomplete="name" />
            <x-input-error class="mt-1.5 text-xs text-rose-400" :messages="$errors->get('name')" />
        </div>

        <div>
            <label for="email" class="block text-xs font-semibold text-slate-300 mb-1.5">{{ __('profile.info.email') }}</label>
            <input id="email" name="email" type="email" 
                class="w-full text-xs bg-slate-800/80 border border-slate-700 rounded-lg px-3.5 py-2.5 text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-amber-500/50 focus:border-amber-500 transition" 
                value="{{ old('email', $user->email) }}" required autocomplete="username" />
            <x-input-error class="mt-1.5 text-xs text-rose-400" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-xs mt-2 text-slate-300">
                        {{ __('profile.info.unverified_email') }}

                        <button form="send-verification" class="underline text-xs text-amber-400 hover:text-amber-300 focus:outline-none">
                            {{ __('profile.info.resend_verification') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 text-xs font-medium text-emerald-400">
                            {{ __('profile.info.verification_link_sent') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4 pt-2">
            <button type="submit" class="px-4 py-2 bg-amber-500 hover:bg-amber-400 text-slate-950 font-bold text-xs rounded-lg transition shadow-sm">
                {{ __('profile.info.save') }}
            </button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2500)" class="text-xs font-semibold text-emerald-400">
                    ✓ {{ __('profile.saved') }}
                </p>
            @endif
        </div>
    </form>
</section>
<x-app-layout>
    <!-- Fond global très sombre -->
    <div class="py-12 bg-[#080d1a] min-h-[80vh] text-slate-100">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Titre de la page -->
            <div class="px-4 sm:px-0">
                <h2 class="font-bold text-2xl text-white leading-tight">
                    {{ __('profile.title') }}
                </h2>
                <p class="text-xs text-slate-400 mt-1">
                    {{ __('profile.subtitle') }}
                </p>
            </div>

            <!-- Bloc 1: Informations du profil -->
            <div class="p-4 sm:p-8 bg-[#0f172a] shadow-2xl sm:rounded-2xl border border-slate-800/80">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <!-- Bloc 2: Mot de passe -->
            <div class="p-4 sm:p-8 bg-[#0f172a] shadow-2xl sm:rounded-2xl border border-slate-800/80">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <!-- Bloc 3: Suppression du compte -->
            <div class="p-4 sm:p-8 bg-[#0f172a] shadow-2xl sm:rounded-2xl border border-slate-800/80">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
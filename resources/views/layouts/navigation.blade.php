<nav x-data="{ open: false }" class="bg-slate-900 border-b border-slate-800 text-white sticky top-0 z-50 shadow-md">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">

            <!-- 1. GAUCHE : LOGO BRAND -->
            <div class="flex items-center shrink-0">
                <a href="{{ route('home') }}" class="flex items-center gap-2 py-2">
                    <img src="{{ asset('images/logo2.jpeg') }}"
                        alt="405 Auto Group Logo"
                        class="h-9 md:h-10 w-auto object-contain">
                    @role('admin')
                    <span class="text-amber-500 text-xs uppercase font-extrabold ml-1">ADMIN</span>
                    @endrole
                </a>
            </div>

            <!-- 2. CENTRE : DESKTOP MENU LINKS -->
            <div class="hidden sm:flex items-center justify-center space-x-2">
                @role('user')
                <a href="{{ route('dashboard') }}"
                    class="px-3 py-2 rounded-lg text-xs font-semibold transition flex items-center gap-1.5 {{ request()->routeIs('dashboard') ? 'bg-amber-500 text-slate-950 shadow-sm font-bold' : 'text-slate-300 hover:text-white hover:bg-slate-800' }}">
                    📊 {{ __('admin/navigation.dashboard') }}
                </a>
                @endrole

                @role('admin')
                <a href="{{ route('admin.vehicles.index') }}"
                    class="px-3 py-2 rounded-lg text-xs font-semibold transition flex items-center gap-1.5 {{ request()->routeIs('admin.vehicles.*') ? 'bg-amber-500 text-slate-950 shadow-sm font-bold' : 'text-amber-400 hover:text-amber-300 hover:bg-slate-800' }}">
                    ⚙️ {{ __('admin/navigation.admin_fleet') }}
                </a>

                <a href="{{ route('admin.test-drives.index') }}"
                    class="px-3 py-2 rounded-lg text-xs font-semibold transition flex items-center gap-1.5 {{ request()->routeIs('admin.test-drives.*') ? 'bg-amber-500 text-slate-950 shadow-sm font-bold' : 'text-amber-400 hover:text-amber-300 hover:bg-slate-800' }}">
                    🏎️ {{ __('admin/navigation.test_drives') }}
                </a>

                <a href="{{ route('admin.orders.index') }}"
                    class="px-3 py-2 rounded-lg text-xs font-semibold transition flex items-center gap-1.5 {{ request()->routeIs('admin.orders.*') ? 'bg-amber-500 text-slate-950 shadow-sm font-bold' : 'text-amber-400 hover:text-amber-300 hover:bg-slate-800' }}">
                    📦 {{ __('admin/navigation.orders') }}
                </a>

                <a href="{{ route('admin.vehicle-requests.index') }}"
                    class="px-3 py-2 rounded-lg text-xs font-semibold transition flex items-center gap-1.5 {{ request()->routeIs('admin.vehicle-requests.*') ? 'bg-amber-500 text-slate-950 shadow-sm font-bold' : 'text-amber-400 hover:text-amber-300 hover:bg-slate-800' }}">
                    🚗 {{ __('admin/navigation.vehicle_requests') }}
                </a>

                <a href="{{ route('admin.users.index') }}"
                    class="px-3 py-2 rounded-lg text-xs font-semibold transition flex items-center gap-1.5 {{ request()->routeIs('admin.users.*') ? 'bg-amber-500 text-slate-950 shadow-sm font-bold' : 'text-amber-400 hover:text-amber-300 hover:bg-slate-800' }}">
                    👥 {{ __('admin/navigation.admins') }}
                </a>
                @endrole
            </div>

            <!-- 3. DROITE : SELECTEUR DE LANGUE & PROFIL USER -->
            <div class="hidden sm:flex items-center space-x-3 shrink-0">
                
                <!-- SELECTEUR DE LANGUE (DESKTOP) -->
                <x-dropdown align="right" width="36">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center gap-1.5 px-2.5 py-2 border border-slate-700 text-xs font-semibold rounded-lg text-slate-200 bg-slate-800 hover:bg-slate-700 hover:text-white focus:outline-none transition shadow-sm">
                            <!-- Icon Globe -->
                            <svg class="w-4 h-4 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 002 2h1.5a2.5 2.5 0 002.5-2.5V11a2 2 0 00-2-2h-1c-1 0-1.5-.5-1.5-1V5.5A2.5 2.5 0 0014.5 3h-1.872a2.5 2.5 0 00-2.128 1.18L10.5 5.5" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span class="uppercase font-bold">{{ app()->getLocale() }}</span>
                            <svg class="fill-current h-3 w-3 text-slate-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <a href="{{ route('lang.switch', 'fr') }}" class="flex items-center gap-2 px-4 py-2 text-xs font-semibold text-slate-700 hover:bg-slate-100 {{ app()->getLocale() === 'fr' ? 'bg-slate-50 font-bold text-amber-600' : '' }}">
                            🇫🇷 Français
                        </a>
                        <a href="{{ route('lang.switch', 'en') }}" class="flex items-center gap-2 px-4 py-2 text-xs font-semibold text-slate-700 hover:bg-slate-100 {{ app()->getLocale() === 'en' ? 'bg-slate-50 font-bold text-amber-600' : '' }}">
                            🇺🇸 English
                        </a>
                    </x-slot>
                </x-dropdown>

                <!-- DROPDOWN PROFIL -->
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-slate-700 text-xs leading-4 font-semibold rounded-lg text-slate-200 bg-slate-800 hover:bg-slate-700 hover:text-white focus:outline-none transition ease-in-out duration-150 shadow-sm">
                            <div>{{ Auth::user()->name }}</div>
                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4 text-slate-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('home')" class="text-xs font-semibold text-slate-700 hover:bg-slate-100">
                            🌐 {{ __('admin/navigation.public_site') }}
                        </x-dropdown-link>

                        <x-dropdown-link :href="route('profile.edit')" class="text-xs font-semibold">
                            👤 {{ __('admin/navigation.profile') }}
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();"
                                class="text-xs font-semibold text-red-600 hover:bg-red-50">
                                🚪 {{ __('admin/navigation.logout') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- BURGER MENU MOBILE -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-slate-400 hover:text-white hover:bg-slate-800 focus:outline-none transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

        </div>
    </div>

    <!-- RESPONSIVE MOBILE MENU -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-slate-900 border-b border-slate-800">
        <div class="pt-2 pb-3 space-y-1 px-2">
            <a href="{{ route('dashboard') }}" class="block px-3 py-2 rounded-md text-sm font-semibold {{ request()->routeIs('dashboard') ? 'bg-amber-500 text-slate-950 font-bold' : 'text-slate-300 hover:bg-slate-800' }}">
                📊 {{ __('admin/navigation.dashboard') }}
            </a>

            @role('admin')
            <a href="{{ route('admin.vehicles.index') }}" class="block px-3 py-2 rounded-md text-sm font-semibold {{ request()->routeIs('admin.vehicles.*') ? 'bg-amber-500 text-slate-950 font-bold' : 'text-amber-400 hover:bg-slate-800' }}">
                ⚙️ {{ __('admin/navigation.admin_fleet') }}
            </a>
            <a href="{{ route('admin.test-drives.index') }}" class="block px-3 py-2 rounded-md text-sm font-semibold {{ request()->routeIs('admin.test-drives.*') ? 'bg-amber-500 text-slate-950 font-bold' : 'text-amber-400 hover:bg-slate-800' }}">
                🏎️ {{ __('admin/navigation.test_drives') }}
            </a>
            <a href="{{ route('admin.orders.index') }}" class="block px-3 py-2 rounded-md text-sm font-semibold {{ request()->routeIs('admin.orders.*') ? 'bg-amber-500 text-slate-950 font-bold' : 'text-amber-400 hover:bg-slate-800' }}">
                📦 {{ __('admin/navigation.orders') }}
            </a>
            <a href="{{ route('admin.vehicle-requests.index') }}" class="block px-3 py-2 rounded-md text-sm font-semibold {{ request()->routeIs('admin.vehicle-requests.*') ? 'bg-amber-500 text-slate-950 font-bold' : 'text-amber-400 hover:bg-slate-800' }}">
                🚗 {{ __('admin/navigation.vehicle_requests') }}
            </a>
            <a href="{{ route('admin.users.index') }}" class="block px-3 py-2 rounded-md text-sm font-semibold {{ request()->routeIs('admin.users.*') ? 'bg-amber-500 text-slate-950 font-bold' : 'text-amber-400 hover:bg-slate-800' }}">
                👥 {{ __('admin/navigation.admins') }}
            </a>
            @endrole
        </div>

        <!-- SÉLECTEUR DE LANGUE (MOBILE) -->
        <div class="pt-2 pb-2 border-t border-slate-800 px-4">
            <div class="text-xs font-semibold text-slate-400 mb-2 flex items-center gap-1.5">
                <svg class="w-3.5 h-3.5 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 002 2h1.5a2.5 2.5 0 002.5-2.5V11a2 2 0 00-2-2h-1c-1 0-1.5-.5-1.5-1V5.5A2.5 2.5 0 0014.5 3h-1.872a2.5 2.5 0 00-2.128 1.18L10.5 5.5" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>Langue / Language</span>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('lang.switch', 'fr') }}" class="px-3 py-1.5 rounded-lg text-xs font-bold transition {{ app()->getLocale() === 'fr' ? 'bg-amber-500 text-slate-950' : 'bg-slate-800 text-slate-300 hover:bg-slate-700' }}">
                    🇫🇷 Français
                </a>
                <a href="{{ route('lang.switch', 'en') }}" class="px-3 py-1.5 rounded-lg text-xs font-bold transition {{ app()->getLocale() === 'en' ? 'bg-amber-500 text-slate-950' : 'bg-slate-800 text-slate-300 hover:bg-slate-700' }}">
                    🇬🇧 English
                </a>
            </div>
        </div>

        <div class="pt-4 pb-3 border-t border-slate-800 px-4">
            <div class="font-medium text-sm text-white">{{ Auth::user()->name }}</div>
            <div class="font-medium text-xs text-slate-400">{{ Auth::user()->email }}</div>

            <div class="mt-3 space-y-1">
                <a href="{{ route('home') }}" class="block text-xs font-semibold text-slate-300 py-1 hover:text-white">🌐 {{ __('admin/navigation.public_site') }}</a>
                <a href="{{ route('profile.edit') }}" class="block text-xs font-semibold text-slate-300 py-1 hover:text-white">👤 {{ __('admin/navigation.profile') }}</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-left text-xs font-semibold text-red-400 py-1 hover:text-red-300">
                        🚪 {{ __('admin/navigation.logout') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>
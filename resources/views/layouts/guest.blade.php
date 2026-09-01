<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', '405 Group Auto') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="font-sans text-gray-900 antialiased bg-white" x-data="{ searchResults: [], searchFocused: false }">

    <nav class="border-b border-slate-200 bg-slate-100/95 backdrop-blur-md sticky top-0 z-50 transition-all shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">

                <!-- LOGO -->
                <div class="flex items-center flex-shrink-0">
                    <a href="{{ route('home') }}" class="flex items-center py-2">
                        <img src="{{ asset('images/logo2-nbg.png') }}"
                            alt="405 Auto Group Logo"
                            class="h-10 md:h-12 w-auto object-contain">
                    </a>
                </div>

                <!-- NAVIGATION LINKS -->
                <div class="hidden md:flex space-x-8 text-sm font-medium">
                    <a href="{{ route('home') }}"
                        class="py-2 transition {{ request()->routeIs('home') ? 'text-amber-500 font-bold border-b-2 border-amber-500' : 'text-gray-600 hover:text-amber-500' }}">
                        {{ __('public/guest.nav_home') }}
                    </a>

                    <a href="{{ route('about') }}"
                        class="py-2 transition {{ request()->routeIs('about') ? 'text-amber-500 font-bold border-b-2 border-amber-500' : 'text-gray-600 hover:text-amber-500' }}">
                        {{ __('public/guest.nav_about') }}
                    </a>
                </div>

                <!-- SEARCH BAR -->
                <div class="hidden lg:block flex-1 max-w-xs mx-8 relative" x-data="{ searchFocused: false, searchResults: [] }" @click.away="searchFocused = false">
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.602 10.602Z" />
                            </svg>
                        </span>
                        <input
                            type="text"
                            placeholder="{{ __('public/guest.search_placeholder') }}"
                            @focus="searchFocused = true"
                            @input.debounce.300ms="
                            fetch(`/vehicles/search?q=${$event.target.value}`)
                                .then(res => res.json())
                                .then(data => { searchResults = data; searchFocused = true; })
                        "
                            class="w-full text-sm pl-10 pr-4 py-1.5 bg-white border border-gray-300 rounded-lg focus:bg-white focus:border-amber-500 focus:ring-1 focus:ring-amber-500 transition shadow-inner">
                    </div>

                    <div
                        x-show="searchFocused && searchResults.length > 0"
                        class="absolute left-0 right-0 mt-2 bg-white border border-gray-100 rounded-xl shadow-lg z-50 max-h-60 overflow-y-auto p-2 space-y-1"
                        x-cloak>
                        <template x-for="car in searchResults" :key="car.id">
                            <a :href="`/cars/${car.id}`" class="flex items-center space-x-3 p-2 hover:bg-gray-50 rounded-lg transition">
                                <img :src="car.image" class="w-12 h-8 object-cover rounded bg-gray-100">
                                <div class="flex-1 min-w-0">
                                    <p class="text-xs font-bold text-gray-900 truncate" x-text="car.title"></p>
                                    <p class="text-[10px] text-gray-400" x-text="`${car.year} • $${Number(car.price).toLocaleString()}`"></p>
                                </div>
                            </a>
                        </template>
                    </div>
                </div>

                <!-- ICONS, LANGUAGE SWITCHER & PROFILE -->
                <div class="flex items-center space-x-4 text-gray-700">

                    <!-- LANGUAGE SWITCHER -->
                    <div class="relative" x-data="{ langOpen: false }">
                        <button @click="langOpen = !langOpen" class="p-2 transition hover:text-amber-500 flex items-center space-x-1 focus:outline-none">
                            <svg class="w-5 h-5 text-gray-700 hover:text-amber-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 21a9.004 9.004 0 008.716-6.747M12 21a9.004 9.004 0 01-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 017.843 4.582M12 3a8.997 8.997 0 00-7.843 4.582m15.686 0A11.953 11.953 0 0112 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0121 12c0 .778-.099 1.533-.284 2.253m-15.432-6.83A8.959 8.959 0 003 12c0 .778.099 1.533.284 2.253" />
                            </svg>
                            <span class="text-xs font-bold uppercase">{{ app()->getLocale() }}</span>
                        </button>

                        <div x-show="langOpen" @click.away="langOpen = false" class="absolute right-0 mt-2 w-32 bg-white border border-gray-100 rounded-xl shadow-xl py-1 z-50 text-xs font-medium" x-cloak>
                            <a href="{{ route('lang.switch', 'en') }}" class="flex items-center px-4 py-2 text-gray-700 hover:bg-amber-50 hover:text-amber-600 transition {{ app()->getLocale() == 'en' ? 'font-bold text-amber-600' : '' }}">
                                🇺🇸 English
                            </a>
                            <a href="{{ route('lang.switch', 'fr') }}" class="flex items-center px-4 py-2 text-gray-700 hover:bg-amber-50 hover:text-amber-600 transition {{ app()->getLocale() == 'fr' ? 'font-bold text-amber-600' : '' }}">
                                🇫🇷 Français
                            </a>
                        </div>
                    </div>

                    <!-- FAVORITES LINK -->
                    <a href="{{ route('favorites.index') }}"
                        class="p-2 transition relative {{ request()->routeIs('favorites.*') ? 'text-amber-500' : 'hover:text-amber-500' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                        </svg>
                        <span id="fav-badge" class="absolute -top-1 -right-1 bg-gray-900 text-white text-[9px] font-bold rounded-full h-4 w-4 flex items-center justify-center shadow {{ (!session('favorites') || count(session('favorites')) == 0) ? 'hidden' : '' }}">
                            {{ session('favorites') ? count(session('favorites')) : 0 }}
                        </span>
                    </a>

                    <!-- CART LINK -->
                    <a href="{{ route('cart.index') }}"
                        class="p-2 transition relative {{ request()->routeIs('cart.*') ? 'text-amber-500' : 'hover:text-amber-500' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                        </svg>
                        @php
                        $cartCount = session('cart') ? array_sum(array_column(session('cart'), 'quantity')) : 0;
                        @endphp
                        <span id="cart-badge" class="absolute -top-1 -right-1 bg-red-600 text-white text-[9px] font-bold rounded-full h-4 w-4 flex items-center justify-center shadow {{ $cartCount == 0 ? 'hidden' : '' }}">
                            {{ $cartCount }}
                        </span>
                    </a>

                    @auth
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" class="flex items-center space-x-1.5 p-1.5 rounded-lg focus:outline-none hover:text-amber-500 transition">
                            <svg class="w-5 h-5 text-gray-700 hover:text-amber-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                            </svg>
                            <span class="text-xs font-semibold max-w-[80px] truncate">{{ Auth::user()->name }}</span>
                        </button>

                        <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-white border border-gray-100 rounded-xl shadow-xl py-1 z-50 text-xs font-medium" x-cloak>
                            @role('admin')
                            <a href="{{ route('admin.vehicles.index') }}" class="block px-4 py-2 font-bold text-amber-600 hover:bg-amber-50 transition uppercase tracking-wider text-[10px]">
                                ⚙️ {{ __('public/guest.admin_fleet') }}
                            </a>
                            <a href="{{ route('admin.orders.index') }}" class="block px-4 py-2 font-bold text-amber-600 hover:bg-amber-50 transition uppercase tracking-wider text-[10px]">
                                📦 {{ __('public/guest.admin_orders') }}
                            </a>
                            <a href="{{ route('admin.vehicle-requests.index') }}" class="block px-4 py-2 font-bold text-amber-600 hover:bg-amber-50 transition uppercase tracking-wider text-[10px]">
                                🚗 {{ __('public/guest.admin_requests') }}
                            </a>
                            <hr class="border-gray-100 my-1">
                            @endrole
                            @role('user')
                            <a href="{{ url('/dashboard') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-50">{{ __('public/guest.user_dashboard') }}</a>
                            @endrole
                            <hr class="border-gray-100">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full text-left px-4 py-2 text-red-600 hover:bg-red-50">
                                    {{ __('public/guest.logout') }}
                                </button>
                            </form>
                        </div>
                    </div>
                    @else
                    <a href="{{ route('login') }}" class="p-2 transition hover:text-amber-500">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                        </svg>
                    </a>
                    @endauth
                </div>

            </div>
        </div>
    </nav>

    <!-- COMPOSANT TOAST / SUCCÈS -->
    <x-toast-notification />

    <main>
        {{ $slot }}
    </main>

    <footer class="bg-slate-950 text-slate-400 pt-16 pb-8 border-t border-slate-800/80">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10 pb-12 border-b border-slate-800/80">

                <!-- Col 1: Description -->
                <div class="space-y-4">
                    <div class="flex items-center mb-4">
                        <img src="{{ asset('images/logo2.jpeg') }}" alt="405 Auto Group LLC" class="h-12 w-auto object-contain">
                    </div>
                    <p class="text-xs text-slate-400 leading-relaxed">
                        {{ __('public/guest.footer_description') }}
                    </p>
                </div>

                <!-- Col 2: Navigation Rapide -->
                <div>
                    <h3 class="text-white font-bold text-xs tracking-wider uppercase mb-4">{{ __('public/guest.footer_quick_nav') }}</h3>
                    <ul class="space-y-2.5 text-xs">
                        <li><a href="{{ route('home') }}" class="hover:text-amber-400 transition-colors">{{ __('public/guest.nav_home') }}</a></li>
                        <li><a href="{{ route('home') }}#catalog" class="hover:text-amber-400 transition-colors">{{ __('public/guest.footer_catalog') }}</a></li>
                        <li><a href="{{ route('about') }}" class="hover:text-amber-400 transition-colors">{{ __('public/guest.nav_about') }}</a></li>
                        <li><a href="{{ route('cart.index') }}" class="hover:text-amber-400 transition-colors flex items-center gap-1.5">
                                <span>{{ __('public/guest.footer_cart') }}</span>
                                @if(count(session()->get('cart', [])) > 0)
                                <span class="bg-amber-500 text-slate-950 font-bold text-[10px] px-1.5 py-0.5 rounded-full">
                                    {{ count(session()->get('cart', [])) }}
                                </span>
                                @endif
                            </a></li>
                    </ul>
                </div>

                <!-- Col 3: Services -->
                <div>
                    <h3 class="text-white font-bold text-xs tracking-wider uppercase mb-4">{{ __('public/guest.footer_services') }}</h3>
                    <ul class="space-y-2.5 text-xs">
                        <li>
                            <a href="{{route('home')}}#vehicle-request" class="hover:text-amber-400 transition-colors inline-flex items-center gap-1">
                                <span>{{ __('public/guest.service_finder') }}</span>
                                <span class="text-[9px] bg-amber-500/10 text-amber-400 px-1.5 py-0.5 rounded font-semibold border border-amber-500/20">{{ __('public/guest.service_custom_order') }}</span>
                            </a>
                        </li>
                        <li><a href="#" class="hover:text-amber-400 transition-colors">{{ __('public/guest.service_shipping') }}</a></li>
                        <li><a href="#" class="hover:text-amber-400 transition-colors">{{ __('public/guest.service_history') }}</a></li>
                    </ul>
                </div>

                <!-- Col 4: Contact -->
                <div>
                    <h3 class="text-white font-bold text-xs tracking-wider uppercase mb-4">{{ __('public/guest.footer_contact') }}</h3>
                    <ul class="space-y-3 text-xs">
                        <li class="flex items-start gap-2.5">
                            <svg class="w-4 h-4 text-amber-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                            </svg>
                            <span>405 AUTO GROUP LLC<br>4309 NW 39th St #B<br>Oklahoma City, OK 73112</span>
                        </li>
                        <li>
                            <a href="tel:+14054173665" class="flex items-center gap-2.5 hover:text-white transition-colors">
                                <svg class="w-4 h-4 text-amber-500 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-2.824-1.435-5.161-3.772-6.596-6.596l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.75Z" />
                                </svg>
                                <span>{{ __('public/guest.footer_phone_val') }}</span>
                            </a>
                        </li>
                        <li>
                            <a href="mailto:405autogroup@gmail.com" class="flex items-center gap-2.5 hover:text-white transition-colors">
                                <svg class="w-4 h-4 text-amber-500 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                                </svg>
                                <span class="truncate">info@405group-auto.com</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Footer Copyright -->
            <div class="mt-8 pt-4 flex flex-col md:flex-row justify-between items-center text-xs text-slate-500 gap-4">
                <p>&copy; {{ date('Y') }} 405 Auto Group LLC. {{ __('public/guest.footer_rights') }}</p>
                <div class="flex items-center space-x-6">
                    <a href="#" class="hover:text-slate-400 transition">{{ __('public/guest.footer_privacy') }}</a>
                    <a href="#" class="hover:text-slate-400 transition">{{ __('public/guest.footer_terms') }}</a>
                </div>
            </div>
        </div>
    </footer>
</body>

</html>
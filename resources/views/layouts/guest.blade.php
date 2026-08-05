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

    <nav class="border-b border-gray-100 bg-white sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">

                <div class="flex items-center space-x-2 flex-shrink-0">
                    <svg class="w-6 h-6 text-gray-900" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h6m-9 0H3.75a1.125 1.125 0 0 1-1.125-1.125V15h1.5a1.5 1.5 0 0 0 1.5-1.5V11.25A3.375 3.375 0 0 1 9 8.25h5.25a3.375 3.375 0 0 1 3.375 3.375v2.25a1.5 1.5 0 0 0 1.5 1.5h1.5v2.625a1.125 1.125 0 0 1-1.125 1.125H18.75a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h-6m1.5-9h3.75m-3.75 3h4.5M12 15.75h.008v.008H12v-.008Z" />
                    </svg>
                    <a href="{{ route('home') }}" class="font-bold text-xl tracking-tight text-gray-900">405 Group Auto</a>
                </div>

                <div class="hidden md:flex space-x-8 text-sm font-medium">
                    <a href="{{ route('home') }}" class="text-gray-500 hover:text-gray-900 transition">Home</a>
                    <a href="{{ route('home') }}#catalog" class="text-gray-500 hover:text-gray-900 transition">Cars</a>
                    <a href="{{ route('about') }}" class="text-gray-500 hover:text-gray-900 transition">About</a>
                </div>

                <div class="hidden lg:block flex-1 max-w-xs mx-8 relative" @click-away="searchFocused = false">
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.602 10.602Z" />
                            </svg>
                        </span>
                        <input
                            type="text"
                            placeholder="Search cars..."
                            @focus="searchFocused = true"
                            @input.debounce.300ms="
                                fetch(`/vehicles/search?q=${$event.target.value}`)
                                    .then(res => res.json())
                                    .then(data => { searchResults = data; searchFocused = true; })
                            "
                            class="w-full text-sm pl-10 pr-4 py-1.5 bg-gray-50 border border-transparent rounded-lg focus:bg-white focus:border-gray-300 focus:ring-0 transition">
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

                <div class="flex items-center space-x-6 text-gray-700">

                    <!-- FAVORITES LINK -->
                    <a href="{{ route('favorites.index') }}" class="hover:text-gray-900 transition relative">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                        </svg>
                        <span id="fav-badge" class="absolute -top-1.5 -right-1.5 bg-gray-900 text-white text-[9px] font-bold rounded-full h-4 w-4 flex items-center justify-center shadow {{ (!session('favorites') || count(session('favorites')) == 0) ? 'hidden' : '' }}">
                            {{ session('favorites') ? count(session('favorites')) : 0 }}
                        </span>
                    </a>

                    <!-- CART LINK -->
                    <a href="{{ route('cart.index') }}" class="hover:text-gray-900 transition relative">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                        </svg>
                        @php
                        $cartCount = session('cart') ? array_sum(array_column(session('cart'), 'quantity')) : 0;
                        @endphp
                        <span id="cart-badge" class="absolute -top-1.5 -right-1.5 bg-red-600 text-white text-[9px] font-bold rounded-full h-4 w-4 flex items-center justify-center shadow {{ $cartCount == 0 ? 'hidden' : '' }}">
                            {{ $cartCount }}
                        </span>
                    </a>

                    @auth
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" class="flex items-center space-x-1 focus:outline-none hover:text-gray-900 transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                            </svg>
                            <span class="text-xs font-semibold max-w-[80px] truncate">{{ Auth::user()->name }}</span>
                        </button>

                        <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-white border border-gray-100 rounded-xl shadow-xl py-1 z-50 text-xs font-medium" x-cloak>

                            @role('admin')
                            <a href="{{ route('admin.vehicles.index') }}" class="block px-4 py-2 font-bold text-amber-600 hover:bg-amber-50 transition uppercase tracking-wider text-[10px]">
                                ⚙️ Fleet Administration
                            </a>
                            <a href="{{ route('admin.orders.index') }}" class="block px-4 py-2 font-bold text-amber-600 hover:bg-amber-50 transition uppercase tracking-wider text-[10px]">
                                📦 Manage Orders
                            </a>
                            <a href="{{ route('admin.vehicle-requests.index') }}" class="block px-4 py-2 font-bold text-amber-600 hover:bg-amber-50 transition uppercase tracking-wider text-[10px]">
                                🚗 Vehicle Requests
                            </a>
                            <hr class="border-gray-100 my-1">
                            @endrole

                            <a href="{{ url('/dashboard') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-50">My Orders & Drives</a>
                            <hr class="border-gray-100">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full text-left px-4 py-2 text-red-600 hover:bg-red-50">
                                    Log Out
                                </button>
                            </form>
                        </div>
                    </div>
                    @else
                    <a href="{{ route('login') }}" class="hover:text-gray-900 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                        </svg>
                    </a>
                    @endauth
                </div>

            </div>
        </div>
    </nav>

    @if(session('success'))
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
        <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 rounded-xl text-xs font-semibold flex items-center space-x-2 shadow-sm">
            <span>{{ session('success') }}</span>
        </div>
    </div>
    @endif

    <main>
        {{ $slot }}
    </main>

    <footer class="bg-[#030712] text-gray-400 pt-16 pb-8 mt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12 pb-12 border-b border-gray-800">
                <div>
                    <div class="flex items-center space-x-2 text-white mb-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h6m-9 0H3.75a1.125 1.125 0 0 1-1.125-1.125V15h1.5a1.5 1.5 0 0 0 1.5-1.5V11.25A3.375 3.375 0 0 1 9 8.25h5.25a3.375 3.375 0 0 1 3.375 3.375v2.25a1.5 1.5 0 0 0 1.5 1.5h1.5v2.625a1.125 1.125 0 0 1-1.125 1.125H18.75a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h-6m1.5-9h3.75m-3.75 3h4.5M12 15.75h.008v.008H12v-.008Z" />
                        </svg>
                        <span class="font-bold text-xl tracking-tight text-white">405 Group Auto</span>
                    </div>
                    <p class="text-sm text-gray-400 leading-relaxed">
                        Your premier destination for luxury and performance vehicles. We offer the finest selection of cars from the world's most prestigious brands.
                    </p>
                </div>
                <div class="md:pl-12">
                    <h3 class="text-white font-semibold text-sm tracking-wider uppercase mb-4">Quick Links</h3>
                    <ul class="space-y-2 text-sm">
                        <li><a href="{{ route('about') }}" class="hover:text-white transition">About Us</a></li>
                        <li><a href="{{ route('home') }}#catalog" class="hover:text-white transition">Our Cars</a></li>
                        <li><a href="{{ route('cart.index') }}" class="hover:text-white transition">Cart</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-white font-semibold text-sm tracking-wider uppercase mb-4">Contact</h3>
                    <ul class="space-y-2 text-sm">
                        <li>405 AUTO GROUP LLC<br>4309 NW 39th St #B</li>
                        <li>Oklahoma City, OK 73112</li>
                        <li class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-2.824-1.435-5.161-3.772-6.596-6.596l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.75Z" />
                            </svg>
                            <span>(+1) 405-417-3665</span>
                        </li>

                        <li class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            <span>405autogroup@gmail.com</span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="mt-8 flex justify-center text-xs text-gray-500">
                <p>&copy; {{ date('Y') }} 405 Group Auto. All rights reserved.</p>
            </div>
        </div>
    </footer>
</body>

</html>
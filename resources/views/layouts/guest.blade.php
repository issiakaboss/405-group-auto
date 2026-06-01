<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', '405 Group Auto') }}</title>

    <!-- Fonts (Inter ou similaire, très proche du template) -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Scripts & Styles via Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans text-gray-900 antialiased bg-white">

    <!-- HEADER / NAVBAR -->
    <nav class="border-b border-gray-100 bg-white sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                
                <!-- Logo -->
                <div class="flex items-center space-x-2">
                    <!-- Icône Voiture en SVG -->
                    <svg class="w-6 h-6 text-gray-900" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h6m-9 0H3.75a1.125 1.125 0 0 1-1.125-1.125V15h1.5a1.5 1.5 0 0 0 1.5-1.5V11.25A3.375 3.375 0 0 1 9 8.25h5.25a3.375 3.375 0 0 1 3.375 3.375v2.25a1.5 1.5 0 0 0 1.5 1.5h1.5v2.625a1.125 1.125 0 0 1-1.125 1.125H18.75a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h-6m1.5-9h3.75m-3.75 3h4.5M12 15.75h.008v.008H12v-.008Z" />
                    </svg>
                    <a href="/" class="font-bold text-xl tracking-tight text-gray-900">405 Group Auto</a>
                </div>

                <!-- Liens de Navigation Principaux -->
                <div class="hidden md:flex space-x-8 text-sm font-medium">
                    <a href="/" class="text-gray-900 hover:text-gray-600 transition">Home</a>
                    <a href="#" class="text-gray-500 hover:text-gray-900 transition">Cars</a>
                    <a href="#" class="text-gray-500 hover:text-gray-900 transition">About</a>
                    <a href="#" class="text-gray-500 hover:text-gray-900 transition">Contact</a>
                </div>

                <!-- Barre de recherche (Milieu/Droite) -->
                <div class="hidden lg:block flex-1 max-w-xs mx-8">
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.602 10.602Z"/></svg>
                        </span>
                        <input type="text" placeholder="Search cars..." class="w-full text-sm pl-10 pr-4 py-1.5 bg-gray-50 border border-transparent rounded-lg focus:bg-white focus:border-gray-300 focus:ring-0 transition">
                    </div>
                </div>

                <!-- Icônes Actions (Favoris, Panier, Profil) -->
                <div class="flex items-center space-x-6 text-gray-700">
                    <!-- Favoris -->
                    <a href="#" class="hover:text-gray-900 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z"/></svg>
                    </a>
                    <!-- Panier -->
                    <a href="#" class="hover:text-gray-900 transition relative">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z"/></svg>
                    </a>
                    <!-- Profil (Lien Connexion/Dashboard) -->
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="hover:text-gray-900 transition">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z"/></svg>
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="hover:text-gray-900 transition">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z"/></svg>
                            </a>
                        @endauth
                    @endif
                </div>

            </div>
        </div>
    </nav>

    <!-- CONTENU DYNAMIQUE -->
    <main>
        {{ $slot }}
    </main>

    <!-- FOOTER (Fonds Sombre - cf capture 7) -->
    <footer class="bg-[#030712] text-gray-400 pt-16 pb-8 mt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12 pb-12 border-b border-gray-800">
                
                <!-- Colonne Info Marque -->
                <div>
                    <div class="flex items-center space-x-2 text-white mb-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h6m-9 0H3.75a1.125 1.125 0 0 1-1.125-1.125V15h1.5a1.5 1.5 0 0 0 1.5-1.5V11.25A3.375 3.375 0 0 1 9 8.25h5.25a3.375 3.375 0 0 1 3.375 3.375v2.25a1.5 1.5 0 0 0 1.5 1.5h1.5v2.625a1.125 1.125 0 0 1-1.125 1.125H18.75a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h-6m1.5-9h3.75m-3.75 3h4.5M12 15.75h.008v.008H12v-.008Z" /></svg>
                        <span class="font-bold text-xl tracking-tight text-white">405 Group Auto</span>
                    </div>
                    <p class="text-sm text-gray-400 leading-relaxed">
                        Your premier destination for luxury and performance vehicles. We offer the finest selection of cars from the world's most prestigious brands.
                    </p>
                    <!-- Réseaux Sociaux -->
                    <div class="flex space-x-4 mt-6">
                        <!-- Liens iconographiques factices pour respecter le design -->
                        <a href="#" class="hover:text-white transition"><svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"/></svg></a>
                        <a href="#" class="hover:text-white transition"><svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12.315 2c2.43 0 2.784.01 3.81.058 1.028.048 1.747.212 2.38.457a4.761 4.761 0 0 1 1.66 1.08 4.79 4.79 0 0 1 1.08 1.66c.245.633.409 1.354.458 2.38.047 1.026.057 1.38.057 3.81 0 2.43-.01 2.784-.058 3.81-.048 1.028-.212 1.747-.457 2.38a4.78 4.78 0 0 1-1.08 1.66 4.78 4.78 0 0 1-1.66 1.08c-.634.245-1.355.409-2.38.458-1.027.047-1.381.057-3.81.057-2.43 0-2.784-.01-3.81-.058-1.03-.048-1.747-.212-2.38-.457a4.761 4.761 0 0 1-1.66-1.08 4.762 4.762 0 0 1-1.08-1.66c-.244-.634-.409-1.355-.458-2.38-.047-1.027-.057-1.381-.057-3.81 0-2.43.01-2.784.058-3.81.048-1.03.212-1.747.457-2.38a4.761 4.761 0 0 1 1.08-1.66 4.76 4.76 0 0 1 1.66-1.08c.633-.244 1.354-.409 2.38-.458C9.53 2.01 9.883 2 12.315 2m0-2C9.793 0 9.47.01 8.474.055 7.478.101 6.797.263 6.202.495a6.76 6.76 0 0 0-2.443 1.59 6.76a6.76 0 0 0-1.59 2.443C1.94 5.112 1.778 5.793 1.732 6.79c-.046.996-.056 1.319-.056 3.837 0 2.518.01 2.84.056 3.836.046.997.207 1.678.44 2.273a6.76 6.76 0 0 0 1.59 2.442 6.75 6.75 0 0 0 2.443 1.59c.595.232 1.277.394 2.273.44 1 .045 1.32.056 3.837.056 2.517 0 2.84-.01 3.837-.056 1-.046 1.681-.207 2.273-.44a6.76 6.76 0 0 0 2.442-1.59 6.76a6.76 0 0 0 1.59-2.442c.232-.595.394-1.277.44-2.273.045-.996.056-1.32.056-3.836 0-2.518-.01-2.84-.056-3.837-.046-1-.207-1.681-.44-2.273a6.756 6.756 0 0 0-1.59-2.443 6.756 6.756 0 0 0-2.442-1.59c-.595-.232-1.277-.394-2.273-.44C15.158.01 14.836 0 12.315 0z"/></svg></a>
                    </div>
                </div>

                <!-- Colonne Liens Rapides -->
                <div class="md:pl-12">
                    <h3 class="text-white font-semibold text-sm tracking-wider uppercase mb-4">Quick Links</h3>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#" class="hover:text-white transition">About Us</a></li>
                        <li><a href="#" class="hover:text-white transition">Our Cars</a></li>
                        <li><a href="#" class="hover:text-white transition">Financing</a></li>
                        <li><a href="#" class="hover:text-white transition">Trade-In</a></li>
                        <li><a href="#" class="hover:text-white transition">Service</a></li>
                    </ul>
                </div>

                <!-- Colonne Contacts (Idéal pour ajouter la localisation transatlantique après) -->
                <div>
                    <h3 class="text-white font-semibold text-sm tracking-wider uppercase mb-4">Contact</h3>
                    <ul class="space-y-2 text-sm">
                        <li class="flex items-start">
                            <span class="text-gray-300">123 Luxury Auto Boulevard<br>Beverly Hills, CA 90210</span>
                        </li>
                        <li>Phone: (555) 123-4567</li>
                        <li>Email: info@405groupauto.com</li>
                    </ul>
                </div>

            </div>

            <!-- Droits d'auteur -->
            <div class="mt-8 flex justify-center text-xs text-gray-500">
                <p>&copy; {{ date('Y') }} 405 Group Auto. All rights reserved.</p>
            </div>
        </div>
    </footer>

</body>
</html>
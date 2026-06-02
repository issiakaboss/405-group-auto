<x-guest-layout>

    <!-- SECTION HERO (Première Capture d'écran) -->
    <div class="relative bg-gray-900 h-[550px] flex items-center justify-center overflow-hidden">
        <!-- Image de fond sombre avec effet d'opacité -->
        <div class="absolute inset-0 bg-black opacity-60 z-10"></div>
        <img src="https://images.unsplash.com/photo-1503376780353-7e6692767b70?auto=format&fit=crop&w=1920&q=80"
            alt="Luxury Car"
            class="absolute inset-0 w-full h-full object-cover">

        <!-- Contenu textuel par-dessus la voiture -->
        <div class="relative max-w-4xl mx-auto text-center px-4 z-20 text-white">
            <h1 class="text-5xl md:text-6xl font-bold tracking-tight mb-4">
                Drive Your Dreams
            </h1>
            <p class="text-lg md:text-xl text-gray-300 mb-8 max-w-2xl mx-auto">
                Discover the finest collection of luxury and performance vehicles.
            </p>
            <a href="#" class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-sm font-medium rounded-full bg-white text-gray-900 hover:bg-gray-100 transition shadow-lg">
                Browse Cars
                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                </svg>
            </a>
        </div>
    </div>

    <!-- SECTION 1 : WELCOME & WHY CHOOSE US (cf captures 2 & 3) -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-16">
        <div class="text-center max-w-3xl mx-auto mb-16">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Welcome to 405 Group Auto - Your Ultimate Luxury Automotive Destination</h2>
            <p class="text-gray-500 text-sm leading-relaxed">
                405 Group Auto is a premium e-commerce platform designed for luxury vehicle enthusiasts. We offer a curated selection of the world's most prestigious brands. Our complete shopping experience features detailed information for each vehicle, seamless contact tracking, and custom import structures from the USA directly to Africa.
            </p>
        </div>

        <!-- Les 4 cartes d'atouts -->
        <div class="text-center mb-6">
            <h3 class="text-2xl font-bold text-gray-900 mb-2">Why Choose 405 Group Auto?</h3>
            <p class="text-gray-400 text-xs">We provide premium automotive experiences with unmatched service and quality</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-24">
            <!-- Carte 1 -->
            <div class="bg-white p-6 rounded-xl border border-gray-100 shadow-sm flex flex-col items-center text-center">
                <div class="p-3 bg-gray-50 rounded-full mb-4">
                    <svg class="w-6 h-6 text-gray-900" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499c.172-.435.76-.435.932 0l2.309 4.671 5.127.745c.478.07.667.653.322.988l-3.715 3.62 1.13 5.086c.106.478-.396.84-.811.614L12 16.732l-4.507 2.372c-.415.226-.917-.136-.811-.614l1.13-5.087-3.715-3.62c-.345-.336-.156-.918.322-.988l5.128-.745 2.308-4.671Z" />
                    </svg>
                </div>
                <h4 class="font-bold text-gray-900 text-sm mb-1">Premium Quality</h4>
                <p class="text-gray-400 text-xs">Only the finest vehicles from trusted brands worldwide.</p>
            </div>
            <!-- Carte 2 -->
            <div class="bg-white p-6 rounded-xl border border-gray-100 shadow-sm flex flex-col items-center text-center">
                <div class="p-3 bg-gray-50 rounded-full mb-4">
                    <svg class="w-6 h-6 text-gray-900" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.57-.598-3.751A11.956 11.956 0 0 1 12 2.714Z" />
                    </svg>
                </div>
                <h4 class="font-bold text-gray-900 text-sm mb-1">Secured Logstics</h4>
                <p class="text-gray-400 text-xs">Full tracking from US ports straight to your local destination.</p>
            </div>
            <!-- Carte 3 -->
            <div class="bg-white p-6 rounded-xl border border-gray-100 shadow-sm flex flex-col items-center text-center">
                <div class="p-3 bg-gray-50 rounded-full mb-4">
                    <svg class="w-6 h-6 text-gray-900" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.25 9.75v-4.5m0 4.5h4.5m-4.5 0 6-6m-3 18c-4.97 0-9-4.03-9-9s4.03-9 9-9 9 4.03 9 9-4.03 9-9 9Zm0-3.75a3.75 3.75 0 1 0 0-7.5 3.75 3.75 0 0 0 0 7.5Z" />
                    </svg>
                </div>
                <h4 class="font-bold text-gray-900 text-sm mb-1">Expert Support</h4>
                <p class="text-gray-400 text-xs">24/7 dedicated support team covering two continents.</p>
            </div>
            <!-- Carte 4 -->
            <div class="bg-white p-6 rounded-xl border border-gray-100 shadow-sm flex flex-col items-center text-center">
                <div class="p-3 bg-gray-50 rounded-full mb-4">
                    <svg class="w-6 h-6 text-gray-900" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 18.75h-9m9 0a3 3 0 0 1 3 3h-15a3 3 0 0 1 3-3m9 0v-3.375c0-.621-.504-1.125-1.125-1.125h-3.75c-.621 0-1.125.504-1.125 1.125v3.375m9 0h-9M9 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                    </svg>
                </div>
                <h4 class="font-bold text-gray-900 text-sm mb-1">Transatlantic Deals</h4>
                <p class="text-gray-400 text-xs">Direct auction access in the USA with optimized localized pricing.</p>
            </div>
        </div>

        <!-- SECTION 2 : FEATURED CARS (BOUCLE CODEE - cf capture 4) -->
        <div class="flex justify-between items-end mb-8">
            <div>
                <h3 class="text-2xl font-bold text-gray-900">Featured Cars</h3>
                <p class="text-gray-400 text-xs">Hand-picked premium vehicles</p>
            </div>
            <a href="#" class="inline-flex items-center text-xs font-semibold px-4 py-2 border border-gray-200 rounded-lg hover:bg-gray-50 text-gray-700 transition">
                View All &rarr;
            </a>
        </div>

        <!-- Grille de cartes dynamiques -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-24">
            @foreach($featuredVehicles as $vehicle)
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden group">
                <!-- Zone Image + Badges -->
                <div class="relative h-48 bg-gray-100 overflow-hidden">
                    <img src="{{ $vehicle->images[0] }}" alt="{{ $vehicle->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-300">

                    <!-- Badges d'état (cf capture Figma, coin supérieur gauche) -->
                    <div class="absolute top-3 left-3 flex flex-wrap gap-1.5">
                        <span class="bg-red-600 text-white text-[10px] uppercase font-bold px-2 py-0.5 rounded-md shadow">Featured</span>

                        <!-- Personnalisation pour le grand frère : Couleur selon la dispo ! -->
                        @if($vehicle->status === 'available_local')
                        <span class="bg-green-600 text-white text-[10px] uppercase font-bold px-2 py-0.5 rounded-md shadow">Stock Afrique</span>
                        @elseif($vehicle->status === 'in_transit')
                        <span class="bg-blue-600 text-white text-[10px] uppercase font-bold px-2 py-0.5 rounded-md shadow">En Mer</span>
                        @else
                        <span class="bg-amber-600 text-white text-[10px] uppercase font-bold px-2 py-0.5 rounded-md shadow">Stock USA</span>
                        @endif
                    </div>
                </div>

                <!-- Zone Contenu -->
                <div class="p-5">
                    <h4 class="font-bold text-gray-900 text-lg mb-1">{{ $vehicle->title }}</h4>
                    <p class="text-gray-400 text-xs mb-4">{{ $vehicle->year }} &bull; {{ number_format($vehicle->mileage) }} miles &bull; {{ $vehicle->location }}</p>

                    <div class="flex justify-between items-center mb-5">
                        <span class="text-xl font-bold text-gray-900">${{ number_format($vehicle->price) }}</span>
                        <span class="bg-gray-50 text-gray-500 text-[11px] font-medium px-2.5 py-1 rounded-md border border-gray-100">{{ $vehicle->category }}</span>
                    </div>

                    <!-- Boutons d'action (Figma : View Details / Add to Cart) -->
                    <div class="grid grid-cols-2 gap-3">
                        <a href="{{ route('vehicles.show', $vehicle->id) }}" class="text-center py-2 text-xs font-semibold text-gray-700 border border-gray-200 rounded-lg hover:bg-gray-50 transition">
                            View Details
                        </a>
                        <form action="{{ route('cart.add', $vehicle->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="w-full text-center py-2 text-[11px] font-semibold text-white bg-[#0F172A] rounded-lg hover:bg-gray-800 transition shadow-sm">
                                Add to Cart
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- --- SECTION 3 : LATEST MODELS (NOUVEAUTÉS) --- -->
        <div class="flex justify-between items-end mb-8 mt-12">
            <div>
                <h3 class="text-2xl font-bold text-gray-900">Latest Models</h3>
                <p class="text-gray-400 text-xs">Explore the newest additions to our transatlantic showroom</p>
            </div>
            <a href="#" class="inline-flex items-center text-xs font-semibold px-4 py-2 border border-gray-200 rounded-lg hover:bg-gray-50 text-gray-700 transition">
                See New Arrivals &rarr;
            </a>
        </div>

        <!-- Grille des derniers modèles -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-16">
            @foreach($latestVehicles as $vehicle)
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden group">
                <!-- Zone Image -->
                <div class="relative h-48 bg-gray-100 overflow-hidden">
                    <img src="{{ $vehicle->images[0] }}" alt="{{ $vehicle->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-300">

                    <!-- Badges Logistiques -->
                    <div class="absolute top-3 left-3 flex flex-wrap gap-1.5">
                        <span class="bg-gray-900 text-white text-[10px] uppercase font-bold px-2 py-0.5 rounded-md shadow">New</span>

                        @if($vehicle->status === 'available_local')
                        <span class="bg-green-600 text-white text-[10px] uppercase font-bold px-2 py-0.5 rounded-md shadow">Stock Afrique</span>
                        @elseif($vehicle->status === 'in_transit')
                        <span class="bg-blue-600 text-white text-[10px] uppercase font-bold px-2 py-0.5 rounded-md shadow">En Mer</span>
                        @else
                        <span class="bg-amber-600 text-white text-[10px] uppercase font-bold px-2 py-0.5 rounded-md shadow">Stock USA</span>
                        @endif
                    </div>
                </div>

                <!-- Zone Infos -->
                <div class="p-5">
                    <h4 class="font-bold text-gray-900 text-lg mb-1">{{ $vehicle->title }}</h4>
                    <p class="text-gray-400 text-xs mb-4">{{ $vehicle->year }} &bull; {{ number_format($vehicle->mileage) }} miles &bull; {{ $vehicle->location }}</p>

                    <div class="flex justify-between items-center mb-5">
                        <span class="text-xl font-bold text-gray-900">${{ number_format($vehicle->price) }}</span>
                        <span class="bg-gray-50 text-gray-500 text-[11px] font-medium px-2.5 py-1 rounded-md border border-gray-100">{{ $vehicle->category }}</span>
                    </div>

                    <!-- Actions -->
                    <div class="grid grid-cols-2 gap-3">
                        <a href="{{ route('vehicles.show', $vehicle->id) }}" class="text-center py-2 text-xs font-semibold text-gray-700 border border-gray-200 rounded-lg hover:bg-gray-50 transition">
                            View Details
                        </a>

                        <form action="{{ route('cart.add', $vehicle->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="w-full text-center py-2 text-[11px] font-semibold text-white bg-[#0F172A] rounded-lg hover:bg-gray-800 transition shadow-sm">
                                Add to Cart
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <!-- --- FIN SECTION LATEST MODELS --- -->

        <!-- --- SECTION 4 : COMPLETE COLLECTION (cf image_e2bbbf.jpg) --- -->
        <div class="text-center max-w-3xl mx-auto mb-12 mt-20">
            <h3 class="text-3xl font-bold text-gray-900 mb-2">Complete Collection</h3>
            <p class="text-gray-500 text-sm">Browse our entire inventory of {{ $allVehicles->count() }} luxury and performance vehicles</p>
        </div>

        <!-- Grille à 4 colonnes comme sur la maquette -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 mb-20">
            @foreach($allVehicles as $vehicle)
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden flex flex-col justify-between group">

                <!-- Zone Image + Badges Figma (Top gauche) -->
                <div>
                    <div class="relative h-44 bg-gray-100 overflow-hidden">
                        <img src="{{ $vehicle->images[0] }}" alt="{{ $vehicle->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-300">

                        <!-- Badges superposés selon les attributs -->
                        <div class="absolute top-3 left-3 flex flex-wrap gap-1">
                            @if($vehicle->is_featured)
                            <span class="bg-[#E11D48] text-white text-[10px] font-semibold px-2 py-0.5 rounded-md shadow-sm">Featured</span>
                            @endif

                            @if($vehicle->year >= 2025)
                            <span class="bg-gray-900 text-white text-[10px] font-semibold px-2 py-0.5 rounded-md shadow-sm">New</span>
                            @endif
                        </div>
                    </div>

                    <!-- Infos véhicule -->
                    <div class="p-4">
                        <h4 class="font-bold text-gray-900 text-sm mb-1 tracking-tight truncate">{{ $vehicle->title }}</h4>
                        <p class="text-gray-400 text-[11px] mb-3">{{ $vehicle->year }} &bull; {{ number_format($vehicle->mileage) }} miles</p>

                        <div class="flex justify-between items-center mb-4">
                            <span class="text-base font-bold text-gray-900">${{ number_format($vehicle->price) }}</span>
                            <span class="bg-gray-50 text-gray-500 text-[10px] font-medium px-2 py-0.5 rounded border border-gray-100">{{ $vehicle->category }}</span>
                        </div>
                    </div>
                </div>

                <!-- Boutons d'actions originaux (View Details & Add to Cart) -->
                <div class="p-4 pt-0 grid grid-cols-2 gap-2.5">
                    <a href="{{ route('vehicles.show', $vehicle->id) }}" class="text-center py-2 text-[11px] font-semibold text-gray-700 border border-gray-200 rounded-lg hover:bg-gray-50 transition">
                        View Details
                    </a>
                    <form action="{{ route('cart.add', $vehicle->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full text-center py-2 text-[11px] font-semibold text-white bg-[#0F172A] rounded-lg hover:bg-gray-800 transition shadow-sm">
                            Add to Cart
                        </button>
                    </form>
                </div>

            </div>
            @endforeach
        </div>
        <!-- --- FIN SECTION COMPLETE COLLECTION --- -->
    </div>


</x-guest-layout>
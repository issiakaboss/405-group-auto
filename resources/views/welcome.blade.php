<x-guest-layout>

    <!-- HERO BANNER SANS PHOTO DE FOND -->
    <div class="relative bg-gradient-to-b from-slate-950 via-slate-900 to-slate-950 py-16 px-4 flex items-center justify-center border-b border-slate-800">
        <div class="max-w-4xl mx-auto text-center flex flex-col items-center">

            <!-- Logo nettoyé en format SVG ou PNG transparent -->
            <img src="{{ asset('images/logo.jpeg') }}"
                alt="405 Auto Group Logo"
                class="h-28 md:h-36 w-auto mb-6 object-contain drop-shadow-md">

            <h1 class="text-4xl md:text-5xl font-extrabold text-white tracking-tight mb-3">
                Drive Your Dreams
            </h1>

            <p class="text-base md:text-lg text-gray-400 mb-8 max-w-xl">
                Discover the finest collection of luxury and performance vehicles.
            </p>

            <a href="#catalog" class="inline-flex items-center justify-center px-7 py-3 text-sm font-semibold rounded-full bg-white text-slate-900 hover:bg-amber-500 hover:text-white transition shadow-lg gap-2">
                <span>Browse Cars</span>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                </svg>
            </a>
        </div>
    </div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-0">

        <!-- SECTION COMPLETE COLLECTION WITH LIVE FILTERS -->
        <div class="text-left  mx-auto mb-8 mt-12" id="catalog">
            <h3 class="text-3xl font-bold text-gray-900 mb-2">Complete Collection</h3>
            <p class="text-gray-500 text-sm">
                Browse our inventory (<span id="vehicle-count">{{ $allVehicles->count() }}</span> vehicles found)
            </p>
        </div>

        <!-- BARRE DE FILTRES DYNAMIQUE -->
        <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm mb-10">
            <form id="filter-form" class="space-y-4">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    <!-- Search -->
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 mb-1">Search</label>
                        <input type="text" name="search" id="filter-search" placeholder="Brand, model..."
                            class="w-full text-xs rounded-xl border-gray-200 focus:border-gray-900 focus:ring-gray-900">
                    </div>

                    <!-- Make / Brand -->
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 mb-1">Make</label>
                        <select name="brand" class="w-full text-xs rounded-xl border-gray-200 focus:border-gray-900 focus:ring-gray-900">
                            <option value="">All Makes</option>
                            @foreach($brands as $brand)
                            <option value="{{ $brand }}">{{ $brand }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Category -->
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 mb-1">Category</label>
                        <select name="category" class="w-full text-xs rounded-xl border-gray-200 focus:border-gray-900 focus:ring-gray-900">
                            <option value="">All Categories</option>
                            @foreach($categories as $category)
                            @php $categoryValue = is_object($category) ? $category->value : $category; @endphp
                            <option value="{{ $categoryValue }}">{{ $categoryValue }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Sort By -->
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 mb-1">Sort By</label>
                        <select name="sort" class="w-full text-xs rounded-xl border-gray-200 focus:border-gray-900 focus:ring-gray-900">
                            <option value="latest">Newest First</option>
                            <option value="price_asc">Price: Low to High</option>
                            <option value="price_desc">Price: High to Low</option>
                            <option value="year_desc">Year: Newest</option>
                            <option value="mileage_asc">Mileage: Lowest</option>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 pt-2 border-t border-gray-100">
                    <!-- Fuel Type -->
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 mb-1">Fuel Type</label>
                        <select name="fuel_type" class="w-full text-xs rounded-xl border-gray-200 focus:border-gray-900 focus:ring-gray-900">
                            <option value="">All Fuel Types</option>
                            @foreach($fuelTypes as $fuel)
                            @php $fuelValue = is_object($fuel) ? $fuel->value : $fuel; @endphp
                            <option value="{{ $fuelValue }}">{{ ucfirst($fuelValue) }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Transmission -->
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 mb-1">Transmission</label>
                        <select name="transmission" class="w-full text-xs rounded-xl border-gray-200 focus:border-gray-900 focus:ring-gray-900">
                            <option value="">All Transmissions</option>
                            @foreach($transmissions as $trans)
                            @php $transValue = is_object($trans) ? $trans->value : $trans; @endphp
                            <option value="{{ $transValue }}">{{ ucfirst($transValue) }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Reset Button -->
                    <div class="flex items-end">
                        <button type="button" id="reset-filters" class="w-full py-2 px-4 text-xs font-semibold text-gray-600 bg-gray-100 hover:bg-gray-200 rounded-xl transition">
                            Reset Filters
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- GRILLE DE VÉHICULES (DYNAMIC TARGET) -->
        <div id="vehicles-grid" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 mb-20 relative min-h-[200px]">
            @include('vehicles.partials.list', ['vehicles' => $allVehicles])
        </div>

        <!-- SECTION HISTORIQUE DES VENTES & LIVRAISONS (PREUVE SOCIALE) -->
        @if(isset($recentlySoldVehicles) && $recentlySoldVehicles->isNotEmpty())
        <div class="flex justify-between items-end mb-8">
            <div>
                <h3 class="text-2xl font-bold text-gray-900">Recently Sold & Delivered</h3>
                <p class="text-gray-400 text-xs">Explore models recently delivered to our clients. Order a similar unit today!</p>
            </div>
            <a href="#catalog" class="inline-flex items-center text-xs font-semibold px-4 py-2 border border-gray-200 rounded-lg hover:bg-gray-50 text-gray-700 transition">
                Browse Full Catalog &rarr;
            </a>
        </div>



        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-24">
            @foreach($recentlySoldVehicles as $vehicle)
            @php
            $statusEnum = $vehicle->status instanceof \App\Models\Enums\VehicleStatus
            ? $vehicle->status
            : \App\Models\Enums\VehicleStatus::tryFrom($vehicle->status);
            $locationLabel = $vehicle->location instanceof \App\Models\Enums\VehicleLocation
            ? $vehicle->location->label()
            : (\App\Models\Enums\VehicleLocation::tryFrom($vehicle->location)?->label() ?? 'USA Warehouse');
            @endphp
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden group opacity-95">
                <div class="relative h-48 bg-gray-100 overflow-hidden">
                    <img src="{{ !empty($vehicle->images) ? $vehicle->images[0] : 'https://images.unsplash.com/photo-1533473359331-0135ef1b58bf?auto=format&fit=crop&w=800&q=80' }}"
                        alt="{{ $vehicle->title }}"
                        class="w-full h-full object-cover group-hover:scale-105 transition duration-300">

                    <!-- Badges d'historique -->
                    <div class="absolute top-3 left-3 flex flex-wrap gap-1.5 z-10">
                        <span class="bg-red-600 text-white text-[10px] uppercase font-bold px-2 py-0.5 rounded-md shadow">
                            Vendu / Livré
                        </span>
                        @if($statusEnum)
                        <span class="{{ $statusEnum->badgeColor() }} text-[10px] uppercase font-bold px-2 py-0.5 rounded-md shadow">
                            {{ $statusEnum->label() }}
                        </span>
                        @endif
                    </div>

                    <form action="{{ route('favorites.toggle', $vehicle->id) }}" method="POST" class="absolute top-3 right-3 z-20">
                        @csrf
                        <button type="submit" class="p-2 rounded-full bg-white/90 backdrop-blur-sm shadow-sm transition hover:bg-white text-gray-600 hover:text-red-500">
                            <svg class="h-4 w-4 {{ isset(session()->get('favorites', [])[$vehicle->id]) ? 'fill-red-500 text-red-500' : 'fill-none stroke-current' }}" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                            </svg>
                        </button>
                    </form>
                </div>

                <div class="p-5">
                    <h4 class="font-bold text-gray-900 text-lg mb-1">{{ $vehicle->title }}</h4>
                    <div class="flex items-center gap-2 text-xs text-gray-500 mb-3">
                        <span>{{ $vehicle->year }}</span>
                        <span>&bull;</span>
                        <span>{{ number_format($vehicle->mileage) }} mi</span>
                    </div>

                    {{-- Localisation / Position du véhicule --}}
                    <div class="flex items-center text-xs text-gray-600 bg-gray-50 px-2.5 py-1.5 rounded-lg mb-4 w-max border border-gray-100">
                        <svg class="w-3.5 h-3.5 text-gray-400 mr-1.5 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                        </svg>
                        <span class="font-medium truncate max-w-[200px]">{{ $locationLabel }}</span>
                    </div>

                    <div class="flex justify-between items-center mb-5 gap-2">
                        <span class="text-xl font-bold text-gray-900">${{ number_format($vehicle->price) }}</span>
                        <span class="bg-gray-50 text-gray-500 text-[11px] font-medium px-2.5 py-1 rounded-md border border-gray-100 max-w-[45%] truncate">
                            {{ $vehicle->vehicle_type?->label() ?? $vehicle->vehicle_type?->value ?? $vehicle->vehicle_type ?? $vehicle->category }}
                        </span>
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        {{-- Bouton View Details --}}
                        <a href="{{ route('vehicles.show', $vehicle->id) }}"
                            class="py-2 px-4 border border-gray-200 text-gray-700 font-semibold text-xs rounded-xl hover:bg-gray-50 transition">
                            View Details
                        </a>

                        {{-- Bouton Order Similar --}}
                        <a href="{{ route('vehicles.show', ['vehicle' => $vehicle->id, 'action' => 'order_similar']) }}"
                            class="py-2 px-4 bg-amber-100 text-amber-900 font-semibold text-xs rounded-xl hover:bg-amber-200 transition">
                            Order Similar
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif

        <!-- a custom car configuration -->
        <div id="vehicle-request" class="mt-8 bg-white rounded-2xl border border-gray-100 shadow-sm p-8">
            <div class="mb-6">
                <p class="text-xs uppercase tracking-[0.24em] text-amber-700 font-semibold mb-2">Vehicle Finder</p>
                <h2 class="text-2xl font-bold text-gray-900 mb-2">Request a Custom Vehicle</h2>
                <p class="text-sm text-gray-600">Tell us what you are looking for and we will help you source the right fit from our market.</p>
            </div>

            <form action="{{ route('vehicles.request') }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @csrf
                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1">Make</label>
                    <input type="text" name="make" required class="w-full rounded-xl border-gray-200 focus:border-gray-900 focus:ring-gray-900">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1">Model</label>
                    <input type="text" name="model" required class="w-full rounded-xl border-gray-200 focus:border-gray-900 focus:ring-gray-900">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1">Year Min</label>
                    <input type="number" name="year_min" min="1900" class="w-full rounded-xl border-gray-200 focus:border-gray-900 focus:ring-gray-900">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1">Year Max</label>
                    <input type="number" name="year_max" min="1900" class="w-full rounded-xl border-gray-200 focus:border-gray-900 focus:ring-gray-900">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1">Max Budget ($)</label>
                    <input type="number" name="max_budget" min="0" class="w-full rounded-xl border-gray-200 focus:border-gray-900 focus:ring-gray-900">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1">Desired Mileage</label>
                    <input type="number" name="desired_mileage" min="0" class="w-full rounded-xl border-gray-200 focus:border-gray-900 focus:ring-gray-900">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1">Body Style</label>
                    <input type="text" name="body_style" class="w-full rounded-xl border-gray-200 focus:border-gray-900 focus:ring-gray-900">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1">Your Name</label>
                    <input type="text" name="name" required class="w-full rounded-xl border-gray-200 focus:border-gray-900 focus:ring-gray-900">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1">Email</label>
                    <input type="email" name="email" required class="w-full rounded-xl border-gray-200 focus:border-gray-900 focus:ring-gray-900">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1">Phone</label>
                    <input type="text" name="phone" required class="w-full rounded-xl border-gray-200 focus:border-gray-900 focus:ring-gray-900">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1">ZIP Code</label>
                    <input type="text" name="zip_code" required class="w-full rounded-xl border-gray-200 focus:border-gray-900 focus:ring-gray-900">
                </div>
                <div class="md:col-span-2">
                    <label class="block text-xs font-semibold text-gray-700 mb-1">Notes</label>
                    <textarea name="notes" rows="4" class="w-full rounded-xl border-gray-200 focus:border-gray-900 focus:ring-gray-900"></textarea>
                </div>
                <div class="md:col-span-2">
                    <button type="submit" class="w-full py-3 px-4 bg-[#0F172A] text-white rounded-xl font-semibold text-sm hover:bg-gray-800 transition">
                        Submit Vehicle Request
                    </button>
                </div>
            </form>
        </div>

    </div>

    <!-- SCRIPT DE FILTRAGE AJAX -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('filter-form');
            const grid = document.getElementById('vehicles-grid');
            const countSpan = document.getElementById('vehicle-count');
            const resetButton = document.getElementById('reset-filters');
            let timeout = null;

            function fetchFilteredVehicles() {
                grid.classList.add('opacity-50', 'pointer-events-none');

                const formData = new FormData(form);
                const params = new URLSearchParams(formData).toString();

                fetch(`{{ route('vehicles.filter') }}?${params}`, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        grid.innerHTML = data.html;
                        countSpan.textContent = data.count;
                    })
                    .catch(error => console.error('Erreur de filtrage:', error))
                    .finally(() => {
                        grid.classList.remove('opacity-50', 'pointer-events-none');
                    });
            }

            form.querySelectorAll('select').forEach(select => {
                select.addEventListener('change', fetchFilteredVehicles);
            });

            form.querySelector('#filter-search').addEventListener('input', function() {
                clearTimeout(timeout);
                timeout = setTimeout(fetchFilteredVehicles, 300);
            });

            resetButton.addEventListener('click', function() {
                form.reset();
                fetchFilteredVehicles();
            });
        });
    </script>

</x-guest-layout>
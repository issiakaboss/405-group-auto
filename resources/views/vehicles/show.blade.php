<x-guest-layout>
    @php
        $isUsVisitor = request()->attributes->get('is_us_visitor', true);
        $statusEnum = $vehicle->status instanceof \App\Models\Enums\VehicleStatus
            ? $vehicle->status
            : \App\Models\Enums\VehicleStatus::tryFrom($vehicle->status);
        $locationLabel = $vehicle->location instanceof \App\Models\Enums\VehicleLocation
            ? $vehicle->location->label()
            : (\App\Models\Enums\VehicleLocation::tryFrom($vehicle->location)?->label() ?? 'USA Warehouse');
    @endphp

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12"
        x-data="{ 
             activeImage: '{{ !empty($vehicle->images) ? $vehicle->images[0] : 'https://images.unsplash.com/photo-1533473359331-0135ef1b58bf?auto=format&fit=crop&w=800&q=80' }}', 
             isZoomOpen: false 
         }"
        @keydown.escape.window="isZoomOpen = false">

        <!-- Fil d'Ariane / Retour -->
        <div class="mb-6">
            <a href="{{ route('home') }}#catalog" class="text-xs font-semibold text-gray-500 hover:text-gray-900 transition flex items-center space-x-1 w-max">
                <span>&larr; Back to Collection</span>
            </a>
        </div>

        <!-- Grille Principale : Galerie à gauche, Infos à droite -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-start">

            <!-- BLOC GAUCHE : Galerie / Grande Image + Thumbnails -->
            <div class="space-y-4">

                <!-- Image Principale avec curseur de Zoom -->
                <div class="relative bg-gray-100 rounded-2xl overflow-hidden aspect-[16/10] shadow-sm border border-gray-100 group cursor-zoom-in"
                    @click="isZoomOpen = true">

                    <img :src="activeImage"
                        alt="{{ $vehicle->title }}"
                        class="w-full h-full object-cover transition duration-300 group-hover:scale-105">

                    <!-- Overlay au survol -->
                    <div class="absolute inset-0 bg-black/10 opacity-0 group-hover:opacity-100 transition flex items-center justify-center">
                        <span class="bg-white/90 text-gray-900 text-xs font-semibold px-3 py-1.5 rounded-full shadow-md flex items-center gap-1.5">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                            </svg>
                            Click to Zoom
                        </span>
                    </div>
                </div>

                <!-- Boucle sur les miniatures -->
                @if(!empty($vehicle->images) && count($vehicle->images) > 1)
                <div class="grid grid-cols-4 gap-4">
                    @foreach($vehicle->images as $imageUrl)
                    <button type="button"
                        @click="activeImage = '{{ $imageUrl }}'"
                        class="bg-gray-100 rounded-xl overflow-hidden aspect-video border-2 transition cursor-pointer focus:outline-none"
                        :class="activeImage === '{{ $imageUrl }}' ? 'border-gray-900 opacity-100' : 'border-transparent opacity-60 hover:opacity-100'">
                        <img src="{{ $imageUrl }}" alt="Thumbnail {{ $loop->iteration }}" class="w-full h-full object-cover">
                    </button>
                    @endforeach
                </div>
                @endif

            </div>

            <!-- BLOC DROITE : Spécifications & Actions -->
            <div class="space-y-6">
                <div>
                    <!-- Badges Logistiques et Statuts -->
                    <div class="mb-3 flex items-center gap-2 flex-wrap">
                        <span class="bg-gray-100 text-gray-800 text-[10px] uppercase font-bold px-2.5 py-1 rounded-md border border-gray-200">
                            {{ $vehicle->vehicle_type?->label() ?? $vehicle->vehicle_type?->value ?? $vehicle->vehicle_type ?? $vehicle->category ?? 'Vehicle' }}
                        </span>

                        @if($vehicle->hasBeenSold())
                        <span class="bg-rose-100 text-rose-800 text-[10px] uppercase font-bold px-2.5 py-1 rounded-md border border-rose-200">Vendu</span>
                        @elseif($statusEnum)
                        <span class="{{ $statusEnum->badgeColor() }} text-[10px] uppercase font-bold px-2.5 py-1 rounded-md shadow-sm">
                            {{ $statusEnum->label() }}
                        </span>
                        @endif
                    </div>

                    <h1 class="text-3xl font-bold text-gray-900 tracking-tight mb-2">{{ $vehicle->title }}</h1>
                    <p class="text-2xl font-bold text-gray-900">${{ number_format($vehicle->price) }}</p>
                </div>

                <hr class="border-gray-100">

                <!-- Grille des caractéristiques clés -->
                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-gray-50 p-3.5 rounded-xl border border-gray-100">
                        <span class="block text-[11px] text-gray-400 uppercase font-medium">Year</span>
                        <span class="font-semibold text-gray-900 text-sm">{{ $vehicle->year }}</span>
                    </div>
                    <div class="bg-gray-50 p-3.5 rounded-xl border border-gray-100">
                        <span class="block text-[11px] text-gray-400 uppercase font-medium">Mileage</span>
                        <span class="font-semibold text-gray-900 text-sm">{{ number_format($vehicle->mileage) }} miles</span>
                    </div>
                    <div class="bg-gray-50 p-3.5 rounded-xl border border-gray-100">
                        <span class="block text-[11px] text-gray-400 uppercase font-medium">Transmission</span>
                        <span class="font-semibold text-gray-900 text-sm">{{ $vehicle->transmission ?? 'N/A' }}</span>
                    </div>
                    <div class="bg-gray-50 p-3.5 rounded-xl border border-gray-100">
                        <span class="block text-[11px] text-gray-400 uppercase font-medium">Fuel Type</span>
                        <span class="font-semibold text-gray-900 text-sm">{{ $vehicle->fuel_type ?? 'N/A' }}</span>
                    </div>
                </div>

                <!-- Localisation exacte -->
                <div class="p-4 bg-gray-50 border border-gray-100 rounded-xl flex items-center space-x-3">
                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25s-7.5-4.108-7.5-11.25a7.5 7.5 0 1 1 15 0Z" />
                    </svg>
                    <div>
                        <span class="block text-[10px] uppercase tracking-wider text-gray-400 font-medium">Current Location</span>
                        <span class="text-xs font-semibold text-gray-900">{{ $locationLabel }}</span>
                    </div>
                </div>

                <!-- DÉTAILS COMPLÉMENTAIRES / SPÉCIFICATIONS -->
                <div class="border-t border-gray-100 pt-6 space-y-4">
                    <h3 class="text-sm font-bold text-gray-900 uppercase tracking-wider">Detailed Specifications</h3>

                    <div class="grid grid-cols-2 gap-y-3 gap-x-4 text-xs">
                        @if($vehicle->make)
                        <div class="flex justify-between border-b border-gray-50 pb-2">
                            <span class="text-gray-400">Make</span>
                            <span class="font-semibold text-gray-800">{{ $vehicle->make }}</span>
                        </div>
                        @endif

                        @if($vehicle->model)
                        <div class="flex justify-between border-b border-gray-50 pb-2">
                            <span class="text-gray-400">Model</span>
                            <span class="font-semibold text-gray-800">{{ $vehicle->model }}</span>
                        </div>
                        @endif

                        @if($vehicle->engine)
                        <div class="flex justify-between border-b border-gray-50 pb-2">
                            <span class="text-gray-400">Engine</span>
                            <span class="font-semibold text-gray-800">{{ $vehicle->engine }}</span>
                        </div>
                        @endif

                        @if($vehicle->drive_train)
                        <div class="flex justify-between border-b border-gray-50 pb-2">
                            <span class="text-gray-400">Drivetrain</span>
                            <span class="font-semibold text-gray-800">{{ $vehicle->drive_train }}</span>
                        </div>
                        @endif

                        @if($vehicle->exterior_color)
                        <div class="flex justify-between border-b border-gray-50 pb-2">
                            <span class="text-gray-400">Exterior Color</span>
                            <span class="font-semibold text-gray-800">{{ $vehicle->exterior_color }}</span>
                        </div>
                        @endif

                        @if($vehicle->interior_color)
                        <div class="flex justify-between border-b border-gray-50 pb-2">
                            <span class="text-gray-400">Interior Color</span>
                            <span class="font-semibold text-gray-800">{{ $vehicle->interior_color }}</span>
                        </div>
                        @endif

                        @if($vehicle->vin)
                        <div class="flex justify-between border-b border-gray-50 pb-2 col-span-2">
                            <span class="text-gray-400">VIN</span>
                            <span class="font-mono font-semibold text-gray-800">{{ $vehicle->vin }}</span>
                        </div>
                        @endif
                    </div>

                    @if($vehicle->description)
                    <div class="pt-2">
                        <span class="block text-xs text-gray-400 font-medium mb-1">Description</span>
                        <p class="text-xs text-gray-600 leading-relaxed bg-gray-50 p-3 rounded-xl border border-gray-100">
                            {{ $vehicle->description }}
                        </p>
                    </div>
                    @endif
                </div>

                <!-- BLOC D'ACTION PRINCIPAL -->
                <div class="pt-4 space-y-3">

                    @if(request('action') === 'order_similar')
                    <div class="p-3.5 bg-amber-50 border border-amber-200 rounded-xl flex items-start gap-3">
                        <svg class="w-5 h-5 text-amber-600 mt-0.5 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
                        </svg>
                        <p class="text-xs text-amber-800 leading-relaxed">
                            This unit is currently unavailable, but you can place an order for a <strong>similar unit</strong> with matching specifications.
                        </p>
                    </div>
                    @endif

                    <div class="flex items-center gap-3">
                        @if(request('action') === 'order_similar')
                        <form action="{{ route('cart.add-similar', $vehicle->id) }}" method="POST" class="flex-1">
                            @csrf
                            <button type="submit"
                                class="w-full py-3.5 px-6 font-semibold text-sm text-white bg-amber-600 rounded-xl hover:bg-amber-700 transition shadow-md flex items-center justify-center space-x-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                </svg>
                                <span>Order Similar Unit</span>
                            </button>
                        </form>

                        @elseif($vehicle->hasBeenSold() || $vehicle->isCurrentlyReserved())
                        <div class="flex-1 flex gap-2">
                            <button disabled
                                class="flex-1 py-3.5 px-6 font-semibold text-sm text-gray-400 bg-gray-200 rounded-xl cursor-not-allowed text-center">
                                Vehicle Sold / Reserved
                            </button>
                            <a href="{{ route('vehicles.show', ['vehicle' => $vehicle->id, 'action' => 'order_similar']) }}"
                                class="py-3.5 px-4 font-semibold text-xs text-amber-800 bg-amber-100 hover:bg-amber-200 rounded-xl transition flex items-center justify-center text-center">
                                Order Similar
                            </a>
                        </div>

                        @else
                        <form action="{{ route('cart.add', $vehicle->id) }}" method="POST" class="flex-1">
                            @csrf
                            <button type="submit"
                                class="w-full py-3.5 px-6 font-semibold text-sm text-white bg-[#0F172A] rounded-xl hover:bg-gray-800 transition shadow-md flex items-center justify-center space-x-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                                </svg>
                                <span>Add to Cart</span>
                            </button>
                        </form>
                        @endif

                        @php $isFav = isset(session('favorites', [])[$vehicle->id]); @endphp
                        <form action="{{ route('favorites.toggle', $vehicle->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="p-3.5 border border-gray-200 rounded-xl hover:bg-gray-50 transition text-gray-600">
                                <svg class="w-5 h-5 {{ $isFav ? 'fill-red-500 text-red-500' : 'fill-none stroke-current' }}" viewBox="0 0 24 24" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                                </svg>
                            </button>
                        </form>
                    </div>

                </div>

            </div>

        </div>

        <!-- LIGHTBOX MODAL (ZOOM IMAGE EN GRAND) -->
        <div x-show="isZoomOpen"
            x-cloak
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 z-50 bg-black/90 flex items-center justify-center p-4">

            <button @click="isZoomOpen = false"
                class="absolute top-6 right-6 text-white hover:text-gray-300 transition focus:outline-none">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

            <div class="max-w-5xl max-h-[90vh] overflow-hidden" @click.away="isZoomOpen = false">
                <img :src="activeImage" alt="Zoomed view" class="w-full h-full object-contain rounded-lg">
            </div>
        </div>

    </div>
</x-guest-layout>
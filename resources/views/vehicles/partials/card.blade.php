<div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden flex flex-col justify-between group">
    <div>
        {{-- Image & Badges --}}
        <div class="relative h-44 bg-gray-100 overflow-hidden">
            <img src="{{ is_array($vehicle->images) && count($vehicle->images) > 0 ? $vehicle->images[0] : 'https://images.unsplash.com/photo-1503376780353-7e6692767b70?q=80&w=400' }}" 
                 alt="{{ $vehicle->title }}" 
                 class="w-full h-full object-cover group-hover:scale-105 transition duration-300">

            {{-- Badges de statut & tags --}}
            <div class="absolute top-3 left-3 flex flex-wrap gap-1 z-10">
                {{-- Badge de statut dynamique via l'Enum --}}
                @php
                    $statusEnum = $vehicle->status instanceof \App\Models\Enums\VehicleStatus 
                        ? $vehicle->status 
                        : \App\Models\Enums\VehicleStatus::tryFrom($vehicle->status);
                @endphp

                @if($statusEnum)
                    <span class="{{ $statusEnum->badgeColor() }} text-[10px] font-semibold px-2 py-0.5 rounded-md shadow-sm">
                        {{ $statusEnum->label() }}
                    </span>
                @endif

                @if($vehicle->is_featured)
                    <span class="bg-[#E11D48] text-white text-[10px] font-semibold px-2 py-0.5 rounded-md shadow-sm">Featured</span>
                @endif

                @if($vehicle->year >= 2025)
                    <span class="bg-gray-900 text-white text-[10px] font-semibold px-2 py-0.5 rounded-md shadow-sm">New</span>
                @endif
            </div>

            {{-- Badge de localisation (flottant sur l'image) --}}
            @if(!empty($vehicle->location))
                <div class="absolute bottom-2.5 left-3 z-10">
                    <span class="inline-flex items-center gap-1 bg-black/60 backdrop-blur-md text-white text-[10px] font-medium px-2 py-0.5 rounded-md shadow">
                        <svg class="w-3 h-3 text-red-400 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                        </svg>
                        <span class="truncate max-w-[150px]">{{ $vehicle->location?->label() }}</span>
                    </span>
                </div>
            @endif

            {{-- Bouton Favoris --}}
            <form action="{{ route('favorites.toggle', $vehicle->id) }}" method="POST" class="absolute top-3 right-3 z-20">
                @csrf
                <button type="submit" class="p-2 rounded-full bg-white/90 backdrop-blur-sm shadow-sm transition group/fav hover:bg-white text-gray-600 hover:text-red-500">
                    <svg class="h-4 w-4 {{ isset(session()->get('favorites', [])[$vehicle->id]) ? 'fill-red-500 text-red-500' : 'fill-none stroke-current' }}" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                    </svg>
                </button>
            </form>
        </div>

        {{-- Détails du véhicule --}}
        <div class="p-4">
            <h4 class="font-bold text-gray-900 text-sm mb-1 tracking-tight truncate">{{ $vehicle->title }}</h4>

            {{-- Année, Kilométrage et Position textuelle --}}
            <div class="flex items-center gap-1.5 text-gray-400 text-[11px] mb-3 truncate">
                <span>{{ $vehicle->year }}</span>
                <span>&bull;</span>
                <span>{{ number_format($vehicle->mileage) }} mi</span>
                @if(!empty($vehicle->location))
                    <span>&bull;</span>
                    <span class="text-gray-600 font-medium truncate">{{ $vehicle->location->label() }}</span>
                @endif
            </div>

            <div class="flex justify-between items-center mb-1">
                <span class="text-base font-bold text-gray-900">${{ number_format($vehicle->price) }}</span>
                <span class="bg-gray-50 text-gray-500 text-[10px] font-medium px-2 py-0.5 rounded border border-gray-100">{{ $vehicle->category }}</span>
            </div>
        </div>
    </div>

    {{-- Actions --}}
    <div class="p-4 pt-0 grid grid-cols-2 gap-2.5">
        <a href="{{ route('vehicles.show', $vehicle->id) }}" class="text-center py-2 text-[11px] font-semibold text-gray-700 border border-gray-200 rounded-lg hover:bg-gray-50 transition">
            View Details
        </a>

        @if($vehicle->hasBeenSold() || $vehicle->isCurrentlyReserved())
            <a href="{{ route('vehicles.show', ['vehicle' => $vehicle->id, 'action' => 'order_similar']) }}" 
               class="text-center py-2 text-[11px] font-semibold text-amber-900 bg-amber-100 rounded-lg hover:bg-amber-200 transition">
                Order Similar
            </a>
        @else
            <form action="{{ route('cart.add', $vehicle->id) }}" method="POST">
                @csrf
                <button type="submit" class="w-full text-center py-2 text-[11px] font-semibold text-white bg-[#0F172A] rounded-lg hover:bg-gray-800 transition shadow-sm">
                    Add to Cart
                </button>
            </form>
        @endif
    </div>
</div>
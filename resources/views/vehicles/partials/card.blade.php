@php
    // Normalisation des enums & attributs
    $statusEnum = $vehicle->status instanceof \App\Models\Enums\VehicleStatus
        ? $vehicle->status
        : \App\Models\Enums\VehicleStatus::tryFrom($vehicle->status);

    $locationLabel = $vehicle->location instanceof \App\Models\Enums\VehicleLocation
        ? $vehicle->location->label()
        : (\App\Models\Enums\VehicleLocation::tryFrom($vehicle->location)?->label() ?? 'USA Warehouse');

    $fuelLabel = $vehicle->fuel_type instanceof \BackedEnum ? $vehicle->fuel_type->value : $vehicle->fuel_type;
    $transLabel = $vehicle->transmission instanceof \BackedEnum ? $vehicle->transmission->value : $vehicle->transmission;
    $bodyStyleLabel = $vehicle->body_style instanceof \BackedEnum ? $vehicle->body_style->value : $vehicle->body_style;
@endphp

<div class="bg-white rounded-2xl border border-gray-200/80 shadow-sm hover:shadow-xl transition-all duration-300 overflow-hidden flex flex-col justify-between group">
    <div>
        {{-- VISUEL & BADGES DE CONFIANCE --}}
        <div class="relative h-48 bg-gray-100 overflow-hidden">
            <img src="{{ is_array($vehicle->images) && count($vehicle->images) > 0 ? $vehicle->images[0] : 'https://images.unsplash.com/photo-1503376780353-7e6692767b70?q=80&w=400' }}"
                alt="{{ $vehicle->title }}"
                class="w-full h-full object-cover group-hover:scale-105 transition duration-500">

            {{-- Overlay Dégradé pour lisibilité --}}
            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-black/20 pointer-events-none"></div>

            {{-- Badges Supérieurs (Statut, Clean Title, Featured) --}}
            <div class="absolute top-3 left-3 right-12 flex flex-wrap gap-1.5 z-10">
                @if($statusEnum)
                    <span class="{{ $statusEnum->badgeColor() }} text-[10px] font-black uppercase tracking-wider px-2 py-0.5 rounded-md shadow-md">
                        {{ $statusEnum->label() }}
                    </span>
                @endif

                @if($vehicle->has_clean_title)
                    <span class="bg-emerald-600 text-white text-[10px] font-bold px-2 py-0.5 rounded-md shadow-md flex items-center gap-1">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5"/></svg>
                        Clean Title
                    </span>
                @endif

                @if($vehicle->is_featured)
                    <span class="bg-rose-600 text-white text-[10px] font-bold px-2 py-0.5 rounded-md shadow-md">
                        Featured
                    </span>
                @endif
            </div>

            {{-- Bouton Favoris --}}
            <form action="{{ route('favorites.toggle', $vehicle->id) }}" method="POST" class="absolute top-3 right-3 z-20">
                @csrf
                <button type="submit" class="p-2 rounded-full bg-slate-900/40 backdrop-blur-md text-white hover:text-rose-500 hover:bg-white transition-all shadow-md">
                    <svg class="h-4 w-4 {{ isset(session()->get('favorites', [])[$vehicle->id]) ? 'fill-rose-500 text-rose-500' : 'fill-none stroke-current' }}" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                    </svg>
                </button>
            </form>

            {{-- Badge Localisation Immersif --}}
            @if(!empty($vehicle->location))
                <div class="absolute bottom-2.5 left-3 z-10">
                    <span class="inline-flex items-center gap-1 bg-black/60 backdrop-blur-md text-white text-[10px] font-semibold px-2.5 py-1 rounded-lg border border-white/10">
                        <svg class="w-3 h-3 text-amber-400 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                        </svg>
                        <span class="truncate max-w-[160px]">{{ $locationLabel }}</span>
                    </span>
                </div>
            @endif
        </div>

        {{-- CONTENU & CARACTÉRISTIQUES --}}
        <div class="p-4">
            {{-- En-tête : Titre & Trim --}}
            <div class="mb-2">
                <h4 class="font-extrabold text-gray-900 text-base leading-snug truncate" title="{{ $vehicle->title }}">
                    {{ $vehicle->title }}
                </h4>
                @if($vehicle->trim)
                    <p class="text-[11px] font-semibold text-amber-600 truncate uppercase tracking-wider">{{ $vehicle->trim }} Trim</p>
                @endif
            </div>

            {{-- Métriques Clés : Année, Kilométrage --}}
            <div class="flex items-center gap-2 text-xs font-bold text-gray-500 mb-3 pb-3 border-b border-gray-100">
                <span>{{ $vehicle->year }}</span>
                <span>•</span>
                <span>{{ number_format($vehicle->mileage) }} mi</span>
                @if($bodyStyleLabel)
                    <span>•</span>
                    <span class="text-slate-700 font-semibold truncate">{{ ucfirst($bodyStyleLabel) }}</span>
                @endif
            </div>

            {{-- Grille de spécifications techniques --}}
            <div class="grid grid-cols-2 gap-1.5 text-[11px] text-gray-600 mb-4 bg-gray-50/80 p-2.5 rounded-xl border border-gray-100">
                @if($transLabel)
                    <div class="flex items-center gap-1.5 truncate">
                        <svg class="w-3.5 h-3.5 text-gray-400 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6h9.75M10.5 6a1.5 1.5 0 1 1-3 0m3 0a1.5 1.5 0 1 0-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 1 1-3 0m3 0a1.5 1.5 0 1 0-3 0M3.75 18H7.5"/></svg>
                        <span class="truncate capitalize">{{ $transLabel }}</span>
                    </div>
                @endif

                @if($fuelLabel)
                    <div class="flex items-center gap-1.5 truncate">
                        <svg class="w-3.5 h-3.5 text-gray-400 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.362 5.214A8.252 8.252 0 0 1 12 21 8.25 8.25 0 0 1 6.038 7.047 8.287 8.287 0 0 0 9 9.601a8.983 8.983 0 0 1 3.361-6.867 8.21 8.21 0 0 1 3 2.48Z"/></svg>
                        <span class="truncate capitalize">{{ $fuelLabel }}</span>
                    </div>
                @endif
            </div>

            {{-- Affichage du Prix & Type --}}
            <div class="flex justify-between items-baseline gap-2">
                <div>
                    <span class="text-xs text-gray-400 uppercase font-bold block leading-none mb-0.5">Price</span>
                    <span class="text-xl font-black text-slate-950 tracking-tight">${{ number_format($vehicle->price) }}</span>
                </div>
                
                @if($vehicle->money_still_owed && $vehicle->money_still_owed->value !== 'none')
                    <span class="bg-amber-50 text-amber-700 text-[10px] font-bold px-2 py-1 rounded-md border border-amber-200/60">
                        Balance Owed
                    </span>
                @endif
            </div>
        </div>
    </div>

    {{-- BOUTONS D'ACTION --}}
    <div class="p-4 pt-0 grid grid-cols-2 gap-2">
        <a href="{{ route('vehicles.show', $vehicle->id) }}" 
           class="w-full text-center py-2.5 px-2 text-xs font-bold text-slate-700 bg-gray-100 hover:bg-gray-200 rounded-xl transition">
            Details
        </a>

        @if($vehicle->hasBeenSold() || $vehicle->isCurrentlyReserved())
            <a href="{{ route('vehicles.show', ['vehicle' => $vehicle->id, 'action' => 'order_similar']) }}"
               class="w-full text-center py-2.5 px-2 text-xs font-bold text-slate-900 bg-amber-400 hover:bg-amber-500 rounded-xl transition shadow-sm">
                Reserve Similar
            </a>
        @else
            <form action="{{ route('cart.add', $vehicle->id) }}" method="POST" class="w-full">
                @csrf
                <button type="submit" 
                        class="w-full text-center py-2.5 px-2 text-xs font-bold text-white bg-slate-950 hover:bg-slate-800 rounded-xl transition shadow-sm">
                    Reserve
                </button>
            </form>
        @endif
    </div>
</div>
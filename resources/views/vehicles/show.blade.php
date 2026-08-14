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

    <!-- Container Principal avec État Alpine Global -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10"
        x-data="{ 
             activeImage: '{{ !empty($vehicle->images) ? $vehicle->images[0] : 'https://images.unsplash.com/photo-1533473359331-0135ef1b58bf?auto=format&fit=crop&w=800&q=80' }}', 
             isZoomOpen: false,
             visitDate: '{{ date('Y-m-d', strtotime('+1 day')) }}',
             visitTime: '10:00 AM',
             testDriveModal: false,
             selectedVehicleId: '{{ $vehicle->id }}',
             selectedVehicleTitle: '{{ addslashes($vehicle->title ?? $vehicle->make . ' ' . $vehicle->model) }}',
             selectedDate: '',
             selectedTime: ''
         }"
        @keydown.escape.window="isZoomOpen = false; testDriveModal = false">

        <!-- Fil d'Ariane / Retour -->
        <div class="mb-6">
            <a href="{{ route('home') }}#catalog" class="inline-flex items-center gap-2 text-xs font-semibold text-slate-500 hover:text-slate-900 transition-colors bg-slate-100 hover:bg-slate-200 px-3 py-1.5 rounded-lg">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                </svg>
                <span>Back to Inventory</span>
            </a>
        </div>

        <!-- Grille Principale -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-start">

            <!-- BLOC GAUCHE : Galerie -->
            <div class="lg:col-span-7 space-y-4">
                <!-- Image Principale -->
                <div class="relative bg-slate-900 rounded-2xl overflow-hidden aspect-[16/10] shadow-md border border-slate-200 group cursor-zoom-in"
                    @click="isZoomOpen = true">

                    <img :src="activeImage"
                        alt="{{ $vehicle->title }}"
                        class="w-full h-full object-cover transition duration-500 group-hover:scale-105">

                    <!-- Overlay au survol -->
                    <div class="absolute inset-0 bg-slate-950/20 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                        <span class="bg-white/95 backdrop-blur text-slate-900 text-xs font-bold px-4 py-2 rounded-full shadow-lg flex items-center gap-2">
                            <svg class="w-4 h-4 text-amber-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                            </svg>
                            Click to Expand View
                        </span>
                    </div>
                </div>

                <!-- Miniatures -->
                @if(!empty($vehicle->images) && count($vehicle->images) > 1)
                <div class="grid grid-cols-5 gap-3">
                    @foreach($vehicle->images as $imageUrl)
                    <button type="button"
                        @click="activeImage = '{{ $imageUrl }}'"
                        class="bg-slate-100 rounded-xl overflow-hidden aspect-video border-2 transition cursor-pointer focus:outline-none"
                        :class="activeImage === '{{ $imageUrl }}' ? 'border-amber-500 ring-2 ring-amber-500/20 opacity-100 scale-[0.98]' : 'border-transparent opacity-70 hover:opacity-100'">
                        <img src="{{ $imageUrl }}" alt="Thumbnail {{ $loop->iteration }}" class="w-full h-full object-cover">
                    </button>
                    @endforeach
                </div>
                @endif
            </div>

            <!-- BLOC DROITE : Spécifications & Formulaire de Visite -->
            <div class="lg:col-span-5 space-y-6">
                <div>
                    <!-- Badges Logistiques -->
                    <div class="mb-3 flex items-center gap-2 flex-wrap">
                        <span class="bg-amber-50 text-amber-800 text-[11px] font-extrabold px-3 py-1 rounded-md border border-amber-200/60 uppercase tracking-wide">
                            {{ $vehicle->vehicle_type?->label() ?? $vehicle->vehicle_type?->value ?? $vehicle->vehicle_type ?? $vehicle->category ?? 'Vehicle' }}
                        </span>

                        @if($vehicle->hasBeenSold())
                        <span class="bg-rose-100 text-rose-800 text-[11px] uppercase font-bold px-3 py-1 rounded-md border border-rose-200">Vendu / Sold</span>
                        @elseif($statusEnum)
                        <span class="{{ $statusEnum->badgeColor() }} text-[11px] uppercase font-bold px-3 py-1 rounded-md shadow-sm">
                            {{ $statusEnum->label() }}
                        </span>
                        @endif
                    </div>

                    <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight leading-tight mb-2">{{ $vehicle->title }}</h1>
                    <div class="flex items-baseline gap-2">
                        <span class="text-3xl font-black text-slate-900">${{ number_format($vehicle->price) }}</span>
                        <span class="text-xs text-slate-600 font-medium">+ applicable taxes & fees</span>
                    </div>
                </div>

                <!-- Grille des caractéristiques clés -->
                <div class="grid grid-cols-2 gap-3">
                    <div class="bg-slate-50 p-3 rounded-xl border border-slate-200/60">
                        <span class="block text-[10px] text-slate-600 uppercase font-bold tracking-wider">Year</span>
                        <span class="font-bold text-slate-900 text-sm">{{ $vehicle->year }}</span>
                    </div>
                    <div class="bg-slate-50 p-3 rounded-xl border border-slate-200/60">
                        <span class="block text-[10px] text-slate-600 uppercase font-bold tracking-wider">Mileage</span>
                        <span class="font-bold text-slate-900 text-sm">{{ number_format($vehicle->mileage) }} mi</span>
                    </div>
                    <div class="bg-slate-50 p-3 rounded-xl border border-slate-200/60">
                        <span class="block text-[10px] text-slate-600 uppercase font-bold tracking-wider">Transmission</span>
                        <span class="font-bold text-slate-900 text-sm truncate block" title="{{ $vehicle->transmission ?? 'N/A' }}">{{ $vehicle->transmission ?? 'N/A' }}</span>
                    </div>
                    <div class="bg-slate-50 p-3 rounded-xl border border-slate-200/60">
                        <span class="block text-[10px] text-slate-600 uppercase font-bold tracking-wider">Fuel Type</span>
                        <span class="font-bold text-slate-900 text-sm">{{ $vehicle->fuel_type ?? 'N/A' }}</span>
                    </div>
                </div>

                <!-- Localisation exacte -->
                <div class="p-3.5 bg-slate-50 border border-slate-200/60 rounded-xl flex items-center space-x-3">
                    <div class="p-2 bg-amber-50 text-amber-600 rounded-lg">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25s-7.5-4.108-7.5-11.25a7.5 7.5 0 1 1 15 0Z" />
                        </svg>
                    </div>
                    <div>
                        <span class="block text-[10px] uppercase tracking-wider text-slate-600 font-bold">Showroom Location</span>
                        <span class="text-xs font-bold text-slate-900">{{ $locationLabel }}</span>
                    </div>
                </div>

                <!-- 1. ACTIONS PRINCIPALES (PANIER & FAVORIS) -->
                <div class="space-y-3 mb-6">
                    <div class="flex gap-3">
                        <form action="{{ route('cart.add', $vehicle->id) }}" method="POST" class="flex-1">
                            @csrf
                            <button type="submit" class="w-full py-3.5 bg-amber-400 hover:bg-amber-300 text-slate-900 font-bold rounded-xl text-xs uppercase tracking-wider transition">
                                Add to Selection
                            </button>
                        </form>

                        <form action="{{ route('favorites.toggle', $vehicle->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="p-3.5 bg-slate-100 hover:bg-slate-200 border border-slate-200 rounded-xl transition text-slate-700">
                                <svg class="w-5 h-5 fill-none stroke-current" viewBox="0 0 24 24" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>

                <!-- 2. BLOC DÉDIÉ : PRISE DE RENDEZ-VOUS EN SHOWROOM -->
                <div class="bg-slate-900 text-white p-5 rounded-2xl shadow-xl space-y-4">
                    <div class="flex items-center justify-between border-b border-slate-800 pb-3">
                        <h3 class="text-xs font-bold tracking-wide uppercase text-amber-400 flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 9v7.5" />
                            </svg>
                            Schedule Showroom Visit
                        </h3>
                        <span class="text-[10px] bg-emerald-500/20 text-emerald-300 font-semibold px-2 py-0.5 rounded border border-emerald-500/30">Free Appointment</span>
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block text-[10px] font-bold text-slate-400 uppercase mb-1">Preferred Date</label>
                            <input type="date" x-model="visitDate" min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                                class="w-full bg-slate-800 border border-slate-700 rounded-lg px-3 py-2 text-xs text-white focus:outline-none focus:border-amber-400">
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold text-slate-400 uppercase mb-1">Time Slot</label>
                            <select x-model="visitTime"
                                class="w-full bg-slate-800 border border-slate-700 rounded-lg px-3 py-2 text-xs text-white focus:outline-none focus:border-amber-400">
                                @foreach(\App\Models\Enums\VisitTimeSlot::cases() as $slot)
                                <option value="{{ $slot->value }}">{{ $slot->label() }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Bouton Déclencheur du Modal -->
                    <button type="button"
                        @click="
                            selectedDate = visitDate;
                            selectedTime = visitTime;
                            testDriveModal = true;
                        "
                        class="w-full py-3 bg-amber-400 hover:bg-amber-300 text-slate-900 font-bold rounded-xl text-xs uppercase tracking-wider transition">
                        Book Appointment
                    </button>
                </div>

                <!-- DÉTAILS COMPLÉMENTAIRES -->
                <div class="border-t border-slate-200 pt-5 space-y-4">
                    <h3 class="text-xs font-bold text-slate-900 uppercase tracking-wider">Detailed Specifications</h3>

                    <div class="grid grid-cols-2 gap-y-2.5 gap-x-4 text-xs">
                        @if($vehicle->make)
                        <div class="flex justify-between border-b border-slate-100 pb-1.5">
                            <span class="text-slate-600 font-semibold">Make</span>
                            <span class="font-bold text-slate-900">{{ $vehicle->make }}</span>
                        </div>
                        @endif

                        @if($vehicle->model)
                        <div class="flex justify-between border-b border-slate-100 pb-1.5">
                            <span class="text-slate-600 font-semibold">Model</span>
                            <span class="font-bold text-slate-900">{{ $vehicle->model }}</span>
                        </div>
                        @endif

                        @if($vehicle->engine)
                        <div class="flex justify-between border-b border-slate-100 pb-1.5">
                            <span class="text-slate-600 font-semibold">Engine</span>
                            <span class="font-bold text-slate-900">{{ $vehicle->engine }}</span>
                        </div>
                        @endif

                        @if($vehicle->drive_train)
                        <div class="flex justify-between border-b border-slate-100 pb-1.5">
                            <span class="text-slate-600 font-semibold">Drivetrain</span>
                            <span class="font-bold text-slate-900">{{ $vehicle->drive_train }}</span>
                        </div>
                        @endif

                        @if($vehicle->exterior_color)
                        <div class="flex justify-between border-b border-slate-100 pb-1.5">
                            <span class="text-slate-600 font-semibold">Exterior Color</span>
                            <span class="font-bold text-slate-900">{{ $vehicle->exterior_color }}</span>
                        </div>
                        @endif

                        @if($vehicle->interior_color)
                        <div class="flex justify-between border-b border-slate-100 pb-1.5">
                            <span class="text-slate-600 font-semibold">Interior Color</span>
                            <span class="font-bold text-slate-900">{{ $vehicle->interior_color }}</span>
                        </div>
                        @endif

                        @if($vehicle->vin)
                        <div class="flex justify-between border-b border-slate-100 pb-1.5 col-span-2">
                            <span class="text-slate-600 font-semibold">VIN</span>
                            <span class="font-mono font-bold text-slate-900">{{ $vehicle->vin }}</span>
                        </div>
                        @endif
                    </div>

                    @if($vehicle->description)
                    <div class="pt-2">
                        <span class="block text-xs font-bold text-slate-900 mb-1">Vehicle Notes</span>
                        <p class="text-xs text-slate-600 leading-relaxed bg-slate-50 p-3.5 rounded-xl border border-slate-200/60">
                            {{ $vehicle->description }}
                        </p>
                    </div>
                    @endif
                </div>

            </div>

        </div>

        <!-- LIGHTBOX MODAL (ZOOM IMAGE) -->
        <div x-show="isZoomOpen"
            x-cloak
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 z-50 bg-slate-950/90 backdrop-blur-sm flex items-center justify-center p-4">

            <button @click="isZoomOpen = false"
                class="absolute top-6 right-6 text-white hover:text-amber-400 transition focus:outline-none">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

            <div class="max-w-5xl max-h-[90vh] overflow-hidden" @click.away="isZoomOpen = false">
                <img :src="activeImage" alt="Zoomed view" class="w-full h-full object-contain rounded-xl shadow-2xl">
            </div>
        </div>

        <!-- MODAL SCHEDULE TEST DRIVE / SHOWROOM VISIT -->
        <div x-show="testDriveModal"
            class="fixed inset-0 bg-slate-950/70 backdrop-blur-sm flex items-center justify-center z-50 p-4"
            x-cloak
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0">

            <div @click.away="testDriveModal = false" class="bg-white rounded-2xl max-w-md w-full p-6 shadow-2xl border border-gray-100 space-y-4">
                <div class="flex justify-between items-center border-b border-gray-100 pb-3">
                    <h3 class="font-bold text-gray-900 text-base">Schedule a Test Drive</h3>
                    <button type="button" @click="testDriveModal = false" class="text-gray-400 hover:text-gray-600 font-bold text-xl">&times;</button>
                </div>
                
                <p class="text-xs text-gray-500 leading-relaxed">
                    Book a private slot to inspect and test drive the <span class="font-bold text-gray-900" x-text="selectedVehicleTitle"></span>.
                </p>

                <form action="{{ route('testdrive.store') }}" method="POST" class="space-y-4 text-xs">
                    @csrf
                    <input type="hidden" name="vehicle_id" :value="selectedVehicleId">

                    <div>
                        <label class="block font-semibold text-gray-700 mb-1">Preferred Date</label>
                        <input type="date" name="date" x-model="selectedDate" required min="{{ date('Y-m-d', strtotime('+1 day')) }}" class="w-full border border-gray-200 rounded-xl px-3.5 py-2.5 bg-gray-50 focus:bg-white focus:border-amber-400 transition outline-none">
                    </div>

                    <div>
                        <label class="block font-semibold text-gray-700 mb-1">Preferred Time Slot</label>
                        <select name="visit_time" x-model="selectedTime" class="w-full border border-gray-200 rounded-xl px-3.5 py-2.5 bg-gray-50 focus:bg-white focus:border-amber-400 transition outline-none text-gray-800">
                            @foreach(\App\Models\Enums\VisitTimeSlot::cases() as $slot)
                            <option value="{{ $slot->value }}">{{ $slot->label() }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block font-semibold text-gray-700 mb-1">Special Requirements (Optional)</label>
                        <textarea name="notes" placeholder="Specify if you require delivery to a specific venue or features review..." class="w-full border border-gray-200 rounded-xl px-3.5 py-2.5 bg-gray-50 focus:bg-white focus:border-amber-400 transition h-20 resize-none outline-none"></textarea>
                    </div>

                    <button type="submit" class="w-full py-3 bg-[#0F172A] hover:bg-slate-800 text-white font-semibold rounded-xl transition mt-2 shadow tracking-wide uppercase text-xs">
                        Confirm Appointment
                    </button>
                </form>
            </div>
        </div>

    </div>
</x-guest-layout>
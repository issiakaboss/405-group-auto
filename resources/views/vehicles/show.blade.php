<x-guest-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

        <!-- Fil d'Ariane / Retour -->
        <div class="mb-6">
            <a href="{{ route('home') }}#catalog" class="text-xs font-semibold text-gray-500 hover:text-gray-900 transition flex items-center space-x-1">
                <span>&larr; Back to Collection</span>
            </a>
        </div>

        <!-- Grille Principale : Image à gauche, Infos à droite -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-start">

            <!-- BLOC GAUCHE : Galerie / Grande Image -->
            <!-- BLOC GAUCHE : Galerie entièrement dynamique -->
            <div class="space-y-4">

                <!-- Image Principale Dynamique -->
                <div class="bg-gray-100 rounded-2xl overflow-hidden aspect-[16/10] shadow-sm border border-gray-100">
                    <img id="main-showroom-image"
                        src="{{ $vehicle->images[0] }}"
                        alt="{{ $vehicle->title }}"
                        class="w-full h-full object-cover transition duration-300">
                </div>

                <!-- Boucle sur les miniatures réelles du véhicule -->
                <div class="grid grid-cols-4 gap-4">
                    @foreach($vehicle->images as $index => $imageUrl)
                    <div onclick="switchShowroomImage(this, '{{ $imageUrl }}')"
                        class="thumbnail-container bg-gray-100 rounded-xl overflow-hidden aspect-video border-2 {{ $index === 0 ? 'border-gray-900 opacity-100' : 'border-transparent opacity-60' }} hover:opacity-100 transition cursor-pointer">
                        <img src="{{ $imageUrl }}" class="w-full h-full object-cover">
                    </div>
                    @endforeach
                </div>

            </div>

            <!-- Script d'interactivité fluide -->
            <script>
                function switchShowroomImage(element, newImageUrl) {
                    // 1. Muter la grande image principale
                    const mainImage = document.getElementById('main-showroom-image');
                    mainImage.style.opacity = '0.3';

                    setTimeout(() => {
                        mainImage.src = newImageUrl;
                        mainImage.style.opacity = '1';
                    }, 150);

                    // 2. Réinitialiser les bordures de toutes les miniatures
                    document.querySelectorAll('.thumbnail-container').forEach(el => {
                        el.classList.remove('border-gray-900', 'opacity-100');
                        el.classList.add('border-transparent', 'opacity-60');
                    });

                    // 3. Activer la miniature cliquée
                    element.classList.remove('border-transparent', 'opacity-60');
                    element.classList.add('border-gray-900', 'opacity-100');
                }
            </script>

            <!-- BLOC DROITE : Spécifications & Achat -->
            <div class="space-y-6">
                <div>
                    <!-- Badges Logistiques Premium -->
                    <div class="mb-3 flex gap-2">
                        <span class="bg-gray-100 text-gray-800 text-[10px] uppercase font-bold px-2.5 py-1 rounded-md border border-gray-200">
                            {{ $vehicle->category }}
                        </span>
                        @if($vehicle->status === 'available_local')
                        <span class="bg-green-100 text-green-800 text-[10px] uppercase font-bold px-2.5 py-1 rounded-md border border-green-200">Stock Afrique</span>
                        @elseif($vehicle->status === 'in_transit')
                        <span class="bg-blue-100 text-blue-800 text-[10px] uppercase font-bold px-2.5 py-1 rounded-md border border-blue-200">En Mer</span>
                        @else
                        <span class="bg-amber-100 text-amber-800 text-[10px] uppercase font-bold px-2.5 py-1 rounded-md border border-amber-200">Stock USA</span>
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
                        <span class="font-semibold text-gray-900 text-sm">{{ $vehicle->transmission }}</span>
                    </div>
                    <div class="bg-gray-50 p-3.5 rounded-xl border border-gray-100">
                        <span class="block text-[11px] text-gray-400 uppercase font-medium">Fuel Type</span>
                        <span class="font-semibold text-gray-900 text-sm">{{ $vehicle->fuel_type }}</span>
                    </div>
                </div>

                <!-- Localisation exacte du transit -->
                <div class="p-4 bg-gray-50 border border-gray-100 rounded-xl flex items-center space-x-3">
                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25s-7.5-4.108-7.5-11.25a7.5 7.5 0 1 1 15 0Z" />
                    </svg>
                    <div>
                        <span class="block text-[10px] uppercase tracking-wider text-gray-400 font-medium">Current Location</span>
                        <span class="text-xs font-semibold text-gray-900">{{ $vehicle->location }}</span>
                    </div>
                </div>

                <!-- Bouton d'action principal -->
                <div class="pt-4">
                    <form action="{{ route('cart.add', $vehicle->id) }}" method="POST" class="pt-4">
                        @csrf
                        <button type="submit" class="w-full py-3.5 px-6 font-semibold text-sm text-white bg-[#0F172A] rounded-xl hover:bg-gray-800 transition shadow-md flex items-center justify-center space-x-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                            </svg>
                            <span>Add to Cart</span>
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</x-guest-layout>
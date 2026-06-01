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

    <!-- On ajoutera le reste (Why choose us, Featured Cars) juste après -->
    <div class="text-center py-12">
        <p class="text-gray-400 text-sm">Structure de base opérationnelle. Prêt pour les sections de cartes !</p>
    </div>

</x-guest-layout>
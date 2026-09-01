<x-guest-layout>
    <div class="py-12 bg-gray-50/50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- En-tête -->
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-950 tracking-tight">{{ __('public/favorites.title') }}</h1>
                <p class="text-sm text-gray-500 mt-1">{{ __('public/favorites.subtitle') }}</p>
            </div>

            <!-- État vide -->
            <div id="empty-favorites-state" class="{{ $favorites->isEmpty() ? '' : 'hidden' }} bg-white border border-gray-100 rounded-2xl p-12 text-center shadow-sm max-w-xl mx-auto mt-12">
                <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-gray-50 text-gray-400 mb-4">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                    </svg>
                </div>
                <h3 class="text-base font-semibold text-gray-900">{{ __('public/favorites.empty_title') }}</h3>
                <p class="text-xs text-gray-400 mt-1 max-w-xs mx-auto">{{ __('public/favorites.empty_desc') }}</p>
                <div class="mt-6">
                    <a href="{{ route('home') }}#catalog" class="inline-flex items-center justify-center px-4 py-2.5 bg-[#0F172A] hover:bg-gray-800 text-white font-medium text-xs rounded-xl shadow-sm transition tracking-wide uppercase">
                        {{ __('public/favorites.browse_cars') }}
                    </a>
                </div>
            </div>

            <!-- Grille des véhicules -->
            @if(!$favorites->isEmpty())
            <div id="favorites-grid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($favorites as $vehicle)
                    @php
                        $firstImage = (is_array($vehicle->images) && count($vehicle->images) > 0)
                            ? $vehicle->images[0]
                            : 'https://images.unsplash.com/photo-1503376780353-7e6692767b70?q=80&w=600';
                        $toggleUrl = route('favorites.toggle', $vehicle);
                    @endphp

                    <div id="favorite-card-{{ $vehicle->id }}" class="favorite-card bg-white border border-gray-100 rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition-all duration-300 flex flex-col group">

                        <div class="relative aspect-[16/10] bg-gray-100 overflow-hidden">
                            <img src="{{ $firstImage }}" alt="{{ $vehicle->brand }} {{ $vehicle->model }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">

                            <button type="button"
                                    onclick="removeFavorite('{{ $vehicle->id }}', '{{ $toggleUrl }}')"
                                    class="absolute top-3 right-3 p-2 rounded-full bg-white/90 backdrop-blur-sm text-red-500 hover:bg-white shadow-sm transition active:scale-90"
                                    title="{{ __('public/favorites.remove') }}">
                                <svg class="h-4 w-4 fill-current" viewBox="0 0 24 24">
                                    <path d="M11.645 20.91l-.007-.003-.022-.012a15.247 15.247 0 01-.383-.218 25.18 25.18 0 01-4.244-3.17C4.688 15.36 2.25 12.174 2.25 8.25 2.25 5.322 4.714 3 7.688 3c1.749 0 3.3.835 4.312 2.134C13.012 3.835 14.562 3 16.313 3c2.973 0 5.437 2.322 5.437 5.25 0 3.925-2.438 7.111-4.739 9.256a25.175 25.175 0 01-4.244 3.17 15.247 15.247 0 01-.383.219l-.022.012-.007.004-.003.001a.752.752 0 01-.704 0l-.003-.001z" />
                                </svg>
                            </button>
                        </div>

                        <div class="p-5 flex-1 flex flex-col justify-between">
                            <div>
                                <div class="flex items-center justify-between mb-1">
                                    <h3 class="font-bold text-gray-900 text-lg tracking-tight">
                                        {{ $vehicle->brand }} {{ $vehicle->model }}
                                    </h3>
                                    <span class="text-sm font-semibold text-gray-900">${{ number_format($vehicle->price) }}</span>
                                </div>

                                <div class="flex items-center space-x-2 text-xs text-gray-400 font-medium mb-4">
                                    <span>{{ $vehicle->year }}</span>
                                    <span>•</span>
                                    <span>{{ number_format($vehicle->mileage) }} {{ __('public/favorites.miles') }}</span>
                                    <span>•</span>
                                    <span class="capitalize">{{ $vehicle->transmission }}</span>
                                </div>
                            </div>

                            <div class="pt-2">
                                <a href="{{ route('vehicles.show', $vehicle) }}" class="w-full inline-flex items-center justify-center py-2.5 bg-gray-50 border border-gray-200 hover:bg-gray-100 text-gray-900 font-semibold text-xs rounded-xl transition">
                                    {{ __('public/favorites.view_details') }}
                                </a>
                            </div>
                        </div>

                    </div>
                @endforeach
            </div>
            @endif

        </div>
    </div>

    <script>
        function removeFavorite(vehicleId, toggleUrl) {
            fetch(toggleUrl, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => response.json())
            .then(data => {
                const card = document.getElementById(`favorite-card-${vehicleId}`);
                if (card) {
                    card.style.opacity = '0';
                    card.style.transform = 'scale(0.95)';

                    setTimeout(() => {
                        card.remove();
                        const remaining = document.querySelectorAll('.favorite-card');
                        if (remaining.length === 0) {
                            const grid = document.getElementById('favorites-grid');
                            if (grid) grid.remove();
                            document.getElementById('empty-favorites-state').classList.remove('hidden');
                        }
                    }, 300);
                }

                window.dispatchEvent(new CustomEvent('favorites-updated', {
                    detail: { count: data.count ?? 0 }
                }));
            })
            .catch(error => console.error('Erreur lors de la mise à jour des favoris:', error));
        }
    </script>
</x-guest-layout>
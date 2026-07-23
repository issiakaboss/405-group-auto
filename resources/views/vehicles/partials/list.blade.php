@forelse($vehicles as $vehicle)
    @include('vehicles.partials.card', ['vehicle' => $vehicle])
@empty
    <div class="col-span-full py-12 text-center text-gray-500">
        <svg class="mx-auto h-12 w-12 text-gray-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
        </svg>
        <p class="text-base font-semibold">No vehicles match your search criteria.</p>
        <p class="text-xs text-gray-400 mt-1">Try resetting your filters.</p>
    </div>
@endforelse
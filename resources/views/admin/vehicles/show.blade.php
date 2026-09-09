<x-app-layout>
    <div class="py-8 bg-slate-950 text-slate-100 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if(session('success'))
            <div class="mb-6 p-4 bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 text-xs font-semibold rounded-xl">
                {{ session('success') }}
            </div>
            @endif

            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
                <div>
                    <a href="{{ route('admin.vehicles.index') }}" class="text-xs font-bold text-slate-400 hover:text-white transition uppercase tracking-wider">
                        &larr; {{ __('admin/vehicles.back_to_inventory') }}
                    </a>
                    <p class="text-[10px] font-bold uppercase tracking-widest text-blue-400 mt-6">{{ __('admin/vehicles.vehicle_overview') }}</p>
                    <h1 class="text-2xl sm:text-3xl font-black text-white uppercase tracking-tight mt-1">{{ $vehicle->title }}</h1>
                </div>
                <a href="{{ route('admin.vehicles.edit', $vehicle) }}" class="inline-flex items-center justify-center px-4 py-2.5 bg-blue-600 hover:bg-blue-500 text-white font-bold text-xs rounded-xl shadow-sm transition uppercase tracking-wider">
                    {{ __('admin/vehicles.edit_vehicle_action') }}
                </a>
            </div>

            @php
            $images = is_array($vehicle->images) ? $vehicle->images : [];
            $primaryImage = $images[0] ?? asset('images/default-car.jpg');
            @endphp

            <div class="grid grid-cols-1 lg:grid-cols-5 gap-6">
                <div class="lg:col-span-3 space-y-4">
                    <div class="bg-slate-900 border border-slate-800 rounded-2xl overflow-hidden">
                        <img src="{{ $primaryImage }}" alt="{{ $vehicle->title }}" class="w-full aspect-[16/10] object-cover bg-slate-800">
                    </div>
                    @if(count($images) > 1)
                    <div>
                        <h2 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-3">{{ __('admin/vehicles.gallery') }}</h2>
                        <div class="grid grid-cols-4 sm:grid-cols-5 gap-3">
                            @foreach($images as $image)
                            <img src="{{ $image }}" alt="{{ $vehicle->title }}" class="w-full aspect-square object-cover rounded-xl border border-slate-800 bg-slate-900">
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>

                <div class="lg:col-span-2 space-y-6">
                    <div class="bg-slate-900 border border-slate-800 rounded-2xl p-6">
                        <div class="flex items-start justify-between gap-4 mb-6">
                            <div>
                                <p class="text-xs text-slate-400 uppercase tracking-wider">{{ $vehicle->make }} {{ $vehicle->model }}</p>
                                <p class="text-2xl font-black text-emerald-400 mt-2">${{ number_format($vehicle->price, 2) }}</p>
                            </div>
                            <span class="px-3 py-1.5 rounded-lg bg-blue-500/10 text-blue-300 text-[10px] font-bold uppercase tracking-wider">
                                {{ $vehicle->status?->label() ?? $vehicle->status }}
                            </span>
                        </div>
                        <dl class="grid grid-cols-2 gap-x-5 gap-y-5 text-xs">
                            <div>
                                <dt class="text-slate-500 uppercase tracking-wider">{{ __('admin/vehicles.year') }}</dt>
                                <dd class="text-white font-bold mt-1">{{ $vehicle->year }}</dd>
                            </div>
                            <div>
                                <dt class="text-slate-500 uppercase tracking-wider">{{ __('admin/vehicles.mileage_miles') }}</dt>
                                <dd class="text-white font-bold mt-1">{{ number_format($vehicle->mileage) }} mi</dd>
                            </div>
                            <div>
                                <dt class="text-slate-500 uppercase tracking-wider">{{ __('admin/vehicles.trim') }}</dt>
                                <dd class="text-white font-bold mt-1">{{ $vehicle->trim ?: '—' }}</dd>
                            </div>
                            <div>
                                <dt class="text-slate-500 uppercase tracking-wider">{{ __('admin/vehicles.location') }}</dt>
                                <dd class="text-white font-bold mt-1">{{ $vehicle->location?->label() ?? $vehicle->location }}</dd>
                            </div>
                            <div>
                                <dt class="text-slate-500 uppercase tracking-wider">{{ __('admin/vehicles.vehicle_type') }}</dt>
                                <dd class="text-white font-bold mt-1">{{ $vehicle->vehicle_type?->label() ?? $vehicle->vehicle_type }}</dd>
                            </div>
                            <div>
                                <dt class="text-slate-500 uppercase tracking-wider">{{ __('admin/vehicles.body_style') }}</dt>
                                <dd class="text-white font-bold mt-1">{{ $vehicle->body_style?->label() ?? $vehicle->body_style }}</dd>
                            </div>
                            <div>
                                <dt class="text-slate-500 uppercase tracking-wider">{{ __('admin/vehicles.exterior_color') }}</dt>
                                <dd class="text-white font-bold mt-1">{{ $vehicle->exterior_color?->label() ?? $vehicle->exterior_color }}</dd>
                            </div>
                            <div>
                                <dt class="text-slate-500 uppercase tracking-wider">{{ __('admin/vehicles.interior_color') }}</dt>
                                <dd class="text-white font-bold mt-1">{{ $vehicle->interior_color?->label() ?? $vehicle->interior_color }}</dd>
                            </div>
                            <div>
                                <dt class="text-slate-500 uppercase tracking-wider">{{ __('admin/vehicles.transmission') }}</dt>
                                <dd class="text-white font-bold mt-1">{{ $vehicle->transmission?->label() ?? $vehicle->transmission ?: '—' }}</dd>
                            </div>
                            <div>
                                <dt class="text-slate-500 uppercase tracking-wider">{{ __('admin/vehicles.fuel_type') }}</dt>
                                <dd class="text-white font-bold mt-1">{{ $vehicle->fuel_type?->label() ?? $vehicle->fuel_type ?: '—' }}</dd>
                            </div>
                        </dl>
                    </div>

                    <div class="bg-slate-900 border border-slate-800 rounded-2xl p-6">
                        <h2 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-3">{{ __('admin/vehicles.description') }}</h2>
                        <p class="text-sm text-slate-300 leading-6 whitespace-pre-line">{{ $vehicle->description ?: __('admin/vehicles.no_description') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
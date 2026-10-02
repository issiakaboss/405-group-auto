<x-app-layout>
    <div class="py-8 bg-slate-950 text-slate-100 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if(session('success'))
            <div class="mb-6 p-4 bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 text-sm rounded-xl">
                {{ session('success') }}
            </div>
            @endif

            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
                <div>
                    <h1 class="text-2xl font-black uppercase text-white">{{ __('admin/sold_vehicles.title') }}</h1>
                    <p class="mt-1 text-sm text-slate-400">{{ __('admin/sold_vehicles.subtitle') }}</p>
                </div>
                <a href="{{ route('admin.sold-vehicles.create') }}" class="inline-flex justify-center px-4 py-2.5 rounded-lg bg-amber-500 hover:bg-amber-400 text-slate-950 text-sm font-bold">
                    {{ __('admin/sold_vehicles.add_sale') }}
                </a>
            </div>

            <div class="bg-slate-900 border border-slate-800 rounded-xl overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm">
                        <thead class="bg-slate-800/70 text-xs uppercase text-slate-400">
                            <tr>
                                <th class="px-5 py-4">{{ __('admin/sold_vehicles.vehicle') }}</th>
                                <th class="px-5 py-4">{{ __('admin/sold_vehicles.sold_date') }}</th>
                                <th class="px-5 py-4">{{ __('admin/sold_vehicles.client') }}</th>
                                <th class="px-5 py-4">{{ __('admin/sold_vehicles.invoice') }}</th>
                                <th class="px-5 py-4">{{ __('admin/sold_vehicles.visibility') }}</th>
                                <th class="px-5 py-4 text-right">{{ __('admin/sold_vehicles.actions') }}</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-800 text-slate-300">
                            @forelse($soldVehicles as $soldVehicle)
                            @php
                            $vehicle = $soldVehicle->vehicle;
                            $image = $vehicle->images[0] ?? asset('images/default-car.jpg');
                            @endphp
                            <tr class="hover:bg-slate-800/40">
                                <td class="px-5 py-4">
                                    <div class="flex items-center gap-3 min-w-56">
                                        <img src="{{ $image }}" alt="{{ $vehicle->title }}" class="w-16 h-11 rounded-md object-cover bg-slate-800">
                                        <div>
                                            <p class="font-bold text-white">{{ $vehicle->make }} {{ $vehicle->model }}</p>
                                            <p class="text-xs text-slate-500">{{ $vehicle->year }} {{ $vehicle->trim }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-5 py-4 whitespace-nowrap">{{ $soldVehicle->sold_date->format('d/m/Y') }}</td>
                                <td class="px-5 py-4">
                                    <div>{{ $soldVehicle->client_name ?: '—' }}</div>
                                    @if($soldVehicle->client_phone)
                                    <div class="text-xs text-slate-500">{{ $soldVehicle->client_phone }}</div>
                                    @endif
                                </td>
                                <td class="px-5 py-4">
                                    @if($soldVehicle->invoice_path)
                                    <a href="{{ route('admin.sold-vehicles.invoice', $soldVehicle) }}" class="text-amber-400 hover:text-amber-300 font-semibold">{{ __('admin/sold_vehicles.download') }}</a>
                                    @else
                                    <span class="text-slate-500">—</span>
                                    @endif
                                </td>
                                <td class="px-5 py-4">
                                    <span class="inline-flex px-2.5 py-1 rounded-full text-xs font-bold {{ $soldVehicle->is_visible ? 'bg-emerald-500/10 text-emerald-400' : 'bg-slate-700 text-slate-400' }}">
                                        {{ $soldVehicle->is_visible ? __('admin/sold_vehicles.visible') : __('admin/sold_vehicles.hidden') }}
                                    </span>
                                </td>
                                <td class="px-5 py-4">
                                    <div class="flex justify-end items-center gap-3 whitespace-nowrap">
                                        <a href="{{ route('admin.sold-vehicles.edit', $soldVehicle) }}" class="text-blue-400 hover:text-blue-300 font-semibold">{{ __('admin/sold_vehicles.edit') }}</a>
                                        <form action="{{ route('admin.sold-vehicles.destroy', $soldVehicle) }}" method="POST" data-confirm="{{ __('admin/sold_vehicles.confirm_delete') }}" onsubmit="return confirm(this.dataset.confirm)">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-rose-400 hover:text-rose-300 font-semibold">{{ __('admin/sold_vehicles.delete') }}</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="px-5 py-12 text-center text-slate-500">{{ __('admin/sold_vehicles.empty') }}</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if($soldVehicles->hasPages())
                <div class="border-t border-slate-800 p-4">{{ $soldVehicles->links() }}</div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
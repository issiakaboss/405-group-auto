<x-app-layout>
    <div class="py-8 bg-slate-950 text-slate-100 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            @if(session('success'))
            <div class="mb-6 p-4 bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 text-xs font-semibold rounded-xl shadow-sm flex items-center space-x-2">
                <span class="h-2 w-2 rounded-full bg-emerald-500 animate-pulse"></span>
                <span>{{ session('success') }}</span>
            </div>
            @endif

            <!-- En-tête -->
            <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8 gap-4">
                <div>
                    <h1 class="text-2xl font-black text-white uppercase tracking-tight">{{ __('admin/vehicles.fleet_inventory') }}</h1>
                    <p class="text-xs text-slate-400 mt-0.5">{{ __('admin/vehicles.manage_showroom') }}</p>
                </div>
                <a href="{{ route('admin.vehicles.create') }}" class="inline-flex items-center justify-center px-4 py-2.5 bg-blue-600 hover:bg-blue-500 text-white font-bold text-xs rounded-xl shadow-sm transition tracking-wider uppercase">
                    + {{ __('admin/vehicles.add_new_vehicle') }}
                </a>
            </div>

            <!-- Cartes KPI / Statistiques -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 mb-8">
                <div class="bg-slate-900 border border-slate-800 rounded-2xl p-6 shadow-sm flex items-center justify-between">
                    <div>
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block">{{ __('admin/vehicles.total_fleet_size') }}</span>
                        <span class="text-2xl font-black text-white mt-1 block">{{ $vehicles->total() }} {{ __('admin/vehicles.vehicles') }}</span>
                    </div>
                    <div class="h-10 w-10 rounded-xl bg-slate-800 flex items-center justify-center text-slate-300">🚘</div>
                </div>
                <div class="bg-slate-900 border border-slate-800 rounded-2xl p-6 shadow-sm flex items-center justify-between">
                    <div>
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block">{{ __('admin/vehicles.estimated_catalog_value') }}</span>
                        <span class="text-2xl font-black text-white mt-1 block">${{ number_format($totalValue) }}</span>
                    </div>
                    <div class="h-10 w-10 rounded-xl bg-slate-800 flex items-center justify-center text-slate-300">💰</div>
                </div>
            </div>

            <!-- Tableau des véhicules -->
            <div class="bg-slate-900 border border-slate-800 shadow-sm rounded-2xl overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-800/60 border-b border-slate-800 text-[10px] font-bold text-slate-400 uppercase tracking-wider">
                                <th class="py-4 px-6">{{ __('admin/vehicles.vehicle_details') }}</th>
                                <th class="py-4 px-6">{{ __('admin/vehicles.specs') }}</th>
                                <th class="py-4 px-6">{{ __('admin/vehicles.location') }}</th>
                                <th class="py-4 px-6 text-right">{{ __('admin/vehicles.price') }}</th>
                                <th class="py-4 px-6">{{ __('admin/vehicles.status') }}</th>
                                <th class="py-4 px-6 text-center">{{ __('admin/vehicles.actions') }}</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-800 text-xs font-medium text-slate-300">
                            @forelse($vehicles as $vehicle)
                            <tr class="hover:bg-slate-800/40 transition">
                                <td class="py-4 px-6 flex items-center space-x-4">
                                    <img src="{{ is_array($vehicle->images) && count($vehicle->images) > 0 ? $vehicle->images[0] : asset('images/default-car.jpg') }}" class="w-14 h-10 object-cover rounded-lg bg-slate-800 border border-slate-700 flex-shrink-0">
                                    <div>
                                        <p class="font-bold text-white text-sm">{{ $vehicle->make }} {{ $vehicle->model }} {{ $vehicle->trim }}</p>
                                        <p class="text-[10px] text-slate-400 font-semibold uppercase mt-0.5">{{ $vehicle->vehicle_type }} • {{ $vehicle->year }}</p>
                                    </div>
                                </td>
                                <td class="py-4 px-6">
                                    <p class="text-slate-200">{{ number_format($vehicle->mileage) }} mi</p>
                                    <p class="text-[10px] text-slate-400 font-semibold capitalize mt-0.5">{{ $vehicle->fuel_type }} • {{ $vehicle->transmission }}</p>
                                </td>
                                <td class="py-4 px-6 text-slate-400 font-semibold">
                                    {{ $vehicle->location?->label() }}
                                </td>
                                <td class="py-4 px-6 text-right font-bold text-emerald-400 text-sm">
                                    ${{ number_format($vehicle->price) }}
                                </td>
                                <td class="py-4 px-6">
                                    <form action="{{ route('admin.vehicles.update-status', $vehicle->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <select name="status" onchange="this.form.submit()" class="text-xs font-bold rounded-lg bg-slate-800 border-slate-700 text-white focus:ring-blue-500 focus:border-blue-500">
                                            @foreach(\App\Models\Enums\VehicleStatus::cases() as $status)
                                            <option value="{{ $status->value }}" {{ ($vehicle->status?->value ?? $vehicle->status) === $status->value ? 'selected' : '' }}>
                                                {{ method_exists($status, 'label') ? $status->label() : $status->name }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </form>
                                </td>
                                <td class="py-4 px-6">
                                    <div class="flex items-center justify-center space-x-3">
                                        <a href="{{ route('admin.vehicles.edit', $vehicle) }}" class="text-blue-400 hover:text-blue-300 font-medium transition text-xs">
                                            {{ __('admin/vehicles.edit') }}
                                        </a>

                                        <form id="delete-form-{{ $vehicle->id }}" action="{{ route('admin.vehicles.destroy', $vehicle) }}" method="POST">
                                            @csrf
                                            @method('DELETE')

                                            <button type="button"
                                                onclick="requestVehicleDeletion('{{ $vehicle->id }}')"
                                                class="p-2 text-rose-400 hover:text-rose-300 hover:bg-rose-500/10 rounded-xl transition flex items-center gap-1"
                                                title="{{ __('admin/vehicles.delete_vehicle') }}">
                                                🗑️ {{ __('admin/vehicles.delete') }}
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="py-12 text-center text-slate-500 font-semibold">
                                    {{ __('admin/vehicles.no_vehicles') }}
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($vehicles->hasPages())
                <div class="p-4 bg-slate-900 border-t border-slate-800">
                    {{ $vehicles->links() }}
                </div>
                @endif
            </div>

        </div>
    </div>

    <!-- Modal de confirmation -->
    <x-confirm-modal
        name="delete-vehicle-modal"
        :title="__('admin/vehicles.modal_delete_title')"
        :message="__('admin/vehicles.modal_delete_message')"
        :confirmText="__('admin/vehicles.confirm_delete')"
        :cancelText="__('admin/vehicles.cancel')"
        type="danger" />

    <script>
        function requestVehicleDeletion(vehicleId) {
            window.dispatchEvent(new CustomEvent('open-modal-delete-vehicle-modal', {
                detail: { vehicleId: vehicleId }
            }));
        }

        document.addEventListener('DOMContentLoaded', function() {
            window.addEventListener('confirmed-delete-vehicle-modal', function(event) {
                if (event.detail && event.detail.vehicleId) {
                    const form = document.getElementById(`delete-form-${event.detail.vehicleId}`);
                    if (form) {
                        form.submit();
                    }
                }
            });
        });
    </script>
</x-app-layout>
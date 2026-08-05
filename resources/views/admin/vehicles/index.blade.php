<x-app-layout>
    <div class="py-12 bg-gray-50/50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            @if(session('success'))
            <div class="mb-6 p-4 bg-emerald-50 border border-emerald-100 text-emerald-800 text-xs font-semibold rounded-xl shadow-sm flex items-center space-x-2">
                <span class="h-2 w-2 rounded-full bg-emerald-500 animate-pulse"></span>
                <span>{{ session('success') }}</span>
            </div>
            @endif

            <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8 gap-4">
                <div>
                    <h1 class="text-2xl font-black text-gray-950 uppercase tracking-tight">Fleet Inventory</h1>
                    <p class="text-xs text-gray-500 mt-0.5">Manage and monitor 405 Group Auto catalog showroom.</p>
                </div>
                <a href="{{ route('admin.vehicles.create') }}" class="inline-flex items-center justify-center px-4 py-2.5 bg-gray-950 hover:bg-gray-800 text-white font-bold text-xs rounded-xl shadow-sm transition tracking-wider uppercase">
                    + Add New Vehicle
                </a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 mb-8">
                <div class="bg-white border border-gray-100 rounded-2xl p-6 shadow-sm flex items-center justify-between">
                    <div>
                        <span class="text-[10px] font-bold text-gray-400 uppercase tracking-wider block">Total Fleet Size</span>
                        <span class="text-2xl font-black text-gray-950 mt-1 block">{{ $vehicles->total() }} Cars</span>
                    </div>
                    <div class="h-10 w-10 rounded-xl bg-gray-50 flex items-center justify-center text-gray-400">🚘</div>
                </div>
                <div class="bg-white border border-gray-100 rounded-2xl p-6 shadow-sm flex items-center justify-between">
                    <div>
                        <span class="text-[10px] font-bold text-gray-400 uppercase tracking-wider block">Estimated Catalog Value</span>
                        <span class="text-2xl font-black text-gray-950 mt-1 block">${{ number_format($totalValue) }}</span>
                    </div>
                    <div class="h-10 w-10 rounded-xl bg-gray-50 flex items-center justify-center text-gray-400">💰</div>
                </div>
            </div>

            <div class="bg-white border border-gray-100 shadow-sm rounded-2xl overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-50 border-b border-gray-100 text-[10px] font-bold text-gray-400 uppercase tracking-wider">
                                <th class="py-4 px-6">Vehicle Details</th>
                                <th class="py-4 px-6">Specs</th>
                                <th class="py-4 px-6">Location</th>
                                <th class="py-4 px-6 text-right">Price</th>
                                <th class="py-4 px-6">Status</th>
                                <th class="py-4 px-6 text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 text-xs font-medium text-gray-700">
                            @forelse($vehicles as $vehicle)
                            <tr class="hover:bg-gray-50/70 transition">
                                <td class="py-4 px-6 flex items-center space-x-4">
                                    <img src="{{ is_array($vehicle->images) && count($vehicle->images) > 0 ? $vehicle->images[0] : asset('images/default-car.jpg') }}" class="w-14 h-10 object-cover rounded-lg bg-gray-50 border border-gray-100 flex-shrink-0">
                                    <div>
                                        <p class="font-bold text-gray-950 text-sm">{{ $vehicle->make }} {{ $vehicle->model }} {{ $vehicle->trim }}</p>
                                        <p class="text-[10px] text-gray-400 font-semibold uppercase mt-0.5">{{ $vehicle->vehicle_type }} • {{ $vehicle->year }}</p>
                                    </div>
                                </td>
                                <td class="py-4 px-6">
                                    <p class="text-gray-900">{{ number_format($vehicle->mileage) }} mi</p>
                                    <p class="text-[10px] text-gray-400 font-semibold capitalize mt-0.5">{{ $vehicle->fuel_type }} • {{ $vehicle->transmission }}</p>
                                </td>
                                <td class="py-4 px-6 text-gray-500 font-semibold">
                                    {{ $vehicle->location }}
                                </td>
                                <td class="py-4 px-6 text-right font-bold text-gray-950 text-sm">
                                    ${{ number_format($vehicle->price) }}
                                </td>
                                <td class="py-4 px-6">
                                    <form action="{{ route('admin.vehicles.update-status', $vehicle->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <select name="status" onchange="this.form.submit()" class="text-xs font-bold rounded-lg border-gray-200">
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
                                        <a href="{{ route('admin.vehicles.edit', $vehicle) }}" class="text-blue-600 hover:text-blue-900 font-medium transition text-xs">
                                            Edit
                                        </a>

                                        <!-- Formulaire de suppression avec ID dynamique -->
                                        <form id="delete-form-{{ $vehicle->id }}" action="{{ route('admin.vehicles.destroy', $vehicle) }}" method="POST">
                                            @csrf
                                            @method('DELETE')

                                            <button type="button"
                                                onclick="requestVehicleDeletion('{{ $vehicle->id }}')"
                                                class="p-2 text-red-500 hover:bg-red-50 rounded-xl transition"
                                                title="Delete Car">
                                                🗑️ Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="py-12 text-center text-gray-400 font-semibold">
                                    No vehicles found in showroom inventory. Click "+ Add New Vehicle" to start.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($vehicles->hasPages())
                <div class="p-4 bg-gray-50 border-t border-gray-100">
                    {{ $vehicles->links() }}
                </div>
                @endif
            </div>

        </div>
    </div>

    <!-- Modal de confirmation de suppression -->
    <x-confirm-modal
        name="delete-vehicle-modal"
        title="Delete Vehicle?"
        message="Are you sure you want to delete this vehicle from the inventory? This action cannot be undone."
        confirmText="Yes, Delete"
        cancelText="Cancel"
        type="danger" />

    <script>
        function requestVehicleDeletion(vehicleId) {
            window.dispatchEvent(new CustomEvent('open-modal-delete-vehicle-modal', {
                detail: {
                    vehicleId
                }
            }));
        }

        window.addEventListener('confirmed-delete-vehicle-modal', function(event) {
            const vehicleId = event.detail.vehicleId;
            const form = document.getElementById(`delete-form-${vehicleId}`);

            if (form) {
                form.submit();
            }
        });
    </script>
</x-app-layout>
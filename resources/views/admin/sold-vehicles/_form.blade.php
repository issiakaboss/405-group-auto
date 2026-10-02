@php
$soldVehicle = $soldVehicle ?? null;
@endphp

<div>
    <label for="vehicle_id" class="block mb-1.5 text-sm font-semibold text-slate-300">{{ __('admin/sold_vehicles.vehicle') }}</label>
    <select id="vehicle_id" name="vehicle_id" required class="w-full rounded-lg border-slate-700 bg-slate-800 text-white focus:border-amber-500 focus:ring-amber-500">
        <option value="">{{ __('admin/sold_vehicles.select_vehicle') }}</option>
        @foreach($vehicles as $vehicle)
        <option value="{{ $vehicle->id }}" @selected((string) old('vehicle_id', $soldVehicle?->vehicle_id) === (string) $vehicle->id)>
            {{ $vehicle->make }} {{ $vehicle->model }} {{ $vehicle->trim }} ({{ $vehicle->year }})
        </option>
        @endforeach
    </select>
    @error('vehicle_id') <p class="mt-1 text-xs text-rose-400">{{ $message }}</p> @enderror
</div>

<div class="grid sm:grid-cols-2 gap-4">
    <div>
        <label for="sold_date" class="block mb-1.5 text-sm font-semibold text-slate-300">{{ __('admin/sold_vehicles.sold_date') }}</label>
        <input id="sold_date" type="date" name="sold_date" value="{{ old('sold_date', $soldVehicle?->sold_date?->format('Y-m-d')) }}" required class="w-full rounded-lg border-slate-700 bg-slate-800 text-white focus:border-amber-500 focus:ring-amber-500">
        @error('sold_date') <p class="mt-1 text-xs text-rose-400">{{ $message }}</p> @enderror
    </div>
    <div>
        <label for="client_name" class="block mb-1.5 text-sm font-semibold text-slate-300">{{ __('admin/sold_vehicles.client_name') }}</label>
        <input id="client_name" type="text" name="client_name" value="{{ old('client_name', $soldVehicle?->client_name) }}" maxlength="255" class="w-full rounded-lg border-slate-700 bg-slate-800 text-white focus:border-amber-500 focus:ring-amber-500">
        @error('client_name') <p class="mt-1 text-xs text-rose-400">{{ $message }}</p> @enderror
    </div>
</div>

<div>
    <label for="client_phone" class="block mb-1.5 text-sm font-semibold text-slate-300">{{ __('admin/sold_vehicles.client_phone') }}</label>
    <input id="client_phone" type="tel" name="client_phone" value="{{ old('client_phone', $soldVehicle?->client_phone) }}" maxlength="50" class="w-full rounded-lg border-slate-700 bg-slate-800 text-white focus:border-amber-500 focus:ring-amber-500">
    @error('client_phone') <p class="mt-1 text-xs text-rose-400">{{ $message }}</p> @enderror
</div>

<div>
    <label for="invoice" class="block mb-1.5 text-sm font-semibold text-slate-300">{{ __('admin/sold_vehicles.invoice_upload') }}</label>
    <input id="invoice" type="file" name="invoice" accept=".pdf,.jpg,.jpeg,.png,.webp" class="block w-full text-sm text-slate-300 file:mr-4 file:rounded-md file:border-0 file:bg-slate-700 file:px-3 file:py-2 file:text-white">
    @error('invoice') <p class="mt-1 text-xs text-rose-400">{{ $message }}</p> @enderror
    @if($soldVehicle?->invoice_path)
    <div class="mt-3 flex items-center gap-3 text-sm">
        <a href="{{ route('admin.sold-vehicles.invoice', $soldVehicle) }}" class="text-amber-400 hover:text-amber-300">{{ __('admin/sold_vehicles.current_invoice') }}</a>
        <label class="inline-flex items-center gap-2 text-slate-400">
            <input type="checkbox" name="remove_invoice" value="1" class="rounded border-slate-600 bg-slate-800 text-amber-500 focus:ring-amber-500">
            {{ __('admin/sold_vehicles.remove_invoice') }}
        </label>
    </div>
    @endif
</div>

<div>
    <input type="hidden" name="is_visible" value="0">
    <label class="inline-flex items-center gap-3 text-sm font-semibold text-slate-300">
        <input type="checkbox" name="is_visible" value="1" @checked((bool) old('is_visible', $soldVehicle?->is_visible ?? true)) class="rounded border-slate-600 bg-slate-800 text-amber-500 focus:ring-amber-500">
        {{ __('admin/sold_vehicles.show_on_homepage') }}
    </label>
    @error('is_visible') <p class="mt-1 text-xs text-rose-400">{{ $message }}</p> @enderror
</div>
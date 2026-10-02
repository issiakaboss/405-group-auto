<x-app-layout>
    <div class="py-10 bg-slate-950 text-slate-100 min-h-screen">
        <div class="max-w-3xl mx-auto px-4 sm:px-6">
            <a href="{{ route('admin.sold-vehicles.index') }}" class="text-sm text-slate-400 hover:text-white">← {{ __('admin/sold_vehicles.back_to_history') }}</a>
            <div class="mt-5 rounded-xl border border-slate-800 bg-slate-900 p-6 sm:p-8">
                <h1 class="text-2xl font-black text-white">{{ __('admin/sold_vehicles.edit_title') }}</h1>
                <form action="{{ route('admin.sold-vehicles.update', $soldVehicle) }}" method="POST" enctype="multipart/form-data" class="mt-6 space-y-5">
                    @csrf
                    @method('PUT')
                    @include('admin.sold-vehicles._form', ['soldVehicle' => $soldVehicle])
                    <div class="flex justify-end gap-3 pt-2">
                        <a href="{{ route('admin.sold-vehicles.index') }}" class="px-4 py-2.5 rounded-lg bg-slate-800 text-slate-300 font-semibold">{{ __('admin/sold_vehicles.cancel') }}</a>
                        <button type="submit" class="px-4 py-2.5 rounded-lg bg-amber-500 hover:bg-amber-400 text-slate-950 font-bold">{{ __('admin/sold_vehicles.save_changes') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
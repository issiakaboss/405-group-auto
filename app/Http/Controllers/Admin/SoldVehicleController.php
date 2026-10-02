<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SoldVehicle;
use App\Models\Vehicle;
use Illuminate\Filesystem\FilesystemAdapter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SoldVehicleController extends Controller
{
    public function index()
    {
        $soldVehicles = SoldVehicle::with('vehicle')
            ->latest('sold_date')
            ->paginate(15);

        return view('admin.sold-vehicles.index', compact('soldVehicles'));
    }

    public function create()
    {
        $vehicles = Vehicle::orderBy('make')->orderBy('model')->get();

        return view('admin.sold-vehicles.create', compact('vehicles'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate($this->rules());
        $validated['invoice_path'] = $request->file('invoice')?->store('invoices', 'local');
        unset($validated['invoice'], $validated['remove_invoice']);

        SoldVehicle::create($validated);

        return redirect()->route('admin.sold-vehicles.index')
            ->with('success', __('admin/sold_vehicles.created'));
    }

    public function edit(SoldVehicle $soldVehicle)
    {
        $vehicles = Vehicle::orderBy('make')->orderBy('model')->get();

        return view('admin.sold-vehicles.edit', compact('soldVehicle', 'vehicles'));
    }

    public function update(Request $request, SoldVehicle $soldVehicle)
    {
        $validated = $request->validate($this->rules());
        $oldInvoicePath = $soldVehicle->invoice_path;
        $newInvoicePath = $request->file('invoice')?->store('invoices', 'local');

        if ($newInvoicePath) {
            $validated['invoice_path'] = $newInvoicePath;
        } elseif ($request->boolean('remove_invoice')) {
            $validated['invoice_path'] = null;
        }

        unset($validated['invoice'], $validated['remove_invoice']);
        $soldVehicle->update($validated);

        if ($oldInvoicePath && $oldInvoicePath !== $soldVehicle->invoice_path) {
            Storage::disk('local')->delete($oldInvoicePath);
        }

        return redirect()->route('admin.sold-vehicles.index')
            ->with('success', __('admin/sold_vehicles.updated'));
    }

    public function destroy(SoldVehicle $soldVehicle)
    {
        $soldVehicle->delete();

        return redirect()->route('admin.sold-vehicles.index')
            ->with('success', __('admin/sold_vehicles.deleted'));
    }

    public function downloadInvoice(SoldVehicle $soldVehicle)
    {
        abort_unless(
            $soldVehicle->invoice_path && Storage::disk('local')->exists($soldVehicle->invoice_path),
            404
        );

        /** @var FilesystemAdapter $disk */
        $disk = Storage::disk('local');

        return $disk->download($soldVehicle->invoice_path);
    }

    private function rules(): array
    {
        return [
            'vehicle_id' => ['required', 'integer', 'exists:vehicles,id'],
            'sold_date' => ['required', 'date'],
            'client_name' => ['nullable', 'string', 'max:255'],
            'client_phone' => ['nullable', 'string', 'max:50'],
            'invoice' => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png,webp', 'max:10240'],
            'is_visible' => ['required', 'boolean'],
            'remove_invoice' => ['nullable', 'boolean'],
        ];
    }
}

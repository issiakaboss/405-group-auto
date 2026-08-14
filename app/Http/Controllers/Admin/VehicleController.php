<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Format;
use App\Models\Enums\VehicleStatus;
use Illuminate\Validation\Rule;

class VehicleController extends Controller
{
    public function index()
    {
        $vehicles = Vehicle::latest()->paginate(10);
        $totalCars = Vehicle::count();
        $totalValue = Vehicle::sum('price');

        return view('admin.vehicles.index', compact('vehicles', 'totalCars', 'totalValue'));
    }

    public function create()
    {
        return view('admin.vehicles.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'make' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'trim' => 'nullable|string|max:255',
            'price' => 'required|numeric|min:0',
            'year' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'mileage' => 'required|integer|min:0',
            'vehicle_type' => 'required|string',
            'body_style' => 'required|string',
            'exterior_color' => 'required|string',
            'interior_color' => 'required|string',
            'transmission' => 'nullable|string',
            'fuel_type' => 'nullable|string',
            'location' => 'required|string|max:255',
            'has_clean_title' => 'nullable|boolean',
            'money_still_owed' => 'nullable|string',
            'description' => 'nullable|string',
            'images' => 'required',
            'images.*' => 'image|mimes:jpeg,png,jpg,webp|max:5120',
        ]);

        $uploadedImages = [];

        if ($request->hasFile('images')) {
            $manager = ImageManager::usingDriver(Driver::class);
            foreach ($request->file('images') as $file) {
                $filename = uniqid() . '.webp';
                $image = $manager->decodePath($file->getRealPath());
                $image->scale(width: 800);
                $encoded = $image->encodeUsingFormat(Format::WEBP, quality: 80);
                Storage::disk('public')->put('vehicles/' . $filename, $encoded->toString());
                $uploadedImages[] = '/storage/vehicles/' . $filename;
            }
        }

        Vehicle::create([
            'make' => $request->make,
            'model' => $request->model,
            'trim' => $request->trim,
            'title' => trim(sprintf('%s %s %s', $request->make, $request->model, $request->trim ?: '')),
            'price' => $request->price,
            'year' => $request->year,
            'mileage' => $request->mileage,
            'vehicle_type' => $request->vehicle_type,
            'body_style' => $request->body_style,
            'exterior_color' => $request->exterior_color,
            'interior_color' => $request->interior_color,
            'fuel_type' => $request->fuel_type,
            'transmission' => $request->transmission,
            'has_clean_title' => $request->boolean('has_clean_title'),
            'money_still_owed' => $request->money_still_owed,
            'description' => $request->description,
            'location' => $request->location,
            'status' => $request->status ?? VehicleStatus::AVAILABLE,
            'is_featured' => $request->boolean('is_featured'),
            'images' => $uploadedImages,
        ]);

        return redirect()->route('admin.vehicles.index')->with('success', 'Vehicle added to inventory successfully!');
    }

    public function edit(Vehicle $vehicle)
    {
        return view('admin.vehicles.edit', compact('vehicle'));
    }

    public function update(Request $request, Vehicle $vehicle)
    {
        $validated = $request->validate([
            'make' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'trim' => 'nullable|string|max:255',
            'price' => 'required|numeric|min:0',
            'year' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'mileage' => 'required|integer|min:0',
            'vehicle_type' => 'required|string',
            'body_style' => 'required|string',
            'exterior_color' => 'required|string',
            'interior_color' => 'required|string',
            'transmission' => 'nullable|string',
            'fuel_type' => 'nullable|string',
            'location' => 'required|string|max:255',
            'has_clean_title' => 'nullable|boolean',
            'money_still_owed' => 'nullable|string',
            'description' => 'nullable|string',
            'images.*' => 'image|mimes:jpeg,png,jpg,webp|max:5120',
            'deleted_images' => 'nullable|array',
        ]);

        $currentImages = is_array($vehicle->images) ? $vehicle->images : [];

        if ($request->has('deleted_images')) {
            foreach ($request->deleted_images as $imageToDelete) {
                $relativePath = str_replace('/storage/', '', $imageToDelete);
                Storage::disk('public')->delete($relativePath);
                $currentImages = array_filter($currentImages, function ($path) use ($imageToDelete) {
                    return $path !== $imageToDelete;
                });
            }
        }

        if ($request->hasFile('images')) {
            $manager = ImageManager::usingDriver(Driver::class);

            foreach ($request->file('images') as $file) {
                $filename = uniqid() . '.webp';
                $image = $manager->decodePath($file->getRealPath());
                $image->scale(width: 800);
                $encoded = $image->encodeUsingFormat(Format::WEBP, quality: 80);
                Storage::disk('public')->put('vehicles/' . $filename, $encoded->toString());
                $currentImages[] = '/storage/vehicles/' . $filename;
            }
        }

        $vehicle->update([
            'make' => $request->make,
            'model' => $request->model,
            'trim' => $request->trim,
            'title' => trim(sprintf('%s %s %s', $request->make, $request->model, $request->trim ?: '')),
            'price' => $request->price,
            'year' => $request->year,
            'mileage' => $request->mileage,
            'vehicle_type' => $request->vehicle_type,
            'body_style' => $request->body_style,
            'exterior_color' => $request->exterior_color,
            'interior_color' => $request->interior_color,
            'transmission' => $request->transmission,
            'fuel_type' => $request->fuel_type,
            'has_clean_title' => $request->boolean('has_clean_title'),
            'money_still_owed' => $request->money_still_owed,
            'description' => $request->description,
            'location' => $request->location,
            'status' => $request->status ?? $vehicle->status,
            'is_featured' => $request->boolean('is_featured'),
            'images' => array_values($currentImages),
        ]);

        return redirect()->route('admin.vehicles.index')->with('success', 'Vehicle updated successfully!');
    }
    public function updateStatus(Request $request, Vehicle $vehicle)
    {
        $validated = $request->validate([
            'status' => ['required', Rule::enum(VehicleStatus::class)],
        ]);

        $vehicle->update([
            'status' => $validated['status'],
        ]);

        return back()->with('success', 'Vehicle status updated successfully!');
    }
    public function destroy(Vehicle $vehicle)
    {
        if (is_array($vehicle->images)) {
            foreach ($vehicle->images as $path) {
                $relativePath = str_replace('/storage/', '', $path);
                Storage::disk('public')->delete($relativePath);
            }
        }

        $vehicle->delete();

        return redirect()->route('admin.vehicles.index')->with('success', 'Vehicle removed from inventory.');
    }
}

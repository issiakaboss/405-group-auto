<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Format;

class VehicleController extends Controller
{
    // Liste des véhicules pour l'admin
    public function index()
    {
        $vehicles = Vehicle::latest()->paginate(10);

        // Petites stats rapides pour le tableau de bord
        $totalCars = Vehicle::count();
        $totalValue = Vehicle::sum('price');

        // ⚙️ CORRECTION : On passe les noms sous forme de chaînes de caractères
        return view('admin.vehicles.index', compact('vehicles', 'totalCars', 'totalValue'));
    }

    // Formulaire de création
    public function create()
    {
        return view('admin.vehicles.create');
    }

    // Enregistrement d'un nouveau véhicule
    public function store(Request $request)
    {
        $request->validate([
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'year' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'mileage' => 'required|integer|min:0',
            'transmission' => 'required|string',
            'fuel_type' => 'required|string',
            'category' => 'required|string',
            'location' => 'required|string',
            'images' => 'required',
            'images.*' => 'image|mimes:jpeg,png,jpg,webp|max:5120', // Max 5MB par image
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
            'brand' => $request->brand,
            'model' => $request->model,
            'title' => $request->brand . ' ' . $request->model,
            'price' => $request->price,
            'year' => $request->year,
            'mileage' => $request->mileage,
            'transmission' => $request->transmission,
            'fuel_type' => $request->fuel_type,
            'category' => $request->category,
            'location' => $request->location,
            'images' => $uploadedImages, // Casté en JSON automatiquement par le modèle
        ]);

        return redirect()->route('admin.vehicles.index')->with('success', 'Vehicle added to inventory successfully!');
    }

    // Formulaire d'édition
    public function edit(Vehicle $vehicle)
    {
        return view('admin.vehicles.edit', compact('vehicle'));
    }

    // Mise à jour en Base de Données
    public function update(Request $request, Vehicle $vehicle)
    {
        $request->validate([
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'year' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'mileage' => 'required|integer|min:0',
            'transmission' => 'required|string',
            'fuel_type' => 'required|string',
            'category' => 'required|string',
            'location' => 'required|string',
            'images.*' => 'image|mimes:jpeg,png,jpg,webp|max:5120',
            'deleted_images' => 'nullable|array',
        ]);

        // 1. On récupère le tableau d'images actuelles
        $currentImages = is_array($vehicle->images) ? $vehicle->images : [];

        // 2. Traiter les suppressions ciblées
        if ($request->has('deleted_images')) {
            foreach ($request->deleted_images as $imageToDelete) {
                $relativePath = str_replace('/storage/', '', $imageToDelete);
                Storage::disk('public')->delete($relativePath);
                $currentImages = array_filter($currentImages, function ($path) use ($imageToDelete) {
                    return $path !== $imageToDelete;
                });
            }
        }

        // 3. Traiter les nouvelles images ajoutées (conservées + nouvelles)
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

        // 4. Mise à jour en BDD avec réindexation propre du tableau d'images
        $vehicle->update([
            'brand' => $request->brand,
            'model' => $request->model,
            'title' => $request->brand . ' ' . $request->model,
            'price' => $request->price,
            'year' => $request->year,
            'mileage' => $request->mileage,
            'transmission' => $request->transmission,
            'fuel_type' => $request->fuel_type,
            'category' => $request->category,
            'location' => $request->location,
            'images' => array_values($currentImages),
        ]);

        return redirect()->route('admin.vehicles.index')->with('success', 'Vehicle updated successfully!');
    }

    // Changement de statut rapide depuis la liste
    public function updateStatus(Request $request, Vehicle $vehicle)
    {
        $request->validate([
            'status' => 'required|string', // Ou validation via ton Enum
        ]);
        $vehicle->update(['status' => $request->status]);

        return back()->with('success', 'Vehicle status updated successfully!');
    }

    // Supprimer un véhicule
    public function destroy(Vehicle $vehicle)
    {
        // Supprimer physiquement les images du serveur pour ne pas saturer l'espace
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

<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    // Affiche la page d'accueil
    public function index()
    {
        $featuredVehicles = Vehicle::where('is_featured', true)->take(3)->get();
        $latestVehicles = Vehicle::where('is_featured', false)->orderBy('year', 'desc')->take(3)->get();
        $allVehicles = Vehicle::all();

        return view('welcome', compact('featuredVehicles', 'latestVehicles', 'allVehicles'));
    }

    // Affiche les détails d'un véhicule spécifique
    public function show(Vehicle $vehicle)
    {
        return view('vehicles.show', compact('vehicle'));
    }

    public function search(Request $request)
    {
        $query = $request->get('q');

        if (empty($query)) {
            return response()->json([]);
        }

        $vehicles = Vehicle::where('title', 'LIKE', "%{$query}%")
            ->orWhere('brand', 'LIKE', "%{$query}%")
            ->take(5)
            ->get()
            ->map(function ($vehicle) {
                // Récupérer la première URL du tableau JSON
                $imageUrl = 'https://images.unsplash.com/photo-1503376780353-7e6692767b70?q=80&w=400'; // Par défaut

                if (is_array($vehicle->images) && count($vehicle->images) > 0) {
                    $imageUrl = $vehicle->images[0]; // C'est directement l'URL HTTP de ta BDD
                }

                return [
                    'id' => $vehicle->id,
                    'title' => $vehicle->brand . ' ' . $vehicle->model, // Exemple: Porsche 911 GT3
                    'year' => $vehicle->year,
                    'price' => $vehicle->price,
                    'image' => $imageUrl,
                ];
            });

        return response()->json($vehicles);
    }
}

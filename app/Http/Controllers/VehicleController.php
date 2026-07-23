<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    public function index()
    {
        $featuredVehicles = Vehicle::where('is_featured', true)->take(3)->get();
        $latestVehicles = Vehicle::where('is_featured', false)->orderBy('year', 'desc')->take(3)->get();
        $allVehicles = Vehicle::all();

        // Récupérer les options uniques pour alimenter les listes déroulantes de filtres
        $brands = Vehicle::select('brand')->distinct()->pluck('brand');
        $categories = Vehicle::select('category')->distinct()->pluck('category');
        $fuelTypes = Vehicle::select('fuel_type')->whereNotNull('fuel_type')->distinct()->pluck('fuel_type');
        $transmissions = Vehicle::select('transmission')->whereNotNull('transmission')->distinct()->pluck('transmission');

        return view('welcome', compact(
            'featuredVehicles', 
            'latestVehicles', 
            'allVehicles', 
            'brands', 
            'categories', 
            'fuelTypes', 
            'transmissions'
        ));
    }

    public function filter(Request $request)
    {
        $query = Vehicle::query();

        // Filtrage par texte (recherche)
        if ($request->filled('search')) {
            $search = $request->get('search');
            $query->where(function ($q) use ($search) {
                $q->where('title', 'LIKE', "%{$search}%")
                  ->orWhere('brand', 'LIKE', "%{$search}%")
                  ->orWhere('model', 'LIKE', "%{$search}%");
            });
        }

        // Marque
        if ($request->filled('brand')) {
            $query->where('brand', $request->get('brand'));
        }

        // Catégorie
        if ($request->filled('category')) {
            $query->where('category', $request->get('category'));
        }

        // Type de carburant
        if ($request->filled('fuel_type')) {
            $query->where('fuel_type', $request->get('fuel_type'));
        }

        // Transmission
        if ($request->filled('transmission')) {
            $query->where('transmission', $request->get('transmission'));
        }

        // Prix min / max
        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->get('min_price'));
        }
        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->get('max_price'));
        }

        // Tri (Sort)
        match ($request->get('sort')) {
            'price_asc' => $query->orderBy('price', 'asc'),
            'price_desc' => $query->orderBy('price', 'desc'),
            'year_desc' => $query->orderBy('year', 'desc'),
            'mileage_asc' => $query->orderBy('mileage', 'asc'),
            default => $query->latest(),
        };

        $vehicles = $query->get();

        if ($request->ajax()) {
            return response()->json([
                'html' => view('vehicles.partials.list', compact('vehicles'))->render(),
                'count' => $vehicles->count()
            ]);
        }

        return redirect()->route('home');
    }

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
                $imageUrl = 'https://images.unsplash.com/photo-1503376780353-7e6692767b70?q=80&w=400';

                if (is_array($vehicle->images) && count($vehicle->images) > 0) {
                    $imageUrl = $vehicle->images[0];
                }

                return [
                    'id' => $vehicle->id,
                    'title' => $vehicle->brand . ' ' . $vehicle->model,
                    'year' => $vehicle->year,
                    'price' => $vehicle->price,
                    'image' => $imageUrl,
                ];
            });

        return response()->json($vehicles);
    }
}
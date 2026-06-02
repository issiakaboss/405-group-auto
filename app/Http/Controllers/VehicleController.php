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
}
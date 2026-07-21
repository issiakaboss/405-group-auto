<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function index()
    {
        // 1. Récupérer le tableau des favoris de la session
        $sessionFavorites = session()->get('favorites', []);

        // 2. Extraire uniquement les IDs des véhicules
        $favoriteIds = array_keys($sessionFavorites);

        // 3. Charger les vrais objets Vehicle depuis la BDD
        $favorites = Vehicle::whereIn('id', $favoriteIds)->get();

        // 4. Envoyer la collection Eloquent à la vue favorites.index
        return view('favorites.index', compact('favorites'));
    }

    public function toggle(Vehicle $vehicle)
    {
        $favorites = session()->get('favorites', []);

        if (isset($favorites[$vehicle->id])) {
            unset($favorites[$vehicle->id]);
            $msg = 'Vehicle removed from favorites.';
        } else {
            // On stocke les infos essentielles en session avec la même sécurité d'image que le panier
            $favorites[$vehicle->id] = [
                'id' => $vehicle->id,
                'title' => $vehicle->title,
                'price' => $vehicle->price,
                'image' => $vehicle->images[0] ?? 'default.jpg', // Sécurité si le tableau d'images est vide
                'year' => $vehicle->year,
            ];
            $msg = 'Vehicle added to favorites!';
        }

        session()->put('favorites', $favorites);

        return redirect()->back()->with('success', $msg);
    }
}

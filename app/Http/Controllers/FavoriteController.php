<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function index()
    {
        $sessionFavorites = session()->get('favorites', []);
        $favoriteIds = array_keys($sessionFavorites);
        $favorites = Vehicle::whereIn('id', $favoriteIds)->get();

        return view('favorites.index', compact('favorites'));
    }

    public function toggle(Request $request, Vehicle $vehicle)
    {
        $favorites = session()->get('favorites', []);
        $isFavorite = false;

        if (isset($favorites[$vehicle->id])) {
            unset($favorites[$vehicle->id]);
            $msg = 'Vehicle removed from favorites.';
        } else {
            $favorites[$vehicle->id] = [
                'id' => $vehicle->id,
                'title' => $vehicle->title,
                'price' => $vehicle->price,
                'image' => $vehicle->images[0] ?? 'default.jpg',
                'year' => $vehicle->year,
            ];
            $msg = 'Vehicle added to favorites!';
            $isFavorite = true;
        }

        session()->put('favorites', $favorites);

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => $msg,
                'is_favorite' => $isFavorite,
                'favorites_count' => count($favorites)
            ]);
        }

        return redirect()->back()->with('success', $msg);
    }
}
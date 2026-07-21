<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\DB;

class SyncCartOnLogin
{
    public function handle(Login $event): void
    {
        $user = $event->user;
        $sessionCart = session()->get('cart', []);

        if (!empty($sessionCart)) {
            foreach ($sessionCart as $vehicleId => $item) {
                // Insérer ou mettre à jour dans la table carts
                DB::table('carts')->updateOrInsert(
                    ['user_id' => $user->id, 'vehicle_id' => $vehicleId],
                    ['quantity' => $item['quantity'], 'updated_at' => now()]
                );
            }

            // Recharger tout le panier depuis la DB pour fusionner les anciennes sauvegardes
            $dbCart = DB::table('carts')
                ->join('vehicles', 'carts.vehicle_id', '=', 'vehicles.id')
                ->where('user_id', $user->id)
                ->select('vehicles.*', 'carts.quantity')
                ->get();

            $newSessionCart = [];
            foreach ($dbCart as $car) {
                $images = json_decode($car->images, true);
                $newSessionCart[$car->id] = [
                    "id" => $car->id,
                    "title" => $car->title,
                    "price" => $car->price,
                    "image" => $images[0] ?? '',
                    "year" => $car->year,
                    "category" => $car->category,
                    "location" => $car->location,
                    "quantity" => $car->quantity,
                ];
            }
            session()->put('cart', $newSessionCart);
        }
    }
}

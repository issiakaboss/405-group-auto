<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;

class CartController extends Controller
{
    // Afficher le contenu du panier
    public function index()
    {
        $cart = session()->get('cart', []);

        // Calcul du prix total
        $total = array_sum(array_column($cart, 'price'));

        return view('cart.index', compact('cart', 'total'));
    }

    // Ajouter un véhicule au panier
    public function add(Vehicle $vehicle)
    {
        $cart = session()->get('cart', []);

        // Si le véhicule n'est pas déjà dans le panier, on l'ajoute
        if (!isset($cart[$vehicle->id])) {
            $cart[$vehicle->id] = [
                "id" => $vehicle->id,
                "title" => $vehicle->title,
                "price" => $vehicle->price,
                "image" => $vehicle->images[0], // Première image du JSON
                "year" => $vehicle->year,
                "category" => $vehicle->category,
                "location" => $vehicle->location,
                "mileage" => $vehicle->mileage,
                "fuel_type" => $vehicle->fuel_type,
            ];
            session()->put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Vehicle added to cart successfully!');
    }

    // Mettre à jour la quantité d'un article
    public function update(Request $request, $id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            // Validation de la quantité (minimum 1)
            $quantity = max(1, intval($request->quantity));
            $cart[$id]['quantity'] = $quantity;

            session()->put('cart', $cart);

            // Recalcul des totaux pour la réponse JSON
            $subtotal = 0;
            foreach ($cart as $item) {
                // Si la quantité n'existe pas encore pour d'anciens tests, on applique 1 par défaut
                $itemQty = $item['quantity'] ?? 1;
                $subtotal += $item['price'] * $itemQty;
            }

            $salesTax = $subtotal * 0.08;
            $total = $subtotal + $salesTax;

            return response()->json([
                'success' => true,
                'item_subtotal' => '$' . number_format($cart[$id]['price'] * $quantity),
                'cart_count' => count($cart),
                'subtotal' => '$' . number_format($subtotal),
                'sales_tax' => '$' . number_format($salesTax),
                'total' => '$' . number_format($total)
            ]);
        }

        return response()->json(['success' => false], 404);
    }
    // Supprimer un véhicule du panier
    public function remove($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Vehicle removed from cart.');
    }
}

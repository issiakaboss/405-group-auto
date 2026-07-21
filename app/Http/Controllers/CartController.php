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

        // Calcul du prix total en prenant en compte les quantités
        $total = 0;
        foreach ($cart as $item) {
            $quantity = $item['quantity'] ?? 1;
            $total += $item['price'] * $quantity;
        }

        return view('cart.index', compact('cart', 'total'));
    }

    // Ajouter un véhicule au panier
    public function add(Vehicle $vehicle)
    {
        $cart = session()->get('cart', []);

        // Si le véhicule est déjà dans le panier, on incrémente la quantité
        if (isset($cart[$vehicle->id])) {
            $cart[$vehicle->id]['quantity']++;
        } else {
            // S'il n'est pas dedans, on l'ajoute AVEC la clé quantity à 1 par défaut
            $cart[$vehicle->id] = [
                "id" => $vehicle->id,
                "title" => $vehicle->title,
                "price" => $vehicle->price,
                "image" => $vehicle->images[0] ?? 'default.jpg', // Sécurité si pas d'image
                "year" => $vehicle->year,
                "category" => $vehicle->category,
                "location" => $vehicle->location,
                "mileage" => $vehicle->mileage,
                "fuel_type" => $vehicle->fuel_type,
                "quantity" => 1 // 👈 LA CLÉ MAGIQUE QUI MANQUAIT !
            ];
        }

        session()->put('cart', $cart);

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

            // Recalcul des totaux pour la réponse AJAX/JSON
            $subtotal = 0;
            foreach ($cart as $item) {
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

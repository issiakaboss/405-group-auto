<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);

        $total = 0;
        foreach ($cart as $item) {
            $quantity = $item['quantity'] ?? 1;
            $total += $item['price'] * $quantity;
        }

        return view('cart.index', compact('cart', 'total'));
    }

    public function add(Request $request, Vehicle $vehicle)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$vehicle->id])) {
            $cart[$vehicle->id]['quantity']++;
        } else {
            $cart[$vehicle->id] = [
                "id" => $vehicle->id,
                "title" => $vehicle->title,
                "price" => $vehicle->price,
                "image" => $vehicle->images[0] ?? 'default.jpg',
                "year" => $vehicle->year,
                "category" => $vehicle->category,
                "location" => $vehicle->location,
                "mileage" => $vehicle->mileage,
                "fuel_type" => $vehicle->fuel_type,
                "quantity" => 1
            ];
        }

        session()->put('cart', $cart);

        // Calcul du nombre total d'articles (somme des quantités)
        $cartCount = array_sum(array_column($cart, 'quantity'));

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Vehicle added to cart successfully!',
                'cart_count' => $cartCount
            ]);
        }

        return redirect()->back()->with('success', 'Vehicle added to cart successfully!');
    }

    public function update(Request $request, $id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $quantity = max(1, intval($request->quantity));
            $cart[$id]['quantity'] = $quantity;

            session()->put('cart', $cart);

            $subtotal = 0;
            foreach ($cart as $item) {
                $itemQty = $item['quantity'] ?? 1;
                $subtotal += $item['price'] * $itemQty;
            }

            $salesTax = $subtotal * 0.08;
            $total = $subtotal + $salesTax;
            $cartCount = array_sum(array_column($cart, 'quantity'));

            return response()->json([
                'success' => true,
                'item_subtotal' => '$' . number_format($cart[$id]['price'] * $quantity),
                'cart_count' => $cartCount,
                'subtotal' => '$' . number_format($subtotal),
                'sales_tax' => '$' . number_format($salesTax),
                'total' => '$' . number_format($total)
            ]);
        }

        return response()->json(['success' => false], 404);
    }

    public function remove(Request $request, $id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        $subtotal = array_reduce($cart, function ($carry, $item) {
            return $carry + ($item['price'] * ($item['quantity'] ?? 1));
        }, 0);

        // Retourner du JSON si la requête est AJAX / Expects JSON
        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'cart_count' => count($cart),
                'raw_subtotal' => $subtotal,
                'subtotal' => number_format($subtotal),
                'total' => number_format($subtotal * 1.08),
            ]);
        }

        return redirect()->back()->with('success', 'Vehicle removed from cart');
    }
}

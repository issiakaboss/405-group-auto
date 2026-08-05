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
            $quantity = (int) ($item['quantity'] ?? 1);
            $total += (float) ($item['price'] ?? 0) * $quantity;
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
                'id' => $vehicle->id,
                'vehicle_id' => $vehicle->id,
                'title' => $vehicle->title,
                'price' => $vehicle->price,
                'image' => is_array($vehicle->images) && count($vehicle->images) > 0 ? $vehicle->images[0] : 'default.jpg',
                'year' => $vehicle->year,
                'category' => $vehicle->vehicle_type?->value ?? $vehicle->vehicle_type,
                'location' => $vehicle->location,
                'mileage' => $vehicle->mileage,
                'fuel_type' => $vehicle->fuel_type?->value ?? $vehicle->fuel_type,
                'quantity' => 1,
            ];
        }

        session()->put('cart', $cart);
        $cartCount = array_sum(array_column($cart, 'quantity'));

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Vehicle added to your selection list successfully!',
                'cart_count' => $cartCount,
            ]);
        }

        return redirect()->back()->with('success', 'Vehicle added to your selection list successfully!');
    }

    public function update(Request $request, $id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $quantity = max(1, (int) $request->quantity);
            $cart[$id]['quantity'] = $quantity;
            session()->put('cart', $cart);

            $subtotal = 0;
            foreach ($cart as $item) {
                $subtotal += (float) ($item['price'] ?? 0) * ((int) ($item['quantity'] ?? 1));
            }

            return response()->json([
                'success' => true,
                'item_subtotal' => '$' . number_format($cart[$id]['price'] * $quantity),
                'cart_count' => array_sum(array_column($cart, 'quantity')),
                'raw_subtotal' => $subtotal,
                'subtotal' => '$' . number_format($subtotal),
                'total' => '$' . number_format($subtotal),
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
            return $carry + ((float) ($item['price'] ?? 0) * ((int) ($item['quantity'] ?? 1)));
        }, 0);

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'cart_count' => array_sum(array_column($cart, 'quantity')),
                'raw_subtotal' => $subtotal,
                'subtotal' => number_format($subtotal),
                'total' => number_format($subtotal),
            ]);
        }

        return redirect()->back()->with('success', 'Vehicle removed from your selection list');
    }

    public function addSimilar(Request $request, Vehicle $vehicle)
    {
        $cart = session()->get('cart', []);
        $cartKey = 'similar_' . $vehicle->id;

        $cart[$cartKey] = [
            'id' => $cartKey,
            'vehicle_id' => $vehicle->id,
            'title' => 'Similar: ' . $vehicle->title,
            'price' => $vehicle->price,
            'image' => is_array($vehicle->images) && count($vehicle->images) > 0 ? $vehicle->images[0] : 'default.jpg',
            'year' => $vehicle->year,
            'category' => $vehicle->vehicle_type?->value ?? $vehicle->vehicle_type,
            'location' => $vehicle->location,
            'mileage' => $vehicle->mileage,
            'fuel_type' => $vehicle->fuel_type?->value ?? $vehicle->fuel_type,
            'is_similar' => true,
            'quantity' => 1,
        ];

        session()->put('cart', $cart);

        return redirect()->route('cart.index')->with('success', 'Similar vehicle request added to your selection list!');
    }
}

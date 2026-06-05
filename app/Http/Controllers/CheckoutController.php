<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('success', 'Your cart is empty.');
        }

        $subtotal = array_sum(array_map(function ($item) {
            return $item['price'] * ($item['quantity'] ?? 1);
        }, $cart));

        $tax = $subtotal * 0.08;
        $total = $subtotal + $tax;

        return view('checkout.index', compact('cart', 'subtotal', 'tax', 'total'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'phone' => 'required',
            'address' => 'required',
            'city' => 'required',
            'country' => 'required',
        ]);

        $cart = session()->get('cart', []);
        // Écriture de la commande fictive
        $orderId = DB::table('orders')->insertGetId([
            'user_id' => Auth::user()?->id,
            'total' => array_sum(array_column($cart, 'price')) * 1.08,
            'status' => 'pending_review',
            'address' => $request->address . ', ' . $request->city . ', ' . $request->country,
            'phone' => $request->phone,
            'created_at' => now()
        ]);

        // Vider la session et la base de données
        session()->forget('cart');
        DB::table('carts')->where('user_id', Auth::user()?->id)->delete();

        return redirect()->route('checkout.success');
    }

    public function success()
    {
        return view('checkout.success');
    }
}

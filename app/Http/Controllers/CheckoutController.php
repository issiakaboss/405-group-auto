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
            return redirect()->route('cart.index')->with('warning', 'Your cart is empty.');
        }

        $subtotal = array_reduce($cart, function ($carry, $item) {
            return $carry + ($item['price'] * ($item['quantity'] ?? 1));
        }, 0);

        $tax = $subtotal * 0.08;
        $total = $subtotal + $tax;

        return view('checkout.index', compact('cart', 'subtotal', 'tax', 'total'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'phone'   => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'city'    => 'required|string|max:100',
            'country' => 'required|string|max:100',
        ]);

        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        // Calcul exact du total avec quantité et taxe
        $subtotal = array_reduce($cart, function ($carry, $item) {
            return $carry + ($item['price'] * ($item['quantity'] ?? 1));
        }, 0);
        
        $total = $subtotal * 1.08;

        DB::beginTransaction();

        try {
            // 1. Insertion de la commande globale
            $orderId = DB::table('orders')->insertGetId([
                'user_id'    => Auth::id(),
                'total'      => $total,
                'status'     => 'pending_review',
                'address'    => $request->address . ', ' . $request->city . ', ' . $request->country,
                'phone'      => $request->phone,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // 2. Insertion des articles de la commande (Si la table order_items existe)
            if (DB::getSchemaBuilder()->hasTable('order_items')) {
                foreach ($cart as $id => $item) {
                    DB::table('order_items')->insert([
                        'order_id'   => $orderId,
                        'vehicle_id' => $item['id'] ?? $id,
                        'title'      => $item['title'] ?? 'Vehicle',
                        'price'      => $item['price'],
                        'quantity'   => $item['quantity'] ?? 1,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }

            // 3. Vider la session et la BDD pour cet utilisateur
            session()->forget('cart');
            DB::table('carts')->where('user_id', Auth::id())->delete();

            DB::commit();

            return redirect()->route('checkout.success');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'An error occurred while processing your order. Please try again.');
        }
    }

    public function success()
    {
        return view('checkout.success');
    }
}
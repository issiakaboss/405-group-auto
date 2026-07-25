<?php

namespace App\Http\Controllers;

use App\Models\Enums\OrderStatus;
use App\Models\Enums\VehicleStatus;
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

        $subtotal = array_reduce($cart, function ($carry, $item) {
            return $carry + ($item['price'] * ($item['quantity'] ?? 1));
        }, 0);

        $total = $subtotal * 1.08;

        DB::beginTransaction();

        try {
            $orderId = DB::table('orders')->insertGetId([
                'user_id'    => Auth::id(),
                'total'      => $total,
                'status'     => OrderStatus::PENDING_REVIEW->value,
                'address'    => $request->address . ', ' . $request->city . ', ' . $request->country,
                'phone'      => $request->phone,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            if (DB::getSchemaBuilder()->hasTable('order_items')) {
                foreach ($cart as $id => $item) {
                    // IMPORTANT : Récupérer l'ID numérique réel du véhicule
                    $vehicleId = $item['vehicle_id'] ?? $item['id'] ?? $id;

                    DB::table('order_items')->insert([
                        'order_id'   => $orderId,
                        'vehicle_id' => $vehicleId,
                        'title'      => $item['title'] ?? 'Vehicle',
                        'price'      => $item['price'],
                        'quantity'   => $item['quantity'] ?? 1,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);

                    // Mettre à jour uniquement si un véhicule réel existe
                    if (is_numeric($vehicleId)) {
                        DB::table('vehicles')
                            ->where('id', $vehicleId)
                            ->update(['status' => VehicleStatus::IN_TRANSIT->value]);
                    }
                }
            }

            session()->forget('cart');
            if (Auth::check()) {
                DB::table('carts')->where('user_id', Auth::id())->delete();
            }

            DB::commit();

            return redirect()->route('checkout.success');
        } catch (\Exception $e) {
            DB::rollBack();
            // Affiche l'erreur réelle en local pour le débogage
            return back()->with('error', 'Order failed: ' . $e->getMessage());
        }
    }
    public function success()
    {
        return view('checkout.success');
    }
}

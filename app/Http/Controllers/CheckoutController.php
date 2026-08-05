<?php

namespace App\Http\Controllers;

use App\Models\Enums\OrderStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('warning', 'Your selection list is empty.');
        }

        $subtotal = array_reduce($cart, function ($carry, $item) {
            return $carry + ((float) ($item['price'] ?? 0) * ((int) ($item['quantity'] ?? 1)));
        }, 0);

        return view('checkout.index', compact('cart', 'subtotal'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['required', 'string', 'max:20'],
            'zip_code' => ['required', 'string', 'max:20'],
            'notes' => ['nullable', 'string'],
        ]);

        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Your selection list is empty.');
        }

        DB::beginTransaction();

        try {
            $orderId = DB::table('orders')->insertGetId([
                'user_id' => Auth::id(),
                'total' => array_reduce($cart, fn($carry, $item) => $carry + ((float) ($item['price'] ?? 0) * ((int) ($item['quantity'] ?? 1))), 0),
                'status' => OrderStatus::PENDING_REVIEW->value,
                'address' => $request->zip_code,
                'phone' => $request->phone,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            foreach ($cart as $item) {
                $vehicleId = $item['vehicle_id'] ?? $item['id'];

                DB::table('order_items')->insert([
                    'order_id' => $orderId,
                    'vehicle_id' => $vehicleId,
                    'title' => $item['title'] ?? 'Vehicle',
                    'price' => $item['price'],
                    'quantity' => $item['quantity'] ?? 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            session()->forget('cart');
            DB::commit();

            return redirect()->route('checkout.success')->with('success', 'Your selection has been submitted successfully. An administrator will contact you shortly.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Inquiry submission failed: ' . $e->getMessage());
        }
    }

    public function success()
    {
        return view('checkout.success');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Enums\OrderStatus;
use App\Models\Enums\VehicleStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index()
    {
        $orders = DB::table('orders')
            ->join('users', 'orders.user_id', '=', 'users.id')
            ->select('orders.*', 'users.name as customer_name', 'users.email as customer_email')
            ->orderBy('orders.created_at', 'desc')
            ->paginate(15);

        return view('admin.orders.index', compact('orders'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string|in:pending_review,confirmed,shipping,delivered,cancelled',
        ]);

        DB::table('orders')
            ->where('id', $id)
            ->update([
                'status'     => $request->status,
                'updated_at' => now(),
            ]);

        // Si la commande est annulée, on remet le véhicule en vente
        if ($request->status === OrderStatus::CANCELLED->value) {
            $vehicleIds = DB::table('order_items')->where('order_id', $id)->pluck('vehicle_id');
            DB::table('vehicles')->whereIn('id', $vehicleIds)->update([
                'status' => VehicleStatus::AVAILABLE_USA->value // ou AVAILABLE_LOCAL selon le stock
            ]);
        }

        return back()->with('success', 'Order status updated successfully!');
    }
}
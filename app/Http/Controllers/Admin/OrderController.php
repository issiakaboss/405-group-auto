<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Vehicle;
use App\Models\Enums\OrderStatus;
use App\Models\Enums\VehicleStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules\Enum;

class OrderController extends Controller
{
    /**
     * Liste les commandes paginées.
     */
    public function index()
    {
        // Eloquent charge la relation avec l'utilisateur
        $orders = Order::with('user')
            ->latest()
            ->paginate(15);

        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Affiche les détails d'une commande spécifique avec ses items et les véhicules associés.
     */
    public function show(Order $order)
    {
        // Chargement des relations du modèle
        $order->load(['user', 'items.vehicle']);

        return view('admin.orders.show', compact('order'));
    }

    /**
     * Mettre à jour le statut d'une commande et ajuster le statut des véhicules.
     */
    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => ['required', new Enum(OrderStatus::class)],
        ]);

        $newStatus = $request->status;
        $previousStatus = $order->status;

        DB::transaction(function () use ($order, $newStatus, $previousStatus) {
            // 1. Mise à jour du statut de la commande
            $order->update([
                'status' => $newStatus,
            ]);

            // Récupération des IDs des véhicules liés à cette commande via les items
            $vehicleIds = $order->items()->pluck('vehicle_id')->filter();

            // 2. Si la commande est annulée, on libère les véhicules
            if ($newStatus === OrderStatus::CANCELLED->value || $newStatus === OrderStatus::CANCELLED) {
                Vehicle::whereIn('id', $vehicleIds)->update([
                    'status' => VehicleStatus::AVAILABLE->value ?? VehicleStatus::AVAILABLE,
                ]);
            }
            // 3. Si la commande était précédemment annulée et repasse à un statut actif
            elseif ($previousStatus === OrderStatus::CANCELLED->value || $previousStatus === OrderStatus::CANCELLED) {
                Vehicle::whereIn('id', $vehicleIds)->update([
                    'status' => VehicleStatus::SOLD->value ?? VehicleStatus::SOLD,
                ]);
            }
        });

        return back()->with('success', 'Order status updated successfully!');
    }
}

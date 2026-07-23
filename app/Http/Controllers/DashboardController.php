<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        // 1. Récupération des commandes de l'utilisateur
        $orders = DB::table('orders')
            ->where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->get();

        // 2. Si la table order_items existe, on rattachera les véhicules associés
        if (DB::getSchemaBuilder()->hasTable('order_items') && $orders->isNotEmpty()) {
            $orderIds = $orders->pluck('id')->toArray();
            
            $items = DB::table('order_items')
                ->whereIn('order_id', $orderIds)
                ->get()
                ->groupBy('order_id');

            foreach ($orders as $order) {
                $order->items = $items->get($order->id, collect());
            }
        }

        return view('dashboard', compact('orders'));
    }
}
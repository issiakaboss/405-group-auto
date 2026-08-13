<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\TestDrive;
use App\Models\VehicleRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
  public function index()
    {
        $userId = Auth::id();

        // 1. Rendez-vous Test Drive avec la relation Vehicle
        $testDrives = TestDrive::with('vehicle')
            ->where('user_id', $userId)
            ->latest()
            ->get();

        // 2. Demandes sur-mesure (Custom Requests)
        $vehicleRequests = VehicleRequest::where('user_id', $userId)
            ->latest()
            ->get();

        // 3. Commandes / Demandes de sélection avec leurs articles
        $orders = Order::with('items')
            ->where('user_id', $userId)
            ->latest()
            ->get();

        return view('dashboard', compact('testDrives', 'vehicleRequests', 'orders'));
    }
}
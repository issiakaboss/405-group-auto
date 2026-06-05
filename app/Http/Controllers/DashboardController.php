<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Récupérer toutes les commandes de l'utilisateur connecté
        $orders = DB::table('orders')
            ->where('user_id', Auth::user()?->id)
            ->orderBy('created_at', 'desc')
            ->get();

        // Retourner la vue du dashboard en lui passant les commandes
        return view('dashboard', compact('orders'));
    }
}
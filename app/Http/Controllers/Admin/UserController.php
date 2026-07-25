<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewAdminWelcomeMail;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function index()
    {
        // Récupérer uniquement les administrateurs
        $admins = User::role('admin')->get();
        return view('admin.users.index', compact('admins'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
        ]);

        // Générer un mot de passe temporaire aléatoire
        $plainPassword = Str::random(10);

        $admin = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($plainPassword),
        ]);

        // Assigner le rôle admin (Spatie Permission)
        $admin->assignRole('admin');

        // Envoyer le mail d'invitation avec les accès
        Mail::to($admin->email)->send(new NewAdminWelcomeMail($admin, $plainPassword));

        return back()->with('success', 'Nouvel administrateur créé et accès envoyés par email !');
    }
}

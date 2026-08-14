<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewAdminWelcomeMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function index()
    {
        // Get only administrators
        $admins = User::role('admin')->latest()->get();
        return view('admin.users.index', compact('admins'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
        ]);

        // Generate temporary random password
        $plainPassword = Str::random(10);

        $admin = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make("password"),
            'is_blocked' => false,
        ]);

        // Assign admin role (Spatie Permission)
        $admin->assignRole('admin');

        // Send email with credentials
        Mail::to($admin->email)->send(new NewAdminWelcomeMail($admin, $plainPassword));

        return back()->with('success', 'Administrator created successfully and credentials sent by email.');
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return back()->with('success', 'Administrator details updated successfully.');
    }

    public function toggleBlock(User $user)
    {
        // Prevent self-blocking
        if (Auth::id() === $user->id) {
            return back()->with('error', 'You cannot suspend your own account.');
        }

        $user->is_blocked = !$user->is_blocked;
        $user->save();

        $statusMessage = $user->is_blocked 
            ? 'Administrator has been suspended.' 
            : 'Administrator has been reactivated.';

        return back()->with('success', $statusMessage);
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TestDriveController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'vehicle_id' => 'required',
            'date' => 'required|date|after:today',
            'time' => 'required',
            'notes' => 'nullable|string',
        ]);

        DB::table('test_drives')->insert([
            'user_id' => Auth::user()?->id ?? null, // Optionnel si invité
            'vehicle_id' => $request->vehicle_id,
            'date' => $request->date,
            'time' => $request->time,
            'notes' => $request->notes,
            'created_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Your test drive appointment has been scheduled successfully!');
    }
}
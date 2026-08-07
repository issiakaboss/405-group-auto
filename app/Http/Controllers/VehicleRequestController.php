<?php

namespace App\Http\Controllers;

use App\Models\VehicleRequest;
use Illuminate\Http\Request;

class VehicleRequestController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'make'            => ['required', 'string', 'max:100'],
            'model'           => ['required', 'string', 'max:100'],
            'year_min'        => ['nullable', 'integer', 'min:1900', 'max:' . (date('Y') + 1)],
            'year_max'        => ['nullable', 'integer', 'min:1900', 'max:' . (date('Y') + 1)],
            'max_budget'      => ['nullable', 'numeric', 'min:0'],
            'desired_mileage' => ['nullable', 'integer', 'min:0'],
            'body_style'      => ['nullable', 'string', 'max:100'],
            'name'            => ['required', 'string', 'max:255'],
            'email'           => ['required', 'email', 'max:255'],
            'phone'           => ['required', 'string', 'max:30'],
            'zip_code'        => ['required', 'string', 'max:20'],
            'notes'           => ['nullable', 'string', 'max:1000'],
        ]);

        VehicleRequest::create($validated);

        return back()->with('success', 'Your vehicle finder request has been submitted! Our team will search for your desired car and contact you soon.');
    }
}
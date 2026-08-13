<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VehicleRequest;
use Illuminate\Http\Request;

class VehicleRequestController extends Controller
{
    public function index()
    {
        $vehicleRequests = VehicleRequest::latest()->paginate(15);

        return view('admin.vehicle-requests.index', compact('vehicleRequests'));
    }

    public function show(VehicleRequest $vehicleRequest)
{
    return view('admin.vehicle-requests.show', compact('vehicleRequest'));
}

public function updateStatus(Request $request, VehicleRequest $vehicleRequest)
{
    $request->validate([
        'status' => 'required|string|in:pending_review,contacted,scheduled,cancelled',
    ]);

    $vehicleRequest->update([
        'status' => $request->status,
    ]);

    return back()->with('success', 'Le statut de la demande a été mis à jour avec succès !');
}

}

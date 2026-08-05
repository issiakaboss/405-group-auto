<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VehicleRequest;

class VehicleRequestController extends Controller
{
    public function index()
    {
        $vehicleRequests = VehicleRequest::latest()->paginate(15);

        return view('admin.vehicle-requests.index', compact('vehicleRequests'));
    }
}

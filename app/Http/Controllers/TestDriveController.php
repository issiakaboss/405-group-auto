<?php

namespace App\Http\Controllers;

use App\Models\Enums\TestDriveStatus; // Ou App\Enums\TestDriveStatus selon votre namespace
use App\Models\TestDrive;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TestDriveController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'vehicle_id' => 'required|exists:vehicles,id',
            'date'       => 'required|date|after:today',
            'visit_time' => 'required|string',
            'notes'      => 'nullable|string|max:1000',
        ]);

        $userId = Auth::id();

        // Vérification : l'utilisateur a-t-il une réservation non clôturée / non annulée ?
        if ($userId) {
            $existingTestDrive = TestDrive::where('user_id', $userId)
                ->where('vehicle_id', $request->vehicle_id)
                ->whereNotIn('status', [
                    TestDriveStatus::CLOSED,
                    TestDriveStatus::CANCELLED,
                    TestDriveStatus::COMPLETED,
                ])
                ->first();

            if ($existingTestDrive) {
                return redirect()->back()->with('error', 'You already have an active test drive request for this vehicle.');
            }
        }

        TestDrive::create([
            'user_id'    => $userId,
            'vehicle_id' => $request->vehicle_id,
            'date'       => $request->date,
            'visit_time' => $request->visit_time,
            'notes'      => $request->notes,
            'status'     => TestDriveStatus::PENDING
        ]);

        return redirect()->back()->with('success', 'Your test drive appointment has been scheduled successfully!');
    }

    public function cancel(TestDrive $testDrive)
    {
        // Sécurité : Vérifier que le rendez-vous appartient bien à l'utilisateur connecté
        if ($testDrive->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        // On ne peut annuler que si c'est encore "pending"
        if ($testDrive->status === TestDriveStatus::PENDING || $testDrive->status->value === 'pending') {
            $testDrive->update([
                'status' => TestDriveStatus::CANCELLED
            ]);

            return redirect()->back()->with('success', 'Your test drive appointment has been cancelled successfully.');
        }

        return redirect()->back()->with('error', 'Cannot cancel an appointment that is already processed or completed.');
    }
}
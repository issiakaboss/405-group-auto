<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Enums\TestDriveStatus;
use App\Models\TestDrive;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class TestDriveController extends Controller
{
    public function index()
    {
        // Fetch test drives with associated vehicle and user
        $testDrives = TestDrive::with(['vehicle', 'user'])
            ->latest()
            ->paginate(15);

        return view('admin.test-drives.index', compact('testDrives'));
    }

    public function show(TestDrive $testDrive)
    {
        $testDrive->load(['vehicle', 'user']);
        return view('admin.test-drives.show', compact('testDrive'));
    }

    public function updateStatus(Request $request, TestDrive $testDrive)
    {
        $request->validate([
            'status' => ['required', Rule::enum(TestDriveStatus::class)],
        ]);

        $testDrive->update([
            'status' => $request->status,
        ]);

        return redirect()->back()->with('success', 'Test drive status updated successfully!');
    }

    public function cancel(TestDrive $testDrive)
    {
        // Security check: ensure the user owns this test drive
        if ($testDrive->user_id !== Auth::id()) {
            abort(403);
        }

        if ($testDrive->status === TestDriveStatus::PENDING) {
            $testDrive->update(['status' => TestDriveStatus::CANCELLED->value]);
            return redirect()->back()->with('success', 'Test drive appointment cancelled successfully.');
        }

        return redirect()->back()->with('error', 'Cannot cancel a processed appointment.');
    }
}

@extends('layouts.admin')

@section('title', 'Vehicle Requests')

@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Vehicle Requests</h1>
            <p class="text-sm text-gray-500">Custom vehicle finder submissions from site visitors.</p>
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden shadow-sm">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-100 text-sm">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 text-left font-semibold text-gray-700">Customer</th>
                        <th class="px-4 py-3 text-left font-semibold text-gray-700">Desired Vehicle</th>
                        <th class="px-4 py-3 text-left font-semibold text-gray-700">Budget</th>
                        <th class="px-4 py-3 text-left font-semibold text-gray-700">Location</th>
                        <th class="px-4 py-3 text-left font-semibold text-gray-700">Submitted</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($vehicleRequests as $request)
                    <tr>
                        <td class="px-4 py-3">
                            <div class="font-semibold text-gray-900">{{ $request->name }}</div>
                            <div class="text-xs text-gray-500">{{ $request->email }}</div>
                        </td>
                        <td class="px-4 py-3">
                            <div class="font-medium text-gray-900">{{ $request->make }} {{ $request->model }}</div>
                            <div class="text-xs text-gray-500">{{ $request->body_style ?? 'N/A' }}</div>
                        </td>
                        <td class="px-4 py-3 text-gray-700">${{ number_format($request->max_budget ?? 0) }}</td>
                        <td class="px-4 py-3 text-gray-700">{{ $request->zip_code }}</td>
                        <td class="px-4 py-3 text-gray-700">{{ $request->created_at->format('M d, Y') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-4 py-10 text-center text-gray-500">No custom vehicle requests yet.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
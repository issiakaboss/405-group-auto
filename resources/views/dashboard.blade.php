<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-white leading-tight">
            {{ __('My Account Dashboard') }}
        </h2>
    </x-slot>

    <!-- Fond global très sombre -->
    <div class="py-12 bg-[#080d1a] min-h-[80vh] text-slate-100">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            @if(session('success'))
            <div class="p-4 bg-emerald-950/60 border border-emerald-800/80 text-emerald-300 text-xs font-medium rounded-xl flex items-center space-x-2">
                <span class="h-2 w-2 rounded-full bg-emerald-400 animate-pulse"></span>
                <span>{{ session('success') }}</span>
            </div>
            @endif

            <!-- SECTION 1: MY RESERVATIONS & INQUIRIES -->
            <div class="bg-[#0f172a] overflow-hidden shadow-2xl sm:rounded-2xl border border-slate-800/80 p-6 sm:p-8">
                <div class="mb-6 flex justify-between items-center">
                    <div>
                        <h3 class="text-base font-bold text-white uppercase tracking-tight">My Vehicle Reservations & Inquiries</h3>
                        <p class="text-xs text-slate-400 mt-0.5">Vehicles you have requested or reserved via checkout.</p>
                    </div>
                </div>

                @if(!isset($orders) || $orders->isEmpty())
                <div class="text-center py-8 border border-dashed border-slate-700/60 rounded-2xl bg-[#182234]">
                    <p class="text-xs font-semibold text-slate-400">No vehicle reservations placed yet</p>
                </div>
                @else
                <div class="overflow-x-auto rounded-xl border border-slate-800/80 shadow-sm bg-[#0f172a]">
                    <table class="w-full text-left border-collapse text-xs">
                        <thead>
                            <tr class="bg-[#1e293b] text-slate-400 font-bold uppercase tracking-wider border-b border-slate-800">
                                <th class="p-4">Order ID</th>
                                <th class="p-4">Vehicles Requested</th>
                                <th class="p-4">Total Price</th>
                                <th class="p-4">Date</th>
                                <th class="p-4">Status</th>
                                <th class="p-4 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-800 text-slate-300">
                            @foreach($orders as $order)
                            <tr class="hover:bg-[#1e293b]/50 transition">
                                <td class="p-4 font-bold text-white">
                                    #ORD-{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}
                                </td>
                                <td class="p-4 font-medium text-slate-200">
                                    <ul class="space-y-1">
                                        @foreach($order->items as $item)
                                        <li class="flex items-center space-x-1.5">
                                            <span class="h-1.5 w-1.5 rounded-full bg-slate-500"></span>
                                            <span>{{ $item->title }} <strong class="text-white">(x{{ $item->quantity }})</strong></span>
                                        </li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td class="p-4 font-bold text-emerald-400 whitespace-nowrap">
                                    ${{ number_format($order->total_estimated_price, 2) }}
                                </td>
                                <td class="p-4 text-slate-400 whitespace-nowrap">
                                    {{ \Carbon\Carbon::parse($order->created_at)->format('M d, Y') }}
                                </td>
                                <td class="p-4 whitespace-nowrap">
                                    <span class="inline-flex items-center px-2.5 py-1 text-[10px] font-bold rounded-full uppercase tracking-wider bg-[#1e293b] text-slate-300 border border-slate-700">
                                        {{ is_object($order->status) ? $order->status->value : $order->status }}
                                    </span>
                                </td>
                                <td class="p-4 text-right whitespace-nowrap">
                                    <!-- Bouton Détails -->
                                    <a href="{{ route('user.orders.show', $order) }}"
                                        class="inline-flex items-center space-x-1 text-xs font-semibold px-3 py-1.5 rounded-lg bg-[#1e293b] text-slate-200 hover:bg-slate-700 transition border border-slate-700/60">
                                        <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                        <span>Details</span>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endif
            </div>

            <!-- SECTION 2: MY TEST DRIVE APPOINTMENTS -->
            <div class="bg-[#0f172a] overflow-hidden shadow-2xl sm:rounded-2xl border border-slate-800/80 p-6 sm:p-8">
                <div class="mb-6">
                    <h3 class="text-base font-bold text-white uppercase tracking-tight">My Test Drive Appointments</h3>
                    <p class="text-xs text-slate-400 mt-0.5">Scheduled test drives at our dealership.</p>
                </div>

                @if($testDrives->isEmpty())
                <div class="text-center py-8 border border-dashed border-slate-700/60 rounded-2xl bg-[#182234]">
                    <p class="text-xs font-semibold text-slate-400">No test drive appointments scheduled</p>
                </div>
                @else
                <div class="overflow-x-auto rounded-xl border border-slate-800/80 shadow-sm bg-[#0f172a]">
                    <table class="w-full text-left border-collapse text-xs">
                        <thead>
                            <tr class="bg-[#1e293b] text-slate-400 font-bold uppercase tracking-wider border-b border-slate-800">
                                <th class="p-4">Vehicle</th>
                                <th class="p-4">Date & Time</th>
                                <th class="p-4">Status</th>
                                <th class="p-4 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-800 text-slate-300">
                            @foreach($testDrives as $drive)
                            <tr class="hover:bg-[#1e293b]/50 transition">
                                <td class="p-4 font-bold text-white">
                                    {{ $drive->vehicle->title ?? 'Vehicle Unavailable' }}
                                </td>
                                <td class="p-4 text-slate-300 whitespace-nowrap">
                                    {{ \Carbon\Carbon::parse($drive->date)->format('M d, Y') }} at <span class="font-bold text-white">{{ $drive->visit_time }}</span>
                                </td>
                                <td class="p-4 whitespace-nowrap">
                                    <span class="inline-flex items-center px-2.5 py-1 text-[10px] font-bold rounded-full uppercase tracking-wider border {{ $drive->status?->badgeColor() ?? 'bg-[#1e293b] text-slate-300 border-slate-700' }}">
                                        {{ $drive->status?->label() ?? 'PENDING' }}
                                    </span>
                                </td>
                                <td class="p-4 text-right whitespace-nowrap space-x-2">
                                    @if(($drive->status?->value ?? $drive->status) === \App\Models\Enums\TestDriveStatus::PENDING->value || $drive->status === \App\Models\Enums\TestDriveStatus::PENDING)
                                    <form id="cancel-test-drive-form-{{ $drive->id }}" action="{{ route('user.test-drives.cancel', $drive) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('PATCH')
                                        <button type="button"
                                            onclick="requestTestDriveCancellation('{{ $drive->id }}')"
                                            class="px-3 py-1.5 text-xs font-semibold text-rose-400 hover:text-rose-300 bg-rose-950/40 hover:bg-rose-900/60 rounded-lg border border-rose-800/80 transition">
                                            Cancel Appointment
                                        </button>
                                    </form>
                                    @else
                                    <span class="text-slate-500 text-[11px] italic">No actions</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endif
            </div>

            <!-- SECTION 3: MY CUSTOM VEHICLE REQUESTS -->
            <div class="bg-[#0f172a] overflow-hidden shadow-2xl sm:rounded-2xl border border-slate-800/80 p-6 sm:p-8">
                <div class="mb-6">
                    <h3 class="text-base font-bold text-white uppercase tracking-tight">My Custom Vehicle Requests</h3>
                    <p class="text-xs text-slate-400 mt-0.5">Specific car sourcing requests submitted to our team.</p>
                </div>

                @if($vehicleRequests->isEmpty())
                <div class="text-center py-8 border border-dashed border-slate-700/60 rounded-2xl bg-[#182234]">
                    <p class="text-xs font-semibold text-slate-400">No custom requests submitted</p>
                </div>
                @else
                <div class="overflow-x-auto rounded-xl border border-slate-800/80 shadow-sm bg-[#0f172a]">
                    <table class="w-full text-left border-collapse text-xs">
                        <thead>
                            <tr class="bg-[#1e293b] text-slate-400 font-bold uppercase tracking-wider border-b border-slate-800">
                                <th class="p-4">Requested Vehicle</th>
                                <th class="p-4">Budget / Year</th>
                                <th class="p-4">Date</th>
                                <th class="p-4">Status</th>
                                <th class="p-4 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-800 text-slate-300">
                            @foreach($vehicleRequests as $req)
                            <tr class="hover:bg-[#1e293b]/50 transition">
                                <td class="p-4 font-bold text-white">
                                    {{ $req->make }} {{ $req->model }}
                                </td>
                                <td class="p-4 text-slate-300 whitespace-nowrap">
                                    Max <span class="font-semibold text-emerald-400">${{ number_format($req->max_budget ?? $req->budget ?? 0) }}</span> (Year: {{ $req->year_min ?? $req->year ?? 'Any' }})
                                </td>
                                <td class="p-4 text-slate-400 whitespace-nowrap">
                                    {{ \Carbon\Carbon::parse($req->created_at)->format('M d, Y') }}
                                </td>
                                <td class="p-4 whitespace-nowrap">
                                    <span class="inline-flex items-center px-2.5 py-1 text-[10px] font-bold rounded-full uppercase tracking-wider border {{ $req->status?->badgeColor() ?? 'bg-[#1e293b] text-slate-300 border-slate-700' }}">
                                        {{ $req->status?->label() ?? 'PENDING' }}
                                    </span>
                                </td>
                                <td class="p-4 text-right whitespace-nowrap space-x-2">
                                    @if(($req->status?->value ?? $req->status) === \App\Models\Enums\VehicleRequestStatus::PENDING->value || $req->status === \App\Models\Enums\VehicleRequestStatus::PENDING)
                                    <form id="cancel-vehicle-request-form-{{ $req->id }}" action="{{ route('user.vehicle-requests.cancel', $req) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('PATCH')
                                        <button type="button"
                                            onclick="requestVehicleRequestCancellation('{{ $req->id }}')"
                                            class="px-3 py-1.5 text-xs font-semibold text-rose-400 hover:text-rose-300 bg-rose-950/40 hover:bg-rose-900/60 rounded-lg border border-rose-800/80 transition">
                                            Cancel Request
                                        </button>
                                    </form>
                                    @else
                                    <span class="text-slate-500 text-[11px] italic">No actions</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endif
            </div>

        </div>
    </div>

    <!-- Modal confirmation -->
    <x-confirm-modal
        name="cancel-test-drive-modal"
        title="Cancel Test Drive Appointment?"
        message="Are you sure you want to cancel this appointment? This action cannot be undone."
        confirmText="Yes, Cancel"
        cancelText="Keep Appointment"
        type="danger" />

    <x-confirm-modal
        name="cancel-vehicle-request-modal"
        title="Cancel Custom Vehicle Request?"
        message="Are you sure you want to cancel this custom sourcing request?"
        confirmText="Yes, Cancel Request"
        cancelText="Keep Request"
        type="danger" />

    <script>
        function requestTestDriveCancellation(id) {
            window.dispatchEvent(new CustomEvent('open-modal-cancel-test-drive-modal', {
                detail: {
                    id: id
                }
            }));
        }

        function requestVehicleRequestCancellation(id) {
            window.dispatchEvent(new CustomEvent('open-modal-cancel-vehicle-request-modal', {
                detail: {
                    id: id
                }
            }));
        }

        document.addEventListener('DOMContentLoaded', function() {
            window.addEventListener('confirmed-cancel-test-drive-modal', function(event) {
                if (event.detail && event.detail.id) {
                    const form = document.getElementById(`cancel-test-drive-form-${event.detail.id}`);
                    if (form) form.submit();
                }
            });

            window.addEventListener('confirmed-cancel-vehicle-request-modal', function(event) {
                if (event.detail && event.detail.id) {
                    const form = document.getElementById(`cancel-vehicle-request-form-${event.detail.id}`);
                    if (form) form.submit();
                }
            });
        });
    </script>
</x-app-layout>
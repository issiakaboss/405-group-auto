<x-app-layout>
    <div class="min-h-screen bg-slate-950 text-slate-100 -m-6 p-6">
        <div class="container mx-auto max-w-7xl">
            <!-- Header with Back Link -->
            <div class="flex items-center justify-between mb-6">
                <div>
                    <a href="{{ route('admin.vehicle-requests.index') }}" class="text-xs text-slate-400 hover:text-white transition flex items-center gap-1 mb-2">
                        ← Back to requests
                    </a>
                    <h1 class="text-2xl font-bold text-white">Request #{{ $vehicleRequest->id }}</h1>
                    <p class="text-xs text-slate-400">Submitted on {{ $vehicleRequest->created_at->format('M d, Y \a\t H:i') }}</p>
                </div>

                <!-- Status Badge -->
                <div>
                    <span class="px-3 py-1.5 rounded-full text-xs font-semibold bg-slate-800 text-slate-300 border border-slate-700">
                        Current status: <strong class="text-white uppercase">{{ $vehicleRequest->status->value ?? $vehicleRequest->status }}</strong>
                    </span>
                </div>
            </div>

            @if(session('success'))
            <div class="mb-6 p-4 rounded-lg bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 text-sm">
                {{ session('success') }}
            </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                <!-- Left Column: Request Details & Customer Info -->
                <div class="lg:col-span-2 space-y-6">

                    <!-- Customer Details -->
                    <div class="bg-slate-900 border border-slate-800 rounded-xl p-6">
                        <h2 class="text-lg font-semibold text-white mb-4 flex items-center gap-2">
                            👤 Applicant Information
                        </h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                            <div>
                                <span class="text-slate-400 block text-xs">Customer Name:</span>
                                <span class="text-white font-medium">
                                    {{ $vehicleRequest->user->name ?? 'Guest User' }}
                                </span>
                            </div>
                            <div>
                                <span class="text-slate-400 block text-xs">Email Address:</span>
                                <span class="text-white font-medium">
                                    {{ $vehicleRequest->user->email ?? 'N/A' }}
                                </span>
                            </div>
                            <div>
                                <span class="text-slate-400 block text-xs">Phone Number:</span>
                                <span class="text-white font-medium">{{ $vehicleRequest->phone ?? 'N/A' }}</span>
                            </div>
                            <div>
                                <span class="text-slate-400 block text-xs">Total Estimated Price:</span>
                                <span class="text-emerald-400 font-bold">
                                    {{ number_format($vehicleRequest->total_estimated_price, 2) }} €
                                </span>
                            </div>
                            <div class="md:col-span-2">
                                <span class="text-slate-400 block text-xs">Full Address:</span>
                                <span class="text-white font-medium">
                                    @php
                                    $addressParts = array_filter([$vehicleRequest->address, $vehicleRequest->city, $vehicleRequest->country]);
                                    @endphp
                                    {{ !empty($addressParts) ? implode(', ', $addressParts) : 'Not provided' }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Requested Vehicles Section -->
                    @if(isset($vehicleRequest->items) && $vehicleRequest->items->count() > 0)
                    <div class="bg-slate-900 border border-slate-800 rounded-xl p-6">
                        <h2 class="text-lg font-semibold text-white mb-4 flex items-center gap-2">
                            🚗 Requested Vehicles ({{ $vehicleRequest->items->count() }})
                        </h2>
                        <div class="divide-y divide-slate-800">
                            @foreach($vehicleRequest->items as $item)
                            <div class="py-3 flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    @if(optional($item->vehicle)->image_url)
                                    <img src="{{ asset('storage/' . $item->vehicle->image_url) }}" class="w-12 h-12 object-cover rounded-lg border border-slate-700" alt="Vehicle image">
                                    @endif
                                    <div>
                                        <h3 class="text-white font-medium text-sm">
                                            {{ $item->vehicle->title ?? $item->vehicle_name ?? 'Vehicle #' . $item->vehicle_id }}
                                        </h3>
                                        <p class="text-xs text-slate-400">Vehicle ID: {{ $item->vehicle_id }}</p>
                                    </div>
                                </div>
                                <span class="text-emerald-400 font-semibold text-sm">
                                    {{ number_format($item->price ?? 0, 2) }} €
                                </span>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <!-- Notes & Instructions -->
                    @if($vehicleRequest->notes)
                    <div class="bg-slate-900 border border-slate-800 rounded-xl p-6">
                        <h2 class="text-lg font-semibold text-white mb-2">📝 Notes & Instructions</h2>
                        <p class="text-slate-300 text-sm leading-relaxed whitespace-pre-line">
                            {{ $vehicleRequest->notes }}
                        </p>
                    </div>
                    @endif

                </div>

                <!-- Right Column: Admin Actions -->
                <div class="space-y-6">
                    <div class="bg-slate-900 border border-slate-800 rounded-xl p-6">
                        <h2 class="text-lg font-semibold text-white mb-4">⚙️ Status Management</h2>

                        @php
                        $currentStatus = $vehicleRequest->status->value ?? $vehicleRequest->status;
                        @endphp

                        <form action="{{ route('admin.vehicle-requests.update-status', $vehicleRequest->id) }}" method="POST">
                            @csrf
                            @method('PATCH')

                            <div class="mb-4">
                                <label for="status" class="block text-xs font-medium text-slate-400 mb-2">
                                    Change Status
                                </label>
                                <select name="status" id="status" class="w-full bg-slate-800 border border-slate-700 rounded-lg px-3 py-2 text-white text-sm focus:outline-none focus:border-blue-500">
                                    <option value="pending_review" {{ $currentStatus == 'pending_review' || $currentStatus == 'pending' ? 'selected' : '' }}>Pending Review</option>
                                    <option value="contacted" {{ $currentStatus == 'contacted' ? 'selected' : '' }}>Customer Contacted</option>
                                    <option value="scheduled" {{ $currentStatus == 'scheduled' ? 'selected' : '' }}>Scheduled / Confirmed</option>
                                    <option value="cancelled" {{ $currentStatus == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                </select>
                            </div>

                            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-500 text-white font-semibold py-2 px-4 rounded-lg text-sm transition">
                                Update Status
                            </button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
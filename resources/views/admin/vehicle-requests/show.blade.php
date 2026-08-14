<x-app-layout>
    <div class="min-h-screen bg-slate-950 text-slate-100 py-8 px-4 sm:px-6 lg:px-8">
        <div class="container mx-auto max-w-7xl">
            <!-- Header avec espace suffisant sous le Navbar -->
            <div class="flex items-center justify-between mb-8">
                <div>
                    <a href="{{ route('admin.vehicle-requests.index') }}" class="text-xs text-slate-400 hover:text-white transition inline-flex items-center gap-1 mb-3">
                        ← Back to requests
                    </a>
                    <h1 class="text-2xl font-bold text-white">Request #{{ $vehicleRequest->id }}</h1>
                    <p class="text-xs text-slate-400 mt-1">Submitted on {{ $vehicleRequest->created_at->format('M d, Y \a\t H:i') }}</p>
                </div>

                <!-- Status Badge -->
                <div>
                    <span class="px-3 py-1.5 rounded-full text-xs font-semibold bg-slate-800 text-slate-300 border border-slate-700">
                        Current status: <strong class="text-white uppercase">{{ $vehicleRequest->status->value ?? $vehicleRequest->status }}</strong>
                    </span>
                </div>
            </div>



            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                <!-- Left Column: Search Details & Applicant Info -->
                <div class="lg:col-span-2 space-y-6">

                    <!-- Vehicle Search Criteria -->
                    <div class="bg-slate-900 border border-slate-800 rounded-xl p-6">
                        <h2 class="text-lg font-semibold text-white mb-4 flex items-center gap-2">
                            🔍 Search Criteria / Vehicle Specifications
                        </h2>
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 text-sm">
                            <div>
                                <span class="text-slate-400 block text-xs">Make (Marque):</span>
                                <span class="text-white font-medium">{{ $vehicleRequest->make ?? 'Any' }}</span>
                            </div>
                            <div>
                                <span class="text-slate-400 block text-xs">Model (Modèle):</span>
                                <span class="text-white font-medium">{{ $vehicleRequest->model ?? 'Any' }}</span>
                            </div>
                            <div>
                                <span class="text-slate-400 block text-xs">Body Style (Carrosserie):</span>
                                <span class="text-white font-medium">{{ $vehicleRequest->body_style ?? 'N/A' }}</span>
                            </div>
                            <div>
                                <span class="text-slate-400 block text-xs">Year Range (Année):</span>
                                <span class="text-white font-medium">
                                    {{ $vehicleRequest->year_min ?? 'N/A' }} - {{ $vehicleRequest->year_max ?? 'N/A' }}
                                </span>
                            </div>
                            <div>
                                <span class="text-slate-400 block text-xs">Max Budget:</span>
                                <span class="text-emerald-400 font-bold">
                                    {{ $vehicleRequest->max_budget ? number_format($vehicleRequest->max_budget, 2) . ' €' : 'N/A' }}
                                </span>
                            </div>
                            <div>
                                <span class="text-slate-400 block text-xs">Desired Mileage:</span>
                                <span class="text-white font-medium">
                                    {{ $vehicleRequest->desired_mileage ? number_format($vehicleRequest->desired_mileage) . ' km' : 'N/A' }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Applicant Information -->
                    <div class="bg-slate-900 border border-slate-800 rounded-xl p-6">
                        <h2 class="text-lg font-semibold text-white mb-4 flex items-center gap-2">
                            👤 Applicant Information
                        </h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                            <div>
                                <span class="text-slate-400 block text-xs">Customer Name:</span>
                                <span class="text-white font-medium">
                                    {{ $vehicleRequest->name ?? $vehicleRequest->user->name ?? 'Guest User' }}
                                </span>
                            </div>
                            <div>
                                <span class="text-slate-400 block text-xs">Email Address:</span>
                                <span class="text-white font-medium">
                                    {{ $vehicleRequest->email ?? $vehicleRequest->user->email ?? 'N/A' }}
                                </span>
                            </div>
                            <div>
                                <span class="text-slate-400 block text-xs">Phone Number:</span>
                                <span class="text-white font-medium">{{ $vehicleRequest->phone ?? 'N/A' }}</span>
                            </div>
                            <div>
                                <span class="text-slate-400 block text-xs">Zip Code:</span>
                                <span class="text-white font-medium">{{ $vehicleRequest->zip_code ?? 'N/A' }}</span>
                            </div>
                        </div>
                    </div>

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
                                    @foreach(\App\Models\Enums\VehicleRequestStatus::cases() as $status)
                                    <option value="{{ $status->value }}" {{ $currentStatus === $status->value ? 'selected' : '' }}>
                                        {{ $status->label() }}
                                    </option>
                                    @endforeach
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
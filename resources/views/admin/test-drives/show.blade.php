<x-app-layout>
    <div class="py-12 bg-slate-900 text-white min-h-screen">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="flex items-center justify-between">
                <h2 class="font-extrabold text-2xl text-white">
                    Test Drive Details #TD-{{ $testDrive->id }}
                </h2>
                <a href="{{ route('admin.test-drives.index') }}" class="text-xs font-semibold px-3 py-2 bg-slate-800 hover:bg-slate-700 text-slate-300 rounded-xl transition">
                    &larr; Back to List
                </a>
            </div>

            @if(session('success'))
                <div class="p-4 bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 text-xs font-medium rounded-xl">
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Vehicle & Appointment Details -->
                <div class="md:col-span-2 space-y-6">
                    <div class="bg-slate-800/50 border border-slate-700/50 p-6 rounded-2xl shadow-xl backdrop-blur-xl">
                        <h3 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-4">Vehicle Information</h3>
                        <div class="flex items-start gap-4">
                            @if(optional($testDrive->vehicle)->image_url)
                                <img src="{{ $testDrive->vehicle->image_url }}" class="w-28 h-20 object-cover rounded-xl border border-slate-700" alt="Vehicle">
                            @endif
                            <div>
                                <h4 class="text-lg font-bold text-white">{{ $testDrive->vehicle->title ?? 'Vehicle Unavailable' }}</h4>
                                <p class="text-xs text-slate-400 mt-1">VIN: {{ $testDrive->vehicle->vin ?? 'N/A' }}</p>
                                <p class="text-sm font-bold text-emerald-400 mt-2">${{ number_format($testDrive->vehicle->price ?? 0) }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-slate-800/50 border border-slate-700/50 p-6 rounded-2xl shadow-xl backdrop-blur-xl">
                        <h3 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-4">Appointment Schedule</h3>
                        <div class="grid grid-cols-2 gap-4 text-xs">
                            <div class="bg-slate-900/60 p-4 rounded-xl border border-slate-700/40">
                                <span class="text-slate-400 block mb-1">Date</span>
                                <span class="font-bold text-white text-sm">{{ \Carbon\Carbon::parse($testDrive->date)->format('F d, Y') }}</span>
                            </div>
                            <div class="bg-slate-900/60 p-4 rounded-xl border border-slate-700/40">
                                <span class="text-slate-400 block mb-1">Visit Time</span>
                                <span class="font-bold text-white text-sm">{{ $testDrive->visit_time }}</span>
                            </div>
                        </div>

                        @if($testDrive->notes)
                            <div class="mt-4 pt-4 border-t border-slate-700/50">
                                <span class="text-xs text-slate-400 block mb-1">Customer Notes:</span>
                                <p class="text-xs text-slate-300 italic bg-slate-900/40 p-3 rounded-xl border border-slate-700/30">"{{ $testDrive->notes }}"</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Customer Details & Admin Action -->
                <div class="space-y-6">
                    <div class="bg-slate-800/50 border border-slate-700/50 p-6 rounded-2xl shadow-xl backdrop-blur-xl">
                        <h3 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-4">Customer Details</h3>
                        <div class="space-y-3 text-xs">
                            <div>
                                <span class="text-slate-400 block">Name</span>
                                <span class="font-semibold text-white">{{ $testDrive->user->name ?? 'Guest User' }}</span>
                            </div>
                            <div>
                                <span class="text-slate-400 block">Email</span>
                                <span class="font-semibold text-white">{{ $testDrive->user->email ?? 'N/A' }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="bg-slate-800/50 border border-slate-700/50 p-6 rounded-2xl shadow-xl backdrop-blur-xl">
                        <h3 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-4">Update Status</h3>
                        <form action="{{ route('admin.test-drives.update-status', $testDrive) }}" method="POST" class="space-y-4">
                            @csrf
                            @method('PATCH')
                            <div>
                                <select name="status" class="w-full bg-slate-900 border border-slate-700 text-xs font-medium text-white rounded-xl focus:ring-emerald-500 focus:border-emerald-500 p-2.5">
                                    <option value="pending" {{ $testDrive->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="confirmed" {{ $testDrive->status === 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                    <option value="completed" {{ $testDrive->status === 'completed' ? 'selected' : '' }}>Completed</option>
                                    <option value="cancelled" {{ $testDrive->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                </select>
                            </div>
                            <button type="submit" class="w-full py-2.5 bg-emerald-600 hover:bg-emerald-500 text-white font-semibold text-xs rounded-xl shadow-lg transition">
                                Save Status
                            </button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
<x-app-layout>
    <div class="py-12 bg-slate-900 text-white min-h-screen">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="flex items-center justify-between">
                <h2 class="font-extrabold text-2xl text-white">
                    {{ __('admin/test_drives.details_title') }} #TD-{{ $testDrive->id }}
                </h2>
                <a href="{{ route('admin.test-drives.index') }}" class="text-xs font-semibold px-3 py-2 bg-slate-800 hover:bg-slate-700 text-slate-300 rounded-xl transition">
                    &larr; {{ __('admin/test_drives.back_to_list') }}
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
                        <h3 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-4">{{ __('admin/test_drives.vehicle_info') }}</h3>
                        <div class="flex items-start gap-4">
                            @if(optional($testDrive->vehicle)->image_url)
                                <img src="{{ $testDrive->vehicle->image_url }}" class="w-28 h-20 object-cover rounded-xl border border-slate-700" alt="Vehicle">
                            @endif
                            <div>
                                <h4 class="text-lg font-bold text-white">{{ $testDrive->vehicle->title ?? __('admin/test_drives.vehicle_unavailable') }}</h4>
                                <p class="text-xs text-slate-400 mt-1">VIN: {{ $testDrive->vehicle->vin ?? 'N/A' }}</p>
                                <p class="text-sm font-bold text-emerald-400 mt-2">${{ number_format($testDrive->vehicle->price ?? 0) }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-slate-800/50 border border-slate-700/50 p-6 rounded-2xl shadow-xl backdrop-blur-xl">
                        <h3 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-4">{{ __('admin/test_drives.appointment_schedule') }}</h3>
                        <div class="grid grid-cols-2 gap-4 text-xs">
                            <div class="bg-slate-900/60 p-4 rounded-xl border border-slate-700/40">
                                <span class="text-slate-400 block mb-1">{{ __('admin/test_drives.date') }}</span>
                                <span class="font-bold text-white text-sm">{{ \Carbon\Carbon::parse($testDrive->date)->format('F d, Y') }}</span>
                            </div>
                            <div class="bg-slate-900/60 p-4 rounded-xl border border-slate-700/40">
                                <span class="text-slate-400 block mb-1">{{ __('admin/test_drives.visit_time') }}</span>
                                <span class="font-bold text-white text-sm">{{ $testDrive->visit_time }}</span>
                            </div>
                        </div>

                        @if($testDrive->notes)
                            <div class="mt-4 pt-4 border-t border-slate-700/50">
                                <span class="text-xs text-slate-400 block mb-1">{{ __('admin/test_drives.customer_notes') }}</span>
                                <p class="text-xs text-slate-300 italic bg-slate-900/40 p-3 rounded-xl border border-slate-700/30">"{{ $testDrive->notes }}"</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Customer Details & Admin Action -->
                <div class="space-y-6">
                    <div class="bg-slate-800/50 border border-slate-700/50 p-6 rounded-2xl shadow-xl backdrop-blur-xl">
                        <h3 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-4">{{ __('admin/test_drives.customer_details') }}</h3>
                        <div class="space-y-3 text-xs">
                            <div>
                                <span class="text-slate-400 block">{{ __('admin/test_drives.name') }}</span>
                                <span class="font-semibold text-white">{{ $testDrive->user->name ?? __('admin/test_drives.guest_user') }}</span>
                            </div>
                            <div>
                                <span class="text-slate-400 block">{{ __('admin/test_drives.email') }}</span>
                                <span class="font-semibold text-white">{{ $testDrive->user->email ?? 'N/A' }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="bg-slate-800/50 border border-slate-700/50 p-6 rounded-2xl shadow-xl backdrop-blur-xl">
                        <h3 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-4">{{ __('admin/test_drives.update_status') }}</h3>
                        <form action="{{ route('admin.test-drives.update-status', $testDrive) }}" method="POST" class="space-y-4">
                            @csrf
                            @method('PATCH')
                            @php
                                $currentStatus = is_object($testDrive->status) && method_exists($testDrive->status, 'value') ? $testDrive->status->value : (string) $testDrive->status;
                            @endphp
                            <div>
                                <select name="status" class="w-full bg-slate-900 border border-slate-700 text-xs font-medium text-white rounded-xl focus:ring-emerald-500 focus:border-emerald-500 p-2.5">
                                    <option value="pending" {{ $currentStatus === 'pending' ? 'selected' : '' }}>{{ __('admin/test_drives.statuses.pending') }}</option>
                                    <option value="confirmed" {{ $currentStatus === 'confirmed' ? 'selected' : '' }}>{{ __('admin/test_drives.statuses.confirmed') }}</option>
                                    <option value="completed" {{ $currentStatus === 'completed' ? 'selected' : '' }}>{{ __('admin/test_drives.statuses.completed') }}</option>
                                    <option value="cancelled" {{ $currentStatus === 'cancelled' ? 'selected' : '' }}>{{ __('admin/test_drives.statuses.cancelled') }}</option>
                                </select>
                            </div>
                            <button type="submit" class="w-full py-2.5 bg-emerald-600 hover:bg-emerald-500 text-white font-semibold text-xs rounded-xl shadow-lg transition">
                                {{ __('admin/test_drives.save_status') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
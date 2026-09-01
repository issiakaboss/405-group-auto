<x-app-layout>
    <div class="py-12 bg-slate-900 text-white min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <div class="flex justify-between items-center">
                <div>
                    <h2 class="text-3xl font-extrabold text-white">{{ __('admin/test_drives.title') }}</h2>
                    <p class="text-slate-400 text-sm mt-1">{{ __('admin/test_drives.subtitle') }}</p>
                </div>
            </div>

            @if(session('success'))
                <div class="p-4 bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 text-xs font-medium rounded-xl">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-slate-800/50 border border-slate-700/50 rounded-2xl overflow-hidden shadow-xl backdrop-blur-xl">
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm text-slate-300">
                        <thead class="bg-slate-900/60 uppercase text-xs font-semibold tracking-wider text-slate-400">
                            <tr>
                                <th class="px-6 py-4">{{ __('admin/test_drives.vehicle') }}</th>
                                <th class="px-6 py-4">{{ __('admin/test_drives.customer') }}</th>
                                <th class="px-6 py-4">{{ __('admin/test_drives.date_time') }}</th>
                                <th class="px-6 py-4">{{ __('admin/test_drives.status') }}</th>
                                <th class="px-6 py-4 text-right">{{ __('admin/test_drives.action') }}</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-700/50">
                            @forelse($testDrives as $drive)
                                <tr class="hover:bg-slate-800/80 transition-colors">
                                    <td class="px-6 py-4 font-bold text-white">
                                        {{ $drive->vehicle->title ?? 'N/A' }}
                                    </td>
                                    <td class="px-6 py-4 text-slate-300">
                                        {{ $drive->user->name ?? __('admin/test_drives.guest_user') }} <br>
                                        <span class="text-xs text-slate-400">{{ $drive->user->email ?? '' }}</span>
                                    </td>
                                    <td class="px-6 py-4 text-slate-300">
                                        {{ \Carbon\Carbon::parse($drive->date)->format('M d, Y') }} <br>
                                        <span class="text-xs font-semibold text-slate-400">{{ $drive->visit_time }}</span>
                                    </td>
                                    <td class="px-6 py-4">
                                        @php
                                            $statusValue = is_object($drive->status) && method_exists($drive->status, 'value') ? $drive->status->value : (string) $drive->status;
                                            $badgeClass = match($statusValue) {
                                                'confirmed' => 'bg-emerald-500/10 text-emerald-400 border-emerald-500/20',
                                                'pending'   => 'bg-amber-500/10 text-amber-400 border-amber-500/20',
                                                'cancelled' => 'bg-rose-500/10 text-rose-400 border-rose-500/20',
                                                'completed' => 'bg-blue-500/10 text-blue-400 border-blue-500/20',
                                                default     => 'bg-slate-500/10 text-slate-400 border-slate-500/20',
                                            };
                                        @endphp
                                        <span class="px-3 py-1 rounded-full text-xs font-semibold border {{ $badgeClass }}">
                                            {{ __('admin/test_drives.statuses.' . $statusValue) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <a href="{{ route('admin.test-drives.show', $drive) }}" class="text-xs font-bold px-3 py-1.5 bg-slate-700 hover:bg-slate-600 rounded-lg text-slate-200 transition">
                                            {{ __('admin/test_drives.view_details') }}
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-12 text-center text-slate-500">
                                        {{ __('admin/test_drives.no_appointments') }}
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            @if(method_exists($testDrives, 'links'))
                <div class="mt-6">
                    {{ $testDrives->links() }}
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
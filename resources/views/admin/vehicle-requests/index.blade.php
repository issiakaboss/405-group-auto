<x-app-layout>
    <div class="py-12 bg-slate-900 text-white min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <div class="flex justify-between items-center">
                <div>
                    <h2 class="text-3xl font-extrabold text-white">{{ __('admin/vehicle_requests.title') }}</h2>
                    <p class="text-slate-400 text-sm mt-1">{{ __('admin/vehicle_requests.subtitle') }}</p>
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
                                <th class="px-6 py-4">{{ __('admin/vehicle_requests.customer') }}</th>
                                <th class="px-6 py-4">{{ __('admin/vehicle_requests.desired_vehicle') }}</th>
                                <th class="px-6 py-4">{{ __('admin/vehicle_requests.budget') }}</th>
                                <th class="px-6 py-4">{{ __('admin/vehicle_requests.location') }}</th>
                                <th class="px-6 py-4">{{ __('admin/vehicle_requests.submitted') }}</th>
                                <th class="px-6 py-4 text-right">{{ __('admin/vehicle_requests.actions') }}</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-700/50">
                            @forelse($vehicleRequests as $request)
                            <tr class="hover:bg-slate-800/80 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="font-bold text-white">{{ $request->name }}</div>
                                    <div class="text-xs text-slate-400">{{ $request->email }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="font-medium text-white">{{ $request->make }} {{ $request->model }}</div>
                                    <div class="text-xs text-slate-400">{{ $request->body_style ?? 'N/A' }}</div>
                                </td>
                                <td class="px-6 py-4 font-bold text-emerald-400">
                                    ${{ number_format($request->max_budget ?? 0) }}
                                </td>
                                <td class="px-6 py-4 text-slate-300">
                                    {{ $request->zip_code }}
                                </td>
                                <td class="px-6 py-4 text-xs text-slate-400">
                                    {{ $request->created_at->format('d/m/Y H:i') }}
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <a href="{{ route('admin.vehicle-requests.show', $request) }}" class="text-xs font-bold px-3 py-1.5 bg-slate-700 hover:bg-slate-600 rounded-lg text-slate-200 transition">
                                        {{ __('admin/vehicle_requests.view_details') }}
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center text-slate-500">
                                    {{ __('admin/vehicle_requests.no_requests') }}
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            @if(method_exists($vehicleRequests, 'links'))
                <div class="mt-6">
                    {{ $vehicleRequests->links() }}
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
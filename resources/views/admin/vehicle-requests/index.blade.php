<x-app-layout>
    <div class="py-12 bg-slate-900 text-white min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="flex justify-between items-center mb-8">
                <div>
                    <h2 class="text-3xl font-extrabold text-white">Vehicle Requests</h2>
                    <p class="text-slate-400 text-sm mt-1">Custom vehicle finder submissions from site visitors.</p>
                </div>
            </div>

            <div class="bg-slate-800/50 border border-slate-700/50 rounded-2xl overflow-hidden shadow-xl backdrop-blur-xl">
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm text-slate-300">
                        <thead class="bg-slate-900/60 uppercase text-xs font-semibold tracking-wider text-slate-400">
                            <tr>
                                <th class="px-6 py-4">Customer</th>
                                <th class="px-6 py-4">Desired Vehicle</th>
                                <th class="px-6 py-4">Budget</th>
                                <th class="px-6 py-4">Location</th>
                                <th class="px-6 py-4">Submitted</th>
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
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center text-slate-500">
                                    No custom vehicle requests yet.
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
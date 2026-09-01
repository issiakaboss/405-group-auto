<x-app-layout>
    <div class="py-12 bg-slate-900 text-white min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Message de succès -->
            @if(session('success'))
            <div class="mb-6 p-4 bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 rounded-xl">
                {{ session('success') }}
            </div>
            @endif

            <div class="flex justify-between items-center mb-8">
                <div>
                    <h2 class="text-3xl font-extrabold text-white">{{ __('admin/orders.title') }}</h2>
                    <p class="text-slate-400 text-sm mt-1">{{ __('admin/orders.subtitle') }}</p>
                </div>
            </div>

            <div class="bg-slate-800/50 border border-slate-700/50 rounded-2xl overflow-hidden shadow-xl backdrop-blur-xl">
                <table class="w-full text-left text-sm text-slate-300">
                    <thead class="bg-slate-900/60 uppercase text-xs font-semibold tracking-wider text-slate-400">
                        <tr>
                            <th class="px-6 py-4">{{ __('admin/orders.columns.id_date') }}</th>
                            <th class="px-6 py-4">{{ __('admin/orders.columns.customer') }}</th>
                            <th class="px-6 py-4">{{ __('admin/orders.columns.contact') }}</th>
                            <th class="px-6 py-4">{{ __('admin/orders.columns.total_amount') }}</th>
                            <th class="px-6 py-4">{{ __('admin/orders.columns.current_status') }}</th>
                            <th class="px-6 py-4 text-right">{{ __('admin/orders.columns.action') }}</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-700/50">
                        @forelse($orders as $order)
                        <tr class="hover:bg-slate-800/80 transition-colors">
                            <!-- ID & Date -->
                            <td class="px-6 py-4">
                                <div class="font-bold text-white">#ORD-{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</div>
                                <div class="text-xs text-slate-400">{{ \Carbon\Carbon::parse($order->created_at)->format('d/m/Y H:i') }}</div>
                            </td>

                            <!-- Client -->
                            <td class="px-6 py-4">
                                <div class="font-medium text-white">{{ $order->customer_name }}</div>
                                <div class="text-xs text-slate-400">{{ $order->customer_email }}</div>
                            </td>

                            <!-- Contact & Adresse -->
                            <td class="px-6 py-4">
                                <div class="text-slate-300">{{ $order->phone }}</div>
                                <div class="text-xs text-slate-400 truncate max-w-xs">{{ $order->address }}</div>
                            </td>

                            <!-- Montant -->
                            <td class="px-6 py-4 font-bold text-emerald-400">
                                ${{ number_format($order->total_estimated_price, 2) }}
                            </td>

                            <!-- Statut Badge -->
                            <td class="px-6 py-4">
                                @php
                                $statusValue = $order->status->value ?? $order->status;
                                $statusClass = match($statusValue) {
                                'pending_review' => 'bg-amber-500/10 text-amber-400 border-amber-500/20',
                                'confirmed' => 'bg-blue-500/10 text-blue-400 border-blue-500/20',
                                'shipping' => 'bg-purple-500/10 text-purple-400 border-purple-500/20',
                                'delivered' => 'bg-emerald-500/10 text-emerald-400 border-emerald-500/20',
                                'cancelled' => 'bg-rose-500/10 text-rose-400 border-rose-500/20',
                                default => 'bg-slate-500/10 text-slate-400 border-slate-500/20',
                                };
                                @endphp
                                <span class="px-3 py-1 text-xs font-semibold rounded-full border {{ $statusClass }}">
                                    {{ __('admin/orders.statuses.' . $statusValue) }}
                                </span>
                            </td>

                            <!-- Modifier le Statut -->
                            <td class="px-6 py-4 text-right">
                                <form action="{{ route('admin.orders.update-status', $order->id) }}" method="POST" class="inline-flex items-center gap-2">
                                    @csrf
                                    @method('PATCH')
                                    <select name="status" onchange="this.form.submit()" class="bg-slate-900 border border-slate-700 text-xs text-white rounded-lg px-2 py-1.5 focus:ring-amber-500 focus:border-amber-500">
                                        @foreach(['pending_review', 'confirmed', 'shipping', 'delivered', 'cancelled'] as $st)
                                            <option value="{{ $st }}" {{ ($order->status->value ?? $order->status) === $st ? 'selected' : '' }}>
                                                {{ __('admin/orders.statuses.' . $st) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-slate-500">
                                {{ __('admin/orders.empty') }}
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-6">
                {{ $orders->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
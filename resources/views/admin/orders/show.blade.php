<x-app-layout>
    <div class="py-12 bg-slate-900 text-white min-h-screen">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="flex items-center justify-between">
                <h2 class="font-extrabold text-2xl text-white">
                    Order Details #ORD-{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}
                </h2>
                <a href="{{ route('admin.orders.index') }}" class="text-xs font-semibold px-3 py-2 bg-slate-800 hover:bg-slate-700 text-slate-300 rounded-xl transition">
                    &larr; Back to Orders List
                </a>
            </div>

            @if(session('success'))
                <div class="p-4 bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 text-xs font-medium rounded-xl">
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Contenu de la Commande -->
                <div class="md:col-span-2 space-y-6">
                    <div class="bg-slate-800/50 border border-slate-700/50 p-6 rounded-2xl shadow-xl backdrop-blur-xl">
                        <h3 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-4">Ordered Items</h3>
                        <div class="divide-y divide-slate-700/50">
                            @foreach($order->items as $item)
                                <div class="py-3 flex justify-between items-center text-xs">
                                    <div>
                                        <p class="font-bold text-white text-sm">{{ $item->title ?? $item->vehicle_name }}</p>
                                        <p class="text-slate-400">Qty: {{ $item->quantity }}</p>
                                    </div>
                                    <p class="font-bold text-emerald-400 text-sm">${{ number_format($item->price, 2) }}</p>
                                </div>
                            @endforeach
                        </div>
                        <div class="mt-6 pt-4 border-t border-slate-700/50 flex justify-between items-center">
                            <span class="text-xs font-bold text-slate-400 uppercase">Total Amount</span>
                            <span class="text-xl font-black text-emerald-400">${{ number_format($order->total_estimated_price, 2) }}</span>
                        </div>
                    </div>
                </div>

                <!-- Informations Client & Traitement du Statut -->
                <div class="space-y-6">
                    <div class="bg-slate-800/50 border border-slate-700/50 p-6 rounded-2xl shadow-xl backdrop-blur-xl">
                        <h3 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-4">Customer Info</h3>
                        <div class="space-y-3 text-xs">
                            <div>
                                <span class="text-slate-400 block">Name</span>
                                <span class="font-semibold text-white">{{ $order->customer_name }}</span>
                            </div>
                            <div>
                                <span class="text-slate-400 block">Email</span>
                                <span class="font-semibold text-white">{{ $order->customer_email }}</span>
                            </div>
                            <div>
                                <span class="text-slate-400 block">Phone</span>
                                <span class="font-semibold text-white">{{ $order->phone }}</span>
                            </div>
                            <div>
                                <span class="text-slate-400 block">Address</span>
                                <span class="font-semibold text-slate-300">{{ $order->address }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="bg-slate-800/50 border border-slate-700/50 p-6 rounded-2xl shadow-xl backdrop-blur-xl">
                        <h3 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-4">Update Order Status</h3>
                        <form action="{{ route('admin.orders.update-status', $order->id) }}" method="POST" class="space-y-4">
                            @csrf
                            @method('PATCH')
                            <select name="status" class="w-full bg-slate-900 border border-slate-700 text-xs font-medium text-white rounded-xl focus:ring-emerald-500 focus:border-emerald-500 p-2.5">
                                <option value="pending_review" {{ $order->status === 'pending_review' ? 'selected' : '' }}>En revue</option>
                                <option value="confirmed" {{ $order->status === 'confirmed' ? 'selected' : '' }}>Confirmée</option>
                                <option value="shipping" {{ $order->status === 'shipping' ? 'selected' : '' }}>En Transit / Shipping</option>
                                <option value="delivered" {{ $order->status === 'delivered' ? 'selected' : '' }}>Livrée</option>
                                <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>Annulée</option>
                            </select>
                            <button type="submit" class="w-full py-2.5 bg-emerald-600 hover:bg-emerald-500 text-white font-semibold text-xs rounded-xl shadow-lg transition">
                                Update Order
                            </button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
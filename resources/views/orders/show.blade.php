<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-bold text-xl text-gray-800 leading-tight">
                {{ __('Order Details') }} #ORD-{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}
            </h2>
            <a href="{{ route('dashboard') }}" class="text-xs font-semibold px-3 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg transition">
                ← Back to Dashboard
            </a>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-50/50 min-h-[80vh]">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Card Informations Générales -->
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex flex-col md:flex-row justify-between gap-4">
                <div>
                    <p class="text-xs text-gray-400 uppercase font-bold tracking-wider">Order Reference</p>
                    <p class="text-lg font-extrabold text-gray-900">#ORD-{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</p>
                    <p class="text-xs text-gray-500 mt-1">Placed on {{ \Carbon\Carbon::parse($order->created_at)->format('F d, Y \a\t H:i') }}</p>
                </div>
                <div>
                    <p class="text-xs text-gray-400 uppercase font-bold tracking-wider mb-1">Status</p>
                    <span class="inline-flex items-center px-3 py-1 text-xs font-bold rounded-full uppercase tracking-wider bg-slate-100 text-slate-800 border border-slate-200">
                        {{ is_object($order->status) ? $order->status->value : $order->status }}
                    </span>
                </div>
            </div>

            <!-- Card Articles Commandés -->
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                <h3 class="text-sm font-bold text-gray-900 mb-4 pb-2 border-b border-gray-100">Requested Vehicles / Items</h3>
                <div class="divide-y divide-gray-100">
                    @foreach($order->items as $item)
                    <div class="py-3 flex justify-between items-center text-xs">
                        <div>
                            <p class="font-bold text-gray-800 text-sm">{{ $item->title ?? $item->vehicle_name }}</p>
                            <p class="text-gray-400">Quantity: {{ $item->quantity }}</p>
                        </div>
                        <p class="font-bold text-emerald-600 text-sm">${{ number_format($item->price, 2) }}</p>
                    </div>
                    @endforeach
                </div>

                <div class="mt-6 pt-4 border-t border-gray-100 flex justify-between items-center">
                    <span class="text-xs font-bold text-gray-500 uppercase">Total Estimated Price</span>
                    <span class="text-lg font-black text-emerald-600">${{ number_format($order->total_estimated_price, 2) }}</span>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50/50 min-h-[80vh]">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-gray-100 p-8">

                <div class="mb-6">
                    <h3 class="text-lg font-bold text-gray-900">My Import Orders</h3>
                    <p class="text-xs text-gray-400 mt-1">Track the status of your transatlantic vehicle acquisitions.</p>
                </div>

                @if($orders->isEmpty())
                <div class="text-center py-12 border border-dashed border-gray-200 rounded-2xl bg-gray-50/30">
                    <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-gray-100 text-gray-400 mb-3">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 0 1-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124l-.09-1.43c-.092-1.474-1.321-2.613-2.797-2.613H16.5V14.25m0 4.5V14.25m0 0V9m0 0a2.25 2.25 0 0 0-2.25-2.25h-1.354a2.25 2.25 0 0 0-2.078 1.402l-.422 1.055a2.25 2.25 0 0 1-2.078 1.402H6.75m12 0h-1.5M6.75 14.25v-3.375c0-.621.504-1.125 1.125-1.125h2.25M3 14.25h13.5" />
                        </svg>
                    </div>
                    <p class="text-xs font-semibold text-gray-600">No active orders</p>
                    <p class="text-[11px] text-gray-400 mt-0.5">Your luxury car garage is currently empty.</p>
                    <a href="{{ route('home') }}" class="inline-block mt-4 px-4 py-2 bg-gray-900 text-white rounded-xl font-medium text-xs shadow-sm hover:bg-gray-800 transition tracking-wide uppercase">
                        Explore Showroom
                    </a>
                </div>
                @else
                <div class="overflow-x-auto rounded-xl border border-gray-100 shadow-sm bg-white">
                    <table class="w-full text-left border-collapse text-xs">
                        <thead>
                            <tr class="bg-gray-50 text-gray-400 font-semibold uppercase tracking-wider border-b border-gray-100">
                                <th class="p-4">Order ID</th>
                                <th class="p-4">Date</th>
                                <th class="p-4">Delivery Address</th>
                                <th class="p-4">Phone</th>
                                <th class="p-4">Total Price</th>
                                <th class="p-4 text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 text-gray-600">
                            @foreach($orders as $order)
                            <tr class="hover:bg-gray-50/40 transition">
                                <td class="p-4 font-bold text-gray-900 tracking-wide">
                                    #405-{{ $order->id }}
                                </td>
                                <td class="p-4 text-gray-500 whitespace-nowrap">
                                    {{ \Carbon\Carbon::parse($order->created_at)->format('M d, Y') }}
                                </td>
                                <td class="p-4 max-w-xs truncate font-medium text-gray-700" title="{{ $order->address }}">
                                    {{ $order->address }}
                                </td>
                                <td class="p-4 font-mono text-gray-500 whitespace-nowrap">
                                    {{ $order->phone }}
                                </td>
                                <td class="p-4 font-bold text-gray-900 text-sm whitespace-nowrap">
                                    ${{ number_format($order->total) }}
                                </td>
                                <td class="p-4 text-center whitespace-nowrap">
                                    @if($order->status === 'pending_review')
                                    <span class="inline-flex items-center px-2.5 py-1 text-[10px] font-semibold bg-amber-50 text-amber-700 rounded-full border border-amber-200/50 uppercase tracking-wider">
                                        <span class="w-1.5 h-1.5 bg-amber-500 rounded-full mr-1.5 animate-pulse"></span>
                                        Pending Review
                                    </span>
                                    @else
                                    <span class="inline-flex items-center px-2.5 py-1 text-[10px] font-semibold bg-emerald-50 text-emerald-700 rounded-full border border-emerald-200/50 uppercase tracking-wider">
                                        <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full mr-1.5"></span>
                                        {{ str_replace('_', ' ', $order->status) }}
                                    </span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>
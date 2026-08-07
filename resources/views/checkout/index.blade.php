<x-guest-layout>
    <div class="max-w-5xl mx-auto px-4 py-12">
        <h1 class="text-2xl font-bold mb-2">Request Vehicle Inspection & Quote</h1>
        <p class="text-gray-500 text-sm mb-8">Submit your contact info to schedule a test drive or request import details. No payment is required today.</p>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">

            <!-- Messages d'erreur / Flash -->
            @if (session('error'))
            <div class="mb-4 p-4 text-sm text-red-800 bg-red-100 rounded-lg">
                {{ session('error') }}
            </div>
            @endif

            @if ($errors->any())
            <div class="mb-4 p-4 text-sm text-red-800 bg-red-100 rounded-lg">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <!-- Formulaire de réservation -->
            <form action="{{ route('checkout.store') }}" method="POST" class="space-y-4 text-xs">
                @csrf
                <h3 class="font-bold text-sm border-b pb-2">Your Contact & Delivery Information</h3>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block font-semibold text-gray-700 mb-1">Full Name</label>
                        <input type="text" value="{{ auth()->user()->name ?? auth()->user()->first_name ?? 'Customer' }}" disabled class="w-full bg-gray-100 border-gray-200 rounded-xl p-2.5 text-gray-600">
                    </div>
                    <div>
                        <label class="block font-semibold text-gray-700 mb-1">Phone Number</label>
                        <input type="text" name="phone" value="{{ old('phone') }}" required class="w-full border-gray-200 rounded-xl p-2.5">
                    </div>
                </div>

                <div>
                    <label class="block font-semibold text-gray-700 mb-1">Street Address</label>
                    <input type="text" name="address" value="{{ old('address') }}" required class="w-full border-gray-200 rounded-xl p-2.5">
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block font-semibold text-gray-700 mb-1">City</label>
                        <input type="text" name="city" value="{{ old('city') }}" required class="w-full border-gray-200 rounded-xl p-2.5">
                    </div>
                    <div>
                        <label class="block font-semibold text-gray-700 mb-1">Country</label>
                        <input type="text" name="country" value="{{ old('country') }}" required class="w-full border-gray-200 rounded-xl p-2.5">
                    </div>
                </div>

                <button type="submit" class="w-full py-3.5 bg-[#0F172A] text-white font-bold rounded-xl mt-4 text-xs uppercase tracking-wider shadow hover:bg-slate-800 transition">
                    Submit Reservation Request
                </button>
            </form>

            <!-- Récapitulatif des véhicules sélectionnés -->
            <div class="bg-gray-50 p-6 rounded-2xl h-fit space-y-4">
                <h4 class="font-bold text-sm">Selected Vehicles Summary</h4>
                @foreach($cart as $item)
                <div class="flex justify-between items-center text-xs">
                    <span>{{ $item['title'] }} (x{{ $item['quantity'] ?? 1 }})</span>
                    <span class="font-bold">${{ number_format($item['price'] * ($item['quantity'] ?? 1)) }}</span>
                </div>
                @endforeach
                <hr>
                <div class="flex justify-between font-bold text-sm">
                    <span>Estimated Vehicle Value</span>
                    <span>${{ number_format($subtotal ?? $total) }}</span>
                </div>
                <p class="text-xs text-gray-500 italic mt-2">
                    * Final pricing, shipping fees, and test-drive appointments will be confirmed by our team after request submission.
                </p>
            </div>
        </div>
    </div>
</x-guest-layout>
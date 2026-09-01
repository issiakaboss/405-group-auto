<x-guest-layout>
    <div class="max-w-5xl mx-auto px-4 py-12">
        <h1 class="text-2xl font-bold mb-2">{{ __('public/checkout.title') }}</h1>
        <p class="text-gray-500 text-sm mb-8">{{ __('public/checkout.subtitle') }}</p>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">

            <!-- Messages d'erreur / Flash -->
            <div>
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
                    <h3 class="font-bold text-sm border-b pb-2">{{ __('public/checkout.contact_info_title') }}</h3>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block font-semibold text-gray-700 mb-1">{{ __('public/checkout.full_name') }}</label>
                            <input type="text" value="{{ auth()->user()->name ?? auth()->user()->first_name ?? 'Customer' }}" disabled class="w-full bg-gray-100 border-gray-200 rounded-xl p-2.5 text-gray-600">
                        </div>
                        <div>
                            <label class="block font-semibold text-gray-700 mb-1">{{ __('public/checkout.phone_number') }}</label>
                            <input type="text" name="phone" value="{{ old('phone') }}" required class="w-full border-gray-200 rounded-xl p-2.5">
                        </div>
                    </div>

                    <div>
                        <label class="block font-semibold text-gray-700 mb-1">{{ __('public/checkout.street_address') }}</label>
                        <input type="text" name="address" value="{{ old('address') }}" required class="w-full border-gray-200 rounded-xl p-2.5">
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block font-semibold text-gray-700 mb-1">{{ __('public/checkout.city') }}</label>
                            <input type="text" name="city" value="{{ old('city') }}" required class="w-full border-gray-200 rounded-xl p-2.5">
                        </div>
                        <div>
                            <label class="block font-semibold text-gray-700 mb-1">{{ __('public/checkout.country') }}</label>
                            <input type="text" name="country" value="{{ old('country') }}" required class="w-full border-gray-200 rounded-xl p-2.5">
                        </div>
                    </div>

                    <button type="submit" class="w-full py-3.5 bg-[#0F172A] text-white font-bold rounded-xl mt-4 text-xs uppercase tracking-wider shadow hover:bg-slate-800 transition">
                        {{ __('public/checkout.submit_btn') }}
                    </button>
                </form>
            </div>

            <!-- Récapitulatif des véhicules sélectionnés -->
            <div class="bg-gray-50 p-6 rounded-2xl h-fit space-y-4 border border-gray-100">
                <h4 class="font-bold text-sm">{{ __('public/checkout.summary_title') }}</h4>
                @foreach($cart as $item)
                <div class="flex justify-between items-center text-xs">
                    <span>{{ $item['title'] }} (x{{ $item['quantity'] ?? 1 }})</span>
                    <span class="font-bold">${{ number_format($item['price'] * ($item['quantity'] ?? 1)) }}</span>
                </div>
                @endforeach
                <hr class="border-gray-200">
                <div class="flex justify-between font-bold text-sm">
                    <span>{{ __('public/checkout.estimated_value') }}</span>
                    <span>${{ number_format($subtotal ?? $total) }}</span>
                </div>
                <p class="text-xs text-gray-500 italic mt-2">
                    {{ __('public/checkout.disclaimer') }}
                </p>
            </div>
        </div>
    </div>
</x-guest-layout>
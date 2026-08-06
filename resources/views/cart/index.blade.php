<x-guest-layout>
    <div x-data="{ 
            testDriveModal: false, 
            selectedVehicleId: null, 
            selectedVehicleTitle: ''
         }"
        class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12"
        @keydown.escape.window="testDriveModal = false">

        <!-- HEADER DU PANIER -->
        <div class="flex items-center justify-between mb-8">
            <h1 class="text-3xl font-bold text-gray-900 tracking-tight">Shopping Cart</h1>

            <!-- Bouton Tout Nettoyer (affiché seulement si le panier n'est pas vide) -->
            <button type="button" 
                id="btn-clear-cart"
                x-data
                @click="$dispatch('open-modal-clear-cart')"
                class="{{ count($cart) > 0 ? '' : 'hidden' }} inline-flex items-center gap-2 text-xs font-semibold text-red-600 hover:text-red-700 bg-red-50 hover:bg-red-100 px-3.5 py-2 rounded-xl transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                </svg>
                Clear Cart
            </button>
        </div>

        <!-- CONTENEUR DU PANIER AVEC ARTICLES -->
        <div id="cart-container" class="{{ count($cart) > 0 ? '' : 'hidden' }}">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">

                <!-- LISTE DES ARTICLES -->
                <div class="lg:col-span-2 space-y-4" id="cart-items-list">
                    @foreach($cart as $id => $item)
                    <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm flex flex-col sm:flex-row items-start sm:items-center justify-between gap-6 relative item-row" data-id="{{ $id }}">

                        <div class="flex flex-col sm:flex-row items-start sm:items-center gap-6 w-full sm:w-auto">
                            <div class="w-full sm:w-40 h-32 sm:h-28 bg-gray-50 rounded-xl overflow-hidden flex-shrink-0">
                                <img src="{{ $item['image'] }}" class="w-full h-full object-cover" alt="{{ $item['title'] }}">
                            </div>

                            <div class="space-y-3 w-full sm:w-auto">
                                <div>
                                    <h4 class="font-bold text-gray-900 text-lg leading-snug">{{ $item['title'] }}</h4>
                                    <p class="text-sm text-gray-400 font-medium mt-0.5">
                                        {{ $item['year'] ?? '' }} &bull; {{ number_format((float)($item['mileage'] ?? 0)) }} miles
                                    </p>
                                    <p class="text-xs text-gray-400 mt-0.5">
                                        {{ $item['category'] ?? '' }} &bull; {{ $item['fuel_type'] ?? 'Gasoline' }}
                                    </p>
                                </div>

                                <div class="flex flex-wrap items-center gap-2 pt-1">
                                    <a href="{{ route('vehicles.show', $item['id'] ?? $id) }}" class="text-xs font-semibold px-3.5 py-2 border border-gray-200 rounded-xl text-gray-700 hover:bg-gray-50 transition shadow-sm">View Details</a>

                                    <button
                                        type="button"
                                        @click="testDriveModal = true; selectedVehicleId = '{{ $item['id'] ?? $id }}'; selectedVehicleTitle = '{{ addslashes($item['title']) }}'"
                                        class="text-xs font-semibold px-3.5 py-2 border border-gray-200 rounded-xl text-gray-700 hover:bg-gray-50 transition shadow-sm">
                                        Schedule Test Drive
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Prix & Bouton Supprimer -->
                        <div class="flex sm:flex-col items-center sm:items-end justify-between sm:justify-between w-full sm:w-auto sm:h-28 border-t sm:border-t-0 pt-4 sm:pt-0 border-gray-100">
                            <button type="button"
                                x-data
                                @click="$dispatch('open-modal-delete-cart-item', '{{ $id }}')"
                                class="text-gray-400 hover:text-red-500 transition p-1.5 rounded-lg hover:bg-red-50"
                                title="Remove item">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                </svg>
                            </button>

                            <span class="font-black text-gray-900 text-xl tracking-tight">
                                ${{ number_format($item['price']) }}
                            </span>
                        </div>

                    </div>
                    @endforeach
                </div>

                <!-- RÉSUMÉ DE COMMANDE -->
                <div class="space-y-6">
                    <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm space-y-5 sticky top-6">
                        <h3 class="font-bold text-gray-900 text-base">Selection Summary</h3>

                        <div class="space-y-3 text-sm">
                            <div class="flex justify-between text-gray-500">
                                <span id="summary-text">Vehicles selected (<span id="summary-count">{{ count($cart) }}</span> <span id="summary-unit">{{ count($cart) > 1 ? 'cars' : 'car' }}</span>)</span>
                                <span class="font-semibold text-gray-900" id="summary-subtotal">${{ number_format($total) }}</span>
                            </div>
                            <div class="flex justify-between text-gray-500">
                                <span>Inquiry Review</span>
                                <span class="text-emerald-600 font-bold">No payment</span>
                            </div>

                            <hr class="border-gray-100 my-4">

                            <div class="flex justify-between text-lg font-black text-gray-900">
                                <span>Total</span>
                                <span id="summary-total">${{ number_format($total) }}</span>
                            </div>
                        </div>

                        <div class="space-y-2.5 pt-2">
                            <a href="{{ route('checkout.index') }}" class="w-full py-3.5 px-4 bg-[#0F172A] hover:bg-gray-800 text-white font-semibold text-xs rounded-xl shadow-sm transition tracking-wide flex items-center justify-center space-x-2 text-center">
                                <span>Submit Selection for Review</span>
                            </a>
                            <a href="{{ route('home') }}" class="w-full inline-block text-center py-3 text-xs font-semibold text-gray-700 bg-white border border-gray-200 rounded-xl hover:bg-gray-50 transition shadow-sm">Continue Shopping</a>
                        </div>
                        <p class="text-[11px] text-gray-400 text-center">No payment processing is used on this site.</p>
                    </div>
                </div>

            </div>
        </div>

        <!-- ÉTAT VIDE -->
        <div id="empty-cart-state" class="{{ count($cart) === 0 ? '' : 'hidden' }} text-center py-20 bg-gray-50/50 rounded-2xl border border-dashed border-gray-200">
            <svg class="w-12 h-12 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
            </svg>
            <p class="text-sm text-gray-500 font-medium mb-4">Your shopping cart is completely empty.</p>
            <a href="{{ route('home') }}" class="inline-flex text-xs font-semibold px-5 py-2.5 bg-[#0F172A] text-white rounded-xl hover:bg-gray-800 transition shadow-sm">Continue Shopping</a>
        </div>

        <!-- MODAL SCHEDULE TEST DRIVE -->
        <div x-show="testDriveModal" class="fixed inset-0 bg-gray-900/60 backdrop-blur-sm flex items-center justify-center z-50 p-4" x-cloak x-transition>
            <div @click.away="testDriveModal = false" class="bg-white rounded-2xl max-w-md w-full p-6 shadow-2xl border border-gray-100 space-y-4">
                <div class="flex justify-between items-center">
                    <h3 class="font-bold text-gray-900 text-base">Schedule a Test Drive</h3>
                    <button @click="testDriveModal = false" class="text-gray-400 hover:text-gray-600 font-bold text-xl">&times;</button>
                </div>
                <p class="text-xs text-gray-500">Book a private slot to drive the <span class="font-bold text-gray-900" x-text="selectedVehicleTitle"></span>.</p>

                <form action="{{ route('testdrive.store') }}" method="POST" class="space-y-4 text-xs">
                    @csrf
                    <input type="hidden" name="vehicle_id" :value="selectedVehicleId">

                    <div>
                        <label class="block font-semibold text-gray-700 mb-1">Preferred Date</label>
                        <input type="date" name="date" required min="{{ date('Y-m-d', strtotime('+1 day')) }}" class="w-full border border-gray-200 rounded-xl px-3.5 py-2.5 bg-gray-50 focus:bg-white focus:border-gray-400 transition outline-none">
                    </div>
                    <div>
                        <label class="block font-semibold text-gray-700 mb-1">Preferred Time Slot</label>
                        <select name="visit_time" class="w-full border border-gray-200 rounded-xl px-3.5 py-2.5 bg-gray-50 focus:bg-white focus:border-gray-400 transition outline-none text-gray-800">
                            @foreach(\App\Models\Enums\VisitTimeSlot::cases() as $slot)
                            <option value="{{ $slot->value }}">{{ $slot->label() }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block font-semibold text-gray-700 mb-1">Special Requirements (Optional)</label>
                        <textarea name="notes" placeholder="Specify if you require delivery to a specific venue or features review..." class="w-full border border-gray-200 rounded-xl px-3.5 py-2.5 bg-gray-50 focus:bg-white focus:border-gray-400 transition h-20 resize-none outline-none"></textarea>
                    </div>

                    <button type="submit" class="w-full py-3 bg-[#0F172A] hover:bg-gray-800 text-white font-semibold rounded-xl transition mt-2 shadow tracking-wide">
                        Confirm Appointment
                    </button>
                </form>
            </div>
        </div>

        <!-- MODALS DE CONFIRMATION -->
        <x-confirm-modal
            name="delete-cart-item"
            title="Remove Vehicle?"
            message="Are you sure you want to remove this vehicle from your cart?"
            confirmText="Remove"
            type="danger" />

        <x-confirm-modal
            name="clear-cart"
            title="Clear Shopping Cart?"
            message="Are you sure you want to remove all vehicles from your cart? This action cannot be undone."
            confirmText="Clear All"
            type="danger" />
    </div>

    <!-- SCRIPT AJAX PANIER -->
    <script>
        const formatter = new Intl.NumberFormat('en-US', {
            style: 'currency',
            currency: 'USD',
            maximumFractionDigits: 0
        });

        function updateUI(data) {
            if (data.subtotal !== undefined || data.total !== undefined) {
                const rawTotal = data.raw_subtotal ?? data.total ?? (data.subtotal ? parseFloat(data.subtotal.replace(/[^0-9.-]+/g, "")) : 0);

                const subtotalElem = document.getElementById('summary-subtotal');
                const totalElem = document.getElementById('summary-total');

                if (subtotalElem) subtotalElem.textContent = formatter.format(rawTotal);
                if (totalElem) totalElem.textContent = formatter.format(rawTotal);
            }

            if (data.cart_count !== undefined) {
                const countElem = document.getElementById('summary-count');
                const unitElem = document.getElementById('summary-unit');
                if (countElem) countElem.textContent = data.cart_count;
                if (unitElem) unitElem.textContent = data.cart_count > 1 ? 'cars' : 'car';

                const badge = document.getElementById('cart-badge');
                if (badge) {
                    badge.textContent = data.cart_count;
                    badge.classList.toggle('hidden', data.cart_count === 0);
                }

                if (data.cart_count === 0) {
                    document.getElementById('cart-container').classList.add('hidden');
                    document.getElementById('btn-clear-cart').classList.add('hidden');
                    document.getElementById('empty-cart-state').classList.remove('hidden');
                }
            }
        }

        // Écoute suppression d'un item
        window.addEventListener('confirmed-delete-cart-item', function(event) {
            const itemId = event.detail;
            confirmRemoveItem(itemId);
        });

        // Écoute suppression de TOUT le panier
        window.addEventListener('confirmed-clear-cart', function() {
            clearCart();
        });

        function confirmRemoveItem(itemId) {
            if (!itemId) return;

            fetch(`/cart/remove/${itemId}`, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const row = document.querySelector(`.item-row[data-id="${itemId}"]`);
                        if (row) row.remove();
                        updateUI(data);
                    }
                })
                .catch(error => console.error('Error removing item:', error));
        }

        function clearCart() {
            fetch(`/cart/clear`, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        document.getElementById('cart-items-list').innerHTML = '';
                        updateUI({ cart_count: 0, total: 0 });
                    }
                })
                .catch(error => console.error('Error clearing cart:', error));
        }
    </script>
</x-guest-layout>
<x-guest-layout>
    <div x-data="{ 
            testDriveModal: false, 
            selectedVehicleId: null, 
            selectedVehicleTitle: ''
         }"
        class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12"
        @keydown.escape.window="testDriveModal = false">

        <h1 class="text-3xl font-bold text-gray-900 mb-8 tracking-tight">Shopping Cart</h1>

        <!-- CONTENEUR DU PANIER AVEC ARTICLES -->
        <div id="cart-container" class="{{ count($cart) > 0 ? '' : 'hidden' }}">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">

                <!-- LISTE DES ARTICLES -->
                <div class="lg:col-span-2 space-y-4" id="cart-items-list">
                    @foreach($cart as $id => $item)
                    <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm flex space-x-6 items-center justify-between relative item-row" data-id="{{ $id }}">

                        <div class="flex items-center space-x-6">
                            <div class="w-40 h-28 bg-gray-50 rounded-xl overflow-hidden flex-shrink-0">
                                <img src="{{ $item['image'] }}" class="w-full h-full object-cover" alt="{{ $item['title'] }}">
                            </div>

                            <div class="space-y-2">
                                <div>
                                    <h4 class="font-bold text-gray-900 text-lg">{{ $item['title'] }}</h4>
                                    <p class="text-sm text-gray-400 font-medium">
                                        {{ $item['year'] ?? '' }} &bull; {{ number_format((float)($item['mileage'] ?? 0)) }} miles
                                    </p>
                                    <p class="text-xs text-gray-400 mt-0.5">
                                        {{ $item['category'] ?? '' }} &bull; {{ $item['fuel_type'] ?? 'Gasoline' }}
                                    </p>
                                </div>

                                <div class="flex items-center space-x-4 pt-2">
                                    <!-- Selecteur de Quantité -->
                                    <div class="flex items-center border border-gray-200 rounded-lg bg-gray-50 text-xs px-2 py-1 space-x-3">
                                        <span class="text-gray-400">Quantity:</span>
                                        <button type="button" class="text-gray-500 hover:text-gray-700 font-bold btn-minus">&minus;</button>
                                        <span class="font-semibold text-gray-800 qty-value">{{ $item['quantity'] ?? 1 }}</span>
                                        <button type="button" class="text-gray-500 hover:text-gray-700 font-bold btn-plus">&plus;</button>
                                    </div>

                                    <a href="{{ route('vehicles.show', $item['id'] ?? $id) }}" class="text-xs font-medium px-3 py-1.5 border border-gray-200 rounded-lg text-gray-700 hover:bg-gray-50 transition shadow-sm">View Details</a>

                                    <button
                                        type="button"
                                        @click="testDriveModal = true; selectedVehicleId = '{{ $item['id'] ?? $id }}'; selectedVehicleTitle = '{{ addslashes($item['title']) }}'"
                                        class="text-xs font-medium px-3 py-1.5 border border-gray-200 rounded-lg text-gray-700 hover:bg-gray-50 transition shadow-sm">
                                        Schedule Test Drive
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Prix & Bouton Supprimer -->
                        <div class="flex flex-col items-end justify-between h-24">
                            <button type="button"
                                x-data
                                @click="$dispatch('open-modal-delete-cart-item', '{{ $id }}')"
                                class="text-red-400 hover:text-red-600 transition p-1"
                                title="Remove item">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                </svg>
                            </button>

                            <span class="font-extrabold text-gray-900 text-xl item-total-price">
                                ${{ number_format($item['price'] * ($item['quantity'] ?? 1)) }}
                            </span>
                        </div>

                    </div>
                    @endforeach
                </div>

                <!-- RÉSUMÉ DE COMMANDE -->
                <div class="space-y-6">
                    <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm space-y-4">
                        <h3 class="font-bold text-gray-900 text-sm">Order Summary</h3>

                        <div class="space-y-3 text-sm">
                            <div class="flex justify-between text-gray-500">
                                <span id="summary-text">Subtotal (<span id="summary-count">{{ count($cart) }}</span> <span id="summary-unit">{{ count($cart) > 1 ? 'cars' : 'car' }}</span>)</span>
                                <span class="font-semibold text-gray-900" id="summary-subtotal">${{ number_format($total) }}</span>
                            </div>
                            <div class="flex justify-between text-gray-500">
                                <span>Sales Tax (8%)</span>
                                <span class="font-semibold text-gray-900" id="summary-tax">${{ number_format($total * 0.08) }}</span>
                            </div>
                            <div class="flex justify-between text-gray-500">
                                <span>Delivery</span>
                                <span class="text-green-600 font-bold">Free</span>
                            </div>

                            <hr class="border-gray-100 my-4">

                            <div class="flex justify-between text-base font-extrabold text-gray-900">
                                <span>Total</span>
                                <span id="summary-total">${{ number_format($total * 1.08) }}</span>
                            </div>
                        </div>

                        <div class="space-y-2 pt-2">
                            <a href="{{ route('checkout.index') }}" class="w-full py-3 px-4 bg-[#0F172A] hover:bg-gray-800 text-white font-semibold text-xs rounded-xl shadow-sm transition tracking-wide flex items-center justify-center space-x-2 text-center">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                                </svg>
                                <span>Proceed to Checkout</span>
                            </a>
                            <a href="{{ route('home') }}" class="w-full inline-block text-center py-2.5 text-xs font-semibold text-gray-700 bg-white border border-gray-200 rounded-xl hover:bg-gray-50 transition shadow-sm">Continue Shopping</a>
                        </div>
                        <p class="text-[10px] text-gray-400 text-center pt-1">Secure checkout with 256-bit SSL encryption</p>
                    </div>

                    <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm space-y-3">
                        <h4 class="font-bold text-gray-900 text-xs">Financing Available</h4>
                        <p class="text-xs text-gray-400 leading-relaxed">Get pre-approved for financing with rates as low as 2.9% APR.</p>
                        <button type="button" class="w-full py-2 px-4 bg-white border border-gray-200 text-gray-800 font-semibold text-xs rounded-xl hover:bg-gray-50 transition shadow-sm">Check Financing Options</button>
                    </div>
                </div>

            </div>
        </div>

        <!-- ETAT VIDE -->
        <div id="empty-cart-state" class="{{ count($cart) === 0 ? '' : 'hidden' }} text-center py-16 bg-gray-50 rounded-2xl border border-dashed border-gray-200">
            <svg class="w-12 h-12 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
            </svg>
            <p class="text-sm text-gray-500 font-medium mb-4">Your shopping cart is completely empty.</p>
            <a href="{{ route('home') }}" class="inline-flex text-xs font-semibold px-4 py-2 bg-[#0F172A] text-white rounded-xl hover:bg-gray-800 transition shadow-sm">Continue Shopping</a>
        </div>

        <!-- MODAL SCHEDULE TEST DRIVE -->
        <div x-show="testDriveModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50 p-4" x-cloak x-transition>
            <div @click.away="testDriveModal = false" class="bg-white rounded-2xl max-w-md w-full p-6 shadow-2xl border border-gray-100 space-y-4">
                <div class="flex justify-between items-center">
                    <h3 class="font-bold text-gray-900 text-base">Schedule a Test Drive</h3>
                    <button @click="testDriveModal = false" class="text-gray-400 hover:text-gray-600 font-bold text-xl">&times;</button>
                </div>
                <p class="text-xs text-gray-400">Book a private slot to drive the <span class="font-bold text-gray-900" x-text="selectedVehicleTitle"></span>.</p>

                <form action="{{ route('testdrive.store') }}" method="POST" class="space-y-4 text-xs">
                    @csrf
                    <input type="hidden" name="vehicle_id" :value="selectedVehicleId">

                    <div>
                        <label class="block font-semibold text-gray-700 mb-1">Preferred Date</label>
                        <input type="date" name="date" required min="{{ date('Y-m-d', strtotime('+1 day')) }}" class="w-full border border-gray-200 rounded-xl px-3 py-2.5 bg-gray-50 focus:bg-white focus:border-gray-400 transition outline-none">
                    </div>
                    <div>
                        <label class="block font-semibold text-gray-700 mb-1">Preferred Time Slot</label>
                        <select name="time" required class="w-full border border-gray-200 rounded-xl px-3 py-2.5 bg-gray-50 focus:bg-white focus:border-gray-400 transition outline-none">
                            <option value="09:00">09:00 AM - 11:00 AM</option>
                            <option value="11:00">11:00 AM - 01:00 PM</option>
                            <option value="14:00">02:00 PM - 04:00 PM</option>
                            <option value="16:00">04:00 PM - 06:00 PM</option>
                        </select>
                    </div>
                    <div>
                        <label class="block font-semibold text-gray-700 mb-1">Special Requirements (Optional)</label>
                        <textarea name="notes" placeholder="Specify if you require delivery to a specific venue or features review..." class="w-full border border-gray-200 rounded-xl px-3 py-2.5 bg-gray-50 focus:bg-white focus:border-gray-400 transition h-20 resize-none outline-none"></textarea>
                    </div>

                    <button type="submit" class="w-full py-3 bg-[#0F172A] hover:bg-gray-800 text-white font-semibold rounded-xl transition mt-2 shadow tracking-wide">
                        Confirm Appointment
                    </button>
                </form>
            </div>
        </div>

        <x-confirm-modal
            name="delete-cart-item"
            title="Remove Vehicle?"
            message="Are you sure you want to remove this vehicle from your cart?"
            confirmText="Remove"
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
            if (data.subtotal !== undefined) {
                const subtotal = data.raw_subtotal ?? parseFloat(data.subtotal.replace(/[^0-9.-]+/g, ""));
                const tax = subtotal * 0.08;
                const total = subtotal * 1.08;

                document.getElementById('summary-subtotal').textContent = formatter.format(subtotal);
                document.getElementById('summary-tax').textContent = formatter.format(tax);
                document.getElementById('summary-total').textContent = formatter.format(total);
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
                    document.getElementById('empty-cart-state').classList.remove('hidden');
                }
            }
        }

        // Écoute la confirmation de la modal réutilisable
        window.addEventListener('confirmed-delete-cart-item', function(event) {
            const itemId = event.detail; // Récupère l'ID transmis lors du clic
            confirmRemoveItem(itemId);
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

        document.addEventListener('DOMContentLoaded', function() {
            // GESTION DU BOUTON PLUS / MOINS
            document.querySelectorAll('.btn-plus, .btn-minus').forEach(button => {
                button.addEventListener('click', function() {
                    const row = this.closest('.item-row');
                    const itemId = row.getAttribute('data-id');
                    const qtySpan = row.querySelector('.qty-value');
                    let currentQty = parseInt(qtySpan.textContent);

                    if (this.classList.contains('btn-plus')) {
                        currentQty++;
                    } else if (this.classList.contains('btn-minus')) {
                        if (currentQty > 1) currentQty--;
                        else return;
                    }

                    fetch(`/cart/update/${itemId}`, {
                            method: 'PATCH',
                            headers: {
                                'Content-Type': 'application/json',
                                'Accept': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({
                                quantity: currentQty
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                qtySpan.textContent = currentQty;
                                if (data.item_subtotal) {
                                    row.querySelector('.item-total-price').textContent = typeof data.item_subtotal === 'number' ? formatter.format(data.item_subtotal) : data.item_subtotal;
                                }
                                updateUI(data);
                            }
                        })
                        .catch(error => console.error('Error updating quantity:', error));
                });
            });
        });
    </script>
</x-guest-layout>
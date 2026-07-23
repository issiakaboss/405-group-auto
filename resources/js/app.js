import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

document.addEventListener('DOMContentLoaded', function () {
    // Récupération dynamique du token CSRF depuis les balises META
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

    // 1. Interception AJAX pour les Favoris
    document.addEventListener('submit', function (e) {
        const form = e.target;
        if (form.action && form.action.includes('/favorites/toggle/')) {
            e.preventDefault();
            
            fetch(form.action, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                }
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    // Mettre à jour l'icône du cœur
                    const svg = form.querySelector('svg');
                    if (svg) {
                        if (data.is_favorite) {
                            svg.setAttribute('class', 'h-4 w-4 fill-red-500 text-red-500');
                        } else {
                            svg.setAttribute('class', 'h-4 w-4 fill-none stroke-current');
                        }
                    }

                    // Mettre à jour le badge de navigation
                    const favBadge = document.getElementById('fav-badge');
                    if (favBadge) {
                        favBadge.textContent = data.favorites_count;
                        favBadge.classList.toggle('hidden', data.favorites_count === 0);
                    }
                }
            })
            .catch(err => console.error(err));
        }

        // 2. Interception AJAX pour l'ajout au Panier
        if (form.action && form.action.includes('/cart/add/')) {
            e.preventDefault();

            fetch(form.action, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                }
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    // Mettre à jour le badge de navigation
                    const cartBadge = document.getElementById('cart-badge');
                    if (cartBadge) {
                        cartBadge.textContent = data.cart_count;
                        cartBadge.classList.remove('hidden');
                    }

                    // Feedback visuel sur le bouton
                    const btn = form.querySelector('button');
                    if (btn) {
                        const originalText = btn.textContent;
                        btn.textContent = 'Added! ✓';
                        btn.classList.add('bg-emerald-600');
                        setTimeout(() => {
                            btn.textContent = originalText;
                            btn.classList.remove('bg-emerald-600');
                        }, 1500);
                    }
                }
            })
            .catch(err => console.error(err));
        }
    });
});
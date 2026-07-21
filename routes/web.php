<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\TestDriveController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\VehicleController as AdminVehicleController;

// --- CATALOGUE & RECHERCHE ---
Route::get('/', [VehicleController::class, 'index'])->name('home');
// Recherche AJAX pour l'autocomplétion de la Navbar
Route::get('/vehicles/search', [VehicleController::class, 'search'])->name('vehicles.search');
Route::get('/cars/{vehicle}', [VehicleController::class, 'show'])->name('vehicles.show');

// --- PANIER (CART) ---
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{vehicle}', [CartController::class, 'add'])->name('cart.add');
Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::patch('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');

// --- FAVORIS (FAVORITES) ---
Route::get('/favorites', [FavoriteController::class, 'index'])->name('favorites.index');
Route::post('/favorites/toggle/{vehicle}', [FavoriteController::class, 'toggle'])->name('favorites.toggle');

// --- TEST DRIVE (PLANIFICATION D'ESSAIS) ---
Route::post('/test-drive/schedule', [TestDriveController::class, 'store'])->name('testdrive.store');

// --- PAGES STATIQUES ---
Route::view('/about', 'pages.about')->name('about');
Route::view('/contact', 'pages.contact')->name('contact');

// --- DASHBOARD & PAGES SÉCURISÉES (AUTH) ---
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    // Profil utilisateur
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Checkout (Accessible uniquement aux utilisateurs connectés)
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout/order', [CheckoutController::class, 'store'])->name('checkout.store');
    Route::get('/checkout/success', [CheckoutController::class, 'success'])->name('checkout.success');
});


// Groupe de routes réservé uniquement aux utilisateurs connectés AYANT le rôle 'admin'
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/vehicles', [AdminVehicleController::class, 'index'])->name('vehicles.index');
    Route::get('/vehicles/create', [AdminVehicleController::class, 'create'])->name('vehicles.create');
    Route::post('/vehicles', [AdminVehicleController::class, 'store'])->name('vehicles.store');

    // 🛠️ Les deux routes manquantes pour l'édition :
    Route::get('/vehicles/{vehicle}/edit', [AdminVehicleController::class, 'edit'])->name('vehicles.edit');
    Route::put('/vehicles/{vehicle}', [AdminVehicleController::class, 'update'])->name('vehicles.update');

    // Route de suppression
    Route::delete('/vehicles/{vehicle}', [AdminVehicleController::class, 'destroy'])->name('vehicles.destroy');
});

require __DIR__ . '/auth.php';

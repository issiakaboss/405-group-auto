<?php

use App\Http\Controllers\Admin\VehicleController as AdminVehicleController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\VehicleRequestController as AdminVehicleRequestController ;
use App\Http\Controllers\CartController;
use App\Http\Controllers\VehicleRequestController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TestDriveController;
use App\Http\Controllers\VehicleController;
use Illuminate\Support\Facades\Route;

Route::get('/', [VehicleController::class, 'index'])->name('home');
Route::get('/vehicles/search', [VehicleController::class, 'search'])->name('vehicles.search');
Route::get('/vehicles/filter', [VehicleController::class, 'filter'])->name('vehicles.filter');
Route::get('/cars/{vehicle}', [VehicleController::class, 'show'])->name('vehicles.show');
Route::post('/vehicles/request', [VehicleRequestController::class, 'store'])->name('vehicles.request');

Route::middleware('geo.us')->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{vehicle}', [CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/add-similar/{vehicle}', [CartController::class, 'addSimilar'])->name('cart.add-similar');
    Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
    Route::patch('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');
    Route::post('/test-drive/schedule', [TestDriveController::class, 'store'])->name('testdrive.store');
});

Route::get('/favorites', [FavoriteController::class, 'index'])->name('favorites.index');
Route::post('/favorites/toggle/{vehicle}', [FavoriteController::class, 'toggle'])->name('favorites.toggle');

Route::view('/about', 'pages.about-contact')->name('about');
Route::post('/about/contact', [VehicleController::class, 'storeContact'])->name('about.contact');

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout/order', [CheckoutController::class, 'store'])->name('checkout.store');
    Route::get('/checkout/success', [CheckoutController::class, 'success'])->name('checkout.success');
});

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/vehicles', [AdminVehicleController::class, 'index'])->name('vehicles.index');
    Route::get('/vehicles/create', [AdminVehicleController::class, 'create'])->name('vehicles.create');
    Route::post('/vehicles', [AdminVehicleController::class, 'store'])->name('vehicles.store');
    Route::get('/vehicles/{vehicle}/edit', [AdminVehicleController::class, 'edit'])->name('vehicles.edit');
    Route::put('/vehicles/{vehicle}', [AdminVehicleController::class, 'update'])->name('vehicles.update');
    Route::patch('/vehicles/{vehicle}/status', [AdminVehicleController::class, 'updateStatus'])->name('vehicles.update-status');
    Route::delete('/vehicles/{vehicle}', [AdminVehicleController::class, 'destroy'])->name('vehicles.destroy');

    Route::get('/orders', [AdminOrderController::class, 'index'])->name('orders.index');
    Route::patch('/orders/{order}/status', [AdminOrderController::class, 'updateStatus'])->name('orders.update-status');

    Route::get('/vehicle-requests', [AdminVehicleRequestController::class, 'index'])->name('vehicle-requests.index');

    Route::get('/users', [AdminUserController::class, 'index'])->name('users.index');
    Route::post('/users', [AdminUserController::class, 'store'])->name('users.store');
});

require __DIR__ . '/auth.php';

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/products', [ProductController::class, 'index'])
    ->name('products.index');


/*
|--------------------------------------------------------------------------
| Authenticated User Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Cart
    Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
    Route::get('/cart', [CartController::class, 'view'])->name('cart.index');
    Route::post('/cart/increase/{id}', [CartController::class, 'increase'])->name('cart.increase');
    Route::post('/cart/decrease/{id}', [CartController::class, 'decrease'])->name('cart.decrease');

    // Checkout
    Route::get('/checkout', [CartController::class, 'checkout'])->name('checkout');

    // Place Order
    Route::post('/order/place', [OrderController::class, 'place'])->name('order.place');

    // Order Success
    Route::get('/order-success/{id}', [OrderController::class, 'success'])
        ->name('order.success');

    // My Orders
    Route::get('/my-orders', [OrderController::class, 'myOrders'])
        ->name('orders.my');

    Route::get('/my-orders/{id}/invoice', [OrderController::class, 'userInvoice'])
        ->name('user.orders.invoice');

});


/*
|--------------------------------------------------------------------------
| Admin Routes (Protected by admin middleware)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'admin'])->group(function () {

    Route::get('/admin/dashboard', [OrderController::class, 'adminDashboard'])
        ->name('admin.dashboard');

    Route::get('/admin/orders/{id}', [OrderController::class, 'show'])
        ->name('admin.orders.show');

    Route::post('/admin/orders/{id}/deliver', [OrderController::class, 'deliver'])
        ->name('order.deliver');

    Route::get('/admin/orders/{id}/invoice', [OrderController::class, 'invoice'])
        ->name('admin.orders.invoice');

    Route::get('/admin/orders', [OrderController::class, 'adminOrders'])
        ->name('admin.orders');

});


/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
*/

require __DIR__.'/auth.php';

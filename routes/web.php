<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CheckoutController;
use App\Models\Order;
use App\Http\Controllers\OrderController;



Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


Route::get('/products', [ProductController::class, 'index'])->name('products');

Route::post('/add-to-cart/{id}', [CartController::class, 'add'])->name('cart.add');
Route::get('/cart', [CartController::class, 'view'])->name('cart.view');

Route::post('/cart/increase/{id}', [CartController::class, 'increase'])->name('cart.increase');
Route::post('/cart/decrease/{id}', [CartController::class, 'decrease'])->name('cart.decrease');

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');

Route::get('/checkout', function () {
    return view('checkout');
})->name('checkout');

Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');

Route::get('/order-success', function () {
    return view('checkout.success');
})->name('order.success');

Route::post('/order/{id}/deliver', function ($id) {
    $order = Order::findOrFail($id);
    $order->status = 'Delivered';
    $order->save();

    return back();
})->name('order.deliver');

Route::get('/admin/orders', [OrderController::class, 'index'])
    ->name('admin.orders');

Route::post('/order/{id}/deliver', [OrderController::class, 'deliver'])
    ->name('order.deliver');


Route::get('/my-orders', [OrderController::class, 'myOrders'])
    ->name('orders.my')
    ->middleware('auth');


Route::post('/place-order', [OrderController::class, 'placeOrder'])
    ->name('order.place')
    ->middleware('auth');


Route::get('/checkout', [CartController::class, 'checkout'])
    ->name('checkout')
    ->middleware('auth');

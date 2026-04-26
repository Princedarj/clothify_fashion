<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Session;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

// Homepage (public)
Route::get('/', [HomeController::class, 'index'])->name('dashboard');

// Language
Route::get('/lang/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'hi', 'gu'])) {
        Session::put('locale', $locale);
    }
    return redirect()->back();
})->name('lang.switch');

// Products
Route::get('/products', [ProductController::class, 'index'])->name('products.index');

// Add to Cart (with middleware for login flow)
Route::post('/add-to-cart', [CartController::class, 'add'])
    ->middleware('store.action')
    ->name('cart.add');

// Buy Now
Route::post('/buy-now/{id}', [OrderController::class, 'buyNow'])
    ->middleware('store.action')
    ->name('buy.now');

/*
|--------------------------------------------------------------------------
| Authenticated User Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Cart
    Route::get('/cart', [CartController::class, 'view'])->name('cart.index');
    Route::post('/cart/increase/{id}', [CartController::class, 'increase'])->name('cart.increase');
    Route::post('/cart/decrease/{id}', [CartController::class, 'decrease'])->name('cart.decrease');

    // Checkout
    Route::get('/checkout', [CartController::class, 'checkout'])->name('checkout');

    // Order
    Route::post('/order/place', [OrderController::class, 'place'])->name('order.place');
    Route::get('/order-success/{id}', [OrderController::class, 'success'])->name('order.success');

    // Orders
    Route::get('/my-orders', [OrderController::class, 'myOrders'])->name('orders.my');
    Route::get('/my-orders/{id}/invoice', [OrderController::class, 'userInvoice'])->name('user.orders.invoice');

    Route::get('/invoice/{id}', [OrderController::class, 'invoice'])->name('invoice.download');

    Route::get('/payment/{order}', [OrderController::class, 'payment'])->name('payment.page');
    Route::post('/payment/verify', [OrderController::class, 'verifyPayment'])->name('payment.verify');
});


/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

        Route::resource('products', AdminProductController::class);
        Route::resource('categories', CategoryController::class);

        Route::get('/users', [UserController::class, 'index'])->name('users.index');

        Route::get('/orders', [OrderController::class, 'adminOrders'])->name('orders.index');
        Route::get('/orders/export', [OrderController::class, 'export'])->name('orders.export');
        Route::get('/orders/{id}', [OrderController::class, 'show'])->name('orders.show');
        Route::post('/orders/{id}/deliver', [OrderController::class, 'deliver'])->name('orders.deliver');
        Route::get('/orders/{id}/invoice', [OrderController::class, 'invoice'])->name('orders.invoice');

        Route::get('/profile', [AdminController::class, 'profile'])->name('profile');
        Route::post('/profile/update', [AdminController::class, 'update'])->name('profile.update');

        Route::get('/create', [AdminController::class, 'create'])->name('create');
        Route::post('/store', [AdminController::class, 'store'])->name('store');    
    });

/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
*/

require __DIR__.'/auth.php';
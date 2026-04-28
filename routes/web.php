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

Route::get('/', [HomeController::class, 'index'])->name('dashboard');

Route::get('/lang/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'hi', 'gu'])) {
        Session::put('locale', $locale);
    }
    return redirect()->back();
})->name('lang.switch');

Route::get('/products', [ProductController::class, 'index'])->name('products.index');

Route::post('/add-to-cart', [CartController::class, 'add'])
    ->middleware('store.action')
    ->name('cart.add');

Route::post('/buy-now/{id}', [OrderController::class, 'buyNow'])
    ->middleware('store.action')
    ->name('buy.now');


/*
|--------------------------------------------------------------------------
| Authenticated User Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/cart', [CartController::class, 'view'])->name('cart.index');
    Route::post('/cart/increase/{id}', [CartController::class, 'increase'])->name('cart.increase');
    Route::post('/cart/decrease/{id}', [CartController::class, 'decrease'])->name('cart.decrease');

    Route::get('/checkout', [CartController::class, 'checkout'])->name('checkout');

    Route::post('/order/place', [OrderController::class, 'place'])->name('order.place');
    Route::get('/order-success/{id}', [OrderController::class, 'success'])->name('order.success');

    Route::get('/my-orders', [OrderController::class, 'myOrders'])->name('orders.my');
    Route::get('/my-orders/{id}/invoice', [OrderController::class, 'userInvoice'])->name('user.orders.invoice');

    Route::get('/invoice/{id}', [OrderController::class, 'invoice'])->name('invoice.download');

    Route::get('/payment/{id}', [OrderController::class, 'paymentPage'])->name('payment.page');
    Route::post('/payment/success/{id}', [OrderController::class, 'paymentSuccess'])->name('payment.success');

    Route::view('/contact-us', 'pages.contact')->name('contact');
    Route::view('/faqs', 'pages.faqs')->name('faqs');
    Route::view('/shipping-policy', 'pages.shipping')->name('shipping.policy');
    Route::view('/return-policy', 'pages.returns')->name('return.policy');


    Route::get('/product/{product}', [ProductController::class, 'show'])->name('products.show');
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

        /*
        |--------------------------------------------------------------------------
        | Orders Routes
        |--------------------------------------------------------------------------
        */

        // Your old route as it is
        Route::get('/orders', [OrderController::class, 'adminOrders'])->name('orders.index');

        // New route for filtered orders page
        Route::get('/orders-filter', [AdminController::class, 'orders'])->name('orders.filter');

        // Export
        Route::get('/orders/export', [AdminController::class, 'export'])->name('orders.export');

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
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Models\Product;
use App\Http\Controllers\Admin\UserController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/lang/{locale}', function ($locale) {

    if (!in_array($locale, ['en', 'gu', 'hi'])) {
        abort(400);
    }

    session(['locale' => $locale]);

    return redirect()->back();

})->name('lang.switch');

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
        $products = Product::latest()->get();
        return view('dashboard', compact('products'));
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

    // Buy Now
    Route::post('/buy-now/{id}', [OrderController::class, 'buyNow'])->name('buy.now');
    
    
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

        Route::get('/dashboard', [AdminController::class, 'dashboard'])
            ->name('dashboard');

        Route::resource('products', AdminProductController::class);

        Route::resource('categories', CategoryController::class);
        
        Route::get('/users', [UserController::class, 'index'])
            ->name('users.index');

        Route::get('/orders', [OrderController::class, 'index'])
            ->name('orders.index');

        Route::get('/orders/export', [OrderController::class, 'export'])
            ->name('orders.export');

        Route::get('/orders/{id}', [OrderController::class, 'show'])
            ->name('orders.show');

        Route::post('/orders/{id}/deliver', [OrderController::class, 'deliver'])
            ->name('orders.deliver');

        Route::get('/orders/{id}/invoice', [OrderController::class, 'invoice'])
            ->name('orders.invoice');
    });


/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
*/

require __DIR__.'/auth.php';
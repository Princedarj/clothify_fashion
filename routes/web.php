<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\AdminProductController;

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

    Route::get('/admin/orders/export', [OrderController::class, 'export'])
    ->name('admin.orders.export');

    Route::get('/admin/orders/{id}', [OrderController::class, 'show'])
    ->name('admin.orders.show');

    // Products
    Route::get('/products', [ProductController::class, 'index'])
    ->name('products.index');

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

        Route::get('/orders', [AdminController::class, 'orders'])
            ->name('orders');

        Route::get('/users', [AdminController::class, 'users'])
            ->name('users');

        Route::resource('products', AdminProductController::class);

        Route::post('/orders/{id}/deliver', [OrderController::class, 'deliver'])
            ->name('orders.deliver');
        
        Route::get('/orders/{id}/invoice', [OrderController::class, 'invoice'])
            ->name('invoice');

        Route::get('/products', [AdminProductController::class, 'index'])->name('products.index');

        Route::get('/products/{id}/edit', [AdminProductController::class, 'edit'])->name('products.edit');

        Route::put('/products/{id}', [AdminProductController::class, 'update'])->name('products.update');

        Route::get('/users', [App\Http\Controllers\Admin\UserController::class, 'index'])
        ->name('users.index');

    });


Route::middleware(['auth'])->group(function () {

  
});
/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
*/

require __DIR__.'/auth.php';

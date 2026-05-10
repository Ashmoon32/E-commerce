<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/about', [PageController::class, 'about']);

Route::get('/shop', [ShopController::class, 'index'])->name('shop.index');

Route::get('/shop/{product}', [ShopController::class, 'show'])->name('shop.show');

Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::resource('products', ProductController::class);

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');

Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');

Route::delete('/cart/remove/{productId}', [CartController::class, 'remove'])->name('cart.remove');

Route::put('/cart/update', [CartController::class, 'update'])->name('cart.update');

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');

Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');

Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');

    Route::post('/checkout', [CheckoutController::class, 'placeOrder'])->name('checkout.place');

    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');

    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');

    Route::put('/orders/{order}/cancel', [OrderController::class, 'cancel'])->name('orders.cancel');
});

Route::middleware('auth')->group(function () {
    Route::get('/payment/{order}', [PaymentController::class, 'show'])->name('payment.show');

    Route::post('/payment/{order}', [PaymentController::class, 'pay'])->name('payment.pay');

    Route::get('/payment/success/{order}', [PaymentController::class, 'success'])->name('payment.success');
});

Route::get('/cloudinary-test', function () {
    try {
        $result = CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary::upload(
            public_path('favicon.ico'),
            ['folder' => 'ecommerce-products']
        );
        dd($result);
    } catch (\Exception $e) {
        dd('Error: ' . $e->getMessage());
    }
});
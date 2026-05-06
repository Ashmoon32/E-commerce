<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ShopController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);

Route::get('/about', [PageController::class, 'about']);

Route::get('/shop', [ShopController::class, 'index'])->name('shop.index');

Route::get('/shop/{product}', [ShopController::class, 'show'])->name('shop.show');
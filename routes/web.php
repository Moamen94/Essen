<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\FoodItemController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('welcome');
Route::get('/menu', [FoodItemController::class, 'index'])->name('food.index');
Route::get('/menu/{foodItem}', [FoodItemController::class, 'show'])->name('food.show');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', fn () => view('dashboard'))->name('dashboard');

    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart', [CartController::class, 'store'])->name('cart.store');
    Route::put('/cart/{cartItem}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/{cartItem}', [CartController::class, 'destroy'])->name('cart.destroy');

    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
});

require __DIR__.'/auth.php';

<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\SneakerController;
use Illuminate\Support\Facades\Route;

Route::get('/', [SneakerController::class, 'index'])->name('home');

Route::resource('sneakers', SneakerController::class);

Route::middleware(['auth', 'admin'])->group(function () {
    Route::patch('sneakers/{sneaker}/price', [SneakerController::class, 'updatePrice'])->name('sneakers.updatePrice');
});

Route::middleware(['auth'])->group(function () {
    Route::get('orders', [OrderController::class, 'index'])->name('orders.index');
    Route::post('sneakers/{sneaker}/orders', [OrderController::class, 'store'])->name('orders.store');
    Route::delete('orders/{order}', [OrderController::class, 'destroy'])->name('orders.destroy');
});

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

require __DIR__.'/settings.php';

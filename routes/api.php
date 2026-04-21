<?php

use App\Http\Controllers\Api\ProductController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')
    ->as('api.v1.')
    ->group(static function () {
        Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    });

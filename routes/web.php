<?php

use App\Http\Controllers\Shop\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/san-pham/{product:slug}',[ProductController::class, 'show'])->name('products.show');

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('home');
});


Route::get('/shop', [ShopController::class, 'index']);


// Route to display the product creation form (GET request)
Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');

// Route to handle the form submission (POST request)
Route::post('/products', [ProductController::class, 'store'])->name('products.store');

Route::get('/auth', function () {
    return view('auth.auth');
});

<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
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
Route::get('/shop/category/{id}', [ShopController::class, 'filterByCategory'])->name('shop.category');



// Route to display the product creation form (GET request)
Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');

// Route to handle the form submission (POST request)
Route::post('/products', [ProductController::class, 'store'])->name('products.store');

Route::get('/login',[AuthController::class,'showlogin'])->name('login.form');
Route ::post('/login',[AuthController::class,'login'])->name('login');; 
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth');

// Route::get('/dashboard', [UserController::class, 'index'])->middleware('auth')->name('dashboard');
// Admin Dashboard
Route::get('/admin/dashboard', [UserController::class, 'admin'])
    ->middleware(['auth', 'role:admin'])->name('dashboard.admin');

// Staff Dashboard
Route::get('/staff/dashboard', [UserController::class, 'staff'])
    ->middleware(['auth', 'role:staff'])->name('dashboard.staff');

// Customer Dashboard
Route::get('/customer/dashboard', [UserController::class, 'index'])
    ->middleware(['auth', 'role:customer'])->name('customer.dashboard');

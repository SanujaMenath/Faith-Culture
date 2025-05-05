<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\StaffController;
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

//Main routes
Route::get('/', function () {
    return view('home');
});
Route::get('/settings', function () {
    return view('settings');
});
Route::get('/profile', [UserController::class, 'profile'])->middleware('auth')->name('profile');
Route::get('/orders',[OrdersController::class,'index'])->middleware('auth')->name('orders.index');
Route::get('/shop', [ShopController::class, 'index'])->name('shop');
Route::get('/shop/category/{id}', [ShopController::class, 'filterByCategory'])->name('shop.category');


// Route to display the product creation form (GET request)
Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');

// Route to handle the form submission (POST request)
Route::post('/products', [ProductController::class, 'store'])->name('products.store');

Route::get('/login',[AuthController::class,'showlogin'])->name('login.form');
Route ::post('/login',[AuthController::class,'login'])->name('login');; 
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

// Admin Dashboard
Route::get('/admin/dashboard', [AdminController::class, 'index'])
    ->middleware(['auth', 'role:ADMIN'])->name('admin.index');
Route::get('/admin/profile', [AdminController::class, 'editProfile'])->name('admin.profile');
Route::get('admin/add-category', [AdminController::class, 'showAddCategoryForm'])->name('admin.addCategory');
Route::post('admin/add-category', [AdminController::class, 'addCategory'])->name('admin.addCategoryForm');
Route::get('admin/add-products', [AdminController::class, 'showAddProductsForm'])->name('admin.addProducts');
Route::post('/admin/add-products', [AdminController::class, 'addProduct'])->name('admin.addProductsForm');

// Manage staff
Route::get('/admin/create-staff', [AdminController::class, 'showCreateStaffForm'])->name('admin.staffs');
Route::post('/admin/create-staff', [AdminController::class, 'createStaff'])->name('admin.createStaff');
// Edit homepage
Route::get('/admin/edit-homepage', [AdminController::class, 'editHomepage'])->name('admin.editHomepage');


// Staff Dashboard
Route::get('/staff/dashboard', [StaffController::class, 'index'])
    ->middleware(['auth', 'role:STAFF'])->name('staff.index');

// User Profile
Route::get('/profile', [UserController::class, 'index'])
    ->middleware(['auth', 'role:USER'])->name('profile');

// Cart Routes
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::get('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update/{product}', [CartController::class, 'update'])->name('cart.update');
Route::get('/cart/remove/{product}', [CartController::class, 'remove'])->name('cart.remove');
Route::get('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');
Route::post('/cart/update-quantity/{product}', [CartController::class, 'updateQuantity'])->name('cart.update-quantity');

Route::post('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
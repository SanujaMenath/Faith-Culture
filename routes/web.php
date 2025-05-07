<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
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
Route::get('/orders',[OrderController::class,'index'])->middleware('auth')->name('orders.index');
Route::get('/shop', [ShopController::class, 'index'])->name('shop');
Route::get('/shop/category/{id}', [ShopController::class, 'filterByCategory'])->name('shop.category');
Route::get('/shop/product/{id}', [ProductController::class, 'productDetails'])->name('product.details');


Route::get('/login',[AuthController::class,'showlogin'])->name('login.form');
Route ::post('/login',[AuthController::class,'login'])->name('login');; 
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

// Admin Dashboard
Route::get('/admin/dashboard', [AdminController::class, 'index'])
    ->middleware(['auth', 'role:ADMIN'])->name('admin.index');
Route::get('/admin/profile', [AdminController::class, 'editProfile']) ->middleware(['auth', 'role:ADMIN'])->name('admin.profile');
Route::get('admin/add-category', [AdminController::class, 'showAddCategoryForm']) ->middleware(['auth', 'role:ADMIN'])->name('admin.addCategory');
Route::post('admin/add-category', [AdminController::class, 'addCategory']) ->middleware(['auth', 'role:ADMIN'])->name('admin.addCategoryForm');
Route::get('admin/add-products', [AdminController::class, 'showAddProductsForm']) ->middleware(['auth', 'role:ADMIN'])->name('admin.addProducts');
Route::post('/admin/add-products', [AdminController::class, 'addProduct']) ->middleware(['auth', 'role:ADMIN'])->name('admin.addProductsForm');
Route::get('/admin/inventory', [AdminController::class, 'viewInventory']) ->middleware(['auth', 'role:ADMIN'])->name('admin.inventory');
Route::post('/admin/inventory', [AdminController::class, 'manageInventory']) ->middleware(['auth', 'role:ADMIN'])->name('admin.manageInventory');

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
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/update', [CartController::class, 'updatQuantity'])->name('cart.update');


Route::post('/checkout', [CheckoutController::class, 'index'])->name('checkout');





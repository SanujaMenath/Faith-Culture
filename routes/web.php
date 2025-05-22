<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\UserController;
use App\Models\Inventory;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
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
    $newArrivals = Inventory::with('product.category')->latest()->take(4)->get();
    return view('home', compact('newArrivals'));
});

Route::get('/settings', function () {
    return view('settings');
});
Route::get('/shop', [ShopController::class, 'index'])->name('shop');
Route::get('/shop/category/{id}', [ShopController::class, 'filterByCategory'])->name('shop.category');
Route::get('/shop/product/{id}', [ProductController::class, 'productDetails'])->name('product.details');
Route::get('/select-profile', [UserController::class, 'profile'])->middleware('auth')->name('select.profile');
Route::get('/about', function () {
    return view('about');
})->name('about');


// User Profile
Route::get('/profile', function () {
    return view('profile');
})->middleware(['auth', 'role:USER'])->name('profile');

Route::get('/login', [AuthController::class, 'showlogin'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');
;
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::get('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('status', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

// Admin Dashboard
Route::get('/admin/dashboard', [AdminController::class, 'index'])
    ->middleware(['auth', 'role:ADMIN'])->name('admin.index');
Route::get('/admin/profile', [AdminController::class, 'editProfile'])->middleware(['auth', 'role:ADMIN'])->name('admin.profile');
Route::get('admin/manage-category', [AdminController::class, 'showAddCategoryForm'])->middleware(['auth', 'role:ADMIN'])->name('admin.addCategory');
Route::post('admin/manage-category', [AdminController::class, 'addCategory'])->middleware(['auth', 'role:ADMIN'])->name('admin.addCategoryForm');
Route::delete('admin/manage-category/{id}/delete', [AdminController::class, 'deleteCategory'])->middleware(['auth', 'role:ADMIN'])->name('admin.deleteCategory');
Route::get('admin/manage-products', [AdminController::class, 'showAddProductsForm'])->middleware(['auth', 'role:ADMIN'])->name('admin.addProducts');
Route::post('/admin/manage-products', [AdminController::class, 'addProduct'])->middleware(['auth', 'role:ADMIN'])->name('admin.addProductsForm');
Route::delete('admin/manage-products/{id}/delete',[AdminController::class,'deleteProduct'])->middleware(['auth', 'role:ADMIN'])->name('admin.productDelete');
Route::get('/admin/manage-inventory', [AdminController::class, 'viewInventory'])->middleware(['auth', 'role:ADMIN'])->name('admin.inventory');
Route::post('/admin/manage-inventory', [AdminController::class, 'manageInventory'])->middleware(['auth', 'role:ADMIN'])->name('admin.manageInventory');
Route::get('admin/manage-sizes', [AdminController::class, 'showAddSizeForm'])->middleware(['auth', 'role:ADMIN'])->name('admin.manageSizes');
Route::post('admin/manage-sizes', [AdminController::class, 'addSize'])->middleware(['auth', 'role:ADMIN'])->name('admin.addSizeForm');
Route::delete('admin/manage-sizes/{id}/delete', [AdminController::class, 'deleteSize'])->middleware(['auth', 'role:ADMIN'])->name('admin.deleteSize');
Route::get('admin/manage-colors', [AdminController::class, 'showAddColorForm'])->middleware(['auth', 'role:ADMIN'])->name('admin.manageColors');
Route::post('admin/manage-colors', [AdminController::class, 'addColor'])->middleware(['auth', 'role:ADMIN'])->name('admin.addColorForm');
Route::delete('admin/manage-colors/{id}/delete',[AdminController::class, 'deleteColor'])->middleware(['auth', 'role:ADMIN'])->name('admin.deleteColor');
// Manage staff
Route::get('/admin/create-staff', [AdminController::class, 'showCreateStaffForm'])->name('admin.staffs');
Route::post('/admin/create-staff', [AdminController::class, 'createStaff'])->name('admin.createStaff');
// Edit homepage
Route::get('/admin/edit-homepage', [AdminController::class, 'editHomepage'])->name('admin.editHomepage');


// Staff Dashboard
Route::get('/staff/dashboard', [StaffController::class, 'index'])
    ->middleware(['auth', 'role:STAFF'])->name('staff.index');


// Cart Routes
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/update', [CartController::class, 'updateQuantity'])->name('cart.update');


Route::post('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');

Route::post('/checkout', [CheckoutController::class, 'processCheckout'])->name('order.place');
Route::get('view-orders', [OrderController::class, 'showOrders'])->name('orders.show');

Route::get('/checkout/success', [OrderController::class, 'checkoutSuccess'])->name('checkout.success');
Route::get('/checkout/cancel', [CheckoutController::class, 'cancel'])->name('checkout.cancel');

Route::get('/order', [OrderController::class, 'confirmOrder'])->name('orders.confirm');

// search products
Route::get('/search', [ProductController::class, 'search'])->name('search.page');


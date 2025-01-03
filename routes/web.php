<?php
use App\Http\Middleware\CheckAdmin;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\MediaController;
use App\Http\Controllers\Admin\StoreController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Front\HomepageController;
use App\Http\Controllers\Front\CartController;


Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/send-otp', [AuthController::class, 'sendOtp'])->name('send.otp');
Route::post('/verify-otp', [AuthController::class, 'verifyOtp'])->name('verify.otp');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/', [HomepageController::class, 'index'])->name('home');
Route::get('/search', [HomepageController::class, 'search'])->name('search');
Route::get('/about', [HomepageController::class, 'about'])->name('about');

Route::post('/cart/add/{productId}', [CartController::class, 'addToCart']);
Route::get('/getcart/{productId}', [CartController::class, 'getCart']);
Route::post('/cart/remove/{productId}', [CartController::class, 'removeFromCart']);
Route::get('/cart/check/{id}', [CartController::class, 'check'])->name('cart.check');
Route::get('/cart', [CartController::class, 'Cart']);
Route::get('/clearcart', [CartController::class, 'clearCart']);




Route::middleware(['auth', CheckAdmin::class])->group(function () {
    // Admin dashboard route
    Route::get('/admin/dashboard', [DashboardController::class, 'dashboard'])->name('admin.dashboard');

    Route::get('/admin/category/add', [CategoryController::class, 'add'])->name('categories.create');
    Route::post('/admin/categories/store', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('/admin/category', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/admin/category/edit/{id}', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::post('/admin/categories/update', [CategoryController::class, 'update'])->name('categories.update');
    Route::post('/admin/categories/destory', [CategoryController::class, 'update'])->name('categories.destory');

    //products routes
    Route::get('/admin/product/add', [ProductController::class, 'add'])->name('products.create');
    Route::post('/admin/product/store', [ProductController::class, 'store'])->name('products.store');
    Route::get('admin/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('admin/products/data', [ProductController::class, 'getData'])->name('products.data');
    Route::delete('admin/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');
    Route::get('admin/products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('admin/products/{id}', [ProductController::class, 'update'])->name('products.update');

    //Media Data
// Route to update the Media (PUT/PATCH request)
    Route::get('admin/media/edit', [MediaController::class, 'edit'])->name('media.edit');
    Route::put('media/{id}', [MediaController::class, 'update'])->name('media.update');


// Store index page (show all stores)
Route::get('admin/stores', [StoreController::class, 'index'])->name('stores.index');
Route::get('admin/stores/data', [StoreController::class, 'getStores'])->name('stores.data');
Route::get('admin/stores/create', [StoreController::class, 'create'])->name('stores.create');
Route::post('admin/stores', [StoreController::class, 'store'])->name('stores.store');
Route::get('admin/stores/{store}/edit', [StoreController::class, 'edit'])->name('stores.edit');
Route::put('admin/stores/{store}', [StoreController::class, 'update'])->name('stores.update');
Route::delete('admin/stores/{store}', [StoreController::class, 'destroy'])->name('stores.destroy');


Route::get('admin/coupons', [CouponController::class, 'index'])->name('coupons.index');
Route::get('admin/coupons/data', [CouponController::class, 'getCoupons'])->name('coupons.data');
Route::get('admin/coupons/{coupon}/edit', [CouponController::class, 'edit'])->name('coupons.edit');
Route::put('admin/coupons/{coupon}', [CouponController::class, 'update'])->name('coupons.update');
Route::delete('admin/coupons/{coupon}', [CouponController::class, 'destroy'])->name('coupons.destroy');
Route::get('admin/coupons/create', [CouponController::class, 'create'])->name('coupons.create');
Route::post('admin/coupons', [CouponController::class, 'store'])->name('coupons.store');



});

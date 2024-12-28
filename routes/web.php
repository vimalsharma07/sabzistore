<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;

use App\Http\Middleware\CheckAdmin;

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/send-otp', [AuthController::class, 'sendOtp'])->name('send.otp');
Route::post('/verify-otp', [AuthController::class, 'verifyOtp'])->name('verify.otp');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/', function () {
    return view('frontend.index');
});


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

});

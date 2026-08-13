<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductImageController;
use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\HomeController; 
use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Route;

// 1. PUBLIC STOREFRONT ROUTES
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/product-detail/{id}', [HomeController::class, 'show'])->name('product.show');

// Reviews Routes
Route::get('/reviews', [ReviewController::class, 'index'])->name('reviews.index');
Route::get('/reviews/create/{product_id}', [ReviewController::class, 'create'])->name('reviews.create');
Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');

// TEMPORARY CART DUMMY ROUTES (Prevents Blade route errors until cart is built)
Route::get('/cart', function () {
    return redirect()->back();
})->name('cart.index');

Route::post('/cart/add', function () {
    return redirect()->back()->with('success', 'Item functionality pending.');
})->name('cart.add');


// 2. AUTHENTICATED ADMIN ROUTES
Route::middleware(['auth'])->group(function () {

    // Admin Dashboard
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

    // Categories
    Route::get('/categories-export', [CategoryController::class, 'exportCsv'])->name('categories.export');
    Route::resource('categories', CategoryController::class);

    // Products (Admin Management)
    Route::get('/product-export', [ProductController::class, 'exportCsv'])->name('product.export');
    Route::get('/admin/product/{id}', [ProductController::class, 'show'])->name('admin.product.show');
    Route::resource('product', ProductController::class)->except(['show']);

    // Product Image management routes
    Route::post('product/{product}/images', [ProductImageController::class, 'store'])->name('product.images.store');
    Route::put('product-images/{image}', [ProductImageController::class, 'update'])->name('product.images.update');
    Route::delete('product-images/{image}', [ProductImageController::class, 'destroy'])->name('product.images.destroy');

    // Dashboard & Profile
    Route::get('/dashboard', function () {
        return redirect()->route('admin.dashboard');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/activity-log-export', [ActivityLogController::class, 'exportCsv'])->name('activity-log.export');
    Route::get('/activity-log', [ActivityLogController::class, 'index'])->name('activity-log.index');
});

// Breeze auth routes
require __DIR__.'/auth.php';
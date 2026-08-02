<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\SettingController as AdminSettingController;
use App\Http\Controllers\Admin\TransactionController as AdminTransactionController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\UserTransactionController;
use Illuminate\Support\Facades\Route;

// ==================== FRONTEND SHOP ROUTES ====================
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/product/{slug}', [ProductController::class, 'show'])->name('product.show');

// Checkout & User Protected Routes (Requires Auth)
Route::middleware(['auth'])->group(function () {
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');

    // User transaction history
    Route::get('/transactions', [UserTransactionController::class, 'index'])->name('transactions.history');

    // Reviews
    Route::post('/product/{id}/review', [ReviewController::class, 'store'])->name('review.store');

    // Profile Settings
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // Cart Routes
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
    Route::post('/cart/delete', [CartController::class, 'delete'])->name('cart.delete');

});

// ==================== AUTHENTICATION ROUTES ====================
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ==================== ADMIN BACKEND ROUTES ====================
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Category Management
    Route::get('/category', [CategoryController::class, 'index'])->name('category.index');
    Route::post('/category', [CategoryController::class, 'store'])->name('category.store');
    Route::put('/category/{id}', [CategoryController::class, 'update'])->name('category.update');
    Route::delete('/category/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');

    // Product Management
    Route::resource('product', AdminProductController::class)->except(['show']);

    // Transaction Management
    Route::get('/transaction', [AdminTransactionController::class, 'index'])->name('transaction.index');
    Route::get('/transaction/{id}', [AdminTransactionController::class, 'show'])->name('transaction.show');
    Route::put('/transaction/{id}/status', [AdminTransactionController::class, 'updateStatus'])->name('transaction.updateStatus');

    // Settings Management (logo, banner, etc.)
    Route::get('/setting', [AdminSettingController::class, 'index'])->name('setting.index');
    Route::post('/setting', [AdminSettingController::class, 'update'])->name('setting.update');
});

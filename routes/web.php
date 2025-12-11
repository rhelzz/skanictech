<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\HeroSlideController;
use App\Http\Controllers\Admin\PromoBannerController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\AdminManagementController;
use App\Http\Controllers\Admin\SettingController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/katalog', [HomeController::class, 'catalog'])->name('catalog');
Route::get('/produk/{slug}', [HomeController::class, 'productDetail'])->name('product.detail');
Route::get('/tentang-kami', [HomeController::class, 'about'])->name('about');

// Analytics tracking
Route::post('/track/demo/{product}', [HomeController::class, 'trackDemoClick'])->name('track.demo');
Route::post('/track/whatsapp/{product}', [HomeController::class, 'trackWhatsappClick'])->name('track.whatsapp');

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/daftar', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/daftar', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Products
    Route::resource('products', ProductController::class);
    Route::post('products/{product}/toggle-status', [ProductController::class, 'toggleStatus'])->name('products.toggle-status');
    Route::post('products/{product}/toggle-featured', [ProductController::class, 'toggleFeatured'])->name('products.toggle-featured');

    // Categories (Super Admin only via middleware in controller or add middleware)
    Route::resource('categories', CategoryController::class)->except(['show']);
    Route::post('categories/{category}/toggle-status', [CategoryController::class, 'toggleStatus'])->name('categories.toggle-status');

    // Hero Slides
    Route::resource('hero-slides', HeroSlideController::class)->except(['show']);
    Route::post('hero-slides/{heroSlide}/toggle-status', [HeroSlideController::class, 'toggleStatus'])->name('hero-slides.toggle-status');
    Route::post('hero-slides/reorder', [HeroSlideController::class, 'reorder'])->name('hero-slides.reorder');

    // Promo Banners
    Route::resource('promo-banners', PromoBannerController::class)->except(['show']);
    Route::post('promo-banners/{promoBanner}/toggle-status', [PromoBannerController::class, 'toggleStatus'])->name('promo-banners.toggle-status');

    // Profile
    Route::get('profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');

    // Admin Management (Super Admin only)
    Route::middleware('super_admin')->group(function () {
        Route::get('admin-management', [AdminManagementController::class, 'index'])->name('admin-management.index');
        Route::get('admin-management/pending', [AdminManagementController::class, 'pending'])->name('admin-management.pending');
        Route::get('admin-management/create', [AdminManagementController::class, 'create'])->name('admin-management.create');
        Route::post('admin-management', [AdminManagementController::class, 'store'])->name('admin-management.store');
        Route::get('admin-management/{user}/edit', [AdminManagementController::class, 'edit'])->name('admin-management.edit');
        Route::put('admin-management/{user}', [AdminManagementController::class, 'update'])->name('admin-management.update');
        Route::post('admin-management/{user}/approve', [AdminManagementController::class, 'approve'])->name('admin-management.approve');
        Route::post('admin-management/{user}/reject', [AdminManagementController::class, 'reject'])->name('admin-management.reject');
        Route::post('admin-management/{user}/toggle-status', [AdminManagementController::class, 'toggleStatus'])->name('admin-management.toggle-status');
        Route::post('admin-management/{user}/reset-password', [AdminManagementController::class, 'resetPassword'])->name('admin-management.reset-password');
        Route::delete('admin-management/{user}', [AdminManagementController::class, 'destroy'])->name('admin-management.destroy');
        
        // Settings
        Route::get('settings', [SettingController::class, 'index'])->name('settings.index');
        Route::put('settings', [SettingController::class, 'update'])->name('settings.update');
    });
});

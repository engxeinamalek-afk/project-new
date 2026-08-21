<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\DashboardController as DashboardController;
use App\Http\Controllers\admin\ProductController as ProductController;
use App\Http\Controllers\admin\CategoryController as CategoryController;
use App\Http\Controllers\admin\OrderController as OrderController;
use App\Http\Controllers\frontend\OrderController as frontendOrderController;
use App\Http\Controllers\frontend\CartController;
use App\Http\Controllers\admin\UserController as UserController;
use App\Http\Controllers\frontend\CategoryController as frontendCategoryController;
use App\Http\Controllers\frontend\ProductController as frontendProductController;
use App\Http\Controllers\frontend\HomeController;

    Route::get('/', [HomeController::class, 'index'])->name('home');
    // عرض صفحة تفاصيل منتج
    Route::get('product_details/{product}', [frontendProductController::class, 'viewDetails'])->name('product_details');    
    // تفضيل منتج
    Route::post('favorite_product/{product}', [frontendProductController::class, 'favoriteProduct'])->name('favorite_product');    
    // عرض صفحة الفئة
    Route::get('category/{category}', [frontendCategoryController::class, 'index'])->name('viewCategory');    
    //دالة اضافة منتج للسلة
    Route::post('add_to_cart/{product}',[CartController::class, 'store'])->name('add_to_cart');
    //واجهة السلة
    Route::get('cartView' , [CartController::class, 'index'])->name('cartView');

Route::middleware(['auth','user', 'verified'])->group(function () {
    Route::post('order_store', [frontendOrderController::class, 'store'])->name('order_store');
    Route::get('ordersView', [frontendOrderController::class, 'index'])->name('ordersView');
});

Route::middleware(['auth','admin', 'verified'])->group(function () {
    
    // واجهة لوحة التحكم
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // واجهة عرض الفئات
    Route::get('category', [CategoryController::class, 'index'])->name('category');
    //واجهة انشاء فئة 
    Route::get('category_create', [CategoryController::class, 'create'])->name('category_create');
    //دالة تخزين فئة
    Route::post('categories_store', [CategoryController::class, 'store'])->name('categories_store');
    //واجهة تعديل فئة
    Route::get('categories_edit/{category}', [CategoryController::class, 'edit'])->name('categories_edit');
    //دالة تعديل فئة
    Route::put('categories_update/{category}', [CategoryController::class, 'update'])->name('categories_update');
    //دالة حذف فئة
    Route::delete('categories_destroy/{category}', [CategoryController::class, 'destroy'])->name('categories_destroy');
    //دالة تمييز فئة
    Route::post('featuredCategory/{category}', [CategoryController::class, 'featured'])->name('featuredCategory');

    
    // واجهة عرض المنتجات
    Route::get('product', [ProductController::class, 'index'])->name('product');
    //واجهة انشاء منتج 
    Route::get('product_create', [ProductController::class, 'create'])->name('product_create');
    //دالة تخزين منتج
    Route::post('productes_store', [ProductController::class, 'store'])->name('productes_store');
    //واجهة تعديل منتج
    Route::get('productes_edit/{product}', [ProductController::class, 'edit'])->name('productes_edit');
    //دالة تعديل منتج
    Route::put('productes_update/{product}', [ProductController::class, 'update'])->name('productes_update');
    //دالة حذف منتج
    Route::delete('productes_destroy/{product}', [ProductController::class, 'destroy'])->name('productes_destroy');
    //دالة تمييز منتج
    Route::post('featured/{product}', [ProductController::class, 'featured'])->name('featured');
    //دالة تخفيض منتج
    Route::post('/products/{product}/apply-discount', [ProductController::class, 'applyDiscount'])->name('applyDiscount');

    //دالة عرض جدول الطلبات 
    Route::get('order', [OrderController::class, 'index'])->name('order');
    //تعديل حالة الطلب
    Route::post('/orders/{id}/update-status', [OrderController::class, 'updateStatus']);

    //واجهة عرض المستخدمين
    Route::get('users', [UserController::class, 'index'])->name('users');




});









Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

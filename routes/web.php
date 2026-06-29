<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PublicController;

// Public Routes
Route::get('/', [PublicController::class, 'home'])->name('home');

// Auth Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin Routes
Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    
    Route::get('/banners', [AdminController::class, 'banners'])->name('admin.banners');
    Route::post('/banners', [AdminController::class, 'storeBanner']);
    Route::post('/banners/{banner}', [AdminController::class, 'updateBanner'])->name('admin.banners.update');
    Route::delete('/banners/{banner}', [AdminController::class, 'deleteBanner'])->name('admin.banners.delete');
    
    Route::get('/faqs', [AdminController::class, 'faqs'])->name('admin.faqs');
    Route::post('/faqs', [AdminController::class, 'storeFaq']);
    Route::post('/faqs/{faq}', [AdminController::class, 'updateFaq'])->name('admin.faqs.update');
    Route::delete('/faqs/{faq}', [AdminController::class, 'deleteFaq'])->name('admin.faqs.delete');

    Route::get('/news', [AdminController::class, 'news'])->name('admin.news');
    Route::post('/news', [AdminController::class, 'storeNews']);
    Route::post('/news/{news}', [AdminController::class, 'updateNews'])->name('admin.news.update');
    Route::delete('/news/{news}', [AdminController::class, 'deleteNews'])->name('admin.news.delete');

    Route::get('/activities', [AdminController::class, 'activities'])->name('admin.activities');
    Route::post('/activities', [AdminController::class, 'storeActivity']);
    Route::post('/activities/{activity}', [AdminController::class, 'updateActivity'])->name('admin.activities.update');
    Route::delete('/activities/{activity}', [AdminController::class, 'deleteActivity'])->name('admin.activities.delete');
    
    Route::get('/galleries', [AdminController::class, 'galleries'])->name('admin.galleries');
    Route::post('/galleries', [AdminController::class, 'storeGallery']);
    Route::post('/galleries/{gallery}', [AdminController::class, 'updateGallery'])->name('admin.galleries.update');
    Route::delete('/galleries/{gallery}', [AdminController::class, 'deleteGallery'])->name('admin.galleries.delete');
    
    Route::get('/settings', [AdminController::class, 'settings'])->name('admin.settings');
    Route::post('/settings', [AdminController::class, 'storeSettings']);
});


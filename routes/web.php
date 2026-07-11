<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PublicController;

// Public Routes
Route::get('/', [PublicController::class, 'home'])->name('home');
Route::get('/tentang', [PublicController::class, 'home'])->name('tentang');
Route::get('/berita', [PublicController::class, 'home'])->name('berita');
Route::get('/kegiatan', [PublicController::class, 'home'])->name('kegiatan');
Route::get('/galeri', [PublicController::class, 'home'])->name('galeri');
Route::get('/faq', [PublicController::class, 'home'])->name('faq');
Route::get('/kontak', [PublicController::class, 'home'])->name('kontak');
Route::get('/berita/{news}', [PublicController::class, 'newsDetail'])->name('news.show');
Route::get('/kegiatan/{activity}', [PublicController::class, 'activityDetail'])->name('activity.show');
Route::post('/contact', [PublicController::class, 'storeMessage'])->name('contact.store');

// Serve storage images without symlink
Route::get('/uploads/{path}', function (string $path) {
    $fullPath = storage_path('app/public/' . $path);
    if (!file_exists($fullPath)) {
        abort(404);
    }
    return response()->file($fullPath);
})->where('path', '.*');

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

    Route::get('/principal', [AdminController::class, 'principal'])->name('admin.principal');
    Route::post('/principal', [AdminController::class, 'updatePrincipal'])->name('admin.principal.update');

    Route::get('/teachers', [AdminController::class, 'teachers'])->name('admin.teachers');
    Route::post('/teachers', [AdminController::class, 'storeTeacher']);
    Route::post('/teachers/{teacher}', [AdminController::class, 'updateTeacher'])->name('admin.teachers.update');
    Route::delete('/teachers/{teacher}', [AdminController::class, 'deleteTeacher'])->name('admin.teachers.delete');

    Route::get('/messages', [AdminController::class, 'messages'])->name('admin.messages');
    Route::get('/messages/{message}', [AdminController::class, 'showMessage'])->name('admin.messages.show');
    Route::delete('/messages/{message}', [AdminController::class, 'deleteMessage'])->name('admin.messages.delete');

    Route::get('/settings/profile', [AdminController::class, 'settingsProfile'])->name('admin.settings.profile');
    Route::post('/settings/profile', [AdminController::class, 'storeSettingsProfile']);
    Route::get('/settings/vision', [AdminController::class, 'settingsVision'])->name('admin.settings.vision');
    Route::post('/settings/vision', [AdminController::class, 'storeSettingsVision']);
    Route::get('/settings/mission', [AdminController::class, 'settingsMission'])->name('admin.settings.mission');
    Route::post('/settings/mission', [AdminController::class, 'storeSettingsMission']);
    Route::get('/settings/contact', [AdminController::class, 'settingsContact'])->name('admin.settings.contact');
    Route::post('/settings/contact', [AdminController::class, 'storeSettingsContact']);
    Route::get('/settings/operational-hours', [AdminController::class, 'settingsOperationalHours'])->name('admin.settings.operational-hours');
    Route::post('/settings/operational-hours', [AdminController::class, 'storeSettingsOperationalHours']);

    // User Management
    Route::get('/users', [AdminController::class, 'users'])->name('admin.users');
    Route::post('/users', [AdminController::class, 'storeUser']);
    Route::delete('/users/{user}', [AdminController::class, 'deleteUser'])->name('admin.users.delete');
});


<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Admin\ProjectController as AdminProjectController;
use App\Http\Controllers\Admin\NewsController as AdminNewsController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ForgotPasswordController; // Tambahkan ini

/*
|--------------------------------------------------------------------------
| FRONTEND ROUTES
|--------------------------------------------------------------------------
*/

// Halaman Utama (Home, About, Skills, Projects, News, Education, Experience, Contact)
Route::get('/', [ProjectController::class, 'index'])->name('home');

// Project Detail (Menggunakan ID)
Route::get('/project/detail/{id}', [ProjectController::class, 'show'])->name('project.detail');

// News Detail (Mendukung Slug atau ID agar sinkron dengan Alpine.js)
Route::get('/news/{slugOrId}', [ProjectController::class, 'showNews'])->name('news.detail');

// Route Pengiriman Pesan (Contact Form)
Route::post('/contact-send', [ContactController::class, 'send'])->name('contact.send');

/*
|--------------------------------------------------------------------------
| AUTH ROUTES (Pintu Rahasia)
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {
    // Route login dengan custom URL
    Route::get('/pintu-rahasia', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/pintu-rahasia', [LoginController::class, 'login'])->name('processLogin');

    // --- FITUR RESET PASSWORD ---
    // 1. Form Lupa Password (Input Email)
    Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    // 2. Kirim Link Reset ke Email
    Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLink'])->name('password.email');
    // 3. Form Input Password Baru (Dari Link Email)
    Route::get('/reset-password/{token}', [ForgotPasswordController::class, 'showResetForm'])->name('password.reset');
    // 4. Update Password Baru ke Database
    Route::post('/reset-password', [ForgotPasswordController::class, 'resetPassword'])->name('password.update');
});

// Logout harus bisa diakses setelah login
Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

/*
|--------------------------------------------------------------------------
| ADMIN ROUTES (Protected by Auth)
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    // Dashboard Admin
    Route::get('/', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    // CRUD Projects & News
    Route::resource('projects', AdminProjectController::class);
    Route::resource('news', AdminNewsController::class);
});

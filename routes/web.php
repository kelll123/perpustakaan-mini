<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StaffController;
// PERBAIKAN 1: Pastikan pakai Staff\BookController (bukan Admin)
use App\Http\Controllers\Staff\BookController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\BookController as AdminBookController;

Route::get('/', function () {
    return view('welcome');
});

// Route Auth
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Dashboard Admin
Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->middleware('auth');

// Group Staff
Route::middleware(['auth', 'role:staff'])->group(function () {

    // Dashboard Staff
    Route::get('/staff/dashboard', [StaffController::class, 'dashboard'])
        ->name('staff.dashboard');

    // PERBAIKAN 2: Gunakan grouping yang benar untuk Resource
    Route::prefix('staff')       // Membuat URL diawali /staff/...
        ->name('staff.')         // Membuat nama route diawali staff.... (PENTING!)
        ->group(function () {

            // Ini otomatis membuat route: staff.books.index, staff.books.store, dll
            Route::resource('books', BookController::class);
        });
});

// GROUP ROUTE ADMIN
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {

    Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
    Route::resource('books', AdminBookController::class);

    Route::resource('categories', App\Http\Controllers\Admin\CategoryController::class);
    Route::resource('staff', App\Http\Controllers\Admin\StaffController::class);
});

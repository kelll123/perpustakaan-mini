<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\BorrowController;
use App\Http\Controllers\RegisterController;

//Admin
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\BookController as AdminBookController;
use App\Http\Controllers\Admin\AuthorController as AdminAuthorController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\StaffController as AdminStaffController;

//Staff 
use App\Http\Controllers\StaffController as StaffAreaController;
use App\Http\Controllers\Staff\BookController as StaffBookController;



// 1. HALAMAN DEPAN (GUEST)
Route::get('/', [GuestController::class, 'index'])->name('welcome');

Route::get('/book/{id}', [GuestController::class, 'show'])->name('book.detail');

// 2. AUTHENTICATION (Login, Logout, Register)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');


// 3. MEMBER AREA (Peminjam)
Route::middleware(['auth'])->group(function () {
    // Dashboard Member
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    // Proses Pinjam Buku
    Route::post('/borrow/{id}', [BorrowController::class, 'store'])->name('borrow.store');
});


// 4. ADMIN PANEL
// Menggabungkan semua route admin dalam satu grup agar rapi
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {

    // Dashboard Admin
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // Manajemen Data (CRUD)
    Route::resource('books', AdminBookController::class);
    Route::resource('authors', AdminAuthorController::class);
    Route::resource('categories', AdminCategoryController::class);
    Route::resource('staff', AdminStaffController::class);

    // Route untuk memproses pengembalian buku
    Route::put('/return-book/{id}', [AdminDashboardController::class, 'returnBook'])->name('book.return');
});


// 5. STAFF PANEL
Route::middleware(['auth', 'role:staff'])->prefix('staff')->name('staff.')->group(function () {

    // Dashboard Staff
    Route::get('/dashboard', [StaffAreaController::class, 'dashboard'])->name('dashboard');

    // Manajemen Buku oleh Staff
    Route::resource('books', StaffBookController::class);

    // TAMBAHKAN INI: Agar staff punya halaman member dengan prefix staff.members
    Route::get('/members', [StaffAreaController::class, 'members'])->name('members.index');
});


// 6. MANAJEMEN MEMBER (Khusus Admin)
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('members', MemberController::class);
});

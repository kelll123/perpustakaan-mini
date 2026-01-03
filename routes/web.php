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



//HALAMAN DEPAN GUEST
Route::get('/', [GuestController::class, 'index'])->name('welcome');

Route::get('/book/{id}', [GuestController::class, 'show'])->name('book.detail');

//Login, Logout, Register
Route::middleware('guest')->group(function () {

    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');


//MEMBER AREA (Peminjam)
Route::middleware(['auth'])->group(function () {

    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::post('/borrow/{id}', [BorrowController::class, 'store'])->name('borrow.store');
});


// ADMIN PANEL
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

    Route::get('/dashboard', [StaffAreaController::class, 'dashboard'])->name('dashboard');

    Route::resource('books', StaffBookController::class);
    Route::get('/members', [StaffAreaController::class, 'members'])->name('members.index');
    Route::put('/return-book/{id}', [StaffAreaController::class, 'returnBook'])->name('book.return');
    Route::get('/authors', [StaffAreaController::class, 'authors'])->name('authors.index');
    Route::get('/categories', [StaffAreaController::class, 'categories'])->name('categories.index');

    //CRUD penulis
    Route::post('/authors', [StaffAreaController::class, 'storeAuthor'])->name('authors.store');
    Route::put('/authors/{id}', [StaffAreaController::class, 'updateAuthor'])->name('authors.update');
    Route::delete('/authors/{id}', [StaffAreaController::class, 'destroyAuthor'])->name('authors.destroy');

    // CRUD Kategori
    Route::get('/categories', [StaffAreaController::class, 'categories'])->name('categories.index');
    Route::post('/categories', [StaffAreaController::class, 'storeCategory'])->name('categories.store');
    Route::put('/categories/{id}', [StaffAreaController::class, 'updateCategory'])->name('categories.update');
    Route::delete('/categories/{id}', [StaffAreaController::class, 'destroyCategory'])->name('categories.destroy');
});


// 6. MANAJEMEN MEMBER (Khusus Admin)
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('members', MemberController::class);
});

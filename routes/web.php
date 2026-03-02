<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BorrowingController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Public routes
Route::get('/', function () {
    return view('welcome');
});

// Auth routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Protected routes (require authentication)
Route::middleware(['auth'])->group(function () {
    
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // User Management (Admin only)
    Route::middleware(['admin'])->group(function () {
        Route::resource('users', UserController::class);
    });
    
    // Books Management
    Route::resource('books', BookController::class);
    
    // Members Management
    Route::resource('members', MemberController::class);
    
    // Categories Management
    Route::resource('categories', CategoryController::class);
    
    // Borrowings Management
    Route::resource('borrowings', BorrowingController::class);
    Route::post('/borrowings/{borrowing}/return', [BorrowingController::class, 'returnBook'])->name('borrowings.return');
    
    // Reports
    Route::get('/reports/borrowings', [BorrowingController::class, 'report'])->name('reports.borrowings');
    Route::get('/reports/overdue', [BorrowingController::class, 'overdue'])->name('reports.overdue');
});


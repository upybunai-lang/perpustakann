<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BookController;
use App\Http\Controllers\Api\MemberController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\BorrowingController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// Public API routes
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

// Protected API routes (require authentication)
Route::middleware('auth:sanctum')->group(function () {
    
    // Auth
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    
    // Books API
    Route::apiResource('books', BookController::class);
    Route::get('/books/search/{keyword}', [BookController::class, 'search']);
    
    // Members API
    Route::apiResource('members', MemberController::class);
    Route::get('/members/search/{keyword}', [MemberController::class, 'search']);
    Route::patch('/members/{member}/status', [MemberController::class, 'updateStatus']);
    
    // Categories API
    Route::apiResource('categories', CategoryController::class);
    
    // Borrowings API
    Route::apiResource('borrowings', BorrowingController::class);
    Route::post('/borrowings/{borrowing}/return', [BorrowingController::class, 'returnBook']);
    Route::get('/borrowings/member/{member}', [BorrowingController::class, 'byMember']);
    Route::get('/borrowings/overdue/list', [BorrowingController::class, 'overdue']);
    
    // Statistics & Reports
    Route::get('/statistics/dashboard', [BorrowingController::class, 'statistics']);
});


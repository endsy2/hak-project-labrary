<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BorrowerController;

// Show login page
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');

// Handle login submission
Route::post('/login', [AuthController::class, 'login'])->name('login');

// Handle logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Dashboard (only for authenticated users)
Route::get('/dashboard', [AuthController::class, 'dashboard'])->middleware('auth')->name('dashboard');

// Redirect root URL to login
Route::get('/', function () {
    return redirect()->route('login.form');
});
Route::get('/dashboard', [AuthController::class, 'dashboard'])->middleware('auth')->name('dashboard');


Route::get('/book-information', function () {
    return view('bookinformation');
})->name('bookinformation');

// Route::get('/borrower', function () {
//     return view('borrower');
// })->name('borrower');
// //test
// Route::get('/borrower', [BorrowerController::class, 'index'])->name('borrower');
// Route::post('/borrower', [BorrowerController::class, 'store'])->name('borrower.store');
// Route::get('/borrower', [BorrowerController::class, 'index'])->name('borrower');
// Route::post('/borrower', [BorrowerController::class, 'store'])->name('borrower.store');
// Route::put('/borrower/{id}', [BorrowerController::class, 'update'])->name('borrower.update');
// Route::delete('/borrower/{id}', [BorrowerController::class, 'destroy'])->name('borrower.destroy');
Route::resource('borrowers', BorrowerController::class);

Route::get('/books', [BookController::class, 'index'])->name('books.index');

Route::resource('books', BookController::class);

Route::get('/books', [BookController::class, 'index']);
Route::post('/books', [BookController::class, 'store']);
Route::put('/books/{id}', [BookController::class, 'update']);
Route::delete('/books/{id}', [BookController::class, 'destroy']);
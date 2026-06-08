<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BorrowingController;
use App\Http\Controllers\ReturnBookController;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    if (auth()->check()) {
        /** @var \App\Models\User $user */
        $user = auth()->user();
        if ($user->isAdmin()) {
            return redirect()->route('admin.dashboard');
        }
        return redirect()->route('member.dashboard');
    }
    return view('landing');
})->name('landing');

/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'admin'])
        ->name('admin.dashboard');

    // categories
    Route::resource('categories', CategoryController::class)->except(['show']);

    // authors
    Route::resource('authors', AuthorController::class)->except(['show']);

    // books CRUD
    Route::resource('books', BookController::class)->except(['show', 'index']);

    // borrowings
    Route::resource('borrowings', BorrowingController::class)->except(['edit', 'update']);

    // return books
    Route::resource('return_books', ReturnBookController::class)
        ->only(['index', 'create', 'store', 'show']);
});

/*
|--------------------------------------------------------------------------
| Member Routes
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/member/dashboard', [DashboardController::class, 'member'])
        ->name('member.dashboard');

    // lihat daftar dan detail buku
    Route::get('/books', [BookController::class, 'index'])->name('books.index');
    Route::get('/books/{slug}', [BookController::class, 'show'])->name('books.show');
});


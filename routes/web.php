<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\Admin\AdminMenuController;

// ==========================
// AUTH & LANDING
// ==========================

// Default landing page → redirect ke login
Route::get('/', function () {
    return redirect()->route('login');
});

// Login
Route::get('/login', [AuthController::class, 'loginPage'])->name('login');
Route::post('/login', [AuthController::class, 'loginProcess']);

// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Register
Route::get('/register', [AuthController::class, 'registerPage'])->name('register');
Route::post('/register', [AuthController::class, 'registerProcess']);

// Setelah login, /dashboard diarahkan ke halaman menu user
Route::get('/dashboard', function () {
    return redirect()->route('menus.index');
})->middleware('auth');

// ==========================
// ROUTE USER (WAJIB LOGIN)
// ==========================
Route::middleware('auth')->group(function () {
    // Halaman menu & rekomendasi
    Route::get('/menus', [MenuController::class, 'index'])->name('menus.index');
    Route::get('/menus/{id}', [MenuController::class, 'show'])->name('menus.show');

    // Halaman keranjang / riwayat pilihan
    Route::get('/keranjang', [CartController::class, 'index'])->name('cart.index');
    Route::post('/keranjang/{menu}', [CartController::class, 'store'])->name('cart.store');
    Route::delete('/keranjang/{cart}', [CartController::class, 'destroy'])->name('cart.destroy');
});

// ==========================
// ROUTE ADMIN (WAJIB LOGIN + ADMIN)
// prefix: /admin
// name:   admin.*
// ==========================
Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'is_admin'])
    ->group(function () {

        // /admin diarahkan ke /admin/menus
        Route::get('/', function () {
            return redirect()->route('admin.menus.index');
        })->name('dashboard');

        // CRUD kelola menu
        Route::resource('menus', AdminMenuController::class);
    });

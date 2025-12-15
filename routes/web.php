<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\Admin\AdminMenuController;
use App\Http\Controllers\Admin\AdminUserController;

// ==========================
// AUTH & LANDING
// ==========================
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
// ROUTE USER (WAJIB LOGIN) -> USER & ADMIN bisa akses
// ==========================
Route::middleware('auth')->group(function () {
    // rekomendasi (bisa admin & user)
    Route::get('/rekomendasi', [MenuController::class, 'recommend'])->name('menus.recommend');

    // Halaman menu & rekomendasi budget
    Route::get('/menus', [MenuController::class, 'index'])->name('menus.index');
    Route::get('/menus/{id}', [MenuController::class, 'show'])->name('menus.show');

    // Keranjang (user biasa)
    Route::get('/keranjang', [CartController::class, 'index'])->name('cart.index');
    Route::post('/keranjang/{menu}', [CartController::class, 'store'])->name('cart.store');
    Route::delete('/keranjang/{cart}', [CartController::class, 'destroy'])->name('cart.destroy');
});
    

// ==========================
// ROUTE ADMIN (WAJIB LOGIN + ADMIN)
// ==========================
Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'is_admin'])
    ->group(function () {

        Route::get('/', function () {
            return redirect()->route('admin.menus.index');
        })->name('dashboard');

        // CRUD kelola menu
        Route::resource('menus', AdminMenuController::class);

        // Manajemen user
        Route::get('/users', [AdminUserController::class, 'index'])->name('users.index');
        Route::get('/users/{user}', [AdminUserController::class, 'show'])->name('users.show');
        Route::delete('/users/{user}', [AdminUserController::class, 'destroy'])->name('users.destroy');
    });
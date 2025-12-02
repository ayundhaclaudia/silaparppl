<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MenuController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application.
| These routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Default landing page → redirect ke login
Route::get('/', function () {
    return redirect('/login');
});

// Login Page
Route::get('/login', [AuthController::class, 'loginPage'])->name('login');

// Proses Login
Route::post('/login', [AuthController::class, 'loginProcess']);

// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Dashboard (halaman utama) – hanya bisa diakses setelah login
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth');

// Halaman Register
Route::get('/register', [AuthController::class, 'registerPage'])->name('register');

// Proses Register
Route::post('/register', [AuthController::class, 'registerProcess']);

Route::get('/dashboard', function () {
    return redirect()->route('menus.index');
})->middleware('auth');

// Halaman menu & rekomendasi berdasarkan budget (auth protected)
Route::get('/menus', [MenuController::class, 'index'])->name('menus.index');
Route::get('/menus/{id}', [MenuController::class, 'show'])->name('menus.show');

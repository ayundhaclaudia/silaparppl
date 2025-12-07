<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // =========================
    // LOGIN USER
    // =========================
    public function loginPage()
    {
        // form login untuk USER biasa
        return view('auth.login');
    }

    public function loginProcess(Request $request)
    {
        // validasi input
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();

            // jika admin, arahkan ke dashboard admin
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }

            // jika user biasa, arahkan ke dashboard/menu user
            return redirect()->route('menus.index');
        }

        return back()->withErrors([
            'loginError' => 'Email atau password salah.',
        ])->onlyInput('email');
    }

    // =========================
    // LOGIN ADMIN (KHUSUS ADMIN)
    // =========================
    public function adminLoginPage()
    {
        // buat view baru: resources/views/auth/admin-login.blade.php
        return view('auth.admin-login');
    }

    public function adminLoginProcess(Request $request)
    {
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();

            // pastikan yang login benar-benar admin
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }

            // kalau yang login bukan admin, langsung logout lagi
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return back()->withErrors([
                'loginError' => 'Akun ini bukan akun admin.',
            ])->onlyInput('email');
        }

        return back()->withErrors([
            'loginError' => 'Email atau password admin salah.',
        ])->onlyInput('email');
    }

    // =========================
    // LOGOUT
    // =========================
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }

    // =========================
    // REGISTER USER
    // =========================
    public function registerPage()
    {
        return view('auth.register');
    }

    public function registerProcess(Request $request)
    {
        // Validasi input
        $request->validate([
            'name'                  => ['required', 'min:3'],
            'email'                 => ['required', 'email', 'unique:users,email'],
            'password'              => ['required', 'min:6', 'confirmed'],
        ]);

        // Simpan data user ke database
        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => bcrypt($request->password),
            // pastikan di tabel users ada kolom "role"
            // dan di model User sudah dimasukkan ke $fillable
            'role'     => 'user',
        ]);

        // Login otomatis setelah register
        Auth::login($user);

        // Redirect ke dashboard user
        return redirect()->route('menus.index')->with('success', 'Akun berhasil dibuat!');
    }
}

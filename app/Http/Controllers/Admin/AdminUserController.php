<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    public function index()
    {
        // urutkan dari user terbaru, pakai pagination biar rapi
        $users = User::orderByDesc('created_at')->paginate(10);

        return view('admin.users.index', compact('users'));
    }

    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }

    public function destroy(User $user)
    {
        // biar admin tidak bisa menghapus dirinya sendiri
        if (auth()->id() === $user->id) {
            return back()->with('error', 'Tidak bisa menghapus akun admin yang sedang login.');
        }

        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'User berhasil dihapus.');
    }
}

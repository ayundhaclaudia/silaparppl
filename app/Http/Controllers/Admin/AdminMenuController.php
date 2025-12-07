<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;

class AdminMenuController extends Controller
{
    public function index()
    {
        // Ambil semua menu untuk ditampilkan di admin
        $menus = Menu::orderBy('created_at', 'desc')->get();

        return view('admin.menus.index', compact('menus'));
    }

    // method lain (create, store, edit, update, destroy) nanti bisa ditambah di sini
}

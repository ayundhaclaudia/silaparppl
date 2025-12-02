<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;

class MenuController extends Controller
{
    // pastikan controller hanya untuk user yang sudah auth
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Tampilkan form input budget + daftar hasil (jika ada)
    public function index(Request $request)
    {
        // ambil budget dari query param ?budget=10000
        $budget = $request->query('budget');

        $menus = collect(); // kosong default

        if ($budget !== null && $budget !== '') {
            // validasi sederhana: harus numeric dan >= 0
            $validated = $request->validate([
                'budget' => ['nullable', 'numeric', 'min:0']
            ]);

            // exact match: harga == budget
            $menus = Menu::where('price', intval($budget))->get();
        }

        return view('menus.index', compact('menus', 'budget'));
    }

    // Tampilkan detail menu
    public function show($id)
    {
        $menu = Menu::findOrFail($id);
        return view('menus.show', compact('menu'));
    }
}

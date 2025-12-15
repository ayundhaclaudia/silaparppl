<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;

class MenuController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['recommend']);
    }

    // HALAMAN INPUT BUDGET + HASIL REKOMENDASI
    public function index(Request $request)
    {
        $budget = $request->query('budget');

        $query = Menu::query();

        if ($budget !== null && $budget !== '') {
            $request->validate([
                'budget' => ['numeric', 'min:0'],
            ]);

            $budgetInt = (int) $budget;

            // LOGIKA RANGE YANG SUDAH KITA PAKAI:
            // 0      => 0 - 8999
            // 10000  => 10000 - 19999
            // 20000  => 20000 - 29999
            // 30000  => 30000 - 39999
            if ($budgetInt === 0) {
                $query->whereBetween('price', [0, 8999]);
            } elseif ($budgetInt === 10000) {
                $query->whereBetween('price', [10000, 19999]);
            } elseif ($budgetInt === 20000) {
                $query->whereBetween('price', [20000, 29999]);
            } elseif ($budgetInt === 30000) {
                $query->whereBetween('price', [30000, 39999]);
            } else {
                // kalau user isi budget bebas (misal 15000),
                // ambil semua yang price <= budget
                $query->where('price', '<=', $budgetInt);
            }
        }

        // HASIL FILTER BUDGET diurutkan berdasarkan rating tertinggi
        $menus = $query
            ->orderByDesc('rating')
            ->orderBy('price', 'asc')
            ->get();

        // REKOMENDASI UTAMA: top 4 menu dengan rating tertinggi (tanpa filter budget)
        $recommendedMenus = Menu::orderByDesc('rating')
            ->orderBy('price', 'asc')
            ->take(4)
            ->get();

        return view('menus.index', compact('menus', 'budget', 'recommendedMenus'));
    }

    public function show($id)
    {
        $menu = Menu::findOrFail($id);
        return view('menus.show', compact('menu'));
    }

    public function recommend(Request $request)
    {
        $q = trim((string) $request->query('q', ''));

        $menus = Menu::query()
            ->when($q !== '', function ($query) use ($q) {
                $query->where('name', 'like', '%' . $q . '%');
            })
            ->orderByDesc('rating')
            ->orderByDesc('reviews_count')
            ->orderBy('price')
            ->get();

        return view('menus.recommend', compact('menus', 'q'));
    }

}
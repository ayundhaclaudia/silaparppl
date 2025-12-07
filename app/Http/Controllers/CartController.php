<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Menu;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // TAMPILKAN HALAMAN KERANJANG / RIWAYAT PILIHAN
    public function index()
    {
        $user = Auth::user();

        // ambil semua cart milik user + relasi menu
        $items = Cart::with('menu')
            ->where('user_id', $user->id)
            ->orderByDesc('created_at')
            ->get();

        return view('cart.index', compact('items'));
    }

    // SIMPAN MENU KE KERANJANG
    public function store($menuId)
    {
        $userId = Auth::id();

        $menu = Menu::findOrFail($menuId);

        // kalau sudah ada di keranjang, tambah quantity
        $cartItem = Cart::firstOrCreate(
            [
                'user_id' => $userId,
                'menu_id' => $menu->id,
            ],
            [
                'quantity' => 0,
            ]
        );

        $cartItem->quantity += 1;
        $cartItem->save();

        return redirect()
            ->route('cart.index')
            ->with('success', 'Menu berhasil disimpan ke keranjang.');
    }

    // HAPUS DARI KERANJANG
    public function destroy(Cart $cart)
    {
        // pastikan ini milik user yang login
        if ($cart->user_id !== Auth::id()) {
            abort(403);
        }

        $cart->delete();

        return redirect()
            ->route('cart.index')
            ->with('success', 'Menu berhasil dihapus dari keranjang.');
    }
}

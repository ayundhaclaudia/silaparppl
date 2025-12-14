<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminMenuController extends Controller
{
    public function index()
    {
        $menus = Menu::orderBy('created_at', 'desc')->get();
        return view('admin.menus.index', compact('menus'));
    }

    public function create()
    {
        return view('admin.menus.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'          => ['required','string','max:255'],
            'price'         => ['required','integer','min:0'],
            'description'   => ['nullable','string'],
            'rating'        => ['required','numeric','min:0','max:5'],
            'reviews_count' => ['required','integer','min:0'],
            'image'         => ['nullable','image','mimes:jpg,jpeg,png,webp','max:2048'],
        ]);

        // upload image (opsional)
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = Str::slug($data['name']).'-'.time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('images/menus'), $filename);
            $data['image'] = $filename;
        }

        Menu::create($data);

        return redirect()->route('admin.menus.index')->with('success', 'Menu berhasil ditambahkan.');
    }

    public function edit(Menu $menu)
    {
        return view('admin.menus.edit', compact('menu'));
    }

    public function update(Request $request, Menu $menu)
    {
        $data = $request->validate([
            'name'          => ['required','string','max:255'],
            'price'         => ['required','integer','min:0'],
            'description'   => ['nullable','string'],
            'rating'        => ['required','numeric','min:0','max:5'],
            'reviews_count' => ['required','integer','min:0'],
            'image'         => ['nullable','image','mimes:jpg,jpeg,png,webp','max:2048'],
        ]);

        // upload image (opsional)
        if ($request->hasFile('image')) {
            // hapus file lama jika ada
            if ($menu->image) {
                $oldPath = public_path('images/menus/'.$menu->image);
                if (file_exists($oldPath)) unlink($oldPath);
            }

            $file = $request->file('image');
            $filename = Str::slug($data['name']).'-'.time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('images/menus'), $filename);
            $data['image'] = $filename;
        }

        $menu->update($data);

        return redirect()->route('admin.menus.index')->with('success', 'Menu berhasil diupdate.');
    }

    public function destroy(Menu $menu)
    {
        if ($menu->image) {
            $path = public_path('images/menus/'.$menu->image);
            if (file_exists($path)) unlink($path);
        }

        $menu->delete();

        return redirect()->route('admin.menus.index')->with('success', 'Menu berhasil dihapus.');
    }
}

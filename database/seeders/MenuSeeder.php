<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Menu;

class MenuSeeder extends Seeder
{
    public function run()
    {
        // Pastikan kamu sudah menaruh beberapa gambar di public/images/menus/
        Menu::create([
            'name' => 'Nasi Goreng Spesial',
            'price' => 10000,
            'description' => 'Nasi goreng lengkap dengan telur dan ayam suwir.',
            'images' => 'nasi_goreng.jpg',
        ]);

        Menu::create([
            'name' => 'Mie Ayam Pangsit',
            'price' => 10000,
            'description' => 'Mie ayam dengan pangsit goreng.',
            'image' => 'mie_ayam.jpg',
        ]);

        Menu::create([
            'name' => 'Bakso Kuah',
            'price' => 12000,
            'description' => 'Bakso sapi dengan kuah kaldu gurih.',
            'image' => 'bakso.jpg',
        ]);

        Menu::create([
            'name' => 'Siomay',
            'price' => 8000,
            'description' => 'Siomay ikan dengan bumbu kacang.',
            'image' => 'siomay.jpg',
        ]);
    }
}

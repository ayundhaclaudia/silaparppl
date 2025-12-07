<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Menu;

class MenuSeeder extends Seeder
{
    public function run()
    {
        // Nasi Goreng Spesial
        Menu::create([
            'name'          => 'Nasi Goreng Spesial',
            'price'         => 10000,
            'description'   => 'Nasi goreng lengkap dengan telur dan ayam suwir.',
            'image'         => 'nasi_goreng.jpg',
            'rating'        => 4.8,
            'reviews_count' => 132,
        ]);

        // Mie Ayam Pangsit
        Menu::create([
            'name'          => 'Mie Ayam Pangsit',
            'price'         => 10000,
            'description'   => 'Mie ayam dengan pangsit goreng.',
            'image'         => 'mie_ayam.jpg',
            'rating'        => 4.6,
            'reviews_count' => 98,
        ]);

        // Bakso Kuah
        Menu::create([
            'name'          => 'Bakso Kuah',
            'price'         => 12000,
            'description'   => 'Bakso sapi dengan kuah kaldu gurih.',
            'image'         => 'bakso.jpg',
            'rating'        => 4.7,
            'reviews_count' => 120,
        ]);

        // Siomay
        Menu::create([
            'name'          => 'Siomay',
            'price'         => 8000,
            'description'   => 'Siomay ikan dengan bumbu kacang.',
            'image'         => 'siomay.jpg',
            'rating'        => 4.5,
            'reviews_count' => 87,
        ]);

        // Sate Ayam
        Menu::create([
            'name'          => 'Sate Ayam',
            'price'         => 16000,
            'description'   => 'Sate ayam dengan bumbu kacang khas Madura.',
            'image'         => 'sate_ayam.jpg',
            'rating'        => 3.7,
            'reviews_count' => 150,
        ]);

        // Es Teh Manis
        Menu::create([
            'name'          => 'Es Teh Manis',
            'price'         => 5000,
            'description'   => 'Minuman teh segar dengan gula asli.',
            'image'         => 'es_teh.jpg',
            'rating'        => 5.0,
            'reviews_count' => 95,
        ]);

        // Es Jeruk
        Menu::create([
            'name'          => 'Es Jeruk',
            'price'         => 6000,
            'description'   => 'Jeruk segar diperas langsung, manis dan menyegarkan.',
            'image'         => 'es_jeruk.jpg',
            'rating'        => 4.6,
            'reviews_count' => 102,
        ]);

        // Mie Goreng
        Menu::create([
            'name'          => 'Mie Goreng',
            'price'         => 9000,
            'description'   => 'Mie goreng kecap dengan sayur dan telur.',
            'image'         => 'mie_goreng.jpg',
            'rating'        => 2.9,
            'reviews_count' => 88,
        ]);
    }
}

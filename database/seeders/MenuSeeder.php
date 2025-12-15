<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Menu;

class MenuSeeder extends Seeder
{
    public function run()
    {
        Menu::create([
            'name' => 'Nasi Goreng Spesial',
            'price' => 10000,
            'description' => 'Nasi goreng lengkap dengan telur dan ayam suwir.',
            'image' => 'nasi-goreng-spesial-1765725941.jpg',
            'rating' => 4.8,
            'reviews_count' => 132,
        ]);

        Menu::create([
            'name' => 'Mie Ayam Pangsit',
            'price' => 10000,
            'description' => 'Mie ayam dengan pangsit goreng.',
            'image' => 'mie_ayam.jpg',
            'rating' => 4.6,
            'reviews_count' => 98,
        ]);

        Menu::create([
            'name' => 'Bakso Kuah',
            'price' => 12000,
            'description' => 'Bakso sapi dengan kuah kaldu gurih.',
            'image' => 'bakso.jpg',
            'rating' => 4.7,
            'reviews_count' => 120,
        ]);

        Menu::create([
            'name' => 'Siomay',
            'price' => 8000,
            'description' => 'Siomay ikan dengan bumbu kacang.',
            'image' => 'siomay.jpg',
            'rating' => 4.5,
            'reviews_count' => 87,
        ]);

        Menu::create([
            'name' => 'Sate Ayam',
            'price' => 16000,
            'description' => 'Sate ayam dengan bumbu kacang khas Madura.',
            'image' => 'sate_ayam.jpg',
            'rating' => 3.7,
            'reviews_count' => 150,
        ]);

        Menu::create([
            'name' => 'Es Teh Manis',
            'price' => 5000,
            'description' => 'Minuman teh segar dengan gula asli.',
            'image' => 'es_teh.jpg',
            'rating' => 5.0,
            'reviews_count' => 95,
        ]);

        Menu::create([
            'name' => 'Es Jeruk',
            'price' => 6000,
            'description' => 'Jeruk segar diperas langsung, manis dan menyegarkan.',
            'image' => 'es_jeruk.jpg',
            'rating' => 4.6,
            'reviews_count' => 102,
        ]);

        Menu::create([
            'name' => 'Es Kuwut',
            'price' => 6000,
            'description' => 'Perpaduan sirup, jeruk nipis dan melon serut.',
            'image' => 'https://i.pinimg.com/736x/8a/df/90/8adf901e91d84cc223f4c1bbd6a3a976.jpg',
            'rating' => 4.6,
            'reviews_count' => 102,
        ]);

        Menu::create([
            'name' => 'Mie Goreng',
            'price' => 9000,
            'description' => 'Mie goreng kecap dengan sayur dan telur.',
            'image' => 'mie_goreng.jpg',
            'rating' => 2.9,
            'reviews_count' => 88,
        ]);

        Menu::create([
            'name' => 'Nasi Goreng Seafood Bang Fajar',
            'price' => 23000,
            'description' => 'Nasi goreng dengan udang, cumi, telur, dan sayuran segar.',
            'image' => 'https://id.pinterest.com/pin/415879346858310433/',
            'rating' => 4.7,
            'reviews_count' => 150,
        ]);

        Menu::create([
            'name' => 'Nasi Goreng Kampung Bu Tini',
            'price' => 16000,
            'description' => 'Nasi goreng sederhana dengan telur dadar, teri, dan sambal.',
            'image' => 'https://i.pinimg.com/1200x/d0/e1/f4/d0e1f4aee3717c9dbf794846b057951f.jpg',
            'rating' => 4.8,
            'reviews_count' => 120,
        ]);
    }
}

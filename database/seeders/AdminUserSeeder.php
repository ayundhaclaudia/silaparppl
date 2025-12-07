<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@silapar.test'], // email unik admin
            [
                'name'     => 'Admin SILAPAR',
                'password' => Hash::make('admin123'), // ganti nanti di production
                'role'     => 'admin',
            ]
        );
    }
}

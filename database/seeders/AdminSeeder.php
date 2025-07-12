<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        Admin::updateOrCreate(
            ['email' => 'admin@example.com'], // kondisi pencarian
            [ // data yang diisi/update
                'name' => 'Admin Utama',
                'password' => Hash::make('password'),
            ]
        );
    }
}

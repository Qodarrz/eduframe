<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        // Buat admin default
        User::create([
            'name' => 'Admin Galeri',
            'email' => 'admin@galeri.sch.id',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'email_verified_at' => now(),
        ]);

        // Buat guest user untuk testing
        User::create([
            'name' => 'Guest User',
            'email' => 'guest@galeri.sch.id',
            'password' => Hash::make('guest123'),
            'role' => 'guest',
            'email_verified_at' => now(),
        ]);
    }
}

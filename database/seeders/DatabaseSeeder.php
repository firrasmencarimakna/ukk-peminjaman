<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Admin
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Petugas
        User::create([
            'name' => 'Petugas 1',
            'email' => 'petugas@petugas.com',
            'password' => Hash::make('password'),
            'role' => 'petugas',
        ]);

        // Peminjam
        User::create([
            'name' => 'Siswa Peminjam',
            'email' => 'siswa@siswa.com',
            'password' => Hash::make('password'),
            'role' => 'peminjam',
        ]);
    }
}

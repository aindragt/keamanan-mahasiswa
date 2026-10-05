<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Admin (bcrypt otomatis via Hash::make)
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@pnp.ac.id',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);

        // User biasa
        User::create([
            'name' => 'Mahasiswa User',
            'email' => 'user@pnp.ac.id',
            'password' => Hash::make('user123'),
            'role' => 'user',
        ]);
    }
}

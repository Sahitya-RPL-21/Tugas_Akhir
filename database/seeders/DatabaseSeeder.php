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
        // Create Admin user
        User::create([
            'username' => 'sahityaaadmin',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);

        // Create Kepala user
        User::create([
            'username' => 'sahityaakepala',
            'password' => Hash::make('kepala123'),
            'role' => 'kepala',
        ]);

        // Create regular user
        User::create([
            'username' => 'sahityaauser',
            'password' => Hash::make('user123'),
            'role' => 'user',
        ]);
    }
}
    
<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Membuat user Admin
        User::create([
            'full_name' => 'Administrator',
            'username'  => 'admin',
            'password'  => Hash::make('admin123'), // Ganti 'password' dengan password yang Anda inginkan
            'role'      => 'Admin',
        ]);
    }
}
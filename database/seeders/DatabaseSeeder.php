<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str; // Tambahkan ini untuk memanggil fitur UUID

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'id_user'  => Str::uuid(), // Generate UUID otomatis
            'username' => 'sagara',
            'password' => Hash::make('sagara123'),
            'role'     => 'Admin',
        ]);
    }
}
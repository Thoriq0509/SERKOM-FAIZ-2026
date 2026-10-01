<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        User::create([
            'username' => 'admin',
            'password' => Hash::make('adm123'),
            'role'     => 'Admin',
        ]);

        // Operator
        User::create([
            'username' => 'operator',
            'password' => Hash::make('op123'),
            'role'     => 'Operator',
        ]);
    }
}
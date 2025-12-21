<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Super Admin
        User::create([
            'name' => 'Super Admin Skanic',
            'email' => 'superadmin@skanictech.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'role' => 'super_admin',
            'phone' => '6281234567890',
            'avatar' => null,
            'bio' => 'Super Administrator Skanic Tech Platform. Mengelola seluruh sistem e-katalog dan manajemen admin.',
            'status' => 'active',
        ]);
    }
}

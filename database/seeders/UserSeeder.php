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

        // Admin 1 - Active
        User::create([
            'name' => 'Budi Santoso',
            'email' => 'budi@skanictech.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'role' => 'admin',
            'phone' => '6289876543210',
            'avatar' => null,
            'bio' => 'Full Stack Developer dengan pengalaman 5+ tahun. Spesialisasi di Laravel, Vue.js, dan aplikasi POS.',
            'status' => 'active',
        ]);

        // Admin 2 - Active
        User::create([
            'name' => 'Dewi Anggraini',
            'email' => 'dewi@skanictech.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'role' => 'admin',
            'phone' => '6281122334455',
            'avatar' => null,
            'bio' => 'UI/UX Designer & Frontend Developer. Passionate tentang membuat aplikasi yang user-friendly.',
            'status' => 'active',
        ]);

        // Admin 3 - Active
        User::create([
            'name' => 'Ahmad Rizki',
            'email' => 'rizki@skanictech.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'role' => 'admin',
            'phone' => '6285566778899',
            'avatar' => null,
            'bio' => 'Backend Developer & DevOps Engineer. Expert di sistem cloud dan API integration.',
            'status' => 'active',
        ]);

        // Admin 4 - Pending (untuk testing approval)
        User::create([
            'name' => 'Siti Nurhaliza',
            'email' => 'siti@example.com',
            'email_verified_at' => null,
            'password' => Hash::make('password'),
            'role' => 'admin',
            'phone' => '6287788990011',
            'avatar' => null,
            'bio' => 'Fresh graduate yang tertarik di dunia digital product.',
            'status' => 'pending',
        ]);
    }
}

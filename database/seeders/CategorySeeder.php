<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Aplikasi POS & Kasir',
                'slug' => 'aplikasi-pos-kasir',
                'description' => 'Sistem Point of Sale dan kasir lengkap untuk berbagai jenis usaha retail, restoran, cafe, dan F&B. Dilengkapi manajemen stok, laporan penjualan, dan multi payment.',
                'icon' => '🛒',
                'color' => '#3B82F6',
                'image' => null,
                'order' => 1,
                'is_active' => true,
                'meta_title' => 'Aplikasi POS & Kasir Terbaik | Skanic Tech',
                'meta_description' => 'Temukan berbagai aplikasi POS dan sistem kasir modern untuk bisnis Anda.',
            ],
            [
                'name' => 'E-Commerce & Marketplace',
                'slug' => 'e-commerce-marketplace',
                'description' => 'Platform toko online dan marketplace siap pakai dengan fitur lengkap: payment gateway, shipping integration, multi vendor, dan dashboard analytics.',
                'icon' => '🏪',
                'color' => '#10B981',
                'image' => null,
                'order' => 2,
                'is_active' => true,
                'meta_title' => 'Platform E-Commerce & Marketplace | Skanic Tech',
                'meta_description' => 'Solusi e-commerce dan marketplace untuk memulai bisnis online Anda.',
            ],
            [
                'name' => 'Sistem HRIS & HRM',
                'slug' => 'sistem-hris-hrm',
                'description' => 'Human Resource Information System lengkap untuk mengelola karyawan, absensi, cuti, penggajian, dan performance review dalam satu platform terintegrasi.',
                'icon' => '👥',
                'color' => '#8B5CF6',
                'image' => null,
                'order' => 3,
                'is_active' => true,
                'meta_title' => 'Sistem HRIS & HRM Modern | Skanic Tech',
                'meta_description' => 'Aplikasi HR modern untuk mengelola SDM perusahaan Anda.',
            ],
            [
                'name' => 'Company Profile & Landing Page',
                'slug' => 'company-profile-landing-page',
                'description' => 'Website company profile profesional dan landing page konversi tinggi dengan CMS yang mudah digunakan, responsive design, dan SEO optimized.',
                'icon' => '🌐',
                'color' => '#06B6D4',
                'image' => null,
                'order' => 4,
                'is_active' => true,
                'meta_title' => 'Company Profile & Landing Page Premium | Skanic Tech',
                'meta_description' => 'Template website company profile dan landing page premium.',
            ],
            [
                'name' => 'Sistem Akuntansi & Keuangan',
                'slug' => 'sistem-akuntansi-keuangan',
                'description' => 'Software akuntansi dan pembukuan untuk UKM hingga enterprise. Fitur lengkap: jurnal, buku besar, neraca, laporan laba rugi, dan integrasi bank.',
                'icon' => '💰',
                'color' => '#F59E0B',
                'image' => null,
                'order' => 5,
                'is_active' => true,
                'meta_title' => 'Sistem Akuntansi & Keuangan | Skanic Tech',
                'meta_description' => 'Software akuntansi dan pembukuan untuk bisnis Anda.',
            ],
            [
                'name' => 'Aplikasi Sekolah & Pendidikan',
                'slug' => 'aplikasi-sekolah-pendidikan',
                'description' => 'Sistem informasi sekolah, LMS, dan aplikasi pendidikan lengkap dengan fitur akademik, keuangan, perpustakaan, dan portal orang tua.',
                'icon' => '🎓',
                'color' => '#EC4899',
                'image' => null,
                'order' => 6,
                'is_active' => true,
                'meta_title' => 'Aplikasi Sekolah & Pendidikan | Skanic Tech',
                'meta_description' => 'Sistem informasi sekolah dan aplikasi pendidikan modern.',
            ],
            [
                'name' => 'CRM & Sales Management',
                'slug' => 'crm-sales-management',
                'description' => 'Customer Relationship Management dan sistem penjualan untuk mengelola leads, customer, pipeline sales, dan meningkatkan konversi bisnis Anda.',
                'icon' => '📊',
                'color' => '#EF4444',
                'image' => null,
                'order' => 7,
                'is_active' => true,
                'meta_title' => 'CRM & Sales Management System | Skanic Tech',
                'meta_description' => 'Aplikasi CRM dan manajemen penjualan untuk bisnis Anda.',
            ],
            [
                'name' => 'SaaS & Subscription Platform',
                'slug' => 'saas-subscription-platform',
                'description' => 'Platform SaaS dan sistem berlangganan dengan fitur billing otomatis, multi-tenant, API integration, dan dashboard analytics.',
                'icon' => '☁️',
                'color' => '#6366F1',
                'image' => null,
                'order' => 8,
                'is_active' => true,
                'meta_title' => 'SaaS & Subscription Platform | Skanic Tech',
                'meta_description' => 'Platform SaaS dan sistem subscription untuk bisnis digital.',
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}

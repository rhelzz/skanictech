<?php

namespace Database\Seeders;

use App\Models\HeroSlide;
use Illuminate\Database\Seeder;

class HeroSlideSeeder extends Seeder
{
    public function run(): void
    {
        $slides = [
            [
                'user_id' => 1,
                'title' => 'Temukan Solusi Digital Terbaik untuk Bisnis Anda',
                'description' => 'Jelajahi ratusan produk digital berkualitas - dari aplikasi kasir hingga sistem enterprise. Semua siap pakai dengan dukungan penuh dari developer berpengalaman.',
                'image' => 'hero-slides/hero-slide-1.jpg', // Placeholder - replace with actual image
                'cta_text' => 'Jelajahi Katalog',
                'cta_url' => '/katalog',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'user_id' => 1,
                'title' => 'Promo Spesial Akhir Tahun! Diskon Hingga 40%',
                'description' => 'Dapatkan penawaran terbaik untuk produk-produk unggulan kami. Kesempatan terbatas untuk upgrade bisnis Anda dengan harga spesial.',
                'image' => 'hero-slides/hero-slide-2.jpg', // Placeholder - replace with actual image
                'cta_text' => 'Lihat Promo',
                'cta_url' => '/katalog?sort=popular',
                'order' => 2,
                'is_active' => true,
            ],
            [
                'user_id' => 1,
                'title' => 'Garansi Support & Maintenance 6 Bulan',
                'description' => 'Setiap pembelian produk di Skanic Tech mendapat garansi full support, free bug fix, dan panduan instalasi lengkap dari tim developer kami.',
                'image' => 'hero-slides/hero-slide-3.jpg', // Placeholder - replace with actual image
                'cta_text' => 'Pelajari Lebih Lanjut',
                'cta_url' => '/tentang-kami',
                'order' => 3,
                'is_active' => true,
            ],
        ];

        foreach ($slides as $slide) {
            HeroSlide::create($slide);
        }
    }
}

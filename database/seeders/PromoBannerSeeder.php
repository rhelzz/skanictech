<?php

namespace Database\Seeders;

use App\Models\PromoBanner;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class PromoBannerSeeder extends Seeder
{
    public function run(): void
    {
        $banners = [
            // Top Banners
            [
                'user_id' => 1,
                'title' => '🔥 Flash Sale - Aplikasi POS Diskon 30%! Buruan Pesan Sekarang',
                'url' => '/katalog?categories=1',
                'position' => 'top',
                'order' => 1,
                'is_active' => true,
                'start_date' => Carbon::now()->subDays(5),
                'end_date' => Carbon::now()->addDays(25),
            ],
            [
                'user_id' => 1,
                'title' => '💼 Bundle Deal - Beli 2 Gratis Konsultasi Premium',
                'url' => '/katalog?sort=popular',
                'position' => 'top',
                'order' => 2,
                'is_active' => true,
                'start_date' => Carbon::now()->subDays(3),
                'end_date' => Carbon::now()->addDays(30),
            ],
            // Middle Banners
            [
                'user_id' => 1,
                'title' => 'Gratis Instalasi & Training untuk Pembelian Diatas 5 Juta!',
                'url' => '/katalog?min_price=5000000',
                'position' => 'middle',
                'order' => 1,
                'is_active' => true,
                'start_date' => null,
                'end_date' => null,
            ],
            // Bottom Banners
            [
                'user_id' => 1,
                'title' => '🎁 Gratis Instalasi & Training untuk Pembelian Diatas 5 Juta!',
                'url' => '/katalog?min_price=5000000',
                'position' => 'bottom',
                'order' => 1,
                'is_active' => true,
                'start_date' => null,
                'end_date' => null,
            ],
            [
                'user_id' => 1,
                'title' => '🤝 Gabung Jadi Mitra Developer - Komisi Menarik hingga 40%!',
                'url' => '/daftar',
                'position' => 'bottom',
                'order' => 2,
                'is_active' => true,
                'start_date' => null,
                'end_date' => null,
            ],
        ];

        foreach ($banners as $banner) {
            PromoBanner::create($banner);
        }
    }
}

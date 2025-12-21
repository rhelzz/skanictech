<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            // Site Info
            ['key' => 'site_name', 'value' => 'Skanic', 'group' => 'general'],
            ['key' => 'site_tagline', 'value' => 'E-Katalog Produk Digital Terpercaya', 'group' => 'general'],
            ['key' => 'site_description', 'value' => 'Platform e-katalog untuk menemukan berbagai produk digital berkualitas - aplikasi web, SaaS, sistem enterprise, dan solusi digital lainnya untuk mengembangkan bisnis Anda.', 'group' => 'general'],
            ['key' => 'site_logo', 'value' => null, 'group' => 'general'],
            ['key' => 'site_favicon', 'value' => null, 'group' => 'general'],
            
            // Contact Info
            ['key' => 'contact_email', 'value' => 'hello@skanictech.com', 'group' => 'contact'],
            ['key' => 'contact_phone', 'value' => '+62 812 3456 7890', 'group' => 'contact'],
            ['key' => 'contact_whatsapp', 'value' => '6281234567890', 'group' => 'contact'],
            ['key' => 'contact_address', 'value' => 'Jl. Digital Innovation No. 123, Jakarta Selatan, DKI Jakarta 12345', 'group' => 'contact'],
            
            // Social Media
            ['key' => 'social_facebook', 'value' => 'https://facebook.com/skanictech', 'group' => 'social'],
            ['key' => 'social_instagram', 'value' => 'https://instagram.com/skanictech', 'group' => 'social'],
            ['key' => 'social_twitter', 'value' => 'https://twitter.com/skanictech', 'group' => 'social'],
            ['key' => 'social_linkedin', 'value' => 'https://linkedin.com/company/skanictech', 'group' => 'social'],
            ['key' => 'social_youtube', 'value' => 'https://youtube.com/@skanictech', 'group' => 'social'],
            ['key' => 'social_github', 'value' => 'https://github.com/skanictech', 'group' => 'social'],
            
            // SEO
            ['key' => 'seo_meta_title', 'value' => 'Skanic Tech - E-Katalog Produk Digital Terpercaya', 'group' => 'seo'],
            ['key' => 'seo_meta_description', 'value' => 'Temukan berbagai produk digital berkualitas untuk bisnis Anda. Aplikasi POS, e-commerce, HRIS, dan solusi digital lainnya.', 'group' => 'seo'],
            ['key' => 'seo_meta_keywords', 'value' => 'aplikasi kasir, pos, e-commerce, hris, software bisnis, aplikasi web, saas, skanic tech', 'group' => 'seo'],
            ['key' => 'seo_google_analytics', 'value' => null, 'group' => 'seo'],
            
            // Business
            ['key' => 'business_hours', 'value' => 'Senin - Jumat: 09:00 - 18:00 WIB', 'group' => 'business'],
            ['key' => 'business_currency', 'value' => 'IDR', 'group' => 'business'],
            ['key' => 'business_tax_rate', 'value' => '11', 'group' => 'business'],
        ];

        foreach ($settings as $setting) {
            Setting::create($setting);
        }
    }
}

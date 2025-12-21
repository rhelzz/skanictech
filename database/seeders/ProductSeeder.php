<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            // POS Products by Budi (user_id: 2)
            [
                'user_id' => 2,
                'category_id' => 1,
                'name' => 'POSmart Pro - Aplikasi Kasir Multi-Outlet',
                'slug' => 'posmart-pro-aplikasi-kasir-multi-outlet',
                'short_description' => 'Aplikasi kasir profesional dengan fitur multi-outlet, inventory realtime, dan laporan penjualan komprehensif. Cocok untuk retail, minimarket, dan toko grosir.',
                'description' => '<div class="product-description">
<h2>POSmart Pro - Solusi Kasir Modern untuk Bisnis Retail</h2>
<p>POSmart Pro adalah aplikasi Point of Sale (POS) terlengkap yang dirancang khusus untuk memudahkan operasional bisnis retail Anda. Dengan teknologi modern dan interface yang intuitif, POSmart Pro membantu Anda mengelola penjualan, stok, dan laporan keuangan dalam satu platform terintegrasi.</p>

<h3>🎯 Mengapa POSmart Pro?</h3>
<ul>
<li><strong>Multi-Outlet Management</strong> - Kelola banyak cabang dari satu dashboard</li>
<li><strong>Real-time Sync</strong> - Data tersinkronisasi otomatis antar outlet</li>
<li><strong>Offline Mode</strong> - Tetap berjalan saat internet mati</li>
<li><strong>Cloud Backup</strong> - Data aman tersimpan di cloud</li>
</ul>

<h3>📦 Apa yang Anda Dapatkan?</h3>
<ul>
<li>Source code lengkap (Laravel + Vue.js)</li>
<li>Dokumentasi instalasi & penggunaan</li>
<li>Free support 6 bulan</li>
<li>Free update minor version</li>
<li>Video tutorial setup</li>
</ul>

<h3>💻 Tech Stack</h3>
<p>Laravel 11, Vue.js 3, Tailwind CSS, MySQL, Redis</p>
</div>',
                'features' => [
                    'Multi Outlet & Cabang Management',
                    'Inventory Management dengan Stock Opname',
                    'Laporan Penjualan Real-time',
                    'Multi Payment Method (Cash, Card, E-wallet)',
                    'Program Loyalitas & Membership',
                    'Barcode Scanner Support',
                    'Print Struk Thermal & A4',
                    'Export Excel & PDF',
                    'Role & Permission Management',
                    'Cloud Backup Otomatis'
                ],
                'price' => 2500000,
                'price_type' => 'one_time',
                'demo_url' => 'https://demo.posmart.id',
                'demo_username' => 'demo@posmart.id',
                'demo_password' => 'demo123',
                'owner_name' => 'Budi Santoso',
                'owner_whatsapp' => '6289876543210',
                'main_image' => 'https://via.placeholder.com/800x600/1e40af/ffffff?text=POSmart+Pro',
                'gallery_images' => ['https://via.placeholder.com/800x600'],
                'is_featured' => true,
                'status' => 'published',
                'views_count' => 1250,
                'demo_clicks' => 340,
                'whatsapp_clicks' => 89,
                'meta_title' => 'POSmart Pro - Aplikasi Kasir Multi-Outlet Terbaik',
                'meta_description' => 'Aplikasi kasir profesional untuk retail dengan fitur multi-outlet, inventory, dan laporan lengkap.',
            ],
            [
                'user_id' => 2,
                'category_id' => 1,
                'name' => 'RestoPOS - Sistem Kasir Restoran & Cafe',
                'slug' => 'restopos-sistem-kasir-restoran-cafe',
                'short_description' => 'Sistem kasir khusus untuk bisnis F&B dengan Kitchen Display System, table management, split bill, dan integrasi delivery online.',
                'description' => '<div class="product-description">
<h2>RestoPOS - Solusi Kasir Lengkap untuk Bisnis F&B</h2>
<p>RestoPOS adalah sistem POS yang dirancang khusus untuk restoran, cafe, dan bisnis kuliner. Dilengkapi dengan Kitchen Display System (KDS) yang memudahkan komunikasi antara kasir dan dapur.</p>

<h3>🍽️ Fitur Khusus F&B</h3>
<ul>
<li><strong>Table Management</strong> - Visual layout meja restoran</li>
<li><strong>Kitchen Display</strong> - Order langsung ke dapur</li>
<li><strong>Split Bill</strong> - Bagi tagihan per item atau rata</li>
<li><strong>QR Menu</strong> - Menu digital untuk self-order</li>
</ul>

<h3>📱 Integrasi Delivery</h3>
<p>Terintegrasi dengan GoFood, GrabFood, dan ShopeeFood untuk menerima order delivery langsung ke sistem.</p>
</div>',
                'features' => [
                    'Kitchen Display System (KDS)',
                    'Table Management Visual',
                    'Split Bill & Merge Bill',
                    'QR Code Digital Menu',
                    'Integrasi GoFood & GrabFood',
                    'Reservasi Online',
                    'Happy Hour & Promo Management',
                    'Ingredient Tracking',
                    'Multi-printer Support',
                    'Dashboard Analytics'
                ],
                'price' => 3500000,
                'price_type' => 'one_time',
                'demo_url' => 'https://demo.restopos.id',
                'demo_username' => 'demo@restopos.id',
                'demo_password' => 'demo123',
                'owner_name' => 'Budi Santoso',
                'owner_whatsapp' => '6289876543210',
                'main_image' => 'https://via.placeholder.com/800x600/2563eb/ffffff?text=RestoPOS',
                'gallery_images' => ['https://via.placeholder.com/800x600'],
                'is_featured' => true,
                'status' => 'published',
                'views_count' => 980,
                'demo_clicks' => 220,
                'whatsapp_clicks' => 67,
                'meta_title' => 'RestoPOS - Sistem Kasir Restoran & Cafe',
                'meta_description' => 'Sistem POS khusus F&B dengan Kitchen Display dan integrasi delivery.',
            ],
            // E-Commerce by Dewi (user_id: 3)
            [
                'user_id' => 3,
                'category_id' => 2,
                'name' => 'TokoKu - Platform E-Commerce Multi Vendor',
                'slug' => 'tokoku-platform-e-commerce-multi-vendor',
                'short_description' => 'Platform e-commerce lengkap dengan fitur multi-vendor/marketplace, payment gateway terintegrasi, dan shipping API otomatis.',
                'description' => '<div class="product-description">
<h2>TokoKu - Bangun Marketplace Anda Sendiri</h2>
<p>TokoKu adalah platform e-commerce multi-vendor yang memungkinkan Anda membangun marketplace seperti Tokopedia atau Shopee dengan brand Anda sendiri.</p>

<h3>🛍️ Fitur Marketplace</h3>
<ul>
<li><strong>Multi Vendor</strong> - Undang seller untuk berjualan</li>
<li><strong>Commission System</strong> - Atur komisi per kategori</li>
<li><strong>Seller Dashboard</strong> - Dashboard lengkap untuk seller</li>
<li><strong>Product Review</strong> - Sistem rating dan review</li>
</ul>

<h3>💳 Payment Gateway</h3>
<p>Terintegrasi dengan Midtrans, Xendit, dan DOKU untuk berbagai metode pembayaran.</p>

<h3>🚚 Shipping Integration</h3>
<p>API RajaOngkir untuk cek ongkir realtime dari JNE, J&T, SiCepat, dan kurir lainnya.</p>
</div>',
                'features' => [
                    'Multi Vendor Marketplace',
                    'Product Variants & Attributes',
                    'Payment Gateway (Midtrans, Xendit)',
                    'Shipping API (RajaOngkir)',
                    'Voucher & Coupon System',
                    'Flash Sale & Campaign',
                    'Affiliate Program',
                    'Chat System Built-in',
                    'Mobile Responsive',
                    'SEO Optimized'
                ],
                'price' => 7500000,
                'price_type' => 'one_time',
                'demo_url' => 'https://demo.tokoku.id',
                'demo_username' => 'demo@tokoku.id',
                'demo_password' => 'demo123',
                'owner_name' => 'Dewi Anggraini',
                'owner_whatsapp' => '6281122334455',
                'main_image' => 'https://via.placeholder.com/800x600/3b82f6/ffffff?text=TokoKu',
                'gallery_images' => ['https://via.placeholder.com/800x600'],
                'is_featured' => true,
                'status' => 'published',
                'views_count' => 2100,
                'demo_clicks' => 580,
                'whatsapp_clicks' => 156,
                'meta_title' => 'TokoKu - Platform E-Commerce Multi Vendor',
                'meta_description' => 'Bangun marketplace Anda sendiri dengan TokoKu - platform e-commerce multi vendor lengkap.',
            ],
            // HRIS by Rizki (user_id: 4)
            [
                'user_id' => 4,
                'category_id' => 3,
                'name' => 'HRMax - Sistem HRIS & Payroll Terintegrasi',
                'slug' => 'hrmax-sistem-hris-payroll-terintegrasi',
                'short_description' => 'Sistem HRIS lengkap untuk mengelola karyawan, absensi dengan GPS, cuti online, penggajian otomatis, dan ESS portal.',
                'description' => '<div class="product-description">
<h2>HRMax - Human Resource Information System Modern</h2>
<p>HRMax adalah solusi HRIS komprehensif yang membantu perusahaan mengelola seluruh aspek sumber daya manusia dari rekrutmen hingga pensiun.</p>

<h3>👥 Modul Lengkap</h3>
<ul>
<li><strong>Employee Database</strong> - Data karyawan terpusat</li>
<li><strong>Attendance</strong> - Absensi GPS & Face Recognition</li>
<li><strong>Leave Management</strong> - Pengajuan cuti online</li>
<li><strong>Payroll</strong> - Penggajian otomatis dengan PPh 21</li>
<li><strong>Performance</strong> - KPI dan review berkala</li>
</ul>

<h3>📱 Employee Self Service</h3>
<p>Portal karyawan untuk melihat slip gaji, mengajukan cuti, dan update data pribadi.</p>
</div>',
                'features' => [
                    'Employee Database Management',
                    'Attendance GPS & Face Recognition',
                    'Leave & Permission Management',
                    'Payroll dengan PPh 21 Otomatis',
                    'BPJS Calculator',
                    'Performance & KPI Tracking',
                    'Employee Self Service Portal',
                    'Organization Chart',
                    'Training Management',
                    'Exit Interview & Offboarding'
                ],
                'price' => 5000000,
                'price_type' => 'one_time',
                'demo_url' => 'https://demo.hrmax.id',
                'demo_username' => 'hr@demo.com',
                'demo_password' => 'demo123',
                'owner_name' => 'Ahmad Rizki',
                'owner_whatsapp' => '6285566778899',                'main_image' => 'https://via.placeholder.com/800x600/6366f1/ffffff?text=LMS',                'gallery_images' => ['https://via.placeholder.com/800x600'],
                'is_featured' => true,
                'status' => 'published',
                'views_count' => 1450,
                'demo_clicks' => 390,
                'whatsapp_clicks' => 98,
                'meta_title' => 'HRMax - Sistem HRIS & Payroll Modern',
                'meta_description' => 'Sistem HRIS lengkap dengan payroll, absensi GPS, dan employee self service.',
            ],
            // Company Profile by Dewi (user_id: 3)
            [
                'user_id' => 3,
                'category_id' => 4,
                'name' => 'BizPro - Company Profile Premium',
                'slug' => 'bizpro-company-profile-premium',
                'short_description' => 'Template company profile profesional dengan CMS yang mudah, multi-language support, blog system, dan SEO optimized.',
                'description' => '<div class="product-description">
<h2>BizPro - Company Profile untuk Bisnis Profesional</h2>
<p>BizPro adalah template company profile premium yang dirancang untuk memberikan kesan profesional dan terpercaya kepada klien potensial Anda.</p>

<h3>✨ Desain Premium</h3>
<ul>
<li><strong>Modern & Clean</strong> - Desain minimalis profesional</li>
<li><strong>Fully Responsive</strong> - Optimal di semua device</li>
<li><strong>Animasi Smooth</strong> - Transisi yang elegan</li>
<li><strong>Dark Mode</strong> - Support mode gelap</li>
</ul>

<h3>🔧 Mudah Dikustomisasi</h3>
<p>CMS yang user-friendly memungkinkan Anda mengupdate konten tanpa perlu coding.</p>
</div>',
                'features' => [
                    'Modern & Responsive Design',
                    'Easy-to-use CMS',
                    'Multi-language Support',
                    'Blog & News System',
                    'Portfolio Gallery',
                    'Team Members Section',
                    'Testimonial Slider',
                    'Contact Form with Email',
                    'Google Maps Integration',
                    'SEO Optimized'
                ],
                'price' => 1500000,
                'price_type' => 'one_time',
                'demo_url' => 'https://demo.bizpro.id',
                'demo_username' => 'admin@demo.com',
                'demo_password' => 'demo123',
                'owner_name' => 'Dewi Anggraini',
                'owner_whatsapp' => '6281122334455',
                'main_image' => 'https://via.placeholder.com/800x600/06b6d4/ffffff?text=MarketKita',
                'gallery_images' => ['https://via.placeholder.com/800x600'],
                'is_featured' => false,
                'status' => 'published',
                'views_count' => 890,
                'demo_clicks' => 210,
                'whatsapp_clicks' => 45,
                'meta_title' => 'BizPro - Company Profile Premium',
                'meta_description' => 'Template company profile profesional dengan CMS mudah digunakan.',
            ],
            // Accounting by Rizki (user_id: 4)
            [
                'user_id' => 4,
                'category_id' => 5,
                'name' => 'AkunPro - Software Akuntansi UKM',
                'slug' => 'akunpro-software-akuntansi-ukm',
                'short_description' => 'Software akuntansi sederhana untuk UKM dengan fitur jurnal, buku besar, neraca, laba rugi, dan laporan keuangan lengkap.',
                'description' => '<div class="product-description">
<h2>AkunPro - Pembukuan Mudah untuk UKM</h2>
<p>AkunPro adalah software akuntansi yang dirancang khusus untuk kebutuhan UKM Indonesia. Interface yang sederhana namun fitur yang powerful.</p>

<h3>📊 Fitur Akuntansi</h3>
<ul>
<li><strong>Jurnal Umum</strong> - Pencatatan transaksi</li>
<li><strong>Buku Besar</strong> - Rekap per akun</li>
<li><strong>Neraca</strong> - Laporan posisi keuangan</li>
<li><strong>Laba Rugi</strong> - Laporan pendapatan</li>
</ul>

<h3>🏦 Integrasi Bank</h3>
<p>Rekonsiliasi otomatis dengan mutasi bank BCA, Mandiri, BNI, dan BRI.</p>
</div>',
                'features' => [
                    'Jurnal Umum & Penyesuaian',
                    'Buku Besar & Subsidiary',
                    'Neraca & Laba Rugi',
                    'Arus Kas & Perubahan Modal',
                    'Invoice & Faktur Pajak',
                    'Rekonsiliasi Bank',
                    'Multi Currency',
                    'Budget & Forecasting',
                    'Audit Trail',
                    'Export ke Excel & PDF'
                ],
                'price' => 3000000,
                'price_type' => 'one_time',
                'demo_url' => 'https://demo.akunpro.id',
                'demo_username' => 'demo@akunpro.id',
                'demo_password' => 'demo123',
                'owner_name' => 'Ahmad Rizki',
                'owner_whatsapp' => '6285566778899',
                'main_image' => 'https://via.placeholder.com/800x600/ef4444/ffffff?text=Accounting',
                'gallery_images' => ['https://via.placeholder.com/800x600'],
                'is_featured' => false,
                'status' => 'published',
                'views_count' => 720,
                'demo_clicks' => 180,
                'whatsapp_clicks' => 52,
                'meta_title' => 'AkunPro - Software Akuntansi UKM',
                'meta_description' => 'Software akuntansi sederhana dan lengkap untuk UKM Indonesia.',
            ],
            // School by Budi (user_id: 2)
            [
                'user_id' => 2,
                'category_id' => 6,
                'name' => 'EduSchool - Sistem Informasi Sekolah',
                'slug' => 'eduschool-sistem-informasi-sekolah',
                'short_description' => 'Sistem informasi sekolah lengkap dengan modul akademik, keuangan, perpustakaan, dan portal orang tua terintegrasi.',
                'description' => '<div class="product-description">
<h2>EduSchool - Solusi Digital untuk Sekolah Modern</h2>
<p>EduSchool adalah sistem informasi sekolah terpadu yang membantu mengelola seluruh kegiatan akademik dan administrasi sekolah.</p>

<h3>📚 Modul Lengkap</h3>
<ul>
<li><strong>Akademik</strong> - Kurikulum, jadwal, nilai</li>
<li><strong>Keuangan</strong> - SPP, pembayaran online</li>
<li><strong>Perpustakaan</strong> - Katalog dan peminjaman</li>
<li><strong>Portal Ortu</strong> - Monitoring anak</li>
</ul>

<h3>📱 Mobile App</h3>
<p>Tersedia aplikasi mobile untuk siswa dan orang tua (Android & iOS).</p>
</div>',
                'features' => [
                    'Manajemen Kurikulum & Silabus',
                    'E-Learning & Assignment',
                    'Penjadwalan Otomatis',
                    'E-Raport & Nilai Online',
                    'Pembayaran SPP Online',
                    'Perpustakaan Digital',
                    'Portal Orang Tua',
                    'Attendance QR Code',
                    'Announcement & News',
                    'Mobile App (Android/iOS)'
                ],
                'price' => 4500000,
                'price_type' => 'one_time',
                'demo_url' => 'https://demo.eduschool.id',
                'demo_username' => 'admin@demo.com',
                'demo_password' => 'demo123',
                'owner_name' => 'Budi Santoso',
                'owner_whatsapp' => '6289876543210',                'main_image' => 'https://via.placeholder.com/800x600/14b8a6/ffffff?text=Laundry',                'main_image' => 'https://via.placeholder.com/800x600/10b981/ffffff?text=School',
                'gallery_images' => ['https://via.placeholder.com/800x600'],
                'is_featured' => true,
                'status' => 'published',
                'views_count' => 1100,
                'demo_clicks' => 290,
                'whatsapp_clicks' => 78,
                'meta_title' => 'EduSchool - Sistem Informasi Sekolah',
                'meta_description' => 'Sistem informasi sekolah lengkap dengan portal orang tua dan e-learning.',
            ],
            // CRM by Dewi (user_id: 3)
            [
                'user_id' => 3,
                'category_id' => 7,
                'name' => 'SalesPro CRM - Customer Management System',
                'slug' => 'salespro-crm-customer-management-system',
                'short_description' => 'Sistem CRM untuk mengelola leads, customer, pipeline penjualan, dan meningkatkan konversi dengan analytics yang powerful.',
                'description' => '<div class="product-description">
<h2>SalesPro CRM - Tingkatkan Penjualan Anda</h2>
<p>SalesPro CRM membantu tim sales Anda mengelola prospek dan pelanggan dengan lebih efektif melalui pipeline yang terorganisir.</p>

<h3>📈 Sales Pipeline</h3>
<ul>
<li><strong>Lead Management</strong> - Capture dan scoring leads</li>
<li><strong>Deal Tracking</strong> - Pantau progress deal</li>
<li><strong>Activity Log</strong> - Riwayat interaksi</li>
<li><strong>Forecast</strong> - Prediksi penjualan</li>
</ul>

<h3>📊 Analytics</h3>
<p>Dashboard analitik untuk mengukur performa tim dan mengidentifikasi peluang.</p>
</div>',
                'features' => [
                    'Lead Capture & Scoring',
                    'Contact Management',
                    'Deal Pipeline Kanban',
                    'Activity Tracking',
                    'Email Integration',
                    'Calendar & Tasks',
                    'Quote & Proposal',
                    'Sales Forecast',
                    'Team Performance',
                    'API Integration'
                ],
                'price' => 150000,
                'price_type' => 'monthly',
                'demo_url' => 'https://demo.salespro.id',
                'demo_username' => 'demo@salespro.id',
                'demo_password' => 'demo123',
                'owner_name' => 'Dewi Anggraini',
                'owner_whatsapp' => '6281122334455',
                'main_image' => 'https://via.placeholder.com/800x600/ec4899/ffffff?text=EventKu',
                'gallery_images' => ['https://via.placeholder.com/800x600'],
                'is_featured' => false,
                'status' => 'published',
                'views_count' => 650,
                'demo_clicks' => 150,
                'whatsapp_clicks' => 38,
                'meta_title' => 'SalesPro CRM - Customer Management System',
                'meta_description' => 'Sistem CRM untuk mengelola leads dan meningkatkan penjualan.',
            ],
            // SaaS by Rizki (user_id: 4)
            [
                'user_id' => 4,
                'category_id' => 8,
                'name' => 'LaunchKit - SaaS Boilerplate Laravel',
                'slug' => 'launchkit-saas-boilerplate-laravel',
                'short_description' => 'Boilerplate Laravel untuk membangun aplikasi SaaS dengan cepat. Multi-tenant, subscription billing, dan API ready.',
                'description' => '<div class="product-description">
<h2>LaunchKit - Start Your SaaS Faster</h2>
<p>LaunchKit adalah boilerplate Laravel yang sudah dilengkapi semua fitur yang dibutuhkan untuk membangun aplikasi SaaS modern.</p>

<h3>🚀 Fitur Siap Pakai</h3>
<ul>
<li><strong>Multi-tenant</strong> - Isolasi data per tenant</li>
<li><strong>Subscription</strong> - Billing dengan Stripe/Midtrans</li>
<li><strong>API</strong> - RESTful API dengan Sanctum</li>
<li><strong>Admin Panel</strong> - Dashboard admin lengkap</li>
</ul>

<h3>⚡ Tech Stack Modern</h3>
<p>Laravel 11, Livewire 3, Tailwind CSS, Alpine.js</p>
</div>',
                'features' => [
                    'Multi-tenant Architecture',
                    'Subscription Billing',
                    'Stripe & Midtrans Integration',
                    'User Authentication & Roles',
                    'Team Management',
                    'API with Rate Limiting',
                    'Webhook Handler',
                    'Admin Dashboard',
                    'Email Notifications',
                    'Comprehensive Documentation'
                ],
                'price' => 2000000,
                'price_type' => 'one_time',
                'demo_url' => 'https://demo.launchkit.dev',
                'demo_username' => 'demo@launchkit.dev',
                'demo_password' => 'demo123',
                'owner_name' => 'Ahmad Rizki',
                'owner_whatsapp' => '6285566778899',
                'gallery_images' => ['https://via.placeholder.com/800x600'],
                'is_featured' => true,
                'status' => 'published',
                'views_count' => 1800,
                'demo_clicks' => 520,
                'whatsapp_clicks' => 134,
                'meta_title' => 'LaunchKit - SaaS Boilerplate Laravel',
                'meta_description' => 'Boilerplate Laravel untuk membangun SaaS dengan cepat dan mudah.',
            ],
            // Draft product
            [
                'user_id' => 2,
                'category_id' => 1,
                'name' => 'LaundryPOS - Coming Soon',
                'slug' => 'laundrypos-coming-soon',
                'short_description' => 'Sistem kasir khusus untuk usaha laundry dengan tracking order, notifikasi WhatsApp, dan laporan harian.',
                'description' => '<p>Akan segera hadir sistem kasir lengkap untuk usaha laundry kiloan dan satuan.</p>',
                'features' => [
                    'Order Tracking',
                    'WhatsApp Notification',
                    'Pricing per KG/Item',
                    'Daily Report'
                ],
                'price' => 1500000,
                'price_type' => 'one_time',
                'demo_url' => null,
                'demo_username' => null,
                'demo_password' => null,
                'owner_name' => 'Budi Santoso',
                'owner_whatsapp' => '6289876543210',
                'main_image' => 'https://via.placeholder.com/800x600/14b8a6/ffffff?text=Laundry',
                'gallery_images' => ['https://via.placeholder.com/800x600'],
                'is_featured' => false,
                'status' => 'draft',
                'views_count' => 0,
                'demo_clicks' => 0,
                'whatsapp_clicks' => 0,
                'meta_title' => null,
                'meta_description' => null,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}

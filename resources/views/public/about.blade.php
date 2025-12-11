@extends('layouts.public')

@section('title', 'Tentang Kami - Skanic Tech')
@section('meta_description', 'Kenali lebih dekat Skanic Tech - Platform e-katalog produk digital terpercaya untuk solusi bisnis Anda.')

@section('content')
<div class="bg-gradient-corporate py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">Tentang Kami</h1>
        <p class="text-xl text-white/80 max-w-2xl mx-auto">Platform e-katalog produk digital terpercaya</p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <!-- About Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center mb-20">
        <div>
            <h2 class="text-3xl font-bold text-slate-800 mb-6">Apa itu Skanic Tech?</h2>
            <div class="space-y-4 text-slate-600">
                <p>
                    <strong class="text-slate-800">Skanic Tech</strong> adalah platform e-katalog yang dirancang khusus untuk menampilkan dan mempromosikan produk-produk digital berkualitas tinggi seperti aplikasi web, SaaS, sistem ERP, dan berbagai solusi digital lainnya.
                </p>
                <p>
                    Platform ini didirikan oleh sekelompok developer dan entrepreneur yang percaya bahwa produk digital berkualitas harus dapat diakses dengan mudah oleh semua kalangan bisnis, dari UMKM hingga perusahaan besar.
                </p>
                <p>
                    Kami menyediakan wadah bagi para pengembang dan pemilik produk digital untuk memamerkan karya mereka, sekaligus membantu calon pengguna menemukan solusi yang tepat untuk kebutuhan bisnis mereka.
                </p>
            </div>
        </div>
        <div class="relative">
            <div class="aspect-square bg-gradient-to-br from-blue-500 to-blue-700 rounded-2xl flex items-center justify-center">
                <div class="text-center text-white p-8">
                    <div class="w-24 h-24 bg-white/20 rounded-2xl flex items-center justify-center mx-auto mb-6">
                        <span class="text-5xl font-bold">S</span>
                    </div>
                    <h3 class="text-3xl font-bold">Skanic Tech</h3>
                    <p class="text-white/80 mt-2">Digital Solutions Marketplace</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Mission & Vision -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-20">
        <div class="bg-blue-600 text-white rounded-2xl p-8">
            <div class="w-14 h-14 bg-white/20 rounded-xl flex items-center justify-center mb-6">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                </svg>
            </div>
            <h3 class="text-2xl font-bold mb-4">Misi Kami</h3>
            <p class="text-white/90">
                Menghubungkan pengembang produk digital dengan pengguna yang membutuhkan solusi tepat untuk bisnis mereka. Kami berkomitmen untuk menyediakan platform yang mudah digunakan, transparan, dan terpercaya.
            </p>
        </div>
        <div class="bg-slate-800 text-white rounded-2xl p-8">
            <div class="w-14 h-14 bg-white/20 rounded-xl flex items-center justify-center mb-6">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                </svg>
            </div>
            <h3 class="text-2xl font-bold mb-4">Visi Kami</h3>
            <p class="text-white/90">
                Menjadi platform e-katalog produk digital nomor satu di Indonesia yang menjadi rujukan utama bagi siapa saja yang mencari solusi digital berkualitas untuk mengembangkan bisnis mereka.
            </p>
        </div>
    </div>

    <!-- Why Choose Us -->
    <div class="text-center mb-12">
        <h2 class="text-3xl font-bold text-slate-800 mb-4">Mengapa Skanic Tech?</h2>
        <p class="text-slate-600 max-w-2xl mx-auto">Berikut adalah alasan mengapa Anda harus memilih platform kami</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-20">
        <div class="text-center p-6">
            <div class="w-16 h-16 bg-blue-100 text-blue-600 rounded-2xl flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <h3 class="text-xl font-bold text-slate-800 mb-2">Produk Terverifikasi</h3>
            <p class="text-slate-600">Setiap produk yang ditampilkan telah melalui proses kurasi untuk memastikan kualitasnya.</p>
        </div>
        <div class="text-center p-6">
            <div class="w-16 h-16 bg-green-100 text-green-600 rounded-2xl flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z"/>
                </svg>
            </div>
            <h3 class="text-xl font-bold text-slate-800 mb-2">Kontak Langsung</h3>
            <p class="text-slate-600">Hubungi langsung pemilik produk via WhatsApp untuk diskusi dan negosiasi.</p>
        </div>
        <div class="text-center p-6">
            <div class="w-16 h-16 bg-purple-100 text-purple-600 rounded-2xl flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 15l-2 5L9 9l11 4-5 2zm0 0l5 5M7.188 2.239l.777 2.897M5.136 7.965l-2.898-.777M13.95 4.05l-2.122 2.122m-5.657 5.656l-2.12 2.122"/>
                </svg>
            </div>
            <h3 class="text-xl font-bold text-slate-800 mb-2">Live Demo</h3>
            <p class="text-slate-600">Coba langsung produk dengan akses demo sebelum memutuskan untuk membeli.</p>
        </div>
    </div>

    <!-- CTA -->
    <div class="bg-slate-100 rounded-2xl p-8 md:p-12 text-center">
        <h2 class="text-2xl md:text-3xl font-bold text-slate-800 mb-4">Tertarik Menjadi Mitra?</h2>
        <p class="text-slate-600 mb-8 max-w-2xl mx-auto">
            Jika Anda memiliki produk digital berkualitas dan ingin menjangkau lebih banyak pengguna, daftarkan diri Anda sebagai Admin dan mulai tampilkan produk Anda di platform kami.
        </p>
        <a href="{{ route('register') }}" class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-8 rounded-lg transition-all duration-200 shadow-lg hover:shadow-xl">
            Daftar Sekarang
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
            </svg>
        </a>
    </div>
</div>
@endsection

@extends('layouts.public')

@section('title', 'Skanic Tech - E-Katalog Produk Digital Terpercaya')
@section('meta_description', 'Temukan berbagai produk digital berkualitas untuk bisnis Anda. Aplikasi POS, e-commerce, HRIS, dan solusi digital lainnya.')

@section('content')
    {{-- HERO SECTION WITH SLIDER --}}
    <section class="relative min-h-[650px] bg-gradient-to-br from-slate-900 via-blue-900 to-slate-900 overflow-hidden">
        {{-- Animated Background --}}
        <div class="absolute inset-0">
            <div class="absolute top-20 left-10 w-72 h-72 bg-blue-500/20 rounded-full blur-3xl animate-pulse"></div>
            <div class="absolute bottom-20 right-10 w-96 h-96 bg-cyan-500/20 rounded-full blur-3xl animate-pulse" style="animation-delay: 1s"></div>
            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-blue-600/10 rounded-full blur-3xl"></div>
        </div>
        
        {{-- Grid Pattern --}}
        <div class="absolute inset-0 opacity-20" style="background-image: radial-gradient(circle at 1px 1px, rgba(255,255,255,0.15) 1px, transparent 0); background-size: 40px 40px;"></div>

        @if($heroSlides->count() > 0)
        <div class="swiper hero-swiper h-full">
            <div class="swiper-wrapper">
                @foreach($heroSlides as $slide)
                <div class="swiper-slide">
                    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 lg:py-32">
                        <div class="grid lg:grid-cols-2 gap-12 items-center">
                            {{-- Content --}}
                            <div class="text-center lg:text-left relative z-10">
                                <div class="inline-flex items-center gap-2 bg-blue-500/20 backdrop-blur-sm border border-blue-400/30 rounded-full px-4 py-2 mb-6">
                                    <span class="relative flex h-2 w-2">
                                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                                        <span class="relative inline-flex rounded-full h-2 w-2 bg-green-500"></span>
                                    </span>
                                    <span class="text-blue-200 text-sm font-medium">Platform Katalog Lokal Digital Indonesia</span>
                                </div>
                                
                                <h1 class="text-3xl font-bold text-white mb-6 leading-tight">
                                    {{ $slide->title }}
                                </h1>
                                
                                <p class="text-lg md:text-l text-slate-300 mb-8 leading-relaxed">
                                    {{ $slide->description }}
                                </p>
                                
                                @if($slide->cta_text && $slide->cta_url)
                                <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                                    <a href="{{ $slide->cta_url }}" class="group inline-flex items-center justify-center gap-2 bg-gradient-to-r from-blue-600 to-cyan-600 hover:from-blue-700 hover:to-cyan-700 text-white font-semibold py-4 px-8 rounded-xl transition-all duration-300 shadow-lg shadow-blue-500/25 hover:shadow-xl hover:shadow-blue-500/30 hover:-translate-y-0.5">
                                        {{ $slide->cta_text }}
                                        <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                        </svg>
                                    </a>
                                    <a href="{{ route('about') }}" class="inline-flex items-center justify-center gap-2 bg-white/10 backdrop-blur-sm hover:bg-white/20 text-white font-semibold py-4 px-8 rounded-xl border border-white/20 transition-all duration-300">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        Tentang Kami
                                    </a>
                                </div>
                                @endif
                            </div>
                            
                            {{-- Visual --}}
                            <div class="hidden lg:block relative">
                                @if($slide->image && Storage::disk('public')->exists($slide->image))
                                <div class="aspect-square">
                                    <img src="{{ Storage::url($slide->image) }}" alt="{{ $slide->title }}" class="w-full h-full object-cover rounded-2xl shadow-2xl">
                                </div>
                                @else
                                {{-- Default Visual with Floating Cards --}}
                                <div class="relative">
                                    <div class="absolute -top-4 -left-4 bg-white/10 backdrop-blur-lg rounded-2xl p-4 border border-white/20 shadow-xl animate-bounce z-10" style="animation-duration: 3s">
                                        <div class="flex items-center gap-3">
                                            <div class="w-10 h-10 bg-green-500 rounded-lg flex items-center justify-center">
                                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                </svg>
                                            </div>
                                            <div>
                                                <div class="text-white font-semibold text-sm">Transaksi Berhasil</div>
                                                <div class="text-slate-400 text-xs">+Rp 2.500.000</div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="aspect-square bg-gradient-to-br from-blue-500/30 to-purple-500/30 backdrop-blur-sm rounded-3xl border border-white/20 p-8 flex items-center justify-center">
                                        <div class="text-center">
                                            <div class="w-32 h-32 bg-white/20 rounded-3xl flex items-center justify-center mx-auto mb-6">
                                                <span class="text-6xl font-bold text-white">S</span>
                                            </div>
                                            <p class="text-white/80 text-lg">Skanic Tech</p>
                                        </div>
                                    </div>
                                    
                                    <div class="absolute -bottom-4 -right-4 bg-white/10 backdrop-blur-lg rounded-2xl p-4 border border-white/20 shadow-xl animate-bounce z-10" style="animation-duration: 4s; animation-delay: 0.5s">
                                        <div class="flex items-center gap-3">
                                            <div class="w-10 h-10 bg-blue-500 rounded-lg flex items-center justify-center">
                                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                                                </svg>
                                            </div>
                                            <div>
                                                <div class="text-white font-semibold text-sm">Developer Aktif</div>
                                                <div class="text-slate-400 text-xs">50+ Partner</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            
            {{-- Pagination --}}
            <div class="swiper-pagination !bottom-10"></div>
            
            {{-- Navigation --}}
            <div class="swiper-button-prev !text-white !w-12 !h-12 !bg-white/10 !backdrop-blur-sm !rounded-full after:!text-lg"></div>
            <div class="swiper-button-next !text-white !w-12 !h-12 !bg-white/10 !backdrop-blur-sm !rounded-full after:!text-lg"></div>
        </div>
        @else
        {{-- Default Hero without slides --}}
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 lg:py-32">
            <div class="text-center relative z-10">
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-6 leading-tight">
                    Temukan <span class="text-transparent bg-clip-text bg-gradient-to-r from-cyan-400 to-blue-400">Solusi Digital</span> Terbaik untuk Bisnis
                </h1>
                <p class="text-lg md:text-xl text-slate-300 mb-8 max-w-3xl mx-auto">
                    Jelajahi ratusan produk digital berkualitas tinggi. Dari aplikasi kasir hingga sistem enterprise.
                </p>
                <a href="{{ route('catalog') }}" class="inline-flex items-center gap-2 bg-gradient-to-r from-blue-600 to-cyan-600 text-white font-semibold py-4 px-8 rounded-xl shadow-lg">
                    Jelajahi Katalog
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
            </div>
        </div>
        @endif
        
        {{-- Stats Bar --}}
        <div class="absolute bottom-0 left-0 right-0 bg-black/30 backdrop-blur-md border-t border-white/10">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
                    <div>
                        <div class="text-3xl md:text-4xl font-bold text-white">{{ $featuredProducts->count() + $latestProducts->count() }}+</div>
                        <div class="text-slate-400 text-sm">Produk Digital</div>
                    </div>
                    <div>
                        <div class="text-3xl md:text-4xl font-bold text-white">{{ $categories->count() }}</div>
                        <div class="text-slate-400 text-sm">Kategori</div>
                    </div>
                    <div>
                        <div class="text-3xl md:text-4xl font-bold text-white">{{ $totalVisitors }}+</div>
                        <div class="text-slate-400 text-sm">Total Pengunjung</div>
                    </div>
                    <div>
                        <div class="text-3xl md:text-4xl font-bold text-white">24/7</div>
                        <div class="text-slate-400 text-sm">Support</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- TOP PROMO BANNERS --}}
    @if($topBanners->count() > 0)
    <div class="bg-gradient-to-r from-blue-600 to-indigo-600 shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="swiper top-banners-swiper py-5 md:py-6">
                <div class="swiper-wrapper">
                    @foreach($topBanners as $banner)
                    <div class="swiper-slide">
                        <a href="{{ $banner->url ?? '#' }}" class="flex items-center justify-center gap-4 text-white text-base md:text-lg group">
                            <span class="animate-pulse text-2xl">🔥</span>
                            <span class="font-semibold">{{ $banner->title }}</span>
                            <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    @endif

    {{-- CATEGORIES SECTION --}}
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <span class="inline-block bg-blue-100 text-blue-700 text-sm font-semibold px-4 py-1.5 rounded-full mb-4">Kategori</span>
                <h2 class="text-3xl md:text-4xl font-bold text-slate-800 mb-4">Jelajahi Berdasarkan Kategori</h2>
                <p class="text-slate-600 max-w-2xl mx-auto">Temukan produk digital yang sesuai dengan kebutuhan bisnis Anda</p>
            </div>
            
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4">
                @foreach($categories->take(10) as $category)
                <a href="{{ route('catalog', ['categories' => $category->id]) }}" class="group relative bg-gradient-to-br from-slate-50 to-slate-100 hover:from-blue-50 hover:to-indigo-50 rounded-2xl p-6 text-center transition-all duration-300 hover:shadow-lg hover:-translate-y-1 border border-slate-200 hover:border-blue-200">
                    <div class="w-14 h-14 rounded-xl flex items-center justify-center mx-auto mb-4 transition-all duration-300 group-hover:scale-110 overflow-hidden" style="background-color: {{ $category->color ?? '#3B82F6' }}20;">
                        @if($category->image && Storage::disk('public')->exists($category->image))
                            <img src="{{ Storage::url($category->image) }}" alt="{{ $category->name }}" class="w-full h-full object-cover">
                        @else
                            <span class="text-3xl">{{ $category->icon ?? '📦' }}</span>
                        @endif
                    </div>
                    <h3 class="font-semibold text-slate-800 group-hover:text-blue-600 transition-colors mb-1">{{ $category->name }}</h3>
                    <p class="text-sm text-slate-500">{{ $category->products_count }} Produk</p>
                </a>
                @endforeach
            </div>
            
            <div class="text-center mt-10">
                <a href="{{ route('catalog') }}" class="inline-flex items-center gap-2 text-blue-600 hover:text-blue-700 font-semibold">
                    Lihat Semua Kategori
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
            </div>
        </div>
    </section>

    {{-- MIDDLE PROMO BANNER --}}
    @if($middleBanners->count() > 0)
    <section class="py-8 bg-slate-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="swiper middle-banners-swiper">
                <div class="swiper-wrapper">
                    @foreach($middleBanners as $banner)
                    <div class="swiper-slide">
                        <a href="{{ $banner->url ?? '#' }}" class="block relative overflow-hidden rounded-2xl bg-gradient-to-r from-purple-600 to-pink-600 p-8 md:p-12">
                            <div class="absolute top-0 right-0 w-64 h-64 bg-white/10 rounded-full -mr-32 -mt-32"></div>
                            <div class="absolute bottom-0 left-0 w-48 h-48 bg-white/10 rounded-full -ml-24 -mb-24"></div>
                            <div class="relative z-10 flex flex-col md:flex-row items-center justify-between gap-6">
                                <div class="text-center md:text-left">
                                    <h3 class="text-2xl md:text-3xl font-bold text-white mb-2">{{ $banner->title }}</h3>
                                    <p class="text-white/80">Klik untuk melihat penawaran spesial</p>
                                </div>
                                <div class="flex-shrink-0">
                                    <span class="inline-flex items-center gap-2 bg-white text-purple-600 font-semibold py-3 px-6 rounded-xl shadow-lg hover:shadow-xl transition-shadow">
                                        Lihat Sekarang
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                        </svg>
                                    </span>
                                </div>
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>
                <div class="swiper-pagination !relative !mt-4"></div>
            </div>
        </div>
    </section>
    @endif

    {{-- FEATURED PRODUCTS --}}
    @if($featuredProducts->count() > 0)
    <section class="py-20 bg-gradient-to-b from-white to-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-12">
                <div>
                    <span class="inline-block bg-yellow-100 text-yellow-700 text-sm font-semibold px-4 py-1.5 rounded-full mb-4">⭐ Unggulan</span>
                    <h2 class="text-3xl md:text-4xl font-bold text-slate-800">Produk Unggulan</h2>
                    <p class="text-slate-600 mt-2">Produk pilihan dengan rating dan review terbaik</p>
                </div>
                <a href="{{ route('catalog', ['featured' => 1]) }}" class="inline-flex items-center gap-2 text-blue-600 hover:text-blue-700 font-semibold">
                    Lihat Semua
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
            </div>
            
            <div class="relative overflow-hidden">
                <div class="swiper featured-products-swiper">
                    <div class="swiper-wrapper pb-12">
                        @foreach($featuredProducts as $product)
                        <div class="swiper-slide !h-auto">
                            @include('components.product-card', ['product' => $product, 'featured' => true])
                        </div>
                        @endforeach
                    </div>
                    
                    {{-- Navigation Buttons --}}
                    <div class="swiper-button-prev-featured !left-0 !-translate-x-12 !w-12 !h-12 !bg-white !shadow-lg !rounded-full after:!text-lg after:!text-blue-600 hover:!bg-blue-50 !transition-all"></div>
                    <div class="swiper-button-next-featured !right-0 !translate-x-12 !w-12 !h-12 !bg-white !shadow-lg !rounded-full after:!text-lg after:!text-blue-600 hover:!bg-blue-50 !transition-all"></div>
                    
                    {{-- Pagination --}}
                    <div class="swiper-pagination-featured !relative !bottom-0 !mt-8"></div>
                </div>
            </div>
        </div>
    </section>
    @endif

    {{-- WHY CHOOSE US --}}
    <section class="py-20 bg-slate-900 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <span class="inline-block bg-blue-500/20 text-blue-300 text-sm font-semibold px-4 py-1.5 rounded-full mb-4">Keunggulan</span>
                <h2 class="text-3xl md:text-4xl font-bold mb-4">Mengapa Memilih Kami?</h2>
                <p class="text-slate-400 max-w-2xl mx-auto">Platform e-katalog terpercaya dengan berbagai keunggulan</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="text-center p-6 rounded-2xl bg-white/5 backdrop-blur-sm border border-white/10 hover:bg-white/10 transition-all duration-300">
                    <div class="w-16 h-16 bg-blue-500/20 rounded-2xl flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Produk Terverifikasi</h3>
                    <p class="text-slate-400 text-sm">Setiap produk melalui proses kurasi kualitas</p>
                </div>
                
                <div class="text-center p-6 rounded-2xl bg-white/5 backdrop-blur-sm border border-white/10 hover:bg-white/10 transition-all duration-300">
                    <div class="w-16 h-16 bg-green-500/20 rounded-2xl flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Kontak Langsung</h3>
                    <p class="text-slate-400 text-sm">Hubungi pemilik produk via WhatsApp</p>
                </div>
                
                <div class="text-center p-6 rounded-2xl bg-white/5 backdrop-blur-sm border border-white/10 hover:bg-white/10 transition-all duration-300">
                    <div class="w-16 h-16 bg-purple-500/20 rounded-2xl flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 15l-2 5L9 9l11 4-5 2zm0 0l5 5M7.188 2.239l.777 2.897M5.136 7.965l-2.898-.777M13.95 4.05l-2.122 2.122m-5.657 5.656l-2.12 2.122"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Live Demo</h3>
                    <p class="text-slate-400 text-sm">Coba produk sebelum membeli</p>
                </div>
                
                <div class="text-center p-6 rounded-2xl bg-white/5 backdrop-blur-sm border border-white/10 hover:bg-white/10 transition-all duration-300">
                    <div class="w-16 h-16 bg-cyan-500/20 rounded-2xl flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Support 24/7</h3>
                    <p class="text-slate-400 text-sm">Bantuan kapan saja Anda butuhkan</p>
                </div>
            </div>
        </div>
    </section>

    {{-- LATEST PRODUCTS --}}
    <section class="py-20 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-12">
                <div>
                    <span class="inline-block bg-green-100 text-green-700 text-sm font-semibold px-4 py-1.5 rounded-full mb-4">🆕 Terbaru</span>
                    <h2 class="text-3xl md:text-4xl font-bold text-slate-800">Produk Terbaru</h2>
                    <p class="text-slate-600 mt-2">Produk digital baru yang siap membantu bisnis Anda</p>
                </div>
                <a href="{{ route('catalog', ['sort' => 'latest']) }}" class="inline-flex items-center gap-2 text-blue-600 hover:text-blue-700 font-semibold">
                    Lihat Semua
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
            </div>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($latestProducts as $product)
                    @include('components.product-card', ['product' => $product])
                @endforeach
            </div>
        </div>
    </section>

    {{-- BOTTOM PROMO BANNER --}}
    @if($bottomBanners->count() > 0)
    <section class="bg-gradient-to-r from-orange-600 via-red-600 to-pink-600 shadow-lg py-6 md:py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="swiper bottom-banners-swiper">
                <div class="swiper-wrapper">
                    @foreach($bottomBanners as $banner)
                    <div class="swiper-slide">
                        <a href="{{ $banner->url ?? '#' }}" class="flex items-center justify-center gap-3 md:gap-4 text-white text-lg md:text-xl lg:text-2xl font-bold group hover:scale-105 transition-transform">
                            <span class="text-3xl md:text-4xl">🎉</span>
                            <span class="text-center">{{ $banner->title }}</span>
                            <svg class="w-6 h-6 md:w-7 md:h-7 group-hover:translate-x-1 transition-transform flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="3">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                            </svg>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    @endif

    {{-- CTA SECTION --}}
    <section class="py-20 bg-gradient-to-r from-blue-600 via-blue-700 to-indigo-800 relative overflow-hidden">
        <div class="absolute inset-0">
            <div class="absolute top-0 left-0 w-96 h-96 bg-white/10 rounded-full -ml-48 -mt-48"></div>
            <div class="absolute bottom-0 right-0 w-64 h-64 bg-white/10 rounded-full -mr-32 -mb-32"></div>
        </div>
        
        <div class="relative max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-6">
                Siap Mengembangkan Bisnis Anda?
            </h2>
            <p class="text-xl text-blue-100 mb-8 max-w-2xl mx-auto">
                Jelajahi katalog kami sekarang dan temukan solusi digital yang tepat untuk kebutuhan bisnis Anda.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('catalog') }}" class="inline-flex items-center justify-center gap-2 bg-white text-blue-600 hover:bg-blue-50 font-semibold py-4 px-8 rounded-xl transition-all duration-300 shadow-lg hover:shadow-xl">
                    Jelajahi Katalog
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
                <a href="{{ route('register') }}" class="inline-flex items-center justify-center gap-2 bg-transparent border-2 border-white text-white hover:bg-white/10 font-semibold py-4 px-8 rounded-xl transition-all duration-300">
                    Daftar Sebagai Mitra
                </a>
            </div>
        </div>
    </section>
@endsection

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
<style>
    .swiper-button-prev, .swiper-button-next {
        transition: all 0.3s ease;
    }
    .swiper-button-prev:hover, .swiper-button-next:hover {
        background-color: rgba(255,255,255,0.2) !important;
    }
    .swiper-pagination-bullet {
        background: white;
        opacity: 0.5;
    }
    .swiper-pagination-bullet-active {
        opacity: 1;
        background: white;
    }
    .hero-swiper .swiper-slide {
        opacity: 0.4;
        transition: opacity 0.3s;
    }
    .hero-swiper .swiper-slide-active {
        opacity: 1;
    }
    
    /* Featured Products Swiper Custom Styles */
    .swiper-button-prev-featured,
    .swiper-button-next-featured {
        transition: all 0.3s ease !important;
    }
    
    .swiper-pagination-featured .swiper-pagination-bullet {
        background: #3B82F6;
        opacity: 0.3;
        width: 10px;
        height: 10px;
        transition: all 0.3s ease;
    }
    
    .swiper-pagination-featured .swiper-pagination-bullet-active {
        opacity: 1;
        background: #3B82F6;
        transform: scale(1.2);
    }
    
    .swiper-pagination-featured .swiper-pagination-bullet:hover {
        opacity: 0.7;
    }
    
    /* Hide navigation on mobile */
    @media (max-width: 1024px) {
        .swiper-button-prev-featured,
        .swiper-button-next-featured {
            display: none;
        }
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Top Banners Swiper
    new Swiper('.top-banners-swiper', {
        loop: true,
        autoplay: {
            delay: 4000,
            disableOnInteraction: false,
        },
        effect: 'fade',
        fadeEffect: {
            crossFade: true
        }
    });
    
    // Hero Swiper
    new Swiper('.hero-swiper', {
        loop: true,
        autoplay: {
            delay: 6000,
            disableOnInteraction: false,
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        effect: 'fade',
        fadeEffect: {
            crossFade: true
        }
    });
    
    // Middle Banners Swiper
    new Swiper('.middle-banners-swiper', {
        loop: true,
        autoplay: {
            delay: 5000,
            disableOnInteraction: false,
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        }
    });
    
    // Bottom Banners Swiper
    new Swiper('.bottom-banners-swiper', {
        loop: true,
        autoplay: {
            delay: 4000,
            disableOnInteraction: false,
        },
        effect: 'fade',
        fadeEffect: {
            crossFade: true
        }
    });
    
    // Featured Products Swiper
    new Swiper('.featured-products-swiper', {
        slidesPerView: 1,
        spaceBetween: 24,
        loop: true,
        autoplay: {
            delay: 3000,
            disableOnInteraction: false,
            pauseOnMouseEnter: true,
        },
        navigation: {
            nextEl: '.swiper-button-next-featured',
            prevEl: '.swiper-button-prev-featured',
        },
        pagination: {
            el: '.swiper-pagination-featured',
            clickable: true,
            dynamicBullets: true,
        },
        breakpoints: {
            640: {
                slidesPerView: 2,
                spaceBetween: 20,
            },
            1024: {
                slidesPerView: 3,
                spaceBetween: 24,
            },
            1280: {
                slidesPerView: 4,
                spaceBetween: 24,
            }
        },
        on: {
            init: function() {
                updateNavigationVisibility(this);
            },
            slideChange: function() {
                updateNavigationVisibility(this);
            }
        }
    });
    
    function updateNavigationVisibility(swiper) {
        const prevBtn = document.querySelector('.swiper-button-prev-featured');
        const nextBtn = document.querySelector('.swiper-button-next-featured');
        
        if (prevBtn && nextBtn) {
            if (swiper.isBeginning) {
                prevBtn.style.opacity = '0.3';
                prevBtn.style.pointerEvents = 'none';
            } else {
                prevBtn.style.opacity = '1';
                prevBtn.style.pointerEvents = 'auto';
            }
            
            if (swiper.isEnd) {
                nextBtn.style.opacity = '0.3';
                nextBtn.style.pointerEvents = 'none';
            } else {
                nextBtn.style.opacity = '1';
                nextBtn.style.pointerEvents = 'auto';
            }
        }
    }
});
</script>
@endpush

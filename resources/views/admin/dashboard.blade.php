@extends('layouts.admin')

@section('title', 'Dashboard')
@section('header', 'Dashboard')

@section('content')
<div class="space-y-6">
    <!-- Welcome Banner -->
    <div class="relative overflow-hidden bg-gradient-to-r from-blue-600 via-blue-700 to-indigo-800 rounded-2xl p-6 md:p-8 text-white">
        <div class="absolute top-0 right-0 -mt-4 -mr-4 w-64 h-64 bg-white/10 rounded-full blur-2xl"></div>
        <div class="absolute bottom-0 left-0 -mb-8 -ml-8 w-48 h-48 bg-blue-500/20 rounded-full blur-xl"></div>
        <div class="relative z-10">
            <h1 class="text-2xl md:text-3xl font-bold mb-2">Selamat Datang, {{ auth()->user()->name }}! 👋</h1>
            <p class="text-blue-100 text-sm md:text-base max-w-2xl">
                Dashboard ini menampilkan ringkasan statistik dan aktivitas terbaru dari katalog produk Anda.
            </p>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-2 md:grid-cols-3 xl:grid-cols-6 gap-4">
        <!-- Total Products -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-100 p-5 hover:shadow-md transition-all duration-300">
            <div class="flex items-center justify-between mb-3">
                <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center shadow-lg shadow-blue-500/30">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                    </svg>
                </div>
                <span class="text-xs font-medium text-blue-600 bg-blue-50 px-2 py-1 rounded-full">Total</span>
            </div>
            <p class="text-3xl font-bold text-slate-800 mb-1">{{ $stats['total_products'] }}</p>
            <p class="text-sm text-slate-500">Produk</p>
        </div>
        
        <!-- Published -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-100 p-5 hover:shadow-md transition-all duration-300">
            <div class="flex items-center justify-between mb-3">
                <div class="w-12 h-12 bg-gradient-to-br from-emerald-500 to-green-600 rounded-xl flex items-center justify-center shadow-lg shadow-green-500/30">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <span class="text-xs font-medium text-green-600 bg-green-50 px-2 py-1 rounded-full">Live</span>
            </div>
            <p class="text-3xl font-bold text-slate-800 mb-1">{{ $stats['published_products'] }}</p>
            <p class="text-sm text-slate-500">Published</p>
        </div>
        
        <!-- Draft -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-100 p-5 hover:shadow-md transition-all duration-300">
            <div class="flex items-center justify-between mb-3">
                <div class="w-12 h-12 bg-gradient-to-br from-amber-400 to-yellow-500 rounded-xl flex items-center justify-center shadow-lg shadow-yellow-500/30">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                </div>
                <span class="text-xs font-medium text-yellow-600 bg-yellow-50 px-2 py-1 rounded-full">Pending</span>
            </div>
            <p class="text-3xl font-bold text-slate-800 mb-1">{{ $stats['draft_products'] }}</p>
            <p class="text-sm text-slate-500">Draft</p>
        </div>
        
        <!-- Total Views -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-100 p-5 hover:shadow-md transition-all duration-300">
            <div class="flex items-center justify-between mb-3">
                <div class="w-12 h-12 bg-gradient-to-br from-violet-500 to-purple-600 rounded-xl flex items-center justify-center shadow-lg shadow-purple-500/30">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                </div>
            </div>
            <p class="text-3xl font-bold text-slate-800 mb-1">{{ number_format($stats['total_views']) }}</p>
            <p class="text-sm text-slate-500">Total Views</p>
        </div>
        
        <!-- Demo Clicks -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-100 p-5 hover:shadow-md transition-all duration-300">
            <div class="flex items-center justify-between mb-3">
                <div class="w-12 h-12 bg-gradient-to-br from-cyan-500 to-teal-600 rounded-xl flex items-center justify-center shadow-lg shadow-cyan-500/30">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 15l-2 5L9 9l11 4-5 2zm0 0l5 5M7.188 2.239l.777 2.897M5.136 7.965l-2.898-.777M13.95 4.05l-2.122 2.122m-5.657 5.656l-2.12 2.122"/>
                    </svg>
                </div>
            </div>
            <p class="text-3xl font-bold text-slate-800 mb-1">{{ number_format($stats['total_demo_clicks']) }}</p>
            <p class="text-sm text-slate-500">Demo Clicks</p>
        </div>
        
        <!-- WhatsApp Clicks -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-100 p-5 hover:shadow-md transition-all duration-300">
            <div class="flex items-center justify-between mb-3">
                <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-emerald-600 rounded-xl flex items-center justify-center shadow-lg shadow-green-500/30">
                    <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981z"/>
                    </svg>
                </div>
            </div>
            <p class="text-3xl font-bold text-slate-800 mb-1">{{ number_format($stats['total_whatsapp_clicks']) }}</p>
            <p class="text-sm text-slate-500">WA Clicks</p>
        </div>
    </div>
    
    <!-- Quick Actions & Chart -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Quick Actions -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-100 p-6">
            <div class="flex items-center gap-2 mb-5">
                <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center">
                    <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                </div>
                <h2 class="text-lg font-semibold text-slate-800">Aksi Cepat</h2>
            </div>
            <div class="space-y-3">
                <a href="{{ route('admin.products.create') }}" class="group flex items-center gap-3 p-4 bg-gradient-to-r from-blue-50 to-indigo-50 hover:from-blue-100 hover:to-indigo-100 rounded-xl transition-all duration-300 border border-blue-100">
                    <div class="w-11 h-11 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center text-white shadow-md group-hover:scale-110 transition-transform">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                    </div>
                    <div>
                        <p class="font-semibold text-slate-800">Tambah Produk Baru</p>
                        <p class="text-xs text-slate-500">Buat listing produk baru</p>
                    </div>
                    <svg class="w-5 h-5 ml-auto text-slate-400 group-hover:text-blue-600 group-hover:translate-x-1 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
                
                <a href="{{ route('admin.hero-slides.create') }}" class="group flex items-center gap-3 p-4 bg-gradient-to-r from-purple-50 to-pink-50 hover:from-purple-100 hover:to-pink-100 rounded-xl transition-all duration-300 border border-purple-100">
                    <div class="w-11 h-11 bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl flex items-center justify-center text-white shadow-md group-hover:scale-110 transition-transform">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="font-semibold text-slate-800">Tambah Hero Slide</p>
                        <p class="text-xs text-slate-500">Update banner homepage</p>
                    </div>
                    <svg class="w-5 h-5 ml-auto text-slate-400 group-hover:text-purple-600 group-hover:translate-x-1 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
                
                <a href="{{ route('admin.products.index') }}" class="group flex items-center gap-3 p-4 bg-gradient-to-r from-slate-50 to-gray-50 hover:from-slate-100 hover:to-gray-100 rounded-xl transition-all duration-300 border border-slate-100">
                    <div class="w-11 h-11 bg-gradient-to-br from-slate-600 to-slate-700 rounded-xl flex items-center justify-center text-white shadow-md group-hover:scale-110 transition-transform">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/>
                        </svg>
                    </div>
                    <div>
                        <p class="font-semibold text-slate-800">Kelola Produk</p>
                        <p class="text-xs text-slate-500">Lihat semua produk</p>
                    </div>
                    <svg class="w-5 h-5 ml-auto text-slate-400 group-hover:text-slate-600 group-hover:translate-x-1 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>
        </div>
        
        <!-- Analytics Chart -->
        <div class="lg:col-span-2 bg-white rounded-xl shadow-sm border border-slate-100 p-6">
            <div class="flex items-center justify-between mb-5">
                <div class="flex items-center gap-2">
                    <div class="w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center">
                        <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                        </svg>
                    </div>
                    <h2 class="text-lg font-semibold text-slate-800">Statistik 7 Hari Terakhir</h2>
                </div>
                <div class="flex items-center gap-4 text-xs">
                    <span class="flex items-center gap-1.5">
                        <span class="w-3 h-3 bg-violet-500 rounded-full"></span>
                        Views
                    </span>
                    <span class="flex items-center gap-1.5">
                        <span class="w-3 h-3 bg-cyan-500 rounded-full"></span>
                        Demo
                    </span>
                    <span class="flex items-center gap-1.5">
                        <span class="w-3 h-3 bg-green-500 rounded-full"></span>
                        WhatsApp
                    </span>
                </div>
            </div>
            <!-- FIXED: Chart container with fixed height to prevent infinite stretching -->
            <div class="relative" style="height: 280px;">
                <canvas id="analyticsChart"></canvas>
            </div>
        </div>
    </div>
    
    <!-- Recent & Top Products -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Recent Products -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-100 p-6">
            <div class="flex items-center justify-between mb-5">
                <div class="flex items-center gap-2">
                    <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center">
                        <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h2 class="text-lg font-semibold text-slate-800">Produk Terbaru</h2>
                </div>
                <a href="{{ route('admin.products.index') }}" class="text-sm text-blue-600 hover:text-blue-700 font-medium flex items-center gap-1 hover:gap-2 transition-all">
                    Lihat Semua
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>
            
            @if($recentProducts->count() > 0)
            <div class="space-y-3">
                @foreach($recentProducts as $product)
                <a href="{{ route('admin.products.edit', $product) }}" class="group flex items-center gap-4 p-3 hover:bg-slate-50 rounded-xl transition-all duration-200 border border-transparent hover:border-slate-200">
                    <div class="relative">
                        <img 
                            src="{{ $product->main_image_url }}" 
                            alt="{{ $product->name }}" 
                            class="w-14 h-14 rounded-xl object-cover shadow-sm ring-2 ring-slate-100"
                        >
                        <div class="absolute -bottom-1 -right-1 w-5 h-5 rounded-full flex items-center justify-center {{ $product->status === 'published' ? 'bg-green-500' : 'bg-yellow-500' }}">
                            @if($product->status === 'published')
                            <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            @else
                            <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01"/>
                            </svg>
                            @endif
                        </div>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="font-semibold text-slate-800 truncate group-hover:text-blue-600 transition-colors">{{ $product->name }}</p>
                        <div class="flex items-center gap-2 mt-1">
                            <span class="text-xs text-slate-500 bg-slate-100 px-2 py-0.5 rounded-full">{{ $product->category->name ?? '-' }}</span>
                            <span class="text-xs text-slate-400">{{ $product->created_at->diffForHumans() }}</span>
                        </div>
                    </div>
                    <svg class="w-5 h-5 text-slate-300 group-hover:text-blue-500 group-hover:translate-x-1 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
                @endforeach
            </div>
            @else
            <div class="text-center py-10">
                <div class="w-16 h-16 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                    </svg>
                </div>
                <p class="text-slate-500 font-medium">Belum ada produk</p>
                <p class="text-sm text-slate-400 mt-1">Tambahkan produk pertama Anda</p>
            </div>
            @endif
        </div>
        
        <!-- Top Products -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-100 p-6">
            <div class="flex items-center justify-between mb-5">
                <div class="flex items-center gap-2">
                    <div class="w-8 h-8 bg-amber-100 rounded-lg flex items-center justify-center">
                        <svg class="w-4 h-4 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                        </svg>
                    </div>
                    <h2 class="text-lg font-semibold text-slate-800">Produk Terpopuler</h2>
                </div>
            </div>
            
            @if($topProducts->count() > 0)
            <div class="space-y-3">
                @foreach($topProducts as $index => $product)
                <a href="{{ route('admin.products.edit', $product) }}" class="group flex items-center gap-4 p-3 hover:bg-slate-50 rounded-xl transition-all duration-200 border border-transparent hover:border-slate-200">
                    <span class="w-9 h-9 rounded-xl flex items-center justify-center text-sm font-bold
                        {{ $index === 0 ? 'bg-gradient-to-br from-amber-400 to-orange-500 text-white shadow-lg shadow-amber-500/30' : '' }}
                        {{ $index === 1 ? 'bg-gradient-to-br from-slate-300 to-slate-400 text-white shadow-lg shadow-slate-400/30' : '' }}
                        {{ $index === 2 ? 'bg-gradient-to-br from-amber-600 to-amber-700 text-white shadow-lg shadow-amber-600/30' : '' }}
                        {{ $index > 2 ? 'bg-slate-100 text-slate-600' : '' }}
                    ">
                        {{ $index + 1 }}
                    </span>
                    <img 
                        src="{{ $product->main_image_url }}" 
                        alt="{{ $product->name }}" 
                        class="w-14 h-14 rounded-xl object-cover shadow-sm ring-2 ring-slate-100"
                    >
                    <div class="flex-1 min-w-0">
                        <p class="font-semibold text-slate-800 truncate group-hover:text-blue-600 transition-colors">{{ $product->name }}</p>
                        <div class="flex items-center gap-3 mt-1">
                            <span class="text-xs text-slate-500 flex items-center gap-1">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                                {{ number_format($product->views_count) }}
                            </span>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
            @else
            <div class="text-center py-10">
                <div class="w-16 h-16 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                    </svg>
                </div>
                <p class="text-slate-500 font-medium">Belum ada data</p>
                <p class="text-sm text-slate-400 mt-1">Statistik akan muncul saat produk mendapat views</p>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const ctx = document.getElementById('analyticsChart');
    if (!ctx) return;
    
    const analyticsData = @json($analyticsData);
    
    new Chart(ctx.getContext('2d'), {
        type: 'line',
        data: {
            labels: analyticsData.labels,
            datasets: [
                {
                    label: 'Views',
                    data: analyticsData.views,
                    borderColor: '#8B5CF6',
                    backgroundColor: 'rgba(139, 92, 246, 0.1)',
                    tension: 0.4,
                    fill: true,
                    borderWidth: 2,
                    pointRadius: 4,
                    pointBackgroundColor: '#8B5CF6',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2,
                    pointHoverRadius: 6
                },
                {
                    label: 'Demo Clicks',
                    data: analyticsData.demoClicks,
                    borderColor: '#06B6D4',
                    backgroundColor: 'rgba(6, 182, 212, 0.1)',
                    tension: 0.4,
                    fill: true,
                    borderWidth: 2,
                    pointRadius: 4,
                    pointBackgroundColor: '#06B6D4',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2,
                    pointHoverRadius: 6
                },
                {
                    label: 'WA Clicks',
                    data: analyticsData.whatsappClicks,
                    borderColor: '#22C55E',
                    backgroundColor: 'rgba(34, 197, 94, 0.1)',
                    tension: 0.4,
                    fill: true,
                    borderWidth: 2,
                    pointRadius: 4,
                    pointBackgroundColor: '#22C55E',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2,
                    pointHoverRadius: 6
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            interaction: {
                mode: 'index',
                intersect: false,
            },
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    backgroundColor: 'rgba(15, 23, 42, 0.9)',
                    titleFont: { size: 13, weight: '600' },
                    bodyFont: { size: 12 },
                    padding: 12,
                    cornerRadius: 8,
                    displayColors: true,
                    boxPadding: 4
                }
            },
            scales: {
                x: {
                    grid: {
                        display: false
                    },
                    ticks: {
                        font: { size: 11 },
                        color: '#64748b'
                    }
                },
                y: {
                    beginAtZero: true,
                    grid: {
                        color: 'rgba(148, 163, 184, 0.1)'
                    },
                    ticks: {
                        font: { size: 11 },
                        color: '#64748b',
                        stepSize: 1
                    }
                }
            }
        }
    });
});
</script>
@endpush

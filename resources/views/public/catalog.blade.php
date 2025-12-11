@extends('layouts.public')

@section('title', 'Katalog Produk - Skanic Tech')
@section('meta_description', 'Jelajahi katalog lengkap produk digital kami. Aplikasi web, SaaS, dan solusi digital untuk berbagai kebutuhan bisnis.')

@section('content')
<div class="bg-gradient-corporate py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl md:text-4xl font-bold text-white mb-4">Katalog Produk</h1>
        <p class="text-white/80">Temukan produk digital yang sesuai dengan kebutuhan Anda</p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="flex flex-col lg:flex-row gap-8">
        <!-- Sidebar Filters -->
        <aside class="w-full lg:w-64 flex-shrink-0">
            <div class="bg-white rounded-xl shadow-md p-6 lg:sticky lg:top-20">
                <form action="{{ route('catalog') }}" method="GET" id="filter-form">
                    <!-- Search -->
                    <div class="mb-6">
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Cari Produk</label>
                        <div class="relative">
                            <input 
                                type="text" 
                                name="search" 
                                value="{{ request('search') }}"
                                placeholder="Ketik nama produk..."
                                class="w-full pl-10 pr-4 py-2.5 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            >
                            <svg class="w-5 h-5 text-slate-400 absolute left-3 top-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </div>
                    </div>
                    
                    <!-- Categories -->
                    <div class="mb-6">
                        <label class="block text-sm font-semibold text-slate-700 mb-3">Kategori</label>
                        <div class="space-y-2 max-h-48 overflow-y-auto">
                            @foreach($categories as $category)
                            <label class="flex items-center gap-2 cursor-pointer group">
                                <input 
                                    type="checkbox" 
                                    name="categories[]" 
                                    value="{{ $category->id }}"
                                    class="w-4 h-4 text-blue-600 border-slate-300 rounded focus:ring-blue-500"
                                    {{ in_array($category->id, (array) request('categories', [])) ? 'checked' : '' }}
                                >
                                <span class="text-sm text-slate-600 group-hover:text-blue-600">{{ $category->name }}</span>
                            </label>
                            @endforeach
                        </div>
                    </div>
                    
                    <!-- Price Type -->
                    <div class="mb-6">
                        <label class="block text-sm font-semibold text-slate-700 mb-3">Tipe Harga</label>
                        <div class="space-y-2">
                            <label class="flex items-center gap-2 cursor-pointer group">
                                <input 
                                    type="radio" 
                                    name="price_type" 
                                    value=""
                                    class="w-4 h-4 text-blue-600 border-slate-300 focus:ring-blue-500"
                                    {{ !request('price_type') ? 'checked' : '' }}
                                >
                                <span class="text-sm text-slate-600 group-hover:text-blue-600">Semua</span>
                            </label>
                            <label class="flex items-center gap-2 cursor-pointer group">
                                <input 
                                    type="radio" 
                                    name="price_type" 
                                    value="monthly"
                                    class="w-4 h-4 text-blue-600 border-slate-300 focus:ring-blue-500"
                                    {{ request('price_type') === 'monthly' ? 'checked' : '' }}
                                >
                                <span class="text-sm text-slate-600 group-hover:text-blue-600">Bulanan</span>
                            </label>
                            <label class="flex items-center gap-2 cursor-pointer group">
                                <input 
                                    type="radio" 
                                    name="price_type" 
                                    value="yearly"
                                    class="w-4 h-4 text-blue-600 border-slate-300 focus:ring-blue-500"
                                    {{ request('price_type') === 'yearly' ? 'checked' : '' }}
                                >
                                <span class="text-sm text-slate-600 group-hover:text-blue-600">Tahunan</span>
                            </label>
                            <label class="flex items-center gap-2 cursor-pointer group">
                                <input 
                                    type="radio" 
                                    name="price_type" 
                                    value="one_time"
                                    class="w-4 h-4 text-blue-600 border-slate-300 focus:ring-blue-500"
                                    {{ request('price_type') === 'one_time' ? 'checked' : '' }}
                                >
                                <span class="text-sm text-slate-600 group-hover:text-blue-600">Sekali Bayar</span>
                            </label>
                        </div>
                    </div>
                    
                    <!-- Price Range -->
                    <div class="mb-6">
                        <label class="block text-sm font-semibold text-slate-700 mb-3">Rentang Harga</label>
                        <div class="grid grid-cols-2 gap-2">
                            <input 
                                type="number" 
                                name="min_price" 
                                value="{{ request('min_price') }}"
                                placeholder="Min"
                                class="w-full px-3 py-2 text-sm border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            >
                            <input 
                                type="number" 
                                name="max_price" 
                                value="{{ request('max_price') }}"
                                placeholder="Max"
                                class="w-full px-3 py-2 text-sm border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            >
                        </div>
                    </div>
                    
                    <div class="flex gap-2">
                        <button type="submit" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg transition-colors">
                            Terapkan
                        </button>
                        <a href="{{ route('catalog') }}" class="px-4 py-2 text-slate-600 hover:text-slate-800 font-medium">
                            Reset
                        </a>
                    </div>
                </form>
            </div>
        </aside>
        
        <!-- Products Grid -->
        <div class="flex-1">
            <!-- Sort & Results Info -->
            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 mb-6">
                <p class="text-slate-600">
                    Menampilkan <span class="font-semibold">{{ $products->total() }}</span> produk
                </p>
                <div class="flex items-center gap-2">
                    <label class="text-sm text-slate-600">Urutkan:</label>
                    <select 
                        name="sort" 
                        onchange="window.location.href = updateQueryString('sort', this.value)"
                        class="px-3 py-2 text-sm border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white"
                    >
                        <option value="latest" {{ request('sort') === 'latest' || !request('sort') ? 'selected' : '' }}>Terbaru</option>
                        <option value="price_low" {{ request('sort') === 'price_low' ? 'selected' : '' }}>Harga Terendah</option>
                        <option value="price_high" {{ request('sort') === 'price_high' ? 'selected' : '' }}>Harga Tertinggi</option>
                        <option value="popular" {{ request('sort') === 'popular' ? 'selected' : '' }}>Terpopuler</option>
                        <option value="name" {{ request('sort') === 'name' ? 'selected' : '' }}>Nama A-Z</option>
                    </select>
                </div>
            </div>
            
            @if($products->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-6">
                @foreach($products as $product)
                    @include('components.product-card', ['product' => $product])
                @endforeach
            </div>
            
            <!-- Pagination -->
            <div class="mt-8">
                {{ $products->links() }}
            </div>
            @else
            <div class="text-center py-16">
                <svg class="w-24 h-24 mx-auto text-slate-300 mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                </svg>
                <h3 class="text-xl font-semibold text-slate-700 mb-2">Tidak ada produk ditemukan</h3>
                <p class="text-slate-500 mb-4">Coba ubah filter atau kata kunci pencarian Anda</p>
                <a href="{{ route('catalog') }}" class="inline-flex items-center gap-2 text-blue-600 hover:text-blue-700 font-medium">
                    Reset Filter
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                    </svg>
                </a>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function updateQueryString(key, value) {
    const url = new URL(window.location.href);
    if (value) {
        url.searchParams.set(key, value);
    } else {
        url.searchParams.delete(key);
    }
    return url.toString();
}
</script>
@endpush

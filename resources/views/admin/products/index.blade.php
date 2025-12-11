@extends('layouts.admin')

@section('title', 'Kelola Produk')
@section('header', 'Kelola Produk')

@section('content')
<div class="space-y-6">
    <!-- Header Actions -->
    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
        <div>
            <p class="text-slate-600">Kelola semua produk digital Anda di sini</p>
        </div>
        <a href="{{ route('admin.products.create') }}" class="flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2.5 px-5 rounded-lg transition-all duration-200 shadow-md hover:shadow-lg">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Tambah Produk
        </a>
    </div>
    
    <!-- Filters -->
    <div class="bg-white rounded-xl shadow-md p-4">
        <form action="{{ route('admin.products.index') }}" method="GET" class="flex flex-col sm:flex-row gap-4">
            <div class="flex-1">
                <input 
                    type="text" 
                    name="search" 
                    value="{{ request('search') }}"
                    placeholder="Cari produk atau pemilik..."
                    class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                >
            </div>
            <select name="status" class="px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white">
                <option value="">Semua Status</option>
                <option value="published" {{ request('status') === 'published' ? 'selected' : '' }}>Published</option>
                <option value="draft" {{ request('status') === 'draft' ? 'selected' : '' }}>Draft</option>
            </select>
            <select name="category" class="px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white">
                <option value="">Semua Kategori</option>
                @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                @endforeach
            </select>
            <button type="submit" class="bg-slate-100 hover:bg-slate-200 text-slate-700 font-medium py-2 px-4 rounded-lg transition-colors">
                Filter
            </button>
        </form>
    </div>
    
    <!-- Products Table -->
    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        @if($products->count() > 0)
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-200">
                        <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Produk</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Kategori</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Harga</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Status</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Stats</th>
                        <th class="px-4 py-3 text-center text-xs font-semibold text-slate-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach($products as $product)
                    <tr class="hover:bg-slate-50">
                        <td class="px-4 py-4">
                            <div class="flex items-center gap-3">
                                <img 
                                    src="{{ $product->main_image_url }}" 
                                    alt="{{ $product->name }}" 
                                    class="w-12 h-12 rounded-lg object-cover"
                                >
                                <div>
                                    <p class="font-medium text-slate-800">{{ Str::limit($product->name, 30) }}</p>
                                    <p class="text-sm text-slate-500">{{ $product->owner_name }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-4 py-4 text-sm text-slate-600">
                            {{ $product->category->name ?? '-' }}
                        </td>
                        <td class="px-4 py-4">
                            <span class="text-sm font-medium text-slate-800">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                            <span class="text-xs text-slate-500 block">{{ $product->price_type_label }}</span>
                        </td>
                        <td class="px-4 py-4">
                            <div class="flex items-center gap-2">
                                <span class="badge {{ $product->status === 'published' ? 'badge-success' : 'badge-warning' }}">
                                    {{ $product->status === 'published' ? 'Published' : 'Draft' }}
                                </span>
                                @if($product->is_featured)
                                <span class="badge badge-info">⭐ Featured</span>
                                @endif
                            </div>
                        </td>
                        <td class="px-4 py-4 text-sm text-slate-500">
                            <div class="flex items-center gap-3">
                                <span title="Views">👁 {{ number_format($product->views_count) }}</span>
                                <span title="Demo Clicks">🖱 {{ number_format($product->demo_clicks) }}</span>
                                <span title="WA Clicks">📱 {{ number_format($product->whatsapp_clicks) }}</span>
                            </div>
                        </td>
                        <td class="px-4 py-4">
                            <div class="flex items-center justify-center gap-1">
                                <a href="{{ route('product.detail', $product->slug) }}" target="_blank" class="p-2 text-slate-400 hover:text-blue-600 hover:bg-blue-50 rounded-lg" title="Lihat">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                                    </svg>
                                </a>
                                <a href="{{ route('admin.products.edit', $product) }}" class="p-2 text-slate-400 hover:text-blue-600 hover:bg-blue-50 rounded-lg" title="Edit">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                </a>
                                <form action="{{ route('admin.products.toggle-status', $product) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" class="p-2 text-slate-400 hover:text-yellow-600 hover:bg-yellow-50 rounded-lg" title="{{ $product->status === 'published' ? 'Set Draft' : 'Publish' }}">
                                        @if($product->status === 'published')
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>
                                        </svg>
                                        @else
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                        @endif
                                    </button>
                                </form>
                                <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 text-slate-400 hover:text-red-600 hover:bg-red-50 rounded-lg" title="Hapus">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <div class="px-4 py-3 border-t border-slate-100">
            {{ $products->links() }}
        </div>
        @else
        <div class="text-center py-16">
            <svg class="w-16 h-16 mx-auto text-slate-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
            </svg>
            <h3 class="text-lg font-medium text-slate-700 mb-2">Belum ada produk</h3>
            <p class="text-slate-500 mb-4">Mulai tambahkan produk digital Anda sekarang</p>
            <a href="{{ route('admin.products.create') }}" class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Tambah Produk Pertama
            </a>
        </div>
        @endif
    </div>
</div>
@endsection

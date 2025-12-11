@extends('layouts.admin')

@section('title', 'Edit Produk')
@section('header', 'Edit Produk')

@section('content')
<div class="max-w-4xl">
    <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')
        
        <!-- Basic Info -->
        <div class="bg-white rounded-xl shadow-md p-6">
            <h2 class="text-lg font-semibold text-slate-800 mb-4">Informasi Dasar</h2>
            
            <div class="space-y-4">
                <div>
                    <label for="name" class="block text-sm font-medium text-slate-700 mb-1.5">Nama Produk <span class="text-red-500">*</span></label>
                    <input 
                        type="text" 
                        id="name" 
                        name="name" 
                        value="{{ old('name', $product->name) }}"
                        required
                        class="w-full px-4 py-2.5 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('name') border-red-500 @enderror"
                    >
                    @error('name')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="category_id" class="block text-sm font-medium text-slate-700 mb-1.5">Kategori <span class="text-red-500">*</span></label>
                        <select 
                            id="category_id" 
                            name="category_id" 
                            required
                            class="w-full px-4 py-2.5 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white"
                        >
                            <option value="">Pilih Kategori</option>
                            @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div>
                        <label for="status" class="block text-sm font-medium text-slate-700 mb-1.5">Status</label>
                        <select 
                            id="status" 
                            name="status"
                            class="w-full px-4 py-2.5 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white"
                        >
                            <option value="draft" {{ old('status', $product->status) === 'draft' ? 'selected' : '' }}>Draft</option>
                            <option value="published" {{ old('status', $product->status) === 'published' ? 'selected' : '' }}>Published</option>
                        </select>
                    </div>
                </div>
                
                <div>
                    <label for="short_description" class="block text-sm font-medium text-slate-700 mb-1.5">Deskripsi Singkat</label>
                    <textarea 
                        id="short_description" 
                        name="short_description" 
                        rows="2"
                        class="w-full px-4 py-2.5 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    >{{ old('short_description', $product->short_description) }}</textarea>
                </div>
                
                <div>
                    <label for="description" class="block text-sm font-medium text-slate-700 mb-1.5">Deskripsi Lengkap</label>
                    <textarea 
                        id="description" 
                        name="description" 
                        rows="5"
                        class="w-full px-4 py-2.5 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    >{{ old('description', $product->description) }}</textarea>
                </div>
            </div>
        </div>
        
        <!-- Pricing -->
        <div class="bg-white rounded-xl shadow-md p-6">
            <h2 class="text-lg font-semibold text-slate-800 mb-4">Harga</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="price" class="block text-sm font-medium text-slate-700 mb-1.5">Harga (Rp) <span class="text-red-500">*</span></label>
                    <input 
                        type="number" 
                        id="price" 
                        name="price" 
                        value="{{ old('price', $product->price) }}"
                        required
                        min="0"
                        class="w-full px-4 py-2.5 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    >
                </div>
                
                <div>
                    <label for="price_type" class="block text-sm font-medium text-slate-700 mb-1.5">Tipe Harga <span class="text-red-500">*</span></label>
                    <select 
                        id="price_type" 
                        name="price_type" 
                        required
                        class="w-full px-4 py-2.5 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white"
                    >
                        <option value="one_time" {{ old('price_type', $product->price_type) === 'one_time' ? 'selected' : '' }}>Sekali Bayar</option>
                        <option value="monthly" {{ old('price_type', $product->price_type) === 'monthly' ? 'selected' : '' }}>Bulanan</option>
                        <option value="yearly" {{ old('price_type', $product->price_type) === 'yearly' ? 'selected' : '' }}>Tahunan</option>
                    </select>
                </div>
            </div>
        </div>
        
        <!-- Images -->
        <div class="bg-white rounded-xl shadow-md p-6">
            <h2 class="text-lg font-semibold text-slate-800 mb-4">Galeri Gambar Produk</h2>
            
            <div class="space-y-4">
                @if(is_array($product->gallery_images) && count($product->gallery_images) > 0)
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Galeri Saat Ini</label>
                    <div class="flex flex-wrap gap-2">
                        @foreach($product->gallery_urls as $index => $image)
                        <div class="relative group">
                            <img src="{{ $image }}" alt="" class="w-24 h-24 object-cover rounded-lg border-2 {{ $index === 0 ? 'border-blue-500' : 'border-slate-200' }}">
                            @if($index === 0)
                            <span class="absolute bottom-1 left-1 bg-blue-500 text-white text-xs px-2 py-0.5 rounded">Utama</span>
                            @endif
                            <label class="absolute top-1 right-1 bg-red-500 text-white rounded p-1 cursor-pointer hover:bg-red-600">
                                <input type="checkbox" name="remove_gallery_images[]" value="{{ $index }}" class="sr-only">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </label>
                        </div>
                        @endforeach
                    </div>
                    <p class="text-xs text-slate-500 mt-1">Centang untuk menghapus gambar. Gambar pertama adalah gambar utama produk.</p>
                </div>
                @endif
                
                <div>
                    <label for="gallery_images" class="block text-sm font-medium text-slate-700 mb-1.5">
                        {{ is_array($product->gallery_images) && count($product->gallery_images) > 0 ? 'Tambah Gambar Baru' : 'Upload Gambar Produk' }}
                        @if(!is_array($product->gallery_images) || count($product->gallery_images) === 0)
                        <span class="text-red-500">*</span>
                        @endif
                    </label>
                    <input 
                        type="file" 
                        id="gallery_images" 
                        name="gallery_images[]"
                        accept="image/jpeg,image/png,image/gif,image/webp"
                        multiple
                        {{ (!is_array($product->gallery_images) || count($product->gallery_images) === 0) ? 'required' : '' }}
                        class="w-full px-4 py-2.5 border border-slate-300 rounded-lg file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-blue-50 file:text-blue-700"
                    >
                    <p class="text-xs text-slate-500 mt-1">JPG, PNG, GIF, WebP (Maks. 2MB per file). Urutan upload akan menjadi urutan tampilan.</p>
                </div>
            </div>
        </div>
        
        <!-- Features -->
        <div class="bg-white rounded-xl shadow-md p-6">
            <h2 class="text-lg font-semibold text-slate-800 mb-4">Fitur Produk</h2>
            
            <div id="features-container" class="space-y-2">
                @if(is_array($product->features) && count($product->features) > 0)
                    @foreach($product->features as $feature)
                    <div class="flex gap-2">
                        <input 
                            type="text" 
                            name="features[]"
                            value="{{ $feature }}"
                            class="flex-1 px-4 py-2.5 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500"
                        >
                        <button type="button" onclick="this.parentElement.remove()" class="px-4 py-2 bg-red-100 text-red-600 rounded-lg hover:bg-red-200">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>
                    @endforeach
                @else
                <div class="flex gap-2">
                    <input 
                        type="text" 
                        name="features[]"
                        class="flex-1 px-4 py-2.5 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500"
                        placeholder="Fitur produk..."
                    >
                    <button type="button" onclick="addFeature()" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                    </button>
                </div>
                @endif
            </div>
            
            @if(is_array($product->features) && count($product->features) > 0)
            <button type="button" onclick="addFeature()" class="mt-3 text-blue-600 hover:text-blue-700 font-medium text-sm">
                + Tambah Fitur
            </button>
            @endif
        </div>
        
        <!-- Demo Info -->
        <div class="bg-white rounded-xl shadow-md p-6">
            <h2 class="text-lg font-semibold text-slate-800 mb-4">Informasi Demo</h2>
            
            <div class="space-y-4">
                <div>
                    <label for="demo_url" class="block text-sm font-medium text-slate-700 mb-1.5">URL Live Demo</label>
                    <input 
                        type="url" 
                        id="demo_url" 
                        name="demo_url" 
                        value="{{ old('demo_url', $product->demo_url) }}"
                        class="w-full px-4 py-2.5 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500"
                    >
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="demo_username" class="block text-sm font-medium text-slate-700 mb-1.5">Username Demo</label>
                        <input 
                            type="text" 
                            id="demo_username" 
                            name="demo_username" 
                            value="{{ old('demo_username', $product->demo_username) }}"
                            class="w-full px-4 py-2.5 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500"
                        >
                    </div>
                    
                    <div>
                        <label for="demo_password" class="block text-sm font-medium text-slate-700 mb-1.5">Password Demo</label>
                        <input 
                            type="text" 
                            id="demo_password" 
                            name="demo_password" 
                            value="{{ old('demo_password', $product->demo_password) }}"
                            class="w-full px-4 py-2.5 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500"
                        >
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Owner Info -->
        <div class="bg-white rounded-xl shadow-md p-6">
            <h2 class="text-lg font-semibold text-slate-800 mb-4">Informasi Pemilik</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="owner_name" class="block text-sm font-medium text-slate-700 mb-1.5">Nama Pemilik <span class="text-red-500">*</span></label>
                    <input 
                        type="text" 
                        id="owner_name" 
                        name="owner_name" 
                        value="{{ old('owner_name', $product->owner_name) }}"
                        required
                        class="w-full px-4 py-2.5 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500"
                    >
                </div>
                
                <div>
                    <label for="owner_whatsapp" class="block text-sm font-medium text-slate-700 mb-1.5">Nomor WhatsApp <span class="text-red-500">*</span></label>
                    <input 
                        type="text" 
                        id="owner_whatsapp" 
                        name="owner_whatsapp" 
                        value="{{ old('owner_whatsapp', $product->owner_whatsapp) }}"
                        required
                        class="w-full px-4 py-2.5 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500"
                    >
                </div>
            </div>
        </div>
        
        <!-- SEO -->
        <div class="bg-white rounded-xl shadow-md p-6">
            <h2 class="text-lg font-semibold text-slate-800 mb-4">SEO (Opsional)</h2>
            
            <div class="space-y-4">
                <div>
                    <label for="meta_title" class="block text-sm font-medium text-slate-700 mb-1.5">Meta Title</label>
                    <input 
                        type="text" 
                        id="meta_title" 
                        name="meta_title" 
                        value="{{ old('meta_title', $product->meta_title) }}"
                        class="w-full px-4 py-2.5 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500"
                    >
                </div>
                
                <div>
                    <label for="meta_description" class="block text-sm font-medium text-slate-700 mb-1.5">Meta Description</label>
                    <textarea 
                        id="meta_description" 
                        name="meta_description" 
                        rows="2"
                        class="w-full px-4 py-2.5 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500"
                    >{{ old('meta_description', $product->meta_description) }}</textarea>
                </div>
            </div>
        </div>
        
        <!-- Options -->
        <div class="bg-white rounded-xl shadow-md p-6">
            <h2 class="text-lg font-semibold text-slate-800 mb-4">Opsi Tambahan</h2>
            
            <label class="flex items-center gap-3 cursor-pointer">
                <input 
                    type="checkbox" 
                    name="is_featured" 
                    value="1"
                    {{ old('is_featured', $product->is_featured) ? 'checked' : '' }}
                    class="w-5 h-5 text-blue-600 border-slate-300 rounded focus:ring-blue-500"
                >
                <div>
                    <span class="font-medium text-slate-700">Jadikan Produk Unggulan</span>
                    <p class="text-sm text-slate-500">Produk akan ditampilkan di bagian "Produk Unggulan" di homepage</p>
                </div>
            </label>
        </div>
        
        <!-- Submit -->
        <div class="flex items-center justify-end gap-3">
            <a href="{{ route('admin.products.index') }}" class="px-6 py-2.5 text-slate-600 hover:text-slate-800 font-medium">
                Batal
            </a>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2.5 px-6 rounded-lg transition-all shadow-md hover:shadow-lg">
                Update Produk
            </button>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
function addFeature() {
    const container = document.getElementById('features-container');
    const div = document.createElement('div');
    div.className = 'flex gap-2';
    div.innerHTML = `
        <input 
            type="text" 
            name="features[]"
            class="flex-1 px-4 py-2.5 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500"
            placeholder="Fitur produk..."
        >
        <button type="button" onclick="this.parentElement.remove()" class="px-4 py-2 bg-red-100 text-red-600 rounded-lg hover:bg-red-200">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
    `;
    container.appendChild(div);
}
</script>
@endpush

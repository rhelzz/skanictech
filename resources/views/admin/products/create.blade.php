@extends('layouts.admin')

@section('title', 'Tambah Produk')
@section('header', 'Tambah Produk Baru')

@section('content')
<div class="max-w-5xl">
    <!-- Page Header with Guide -->
    <div class="bg-gradient-to-r from-blue-600 to-indigo-700 rounded-2xl p-6 mb-6 text-white">
        <div class="flex items-start gap-4">
            <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center flex-shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                </svg>
            </div>
            <div>
                <h1 class="text-xl font-bold mb-2">Buat Produk Baru</h1>
                <p class="text-blue-100 text-sm leading-relaxed">
                    Lengkapi form berikut untuk menambahkan produk ke katalog. Field dengan tanda <span class="text-yellow-300">*</span> wajib diisi. 
                    Pastikan informasi yang Anda masukkan akurat untuk hasil terbaik.
                </p>
            </div>
        </div>
    </div>

    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        
        <!-- Basic Info -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="bg-slate-50 px-6 py-4 border-b border-slate-200">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center">
                        <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-lg font-semibold text-slate-800">Informasi Dasar</h2>
                        <p class="text-sm text-slate-500">Detail utama produk yang akan ditampilkan</p>
                    </div>
                </div>
            </div>
            
            <div class="p-6 space-y-5">
                <div>
                    <label for="name" class="block text-sm font-medium text-slate-700 mb-1.5">
                        Nama Produk <span class="text-red-500">*</span>
                    </label>
                    <input 
                        type="text" 
                        id="name" 
                        name="name" 
                        value="{{ old('name') }}"
                        required
                        class="w-full px-4 py-3 border border-slate-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all @error('name') border-red-500 ring-red-100 @enderror"
                        placeholder="Contoh: Aplikasi POS Modern, Website Toko Online..."
                    >
                    <p class="mt-1.5 text-xs text-slate-500 flex items-center gap-1">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Gunakan nama yang jelas dan deskriptif (3-100 karakter)
                    </p>
                    @error('name')
                    <p class="mt-1 text-sm text-red-500 flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        {{ $message }}
                    </p>
                    @enderror
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label for="category_id" class="block text-sm font-medium text-slate-700 mb-1.5">
                            Kategori <span class="text-red-500">*</span>
                        </label>
                        <select 
                            id="category_id" 
                            name="category_id" 
                            required
                            class="w-full px-4 py-3 border border-slate-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white transition-all @error('category_id') border-red-500 @enderror"
                        >
                            <option value="">-- Pilih Kategori --</option>
                            @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                            @endforeach
                        </select>
                        <p class="mt-1.5 text-xs text-slate-500">Pilih kategori yang paling sesuai dengan produk</p>
                        @error('category_id')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="status" class="block text-sm font-medium text-slate-700 mb-1.5">Status Publikasi</label>
                        <select 
                            id="status" 
                            name="status"
                            class="w-full px-4 py-3 border border-slate-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white transition-all"
                        >
                            <option value="draft" {{ old('status', 'draft') === 'draft' ? 'selected' : '' }}>📝 Draft - Simpan dulu, publish nanti</option>
                            <option value="published" {{ old('status') === 'published' ? 'selected' : '' }}>✅ Published - Langsung tampil di katalog</option>
                        </select>
                        <p class="mt-1.5 text-xs text-slate-500">Draft tidak akan tampil di halaman publik</p>
                    </div>
                </div>
                
                <div>
                    <label for="short_description" class="block text-sm font-medium text-slate-700 mb-1.5">Deskripsi Singkat</label>
                    <textarea 
                        id="short_description" 
                        name="short_description" 
                        rows="2"
                        maxlength="500"
                        class="w-full px-4 py-3 border border-slate-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all resize-none"
                        placeholder="Ringkasan singkat tentang produk Anda dalam 1-2 kalimat..."
                    >{{ old('short_description') }}</textarea>
                    <div class="mt-1.5 flex items-center justify-between text-xs text-slate-500">
                        <span>Akan ditampilkan di card produk dan hasil pencarian</span>
                        <span id="short-desc-count">0/500</span>
                    </div>
                </div>
                
                <div>
                    <label for="description" class="block text-sm font-medium text-slate-700 mb-1.5">Deskripsi Lengkap</label>
                    <textarea 
                        id="description" 
                        name="description" 
                        rows="6"
                        class="w-full px-4 py-3 border border-slate-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all resize-none"
                        placeholder="Jelaskan produk secara detail:&#10;- Apa yang bisa dilakukan produk ini?&#10;- Untuk siapa produk ini cocok?&#10;- Apa keunggulan dibanding produk lain?&#10;- Teknologi apa yang digunakan?"
                    >{{ old('description') }}</textarea>
                    <p class="mt-1.5 text-xs text-slate-500">Deskripsi lengkap membantu calon pembeli memahami produk Anda</p>
                </div>
            </div>
        </div>
        
        <!-- Pricing -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="bg-slate-50 px-6 py-4 border-b border-slate-200">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center">
                        <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-lg font-semibold text-slate-800">Harga & Pembayaran</h2>
                        <p class="text-sm text-slate-500">Tentukan harga dan model pembayaran produk</p>
                    </div>
                </div>
            </div>
            
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label for="price" class="block text-sm font-medium text-slate-700 mb-1.5">
                            Harga <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-500 font-medium">Rp</span>
                            <input 
                                type="number" 
                                id="price" 
                                name="price" 
                                value="{{ old('price') }}"
                                required
                                min="0"
                                class="w-full pl-12 pr-4 py-3 border border-slate-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all @error('price') border-red-500 @enderror"
                                placeholder="500000"
                            >
                        </div>
                        <p class="mt-1.5 text-xs text-slate-500">Masukkan harga dalam Rupiah</p>
                        @error('price')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="price_type" class="block text-sm font-medium text-slate-700 mb-1.5">
                            Model Pembayaran <span class="text-red-500">*</span>
                        </label>
                        <select 
                            id="price_type" 
                            name="price_type" 
                            required
                            class="w-full px-4 py-3 border border-slate-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white transition-all"
                        >
                            <option value="one_time" {{ old('price_type', 'one_time') === 'one_time' ? 'selected' : '' }}>💰 Sekali Bayar (Lifetime)</option>
                            <option value="monthly" {{ old('price_type') === 'monthly' ? 'selected' : '' }}>📅 Bulanan (Subscription)</option>
                            <option value="yearly" {{ old('price_type') === 'yearly' ? 'selected' : '' }}>📆 Tahunan (Subscription)</option>
                        </select>
                        <p class="mt-1.5 text-xs text-slate-500">Model pembayaran akan ditampilkan bersama harga</p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Images -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="bg-slate-50 px-6 py-4 border-b border-slate-200">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center">
                        <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-lg font-semibold text-slate-800">Gambar Produk</h2>
                        <p class="text-sm text-slate-500">Upload gambar berkualitas tinggi untuk menarik pembeli</p>
                    </div>
                </div>
            </div>
            
            <div class="p-6 space-y-6">
                <!-- Main/Thumbnail Image - Single Upload -->
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">
                        Gambar Utama / Thumbnail <span class="text-red-500">*</span>
                    </label>
                    <div class="border-2 border-dashed border-blue-300 rounded-xl p-6 text-center hover:border-blue-500 hover:bg-blue-50/50 transition-all cursor-pointer" onclick="document.getElementById('main_image').click()">
                        <input 
                            type="file" 
                            id="main_image" 
                            name="main_image"
                            accept="image/jpeg,image/png,image/jpg,image/gif,image/webp"
                            required
                            class="hidden"
                            onchange="previewMainImage(this)"
                        >
                        <div id="main-preview" class="hidden mb-4 flex justify-center"></div>
                        <div id="main-placeholder">
                            <div class="w-16 h-16 bg-blue-100 rounded-xl flex items-center justify-center mx-auto mb-3">
                                <svg class="w-8 h-8 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <p class="text-slate-600 font-medium">Klik untuk upload gambar utama</p>
                            <p class="text-sm text-slate-500 mt-1">Gambar ini akan menjadi thumbnail produk</p>
                        </div>
                    </div>
                    <div class="mt-2 flex items-center gap-4 text-xs text-slate-500">
                        <span>✓ JPG, PNG, GIF, WebP</span>
                        <span>✓ Maksimal 2MB</span>
                        <span>✓ Rekomendasi: 800x600px atau 4:3</span>
                    </div>
                    <p class="mt-2 text-xs text-blue-600 flex items-center gap-1">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Gambar ini akan ditampilkan di card produk dan hasil pencarian
                    </p>
                    @error('main_image')
                    <p class="mt-1 text-sm text-red-500 flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        {{ $message }}
                    </p>
                    @enderror
                </div>

                <!-- Gallery Images - Multiple Upload -->
                <div class="pt-4 border-t border-slate-200">
                    <label class="block text-sm font-medium text-slate-700 mb-2">
                        Galeri Gambar Tambahan <span class="text-slate-400 text-xs">(Opsional)</span>
                    </label>
                    <div class="border-2 border-dashed border-slate-300 rounded-xl p-6 text-center hover:border-purple-500 hover:bg-purple-50/50 transition-all cursor-pointer" onclick="document.getElementById('gallery_images').click()">
                        <input 
                            type="file" 
                            id="gallery_images" 
                            name="gallery_images[]"
                            accept="image/jpeg,image/png,image/jpg,image/gif,image/webp"
                            multiple
                            class="hidden"
                            onchange="previewGallery(this)"
                        >
                        <div id="gallery-preview" class="hidden mb-4 grid grid-cols-2 md:grid-cols-4 gap-3"></div>
                        <div id="gallery-placeholder">
                            <div class="w-16 h-16 bg-slate-100 rounded-xl flex items-center justify-center mx-auto mb-3">
                                <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <p class="text-slate-600 font-medium">Klik untuk upload gambar tambahan</p>
                            <p class="text-sm text-slate-500 mt-1">Pilih beberapa gambar sekaligus (maks. 10 gambar)</p>
                        </div>
                    </div>
                    <div class="mt-2 flex items-center gap-4 text-xs text-slate-500">
                        <span>✓ JPG, PNG, GIF, WebP</span>
                        <span>✓ Maksimal 2MB per file</span>
                        <span>✓ Rekomendasi: 800x600px</span>
                    </div>
                    <p class="mt-2 text-xs text-slate-500">💡 Tips: Upload screenshot yang menunjukkan berbagai fitur dan tampilan produk dari berbagai sudut pandang.</p>
                    @error('gallery_images')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>
        
        <!-- Features -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="bg-slate-50 px-6 py-4 border-b border-slate-200">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 bg-amber-100 rounded-lg flex items-center justify-center">
                        <svg class="w-4 h-4 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-lg font-semibold text-slate-800">Fitur Produk</h2>
                        <p class="text-sm text-slate-500">Daftarkan fitur-fitur unggulan produk Anda</p>
                    </div>
                </div>
            </div>
            
            <div class="p-6">
                <div id="features-container" class="space-y-3">
                    <div class="flex gap-2 items-center">
                        <span class="w-8 h-8 bg-blue-100 text-blue-600 rounded-lg flex items-center justify-center text-sm font-medium flex-shrink-0">1</span>
                        <input 
                            type="text" 
                            name="features[]"
                            class="flex-1 px-4 py-3 border border-slate-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all"
                            placeholder="Contoh: Multi-user dengan role management"
                        >
                        <button type="button" onclick="addFeature()" class="p-3 bg-blue-600 text-white rounded-xl hover:bg-blue-700 transition-all shadow-md hover:shadow-lg">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                        </button>
                    </div>
                </div>
                <p class="mt-4 text-xs text-slate-500">💡 Tips: Tambahkan 5-10 fitur utama. Contoh: Dashboard analytics, Export PDF/Excel, Integrasi WhatsApp, dll.</p>
            </div>
        </div>
        
        <!-- Demo Info -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="bg-slate-50 px-6 py-4 border-b border-slate-200">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 bg-cyan-100 rounded-lg flex items-center justify-center">
                        <svg class="w-4 h-4 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 15l-2 5L9 9l11 4-5 2zm0 0l5 5M7.188 2.239l.777 2.897M5.136 7.965l-2.898-.777M13.95 4.05l-2.122 2.122m-5.657 5.656l-2.12 2.122"/>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-lg font-semibold text-slate-800">Akses Demo</h2>
                        <p class="text-sm text-slate-500">Berikan akses demo agar calon pembeli bisa mencoba langsung</p>
                    </div>
                </div>
            </div>
            
            <div class="p-6 space-y-5">
                <div class="p-4 bg-blue-50 rounded-xl border border-blue-200">
                    <div class="flex gap-3">
                        <svg class="w-5 h-5 text-blue-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <p class="text-sm text-blue-800">
                            Produk dengan demo aktif memiliki <strong>konversi 3x lebih tinggi</strong>. Pastikan akun demo selalu aktif dan data sample sudah tersedia.
                        </p>
                    </div>
                </div>
                
                <div>
                    <label for="demo_url" class="block text-sm font-medium text-slate-700 mb-1.5">URL Live Demo</label>
                    <input 
                        type="url" 
                        id="demo_url" 
                        name="demo_url" 
                        value="{{ old('demo_url') }}"
                        class="w-full px-4 py-3 border border-slate-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all"
                        placeholder="https://demo.produkanda.com"
                    >
                    <p class="mt-1.5 text-xs text-slate-500">URL halaman demo yang bisa diakses calon pembeli</p>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label for="demo_username" class="block text-sm font-medium text-slate-700 mb-1.5">Username/Email Demo</label>
                        <input 
                            type="text" 
                            id="demo_username" 
                            name="demo_username" 
                            value="{{ old('demo_username') }}"
                            class="w-full px-4 py-3 border border-slate-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all"
                            placeholder="demo@contoh.com"
                        >
                    </div>
                    
                    <div>
                        <label for="demo_password" class="block text-sm font-medium text-slate-700 mb-1.5">Password Demo</label>
                        <input 
                            type="text" 
                            id="demo_password" 
                            name="demo_password" 
                            value="{{ old('demo_password') }}"
                            class="w-full px-4 py-3 border border-slate-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all"
                            placeholder="demo123"
                        >
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Owner Info -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="bg-slate-50 px-6 py-4 border-b border-slate-200">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center">
                        <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-lg font-semibold text-slate-800">Informasi Kontak</h2>
                        <p class="text-sm text-slate-500">Detail kontak untuk calon pembeli menghubungi Anda</p>
                    </div>
                </div>
            </div>
            
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label for="owner_name" class="block text-sm font-medium text-slate-700 mb-1.5">
                            Nama Pemilik <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="text" 
                            id="owner_name" 
                            name="owner_name" 
                            value="{{ old('owner_name', auth()->user()->name) }}"
                            required
                            class="w-full px-4 py-3 border border-slate-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all"
                        >
                    </div>
                    
                    <div>
                        <label for="owner_whatsapp" class="block text-sm font-medium text-slate-700 mb-1.5">
                            Nomor WhatsApp <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="text" 
                            id="owner_whatsapp" 
                            name="owner_whatsapp" 
                            value="{{ old('owner_whatsapp', auth()->user()->phone) }}"
                            required
                            class="w-full px-4 py-3 border border-slate-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all"
                            placeholder="081234567890"
                        >
                        <p class="mt-1.5 text-xs text-slate-500">Format: 08xxx atau 628xxx</p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- SEO -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="bg-slate-50 px-6 py-4 border-b border-slate-200">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 bg-orange-100 rounded-lg flex items-center justify-center">
                        <svg class="w-4 h-4 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-lg font-semibold text-slate-800">SEO (Opsional)</h2>
                        <p class="text-sm text-slate-500">Optimasi untuk mesin pencari</p>
                    </div>
                </div>
            </div>
            
            <div class="p-6 space-y-5">
                <div>
                    <label for="meta_title" class="block text-sm font-medium text-slate-700 mb-1.5">Meta Title</label>
                    <input 
                        type="text" 
                        id="meta_title" 
                        name="meta_title" 
                        value="{{ old('meta_title') }}"
                        maxlength="60"
                        class="w-full px-4 py-3 border border-slate-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all"
                        placeholder="Judul untuk hasil pencarian (maks. 60 karakter)"
                    >
                </div>
                
                <div>
                    <label for="meta_description" class="block text-sm font-medium text-slate-700 mb-1.5">Meta Description</label>
                    <textarea 
                        id="meta_description" 
                        name="meta_description" 
                        rows="2"
                        maxlength="160"
                        class="w-full px-4 py-3 border border-slate-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all resize-none"
                        placeholder="Deskripsi untuk hasil pencarian (maks. 160 karakter)"
                    >{{ old('meta_description') }}</textarea>
                </div>
            </div>
        </div>
        
        <!-- Options -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="bg-slate-50 px-6 py-4 border-b border-slate-200">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 bg-violet-100 rounded-lg flex items-center justify-center">
                        <svg class="w-4 h-4 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-lg font-semibold text-slate-800">Opsi Tambahan</h2>
                        <p class="text-sm text-slate-500">Pengaturan tambahan untuk produk</p>
                    </div>
                </div>
            </div>
            
            <div class="p-6">
                <label class="flex items-start gap-4 cursor-pointer group">
                    <input 
                        type="checkbox" 
                        name="is_featured" 
                        value="1"
                        {{ old('is_featured') ? 'checked' : '' }}
                        class="w-5 h-5 text-blue-600 border-slate-300 rounded focus:ring-blue-500 mt-0.5"
                    >
                    <div>
                        <span class="font-medium text-slate-700 group-hover:text-blue-600 transition-colors">⭐ Jadikan Produk Unggulan</span>
                        <p class="text-sm text-slate-500 mt-1">
                            Produk akan ditampilkan di section khusus di homepage
                        </p>
                    </div>
                </label>
            </div>
        </div>
        
        <!-- Submit -->
        <div class="flex items-center justify-between gap-4 bg-white rounded-xl shadow-sm border border-slate-200 p-6">
            <div class="text-sm text-slate-500">
                <span class="text-red-500">*</span> Wajib diisi
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.products.index') }}" class="px-6 py-3 text-slate-600 hover:text-slate-800 font-medium hover:bg-slate-100 rounded-xl transition-all">
                    Batal
                </a>
                <button type="submit" class="px-8 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-semibold rounded-xl transition-all shadow-lg hover:shadow-xl">
                    Simpan Produk
                </button>
            </div>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
let featureCount = 1;

function addFeature() {
    featureCount++;
    const container = document.getElementById('features-container');
    const div = document.createElement('div');
    div.className = 'flex gap-2 items-center';
    div.innerHTML = `
        <span class="w-8 h-8 bg-blue-100 text-blue-600 rounded-lg flex items-center justify-center text-sm font-medium flex-shrink-0">${featureCount}</span>
        <input 
            type="text" 
            name="features[]"
            class="flex-1 px-4 py-3 border border-slate-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all"
            placeholder="Fitur produk..."
        >
        <button type="button" onclick="removeFeature(this)" class="p-3 bg-red-100 text-red-600 rounded-xl hover:bg-red-200 transition-all">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
    `;
    container.appendChild(div);
}

function removeFeature(btn) {
    btn.parentElement.remove();
    updateFeatureNumbers();
}

function updateFeatureNumbers() {
    const container = document.getElementById('features-container');
    const items = container.querySelectorAll('.flex');
    items.forEach((item, index) => {
        const badge = item.querySelector('span');
        badge.textContent = index + 1;
    });
    featureCount = items.length;
}

// Image preview for main/thumbnail image
function previewMainImage(input) {
    const preview = document.getElementById('main-preview');
    const placeholder = document.getElementById('main-placeholder');
    
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.innerHTML = '';
            preview.classList.remove('hidden');
            placeholder.classList.add('hidden');
            
            const wrapper = document.createElement('div');
            wrapper.className = 'relative inline-block';
            
            const img = document.createElement('img');
            img.src = e.target.result;
            img.className = 'w-48 h-36 object-cover rounded-lg shadow-lg border-4 border-blue-500';
            
            const badge = document.createElement('span');
            badge.className = 'absolute top-2 left-2 bg-blue-500 text-white text-xs px-3 py-1 rounded-full font-medium shadow-md';
            badge.innerHTML = '⭐ Gambar Utama';
            
            wrapper.appendChild(img);
            wrapper.appendChild(badge);
            preview.appendChild(wrapper);
        };
        reader.readAsDataURL(input.files[0]);
    }
}

// Image preview for gallery
function previewGallery(input) {
    const preview = document.getElementById('gallery-preview');
    const placeholder = document.getElementById('gallery-placeholder');
    
    if (input.files && input.files.length > 0) {
        preview.innerHTML = '';
        preview.classList.remove('hidden');
        placeholder.classList.add('hidden');
        
        Array.from(input.files).slice(0, 10).forEach((file, index) => {
            const reader = new FileReader();
            reader.onload = function(e) {
                const wrapper = document.createElement('div');
                wrapper.className = 'relative';
                
                const img = document.createElement('img');
                img.src = e.target.result;
                img.className = 'w-full h-24 object-cover rounded-lg shadow-md border-2 border-slate-200 hover:border-purple-400 transition-all';
                
                const numberBadge = document.createElement('span');
                numberBadge.className = 'absolute top-1 left-1 bg-purple-500 text-white text-xs w-6 h-6 rounded-full flex items-center justify-center font-bold';
                numberBadge.textContent = index + 1;
                
                wrapper.appendChild(img);
                wrapper.appendChild(numberBadge);
                preview.appendChild(wrapper);
            };
            reader.readAsDataURL(file);
        });
        
        if (input.files.length > 10) {
            const msg = document.createElement('p');
            msg.className = 'text-xs text-red-500 col-span-full text-center mt-2';
            msg.textContent = `⚠️ Maksimal 10 gambar. ${input.files.length - 10} gambar tidak akan diupload.`;
            preview.appendChild(msg);
        }
    } else {
        preview.classList.add('hidden');
        placeholder.classList.remove('hidden');
    }
}

// Character counter for short description
document.getElementById('short_description')?.addEventListener('input', function() {
    const counter = document.getElementById('short-desc-count');
    if (counter) counter.textContent = this.value.length + '/500';
});
</script>
@endpush

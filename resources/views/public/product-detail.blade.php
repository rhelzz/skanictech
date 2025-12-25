@extends('layouts.public')

@section('title', $product->meta_title ?? $product->name . ' - Skanic Tech')
@section('meta_description', $product->meta_description ?? $product->short_description)
@section('og_image', $product->main_image_url)

@section('content')
<div class="bg-white">
    <!-- Breadcrumb -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
        <nav class="flex items-center gap-2 text-sm">
            <a href="{{ route('home') }}" class="text-slate-500 hover:text-blue-600">Beranda</a>
            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
            <a href="{{ route('catalog') }}" class="text-slate-500 hover:text-blue-600">Katalog</a>
            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
            <span class="text-slate-700 font-medium truncate">{{ $product->name }}</span>
        </nav>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-16">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12">
            <!-- Gallery -->
            <div>
                @php
                    $galleryImages = $product->gallery_urls ?? [];
                    $firstImage = !empty($galleryImages) ? $galleryImages[0] : asset('images/placeholder-product.png');
                @endphp
                
                <div class="relative mb-4">
                    <img 
                        src="{{ $firstImage }}" 
                        alt="{{ $product->name }}" 
                        class="w-full aspect-[4/3] object-cover rounded-xl shadow-lg"
                        id="main-image"
                    >
                    <div class="absolute top-4 left-4 flex flex-col gap-2">
                        {{-- Badge Diskon 80% --}}
                        <span class="inline-flex items-center gap-1.5 bg-gradient-to-r from-red-500 to-pink-500 text-white text-sm font-bold px-3 py-1.5 rounded-lg shadow-lg">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5 2a1 1 0 011 1v1h1a1 1 0 010 2H6v1a1 1 0 01-2 0V6H3a1 1 0 010-2h1V3a1 1 0 011-1zm0 10a1 1 0 011 1v1h1a1 1 0 110 2H6v1a1 1 0 11-2 0v-1H3a1 1 0 110-2h1v-1a1 1 0 011-1zM12 2a1 1 0 01.967.744L14.146 7.2 17.5 9.134a1 1 0 010 1.732l-3.354 1.935-1.18 4.455a1 1 0 01-1.933 0L9.854 12.8 6.5 10.866a1 1 0 010-1.732l3.354-1.935 1.18-4.455A1 1 0 0112 2z" clip-rule="evenodd"/>
                            </svg>
                            Diskon 80%
                        </span>
                        @if($product->is_featured)
                        <span class="inline-flex items-center gap-1.5 bg-gradient-to-r from-yellow-500 to-orange-500 text-white text-sm font-semibold px-3 py-1.5 rounded-lg shadow-lg">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                            Produk Unggulan
                        </span>
                        @endif
                    </div>
                </div>
                
                @if(count($galleryImages) > 1)
                <div class="grid grid-cols-5 gap-2">
                    @foreach($galleryImages as $index => $image)
                    <button 
                        onclick="changeMainImage('{{ $image }}')"
                        class="aspect-square rounded-lg overflow-hidden border-2 {{ $index === 0 ? 'border-blue-500' : 'border-slate-200' }} hover:border-blue-500 transition-colors"
                    >
                        <img src="{{ $image }}" alt="" class="w-full h-full object-cover">
                    </button>
                    @endforeach
                </div>
                @endif
            </div>
            
            <!-- Product Info -->
            <div>
                <div class="mb-4">
                    <span class="inline-block bg-blue-100 text-blue-700 text-sm font-medium px-3 py-1 rounded-full">
                        {{ $product->category->name ?? 'Uncategorized' }}
                    </span>
                </div>
                
                <h1 class="text-3xl md:text-4xl font-bold text-slate-800 mb-4">{{ $product->name }}</h1>
                
                @php
                    // Hitung harga awal dari harga akhir: Harga Awal = Harga Akhir / (1 - 0.8)
                    $discountPercentage = 80;
                    $finalPrice = $product->price;
                    $originalPrice = $finalPrice / (1 - ($discountPercentage / 100));
                @endphp
                <div class="mb-6">
                    <div class="flex items-center gap-3 mb-2">
                        <span class="text-xl text-slate-400 line-through">
                            Rp {{ number_format($originalPrice, 0, ',', '.') }}
                        </span>
                        <span class="inline-flex items-center gap-1 bg-red-100 text-red-600 text-sm font-bold px-2.5 py-1 rounded-lg">
                            <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5 2a1 1 0 011 1v1h1a1 1 0 010 2H6v1a1 1 0 01-2 0V6H3a1 1 0 010-2h1V3a1 1 0 011-1zm0 10a1 1 0 011 1v1h1a1 1 0 110 2H6v1a1 1 0 11-2 0v-1H3a1 1 0 110-2h1v-1a1 1 0 011-1zM12 2a1 1 0 01.967.744L14.146 7.2 17.5 9.134a1 1 0 010 1.732l-3.354 1.935-1.18 4.455a1 1 0 01-1.933 0L9.854 12.8 6.5 10.866a1 1 0 010-1.732l3.354-1.935 1.18-4.455A1 1 0 0112 2z" clip-rule="evenodd"/>
                            </svg>
                            -{{ $discountPercentage }}%
                        </span>
                    </div>
                    <div class="flex items-baseline gap-2">
                        <span class="text-4xl font-bold text-blue-600">Rp {{ number_format($finalPrice, 0, ',', '.') }}</span>
                        <span class="text-sm text-slate-500">{{ $product->price_type_label }}</span>
                    </div>
                </div>
                
                @if($product->short_description)
                <p class="text-slate-600 mb-6">{{ $product->short_description }}</p>
                @endif
                
                <!-- Owner Info -->
                <div class="flex items-center gap-4 p-4 bg-slate-50 rounded-xl mb-6">
                    <div class="w-12 h-12 bg-blue-600 rounded-full flex items-center justify-center text-white font-bold text-lg">
                        {{ substr($product->owner_name, 0, 1) }}
                    </div>
                    <div>
                        <p class="font-semibold text-slate-800">{{ $product->owner_name }}</p>
                        <p class="text-sm text-slate-500">Pemilik Produk</p>
                    </div>
                </div>
                
                <!-- CTA Buttons -->
                <div class="flex flex-col sm:flex-row gap-3 mb-8">
                    @if($product->demo_url)
                    <a 
                        href="{{ $product->demo_url }}" 
                        target="_blank"
                        onclick="trackDemo()"
                        class="flex-1 flex items-center justify-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded-lg transition-all duration-200 shadow-md hover:shadow-lg"
                    >
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                        Live Demo
                    </a>
                    @endif
                    
                    <a 
                        href="{{ $product->whatsapp_url }}" 
                        target="_blank"
                        onclick="trackWhatsapp()"
                        class="flex-1 flex items-center justify-center gap-2 bg-green-500 hover:bg-green-600 text-white font-semibold py-3 px-6 rounded-lg transition-all duration-200 shadow-md hover:shadow-lg"
                    >
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/>
                        </svg>
                        Hubungi via WhatsApp
                    </a>
                </div>
                
                <!-- Demo Account -->
                @if($product->demo_username || $product->demo_password)
                <div class="p-4 bg-blue-50 border border-blue-100 rounded-xl mb-6">
                    <h3 class="font-semibold text-slate-800 mb-3 flex items-center gap-2">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/>
                        </svg>
                        Akun Demo
                    </h3>
                    <div class="space-y-2">
                        @if($product->demo_username)
                        <div class="flex items-center justify-between bg-white p-2 rounded-lg">
                            <div>
                                <span class="text-xs text-slate-500">Username</span>
                                <p class="font-mono text-sm text-slate-700" id="demo-username">{{ $product->demo_username }}</p>
                            </div>
                            <button 
                                onclick="copyToClipboard('{{ $product->demo_username }}', this)"
                                class="text-blue-600 hover:text-blue-700 p-2"
                            >
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                                </svg>
                            </button>
                        </div>
                        @endif
                        @if($product->demo_password)
                        <div class="flex items-center justify-between bg-white p-2 rounded-lg">
                            <div>
                                <span class="text-xs text-slate-500">Password</span>
                                <p class="font-mono text-sm text-slate-700" id="demo-password">{{ $product->demo_password }}</p>
                            </div>
                            <button 
                                onclick="copyToClipboard('{{ $product->demo_password }}', this)"
                                class="text-blue-600 hover:text-blue-700 p-2"
                            >
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                                </svg>
                            </button>
                        </div>
                        @endif
                    </div>
                </div>
                @endif
                
                <!-- Stats -->
                <div class="flex items-center gap-6 text-sm text-slate-500">
                    <span class="flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                        {{ number_format($product->views_count) }} views
                    </span>
                </div>
            </div>
        </div>
        
        <!-- Description & Features -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mt-12">
            <!-- Description -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-xl shadow-md p-6 lg:p-8">
                    <h2 class="text-xl font-bold text-slate-800 mb-4">Deskripsi Produk</h2>
                    <div class="prose prose-slate max-w-none">
                        {!! nl2br(e($product->description)) !!}
                    </div>
                </div>
            </div>
            
            <!-- Features -->
            <div>
                @if(is_array($product->features) && count($product->features) > 0)
                <div class="bg-white rounded-xl shadow-md p-6">
                    <h2 class="text-xl font-bold text-slate-800 mb-4">Fitur Unggulan</h2>
                    <ul class="space-y-3">
                        @foreach($product->features as $feature)
                        <li class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-green-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span class="text-slate-600">{{ $feature }}</span>
                        </li>
                        @endforeach
                    </ul>
                </div>
                @endif
            </div>
        </div>
        
        <!-- Related Products -->
        @if($relatedProducts->count() > 0)
        <div class="mt-16">
            <h2 class="text-2xl font-bold text-slate-800 mb-6">Produk Terkait</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($relatedProducts as $related)
                    @include('components.product-card', ['product' => $related])
                @endforeach
            </div>
        </div>
        @endif
    </div>
</div>
@endsection

@push('scripts')
<script>
function changeMainImage(src) {
    document.getElementById('main-image').src = src;
}

function copyToClipboard(text, btn) {
    navigator.clipboard.writeText(text).then(() => {
        const originalHtml = btn.innerHTML;
        btn.innerHTML = '<svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>';
        setTimeout(() => {
            btn.innerHTML = originalHtml;
        }, 2000);
    });
}

function trackDemo() {
    fetch('{{ route('track.demo', $product->id) }}', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Content-Type': 'application/json'
        }
    });
}

function trackWhatsapp() {
    fetch('{{ route('track.whatsapp', $product->id) }}', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Content-Type': 'application/json'
        }
    });
}
</script>
@endpush

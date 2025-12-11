@php
    $isFeatured = $featured ?? false;
@endphp

<a href="{{ route('product.detail', $product->slug) }}" class="product-card block group bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 h-full border border-slate-100 hover:border-blue-200 hover:-translate-y-1">
    <div class="relative overflow-hidden aspect-[4/3]">
        <img 
            src="{{ $product->main_image_url }}" 
            alt="{{ $product->name }}" 
            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
        >
        {{-- Overlay gradient --}}
        <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
        
        {{-- Badges Container --}}
        <div class="absolute top-3 left-3 right-3 flex items-start justify-between gap-2">
            <div class="flex flex-col gap-2">
                @if($product->is_featured || $isFeatured)
                <span class="inline-flex items-center gap-1 bg-gradient-to-r from-yellow-500 to-orange-500 text-white text-xs font-semibold px-2.5 py-1 rounded-lg shadow-lg">
                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                    </svg>
                    Unggulan
                </span>
                @endif
                
                @if($product->demo_url)
                <span class="inline-flex items-center gap-1 bg-green-500 text-white text-xs font-semibold px-2.5 py-1 rounded-lg shadow-lg">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                    </svg>
                    Demo
                </span>
                @endif
            </div>
            
            <span class="bg-white/95 backdrop-blur-sm text-slate-700 text-xs font-medium px-2.5 py-1 rounded-lg shadow-sm">
                {{ $product->category->name ?? 'Uncategorized' }}
            </span>
        </div>
        
        {{-- Quick View Button --}}
        <div class="absolute inset-x-0 bottom-0 p-3 translate-y-full group-hover:translate-y-0 transition-transform duration-300">
            <span class="flex items-center justify-center gap-2 w-full bg-white/95 backdrop-blur-sm text-blue-600 font-semibold py-2 rounded-lg">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                </svg>
                Lihat Detail
            </span>
        </div>
    </div>
    
    <div class="p-5">
        {{-- Owner Badge --}}
        @if($product->owner_name)
        <div class="flex items-center gap-2 mb-3">
            <div class="w-6 h-6 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-full flex items-center justify-center">
                <span class="text-white text-xs font-bold">{{ strtoupper(substr($product->owner_name, 0, 1)) }}</span>
            </div>
            <span class="text-xs text-slate-500">{{ $product->owner_name }}</span>
        </div>
        @endif
        
        <h3 class="font-bold text-slate-800 mb-2 group-hover:text-blue-600 transition-colors line-clamp-2 text-lg leading-tight">
            {{ $product->name }}
        </h3>
        
        @if($product->short_description)
        <p class="text-sm text-slate-500 mb-4 line-clamp-2 leading-relaxed">{{ $product->short_description }}</p>
        @endif
        
        <div class="flex items-end justify-between pt-3 border-t border-slate-100">
            <div>
                <span class="text-xs text-slate-400 block mb-0.5">Mulai dari</span>
                <span class="text-xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-indigo-600">
                    Rp {{ number_format($product->price, 0, ',', '.') }}
                </span>
                <span class="text-xs text-slate-500 block mt-0.5">
                    {{ $product->price_type_label }}
                </span>
            </div>
            
            <div class="flex items-center gap-3 text-xs text-slate-400">
                <span class="flex items-center gap-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                    {{ number_format($product->views_count ?? 0) }}
                </span>
            </div>
        </div>
    </div>
</a>

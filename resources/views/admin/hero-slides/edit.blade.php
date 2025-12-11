@extends('layouts.admin')

@section('title', 'Edit Hero Slide')
@section('header', 'Edit Hero Slide')

@section('content')
<div class="max-w-2xl">
    <form action="{{ route('admin.hero-slides.update', $heroSlide) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')
        
        <div class="bg-white rounded-xl shadow-md p-6">
            <div class="space-y-4">
                <div>
                    <label for="title" class="block text-sm font-medium text-slate-700 mb-1.5">Judul <span class="text-red-500">*</span></label>
                    <input type="text" id="title" name="title" value="{{ old('title', $heroSlide->title) }}" required class="w-full px-4 py-2.5 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
                
                <div>
                    <label for="description" class="block text-sm font-medium text-slate-700 mb-1.5">Deskripsi</label>
                    <textarea id="description" name="description" rows="3" class="w-full px-4 py-2.5 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">{{ old('description', $heroSlide->description) }}</textarea>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1.5">Gambar Saat Ini</label>
                    <div class="w-48 aspect-square">
                        <img src="{{ $heroSlide->image_url }}" alt="" class="w-full h-full object-cover rounded-lg">
                    </div>
                </div>
                
                <div>
                    <label for="image" class="block text-sm font-medium text-slate-700 mb-1.5">Ganti Gambar (1:1)</label>
                    <input type="file" id="image" name="image" accept="image/*" class="w-full px-4 py-2.5 border border-slate-300 rounded-lg file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-blue-50 file:text-blue-700">
                    <p class="mt-1 text-xs text-slate-500">⚠️ Wajib aspek rasio 1:1 (kotak). Ukuran rekomendasi: 800x800 pixels atau 1000x1000 pixels</p>
                </div>
                
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="cta_text" class="block text-sm font-medium text-slate-700 mb-1.5">Teks Tombol CTA</label>
                        <input type="text" id="cta_text" name="cta_text" value="{{ old('cta_text', $heroSlide->cta_text) }}" class="w-full px-4 py-2.5 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div>
                        <label for="cta_url" class="block text-sm font-medium text-slate-700 mb-1.5">URL Tombol CTA</label>
                        <input type="text" id="cta_url" name="cta_url" value="{{ old('cta_url', $heroSlide->cta_url) }}" class="w-full px-4 py-2.5 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                </div>
                
                <div>
                    <label for="order" class="block text-sm font-medium text-slate-700 mb-1.5">Urutan</label>
                    <input type="number" id="order" name="order" value="{{ old('order', $heroSlide->order) }}" min="0" class="w-full px-4 py-2.5 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
                
                <div>
                    <label class="flex items-center gap-3 cursor-pointer">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', $heroSlide->is_active) ? 'checked' : '' }} class="w-5 h-5 text-blue-600 border-slate-300 rounded focus:ring-blue-500">
                        <span class="font-medium text-slate-700">Aktifkan Slide</span>
                    </label>
                </div>
            </div>
        </div>
        
        <div class="flex items-center justify-end gap-3">
            <a href="{{ route('admin.hero-slides.index') }}" class="px-6 py-2.5 text-slate-600 hover:text-slate-800 font-medium">Batal</a>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2.5 px-6 rounded-lg transition-all shadow-md hover:shadow-lg">Update</button>
        </div>
    </form>
</div>
@endsection

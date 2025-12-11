@extends('layouts.admin')

@section('title', 'Tambah Promo Banner')
@section('header', 'Tambah Promo Banner')

@section('content')
<div class="max-w-2xl">
    <form action="{{ route('admin.promo-banners.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        
        <div class="bg-white rounded-xl shadow-md p-6">
            <div class="space-y-4">
                <div>
                    <label for="title" class="block text-sm font-medium text-slate-700 mb-1.5">Teks Banner <span class="text-red-500">*</span></label>
                    <input type="text" id="title" name="title" value="{{ old('title') }}" required class="w-full px-4 py-2.5 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Diskon 50% untuk semua produk!">
                    <p class="mt-1 text-xs text-slate-500">Teks promo yang akan ditampilkan</p>
                </div>
                
                <div>
                    <label for="url" class="block text-sm font-medium text-slate-700 mb-1.5">Link (URL)</label>
                    <input type="url" id="url" name="url" value="{{ old('url') }}" class="w-full px-4 py-2.5 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="https://...">
                    <p class="mt-1 text-xs text-slate-500">Link tujuan ketika banner diklik (opsional)</p>
                </div>
                
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="start_date" class="block text-sm font-medium text-slate-700 mb-1.5">Tanggal Mulai</label>
                        <input type="date" id="start_date" name="start_date" value="{{ old('start_date') }}" class="w-full px-4 py-2.5 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div>
                        <label for="end_date" class="block text-sm font-medium text-slate-700 mb-1.5">Tanggal Berakhir</label>
                        <input type="date" id="end_date" name="end_date" value="{{ old('end_date') }}" class="w-full px-4 py-2.5 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                </div>
                
                <div>
                    <label for="position" class="block text-sm font-medium text-slate-700 mb-1.5">Posisi Banner</label>
                    <select id="position" name="position" class="w-full px-4 py-2.5 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="top" {{ old('position') == 'top' ? 'selected' : '' }}>Atas (Top) - Di bawah navbar</option>
                        <option value="middle" {{ old('position', 'middle') == 'middle' ? 'selected' : '' }}>Tengah (Middle) - Setelah kategori</option>
                        <option value="bottom" {{ old('position') == 'bottom' ? 'selected' : '' }}>Bawah (Bottom) - Sebelum footer</option>
                    </select>
                </div>
                
                <div>
                    <label for="order" class="block text-sm font-medium text-slate-700 mb-1.5">Urutan</label>
                    <input type="number" id="order" name="order" value="{{ old('order', 0) }}" min="0" class="w-full px-4 py-2.5 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
                
                <div>
                    <label class="flex items-center gap-3 cursor-pointer">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }} class="w-5 h-5 text-blue-600 border-slate-300 rounded focus:ring-blue-500">
                        <span class="font-medium text-slate-700">Aktifkan Banner</span>
                    </label>
                </div>
            </div>
        </div>
        
        <div class="flex items-center justify-end gap-3">
            <a href="{{ route('admin.promo-banners.index') }}" class="px-6 py-2.5 text-slate-600 hover:text-slate-800 font-medium">Batal</a>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2.5 px-6 rounded-lg transition-all shadow-md hover:shadow-lg">Simpan</button>
        </div>
    </form>
</div>
@endsection

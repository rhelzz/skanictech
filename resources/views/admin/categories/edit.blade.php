@extends('layouts.admin')

@section('title', 'Edit Kategori')
@section('header', 'Edit Kategori')

@section('content')
<div class="max-w-2xl">
    <form action="{{ route('admin.categories.update', $category) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')
        
        <div class="bg-white rounded-xl shadow-md p-6">
            <div class="space-y-4">
                <div>
                    <label for="name" class="block text-sm font-medium text-slate-700 mb-1.5">Nama Kategori <span class="text-red-500">*</span></label>
                    <input type="text" id="name" name="name" value="{{ old('name', $category->name) }}" required class="w-full px-4 py-2.5 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
                
                <div>
                    <label for="description" class="block text-sm font-medium text-slate-700 mb-1.5">Deskripsi</label>
                    <textarea id="description" name="description" rows="3" class="w-full px-4 py-2.5 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">{{ old('description', $category->description) }}</textarea>
                </div>
                
                <div>
                    <label for="icon" class="block text-sm font-medium text-slate-700 mb-1.5">Icon (Emoji)</label>
                    <input type="text" id="icon" name="icon" value="{{ old('icon', $category->icon) }}" class="w-full px-4 py-2.5 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
                
                @if($category->image)
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1.5">Gambar Saat Ini</label>
                    <img src="{{ $category->image_url }}" alt="" class="w-24 h-24 object-cover rounded-lg">
                </div>
                @endif
                
                <div>
                    <label for="image" class="block text-sm font-medium text-slate-700 mb-1.5">Ganti Gambar</label>
                    <input type="file" id="image" name="image" accept="image/*" class="w-full px-4 py-2.5 border border-slate-300 rounded-lg file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-blue-50 file:text-blue-700">
                </div>
                
                <div>
                    <label for="order" class="block text-sm font-medium text-slate-700 mb-1.5">Urutan</label>
                    <input type="number" id="order" name="order" value="{{ old('order', $category->order) }}" min="0" class="w-full px-4 py-2.5 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
                
                <div>
                    <label class="flex items-center gap-3 cursor-pointer">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', $category->is_active) ? 'checked' : '' }} class="w-5 h-5 text-blue-600 border-slate-300 rounded focus:ring-blue-500">
                        <span class="font-medium text-slate-700">Aktifkan Kategori</span>
                    </label>
                </div>
            </div>
        </div>
        
        <div class="flex items-center justify-end gap-3">
            <a href="{{ route('admin.categories.index') }}" class="px-6 py-2.5 text-slate-600 hover:text-slate-800 font-medium">Batal</a>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2.5 px-6 rounded-lg transition-all shadow-md hover:shadow-lg">Update</button>
        </div>
    </form>
</div>
@endsection

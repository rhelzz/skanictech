@extends('layouts.admin')

@section('title', 'Kelola Kategori')
@section('header', 'Kelola Kategori')

@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <p class="text-slate-600">Kelola kategori produk digital</p>
        <a href="{{ route('admin.categories.create') }}" class="flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2.5 px-5 rounded-lg transition-all shadow-md hover:shadow-lg">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Tambah Kategori
        </a>
    </div>
    
    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        @if($categories->count() > 0)
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-200">
                        <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Kategori</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Deskripsi</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Produk</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Status</th>
                        <th class="px-4 py-3 text-center text-xs font-semibold text-slate-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach($categories as $category)
                    <tr class="hover:bg-slate-50">
                        <td class="px-4 py-4">
                            <div class="flex items-center gap-3">
                                @if($category->icon)
                                <span class="text-2xl">{{ $category->icon }}</span>
                                @else
                                <div class="w-10 h-10 bg-blue-100 text-blue-600 rounded-lg flex items-center justify-center">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                                    </svg>
                                </div>
                                @endif
                                <span class="font-medium text-slate-800">{{ $category->name }}</span>
                            </div>
                        </td>
                        <td class="px-4 py-4 text-sm text-slate-500">
                            {{ Str::limit($category->description, 50) ?? '-' }}
                        </td>
                        <td class="px-4 py-4 text-sm text-slate-600">
                            {{ $category->products_count }} produk
                        </td>
                        <td class="px-4 py-4">
                            <span class="badge {{ $category->is_active ? 'badge-success' : 'badge-warning' }}">
                                {{ $category->is_active ? 'Aktif' : 'Nonaktif' }}
                            </span>
                        </td>
                        <td class="px-4 py-4">
                            <div class="flex items-center justify-center gap-1">
                                <a href="{{ route('admin.categories.edit', $category) }}" class="p-2 text-slate-400 hover:text-blue-600 hover:bg-blue-50 rounded-lg" title="Edit">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                </a>
                                <form action="{{ route('admin.categories.toggle-status', $category) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" class="p-2 text-slate-400 hover:text-yellow-600 hover:bg-yellow-50 rounded-lg" title="Toggle Status">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l4-4 4 4m0 6l-4 4-4-4"/>
                                        </svg>
                                    </button>
                                </form>
                                <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin?')">
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
        @else
        <div class="text-center py-16">
            <h3 class="text-lg font-medium text-slate-700 mb-2">Belum ada kategori</h3>
            <a href="{{ route('admin.categories.create') }}" class="text-blue-600 hover:text-blue-700">Tambah kategori pertama →</a>
        </div>
        @endif
    </div>
</div>
@endsection

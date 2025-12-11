@extends('layouts.admin')

@section('title', 'Hero Slides')
@section('header', 'Kelola Hero Slides')

@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <p class="text-slate-600">Kelola banner slider di homepage</p>
        <a href="{{ route('admin.hero-slides.create') }}" class="flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2.5 px-5 rounded-lg transition-all shadow-md hover:shadow-lg">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Tambah Slide
        </a>
    </div>
    
    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        @if($slides->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 p-4">
            @foreach($slides as $slide)
            <div class="relative rounded-xl overflow-hidden shadow-md group">
                <img src="{{ $slide->image_url }}" alt="{{ $slide->title }}" class="w-full h-48 object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/30 to-transparent">
                    <div class="absolute bottom-0 left-0 right-0 p-4">
                        <h3 class="font-semibold text-white truncate">{{ $slide->title }}</h3>
                        <div class="flex items-center gap-2 mt-2">
                            <span class="badge {{ $slide->is_active ? 'badge-success' : 'badge-warning' }}">
                                {{ $slide->is_active ? 'Aktif' : 'Nonaktif' }}
                            </span>
                            <span class="text-xs text-white/70">Order: {{ $slide->order }}</span>
                        </div>
                    </div>
                </div>
                <div class="absolute top-2 right-2 flex gap-1 opacity-0 group-hover:opacity-100 transition-opacity">
                    <a href="{{ route('admin.hero-slides.edit', $slide) }}" class="p-2 bg-white rounded-lg shadow hover:bg-blue-50">
                        <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                    </a>
                    <form action="{{ route('admin.hero-slides.destroy', $slide) }}" method="POST" class="inline" onsubmit="return confirm('Hapus slide ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="p-2 bg-white rounded-lg shadow hover:bg-red-50">
                            <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="text-center py-16">
            <h3 class="text-lg font-medium text-slate-700 mb-2">Belum ada hero slide</h3>
            <a href="{{ route('admin.hero-slides.create') }}" class="text-blue-600 hover:text-blue-700">Tambah slide pertama →</a>
        </div>
        @endif
    </div>
</div>
@endsection

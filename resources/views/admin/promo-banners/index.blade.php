@extends('layouts.admin')

@section('title', 'Promo Banners')
@section('header', 'Kelola Promo Banners')

@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <p class="text-slate-600">Kelola banner promosi di homepage</p>
        <a href="{{ route('admin.promo-banners.create') }}" class="flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2.5 px-5 rounded-lg transition-all shadow-md hover:shadow-lg">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Tambah Banner
        </a>
    </div>
    
    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        @if($banners->count() > 0)
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-200">
                        <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Banner</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Periode</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Status</th>
                        <th class="px-4 py-3 text-center text-xs font-semibold text-slate-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach($banners as $banner)
                    <tr class="hover:bg-slate-50">
                        <td class="px-4 py-4">
                            <div>
                                <p class="font-medium text-slate-800">{{ $banner->title }}</p>
                                @if($banner->url)
                                <p class="text-xs text-slate-500 truncate max-w-[300px]">{{ $banner->url }}</p>
                                @endif
                            </div>
                        </td>
                        <td class="px-4 py-4 text-sm text-slate-600">
                            @if($banner->start_date || $banner->end_date)
                            {{ $banner->start_date?->format('d/m/Y') ?? '-' }} - {{ $banner->end_date?->format('d/m/Y') ?? '-' }}
                            @else
                            <span class="text-slate-400">Tanpa batas waktu</span>
                            @endif
                        </td>
                        <td class="px-4 py-4">
                            @php
                                $now = now();
                                $isExpired = $banner->end_date && $banner->end_date < $now;
                                $isNotStarted = $banner->start_date && $banner->start_date > $now;
                            @endphp
                            @if(!$banner->is_active)
                            <span class="badge badge-warning">Nonaktif</span>
                            @elseif($isExpired)
                            <span class="badge badge-danger">Expired</span>
                            @elseif($isNotStarted)
                            <span class="badge badge-info">Terjadwal</span>
                            @else
                            <span class="badge badge-success">Aktif</span>
                            @endif
                        </td>
                        <td class="px-4 py-4">
                            <div class="flex items-center justify-center gap-1">
                                <a href="{{ route('admin.promo-banners.edit', $banner) }}" class="p-2 text-slate-400 hover:text-blue-600 hover:bg-blue-50 rounded-lg" title="Edit">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                </a>
                                <form action="{{ route('admin.promo-banners.destroy', $banner) }}" method="POST" class="inline" onsubmit="return confirm('Hapus banner ini?')">
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
            <h3 class="text-lg font-medium text-slate-700 mb-2">Belum ada promo banner</h3>
            <a href="{{ route('admin.promo-banners.create') }}" class="text-blue-600 hover:text-blue-700">Tambah banner pertama →</a>
        </div>
        @endif
    </div>
</div>
@endsection

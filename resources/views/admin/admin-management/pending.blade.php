@extends('layouts.admin')

@section('title', 'Persetujuan Admin')
@section('header', 'Menunggu Persetujuan')

@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <p class="text-slate-600">Admin yang menunggu persetujuan pendaftaran</p>
        <a href="{{ route('admin.admin-management.index') }}" class="text-blue-600 hover:text-blue-700 font-medium">
            ← Kembali ke Daftar Admin
        </a>
    </div>
    
    @if(session('success'))
    <div class="bg-green-100 border border-green-300 text-green-700 px-4 py-3 rounded-lg">
        {{ session('success') }}
    </div>
    @endif
    
    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        @if($pendingAdmins->count() > 0)
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-200">
                        <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Pendaftar</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Kontak</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Tanggal Daftar</th>
                        <th class="px-4 py-3 text-center text-xs font-semibold text-slate-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach($pendingAdmins as $admin)
                    <tr class="hover:bg-slate-50">
                        <td class="px-4 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full bg-gradient-to-br from-yellow-400 to-orange-500 flex items-center justify-center text-white font-semibold">
                                    {{ strtoupper(substr($admin->name, 0, 1)) }}
                                </div>
                                <div>
                                    <p class="font-medium text-slate-800">{{ $admin->name }}</p>
                                    @if($admin->bio)
                                    <p class="text-xs text-slate-500 truncate max-w-[200px]">{{ $admin->bio }}</p>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td class="px-4 py-4">
                            <p class="text-sm text-slate-600">{{ $admin->email }}</p>
                            @if($admin->phone)
                            <p class="text-xs text-slate-500">{{ $admin->phone }}</p>
                            @endif
                        </td>
                        <td class="px-4 py-4 text-sm text-slate-600">
                            {{ $admin->created_at->format('d M Y H:i') }}
                            <span class="block text-xs text-slate-400">{{ $admin->created_at->diffForHumans() }}</span>
                        </td>
                        <td class="px-4 py-4">
                            <div class="flex items-center justify-center gap-2">
                                <form action="{{ route('admin.admin-management.approve', $admin) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" class="flex items-center gap-1 px-3 py-1.5 bg-green-100 hover:bg-green-200 text-green-700 font-medium rounded-lg text-sm transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                        </svg>
                                        Setujui
                                    </button>
                                </form>
                                <form action="{{ route('admin.admin-management.reject', $admin) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menolak pendaftaran ini?')">
                                    @csrf
                                    <button type="submit" class="flex items-center gap-1 px-3 py-1.5 bg-red-100 hover:bg-red-200 text-red-700 font-medium rounded-lg text-sm transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                        </svg>
                                        Tolak
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
            <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
            </div>
            <h3 class="text-lg font-medium text-slate-700 mb-2">Tidak ada pendaftaran yang menunggu</h3>
            <p class="text-slate-500">Semua pendaftaran admin telah diproses</p>
        </div>
        @endif
    </div>
</div>
@endsection

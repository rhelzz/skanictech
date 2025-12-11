@extends('layouts.admin')

@section('title', 'Kelola Admin')
@section('header', 'Kelola Admin')

@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <div class="flex items-center gap-4">
            <p class="text-slate-600">Kelola semua admin terdaftar</p>
            @if($pendingCount > 0)
            <a href="{{ route('admin.admin-management.pending') }}" class="badge badge-warning">
                {{ $pendingCount }} menunggu persetujuan
            </a>
            @endif
        </div>
        <a href="{{ route('admin.admin-management.create') }}" class="flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2.5 px-5 rounded-lg transition-all shadow-md hover:shadow-lg">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Tambah Admin
        </a>
    </div>
    
    @if(session('success'))
    <div class="bg-green-100 border border-green-300 text-green-700 px-4 py-3 rounded-lg">
        {{ session('success') }}
    </div>
    @endif
    
    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        @if($admins->count() > 0)
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-200">
                        <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Admin</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Kontak</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Role</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Produk</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Status</th>
                        <th class="px-4 py-3 text-center text-xs font-semibold text-slate-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach($admins as $admin)
                    <tr class="hover:bg-slate-50">
                        <td class="px-4 py-4">
                            <div class="flex items-center gap-3">
                                @if($admin->avatar)
                                <img src="{{ Storage::url($admin->avatar) }}" alt="" class="w-10 h-10 rounded-full object-cover">
                                @else
                                <div class="w-10 h-10 rounded-full bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center text-white font-semibold">
                                    {{ strtoupper(substr($admin->name, 0, 1)) }}
                                </div>
                                @endif
                                <div>
                                    <p class="font-medium text-slate-800">{{ $admin->name }}</p>
                                    <p class="text-xs text-slate-500">Bergabung: {{ $admin->created_at->format('d M Y') }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-4 py-4">
                            <p class="text-sm text-slate-600">{{ $admin->email }}</p>
                            @if($admin->phone)
                            <p class="text-xs text-slate-500">{{ $admin->phone }}</p>
                            @endif
                        </td>
                        <td class="px-4 py-4">
                            <span class="badge {{ $admin->role === 'super_admin' ? 'badge-primary' : 'badge-info' }}">
                                {{ $admin->role === 'super_admin' ? 'Super Admin' : 'Admin' }}
                            </span>
                        </td>
                        <td class="px-4 py-4 text-sm text-slate-600">
                            {{ $admin->products_count }} produk
                        </td>
                        <td class="px-4 py-4">
                            <span class="badge {{ $admin->isActive() ? 'badge-success' : 'badge-warning' }}">
                                {{ $admin->isActive() ? 'Aktif' : 'Nonaktif' }}
                            </span>
                        </td>
                        <td class="px-4 py-4">
                            <div class="flex items-center justify-center gap-1">
                                <a href="{{ route('admin.admin-management.edit', $admin) }}" class="p-2 text-slate-400 hover:text-blue-600 hover:bg-blue-50 rounded-lg" title="Edit">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                </a>
                                @if($admin->id !== auth()->id())
                                <form action="{{ route('admin.admin-management.toggle-status', $admin) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" class="p-2 text-slate-400 hover:text-yellow-600 hover:bg-yellow-50 rounded-lg" title="{{ $admin->isActive() ? 'Nonaktifkan' : 'Aktifkan' }}">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l4-4 4 4m0 6l-4 4-4-4"/>
                                        </svg>
                                    </button>
                                </form>
                                <form action="{{ route('admin.admin-management.destroy', $admin) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus admin ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 text-slate-400 hover:text-red-600 hover:bg-red-50 rounded-lg" title="Hapus">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                    </button>
                                </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        @if($admins->hasPages())
        <div class="px-4 py-3 border-t">
            {{ $admins->links() }}
        </div>
        @endif
        @else
        <div class="text-center py-16">
            <h3 class="text-lg font-medium text-slate-700 mb-2">Belum ada admin lain</h3>
            <a href="{{ route('admin.admin-management.create') }}" class="text-blue-600 hover:text-blue-700">Tambah admin baru →</a>
        </div>
        @endif
    </div>
</div>
@endsection

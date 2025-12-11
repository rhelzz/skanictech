@extends('layouts.admin')

@section('title', 'Tambah Admin')
@section('header', 'Tambah Admin Baru')

@section('content')
<div class="max-w-2xl">
    <form action="{{ route('admin.admin-management.store') }}" method="POST" class="space-y-6">
        @csrf
        
        <div class="bg-white rounded-xl shadow-md p-6">
            <div class="space-y-4">
                <div>
                    <label for="name" class="block text-sm font-medium text-slate-700 mb-1.5">Nama Lengkap <span class="text-red-500">*</span></label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" required class="w-full px-4 py-2.5 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    @error('name')<p class="mt-1 text-sm text-red-500">{{ $message }}</p>@enderror
                </div>
                
                <div>
                    <label for="email" class="block text-sm font-medium text-slate-700 mb-1.5">Email <span class="text-red-500">*</span></label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required class="w-full px-4 py-2.5 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    @error('email')<p class="mt-1 text-sm text-red-500">{{ $message }}</p>@enderror
                </div>
                
                <div>
                    <label for="phone" class="block text-sm font-medium text-slate-700 mb-1.5">Nomor WhatsApp</label>
                    <input type="text" id="phone" name="phone" value="{{ old('phone') }}" class="w-full px-4 py-2.5 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="628xxxxxxxxxx">
                </div>
                
                <div>
                    <label for="role" class="block text-sm font-medium text-slate-700 mb-1.5">Role <span class="text-red-500">*</span></label>
                    <select id="role" name="role" required class="w-full px-4 py-2.5 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin (Pemilik Produk)</option>
                        <option value="super_admin" {{ old('role') == 'super_admin' ? 'selected' : '' }}>Super Admin</option>
                    </select>
                    @error('role')<p class="mt-1 text-sm text-red-500">{{ $message }}</p>@enderror
                </div>
                
                <div>
                    <label for="password" class="block text-sm font-medium text-slate-700 mb-1.5">Password <span class="text-red-500">*</span></label>
                    <input type="password" id="password" name="password" required class="w-full px-4 py-2.5 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    @error('password')<p class="mt-1 text-sm text-red-500">{{ $message }}</p>@enderror
                </div>
                
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-slate-700 mb-1.5">Konfirmasi Password <span class="text-red-500">*</span></label>
                    <input type="password" id="password_confirmation" name="password_confirmation" required class="w-full px-4 py-2.5 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
                
                <div>
                    <label class="flex items-center gap-3 cursor-pointer">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }} class="w-5 h-5 text-blue-600 border-slate-300 rounded focus:ring-blue-500">
                        <span class="font-medium text-slate-700">Aktifkan Langsung</span>
                    </label>
                    <p class="mt-1 text-xs text-slate-500">Jika dicentang, admin akan langsung aktif tanpa perlu approval</p>
                </div>
            </div>
        </div>
        
        <div class="flex items-center justify-end gap-3">
            <a href="{{ route('admin.admin-management.index') }}" class="px-6 py-2.5 text-slate-600 hover:text-slate-800 font-medium">Batal</a>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2.5 px-6 rounded-lg transition-all shadow-md hover:shadow-lg">Simpan</button>
        </div>
    </form>
</div>
@endsection

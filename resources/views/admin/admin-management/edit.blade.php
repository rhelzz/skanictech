@extends('layouts.admin')

@section('title', 'Edit Admin')
@section('header', 'Edit Admin')

@section('content')
<div class="max-w-2xl">
    <form action="{{ route('admin.admin-management.update', $user) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')
        
        <div class="bg-white rounded-xl shadow-md p-6">
            <div class="flex items-center gap-4 mb-6 pb-4 border-b">
                @if($user->avatar)
                <img src="{{ Storage::url($user->avatar) }}" alt="" class="w-16 h-16 rounded-full object-cover">
                @else
                <div class="w-16 h-16 rounded-full bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center text-white text-2xl font-bold">
                    {{ strtoupper(substr($user->name, 0, 1)) }}
                </div>
                @endif
                <div>
                    <h3 class="text-lg font-semibold text-slate-800">{{ $user->name }}</h3>
                    <p class="text-slate-500">{{ $user->email }}</p>
                    <p class="text-xs text-slate-400">Bergabung: {{ $user->created_at->format('d M Y') }}</p>
                </div>
            </div>
            
            <div class="space-y-4">
                <div>
                    <label for="name" class="block text-sm font-medium text-slate-700 mb-1.5">Nama Lengkap <span class="text-red-500">*</span></label>
                    <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required class="w-full px-4 py-2.5 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    @error('name')<p class="mt-1 text-sm text-red-500">{{ $message }}</p>@enderror
                </div>
                
                <div>
                    <label for="email" class="block text-sm font-medium text-slate-700 mb-1.5">Email <span class="text-red-500">*</span></label>
                    <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required class="w-full px-4 py-2.5 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    @error('email')<p class="mt-1 text-sm text-red-500">{{ $message }}</p>@enderror
                </div>
                
                <div>
                    <label for="phone" class="block text-sm font-medium text-slate-700 mb-1.5">Nomor WhatsApp</label>
                    <input type="text" id="phone" name="phone" value="{{ old('phone', $user->phone) }}" class="w-full px-4 py-2.5 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
                
                <div>
                    <label for="role" class="block text-sm font-medium text-slate-700 mb-1.5">Role <span class="text-red-500">*</span></label>
                    <select id="role" name="role" required class="w-full px-4 py-2.5 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" {{ $user->id === auth()->id() ? 'disabled' : '' }}>
                        <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin (Pemilik Produk)</option>
                        <option value="super_admin" {{ old('role', $user->role) == 'super_admin' ? 'selected' : '' }}>Super Admin</option>
                    </select>
                    @if($user->id === auth()->id())
                    <p class="mt-1 text-xs text-slate-500">Anda tidak dapat mengubah role sendiri</p>
                    @endif
                </div>
                
                <div>
                    <label for="password" class="block text-sm font-medium text-slate-700 mb-1.5">Password Baru</label>
                    <input type="password" id="password" name="password" class="w-full px-4 py-2.5 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <p class="mt-1 text-xs text-slate-500">Biarkan kosong jika tidak ingin mengubah password</p>
                    @error('password')<p class="mt-1 text-sm text-red-500">{{ $message }}</p>@enderror
                </div>
                
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-slate-700 mb-1.5">Konfirmasi Password Baru</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" class="w-full px-4 py-2.5 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
                
                @if($user->id !== auth()->id())
                <div>
                    <label for="status" class="block text-sm font-medium text-slate-700 mb-1.5">Status Akun</label>
                    <select id="status" name="status" class="w-full px-4 py-2.5 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="active" {{ old('status', $user->status) == 'active' ? 'selected' : '' }}>Aktif</option>
                        <option value="inactive" {{ old('status', $user->status) == 'inactive' ? 'selected' : '' }}>Nonaktif</option>
                        <option value="pending" {{ old('status', $user->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                    </select>
                </div>
                @endif
            </div>
        </div>
        
        <div class="flex items-center justify-between">
            <div>
                @if($user->id !== auth()->id())
                <p class="text-sm text-slate-500">
                    Produk: <span class="font-medium text-slate-700">{{ $user->products()->count() }}</span>
                </p>
                @endif
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.admin-management.index') }}" class="px-6 py-2.5 text-slate-600 hover:text-slate-800 font-medium">Batal</a>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2.5 px-6 rounded-lg transition-all shadow-md hover:shadow-lg">Update</button>
            </div>
        </div>
    </form>
</div>
@endsection

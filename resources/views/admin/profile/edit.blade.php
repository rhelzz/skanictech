@extends('layouts.admin')

@section('title', 'Profil Saya')
@section('header', 'Profil Saya')

@section('content')
<div class="max-w-3xl space-y-6">
    @if(session('success'))
    <div class="bg-green-100 border border-green-300 text-green-700 px-4 py-3 rounded-lg">
        {{ session('success') }}
    </div>
    @endif
    
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white rounded-xl shadow-md p-6 text-center">
            <div class="relative inline-block">
                @if(auth()->user()->avatar)
                <img src="{{ Storage::url(auth()->user()->avatar) }}" alt="" class="w-32 h-32 rounded-full object-cover mx-auto border-4 border-blue-100">
                @else
                <div class="w-32 h-32 rounded-full bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center mx-auto text-white text-4xl font-bold">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
                @endif
            </div>
            <h2 class="mt-4 text-xl font-bold text-slate-800">{{ auth()->user()->name }}</h2>
            <p class="text-slate-500">{{ auth()->user()->email }}</p>
            <span class="inline-block mt-2 badge {{ auth()->user()->role === 'super_admin' ? 'badge-primary' : 'badge-success' }}">
                {{ auth()->user()->role === 'super_admin' ? 'Super Admin' : 'Admin' }}
            </span>
            <div class="mt-4 pt-4 border-t">
                <p class="text-sm text-slate-500">Bergabung: {{ auth()->user()->created_at->format('d M Y') }}</p>
            </div>
        </div>
        
        <div class="md:col-span-2 space-y-6">
            <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-xl shadow-md p-6">
                @csrf
                @method('PUT')
                
                <h3 class="text-lg font-semibold text-slate-800 mb-4">Informasi Profil</h3>
                
                <div class="space-y-4">
                    <div>
                        <label for="name" class="block text-sm font-medium text-slate-700 mb-1.5">Nama Lengkap</label>
                        <input type="text" id="name" name="name" value="{{ old('name', auth()->user()->name) }}" required class="w-full px-4 py-2.5 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        @error('name')<p class="mt-1 text-sm text-red-500">{{ $message }}</p>@enderror
                    </div>
                    
                    <div>
                        <label for="email" class="block text-sm font-medium text-slate-700 mb-1.5">Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email', auth()->user()->email) }}" required class="w-full px-4 py-2.5 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        @error('email')<p class="mt-1 text-sm text-red-500">{{ $message }}</p>@enderror
                    </div>
                    
                    <div>
                        <label for="phone" class="block text-sm font-medium text-slate-700 mb-1.5">Nomor WhatsApp</label>
                        <input type="text" id="phone" name="phone" value="{{ old('phone', auth()->user()->phone) }}" class="w-full px-4 py-2.5 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="628xxxxxxxxxx">
                        <p class="mt-1 text-xs text-slate-500">Format: 628xxxxxxxxxx (tanpa +)</p>
                    </div>
                    
                    <div>
                        <label for="bio" class="block text-sm font-medium text-slate-700 mb-1.5">Bio</label>
                        <textarea id="bio" name="bio" rows="3" class="w-full px-4 py-2.5 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Ceritakan sedikit tentang Anda...">{{ old('bio', auth()->user()->bio) }}</textarea>
                    </div>
                    
                    <div>
                        <label for="avatar" class="block text-sm font-medium text-slate-700 mb-1.5">Foto Profil</label>
                        <input type="file" id="avatar" name="avatar" accept="image/*" class="w-full px-4 py-2.5 border border-slate-300 rounded-lg file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-blue-50 file:text-blue-700">
                    </div>
                </div>
                
                <div class="mt-6">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2.5 px-6 rounded-lg transition-all">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
            
            <form action="{{ route('admin.profile.password') }}" method="POST" class="bg-white rounded-xl shadow-md p-6">
                @csrf
                @method('PUT')
                
                <h3 class="text-lg font-semibold text-slate-800 mb-4">Ganti Password</h3>
                
                <div class="space-y-4">
                    <div>
                        <label for="current_password" class="block text-sm font-medium text-slate-700 mb-1.5">Password Saat Ini</label>
                        <input type="password" id="current_password" name="current_password" required class="w-full px-4 py-2.5 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        @error('current_password')<p class="mt-1 text-sm text-red-500">{{ $message }}</p>@enderror
                    </div>
                    
                    <div>
                        <label for="password" class="block text-sm font-medium text-slate-700 mb-1.5">Password Baru</label>
                        <input type="password" id="password" name="password" required class="w-full px-4 py-2.5 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        @error('password')<p class="mt-1 text-sm text-red-500">{{ $message }}</p>@enderror
                    </div>
                    
                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-slate-700 mb-1.5">Konfirmasi Password Baru</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" required class="w-full px-4 py-2.5 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                </div>
                
                <div class="mt-6">
                    <button type="submit" class="bg-slate-600 hover:bg-slate-700 text-white font-semibold py-2.5 px-6 rounded-lg transition-all">
                        Ganti Password
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

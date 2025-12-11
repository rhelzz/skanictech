@extends('layouts.admin')

@section('title', 'Pengaturan Website')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">Pengaturan Website</h1>
            <p class="text-slate-600 mt-1">Kelola informasi dan pengaturan website</p>
        </div>
    </div>

    @if(session('success'))
    <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg flex items-center gap-2">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
        </svg>
        {{ session('success') }}
    </div>
    @endif

    <form action="{{ route('admin.settings.update') }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        <!-- Informasi Website -->
        <div class="bg-white rounded-xl shadow-sm p-6 border border-slate-200">
            <h2 class="text-lg font-semibold text-slate-800 mb-4 flex items-center gap-2">
                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                Informasi Website
            </h2>

            <div class="grid md:grid-cols-2 gap-4">
                <div>
                    <label for="site_name" class="block text-sm font-medium text-slate-700 mb-2">Nama Website</label>
                    <input 
                        type="text" 
                        name="site_name" 
                        id="site_name" 
                        value="{{ old('site_name', $settings['site_name'] ?? 'Skanic Tech') }}"
                        class="w-full px-4 py-2.5 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        required
                    >
                    @error('site_name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="contact_email" class="block text-sm font-medium text-slate-700 mb-2">Email Kontak</label>
                    <input 
                        type="email" 
                        name="contact_email" 
                        id="contact_email" 
                        value="{{ old('contact_email', $settings['contact_email'] ?? '') }}"
                        class="w-full px-4 py-2.5 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    >
                    @error('contact_email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="md:col-span-2">
                    <label for="site_description" class="block text-sm font-medium text-slate-700 mb-2">Deskripsi Website</label>
                    <textarea 
                        name="site_description" 
                        id="site_description" 
                        rows="3"
                        class="w-full px-4 py-2.5 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    >{{ old('site_description', $settings['site_description'] ?? '') }}</textarea>
                    @error('site_description')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Informasi Kontak -->
        <div class="bg-white rounded-xl shadow-sm p-6 border border-slate-200">
            <h2 class="text-lg font-semibold text-slate-800 mb-4 flex items-center gap-2">
                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
                Informasi Kontak
            </h2>

            <div class="grid md:grid-cols-2 gap-4">
                <div>
                    <label for="contact_phone" class="block text-sm font-medium text-slate-700 mb-2">Nomor Telepon</label>
                    <input 
                        type="text" 
                        name="contact_phone" 
                        id="contact_phone" 
                        value="{{ old('contact_phone', $settings['contact_phone'] ?? '') }}"
                        placeholder="+62 812-3456-7890"
                        class="w-full px-4 py-2.5 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    >
                    @error('contact_phone')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="contact_address" class="block text-sm font-medium text-slate-700 mb-2">Alamat</label>
                    <input 
                        type="text" 
                        name="contact_address" 
                        id="contact_address" 
                        value="{{ old('contact_address', $settings['contact_address'] ?? '') }}"
                        class="w-full px-4 py-2.5 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    >
                    @error('contact_address')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="bg-white rounded-xl shadow-sm p-6 border border-slate-200">
            <h2 class="text-lg font-semibold text-slate-800 mb-4 flex items-center gap-2">
                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z"/>
                </svg>
                Footer Website
            </h2>

            <div>
                <label for="footer_text" class="block text-sm font-medium text-slate-700 mb-2">Teks Footer (Copyright)</label>
                <input 
                    type="text" 
                    name="footer_text" 
                    id="footer_text" 
                    value="{{ old('footer_text', $settings['footer_text'] ?? '') }}"
                    placeholder="© 2024 Skanic Tech. All rights reserved."
                    class="w-full px-4 py-2.5 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                >
                @error('footer_text')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Social Media -->
        <div class="bg-white rounded-xl shadow-sm p-6 border border-slate-200">
            <h2 class="text-lg font-semibold text-slate-800 mb-4 flex items-center gap-2">
                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"/>
                </svg>
                Media Sosial
            </h2>

            <div class="grid md:grid-cols-2 gap-4">
                <div>
                    <label for="facebook_url" class="block text-sm font-medium text-slate-700 mb-2">Facebook URL</label>
                    <input 
                        type="url" 
                        name="facebook_url" 
                        id="facebook_url" 
                        value="{{ old('facebook_url', $settings['facebook_url'] ?? '') }}"
                        placeholder="https://facebook.com/..."
                        class="w-full px-4 py-2.5 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    >
                    @error('facebook_url')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="twitter_url" class="block text-sm font-medium text-slate-700 mb-2">Twitter URL</label>
                    <input 
                        type="url" 
                        name="twitter_url" 
                        id="twitter_url" 
                        value="{{ old('twitter_url', $settings['twitter_url'] ?? '') }}"
                        placeholder="https://twitter.com/..."
                        class="w-full px-4 py-2.5 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    >
                    @error('twitter_url')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="instagram_url" class="block text-sm font-medium text-slate-700 mb-2">Instagram URL</label>
                    <input 
                        type="url" 
                        name="instagram_url" 
                        id="instagram_url" 
                        value="{{ old('instagram_url', $settings['instagram_url'] ?? '') }}"
                        placeholder="https://instagram.com/..."
                        class="w-full px-4 py-2.5 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    >
                    @error('instagram_url')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="linkedin_url" class="block text-sm font-medium text-slate-700 mb-2">LinkedIn URL</label>
                    <input 
                        type="url" 
                        name="linkedin_url" 
                        id="linkedin_url" 
                        value="{{ old('linkedin_url', $settings['linkedin_url'] ?? '') }}"
                        placeholder="https://linkedin.com/company/..."
                        class="w-full px-4 py-2.5 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    >
                    @error('linkedin_url')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="github_url" class="block text-sm font-medium text-slate-700 mb-2">GitHub URL</label>
                    <input 
                        type="url" 
                        name="github_url" 
                        id="github_url" 
                        value="{{ old('github_url', $settings['github_url'] ?? '') }}"
                        placeholder="https://github.com/..."
                        class="w-full px-4 py-2.5 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    >
                    @error('github_url')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="flex justify-end gap-3">
            <button 
                type="submit" 
                class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2.5 rounded-lg transition-colors flex items-center gap-2"
            >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection

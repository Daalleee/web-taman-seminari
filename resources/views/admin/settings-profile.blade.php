@extends('layouts.admin')

@section('title', 'Profil Sekolah')

@section('content')
<div class="max-w-3xl">
    <form action="{{ route('admin.settings.profile') }}" method="POST" class="space-y-6">
        @csrf
        <div class="bg-white rounded-2xl shadow-sm border border-primary/5 overflow-hidden">
            <div class="px-6 py-5 border-b border-primary/5 bg-surface-container-low">
                <h3 class="font-headline-sm text-headline-sm text-primary">Informasi Sekolah</h3>
                <p class="text-sm text-on-surface-variant mt-1">Nama, deskripsi, dan teks hero banner.</p>
            </div>
            <div class="p-6 space-y-5">
                <div>
                    <label class="block text-sm font-medium text-on-surface mb-1.5">Nama Sekolah</label>
                    <input type="text" name="school_name" value="{{ $settings['school_name'] ?? 'Taman Seminari' }}" class="block w-full px-4 py-2.5 border border-primary/10 rounded-xl focus:ring-2 focus:ring-secondary/30 focus:border-secondary sm:text-sm bg-surface-bright focus:bg-white transition-colors">
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-on-surface mb-1.5">Judul Hero Banner</label>
                        <input type="text" name="hero_title" value="{{ $settings['hero_title'] ?? 'Membentuk Hati yang Beriman & Pikiran yang Cemerlang' }}" class="block w-full px-4 py-2.5 border border-primary/10 rounded-xl focus:ring-2 focus:ring-secondary/30 focus:border-secondary sm:text-sm bg-surface-bright focus:bg-white transition-colors">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-on-surface mb-1.5">Subjudul Hero Banner</label>
                        <input type="text" name="hero_subtitle" value="{{ $settings['hero_subtitle'] ?? '' }}" class="block w-full px-4 py-2.5 border border-primary/10 rounded-xl focus:ring-2 focus:ring-secondary/30 focus:border-secondary sm:text-sm bg-surface-bright focus:bg-white transition-colors">
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-on-surface mb-1.5">Teks Tentang Kami</label>
                    <p class="text-xs text-on-surface-variant mb-2">Deskripsi singkat yang tampil di section Tentang halaman utama.</p>
                    <textarea name="about_text" rows="4" class="block w-full px-4 py-2.5 border border-primary/10 rounded-xl focus:ring-2 focus:ring-secondary/30 focus:border-secondary sm:text-sm bg-surface-bright focus:bg-white transition-colors" placeholder="Tulis deskripsi tentang sekolah...">{{ $settings['about_text'] ?? '' }}</textarea>
                </div>
            </div>
        </div>

        <div class="flex justify-end">
            <button type="submit" class="px-6 py-3 text-sm font-medium text-white bg-primary hover:bg-primary-container rounded-xl shadow-sm transition-all">
                Simpan Profil
            </button>
        </div>
    </form>
</div>
@endsection
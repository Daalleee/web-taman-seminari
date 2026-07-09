@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
    <div class="bg-white rounded-2xl p-6 shadow-sm border border-primary/5 flex items-center gap-4 transition-all duration-300 hover:-translate-y-1 hover:shadow-md">
        <div class="w-14 h-14 rounded-xl bg-primary/10 text-primary flex items-center justify-center">
            <span class="material-symbols-outlined text-[28px]">photo_library</span>
        </div>
        <div>
            <p class="text-sm font-medium text-on-surface-variant">Banner</p>
            <h3 class="text-2xl font-bold text-on-surface">{{ $stats['banners'] ?? 0 }}</h3>
        </div>
    </div>

    <div class="bg-white rounded-2xl p-6 shadow-sm border border-primary/5 flex items-center gap-4 transition-all duration-300 hover:-translate-y-1 hover:shadow-md">
        <div class="w-14 h-14 rounded-xl bg-primary/10 text-primary flex items-center justify-center">
            <span class="material-symbols-outlined text-[28px]">newspaper</span>
        </div>
        <div>
            <p class="text-sm font-medium text-on-surface-variant">Berita</p>
            <h3 class="text-2xl font-bold text-on-surface">{{ $stats['news'] ?? 0 }}</h3>
        </div>
    </div>

    <div class="bg-white rounded-2xl p-6 shadow-sm border border-primary/5 flex items-center gap-4 transition-all duration-300 hover:-translate-y-1 hover:shadow-md">
        <div class="w-14 h-14 rounded-xl bg-secondary/10 text-secondary flex items-center justify-center">
            <span class="material-symbols-outlined text-[28px]">celebration</span>
        </div>
        <div>
            <p class="text-sm font-medium text-on-surface-variant">Kegiatan</p>
            <h3 class="text-2xl font-bold text-on-surface">{{ $stats['activities'] ?? 0 }}</h3>
        </div>
    </div>

    <div class="bg-white rounded-2xl p-6 shadow-sm border border-primary/5 flex items-center gap-4 transition-all duration-300 hover:-translate-y-1 hover:shadow-md">
        <div class="w-14 h-14 rounded-xl bg-primary/10 text-primary flex items-center justify-center">
            <span class="material-symbols-outlined text-[28px]">wall_art</span>
        </div>
        <div>
            <p class="text-sm font-medium text-on-surface-variant">Galeri</p>
            <h3 class="text-2xl font-bold text-on-surface">{{ $stats['galleries'] ?? 0 }}</h3>
        </div>
    </div>

    <div class="bg-white rounded-2xl p-6 shadow-sm border border-primary/5 flex items-center gap-4 transition-all duration-300 hover:-translate-y-1 hover:shadow-md">
        <div class="w-14 h-14 rounded-xl bg-secondary/10 text-secondary flex items-center justify-center">
            <span class="material-symbols-outlined text-[28px]">mail</span>
        </div>
        <div>
            <p class="text-sm font-medium text-on-surface-variant">Pesan Masuk</p>
            <h3 class="text-2xl font-bold text-on-surface">{{ $stats['messages'] ?? 0 }}</h3>
            @if(($stats['unreadMessages'] ?? 0) > 0)
                <p class="text-xs text-red-500 font-medium mt-0.5">{{ $stats['unreadMessages'] }} belum dibaca</p>
            @endif
        </div>
    </div>
</div>

<div class="mt-8 bg-white rounded-2xl shadow-sm border border-primary/5 p-8 text-center">
    <div class="w-20 h-20 bg-primary/5 text-primary rounded-full flex items-center justify-center mx-auto mb-4">
        <span class="material-symbols-outlined text-[40px]">admin_panel_settings</span>
    </div>
    <h2 class="font-headline-sm text-headline-sm text-primary mb-2">Selamat Datang di Dashboard CMS!</h2>
    <p class="text-on-surface-variant max-w-lg mx-auto text-sm">Gunakan menu di sidebar untuk mengelola konten website Taman Seminari. Semua perubahan akan langsung tampil di website utama.</p>
</div>
@endsection
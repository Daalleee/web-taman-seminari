@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
    
    <!-- Stat Card -->
    <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100 flex items-center gap-4 transition-transform hover:-translate-y-1 duration-300">
        <div class="w-14 h-14 rounded-xl bg-blue-50 text-blue-500 flex items-center justify-center">
            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
        </div>
        <div>
            <p class="text-sm font-medium text-slate-500">Banners</p>
            <h3 class="text-2xl font-bold text-slate-800">{{ $stats['banners'] ?? 0 }}</h3>
        </div>
    </div>

    <!-- Stat Card -->
    <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100 flex items-center gap-4 transition-transform hover:-translate-y-1 duration-300">
        <div class="w-14 h-14 rounded-xl bg-purple-50 text-purple-500 flex items-center justify-center">
            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5a2.5 2.5 0 00-2.5-2.5H15"></path></svg>
        </div>
        <div>
            <p class="text-sm font-medium text-slate-500">Berita</p>
            <h3 class="text-2xl font-bold text-slate-800">{{ $stats['news'] ?? 0 }}</h3>
        </div>
    </div>

    <!-- Stat Card -->
    <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100 flex items-center gap-4 transition-transform hover:-translate-y-1 duration-300">
        <div class="w-14 h-14 rounded-xl bg-indigo-50 text-indigo-500 flex items-center justify-center">
            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
        </div>
        <div>
            <p class="text-sm font-medium text-slate-500">Kegiatan</p>
            <h3 class="text-2xl font-bold text-slate-800">{{ $stats['activities'] ?? 0 }}</h3>
        </div>
    </div>

    <!-- Stat Card -->
    <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100 flex items-center gap-4 transition-transform hover:-translate-y-1 duration-300">
        <div class="w-14 h-14 rounded-xl bg-teal-50 text-teal-500 flex items-center justify-center">
            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
        </div>
        <div>
            <p class="text-sm font-medium text-slate-500">Galeri Foto</p>
            <h3 class="text-2xl font-bold text-slate-800">{{ $stats['galleries'] ?? 0 }}</h3>
        </div>
    </div>

</div>

<div class="mt-8 bg-white rounded-2xl shadow-sm border border-slate-100 p-8 text-center">
    <div class="w-20 h-20 bg-indigo-50 text-indigo-500 rounded-full flex items-center justify-center mx-auto mb-4">
        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
    </div>
    <h2 class="text-2xl font-bold text-slate-800 mb-2">Selamat Datang di Dashboard CMS!</h2>
    <p class="text-slate-500 max-w-lg mx-auto">Gunakan menu di sidebar untuk mengelola konten website Taman Seminari seperti Berita, Kegiatan, Galeri, dan FAQ. Semua perubahan akan langsung tampil di website utama.</p>
</div>
@endsection

@extends('layouts.admin')

@section('title', 'Pengaturan Website')

@section('content')
<div class="max-w-4xl">
    <form action="{{ route('admin.settings') }}" method="POST" class="space-y-6">
        @csrf
        
        <!-- General Info Section -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
            <div class="px-6 py-5 border-b border-slate-100 bg-slate-50">
                <h3 class="text-lg font-semibold text-slate-800">Informasi Umum</h3>
                <p class="text-sm text-slate-500">Perbarui informasi dasar tentang sekolah.</p>
            </div>
            <div class="p-6 space-y-5">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Nama Sekolah</label>
                    <input type="text" name="school_name" value="{{ $settings['school_name'] ?? 'Taman Seminari' }}" class="block w-full px-4 py-2.5 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm bg-slate-50 focus:bg-white transition-colors">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Teks Tentang Kami</label>
                    <textarea name="about_text" rows="4" class="block w-full px-4 py-2.5 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm bg-slate-50 focus:bg-white transition-colors">{{ $settings['about_text'] ?? '' }}</textarea>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Visi</label>
                        <textarea name="vision" rows="3" class="block w-full px-4 py-2.5 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm bg-slate-50 focus:bg-white transition-colors">{{ $settings['vision'] ?? '' }}</textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Misi</label>
                        <textarea name="mission" rows="3" class="block w-full px-4 py-2.5 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm bg-slate-50 focus:bg-white transition-colors">{{ $settings['mission'] ?? '' }}</textarea>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contact & Maps Section -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
            <div class="px-6 py-5 border-b border-slate-100 bg-slate-50">
                <h3 class="text-lg font-semibold text-slate-800">Kontak & Peta Lokasi</h3>
                <p class="text-sm text-slate-500">Informasi ini akan ditampilkan di bagian footer dan halaman kontak publik.</p>
            </div>
            <div class="p-6 space-y-5">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Nomor Telepon / WhatsApp</label>
                        <input type="text" name="phone" value="{{ $settings['phone'] ?? '' }}" class="block w-full px-4 py-2.5 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm bg-slate-50 focus:bg-white transition-colors" placeholder="+62 812...">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Alamat Email</label>
                        <input type="email" name="email" value="{{ $settings['email'] ?? '' }}" class="block w-full px-4 py-2.5 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm bg-slate-50 focus:bg-white transition-colors" placeholder="info@tamanseminari.com">
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Alamat Lengkap</label>
                    <textarea name="address" rows="2" class="block w-full px-4 py-2.5 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm bg-slate-50 focus:bg-white transition-colors">{{ $settings['address'] ?? '' }}</textarea>
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Kode Semat Google Maps (Embed HTML <iframe...>)</label>
                    <textarea name="map_embed" rows="3" class="block w-full px-4 py-2.5 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm font-mono text-xs bg-slate-50 focus:bg-white transition-colors" placeholder='<iframe src="https://www.google.com/maps/embed?..." ></iframe>'>{{ $settings['map_embed'] ?? '' }}</textarea>
                </div>
            </div>
        </div>

        <div class="flex justify-end gap-3">
            <button type="submit" class="px-6 py-3 text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 rounded-xl shadow-sm transition-all hover:-translate-y-0.5">
                Simpan Pengaturan
            </button>
        </div>
    </form>
</div>
@endsection

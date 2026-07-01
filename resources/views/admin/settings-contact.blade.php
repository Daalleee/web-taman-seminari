@extends('layouts.admin')

@section('title', 'Kontak')

@section('content')
<div class="max-w-3xl">
    <form action="{{ route('admin.settings.contact') }}" method="POST" class="space-y-6">
        @csrf
        <div class="bg-white rounded-2xl shadow-sm border border-primary/5 overflow-hidden">
            <div class="px-6 py-5 border-b border-primary/5 bg-surface-container-low flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-primary flex items-center justify-center text-on-primary">
                    <span class="material-symbols-outlined text-[22px]">contact_phone</span>
                </div>
                <div>
                    <h3 class="font-headline-sm text-headline-sm text-primary">Informasi Kontak</h3>
                    <p class="text-sm text-on-surface-variant mt-0.5">Alamat, telepon, email, dan media sosial sekolah.</p>
                </div>
            </div>
            <div class="p-6 space-y-5">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-sm font-medium text-on-surface mb-1.5">Alamat</label>
                        <textarea name="address" rows="3" class="block w-full px-4 py-2.5 border border-primary/10 rounded-xl focus:ring-2 focus:ring-secondary/30 focus:border-secondary sm:text-sm bg-surface-bright focus:bg-white transition-colors" placeholder="Alamat lengkap sekolah...">{{ $settings['address'] ?? '' }}</textarea>
                    </div>
                    <div class="space-y-5">
                        <div>
                            <label class="block text-sm font-medium text-on-surface mb-1.5">Nomor Telepon</label>
                            <input type="text" name="phone" value="{{ $settings['phone'] ?? '' }}" class="block w-full px-4 py-2.5 border border-primary/10 rounded-xl focus:ring-2 focus:ring-secondary/30 focus:border-secondary sm:text-sm bg-surface-bright focus:bg-white transition-colors" placeholder="+62 xxx xxxx xxxx">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-on-surface mb-1.5">Email</label>
                            <input type="email" name="email" value="{{ $settings['email'] ?? '' }}" class="block w-full px-4 py-2.5 border border-primary/10 rounded-xl focus:ring-2 focus:ring-secondary/30 focus:border-secondary sm:text-sm bg-surface-bright focus:bg-white transition-colors" placeholder="email@sekolah.ac.id">
                        </div>
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-on-surface mb-1.5">Google Maps Embed URL</label>
                    <input type="url" name="google_maps_url" value="{{ $settings['google_maps_url'] ?? '' }}" class="block w-full px-4 py-2.5 border border-primary/10 rounded-xl focus:ring-2 focus:ring-secondary/30 focus:border-secondary sm:text-sm bg-surface-bright focus:bg-white transition-colors" placeholder="https://maps.google.com/?q=...">
                </div>
            </div>
        </div>

        <div class="flex justify-end">
            <button type="submit" class="px-6 py-3 text-sm font-medium text-white bg-primary hover:bg-primary-container rounded-xl shadow-sm transition-all">
                Simpan Kontak
            </button>
        </div>
    </form>
</div>
@endsection
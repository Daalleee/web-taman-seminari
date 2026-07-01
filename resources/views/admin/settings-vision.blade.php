@extends('layouts.admin')

@section('title', 'Visi')

@section('content')
<div class="max-w-3xl">
    <form action="{{ route('admin.settings.vision') }}" method="POST" class="space-y-6">
        @csrf
        <div class="bg-white rounded-2xl shadow-sm border border-primary/5 overflow-hidden">
            <div class="px-6 py-5 border-b border-primary/5 bg-surface-container-low flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-primary flex items-center justify-center text-on-primary">
                    <span class="material-symbols-outlined text-[22px]">visibility</span>
                </div>
                <div>
                    <h3 class="font-headline-sm text-headline-sm text-primary">Visi Sekolah</h3>
                    <p class="text-sm text-on-surface-variant mt-0.5">Cita-cita dan tujuan jangka panjang sekolah.</p>
                </div>
            </div>
            <div class="p-6 space-y-4">
                <div>
                    <label class="block text-sm font-medium text-on-surface mb-1.5">Visi</label>
                    <p class="text-xs text-on-surface-variant mb-2">Tulis setiap poin visi dalam satu baris. Gunakan enter untuk baris baru.</p>
                    <textarea name="vision" rows="5" class="block w-full px-4 py-3 border border-primary/10 rounded-xl focus:ring-2 focus:ring-secondary/30 focus:border-secondary sm:text-sm bg-surface-bright focus:bg-white transition-colors" placeholder="Tulis visi sekolah...&#10;Contoh:&#10;Menjadi lembaga pendidikan Katolik unggulan&#10;Membentuk generasi berkarakter mulia">{{ $settings['vision'] ?? '' }}</textarea>
                </div>
                <div>
                    <label class="block text-sm font-medium text-on-surface mb-1.5">Tampilan</label>
                    <select name="vision_style" class="block w-full px-4 py-2.5 border border-primary/10 rounded-xl focus:ring-2 focus:ring-secondary/30 focus:border-secondary sm:text-sm bg-surface-bright focus:bg-white transition-colors">
                        <option value="paragraph" {{ ($settings['vision_style'] ?? 'paragraph') === 'paragraph' ? 'selected' : '' }}>Paragraf (teks biasa)</option>
                        <option value="number" {{ ($settings['vision_style'] ?? '') === 'number' ? 'selected' : '' }}>Nomor (1, 2, 3)</option>
                        <option value="bullet" {{ ($settings['vision_style'] ?? '') === 'bullet' ? 'selected' : '' }}>Titik Bulat (•)</option>
                        <option value="dash" {{ ($settings['vision_style'] ?? '') === 'dash' ? 'selected' : '' }}>Strip (–)</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="flex justify-end">
            <button type="submit" class="px-6 py-3 text-sm font-medium text-white bg-primary hover:bg-primary-container rounded-xl shadow-sm transition-all">
                Simpan Visi
            </button>
        </div>
    </form>
</div>
@endsection
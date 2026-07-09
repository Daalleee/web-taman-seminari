@extends('layouts.admin')

@section('title', 'Jam Operasional')

@section('content')
<div class="max-w-2xl">
    <form action="{{ route('admin.settings.operational-hours') }}" method="POST" class="space-y-6">
        @csrf
        <div class="bg-white rounded-2xl shadow-sm border border-primary/5 overflow-hidden">
            <div class="px-6 py-5 border-b border-primary/5 bg-surface-container-low flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-primary flex items-center justify-center text-on-primary">
                    <span class="material-symbols-outlined text-[22px]">schedule</span>
                </div>
                <div>
                    <h3 class="font-headline-sm text-headline-sm text-primary">Jam Operasional</h3>
                    <p class="text-sm text-on-surface-variant mt-0.5">Atur jam buka sekolah setiap hari.</p>
                </div>
            </div>
            <div class="p-6 space-y-5">
                <div>
                    <label class="block text-sm font-medium text-on-surface mb-1.5">Senin - Jumat</label>
                    <input type="text" name="operational_hours_weekday" value="{{ $settings['operational_hours_weekday'] ?? '07:30 - 14:00' }}" class="block w-full px-4 py-2.5 border border-primary/10 rounded-xl focus:ring-2 focus:ring-secondary/30 focus:border-secondary sm:text-sm bg-surface-bright focus:bg-white transition-colors" placeholder="07:30 - 14:00">
                </div>
                <div>
                    <label class="block text-sm font-medium text-on-surface mb-1.5">Sabtu</label>
                    <input type="text" name="operational_hours_saturday" value="{{ $settings['operational_hours_saturday'] ?? '08:00 - 12:00' }}" class="block w-full px-4 py-2.5 border border-primary/10 rounded-xl focus:ring-2 focus:ring-secondary/30 focus:border-secondary sm:text-sm bg-surface-bright focus:bg-white transition-colors" placeholder="08:00 - 12:00">
                </div>
                <div>
                    <label class="block text-sm font-medium text-on-surface mb-1.5">Minggu & Libur</label>
                    <input type="text" name="operational_hours_sunday_holiday" value="{{ $settings['operational_hours_sunday_holiday'] ?? 'Tutup' }}" class="block w-full px-4 py-2.5 border border-primary/10 rounded-xl focus:ring-2 focus:ring-secondary/30 focus:border-secondary sm:text-sm bg-surface-bright focus:bg-white transition-colors" placeholder="Tutup">
                </div>
            </div>
        </div>

        <div class="flex justify-end">
            <button type="submit" class="px-6 py-3 text-sm font-medium text-white bg-primary hover:bg-primary-container rounded-xl shadow-sm transition-all">
                Simpan Jam Operasional
            </button>
        </div>
    </form>
</div>
@endsection

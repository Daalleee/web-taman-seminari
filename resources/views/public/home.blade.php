@extends('layouts.public')

@section('title', $settings['school_name'] ?? 'Taman Seminari')

@section('content')

<style>
    .fade-in { opacity:0; transform:translateY(28px); transition: opacity .65s ease, transform .65s ease; }
    .fade-in.in { opacity:1; transform:translateY(0); }
    .hover-lift { transition: transform 0.3s ease, box-shadow 0.3s ease; }
    .hover-lift:hover { transform: translateY(-4px); box-shadow: 0 12px 24px -10px rgba(0, 30, 64, 0.15); }
    .text-shadow-sm { text-shadow: 0 2px 4px rgba(0,0,0,0.1); }
</style>
<script>
document.addEventListener('DOMContentLoaded',()=>{
    const obs=new IntersectionObserver(entries=>{
        entries.forEach((e,i)=>{ if(e.isIntersecting) setTimeout(()=>e.target.classList.add('in'), i*70); });
    },{threshold:.12});
    document.querySelectorAll('.fade-in').forEach(el=>obs.observe(el));
});
</script>

<!-- HERO -->
<section id="home" class="relative min-h-screen flex items-center overflow-hidden bg-surface"
    x-data="{ current: 0, total: {{ $banners->count() }}, go(i) { this.current = i }, next() { this.current = (this.current + 1) % this.total } }"
    x-init="if(total > 1) setInterval(() => next(), 5000)">
    
    @forelse($banners as $i => $banner)
    <div class="absolute inset-0 z-0 transition-opacity duration-1000" :class="current === {{ $i }} ? 'opacity-100' : 'opacity-0'">
        <div class="w-full h-full bg-cover bg-center" style="background-image: url('{{ asset('storage/'.$banner->image_path) }}')"></div>
        <div class="absolute inset-0 bg-gradient-to-r from-primary/85 via-primary/50 to-primary/20"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-primary/40 via-transparent to-transparent"></div>
    </div>
    @empty
    <div class="absolute inset-0 z-0 bg-gradient-to-r from-primary/85 via-primary/50 to-primary/20"></div>
    @endforelse

    <div class="relative z-10 max-w-container-max mx-auto px-margin-mobile md:px-gutter grid grid-cols-1 md:grid-cols-2 gap-stack-lg items-center w-full">
        <div class="fade-in">
            <h1 class="font-headline-lg-mobile md:font-headline-lg text-headline-lg-mobile md:text-headline-lg text-white mb-stack-md leading-tight drop-shadow-lg">
                {{ $settings['hero_title'] ?? 'Membentuk Hati yang Beriman & Pikiran yang Cemerlang' }}
            </h1>
            <p class="font-body-lg text-body-lg text-white/80 mb-stack-lg max-w-[540px] drop-shadow">
                {{ $settings['hero_subtitle'] ?? 'Di Taman Seminari, kami menanamkan nilai-nilai Kristiani yang mendalam dengan pendekatan pendidikan anak usia dini yang modern dan penuh kasih.' }}
            </p>
            <div class="flex flex-wrap gap-4">
                <a href="{{ url('/tentang') }}" class="bg-white text-primary px-8 py-4 rounded-xl font-label-md text-label-md hover:shadow-xl hover:scale-[1.02] transition-all active:scale-95 shadow-lg">
                    Selengkapnya
                </a>
                <a href="{{ url('/kontak') }}" class="bg-white/10 backdrop-blur-sm border border-white/40 text-white px-8 py-4 rounded-xl font-label-md text-label-md hover:bg-white/20 transition-all active:scale-95">
                    Hubungi Kami
                </a>
            </div>
            @if($banners->count() > 1)
            <div class="flex gap-2 mt-8">
                @foreach($banners as $i => $banner)
                <button @click="go({{ $i }})" class="h-2.5 rounded-full transition-all duration-300"
                    :class="current === {{ $i }} ? 'bg-white w-8' : 'bg-white/40 hover:bg-white/70 w-2.5'"></button>
                @endforeach
            </div>
            @endif
        </div>
    </div>
</section>

<!-- TENTANG / VISI MISI -->
<section id="about" class="py-section-gap px-margin-mobile md:px-gutter max-w-container-max mx-auto">
    <div class="text-center mb-16 fade-in">
        <h2 class="font-headline-lg text-headline-lg text-primary mb-4">Tentang</h2>
        <p class="font-body-md text-body-md text-on-surface-variant max-w-[700px] mx-auto">{{ $settings['about_text'] ?? 'Visi dan misi kami adalah menjadi terang bagi pertumbuhan spiritual dan intelektual setiap anak.' }}</p>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 fade-in">
        @php
            $visionText = $settings['vision'] ?? '';
            $visionLines = $visionText ? array_filter(array_map('trim', explode("\n", $visionText))) : [];
            $visionStyle = $settings['vision_style'] ?? 'paragraph';
        @endphp
        <div class="md:col-span-2 bg-white border border-primary/10 p-10 rounded-xl shadow-sm hover:shadow-md transition-shadow group">
            <div class="flex flex-col md:flex-row gap-8 items-start">
                <div class="w-16 h-16 bg-primary rounded-2xl flex items-center justify-center text-on-primary shrink-0 transition-transform group-hover:scale-110">
                    <span class="material-symbols-outlined text-3xl">visibility</span>
                </div>
                <div class="flex-1">
                    <h3 class="font-headline-sm text-headline-sm text-primary mb-4">Visi Kami</h3>
                    @if($visionStyle === 'paragraph' || empty($visionLines))
                    <p class="font-body-lg text-body-lg text-on-surface-variant leading-relaxed">
                        {{ $settings['vision'] ?? 'Menjadi lembaga pendidikan Katolik unggulan yang membentuk generasi berkarakter mulia, cerdas, dan mandiri berlandaskan kasih Kristus dalam semangat kegembiraan anak-anak.' }}
                    </p>
                    @elseif($visionStyle === 'number')
                    <ol class="space-y-3 list-inside list-decimal">
                        @foreach($visionLines as $line)
                        <li class="font-body-lg text-body-lg text-on-surface-variant leading-relaxed pl-2">{{ $line }}</li>
                        @endforeach
                    </ol>
                    @elseif($visionStyle === 'bullet')
                    <ul class="space-y-3 list-inside list-disc">
                        @foreach($visionLines as $line)
                        <li class="font-body-lg text-body-lg text-on-surface-variant leading-relaxed pl-2">{{ $line }}</li>
                        @endforeach
                    </ul>
                    @else
                    <ul class="space-y-3 list-inside">
                        @foreach($visionLines as $line)
                        <li class="font-body-lg text-body-lg text-on-surface-variant leading-relaxed flex items-start gap-3">
                            <span class="text-secondary font-bold flex-shrink-0">–</span>
                            <span>{{ $line }}</span>
                        </li>
                        @endforeach
                    </ul>
                    @endif
                </div>
            </div>
        </div>
        <div class="bg-secondary-container/20 border border-secondary/10 p-10 rounded-xl flex flex-col justify-between">
            <h3 class="font-headline-sm text-headline-sm text-secondary mb-6">Misi Utama</h3>
            @php
                $missionText = $settings['mission'] ?? '';
                $missionLines = $missionText ? array_filter(array_map('trim', explode("\n", $missionText))) : ['Pendidikan karakter religius', 'Kolaborasi aktif dengan orang tua', 'Pengenalan kasih pada sesama'];
                $missionStyle = $settings['mission_style'] ?? 'number';
            @endphp
            @if($missionStyle === 'paragraph')
            <p class="font-body-md text-body-md text-on-surface leading-relaxed">{{ implode(' ', $missionLines) }}</p>
            @elseif($missionStyle === 'number')
            <ol class="space-y-4 list-inside list-decimal">
                @foreach($missionLines as $line)
                <li class="font-body-md text-body-md text-on-surface leading-relaxed pl-2">{{ $line }}</li>
                @endforeach
            </ol>
            @elseif($missionStyle === 'bullet')
            <ul class="space-y-4 list-inside list-disc">
                @foreach($missionLines as $line)
                <li class="font-body-md text-body-md text-on-surface leading-relaxed pl-2">{{ $line }}</li>
                @endforeach
            </ul>
            @else
            <ul class="space-y-4 list-inside">
                @foreach($missionLines as $line)
                <li class="font-body-md text-body-md text-on-surface leading-relaxed flex items-start gap-3">
                    <span class="text-secondary font-bold">–</span>
                    <span>{{ $line }}</span>
                </li>
                @endforeach
            </ul>
            @endif
        </div>
    </div>
</section>

@php
    $principal = $sambutans->firstWhere('role', 'Kepala Sekolah');
    $teachers = $sambutans->where('role', '!=', 'Kepala Sekolah');
@endphp

<!-- KATA SAMBUTAN KEPALA SEKOLAH -->
@if($principal)
<section id="sambutan" class="py-section-gap bg-surface-container-low">
    <div class="max-w-container-max mx-auto px-margin-mobile md:px-gutter">
        <div class="text-center mb-16 fade-in">
            <h2 class="font-headline-lg text-headline-lg text-primary mb-4">Kata Sambutan</h2>
            <p class="font-body-md text-body-md text-on-surface-variant max-w-[700px] mx-auto">Sambutan dari kepala sekolah Taman Seminari.</p>
        </div>
        <div class="max-w-5xl mx-auto fade-in">
            <div class="bg-white rounded-2xl overflow-hidden shadow-md border border-primary/5 flex flex-col md:flex-row">
                <div class="md:w-96 lg:w-[28rem] shrink-0 flex items-center justify-center p-8">
                    @if($principal->photo_path)
                        <div class="w-full border-4 border-primary/20 rounded-xl overflow-hidden shadow-lg bg-white">
                            <img src="{{ asset('storage/'.$principal->photo_path) }}" alt="{{ $principal->name }}" class="w-full aspect-[4/3] object-cover">
                        </div>
                    @else
                        <div class="w-full aspect-[4/3] flex items-center justify-center border-4 border-primary/20 rounded-xl bg-primary/5">
                            <span class="material-symbols-outlined text-primary text-7xl">person</span>
                        </div>
                    @endif
                </div>
                <div class="flex-1 p-8 md:p-10 flex flex-col justify-center">
                    <h3 class="font-headline-sm text-headline-sm text-primary mb-1">{{ $principal->name }}</h3>
                    <p class="font-label-md text-label-md text-secondary mb-4">{{ $principal->role }}</p>
                    <div class="font-body-md text-body-md text-on-surface-variant leading-relaxed space-y-3">
                        {{ $principal->content }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endif

<!-- TENAGA PENDIDIK -->
@if($teachers->count() > 0)
<section class="py-section-gap">
    <div class="max-w-container-max mx-auto px-margin-mobile md:px-gutter">
        <div class="text-center mb-16 fade-in">
            <h2 class="font-headline-lg text-headline-lg text-primary mb-4">Guru</h2>
            <p class="font-body-md text-body-md text-on-surface-variant max-w-[700px] mx-auto">Guru-guru yang berdedikasi mendampingi tumbuh kembang anak-anak.</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 fade-in max-w-3xl mx-auto">
            @foreach($teachers as $teacher)
            <div class="bg-white rounded-2xl overflow-hidden shadow-md border border-primary/10 p-10 text-center hover-lift">
                <div class="w-36 h-36 mx-auto rounded-full overflow-hidden bg-primary/10 flex items-center justify-center border-[6px] border-primary/20 shadow-lg mb-6">
                    @if($teacher->photo_path)
                        <img src="{{ asset('storage/'.$teacher->photo_path) }}" alt="{{ $teacher->name }}" class="w-full h-full object-cover">
                    @else
                        <span class="material-symbols-outlined text-primary text-6xl">person</span>
                    @endif
                </div>
                <h3 class="font-headline-md text-headline-md text-primary">{{ $teacher->name }}</h3>
                <p class="font-label-lg text-label-lg text-secondary mt-2">{{ $teacher->role }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- BERITA -->
<section id="news" class="py-section-gap overflow-hidden">
    <div class="max-w-container-max mx-auto px-margin-mobile md:px-gutter">
        <div class="text-center mb-16 fade-in">
            <h2 class="font-headline-lg text-headline-lg text-primary mb-4">Berita</h2>
            <p class="font-body-md text-body-md text-on-surface-variant max-w-[700px] mx-auto">Tetap terhubung dengan kegiatan harian, pengumuman penting, dan momen-momen berharga.</p>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6 fade-in">
            @forelse($newsList as $item)
            <div class="glass-card rounded-xl overflow-hidden hover-lift border border-primary/5 flex flex-col bg-white">
                <div class="h-48 overflow-hidden bg-surface-container-low">
                    @if($item->image_path)
                        <div class="w-full h-full bg-cover bg-center transition-transform duration-500 hover:scale-105" style="background-image: url('{{ asset('storage/'.$item->image_path) }}')"></div>
                    @else
                        <div class="w-full h-full flex items-center justify-center">
                            <span class="material-symbols-outlined text-headline-lg text-outline">article</span>
                        </div>
                    @endif
                </div>
                <div class="p-5 flex flex-col flex-1">
                    <span class="text-on-surface-variant font-label-md text-label-md mb-2 flex items-center gap-1">
                        <span class="material-symbols-outlined text-[16px]">calendar_today</span>
                        {{ $item->published_at ? $item->published_at->format('d M Y') : '-' }}
                    </span>
                    <h3 class="font-headline-sm text-headline-sm text-primary mb-3">{{ $item->title }}</h3>
                    <p class="font-body-md text-body-md text-on-surface-variant mb-6 flex-1">{{ Str::limit($item->content, 120) }}</p>
                    <a href="{{ route('news.show', $item->id) }}" class="mt-auto text-primary font-label-md text-label-md flex items-center gap-1 hover:text-secondary transition-colors group">
                        Selengkapnya
                        <span class="material-symbols-outlined text-[18px] group-hover:translate-x-1 transition-transform">chevron_right</span>
                    </a>
                </div>
            </div>
            @empty
            <div class="md:col-span-3 text-center py-16 border-2 border-dashed border-outline-variant rounded-xl bg-white/50">
                <span class="material-symbols-outlined text-headline-lg text-outline block mb-4">newspaper</span>
                <p class="text-on-surface-variant font-label-md">Belum ada berita yang ditambahkan.</p>
            </div>
            @endforelse
        </div>
    </div>
</section>

<!-- KEGIATAN -->
<section id="activities" class="py-section-gap px-margin-mobile md:px-gutter max-w-container-max mx-auto">
    <div class="text-center mb-16 fade-in">
        <h2 class="font-headline-lg text-headline-lg text-primary mb-4">Kegiatan</h2>
        <p class="font-body-md text-body-md text-on-surface-variant max-w-[700px] mx-auto">Setiap kegiatan dirancang untuk mengasah potensi dan memperdalam nilai-nilai spiritual sejak dini.</p>
    </div>
    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6 fade-in">
        @forelse($activities->take(6) as $activity)
        <div class="glass-card rounded-xl overflow-hidden hover-lift border border-primary/5 flex flex-col bg-white">
            <div class="h-48 overflow-hidden bg-surface-container-low">
                @if($activity->image_path)
                    <div class="w-full h-full bg-cover bg-center transition-transform duration-500 hover:scale-105" style="background-image: url('{{ asset('storage/'.$activity->image_path) }}')"></div>
                @else
                    <div class="w-full h-full flex items-center justify-center">
                        <span class="material-symbols-outlined text-headline-lg text-outline">celebration</span>
                    </div>
                @endif
            </div>
            <div class="p-5 flex flex-col flex-1">
                <span class="text-on-surface-variant font-label-md text-label-md mb-2 flex items-center gap-1">
                    <span class="material-symbols-outlined text-[16px]">calendar_today</span>
                    {{ $activity->activity_date ? $activity->activity_date->format('d M Y') : '-' }}
                </span>
                <h3 class="font-headline-sm text-headline-sm text-primary mb-3">{{ $activity->title }}</h3>
                <p class="font-body-md text-body-md text-on-surface-variant mb-6 flex-1">{{ $activity->description }}</p>
                <a href="{{ route('activity.show', $activity->id) }}" class="mt-auto text-primary font-label-md text-label-md flex items-center gap-1 hover:text-secondary transition-colors group">
                    Selengkapnya
                    <span class="material-symbols-outlined text-[18px] group-hover:translate-x-1 transition-transform">chevron_right</span>
                </a>
            </div>
        </div>
        @empty
        <div class="md:col-span-3 text-center py-16 border-2 border-dashed border-outline-variant rounded-xl bg-surface-container-low">
            <span class="material-symbols-outlined text-headline-lg text-outline block mb-4">celebration</span>
            <p class="text-on-surface-variant font-label-md">Belum ada kegiatan yang ditambahkan.</p>
        </div>
        @endforelse
    </div>
</section>

<!-- GALERI -->
<section id="gallery" class="py-section-gap bg-surface-container-low">
    <div class="max-w-container-max mx-auto px-margin-mobile md:px-gutter">
        <div class="text-center mb-16 fade-in">
            <h2 class="font-headline-lg text-headline-lg text-primary mb-4">Galeri</h2>
            <p class="font-body-lg text-body-lg text-on-surface-variant max-w-[700px] mx-auto">Eksplorasi perjalanan iman dan kreativitas anak-anak kami melalui lensa kamera.</p>
        </div>

        @if($galleries->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 fade-in"
             x-data="{
                 active: null,
                 images: [
                     @foreach($galleries as $gallery)
                     { src: '{{ asset('storage/'.$gallery->image_path) }}', title: '{{ $gallery->title ?: 'Dokumentasi' }}' }@if(!$loop->last),@endif
                     @endforeach
                 ],
                 init() {
                     this.$watch('active', val => document.body.style.overflow = val !== null ? 'hidden' : '')
                 }
             }">
            @foreach($galleries as $index => $gallery)
            <div class="group relative overflow-hidden rounded-xl border border-primary/10 aspect-square cursor-pointer" x-on:click="active = {{ $index }}">
                <img src="{{ asset('storage/'.$gallery->image_path) }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" alt="{{ $gallery->title ?: 'Dokumentasi' }}">
                <div class="absolute inset-0 bg-gradient-to-t from-primary/80 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-gutter">
                    <div class="text-on-primary">
                        <p class="font-label-md text-label-md mb-1 uppercase tracking-wider text-secondary-fixed">Galeri</p>
                        <h3 class="font-headline-sm text-headline-sm">{{ $gallery->title ?: 'Dokumentasi' }}</h3>
                    </div>
                </div>
            </div>
            @endforeach

            <template x-teleport="body">
                <div x-show="active !== null" class="fixed inset-0 z-[9999] overflow-y-auto" style="display:none;">
                    <div class="flex items-center justify-center min-h-screen px-4 py-8 sm:p-0">
                        <div x-show="active !== null" x-on:click="active = null" class="fixed inset-0 bg-slate-900/90 backdrop-blur-md"></div>
                        <div x-show="active !== null" x-transition class="relative z-10 max-w-4xl w-full">
                            <button x-on:click="active = null" class="absolute -top-12 right-0 text-white hover:text-slate-300 w-8 h-8 flex items-center justify-center">
                                <span class="material-symbols-outlined text-3xl">close</span>
                            </button>
                            <button x-on:click="active = active > 0 ? active - 1 : active" x-show="active > 0" class="absolute left-4 top-1/2 -translate-y-1/2 z-10 text-white w-12 h-12 flex items-center justify-center rounded-full bg-white/10 hover:bg-white/20 transition-colors">
                                <span class="material-symbols-outlined text-3xl">chevron_left</span>
                            </button>
                            <button x-on:click="active = active < images.length - 1 ? active + 1 : active" x-show="active < images.length - 1" class="absolute right-4 top-1/2 -translate-y-1/2 z-10 text-white w-12 h-12 flex items-center justify-center rounded-full bg-white/10 hover:bg-white/20 transition-colors">
                                <span class="material-symbols-outlined text-3xl">chevron_right</span>
                            </button>
                            <template x-if="active !== null">
                                <div class="flex flex-col items-center">
                                    <img :src="images[active].src" :alt="images[active].title" class="w-full max-h-[80vh] object-contain rounded-lg shadow-2xl">
                                    <p class="text-white text-center mt-4 text-lg font-medium" x-text="images[active].title"></p>
                                </div>
                            </template>
                        </div>
                    </div>
                </div>
            </template>
        </div>
        @else
        <div class="text-center py-16 border-2 border-dashed border-outline-variant rounded-xl bg-white/50 fade-in">
            <span class="material-symbols-outlined text-headline-lg text-outline block mb-4">photo_library</span>
            <p class="text-on-surface-variant font-label-md">Galeri masih kosong.</p>
        </div>
        @endif
    </div>
</section>

<!-- FAQ -->
<section id="faq" class="py-section-gap px-margin-mobile md:px-gutter">
    <div class="max-w-container-max mx-auto">
        <div class="text-center mb-16 fade-in">
            <h2 class="font-headline-lg text-headline-lg text-primary mb-4">FAQ</h2>
            <p class="font-body-lg text-body-lg text-on-surface-variant max-w-[700px] mx-auto">Temukan jawaban lengkap mengenai pendaftaran, kurikulum berbasis iman, dan kehidupan harian putra-putri Anda.</p>
        </div>
        <div class="max-w-3xl mx-auto space-y-4 fade-in" x-data="{ active: null }">
            @forelse($faqs as $faq)
            <div class="bg-white border border-primary/10 rounded-xl overflow-hidden transition-all hover:border-primary/20"
                 :class="{'shadow-md border-primary': active === {{ $faq->id }}}">
                <button @click="active !== {{ $faq->id }} ? active = {{ $faq->id }} : active = null" class="w-full px-6 py-5 text-left flex justify-between items-center">
                    <span class="font-label-md text-label-md text-on-surface font-semibold pr-4">{{ $faq->question }}</span>
                    <span class="material-symbols-outlined text-secondary transition-transform duration-300 shrink-0"
                          :class="{'rotate-180': active === {{ $faq->id }}}">expand_more</span>
                </button>
                <div x-show="active === {{ $faq->id }}" x-collapse style="display: none;">
                    <div class="px-6 pb-6 text-on-surface-variant font-body-md text-body-md leading-relaxed border-t border-primary/10 pt-4">
                        {{ $faq->answer }}
                    </div>
                </div>
            </div>
            @empty
            <div class="text-center py-14 border-2 border-dashed border-outline-variant rounded-xl bg-surface-container-low">
                <span class="material-symbols-outlined text-headline-lg text-outline block mb-4">help</span>
                <p class="text-on-surface-variant font-label-md">Belum ada pertanyaan umum.</p>
            </div>
            @endforelse
        </div>
    </div>
</section>

<!-- KONTAK -->
<section id="contact" class="py-section-gap bg-surface-container-low">
    <div class="max-w-container-max mx-auto px-margin-mobile md:px-gutter">
        <div class="text-center mb-16 fade-in">
            <h2 class="font-headline-lg text-headline-lg text-primary mb-4">Kontak</h2>
            <p class="font-body-lg text-body-lg text-on-surface-variant max-w-[700px] mx-auto">Kami di sini untuk menjawab pertanyaan Anda tentang kurikulum berbasis iman, pendaftaran, atau untuk menjadwalkan kunjungan.</p>
        </div>
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-gutter fade-in">
            <div class="lg:col-span-7 bg-surface-container-lowest border border-primary/10 rounded-xl p-8 md:p-10 shadow-sm">
                <h2 class="font-headline-sm text-headline-sm text-primary mb-8">Kirim Pesan</h2>

                @if(session('success'))
                <div class="mb-6 p-4 rounded-xl bg-secondary/10 border border-secondary/20 text-secondary flex items-center gap-3">
                    <span class="material-symbols-outlined text-secondary text-[20px]">check_circle</span>
                    <p class="font-medium text-sm">{{ session('success') }}</p>
                </div>
                @endif

                @if($errors->any())
                <div class="mb-6 p-4 rounded-xl bg-red-50 border border-red-200 text-red-600 text-sm">
                    <ul class="list-disc list-inside space-y-1">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <form action="{{ route('contact.store') }}" method="POST" class="space-y-6">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="font-label-md text-label-md text-on-surface-variant">Nama</label>
                            <input name="name" value="{{ old('name') }}" class="w-full px-4 py-3 rounded-lg border border-outline-variant bg-surface-bright font-body-md text-body-md focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/10 transition-all" placeholder="Masukkan nama Anda" type="text" required>
                        </div>
                        <div class="space-y-2">
                            <label class="font-label-md text-label-md text-on-surface-variant">Email</label>
                            <input name="email" value="{{ old('email') }}" class="w-full px-4 py-3 rounded-lg border border-outline-variant bg-surface-bright font-body-md text-body-md focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/10 transition-all" placeholder="nama@email.com" type="email" required>
                        </div>
                    </div>
                    <div class="space-y-2">
                        <label class="font-label-md text-label-md text-on-surface-variant">Pesan</label>
                        <textarea name="message" class="w-full px-4 py-3 rounded-lg border border-outline-variant bg-surface-bright font-body-md text-body-md focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/10 transition-all" placeholder="Tuliskan pertanyaan atau pesan Anda di sini..." rows="5" required>{{ old('message') }}</textarea>
                    </div>
                    <button class="bg-primary text-on-primary px-8 py-4 rounded-full font-label-md text-label-md flex items-center justify-center gap-2 hover:bg-primary-container transition-all active:scale-95 group" type="submit">
                        Kirim Pesan
                        <span class="material-symbols-outlined text-body-md group-hover:translate-x-1 transition-transform">send</span>
                    </button>
                </form>
            </div>
            <div class="lg:col-span-5 flex flex-col gap-gutter">
                <div class="bg-surface-container border border-primary/10 rounded-xl p-8 flex flex-col gap-6">
                    <h3 class="font-headline-sm text-headline-sm text-primary">Informasi Kontak</h3>
                    @if(!empty($settings['phone']))
                    <div class="flex gap-4 items-start">
                        <div class="w-10 h-10 rounded-full bg-secondary-fixed flex items-center justify-center shrink-0">
                            <span class="material-symbols-outlined text-on-secondary-fixed">phone</span>
                        </div>
                        <div>
                            <p class="font-label-md text-label-md text-secondary uppercase tracking-tight">Telepon</p>
                            <p class="font-body-md text-body-md text-on-surface">{{ $settings['phone'] }}</p>
                        </div>
                    </div>
                    @endif
                    @if(!empty($settings['email']))
                    <div class="flex gap-4 items-start">
                        <div class="w-10 h-10 rounded-full bg-secondary-fixed flex items-center justify-center shrink-0">
                            <span class="material-symbols-outlined text-on-secondary-fixed">mail</span>
                        </div>
                        <div>
                            <p class="font-label-md text-label-md text-secondary uppercase tracking-tight">Email</p>
                            <p class="font-body-md text-body-md text-on-surface">{{ $settings['email'] }}</p>
                        </div>
                    </div>
                    @endif
                    @if(!empty($settings['address']))
                    <div class="flex gap-4 items-start">
                        <div class="w-10 h-10 rounded-full bg-secondary-fixed flex items-center justify-center shrink-0">
                            <span class="material-symbols-outlined text-on-secondary-fixed">location_on</span>
                        </div>
                        <div>
                            <p class="font-label-md text-label-md text-secondary uppercase tracking-tight">Alamat</p>
                            <p class="font-body-md text-body-md text-on-surface">{{ $settings['address'] }}</p>
                        </div>
                    </div>
                    @endif
                </div>
                <div class="bg-primary text-on-primary rounded-xl p-8 shadow-lg">
                    <div class="flex items-center gap-3 mb-6">
                        <span class="material-symbols-outlined">schedule</span>
                        <h3 class="font-headline-sm text-headline-sm">Jam Operasional</h3>
                    </div>
                    <ul class="space-y-4">
                        <li class="flex justify-between items-center border-b border-on-primary/10 pb-2">
                            <span class="font-body-md">Senin - Jumat</span>
                            <span class="font-label-md">{{ $settings['operational_hours_weekday'] ?? '07:30 - 14:00' }}</span>
                        </li>
                        <li class="flex justify-between items-center border-b border-on-primary/10 pb-2">
                            <span class="font-body-md">Sabtu</span>
                            <span class="font-label-md">{{ $settings['operational_hours_saturday'] ?? '08:00 - 12:00' }}</span>
                        </li>
                        <li class="flex justify-between items-center text-on-primary/60">
                            <span class="font-body-md">Minggu & Libur</span>
                            <span class="font-label-md">{{ $settings['operational_hours_sunday_holiday'] ?? 'Tutup' }}</span>
                        </li>
                    </ul>
                </div>
                @if(!empty($settings['phone']))
                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings['phone']) }}" target="_blank"
                   class="bg-primary text-on-primary px-8 py-4 rounded-full font-label-md text-label-md flex items-center justify-center gap-2 hover:bg-primary-container transition-all active:scale-95">
                    <span class="material-symbols-outlined">chat</span>
                    Hubungi via WhatsApp
                </a>
                @endif
            </div>
        </div>
    </div>
</section>

@push('head')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
@endpush

<!-- MAP -->
<section class="pb-section-gap px-margin-mobile md:px-gutter max-w-container-max mx-auto">
    <div class="rounded-2xl overflow-hidden border border-primary/10 shadow-sm h-[450px] relative bg-surface-container-low">
        @php
            $mapLat = $settings['map_latitude'] ?? null;
            $mapLng = $settings['map_longitude'] ?? null;
            $hasCoords = $mapLat && $mapLng;
        @endphp
        @if($hasCoords)
            <div id="public-map" class="w-full h-full"></div>
        @elseif(!empty($settings['address']))
            <div id="public-map" class="w-full h-full"></div>
        @else
            <div class="w-full h-full flex flex-col items-center justify-center text-on-surface-variant">
                <span class="material-symbols-outlined text-4xl text-outline mb-3">map</span>
                <p class="font-label-md">Peta Belum Tersedia</p>
            </div>
        @endif
        <div class="absolute bottom-6 left-6 right-6 md:right-auto md:w-80 bg-surface-container-lowest/90 backdrop-blur-md p-6 rounded-xl shadow-xl z-[1000]">
            <div class="flex items-center gap-2 text-primary mb-2">
                <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">location_on</span>
                <span class="font-label-md text-label-md uppercase">Lokasi Kami</span>
            </div>
            <p class="font-body-md text-body-md text-on-surface mb-4">{{ $settings['address'] ?? 'Akses mudah dari jalan utama dengan area parkir yang aman.' }}</p>
        </div>
    </div>
</section>

@if($hasCoords || !empty($settings['address']))
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var mapEl = document.getElementById('public-map');
        if (!mapEl) return;

        @if($hasCoords)
            var lat = {{ $mapLat }};
            var lng = {{ $mapLng }};
        @else
            var lat = -6.2088;
            var lng = 106.8456;
        @endif

        var map = L.map('public-map', {
            center: [lat, lng],
            zoom: 16,
            zoomControl: true,
            scrollWheelZoom: true,
        });

        L.tileLayer('https://mt1.google.com/vt/lyrs=y&x={x}&y={y}&z={z}', {
            maxZoom: 20,
        }).addTo(map);

        var schoolName = '{{ addslashes($settings['school_name'] ?? 'Taman Seminari St. Mikael') }}';

        var markerIcon = L.divIcon({
            html: '<div style="display:flex;flex-direction:column;align-items:center;gap:2px;"><div style="background:#003366;width:36px;height:36px;border-radius:50%;display:flex;align-items:center;justify-content:center;box-shadow:0 3px 10px rgba(0,0,0,0.4);border:3px solid white;"><svg width="20" height="20" viewBox="0 0 24 24" fill="white"><path d="M12 3L1 9l4 2.18v6L12 21l7-3.82v-6l2-1.09V17h2V9L12 3zm6.82 6L12 12.72 5.18 9 12 5.28 18.82 9zM17 15.99l-5 2.73-5-2.73v-3.72L12 15l5-2.73v3.72z"/></svg></div><span style="background:white;color:#003366;font-size:11px;font-weight:700;padding:2px 8px;border-radius:4px;box-shadow:0 1px 4px rgba(0,0,0,0.2);white-space:nowrap;font-family:sans-serif;">' + schoolName + '</span></div>',
            iconSize: [36, 58],
            iconAnchor: [18, 58],
            className: '',
        });

        var marker = L.marker([lat, lng], { icon: markerIcon }).addTo(map);

        @if(!$hasCoords && !empty($settings['address']))
            var address = '{{ addslashes($settings['address']) }}';
            fetch('https://nominatim.openstreetmap.org/search?format=json&q=' + encodeURIComponent(address) + '&limit=1&countrycodes=id')
                .then(function (res) { return res.json(); })
                .then(function (data) {
                    if (data.length > 0) {
                        var loc = data[0];
                        map.setView([loc.lat, loc.lon], 16);
                        marker.setLatLng([loc.lat, loc.lon]);
                    }
                });
        @endif
    });
</script>
@endif

@endsection

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
<section id="home" class="relative min-h-screen flex items-center overflow-hidden bg-surface">
    @php $firstBanner = $banners->first(); @endphp
    @if($firstBanner && $firstBanner->image_path)
    <div class="absolute inset-0 z-0">
        <div class="w-full h-full bg-cover bg-center scale-105 transition-transform duration-[20s]" style="background-image: url('{{ asset('storage/'.$firstBanner->image_path) }}')"></div>
        <div class="absolute inset-0 bg-gradient-to-r from-primary/85 via-primary/50 to-primary/20"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-primary/40 via-transparent to-transparent"></div>
    </div>
    @endif
    <div class="relative z-10 max-w-container-max mx-auto px-margin-mobile md:px-gutter grid grid-cols-1 md:grid-cols-2 gap-stack-lg items-center w-full">
        <div class="fade-in">
            <h1 class="font-headline-lg-mobile md:font-headline-lg text-headline-lg-mobile md:text-headline-lg text-white mb-stack-md leading-tight drop-shadow-lg">
                {{ $firstBanner->title ?? 'Membentuk Hati yang Beriman & Pikiran yang Cemerlang' }}
            </h1>
            <p class="font-body-lg text-body-lg text-white/80 mb-stack-lg max-w-[540px] drop-shadow">
                {{ $settings['about_text'] ?? 'Di Taman Seminari TK, kami menanamkan nilai-nilai Kristiani yang mendalam dengan pendekatan pendidikan anak usia dini yang modern dan penuh kasih.' }}
            </p>
            <div class="flex flex-wrap gap-4">
                <a href="#about" class="bg-white text-primary px-8 py-4 rounded-xl font-label-md text-label-md hover:shadow-xl hover:scale-[1.02] transition-all active:scale-95 shadow-lg">
                    Selengkapnya
                </a>
                <a href="#contact" class="bg-white/10 backdrop-blur-sm border border-white/40 text-white px-8 py-4 rounded-xl font-label-md text-label-md hover:bg-white/20 transition-all active:scale-95">
                    Hubungi Kami
                </a>
            </div>
        </div>
    </div>
</section>

<!-- TENTANG / VISI MISI -->
<section id="about" class="py-section-gap px-margin-mobile md:px-gutter max-w-container-max mx-auto">
    <div class="text-center mb-16 fade-in">
        <h2 class="font-headline-lg text-headline-lg text-primary mb-4">Tentang</h2>
        <p class="font-body-md text-body-md text-on-surface-variant max-w-[700px] mx-auto">Visi dan misi kami adalah menjadi terang bagi pertumbuhan spiritual dan intelektual setiap anak.</p>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 fade-in">
        <div class="md:col-span-2 bg-white border border-primary/10 p-10 rounded-xl shadow-sm hover:shadow-md transition-shadow group">
            <div class="flex flex-col md:flex-row gap-8 items-start">
                <div class="w-16 h-16 bg-primary rounded-2xl flex items-center justify-center text-on-primary shrink-0 transition-transform group-hover:scale-110">
                    <span class="material-symbols-outlined text-3xl">visibility</span>
                </div>
                <div>
                    <h3 class="font-headline-sm text-headline-sm text-primary mb-4">Visi Kami</h3>
                    <p class="font-body-lg text-body-lg text-on-surface-variant leading-relaxed">
                        {{ $settings['vision'] ?? 'Menjadi lembaga pendidikan Katolik unggulan yang membentuk generasi berkarakter mulia, cerdas, dan mandiri berlandaskan kasih Kristus dalam semangat kegembiraan anak-anak.' }}
                    </p>
                </div>
            </div>
        </div>
        <div class="bg-secondary-container/20 border border-secondary/10 p-10 rounded-xl flex flex-col justify-between">
            <h3 class="font-headline-sm text-headline-sm text-secondary mb-6">Misi Utama</h3>
            <ul class="space-y-4">
                <li class="flex items-start gap-3">
                    <span class="material-symbols-outlined text-secondary pt-1">church</span>
                    <span class="font-body-md text-body-md text-on-surface">Pendidikan karakter religius</span>
                </li>
                <li class="flex items-start gap-3">
                    <span class="material-symbols-outlined text-secondary pt-1">family_restroom</span>
                    <span class="font-body-md text-body-md text-on-surface">Kolaborasi aktif dengan orang tua</span>
                </li>
                <li class="flex items-start gap-3">
                    <span class="material-symbols-outlined text-secondary pt-1">eco</span>
                    <span class="font-body-md text-body-md text-on-surface">Pengenalan kasih pada sesama</span>
                </li>
            </ul>
        </div>
    </div>
</section>

<!-- KEUNGGULAN -->
<section class="bg-primary py-section-gap">
    <div class="max-w-container-max mx-auto px-margin-mobile md:px-gutter">
        <div class="flex flex-col md:flex-row justify-between items-end gap-stack-md mb-16 fade-in">
            <div class="max-w-xl">
                <h2 class="font-headline-lg text-headline-lg text-on-primary mb-4">Keunggulan</h2>
                <p class="font-body-md text-body-md text-on-primary/80">Kami menyediakan lingkungan yang aman dan stimulatif untuk mendukung setiap tahap perkembangan anak.</p>
            </div>
            <div class="hidden md:block h-[2px] bg-secondary flex-grow mx-12 mb-5 opacity-30"></div>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-gutter fade-in">
            <div class="bg-primary-container p-8 rounded-xl border border-white/10 hover:border-secondary transition-colors group">
                <span class="material-symbols-outlined text-secondary-fixed text-4xl mb-6 block">school</span>
                <h4 class="font-headline-sm text-headline-sm text-on-primary mb-3">Kurikulum Holistik</h4>
                <p class="font-body-md text-body-md text-on-primary/70">Menggabungkan akademis, seni, dan nilai spiritual dalam satu kesatuan.</p>
            </div>
            <div class="bg-primary-container p-8 rounded-xl border border-white/10 hover:border-secondary transition-colors group">
                <span class="material-symbols-outlined text-secondary-fixed text-4xl mb-6 block">shield_with_heart</span>
                <h4 class="font-headline-sm text-headline-sm text-on-primary mb-3">Lingkungan Aman</h4>
                <p class="font-body-md text-body-md text-on-primary/70">Fasilitas ramah anak dengan pengawasan staf yang berdedikasi tinggi.</p>
            </div>
            <div class="bg-primary-container p-8 rounded-xl border border-white/10 hover:border-secondary transition-colors group">
                <span class="material-symbols-outlined text-secondary-fixed text-4xl mb-6 block">diversity_1</span>
                <h4 class="font-headline-sm text-headline-sm text-on-primary mb-3">Kelas Kecil</h4>
                <p class="font-body-md text-body-md text-on-primary/70">Rasio guru dan siswa yang ideal untuk perhatian yang personal.</p>
            </div>
            <div class="bg-primary-container p-8 rounded-xl border border-white/10 hover:border-secondary transition-colors group">
                <span class="material-symbols-outlined text-secondary-fixed text-4xl mb-6 block">menu_book</span>
                <h4 class="font-headline-sm text-headline-sm text-on-primary mb-3">Metode Aktif</h4>
                <p class="font-body-md text-body-md text-on-primary/70">Belajar melalui bermain dan eksplorasi yang menyenangkan.</p>
            </div>
        </div>
    </div>
</section>

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
                <form class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="font-label-md text-label-md text-on-surface-variant">Nama Lengkap</label>
                            <input class="w-full px-4 py-3 rounded-lg border border-outline-variant bg-surface-bright font-body-md text-body-md focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/10 transition-all" placeholder="Masukkan nama Anda" type="text">
                        </div>
                        <div class="space-y-2">
                            <label class="font-label-md text-label-md text-on-surface-variant">Alamat Email</label>
                            <input class="w-full px-4 py-3 rounded-lg border border-outline-variant bg-surface-bright font-body-md text-body-md focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/10 transition-all" placeholder="nama@email.com" type="email">
                        </div>
                    </div>
                    <div class="space-y-2">
                        <label class="font-label-md text-label-md text-on-surface-variant">Subjek</label>
                        <select class="w-full px-4 py-3 rounded-lg border border-outline-variant bg-surface-bright font-body-md text-body-md focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/10 transition-all appearance-none">
                            <option>Informasi Pendaftaran</option>
                            <option>Kurikulum & Kegiatan</option>
                            <option>Jadwal Kunjungan</option>
                            <option>Lainnya</option>
                        </select>
                    </div>
                    <div class="space-y-2">
                        <label class="font-label-md text-label-md text-on-surface-variant">Pesan</label>
                        <textarea class="w-full px-4 py-3 rounded-lg border border-outline-variant bg-surface-bright font-body-md text-body-md focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/10 transition-all" placeholder="Tuliskan pertanyaan atau pesan Anda di sini..." rows="5"></textarea>
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
                            <span class="font-label-md">07:30 - 14:00</span>
                        </li>
                        <li class="flex justify-between items-center border-b border-on-primary/10 pb-2">
                            <span class="font-body-md">Sabtu</span>
                            <span class="font-label-md">08:00 - 12:00</span>
                        </li>
                        <li class="flex justify-between items-center text-on-primary/60">
                            <span class="font-body-md">Minggu & Libur</span>
                            <span class="font-label-md">Tutup</span>
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

<!-- MAP -->
<section class="pb-section-gap px-margin-mobile md:px-gutter max-w-container-max mx-auto">
    <div class="rounded-2xl overflow-hidden border border-primary/10 shadow-sm h-[450px] relative bg-surface-container-low">
        @if(!empty($settings['address']))
            <iframe class="w-full h-full border-0"
                    src="https://maps.google.com/maps?q={{ urlencode($settings['address']) }}&t=&z=15&ie=UTF8&iwloc=&output=embed"
                    allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        @else
            <div class="w-full h-full flex flex-col items-center justify-center text-on-surface-variant">
                <span class="material-symbols-outlined text-4xl text-outline mb-3">map</span>
                <p class="font-label-md">Peta Belum Tersedia</p>
            </div>
        @endif
        <div class="absolute bottom-6 left-6 right-6 md:right-auto md:w-80 bg-surface-container-lowest/90 backdrop-blur-md p-6 rounded-xl shadow-xl">
            <div class="flex items-center gap-2 text-primary mb-2">
                <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">location_on</span>
                <span class="font-label-md text-label-md uppercase">Lokasi Kami</span>
            </div>
            <p class="font-body-md text-body-md text-on-surface mb-4">{{ $settings['address'] ?? 'Akses mudah dari jalan utama dengan area parkir yang aman.' }}</p>
        </div>
    </div>
</section>

@endsection

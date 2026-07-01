@extends('layouts.public')

@section('title', $settings['school_name'] ?? 'Taman Seminari')

@section('content')

<style>
    .bg-motif-grid {
        background-image: radial-gradient(#e2e8f0 1.5px, transparent 1.5px);
        background-size: 32px 32px;
    }
    .bg-motif-dots {
        background-image: radial-gradient(#cbd5e1 1.5px, transparent 1.5px), radial-gradient(#cbd5e1 1.5px, transparent 1.5px);
        background-position: 0 0, 16px 16px;
        background-size: 32px 32px;
    }
    .bg-motif-lines {
        background-image: repeating-linear-gradient(45deg, #f1f5f9, #f1f5f9 2px, transparent 2px, transparent 16px);
    }

    /* Scroll reveal */
    .fade-up { opacity:0; transform:translateY(28px); transition: opacity .65s ease, transform .65s ease; }
    .fade-up.in  { opacity:1; transform:translateY(0); }

    /* Cards */
    .hover-card-premium { transition: all 0.4s cubic-bezier(0.4,0,0.2,1); }
    .hover-card-premium:hover { transform: translateY(-10px); box-shadow: 0 28px 52px -10px rgba(0,0,0,0.13); }
    .card-top-blue   { border-top: 3px solid #3b82f6; }
    .card-top-cyan   { border-top: 3px solid #06b6d4; }
    .card-top-purple { border-top: 3px solid #a855f7; }

    /* Section number watermark */
    .sec-num {
        position:absolute; top:1.5rem; right:2rem;
        font-size:8rem; font-weight:900; color:#f1f5f9;
        line-height:1; pointer-events:none; user-select:none;
        letter-spacing:-0.05em; z-index:0;
    }

    /* Pill buttons */
    .pill-btn {
        display:inline-flex; align-items:center; gap:.5rem;
        padding:.65rem 1.5rem; border-radius:9999px;
        font-weight:700; font-size:.875rem; border:1.5px solid;
        transition: all .3s cubic-bezier(.4,0,.2,1);
        text-decoration:none; letter-spacing:.01em;
    }
    .pill-btn:hover { transform:translateY(-3px); box-shadow:0 10px 24px -4px rgba(0,0,0,.18); }
    .pill-btn-solid  { color:white; border-color:transparent; }
    .pill-btn-outline{ background:transparent; }
    .pill-btn svg { transition:transform .3s ease; }
    .pill-btn:hover svg { transform:translateX(4px); }

    /* Section label rule */
    .sec-label {
        display:inline-flex; align-items:center; gap:.6rem;
        font-size:.7rem; font-weight:800; letter-spacing:.12em; text-transform:uppercase;
    }
    .sec-label::before {
        content:''; display:block; width:2rem; height:2.5px;
        border-radius:9999px; background:currentColor; flex-shrink:0;
    }
</style>
<script>
document.addEventListener('DOMContentLoaded',()=>{
    const obs=new IntersectionObserver(entries=>{
        entries.forEach((e,i)=>{ if(e.isIntersecting) setTimeout(()=>e.target.classList.add('in'), i*70); });
    },{threshold:.12});
    document.querySelectorAll('.fade-up').forEach(el=>obs.observe(el));
});
</script>

<!-- Hero Section -->
<section id="home" class="relative min-h-[90vh] flex items-center justify-center overflow-hidden bg-slate-900">
    <div x-data="{ 
            activeSlide: 0, 
            slides: [
                @foreach($banners as $banner)
                { image: '{{ asset('storage/'.$banner->image_path) }}', title: '{{ addslashes($banner->title) }}', subtitle: '{{ addslashes($banner->subtitle) }}' }{{ !$loop->last ? ',' : '' }}
                @endforeach
            ],
            init() {
                if(this.slides.length > 1) {
                    setInterval(() => { this.activeSlide = this.activeSlide === this.slides.length - 1 ? 0 : this.activeSlide + 1 }, 6000);
                }
            }
        }" class="absolute inset-0 z-0">
        
        <template x-for="(slide, index) in slides" :key="index">
            <div x-show="activeSlide === index" x-transition.opacity.duration.1500ms class="absolute inset-0">
                <div class="absolute inset-0 bg-slate-900/40 mix-blend-multiply z-10"></div>
                <div class="absolute inset-0 bg-gradient-to-t from-slate-900 via-transparent to-transparent z-10"></div>
                
                <!-- Gentle zoom effect on active slide -->
                <div class="w-full h-full transform transition-transform duration-[10000ms] ease-out scale-100" :class="{'scale-110': activeSlide === index}">
                    <img :src="slide.image" class="w-full h-full object-cover" alt="Banner">
                </div>
                
                <div class="absolute inset-0 z-20 flex flex-col items-center justify-center text-center px-4 pt-16">
                    <div class="max-w-4xl mx-auto transform transition-all duration-1000 translate-y-0 opacity-100">
                        <span x-show="slide.subtitle" x-text="slide.subtitle" class="inline-block py-1 px-4 rounded-full bg-white/20 backdrop-blur-md text-white font-medium text-sm mb-6 border border-white/30"></span>
                        <h1 x-show="slide.title" x-text="slide.title" class="text-4xl md:text-5xl lg:text-7xl font-heading font-bold text-white mb-8 leading-tight"></h1>
                        <!-- Hero CTA Pills -->
                        <div class="flex flex-wrap items-center justify-center gap-4 mt-2">
                            <a href="#about" class="pill-btn pill-btn-outline text-white border-white/50 hover:bg-white/10 backdrop-blur-sm">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                Tentang Kami
                            </a>
                            <a href="#news" class="pill-btn pill-btn-outline text-white border-white/50 hover:bg-white/10 backdrop-blur-sm">
                                Lihat Berita
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </template>
        
        @if(count($banners) == 0)
        <div class="absolute inset-0 bg-slate-800">
            <div class="absolute inset-0 z-20 flex flex-col items-center justify-center text-center px-4">
                <div class="max-w-4xl mx-auto">
                    <span class="inline-block py-1 px-4 rounded-full bg-white/10 text-white font-medium text-sm mb-6 border border-white/20">SELAMAT DATANG</span>
                    <h1 class="text-4xl md:text-6xl font-heading font-bold text-white mb-6 leading-tight">Membangun Karakter Sejak Usia Dini</h1>
                </div>
            </div>
        </div>
        @endif
    </div>
    
    <!-- Clean bottom border -->
    <div class="absolute bottom-0 left-0 w-full h-px bg-white/20 z-30"></div>
</section>

<!-- About Section -->
<section id="about" class="py-24 relative bg-slate-50 overflow-hidden">
    <div class="absolute inset-0 bg-motif-grid opacity-60"></div>
    <div class="sec-num">01</div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="bg-white rounded-[2.5rem] p-8 md:p-16 border border-slate-100 border-t-4 border-t-indigo-500 flex flex-col lg:flex-row gap-16 items-center shadow-md">
            
            <div class="lg:w-1/2 space-y-8">
                <div class="fade-up text-center">
                    <span class="sec-label text-indigo-500 mb-4 block">Profil Institusi</span>
                    <h3 class="text-4xl md:text-5xl font-heading font-extrabold text-slate-900 leading-tight mt-3">Mengenal Taman Seminari Lebih Dekat</h3>
                </div>
                <p class="text-slate-600 leading-relaxed text-lg fade-up">{{ $settings['about_text'] ?? 'Taman Seminari didedikasikan untuk menciptakan lingkungan belajar yang inspiratif dan edukatif bagi anak-anak di usia keemasan dengan standar profesional.' }}</p>
                
                <div class="grid sm:grid-cols-2 gap-8 pt-6">
                    <div class="group cursor-pointer">
                        <div class="w-14 h-14 bg-indigo-50 text-indigo-600 rounded-2xl flex items-center justify-center mb-5 group-hover:scale-110 group-hover:bg-indigo-600 group-hover:text-white transition-all duration-300">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                        </div>
                        <h4 class="font-heading font-bold text-slate-900 mb-2 text-xl group-hover:text-indigo-600 transition-colors">Visi</h4>
                        <p class="text-slate-500 text-sm leading-relaxed">{{ $settings['vision'] ?? 'Menjadi lembaga pendidikan usia dini terdepan.' }}</p>
                    </div>
                    <div class="group cursor-pointer">
                        <div class="w-14 h-14 bg-indigo-50 text-indigo-600 rounded-2xl flex items-center justify-center mb-5 group-hover:scale-110 group-hover:bg-indigo-600 group-hover:text-white transition-all duration-300">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                        </div>
                        <h4 class="font-heading font-bold text-slate-900 mb-2 text-xl group-hover:text-indigo-600 transition-colors">Misi</h4>
                        <p class="text-slate-500 text-sm leading-relaxed">{{ $settings['mission'] ?? 'Menyelenggarakan pendidikan yang interaktif dan menyenangkan.' }}</p>
                    </div>
                </div>

                <!-- About CTA Pills -->
                <div class="flex flex-wrap gap-3 pt-4">
                    <a href="#news" class="pill-btn pill-btn-solid bg-indigo-600 border-indigo-600 hover:bg-indigo-700">
                        Lihat Berita
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                    </a>
                    <a href="#contact" class="pill-btn pill-btn-outline text-indigo-600 border-indigo-200 hover:bg-indigo-50">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        Hubungi Kami
                    </a>
                </div>
            </div>

            <!-- Sleek Modern Visual Light -->
            <div class="lg:w-1/2 w-full relative">
                <div class="aspect-[4/3] rounded-[2.5rem] overflow-hidden bg-white border border-slate-100 relative group shadow-sm">
                    <div class="absolute inset-0 bg-motif-lines opacity-60"></div>
                    
                    <div class="absolute -right-16 -top-16 w-64 h-64 border-4 border-slate-100 rounded-full"></div>
                    <div class="absolute -right-8 -top-8 w-48 h-48 border-[6px] border-indigo-50 rounded-full"></div>
                    
                    <div class="absolute -left-16 -bottom-16 w-64 h-64 border-4 border-slate-100 rounded-full"></div>
                    
                    <div class="absolute inset-0 flex items-center justify-center">
                        <div class="w-24 h-24 bg-white border border-indigo-100 shadow-md rounded-3xl relative flex items-center justify-center transform group-hover:scale-110 group-hover:rotate-6 transition-all duration-500">
                            <div class="w-10 h-10 rounded-full bg-indigo-50 flex items-center justify-center">
                                <div class="w-4 h-4 rounded-full bg-indigo-600"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</section>

<!-- News Section -->
<section id="news" class="py-24 bg-white relative overflow-hidden">
    <div class="absolute inset-0 bg-motif-dots opacity-30"></div>
    <div class="sec-num">02</div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        
        <div class="mb-16 fade-up text-center">
            <span class="sec-label text-blue-500 mb-3 block">Informasi Terbaru</span>
            <h3 class="text-4xl font-heading font-extrabold text-slate-900 mb-6">Publikasi Terkini</h3>
            <a href="#activities" class="pill-btn pill-btn-outline text-blue-600 border-blue-200 hover:bg-blue-50">Kegiatan <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg></a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($newsList->take(3) as $news)
            <div class="group bg-white rounded-3xl overflow-hidden border border-slate-200 card-top-blue hover-card-premium flex flex-col relative shadow-sm fade-up">
                
                <div class="aspect-[4/3] relative overflow-hidden bg-slate-100">
                    @if($news->image_path)
                    <img src="{{ asset('storage/'.$news->image_path) }}" class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-110">
                    @else
                    <div class="w-full h-full flex items-center justify-center group-hover:scale-110 transition-transform duration-1000">
                        <svg class="w-12 h-12 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
                    </div>
                    @endif
                    <div class="absolute top-4 left-4 z-10">
                        <span class="bg-white/90 backdrop-blur-md text-blue-600 border border-slate-100 text-xs font-bold px-4 py-1.5 rounded-full shadow-sm">Berita</span>
                    </div>
                </div>
                <div class="p-8 flex flex-col flex-1 relative z-10">
                    <div class="text-xs text-blue-500 mb-4 flex items-center gap-2 font-bold">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        {{ $news->published_at ? $news->published_at->format('d M Y') : '-' }}
                    </div>
                    <h4 class="font-heading font-extrabold text-2xl text-slate-900 mb-4 group-hover:text-blue-600 transition-colors leading-snug">{{ $news->title }}</h4>
                    <p class="text-slate-600 text-base leading-relaxed line-clamp-3 mb-6">{{ $news->content }}</p>
                    
                    <div class="mt-auto flex items-center text-blue-600 font-bold text-sm group/btn">
                        Baca Selengkapnya 
                        <svg class="w-4 h-4 ml-2 transform group-hover/btn:translate-x-2 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-full py-16 text-center border border-dashed border-slate-300 rounded-3xl bg-white">
                <p class="text-slate-500 font-medium">Belum ada publikasi yang ditambahkan.</p>
            </div>
            @endforelse
        </div>

        <!-- News CTA -->
        <div class="text-center mt-12">
            <a href="#activities" class="pill-btn pill-btn-outline text-blue-600 border-blue-200 hover:bg-blue-50">
                Lihat Kegiatan Lainnya
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
            </a>
        </div>
    </div>
</section>

<!-- Activities Section -->
<section id="activities" class="py-24 bg-slate-50 relative overflow-hidden">
    <div class="absolute inset-0 bg-motif-lines opacity-50"></div>
    <div class="sec-num">03</div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

        <div class="mb-16 fade-up text-center">
            <span class="sec-label text-cyan-500 mb-3 block">Agenda Institusi</span>
            <h3 class="text-4xl font-heading font-extrabold text-slate-900 mb-6">Kegiatan Siswa</h3>
            <a href="#gallery" class="pill-btn pill-btn-solid bg-cyan-600 border-cyan-600 hover:bg-cyan-700">Lihat Galeri <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg></a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($activities->take(3) as $activity)
            <div class="group bg-white rounded-3xl overflow-hidden border border-slate-100 card-top-cyan hover-card-premium flex flex-col relative shadow-sm fade-up">
                
                <div class="aspect-[4/3] relative overflow-hidden bg-slate-100">
                    @if($activity->image_path)
                    <img src="{{ asset('storage/'.$activity->image_path) }}" class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-110">
                    @else
                    <div class="w-full h-full flex items-center justify-center group-hover:scale-110 transition-transform duration-1000 bg-slate-100">
                        <svg class="w-12 h-12 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    @endif
                    <div class="absolute top-4 left-4 z-10">
                        <span class="bg-white/90 backdrop-blur-md text-cyan-600 border border-slate-100 text-xs font-bold px-4 py-1.5 rounded-full shadow-sm">Kegiatan</span>
                    </div>
                </div>
                <div class="p-8 flex flex-col flex-1 relative z-10">
                    <div class="text-xs text-cyan-500 mb-4 flex items-center gap-2 font-bold">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        {{ $activity->activity_date ? $activity->activity_date->format('d M Y') : '-' }}
                    </div>
                    <h4 class="font-heading font-extrabold text-2xl text-slate-900 mb-4 group-hover:text-cyan-600 transition-colors leading-snug">{{ $activity->title }}</h4>
                    <p class="text-slate-600 text-base leading-relaxed line-clamp-3 mb-6">{{ $activity->description }}</p>
                    
                    <div class="mt-auto flex items-center text-cyan-600 font-bold text-sm group/btn">
                        Lihat Detail
                        <svg class="w-4 h-4 ml-2 transform group-hover/btn:translate-x-2 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-full py-16 text-center border border-dashed border-slate-300 rounded-3xl bg-white">
                <p class="text-slate-500 font-medium">Belum ada kegiatan yang ditambahkan.</p>
            </div>
            @endforelse
        </div>

        <!-- Activities CTA -->
        <div class="text-center mt-12">
            <a href="#gallery" class="pill-btn pill-btn-solid bg-cyan-600 border-cyan-600 hover:bg-cyan-700">
                Lihat Galeri Kami
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
            </a>
        </div>
    </div>
</section>

<!-- Clean Gallery Section -->
<section id="gallery" class="py-24 bg-white relative overflow-hidden">
    <div class="absolute inset-0 bg-motif-grid opacity-40"></div>
    <div class="sec-num">04</div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="mb-16 fade-up text-center">
            <span class="sec-label text-purple-500 mb-3 block">Portofolio</span>
            <h3 class="text-4xl font-heading font-extrabold text-slate-900 mb-6">Galeri Dokumentasi</h3>
            <a href="#faq" class="pill-btn pill-btn-outline text-purple-600 border-purple-200 hover:bg-purple-50">FAQ <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg></a>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 md:gap-6">
            @forelse($galleries as $gallery)
            <div class="group relative aspect-square rounded-3xl overflow-hidden bg-white cursor-pointer border border-slate-200 hover-card-premium transition-all duration-500 shadow-sm fade-up">
                <img src="{{ asset('storage/'.$gallery->image_path) }}" class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-110">
                
                <!-- Dark gradient overlay on hover -->
                <div class="absolute inset-0 bg-gradient-to-t from-slate-900/90 via-slate-900/40 to-transparent opacity-0 group-hover:opacity-100 transition-all duration-500 flex flex-col justify-end p-6 md:p-8">
                    <div class="transform translate-y-8 group-hover:translate-y-0 transition-transform duration-500">
                        <div class="w-10 h-10 bg-white/20 backdrop-blur-md rounded-full flex items-center justify-center mb-3 text-white border border-white/30">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                        </div>
                        <p class="text-white font-bold text-lg leading-snug">{{ $gallery->title ?: 'Dokumentasi' }}</p>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-full py-16 text-center border border-dashed border-slate-300 rounded-3xl bg-white">
                <p class="text-slate-500 font-medium">Galeri masih kosong.</p>
            </div>
            @endforelse
        </div>

        <!-- Gallery CTA -->
        <div class="text-center mt-12">
            <a href="#faq" class="pill-btn pill-btn-outline text-purple-600 border-purple-200 hover:bg-purple-50">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                Punya Pertanyaan?
            </a>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section id="faq" class="py-24 bg-slate-50 relative overflow-hidden">
    <div class="absolute inset-0 bg-motif-dots opacity-30"></div>
    <div class="sec-num">05</div>
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="mb-16 fade-up text-center">
            <span class="sec-label text-teal-500 mb-3 block">Pusat Informasi</span>
            <h3 class="text-4xl font-heading font-extrabold text-slate-900 mb-6">Pertanyaan Umum</h3>
            <a href="#contact" class="pill-btn pill-btn-solid bg-teal-600 border-teal-600 hover:bg-teal-700">Hubungi Kami <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg></a>
        </div>

        <div class="space-y-4" x-data="{ active: null }">
            @forelse($faqs as $faq)
            <div class="border bg-white rounded-3xl overflow-hidden transition-all duration-500 shadow-sm fade-up" :class="{'border-teal-400 shadow-md scale-[1.02]': active === {{ $faq->id }}, 'border-slate-200 hover:border-slate-300': active !== {{ $faq->id }}}">
                <button @click="active !== {{ $faq->id }} ? active = {{ $faq->id }} : active = null" class="w-full text-left px-8 py-6 flex items-center justify-between focus:outline-none bg-white relative z-10">
                    <h4 class="font-extrabold text-lg transition-colors duration-300" :class="{'text-teal-600': active === {{ $faq->id }}, 'text-slate-900': active !== {{ $faq->id }}}">{{ $faq->question }}</h4>
                    <span class="ml-6 flex items-center justify-center w-10 h-10 rounded-full transition-all duration-500 border" :class="{'rotate-180 bg-teal-600 text-white border-teal-600': active === {{ $faq->id }}, 'bg-slate-50 text-slate-400 border-slate-200': active !== {{ $faq->id }}}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path></svg>
                    </span>
                </button>
                <div x-show="active === {{ $faq->id }}" x-collapse style="display: none; background-color: #fff; position: relative; z-10;">
                    <div class="px-8 pb-8 text-slate-600 text-base leading-relaxed">
                        {{ $faq->answer }}
                    </div>
                </div>
            </div>
            @empty
            <div class="text-center py-12 text-slate-500 border border-dashed border-slate-300 rounded-3xl bg-slate-50 relative z-10">Belum ada FAQ.</div>
            @endforelse
        </div>

        <!-- FAQ CTA -->
        <div class="text-center mt-12">
            <a href="#contact" class="pill-btn pill-btn-solid bg-teal-600 border-teal-600 hover:bg-teal-700">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                Hubungi Kami
            </a>
        </div>
    </div>
</section>

<!-- Contact & Map Section -->
<section id="contact" class="py-24 bg-white relative overflow-hidden">
    <div class="absolute inset-0 bg-motif-lines opacity-40"></div>
    <div class="sec-num">06</div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

        <!-- Section Header -->
        <div class="mb-16 fade-up text-center">
            <span class="sec-label text-sky-500 mb-3 block">Lokasi & Kontak</span>
            <h3 class="text-4xl font-heading font-extrabold text-slate-900">Mari Berkunjung</h3>
        </div>

        <!-- Two-column card: Info + Map -->
        <div class="rounded-[2.5rem] overflow-hidden border border-slate-200 grid grid-cols-1 lg:grid-cols-2 min-h-[420px] bg-white relative group shadow-xl">
            
            <!-- Info Side -->
            <div class="relative bg-transparent text-slate-900 flex flex-col justify-center px-10 py-12 lg:px-16 lg:pr-20 z-10">
                <div class="relative z-10">
                    <h4 class="text-3xl font-heading font-extrabold mb-8 text-slate-900">Informasi Kontak</h4>
                    <div class="space-y-8">
                        @if(!empty($settings['address']))
                        <div class="flex gap-6 items-start group/item">
                            <div class="w-14 h-14 rounded-2xl bg-sky-50 border border-sky-100 text-sky-600 flex items-center justify-center shrink-0 group-hover/item:scale-110 group-hover/item:bg-sky-600 group-hover/item:text-white transition-all duration-300 shadow-sm">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            </div>
                            <div>
                                <p class="text-sky-600 text-xs uppercase tracking-widest font-bold mb-2">Alamat</p>
                                <p class="text-slate-600 text-base leading-relaxed">{{ $settings['address'] }}</p>
                            </div>
                        </div>
                        @endif

                        @if(!empty($settings['phone']))
                        <div class="flex gap-6 items-start group/item">
                            <div class="w-14 h-14 rounded-2xl bg-sky-50 border border-sky-100 text-sky-600 flex items-center justify-center shrink-0 group-hover/item:scale-110 group-hover/item:bg-sky-600 group-hover/item:text-white transition-all duration-300 shadow-sm">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                            </div>
                            <div>
                                <p class="text-sky-600 text-xs uppercase tracking-widest font-bold mb-2">Telepon / WhatsApp</p>
                                <p class="text-slate-800 text-base font-medium">{{ $settings['phone'] }}</p>
                            </div>
                        </div>
                        <div class="pt-8">
                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings['phone']) }}" target="_blank"
                               class="group/wa inline-flex items-center justify-center w-full gap-3 px-8 py-5 bg-sky-600 hover:bg-sky-500 text-white shadow-[0_8px_20px_rgba(2,132,199,0.2)] rounded-2xl font-bold text-base transition-all duration-300 hover:-translate-y-1">
                                Hubungi via WhatsApp
                                <svg class="w-5 h-5 transform group-hover/wa:translate-x-1 group-hover/wa:-translate-y-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                            </a>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Map Side -->
            <div class="h-[360px] lg:h-auto bg-slate-100 relative opacity-90 group-hover:opacity-100 transition-opacity">
                <div class="absolute inset-0 border-l border-slate-200 z-20 pointer-events-none"></div>
                @if(!empty($settings['address']))
                    <!-- Standard clean light map style -->
                    <iframe class="absolute inset-0 w-full h-full border-0 filter grayscale opacity-70 hover:opacity-100 hover:grayscale-0 transition-all duration-1000" 
                            src="https://maps.google.com/maps?q={{ urlencode($settings['address']) }}&t=&z=15&ie=UTF8&iwloc=&output=embed" 
                            allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                @else
                    <div class="absolute inset-0 flex flex-col items-center justify-center text-slate-400 bg-slate-100">
                        <svg class="w-12 h-12 mb-3 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"></path></svg>
                        <p class="font-semibold text-slate-400 text-sm">Peta Belum Tersedia</p>
                    </div>
                @endif
            </div>

        </div>
    </div>
</section>

@endsection


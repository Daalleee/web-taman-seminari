@extends('layouts.public')

@section('title', $settings['school_name'] ?? 'Taman Seminari')

@section('content')

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
                        <h1 x-show="slide.title" x-text="slide.title" class="text-4xl md:text-5xl lg:text-7xl font-heading font-bold text-white mb-6 leading-tight"></h1>
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
    
    <!-- Clean bottom curve -->
    <div class="absolute bottom-0 left-0 w-full overflow-hidden leading-none z-30 pointer-events-none">
        <svg viewBox="0 0 1200 120" preserveAspectRatio="none" class="w-full h-16 md:h-24 text-[#FAFAFA]" fill="currentColor">
            <path d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z" opacity=".25"></path>
            <path d="M0,0V15.81C13,36.92,27.64,56.86,47.69,72.05,99.41,111.27,165,111,224.58,91.58c31.15-10.15,60.09-26.07,89.67-39.8,40.92-19,84.73-46,130.83-49.67,36.26-2.85,70.9,9.42,98.6,31.56,31.77,25.39,62.32,62,103.63,73,40.44,10.79,81.35-6.69,119.13-24.28s75.16-39,116.92-43.05c59.73-5.85,113.28,22.88,168.9,38.84,30.2,8.66,59,6.17,87.09-7.5,22.43-10.89,48-26.93,60.65-49.24V0Z" opacity=".5"></path>
            <path d="M0,0V5.63C149.93,59,314.09,71.32,475.83,42.57c43-7.64,84.23-20.12,127.61-26.46,59-8.63,112.48,12.24,165.56,35.4C827.93,77.22,886,95.24,951.2,90c86.53-7,172.46-45.71,248.8-84.81V0Z" transform="translate(0 120) scale(1 -1)"></path>
        </svg>
    </div>
</section>

<!-- About Section -->
<section id="about" class="py-24 relative bg-[#FAFAFA]">
    <div class="absolute inset-0 bg-grid-pattern opacity-30 pointer-events-none"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="bg-white rounded-3xl p-8 md:p-16 shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-slate-100 flex flex-col lg:flex-row gap-12 items-center">
            
            <div class="lg:w-1/2 space-y-6">
                <span class="inline-block py-1.5 px-4 rounded-full bg-indigo-50 text-indigo-600 font-semibold text-sm tracking-wide">Tentang Kami</span>
                <h3 class="text-3xl md:text-4xl font-heading font-bold text-slate-800 leading-tight">Mengenal Taman Seminari Lebih Dekat</h3>
                <p class="text-slate-500 leading-relaxed text-lg">{{ $settings['about_text'] ?? 'Taman Seminari didedikasikan untuk menciptakan lingkungan belajar yang inspiratif dan edukatif bagi anak-anak di usia keemasan.' }}</p>
                
                <div class="grid sm:grid-cols-2 gap-6 pt-6">
                    <div class="p-6 bg-slate-50 rounded-2xl border border-slate-100">
                        <div class="w-10 h-10 bg-indigo-100 text-indigo-600 rounded-xl flex items-center justify-center mb-4">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                        </div>
                        <h4 class="font-heading font-semibold text-slate-800 mb-2">Visi</h4>
                        <p class="text-slate-500 text-sm leading-relaxed">{{ $settings['vision'] ?? 'Menjadi lembaga pendidikan usia dini terdepan.' }}</p>
                    </div>
                    <div class="p-6 bg-slate-50 rounded-2xl border border-slate-100">
                        <div class="w-10 h-10 bg-teal-100 text-teal-600 rounded-xl flex items-center justify-center mb-4">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                        </div>
                        <h4 class="font-heading font-semibold text-slate-800 mb-2">Misi</h4>
                        <p class="text-slate-500 text-sm leading-relaxed">{{ $settings['mission'] ?? 'Menyelenggarakan pendidikan yang interaktif dan menyenangkan.' }}</p>
                    </div>
                </div>
            </div>

            <!-- Abstract Visual -->
            <div class="lg:w-1/2 w-full relative">
                <div class="aspect-square md:aspect-[4/3] rounded-3xl overflow-hidden bg-slate-100 relative">
                    <!-- If we had a specific about image, we'd put it here. Let's use a nice gradient placeholder -->
                    <div class="absolute inset-0 bg-gradient-to-tr from-indigo-100 via-purple-50 to-teal-50"></div>
                    <div class="absolute inset-0 bg-dots-pattern opacity-40"></div>
                    <div class="absolute inset-0 flex items-center justify-center">
                        <!-- Clean abstract shapes -->
                        <div class="w-48 h-48 rounded-full bg-white/60 backdrop-blur-md absolute mix-blend-overlay shadow-lg"></div>
                        <div class="w-32 h-64 rounded-full bg-indigo-200/40 absolute -ml-32 mix-blend-multiply rotate-45"></div>
                        <div class="w-40 h-40 rounded-3xl bg-teal-200/40 absolute ml-32 -mt-24 mix-blend-multiply -rotate-12"></div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</section>

<!-- News & Activities Section (Combined Layout) -->
<section id="news" class="py-24 bg-white relative">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 gap-6">
            <div class="max-w-2xl">
                <span class="inline-block py-1.5 px-4 rounded-full bg-indigo-50 text-indigo-600 font-semibold text-sm tracking-wide mb-4">Informasi Terbaru</span>
                <h3 class="text-3xl md:text-4xl font-heading font-bold text-slate-800">Berita & Kegiatan</h3>
            </div>
            <div class="flex gap-2" x-data="{ filter: 'all' }">
                <!-- Optional filter buttons could go here -->
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8" id="activities">
            <!-- Interleave News and Activities up to 6 items total for clean look -->
            @php
                $items = collect();
                foreach($newsList as $n) { $items->push((object)['type' => 'news', 'data' => $n, 'date' => $n->published_at]); }
                foreach($activities as $a) { $items->push((object)['type' => 'activity', 'data' => $a, 'date' => $a->activity_date]); }
                $sortedItems = $items->sortByDesc('date')->take(6);
            @endphp

            @forelse($sortedItems as $item)
            <div class="group bg-white rounded-3xl overflow-hidden border border-slate-100 hover-lift flex flex-col">
                <div class="aspect-[4/3] relative overflow-hidden bg-slate-100">
                    @if($item->data->image_path)
                    <img src="{{ asset('storage/'.$item->data->image_path) }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                    @else
                    <div class="w-full h-full bg-slate-50 flex items-center justify-center">
                        <svg class="w-12 h-12 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    </div>
                    @endif
                    
                    <div class="absolute top-4 left-4 flex gap-2">
                        @if($item->type === 'news')
                        <span class="bg-white/90 backdrop-blur-sm text-indigo-600 text-xs font-semibold px-3 py-1 rounded-full shadow-sm">Berita</span>
                        @else
                        <span class="bg-white/90 backdrop-blur-sm text-teal-600 text-xs font-semibold px-3 py-1 rounded-full shadow-sm">Kegiatan</span>
                        @endif
                    </div>
                </div>
                <div class="p-6 flex flex-col flex-1">
                    <div class="text-sm text-slate-400 mb-3 flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        {{ $item->date ? $item->date->format('d M Y') : '-' }}
                    </div>
                    <h4 class="font-heading font-bold text-xl text-slate-800 mb-3 group-hover:text-indigo-600 transition-colors">{{ $item->data->title }}</h4>
                    <p class="text-slate-500 text-sm leading-relaxed line-clamp-3 mb-4">{{ $item->type === 'news' ? $item->data->content : $item->data->description }}</p>
                </div>
            </div>
            @empty
            <div class="col-span-full py-16 text-center border-2 border-dashed border-slate-200 rounded-3xl bg-slate-50">
                <p class="text-slate-500 font-medium">Belum ada informasi yang ditambahkan.</p>
            </div>
            @endforelse
        </div>
    </div>
</section>

<!-- Clean Gallery Section -->
<section id="gallery" class="py-24 bg-[#FAFAFA] relative border-t border-slate-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-2xl mx-auto mb-16">
            <h3 class="text-3xl md:text-4xl font-heading font-bold text-slate-800 mb-4">Galeri Dokumentasi</h3>
            <p class="text-slate-500">Momen-momen berharga dalam kegiatan belajar mengajar.</p>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 md:gap-6">
            @forelse($galleries as $gallery)
            <div class="group relative aspect-square rounded-2xl overflow-hidden bg-slate-100 cursor-pointer">
                <img src="{{ asset('storage/'.$gallery->image_path) }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                <div class="absolute inset-0 bg-slate-900/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-6">
                    <p class="text-white font-medium text-sm translate-y-4 group-hover:translate-y-0 transition-transform duration-300">{{ $gallery->title ?: 'Dokumentasi' }}</p>
                </div>
            </div>
            @empty
            <div class="col-span-full py-12 text-center">
                <p class="text-slate-500">Galeri masih kosong.</p>
            </div>
            @endforelse
        </div>
    </div>
</section>

<!-- Clean FAQ Section -->
<section class="py-24 bg-white relative border-t border-slate-100">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h3 class="text-3xl md:text-4xl font-heading font-bold text-slate-800 mb-4">Pertanyaan Umum</h3>
            <p class="text-slate-500">Informasi yang sering ditanyakan oleh orang tua.</p>
        </div>

        <div class="space-y-4" x-data="{ active: null }">
            @forelse($faqs as $faq)
            <div class="border border-slate-200 rounded-2xl bg-white overflow-hidden transition-all duration-300" :class="{'border-indigo-200 shadow-sm ring-1 ring-indigo-50': active === {{ $faq->id }}}">
                <button @click="active !== {{ $faq->id }} ? active = {{ $faq->id }} : active = null" class="w-full text-left px-6 py-5 flex items-center justify-between focus:outline-none">
                    <h4 class="font-semibold text-slate-800" :class="{'text-indigo-600': active === {{ $faq->id }}}">{{ $faq->question }}</h4>
                    <span class="ml-6 flex items-center justify-center w-8 h-8 rounded-full bg-slate-50 text-slate-500 transition-transform duration-300" :class="{'rotate-180 bg-indigo-50 text-indigo-600': active === {{ $faq->id }}}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </span>
                </button>
                <div x-show="active === {{ $faq->id }}" x-collapse style="display: none;">
                    <div class="px-6 pb-6 text-slate-500 text-sm leading-relaxed">
                        {{ $faq->answer }}
                    </div>
                </div>
            </div>
            @empty
            <div class="text-center py-8 text-slate-400">Belum ada FAQ.</div>
            @endforelse
        </div>
    </div>
</section>

<!-- Minimal Contact / Map Section -->
<section class="py-0 bg-slate-50 relative border-t border-slate-200">
    <div class="grid grid-cols-1 lg:grid-cols-2">
        <!-- Info Side -->
        <div class="px-8 py-20 lg:p-24 flex flex-col justify-center">
            <h3 class="text-3xl font-heading font-bold text-slate-800 mb-6">Mari Berkunjung</h3>
            <p class="text-slate-500 mb-10 leading-relaxed max-w-md">Kami menantikan kedatangan Anda untuk berdiskusi tentang pendidikan terbaik bagi putra-putri Anda.</p>
            
            <div class="space-y-6">
                @if(!empty($settings['address']))
                <div class="flex gap-4">
                    <div class="w-10 h-10 rounded-full bg-white border border-slate-200 flex items-center justify-center text-slate-600 shrink-0 shadow-sm">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    </div>
                    <div>
                        <p class="font-semibold text-slate-800 text-sm mb-1">Alamat</p>
                        <p class="text-slate-500 text-sm leading-relaxed">{{ $settings['address'] }}</p>
                    </div>
                </div>
                @endif
                
                @if(!empty($settings['phone']))
                <div class="flex gap-4">
                    <div class="w-10 h-10 rounded-full bg-white border border-slate-200 flex items-center justify-center text-slate-600 shrink-0 shadow-sm">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                    </div>
                    <div>
                        <p class="font-semibold text-slate-800 text-sm mb-1">Kontak</p>
                        <p class="text-slate-500 text-sm">{{ $settings['phone'] }}</p>
                    </div>
                </div>
                
                <div class="pt-6">
                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings['phone']) }}" target="_blank" class="inline-flex items-center gap-2 px-6 py-3 bg-slate-800 hover:bg-slate-700 text-white rounded-full font-medium text-sm transition-colors shadow-sm">
                        Hubungi via WhatsApp
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </a>
                </div>
                @endif
            </div>
        </div>
        
        <!-- Map Side -->
        <div class="h-[400px] lg:h-auto w-full bg-slate-200 relative">
            @if(!empty($settings['map_embed']))
                {!! str_replace('<iframe', '<iframe class="absolute inset-0 w-full h-full border-0"', $settings['map_embed']) !!}
            @else
                <div class="absolute inset-0 flex items-center justify-center text-slate-400">
                    Peta Belum Dipasang
                </div>
            @endif
        </div>
    </div>
</section>

@endsection

@extends('layouts.public')

@section('title', $news->title . ' - ' . ($settings['school_name'] ?? 'Taman Seminari'))

@section('content')

<style>
    .fade-in { opacity:0; transform:translateY(28px); transition: opacity .65s ease, transform .65s ease; }
    .fade-in.in { opacity:1; transform:translateY(0); }
</style>
<script>
document.addEventListener('DOMContentLoaded',()=>{
    const obs=new IntersectionObserver(entries=>{
        entries.forEach((e,i)=>{ if(e.isIntersecting) setTimeout(()=>e.target.classList.add('in'), i*70); });
    },{threshold:.12});
    document.querySelectorAll('.fade-in').forEach(el=>obs.observe(el));
});
</script>

<main class="max-w-container-max mx-auto px-margin-mobile md:px-gutter py-stack-lg">
    <header class="mb-section-gap text-center md:text-left fade-in">
        <a href="{{ url('/berita') }}" class="inline-flex items-center gap-1 text-secondary font-label-md text-label-md hover:gap-2 transition-all mb-4">
            <span class="material-symbols-outlined text-[18px]">arrow_back</span>
            Kembali ke Berita
        </a>
        <h1 class="font-headline-lg text-headline-lg-mobile md:text-headline-lg text-primary mb-4">{{ $news->title }}</h1>
        <p class="font-body-md text-body-md text-on-surface-variant flex items-center gap-2">
            <span class="material-symbols-outlined text-[18px]">calendar_today</span>
            {{ $news->published_at ? $news->published_at->format('d F Y') : 'Tanggal belum tersedia' }}
        </p>
    </header>

    <div class="flex flex-col lg:flex-row gap-gutter fade-in">
        <div class="flex-grow">
            @if($news->image_path)
            <div class="rounded-xl overflow-hidden border border-primary/10 mb-8">
                <img src="{{ asset('uploads/'.$news->image_path) }}" class="w-full h-auto object-cover" alt="{{ $news->title }}">
            </div>
            @endif
            <article class="font-body-lg text-body-lg text-on-surface-variant leading-relaxed space-y-4">
                {{ $news->content }}
            </article>
        </div>
        <aside class="w-full lg:w-80 space-y-stack-lg">
            <div class="bg-white border border-primary/10 rounded-xl p-6">
                <h4 class="font-headline-sm text-headline-sm text-primary mb-4">Berita Terbaru</h4>
                <div class="space-y-4">
                    @forelse($latestNews as $item)
                    <a href="{{ route('news.show', $item->id) }}" class="flex gap-3 group">
                        <div class="w-16 h-16 rounded-lg overflow-hidden shrink-0 border border-primary/5 bg-surface-container-high">
                            @if($item->image_path)
                                <div class="w-full h-full bg-cover bg-center" style="background-image: url('{{ asset('uploads/'.$item->image_path) }}')"></div>
                            @else
                                <div class="w-full h-full flex items-center justify-center">
                                    <span class="material-symbols-outlined text-2xl text-outline">article</span>
                                </div>
                            @endif
                        </div>
                        <div>
                            <h5 class="font-label-md text-label-md text-primary group-hover:text-secondary line-clamp-2 transition-colors">{{ $item->title }}</h5>
                            <span class="text-[12px] text-on-surface-variant">{{ $item->published_at ? $item->published_at->format('d M Y') : '-' }}</span>
                        </div>
                    </a>
                    @if(!$loop->last)
                    <div class="border-t border-outline-variant/30"></div>
                    @endif
                    @empty
                    <p class="text-on-surface-variant text-sm">Belum ada berita lain.</p>
                    @endforelse
                </div>
            </div>
            <a href="{{ url('/kontak') }}" class="block bg-primary text-on-primary p-6 rounded-xl text-center hover:bg-primary-container transition-all">
                <span class="material-symbols-outlined mb-2 text-secondary-fixed text-3xl block">mail</span>
                <h4 class="font-headline-sm text-headline-sm mb-2">Hubungi Kami</h4>
                <p class="font-body-md text-body-md text-on-primary/70">Info lebih lanjut tentang sekolah.</p>
            </a>
        </aside>
    </div>
</main>

@endsection

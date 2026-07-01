<!DOCTYPE html>
<html class="light" lang="id">
<head>
<meta charset="utf-8">
<meta content="width=device-width, initial-scale=1.0" name="viewport">
<title>@yield('title', 'Taman Seminari TK')</title>
@vite(['resources/css/app.css', 'resources/js/app.js'])
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Source+Serif+4:ital,opsz,wght@0,8..60,200..900;1,8..60,200..900&family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
<style>
    .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; display: inline-block; line-height: 1; }
    .scrolled-nav { background-color: rgba(251, 249, 248, 0.95); backdrop-filter: blur(8px); }
    .glass-card { background: rgba(255, 255, 255, 0.8); backdrop-filter: blur(8px); border: 1px solid rgba(0, 30, 64, 0.05); }
    .sacred-gradient { background: linear-gradient(135deg, #001e40 0%, #003366 100%); }
    html { scroll-behavior: smooth; }
</style>
</head>
<body class="bg-background text-on-surface selection:bg-secondary-fixed selection:text-on-secondary-fixed font-body-md">

<nav x-data="{ activeSection: 'home', mobileMenu: false, scrolled: false }" @scroll.window="scrolled = (window.pageYOffset > 20)"
     class="w-full top-0 sticky z-50 bg-surface dark:bg-surface-container-low border-b border-primary/10 transition-all duration-300"
     :class="{'scrolled-nav shadow-md': scrolled}">
    <div class="flex justify-between items-center max-w-container-max mx-auto px-margin-mobile md:px-gutter h-20">
        <a href="{{ url('/#home') }}" class="text-2xl font-bold tracking-tight" style="color: #001e40; font-family: 'Source Serif 4', serif;">Taman Seminari</a>
        <div class="hidden md:flex items-center gap-stack-lg">
            <a href="{{ url('/#home') }}" @click="activeSection = 'home'" :class="activeSection === 'home' ? 'text-primary font-bold border-b-2 border-secondary' : 'text-on-surface-variant hover:text-secondary'" class="font-body-md text-body-md cursor-pointer active:scale-95 transition-colors duration-200">Beranda</a>
            <a href="{{ url('/#about') }}" @click="activeSection = 'about'" :class="activeSection === 'about' ? 'text-primary font-bold border-b-2 border-secondary' : 'text-on-surface-variant hover:text-secondary'" class="font-body-md text-body-md cursor-pointer active:scale-95 transition-colors duration-200">Tentang</a>
            <a href="{{ url('/#news') }}" @click="activeSection = 'news'" :class="activeSection === 'news' ? 'text-primary font-bold border-b-2 border-secondary' : 'text-on-surface-variant hover:text-secondary'" class="font-body-md text-body-md cursor-pointer active:scale-95 transition-colors duration-200">Berita</a>
            <a href="{{ url('/#activities') }}" @click="activeSection = 'activities'" :class="activeSection === 'activities' ? 'text-primary font-bold border-b-2 border-secondary' : 'text-on-surface-variant hover:text-secondary'" class="font-body-md text-body-md cursor-pointer active:scale-95 transition-colors duration-200">Kegiatan</a>
            <a href="{{ url('/#gallery') }}" @click="activeSection = 'gallery'" :class="activeSection === 'gallery' ? 'text-primary font-bold border-b-2 border-secondary' : 'text-on-surface-variant hover:text-secondary'" class="font-body-md text-body-md cursor-pointer active:scale-95 transition-colors duration-200">Galeri</a>
            <a href="{{ url('/#faq') }}" @click="activeSection = 'faq'" :class="activeSection === 'faq' ? 'text-primary font-bold border-b-2 border-secondary' : 'text-on-surface-variant hover:text-secondary'" class="font-body-md text-body-md cursor-pointer active:scale-95 transition-colors duration-200">FAQ</a>
            <a href="{{ url('/#contact') }}" @click="activeSection = 'contact'" :class="activeSection === 'contact' ? 'text-primary font-bold border-b-2 border-secondary' : 'text-on-surface-variant hover:text-secondary'" class="font-body-md text-body-md cursor-pointer active:scale-95 transition-colors duration-200">Kontak</a>
            @auth
                <a href="{{ route('admin.dashboard') }}" class="bg-primary text-on-primary px-6 py-2.5 rounded-full font-label-md text-label-md hover:bg-primary-container transition-all active:scale-95 shadow-sm">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="bg-primary text-on-primary px-6 py-2.5 rounded-full font-label-md text-label-md hover:bg-primary-container transition-all active:scale-95 shadow-sm">Login Admin</a>
            @endauth
        </div>
        <button @click="mobileMenu = !mobileMenu" class="md:hidden text-primary p-2">
            <span class="material-symbols-outlined" x-show="!mobileMenu">menu</span>
            <span class="material-symbols-outlined" x-show="mobileMenu" style="display: none;">close</span>
        </button>
    </div>
    <div x-show="mobileMenu" x-transition class="md:hidden bg-white border-t border-primary/10" style="display: none;">
        <div class="px-margin-mobile py-stack-md space-y-stack-sm">
            <a href="{{ url('/#home') }}" @click="mobileMenu = false" class="block font-label-md text-label-md text-primary font-bold py-2">Beranda</a>
            <a href="{{ url('/#about') }}" @click="mobileMenu = false" class="block font-label-md text-label-md text-on-surface-variant hover:text-secondary py-2">Tentang</a>
            <a href="{{ url('/#news') }}" @click="mobileMenu = false" class="block font-label-md text-label-md text-on-surface-variant hover:text-secondary py-2">Berita</a>
            <a href="{{ url('/#activities') }}" @click="mobileMenu = false" class="block font-label-md text-label-md text-on-surface-variant hover:text-secondary py-2">Kegiatan</a>
            <a href="{{ url('/#gallery') }}" @click="mobileMenu = false" class="block font-label-md text-label-md text-on-surface-variant hover:text-secondary py-2">Galeri</a>
            <a href="{{ url('/#faq') }}" @click="mobileMenu = false" class="block font-label-md text-label-md text-on-surface-variant hover:text-secondary py-2">FAQ</a>
            <a href="{{ url('/#contact') }}" @click="mobileMenu = false" class="block font-label-md text-label-md text-on-surface-variant hover:text-secondary py-2">Kontak</a>
            <div class="pt-stack-sm border-t border-outline-variant/30">
                @auth
                    <a href="{{ route('admin.dashboard') }}" class="block text-center bg-primary text-on-primary px-6 py-2.5 rounded-full font-label-md">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="block text-center bg-primary text-on-primary px-6 py-2.5 rounded-full font-label-md">Login Admin</a>
                @endauth
            </div>
        </div>
    </div>
</nav>

<main>
    @yield('content')
</main>

<footer class="bg-primary w-full">
    <div class="py-8 px-margin-mobile md:px-gutter max-w-container-max mx-auto flex flex-col md:flex-row justify-between gap-6">
        <div class="max-w-sm">
            <div class="font-headline-sm text-headline-sm text-on-primary mb-3">{{ $settings['school_name'] ?? 'Taman Seminari TK' }}</div>
            <p class="font-body-md text-body-md text-on-primary/80 mb-4 leading-relaxed">
                Mendidik anak dengan kasih, membimbing mereka dengan iman, dan mempersiapkan mereka untuk masa depan yang gemilang.
            </p>
            <div class="flex gap-3">
                <a class="w-8 h-8 rounded-full border border-white/20 flex items-center justify-center hover:bg-secondary-fixed hover:text-on-secondary-fixed transition-colors" href="#">
                    <span class="material-symbols-outlined text-base">public</span>
                </a>
                <a class="w-8 h-8 rounded-full border border-white/20 flex items-center justify-center hover:bg-secondary-fixed hover:text-on-secondary-fixed transition-colors" href="#">
                    <span class="material-symbols-outlined text-base">alternate_email</span>
                </a>
                <a class="w-8 h-8 rounded-full border border-white/20 flex items-center justify-center hover:bg-secondary-fixed hover:text-on-secondary-fixed transition-colors" href="#">
                    <span class="material-symbols-outlined text-base">call</span>
                </a>
            </div>
        </div>
        <div class="grid grid-cols-2 gap-6">
            <div>
                <h5 class="font-label-md text-label-md text-secondary-fixed uppercase mb-3 tracking-widest">Navigasi</h5>
                <ul class="space-y-2">
                    <li><a href="{{ url('/#home') }}" class="font-body-md text-body-md text-on-primary/80 hover:text-secondary-fixed transition-colors">Beranda</a></li>
                    <li><a href="{{ url('/#about') }}" class="font-body-md text-body-md text-on-primary/80 hover:text-secondary-fixed transition-colors">Tentang</a></li>
                    <li><a href="{{ url('/#news') }}" class="font-body-md text-body-md text-on-primary/80 hover:text-secondary-fixed transition-colors">Berita</a></li>
                    <li><a href="{{ url('/#activities') }}" class="font-body-md text-body-md text-on-primary/80 hover:text-secondary-fixed transition-colors">Kegiatan</a></li>
                    <li><a href="{{ url('/#gallery') }}" class="font-body-md text-body-md text-on-primary/80 hover:text-secondary-fixed transition-colors">Galeri</a></li>
                    <li><a href="{{ url('/#faq') }}" class="font-body-md text-body-md text-on-primary/80 hover:text-secondary-fixed transition-colors">FAQ</a></li>
                    <li><a href="{{ url('/#contact') }}" class="font-body-md text-body-md text-on-primary/80 hover:text-secondary-fixed transition-colors">Kontak</a></li>
                </ul>
            </div>
            <div>
                <h5 class="font-label-md text-label-md text-secondary-fixed uppercase mb-3 tracking-widest">Kontak</h5>
                @if(!empty($settings['address']))
                <p class="font-body-md text-body-md text-on-primary/80 mb-2">{{ $settings['address'] }}</p>
                @endif
                @if(!empty($settings['phone']))
                <p class="font-body-md text-body-md text-on-primary/80 mb-2">{{ $settings['phone'] }}</p>
                @endif
                @if(!empty($settings['email']))
                <p class="font-body-md text-body-md text-on-primary/80">{{ $settings['email'] }}</p>
                @endif
            </div>
        </div>
    </div>
    <div class="max-w-container-max mx-auto px-margin-mobile md:px-gutter py-4 border-t border-white/10 text-center">
        <p class="font-body-md text-body-md text-on-primary/60">&copy; {{ date('Y') }} {{ $settings['school_name'] ?? 'Taman Seminari TK' }}.</p>
    </div>
</footer>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const nav = document.querySelector('nav[x-data]');
    if (!nav) return;
    const sections = document.querySelectorAll('section[id]');
    if (!sections.length) return;
    const observer = new IntersectionObserver((entries) => {
        let maxRatio = 0, maxId = 'home';
        entries.forEach(e => {
            if (e.intersectionRatio > maxRatio) {
                maxRatio = e.intersectionRatio;
                maxId = e.target.id;
            }
        });
        if (maxRatio > 0 && nav.__x) nav.__x.$data.activeSection = maxId;
    }, { threshold: [0, 0.2, 0.4, 0.6, 0.8, 1], rootMargin: '-100px 0px -40% 0px' });
    sections.forEach(s => observer.observe(s));
});
</script>
</body>
</html>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Taman Seminari')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <!-- Clean & Modern Fonts: Outfit for headings, Nunito for body -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;500;600;700&family=Outfit:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Nunito', sans-serif; background-color: #FAFAFA; }
        h1, h2, h3, h4, h5, h6, .font-heading { font-family: 'Outfit', sans-serif; }
        html { scroll-behavior: smooth; }
        
        /* Subtle Motif Backgrounds */
        .bg-grid-pattern {
            background-image: radial-gradient(#CBD5E1 1px, transparent 1px);
            background-size: 24px 24px;
        }
        .bg-dots-pattern {
            background-image: radial-gradient(#94A3B8 2px, transparent 2px);
            background-size: 30px 30px;
        }
        
        /* Smooth interactions */
        .hover-lift {
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1), box-shadow 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .hover-lift:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
    </style>
</head>
<body class="text-slate-700 antialiased overflow-x-hidden selection:bg-indigo-100 selection:text-indigo-900">

    <!-- Glassmorphism Navigation -->
    <nav x-data="{ scrolled: false, mobileMenu: false }" @scroll.window="scrolled = (window.pageYOffset > 20)" 
         class="fixed w-full z-50 transition-all duration-500 top-0 pt-4 px-4">
        <div class="max-w-6xl mx-auto">
            <div :class="{'bg-white/90 backdrop-blur-xl shadow-lg border border-slate-100 rounded-full px-6 py-3': scrolled, 'bg-transparent px-2 py-4': !scrolled}" class="flex justify-between items-center transition-all duration-500">
                
                <!-- Logo -->
                <a href="#home" class="flex items-center gap-3 group">
                    <div class="w-10 h-10 bg-indigo-600 rounded-full flex items-center justify-center text-white font-heading font-bold text-xl transition-transform group-hover:scale-105 shadow-sm">
                        TS
                    </div>
                    <span :class="{'text-slate-800': scrolled, 'text-white drop-shadow-sm': !scrolled}" class="font-heading font-bold text-xl tracking-tight transition-colors">Taman Seminari</span>
                </a>
                
                <!-- Desktop Menu -->
                <div class="hidden md:flex space-x-4 items-center">
                    <a href="#home" :class="{'text-slate-600 hover:text-indigo-600': scrolled, 'text-white/90 hover:text-white drop-shadow-sm': !scrolled}" class="font-semibold transition-all px-2 py-2 text-sm hover:-translate-y-0.5 relative after:absolute after:bottom-0 after:left-0 after:w-0 after:h-0.5 after:bg-indigo-600 after:transition-all hover:after:w-full" :class="{'after:bg-indigo-600': scrolled, 'after:bg-white': !scrolled}">Beranda</a>
                    <a href="#about" :class="{'text-slate-600 hover:text-indigo-600': scrolled, 'text-white/90 hover:text-white drop-shadow-sm': !scrolled}" class="font-semibold transition-all px-2 py-2 text-sm hover:-translate-y-0.5 relative after:absolute after:bottom-0 after:left-0 after:w-0 after:h-0.5 after:bg-indigo-600 after:transition-all hover:after:w-full" :class="{'after:bg-indigo-600': scrolled, 'after:bg-white': !scrolled}">Tentang</a>
                    <a href="#news" :class="{'text-slate-600 hover:text-indigo-600': scrolled, 'text-white/90 hover:text-white drop-shadow-sm': !scrolled}" class="font-semibold transition-all px-2 py-2 text-sm hover:-translate-y-0.5 relative after:absolute after:bottom-0 after:left-0 after:w-0 after:h-0.5 after:bg-indigo-600 after:transition-all hover:after:w-full" :class="{'after:bg-indigo-600': scrolled, 'after:bg-white': !scrolled}">Berita</a>
                    <a href="#activities" :class="{'text-slate-600 hover:text-indigo-600': scrolled, 'text-white/90 hover:text-white drop-shadow-sm': !scrolled}" class="font-semibold transition-all px-2 py-2 text-sm hover:-translate-y-0.5 relative after:absolute after:bottom-0 after:left-0 after:w-0 after:h-0.5 after:bg-indigo-600 after:transition-all hover:after:w-full" :class="{'after:bg-indigo-600': scrolled, 'after:bg-white': !scrolled}">Kegiatan</a>
                    <a href="#gallery" :class="{'text-slate-600 hover:text-indigo-600': scrolled, 'text-white/90 hover:text-white drop-shadow-sm': !scrolled}" class="font-semibold transition-all px-2 py-2 text-sm hover:-translate-y-0.5 relative after:absolute after:bottom-0 after:left-0 after:w-0 after:h-0.5 after:bg-indigo-600 after:transition-all hover:after:w-full" :class="{'after:bg-indigo-600': scrolled, 'after:bg-white': !scrolled}">Galeri</a>
                </div>

                <!-- Action Button -->
                <div class="hidden md:flex items-center">
                    @auth
                        <a href="{{ route('admin.dashboard') }}" :class="{'bg-indigo-50 text-indigo-600 hover:bg-indigo-100': scrolled, 'bg-white text-indigo-600 hover:bg-slate-50': !scrolled}" class="px-6 py-2.5 rounded-full font-bold text-sm transition-all shadow-sm hover:shadow-md hover:-translate-y-0.5">Dashboard Admin</a>
                    @else
                        <a href="{{ route('login') }}" :class="{'bg-indigo-600 text-white hover:bg-indigo-700': scrolled, 'bg-white text-slate-800 hover:bg-slate-50': !scrolled}" class="px-6 py-2.5 rounded-full font-bold text-sm transition-all shadow-sm hover:shadow-md hover:-translate-y-0.5">Login Admin</a>
                    @endauth
                </div>

                <!-- Mobile Menu Toggle -->
                <div class="md:hidden flex items-center">
                    <button @click="mobileMenu = !mobileMenu" :class="{'text-slate-800': scrolled, 'text-white': !scrolled}" class="focus:outline-none p-2 bg-black/5 rounded-full backdrop-blur-sm">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" x-show="!mobileMenu"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" x-show="mobileMenu" style="display: none;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>
            </div>
            
            <!-- Mobile Menu Dropdown -->
            <div x-show="mobileMenu" x-transition class="md:hidden mt-4 bg-white/95 backdrop-blur-xl border border-slate-100 rounded-3xl overflow-hidden shadow-xl" style="display: none;">
                <div class="px-4 py-6 space-y-2">
                    <a href="#home" @click="mobileMenu = false" class="block px-4 py-3 text-base font-semibold text-slate-700 hover:bg-indigo-50 hover:text-indigo-600 rounded-xl transition-colors">Beranda</a>
                    <a href="#about" @click="mobileMenu = false" class="block px-4 py-3 text-base font-semibold text-slate-700 hover:bg-indigo-50 hover:text-indigo-600 rounded-xl transition-colors">Tentang Kami</a>
                    <a href="#news" @click="mobileMenu = false" class="block px-4 py-3 text-base font-semibold text-slate-700 hover:bg-indigo-50 hover:text-indigo-600 rounded-xl transition-colors">Berita</a>
                    <a href="#activities" @click="mobileMenu = false" class="block px-4 py-3 text-base font-semibold text-slate-700 hover:bg-indigo-50 hover:text-indigo-600 rounded-xl transition-colors">Kegiatan</a>
                    <a href="#gallery" @click="mobileMenu = false" class="block px-4 py-3 text-base font-semibold text-slate-700 hover:bg-indigo-50 hover:text-indigo-600 rounded-xl transition-colors">Galeri</a>
                    
                    <div class="pt-4 mt-2 border-t border-slate-100">
                        @auth
                            <a href="{{ route('admin.dashboard') }}" class="block text-center px-4 py-3 text-base font-bold text-white bg-indigo-600 rounded-xl">Dashboard Admin</a>
                        @else
                            <a href="{{ route('login') }}" class="block text-center px-4 py-3 text-base font-bold text-white bg-indigo-600 rounded-xl">Login Admin</a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Clean Footer -->
    <footer class="bg-white border-t border-slate-200 pt-16 pb-8 relative overflow-hidden">
        <!-- Subtle motif -->
        <div class="absolute top-0 right-0 w-64 h-64 bg-grid-pattern opacity-30 pointer-events-none rounded-bl-full"></div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 md:grid-cols-12 gap-12 lg:gap-8 mb-12">
                
                <div class="md:col-span-5">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-8 h-8 bg-indigo-600 rounded-lg flex items-center justify-center text-white font-heading font-bold">TS</div>
                        <span class="font-heading font-bold text-xl text-slate-800">{{ $settings['school_name'] ?? 'Taman Seminari' }}</span>
                    </div>
                    <p class="text-slate-500 leading-relaxed pr-8">Menyediakan lingkungan yang kondusif, bersih, dan interaktif bagi tumbuh kembang optimal anak usia dini.</p>
                </div>
                
                <div class="md:col-span-4">
                    <h4 class="font-heading font-semibold text-slate-800 mb-6 uppercase tracking-wider text-sm">Informasi Kontak</h4>
                    <ul class="space-y-4 text-slate-600">
                        @if(!empty($settings['address']))
                        <li class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-slate-400 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            <span class="text-sm leading-relaxed">{{ $settings['address'] }}</span>
                        </li>
                        @endif
                        @if(!empty($settings['phone']))
                        <li class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-slate-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                            <span class="text-sm">{{ $settings['phone'] }}</span>
                        </li>
                        @endif
                    </ul>
                </div>

                <div class="md:col-span-3">
                    <h4 class="font-heading font-semibold text-slate-800 mb-6 uppercase tracking-wider text-sm">Tautan Cepat</h4>
                    <ul class="space-y-3">
                        <li><a href="#home" class="text-slate-500 hover:text-indigo-600 text-sm transition-colors">Beranda</a></li>
                        <li><a href="#about" class="text-slate-500 hover:text-indigo-600 text-sm transition-colors">Tentang Kami</a></li>
                        <li><a href="#activities" class="text-slate-500 hover:text-indigo-600 text-sm transition-colors">Kegiatan & Berita</a></li>
                        <li><a href="#gallery" class="text-slate-500 hover:text-indigo-600 text-sm transition-colors">Galeri Dokumentasi</a></li>
                    </ul>
                </div>
            </div>
            
            <div class="border-t border-slate-100 pt-8 flex flex-col md:flex-row items-center justify-between gap-4">
                <p class="text-sm text-slate-400">&copy; {{ date('Y') }} {{ $settings['school_name'] ?? 'Taman Seminari' }}. Hak Cipta Dilindungi.</p>
            </div>
        </div>
    </footer>

</body>
</html>

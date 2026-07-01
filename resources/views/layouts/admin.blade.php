<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Taman Seminari</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Source+Serif+4:ital,opsz,wght@0,8..60,200..900;1,8..60,200..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    <style>
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; display: inline-block; line-height: 1; }
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .animate-fade-in { animation: fadeIn 0.4s ease-out forwards; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
    </style>
</head>
<body class="bg-surface text-on-surface antialiased h-screen flex overflow-hidden">

    <!-- Sidebar -->
    <aside class="w-64 bg-primary text-white flex flex-col transition-all duration-300 shrink-0">
        <div class="px-5 pt-5 pb-2 border-b border-white/10">
            <h2 class="font-headline-sm text-headline-sm text-white leading-tight">Taman Seminari</h2>
            <p class="text-xs text-white/50">Admin Panel</p>
        </div>
        <nav class="flex-1 overflow-y-auto py-4 px-3 space-y-1">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl transition-all duration-200 text-sm {{ request()->routeIs('admin.dashboard') ? 'bg-primary-container text-white font-semibold border-l-2 border-secondary' : 'text-white/70 hover:bg-white/10 hover:text-white' }}">
                <span class="material-symbols-outlined text-[20px]">grid_view</span>
                Dashboard
            </a>
            <a href="{{ route('admin.banners') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl transition-all duration-200 text-sm {{ request()->routeIs('admin.banners') ? 'bg-primary-container text-white font-semibold border-l-2 border-secondary' : 'text-white/70 hover:bg-white/10 hover:text-white' }}">
                <span class="material-symbols-outlined text-[20px]">photo_library</span>
                Hero Banner
            </a>

            <div class="pt-3 pb-1">
                <p class="px-4 text-[11px] uppercase tracking-widest text-white/30 font-semibold">Konten</p>
            </div>
            <a href="{{ route('admin.news') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl transition-all duration-200 text-sm {{ request()->routeIs('admin.news') ? 'bg-primary-container text-white font-semibold border-l-2 border-secondary' : 'text-white/70 hover:bg-white/10 hover:text-white' }}">
                <span class="material-symbols-outlined text-[20px]">newspaper</span>
                Berita
            </a>
            <a href="{{ route('admin.activities') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl transition-all duration-200 text-sm {{ request()->routeIs('admin.activities') ? 'bg-primary-container text-white font-semibold border-l-2 border-secondary' : 'text-white/70 hover:bg-white/10 hover:text-white' }}">
                <span class="material-symbols-outlined text-[20px]">celebration</span>
                Kegiatan
            </a>
            <a href="{{ route('admin.galleries') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl transition-all duration-200 text-sm {{ request()->routeIs('admin.galleries') ? 'bg-primary-container text-white font-semibold border-l-2 border-secondary' : 'text-white/70 hover:bg-white/10 hover:text-white' }}">
                <span class="material-symbols-outlined text-[20px]">wall_art</span>
                Galeri
            </a>
            <a href="{{ route('admin.faqs') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl transition-all duration-200 text-sm {{ request()->routeIs('admin.faqs') ? 'bg-primary-container text-white font-semibold border-l-2 border-secondary' : 'text-white/70 hover:bg-white/10 hover:text-white' }}">
                <span class="material-symbols-outlined text-[20px]">help</span>
                FAQ
            </a>

            <div class="pt-3 pb-1">
                <p class="px-4 text-[11px] uppercase tracking-widest text-white/30 font-semibold">Pengaturan</p>
            </div>
            <a href="{{ route('admin.settings.profile') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl transition-all duration-200 text-sm {{ request()->routeIs('admin.settings.profile') ? 'bg-primary-container text-white font-semibold border-l-2 border-secondary' : 'text-white/70 hover:bg-white/10 hover:text-white' }}">
                <span class="material-symbols-outlined text-[20px]">school</span>
                Profil Sekolah
            </a>
            <a href="{{ route('admin.settings.vision') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl transition-all duration-200 text-sm {{ request()->routeIs('admin.settings.vision') ? 'bg-primary-container text-white font-semibold border-l-2 border-secondary' : 'text-white/70 hover:bg-white/10 hover:text-white' }}">
                <span class="material-symbols-outlined text-[20px]">visibility</span>
                Visi
            </a>
            <a href="{{ route('admin.settings.mission') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl transition-all duration-200 text-sm {{ request()->routeIs('admin.settings.mission') ? 'bg-primary-container text-white font-semibold border-l-2 border-secondary' : 'text-white/70 hover:bg-white/10 hover:text-white' }}">
                <span class="material-symbols-outlined text-[20px]">flag</span>
                Misi
            </a>
            <a href="{{ route('admin.settings.contact') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl transition-all duration-200 text-sm {{ request()->routeIs('admin.settings.contact') ? 'bg-primary-container text-white font-semibold border-l-2 border-secondary' : 'text-white/70 hover:bg-white/10 hover:text-white' }}">
                <span class="material-symbols-outlined text-[20px]">contact_phone</span>
                Kontak
            </a>
        </nav>

        <div class="p-4 border-t border-white/10">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="w-full flex items-center justify-center gap-2 px-4 py-2.5 bg-white/5 text-white/70 hover:bg-red-500 hover:text-white rounded-xl transition-colors text-sm">
                    <span class="material-symbols-outlined text-[18px]">logout</span>
                    Logout
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 flex flex-col overflow-hidden relative">
        <header class="bg-surface border-b border-primary/5 sticky top-0 z-10">
            <div class="flex items-center justify-between px-6 py-3">
                <h1 class="font-headline-sm text-headline-sm text-primary">@yield('title', 'Dashboard')</h1>
                <div class="flex items-center gap-4">
                    <a href="{{ route('home') }}" target="_blank" class="text-sm font-medium text-secondary hover:text-secondary-fixed transition-colors flex items-center gap-1.5">
                        <span class="material-symbols-outlined text-[18px]">open_in_new</span>
                        Lihat Web
                    </a>
                    <div class="flex items-center gap-3 ml-4 border-l pl-4 border-primary/10">
                        <div class="w-9 h-9 rounded-full bg-primary flex items-center justify-center text-on-primary text-sm font-bold shadow-sm">
                            {{ substr(auth()->user()->name ?? 'A', 0, 1) }}
                        </div>
                        <span class="text-sm font-medium text-on-surface hidden sm:block">{{ auth()->user()->name ?? 'Admin' }}</span>
                    </div>
                </div>
            </div>
        </header>

        <div class="flex-1 overflow-y-auto bg-surface-container-low p-6">
            @if(session('success'))
                <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)" class="mb-6 p-4 rounded-xl bg-secondary/10 border border-secondary/20 text-secondary flex items-center justify-between shadow-sm">
                    <div class="flex items-center gap-3">
                        <span class="material-symbols-outlined text-secondary text-[20px]">check_circle</span>
                        <p class="font-medium text-sm">{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            @if($errors->any())
                <div class="mb-6 p-4 rounded-xl bg-error/10 border border-error/20 text-error shadow-sm">
                    <ul class="list-disc list-inside space-y-1 text-sm">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="animate-fade-in">
                @yield('content')
            </div>
        </div>
    </main>

    @yield('modal')
</body>
</html>
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
    @stack('head')
</head>
<body x-data="{ sidebarOpen: false }" class="bg-surface text-on-surface antialiased h-screen flex overflow-hidden">

    <!-- Mobile backdrop -->
    <div x-show="sidebarOpen" @click="sidebarOpen = false" x-transition.opacity class="fixed inset-0 z-40 bg-slate-900/60 backdrop-blur-sm md:hidden" style="display: none;"></div>

    <!-- Sidebar -->
    <aside class="w-64 bg-primary text-white flex flex-col transition-all duration-300 shrink-0 fixed md:static inset-y-0 left-0 z-50 md:z-auto -translate-x-full md:translate-x-0"
           :class="{'translate-x-0': sidebarOpen}">
        <div class="flex items-center justify-between px-5 pt-5 pb-2 border-b border-white/10">
            <div>
                <h2 class="font-headline-sm text-headline-sm text-white leading-tight">Taman Seminari</h2>
                <p class="text-xs text-white/50">Admin Panel</p>
            </div>
            <button @click="sidebarOpen = false" class="md:hidden text-white/70 hover:text-white">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>
        <nav class="flex-1 overflow-y-auto py-4 px-3 space-y-1">
            <a href="{{ route('admin.dashboard') }}" @click="sidebarOpen = false" class="flex items-center gap-3 px-4 py-2.5 rounded-xl transition-all duration-200 text-sm {{ request()->routeIs('admin.dashboard') ? 'bg-primary-container text-white font-semibold border-l-2 border-secondary' : 'text-white/70 hover:bg-white/10 hover:text-white' }}">
                <span class="material-symbols-outlined text-[20px]">grid_view</span>
                Dashboard
            </a>
            <a href="{{ route('admin.banners') }}" @click="sidebarOpen = false" class="flex items-center gap-3 px-4 py-2.5 rounded-xl transition-all duration-200 text-sm {{ request()->routeIs('admin.banners') ? 'bg-primary-container text-white font-semibold border-l-2 border-secondary' : 'text-white/70 hover:bg-white/10 hover:text-white' }}">
                <span class="material-symbols-outlined text-[20px]">photo_library</span>
                Hero Banner
            </a>

            <div class="pt-3 pb-1">
                <p class="px-4 text-[11px] uppercase tracking-widest text-white/30 font-semibold">Konten</p>
            </div>
            <a href="{{ route('admin.news') }}" @click="sidebarOpen = false" class="flex items-center gap-3 px-4 py-2.5 rounded-xl transition-all duration-200 text-sm {{ request()->routeIs('admin.news') ? 'bg-primary-container text-white font-semibold border-l-2 border-secondary' : 'text-white/70 hover:bg-white/10 hover:text-white' }}">
                <span class="material-symbols-outlined text-[20px]">newspaper</span>
                Berita
            </a>
            <a href="{{ route('admin.activities') }}" @click="sidebarOpen = false" class="flex items-center gap-3 px-4 py-2.5 rounded-xl transition-all duration-200 text-sm {{ request()->routeIs('admin.activities') ? 'bg-primary-container text-white font-semibold border-l-2 border-secondary' : 'text-white/70 hover:bg-white/10 hover:text-white' }}">
                <span class="material-symbols-outlined text-[20px]">celebration</span>
                Kegiatan
            </a>
            <a href="{{ route('admin.galleries') }}" @click="sidebarOpen = false" class="flex items-center gap-3 px-4 py-2.5 rounded-xl transition-all duration-200 text-sm {{ request()->routeIs('admin.galleries') ? 'bg-primary-container text-white font-semibold border-l-2 border-secondary' : 'text-white/70 hover:bg-white/10 hover:text-white' }}">
                <span class="material-symbols-outlined text-[20px]">wall_art</span>
                Galeri
            </a>
            <a href="{{ route('admin.principal') }}" @click="sidebarOpen = false" class="flex items-center gap-3 px-4 py-2.5 rounded-xl transition-all duration-200 text-sm {{ request()->routeIs('admin.principal') ? 'bg-primary-container text-white font-semibold border-l-2 border-secondary' : 'text-white/70 hover:bg-white/10 hover:text-white' }}">
                <span class="material-symbols-outlined text-[20px]">school</span>
                Kepala Sekolah
            </a>
            <a href="{{ route('admin.teachers') }}" @click="sidebarOpen = false" class="flex items-center gap-3 px-4 py-2.5 rounded-xl transition-all duration-200 text-sm {{ request()->routeIs('admin.teachers') ? 'bg-primary-container text-white font-semibold border-l-2 border-secondary' : 'text-white/70 hover:bg-white/10 hover:text-white' }}">
                <span class="material-symbols-outlined text-[20px]">group</span>
                Guru
            </a>
            <a href="{{ route('admin.messages') }}" @click="sidebarOpen = false" class="flex items-center gap-3 px-4 py-2.5 rounded-xl transition-all duration-200 text-sm {{ request()->routeIs('admin.messages*') ? 'bg-primary-container text-white font-semibold border-l-2 border-secondary' : 'text-white/70 hover:bg-white/10 hover:text-white' }}">
                <span class="material-symbols-outlined text-[20px]">mail</span>
                Pesan
                @php $unreadCount = \App\Models\Message::unread()->count(); @endphp
                @if($unreadCount > 0)
                    <span class="ml-auto bg-red-500 text-white text-[10px] font-bold px-2 py-0.5 rounded-full min-w-[20px] text-center leading-tight">{{ $unreadCount }}</span>
                @endif
            </a>
            <a href="{{ route('admin.faqs') }}" @click="sidebarOpen = false" class="flex items-center gap-3 px-4 py-2.5 rounded-xl transition-all duration-200 text-sm {{ request()->routeIs('admin.faqs') ? 'bg-primary-container text-white font-semibold border-l-2 border-secondary' : 'text-white/70 hover:bg-white/10 hover:text-white' }}">
                <span class="material-symbols-outlined text-[20px]">help</span>
                FAQ
            </a>

            <div class="pt-3 pb-1">
                <p class="px-4 text-[11px] uppercase tracking-widest text-white/30 font-semibold">Pengaturan</p>
            </div>
            <a href="{{ route('admin.users') }}" @click="sidebarOpen = false" class="flex items-center gap-3 px-4 py-2.5 rounded-xl transition-all duration-200 text-sm {{ request()->routeIs('admin.users') ? 'bg-primary-container text-white font-semibold border-l-2 border-secondary' : 'text-white/70 hover:bg-white/10 hover:text-white' }}">
                <span class="material-symbols-outlined text-[20px]">manage_accounts</span>
                Pengguna
            </a>
            <a href="{{ route('admin.settings.profile') }}" @click="sidebarOpen = false" class="flex items-center gap-3 px-4 py-2.5 rounded-xl transition-all duration-200 text-sm {{ request()->routeIs('admin.settings.profile') ? 'bg-primary-container text-white font-semibold border-l-2 border-secondary' : 'text-white/70 hover:bg-white/10 hover:text-white' }}">
                <span class="material-symbols-outlined text-[20px]">school</span>
                Profil Sekolah
            </a>
            <a href="{{ route('admin.settings.vision') }}" @click="sidebarOpen = false" class="flex items-center gap-3 px-4 py-2.5 rounded-xl transition-all duration-200 text-sm {{ request()->routeIs('admin.settings.vision') ? 'bg-primary-container text-white font-semibold border-l-2 border-secondary' : 'text-white/70 hover:bg-white/10 hover:text-white' }}">
                <span class="material-symbols-outlined text-[20px]">visibility</span>
                Visi
            </a>
            <a href="{{ route('admin.settings.mission') }}" @click="sidebarOpen = false" class="flex items-center gap-3 px-4 py-2.5 rounded-xl transition-all duration-200 text-sm {{ request()->routeIs('admin.settings.mission') ? 'bg-primary-container text-white font-semibold border-l-2 border-secondary' : 'text-white/70 hover:bg-white/10 hover:text-white' }}">
                <span class="material-symbols-outlined text-[20px]">flag</span>
                Misi
            </a>
            <a href="{{ route('admin.settings.contact') }}" @click="sidebarOpen = false" class="flex items-center gap-3 px-4 py-2.5 rounded-xl transition-all duration-200 text-sm {{ request()->routeIs('admin.settings.contact') ? 'bg-primary-container text-white font-semibold border-l-2 border-secondary' : 'text-white/70 hover:bg-white/10 hover:text-white' }}">
                <span class="material-symbols-outlined text-[20px]">contact_phone</span>
                Kontak
            </a>
            <a href="{{ route('admin.settings.operational-hours') }}" @click="sidebarOpen = false" class="flex items-center gap-3 px-4 py-2.5 rounded-xl transition-all duration-200 text-sm {{ request()->routeIs('admin.settings.operational-hours') ? 'bg-primary-container text-white font-semibold border-l-2 border-secondary' : 'text-white/70 hover:bg-white/10 hover:text-white' }}">
                <span class="material-symbols-outlined text-[20px]">schedule</span>
                Jam Operasional
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
    <main class="flex-1 flex flex-col overflow-hidden relative min-w-0">
        <header class="bg-surface border-b border-primary/5 sticky top-0 z-10">
            <div class="flex items-center justify-between px-4 md:px-6 py-3">
                <div class="flex items-center gap-3">
                    <button @click="sidebarOpen = true" class="md:hidden text-primary p-1">
                        <span class="material-symbols-outlined text-2xl">menu</span>
                    </button>
                    <h1 class="font-headline-sm text-headline-sm text-primary truncate">@yield('title', 'Dashboard')</h1>
                </div>
                <div class="flex items-center gap-3">
                    <a href="{{ route('home') }}" target="_blank" class="text-sm font-medium text-secondary hover:text-secondary-fixed transition-colors flex items-center gap-1.5">
                        <span class="material-symbols-outlined text-[18px]">open_in_new</span>
                        <span class="hidden sm:inline">Lihat Web</span>
                    </a>
                    <div class="flex items-center gap-3 ml-2 border-l pl-3 border-primary/10">
                        <div class="w-9 h-9 rounded-full bg-primary flex items-center justify-center text-on-primary text-sm font-bold shadow-sm">
                            {{ substr(auth()->user()->name ?? 'A', 0, 1) }}
                        </div>
                        <span class="text-sm font-medium text-on-surface hidden sm:block truncate max-w-[120px]">{{ auth()->user()->name ?? 'Admin' }}</span>
                    </div>
                </div>
            </div>
        </header>

        <div class="flex-1 overflow-y-auto bg-surface-container-low p-4 md:p-6">
            @if(session('success'))
                <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)" class="mb-4 md:mb-6 p-4 rounded-xl bg-secondary/10 border border-secondary/20 text-secondary flex items-center justify-between shadow-sm">
                    <div class="flex items-center gap-3">
                        <span class="material-symbols-outlined text-secondary text-[20px]">check_circle</span>
                        <p class="font-medium text-sm">{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            @if($errors->any())
                <div class="mb-4 md:mb-6 p-4 rounded-xl bg-error/10 border border-error/20 text-error shadow-sm">
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

    <!-- Delete Confirmation Modal -->
    <div x-data="{ open: false, title: '', message: '', action: '' }" x-on:show-delete-confirm.window="open = true; title = $event.detail.title; message = $event.detail.message; action = $event.detail.action" x-show="open" class="fixed inset-0 z-[99999] overflow-y-auto" style="display: none;">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:p-0">
            <div x-show="open" @click="open = false" x-transition.opacity class="fixed inset-0 transition-opacity">
                <div class="absolute inset-0 bg-slate-900/70 backdrop-blur-sm"></div>
            </div>
            <div x-show="open" x-transition class="inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-md w-full border border-slate-100 relative z-10">
                <div class="px-6 pt-6 pb-4 text-center">
                    <div class="mx-auto w-14 h-14 rounded-full bg-red-100 flex items-center justify-center mb-4">
                        <svg class="w-7 h-7 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4.5c-.77-.833-2.694-.833-3.464 0L3.34 16.5c-.77.833.192 2.5 1.732 2.5z"></path></svg>
                    </div>
                    <h3 class="text-lg font-semibold text-slate-800 mb-2" x-text="title"></h3>
                    <p class="text-sm text-slate-500" x-text="message"></p>
                </div>
                <div class="px-6 pb-6 flex justify-center gap-3">
                    <button @click="open = false" class="px-5 py-2.5 text-sm font-medium text-slate-700 bg-white border border-slate-300 hover:bg-slate-50 rounded-xl transition-colors">Batal</button>
                    <form :action="action" method="POST" class="inline">
                        @csrf @method('DELETE')
                        <button type="submit" class="px-5 py-2.5 text-sm font-medium rounded-xl transition-colors shadow-sm flex items-center gap-2" style="background:#dc2626;color:white;">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            Ya, Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<script>
    function openMailto(email) {
        if (email) location.href = 'mailto:' + email;
    }
</script>
</body>
</html>
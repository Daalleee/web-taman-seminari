<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login CMS - Taman Seminari</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-primary antialiased min-h-screen flex items-center justify-center relative overflow-hidden">
    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute top-[-20%] left-[-10%] w-[50%] h-[50%] bg-secondary/20 rounded-full blur-3xl"></div>
        <div class="absolute bottom-[-20%] right-[-10%] w-[50%] h-[50%] bg-white/5 rounded-full blur-3xl"></div>
    </div>

    <div class="w-full max-w-md p-8 bg-white rounded-3xl shadow-2xl border border-white/10 mx-4">
        <div class="text-center mb-8">
            <div class="w-16 h-16 rounded-2xl bg-primary flex items-center justify-center mx-auto mb-4 shadow-lg">
                <span class="material-symbols-outlined text-[32px] text-secondary">school</span>
            </div>
            <h1 class="font-headline-sm text-headline-sm text-primary">Admin CMS</h1>
            <p class="text-on-surface-variant mt-1 text-sm">Administrasi Taman Seminari</p>
        </div>

        @if($errors->any())
            <div class="mb-6 p-4 rounded-xl bg-error/10 text-error text-sm border border-error/20">
                Email atau kata sandi yang Anda masukkan salah.
            </div>
        @endif

        <form method="POST" action="{{ url('/login') }}" class="space-y-5">
            @csrf
            <div>
                <label class="block text-sm font-medium text-on-surface mb-1.5">Email</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <span class="material-symbols-outlined text-[20px] text-primary/40">mail</span>
                    </div>
                    <input type="email" name="email" value="{{ old('email') }}" required class="block w-full pl-10 pr-3 py-2.5 border border-primary/10 rounded-xl focus:ring-2 focus:ring-secondary/30 focus:border-secondary sm:text-sm bg-surface-bright focus:bg-white transition-colors placeholder:text-primary/30" placeholder="Masukkan Email">
                </div>
            </div>

            <div x-data="{ show: false }">
                <label class="block text-sm font-medium text-on-surface mb-1.5">Kata Sandi</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <span class="material-symbols-outlined text-[20px] text-primary/40">lock</span>
                    </div>
                    <input :type="show ? 'text' : 'password'" name="password" required class="block w-full pl-10 pr-10 py-2.5 border border-primary/10 rounded-xl focus:ring-2 focus:ring-secondary/30 focus:border-secondary sm:text-sm bg-surface-bright focus:bg-white transition-colors placeholder:text-primary/30" placeholder="Kata Sandi">
                    <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 pr-3 flex items-center text-primary/40 hover:text-primary">
                        <span class="material-symbols-outlined text-[20px]" x-text="show ? 'visibility_off' : 'visibility'">visibility</span>
                    </button>
                </div>
            </div>

            <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-xl shadow-md text-sm font-semibold text-white bg-primary hover:bg-primary-container focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-secondary transition-all duration-200">
                Masuk ke Dashboard
            </button>
        </form>
    </div>
</body>
</html>
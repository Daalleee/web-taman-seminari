@extends('layouts.admin')

@section('title', 'Pengguna')

@section('content')
<div x-data="{ openModal: false }" class="space-y-6">
    <div class="flex justify-between items-center bg-white p-6 rounded-2xl shadow-sm border border-slate-100">
        <div>
            <h2 class="text-lg font-semibold text-slate-800">Pengguna</h2>
            <p class="text-sm text-slate-500">Kelola akun admin.</p>
        </div>
        <button @click="openModal = true" class="px-5 py-2.5 bg-primary text-white rounded-xl font-medium hover:bg-primary-container transition-colors shadow-sm flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Tambah Admin
        </button>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-x-auto">
        <table class="w-full text-left border-collapse min-w-[500px]">
            <thead>
                <tr class="bg-slate-50 border-b border-slate-100">
                    <th class="py-4 px-6 text-sm font-semibold text-slate-600">Nama</th>
                    <th class="py-4 px-6 text-sm font-semibold text-slate-600">Email</th>
                    <th class="py-4 px-6 text-sm font-semibold text-slate-600">Bergabung</th>
                    <th class="py-4 px-6 text-sm font-semibold text-slate-600 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                <tr class="border-b border-slate-100 hover:bg-slate-50/50">
                    <td class="py-4 px-6">
                        <div class="flex items-center gap-3">
                            <div class="w-9 h-9 rounded-full bg-primary flex items-center justify-center text-on-primary text-sm font-bold shadow-sm">
                                {{ substr($user->name, 0, 1) }}
                            </div>
                            <span class="font-medium text-slate-800">{{ $user->name }}</span>
                            @if($user->id === auth()->id())
                                <span class="text-[10px] bg-secondary/10 text-secondary px-2 py-0.5 rounded-full font-medium">Anda</span>
                            @endif
                        </div>
                    </td>
                    <td class="py-4 px-6 text-slate-500">{{ $user->email }}</td>
                    <td class="py-4 px-6 text-slate-500 text-sm">{{ $user->created_at->format('d M Y') }}</td>
                    <td class="py-4 px-6 text-right">
                        @if($user->id !== auth()->id())
                        <form method="POST" class="inline">
                            @csrf @method('DELETE')
                            <button type="button" @click="window.dispatchEvent(new CustomEvent('show-delete-confirm', { detail: { title: 'Hapus Admin?', message: 'Yakin ingin menghapus ' + '{{ $user->name }}' + '?', action: '{{ route('admin.users.delete', $user) }}' } }))" class="text-red-500 hover:bg-red-50 px-3 py-1.5 rounded-lg text-sm font-medium">Hapus</button>
                        </form>
                        @endif
                    </td>
                </tr>
                @empty
                <tr><td colspan="4" class="py-8 text-center text-slate-500">Belum ada pengguna.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Modal Tambah -->
    <template x-teleport="body">
        <div x-show="openModal" class="fixed inset-0 z-[9999] overflow-y-auto" style="display:none;">
            <div class="flex items-center justify-center min-h-screen px-4 sm:p-0">
                <div x-show="openModal" @click="openModal=false" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm"></div>
                <div x-show="openModal" x-transition class="bg-white rounded-2xl shadow-2xl sm:max-w-md w-full border border-slate-100 relative z-10">
                    <form action="{{ route('admin.users') }}" method="POST">@csrf
                        <div class="px-6 py-5 border-b border-slate-100 flex justify-between items-center">
                            <h3 class="text-lg font-semibold text-slate-800">Tambah Admin</h3>
                            <button type="button" @click="openModal=false" class="text-slate-400 hover:text-slate-600"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg></button>
                        </div>
                        <div class="px-6 py-5 space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-1">Nama</label>
                                <input type="text" name="name" required class="block w-full px-4 py-2.5 border border-slate-200 rounded-xl sm:text-sm bg-slate-50" placeholder="Nama lengkap">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-1">Email</label>
                                <input type="email" name="email" required class="block w-full px-4 py-2.5 border border-slate-200 rounded-xl sm:text-sm bg-slate-50" placeholder="email@contoh.com">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-1">Password</label>
                                <input type="password" name="password" required minlength="6" class="block w-full px-4 py-2.5 border border-slate-200 rounded-xl sm:text-sm bg-slate-50" placeholder="Minimal 6 karakter">
                            </div>
                        </div>
                        <div class="px-6 py-4 bg-slate-50 flex justify-end gap-3">
                            <button type="button" @click="openModal=false" class="px-4 py-2 text-sm text-slate-600 hover:bg-slate-200 rounded-xl">Batal</button>
                            <button type="submit" class="px-4 py-2 text-sm text-white bg-primary hover:bg-primary-container rounded-xl shadow-sm">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </template>
</div>
@endsection

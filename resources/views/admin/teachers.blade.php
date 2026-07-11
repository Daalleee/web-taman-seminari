@extends('layouts.admin')

@section('title', 'Guru')

@section('content')
<div x-data="{ openModal: false, editModal: false, activeItem: {} }" class="space-y-6">
    <div class="flex justify-between items-center bg-white p-6 rounded-2xl shadow-sm border border-slate-100">
        <div>
            <h2 class="text-lg font-semibold text-slate-800">Guru</h2>
            <p class="text-sm text-slate-500">Data tenaga pendidik.</p>
        </div>
        <button @click="openModal = true" class="px-5 py-2.5 bg-primary text-white rounded-xl font-medium hover:bg-primary-container transition-colors shadow-sm flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Tambah Guru
        </button>
    </div>

    @if($teachers->count() > 0)
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @foreach($teachers as $teacher)
        <div class="bg-white rounded-2xl overflow-hidden shadow-sm border border-slate-100">
            <div class="p-8">
                <div class="flex items-center gap-6">
                    <div class="w-20 h-20 rounded-full overflow-hidden bg-primary/10 shrink-0 flex items-center justify-center border-2 border-primary/10">
                        @if($teacher->photo_path)
                            <img src="{{ asset('uploads/'.$teacher->photo_path) }}" alt="{{ $teacher->name }}" class="w-full h-full object-cover">
                        @else
                            <span class="material-symbols-outlined text-primary text-4xl">person</span>
                        @endif
                    </div>
                    <div class="flex-1 min-w-0">
                        <h3 class="text-lg font-semibold text-slate-800">{{ $teacher->name }}</h3>
                        <p class="text-sm text-slate-500 mt-0.5">{{ $teacher->role }}</p>
                    </div>
                    <div class="flex gap-2 shrink-0">
                        <button @click="activeItem = {{ json_encode($teacher) }}; editModal = true" class="w-9 h-9 bg-secondary hover:bg-primary text-white rounded-xl transition-colors flex items-center justify-center shadow-sm">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                        </button>
                        <form method="POST" class="inline">@csrf @method('DELETE')
                            <button type="button" @click="window.dispatchEvent(new CustomEvent('show-delete-confirm', { detail: { title: 'Hapus Guru?', message: 'Yakin ingin menghapus ' + '{{ $teacher->name }}' + '?', action: '{{ route('admin.teachers.delete', $teacher) }}' } }))" class="w-9 h-9 bg-red-500 hover:bg-red-600 text-white rounded-xl transition-colors flex items-center justify-center shadow-sm">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @else
    <div class="bg-white rounded-2xl p-12 border border-slate-100 text-center">
        <span class="material-symbols-outlined text-5xl text-slate-300 block mb-4">group</span>
        <h3 class="text-lg font-medium text-slate-800">Belum Ada Guru</h3>
        <p class="text-slate-500 mt-1">Tambahkan data guru.</p>
    </div>
    @endif

    <!-- Modal Tambah -->
    <template x-teleport="body">
        <div x-show="openModal" class="fixed inset-0 z-[9999] overflow-y-auto" style="display:none;">
            <div class="flex items-center justify-center min-h-screen px-4 sm:p-0">
                <div x-show="openModal" @click="openModal=false" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm"></div>
                <div x-show="openModal" x-transition class="bg-white rounded-2xl shadow-2xl sm:max-w-lg w-full border border-slate-100 relative z-10">
                    <form action="{{ route('admin.teachers') }}" method="POST" enctype="multipart/form-data">@csrf
                        <div class="px-6 py-5 border-b border-slate-100 flex justify-between items-center">
                            <h3 class="text-lg font-semibold text-slate-800">Tambah Guru</h3>
                            <button type="button" @click="openModal=false" class="text-slate-400 hover:text-slate-600"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg></button>
                        </div>
                        <div class="px-6 py-5 space-y-4">
                            <div><label class="block text-sm font-medium text-slate-700 mb-1">Nama</label><input type="text" name="name" required class="block w-full px-4 py-2.5 border border-slate-200 rounded-xl sm:text-sm bg-slate-50" placeholder="Nama lengkap"></div>
                            <div><label class="block text-sm font-medium text-slate-700 mb-1">Kelas / Jabatan</label><input type="text" name="role" required class="block w-full px-4 py-2.5 border border-slate-200 rounded-xl sm:text-sm bg-slate-50" placeholder="Contoh: Guru Kelas TK A"></div>
                            <div><label class="block text-sm font-medium text-slate-700 mb-1">Foto (Opsional)</label><input type="file" name="photo" accept="image/*" class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:bg-primary/10 file:text-primary border border-slate-200 rounded-xl"></div>
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

    <!-- Modal Edit -->
    <template x-teleport="body">
        <div x-show="editModal" class="fixed inset-0 z-[9999] overflow-y-auto" style="display:none;">
            <div class="flex items-center justify-center min-h-screen px-4 sm:p-0">
                <div x-show="editModal" @click="editModal=false" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm"></div>
                <div x-show="editModal" x-transition class="bg-white rounded-2xl shadow-2xl sm:max-w-lg w-full border border-slate-100 relative z-10">
                    <form :action="`/admin/teachers/${activeItem.id}`" method="POST" enctype="multipart/form-data">@csrf
                        <div class="px-6 py-5 border-b border-slate-100 flex justify-between items-center">
                            <h3 class="text-lg font-semibold text-slate-800">Edit Guru</h3>
                            <button type="button" @click="editModal=false" class="text-slate-400 hover:text-slate-600"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg></button>
                        </div>
                        <div class="px-6 py-5 space-y-4">
                            <div><label class="block text-sm font-medium text-slate-700 mb-1">Nama</label><input type="text" name="name" x-model="activeItem.name" required class="block w-full px-4 py-2.5 border border-slate-200 rounded-xl sm:text-sm bg-slate-50"></div>
                            <div><label class="block text-sm font-medium text-slate-700 mb-1">Kelas / Jabatan</label><input type="text" name="role" x-model="activeItem.role" required class="block w-full px-4 py-2.5 border border-slate-200 rounded-xl sm:text-sm bg-slate-50"></div>
                            <div><label class="block text-sm font-medium text-slate-700 mb-1">Ganti Foto (Opsional)</label><input type="file" name="photo" accept="image/*" class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:bg-primary/10 file:text-primary border border-slate-200 rounded-xl"></div>
                        </div>
                        <div class="px-6 py-4 bg-slate-50 flex justify-end gap-3">
                            <button type="button" @click="editModal=false" class="px-4 py-2 text-sm text-slate-600 hover:bg-slate-200 rounded-xl">Batal</button>
                            <button type="submit" class="px-4 py-2 text-sm text-white bg-primary hover:bg-primary-container rounded-xl shadow-sm">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </template>
</div>
@endsection

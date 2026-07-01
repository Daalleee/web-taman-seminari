@extends('layouts.admin')

@section('title', 'Galeri Foto')

@section('content')
<div x-data="{ openModal: false, editModal: false, viewModal: false, activeItem: {} }" class="space-y-6">
    <div class="flex justify-between items-center bg-white p-6 rounded-2xl shadow-sm border border-slate-100">
        <div>
            <h2 class="text-lg font-semibold text-slate-800">Galeri Foto</h2>
            <p class="text-sm text-slate-500">Unggah foto kegiatan dan fasilitas sekolah.</p>
        </div>
        <button @click="openModal = true" class="px-5 py-2.5 bg-primary text-white rounded-xl font-medium hover:bg-primary-container transition-colors shadow-sm flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Tambah Foto
        </button>
    </div>

    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
        @forelse($galleries as $gallery)
        <div class="bg-white rounded-2xl overflow-hidden shadow-sm border border-slate-100 group relative">
            <div class="aspect-square w-full relative overflow-hidden">
                <img src="{{ asset('storage/'.$gallery->image_path) }}" alt="{{ $gallery->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                <div class="absolute inset-0 bg-slate-900/70 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-between p-4">
                    <p class="text-white text-sm font-medium truncate">{{ $gallery->title ?: 'Tanpa Keterangan' }}</p>
                    <div class="flex justify-end gap-2">
                        <button @click="activeItem = {{ json_encode($gallery) }}; viewModal = true" class="w-8 h-8 bg-secondary hover:bg-secondary-container text-white rounded-full flex items-center justify-center shadow-md">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                        </button>
                        <button @click="activeItem = {{ json_encode($gallery) }}; editModal = true" class="w-8 h-8 bg-secondary hover:bg-primary text-white rounded-full flex items-center justify-center shadow-md">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                        </button>
                        <form action="{{ route('admin.galleries.delete', $gallery) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus foto ini?');">@csrf @method('DELETE')
                            <button class="w-8 h-8 bg-red-500 hover:bg-red-600 text-white rounded-full flex items-center justify-center shadow-md">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-full bg-white rounded-2xl p-12 border border-slate-100 text-center">
            <h3 class="text-lg font-medium text-slate-800">Belum Ada Foto</h3>
            <p class="text-slate-500 mt-1">Mulai tambahkan foto ke galeri.</p>
        </div>
        @endforelse
    </div>

    <!-- Modal Tambah -->
    <template x-teleport="body">
        <div x-show="openModal" class="fixed inset-0 z-[9999] overflow-y-auto" style="display:none;">
            <div class="flex items-center justify-center min-h-screen px-4 sm:p-0">
                <div x-show="openModal" @click="openModal=false" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm"></div>
                <div x-show="openModal" x-transition class="bg-white rounded-2xl shadow-2xl sm:max-w-md w-full border border-slate-100 relative z-10">
                    <form action="{{ route('admin.galleries') }}" method="POST" enctype="multipart/form-data">@csrf
                        <div class="px-6 py-5 border-b border-slate-100 flex justify-between items-center">
                            <h3 class="text-lg font-semibold text-slate-800">Unggah Foto</h3>
                            <button type="button" @click="openModal=false" class="text-slate-400 hover:text-slate-600"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg></button>
                        </div>
                        <div class="px-6 py-5 space-y-4">
                            <div><label class="block text-sm font-medium text-slate-700 mb-1">Pilih Foto (Wajib)</label><input type="file" name="image" required accept="image/*" class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:bg-primary/10 file:text-primary border border-slate-200 rounded-xl"></div>
                            <div><label class="block text-sm font-medium text-slate-700 mb-1">Keterangan (Opsional)</label><input type="text" name="title" class="block w-full px-4 py-2.5 border border-slate-200 rounded-xl sm:text-sm bg-slate-50" placeholder="Contoh: Anak-anak bermain"></div>
                        </div>
                        <div class="px-6 py-4 bg-slate-50 flex justify-end gap-3">
                            <button type="button" @click="openModal=false" class="px-4 py-2 text-sm text-slate-600 hover:bg-slate-200 rounded-xl">Batal</button>
                            <button type="submit" class="px-4 py-2 text-sm text-white bg-primary hover:bg-primary-container rounded-xl shadow-sm">Unggah</button>
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
                <div x-show="editModal" x-transition class="bg-white rounded-2xl shadow-2xl sm:max-w-md w-full border border-slate-100 relative z-10">
                    <form :action="`/admin/galleries/${activeItem.id}`" method="POST" enctype="multipart/form-data">@csrf
                        <div class="px-6 py-5 border-b border-slate-100 flex justify-between items-center">
                            <h3 class="text-lg font-semibold text-slate-800">Edit Foto</h3>
                            <button type="button" @click="editModal=false" class="text-slate-400 hover:text-slate-600"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg></button>
                        </div>
                        <div class="px-6 py-5 space-y-4">
                            <div><label class="block text-sm font-medium text-slate-700 mb-1">Ganti Foto (Opsional)</label><input type="file" name="image" accept="image/*" class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:bg-primary/10 file:text-primary border border-slate-200 rounded-xl"></div>
                            <div><label class="block text-sm font-medium text-slate-700 mb-1">Keterangan</label><input type="text" name="title" :value="activeItem.title" class="block w-full px-4 py-2.5 border border-slate-200 rounded-xl sm:text-sm bg-slate-50"></div>
                        </div>
                        <div class="px-6 py-4 bg-slate-50 flex justify-end gap-3">
                            <button type="button" @click="editModal=false" class="px-4 py-2 text-sm text-slate-600 hover:bg-slate-200 rounded-xl">Batal</button>
                            <button type="submit" class="px-4 py-2 text-sm text-white bg-primary hover:bg-primary-container rounded-xl shadow-sm">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </template>

    <!-- Modal Lihat -->
    <template x-teleport="body">
        <div x-show="viewModal" class="fixed inset-0 z-[9999] overflow-y-auto" style="display:none;">
            <div class="flex items-center justify-center min-h-screen px-4 py-8 sm:p-0">
                <div x-show="viewModal" @click="viewModal=false" class="fixed inset-0 bg-slate-900/90 backdrop-blur-md"></div>
                <div x-show="viewModal" x-transition class="relative z-10 max-w-4xl w-full">
                    <button @click="viewModal=false" class="absolute -top-12 right-0 text-white hover:text-slate-300"><svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg></button>
                    <img x-show="activeItem.image_path" :src="`/storage/${activeItem.image_path}`" class="w-full h-auto max-h-[80vh] object-contain rounded-lg shadow-2xl">
                    <p class="text-white text-center mt-4 text-lg font-medium" x-text="activeItem.title"></p>
                </div>
            </div>
        </div>
    </template>
</div>
@endsection

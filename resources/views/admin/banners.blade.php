@extends('layouts.admin')

@section('title', 'Banner Utama')

@section('content')
<div x-data="{ openModal: false, editModal: false, activeBanner: {} }" class="space-y-6">

    <div class="flex justify-between items-center bg-white p-6 rounded-2xl shadow-sm border border-slate-100">
        <div>
            <h2 class="text-lg font-semibold text-slate-800">Kelola Banner</h2>
            <p class="text-sm text-slate-500">Gambar-gambar ini akan ditampilkan di slider halaman utama.</p>
        </div>
        <button @click="openModal = true" class="px-5 py-2.5 bg-indigo-600 text-white rounded-xl font-medium hover:bg-indigo-700 transition-colors shadow-sm flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Tambah Banner
        </button>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($banners as $banner)
        <div class="bg-white rounded-2xl overflow-hidden shadow-sm border border-slate-100 group relative flex flex-col">
            <div class="aspect-video w-full relative overflow-hidden bg-slate-100">
                <img src="{{ asset('storage/'.$banner->image_path) }}" alt="{{ $banner->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
            </div>
            <div class="p-5 flex-1 flex flex-col">
                <h3 class="font-semibold text-slate-800 text-lg truncate">{{ $banner->title ?: 'Tanpa Judul' }}</h3>
                <p class="text-sm text-slate-500 truncate mt-1 mb-4 flex-1">{{ $banner->subtitle ?: 'Tanpa Subjudul' }}</p>
                
                <div class="pt-4 border-t border-slate-100 flex justify-end gap-2 mt-auto">
                    <button @click="activeBanner = {{ json_encode($banner) }}; editModal = true" class="text-indigo-500 hover:bg-indigo-50 px-3 py-1.5 rounded-lg text-sm font-medium transition-colors flex items-center gap-1.5">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                        Edit
                    </button>
                    <form action="{{ route('admin.banners.delete', $banner) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus banner ini?');">
                        @csrf @method('DELETE')
                        <button class="text-red-500 hover:bg-red-50 px-3 py-1.5 rounded-lg text-sm font-medium transition-colors flex items-center gap-1.5">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-full bg-white rounded-2xl p-12 border border-slate-100 text-center flex flex-col items-center">
            <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center text-slate-400 mb-4">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
            </div>
            <h3 class="text-lg font-medium text-slate-800">Belum Ada Banner</h3>
            <p class="text-slate-500 mt-1">Mulai dengan menambahkan banner untuk halaman utama.</p>
        </div>
        @endforelse
    </div>

    <!-- Modal Tambah -->
    <template x-teleport="body">
        <div x-show="openModal" class="fixed inset-0 z-[9999] overflow-y-auto" style="display: none;">
            <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:p-0">
                <div x-show="openModal" @click="openModal = false" x-transition.opacity class="fixed inset-0 transition-opacity">
                    <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm"></div>
                </div>
                <div x-show="openModal" x-transition class="inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg w-full border border-slate-100 relative z-10">
                    <div class="px-6 py-5 border-b border-slate-100 flex justify-between items-center">
                        <h3 class="text-lg font-semibold text-slate-800">Tambah Banner Baru</h3>
                        <button @click="openModal = false" class="text-slate-400 hover:text-slate-600 transition-colors"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg></button>
                    </div>
                    <form action="{{ route('admin.banners') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="px-6 py-5 space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-1">Gambar Banner (Wajib)</label>
                                <input type="file" name="image" required accept="image/*" class="block w-full text-sm text-slate-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 cursor-pointer border border-slate-200 rounded-xl">
                                <p class="text-xs text-slate-500 mt-1.5">Rasio 16:9 disarankan untuk tampilan terbaik.</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-1">Judul (Opsional)</label>
                                <input type="text" name="title" class="block w-full px-4 py-2.5 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500 sm:text-sm bg-slate-50 focus:bg-white transition-colors" placeholder="Contoh: Selamat Datang di Taman Seminari">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-1">Subjudul (Opsional)</label>
                                <input type="text" name="subtitle" class="block w-full px-4 py-2.5 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500 sm:text-sm bg-slate-50 focus:bg-white transition-colors" placeholder="Contoh: Membangun generasi cerah...">
                            </div>
                        </div>
                        <div class="px-6 py-4 bg-slate-50 flex justify-end gap-3 rounded-b-2xl">
                            <button type="button" @click="openModal = false" class="px-4 py-2 text-sm font-medium text-slate-600 hover:bg-slate-200 rounded-xl transition-colors">Batal</button>
                            <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 rounded-xl shadow-sm transition-colors">Simpan Banner</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </template>

    <!-- Modal Edit -->
    <template x-teleport="body">
        <div x-show="editModal" class="fixed inset-0 z-[9999] overflow-y-auto" style="display: none;">
            <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:p-0">
                <div x-show="editModal" @click="editModal = false" x-transition.opacity class="fixed inset-0 transition-opacity">
                    <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm"></div>
                </div>
                <div x-show="editModal" x-transition class="inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg w-full border border-slate-100 relative z-10">
                    <div class="px-6 py-5 border-b border-slate-100 flex justify-between items-center">
                        <h3 class="text-lg font-semibold text-slate-800">Edit Banner</h3>
                        <button @click="editModal = false" class="text-slate-400 hover:text-slate-600 transition-colors"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg></button>
                    </div>
                    <form :action="`/admin/banners/${activeBanner.id}`" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="px-6 py-5 space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-1">Ganti Gambar (Opsional)</label>
                                <input type="file" name="image" accept="image/*" class="block w-full text-sm text-slate-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 cursor-pointer border border-slate-200 rounded-xl">
                                <p class="text-xs text-slate-500 mt-1.5">Kosongkan jika tidak ingin mengganti gambar.</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-1">Judul (Opsional)</label>
                                <input type="text" name="title" :value="activeBanner.title" class="block w-full px-4 py-2.5 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500 sm:text-sm bg-slate-50 focus:bg-white transition-colors">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-1">Subjudul (Opsional)</label>
                                <input type="text" name="subtitle" :value="activeBanner.subtitle" class="block w-full px-4 py-2.5 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500 sm:text-sm bg-slate-50 focus:bg-white transition-colors">
                            </div>
                        </div>
                        <div class="px-6 py-4 bg-slate-50 flex justify-end gap-3 rounded-b-2xl">
                            <button type="button" @click="editModal = false" class="px-4 py-2 text-sm font-medium text-slate-600 hover:bg-slate-200 rounded-xl transition-colors">Batal</button>
                            <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 rounded-xl shadow-sm transition-colors">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </template>
</div>
@endsection

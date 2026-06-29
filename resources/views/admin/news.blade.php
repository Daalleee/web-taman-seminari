@extends('layouts.admin')

@section('title', 'Berita & Pengumuman')

@section('content')
<div x-data="{ openModal: false, editModal: false, viewModal: false, activeItem: {} }" class="space-y-6">
    <div class="flex justify-between items-center bg-white p-6 rounded-2xl shadow-sm border border-slate-100">
        <div>
            <h2 class="text-lg font-semibold text-slate-800">Kelola Berita</h2>
            <p class="text-sm text-slate-500">Publikasikan berita dan pengumuman terbaru.</p>
        </div>
        <button @click="openModal = true" class="px-5 py-2.5 bg-indigo-600 text-white rounded-xl font-medium hover:bg-indigo-700 transition-colors shadow-sm flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Tambah Berita
        </button>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead><tr class="bg-slate-50 border-b border-slate-100">
                <th class="py-4 px-6 text-sm font-semibold text-slate-600">Gambar</th>
                <th class="py-4 px-6 text-sm font-semibold text-slate-600">Judul</th>
                <th class="py-4 px-6 text-sm font-semibold text-slate-600">Tanggal</th>
                <th class="py-4 px-6 text-sm font-semibold text-slate-600 text-right">Aksi</th>
            </tr></thead>
            <tbody>
                @forelse($news as $item)
                <tr class="border-b border-slate-100 hover:bg-slate-50/50">
                    <td class="py-4 px-6 w-24">
                        <div class="w-16 h-16 rounded-xl overflow-hidden bg-slate-100 border border-slate-200">
                            @if($item->image_path)
                                <img src="{{ asset('storage/'.$item->image_path) }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-slate-300"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2.5 2.5 0 00-2.5-2.5H15"></path></svg></div>
                            @endif
                        </div>
                    </td>
                    <td class="py-4 px-6 font-medium text-slate-800">{{ $item->title }}</td>
                    <td class="py-4 px-6 text-slate-500 text-sm">{{ $item->published_at ? $item->published_at->format('Y-m-d') : '-' }}</td>
                    <td class="py-4 px-6 text-right">
                        <div class="flex items-center justify-end gap-2">
                            <button @click="activeItem = {{ json_encode($item) }}; viewModal = true" class="text-teal-500 hover:bg-teal-50 px-3 py-1.5 rounded-lg text-sm font-medium">Lihat</button>
                            <button @click="activeItem = {{ json_encode($item) }}; editModal = true" class="text-indigo-500 hover:bg-indigo-50 px-3 py-1.5 rounded-lg text-sm font-medium">Edit</button>
                            <form action="{{ route('admin.news.delete', $item) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus berita ini?');">@csrf @method('DELETE')
                                <button class="text-red-500 hover:bg-red-50 px-3 py-1.5 rounded-lg text-sm font-medium">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="4" class="py-8 text-center text-slate-500">Belum ada berita.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Modal Tambah -->
    <template x-teleport="body">
        <div x-show="openModal" class="fixed inset-0 z-[9999] overflow-y-auto" style="display:none;">
            <div class="flex items-center justify-center min-h-screen px-4 sm:p-0">
                <div x-show="openModal" @click="openModal=false" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm"></div>
                <div x-show="openModal" x-transition class="bg-white rounded-2xl shadow-2xl sm:max-w-lg w-full border border-slate-100 relative z-10">
                    <form action="{{ route('admin.news') }}" method="POST" enctype="multipart/form-data">@csrf
                        <div class="px-6 py-5 border-b border-slate-100 flex justify-between items-center">
                            <h3 class="text-lg font-semibold text-slate-800">Publikasikan Berita</h3>
                            <button type="button" @click="openModal=false" class="text-slate-400 hover:text-slate-600"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg></button>
                        </div>
                        <div class="px-6 py-5 space-y-4">
                            <div><label class="block text-sm font-medium text-slate-700 mb-1">Judul</label><input type="text" name="title" required class="block w-full px-4 py-2.5 border border-slate-200 rounded-xl sm:text-sm bg-slate-50" placeholder="Masukkan judul berita"></div>
                            <div><label class="block text-sm font-medium text-slate-700 mb-1">Isi Berita</label><textarea name="content" rows="4" required class="block w-full px-4 py-2.5 border border-slate-200 rounded-xl sm:text-sm bg-slate-50" placeholder="Tulis isi berita..."></textarea></div>
                            <div><label class="block text-sm font-medium text-slate-700 mb-1">Tanggal Terbit</label><input type="date" name="published_at" value="{{ date('Y-m-d') }}" required class="block w-full px-4 py-2.5 border border-slate-200 rounded-xl sm:text-sm bg-slate-50"></div>
                            <div><label class="block text-sm font-medium text-slate-700 mb-1">Gambar Sampul (Opsional)</label><input type="file" name="image" accept="image/*" class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:bg-indigo-50 file:text-indigo-700 border border-slate-200 rounded-xl"></div>
                        </div>
                        <div class="px-6 py-4 bg-slate-50 flex justify-end gap-3">
                            <button type="button" @click="openModal=false" class="px-4 py-2 text-sm text-slate-600 hover:bg-slate-200 rounded-xl">Batal</button>
                            <button type="submit" class="px-4 py-2 text-sm text-white bg-indigo-600 hover:bg-indigo-700 rounded-xl shadow-sm">Terbitkan</button>
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
                    <form :action="`/admin/news/${activeItem.id}`" method="POST" enctype="multipart/form-data">@csrf
                        <div class="px-6 py-5 border-b border-slate-100 flex justify-between items-center">
                            <h3 class="text-lg font-semibold text-slate-800">Edit Berita</h3>
                            <button type="button" @click="editModal=false" class="text-slate-400 hover:text-slate-600"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg></button>
                        </div>
                        <div class="px-6 py-5 space-y-4">
                            <div><label class="block text-sm font-medium text-slate-700 mb-1">Judul</label><input type="text" name="title" :value="activeItem.title" required class="block w-full px-4 py-2.5 border border-slate-200 rounded-xl sm:text-sm bg-slate-50"></div>
                            <div><label class="block text-sm font-medium text-slate-700 mb-1">Isi Berita</label><textarea name="content" rows="4" :value="activeItem.content" x-text="activeItem.content" required class="block w-full px-4 py-2.5 border border-slate-200 rounded-xl sm:text-sm bg-slate-50"></textarea></div>
                            <div><label class="block text-sm font-medium text-slate-700 mb-1">Tanggal Terbit</label>
                                <!-- Kita gunakan format yang benar Y-m-d -->
                                <input type="date" name="published_at" :value="activeItem.published_at ? activeItem.published_at.substring(0,10) : ''" required class="block w-full px-4 py-2.5 border border-slate-200 rounded-xl sm:text-sm bg-slate-50">
                            </div>
                            <div><label class="block text-sm font-medium text-slate-700 mb-1">Ganti Gambar (Opsional)</label><input type="file" name="image" accept="image/*" class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:bg-indigo-50 file:text-indigo-700 border border-slate-200 rounded-xl"></div>
                        </div>
                        <div class="px-6 py-4 bg-slate-50 flex justify-end gap-3">
                            <button type="button" @click="editModal=false" class="px-4 py-2 text-sm text-slate-600 hover:bg-slate-200 rounded-xl">Batal</button>
                            <button type="submit" class="px-4 py-2 text-sm text-white bg-indigo-600 hover:bg-indigo-700 rounded-xl shadow-sm">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </template>

    <!-- Modal Lihat -->
    <template x-teleport="body">
        <div x-show="viewModal" class="fixed inset-0 z-[9999] overflow-y-auto" style="display:none;">
            <div class="flex items-center justify-center min-h-screen px-4 sm:p-0">
                <div x-show="viewModal" @click="viewModal=false" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm"></div>
                <div x-show="viewModal" x-transition class="bg-white rounded-2xl shadow-2xl sm:max-w-lg w-full border border-slate-100 relative z-10 overflow-hidden">
                    <div class="aspect-video w-full relative bg-slate-100">
                        <img x-show="activeItem.image_path" :src="`/storage/${activeItem.image_path}`" class="w-full h-full object-cover">
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-slate-800 mb-2" x-text="activeItem.title"></h3>
                        <p class="text-sm text-indigo-500 font-medium mb-4" x-text="activeItem.published_at ? activeItem.published_at.substring(0,10) : ''"></p>
                        <p class="text-slate-600 whitespace-pre-wrap" x-text="activeItem.content"></p>
                    </div>
                    <div class="px-6 py-4 bg-slate-50 border-t border-slate-100 flex justify-end">
                        <button type="button" @click="viewModal=false" class="px-5 py-2.5 text-sm font-medium text-slate-700 bg-white border border-slate-200 hover:bg-slate-50 rounded-xl shadow-sm">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
    </template>
</div>
@endsection

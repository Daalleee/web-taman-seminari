@extends('layouts.admin')

@section('title', 'Kegiatan')

@section('content')
<div x-data="{ openModal: false, editModal: false, viewModal: false, activeItem: {} }" class="space-y-6">
    <div class="flex justify-between items-center bg-white p-6 rounded-2xl shadow-sm border border-slate-100">
        <div>
            <h2 class="text-lg font-semibold text-slate-800">Kelola Kegiatan</h2>
            <p class="text-sm text-slate-500">Kegiatan dan acara sekolah.</p>
        </div>
        <button @click="openModal = true" class="px-5 py-2.5 bg-indigo-600 text-white rounded-xl font-medium hover:bg-indigo-700 transition-colors shadow-sm flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Tambah Kegiatan
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
                @forelse($activities as $activity)
                <tr class="border-b border-slate-100 hover:bg-slate-50/50">
                    <td class="py-4 px-6 w-24">
                        <div class="w-16 h-16 rounded-xl overflow-hidden bg-slate-100 border border-slate-200">
                            @if($activity->image_path)
                                <img src="{{ asset('storage/'.$activity->image_path) }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-slate-300"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg></div>
                            @endif
                        </div>
                    </td>
                    <td class="py-4 px-6 font-medium text-slate-800">{{ $activity->title }}</td>
                    <td class="py-4 px-6 text-slate-500 text-sm">{{ $activity->activity_date ? $activity->activity_date->format('Y-m-d') : '-' }}</td>
                    <td class="py-4 px-6 text-right">
                        <div class="flex items-center justify-end gap-2">
                            <button @click="activeItem = {{ json_encode($activity) }}; viewModal = true" class="text-teal-500 hover:bg-teal-50 px-3 py-1.5 rounded-lg text-sm font-medium">Lihat</button>
                            <button @click="activeItem = {{ json_encode($activity) }}; editModal = true" class="text-indigo-500 hover:bg-indigo-50 px-3 py-1.5 rounded-lg text-sm font-medium">Edit</button>
                            <form action="{{ route('admin.activities.delete', $activity) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus kegiatan ini?');">@csrf @method('DELETE')
                                <button class="text-red-500 hover:bg-red-50 px-3 py-1.5 rounded-lg text-sm font-medium">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="4" class="py-8 text-center text-slate-500">Belum ada kegiatan.</td></tr>
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
                    <form action="{{ route('admin.activities') }}" method="POST" enctype="multipart/form-data">@csrf
                        <div class="px-6 py-5 border-b border-slate-100 flex justify-between items-center">
                            <h3 class="text-lg font-semibold text-slate-800">Tambah Kegiatan</h3>
                            <button type="button" @click="openModal=false" class="text-slate-400 hover:text-slate-600"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg></button>
                        </div>
                        <div class="px-6 py-5 space-y-4">
                            <div><label class="block text-sm font-medium text-slate-700 mb-1">Judul Kegiatan</label><input type="text" name="title" required class="block w-full px-4 py-2.5 border border-slate-200 rounded-xl sm:text-sm bg-slate-50" placeholder="Contoh: Pentas Seni Anak"></div>
                            <div><label class="block text-sm font-medium text-slate-700 mb-1">Deskripsi</label><textarea name="description" rows="3" required class="block w-full px-4 py-2.5 border border-slate-200 rounded-xl sm:text-sm bg-slate-50" placeholder="Tuliskan deskripsi kegiatan..."></textarea></div>
                            <div><label class="block text-sm font-medium text-slate-700 mb-1">Tanggal Kegiatan</label><input type="date" name="activity_date" required class="block w-full px-4 py-2.5 border border-slate-200 rounded-xl sm:text-sm bg-slate-50"></div>
                            <div><label class="block text-sm font-medium text-slate-700 mb-1">Gambar (Opsional)</label><input type="file" name="image" accept="image/*" class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:bg-indigo-50 file:text-indigo-700 border border-slate-200 rounded-xl"></div>
                        </div>
                        <div class="px-6 py-4 bg-slate-50 flex justify-end gap-3">
                            <button type="button" @click="openModal=false" class="px-4 py-2 text-sm text-slate-600 hover:bg-slate-200 rounded-xl">Batal</button>
                            <button type="submit" class="px-4 py-2 text-sm text-white bg-indigo-600 hover:bg-indigo-700 rounded-xl shadow-sm">Simpan</button>
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
                    <form :action="`/admin/activities/${activeItem.id}`" method="POST" enctype="multipart/form-data">@csrf
                        <div class="px-6 py-5 border-b border-slate-100 flex justify-between items-center">
                            <h3 class="text-lg font-semibold text-slate-800">Edit Kegiatan</h3>
                            <button type="button" @click="editModal=false" class="text-slate-400 hover:text-slate-600"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg></button>
                        </div>
                        <div class="px-6 py-5 space-y-4">
                            <div><label class="block text-sm font-medium text-slate-700 mb-1">Judul Kegiatan</label><input type="text" name="title" :value="activeItem.title" required class="block w-full px-4 py-2.5 border border-slate-200 rounded-xl sm:text-sm bg-slate-50"></div>
                            <div><label class="block text-sm font-medium text-slate-700 mb-1">Deskripsi</label><textarea name="description" rows="3" :value="activeItem.description" x-text="activeItem.description" required class="block w-full px-4 py-2.5 border border-slate-200 rounded-xl sm:text-sm bg-slate-50"></textarea></div>
                            <div><label class="block text-sm font-medium text-slate-700 mb-1">Tanggal Kegiatan</label>
                                <input type="date" name="activity_date" :value="activeItem.activity_date ? activeItem.activity_date.substring(0,10) : ''" required class="block w-full px-4 py-2.5 border border-slate-200 rounded-xl sm:text-sm bg-slate-50">
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
                        <p class="text-sm text-teal-600 font-medium mb-4" x-text="activeItem.activity_date ? activeItem.activity_date.substring(0,10) : ''"></p>
                        <p class="text-slate-600 whitespace-pre-wrap" x-text="activeItem.description"></p>
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

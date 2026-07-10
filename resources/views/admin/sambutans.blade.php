@extends('layouts.admin')

@section('title', 'Kepala Sekolah & Guru')

@section('content')
<div class="space-y-8">

    <!-- KEPALA SEKOLAH -->
    <div x-data="{ editPrincipalModal: false, activeItem: {} }">
        <div class="flex justify-between items-center bg-white p-6 rounded-2xl shadow-sm border border-slate-100">
            <div>
                <h2 class="text-lg font-semibold text-slate-800">Kepala Sekolah</h2>
                <p class="text-sm text-slate-500">Data dan kata sambutan kepala sekolah.</p>
            </div>
        </div>

        @if($principal)
        <div class="mt-6 bg-white rounded-2xl shadow-sm border border-slate-100 p-6">
            <div class="flex items-start gap-6">
                <div class="w-20 h-20 rounded-full overflow-hidden bg-primary/10 shrink-0 flex items-center justify-center">
                    @if($principal->photo_path)
                        <img src="{{ asset('storage/'.$principal->photo_path) }}" alt="{{ $principal->name }}" class="w-full h-full object-cover">
                    @else
                        <span class="material-symbols-outlined text-primary text-4xl">person</span>
                    @endif
                </div>
                <div class="flex-1 min-w-0">
                    <div class="flex items-start justify-between">
                        <div>
                            <h3 class="font-semibold text-slate-800 text-lg">{{ $principal->name }}</h3>
                            <p class="text-sm text-slate-500">{{ $principal->role }}</p>
                        </div>
                        <button @click="activeItem = {{ json_encode($principal) }}; editPrincipalModal = true" class="px-4 py-2 text-sm bg-secondary hover:bg-primary text-white rounded-xl transition-colors flex items-center gap-1.5">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                            Edit
                        </button>
                    </div>
                    <p class="text-sm text-slate-600 mt-3">{{ $principal->content }}</p>
                </div>
            </div>
        </div>
        @else
        <div class="mt-6 bg-white rounded-2xl p-12 border border-slate-100 text-center">
            <span class="material-symbols-outlined text-5xl text-slate-300 block mb-4">school</span>
            <h3 class="text-lg font-medium text-slate-800">Belum Ada Kepala Sekolah</h3>
            <p class="text-slate-500 mt-1">Data kepala sekolah belum ditambahkan.</p>
        </div>
        @endif

        <!-- Modal Edit Kepala Sekolah -->
        <template x-teleport="body">
            <div x-show="editPrincipalModal" class="fixed inset-0 z-[9999] overflow-y-auto" style="display:none;">
                <div class="flex items-center justify-center min-h-screen px-4 sm:p-0">
                    <div x-show="editPrincipalModal" @click="editPrincipalModal=false" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm"></div>
                    <div x-show="editPrincipalModal" x-transition class="bg-white rounded-2xl shadow-2xl sm:max-w-lg w-full border border-slate-100 relative z-10">
                        <form :action="`/admin/sambutans/${activeItem.id}`" method="POST" enctype="multipart/form-data">@csrf
                            <div class="px-6 py-5 border-b border-slate-100 flex justify-between items-center">
                                <h3 class="text-lg font-semibold text-slate-800">Edit Kepala Sekolah</h3>
                                <button type="button" @click="editPrincipalModal=false" class="text-slate-400 hover:text-slate-600"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg></button>
                            </div>
                            <div class="px-6 py-5 space-y-4">
                                <div><label class="block text-sm font-medium text-slate-700 mb-1">Nama</label><input type="text" name="name" x-model="activeItem.name" required class="block w-full px-4 py-2.5 border border-slate-200 rounded-xl sm:text-sm bg-slate-50"></div>
                                <div><label class="block text-sm font-medium text-slate-700 mb-1">Jabatan</label><input type="text" name="role" value="Kepala Sekolah" readonly class="block w-full px-4 py-2.5 border border-slate-200 rounded-xl sm:text-sm bg-slate-100 text-slate-400 cursor-not-allowed"></div>
                                <div><label class="block text-sm font-medium text-slate-700 mb-1">Kata Sambutan</label><textarea name="content" x-model="activeItem.content" required rows="5" class="block w-full px-4 py-2.5 border border-slate-200 rounded-xl sm:text-sm bg-slate-50"></textarea></div>
                                <div><label class="block text-sm font-medium text-slate-700 mb-1">Ganti Foto (Opsional)</label><input type="file" name="photo" accept="image/*" class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:bg-primary/10 file:text-primary border border-slate-200 rounded-xl"></div>
                            </div>
                            <div class="px-6 py-4 bg-slate-50 flex justify-end gap-3">
                                <button type="button" @click="editPrincipalModal=false" class="px-4 py-2 text-sm text-slate-600 hover:bg-slate-200 rounded-xl">Batal</button>
                                <button type="submit" class="px-4 py-2 text-sm text-white bg-primary hover:bg-primary-container rounded-xl shadow-sm">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </template>
    </div>

    <!-- GURU -->
    <div x-data="{ openModal: false, editModal: false, activeItem: {} }">
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
        <div class="mt-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($teachers as $teacher)
            <div class="bg-white rounded-2xl overflow-hidden shadow-sm border border-slate-100">
                <div class="p-6">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-16 h-16 rounded-full overflow-hidden bg-primary/10 shrink-0 flex items-center justify-center">
                            @if($teacher->photo_path)
                                <img src="{{ asset('storage/'.$teacher->photo_path) }}" alt="{{ $teacher->name }}" class="w-full h-full object-cover">
                            @else
                                <span class="material-symbols-outlined text-primary text-3xl">person</span>
                            @endif
                        </div>
                        <div class="flex-1 min-w-0">
                            <h3 class="font-semibold text-slate-800 truncate">{{ $teacher->name }}</h3>
                            <p class="text-sm text-slate-500">{{ $teacher->role }}</p>
                        </div>
                    </div>
                    <div class="flex justify-end gap-2 pt-3 border-t border-slate-100">
                        <button @click="activeItem = {{ json_encode($teacher) }}; editModal = true" class="px-3 py-1.5 text-xs bg-secondary hover:bg-primary text-white rounded-lg transition-colors flex items-center gap-1">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                            Edit
                        </button>
                        <form method="POST" class="inline">@csrf @method('DELETE')
                            <button type="button" @click="window.dispatchEvent(new CustomEvent('show-delete-confirm', { detail: { title: 'Hapus Guru?', message: 'Yakin ingin menghapus ' + '{{ $teacher->name }}' + '?', action: '{{ route('admin.sambutans.delete', $teacher) }}' } }))" class="px-3 py-1.5 text-xs bg-red-500 hover:bg-red-600 text-white rounded-lg transition-colors flex items-center gap-1">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="mt-6 bg-white rounded-2xl p-12 border border-slate-100 text-center">
            <span class="material-symbols-outlined text-5xl text-slate-300 block mb-4">group</span>
            <h3 class="text-lg font-medium text-slate-800">Belum Ada Guru</h3>
            <p class="text-slate-500 mt-1">Tambahkan data guru.</p>
        </div>
        @endif

        <!-- Modal Tambah Guru -->
        <template x-teleport="body">
            <div x-show="openModal" class="fixed inset-0 z-[9999] overflow-y-auto" style="display:none;">
                <div class="flex items-center justify-center min-h-screen px-4 sm:p-0">
                    <div x-show="openModal" @click="openModal=false" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm"></div>
                    <div x-show="openModal" x-transition class="bg-white rounded-2xl shadow-2xl sm:max-w-lg w-full border border-slate-100 relative z-10">
                        <form action="{{ route('admin.sambutans') }}" method="POST" enctype="multipart/form-data">@csrf
                            <div class="px-6 py-5 border-b border-slate-100 flex justify-between items-center">
                                <h3 class="text-lg font-semibold text-slate-800">Tambah Guru</h3>
                                <button type="button" @click="openModal=false" class="text-slate-400 hover:text-slate-600"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg></button>
                            </div>
                            <div class="px-6 py-5 space-y-4">
                                <div><label class="block text-sm font-medium text-slate-700 mb-1">Nama</label><input type="text" name="name" required class="block w-full px-4 py-2.5 border border-slate-200 rounded-xl sm:text-sm bg-slate-50" placeholder="Nama lengkap"></div>
                                <div><label class="block text-sm font-medium text-slate-700 mb-1">Kelas / Jabatan</label><input type="text" name="role" required class="block w-full px-4 py-2.5 border border-slate-200 rounded-xl sm:text-sm bg-slate-50" placeholder="Contoh: Guru Kelas TK A"></div>
                                <div><label class="block text-sm font-medium text-slate-700 mb-1">Kata Sambutan (Opsional)</label><textarea name="content" rows="3" class="block w-full px-4 py-2.5 border border-slate-200 rounded-xl sm:text-sm bg-slate-50" placeholder="Tulis kata sambutan..."></textarea></div>
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

        <!-- Modal Edit Guru -->
        <template x-teleport="body">
            <div x-show="editModal" class="fixed inset-0 z-[9999] overflow-y-auto" style="display:none;">
                <div class="flex items-center justify-center min-h-screen px-4 sm:p-0">
                    <div x-show="editModal" @click="editModal=false" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm"></div>
                    <div x-show="editModal" x-transition class="bg-white rounded-2xl shadow-2xl sm:max-w-lg w-full border border-slate-100 relative z-10">
                        <form :action="`/admin/sambutans/${activeItem.id}`" method="POST" enctype="multipart/form-data">@csrf
                            <div class="px-6 py-5 border-b border-slate-100 flex justify-between items-center">
                                <h3 class="text-lg font-semibold text-slate-800">Edit Guru</h3>
                                <button type="button" @click="editModal=false" class="text-slate-400 hover:text-slate-600"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg></button>
                            </div>
                            <div class="px-6 py-5 space-y-4">
                                <div><label class="block text-sm font-medium text-slate-700 mb-1">Nama</label><input type="text" name="name" x-model="activeItem.name" required class="block w-full px-4 py-2.5 border border-slate-200 rounded-xl sm:text-sm bg-slate-50"></div>
                                <div><label class="block text-sm font-medium text-slate-700 mb-1">Kelas / Jabatan</label><input type="text" name="role" x-model="activeItem.role" required class="block w-full px-4 py-2.5 border border-slate-200 rounded-xl sm:text-sm bg-slate-50"></div>
                                <div><label class="block text-sm font-medium text-slate-700 mb-1">Kata Sambutan</label><textarea name="content" x-model="activeItem.content" rows="3" class="block w-full px-4 py-2.5 border border-slate-200 rounded-xl sm:text-sm bg-slate-50"></textarea></div>
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

</div>
@endsection

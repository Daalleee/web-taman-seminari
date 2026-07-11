@extends('layouts.admin')

@section('title', 'Kepala Sekolah')

@section('content')
<div x-data="{ editModal: false, activeItem: {} }" class="max-w-3xl mx-auto">
    <div class="flex justify-between items-center bg-white p-6 rounded-2xl shadow-sm border border-slate-100">
        <div>
            <h2 class="text-lg font-semibold text-slate-800">Kepala Sekolah</h2>
            <p class="text-sm text-slate-500">Data dan kata sambutan kepala sekolah.</p>
        </div>
    </div>

    @if($principal->exists)
    <div class="mt-6 bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
        <div class="flex flex-col md:flex-row">
            <div class="md:w-80 lg:w-96 shrink-0 flex items-center justify-center p-6">
                @if($principal->photo_path)
                    <div class="w-full border-4 border-primary/20 rounded-xl overflow-hidden shadow-lg bg-white">
                        <img src="{{ asset('uploads/'.$principal->photo_path) }}" alt="{{ $principal->name }}" class="w-full aspect-[4/3] object-cover">
                    </div>
                @else
                    <div class="w-full h-56 flex items-center justify-center border-4 border-primary/20 rounded-xl bg-primary/5">
                        <span class="material-symbols-outlined text-primary text-7xl">person</span>
                    </div>
                @endif
            </div>
            <div class="flex-1 p-8">
                <div class="flex items-start justify-between mb-4">
                    <div>
                        <h3 class="font-headline-sm text-headline-sm text-primary">{{ $principal->name }}</h3>
                    </div>
                    <button @click="activeItem = {{ json_encode($principal) }}; editModal = true" class="px-4 py-2 text-sm bg-secondary hover:bg-primary text-white rounded-xl transition-colors flex items-center gap-1.5 shrink-0 ml-4">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                        Edit
                    </button>
                </div>
                <div class="text-sm text-slate-600 leading-relaxed">
                    {{ $principal->content }}
                </div>
            </div>
        </div>
    </div>
    @else
    <div class="mt-6 bg-white rounded-2xl p-12 border border-slate-100 text-center">
        <span class="material-symbols-outlined text-5xl text-slate-300 block mb-4">school</span>
        <h3 class="text-lg font-medium text-slate-800">Belum Ada Data</h3>
        <p class="text-slate-500 mt-1">Tambahkan data kepala sekolah.</p>
        <button @click="editModal = true" class="mt-4 px-5 py-2.5 bg-primary text-white rounded-xl font-medium hover:bg-primary-container transition-colors shadow-sm inline-flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Tambah Data
        </button>
    </div>
    @endif

    <!-- Modal Edit -->
    <template x-teleport="body">
        <div x-show="editModal" class="fixed inset-0 z-[9999] overflow-y-auto" style="display:none;">
            <div class="flex items-center justify-center min-h-screen px-4 sm:p-0">
                <div x-show="editModal" @click="editModal=false" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm"></div>
                <div x-show="editModal" x-transition class="bg-white rounded-2xl shadow-2xl sm:max-w-lg w-full border border-slate-100 relative z-10">
                    <form action="{{ route('admin.principal.update') }}" method="POST" enctype="multipart/form-data">@csrf
                        <div class="px-6 py-5 border-b border-slate-100 flex justify-between items-center">
                            <h3 class="text-lg font-semibold text-slate-800">Edit Kepala Sekolah</h3>
                            <button type="button" @click="editModal=false" class="text-slate-400 hover:text-slate-600"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg></button>
                        </div>
                        <div class="px-6 py-5 space-y-4">
                            <div><label class="block text-sm font-medium text-slate-700 mb-1">Nama</label><input type="text" name="name" x-model="activeItem.name" required class="block w-full px-4 py-2.5 border border-slate-200 rounded-xl sm:text-sm bg-slate-50"></div>
                            <div><label class="block text-sm font-medium text-slate-700 mb-1">Foto (Opsional)</label><input type="file" name="photo" accept="image/*" class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:bg-primary/10 file:text-primary border border-slate-200 rounded-xl"></div>
                            <div><label class="block text-sm font-medium text-slate-700 mb-1">Kata Sambutan</label><textarea name="content" x-model="activeItem.content" required rows="6" class="block w-full px-4 py-2.5 border border-slate-200 rounded-xl sm:text-sm bg-slate-50"></textarea></div>
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

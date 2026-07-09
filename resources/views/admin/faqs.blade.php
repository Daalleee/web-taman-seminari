@extends('layouts.admin')

@section('title', 'Pertanyaan Umum (FAQ)')

@section('content')
<div x-data="{ openModal: false, editModal: false, activeFaq: {} }" class="space-y-6">

    <div class="flex justify-between items-center bg-white p-6 rounded-2xl shadow-sm border border-slate-100">
        <div>
            <h2 class="text-lg font-semibold text-slate-800">Kelola FAQ</h2>
            <p class="text-sm text-slate-500">Pertanyaan yang sering ditanyakan oleh pengunjung.</p>
        </div>
        <button @click="openModal = true" class="px-5 py-2.5 bg-primary text-white rounded-xl font-medium hover:bg-primary-container transition-colors shadow-sm flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Tambah FAQ
        </button>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-50 border-b border-slate-100">
                    <th class="py-4 px-6 text-sm font-semibold text-slate-600">Pertanyaan</th>
                    <th class="py-4 px-6 text-sm font-semibold text-slate-600">Jawaban</th>
                    <th class="py-4 px-6 text-sm font-semibold text-slate-600 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($faqs as $faq)
                <tr class="border-b border-slate-100 hover:bg-slate-50/50 transition-colors">
                    <td class="py-4 px-6 font-medium text-slate-800 w-1/3">{{ $faq->question }}</td>
                    <td class="py-4 px-6 text-slate-500 text-sm max-w-xs truncate">{{ $faq->answer }}</td>
                    <td class="py-4 px-6 text-right">
                        <div class="flex items-center justify-end gap-2">
                            <button @click="activeFaq = {{ json_encode($faq) }}; editModal = true" class="text-secondary hover:bg-secondary/10 px-3 py-1.5 rounded-lg text-sm font-medium transition-colors">Edit</button>
                            <form method="POST" class="inline">
                                @csrf @method('DELETE')
                                <button type="button" @click="window.dispatchEvent(new CustomEvent('show-delete-confirm', { detail: { title: 'Hapus FAQ?', message: 'Yakin ingin menghapus FAQ ini? Tindakan ini tidak bisa dibatalkan.', action: '{{ route('admin.faqs.delete', $faq) }}' } }))" class="text-red-500 hover:bg-red-50 px-3 py-1.5 rounded-lg text-sm font-medium transition-colors">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="3" class="py-8 text-center text-slate-500">Belum ada FAQ.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Tambah FAQ Modal -->
    <template x-teleport="body">
        <div x-show="openModal" class="fixed inset-0 z-[9999] overflow-y-auto" style="display: none;">
            <div class="flex items-center justify-center min-h-screen px-4 text-center sm:p-0">
                <div x-show="openModal" @click="openModal = false" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity"></div>
                <div x-show="openModal" x-transition class="inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg w-full border border-slate-100 relative z-10">
                    <form action="{{ route('admin.faqs') }}" method="POST">
                        @csrf
                        <div class="px-6 py-5 border-b border-slate-100 flex justify-between items-center">
                            <h3 class="text-lg font-semibold text-slate-800">Tambah FAQ Baru</h3>
                            <button type="button" @click="openModal = false" class="text-slate-400 hover:text-slate-600"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg></button>
                        </div>
                        <div class="px-6 py-5 space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-1">Pertanyaan</label>
                                <input type="text" name="question" required class="block w-full px-4 py-2.5 border border-slate-200 rounded-xl focus:ring-2 focus:ring-secondary/30 sm:text-sm bg-slate-50 focus:bg-white transition-colors" placeholder="Contoh: Bagaimana cara mendaftar?">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-1">Jawaban</label>
                                <textarea name="answer" rows="3" required class="block w-full px-4 py-2.5 border border-slate-200 rounded-xl focus:ring-2 focus:ring-secondary/30 sm:text-sm bg-slate-50 focus:bg-white transition-colors" placeholder="Tuliskan jawaban..."></textarea>
                            </div>
                        </div>
                        <div class="px-6 py-4 bg-slate-50 flex justify-end gap-3">
                            <button type="button" @click="openModal = false" class="px-4 py-2 text-sm font-medium text-slate-600 hover:bg-slate-200 rounded-xl">Batal</button>
                            <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-primary hover:bg-primary-container rounded-xl shadow-sm">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </template>

    <!-- Edit FAQ Modal -->
    <template x-teleport="body">
        <div x-show="editModal" class="fixed inset-0 z-[9999] overflow-y-auto" style="display: none;">
            <div class="flex items-center justify-center min-h-screen px-4 text-center sm:p-0">
                <div x-show="editModal" @click="editModal = false" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity"></div>
                <div x-show="editModal" x-transition class="inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg w-full border border-slate-100 relative z-10">
                    <form :action="`/admin/faqs/${activeFaq.id}`" method="POST">
                        @csrf
                        <div class="px-6 py-5 border-b border-slate-100 flex justify-between items-center">
                            <h3 class="text-lg font-semibold text-slate-800">Edit FAQ</h3>
                            <button type="button" @click="editModal = false" class="text-slate-400 hover:text-slate-600"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg></button>
                        </div>
                        <div class="px-6 py-5 space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-1">Pertanyaan</label>
                                <input type="text" name="question" :value="activeFaq.question" required class="block w-full px-4 py-2.5 border border-slate-200 rounded-xl focus:ring-2 focus:ring-secondary/30 sm:text-sm bg-slate-50 focus:bg-white transition-colors">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-1">Jawaban</label>
                                <textarea name="answer" rows="3" :value="activeFaq.answer" x-text="activeFaq.answer" required class="block w-full px-4 py-2.5 border border-slate-200 rounded-xl focus:ring-2 focus:ring-secondary/30 sm:text-sm bg-slate-50 focus:bg-white transition-colors"></textarea>
                            </div>
                        </div>
                        <div class="px-6 py-4 bg-slate-50 flex justify-end gap-3">
                            <button type="button" @click="editModal = false" class="px-4 py-2 text-sm font-medium text-slate-600 hover:bg-slate-200 rounded-xl">Batal</button>
                            <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-primary hover:bg-primary-container rounded-xl shadow-sm">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </template>
</div>
@endsection

@extends('layouts.admin')

@section('title', 'Pesan Masuk')

@section('content')
<div x-data="{ showModal: false, activeMessage: null, unreadCount: {{ $messages->whereNull('read_at')->count() }} }" class="space-y-6">
    <div class="flex justify-between items-center bg-white p-6 rounded-2xl shadow-sm border border-slate-100">
        <div>
            <h2 class="text-lg font-semibold text-slate-800">Pesan Masuk</h2>
            <p class="text-sm text-slate-500">Pesan yang dikirim pengunjung melalui formulir kontak.</p>
        </div>
        <div class="text-sm text-slate-500">
            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-primary/10 text-primary font-medium">
                <span class="w-2 h-2 rounded-full bg-primary"></span>
                <span x-text="unreadCount + ' belum dibaca'"></span>
            </span>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-50 border-b border-slate-100">
                    <th class="py-4 px-6 text-sm font-semibold text-slate-600">Status</th>
                    <th class="py-4 px-6 text-sm font-semibold text-slate-600">Nama</th>
                    <th class="py-4 px-6 text-sm font-semibold text-slate-600">Email</th>
                    <th class="py-4 px-6 text-sm font-semibold text-slate-600">Pesan</th>
                    <th class="py-4 px-6 text-sm font-semibold text-slate-600">Tanggal</th>
                    <th class="py-4 px-6 text-sm font-semibold text-slate-600 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($messages as $msg)
                <tr class="border-b border-slate-100 hover:bg-slate-50/50 transition-colors cursor-pointer"
                    @click="
                        fetch('{{ route('admin.messages.show', $msg) }}')
                            .then(r => r.json())
                            .then(data => { activeMessage = data; showModal = true; unreadCount = Math.max(0, unreadCount - 1); });
                    ">
                    <td class="py-4 px-6 w-16">
                        @if(is_null($msg->read_at))
                            <span class="w-3 h-3 rounded-full bg-primary block" title="Belum dibaca"></span>
                        @else
                            <span class="w-3 h-3 rounded-full bg-slate-300 block" title="Sudah dibaca"></span>
                        @endif
                    </td>
                    <td class="py-4 px-6 font-medium text-slate-800">{{ $msg->name }}</td>
                    <td class="py-4 px-6 text-slate-500">{{ $msg->email }}</td>
                    <td class="py-4 px-6 text-slate-500 text-sm max-w-xs truncate">{{ $msg->message }}</td>
                    <td class="py-4 px-6 text-slate-500 text-sm whitespace-nowrap">{{ $msg->created_at->format('d M Y H:i') }}</td>
                    <td class="py-4 px-6 text-right">
                        <form method="POST" class="inline">
                            @csrf @method('DELETE')
                            <button type="button"
                                @click.stop="
                                    window.dispatchEvent(new CustomEvent('show-delete-confirm', {
                                        detail: {
                                            title: 'Hapus Pesan?',
                                            message: 'Yakin ingin menghapus pesan dari ' + '{{ $msg->name }}' + '?',
                                            action: '{{ route('admin.messages.delete', $msg) }}'
                                        }
                                    }));
                                "
                                class="text-red-500 hover:bg-red-50 px-3 py-1.5 rounded-lg text-sm font-medium transition-colors">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="py-12 text-center text-slate-500">
                        <span class="material-symbols-outlined text-4xl text-slate-300 block mb-3">mail_outline</span>
                        Belum ada pesan masuk.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Detail Modal -->
    <template x-teleport="body">
        <div x-show="showModal" class="fixed inset-0 z-[9999] overflow-y-auto" style="display:none;">
            <div class="flex items-center justify-center min-h-screen px-4 sm:p-0">
                <div x-show="showModal" @click="showModal = false" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm"></div>
                <div x-show="showModal" x-transition class="bg-white rounded-2xl shadow-2xl sm:max-w-lg w-full border border-slate-100 relative z-10">
                    <div class="px-6 py-5 border-b border-slate-100 flex justify-between items-center">
                        <h3 class="text-lg font-semibold text-slate-800">Detail Pesan</h3>
                        <button type="button" @click="showModal = false" class="text-slate-400 hover:text-slate-600"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg></button>
                    </div>
                    <div class="px-6 py-5 space-y-4">
                        <div class="flex items-center gap-4 pb-4 border-b border-slate-100">
                            <div class="w-12 h-12 rounded-full bg-primary/10 flex items-center justify-center text-primary font-bold text-lg" x-text="activeMessage ? activeMessage.name.charAt(0).toUpperCase() : ''"></div>
                            <div>
                                <p class="font-semibold text-slate-800" x-text="activeMessage ? activeMessage.name : ''"></p>
                                <span class="text-sm text-secondary" x-text="activeMessage ? activeMessage.email : ''"></span>
                            </div>
                        </div>
                        <div>
                            <p class="text-xs text-slate-400 mb-1">Tanggal</p>
                            <p class="text-sm text-slate-600" x-text="activeMessage ? new Date(activeMessage.created_at).toLocaleString('id-ID', { dateStyle: 'full', timeStyle: 'short' }) : ''"></p>
                        </div>
                        <div>
                            <p class="text-xs text-slate-400 mb-1">Pesan</p>
                            <p class="text-slate-700 whitespace-pre-wrap leading-relaxed" x-text="activeMessage ? activeMessage.message : ''"></p>
                        </div>
                    </div>
                    <div class="px-6 py-4 bg-slate-50 flex justify-between items-center rounded-b-2xl">
<button type="button"
    @click="activeMessage && openMailto(activeMessage.email)"
    class="inline-flex items-center gap-2 px-4 py-2.5 text-sm font-medium text-white bg-primary hover:bg-primary-container rounded-xl shadow-sm transition-colors">
    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
    Balas via Email
</button>
                        <button type="button" @click="showModal = false" class="px-4 py-2.5 text-sm font-medium text-slate-600 hover:bg-slate-200 rounded-xl transition-colors">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
    </template>
</div>
@endsection
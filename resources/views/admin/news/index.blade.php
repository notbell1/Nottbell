@extends('layouts.admin')

@section('admin_content')
{{-- Load FontAwesome & AlpineJS --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<script src="//unpkg.com/alpinejs" defer></script>

<style>
    [x-cloak] { display: none !important; }
</style>

<div x-data="{
    isEditModalOpen: false,
    currentNews: { id: '', title: '', category: '', content: '', action: '' },
    openEditModal(news) {
        this.currentNews = news;
        this.isEditModalOpen = true;
    }
}" class="animate__animated animate__fadeIn space-y-6 pb-10">

    {{-- Header Section --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-3xl font-black text-slate-800 tracking-tight">News Editorial</h1>
            <p class="text-slate-500 text-sm font-medium">Manajemen publikasi artikel dan update informasi.</p>
        </div>
        <a href="{{ route('admin.news.create') }}" class="inline-flex items-center justify-center gap-2 bg-slate-900 hover:bg-blue-600 text-white px-6 py-4 rounded-2xl font-black text-xs uppercase tracking-widest transition-all shadow-xl active:scale-95">
            <i class="fa-solid fa-pen-nib"></i> Write News
        </a>
    </div>

    {{-- News Table Card --}}
    <div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-100 overflow-hidden">
        <div class="p-4 overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="text-slate-400 uppercase text-[10px] tracking-[0.2em] border-b border-slate-50">
                        <th class="px-6 py-6 font-black">Article & Info</th>
                        <th class="px-6 py-6 font-black">Author</th>
                        <th class="px-6 py-6 font-black text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @forelse($news as $item)
                    <tr class="hover:bg-slate-50/80 transition-all group">
                        {{-- Thumbnail & Title --}}
                        <td class="px-6 py-5">
                            <div class="flex items-center gap-5">
                                <div class="relative w-16 h-16 shrink-0">
                                    {{-- PERBAIKAN LOGIKA GAMBAR DI SINI --}}
                                    <img src="{{ str_starts_with($item->thumbnail, 'http') ? $item->thumbnail : asset('storage/' . $item->thumbnail) }}"
     class="w-full h-full rounded-2xl object-cover shadow-sm bg-slate-100 group-hover:rotate-3 transition-transform">
                                </div>
                                <div class="space-y-1">
                                    <div class="flex items-center gap-2">
                                        <span class="px-2 py-0.5 bg-blue-50 text-blue-600 rounded text-[9px] font-black uppercase tracking-widest">{{ $item->category }}</span>
                                        <span class="text-[9px] text-slate-300 font-bold uppercase tracking-tighter italic">slug: {{ $item->slug }}</span>
                                    </div>
                                    <span class="font-black text-slate-800 block text-sm leading-tight line-clamp-1">{{ $item->title }}</span>
                                    <span class="text-[10px] text-slate-400 font-medium">Published: {{ $item->created_at->format('d M Y') }}</span>
                                </div>
                            </div>
                        </td>

                        {{-- Author --}}
                        <td class="px-6 py-5">
                            <div class="flex flex-col">
                                <span class="text-xs font-black text-slate-700 uppercase tracking-tight">{{ $item->author }}</span>
                                <span class="text-[9px] text-slate-400 font-bold uppercase tracking-widest">Verified Editor</span>
                            </div>
                        </td>

                        {{-- Actions --}}
                        <td class="px-6 py-5">
                            <div class="flex justify-center gap-2">
                                {{-- Trigger Modal --}}
                                <button @click="openEditModal({
                                    id: '{{ $item->id }}',
                                    title: '{{ addslashes($item->title) }}',
                                    category: '{{ $item->category }}',
                                    content: `{{ addslashes($item->content) }}`,
                                    action: '{{ route('admin.news.update', $item->id) }}'
                                })" class="w-10 h-10 flex items-center justify-center bg-white border border-slate-100 text-slate-400 rounded-xl hover:bg-blue-500 hover:text-white transition-all shadow-sm">
                                    <i class="fa-solid fa-pen-to-square text-xs"></i>
                                </button>

                                <form action="{{ route('admin.news.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus artikel?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="w-10 h-10 flex items-center justify-center bg-white border border-slate-100 text-slate-400 rounded-xl hover:bg-rose-500 hover:text-white transition-all shadow-sm">
                                        <i class="fa-solid fa-trash-can text-xs"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="px-6 py-20 text-center text-slate-300 font-black uppercase text-xs tracking-widest italic">Belum ada berita yang diterbitkan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- MODAL EDIT NEWS (SYNCED WITH YOUR CONTROLLER) --}}
    <div x-show="isEditModalOpen" class="fixed inset-0 z-[99] flex items-center justify-center px-4" x-cloak>
        <div x-show="isEditModalOpen" x-transition.opacity @click="isEditModalOpen = false" class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm"></div>

        <div x-show="isEditModalOpen" x-transition.scale.90 class="bg-white rounded-[3rem] shadow-2xl w-full max-w-2xl relative z-10 overflow-hidden border border-white/20">
            <div class="p-8 border-b border-slate-50 flex justify-between items-center bg-slate-50/50">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center text-white shadow-lg shadow-blue-200">
                        <i class="fa-solid fa-pen-nib text-xs"></i>
                    </div>
                    <h3 class="text-sm font-black text-slate-800 uppercase tracking-widest">Update Editorial Content</h3>
                </div>
                <button @click="isEditModalOpen = false" class="w-8 h-8 flex items-center justify-center rounded-full hover:bg-rose-50 text-slate-300 hover:text-rose-500 transition-all">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>

            <form :action="currentNews.action" method="POST" enctype="multipart/form-data" class="p-10 space-y-6">
                @csrf @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1 mb-2 block">Article Title</label>
                        <input type="text" name="title" x-model="currentNews.title" class="w-full bg-slate-50 border-none rounded-2xl px-5 py-4 text-sm font-bold text-slate-700 focus:ring-2 focus:ring-blue-500 transition-all outline-none">
                    </div>
                    <div>
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1 mb-2 block">Category</label>
                        <input type="text" name="category" x-model="currentNews.category" class="w-full bg-slate-50 border-none rounded-2xl px-5 py-4 text-sm font-bold text-slate-700 focus:ring-2 focus:ring-blue-500 transition-all outline-none">
                    </div>
                </div>

                <div>
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1 mb-2 block">News Body Content</label>
                    <textarea name="content" x-model="currentNews.content" rows="6" class="w-full bg-slate-50 border-none rounded-3xl px-6 py-5 text-sm font-bold text-slate-700 focus:ring-2 focus:ring-blue-500 transition-all outline-none"></textarea>
                </div>

                <div>
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1 mb-2 block">Replace Thumbnail</label>
                    <div class="bg-slate-50 p-6 rounded-2xl border-2 border-dashed border-slate-100 group hover:border-blue-200 transition-all">
                        <input type="file" name="thumbnail" class="text-xs text-slate-400 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-[10px] file:font-black file:bg-blue-50 file:text-blue-700">
                    </div>
                </div>

                <div class="pt-4">
                    <button type="submit" class="w-full py-5 bg-slate-900 text-white rounded-[2rem] font-black text-xs uppercase tracking-[0.3em] hover:bg-blue-600 shadow-xl transition-all active:scale-95">Update Article Publication</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

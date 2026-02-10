@extends('layouts.admin')

@section('admin_content')
{{-- Alpine.js Control Unit --}}
<div x-data="{
    isEditModalOpen: false,
    currentProject: {},
    openEditModal(project) {
        // Kita parsing data ke Alpine, pastikan deskripsi aman dari karakter aneh
        this.currentProject = project;
        this.isEditModalOpen = true;
    }
}" class="animate__animated animate__fadeIn space-y-6 pb-10">

    {{-- Header Section --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-3xl font-black text-slate-800 tracking-tight">Project Library</h1>
            <p class="text-slate-500 text-sm font-medium">Manajemen aset arsitektur dan dokumentasi portfolio.</p>
        </div>
        <a href="{{ route('admin.projects.create') }}" class="inline-flex items-center justify-center gap-2 bg-slate-900 hover:bg-cyan-600 text-white px-6 py-3 rounded-2xl font-black text-xs uppercase tracking-widest transition-all shadow-lg active:scale-95">
            <i class="fas fa-plus"></i> Add Project
        </a>
    </div>

    {{-- Project Table Card --}}
    <div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-100 overflow-hidden">
        <div class="p-8 border-b border-slate-50 flex items-center justify-between bg-slate-50/50">
            <h2 class="text-sm font-black text-slate-800 uppercase tracking-widest">Active Projects ({{ $projects->count() }})</h2>
        </div>

        <div class="px-8 pt-4">
            @include('admin.partials.alerts')
        </div>

        <div class="p-4 overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="text-slate-400 uppercase text-[10px] tracking-[0.2em] border-b border-slate-50">
                        <th class="px-6 py-6 font-black">Main Info</th>
                        <th class="px-6 py-6 font-black">Specs</th>
                        <th class="px-6 py-6 font-black text-center">Gallery</th>
                        <th class="px-6 py-6 font-black text-center">Control</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @forelse($projects as $project)
                    <tr class="hover:bg-slate-50/80 transition-all group">
                        {{-- Thumbnail & Title --}}
                        <td class="px-6 py-5">
                            <div class="flex items-center gap-5">
                                <div class="relative w-24 h-16 shrink-0">
                                    <img src="{{ asset('storage/' . $project->image) }}" class="w-full h-full rounded-xl object-cover shadow-sm bg-slate-100 group-hover:scale-105 transition-transform">
                                </div>
                                <div>
                                    <span class="font-black text-slate-800 block text-sm">{{ $project->title }}</span>
                                    <a href="{{ $project->link }}" target="_blank" class="text-[10px] text-cyan-600 font-bold uppercase tracking-widest hover:underline italic">Live Link ↗</a>
                                </div>
                            </div>
                        </td>

                        {{-- Architecture & Duration --}}
                        <td class="px-6 py-5 text-xs font-bold uppercase tracking-tighter">
                            <div class="space-y-1">
                                <div class="flex items-center gap-2 text-slate-600">
                                    <i class="fas fa-microchip text-slate-300"></i>
                                    <span>{{ $project->architecture }}</span>
                                </div>
                                <div class="flex items-center gap-2 text-slate-400">
                                    <i class="far fa-clock text-slate-300"></i>
                                    <span>{{ $project->duration }}</span>
                                </div>
                            </div>
                        </td>

                        {{-- Gallery Bubbles --}}
                        <td class="px-6 py-5 text-center">
                            @php
                                $gallery = is_array($project->gallery) ? $project->gallery : json_decode($project->gallery, true) ?? [];
                            @endphp
                            <div class="flex justify-center -space-x-3">
                                @forelse(array_slice($gallery, 0, 3) as $img)
                                    <img src="{{ asset('storage/' . $img) }}" class="h-8 w-8 rounded-full ring-2 ring-white object-cover shadow-sm">
                                @empty
                                    <span class="text-[9px] text-slate-300 font-black uppercase tracking-widest italic">Empty</span>
                                @endforelse
                                @if(count($gallery) > 3)
                                    <div class="flex items-center justify-center h-8 w-8 rounded-full bg-slate-100 ring-2 ring-white text-[9px] font-black text-slate-500">+{{ count($gallery) - 3 }}</div>
                                @endif
                            </div>
                        </td>

                        {{-- Actions --}}
                        <td class="px-6 py-5">
                            <div class="flex justify-center gap-2">
                                <button @click="openEditModal({
                                    id: '{{ $project->id }}',
                                    title: '{{ addslashes($project->title) }}',
                                    link: '{{ $project->link }}',
                                    architecture: '{{ addslashes($project->architecture) }}',
                                    duration: '{{ addslashes($project->duration) }}',
                                    description: `{{ addslashes($project->description) }}`,
                                    action: '{{ route('admin.projects.update', $project->id) }}'
                                })" class="w-10 h-10 flex items-center justify-center bg-white border border-slate-100 text-slate-400 rounded-xl hover:bg-cyan-500 hover:text-white transition-all shadow-sm">
                                    <i class="fas fa-edit text-xs"></i>
                                </button>
                                <form action="{{ route('admin.projects.destroy', $project->id) }}" method="POST" onsubmit="return confirm('Sistem akan menghapus data permanen?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="w-10 h-10 flex items-center justify-center bg-white border border-slate-100 text-slate-400 rounded-xl hover:bg-red-500 hover:text-white transition-all shadow-sm">
                                        <i class="fas fa-trash-alt text-xs"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="4" class="px-6 py-20 text-center text-slate-300 font-black uppercase text-xs tracking-[0.2em] italic">Database Empty. Create new project.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- MODAL EDIT PREMIUM --}}
    <div x-show="isEditModalOpen" class="fixed inset-0 z-[99] flex items-center justify-center px-4" x-cloak>
        <div x-show="isEditModalOpen" x-transition.opacity @click="isEditModalOpen = false" class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm"></div>

        <div x-show="isEditModalOpen" x-transition.scale.90 class="bg-white rounded-[3rem] shadow-2xl w-full max-w-4xl relative z-10 overflow-hidden max-h-[90vh] flex flex-col border border-white/20">
            <div class="p-8 border-b border-slate-50 flex justify-between items-center bg-slate-50/30">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 bg-cyan-500 rounded-lg flex items-center justify-center text-white text-xs">
                        <i class="fas fa-sync-alt"></i>
                    </div>
                    <h3 class="text-sm font-black text-slate-800 uppercase tracking-widest">Update Data Detail</h3>
                </div>
                <button @click="isEditModalOpen = false" class="w-10 h-10 rounded-full hover:bg-red-50 text-slate-300 hover:text-red-500 transition-all flex items-center justify-center">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <form :action="currentProject.action" method="POST" enctype="multipart/form-data" class="overflow-y-auto p-10 space-y-8">
                @csrf @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    {{-- Left Col --}}
                    <div class="space-y-6">
                        <div>
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1 mb-2 block">Project Title</label>
                            <input type="text" name="title" x-model="currentProject.title" class="w-full bg-slate-50 border-none rounded-2xl px-5 py-4 text-sm font-bold text-slate-700 focus:ring-2 focus:ring-cyan-500 outline-none transition-all">
                        </div>
                        <div>
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1 mb-2 block">Architecture</label>
                            <input type="text" name="architecture" x-model="currentProject.architecture" class="w-full bg-slate-50 border-none rounded-2xl px-5 py-4 text-sm font-bold text-slate-700 focus:ring-2 focus:ring-cyan-500 outline-none transition-all">
                        </div>
                    </div>
                    {{-- Right Col --}}
                    <div class="space-y-6">
                        <div>
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1 mb-2 block">Live URL Link</label>
                            <input type="url" name="link" x-model="currentProject.link" class="w-full bg-slate-50 border-none rounded-2xl px-5 py-4 text-sm font-bold text-slate-700 focus:ring-2 focus:ring-cyan-500 outline-none transition-all">
                        </div>
                        <div>
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1 mb-2 block">Development Duration</label>
                            <input type="text" name="duration" x-model="currentProject.duration" class="w-full bg-slate-50 border-none rounded-2xl px-5 py-4 text-sm font-bold text-slate-700 focus:ring-2 focus:ring-cyan-500 outline-none transition-all">
                        </div>
                    </div>
                </div>

                {{-- Description --}}
                <div>
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1 mb-2 block">Full Technical Description</label>
                    <textarea name="description" x-model="currentProject.description" rows="5" class="w-full bg-slate-50 border-none rounded-3xl px-6 py-5 text-sm font-bold text-slate-700 focus:ring-2 focus:ring-cyan-500 outline-none transition-all"></textarea>
                </div>

                {{-- Image Handlers --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="bg-slate-50 p-6 rounded-3xl border border-dashed border-slate-200">
                        <label class="text-[10px] font-black text-slate-500 uppercase tracking-widest mb-3 block italic">New Thumbnail</label>
                        <input type="file" name="image" class="text-xs text-slate-400">
                    </div>
                    <div class="bg-slate-50 p-6 rounded-3xl border border-dashed border-slate-200">
                        <label class="text-[10px] font-black text-slate-500 uppercase tracking-widest mb-3 block italic">Replace Gallery</label>
                        <input type="file" name="gallery[]" multiple class="text-xs text-slate-400">
                    </div>
                </div>

                <div class="pt-4">
                    <button type="submit" class="w-full py-5 bg-slate-900 text-white rounded-[2rem] font-black text-xs uppercase tracking-[0.3em] hover:bg-cyan-600 shadow-xl shadow-cyan-900/10 transition-all active:scale-95">
                        Confirm & Push Updates
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="//unpkg.com/alpinejs" defer></script>
<style>[x-cloak] { display: none !important; }</style>
@endsection

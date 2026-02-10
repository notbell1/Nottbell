@extends('layouts.app')

@section('title', $project->title . ' | Project Case Study')

@section('content')
<div class="bg-[#020617] min-h-screen text-slate-200">
    {{-- Hero Section Detail (Tanpa Judul) --}}
    <div class="relative h-[30vh] w-full overflow-hidden">
        <img src="{{ asset('storage/' . $project->image) }}" class="w-full h-full object-cover opacity-20 blur-md scale-110" alt="">
        <div class="absolute inset-0 bg-gradient-to-t from-[#020617] via-[#020617]/40 to-transparent"></div>

        <div class="absolute inset-0 flex items-center justify-center">
            <div class="max-w-4xl px-6 text-center">
                <a href="{{ route('home') }}" class="inline-flex items-center gap-2 text-cyan-400 text-[10px] font-black uppercase tracking-[0.3em] hover:text-white transition-all group">
                    <svg class="w-4 h-4 transform group-hover:-translate-x-2 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path d="M15 19l-7-7 7-7" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    Back to Portfolio
                </a>
            </div>
        </div>
    </div>

    {{-- Main Content --}}
    <div class="max-w-6xl mx-auto px-6 -mt-16 relative z-10 pb-12">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">

            {{-- Column Kiri: Media & Description --}}
            <div class="lg:col-span-8 space-y-10">
                {{-- Main Image Card --}}
                <div class="relative group rounded-[2.5rem] overflow-hidden border border-slate-800 shadow-2xl transition-all duration-500 hover:border-cyan-500/30">
                    <div class="aspect-video w-full overflow-hidden bg-slate-900">
                        <img src="{{ asset('storage/' . $project->image) }}"
                             class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                             alt="{{ $project->title }}">
                    </div>
                </div>

                {{-- Description Card --}}
                <div class="bg-slate-900/40 p-8 md:p-10 rounded-[2.5rem] border border-slate-800/50 backdrop-blur-md">
                    <h2 class="text-xl font-bold text-white mb-6 flex items-center gap-3">
                        <span class="w-6 h-[2px] bg-cyan-500"></span>
                        Project Overview
                    </h2>
                    <div class="prose prose-invert max-w-none text-slate-400 leading-[1.8] text-base md:text-lg font-medium">
                        {!! nl2br(e($project->description)) !!}
                    </div>
                </div>

                {{-- Gallery Section --}}
                @if($project->gallery)
                <div class="space-y-6">
                    <h2 class="text-xl font-bold text-white flex items-center gap-3 uppercase tracking-tighter">
                        <span class="w-6 h-[2px] bg-blue-500"></span>
                        Visual Archive
                    </h2>
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                        @foreach($project->gallery as $img)
                            <div class="aspect-square overflow-hidden rounded-2xl border border-slate-800 hover:border-cyan-500/50 transition-all group">
                                <img src="{{ asset('storage/' . $img) }}"
                                     class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-500 group-hover:scale-110">
                            </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>

            {{-- Column Kanan: Sidebar Info --}}
            <div class="lg:col-span-4">
                <div class="sticky top-24 space-y-6">
                    <div class="bg-[#0f172a]/80 p-8 rounded-[2.5rem] border border-slate-800 shadow-xl relative overflow-hidden group backdrop-blur-sm">
                        <h3 class="text-white font-black uppercase tracking-[0.2em] text-[10px] mb-8 opacity-50">Technical Meta</h3>

                        <div class="space-y-8">
                            <div class="flex items-start gap-4">
                                <div class="w-8 h-8 rounded-xl bg-blue-500/10 flex items-center justify-center text-blue-400 shrink-0 border border-blue-500/20">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                </div>
                                <div>
                                    <p class="text-slate-500 text-[9px] font-black uppercase tracking-widest mb-1">Project Name</p>
                                    <p class="text-white font-bold text-sm leading-tight tracking-tight">{{ $project->title }}</p>
                                </div>
                            </div>

                            <div class="flex items-start gap-4">
                                <div class="w-8 h-8 rounded-xl bg-cyan-500/10 flex items-center justify-center text-cyan-400 shrink-0 border border-cyan-500/20">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                </div>
                                <div>
                                    <p class="text-slate-500 text-[9px] font-black uppercase tracking-widest mb-1">Timeline</p>
                                    <p class="text-white font-bold text-sm">{{ $project->duration ?? 'Completed' }}</p>
                                </div>
                            </div>

                            @if($project->architecture)
                            <div class="pt-6 border-t border-slate-800/50">
                                <p class="text-slate-500 text-[9px] font-black uppercase tracking-widest mb-4 flex items-center gap-2">
                                    Built With
                                </p>
                                <div class="flex flex-wrap gap-2">
                                    @php $tools = array_map('trim', explode(',', $project->architecture)); @endphp
                                    @foreach($tools as $tool)
                                        <span class="text-[9px] font-bold text-cyan-400 px-3 py-1.5 bg-cyan-500/5 border border-cyan-500/10 rounded-lg uppercase">
                                            {{ $tool }}
                                        </span>
                                    @endforeach
                                </div>
                            </div>
                            @endif

                            @if($project->link)
                            <div class="pt-4">
                                <a href="{{ $project->link }}" target="_blank"
                                   class="flex items-center justify-center gap-2 w-full bg-blue-600 hover:bg-cyan-500 text-white font-black py-4 rounded-2xl text-[10px] uppercase tracking-[0.2em] transition-all hover:scale-[1.02] shadow-lg shadow-blue-500/20">
                                    Launch Live Preview
                                </a>
                            </div>
                            @endif
                        </div>
                    </div>

                    <div class="p-8 rounded-[2.5rem] border border-dashed border-slate-800 text-center bg-slate-900/10">
                        <p class="text-slate-500 text-[10px] mb-3 font-black uppercase tracking-widest">Interested?</p>
                        <a href="{{ url('/#contact') }}" class="text-cyan-400 font-bold text-xs hover:text-white transition-colors uppercase tracking-[0.2em]">Hire Nottbell →</a>
                    </div>
                </div>
            </div>
        </div>

        {{-- Navigasi Next & Previous --}}
        <div class="mt-20 pt-10 border-t border-slate-800">
            <div class="flex flex-col md:flex-row justify-between items-center gap-8">
                @if($previous)
                <a href="{{ route('project.detail', $previous->id) }}" class="group flex flex-col items-start gap-2">
                    <span class="text-slate-500 text-[10px] font-black uppercase tracking-[0.2em]">Previous Project</span>
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 rounded-full border border-slate-800 flex items-center justify-center group-hover:bg-cyan-500 group-hover:border-cyan-500 transition-all">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M15 19l-7-7 7-7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        </div>
                        <span class="text-lg font-bold text-white group-hover:text-cyan-400 transition-colors tracking-tighter">{{ $previous->title }}</span>
                    </div>
                </a>
                @else
                <div></div>
                @endif

                @if($next)
                <a href="{{ route('project.detail', $next->id) }}" class="group flex flex-col items-end gap-2 text-right">
                    <span class="text-slate-500 text-[10px] font-black uppercase tracking-[0.2em]">Next Project</span>
                    <div class="flex items-center gap-4">
                        <span class="text-lg font-bold text-white group-hover:text-cyan-400 transition-colors tracking-tighter">{{ $next->title }}</span>
                        <div class="w-10 h-10 rounded-full border border-slate-800 flex items-center justify-center group-hover:bg-cyan-500 group-hover:border-cyan-500 transition-all">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 5l7 7-7 7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        </div>
                    </div>
                </a>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@extends('layouts.app')

@section('title', 'Nottbell | Portfolio')

@section('content')

<style>
    /* Global Section Background */
    body { background-color: #050810; }

    /* Glassmorphism Card Style */
    .glass-card {
        background: rgba(15, 23, 42, 0.4);
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        border: 1px solid rgba(255, 255, 255, 0.03);
        transition: all 0.6s cubic-bezier(0.22, 1, 0.36, 1);
    }

    .glass-card:hover {
        border-color: rgba(34, 211, 238, 0.2);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4), 0 0 25px rgba(34, 211, 238, 0.05);
        transform: translateY(-6px);
    }

    .glow-border-container {
        position: relative;
        padding: 1px;
    }

    .glow-border-container::before {
        content: '';
        position: absolute;
        inset: 0;
        background: radial-gradient(circle at center, rgba(34, 211, 238, 0.08) 0%, transparent 70%);
        border-radius: inherit;
        z-index: -1;
        opacity: 0;
        transition: opacity 0.8s ease;
    }

    .glow-border-container:hover::before { opacity: 1; }

    .project-img-overlay {
        background: linear-gradient(to bottom, transparent 40%, rgba(15, 23, 42, 0.9) 100%);
    }

    img {
        filter: none !important;
        -webkit-filter: none !important;
    }
</style>

{{-- SECTIONS AWAL --}}
@include('sections.hero')
@include('sections.about')
@include('sections.skills')

{{-- SECTION: PROJECTS --}}
<section id="projects"
    x-data="{
        allProjects: {{ json_encode($projects) }},
        currentIndex: 0,
        pageSize: 3,
        get currentProjects() { return this.allProjects.slice(this.currentIndex, this.currentIndex + this.pageSize); },
        next() { if (this.currentIndex + this.pageSize < this.allProjects.length) { this.currentIndex++; this.$nextTick(() => { AOS.refresh(); }); } },
        prev() { if (this.currentIndex > 0) { this.currentIndex--; this.$nextTick(() => { AOS.refresh(); }); } }
    }"
    class="py-24 px-6 relative overflow-hidden">

    <div class="max-w-6xl mx-auto relative z-10">
        <div class="flex flex-col md:flex-row justify-between items-end mb-16 gap-6" data-aos="fade-up">
            <div>
                <span class="text-cyan-400 text-xs font-black uppercase tracking-[0.4em] mb-3 block">Portfolio</span>
                <h2 class="text-5xl font-black text-white italic tracking-tighter leading-none">
                    FEATURED<br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-cyan-400 to-blue-600 uppercase">Projects.</span>
                </h2>
            </div>

            <div class="flex gap-3">
                <button @click="prev" :disabled="currentIndex === 0"
                        class="w-14 h-14 rounded-2xl border border-slate-800 bg-slate-900/50 flex items-center justify-center text-white hover:border-cyan-400 hover:text-cyan-400 transition-all disabled:opacity-10">
                    <i class="fas fa-chevron-left text-sm"></i>
                </button>
                <button @click="next" :disabled="currentIndex + pageSize >= allProjects.length"
                        class="w-14 h-14 rounded-2xl border border-slate-800 bg-slate-900/50 flex items-center justify-center text-white hover:border-cyan-400 hover:text-cyan-400 transition-all disabled:opacity-10">
                    <i class="fas fa-chevron-right text-sm"></i>
                </button>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <template x-for="(project, index) in currentProjects" :key="project.id">
                <div class="glow-border-container rounded-[2rem]" data-aos="fade-up" :data-aos-delay="index * 100">
                    <div class="glass-card rounded-[2rem] overflow-hidden flex flex-col h-full group">
                        <div class="relative h-56 overflow-hidden">
                            {{-- FIX: Smart Image Path for Projects --}}
                            <img :src="project.image.startsWith('http') ? project.image : '/storage/' + project.image"
                                 class="w-full h-full object-cover transition-transform duration-1000 ease-out group-hover:scale-105"
                                 :alt="project.title">
                            <div class="absolute inset-0 project-img-overlay opacity-80"></div>
                            <div class="absolute top-5 left-5">
                                <span class="px-3 py-1 rounded-full border border-cyan-500/30 bg-black/40 backdrop-blur-md text-cyan-400 text-[9px] font-black uppercase tracking-widest" x-text="project.architecture ?? 'Creative'"></span>
                            </div>
                        </div>
                        <div class="p-8 flex flex-col flex-grow">
                            <h3 class="text-xl font-bold text-white mb-3 tracking-tight group-hover:text-cyan-400 transition-colors duration-500" x-text="project.title"></h3>
                            <p class="text-slate-400 text-sm leading-relaxed mb-8 line-clamp-3" x-text="project.description"></p>

                            <div class="mt-auto pt-6 border-t border-white/5">
                                <a :href="'/project/detail/' + project.id" class="group/btn flex items-center justify-between text-[10px] font-black text-slate-400 hover:text-cyan-400 uppercase tracking-[0.2em] transition-all">
                                    View Case Study
                                    <span class="w-8 h-8 rounded-full border border-slate-700 flex items-center justify-center group-hover/btn:bg-cyan-500 group-hover/btn:border-cyan-500 group-hover/btn:text-black transition-all">
                                        <i class="fas fa-arrow-right"></i>
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </template>
        </div>
    </div>
</section>

{{-- SECTION: NEWS --}}
<section id="news"
    x-data="{
        allNews: {{ json_encode($news->items()) }},
        currentIndex: 0,
        pageSize: 4,
        loading: false,
        get currentNews() { return this.allNews.slice(this.currentIndex, this.currentIndex + this.pageSize); },
        async next() {
            if (this.currentIndex + this.pageSize >= this.allNews.length) {
                this.loading = true;
                try {
                    const nextPage = Math.ceil(this.allNews.length / 4) + 1;
                    const response = await fetch(`?page=${nextPage}`);
                    const html = await response.text();
                    const doc = new DOMParser().parseFromString(html, 'text/html');
                    const rawData = doc.getElementById('raw-news-data');
                    if (rawData) {
                        const newData = JSON.parse(rawData.textContent);
                        if (newData.length > 0) {
                            this.allNews = [...this.allNews, ...newData];
                            this.currentIndex += 2;
                        }
                    }
                } catch (e) { console.error(e); }
                this.loading = false;
            } else { this.currentIndex += 2; }
            this.$nextTick(() => { AOS.refresh(); });
        },
        prev() { if (this.currentIndex > 0) { this.currentIndex -= 2; this.$nextTick(() => { AOS.refresh(); }); } }
    }"
    class="py-24 bg-[#03060b] px-6 border-y border-white/5">

    <script id="raw-news-data" type="application/json">@json($news->items())</script>

    <div class="max-w-6xl mx-auto">
        <div class="flex justify-between items-center mb-16" data-aos="fade-up">
            <h2 class="text-4xl font-black text-white italic tracking-tighter uppercase">Recent <span class="text-cyan-500">ARTICLES.</span></h2>

            <div class="flex gap-2">
                <button @click="prev" :disabled="currentIndex === 0"
                        class="w-10 h-10 rounded-xl bg-slate-900 border border-slate-800 text-white hover:border-cyan-500 disabled:opacity-20 transition-all">
                    <i class="fas fa-chevron-left text-xs"></i>
                </button>
                <button @click="next" :class="loading ? 'animate-pulse' : ''"
                        class="w-10 h-10 rounded-xl bg-slate-900 border border-slate-800 text-white hover:border-cyan-500 transition-all">
                    <i :class="loading ? 'fas fa-spinner animate-spin' : 'fas fa-chevron-right'" class="text-xs"></i>
                </button>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <template x-for="(item, index) in currentNews" :key="item.id">
                <div class="glow-border-container rounded-[2.5rem]" data-aos="fade-up" :data-aos-delay="index * 50">
                    <div class="glass-card rounded-[2.5rem] p-5 flex items-center gap-6 group">
                        {{-- FIX: Smart Image Path for News --}}
                        <div class="w-32 h-32 shrink-0 rounded-3xl overflow-hidden shadow-2xl transition-all duration-700 border border-white/5">
                            <img :src="item.thumbnail.startsWith('http') ? item.thumbnail : '/storage/' + item.thumbnail"
     class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-110"
     :alt="item.title">
                        </div>

                        <div class="min-w-0 flex flex-col py-2">
                            <div class="flex items-center gap-3 mb-2">
                                <span class="text-[8px] font-black text-cyan-500 uppercase tracking-[0.2em]" x-text="new Date(item.created_at).toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' })"></span>
                            </div>

                            <a :href="'/news/' + (item.slug || item.id)">
                                <h3 class="text-lg font-bold text-white hover:text-cyan-400 transition-colors line-clamp-1 leading-tight tracking-tight mb-2 uppercase" x-text="item.title"></h3>
                            </a>

                            <p class="text-slate-500 text-xs line-clamp-2 leading-relaxed mb-4" x-text="item.content ? item.content.replace(/<[^>]*>?/gm, '').substring(0, 80) + '...' : ''"></p>

                            <a :href="'/news/' + (item.slug || item.id)" class="group/read flex items-center text-[9px] font-black text-cyan-400 uppercase tracking-widest">
                                Read Full Article
                                <i class="fas fa-arrow-right ml-2 transform group-hover/read:translate-x-1 transition-transform"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </template>
        </div>
    </div>
</section>

{{-- FOOTER SECTIONS --}}
<div data-aos="fade-up">@include('sections.education')</div>
<div data-aos="fade-up">@include('sections.experience')</div>
<div data-aos="fade-up">@include('sections.contact')</div>

@endsection

@extends('layouts.app')

@section('content')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;800&display=swap');

    body {
        font-family: 'Plus Jakarta Sans', sans-serif;
        background-color: #050810;
        color: #cbd5e1;
    }

    /* Glassmorphism Effect */
    .glass-panel {
        background: rgba(15, 23, 42, 0.6);
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        border: 1px solid rgba(255, 255, 255, 0.05);
    }

    /* Article Body Styling */
    .article-body {
        line-height: 1.9;
        font-size: 1.1rem;
        color: #94a3b8;
    }

    /* Huruf pertama besar (Drop Cap) */
    .drop-cap::first-letter {
        font-size: 4rem;
        font-weight: 800;
        float: left;
        margin-right: 0.8rem;
        line-height: 1;
        color: #22d3ee;
        text-shadow: 0 0 20px rgba(34, 211, 238, 0.3);
    }

    /* Animasi Hover Tombol Sosmed */
    .btn-share {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        cursor: pointer;
    }
    .btn-share:hover {
        transform: translateY(-3px);
    }

    #scrollToTop.show {
        opacity: 1;
        transform: translateY(0);
    }
</style>

<section class="min-h-screen py-20 selection:bg-cyan-500/30 selection:text-cyan-200">
    <div class="container mx-auto max-w-5xl px-6">

        {{-- BREADCRUMB: KATEGORI --}}
        <div class="flex items-center gap-4 mb-8 animate__animated animate__fadeIn">
            <span class="px-4 py-1.5 bg-cyan-500/10 border border-cyan-500/20 text-cyan-400 text-[10px] font-black uppercase tracking-[0.3em] rounded-lg">
                {{ $news->category ?? 'Intelligence' }}
            </span>
            <div class="h-[1px] flex-grow bg-gradient-to-r from-white/10 to-transparent"></div>
        </div>

        {{-- HEADER: JUDUL & META --}}
        <header class="mb-12 animate__animated animate__fadeIn">
            <h1 class="text-4xl md:text-7xl font-black text-white leading-[1.1] mb-10 tracking-tighter">
                {{ $news->title }}
            </h1>

            <div class="flex flex-wrap items-center gap-8 py-8 border-y border-white/5">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-slate-800 to-slate-900 flex items-center justify-center text-cyan-400 font-black border border-white/10 shadow-xl shadow-cyan-500/5">
                        N
                    </div>
                    <div>
                        <p class="text-[9px] text-slate-500 font-black uppercase tracking-[0.2em] mb-1">Diterbitkan oleh</p>
                        <p class="text-white font-bold text-sm italic lowercase">@ {{ str_replace('Admin ', '', $news->author ?? 'nottbell') }}</p>
                    </div>
                </div>
                <div class="hidden md:block h-10 w-[1px] bg-white/5"></div>
                <div>
                    <p class="text-[9px] text-slate-500 font-black uppercase tracking-[0.2em] mb-1">Kronologi</p>
                    <p class="text-slate-300 font-bold text-sm">
                        {{ $news->created_at->format('d M, Y') }} <span class="text-cyan-500 mx-1">•</span> {{ $news->created_at->format('H:i') }} WIB
                    </p>
                </div>
            </div>
        </header>

        {{-- MAIN CONTENT AREA --}}
        <div class="animate__animated animate__fadeInUp" style="animation-delay: 0.2s">
            <article class="article-body">
                {{-- WRAPPED IMAGE --}}
                <div class="relative float-left mr-10 mb-8 mt-2 w-full md:w-[460px] group">
                    <div class="absolute -inset-2 bg-cyan-500/10 rounded-[2.5rem] blur-xl opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    <div class="relative rounded-[2.5rem] overflow-hidden border border-white/10 shadow-2xl">
                        <img src="{{ str_starts_with($news->thumbnail, 'http') ? $news->thumbnail : asset('storage/' . $news->thumbnail) }}"
     class="w-full h-auto object-cover grayscale-[30%] hover:grayscale-0 transition-all duration-700"
     alt="{{ $news->title }}">
                    </div>
                </div>

                {{-- TEXT CONTENT --}}
                <div class="text-justify drop-cap">
                    {!! nl2br(e($news->content)) !!}
                </div>
                <div class="clear-both"></div>
            </article>
        </div>

        {{-- SHARE BUTTONS --}}
        <div class="mt-20 p-8 glass-panel rounded-[3rem] flex flex-col lg:flex-row items-center justify-between gap-8 shadow-2xl">
            <div class="flex flex-col md:flex-row items-center gap-6">
                <span class="text-[10px] font-black text-slate-500 uppercase tracking-[0.4em]">Share:</span>
                <div class="flex flex-wrap justify-center gap-3">
                    {{-- Copy Link Button --}}
                    <button onclick="copyToClipboard(this)"
                            data-url="{{ Request::url() }}"
                            class="btn-share w-12 h-12 rounded-2xl bg-white/5 flex items-center justify-center text-white border border-white/5 hover:border-cyan-500">
                        <i class="fas fa-link text-xs"></i>
                    </button>

                    <a href="https://wa.me/?text={{ urlencode($news->title . ' ' . Request::url()) }}" target="_blank" class="btn-share w-12 h-12 rounded-2xl bg-white/5 flex items-center justify-center text-[#25D366] border border-white/5 hover:bg-[#25D366] hover:text-white">
                        <i class="fab fa-whatsapp text-xl"></i>
                    </a>
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(Request::url()) }}" target="_blank" class="btn-share w-12 h-12 rounded-2xl bg-white/5 flex items-center justify-center text-[#1877F2] border border-white/5 hover:bg-[#1877F2] hover:text-white">
                        <i class="fab fa-facebook-f text-sm"></i>
                    </a>
                    <a href="https://twitter.com/intent/tweet?text={{ urlencode($news->title) }}&url={{ urlencode(Request::url()) }}" target="_blank" class="btn-share w-12 h-12 rounded-2xl bg-white/5 flex items-center justify-center text-white border border-white/5 hover:bg-white hover:text-black">
                        <i class="fab fa-x-twitter text-sm"></i>
                    </a>
                    <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(Request::url()) }}" target="_blank" class="btn-share w-12 h-12 rounded-2xl bg-white/5 flex items-center justify-center text-[#0A66C2] border border-white/5 hover:bg-[#0A66C2] hover:text-white">
                        <i class="fab fa-linkedin-in text-sm"></i>
                    </a>
                    <a href="https://t.me/share/url?url={{ urlencode(Request::url()) }}&text={{ urlencode($news->title) }}" target="_blank" class="btn-share w-12 h-12 rounded-2xl bg-white/5 flex items-center justify-center text-[#26A5E4] border border-white/5 hover:bg-[#26A5E4] hover:text-white">
                        <i class="fab fa-telegram-plane text-lg"></i>
                    </a>
                </div>
            </div>

            <a href="{{ route('home') }}" class="group flex items-center gap-4 px-10 py-5 bg-white text-black rounded-2xl font-black text-[10px] uppercase tracking-[0.2em] hover:bg-cyan-400 transition-all shadow-xl">
                <i class="fas fa-arrow-left group-hover:-translate-x-2 transition-transform"></i> Return to Home
            </a>
        </div>

        {{-- NAVIGATION --}}
        <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-6">
            @if($previous)
            <a href="{{ route('news.detail', $previous->slug) }}" class="flex items-center gap-6 p-8 glass-panel rounded-[2.5rem] hover:border-cyan-500/40 transition-all group">
                <div class="w-12 h-12 rounded-full border border-white/10 flex items-center justify-center text-slate-500 group-hover:bg-cyan-500 group-hover:text-black transition-all">
                    <i class="fas fa-chevron-left text-xs"></i>
                </div>
                <div class="min-w-0">
                    <p class="text-[8px] font-black text-slate-600 uppercase tracking-widest mb-1">Prev</p>
                    <h4 class="text-sm font-bold text-white truncate">{{ $previous->title }}</h4>
                </div>
            </a>
            @endif
            @if($next)
            <a href="{{ route('news.detail', $next->slug) }}" class="flex items-center justify-between p-8 glass-panel rounded-[2.5rem] hover:border-cyan-500/40 transition-all group text-right">
                <div class="min-w-0 flex-1">
                    <p class="text-[8px] font-black text-slate-600 uppercase tracking-widest mb-1">Next</p>
                    <h4 class="text-sm font-bold text-white truncate">{{ $next->title }}</h4>
                </div>
                <div class="w-12 h-12 rounded-full border border-white/10 flex items-center justify-center text-slate-500 group-hover:bg-cyan-500 group-hover:text-black transition-all ml-6">
                    <i class="fas fa-chevron-right text-xs"></i>
                </div>
            </a>
            @endif
        </div>
    </div>
</section>

<button id="scrollToTop" class="fixed bottom-8 right-8 w-14 h-14 bg-cyan-500 text-black rounded-full shadow-2xl flex items-center justify-center opacity-0 translate-y-10 transition-all duration-500 z-50 hover:scale-110">
    <i class="fas fa-arrow-up font-black"></i>
</button>

<script>
    function copyToClipboard(button) {
        const url = button.getAttribute('data-url') || window.location.href;

        if (navigator.clipboard && window.isSecureContext) {
            navigator.clipboard.writeText(url).then(() => successFeedback(button))
                .catch(() => fallbackCopy(url, button));
        } else {
            fallbackCopy(url, button);
        }
    }

    function fallbackCopy(text, button) {
        const textArea = document.createElement("textarea");
        textArea.value = text;
        textArea.style.position = "fixed"; textArea.style.left = "-9999px"; textArea.style.top = "0";
        document.body.appendChild(textArea);
        textArea.focus(); textArea.select();
        try {
            document.execCommand('copy');
            successFeedback(button);
        } catch (err) {
            console.error('Fallback failed', err);
        }
        document.body.removeChild(textArea);
    }

    function successFeedback(button) {
        const icon = button.innerHTML;
        button.innerHTML = '<i class="fas fa-check"></i>';
        button.classList.add('!bg-cyan-500', '!text-black', '!border-cyan-500');

        const toast = document.createElement('div');
        toast.className = 'fixed bottom-24 left-1/2 -translate-x-1/2 bg-cyan-500 text-black px-8 py-3 rounded-full font-black text-[10px] uppercase tracking-widest animate__animated animate__fadeInUp z-[100] shadow-2xl';
        toast.innerText = 'Access Link Copied';
        document.body.appendChild(toast);

        setTimeout(() => {
            button.innerHTML = icon;
            button.classList.remove('!bg-cyan-500', '!text-black', '!border-cyan-500');
            toast.classList.replace('animate__fadeInUp', 'animate__fadeOutDown');
            setTimeout(() => toast.remove(), 500);
        }, 2000);
    }

    const scrollBtn = document.getElementById('scrollToTop');
    window.onscroll = () => {
        if (window.scrollY > 500) { scrollBtn.classList.add('show'); scrollBtn.classList.remove('opacity-0', 'translate-y-10'); }
        else { scrollBtn.classList.remove('show'); scrollBtn.classList.add('opacity-0', 'translate-y-10'); }
    };
    scrollBtn.onclick = () => window.scrollTo({ top: 0, behavior: 'smooth' });
</script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
@endsection

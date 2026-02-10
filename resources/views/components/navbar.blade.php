<style>
    [x-cloak] { display: none !important; }
</style>

<nav x-data="{ open: false }"
     class="bg-[#0f172a]/90 backdrop-blur-xl sticky top-0 z-[100] border-b border-slate-800/50 shadow-2xl">
    <div class="max-w-7xl mx-auto px-6">
        <div class="flex justify-between items-center h-20">

            {{-- Logo --}}
            <div class="flex-shrink-0">
                <a href="{{ url('/') }}" class="text-2xl font-black tracking-tighter hover:scale-105 transition-transform duration-300 block">
                    <span class="bg-gradient-to-r from-cyan-400 to-blue-500 bg-clip-text text-transparent uppercase italic">Nottbell.</span>
                </a>
            </div>

            {{-- Nav Links (Desktop) --}}
            <div class="hidden xl:flex items-center space-x-6 text-[11px] font-black uppercase tracking-[0.15em] text-slate-400">
                <a href="{{ url('/') }}" class="hover:text-cyan-400 transition-colors relative group py-2">Home
                    <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-cyan-400 group-hover:w-full transition-all duration-300"></span>
                </a>
                <a href="{{ url('/#about') }}" class="hover:text-cyan-400 transition-colors">About</a>
                <a href="{{ url('/#skills') }}" class="hover:text-cyan-400 transition-colors">Skill</a>
                <a href="{{ url('/#projects') }}" class="hover:text-cyan-400 transition-colors">Project</a>
                <a href="{{ url('/#news') }}" class="hover:text-cyan-400 transition-colors">Article</a>
                <a href="{{ url('/#education') }}" class="hover:text-cyan-400 transition-colors">Education</a>
                {{-- TAMBAHAN: Experience --}}
                <a href="{{ url('/#experience') }}" class="hover:text-cyan-400 transition-colors">Experience</a>
                <a href="{{ url('/#contact') }}" class="text-cyan-400 hover:text-white transition-colors px-3 py-1 bg-cyan-500/10 rounded-lg border border-cyan-500/20">Contact</a>
            </div>

            {{-- Action Buttons (Desktop Only) --}}
            <div class="hidden lg:flex items-center gap-3">
                @auth
                    <a href="{{ route('admin.dashboard') }}" class="px-4 py-2 bg-slate-800/50 hover:bg-slate-700 text-blue-400 text-[10px] font-black uppercase tracking-widest rounded-xl border border-slate-700 transition-all">
                        <i class="fas fa-desktop mr-1"></i> Dashboard
                    </a>
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="px-4 py-2 bg-red-500/10 hover:bg-red-500 text-red-500 hover:text-white text-[10px] font-black uppercase tracking-widest rounded-xl border border-red-500/20 transition-all">
                            Logout
                        </button>
                    </form>
                @else
                    <a href="{{ url('/#contact') }}" class="px-6 py-2.5 bg-gradient-to-r from-blue-600 to-cyan-500 hover:scale-105 text-white text-[10px] font-black uppercase tracking-[0.2em] rounded-full transition-all shadow-lg shadow-cyan-500/20 active:scale-95">
                        Let's Talk
                    </a>
                @endauth
            </div>

            {{-- Mobile menu button --}}
            <div class="flex xl:hidden items-center">
                <button @click="open = !open"
                        class="p-2.5 text-slate-300 hover:text-cyan-400 transition-all focus:outline-none bg-slate-800/50 rounded-xl border border-slate-700">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path x-show="!open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"/>
                        <path x-show="open" x-cloak stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    {{-- Mobile Nav Drawer --}}
    <div x-show="open"
         x-cloak
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 -translate-y-10"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 -translate-y-10"
         class="xl:hidden absolute top-full left-0 w-full bg-[#0f172a] border-b border-slate-800 shadow-2xl z-50 overflow-y-auto max-h-screen">

        <div class="flex flex-col px-6 py-8 space-y-5">
            <a @click="open = false" href="{{ url('/') }}" class="text-sm font-black uppercase tracking-widest text-slate-300 hover:text-cyan-400 border-l-2 border-transparent hover:border-cyan-400 pl-4 transition-all">Home</a>
            <a @click="open = false" href="{{ url('/#about') }}" class="text-sm font-black uppercase tracking-widest text-slate-300 hover:text-cyan-400 border-l-2 border-transparent hover:border-cyan-400 pl-4 transition-all">About</a>
            <a @click="open = false" href="{{ url('/#skills') }}" class="text-sm font-black uppercase tracking-widest text-slate-300 hover:text-cyan-400 border-l-2 border-transparent hover:border-cyan-400 pl-4 transition-all">Skill</a>
            <a @click="open = false" href="{{ url('/#projects') }}" class="text-sm font-black uppercase tracking-widest text-slate-300 hover:text-cyan-400 border-l-2 border-transparent hover:border-cyan-400 pl-4 transition-all">Project</a>
            <a @click="open = false" href="{{ url('/#news') }}" class="text-sm font-black uppercase tracking-widest text-slate-300 hover:text-cyan-400 border-l-2 border-transparent hover:border-cyan-400 pl-4 transition-all">Article</a>
            <a @click="open = false" href="{{ url('/#education') }}" class="text-sm font-black uppercase tracking-widest text-slate-300 hover:text-cyan-400 border-l-2 border-transparent hover:border-cyan-400 pl-4 transition-all">Education</a>
            {{-- TAMBAHAN: Experience Mobile --}}
            <a @click="open = false" href="{{ url('/#experience') }}" class="text-sm font-black uppercase tracking-widest text-slate-300 hover:text-cyan-400 border-l-2 border-transparent hover:border-cyan-400 pl-4 transition-all">Experience</a>
            <a @click="open = false" href="{{ url('/#contact') }}" class="text-sm font-black uppercase tracking-widest text-cyan-400 border-l-2 border-cyan-400 pl-4 transition-all">Contact</a>

            <div class="h-px bg-slate-800 w-full my-2"></div>

            @auth
                <div class="flex flex-col gap-4 pt-2">
                    <a href="{{ route('admin.dashboard') }}" class="text-xs font-black uppercase tracking-widest text-blue-400 flex items-center gap-2">
                        <i class="fas fa-grid-2"></i> Dashboard Admin
                    </a>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="text-xs font-black uppercase tracking-widest text-red-500">
                             Sign Out Account
                        </button>
                    </form>
                </div>
            @else
                <a @click="open = false" href="{{ url('/#contact') }}" class="w-full text-center py-4 bg-cyan-500 text-white text-xs font-black uppercase tracking-[0.2em] rounded-xl shadow-lg shadow-cyan-500/20">
                    Hire Me Now
                </a>
            @endauth
        </div>
    </div>
</nav>

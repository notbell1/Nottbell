<section id="skills" class="h-screen flex items-center justify-center bg-[#0a0f1d] px-2 md:px-6 relative overflow-hidden scroll-mt-10">

    {{-- Decorative Background Glow --}}
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute -top-24 -left-24 w-80 h-80 bg-cyan-600/10 blur-[100px] rounded-full"></div>
        <div class="absolute -bottom-24 -right-24 w-80 h-80 bg-indigo-600/10 blur-[100px] rounded-full"></div>
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full h-full bg-[url('https://www.transparenttextures.com/patterns/carbon-fibre.png')] opacity-5"></div>
    </div>

    <div class="container mx-auto max-w-6xl relative z-10 h-[85vh] flex flex-col">
        {{-- Header Section - Lebih Ringkas --}}
        <div class="flex items-end justify-between mb-3 px-2 border-b border-slate-800/50 pb-3">
            <div>
                <h2 class="text-2xl md:text-4xl font-black text-white tracking-tighter uppercase leading-none">
                    Hard & Soft <span class="text-cyan-500">Skills</span>
                </h2>
                <p class="text-[9px] text-slate-500 uppercase tracking-[0.3em] mt-1 font-bold italic">Technical & Human Intelligence</p>
            </div>

        </div>

        <div class="grid lg:grid-cols-2 gap-3 flex-1 min-h-0">

            {{-- LEFT COLUMN: HARD SKILLS (Kompak & Padat) --}}
            <div class="flex flex-col min-h-0 h-full">
                <div class="flex-1 grid grid-cols-2 sm:grid-cols-3 gap-2 overflow-y-auto pr-1 custom-scrollbar">
                    @php
                        $hard = [
                            ['n' => 'Laravel', 'i' => 'fab fa-laravel', 'l' => 60, 'c' => 'text-red-500'],
                            ['n' => 'Tailwind', 'i' => 'fab fa-css3-alt', 'l' => 65, 'c' => 'text-cyan-400'],
                            ['n' => 'JavaScript', 'i' => 'fab fa-js', 'l' => 45, 'c' => 'text-yellow-400'],
                            ['n' => 'Pentesting', 'i' => 'fas fa-user-secret', 'l' => 75, 'c' => 'text-white'],
                            ['n' => 'Luau Roblox', 'i' => 'fas fa-cube', 'l' => 70, 'c' => 'text-red-500'],
                            ['n' => 'Accounting', 'i' => 'fas fa-calculator', 'l' => 75, 'c' => 'text-emerald-400'],
                            ['n' => 'MySQL', 'i' => 'fas fa-database', 'l' => 55, 'c' => 'text-blue-500'],
                            ['n' => 'MS Word', 'i' => 'fas fa-file-word', 'l' => 85, 'c' => 'text-blue-600'],
                            ['n' => 'MS Excel', 'i' => 'fas fa-file-excel', 'l' => 85, 'c' => 'text-emerald-600'],
                            ['n' => 'MS PPT', 'i' => 'fas fa-file-powerpoint', 'l' => 85, 'c' => 'text-orange-600'],
                            ['n' => 'Git / Github', 'i' => 'fab fa-github', 'l' => 40, 'c' => 'text-slate-300'],
                            ['n' => 'UI Design', 'i' => 'fas fa-paint-brush', 'l' => 55, 'c' => 'text-pink-400'],
                        ];
                    @endphp

                    @foreach($hard as $h)
                    <div class="group/item relative h-24 md:h-auto bg-slate-900/40 border border-slate-800/60 flex flex-col items-center justify-center rounded-xl transition-all duration-300 hover:border-cyan-500/50 hover:bg-slate-800/40">
                        <i class="{{ $h['i'] }} {{ $h['c'] }} text-2xl mb-1 transition-transform group-hover/item:scale-110"></i>
                        <span class="text-[8px] font-black text-slate-400 uppercase tracking-tighter text-center px-1">{{ $h['n'] }}</span>

                        {{-- Hover Overlay --}}
                        <div class="absolute inset-0 bg-[#0a0f1d] flex flex-col items-center justify-center opacity-0 group-hover/item:opacity-100 transition-opacity duration-300 rounded-xl">
                            <span class="text-lg font-black text-white italic">{{ $h['l'] }}%</span>
                            <div class="w-8 h-1 bg-slate-800 rounded-full mt-1 overflow-hidden">
                                <div class="h-full bg-cyan-500" style="width: {{ $h['l'] }}%"></div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- RIGHT COLUMN: SOFT SKILLS (Flexible Stretch) --}}
            <div class="flex flex-col gap-2 h-full min-h-0">
                @php
                    $soft = [
                        ['n' => 'Public Speaking', 'i' => 'fa-microphone-alt', 'l' => 75, 'color' => 'from-blue-600'],
                        ['n' => 'Leadership', 'i' => 'fa-users-cog', 'l' => 75, 'color' => 'from-indigo-600'],
                        ['n' => 'Problem Solving', 'i' => 'fa-lightbulb', 'l' => 75, 'color' => 'from-purple-600'],
                        ['n' => 'Teamwork', 'i' => 'fa-handshake', 'l' => 85, 'color' => 'from-emerald-600'],
                        ['n' => 'Critical Thinking', 'i' => 'fa-balance-scale', 'l' => 85, 'color' => 'from-cyan-600'],
                    ];
                @endphp

                @foreach($soft as $s)
                <div class="group/soft relative flex-1 min-h-[50px] bg-slate-900/40 border border-slate-800/60 rounded-xl px-4 flex items-center justify-between transition-all duration-300 hover:border-indigo-500/30 overflow-hidden">
                    {{-- Hover Progress Glow --}}
                    <div class="absolute left-0 top-0 h-full bg-gradient-to-r {{ $s['color'] }} to-transparent opacity-0 group-hover/soft:opacity-10 w-0 group-hover/soft:w-full transition-all duration-700"></div>

                    <div class="flex items-center gap-3 relative z-10">
                        <div class="w-9 h-9 rounded-lg bg-slate-800/80 flex items-center justify-center text-base text-slate-500 group-hover/soft:text-white transition-colors">
                            <i class="fas {{ $s['i'] }}"></i>
                        </div>
                        <div>
                            <h4 class="text-white font-black text-[12px] uppercase tracking-wide">{{ $s['n'] }}</h4>
                            <div class="w-20 h-0.5 bg-slate-800 rounded-full mt-1 overflow-hidden">
                                <div class="h-full bg-indigo-500" style="width: {{ $s['l'] }}%"></div>
                            </div>
                        </div>
                    </div>

                    <div class="relative z-10 text-right">
                        <span class="text-xl md:text-2xl font-black text-slate-700 group-hover/soft:text-indigo-400 transition-colors duration-300">{{ $s['l'] }}%</span>
                    </div>
                </div>
                @endforeach

                {{-- Compact Footer --}}
                <div class="h-10 bg-indigo-500/5 border border-dashed border-slate-800 rounded-xl flex items-center justify-center px-4">
                    <p class="text-[8px] text-slate-500 text-center uppercase tracking-[0.2em]">
                        Precision Engineering & Human Synergy
                    </p>
                </div>
            </div>

        </div>
    </div>
</section>

<style>
    /* Smooth Scroll Behavior */
    html { scroll-behavior: smooth; }

    .custom-scrollbar::-webkit-scrollbar { width: 3px; }
    .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background: #1e293b; border-radius: 10px; }

    @media (max-height: 700px) {
        #skills .h-24 { height: 5rem; }
        #skills h2 { font-size: 1.5rem; }
    }
</style>

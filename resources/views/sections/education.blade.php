{{-- SECTION: EDUCATION --}}
<section id="education" class="h-screen min-h-[700px] flex items-center bg-[#0f172a] px-6 relative overflow-hidden scroll-mt-28">
    {{-- Decorative Background Glow --}}
    <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-blue-600/5 blur-[120px] rounded-full -mr-64 -mt-64"></div>
    <div class="absolute bottom-0 left-0 w-[500px] h-[500px] bg-cyan-600/5 blur-[120px] rounded-full -ml-64 -mb-64"></div>

    <div class="container mx-auto max-w-6xl relative z-10 h-[85vh] flex flex-col">
        {{-- Header Ringkas --}}
        <div class="text-center mb-10" data-aos="fade-down">
            <h2 class="text-3xl md:text-5xl font-black bg-gradient-to-r from-cyan-400 via-blue-500 to-indigo-500 bg-clip-text text-transparent uppercase tracking-tighter">
                Academic Journey
            </h2>
            <div class="h-1 w-20 bg-cyan-500 mx-auto mt-2 rounded-full shadow-[0_0_15px_rgba(6,182,212,0.5)]"></div>
        </div>

        {{-- Timeline Container --}}
        <div class="flex-1 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 items-stretch min-h-0 overflow-y-auto md:overflow-visible custom-scrollbar">

            @php
                $edu = [
                    [
                        'year' => '2022 — Pres',
                        'title' => 'Bachelor of Info Systems',
                        'school' => 'West Sumatra Islamic Univ',
                        'desc' => 'Focusing on system analysis, database management, and ERP systems.',
                        'icon' => 'fa-university',
                        'status' => 'current'
                    ],
                    [
                        'year' => '2017 — 2020',
                        'title' => 'High School Diploma',
                        'school' => 'SMAN 1 Batang Anai',
                        'desc' => 'Majored in Natural Sciences (IPA) with focus on foundational technology.',
                        'icon' => 'fa-graduation-cap',
                        'status' => 'past'
                    ],
                    [
                        'year' => '2015 — 2017',
                        'title' => 'Junior High School',
                        'school' => 'SMPN 1 Batang Anai',
                        'desc' => 'Actively involved in scout organizations and basic computing.',
                        'icon' => 'fa-book-open',
                        'status' => 'past'
                    ],
                    [
                        'year' => '2009 — 2015',
                        'title' => 'Elementary School',
                        'school' => 'SDN 13 Batang Anai',
                        'desc' => 'Early education focusing on core academic foundations.',
                        'icon' => 'fa-pencil-alt',
                        'status' => 'past'
                    ]
                ];
            @endphp

            @foreach($edu as $index => $e)
                <div class="group relative flex flex-col" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                    {{-- Connecting Line (Desktop Only) --}}
                    @if(!$loop->last)
                    <div class="hidden lg:block absolute top-10 left-1/2 w-full h-[2px] bg-gradient-to-r from-slate-800 via-slate-700 to-transparent z-0"></div>
                    @endif

                    {{-- Card --}}
                    <div class="relative z-10 flex flex-col h-full bg-slate-900/40 border border-slate-800 p-6 rounded-[2rem] transition-all duration-500 hover:-translate-y-2 hover:border-cyan-500/30 hover:bg-slate-800/60 group">

                        {{-- Icon Bubble --}}
                        <div class="w-14 h-14 rounded-2xl {{ $e['status'] == 'current' ? 'bg-cyan-500/10 border-cyan-500/50 shadow-[0_0_20px_rgba(6,182,212,0.2)]' : 'bg-slate-800 border-slate-700' }} border flex items-center justify-center mb-6 transition-all duration-500 group-hover:scale-110 group-hover:rotate-12">
                            <i class="fas {{ $e['icon'] }} {{ $e['status'] == 'current' ? 'text-cyan-400' : 'text-slate-500' }} text-xl"></i>
                        </div>

                        {{-- Content --}}
                        <div class="flex-1">
                            <span class="{{ $e['status'] == 'current' ? 'text-cyan-400' : 'text-slate-500' }} text-[10px] font-black uppercase tracking-[0.3em]">
                                {{ $e['year'] }}
                            </span>
                            <h3 class="text-lg font-bold text-white mt-2 leading-tight group-hover:text-cyan-400 transition-colors">
                                {{ $e['title'] }}
                            </h3>
                            <p class="text-slate-400 text-xs font-medium mt-1 uppercase tracking-tighter">
                                {{ $e['school'] }}
                            </p>
                            <div class="mt-4 pt-4 border-t border-slate-800/50">
                                <p class="text-slate-500 text-[11px] leading-relaxed italic group-hover:text-slate-300 transition-colors">
                                    "{{ $e['desc'] }}"
                                </p>
                            </div>
                        </div>

                        {{-- Decorative Number --}}
                        <div class="absolute top-4 right-6 text-4xl font-black text-white/5 group-hover:text-white/10 transition-colors">
                            0{{ $loop->iteration }}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Footer Note --}}
        <div class="mt-8 text-center opacity-30">
            <p class="text-[9px] text-slate-500 uppercase tracking-[0.5em] font-bold italic">
                Continuously Building The Foundation of Knowledge
            </p>
        </div>
    </div>
</section>

<style>
    /* Smooth Scroll sudah ada di CSS Global Anda */
    #education .custom-scrollbar::-webkit-scrollbar { width: 4px; }
    #education .custom-scrollbar::-webkit-scrollbar-thumb { background: #1e293b; border-radius: 10px; }

    @media (min-width: 1024px) {
        #education .group:nth-child(even) { margin-top: 2rem; }
        #education .group:nth-child(odd) { margin-bottom: 2rem; }
    }
</style>

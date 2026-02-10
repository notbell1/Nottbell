<section id="about" class="min-h-screen lg:h-screen flex items-center bg-[#0f172a] px-6 relative overflow-hidden py-16">
    {{-- Decorative Background --}}
    <div class="absolute top-0 left-0 w-[500px] h-[500px] bg-cyan-600/5 blur-[120px] rounded-full -ml-64 -mt-64"></div>

    <div class="container mx-auto max-w-7xl relative z-10">
        <div class="grid lg:grid-cols-12 gap-16 items-center">

            {{-- LEFT SIDE: IMAGE STACK WITH GLOW --}}
            <div class="lg:col-span-5 relative flex justify-center items-center h-[550px]" data-aos="fade-right">
                <div class="relative w-80 h-[450px]">

                    {{-- Card 3 (Back) --}}
                    <div class="absolute inset-0 rounded-[2.5rem] bg-slate-800 border-2 border-slate-700 overflow-hidden transition-all duration-700 transform rotate-[-15deg] translate-x-[-60px] -translate-y-4 hover:rotate-0 hover:translate-x-0 hover:translate-y-0 hover:z-50 hover:scale-110 hover:border-blue-500 hover:shadow-[0_0_30px_rgba(59,130,246,0.5)] shadow-2xl z-10 cursor-pointer group/card3">
                        <img src="https://images.unsplash.com/photo-1507238691740-187a5b1d37b8?auto=format&fit=crop&q=80&w=600" alt="About 3" class="w-full h-full object-cover grayscale group-hover/card3:grayscale-0 transition-all duration-500">
                        <div class="absolute inset-0 bg-slate-900/50 group-hover/card3:bg-transparent transition-colors"></div>
                    </div>

                    {{-- Card 2 (Middle) --}}
                    <div class="absolute inset-0 rounded-[2.5rem] bg-slate-800 border-2 border-slate-700 overflow-hidden transition-all duration-700 transform rotate-[15deg] translate-x-[60px] translate-y-4 hover:rotate-0 hover:translate-x-0 hover:translate-y-0 hover:z-50 hover:scale-110 hover:border-cyan-400 hover:shadow-[0_0_30px_rgba(34,211,238,0.5)] shadow-2xl z-20 cursor-pointer group/card2">
                        <img src="https://images.unsplash.com/photo-1498050108023-c5249f4df085?auto=format&fit=crop&q=80&w=600" alt="About 2" class="w-full h-full object-cover grayscale group-hover/card2:grayscale-0 transition-all duration-500">
                        <div class="absolute inset-0 bg-slate-900/50 group-hover/card2:bg-transparent transition-colors"></div>
                    </div>

                    {{-- Card 1 (Front/Main) --}}
                    <div class="absolute inset-0 rounded-[2.5rem] bg-slate-800 border-4 border-slate-900 overflow-hidden transition-all duration-700 transform hover:z-50 hover:scale-105 hover:border-cyan-500 hover:shadow-[0_0_40px_rgba(6,182,212,0.6)] shadow-[0_20px_50px_rgba(0,0,0,0.6)] z-30 cursor-pointer group/card1">
                        <img src="https://images.unsplash.com/photo-1555066931-4365d14bab8c?auto=format&fit=crop&q=80&w=600" alt="About 1" class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-900/80 via-transparent to-transparent opacity-60 group-hover/card1:opacity-0 transition-opacity"></div>
                    </div>
                </div>
            </div>

            {{-- RIGHT SIDE: CONTENT (ENGLISH VERSION) --}}
            <div class="lg:col-span-7 space-y-10" data-aos="fade-left">
                <div>
                    <h2 class="text-6xl font-black bg-gradient-to-r from-cyan-400 to-blue-500 bg-clip-text text-transparent uppercase tracking-tighter mb-6">About Me</h2>
                    <p class="text-slate-400 text-xl leading-relaxed max-w-2xl font-medium">
                        I am <span class="text-white font-bold">Abbel</span>, a dedicated <span class="text-cyan-400">Tech Enthusiast</span> specializing in digital security, modern web development, and game creation.
                    </p>
                </div>

                {{-- INFO GRID --}}
                <div class="grid md:grid-cols-2 gap-10">
                    {{-- Personal Info --}}
                    <div class="space-y-5">
                        <h3 class="text-white font-bold uppercase tracking-widest text-[10px] text-cyan-500/80 flex items-center gap-3">
                            <span class="w-10 h-[1px] bg-cyan-500/50"></span> Personal Detail
                        </h3>
                        <div class="space-y-3">
                            @php
                                $info = [
                                    ['label' => 'Born', 'val' => 'June 06, 2002', 'icon' => 'fas fa-calendar-day'],
                                    ['label' => 'Location', 'val' => 'Kab. Padang Pariaman, West Sumatra, Indonesia', 'icon' => 'fas fa-map-marker-alt'],
                                    ['label' => 'Interests', 'val' => 'Ethical Hacking (Pentest)', 'icon' => 'fas fa-shield-alt'],
                                    ['label' => 'Specialty', 'val' => 'Front-End & Roblox (.lua)', 'icon' => 'fas fa-code'],
                                ];
                            @endphp
                            @foreach($info as $i)
                            <div class="flex items-center gap-4 group">
                                <div class="w-8 h-8 rounded-lg bg-slate-800/50 flex items-center justify-center text-cyan-400 group-hover:bg-cyan-500 group-hover:text-white group-hover:shadow-[0_0_15px_rgba(34,211,238,0.4)] transition-all">
                                    <i class="{{ $i['icon'] }} text-[10px]"></i>
                                </div>
                                <div>
                                    <p class="text-[8px] text-slate-500 uppercase font-bold tracking-widest">{{ $i['label'] }}</p>
                                    <p class="text-slate-200 text-xs font-bold group-hover:text-cyan-400 transition-colors">{{ $i['val'] }}</p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- Education --}}
                    <div class="space-y-5">
                        <h3 class="text-white font-bold uppercase tracking-widest text-[10px] text-blue-500/80 flex items-center gap-3">
                            <span class="w-10 h-[1px] bg-blue-500/50"></span> Education
                        </h3>
                        <div class="space-y-6">
                            <a href="https://uisb.ac.id" target="_blank" rel="noopener noreferrer" class="relative block pl-6 border-l border-slate-800 hover:border-blue-500 transition-colors group">
                                <div class="absolute w-2 h-2 bg-blue-500 rounded-full -left-[4.5px] top-1 shadow-[0_0_10px_rgba(59,130,246,0.8)] group-hover:scale-150 transition-transform"></div>
                                <p class="text-slate-200 text-xs font-black group-hover:text-blue-400 transition-colors">Bachelor of Information Systems</p>
                                <p class="text-slate-500 text-[10px] mt-1 font-bold">Islamic University of West Sumatra</p>
                                <p class="text-cyan-500/80 text-[9px] mt-1 font-bold italic">2023 — Present</p>
                                <div class="flex items-center gap-1 mt-2 text-[8px] text-blue-400 opacity-0 group-hover:opacity-100 transition-opacity">
                                    <span>Visit Campus</span> <i class="fas fa-external-link-alt"></i>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>

                {{-- ACTION BUTTONS --}}
                <div class="flex flex-wrap items-center gap-8 pt-6">
                    <div class="flex gap-4">
                        <a href="#contact" class="px-10 py-4 bg-cyan-500 text-slate-900 text-[11px] font-black uppercase tracking-[0.2em] rounded-2xl transition-all shadow-[0_0_20px_rgba(6,182,212,0.3)] hover:shadow-[0_0_35px_rgba(6,182,212,0.6)] hover:bg-white hover:scale-105 active:scale-95">
                            Hire Me
                        </a>

                        <a href="{{ asset('assets/pdf/cv-abbel-kadafi.pdf') }}" download class="px-10 py-4 border-2 border-slate-800 text-white text-[11px] font-black uppercase tracking-[0.2em] rounded-2xl transition-all flex items-center gap-3 group hover:border-cyan-500 hover:text-cyan-400 hover:shadow-[0_0_25px_rgba(6,182,212,0.2)] active:scale-95">
                            Download CV
                            <i class="fas fa-download text-xs group-hover:translate-y-1 transition-transform"></i>
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

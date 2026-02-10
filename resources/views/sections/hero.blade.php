<section id="home" class="h-screen max-h-screen min-h-[650px] flex items-center px-6 overflow-hidden relative bg-[#0a0f1d]">
    {{-- Decorative Background Glow --}}
    <div class="absolute top-[-10%] left-[-10%] w-[40%] h-[40%] bg-blue-600/10 blur-[120px] rounded-full animate-pulse"></div>
    <div class="absolute bottom-[-10%] right-[-10%] w-[40%] h-[40%] bg-cyan-600/10 blur-[120px] rounded-full animate-pulse-slow"></div>

    {{-- Grid Overlay --}}
    <div class="absolute inset-0 opacity-[0.03]" style="background-image: radial-gradient(#fff 1px, transparent 1px); background-size: 40px 40px;"></div>

    <div class="container mx-auto max-w-7xl relative z-10">
        <div class="grid lg:grid-cols-12 gap-12 items-center">

            {{-- LEFT SIDE: CONTENT --}}
            <div class="lg:col-span-7 space-y-6 animate__animated animate__fadeInLeft">
                <div class="space-y-3">
                    <div class="flex items-center gap-3">
                        <span class="h-[1px] w-10 bg-cyan-500 shadow-[0_0_10px_rgba(6,182,212,0.5)]"></span>
                        <span class="text-cyan-400 uppercase tracking-[0.4em] text-[9px] font-black">Front-End Developer & Cyber Security Enthusiast</span>
                    </div>

                    <h1 class="text-5xl md:text-7xl lg:text-[5.2rem] font-black leading-[0.85] tracking-tighter text-white">
                        CRAFTING <br>
                        <span class="bg-gradient-to-r from-cyan-400 via-blue-500 to-indigo-600 bg-clip-text text-transparent">DIGITAL</span><br>
                        PERFECTION.
                    </h1>

                    <p class="mt-4 text-slate-400 text-base md:text-lg max-w-lg leading-relaxed font-medium">
                        I'm <span class="text-white border-b border-cyan-500/50">Abbel</span>.
                        A tech enthusiast specializing in building <span class="text-white">Web Applications</span>, exploring <span class="text-cyan-400">Ethical Hacking</span>, and developing immersive environments in <span class="text-blue-400">Roblox using Luau</span>.
                    </p>
                </div>

                {{-- ACTION BUTTONS --}}
                <div class="flex flex-wrap gap-4 items-center">
                    <a href="#projects" class="group relative px-8 py-4 bg-white text-slate-950 font-black uppercase tracking-widest text-[10px] rounded-xl overflow-hidden transition-all hover:scale-105 active:scale-95 shadow-[0_0_20px_rgba(255,255,255,0.1)]">
                        <span class="relative z-10">Explore Work</span>
                        <div class="absolute inset-0 bg-gradient-to-r from-cyan-400 to-blue-500 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    </a>

                    <a href="#contact" class="group relative px-8 py-4 border border-slate-800 text-white font-black uppercase tracking-widest text-[10px] rounded-xl overflow-hidden transition-all hover:border-cyan-500/50 hover:shadow-[0_0_15px_rgba(6,182,212,0.2)]">
                        <span class="group-hover:text-cyan-400 transition-colors">Contact Me</span>
                    </a>
                </div>

{{-- SOCIAL MEDIA CHANNELS --}}
<div class="pt-6 border-t border-slate-800/50 flex flex-wrap items-center gap-4">
    @php
        $heroSocials = [
            ['icon' => 'fab fa-github', 'link' => 'https://github.com/notbell1', 'color' => 'hover:text-white hover:border-white/50'],
            ['icon' => 'fab fa-linkedin', 'link' => 'https://www.linkedin.com/in/abbel', 'color' => 'hover:text-blue-400 hover:border-blue-400/50'],
            ['icon' => 'fab fa-whatsapp', 'link' => 'https://wa.me/6282287592930', 'color' => 'hover:text-green-400 hover:border-green-400/50'],
            ['icon' => 'fab fa-instagram', 'link' => 'https://instagram.com/_ntbbll', 'color' => 'hover:text-pink-500 hover:border-pink-500/50'],
            // Added Roblox Icon
            ['icon' => 'fas fa-cube', 'link' => 'https://www.roblox.com/users/9013470120/profile', 'color' => 'hover:text-red-600 hover:border-red-600/50'],
            ['icon' => 'fab fa-facebook', 'link' => 'https://facebook.com/zx.marchia', 'color' => 'hover:text-blue-600 hover:border-blue-600/50'],
            ['icon' => 'fab fa-twitter', 'link' => 'https://x.com/zxbell2', 'color' => 'hover:text-slate-200 hover:border-slate-200/50'],
            ['icon' => 'fab fa-telegram', 'link' => 'https://t.me/bellxss', 'color' => 'hover:text-sky-400 hover:border-sky-400/50'],
            ['icon' => 'fas fa-envelope', 'link' => 'mailto:abbelkadafi@gmail.com', 'color' => 'hover:text-red-400 hover:border-red-400/50'],
            ['icon' => 'fas fa-university', 'link' => 'https://uisb.ac.id/', 'color' => 'hover:text-yellow-400 hover:border-yellow-400/50'],
        ];
    @endphp
    <div class="flex flex-wrap gap-2.5">
        @foreach($heroSocials as $social)
        <a href="{{ $social['link'] }}"
           target="_blank"
           rel="noopener noreferrer"
           class="w-10 h-10 rounded-xl bg-slate-900/50 border border-slate-800 flex items-center justify-center text-slate-400 transition-all duration-300 {{ $social['color'] }} hover:shadow-[0_0_20px_rgba(255,255,255,0.05)] hover:-translate-y-1.5 active:scale-90 shadow-sm"
           title="{{ $social['icon'] === 'fas fa-cube' ? 'Roblox' : Str::afterLast($social['icon'], '-') }}">
            <i class="{{ $social['icon'] }} text-base"></i>
        </a>
        @endforeach
    </div>
</div>
            </div>

            {{-- RIGHT SIDE: PROFILE VISUAL --}}
            <div class="lg:col-span-5 relative flex justify-center items-center">
                <div class="relative w-72 h-72 md:w-[420px] md:h-[420px] group">
                    <div class="absolute inset-[-15px] border border-cyan-500/20 rounded-full animate-[spin_10s_linear_infinite] opacity-50"></div>
                    <div class="absolute inset-[-30px] border border-blue-500/10 rounded-full animate-[spin_15s_linear_infinite_reverse] opacity-30"></div>

                    <div class="absolute inset-[-15px] rounded-full animate-[spin_8s_linear_infinite]">
                        <div class="w-3 h-3 bg-cyan-400 rounded-full blur-[2px] shadow-[0_0_15px_rgba(34,211,238,1)] absolute top-0 left-1/2 -translate-x-1/2"></div>
                    </div>

                    <div class="relative z-10 w-full h-full rounded-[2.5rem] p-2 transition-all duration-700 group-hover:scale-[1.02] group-hover:rotate-1">
                        <div class="absolute inset-0 rounded-[2.5rem] bg-gradient-to-tr from-cyan-500 via-blue-600 to-indigo-600 p-[2px] animate-gradient-xy shadow-[0_0_40px_rgba(6,182,212,0.15)] group-hover:shadow-[0_0_60px_rgba(6,182,212,0.3)] transition-all duration-700">
                            <div class="w-full h-full bg-[#0a0f1d] rounded-[2.4rem] overflow-hidden relative">
                                <img src="{{ asset('img/profile.jpg') }}" alt="Profile" class="w-full h-full object-cover grayscale-[20%] group-hover:grayscale-0 transition-all duration-700">
                                <div class="absolute inset-0 bg-gradient-to-t from-[#0a0f1d] via-transparent to-transparent opacity-60"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

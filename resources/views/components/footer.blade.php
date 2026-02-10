<footer class="bg-[#0f172a] text-slate-400 pt-20 pb-10 border-t border-slate-800/50">
    <div class="max-w-6xl mx-auto px-6">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-16">

            {{-- Kolom 1: Brand & Bio --}}
            <div class="space-y-6">
                <a href="{{ url('/') }}" class="text-2xl font-black bg-gradient-to-r from-cyan-400 to-blue-500 bg-clip-text text-transparent">
                    Nottbell.
                </a>
                <p class="text-sm leading-relaxed text-slate-500">
                    A tech enthusiast specializing in building Web Applications, exploring Ethical Hacking, and developing immersive environments in Roblox using Luau.
                </p>
                <div class="flex space-x-4">
                    <a href="#" class="hover:text-cyan-400 transition-colors"><i class="fab fa-github text-xl"></i></a>
                    <a href="#" class="hover:text-cyan-400 transition-colors"><i class="fab fa-linkedin text-xl"></i></a>
                    <a href="#" class="hover:text-cyan-400 transition-colors"><i class="fab fa-instagram text-xl"></i></a>
                </div>
            </div>

            {{-- Kolom 2: Quick Links --}}
            <div>
                <h4 class="text-white font-bold mb-6 uppercase tracking-widest text-xs">Navigation</h4>
                <ul class="space-y-4 text-sm">
                    <li><a href="{{ url('/') }}" class="hover:text-cyan-400 transition-colors">Home</a></li>
                    <li><a href="{{ url('/#about') }}" class="hover:text-cyan-400 transition-colors">About Me</a></li>
                    <li><a href="{{ url('/#projects') }}" class="hover:text-cyan-400 transition-colors">Portfolio</a></li>
                    <li><a href="{{ url('/#news') }}" class="hover:text-cyan-400 transition-colors">Articles</a></li>
                </ul>
            </div>

            {{-- Kolom 3: Services / Focus --}}
            <div>
                <h4 class="text-white font-bold mb-6 uppercase tracking-widest text-xs">Expertise</h4>
                <ul class="space-y-4 text-sm">
                    <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-cyan-500"></span> Front-End</li>
                    <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-blue-500"></span> UI/UX Design</li>
                    <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-indigo-500"></span> Cyber Security Enthusiast</li>
                    <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-purple-500"></span> Roblox Luau</li>
                </ul>
            </div>

            {{-- Kolom 4: Contact Info --}}
            <div>
                <h4 class="text-white font-bold mb-6 uppercase tracking-widest text-xs">Get In Touch</h4>
                <ul class="space-y-4 text-sm">
                    <li class="flex items-start gap-3">
                        <i class="fas fa-envelope mt-1 text-cyan-400"></i>
                        <span>abbelkadafi@gmail.com</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <i class="fas fa-map-marker-alt mt-1 text-cyan-400"></i>
                        <span>Padang Pariaman, West Sumatra,<br>Indonesia</span>
                    </li>
                </ul>
            </div>

        </div>

        {{-- Bottom Footer --}}
        <div class="pt-8 border-t border-slate-800/50 flex flex-col md:flex-row justify-between items-center gap-4 text-xs tracking-wide">
            <p>&copy; 2026 <span class="text-white font-bold">Nottbell</span>. All rights reserved.</p>
            <p>
                Built with
                <a href="https://laravel.com/" target="_blank" class="text-slate-200 hover:text-cyan-400 transition-colors font-bold">Laravel</a>
                &
                <a href="https://tailwindcss.com/" target="_blank" class="text-slate-200 hover:text-cyan-400 transition-colors font-bold">Tailwind CSS</a>
            </p>
        </div>
    </div>
<br>
    <div class="max-w-6xl mx-auto px-6 text-center">
        <p class="text-[10px] font-black uppercase tracking-[0.4em]">&copy; {{ date('Y') }} Nottbell. All Rights Reserved.</p>
    </div>

</footer>

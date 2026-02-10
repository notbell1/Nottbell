<section id="projects" class="py-24 bg-[#1e293b]/30 px-6">
    <div class="container mx-auto">
        <h2 class="text-4xl font-bold text-center mb-16 bg-gradient-to-r from-cyan-400 to-blue-500 bg-clip-text text-transparent animate__animated animate__fadeInUp">Featured Projects</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
            @forelse($projects as $project)
                <div class="group bg-[#0f172a] rounded-2xl overflow-hidden shadow-lg border border-slate-800 hover:border-cyan-500 hover:shadow-cyan-500/20 transition-all duration-300 animate__animated animate__fadeInUp">
                    <div class="relative h-56 bg-gradient-to-br from-indigo-900 to-gray-900 overflow-hidden">
                        <img src="https://via.placeholder.com/600x400/0f172a/94a3b8?text=Project+Image" alt="{{ $project->title }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent"></div>
                        <div class="absolute bottom-4 left-4 text-white text-xl font-bold">{{ $project->title }}</div>
                    </div>
                    <div class="p-6">
                        <p class="text-slate-400 mb-4">{{ Str::limit($project->description, 100) }}</p>
                        <a href="{{ $project->link ?? '#' }}" target="_blank" class="text-cyan-400 hover:text-cyan-500 font-semibold flex items-center group-hover:underline transition-all">
                            View Project
                            <svg class="h-5 w-5 ml-1 transform group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                            </svg>
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-10">
                    <p class="text-slate-500 italic">No projects found. Add some projects from the admin panel!</p>
                </div>
            @endforelse
        </div>
    </div>
</section>

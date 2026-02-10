<section id="news" class="py-24 bg-[#0f172a] px-6 border-t border-slate-800">
    <div class="container mx-auto">
        <h2 class="text-4xl font-bold text-center mb-16 bg-gradient-to-r from-cyan-400 to-blue-500 bg-clip-text text-transparent">Latest News</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            @foreach($news as $item)
            <div class="bg-[#1e293b]/50 p-6 rounded-2xl border border-slate-800 hover:border-cyan-500/30 transition-all flex gap-6">
                <img src="{{ asset('storage/'.$item->thumbnail) }}" class="w-32 h-32 object-cover rounded-xl bg-slate-800">
                <div>
                    <span class="text-cyan-400 text-xs font-bold uppercase">{{ $item->created_at->format('d M Y') }}</span>
                    <h3 class="text-xl font-bold mt-1">{{ $item->title }}</h3>
                    <p class="text-slate-400 text-sm mt-2 line-clamp-2">{{ $item->content }}</p>
                    <a href="#" class="inline-block mt-4 text-cyan-400 text-sm font-bold hover:underline"></a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

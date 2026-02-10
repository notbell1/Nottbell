@extends('layouts.admin')

@section('admin_content')
@php
    // --- LOGIKA REAL SYSTEM HEALTH ---

    // 1. Cek Koneksi Database
    $dbStatus = 'Optimal';
    $dbColor = 'emerald';
    try {
        \DB::connection()->getPdo();
    } catch (\Exception $e) {
        $dbStatus = 'Offline';
        $dbColor = 'red';
    }

    // 2. Cek Kapasitas Disk (Storage) Detil
    $diskFree = disk_free_space(base_path());
    $diskTotal = disk_total_space(base_path());
    $diskUsed = $diskTotal - $diskFree;
    $usedPercentage = round(($diskUsed / $diskTotal) * 100);

    // Konversi ke Gigabyte (GB)
    $totalGB = round($diskTotal / (1024 * 1024 * 1024), 1);
    $usedGB = round($diskUsed / (1024 * 1024 * 1024), 1);
    $freeGB = round($diskFree / (1024 * 1024 * 1024), 1);

    // 3. Hitung Data Content
    $projCount = \App\Models\Project::count();
    $newsCount = \App\Models\News::count();
@endphp

<div class="animate__animated animate__fadeIn space-y-8 pb-10">

    {{-- Row 1: Profile & Time --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-sm flex flex-col md:flex-row items-center gap-8 relative overflow-hidden">
            <div class="absolute top-0 right-0 p-10 opacity-[0.03] select-none">
                <i class="fas fa-user-shield text-9xl"></i>
            </div>
            <div class="relative">
                <img src="{{ asset('img/profile.jpg') }}"
                     alt="Admin Profile"
                     class="w-32 h-32 rounded-[2.5rem] object-cover ring-8 ring-cyan-500/5 shadow-2xl">
                <div class="absolute -bottom-2 -right-2 bg-emerald-500 p-2 rounded-2xl border-4 border-white animate-pulse">
                    <div class="w-2 h-2 bg-white rounded-full"></div>
                </div>
            </div>
            <div class="text-center md:text-left relative z-10">
                <div class="inline-block px-3 py-1 bg-cyan-500/10 rounded-full mb-3">
                    <p class="text-[9px] font-black text-cyan-600 uppercase tracking-[0.2em]">Verified Administrator</p>
                </div>
                <h1 class="text-4xl font-black text-slate-800 tracking-tighter">Nottbell</h1>
                <p class="text-slate-400 mt-1 font-medium text-sm">Front-End Developer • Cyber Security Enthusiast</p>

                <div class="flex flex-wrap justify-center md:justify-start gap-3 mt-6">
                    <div class="flex items-center px-4 py-2 bg-slate-50 rounded-2xl border border-slate-100">
                        <i class="fas fa-bolt text-cyan-500 mr-3 text-xs"></i>
                        <span class="text-[10px] font-black text-slate-600 uppercase tracking-widest">IP: {{ request()->ip() }}</span>
                    </div>
                    <div class="flex items-center px-4 py-2 bg-slate-50 rounded-2xl border border-slate-100">
                        <i class="fas fa-shield-alt text-cyan-500 mr-3 text-xs"></i>
                        <span class="text-[10px] font-black text-slate-600 uppercase tracking-widest">Secure Session</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-slate-900 rounded-[2.5rem] p-8 text-white flex flex-col justify-center items-center text-center shadow-2xl shadow-cyan-950/20 relative overflow-hidden border border-white/5">
            <div class="absolute inset-0 bg-grid-white/[0.02] pointer-events-none"></div>
            <p id="current-date" class="text-cyan-400 text-[10px] font-black uppercase tracking-[0.4em] mb-4 relative z-10"></p>
            <h2 id="realtime-clock" class="text-6xl font-black tracking-tighter tabular-nums mb-2 relative z-10 text-white drop-shadow-[0_0_15px_rgba(34,211,238,0.3)]">00:00:00</h2>
            <div class="flex items-center gap-2 relative z-10">
                <span class="w-2 h-2 bg-cyan-500 rounded-full animate-ping"></span>
                <p class="text-slate-500 text-[9px] font-bold uppercase tracking-[0.3em]">WIB Standard Time</p>
            </div>
        </div>
    </div>

    {{-- Row 2: Charts & System Health --}}
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
        <div class="lg:col-span-2 bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-sm flex flex-col items-center justify-center">
            <div class="w-full mb-6">
                <h3 class="font-black text-slate-800 uppercase text-xs tracking-widest">Content Distribution</h3>
                <p class="text-slate-400 text-xs">Komposisi Project vs News</p>
            </div>
            <div class="relative w-full max-w-[220px]">
                <canvas id="distributionChart"></canvas>
            </div>
            <div class="flex gap-8 mt-8 w-full justify-center text-center">
                <div class="flex flex-col gap-1">
                    <div class="flex items-center justify-center gap-2">
                        <div class="w-2 h-2 rounded-full bg-cyan-500"></div>
                        <p class="text-[10px] font-black text-slate-400 uppercase">Projects</p>
                    </div>
                    <p class="text-xl font-black text-slate-800">{{ $projCount }}</p>
                </div>
                <div class="flex flex-col gap-1">
                    <div class="flex items-center justify-center gap-2">
                        <div class="w-2 h-2 rounded-full bg-slate-800"></div>
                        <p class="text-[10px] font-black text-slate-400 uppercase">News</p>
                    </div>
                    <p class="text-xl font-black text-slate-800">{{ $newsCount }}</p>
                </div>
            </div>
        </div>

        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-sm h-full">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="font-black text-slate-800 uppercase text-xs tracking-widest">System Health</h3>
                    <i class="fas fa-heartbeat text-slate-200 text-xl"></i>
                </div>

                <div class="space-y-8">
                    {{-- Database Status --}}
                    <div>
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-[11px] font-bold text-slate-500 uppercase tracking-widest">Database Server</span>
                            <span class="text-[10px] font-black text-{{ $dbColor }}-500 bg-{{ $dbColor }}-50 px-3 py-1 rounded-lg uppercase italic">{{ $dbStatus }}</span>
                        </div>
                        <div class="w-full bg-slate-100 h-2 rounded-full overflow-hidden">
                            <div class="bg-{{ $dbColor }}-500 h-full w-full"></div>
                        </div>
                    </div>

                    {{-- Storage Status (DETIL GB) --}}
                    <div>
                        <div class="flex justify-between items-center mb-2">
                            <div class="flex flex-col">
                                <span class="text-[11px] font-bold text-slate-500 uppercase tracking-widest">Server Storage</span>
                                <span class="text-[9px] text-slate-400 font-medium tracking-tight">Available: {{ $freeGB }} GB free</span>
                            </div>
                            <span class="text-[10px] font-black text-cyan-600 bg-cyan-50 px-3 py-1 rounded-lg uppercase italic">
                                {{ $usedGB }} GB / {{ $totalGB }} GB ({{ $usedPercentage }}%)
                            </span>
                        </div>
                        <div class="w-full bg-slate-100 h-2 rounded-full overflow-hidden">
                            <div class="bg-cyan-500 h-full transition-all duration-1000" style="width: {{ $usedPercentage }}%"></div>
                        </div>
                    </div>

                    <div class="pt-6 border-t border-slate-50 flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-slate-50 rounded-2xl flex items-center justify-center text-slate-400">
                                <i class="fas fa-server text-xs"></i>
                            </div>
                            <div>
                                <p class="text-[10px] font-black text-slate-700 uppercase tracking-widest">Environment</p>
                                <p class="text-[9px] font-bold text-slate-400 uppercase italic">Laravel {{ app()->version() }} • PHP {{ phpversion() }}</p>
                            </div>
                        </div>
                        <i class="fas fa-check-circle text-emerald-500 text-sm"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Row 3: Quick Navigation --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <a href="{{ route('admin.projects.index') }}" class="group bg-white p-6 rounded-[2.2rem] border border-slate-100 shadow-sm hover:border-cyan-500 transition-all">
            <div class="w-12 h-12 bg-cyan-50 text-cyan-500 rounded-2xl flex items-center justify-center mb-4 group-hover:bg-cyan-500 group-hover:text-white transition-all shadow-sm">
                <i class="fas fa-layer-group"></i>
            </div>
            <h4 class="font-black text-slate-800 uppercase text-[10px] tracking-[0.2em] mb-1">Projects Library</h4>
            <p class="text-[10px] text-slate-400">Manage works & code</p>
        </a>

        <a href="{{ route('admin.news.index') }}" class="group bg-white p-6 rounded-[2.2rem] border border-slate-100 shadow-sm hover:border-slate-800 transition-all">
            <div class="w-12 h-12 bg-slate-50 text-slate-800 rounded-2xl flex items-center justify-center mb-4 group-hover:bg-slate-800 group-hover:text-white transition-all shadow-sm">
                <i class="fas fa-newspaper"></i>
            </div>
            <h4 class="font-black text-slate-800 uppercase text-[10px] tracking-[0.2em] mb-1">Article Feed</h4>
            <p class="text-[10px] text-slate-400">Write latest news</p>
        </a>

        <div class="md:col-span-2 bg-gradient-to-r from-cyan-600 to-blue-700 rounded-[2.2rem] p-6 flex items-center justify-between text-white relative overflow-hidden shadow-xl shadow-cyan-900/20">
            <i class="fas fa-rocket absolute -right-4 -bottom-4 text-8xl opacity-10"></i>
            <div class="relative z-10">
                <h3 class="text-xl font-black mb-1">System Deploy</h3>
                <p class="text-[10px] text-cyan-100 uppercase font-bold tracking-[0.2em]">Ready to push new content?</p>
            </div>
            <a href="{{ route('admin.projects.create') }}" class="px-6 py-3 bg-white text-cyan-700 rounded-xl text-[10px] font-black uppercase tracking-widest hover:bg-cyan-50 transition-all shadow-lg relative z-10">
                <i class="fas fa-plus mr-2"></i> New Entry
            </a>
        </div>
    </div>
</div>

{{-- Scripts --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // 1. Clock Logic
    function updateClock() {
        const now = new Date();
        const optionsDate = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
        document.getElementById('realtime-clock').textContent = now.toLocaleTimeString('en-GB', { hour12: false });
        document.getElementById('current-date').textContent = now.toLocaleDateString('id-ID', optionsDate).toUpperCase();
    }
    setInterval(updateClock, 1000);
    updateClock();

    // 2. Chart Logic
    const ctx = document.getElementById('distributionChart').getContext('2d');
    new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['Projects', 'News'],
            datasets: [{
                data: [{{ $projCount }}, {{ $newsCount }}],
                backgroundColor: ['#06b6d4', '#1e293b'],
                hoverOffset: 12,
                borderWidth: 0,
                cutout: '80%',
                borderRadius: 15
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { display: false } },
            animation: { animateScale: true, duration: 2000 }
        }
    });
</script>
@endsection

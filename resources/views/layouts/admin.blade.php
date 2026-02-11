<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nottbell | Dashboard</title>

    <link rel="icon" type="image/png" href="{{ asset('img/icon.png') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#f8fafc] flex min-h-screen">

    <aside class="w-64 bg-slate-900 text-white fixed h-full flex flex-col">
        <div class="p-8">
            <h2 class="text-2xl font-bold text-cyan-400 italic">Nottbell.</h2>
            <p class="text-xs text-slate-500 mt-1 uppercase tracking-widest">Admin Panel</p>
        </div>

        <nav class="flex-grow px-4 space-y-2">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 py-3 px-4 rounded-xl {{ request()->is('admin') ? 'bg-cyan-600 text-white' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }} transition-all">
                <i class="fa-solid fa-chart-line w-5"></i>
                <span>Dashboard</span>
            </a>
            <a href="{{ route('admin.projects.index') }}" class="flex items-center gap-3 py-3 px-4 rounded-xl {{ request()->is('admin/projects*') ? 'bg-cyan-600 text-white' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }} transition-all">
                <i class="fa-solid fa-briefcase w-5"></i>
                <span>Projects</span>
            </a>
            <a href="{{ route('admin.news.index') }}" class="flex items-center gap-3 py-3 px-4 rounded-xl {{ request()->is('admin/news*') ? 'bg-cyan-600 text-white' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }} transition-all">
                <i class="fa-solid fa-newspaper w-5"></i>
                <span>News Section</span>
            </a>
        </nav>

        <div class="p-6 border-t border-slate-800">
            <form action="{{ route('logout') }}" method="POST" class="mb-4">
                @csrf
                <button type="submit" class="w-full text-left text-sm text-red-400 hover:text-red-300 flex items-center gap-2 px-4">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    Logout
                </button>
            </form>

            <a href="/" target="_blank" class="text-sm text-slate-500 hover:text-cyan-400 flex items-center gap-2 px-4">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                </svg>
                View Website
            </a>
        </div>
    </aside>

    <main class="flex-1 ml-64 p-10">
        @include('admin.partials.alerts')

        @yield('admin_content')
    </main>

</body>
</html>

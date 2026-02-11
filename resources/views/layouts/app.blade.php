<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <title>Nottbell | Portfolio</title>

    <link rel="icon" type="image/png" href="{{ asset('img/icon.png') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    {{-- Heroicons CDN for easy icon usage --}}
    <link href="https://cdn.jsdelivr.net/npm/@heroicons/react@2.0.18/24/outline/index.min.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Custom styles for animations --}}
    <style>
        @keyframes pulse-slow {
            0%, 100% { transform: scale(1); opacity: 0.2; }
            50% { transform: scale(1.1); opacity: 0.3; }
        }
        .animate-pulse-slow {
            animation: pulse-slow 8s infinite ease-in-out;
        }

        @keyframes gradient-border {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        .animate-gradient-border {
            animation: gradient-border 6s ease infinite;
            background-size: 400% 400%;
        }
    </style>
</head>
<body class="bg-[#0f172a] text-slate-200 flex flex-col min-h-screen font-sans">
    @include('components.navbar')

    <main class="flex-grow">
        @yield('content')
    </main>

    @include('components.footer')

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
      AOS.init({
        duration: 1000,
        once: false,
        mirror: true,
      });
    </script>
</body>
</html>

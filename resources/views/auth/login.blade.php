@extends('layouts.app')

@section('content')
<style>
    /* Viewport Setup */
    .login-viewport {
        height: 100vh;
        width: 100%;
        overflow: hidden;
        background-color: #020408;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
    }

    /* Grid Background Decorative */
    .bg-grid {
        position: absolute;
        inset: 0;
        background-image: radial-gradient(circle at 2px 2px, rgba(34, 211, 238, 0.05) 1px, transparent 0);
        background-size: 40px 40px;
        mask-image: radial-gradient(circle at center, black, transparent 80%);
        pointer-events: none;
        z-index: 1;
    }

    /* Main Card */
    .login-card {
        width: 100%;
        max-width: 400px;
        background: rgba(15, 23, 42, 0.8);
        backdrop-filter: blur(25px);
        -webkit-backdrop-filter: blur(25px);
        border: 1px solid rgba(255, 255, 255, 0.05);
        border-radius: 2.5rem;
        padding: 2.5rem;
        position: relative;
        z-index: 10;
        transition: all 0.5s cubic-bezier(0.22, 1, 0.36, 1);
    }

    /* Input Styling */
    .input-group {
        position: relative;
        z-index: 20;
    }

    .input-group input {
        width: 100%;
        background: rgba(5, 8, 16, 0.8) !important;
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 1.25rem;
        padding: 1rem 1.5rem;
        color: white !important;
        outline: none;
        transition: all 0.3s ease;
    }

    .input-group input:focus {
        border-color: #22d3ee;
        box-shadow: 0 0 15px rgba(34, 211, 238, 0.1);
        background: #000000 !important;
    }

    /* Button Styling */
    .btn-submit {
        width: 100%;
        background: #ffffff;
        color: #000;
        font-weight: 900;
        padding: 1.25rem;
        border-radius: 1.25rem;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        transition: all 0.3s ease;
        cursor: pointer;
        border: none;
        margin-top: 1rem;
    }

    .btn-submit:hover {
        background: #22d3ee;
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(34, 211, 238, 0.2);
    }

    /* Cyber Beam Border Hover */
    .login-card::after {
        content: "";
        position: absolute;
        inset: -1px;
        border-radius: 2.5rem;
        padding: 1px;
        background: linear-gradient(90deg, transparent, #22d3ee, transparent);
        -webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
        mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
        -webkit-mask-composite: xor;
        mask-composite: exclude;
        opacity: 0;
        transition: opacity 0.5s ease;
        pointer-events: none;
    }
    .login-card:hover::after { opacity: 1; }

    /* Security Alert Animation */
    @keyframes shake {
        0%, 100% { transform: translateX(0); }
        25% { transform: translateX(-5px); }
        75% { transform: translateX(5px); }
    }
    .security-alert {
        animation: shake 0.4s ease-in-out infinite;
    }
</style>

<div class="login-viewport">
    <div class="bg-grid"></div>

    <div class="login-card">
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-14 h-14 rounded-2xl bg-cyan-500/10 border border-cyan-500/20 mb-4">
                <i class="fas fa-user-shield text-cyan-400 text-xl"></i>
            </div>
            <h1 class="text-2xl font-black text-white tracking-tighter uppercase">LOGIN <span class="text-cyan-400">Portal</span></h1>
            <p class="text-[9px] text-slate-500 font-bold uppercase tracking-[0.4em]">ADMIN ONLY</p>
        </div>

        {{-- Pesan Sukses Reset Password --}}
        @if(session('status'))
            <div class="mb-6 p-3 rounded-xl bg-cyan-500/10 border border-cyan-500/20 text-center">
                <p class="text-cyan-400 text-[10px] font-bold uppercase">{{ session('status') }}</p>
            </div>
        @endif

        {{-- PESAN SARKAS UNTUK HACKER/PENTEST --}}
        @if($errors->has('security'))
            <div class="mb-6 p-4 rounded-2xl bg-red-500/10 border border-red-500/20 text-center security-alert">
                <p class="text-red-500 text-[10px] font-black uppercase tracking-widest leading-relaxed">
                    <i class="fas fa-skull-crossbones mb-2 block text-sm"></i>
                    {{ $errors->first('security') }}
                </p>
            </div>
        @endif

        <form action="{{ route('processLogin') }}" method="POST" class="space-y-5">
            @csrf
            {{-- Honeypot field: Proteksi Bot --}}
            <input type="text" name="honeypot" style="display:none !important" tabindex="-1" autocomplete="off">

            <div class="input-group">
                <label class="text-[9px] font-black text-slate-400 uppercase tracking-widest ml-1 mb-2 block">Email</label>
                <input type="email" name="email" required placeholder="admin@mail.com" value="{{ old('email') }}">
                @error('email') <p class="text-red-400 text-[9px] mt-2 ml-1 font-bold">{{ $message }}</p> @enderror
            </div>

            <div class="input-group">
                <div class="flex justify-between items-center mb-2">
                    <label class="text-[9px] font-black text-slate-400 uppercase tracking-widest ml-1">Password</label>
                    <a href="{{ route('password.request') }}" class="text-[8px] font-bold text-cyan-500/60 hover:text-cyan-400 uppercase tracking-widest transition-colors">
                        Lost Access?
                    </a>
                </div>
                <input type="password" name="password" required placeholder="••••••••">
            </div>

            <button type="submit" class="btn-submit">
                Login
            </button>
        </form>

        <div class="mt-8 text-center">
            <a href="{{ route('home') }}" class="text-[9px] font-bold text-slate-600 hover:text-white transition-all uppercase tracking-widest">
                &larr; Back to Home
            </a>
        </div>
    </div>
</div>

{{-- Font Awesome --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
@endsection

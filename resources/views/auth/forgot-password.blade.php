@extends('layouts.app')

@section('content')
<style>
    .login-viewport { height: 100vh; overflow: hidden; background-color: #020408; display: flex; align-items: center; justify-content: center; position: relative; }
    .bg-grid { position: absolute; inset: 0; background-image: radial-gradient(circle at 2px 2px, rgba(34, 211, 238, 0.05) 1px, transparent 0); background-size: 40px 40px; pointer-events: none; z-index: 1; }
    .login-card { width: 100%; max-width: 400px; background: rgba(15, 23, 42, 0.8); backdrop-filter: blur(20px); border: 1px solid rgba(255, 255, 255, 0.05); border-radius: 2.5rem; padding: 2.5rem; position: relative; z-index: 10; }
    .input-group input { width: 100%; background: rgba(5, 8, 16, 0.8); border: 1px solid rgba(255, 255, 255, 0.1); border-radius: 1.25rem; padding: 1rem 1.5rem; color: white; outline: none; transition: all 0.3s; }
    .input-group input:focus { border-color: #22d3ee; box-shadow: 0 0 15px rgba(34, 211, 238, 0.1); }
    .btn-submit { width: 100%; background: #ffffff; color: #000; font-weight: 900; padding: 1.25rem; border-radius: 1.25rem; text-transform: uppercase; letter-spacing: 0.1em; transition: all 0.3s; cursor: pointer; border: none; }
    .btn-submit:hover { background: #22d3ee; transform: translateY(-2px); box-shadow: 0 10px 20px rgba(34, 211, 238, 0.2); }
</style>

<div class="login-viewport">
    <div class="bg-grid"></div>
    <div class="login-card">
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-14 h-14 rounded-2xl bg-cyan-500/10 border border-cyan-500/20 mb-4">
                <i class="fas fa-user-shield text-cyan-400 text-xl"></i>
            </div>
            <h1 class="text-xl font-black text-white uppercase tracking-tighter">Recovery Access</h1>
            <p class="text-[9px] text-slate-500 font-bold uppercase tracking-[0.4em]">Email Verification</p>
        </div>

        @if(session('status'))
            <div class="mb-6 p-4 rounded-2xl bg-cyan-500/10 border border-cyan-500/20 text-center">
                <p class="text-cyan-400 text-[10px] font-bold uppercase">{{ session('status') }}</p>
            </div>
        @endif

        <form action="{{ route('password.email') }}" method="POST" class="space-y-6">
            @csrf
            <div class="input-group">
                <label class="text-[9px] font-black text-slate-500 uppercase tracking-widest mb-2 block ml-1">Registered Email</label>
                <input type="email" name="email" required placeholder="mail@example.com">
                @error('email') <p class="text-red-500 text-[9px] mt-2 ml-1 uppercase">{{ $message }}</p> @enderror
            </div>

            <button type="submit" class="btn-submit">Reset Access</button>
        </form>

        <div class="mt-8 text-center">
            <a href="{{ route('login') }}" class="text-[9px] font-bold text-slate-600 hover:text-cyan-400 transition-all uppercase tracking-widest">
                Return to Login
            </a>
        </div>
    </div>
</div>
@endsection

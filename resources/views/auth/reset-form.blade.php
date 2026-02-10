{{-- Gunakan style yang sama dengan forgot-password di atas --}}
<div class="login-viewport">
    <div class="bg-grid"></div>
    <div class="login-card">
        <h1 class="text-xl font-black text-white uppercase tracking-tighter mb-8 text-center">Set New Access Key</h1>

        <form action="{{ route('password.update') }}" method="POST" class="space-y-4">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">

            <div class="input-group">
                <label class="text-[9px] font-black text-slate-500 uppercase tracking-widest ml-1 mb-2 block">Confirm Identity (Email)</label>
                <input type="email" name="email" required placeholder="name@protocol.com">
            </div>

            <div class="input-group">
                <label class="text-[9px] font-black text-slate-500 uppercase tracking-widest ml-1 mb-2 block">New Password</label>
                <input type="password" name="password" required placeholder="••••••••">
            </div>

            <div class="input-group">
                <label class="text-[9px] font-black text-slate-500 uppercase tracking-widest ml-1 mb-2 block">Re-type New Password</label>
                <input type="password" name="password_confirmation" required placeholder="••••••••">
            </div>

            <button type="submit" class="btn-submit mt-4">Override Access Key</button>
        </form>
    </div>
</div>

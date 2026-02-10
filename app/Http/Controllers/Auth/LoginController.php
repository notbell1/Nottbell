<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller {

    public function showLoginForm() {
        return view('auth.login');
    }

    public function login(Request $request) {
        // 1. Cek Honeypot (Jika diisi bot, langsung kasih pesan sarkas)
        if ($request->filled('honeypot')) {
            return back()->withErrors(['security' => "Detected a bot. Go play with some magnets, silicon-breath."]);
        }

        // 2. Deteksi Pola Serangan (SQLi, XSS, Path Traversal)
        $dangerous_patterns = [
            'union select', 'drop table', 'insert into', '--', '1=1', 'or 1',
            '<script>', 'javascript:', 'alert(', '../', 'etc/passwd'
        ];

        $payload = strtolower(json_encode($request->all()));
        foreach ($dangerous_patterns as $pattern) {
            if (str_contains($payload, $pattern)) {
                Log::alert("Intrusion attempt detected from IP: " . $request->ip());
                return back()->withErrors([
                    'security' => "Nice try, 'hacker'. My grandma's cat has better injection skills than you. Access denied."
                ]);
            }
        }

        // 3. Validasi Standar
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // 4. Proses Authentikasi
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('admin.dashboard');
        }

        // 5. Gagal Login (Sarkas Halus)
        return back()->withErrors([
            'email' => "Credentials don't match our records. Stop guessing, it's embarrassing."
        ])->withInput($request->only('email'));
    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home');
    }
}

<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class ForgotPasswordController extends Controller
{
    public function showLinkRequestForm() {
        return view('auth.forgot-password');
    }

    public function sendResetLink(Request $request) {
        $request->validate(['email' => 'required|email|exists:users,email']);

        $token = Str::random(64);

        // Simpan token ke database
        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $request->email],
            ['token' => $token, 'created_at' => now()]
        );

        // Kirim Email (Pastikan view 'emails.reset' sudah ada)
        Mail::send('emails.reset', ['token' => $token, 'email' => $request->email], function($message) use($request){
            $message->to($request->email);
            $message->subject('Access Recovery Protocol - Reset Password');
        });

        return back()->with('status', 'Recovery link has been send to your Email');
    }

    public function showResetForm($token) {
        return view('auth.reset-form', ['token' => $token]);
    }

    public function resetPassword(Request $request) {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:8|confirmed',
            'token' => 'required'
        ]);

        $record = DB::table('password_reset_tokens')
                    ->where(['email' => $request->email, 'token' => $request->token])
                    ->first();

        if (!$record) return back()->withErrors(['email' => 'Invalid or expired token.']);

        User::where('email', $request->email)->update([
            'password' => Hash::make($request->password)
        ]);

        DB::table('password_reset_tokens')->where(['email' => $request->email])->delete();

        return redirect()->route('login')->with('status', 'Email access restored. You can login now.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function send(Request $request)
    {
        // 1. Rate Limiting (2x per 24 jam)
        $key = 'send-contact:' . $request->ip();
        if (RateLimiter::tooManyAttempts($key, 3)) {
            $seconds = RateLimiter::availableIn($key);
            $hours = ceil($seconds / 3600);
            return response()->json([
                'status' => 'spam',
                'message' => "Limit tercapai! Silakan coba lagi dalam $hours jam."
            ], 429);
        }

        // 2. Validasi
        $validator = Validator::make($request->all(), [
            'name'    => 'required|string|max:100',
            'email'   => 'required|email|max:100',
            'subject' => 'required|string|max:150',
            'message' => 'required|string|min:10',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data tidak valid. Mohon periksa kembali inputan Anda.'
            ], 422);
        }

        try {
            // 3. Kirim Email
            // Pastikan email penerima sudah benar
            Mail::to('abbelkadafi@gmail.com')->send(new ContactMail($request->all()));

            // 4. Catat Attempt jika berhasil
            RateLimiter::hit($key, 86400);

            return response()->json([
                'status' => 'success',
                'message' => 'Pesan terkirim! Terima kasih telah menghubungi saya.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal mengirim pesan. Silakan coba lagi nanti.'
            ], 500);
        }
    }
}
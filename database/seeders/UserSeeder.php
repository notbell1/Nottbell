<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Membuat User Admin tunggal untuk akses Portfolio
        User::updateOrCreate(
            ['email' => 'zxmarchia@gmail.com'], // Cek berdasarkan email agar tidak duplikat
            [
                'name' => 'Nottbell',
                'password' => Hash::make('12345678'),
                'email_verified_at' => now(),
            ]
        );

        $this->command->info('User Admin berhasil dibuat. Silakan login melalui pintu rahasia.');
    }
}

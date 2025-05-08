<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Profile;
use App\Models\Admin;

class AdminSeeder extends Seeder
{
    public function run()
    {
        // Buat data profile untuk admin
        $profile = Profile::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'nik' => '1234567890', // Sesuaikan dengan format NIK yang diinginkan
            'password' => Hash::make('admin1'), // Password admin
            'no_telp' => '08123456789', // Sesuaikan dengan nomor telepon
        ]);

        // Buat data admin yang berhubungan dengan profile
        Admin::create([
            'profile_id' => $profile->profile_id, // Relasi dengan profile
        ]);
    }
}

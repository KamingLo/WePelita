<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Profile;
use App\Models\Guru;
use App\Models\Admin;
use App\Models\OrangTua;
use App\Models\Murid;
use App\Models\Jurusan;
use App\Models\Kelas;
use App\Models\Absensi;
use App\Models\Pelajaran;
use App\Models\Nilai;
use App\Models\JadwalPelajaran;
use App\Models\Pengumuman;
use App\Models\Kegiatan;

class AllSeeder extends Seeder
{
    public function run()
    {
        // Seeder untuk Jurusan
        Jurusan::factory()->count(2)->create();
    
        // Seeder untuk Kelas
        Kelas::factory()->count(2)->create();
    
        // Seeder untuk Profile
        $profiles = Profile::factory()->count(10)->create();
    
        // Seeder untuk Guru, Admin, Orang Tua, Murid
        $profiles->each(function ($profile) {
            $profile->guru()->create();
            $profile->admin()->create();
            $profile->orangTua()->create();
            $profile->murid()->create([
                'kelas_id' => Kelas::first()->id,
                'orang_tua_id' => OrangTua::first()->id,
                'nis' => '12345',
                'nisn' => '54321',
                'Status' => 'Aktif'
            ]);
        });
    
        // Seeder untuk Absensi
        Absensi::factory()->count(10)->create();
    
        // Seeder untuk Pelajaran
        Pelajaran::factory()->count(5)->create();
    
        // Seeder untuk Nilai
        Nilai::factory()->count(10)->create();
    
        // Seeder untuk Jadwal Pelajaran
        JadwalPelajaran::factory()->count(5)->create();
    
        // Seeder untuk Pengumuman
        Pengumuman::factory()->count(3)->create();
    
        // Seeder untuk Kegiatan
        Kegiatan::factory()->count(3)->create();
    }
    
}
?>
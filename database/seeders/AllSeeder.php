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

class AllSeeder extends Seeder
{
    public function run()
    {
        
        // Seeder untuk Jurusan
        Jurusan::factory()->count(2)->create(); // Menambahkan 2 jurusan
        
        // Seeder untuk Kelas
        Kelas::factory()->count(2)->create(); // Menambahkan 2 kelas
        // Seeder untuk Profile
        $profiles = Profile::factory()->count(10)->create(); // Menghasilkan 10 profile

        // Seeder untuk Guru
        $profiles->each(function ($profile) {
            $profile->guru()->create();
        });

        // Seeder untuk Admin
        $profiles->each(function ($profile) {
            $profile->admin()->create();
        });

        // Seeder untuk OrangTua
        $profiles->each(function ($profile) {
            $profile->orangTua()->create();
        });

        // Seeder untuk Murid
        $kelas = Kelas::first();  // Mengambil kelas pertama yang ada
        $orangTua = OrangTua::first();  // Mengambil orang tua pertama yang ada
       
        $profiles->each(function ($profile) use ($kelas, $orangTua) {
            $profile->murid()->create([
                'kelas_id' => $kelas->kelas_id,
                'orang_tua_id' => $orangTua->orang_tua_id,
                'nis' => '12345',
                'nisn' => '54321',
                'Status' => 'Aktif'
            ]);
        });
    }
}

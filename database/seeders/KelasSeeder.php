<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kelas;

class KelasSeeder extends Seeder
{
    public function run(): void
    {   
        //Gunakan ini setiap tahun ajaran baru
        $tahunAjaran = '2025/2026'; // Ganti sesuai tahun baru

        if (Kelas::where('tahun_ajaran', $tahunAjaran)->exists()) {
            $this->command->info("Kelas tahun ajaran $tahunAjaran sudah tersedia.");
            return;
        }

        $kelasBaru = [
            ['nama_kelas' => 'X AK', 'tahun_ajaran' => $tahunAjaran],
            ['nama_kelas' => 'X AP', 'tahun_ajaran' => $tahunAjaran],
            ['nama_kelas' => 'X MM 1', 'tahun_ajaran' => $tahunAjaran],
            ['nama_kelas' => 'X MM 2', 'tahun_ajaran' => $tahunAjaran],
            ['nama_kelas' => 'XI AK', 'tahun_ajaran' => $tahunAjaran],
            ['nama_kelas' => 'XI AP', 'tahun_ajaran' => $tahunAjaran],
            ['nama_kelas' => 'XI MM 1', 'tahun_ajaran' => $tahunAjaran],
            ['nama_kelas' => 'XI MM 2', 'tahun_ajaran' => $tahunAjaran],
            ['nama_kelas' => 'XII AK', 'tahun_ajaran' => $tahunAjaran],
            ['nama_kelas' => 'XII AP', 'tahun_ajaran' => $tahunAjaran],
            ['nama_kelas' => 'XII MM 1', 'tahun_ajaran' => $tahunAjaran],
            ['nama_kelas' => 'XII MM 2', 'tahun_ajaran' => $tahunAjaran],
            ['nama_kelas' => 'Alumni', 'tahun_ajaran' => 'Selamanya'],
        ];

        Kelas::insert($kelasBaru);
        $this->command->info("Berhasil menambahkan kelas untuk tahun ajaran $tahunAjaran.");
    }
}

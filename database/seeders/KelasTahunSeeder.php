<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kelas;
use App\Models\TahunAjar;

class KelasTahunSeeder extends Seeder
{
    public function run(): void
    {
        $kelasList = Kelas::all();
        $tahunAjaranList = TahunAjar::all();

        foreach ($kelasList as $kelas) {
            $randomTahunRaw = $tahunAjaranList->random(rand(1, 2));

            $randomTahun = $randomTahunRaw instanceof \Illuminate\Support\Collection
                ? $randomTahunRaw->pluck('tahun_ajaran_id')->toArray()  // pakai 'tahun_ajaran_id'
                : [$randomTahunRaw->tahun_ajaran_id];

            $kelas->tahun()->syncWithoutDetaching($randomTahun);
        }
    }
}

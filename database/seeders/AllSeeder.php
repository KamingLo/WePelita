<?php 
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Profile;
use App\Models\Guru;
use App\Models\Admin;
use App\Models\OrangTua;
use App\Models\Murid;
use App\Models\Kelas;

class AllSeeder extends Seeder
{
    public function run()
    {
        $this->call(KelasSeeder::class);
        $this->call(AdminSeeder::class);
    }
}

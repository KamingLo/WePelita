<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Guru;

class GuruSeeder extends Seeder
{
    public function run(): void
    {
        // Buat 15 guru beserta profile baru otomatis per guru
        Guru::factory()->count(15)->create();
    }
}

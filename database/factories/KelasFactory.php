<?php

namespace Database\Factories;

use App\Models\Kelas;
use App\Models\Jurusan;
use Illuminate\Database\Eloquent\Factories\Factory;

class KelasFactory extends Factory
{
    protected $model = Kelas::class;

    public function definition(): array
    {
        return [
            'jurusan_id' => Jurusan::factory(),
            'nama_kelas' => $this->faker->randomElement(['X-A', 'XI-B', 'XII-C']),
            'tahun_ajaran' => $this->faker->year . '/' . ($this->faker->year + 1),
        ];
    }
}


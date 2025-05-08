<?php

namespace Database\Factories;

use App\Models\Jurusan;
use Illuminate\Database\Eloquent\Factories\Factory;

class JurusanFactory extends Factory
{
    protected $model = Jurusan::class;

    public function definition(): array
    {
        return [
            'nama_jurusan' => $this->faker->randomElement(['IPA', 'IPS', 'TKJ', 'RPL', 'AKL']),
        ];
    }
}

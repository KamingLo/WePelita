<?php

namespace Database\Factories;

use App\Models\Profile;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProfileFactory extends Factory
{
    protected $model = Profile::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'nik' => $this->faker->numerify('############'), // 12 angka
            'password' => bcrypt('password'), // bisa diganti dengan hash yang lebih aman
            'no_telp' => $this->faker->phoneNumber(),
        ];
    }
}

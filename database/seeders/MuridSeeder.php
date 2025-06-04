<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Profile;
use App\Models\Murid;
use App\Models\MuridKelas;
use App\Models\KelasTahun;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Hash;

class MuridSeeder extends Seeder
{
    public function run()
    {
        $kelasTahuns = KelasTahun::all()->pluck('kelas_tahun_id')->toArray();

        // Check if kelas_tahun table is populated
        if (empty($kelasTahuns)) {
            throw new \Exception('No KelasTahun records found. Run KelasTahunSeeder first.');
        }

        // Create specific student profile
        $specificProfile = Profile::where('email', 'murid@example.com')->first();
        if (!$specificProfile) {
            $specificProfile = Profile::create([
                'name' => 'Murid Example',
                'email' => 'murid@example.com',
                'password' => Hash::make('murid123'),
                'alamat' => 'Jl. Contoh No. 123, Jakarta',
                'jenis_kelamin' => 'Laki-laki',
                'tanggal_lahir' => '2008-01-01',
                'tempat_lahir' => 'Jakarta',
                'pendidikan' => 'SD',
                'no_telp' => '08123456789',
            ]);
        }

        // Create Murid record for specific profile
        $specificMurid = Murid::where('profile_id', $specificProfile->profile_id)->first();
        if (!$specificMurid) {
            $specificMurid = Murid::create([
                'profile_id' => $specificProfile->profile_id,
                'nis' => '1234567890',
                'nisn' => '9876543210',
                'asal_sekolah' => 'SD Negeri Jakarta',
            ]);

            // Create murid_kelas record
            MuridKelas::create([
                'murid_id' => $specificMurid->murid_id,
                'kelas_tahun_id' => $kelasTahuns[array_rand($kelasTahuns)],
            ]);
        }

        $faker = Faker::create('id_ID');

        // Create 5 additional students
        for ($i = 0; $i < 5; $i++) {
            $email = $faker->unique()->safeEmail;
            $profile = Profile::where('email', $email)->first();
            if (!$profile) {
                $profile = Profile::create([
                    'name' => $faker->name,
                    'email' => $email,
                    'password' => Hash::make('password'),
                    'alamat' => $faker->address,
                    'jenis_kelamin' => $faker->randomElement(['Laki-laki', 'Perempuan']),
                    'tanggal_lahir' => $faker->dateTimeBetween('-18 years', '-12 years')->format('Y-m-d'),
                    'tempat_lahir' => $faker->city,
                    'pendidikan' => $faker->randomElement(['SD', 'SMP', 'SMA', 'S1']),
                    'no_telp' => $faker->phoneNumber,
                ]);
            }

            $murid = Murid::where('profile_id', $profile->profile_id)->first();
            if (!$murid) {
                $kelasTahunId = $kelasTahuns[array_rand($kelasTahuns)];
                $murid = Murid::create([
                    'profile_id' => $profile->profile_id,
                    'nis' => $faker->unique()->numerify('##########'),
                    'nisn' => $faker->unique()->numerify('##########'),
                    'asal_sekolah' => $faker->company . ' School',
                ]);

                // Create murid_kelas record
                MuridKelas::create([
                    'murid_id' => $murid->murid_id,
                    'kelas_tahun_id' => $kelasTahunId,
                ]);
            }
        }
    }
}
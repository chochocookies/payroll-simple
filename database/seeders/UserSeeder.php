<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        $jabatanList = [
            'chief',
            'store_senior',
            'store_junior',
            'store_crew_boy',
            'store_crew_girl'
        ];

        foreach (range(1, 10) as $index) {
            User::create([
                'nik' => $faker->unique()->numerify('##########'), // 10 digit angka unik
                'name' => $faker->name,
                'jabatan' => $faker->randomElement($jabatanList),
                'gaji_pokok' => $faker->numberBetween(3000000, 10000000), // Gaji pokok random 3jt - 10jt
                'email' => $faker->unique()->safeEmail,
                'password' => Hash::make('password'), // default password
            ]);
        }
    }
}

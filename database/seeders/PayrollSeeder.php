<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Payroll;
use App\Models\User;
use Carbon\Carbon;
use Faker\Factory as Faker;

class PayrollSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();
        $users = User::all();
        $periode = Carbon::now()->format('Y-m'); // contoh: '2025-04'

        foreach ($users as $user) {
            $tunjangan_transport = $faker->numberBetween(100000, 500000);
            $tunjangan_lain = $faker->numberBetween(100000, 500000);
            $lembur = $faker->numberBetween(50000, 300000);
            $potongan_absensi = $faker->numberBetween(50000, 200000);
            $potongan_telat = $faker->numberBetween(20000, 100000);

            $total_gaji = $user->gaji_pokok
                        + $tunjangan_transport
                        + $tunjangan_lain
                        + $lembur
                        - $potongan_absensi
                        - $potongan_telat;

            Payroll::create([
                'user_id' => $user->id,
                'periode' => $periode,
                'tunjangan_transport' => $tunjangan_transport,
                'tunjangan_lain' => $tunjangan_lain,
                'lembur' => $lembur,
                'potongan_absensi' => $potongan_absensi,
                'potongan_telat' => $potongan_telat,
                'total_gaji' => $total_gaji,
            ]);
        }
    }
}

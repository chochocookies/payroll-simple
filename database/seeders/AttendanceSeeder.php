<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Attendance;
use App\Models\User;
use Carbon\Carbon;

class AttendanceSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();
        $today = Carbon::today();

        foreach ($users as $user) {
            foreach (range(1, 30) as $i) {
                $date = $today->copy()->subDays($i);

                Attendance::create([
                    'user_id' => $user->id,
                    'date' => $date,
                    'present' => rand(0, 1),
                    'late' => rand(0, 1),
                ]);
            }
        }
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payroll extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'periode',
        'tunjangan_transport',
        'tunjangan_lain',
        'lembur',
        'potongan_absensi',
        'potongan_telat',
        'total_gaji',
    ];
}

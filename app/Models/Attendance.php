<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'date',
        'worked_hours', // Jam kerja yang telah dikerjakan
        'late', // Apakah telat
        'present', // Apakah hadir
    ];
}

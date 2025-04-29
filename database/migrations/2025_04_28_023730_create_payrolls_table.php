<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payrolls', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('periode');
            $table->integer('tunjangan_transport')->nullable()->default(0);
            $table->integer('tunjangan_lain')->nullable()->default(0);
            $table->integer('lembur')->nullable()->default(0);
            $table->integer('potongan_absensi')->nullable()->default(0);
            $table->integer('potongan_telat')->nullable()->default(0);
            $table->integer('total_gaji')->nullable()->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payrolls');
    }
};

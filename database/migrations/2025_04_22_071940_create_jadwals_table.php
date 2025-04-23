<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJadwalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jadwals', function (Blueprint $table) {
            $table->id();  // ID jadwal seleksi
            $table->string('nama_ujian');  // Nama ujian/seleksi
            $table->date('tanggal_ujian');  // Tanggal ujian/seleksi
            $table->time('waktu_mulai');  // Waktu mulai seleksi
            $table->time('waktu_selesai');  // Waktu selesai seleksi
            $table->timestamps();  // Timestamps (created_at, updated_at)
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jadwals');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePendaftarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pendaftars', function (Blueprint $table) {
            $table->id();  // ID pendaftar
            $table->string('nama_lengkap');  // Nama lengkap pendaftar
            $table->date('tanggal_lahir');  // Tanggal lahir
            $table->enum('posisi', ['Penyerang', 'Gelandang', 'Bek', 'Kiper']);  // Posisi yang diinginkan
            $table->string('kontak', 15);  // Kontak pendaftar (misal: nomor telepon) dibatasi 15 karakter
            $table->text('alamat');  // Alamat pendaftar
            $table->enum('status', ['Menunggu', 'Lolos', 'Tidak Lolos']);  // Status seleksi tanpa nilai default
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
        Schema::dropIfExists('pendaftars');
    }
}

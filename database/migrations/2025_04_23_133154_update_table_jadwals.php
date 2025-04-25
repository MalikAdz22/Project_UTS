<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('jadwals', function (Blueprint $table) {
            // Ubah nama kolom
            $table->renameColumn('nama_ujian', 'nama_seleksi');
            $table->renameColumn('tanggal_ujian', 'tanggal_seleksi');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('jadwals', function (Blueprint $table) {
            // Revert perubahan (untuk rollback)
            $table->renameColumn('nama_seleksi', 'nama_ujian');
            $table->renameColumn('tanggal_seleksi', 'tanggal_ujian');
        });
    }
};

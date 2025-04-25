<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;

    // Tentukan kolom-kolom yang boleh diisi
    protected $fillable = [
        'tes_seleksi',
        'tanggal_seleksi',
        'waktu_mulai',
        'waktu_selesai',
    ];

    // Menentukan tipe data untuk kolom
    protected $casts = [
        'tanggal_seleksi' => 'date', // Tanggal menjadi objek Date
        'waktu_mulai' => 'datetime',     // Waktu menjadi objek Time
        'waktu_selesai' => 'datetime',   // Waktu menjadi objek Time
    ];

}

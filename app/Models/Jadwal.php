<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;

    // Tentukan kolom-kolom yang boleh diisi
    protected $fillable = [
        'nama_seleksi',
        'tanggal_seleksi',
        'waktu_mulai',
        'waktu_selesai',
    ];

    // Menentukan tipe data untuk kolom
    protected $casts = [
        'tanggal_seleksi' => 'date', // Tanggal menjadi objek Date
        'waktu_mulai' => 'time',     // Waktu menjadi objek Time
        'waktu_selesai' => 'time',   // Waktu menjadi objek Time
    ];

    // Jika diperlukan, Anda bisa menambahkan aksesori (accessors) atau mutator untuk memformat output
}

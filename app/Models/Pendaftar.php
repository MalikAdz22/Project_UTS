<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendaftar extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_lengkap',
        'tanggal_lahir',
        'posisi',
        'kontak',
        'alamat',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date', // Casting tanggal_lahir menjadi format tanggal
    ];

    // Getter untuk nama_lengkap agar ditampilkan dengan format capitalized
    public function getNamaLengkapAttribute($value)
    {
        return ucwords(strtolower($value));
    }
}

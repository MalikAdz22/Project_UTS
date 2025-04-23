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
        'status', // Pastikan status ada di sini
    ];

    protected $casts = [
        'tanggal_lahir' => 'date', // Casting tanggal_lahir menjadi format tanggal
    ];

    // Getter untuk nama_lengkap agar ditampilkan dengan format capitalized
    public function getNamaLengkapAttribute($value)
    {
        return ucwords(strtolower($value));
    }

    // Validasi status untuk memastikan hanya nilai yang valid yang disimpan
    public static function validStatuses()
    {
        return ['Menunggu', 'Diterima', 'Ditolak'];
    }

    // Menambahkan fungsi untuk validasi status secara manual, jika diperlukan
    public function setStatusAttribute($value)
    {
        if (!in_array($value, self::validStatuses())) {
            // Jika status tidak valid, kita set default ke "Menunggu"
            $this->attributes['status'] = 'Menunggu';
        } else {
            $this->attributes['status'] = $value;
        }
    }
}

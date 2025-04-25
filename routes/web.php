<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PendaftarController;
use App\Http\Controllers\JadwalController;

// Halaman awal / dashboard
Route::get('/', function () {
    return view('dashboard');
})->name('dashboard');

// === Routing untuk Pendaftar ===
Route::prefix('pendaftars')->name('pendaftars.')->group(function () {
    Route::get('/', [PendaftarController::class, 'index'])->name('index');           // Menampilkan halaman utama daftar pendaftar (view dengan tabel)
    Route::get('/data', [PendaftarController::class, 'data'])->name('data');         // Endpoint API untuk DataTables (mengembalikan data JSON)
    Route::get('/create', [PendaftarController::class, 'create'])->name('create');   // Menampilkan form tambah pendaftar
    Route::post('/', [PendaftarController::class, 'store'])->name('store');          // Menyimpan data pendaftar baru (dari form create)
    Route::get('/{id}/edit', [PendaftarController::class, 'edit'])->name('edit');    // Menampilkan form edit pendaftar
    Route::put('/{id}', [PendaftarController::class, 'update'])->name('update');     // Memperbarui data pendaftar (dari form edit)
    Route::delete('/{id}', [PendaftarController::class, 'destroy'])->name('destroy');  // Menghapus data pendaftar
});

// === Routing untuk Jadwal ===
Route::prefix('jadwals')->name('jadwals.')->group(function () {
    Route::get('/', [JadwalController::class, 'index'])->name('index');
    Route::get('/create', [JadwalController::class, 'create'])->name('create');
    Route::post('/', [JadwalController::class, 'store'])->name('store');
    Route::get('/{id}/edit', [JadwalController::class, 'edit'])->name('edit');
    Route::put('/{id}', [JadwalController::class, 'update'])->name('update');
    Route::delete('/{id}', [JadwalController::class, 'destroy'])->name('destroy');
});

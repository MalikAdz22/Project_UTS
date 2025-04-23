<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PendaftarController;
use App\Http\Controllers\JadwalController;

// Halaman awal / dashboard
Route::get('/', function () {
    return view('dashboard'); // ganti ke 'dashboard' kalau kamu sudah punya dashboard.blade.php
})->name('dashboard');

// === Routing untuk Pendaftar ===
Route::prefix('pendaftars')->name('pendaftars.')->group(function () {
    Route::get('/', [PendaftarController::class, 'index'])->name('index');           // Tabel view
    Route::get('/data', [PendaftarController::class, 'data'])->name('data');         // Untuk DataTables (AJAX)
    Route::get('/create', [PendaftarController::class, 'create'])->name('create');   // Form tambah
    Route::post('/', [PendaftarController::class, 'store'])->name('store');          // Simpan data baru
    Route::get('/{id}/edit', [PendaftarController::class, 'edit'])->name('edit');    // Form edit
    Route::put('/{id}', [PendaftarController::class, 'update'])->name('update');     // Update data
    Route::delete('/{id}', [PendaftarController::class, 'destroy'])->name('destroy');// Hapus data
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

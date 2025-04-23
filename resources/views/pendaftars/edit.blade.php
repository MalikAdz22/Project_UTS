{{-- resources/views/pendaftars/edit.blade.php --}}
@extends('layouts.app')

@section('title', 'Edit Data Pendaftar')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header">
        <h6 class="m-0 font-weight-bold text-primary">Edit Data Pendaftar</h6>
    </div>
    <div class="card-body">
        <form action="{{ route('pendaftars.update', $pendaftar->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="nama_lengkap">Nama Lengkap</label>
                <input type="text" id="nama_lengkap" name="nama_lengkap"
                       class="form-control @error('nama_lengkap') is-invalid @enderror"
                       value="{{ old('nama_lengkap', $pendaftar->nama_lengkap) }}" required>
                @error('nama_lengkap') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label for="kontak">Kontak</label>
                <input type="text" id="kontak" name="kontak"
                       class="form-control @error('kontak') is-invalid @enderror"
                       value="{{ old('kontak', $pendaftar->kontak) }}" required>
                @error('kontak') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label for="tanggal_lahir">Tanggal Lahir</label>
                <input type="date" id="tanggal_lahir" name="tanggal_lahir"
                       class="form-control @error('tanggal_lahir') is-invalid @enderror"
                       value="{{ old('tanggal_lahir', \Carbon\Carbon::parse($pendaftar->tanggal_lahir)->format('Y-m-d')) }}" required>
                @error('tanggal_lahir') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label for="alamat">Alamat</label>
                <textarea id="alamat" name="alamat"
                          class="form-control @error('alamat') is-invalid @enderror"
                          required>{{ old('alamat', $pendaftar->alamat) }}</textarea>
                @error('alamat') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label for="posisi">Posisi</label>
                <input type="text" id="posisi" name="posisi"
                       class="form-control @error('posisi') is-invalid @enderror"
                       value="{{ old('posisi', $pendaftar->posisi) }}" required>
                @error('posisi') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('pendaftars.index') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-success">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>
@endsection

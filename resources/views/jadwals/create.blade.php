@extends('layouts.app')

@section('title', 'Tambah Jadwal Seleksi')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Tambah Jadwal Seleksi</h6>
    </div>
    <div class="card-body">
        <!-- Tampilkan pesan sukses jika ada -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('jadwals.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="tes_seleksi">Tes Seleksi</label>
                <select class="form-control @error('tes_seleksi') is-invalid @enderror" id="tes_seleksi" name="tes_seleksi" required>
                    <option value="">Pilih Tes Seleksi</option>
                    <option value="Tes Fisik" {{ old('tes_seleksi') == 'Tes Fisik' ? 'selected' : '' }}>Tes Fisik</option>
                    <option value="Teknik" {{ old('tes_seleksi') == 'Teknik' ? 'selected' : '' }}>Teknik</option>
                    <option value="Taktik & Mental" {{ old('tes_seleksi') == 'Taktik & Mental' ? 'selected' : '' }}>Taktik & Mental</option>
                    <option value="Pertandingan" {{ old('tes_seleksi') == 'Pertandingan' ? 'selected' : '' }}>Pertandingan</option>
                </select>
                @error('tes_seleksi') 
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="tanggal_seleksi">Tanggal Seleksi</label>
                <input type="date" class="form-control @error('tanggal_seleksi') is-invalid @enderror" id="tanggal_seleksi" name="tanggal_seleksi" value="{{ old('tanggal_seleksi') }}" required>
                @error('tanggal_seleksi') 
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="waktu_mulai">Waktu Mulai</label>
                <input type="time" class="form-control @error('waktu_mulai') is-invalid @enderror" id="waktu_mulai" name="waktu_mulai" value="{{ old('waktu_mulai') }}" required>
                @error('waktu_mulai') 
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="waktu_selesai">Waktu Selesai</label>
                <input type="time" class="form-control @error('waktu_selesai') is-invalid @enderror" id="waktu_selesai" name="waktu_selesai" value="{{ old('waktu_selesai') }}" required>
                @error('waktu_selesai') 
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
</div>
@endsection

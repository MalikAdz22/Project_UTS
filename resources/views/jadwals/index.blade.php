@extends('layouts.app')

@section('title', 'Daftar Jadwal Seleksi')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Daftar Jadwal Seleksi</h6>
    </div>
    <div class="card-body">
        <!-- Tampilkan pesan sukses jika ada -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        
        <!-- Tombol untuk tambah jadwal -->
        <a href="{{ route('jadwals.create') }}" class="btn btn-success mb-3">
            <i class="fas fa-calendar-plus"></i> Tambah Jadwal
        </a>

        <!-- Tabel Daftar Jadwal -->
        <table class="table table-hover table-striped" id="jadwalsTable" width="100%" cellspacing="0">
            <thead class="thead-dark">
                <tr>
                    <th>Nama Seleksi</th>
                    <th>Tanggal Seleksi</th>
                    <th>Waktu Mulai</th>
                    <th>Waktu Selesai</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($jadwals as $jadwal)
                    <tr>
                        <td>{{ $jadwal->nama_seleksi }}</td>
                        <td>{{ date('d-m-Y', strtotime($jadwal->tanggal_seleksi)) }}</td> <!-- Format tanggal -->
                        <td>{{ date('H:i', strtotime($jadwal->waktu_mulai)) }}</td> <!-- Format waktu mulai -->
                        <td>{{ date('H:i', strtotime($jadwal->waktu_selesai)) }}</td> <!-- Format waktu selesai -->
                        <td>
                            <a href="{{ route('jadwals.edit', $jadwal) }}" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <form action="{{ route('jadwals.destroy', $jadwal) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus jadwal ini?')">
                                    <i class="fas fa-trash-alt"></i> Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#jadwalsTable').DataTable({
            responsive: true, // Menambahkan dukungan responsif
            order: [[1, 'asc']], // Menyortir berdasarkan tanggal seleksi secara default
            language: {
                lengthMenu: "Tampilkan _MENU_ data per halaman",
                zeroRecords: "Tidak ada data yang ditemukan",
                info: "Menampilkan halaman _PAGE_ dari _PAGES_",
                infoEmpty: "Tidak ada data",
                infoFiltered: "(terfilter dari _MAX_ total data)"
            }
        });
    });
</script>
@endpush

@extends('layouts.app')

@section('title', 'Daftar Pendaftar Akademi Sepak Bola')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 text-gray-800">Data Pendaftar</h1>
    <button class="btn btn-success" data-toggle="modal" data-target="#addModal">
        <i class="fas fa-plus-circle"></i> Tambah Pendaftar
    </button>
</div>

<table id="pendaftarsTable" class="table table-hover table-striped">
    <thead class="thead-dark">
        <tr>
            <th>ID</th>
            <th>Nama Lengkap</th>
            <th>Tanggal Lahir</th>
            <th>Posisi</th>
            <th>Kontak</th>
            <th>Alamat</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody></tbody>
</table>

<!-- Modal Tambah Pendaftar -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModalLabel">Tambah Pendaftar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="addPendaftarForm">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama_lengkap">Nama Lengkap</label>
                        <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" required>
                    </div>
                    <div class="form-group">
                        <label for="tanggal_lahir">Tanggal Lahir</label>
                        <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" required>
                    </div>
                    <div class="form-group">
                        <label for="posisi">Posisi</label>
                        <select class="form-control" id="posisi" name="posisi" required>
                            <option value="Penyerang">Penyerang</option>
                            <option value="Gelandang">Gelandang</option>
                            <option value="Bek">Bek</option>
                            <option value="Kiper">Kiper</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="kontak">Kontak</label>
                        <input type="text" class="form-control" id="kontak" name="kontak" required>
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <textarea class="form-control" id="alamat" name="alamat" rows="3" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var table = $('#pendaftarsTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('pendaftars.data') }}",
        columns: [
            { data: 'id', name: 'id' },
            { data: 'nama_lengkap', name: 'nama_lengkap' },
            { data: 'tanggal_lahir', name: 'tanggal_lahir' },
            { data: 'posisi', name: 'posisi' },
            { data: 'kontak', name: 'kontak' },
            { data: 'alamat', name: 'alamat' },
            { data: 'action', name: 'action', orderable: false, searchable: false }
        ],
        responsive: true,
        language: {
            lengthMenu: "Tampilkan _MENU_ data per halaman",
            zeroRecords: "Tidak ada data yang ditemukan",
            info: "Menampilkan halaman _PAGE_ dari _PAGES_",
            infoEmpty: "Tidak ada data",
            infoFiltered: "(terfilter dari _MAX_ total data)"
        }
    });

    // Event listener untuk tombol Edit
    $(document).on('click', '.edit-btn', function() {
        var id = $(this).data('id');
        // Lakukan sesuatu dengan ID, seperti membuka modal dan mengisi form edit
        window.location.href = "/pendaftars/" + id + "/edit";
    });
    // Submit form tambah pendaftar
    $('#addPendaftarForm').submit(function(e) {
        e.preventDefault();

        $.ajax({
            url: "{{ route('pendaftars.store') }}",
            method: "POST",
            data: $(this).serialize(),
            success: function(response) {
                table.ajax.reload();
                $('#addModal').modal('hide');
                $('#addPendaftarForm')[0].reset();
                alert('Pendaftar berhasil ditambahkan!');
            },
            error: function(response) {
                alert('Terjadi kesalahan saat menyimpan.');
            }
        });
    });
    // Event listener untuk tombol Hapus dengan SweetAlert2
$(document).on('click', '.delete-btn', function() {
    var id = $(this).data('id');

    Swal.fire({
        title: 'Apakah Anda yakin?',
        text: "Data yang dihapus tidak bisa dikembalikan!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: "/pendaftars/" + id,
                method: 'DELETE',
                success: function(response) {
                    $('#pendaftarsTable').DataTable().ajax.reload();
                    Swal.fire(
                        'Dihapus!',
                        response.message,
                        'success'
                    );
                },
                error: function(response) {
                    Swal.fire(
                        'Gagal!',
                        'Terjadi kesalahan saat menghapus.',
                        'error'
                    );
                }
            });
        }
    });
});

});
</script>
@endpush

<?php

namespace App\Http\Controllers;

use App\Models\Pendaftar;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PendaftarController extends Controller
{
    // Menampilkan halaman utama data pendaftar
    public function index()
    {
        return view('pendaftars.index');
    }

    // Menyimpan data pendaftar baru dari form
    public function store(Request $request)
    {
        // Validasi input form
        $validatedData = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'posisi' => 'required|string',
            'kontak' => 'required|string|max:15',
            'alamat' => 'required|string',
        ]);

        // Simpan ke database
        Pendaftar::create($validatedData);

        // Beri respon sukses dalam format JSON
        return response()->json(['success' => true, 'message' => 'Pendaftar berhasil ditambahkan']);
    }

    // Menampilkan form edit berdasarkan ID pendaftar
    public function edit($id)
    {
        $pendaftar = Pendaftar::findOrFail($id); // Cari data atau gagal 404
        return view('pendaftars.edit', compact('pendaftar'));
    }

    // Memperbarui data pendaftar
    public function update(Request $request, $id)
    {
        // Cari data berdasarkan ID
        $pendaftar = Pendaftar::findOrFail($id);

        // Validasi data dari form
        $validatedData = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'posisi' => 'required|string',
            'kontak' => 'required|string|max:15',
            'alamat' => 'required|string',
        ]);

        // Update data
        $pendaftar->update($validatedData);

        // Redirect kembali dengan pesan sukses
        return redirect()->route('pendaftars.index')->with('success', 'Pendaftar berhasil diperbarui');
    }

    /*************  ✨ Windsurf Command ⭐  *************/
    /**
     * Hapus data pendaftar berdasarkan ID
     */
    public function destroy($id)
    {
        $pendaftar = Pendaftar::findOrFail($id); // Cari data
        $pendaftar->delete(); // Hapus data

        // Respon JSON untuk notifikasi AJAX
        return response()->json(['success' => true, 'message' => 'Pendaftar berhasil dihapus']);
    }

    // Mengambil data pendaftar untuk ditampilkan dalam DataTables
    public function data(Request $request)
    {
        // Ambil kolom yang dibutuhkan dari database
        $pendaftars = Pendaftar::select(['id', 'nama_lengkap', 'tanggal_lahir', 'posisi', 'kontak', 'alamat']);

        return DataTables::of($pendaftars)
            // Tambahkan kolom tombol aksi (Edit dan Hapus)
            ->addColumn('action', function ($pendaftar) {
                return '<button class="btn btn-warning btn-sm edit-btn" data-id="' . $pendaftar->id . '">Edit</button>
                        <button class="btn btn-danger btn-sm delete-btn" data-id="' . $pendaftar->id . '">Hapus</button>';
            })
            // Format kolom tanggal lahir menjadi d-m-Y
            ->editColumn('tanggal_lahir', function ($pendaftar) {
                return $pendaftar->tanggal_lahir->format('d-m-Y');
            })
            // Izinkan HTML dalam kolom action
            ->rawColumns(['action'])
            // Kembalikan sebagai JSON untuk DataTables
            ->make(true);
    }
}

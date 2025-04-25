<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    // Menampilkan daftar jadwal
    public function index()
    {
        // Mengambil semua data jadwal dengan paginasi untuk efisiensi
        $jadwals = Jadwal::paginate(10); // Menampilkan 10 data per halaman

        // Menampilkan view dengan data jadwal
        return view('jadwals.index', compact('jadwals'));
    }

    // Menampilkan form untuk menambah jadwal baru
    public function create()
    {
        // Daftar pilihan tes seleksi
        $tesSeleksiOptions = [
            'Tes Fisik',
            'Teknik',
            'Taktik & Mental',
            'Pertandingan'
        ];

        return view('jadwals.create', compact('tesSeleksiOptions')); // Menampilkan form create dengan pilihan tes seleksi
    }

    // Menyimpan data jadwal baru
    public function store(Request $request)
    {
        // Validasi data yang diterima dari form
        $request->validate([
            'tes_seleksi' => 'required|string|in:Tes Fisik,Teknik,Taktik & Mental,Pertandingan',
            'tanggal_seleksi' => 'required|date',
            'waktu_mulai' => 'required|date_format:H:i',
            'waktu_selesai' => 'required|date_format:H:i|after:waktu_mulai',
        ]);

        // Menyimpan data ke database
        Jadwal::create([
            'tes_seleksi' => $request->tes_seleksi,
            'tanggal_seleksi' => $request->tanggal_seleksi,
            'waktu_mulai' => $request->waktu_mulai,
            'waktu_selesai' => $request->waktu_selesai
        ]);

        // Redirect ke halaman daftar jadwal dengan pesan sukses
        return redirect()->route('jadwals.index')->with('success', 'Jadwal berhasil ditambahkan.');
    }

    // Menampilkan form untuk mengedit jadwal
    public function edit($id)
    {
        // Cari data jadwal berdasarkan ID
        $jadwal = Jadwal::findOrFail($id);

        // Daftar pilihan tes seleksi
        $tesSeleksiOptions = [
            'Tes Fisik',
            'Teknik',
            'Taktik & Mental',
            'Pertandingan'
        ];

        // Menampilkan form edit dengan data jadwal dan pilihan tes seleksi
        return view('jadwals.edit', compact('jadwal', 'tesSeleksiOptions'));
    }

    // Memperbarui data jadwal
    public function update(Request $request, $id)
    {
        // Validasi data yang diterima dari form
        $request->validate([
            'tes_seleksi' => 'required|string|in:Tes Fisik,Teknik,Taktik & Mental,Pertandingan',
            'tanggal_seleksi' => 'required|date',
            'waktu_mulai' => 'required|date_format:H:i',
            'waktu_selesai' => 'required|date_format:H:i|after:waktu_mulai',
        ]);

        // Cari data jadwal berdasarkan ID
        $jadwal = Jadwal::findOrFail($id);

        // Memperbarui data jadwal
        $jadwal->update([
            'tes_seleksi' => $request->tes_seleksi,
            'tanggal_seleksi' => $request->tanggal_seleksi,
            'waktu_mulai' => $request->waktu_mulai,
            'waktu_selesai' => $request->waktu_selesai
        ]);

        // Redirect ke halaman daftar jadwal dengan pesan sukses
        return redirect()->route('jadwals.index')->with('success', 'Jadwal berhasil diperbarui.');
    }

    // Menghapus jadwal
    public function destroy($id)
    {
        // Cari data jadwal berdasarkan ID
        $jadwal = Jadwal::findOrFail($id);

        // Menghapus data jadwal
        $jadwal->delete();

        // Redirect ke halaman daftar jadwal dengan pesan sukses
        return redirect()->route('jadwals.index')->with('success', 'Jadwal berhasil dihapus.');
    }

    // (Optional) Menambahkan fitur pencarian atau filter untuk jadwal
    public function search(Request $request)
    {
        $query = Jadwal::query();

        if ($request->filled('tes_seleksi')) {
            $query->where('tes_seleksi', 'like', '%' . $request->tes_seleksi . '%');
        }

        if ($request->filled('tanggal_seleksi')) {
            $query->whereDate('tanggal_seleksi', $request->tanggal_seleksi);
        }

        $jadwals = $query->paginate(10);

        return view('jadwals.index', compact('jadwals'));
    }
}

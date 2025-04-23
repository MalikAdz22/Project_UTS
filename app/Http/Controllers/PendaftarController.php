<?php

namespace App\Http\Controllers;

use App\Models\Pendaftar;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PendaftarController extends Controller
{
    public function index()
    {
        return view('pendaftars.index');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'posisi' => 'required|string',
            'kontak' => 'required|string|max:15',
            'alamat' => 'required|string',
        ]);

        Pendaftar::create($validatedData);

        return response()->json(['success' => true, 'message' => 'Pendaftar berhasil ditambahkan']);
    }

    public function edit($id)
{
    $pendaftar = Pendaftar::findOrFail($id);
    return view('pendaftars.edit', compact('pendaftar'));
}

public function update(Request $request, $id)
{
    // Mencari data pendaftar berdasarkan ID
    $pendaftar = Pendaftar::findOrFail($id);

    // Validasi data yang diterima dari form
    $validatedData = $request->validate([
        'nama_lengkap' => 'required|string|max:255',
        'tanggal_lahir' => 'required|date',
        'posisi' => 'required|string',
        'kontak' => 'required|string|max:15',
        'alamat' => 'required|string',
    ]);

    // Update data pendaftar di database
    $pendaftar->update($validatedData);

    // Redirect ke halaman daftar pendaftar dengan pesan sukses
    return redirect()->route('pendaftars.index')->with('success', 'Pendaftar berhasil diperbarui');
}


    public function destroy($id)
    {
        $pendaftar = Pendaftar::findOrFail($id);
        $pendaftar->delete();

        return response()->json(['success' => true, 'message' => 'Pendaftar berhasil dihapus']);
    }

    public function data(Request $request)
    {
        $pendaftars = Pendaftar::all();

        return DataTables::of($pendaftars)
            ->addColumn('action', function ($pendaftar) {
                return '<button class="btn btn-warning btn-sm edit-btn" data-id="' . $pendaftar->id . '">Edit</button>,
                        <button class="btn btn-danger btn-sm delete-btn" data-id="' . $pendaftar->id . '">Hapus</button>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}

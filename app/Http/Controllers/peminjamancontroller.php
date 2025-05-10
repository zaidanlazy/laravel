<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peminjaman;
use App\Models\User;
use App\Models\Buku;
use Exception;

class PeminjamanController extends Controller
{
    public function index()
    {
        $peminjamans = Peminjaman::with('buku')->paginate(5);
        return view('peminjaman.index')->with('peminjamans', $peminjamans);
    }

    public function create()
    {
        $users = User::all();
        $buku = Buku::all();
        return view('peminjaman.create', compact('users', 'buku'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'UserID' => 'required|exists:users,id',
            'BukuID' => 'required|exists:buku,BukuID',
            'TanggalPeminjaman' => 'required|date|before:9999-12-31|after:1000-01-01',
            'TanggalPengembalian' => 'nullable|date|before:9999-12-31|after:1000-01-01',
            'StatusPeminjaman' => 'required'
        ]);

        // Simpan data peminjaman ke database
        $peminjaman = new Peminjaman();
        $peminjaman->UserID = $request->UserID;
        $peminjaman->BukuID = $request->BukuID;
        $peminjaman->TanggalPeminjaman = $request->TanggalPeminjaman;
        $peminjaman->TanggalPengembalian = $request->TanggalPengembalian;
        $peminjaman->StatusPeminjaman = $request->StatusPeminjaman;
        $peminjaman->save();

        return redirect()->route('peminjaman.index')->with('success', 'Peminjaman berhasil ditambahkan!');
    }

    public function edit(string $id)
    {
        $peminjaman = Peminjaman::find($id);
        if (!$peminjaman) {
            return redirect()->back()->with('error', 'Peminjaman Tidak Ditemukan');
        }

        $users = User::all();
        $buku = Buku::all();
        return view('peminjaman.edit', ['peminjaman' => $peminjaman, 'users' => $users, 'buku' => $buku]);
    }

    public function update(Request $request, string $id)
    {
        // Validasi form input
        $validatedData = $request->validate([
            'UserID' => 'required|exists:users,id',  // Pastikan UserID valid
            'BukuID' => 'required|exists:buku,BukuID',   // Pastikan BukuID valid
            'TanggalPeminjaman' => 'required|date',
            'TanggalPengembalian' => 'nullable|date',
            'StatusPeminjaman' => 'required|string|max:50',
        ]);

        try {
            $peminjaman = Peminjaman::find($id);
            if (!$peminjaman) {
                return redirect()->back()->with('error', 'Peminjaman Tidak Ditemukan');
            }

            // Update data peminjaman
            $peminjaman->UserID = $validatedData['UserID'];
            $peminjaman->BukuID = $validatedData['BukuID'];
            $peminjaman->TanggalPeminjaman = $validatedData['TanggalPeminjaman'];
            $peminjaman->TanggalPengembalian = $validatedData['TanggalPengembalian'];
            $peminjaman->StatusPeminjaman = $validatedData['StatusPeminjaman'];
            $peminjaman->save();
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Data Gagal Disimpan: ' . $e->getMessage());
        }

        return redirect()->route('peminjaman.index')->with('success', 'Data Berhasil Disimpan');
    }

    public function destroy(string $id)
    {
        $peminjaman = Peminjaman::find($id);

        try {
            if (!$peminjaman) {
                return redirect()->back()->with('error', 'Peminjaman Tidak Ditemukan');
            }
            $peminjaman->delete();
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Peminjaman Gagal dihapus: ' . $e->getMessage());
        }

        return redirect()->back()->with('success', 'Peminjaman Berhasil dihapus');
    }
}
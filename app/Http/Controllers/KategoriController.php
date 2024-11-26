<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;

class KategoriController extends Controller
{
    // Metode untuk menampilkan daftar kategori
    public function index() {
    $kategoris = Kategori::paginate(10);
    return view('kategori.index', compact('kategoris'));
}

    // Metode untuk menyimpan kategori baru
    public function store(Request $request)
{
    // Validasi data
    $request->validate([
        'kategori_id' => 'required|unique:kategori,KategoriID', // pastikan KategoriID unik
        'nama_kategori' => 'required|string|max:255',
    ]);

    // Simpan data ke database
    Kategori::create([
        'KategoriID' => $request->kategori_id, // Menyimpan KategoriID dari form
        'NamaKategori' => $request->nama_kategori,
    ]);

    // Redirect kembali dengan pesan sukses
    return redirect()->route('kategori.index')->with('success', 'Kategori berhasil ditambahkan!');
}


    // Metode untuk menampilkan form tambah kategori
    public function create()
    {
        return view('kategori.create'); // Mengarahkan ke tampilan form pembuatan kategori
    }


    public function edit($id) {
        $kategori = Kategori::find($id);
    
        // Cek apakah data kategori ditemukan
        if (!$kategori) {
            return redirect()->route('kategori.index')->with('error', 'Kategori tidak ditemukan.');
        }
    
        return view('kategori.edit', compact('kategori'));
    }
    

    public function destroy(string $KategoriID)
{
    $kategori = Kategori::find($KategoriID);

    try {
        // Hapus kategori
        $kategori->delete();
    } catch (Exception $e) {
        return redirect()->back()->with('error', 'Kategori gagal dihapus');
    }
    
    return redirect()->back()->with('success', 'Kategori berhasil dihapus');
}

public function update(Request $request, $id)
{
    // Validasi data yang dikirimkan melalui form
   /* $request->validate([
        'Nama_Kategori' => 'required|string|max:255',
        // Tambahkan validasi lain jika diperlukan
    ]);
*/
    // Temukan kategori berdasarkan ID
    $kategori = Kategori::find($id);

    // Pastikan data kategori ditemukan
    if (!$kategori) {
        return redirect()->route('kategori.index')->with('error', 'Kategori tidak ditemukan.');
    }

    // Update data kategori
    $kategori->NamaKategori = $request->NamaKategori;
    $kategori->save();

    // Redirect ke halaman index kategori dengan pesan sukses
    return redirect()->route('kategori.index')->with('success', 'Kategori berhasil diperbarui.');
}


}
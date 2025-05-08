<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;
use App\Models\Kategori;
use Exception;

class BukuController extends Controller
{
    public function index()
    { 
        $buku = Buku::paginate(5); 
        return view('buku.index', compact('buku'));  
    }
    
    public function create()
    {
        $kategoris = Kategori::all(); 
        return view('buku.create', compact('kategoris')); 
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'Judul' => 'required|string|max:255',
            'TahunTerbit' => 'required|integer',
            'Penerbit' => 'required|string|max:255',
            'Penulis' => 'required|string|max:255',
            'NamaKategori' => 'required|string|max:255|exists:kategori,NamaKategori',
        ]);

        $buku = new Buku();
        $buku->Judul = $validatedData['Judul'];
        $buku->TahunTerbit = $validatedData['TahunTerbit'];
        $buku->Penerbit = $validatedData['Penerbit'];
        $buku->Penulis = $validatedData['Penulis'];
        $buku->NamaKategori = $validatedData['NamaKategori'];
        $buku->save();

        return redirect()->route('buku.index')->with('success', 'Buku berhasil ditambahkan!');
    }

    public function edit(string $id)    
    {
        $buku = Buku::find($id);
        if (!$buku) {
            return redirect()->back()->with('error', 'Buku Tidak Ditemukan');
        }
        
        $kategoris = Kategori::all();
        return view('buku.edit', ['buku' => $buku, 'kategoris' => $kategoris]);
    }

    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'Judul' => 'required|string|max:255|unique:buku,Judul,' . $id . ',BukuID',
            'TahunTerbit' => 'required|integer',
            'Penerbit' => 'required|string|max:255',
            'Penulis' => 'required|string|max:255',
            'NamaKategori' => 'required|string|max:255|exists:kategori,NamaKategori',
        ]); 
         
          
        try {
            $buku = Buku::find($id); 
            if (!$buku) {
                return redirect()->back()->with('error', 'Buku Tidak Ditemukan');
            }

            $buku->Judul = $validatedData['Judul'];
            $buku->TahunTerbit = $validatedData['TahunTerbit'];
            $buku->Penerbit = $validatedData['Penerbit'];
            $buku->Penulis = $validatedData['Penulis'];
            $buku->NamaKategori = $validatedData['NamaKategori'];
            $buku->save();
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Data Gagal Disimpan: ' . $e->getMessage());
        }

        return redirect()->route('buku.index')->with('success', 'Data Berhasil Disimpan');
    }

    public function destroy(string $id)
    {
        $buku = Buku::find($id);

        try {
            if (!$buku) {
                return redirect()->back()->with('error', 'Buku Tidak Ditemukan');
            }
            $buku->delete();
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Buku Gagal dihapus: ' . $e->getMessage());
        }
        
        return redirect()->back()->with('success', 'Buku Berhasil dihapus');
    }
}
<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\PeminjamanController;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Models\Buku;
use App\Models\Kategori;
use App\Models\Peminjaman;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard', [
        'totalUser' => User::count(),
        'totalBuku' => Buku::count(),
        'totalKategori' => Kategori::count(),
        'totalPeminjaman' => Peminjaman::count(),
        'peminjamanTerbaru' => Peminjaman::with(['user', 'buku'])->latest()->take(5)->get(),
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    Route::resource('user', UserController::class);
    Route::resource('kategori', KategoriController::class);
    Route::resource('buku', BukuController::class);
    Route::resource('peminjaman', PeminjamanController::class);
});

require __DIR__.'/auth.php';

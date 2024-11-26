<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\BukuController;
use App\http\Controllers\peminjamanController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['Role:admin,petugas,'])->group(function () {
    Route::get('/user', [UserController::class, 'index'])->name('user.index');
    Route::get('/user/create', [UserController::class, 'create'])->name('user.create');
    Route::post('/user/store', [UserController::class, 'store'])->name('user.store');
    Route::get('/user/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
    Route::put('/user/update/{id}', [UserController::class, 'update'])->name('user.update');
    Route::delete('/user/{id}', [UserController::class, 'destroy'])->name('user.destroy');

    Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori.index');
    Route::get('/kategori/create', [KategoriController::class, 'create'])->name('kategori.create');
    Route::post('/kategori/store', [KategoriController::class, 'store'])->name('kategori.store');
    Route::get('/kategori/edit/{id}', [KategoriController::class, 'edit'])->name('kategori.edit');
    Route::put('/kategori/update/{id}', [KategoriController::class, 'update'])->name('kategori.update');
    Route::delete('/kategori/{id}', [KategoriController::class, 'destroy'])->name('kategori.destroy');
    

    Route::get('/buku', [bukuController::class, 'index'])->name('buku.index');
    Route::get('/buku/create', [bukuController::class, 'create'])->name('buku.create');
    Route::post('/buku/store', [bukuController::class, 'store'])->name('buku.store');
    Route::get('/buku/edit/{id}', [bukuController::class, 'edit'])->name('buku.edit');
    Route::put('/buku/update/{id}', [bukuController::class, 'update'])->name('buku.update');
    Route::delete('/buku/{id}', [bukuController::class, 'destroy'])->name('buku.destroy');
    Route::resource('buku', BukuController::class);
    

    Route::get('/peminjaman', [peminjamanController::class, 'index'])->name('peminjaman.index');
    Route::get('/peminjaman/create', [peminjamanController::class, 'create'])->name('peminjaman.create');
    Route::post('/peminjaman/store', [peminjamanController::class, 'store'])->name('peminjaman.store');
    Route::get('/peminjaman/edit/{id}', [peminjamanController::class, 'edit'])->name('peminjaman.edit');
    Route::put('/peminjaman/update/{id}', [peminjamanController::class, 'update'])->name('peminjaman.update');
    Route::delete('/peminjaman/{id}', [peminjamanController::class, 'destroy'])->name('peminjaman.destroy');
    Route::resource('peminjaman', PeminjamanController::class);
 
    

});

require __DIR__.'/auth.php';

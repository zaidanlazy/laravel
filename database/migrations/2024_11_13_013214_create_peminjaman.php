<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('peminjaman', function (Blueprint $table) {
            $table->increments('PeminjamanID'); 
            $table->unsignedInteger('BukuID');   // Foreign key ke tabel buku
            $table->date('TanggalPeminjaman');
            $table->date('TanggalPengembalian')->nullable();
            $table->string('StatusPeminjaman', 50); // Status peminjaman (misal: dipinjam, dikembalikan)
            

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('peminjaman');
    }
};

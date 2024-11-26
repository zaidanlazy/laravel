<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('peminjaman', function (Blueprint $table) {
            $table->increments('PeminjamanID'); 
            $table->unsignedInteger('BukuID');   // Foreign key ke tabel buku
            $table->unsignedInteger('UserID');  // Foreign key ke tabel user
            $table->date('TanggalPeminjaman');
            $table->date('TanggalPengembalian')->nullable();
            $table->string('StatusPeminjaman', 50);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('peminjaman', function (Blueprint $table) {
            $table->dropColumn('UserID'); // Menghapus kolom UserID saat rollback
        });
    }
};

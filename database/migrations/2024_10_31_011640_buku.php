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
        Schema::create('buku', function (Blueprint $table) {
            $table->increments('BukuID');  // Primary key, must be unsigned
            $table->string('Judul', 255);
            $table->string('Penulis', 255);
            $table->string('Penerbit', 255);
            $table->integer('TahunTerbit');
            $table->string('NamaKategori', 255);
        });
    }
    
    
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
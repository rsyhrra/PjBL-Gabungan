<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tbl_produk', function (Blueprint $table) {
            $table->id('id_produk');
            
            // UBAH INI: Dari integer id_kategori jadi string kategori
            $table->string('kategori'); 
            
            $table->string('nama_produk');
            $table->text('deskripsi_produk')->nullable();
            $table->string('foto_produk')->nullable();
            $table->integer('harga')->default(0);
            
            // TAMBAH INI: Untuk Minimal Order (Contoh: "400 lbr")
            $table->string('min_order')->default('1 pcs'); 
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tbl_produk');
    }
};
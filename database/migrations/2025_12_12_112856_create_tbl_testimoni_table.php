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
        // Kita cek dulu apakah tabel sudah ada agar tidak error
        if (!Schema::hasTable('tbl_testimoni')) {
            Schema::create('tbl_testimoni', function (Blueprint $table) {
                // Primary Key (Auto Increment)
                $table->id(); 
                
                // Kolom Data
                $table->string('nama_pelanggan');
                $table->string('kota')->nullable(); // Boleh kosong jika tidak diisi
                $table->text('isi_testimoni');
                $table->string('foto_profil')->nullable(); // Foto juga boleh kosong
                $table->integer('rating')->default(5); // Default bintang 5
                
                // Created_at & Updated_at otomatis
                $table->timestamps(); 
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_testimoni');
    }
};
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tbl_pesanan', function (Blueprint $table) {
            $table->id('id_pesanan');
            $table->string('kode_pesanan')->unique();
            $table->string('nama_pelanggan');
            $table->string('no_whatsapp');
            $table->json('detail_pesanan'); // JSON untuk menyimpan item
            $table->string('status')->default('Baru Masuk');
            $table->boolean('is_reviewed')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tbl_pesanan');
    }
};
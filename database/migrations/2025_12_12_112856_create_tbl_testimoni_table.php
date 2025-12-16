<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tbl_testimoni', function (Blueprint $table) {
            $table->id();
            $table->string('kode_pesanan');
            $table->string('nama_pelanggan');
            $table->string('kota')->nullable();
            $table->text('isi_testimoni');
            $table->integer('rating');
            $table->text('admin_reply')->nullable();
            $table->boolean('is_visible')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tbl_testimoni');
    }
};
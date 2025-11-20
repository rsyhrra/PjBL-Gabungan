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
    Schema::create('tbl_pesanan', function (Blueprint $table) {
        // Sesuai RPP 
        $table->id('id_pesanan'); // PK
        $table->dateTime('tgl_pesanan')->useCurrent(); // [cite: 72]
        $table->string('nama_pelanggan'); // [cite: 73]
        $table->string('no_whatsapp'); // [cite: 74]
        $table->text('detail_pesanan'); // [cite: 75]
        $table->string('file_desain')->nullable(); // [cite: 76] (nullable artinya boleh kosong)
        $table->string('status')->default('Baru Masuk'); // [cite: 77]
        $table->timestamps(); // created_at & updated_at (standar Laravel)
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_pesanan');
    }
};

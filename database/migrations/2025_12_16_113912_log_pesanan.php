<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('log_pesanan', function (Blueprint $table) {
            $table->id();
            $table->string('kode_pesanan');
            $table->string('status_lama');
            $table->string('status_baru');
            $table->timestamp('waktu_perubahan');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('log_pesanan');
    }
};
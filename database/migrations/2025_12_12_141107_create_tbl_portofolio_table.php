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
        Schema::create('tbl_portofolio', function (Blueprint $table) {
            $table->id(); // Primary Key (Auto Increment)
            $table->string('judul'); // Judul karya
            $table->string('kategori'); // Kategori (Undangan, Spanduk, dll)
            $table->string('foto'); // Nama file foto
            $table->timestamps(); // created_at & updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_portofolio');
    }
};
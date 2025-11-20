<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    // Beritahu Laravel nama tabelnya (karena tidak pakai bahasa Inggris standar)
    protected $table = 'tbl_produk';
    
    // Beritahu nama Primary Key
    protected $primaryKey = 'id_produk';

    // Kolom yang boleh diisi (sesuai ERD Anda)
   protected $fillable = [
        'kategori',       // Ubah id_kategori jadi ini
        'nama_produk',
        'deskripsi_produk',
        'foto_produk',
        'harga',
        'min_order',      // Tambahan
    ];
}
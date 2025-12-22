<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimoni extends Model
{
    use HasFactory;

    protected $table = 'tbl_testimoni';
    
    // PERBAIKAN: Tambahkan 'kode_pesanan' dan 'is_visible' di sini!
    protected $fillable = [
        'kode_pesanan',   // <--- WAJIB ADA
        'nama_pelanggan', 
        'kota', 
        'isi_testimoni', 
        'foto_profil', 
        'rating',
        'is_visible'      // <--- WAJIB ADA
    ];
}
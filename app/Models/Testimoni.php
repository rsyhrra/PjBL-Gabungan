<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimoni extends Model
{
    use HasFactory;

    // Beritahu Laravel bahwa nama tabel kita adalah 'tbl_testimoni'
    // (Bukan 'testimonis' seperti standar default Laravel)
    protected $table = 'tbl_testimoni';
    
    // Daftar kolom yang boleh diisi secara massal (create/update)
    protected $fillable = [
        'nama_pelanggan', 
        'kota', 
        'isi_testimoni', 
        'foto_profil', 
        'rating'
    ];
}
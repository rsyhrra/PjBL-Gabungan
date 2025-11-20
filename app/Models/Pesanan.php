<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;

    // Beritahu Laravel nama tabel kita (karena tidak pakai bahasa Inggris standar)
    protected $table = 'tbl_pesanan';
    
    // Beritahu nama Primary Key
    protected $primaryKey = 'id_pesanan';

    // Kolom mana saja yang BOLEH diisi oleh pengguna (Security)
    protected $fillable = [
        'nama_pelanggan',
        'no_whatsapp',
        'detail_pesanan',
        'file_desain',
        'status'
    ];
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogPesanan extends Model
{
    use HasFactory;

    // Nama tabel di database (sesuai query SQL sebelumnya)
    protected $table = 'log_pesanan';
    
    // Karena tabel ini tidak punya kolom created_at & updated_at bawaan Laravel,
    // kita matikan timestamps-nya agar tidak error.
    public $timestamps = false;

    protected $fillable = [
        'kode_pesanan',
        'status_lama',
        'status_baru',
        'waktu_perubahan'
    ];
    
    // Kita set kolom waktu agar otomatis diisi tipe tanggal (Carbon)
    protected $casts = [
        'waktu_perubahan' => 'datetime',
    ];
}
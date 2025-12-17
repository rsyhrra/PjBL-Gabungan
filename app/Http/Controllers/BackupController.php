<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\File;

class BackupController extends Controller
{
    public function downloadBackup()
    {
        // 1. Konfigurasi Database
        $dbName = 'db_aneka_usaha';
        $username = 'root';
        $password = ''; // Kosongkan jika pakai XAMPP default
        
        // 2. Siapkan Nama File & Path Sementara
        $filename = 'backup-' . $dbName . '-' . date('Y-m-d_H-i-s') . '.sql';
        // Simpan sementara di folder storage/app
        $storagePath = storage_path("app/" . $filename);

        // 3. Deteksi OS & Path mysqldump (PENTING untuk Windows/XAMPP)
        $mysqldumpPath = "mysqldump"; 
        
        // Cek jika OS adalah Windows
        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
            // Cek path standar XAMPP
            if (file_exists('C:/xampp/mysql/bin/mysqldump.exe')) {
                $mysqldumpPath = '"C:/xampp/mysql/bin/mysqldump.exe"';
            } 
            // Tambahkan path lain jika XAMPP diinstall di drive D: dsb.
            elseif (file_exists('D:/xampp/mysql/bin/mysqldump.exe')) {
                $mysqldumpPath = '"D:/xampp/mysql/bin/mysqldump.exe"';
            }
        }

        // 4. Susun Perintah Terminal
        $passwordCmd = $password ? "--password=\"$password\"" : ""; 
        // Perintah: mysqldump -u root db_name > file.sql
        $command = "$mysqldumpPath --user={$username} {$passwordCmd} {$dbName} > \"{$storagePath}\"";

        // 5. Eksekusi Perintah
        try {
            // Jalankan command
            exec($command, $output, $returnVar);

            // 6. Cek Hasil & FORCE DOWNLOAD ke Browser
            if (file_exists($storagePath) && filesize($storagePath) > 0) {
                
                
                return Response::download($storagePath)->deleteFileAfterSend(true);
            
            } else {
                // Jika file kosong (biasanya path mysqldump salah)
                return back()->with('error', 'Gagal Backup! File kosong. Cek path mysqldump di Controller.');
            }

        } catch (\Exception $e) {
            return back()->with('error', 'Error: ' . $e->getMessage());
        }
    }
}
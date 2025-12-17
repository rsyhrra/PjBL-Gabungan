<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // ---------------------------------------------------------
        // 1. Stored Procedure: Update Status & Audit Log
        // ---------------------------------------------------------
        
        // Hapus dulu jika ada (agar tidak error saat create)
        DB::unprepared("DROP PROCEDURE IF EXISTS sp_update_status_pesanan");

        // Buat Procedure Baru
        $procedure = "
            CREATE PROCEDURE sp_update_status_pesanan(
                IN p_kode VARCHAR(255),
                IN p_status_baru VARCHAR(255)
            )
            BEGIN
                DECLARE v_status_lama VARCHAR(255);

                -- Ambil status lama (gunakan LIMIT 1 untuk keamanan)
                SELECT status INTO v_status_lama 
                FROM tbl_pesanan 
                WHERE kode_pesanan = p_kode 
                LIMIT 1;

                -- Lakukan Update hanya jika data ditemukan
                IF v_status_lama IS NOT NULL THEN
                    -- Update status
                    UPDATE tbl_pesanan 
                    SET status = p_status_baru, updated_at = NOW()
                    WHERE kode_pesanan = p_kode;

                    -- Catat Log Otomatis
                    INSERT INTO log_pesanan (kode_pesanan, status_lama, status_baru, waktu_perubahan, created_at, updated_at)
                    VALUES (p_kode, v_status_lama, p_status_baru, NOW(), NOW(), NOW());
                END IF;
            END;
        ";
        DB::unprepared($procedure);


        // ---------------------------------------------------------
        // 2. Stored Function: Hitung Total Belanja Pelanggan
        // ---------------------------------------------------------

        // Hapus dulu jika ada
        DB::unprepared("DROP FUNCTION IF EXISTS fc_hitung_total_belanja");

        // Buat Function Baru
        $function = "
            CREATE FUNCTION fc_hitung_total_belanja(p_nama_pelanggan VARCHAR(255)) 
            RETURNS INT
            READS SQL DATA
            BEGIN
                DECLARE v_total INT;
                
                -- Hitung berapa kali pelanggan belanja (status Selesai)
                SELECT COUNT(*) INTO v_total 
                FROM tbl_pesanan 
                WHERE nama_pelanggan = p_nama_pelanggan AND status = 'Selesai';
                
                RETURN IFNULL(v_total, 0);
            END;
        ";
        DB::unprepared($function);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS sp_update_status_pesanan");
        DB::unprepared("DROP FUNCTION IF EXISTS fc_hitung_total_belanja");
    }
};
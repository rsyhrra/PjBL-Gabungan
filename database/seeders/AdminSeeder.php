<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB; // <--- TAMBAHKAN BARIS INI
use App\Models\Admin;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
{
    DB::table('tbl_admin')->insert([
        'username' => 'admin',
        // Password "admin123" di-hash (enkripsi)
        'password' => Hash::make('admin123'), 
        'created_at' => now(),
        'updated_at' => now(),
    ]);
}
}

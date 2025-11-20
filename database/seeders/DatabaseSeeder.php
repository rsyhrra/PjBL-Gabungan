<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Panggil semua seeder penting di sini
        $this->call([
            AdminSeeder::class,  // <-- Agar akun admin dibuat otomatis
            ProdukSeeder::class, // <-- Agar produk juga otomatis ada
        ]);
    }
}
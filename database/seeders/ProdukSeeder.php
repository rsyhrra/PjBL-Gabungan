<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Produk;

class ProdukSeeder extends Seeder
{
    public function run(): void
    {
        // Data diambil dari dokumen HARGA UNDANGAN
        $data = [
            // --- 1. KATEGORI BLANGKO (Min Order 400 lbr) ---
            [
                'nama_produk' => 'Blangko Separasi Dobel Engkel (Amplop Tebal)',
                'kategori' => 'Blangko',
                'harga' => 2200,
                'min_order' => '400 lbr',
                'foto_produk' => 'blangko1.jpg', 
                'deskripsi_produk' => 'Termasuk Label Stiker & Plastik.'
            ],
            [
                'nama_produk' => 'Blangko 2 Warna Dobel Engkel (Amplop Tebal)',
                'kategori' => 'Blangko',
                'harga' => 2000,
                'min_order' => '400 lbr',
                'foto_produk' => 'blangko2.jpg',
                'deskripsi_produk' => 'Termasuk Label Stiker & Plastik.'
            ],
            [
                'nama_produk' => 'Blangko Separasi Dobel Engkel (Amplop Tipis)',
                'kategori' => 'Blangko',
                'harga' => 2000,
                'min_order' => '400 lbr',
                'foto_produk' => 'blangko3.jpg',
                'deskripsi_produk' => 'Termasuk Label Stiker & Plastik.'
            ],
            [
                'nama_produk' => 'Blangko Dobel Engkel 1 Warna (Amplop Tipis)',
                'kategori' => 'Blangko',
                'harga' => 1600,
                'min_order' => '400 lbr',
                'foto_produk' => 'blangko4.jpg',
                'deskripsi_produk' => 'Termasuk Label Stiker & Plastik.'
            ],
            [
                'nama_produk' => 'Blangko Engkel 1 Warna (Amplop Tipis)',
                'kategori' => 'Blangko',
                'harga' => 1300,
                'min_order' => '400 lbr',
                'foto_produk' => 'blangko5.jpg',
                'deskripsi_produk' => 'Termasuk Label Stiker & Plastik.'
            ],
            [
                'nama_produk' => 'Blangko Engkel 1 Warna Mini (Amplop Tipis)',
                'kategori' => 'Blangko',
                'harga' => 1100,
                'min_order' => '400 lbr',
                'foto_produk' => 'blangko6.jpg',
                'deskripsi_produk' => 'Termasuk Label Stiker & Plastik.'
            ],

            // --- 2. UNDANGAN SEPARASI DESAIN (Min Order 500 lbr) ---
            [
                'nama_produk' => 'Undangan Separasi Desain + Hotprint 18,5x15 (Amplop Tebal)',
                'kategori' => 'Custom Desain',
                'harga' => 3300,
                'min_order' => '500 lbr',
                'foto_produk' => 'custom1.jpg',
                'deskripsi_produk' => 'Ukuran 18,5x15 cm. Termasuk Label Stiker & Plastik.'
            ],
            [
                'nama_produk' => 'Undangan Separasi Desain + Hotprint 18,5x15 (Amplop Tipis)',
                'kategori' => 'Custom Desain',
                'harga' => 3500, // Sesuai data no. 8
                'min_order' => '500 lbr',
                'foto_produk' => 'custom2.jpg',
                'deskripsi_produk' => 'Ukuran 18,5x15 cm. Termasuk Label Stiker & Plastik.'
            ],
            [
                'nama_produk' => 'Undangan Separasi Desain + Hotprint 22x16 (Amplop Tebal)',
                'kategori' => 'Custom Desain',
                'harga' => 4000,
                'min_order' => '500 lbr',
                'foto_produk' => 'custom3.jpg',
                'deskripsi_produk' => 'Ukuran Besar 22x16 cm. Termasuk Label Stiker & Plastik.'
            ],
            [
                'nama_produk' => 'Undangan Separasi Desain 22x16 (Amplop Tebal)',
                'kategori' => 'Custom Desain',
                'harga' => 3700,
                'min_order' => '500 lbr',
                'foto_produk' => 'custom4.jpg',
                'deskripsi_produk' => 'Tanpa Hotprint. Ukuran Besar 22x16 cm. Termasuk Label Stiker & Plastik.'
            ],

            // --- 3. UNDANGAN DESAIN WARNA (Min Order 500 lbr) ---
            [
                'nama_produk' => 'Undangan 2 Warna Desain + Hotprint 22x16 (Amplop Tebal)',
                'kategori' => 'Desain Warna',
                'harga' => 3500,
                'min_order' => '500 lbr',
                'foto_produk' => 'warna1.jpg',
                'deskripsi_produk' => 'Ukuran Besar. Termasuk Label Stiker & Plastik.'
            ],
            [
                'nama_produk' => 'Undangan 2 Warna Desain 18,5x15 (Amplop Tebal)',
                'kategori' => 'Desain Warna',
                'harga' => 3300,
                'min_order' => '500 lbr',
                'foto_produk' => 'warna2.jpg',
                'deskripsi_produk' => 'Termasuk Label Stiker & Plastik.'
            ],
            [
                'nama_produk' => 'Undangan 1 Warna Desain 22x16 (Amplop Tebal)',
                'kategori' => 'Desain Warna',
                'harga' => 3000,
                'min_order' => '500 lbr',
                'foto_produk' => 'warna3.jpg',
                'deskripsi_produk' => 'Ukuran Besar. Termasuk Label Stiker & Plastik.'
            ],
            [
                'nama_produk' => 'Undangan 1 Warna Desain 18,5x15 (Amplop Tebal)',
                'kategori' => 'Desain Warna',
                'harga' => 2200,
                'min_order' => '500 lbr',
                'foto_produk' => 'warna4.jpg',
                'deskripsi_produk' => 'Termasuk Label Stiker & Plastik.'
            ],
            [
                'nama_produk' => 'Undangan 1 Warna Desain 18,5x15 (Amplop Tipis)',
                'kategori' => 'Desain Warna',
                'harga' => 2000,
                'min_order' => '500 lbr',
                'foto_produk' => 'warna5.jpg',
                'deskripsi_produk' => 'Termasuk Label Stiker & Plastik.'
            ],

            // --- 4. UNDANGAN BLOK (FULL COLOR) (Min Order 500 lbr) ---
            [
                'nama_produk' => 'Undangan Blok Separasi Desain + Hotprint 18,5x15 (Amplop Tebal)',
                'kategori' => 'Undangan Blok',
                'harga' => 4000,
                'min_order' => '500 lbr',
                'foto_produk' => 'blok1.jpg',
                'deskripsi_produk' => 'Full Blok Color. Termasuk Label Stiker & Plastik.'
            ],
            [
                'nama_produk' => 'Undangan Blok Desain + Hotprint 18,5x15 (Amplop Tebal)',
                'kategori' => 'Undangan Blok',
                'harga' => 3500,
                'min_order' => '500 lbr',
                'foto_produk' => 'blok2.jpg',
                'deskripsi_produk' => 'Full Blok Color. Termasuk Label Stiker & Plastik.'
            ],
            [
                'nama_produk' => 'Undangan Blok Separasi Desain 18,5x15 (Amplop Tebal)',
                'kategori' => 'Undangan Blok',
                'harga' => 3500,
                'min_order' => '500 lbr',
                'foto_produk' => 'blok3.jpg',
                'deskripsi_produk' => 'Tanpa Hotprint. Termasuk Label Stiker & Plastik.'
            ],
            [
                'nama_produk' => 'Undangan Blok Desain 18,5x15 (Amplop Tebal)',
                'kategori' => 'Undangan Blok',
                'harga' => 3300,
                'min_order' => '500 lbr',
                'foto_produk' => 'blok4.jpg',
                'deskripsi_produk' => 'Tanpa Hotprint. Termasuk Label Stiker & Plastik.'
            ],
            [
                'nama_produk' => 'Undangan Blok Separasi Desain + Hotprint 22x16 (Amplop Tebal)',
                'kategori' => 'Undangan Blok',
                'harga' => 4500,
                'min_order' => '500 lbr',
                'foto_produk' => 'blok5.jpg',
                'deskripsi_produk' => 'Ukuran Besar. Termasuk Label Stiker & Plastik.'
            ],
            [
                'nama_produk' => 'Undangan Blok Desain + Hotprint 22x16 (Amplop Tebal)',
                'kategori' => 'Undangan Blok',
                'harga' => 4000,
                'min_order' => '500 lbr',
                'foto_produk' => 'blok6.jpg',
                'deskripsi_produk' => 'Ukuran Besar. Termasuk Label Stiker & Plastik.'
            ],
            [
                'nama_produk' => 'Undangan Blok Separasi Desain 22x16 (Amplop Tebal)',
                'kategori' => 'Undangan Blok',
                'harga' => 4000,
                'min_order' => '500 lbr',
                'foto_produk' => 'blok7.jpg',
                'deskripsi_produk' => 'Ukuran Besar. Termasuk Label Stiker & Plastik.'
            ],
            [
                'nama_produk' => 'Undangan Blok Desain 22x16 (Amplop Tebal)',
                'kategori' => 'Undangan Blok',
                'harga' => 3500,
                'min_order' => '500 lbr',
                'foto_produk' => 'blok8.jpg',
                'deskripsi_produk' => 'Ukuran Besar. Termasuk Label Stiker & Plastik.'
            ],

            // --- 5. LAINNYA ---
            [
                'nama_produk' => 'Undangan Dos (Kotak)',
                'kategori' => 'Lainnya',
                'harga' => 1000,
                'min_order' => '-',
                'foto_produk' => 'dos.jpg', // Pastikan ada gambar ini
                'deskripsi_produk' => 'Tambahan kemasan kotak/dos.'
            ],
        ];

        foreach ($data as $item) {
            Produk::create($item);
        }
    }
}
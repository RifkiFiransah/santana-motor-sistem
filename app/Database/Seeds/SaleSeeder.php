<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SaleSeeder extends Seeder
{
    public function run()
    {
        // Data penjualan untuk 8 motor yang sudah terjual
        // Pastikan motorcycle_id sesuai dengan ID motor yang status 'terjual'
        // Asumsi: motor terjual memiliki ID 11-18 (setelah 10 motor tersedia)
        // kasir_id = 3 (asumsi ID user dengan role kasir)
        
        $data = [
            [
                'no_invoice' => 'INV-20241005143000',
                'motorcycle_id' => 11, // B 1111 AAA - Vario 125
                'kasir_id' => 3,
                'nama_pembeli' => 'Ahmad Rizki',
                'no_hp_pembeli' => '081234567890',
                'tanggal_jual' => '2024-10-05 14:30:00',
                'harga_akhir' => 16800000, // Nego dari 17jt
                'created_at' => '2024-10-05 14:30:00',
                'updated_at' => '2024-10-05 14:30:00',
            ],
            [
                'no_invoice' => 'INV-20241012160000',
                'motorcycle_id' => 12, // B 2222 BBB - NMAX 155
                'kasir_id' => 3,
                'nama_pembeli' => 'Siti Nurhaliza',
                'no_hp_pembeli' => '082345678901',
                'tanggal_jual' => '2024-10-12 16:00:00',
                'harga_akhir' => 22000000, // Harga pas
                'created_at' => '2024-10-12 16:00:00',
                'updated_at' => '2024-10-12 16:00:00',
            ],
            [
                'no_invoice' => 'INV-20241020104500',
                'motorcycle_id' => 13, // B 3333 CCC - Beat
                'kasir_id' => 3,
                'nama_pembeli' => 'Budi Santoso',
                'no_hp_pembeli' => '083456789012',
                'tanggal_jual' => '2024-10-20 10:45:00',
                'harga_akhir' => 14500000, // Harga pas
                'created_at' => '2024-10-20 10:45:00',
                'updated_at' => '2024-10-20 10:45:00',
            ],
            [
                'no_invoice' => 'INV-20241025112000',
                'motorcycle_id' => 14, // B 4444 DDD - Satria F150
                'kasir_id' => 3,
                'nama_pembeli' => 'Dedi Kurniawan',
                'no_hp_pembeli' => '084567890123',
                'tanggal_jual' => '2024-10-25 11:20:00',
                'harga_akhir' => 17500000, // Nego dari 18jt
                'created_at' => '2024-10-25 11:20:00',
                'updated_at' => '2024-10-25 11:20:00',
            ],
            [
                'no_invoice' => 'INV-20241101153000',
                'motorcycle_id' => 15, // B 5555 EEE - Aerox 155
                'kasir_id' => 3,
                'nama_pembeli' => 'Eko Prasetyo',
                'no_hp_pembeli' => '085678901234',
                'tanggal_jual' => '2024-11-01 15:30:00',
                'harga_akhir' => 23000000, // Nego dari 23.5jt
                'created_at' => '2024-11-01 15:30:00',
                'updated_at' => '2024-11-01 15:30:00',
            ],
            [
                'no_invoice' => 'INV-20241110140000',
                'motorcycle_id' => 17, // B 7777 GGG - PCX 150
                'kasir_id' => 3,
                'nama_pembeli' => 'Gunawan Wijaya',
                'no_hp_pembeli' => '087890123456',
                'tanggal_jual' => '2024-11-10 14:00:00',
                'harga_akhir' => 26500000, // Nego dari 27jt
                'created_at' => '2024-11-10 14:00:00',
                'updated_at' => '2024-11-10 14:00:00',
            ],
            [
                'no_invoice' => 'INV-20241115164500',
                'motorcycle_id' => 18, // B 8888 HHH - Mio M3
                'kasir_id' => 3,
                'nama_pembeli' => 'Hendra Susanto',
                'no_hp_pembeli' => '088901234567',
                'tanggal_jual' => '2024-11-15 16:45:00',
                'harga_akhir' => 11500000, // Harga pas
                'created_at' => '2024-11-15 16:45:00',
                'updated_at' => '2024-11-15 16:45:00',
            ],
        ];

        // Insert data
        foreach ($data as $sale) {
            $this->db->table('sales')->insert($sale);
        }

        echo "8 data penjualan berhasil ditambahkan\n";
    }
}

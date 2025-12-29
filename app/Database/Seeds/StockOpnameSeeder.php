<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class StockOpnameSeeder extends Seeder
{
    public function run()
    {
        // Data stok opname yang dilakukan oleh petugas gudang
        // gudang_id = 2 (asumsi ID user dengan role gudang)
        
        $data = [
            [
                'gudang_id' => 2,
                'tanggal_opname' => '2024-10-01',
                'jumlah_sistem' => 15,
                'jumlah_fisik' => 15,
                'catatan' => 'Stok opname awal bulan Oktober. Semua motor sesuai dengan sistem.',
                'created_at' => '2024-10-01 09:00:00',
                'updated_at' => '2024-10-01 09:00:00',
            ],
            [
                'gudang_id' => 2,
                'tanggal_opname' => '2024-10-15',
                'jumlah_sistem' => 13,
                'jumlah_fisik' => 13,
                'catatan' => 'Stok opname tengah bulan. 2 motor terjual dalam 2 minggu.',
                'created_at' => '2024-10-15 10:30:00',
                'updated_at' => '2024-10-15 10:30:00',
            ],
            [
                'gudang_id' => 2,
                'tanggal_opname' => '2024-11-01',
                'jumlah_sistem' => 12,
                'jumlah_fisik' => 12,
                'catatan' => 'Stok opname awal bulan November. Terdapat 1 motor baru masuk dan 2 motor terjual.',
                'created_at' => '2024-11-01 09:15:00',
                'updated_at' => '2024-11-01 09:15:00',
            ],
            [
                'gudang_id' => 2,
                'tanggal_opname' => '2024-11-08',
                'jumlah_sistem' => 11,
                'jumlah_fisik' => 10,
                'catatan' => 'Ditemukan selisih 1 unit. Motor B 7777 GGG sedang dalam proses penjualan namun masih tercatat tersedia di sistem. Perlu update status.',
                'created_at' => '2024-11-08 14:45:00',
                'updated_at' => '2024-11-08 14:45:00',
            ],
            [
                'gudang_id' => 2,
                'tanggal_opname' => '2024-11-15',
                'jumlah_sistem' => 10,
                'jumlah_fisik' => 10,
                'catatan' => 'Stok opname mingguan. Semua motor tersedia sesuai sistem. 3 motor baru masuk minggu ini.',
                'created_at' => '2024-11-15 11:00:00',
                'updated_at' => '2024-11-15 11:00:00',
            ],
            [
                'gudang_id' => 2,
                'tanggal_opname' => '2024-11-20',
                'jumlah_sistem' => 10,
                'jumlah_fisik' => 10,
                'catatan' => 'Pengecekan rutin. Semua motor dalam kondisi baik dan sesuai catatan sistem. 2 motor baru masuk hari ini.',
                'created_at' => '2024-11-20 16:30:00',
                'updated_at' => '2024-11-20 16:30:00',
            ],
        ];

        // Insert data
        foreach ($data as $opname) {
            $this->db->table('stock_opnames')->insert($opname);
        }

        echo "6 data stok opname berhasil ditambahkan\n";
    }
}

<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Motorcycles extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'plat_nomor' => [
                'type'       => 'VARCHAR',
                'constraint' => '20',
                'unique'     => true,
            ],
            'merk' => [ // Honda, Yamaha, dll
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'tipe' => [ // Vario 150, NMAX, dll
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'warna' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'tahun' => [
                'type'       => 'YEAR',
            ],
            'harga_beli' => [
                'type'       => 'DECIMAL',
                'constraint' => '15,2',
            ],
            'harga_jual' => [
                'type'       => 'DECIMAL',
                'constraint' => '15,2',
            ],
            'status' => [
                'type'       => 'ENUM',
                'constraint' => ['tersedia', 'terjual', 'perbaikan'],
                'default'    => 'tersedia',
            ],
            'tanggal_masuk' => [
                'type' => 'DATE', // Penting untuk Laporan Pembelian
            ],
            'sumber_pembelian' => [
                'type' => 'VARCHAR',
                'constraint' => 100, // Opsional: Beli dari siapa?
                'null' => true,
            ],
            'created_at' => [ // Tanggal Masuk (Input Gudang)
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('motorcycles');
    }

    public function down()
    {
        $this->forge->dropTable('motorcycles');
    }
}

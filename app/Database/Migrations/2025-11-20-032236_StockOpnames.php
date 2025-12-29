<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class StockOpnames extends Migration
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
            'gudang_id' => [ // Petugas yang melakukan cek
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'tanggal_opname' => [
                'type' => 'DATE',
            ],
            'jumlah_sistem' => [ // Jumlah motor status 'tersedia' di sistem
                'type'       => 'INT',
            ],
            'jumlah_fisik' => [ // Jumlah motor real di lapangan
                'type'       => 'INT',
            ],
            'catatan' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('gudang_id', 'users', 'id', 'CASCADE', 'RESTRICT');
        $this->forge->createTable('stock_opnames');
    }

    public function down()
    {
        $this->forge->dropTable('stock_opnames');
    }
}

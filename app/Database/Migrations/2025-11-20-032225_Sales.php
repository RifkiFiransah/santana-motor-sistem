<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Sales extends Migration
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
            'no_invoice' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'unique'     => true,
            ],
            'motorcycle_id' => [ // Relasi ke motor
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'kasir_id' => [ // Relasi ke user (kasir)
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'nama_pembeli' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'no_hp_pembeli' => [
                'type'       => 'VARCHAR',
                'constraint' => '20',
            ],
            'tanggal_jual' => [
                'type' => 'DATETIME',
            ],
            'harga_akhir' => [ // Harga deal (bisa beda dengan harga_jual di master)
                'type'       => 'DECIMAL',
                'constraint' => '15,2',
            ],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('motorcycle_id', 'motorcycles', 'id', 'CASCADE', 'RESTRICT');
        $this->forge->addForeignKey('kasir_id', 'users', 'id', 'CASCADE', 'RESTRICT');
        $this->forge->createTable('sales');
    }

    public function down()
    {
        $this->forge->dropTable('sales');
    }
}

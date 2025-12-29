<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddFotoToMotorcycles extends Migration
{
    public function up()
    {
        // Tambahkan kolom foto ke tabel motorcycles
        $this->forge->addColumn('motorcycles', [
            'foto' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => true,
                'comment'    => 'Nama file foto motor (disimpan di writable/uploads/motorcycles/)',
            ],
        ]);
    }

    public function down()
    {
        // Hapus kolom foto jika rollback
        $this->forge->dropColumn('motorcycles', 'foto');
    }
}

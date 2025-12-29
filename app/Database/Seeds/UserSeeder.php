<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'username' => 'pemilik',
                'password' => password_hash('pemilik123', PASSWORD_DEFAULT),
                'fullname' => 'Budi Santoso',
                'role'     => 'pemilik',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'username' => 'gudang',
                'password' => password_hash('gudang123', PASSWORD_DEFAULT),
                'fullname' => 'Ahmad Fauzi',
                'role'     => 'gudang',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'username' => 'kasir',
                'password' => password_hash('kasir123', PASSWORD_DEFAULT),
                'fullname' => 'Siti Aminah',
                'role'     => 'kasir',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]
        ];

        // Insert data satu per satu untuk memastikan urutan ID
        foreach ($data as $user) {
            $this->db->table('users')->insert($user);
        }

        echo "3 user berhasil ditambahkan (ID 1: Pemilik, ID 2: Gudang, ID 3: Kasir)\n";
    }
}

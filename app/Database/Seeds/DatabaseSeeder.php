<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        echo "=== Mulai Seeding Database ===\n\n";
        
        // 1. Seed Users (harus pertama karena ada foreign key)
        echo "1. Seeding Users...\n";
        $this->call('UserSeeder');
        echo "\n";
        
        // 2. Seed Motorcycles
        echo "2. Seeding Motorcycles...\n";
        $this->call('MotorcycleSeeder');
        echo "\n";
        
        // 3. Seed Sales (setelah motorcycles dan users)
        echo "3. Seeding Sales...\n";
        $this->call('SaleSeeder');
        echo "\n";
        
        // 4. Seed Stock Opnames (setelah users)
        echo "4. Seeding Stock Opnames...\n";
        $this->call('StockOpnameSeeder');
        echo "\n";
        
        echo "=== Seeding Database Selesai ===\n";
    }
}

<?php

namespace App\Models;

use CodeIgniter\Model;

class MotorcycleModel extends Model
{
    protected $table = 'motorcycles';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'plat_nomor', 'merk', 'tipe', 'warna', 'tahun', 
        'harga_beli', 'harga_jual', 'status', 'tanggal_masuk', 'sumber_pembelian', 'foto'
    ];
    protected $useTimestamps = true;

    // Helper untuk ambil motor tersedia saja
    public function getTersedia()
    {
        return $this->where('status', 'tersedia')->findAll();
    }

    /**
     * Ambil nilai unik dari kolom tertentu dengan kondisi opsional.
     */
    public function getDistinctValues(string $column, array $conditions = [], string $direction = 'ASC'): array
    {
        $builder = $this->builder()
            ->select($column)
            ->distinct()
            ->orderBy($column, $direction);

        if (!empty($conditions)) {
            $builder->where($conditions);
        }

        return $builder->get()->getResultArray();
    }
}

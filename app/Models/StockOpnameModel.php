<?php

namespace App\Models;

use CodeIgniter\Model;

class StockOpnameModel extends Model
{
    protected $table = 'stock_opnames';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'gudang_id', 'tanggal_opname', 'jumlah_sistem', 'jumlah_fisik', 'catatan'
    ];
    protected $useTimestamps = true;

    // Method untuk mendapatkan laporan stok opname dengan join
    public function getLaporanStokOpname()
    {
        return $this->select('stock_opnames.*, users.fullname as nama_petugas')
                    ->join('users', 'users.id = stock_opnames.gudang_id')
                    ->orderBy('stock_opnames.tanggal_opname', 'DESC')
                    ->findAll();
    }
}

<?php

namespace App\Models;

use CodeIgniter\Model;

class SaleModel extends Model
{
    protected $table = 'sales';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'no_invoice', 'motorcycle_id', 'kasir_id', 
        'nama_pembeli', 'no_hp_pembeli', 'tanggal_jual', 'harga_akhir'
    ];
    protected $useTimestamps = true;

    // Relasi untuk menampilkan data detail di laporan
    public function getLaporanPenjualan($tglAwal = null, $tglAkhir = null)
    {
        $builder = $this->select('sales.*, motorcycles.plat_nomor, motorcycles.merk, motorcycles.tipe, motorcycles.warna, users.fullname as nama_kasir');
        $builder->join('motorcycles', 'motorcycles.id = sales.motorcycle_id');
        $builder->join('users', 'users.id = sales.kasir_id');
        
        if($tglAwal && $tglAkhir) {
            $builder->where('sales.tanggal_jual >=', $tglAwal);
            $builder->where('sales.tanggal_jual <=', $tglAkhir);
        }
        
        return $builder->findAll();
    }

    // Method untuk mendapatkan detail invoice dengan join
    public function getInvoiceDetail($noInvoice)
    {
        return $this->select('sales.*, motorcycles.plat_nomor, motorcycles.merk, motorcycles.tipe, motorcycles.warna, motorcycles.tahun, motorcycles.harga_jual, users.fullname as nama_kasir')
                    ->join('motorcycles', 'motorcycles.id = sales.motorcycle_id')
                    ->join('users', 'users.id = sales.kasir_id')
                    ->where('sales.no_invoice', $noInvoice)
                    ->first();
    }
}

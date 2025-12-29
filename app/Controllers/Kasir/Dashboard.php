<?php

namespace App\Controllers\Kasir;

use App\Controllers\BaseController;
use App\Models\MotorcycleModel;
use App\Models\SaleModel;

class Dashboard extends BaseController
{
    public function index()
    {
        $motorModel = new MotorcycleModel();
        $saleModel = new SaleModel();

        // Statistik untuk dashboard kasir
        $data = [
            'total_motor_tersedia' => $motorModel->where('status', 'tersedia')->countAllResults(),
            'transaksi_hari_ini' => $saleModel->where('DATE(tanggal_jual)', date('Y-m-d'))
                                               ->countAllResults(),
            'transaksi_bulan_ini' => $saleModel->where('MONTH(tanggal_jual)', date('m'))
                                                ->where('YEAR(tanggal_jual)', date('Y'))
                                                ->countAllResults(),
            'transaksi_saya_hari_ini' => $saleModel->where('kasir_id', session()->get('id'))
                                                    ->where('DATE(tanggal_jual)', date('Y-m-d'))
                                                    ->countAllResults(),
            'transaksi_terbaru' => $saleModel->select('sales.*, motorcycles.plat_nomor, motorcycles.merk')
                                              ->join('motorcycles', 'motorcycles.id = sales.motorcycle_id')
                                              ->where('sales.kasir_id', session()->get('id'))
                                              ->orderBy('sales.tanggal_jual', 'DESC')
                                              ->limit(5)
                                              ->find(),
        ];

        return view('kasir/dashboard', $data);
    }
}

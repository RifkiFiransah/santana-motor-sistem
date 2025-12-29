<?php

namespace App\Controllers\Pemilik;

use App\Controllers\BaseController;
use App\Models\MotorcycleModel;
use App\Models\SaleModel;
use App\Models\UserModel;

class Dashboard extends BaseController
{
    public function index()
    {
        $motorModel = new MotorcycleModel();
        $saleModel = new SaleModel();
        $userModel = new UserModel();

        // Statistik untuk dashboard pemilik
        $data = [
            'total_motor_tersedia' => $motorModel->where('status', 'tersedia')->countAllResults(),
            'total_motor_terjual' => $motorModel->where('status', 'terjual')->countAllResults(),
            'total_penjualan_bulan_ini' => $saleModel->where('MONTH(tanggal_jual)', date('m'))
                                                      ->where('YEAR(tanggal_jual)', date('Y'))
                                                      ->countAllResults(),
            'total_user' => $userModel->countAll(),
            'penjualan_terbaru' => $saleModel->select('sales.*, motorcycles.plat_nomor, motorcycles.merk')
                                              ->join('motorcycles', 'motorcycles.id = sales.motorcycle_id')
                                              ->orderBy('sales.tanggal_jual', 'DESC')
                                              ->limit(5)
                                              ->find(),
        ];

        return view('pemilik/dashboard', $data);
    }
}

<?php

namespace App\Controllers\Gudang;

use App\Controllers\BaseController;
use App\Models\MotorcycleModel;
use App\Models\StockOpnameModel;

class Dashboard extends BaseController
{
    public function index()
    {
        $motorModel = new MotorcycleModel();
        $stokOpnameModel = new StockOpnameModel();

        // Statistik untuk dashboard gudang
        $data = [
            'total_motor_tersedia' => $motorModel->where('status', 'tersedia')->countAllResults(),
            'total_motor_terjual' => $motorModel->where('status', 'terjual')->countAllResults(),
            'motor_masuk_bulan_ini' => $motorModel->where('MONTH(tanggal_masuk)', date('m'))
                                                   ->where('YEAR(tanggal_masuk)', date('Y'))
                                                   ->countAllResults(),
            'stok_opname_terakhir' => $stokOpnameModel->orderBy('tanggal_opname', 'DESC')
                                                       ->first(),
            'motor_terbaru' => $motorModel->orderBy('tanggal_masuk', 'DESC')
                                           ->limit(5)
                                           ->findAll(),
        ];

        return view('gudang/dashboard', $data);
    }
}

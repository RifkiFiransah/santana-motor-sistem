<?php

namespace App\Controllers\Gudang;

use App\Controllers\BaseController;
use App\Models\StockOpnameModel;
use App\Models\MotorcycleModel;

class StokOpnameController extends BaseController
{
    public function index()
    {
        $motorModel = new MotorcycleModel();
        // Hitung jumlah sistem untuk ditampilkan di form
        $jumlahSistem = $motorModel->where('status', 'tersedia')->countAllResults();

        return view('gudang/stok_opname/form', ['jumlahSistem' => $jumlahSistem]);
    }

    public function create()
    {
        // Validasi input
        $validation = \Config\Services::validation();
        $validation->setRules([
            'jumlah_sistem' => 'required|numeric',
            'jumlah_fisik'  => 'required|numeric',
            'catatan'       => 'permit_empty|max_length[500]',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $model = new StockOpnameModel();
        $model->save([
            'gudang_id'      => session()->get('id'), // ID user login
            'tanggal_opname' => date('Y-m-d'),
            'jumlah_sistem'  => $this->request->getPost('jumlah_sistem'),
            'jumlah_fisik'   => $this->request->getPost('jumlah_fisik'),
            'catatan'        => $this->request->getPost('catatan'),
        ]);

        return redirect()->to('gudang/dashboard')->with('success', 'Laporan Stok Opname Terkirim');
    }
}

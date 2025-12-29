<?php

namespace App\Controllers\Kasir;

use App\Controllers\BaseController;
use App\Models\MotorcycleModel;
use App\Models\SaleModel;

class TransaksiController extends BaseController
{
    public function new()
    {
        $motorModel = new MotorcycleModel();
        // Hanya tampilkan motor yang tersedia
        $data['motors'] = $motorModel->where('status', 'tersedia')->findAll();
        return view('kasir/transaksi/form', $data);
    }

    public function create()
    {
        // Validasi input
        $validation = \Config\Services::validation();
        $validation->setRules([
            'motorcycle_id' => 'required|numeric',
            'nama_pembeli'  => 'required|min_length[3]',
            'no_hp_pembeli' => 'required|numeric|min_length[10]',
            'harga_akhir'   => 'required|numeric',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $saleModel = new SaleModel();
        $motorModel = new MotorcycleModel();

        $motorId = $this->request->getPost('motorcycle_id');

        // Validasi: Pastikan motor masih tersedia
        $motor = $motorModel->find($motorId);
        if (!$motor || $motor['status'] !== 'tersedia') {
            return redirect()->back()->with('error', 'Motor tidak tersedia atau sudah terjual');
        }

        // START TRANSACTION
        $db = \Config\Database::connect();
        $db->transStart();

        // 1. Simpan data penjualan
        $noInvoice = 'INV-' . date('YmdHis'); // Generate Invoice otomatis
        $saleModel->insert([
            'no_invoice'    => $noInvoice,
            'motorcycle_id' => $motorId,
            'kasir_id'      => session()->get('id'),
            'nama_pembeli'  => $this->request->getPost('nama_pembeli'),
            'no_hp_pembeli' => $this->request->getPost('no_hp_pembeli'),
            'tanggal_jual'  => date('Y-m-d H:i:s'),
            'harga_akhir'   => $this->request->getPost('harga_akhir'),
        ]);

        // 2. Update status motor jadi 'terjual'
        $motorModel->update($motorId, ['status' => 'terjual']);

        // COMMIT TRANSACTION
        $db->transComplete();

        if ($db->transStatus() === FALSE) {
            // Jika gagal
            return redirect()->back()->with('error', 'Transaksi Gagal');
        }

        // Jika sukses, arahkan ke invoice
        return redirect()->to('kasir/invoice/' . $noInvoice)->with('success', 'Transaksi Berhasil');
    }

    public function invoice($noInvoice)
    {
        $saleModel = new SaleModel();
        
        // Menggunakan method dengan join untuk mendapatkan detail lengkap
        $data['transaksi'] = $saleModel->getInvoiceDetail($noInvoice);

        if (!$data['transaksi']) {
            return redirect()->to('kasir/dashboard')->with('error', 'Invoice tidak ditemukan');
        }

        return view('kasir/transaksi/invoice', $data);
    }
}

<?php

namespace App\Controllers\Gudang;

use App\Controllers\BaseController;
use App\Models\MotorcycleModel;

class MotorMasukController extends BaseController
{
    public function new()
    {
        return view('gudang/motor/input');
    }

    public function create()
    {
        // Validasi input
        $validation = \Config\Services::validation();
        $validation->setRules([
            'plat_nomor' => 'required|is_unique[motorcycles.plat_nomor]',
            'merk'       => 'required',
            'tipe'       => 'required',
            'warna'      => 'required',
            'tahun'      => 'required|numeric|min_length[4]|max_length[4]',
            'harga_beli' => 'required|numeric',
            'harga_jual' => 'required|numeric',
            'foto'       => 'uploaded[foto]|max_size[foto,5120]|is_image[foto]|mime_in[foto,image/jpg,image/jpeg,image/gif,image/png]',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $model = new MotorcycleModel();
        $fotoFile = $this->request->getFile('foto');
        $fotoName = null;

        // Upload foto jika ada
        if ($fotoFile && $fotoFile->isValid() && !$fotoFile->hasMoved()) {
            $newName = $fotoFile->getRandomName();
            $fotoFile->move(WRITEPATH . 'uploads/motorcycles', $newName);
            $fotoName = $newName;
        }
        
        $dataMotor = [
            'plat_nomor'    => $this->request->getPost('plat_nomor'),
            'merk'          => $this->request->getPost('merk'),
            'tipe'          => $this->request->getPost('tipe'),
            'warna'         => $this->request->getPost('warna'),
            'tahun'         => $this->request->getPost('tahun'),
            'harga_beli'    => $this->request->getPost('harga_beli'),
            'harga_jual'    => $this->request->getPost('harga_jual'),
            'status'        => 'tersedia', // Default status
            'tanggal_masuk' => date('Y-m-d'),
            'foto'          => $fotoName,
        ];

        // Tambahkan sumber_pembelian jika ada
        if ($this->request->getPost('sumber_pembelian')) {
            $dataMotor['sumber_pembelian'] = $this->request->getPost('sumber_pembelian');
        }

        $model->save($dataMotor);
        
        return redirect()->to('gudang/motor')->with('success', 'Data Motor Masuk Berhasil Disimpan');
    }
}

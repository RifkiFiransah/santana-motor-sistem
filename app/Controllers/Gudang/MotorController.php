<?php

namespace App\Controllers\Gudang;

use App\Controllers\BaseController;
use App\Models\MotorcycleModel;

class MotorController extends BaseController
{
    protected $motorModel;

    public function __construct()
    {
        $this->motorModel = new MotorcycleModel();
    }

    public function index()
    {
        // Menampilkan semua motor untuk dipilih dan diupdate
        $status = $this->request->getGet('status');
        $search = $this->request->getGet('search');
        $merk = $this->request->getGet('merk');

        $query = $this->motorModel;

        if (!empty($search)) {
            $query->groupStart()
                ->like('plat_nomor', $search)
                ->orLike('merk', $search)
                ->orLike('tipe', $search)
                ->orLike('warna', $search)
                ->groupEnd();
        }

        if (!empty($merk)) {
            $query->where('merk', $merk);
        }

        if (!empty($status)) {
            $query->where('status', $status);
        }

        $data['motors'] = $query->findAll();
        $data['status'] = $status;
        $data['search'] = $search;
        $data['merk'] = $merk;
        $data['merks'] = $this->motorModel->getDistinctValues('merk');

        return view('gudang/motor/index', $data);
    }

    public function catalog()
    {
        // Katalog motor dengan filter yang user-friendly
        $search = $this->request->getGet('search');
        $merk = $this->request->getGet('merk');
        $warna = $this->request->getGet('warna');
        $tahun = $this->request->getGet('tahun');
        $status = $this->request->getGet('status');
        $hargaMin = $this->request->getGet('harga_min');
        $hargaMax = $this->request->getGet('harga_max');

        $query = $this->motorModel;

        if (!empty($search)) {
            $query->groupStart()
                ->like('plat_nomor', $search)
                ->orLike('merk', $search)
                ->orLike('tipe', $search)
                ->orLike('warna', $search)
                ->groupEnd();
        }

        if (!empty($merk)) {
            $query->where('merk', $merk);
        }

        if (!empty($warna)) {
            $query->where('warna', $warna);
        }

        if (!empty($tahun)) {
            $query->where('tahun', $tahun);
        }

        if (!empty($status)) {
            $query->where('status', $status);
        }

        if (!empty($hargaMin)) {
            $query->where('harga_jual >=', (int)$hargaMin);
        }

        if (!empty($hargaMax)) {
            $query->where('harga_jual <=', (int)$hargaMax);
        }

        $data['motors'] = $query->orderBy('created_at', 'DESC')->findAll();
        $data['merks'] = $this->motorModel->getDistinctValues('merk');
        $data['warnas'] = $this->motorModel->getDistinctValues('warna');
        $data['tahuns'] = $this->motorModel->getDistinctValues('tahun', [], 'DESC');
        $data['statuses'] = [['status' => 'tersedia'], ['status' => 'terjual']];
        $data['search'] = $search;
        $data['merk'] = $merk;
        $data['warna'] = $warna;
        $data['tahun'] = $tahun;
        $data['status'] = $status;
        $data['harga_min'] = $hargaMin;
        $data['harga_max'] = $hargaMax;

        return view('gudang/motor/catalog', $data);
    }


    public function show($id)
    {
        $data['motor'] = $this->motorModel->find($id);

        if (!$data['motor']) {
            return redirect()->to('gudang/motor')->with('error', 'Motor tidak ditemukan');
        }

        return view('gudang/motor/detail', $data);
    }

    public function edit($id)
    {
        $data['motor'] = $this->motorModel->find($id);

        if (!$data['motor']) {
            return redirect()->to('gudang/motor')->with('error', 'Motor tidak ditemukan');
        }

        return view('gudang/motor/edit', $data);
    }

    public function update($id)
    {
        $motor = $this->motorModel->find($id);

        if (!$motor) {
            return redirect()->to('gudang/motor')->with('error', 'Motor tidak ditemukan');
        }

        // Validasi
        $validation = \Config\Services::validation();
        $validation->setRules([
            'plat_nomor' => 'required',
            'merk'       => 'required',
            'tipe'       => 'required',
            'warna'      => 'required',
            'tahun'      => 'required|numeric|min_length[4]|max_length[4]',
            'harga_beli' => 'required|numeric',
            'harga_jual' => 'required|numeric',
            'foto'       => 'permit_empty|max_size[foto,5120]|is_image[foto]|mime_in[foto,image/jpg,image/jpeg,image/gif,image/png]',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $updateData = [
            'plat_nomor'    => $this->request->getPost('plat_nomor'),
            'merk'          => $this->request->getPost('merk'),
            'tipe'          => $this->request->getPost('tipe'),
            'warna'         => $this->request->getPost('warna'),
            'tahun'         => $this->request->getPost('tahun'),
            'harga_beli'    => $this->request->getPost('harga_beli'),
            'harga_jual'    => $this->request->getPost('harga_jual'),
        ];

        // Handle upload foto baru
        $fotoFile = $this->request->getFile('foto');
        if ($fotoFile && $fotoFile->isValid() && !$fotoFile->hasMoved()) {
            // Hapus foto lama jika ada
            if ($motor['foto'] && file_exists(WRITEPATH . 'uploads/motorcycles/' . $motor['foto'])) {
                unlink(WRITEPATH . 'uploads/motorcycles/' . $motor['foto']);
            }

            // Upload foto baru
            $newName = $fotoFile->getRandomName();
            $fotoFile->move(WRITEPATH . 'uploads/motorcycles', $newName);
            $updateData['foto'] = $newName;
        }

        // Jika ada field tambahan seperti sumber_pembelian
        if ($this->request->getPost('sumber_pembelian')) {
            $updateData['sumber_pembelian'] = $this->request->getPost('sumber_pembelian');
        }

        $this->motorModel->update($id, $updateData);

        return redirect()->to('gudang/motor')->with('success', 'Data motor berhasil diupdate');
    }

    public function delete($id)
    {
        $motor = $this->motorModel->find($id);

        if (!$motor) {
            return redirect()->to('gudang/motor')->with('error', 'Motor tidak ditemukan');
        }

        // Hapus foto jika ada
        if ($motor['foto'] && file_exists(WRITEPATH . 'uploads/motorcycles/' . $motor['foto'])) {
            unlink(WRITEPATH . 'uploads/motorcycles/' . $motor['foto']);
        }

        // Hapus data motor
        $this->motorModel->delete($id);

        return redirect()->to('gudang/motor')->with('success', 'Data motor berhasil dihapus');
    }
}

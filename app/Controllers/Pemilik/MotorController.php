<?php

namespace App\Controllers\Pemilik;

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
        // Filter berdasarkan status jika ada
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

        return view('pemilik/motor/index', $data);
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

        return view('pemilik/motor/catalog', $data);
    }


    public function show($id)
    {
        $data['motor'] = $this->motorModel->find($id);
        
        if (!$data['motor']) {
            return redirect()->to('pemilik/motor')->with('error', 'Motor tidak ditemukan');
        }

        return view('pemilik/motor/detail', $data);
    }

    public function delete($id)
    {
        // Validasi: hanya bisa hapus motor yang belum terjual
        $motor = $this->motorModel->find($id);
        
        if (!$motor) {
            return redirect()->back()->with('error', 'Motor tidak ditemukan');
        }

        if ($motor['status'] === 'terjual') {
            return redirect()->back()->with('error', 'Tidak dapat menghapus motor yang sudah terjual');
        }

        // Hapus foto jika ada
        if ($motor['foto'] && file_exists(WRITEPATH . 'uploads/motorcycles/' . $motor['foto'])) {
            unlink(WRITEPATH . 'uploads/motorcycles/' . $motor['foto']);
        }

        $this->motorModel->delete($id);
        return redirect()->to('pemilik/motor')->with('success', 'Data motor berhasil dihapus');
    }
}

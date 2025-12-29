<?php

namespace App\Controllers\Kasir;

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
        // Kasir hanya bisa melihat motor yang tersedia
        // Filter berdasarkan pencarian jika ada
        $search = $this->request->getGet('search');
        $merk = $this->request->getGet('merk');
        
        $query = $this->motorModel->where('status', 'tersedia');

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

        $data['motors'] = $query->findAll();
        $data['search'] = $search;
        $data['merk'] = $merk;
        $data['merks'] = $this->motorModel->getDistinctValues('merk', ['status' => 'tersedia']);

        return view('kasir/motor/index', $data);
    }

    public function catalog()
    {
        // Katalog motor dengan filter yang user-friendly
        $search = $this->request->getGet('search');
        $merk = $this->request->getGet('merk');
        $warna = $this->request->getGet('warna');
        $tahun = $this->request->getGet('tahun');
        $hargaMin = $this->request->getGet('harga_min');
        $hargaMax = $this->request->getGet('harga_max');

        $query = $this->motorModel->where('status', 'tersedia');

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

        if (!empty($hargaMin)) {
            $query->where('harga_jual >=', (int)$hargaMin);
        }

        if (!empty($hargaMax)) {
            $query->where('harga_jual <=', (int)$hargaMax);
        }

        $data['motors'] = $query->orderBy('created_at', 'DESC')->findAll();
        $data['merks'] = $this->motorModel->getDistinctValues('merk', ['status' => 'tersedia']);
        $data['warnas'] = $this->motorModel->getDistinctValues('warna', ['status' => 'tersedia']);
        $data['tahuns'] = $this->motorModel->getDistinctValues('tahun', ['status' => 'tersedia'], 'DESC');
        $data['search'] = $search;
        $data['merk'] = $merk;
        $data['warna'] = $warna;
        $data['tahun'] = $tahun;
        $data['harga_min'] = $hargaMin;
        $data['harga_max'] = $hargaMax;

        return view('kasir/motor/catalog', $data);
    }

    public function show($id)
    {
        $motor = $this->motorModel->find($id);
        
        if (!$motor) {
            return redirect()->to('kasir/motor')->with('error', 'Motor tidak ditemukan');
        }

        // Kasir hanya bisa melihat detail motor yang tersedia
        if ($motor['status'] !== 'tersedia') {
            return redirect()->to('kasir/motor')->with('error', 'Motor tidak tersedia');
        }

        $data['motor'] = $motor;

        return view('kasir/motor/detail', $data);
    }
}

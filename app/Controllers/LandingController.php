<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MotorcycleModel;

class LandingController extends BaseController
{
    protected $motorModel;

    public function __construct()
    {
        $this->motorModel = new MotorcycleModel();
    }

    public function index()
    {
        // Ambil motor featured (tersedia) untuk hero dan gallery
        $data['featured_motors'] = $this->motorModel
            ->where('status', 'tersedia')
            ->orderBy('created_at', 'DESC')
            ->limit(8)
            ->findAll();

        // Statistik untuk about section
        $data['total_motor'] = $this->motorModel->where('status', 'tersedia')->countAllResults();
        $data['merks'] = $this->motorModel->getDistinctValues('merk', ['status' => 'tersedia']);
        
        return view('landing/index', $data);
    }

    public function catalog()
    {
        // Katalog motor dengan filter
        $search = $this->request->getGet('search');
        $merk = $this->request->getGet('merk');
        $tahun = $this->request->getGet('tahun');

        $query = $this->motorModel->where('status', 'tersedia');

        if (!empty($search)) {
            $query->groupStart()
                ->like('merk', $search)
                ->orLike('tipe', $search)
                ->orLike('warna', $search)
                ->groupEnd();
        }

        if (!empty($merk)) {
            $query->where('merk', $merk);
        }

        if (!empty($tahun)) {
            $query->where('tahun', $tahun);
        }

        $data['motors'] = $query->orderBy('created_at', 'DESC')->findAll();
        $data['merks'] = $this->motorModel->getDistinctValues('merk', ['status' => 'tersedia']);
        $data['tahuns'] = $this->motorModel->getDistinctValues('tahun', ['status' => 'tersedia'], 'DESC');
        $data['search'] = $search;
        $data['merk'] = $merk;
        $data['tahun'] = $tahun;

        return view('landing/catalog', $data);
    }

    public function detail($id)
    {
        $motor = $this->motorModel->find($id);
        
        if (!$motor || $motor['status'] !== 'tersedia') {
            return redirect()->to('/catalog')->with('error', 'Motor tidak ditemukan atau tidak tersedia');
        }

        $data['motor'] = $motor;
        
        // Motor terkait (same merk)
        $data['related_motors'] = $this->motorModel
            ->where('status', 'tersedia')
            ->where('merk', $motor['merk'])
            ->where('id !=', $id)
            ->limit(4)
            ->findAll();

        return view('landing/detail', $data);
    }

    public function about()
    {
        return view('landing/about');
    }

    public function contact()
    {
        return view('landing/contact');
    }

    public function submitContact()
    {
        // Validasi form
        $validation = \Config\Services::validation();
        
        $validation->setRules([
            'name' => 'required|min_length[3]',
            'email' => 'required|valid_email',
            'message' => 'required|min_length[10]'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        // Di sini bisa disimpan ke database atau kirim email
        // Untuk sekarang, hanya return success message
        
        return redirect()->to('/contact')->with('success', 'Terima kasih! Pesan Anda telah kami terima. Kami akan menghubungi Anda segera.');
    }
}

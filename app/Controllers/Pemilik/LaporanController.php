<?php

namespace App\Controllers\Pemilik;

use App\Controllers\BaseController;
use App\Models\SaleModel;
use App\Models\StockOpnameModel;
use App\Models\MotorcycleModel;
use App\Libraries\PdfGenerator;
use App\Libraries\ExcelGenerator;

class LaporanController extends BaseController
{
    public function pembelian()
    {
        $model = new MotorcycleModel();
        // Logic filter tanggal
        $tglAwal = $this->request->getGet('tgl_awal');
        $tglAkhir = $this->request->getGet('tgl_akhir');

        if ($tglAwal && $tglAkhir) {
            $data['laporan'] = $model->where('tanggal_masuk >=', $tglAwal)
                                     ->where('tanggal_masuk <=', $tglAkhir)
                                     ->orderBy('tanggal_masuk', 'DESC')
                                     ->findAll();
        } else {
            $data['laporan'] = $model->orderBy('tanggal_masuk', 'DESC')
                                     ->findAll(); // Default
        }

        $data['tgl_awal'] = $tglAwal;
        $data['tgl_akhir'] = $tglAkhir;

        return view('pemilik/laporan/pembelian', $data);
    }

    public function pembelianPdf()
    {
        $model = new MotorcycleModel();
        $tglAwal = $this->request->getGet('tgl_awal');
        $tglAkhir = $this->request->getGet('tgl_akhir');

        if ($tglAwal && $tglAkhir) {
            $laporan = $model->where('tanggal_masuk >=', $tglAwal)
                            ->where('tanggal_masuk <=', $tglAkhir)
                            ->orderBy('tanggal_masuk', 'DESC')
                            ->findAll();
        } else {
            $laporan = $model->orderBy('tanggal_masuk', 'DESC')->findAll();
        }

        $pdf = new PdfGenerator();
        $pdf->generateLaporanPembelian($laporan, $tglAwal, $tglAkhir);
    }

    public function pembelianExcel()
    {
        $model = new MotorcycleModel();
        $tglAwal = $this->request->getGet('tgl_awal');
        $tglAkhir = $this->request->getGet('tgl_akhir');

        if ($tglAwal && $tglAkhir) {
            $laporan = $model->where('tanggal_masuk >=', $tglAwal)
                            ->where('tanggal_masuk <=', $tglAkhir)
                            ->orderBy('tanggal_masuk', 'DESC')
                            ->findAll();
        } else {
            $laporan = $model->orderBy('tanggal_masuk', 'DESC')->findAll();
        }

        $excel = new ExcelGenerator();
        $excel->generateLaporanPembelian($laporan, $tglAwal, $tglAkhir);
    }

    public function penjualan()
    {
        $model = new SaleModel();
        $tglAwal = $this->request->getGet('tgl_awal');
        $tglAkhir = $this->request->getGet('tgl_akhir');

        $data['laporan'] = $model->getLaporanPenjualan($tglAwal, $tglAkhir);
        $data['tgl_awal'] = $tglAwal;
        $data['tgl_akhir'] = $tglAkhir;

        return view('pemilik/laporan/penjualan', $data);
    }

    public function penjualanPdf()
    {
        $model = new SaleModel();
        $tglAwal = $this->request->getGet('tgl_awal');
        $tglAkhir = $this->request->getGet('tgl_akhir');

        $laporan = $model->getLaporanPenjualan($tglAwal, $tglAkhir);

        $pdf = new PdfGenerator();
        $pdf->generateLaporanPenjualan($laporan, $tglAwal, $tglAkhir);
    }

    public function penjualanExcel()
    {
        $model = new SaleModel();
        $tglAwal = $this->request->getGet('tgl_awal');
        $tglAkhir = $this->request->getGet('tgl_akhir');

        $laporan = $model->getLaporanPenjualan($tglAwal, $tglAkhir);

        $excel = new ExcelGenerator();
        $excel->generateLaporanPenjualan($laporan, $tglAwal, $tglAkhir);
    }

    public function stokOpname()
    {
        $model = new StockOpnameModel();
        // Menggunakan method dengan join untuk mendapatkan nama petugas
        $data['laporan'] = $model->getLaporanStokOpname();

        return view('pemilik/laporan/stok_opname', $data);
    }

    public function stokOpnamePdf()
    {
        $model = new StockOpnameModel();
        $laporan = $model->getLaporanStokOpname();

        $pdf = new PdfGenerator();
        $pdf->generateLaporanStokOpname($laporan);
    }

    public function stokOpnameExcel()
    {
        $model = new StockOpnameModel();
        $laporan = $model->getLaporanStokOpname();

        $excel = new ExcelGenerator();
        $excel->generateLaporanStokOpname($laporan);
    }
}

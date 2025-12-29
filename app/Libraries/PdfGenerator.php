<?php

namespace App\Libraries;

class PdfGenerator
{
    public function generate($html, $filename = 'document.pdf', $orientation = 'P')
    {
        // Load TCPDF
        $pdf = new \TCPDF($orientation, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        // Set document information
        $pdf->SetCreator('Santana Motor Sistem');
        $pdf->SetAuthor('Santana Motor');
        $pdf->SetTitle($filename);

        // Remove default header/footer
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);

        // Set margins
        $pdf->SetMargins(15, 15, 15);
        $pdf->SetAutoPageBreak(TRUE, 15);

        // Add a page
        $pdf->AddPage();

        // Set font
        $pdf->SetFont('helvetica', '', 10);

        // Print text using writeHTMLCell()
        $pdf->writeHTML($html, true, false, true, false, '');

        // Close and output PDF document
        $pdf->Output($filename, 'D');
    }

    public function generateLaporanPembelian($data, $tgl_awal = null, $tgl_akhir = null)
    {
        $html = '
        <style>
            h2 { text-align: center; color: #333; }
            table { width: 100%; border-collapse: collapse; margin-top: 20px; }
            th { background-color: #4CAF50; color: white; padding: 10px; text-align: left; border: 1px solid #ddd; }
            td { padding: 8px; border: 1px solid #ddd; }
            tr:nth-child(even) { background-color: #f2f2f2; }
            .total-row { background-color: #d4edda; font-weight: bold; }
            .text-right { text-align: right; }
            .text-center { text-align: center; }
        </style>
        
        <h2>LAPORAN PEMBELIAN MOTOR</h2>
        <h3 style="text-align: center;">CV. SANTANA MOTOR</h3>';
        
        if ($tgl_awal && $tgl_akhir) {
            $html .= '<p style="text-align: center;">Periode: ' . date('d/m/Y', strtotime($tgl_awal)) . ' - ' . date('d/m/Y', strtotime($tgl_akhir)) . '</p>';
        }
        
        $html .= '
        <table>
            <thead>
                <tr>
                    <th class="th-no">No</th>
                    <th>Plat Nomor</th>
                    <th>Merk/Tipe</th>
                    <th>Warna</th>
                    <th>Tahun</th>
                    <th>Harga Beli</th>
                    <th>Harga Jual</th>
                    <th>Tanggal Masuk</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>';
        
        $total_beli = 0;
        $no = 1;
        
        foreach ($data as $motor) {
            $total_beli += $motor['harga_beli'];
            $status = $motor['status'] === 'tersedia' ? 'Tersedia' : 'Terjual';
            
            $html .= '
                <tr>
                    <td>' . $no++ . '</td>
                    <td>' . esc($motor['plat_nomor']) . '</td>
                    <td>' . esc($motor['merk']) . ' ' . esc($motor['tipe']) . '</td>
                    <td>' . esc($motor['warna']) . '</td>
                    <td>' . esc($motor['tahun']) . '</td>
                    <td>Rp ' . number_format($motor['harga_beli'], 0, ',', '.') . '</td>
                    <td>Rp ' . number_format($motor['harga_jual'], 0, ',', '.') . '</td>
                    <td>' . date('d/m/Y', strtotime($motor['tanggal_masuk'])) . '</td>
                    <td>' . $status . '</td>
                </tr>';
        }
        
        $html .= '
                <tr class="total-row">
                    <td colspan="5" class="text-right">TOTAL PEMBELIAN:</td>
                    <td colspan="4">Rp ' . number_format($total_beli, 0, ',', '.') . '</td>
                </tr>
            </tbody>
        </table>
        
        <p style="margin-top: 30px; font-size: 9px;">Dicetak pada: ' . date('d/m/Y H:i:s') . '</p>';
        
        $filename = 'Laporan_Pembelian_' . date('Ymd_His') . '.pdf';
        $this->generate($html, $filename, 'L');
    }

    public function generateLaporanPenjualan($data, $tgl_awal = null, $tgl_akhir = null)
    {
        $html = '
        <style>
            h2 { text-align: center; color: #333; }
            table { width: 100%; border-collapse: collapse; margin-top: 20px; }
            th { background-color: #4CAF50; color: white; padding: 10px; text-align: left; border: 1px solid #ddd; }
            td { padding: 8px; border: 1px solid #ddd; }
            tr:nth-child(even) { background-color: #f2f2f2; }
            .total-row { background-color: #d4edda; font-weight: bold; }
            .text-right { text-align: right; }
        </style>
        
        <h2>LAPORAN PENJUALAN MOTOR</h2>
        <h3 style="text-align: center;">CV. SANTANA MOTOR</h3>';
        
        if ($tgl_awal && $tgl_akhir) {
            $html .= '<p style="text-align: center;">Periode: ' . date('d/m/Y', strtotime($tgl_awal)) . ' - ' . date('d/m/Y', strtotime($tgl_akhir)) . '</p>';
        }
        
        $html .= '
        <table>
            <thead>
                <tr>
                    <th class="th-no">No</th>
                    <th>No Invoice</th>
                    <th>Tanggal Jual</th>
                    <th>Plat Nomor</th>
                    <th>Merk/Tipe</th>
                    <th>Pembeli</th>
                    <th>Kasir</th>
                    <th>Harga Akhir</th>
                </tr>
            </thead>
            <tbody>';
        
        $total_penjualan = 0;
        $no = 1;
        
        foreach ($data as $sale) {
            $total_penjualan += $sale['harga_akhir'];
            $html .= '
                <tr>
                    <td>' . $no++ . '</td>
                    <td>' . esc($sale['no_invoice']) . '</td>
                    <td>' . date('d/m/Y H:i', strtotime($sale['tanggal_jual'])) . '</td>
                    <td>' . esc($sale['plat_nomor']) . '</td>
                    <td>' . esc($sale['merk']) . ' ' . esc($sale['tipe'] ?? '') . '</td>
                    <td>' . esc($sale['nama_pembeli']) . '</td>
                    <td>' . esc($sale['nama_kasir']) . '</td>
                    <td>Rp ' . number_format($sale['harga_akhir'], 0, ',', '.') . '</td>
                </tr>';
        }
        
        $html .= '
                <tr class="total-row">
                    <td colspan="7" class="text-right">TOTAL PENJUALAN:</td>
                    <td>Rp ' . number_format($total_penjualan, 0, ',', '.') . '</td>
                </tr>
            </tbody>
        </table>
        
        <p style="margin-top: 30px; font-size: 9px;">Dicetak pada: ' . date('d/m/Y H:i:s') . '</p>';
        
        $filename = 'Laporan_Penjualan_' . date('Ymd_His') . '.pdf';
        $this->generate($html, $filename, 'L');
    }

    public function generateLaporanStokOpname($data)
    {
        $html = '
        <style>
            h2 { text-align: center; color: #333; }
            table { width: 100%; border-collapse: collapse; margin-top: 20px; }
            th { background-color: #4CAF50; color: white; padding: 10px; text-align: left; border: 1px solid #ddd; }
            td { padding: 8px; border: 1px solid #ddd; }
            tr:nth-child(even) { background-color: #f2f2f2; }
            .th-no { width: 5%; }
            .th-catatan { width: 33%; }
            .th-jumlah { width: 10%; }
        </style>
        
        <h2>LAPORAN STOK OPNAME</h2>
        <h3 style="text-align: center;">CV. SANTANA MOTOR</h3>
        
        <table>
            <thead>
                <tr>
                    <th class="th-no">No</th>
                    <th>Tanggal</th>
                    <th>Petugas Gudang</th>
                    <th class="th-jumlah">Jumlah Sistem</th>
                    <th class="th-jumlah">Jumlah Fisik</th>
                    <th>Selisih</th>
                    <th class="th-catatan">Catatan</th>
                </tr>
            </thead>
            <tbody>';
        
        $no = 1;
        
        foreach ($data as $opname) {
            $selisih = $opname['jumlah_fisik'] - $opname['jumlah_sistem'];
            $status = $selisih === 0 ? 'Sesuai' : ($selisih > 0 ? 'Lebih' : 'Kurang');
            
            $html .= '
                <tr>
                    <td class="th-no">' . $no++ . '</td>
                    <td>' . date('d/m/Y', strtotime($opname['tanggal_opname'])) . '</td>
                    <td>' . esc($opname['nama_petugas']) . '</td>
                    <td class="th-jumlah">' . esc($opname['jumlah_sistem']) . '</td>
                    <td class="th-jumlah">' . esc($opname['jumlah_fisik']) . '</td>
                    <td>' . ($selisih > 0 ? '+' : '') . $selisih . ' (' . $status . ')</td>
                    <td class="th-catatan">' . esc($opname['catatan'] ?? '-') . '</td>
                </tr>';
        }
        
        $html .= '
            </tbody>
        </table>
        
        <p style="margin-top: 30px; font-size: 9px;">Dicetak pada: ' . date('d/m/Y H:i:s') . '</p>';
        
        $filename = 'Laporan_Stok_Opname_' . date('Ymd_His') . '.pdf';
        $this->generate($html, $filename);
    }
}

<?php

namespace App\Libraries;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;

class ExcelGenerator
{
    public function generateLaporanPembelian($data, $tgl_awal = null, $tgl_akhir = null)
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set judul
        $sheet->setCellValue('A1', 'LAPORAN PEMBELIAN MOTOR');
        $sheet->mergeCells('A1:J1');
        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(16);
        $sheet->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        $sheet->setCellValue('A2', 'CV. SANTANA MOTOR');
        $sheet->mergeCells('A2:J2');
        $sheet->getStyle('A2')->getFont()->setBold(true)->setSize(12);
        $sheet->getStyle('A2')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        if ($tgl_awal && $tgl_akhir) {
            $periode = 'Periode: ' . date('d/m/Y', strtotime($tgl_awal)) . ' - ' . date('d/m/Y', strtotime($tgl_akhir));
            $sheet->setCellValue('A3', $periode);
            $sheet->mergeCells('A3:J3');
            $sheet->getStyle('A3')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $headerRow = 5;
        } else {
            $headerRow = 4;
        }

        // Header tabel
        $headers = ['No', 'Plat Nomor', 'Merk', 'Tipe', 'Warna', 'Tahun', 'Harga Beli', 'Harga Jual', 'Tanggal Masuk', 'Status'];
        $col = 'A';
        foreach ($headers as $header) {
            $sheet->setCellValue($col . $headerRow, $header);
            $sheet->getStyle($col . $headerRow)->getFont()->setBold(true);
            $sheet->getStyle($col . $headerRow)->getFill()
                ->setFillType(Fill::FILL_SOLID)
                ->getStartColor()->setARGB('FF4CAF50');
            $sheet->getStyle($col . $headerRow)->getFont()->getColor()->setARGB('FFFFFFFF');
            $col++;
        }

        // Data
        $row = $headerRow + 1;
        $total_beli = 0;
        $no = 1;

        foreach ($data as $motor) {
            $total_beli += $motor['harga_beli'];
            
            $sheet->setCellValue('A' . $row, $no++);
            $sheet->setCellValue('B' . $row, $motor['plat_nomor']);
            $sheet->setCellValue('C' . $row, $motor['merk']);
            $sheet->setCellValue('D' . $row, $motor['tipe']);
            $sheet->setCellValue('E' . $row, $motor['warna']);
            $sheet->setCellValue('F' . $row, $motor['tahun']);
            $sheet->setCellValue('G' . $row, $motor['harga_beli']);
            $sheet->setCellValue('H' . $row, $motor['harga_jual']);
            $sheet->setCellValue('I' . $row, date('d/m/Y', strtotime($motor['tanggal_masuk'])));
            $sheet->setCellValue('J' . $row, $motor['status'] === 'tersedia' ? 'Tersedia' : 'Terjual');
            
            // Format currency
            $sheet->getStyle('G' . $row)->getNumberFormat()->setFormatCode('#,##0');
            $sheet->getStyle('H' . $row)->getNumberFormat()->setFormatCode('#,##0');
            
            $row++;
        }

        // Total
        $sheet->setCellValue('A' . $row, 'TOTAL PEMBELIAN:');
        $sheet->mergeCells('A' . $row . ':F' . $row);
        $sheet->getStyle('A' . $row)->getFont()->setBold(true);
        $sheet->getStyle('A' . $row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);
        $sheet->setCellValue('G' . $row, $total_beli);
        $sheet->getStyle('G' . $row)->getNumberFormat()->setFormatCode('#,##0');
        $sheet->getStyle('G' . $row)->getFont()->setBold(true);
        $sheet->getStyle('A' . $row . ':J' . $row)->getFill()
            ->setFillType(Fill::FILL_SOLID)
            ->getStartColor()->setARGB('FFD4EDDA');

        // Border untuk semua sel yang ada data
        $styleArray = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                ],
            ],
        ];
        $sheet->getStyle('A' . $headerRow . ':J' . $row)->applyFromArray($styleArray);

        // Auto size columns
        foreach (range('A', 'J') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        // Save file
        $filename = 'Laporan_Pembelian_' . date('Ymd_His') . '.xlsx';
        $writer = new Xlsx($spreadsheet);
        
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        
        $writer->save('php://output');
        exit;
    }

    public function generateLaporanPenjualan($data, $tgl_awal = null, $tgl_akhir = null)
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set judul
        $sheet->setCellValue('A1', 'LAPORAN PENJUALAN MOTOR');
        $sheet->mergeCells('A1:H1');
        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(16);
        $sheet->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        $sheet->setCellValue('A2', 'CV. SANTANA MOTOR');
        $sheet->mergeCells('A2:H2');
        $sheet->getStyle('A2')->getFont()->setBold(true)->setSize(12);
        $sheet->getStyle('A2')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        if ($tgl_awal && $tgl_akhir) {
            $periode = 'Periode: ' . date('d/m/Y', strtotime($tgl_awal)) . ' - ' . date('d/m/Y', strtotime($tgl_akhir));
            $sheet->setCellValue('A3', $periode);
            $sheet->mergeCells('A3:H3');
            $sheet->getStyle('A3')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $headerRow = 5;
        } else {
            $headerRow = 4;
        }

        // Header tabel
        $headers = ['No', 'No Invoice', 'Tanggal Jual', 'Plat Nomor', 'Merk/Tipe', 'Pembeli', 'Kasir', 'Harga Akhir'];
        $col = 'A';
        foreach ($headers as $header) {
            $sheet->setCellValue($col . $headerRow, $header);
            $sheet->getStyle($col . $headerRow)->getFont()->setBold(true);
            $sheet->getStyle($col . $headerRow)->getFill()
                ->setFillType(Fill::FILL_SOLID)
                ->getStartColor()->setARGB('FF4CAF50');
            $sheet->getStyle($col . $headerRow)->getFont()->getColor()->setARGB('FFFFFFFF');
            $col++;
        }

        // Data
        $row = $headerRow + 1;
        $total_penjualan = 0;
        $no = 1;

        foreach ($data as $sale) {
            $total_penjualan += $sale['harga_akhir'];
            
            $sheet->setCellValue('A' . $row, $no++);
            $sheet->setCellValue('B' . $row, $sale['no_invoice']);
            $sheet->setCellValue('C' . $row, date('d/m/Y H:i', strtotime($sale['tanggal_jual'])));
            $sheet->setCellValue('D' . $row, $sale['plat_nomor']);
            $sheet->setCellValue('E' . $row, $sale['merk'] . ' ' . ($sale['tipe'] ?? ''));
            $sheet->setCellValue('F' . $row, $sale['nama_pembeli']);
            $sheet->setCellValue('G' . $row, $sale['nama_kasir']);
            $sheet->setCellValue('H' . $row, $sale['harga_akhir']);
            
            // Format currency
            $sheet->getStyle('H' . $row)->getNumberFormat()->setFormatCode('#,##0');
            
            $row++;
        }

        // Total
        $sheet->setCellValue('A' . $row, 'TOTAL PENJUALAN:');
        $sheet->mergeCells('A' . $row . ':G' . $row);
        $sheet->getStyle('A' . $row)->getFont()->setBold(true);
        $sheet->getStyle('A' . $row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);
        
        $sheet->setCellValue('H' . $row, $total_penjualan);
        $sheet->getStyle('H' . $row)->getNumberFormat()->setFormatCode('#,##0');
        $sheet->getStyle('H' . $row)->getFont()->setBold(true);
        
        $sheet->getStyle('A' . $row . ':H' . $row)->getFill()
            ->setFillType(Fill::FILL_SOLID)
            ->getStartColor()->setARGB('FFD4EDDA');

        // Border
        $styleArray = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                ],
            ],
        ];
        $sheet->getStyle('A' . $headerRow . ':H' . $row)->applyFromArray($styleArray);

        // Auto size columns
        foreach (range('A', 'H') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        // Save file
        $filename = 'Laporan_Penjualan_' . date('Ymd_His') . '.xlsx';
        $writer = new Xlsx($spreadsheet);
        
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        
        $writer->save('php://output');
        exit;
    }

    public function generateLaporanStokOpname($data)
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set judul
        $sheet->setCellValue('A1', 'LAPORAN STOK OPNAME');
        $sheet->mergeCells('A1:G1');
        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(16);
        $sheet->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        $sheet->setCellValue('A2', 'CV. SANTANA MOTOR');
        $sheet->mergeCells('A2:G2');
        $sheet->getStyle('A2')->getFont()->setBold(true)->setSize(12);
        $sheet->getStyle('A2')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        $headerRow = 4;

        // Header tabel
        $headers = ['No', 'Tanggal', 'Petugas Gudang', 'Jumlah Sistem', 'Jumlah Fisik', 'Selisih', 'Catatan'];
        $col = 'A';
        foreach ($headers as $header) {
            $sheet->setCellValue($col . $headerRow, $header);
            $sheet->getStyle($col . $headerRow)->getFont()->setBold(true);
            $sheet->getStyle($col . $headerRow)->getFill()
                ->setFillType(Fill::FILL_SOLID)
                ->getStartColor()->setARGB('FF4CAF50');
            $sheet->getStyle($col . $headerRow)->getFont()->getColor()->setARGB('FFFFFFFF');
            $col++;
        }

        // Data
        $row = $headerRow + 1;
        $no = 1;

        foreach ($data as $opname) {
            $selisih = $opname['jumlah_fisik'] - $opname['jumlah_sistem'];
            $status = $selisih === 0 ? 'Sesuai' : ($selisih > 0 ? 'Lebih' : 'Kurang');
            
            $sheet->setCellValue('A' . $row, $no++);
            $sheet->setCellValue('B' . $row, date('d/m/Y', strtotime($opname['tanggal_opname'])));
            $sheet->setCellValue('C' . $row, $opname['nama_petugas']);
            $sheet->setCellValue('D' . $row, $opname['jumlah_sistem']);
            $sheet->setCellValue('E' . $row, $opname['jumlah_fisik']);
            $sheet->setCellValue('F' . $row, ($selisih > 0 ? '+' : '') . $selisih . ' (' . $status . ')');
            $sheet->setCellValue('G' . $row, $opname['catatan'] ?? '-');
            
            $row++;
        }

        // Border
        $styleArray = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                ],
            ],
        ];
        $sheet->getStyle('A' . $headerRow . ':G' . ($row - 1))->applyFromArray($styleArray);

        // Auto size columns
        foreach (range('A', 'G') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        // Save file
        $filename = 'Laporan_Stok_Opname_' . date('Ymd_His') . '.xlsx';
        $writer = new Xlsx($spreadsheet);
        
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        
        $writer->save('php://output');
        exit;
    }
}

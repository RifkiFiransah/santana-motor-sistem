<?= $this->extend('layouts/main') ?>

<?= $this->section('styles') ?>
<style>
    @media print {
        .no-print {
            display: none !important;
        }
        #sidebar, header, footer {
            display: none !important;
        }
        #main {
            padding: 0 !important;
        }
        .page-content {
            padding: 0 !important;
        }
    }
    
    .invoice-box {
        max-width: 800px;
        margin: auto;
        padding: 30px;
        border: 1px solid #eee;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
        font-size: 16px;
        line-height: 24px;
        color: #555;
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="section no-print">
    <div class="mb-3">
        <button onclick="window.print()" class="btn btn-success">
            <i class="iconly-boldPaper-Download"></i> Cetak Invoice
        </button>
        <a href="<?= base_url('kasir/dashboard') ?>" class="btn btn-primary">
            <i class="iconly-boldHome"></i> Kembali ke Dashboard
        </a>
        <a href="<?= base_url('kasir/transaksi') ?>" class="btn btn-secondary">
            <i class="iconly-boldPlus"></i> Transaksi Baru
        </a>
    </div>
</section>

<section class="invoice-box">
    <div class="text-center mb-4">
        <h2>SANTANA MOTOR</h2>
        <p>Jl. Contoh Alamat No. 123, Jakarta<br>
        Telp: (021) 12345678 | Email: info@santanamotor.com</p>
        <hr>
    </div>

    <div class="mb-4">
        <h4>INVOICE PENJUALAN</h4>
        <table style="width: 100%;">
            <tr>
                <td><strong>No. Invoice:</strong></td>
                <td><?= esc($transaksi['no_invoice']) ?></td>
            </tr>
            <tr>
                <td><strong>Tanggal:</strong></td>
                <td><?= date('d/m/Y H:i', strtotime($transaksi['tanggal_jual'])) ?></td>
            </tr>
            <tr>
                <td><strong>Kasir:</strong></td>
                <td><?= esc($transaksi['nama_kasir']) ?></td>
            </tr>
        </table>
    </div>

    <hr>

    <div class="mb-4">
        <h5>Data Pembeli</h5>
        <table style="width: 100%;">
            <tr>
                <td width="150"><strong>Nama:</strong></td>
                <td><?= esc($transaksi['nama_pembeli']) ?></td>
            </tr>
            <tr>
                <td><strong>No. HP:</strong></td>
                <td><?= esc($transaksi['no_hp_pembeli']) ?></td>
            </tr>
        </table>
    </div>

    <hr>

    <div class="mb-4">
        <h5>Detail Motor</h5>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Plat Nomor</th>
                    <th>Merk/Tipe</th>
                    <th>Warna</th>
                    <th>Tahun</th>
                    <th>Harga</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><strong><?= esc($transaksi['plat_nomor']) ?></strong></td>
                    <td><?= esc($transaksi['merk']) ?> <?= esc($transaksi['tipe']) ?></td>
                    <td><?= esc($transaksi['warna']) ?></td>
                    <td><?= esc($transaksi['tahun']) ?></td>
                    <td class="text-end"><strong>Rp <?= number_format($transaksi['harga_akhir'], 0, ',', '.') ?></strong></td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="mb-4">
        <table style="width: 100%;">
            <tr>
                <td colspan="4" class="text-end"><h5>Total Harga:</h5></td>
                <td class="text-end"><h4 class="text-success">Rp <?= number_format($transaksi['harga_akhir'], 0, ',', '.') ?></h4></td>
            </tr>
        </table>
    </div>

    <hr>

    <div class="mt-5">
        <div class="row">
            <div class="col-6 text-center">
                <p>Pembeli</p>
                <br><br><br>
                <p>_____________________<br>
                <?= esc($transaksi['nama_pembeli']) ?></p>
            </div>
            <div class="col-6 text-center">
                <p>Penjual</p>
                <br><br><br>
                <p>_____________________<br>
                <?= esc($transaksi['nama_kasir']) ?></p>
            </div>
        </div>
    </div>

    <div class="mt-5 text-center">
        <small class="text-muted">
            Terima kasih atas kepercayaan Anda kepada Santana Motor<br>
            Invoice ini dicetak pada <?= date('d/m/Y H:i:s') ?>
        </small>
    </div>
</section>
<?= $this->endSection() ?>

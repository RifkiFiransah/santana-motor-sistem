<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<section class="section">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Laporan Penjualan Motor</h4>
        </div>
        <div class="card-body">
            <form action="<?= base_url('pemilik/laporan-penjualan') ?>" method="GET" class="mb-4">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Tanggal Awal</label>
                            <input type="date" name="tgl_awal" class="form-control" value="<?= $tgl_awal ?? '' ?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Tanggal Akhir</label>
                            <input type="date" name="tgl_akhir" class="form-control" value="<?= $tgl_akhir ?? '' ?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>&nbsp;</label>
                            <button type="submit" class="btn btn-primary d-block">
                                <i class="iconly-boldFilter"></i> Filter
                            </button>
                        </div>
                    </div>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>No Invoice</th>
                            <th>Motor</th>
                            <th>Pembeli</th>
                            <th>No HP</th>
                            <th>Kasir</th>
                            <th>Tanggal</th>
                            <th>Harga Akhir</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($laporan)): ?>
                            <?php 
                            $total_penjualan = 0;
                            foreach ($laporan as $index => $penjualan): 
                                $total_penjualan += $penjualan['harga_akhir'];
                            ?>
                                <tr>
                                    <td><?= $index + 1 ?></td>
                                    <td><?= esc($penjualan['no_invoice']) ?></td>
                                    <td>
                                        <strong><?= esc($penjualan['plat_nomor']) ?></strong><br>
                                        <small class="text-muted"><?= esc($penjualan['merk']) ?> - <?= esc($penjualan['tipe'] ?? '') ?></small>
                                    </td>
                                    <td><?= esc($penjualan['nama_pembeli']) ?></td>
                                    <td><?= esc($penjualan['no_hp_pembeli']) ?></td>
                                    <td><?= esc($penjualan['nama_kasir']) ?></td>
                                    <td><?= date('d/m/Y H:i', strtotime($penjualan['tanggal_jual'])) ?></td>
                                    <td>Rp <?= number_format($penjualan['harga_akhir'], 0, ',', '.') ?></td>
                                </tr>
                            <?php endforeach; ?>
                            <tr class="table-success">
                                <td colspan="7" class="text-end"><strong>Total Penjualan:</strong></td>
                                <td><strong>Rp <?= number_format($total_penjualan, 0, ',', '.') ?></strong></td>
                            </tr>
                        <?php else: ?>
                            <tr>
                                <td colspan="8" class="text-center">Tidak ada data</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                <a href="<?= base_url('pemilik/laporan-penjualan/pdf' . ($tgl_awal && $tgl_akhir ? '?tgl_awal=' . $tgl_awal . '&tgl_akhir=' . $tgl_akhir : '')) ?>" class="btn btn-danger" target="_blank">
                    <i class="bi bi-file-pdf"></i> Export PDF
                </a>
                <a href="<?= base_url('pemilik/laporan-penjualan/excel' . ($tgl_awal && $tgl_akhir ? '?tgl_awal=' . $tgl_awal . '&tgl_akhir=' . $tgl_akhir : '')) ?>" class="btn btn-success">
                    <i class="bi bi-file-excel"></i> Export Excel
                </a>
                <!-- <button onclick="window.print()" class="btn btn-primary">
                    <i class="bi bi-printer"></i> Cetak
                </button> -->
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script src="<?= base_url('assets/extensions/simple-datatables/umd/simple-datatables.js') ?>"></script>
<script>
    let table1 = document.querySelector('#table1');
    let dataTable = new simpleDatatables.DataTable(table1);
</script>
<?= $this->endSection() ?>

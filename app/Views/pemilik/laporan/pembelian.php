<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<section class="section">
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <div>
                    <h4 class="card-title">Laporan Pembelian Motorr</h4>
                </div>
                <div>
                    <a href="<?= base_url('pemilik/laporan-pembelian/pdf' . ($tgl_awal && $tgl_akhir ? '?tgl_awal=' . $tgl_awal . '&tgl_akhir=' . $tgl_akhir : '')) ?>" class="btn btn-danger" target="_blank">
                        <i class="bi bi-file-pdf"></i> Export PDF
                    </a>
                    <a href="<?= base_url('pemilik/laporan-pembelian/excel' . ($tgl_awal && $tgl_akhir ? '?tgl_awal=' . $tgl_awal . '&tgl_akhir=' . $tgl_akhir : '')) ?>" class="btn btn-success">
                        <i class="bi bi-file-excel"></i> Export Excel
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form action="<?= base_url('pemilik/laporan-pembelian') ?>" method="GET" class="mb-4">
                <div class="row">
                    <div class="col-md-5 col-sm-4">
                        <div class="form-group">
                            <label>Tanggal Awal</label>
                            <input type="date" name="tgl_awal" class="form-control" value="<?= $tgl_awal ?? '' ?>">
                        </div>
                    </div>
                    <div class="col-md-5 col-sm-4">
                        <div class="form-group">
                            <label>Tanggal Akhir</label>
                            <input type="date" name="tgl_akhir" class="form-control" value="<?= $tgl_akhir ?? '' ?>">
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-2">
                        <div class="form-group">
                            <label>&nbsp;</label>
                            <button type="submit" class="btn btn-primary w-100">
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
                    <tbody>
                        <?php if (!empty($laporan)): ?>
                            <?php
                            $total_beli = 0;
                            foreach ($laporan as $index => $motor):
                                $total_beli += $motor['harga_beli'];
                            ?>
                                <tr>
                                    <td><?= $index + 1 ?></td>
                                    <td><strong><?= esc($motor['plat_nomor']) ?></strong></td>
                                    <td>
                                        <?= esc($motor['merk']) ?><br>
                                        <small class="text-muted"><?= esc($motor['tipe']) ?></small>
                                    </td>
                                    <td><?= esc($motor['warna']) ?></td>
                                    <td><?= esc($motor['tahun']) ?></td>
                                    <td>Rp <?= number_format($motor['harga_beli'], 0, ',', '.') ?></td>
                                    <td>Rp <?= number_format($motor['harga_jual'], 0, ',', '.') ?></td>
                                    <td><?= date('d/m/Y', strtotime($motor['tanggal_masuk'])) ?></td>
                                    <td>
                                        <?php if ($motor['status'] === 'tersedia'): ?>
                                            <span class="badge bg-success">Tersedia</span>
                                        <?php else: ?>
                                            <span class="badge bg-danger">Terjual</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            <tr class="table-info">
                                <td colspan="5" class="text-end"><strong>Total Pembelian:</strong></td>
                                <td colspan="4"><strong>Rp <?= number_format($total_beli, 0, ',', '.') ?></strong></td>
                            </tr>
                        <?php else: ?>
                            <tr>
                                <td colspan="9" class="text-center">Tidak ada data</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
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
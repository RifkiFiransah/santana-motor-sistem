<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<section class="section">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Laporan Stok Opname</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Petugas Gudang</th>
                            <th>Jumlah Sistem</th>
                            <th>Jumlah Fisik</th>
                            <th>Selisih</th>
                            <th>Catatan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($laporan)): ?>
                            <?php foreach ($laporan as $index => $opname): ?>
                                <?php 
                                $selisih = $opname['jumlah_fisik'] - $opname['jumlah_sistem'];
                                $selisihClass = $selisih === 0 ? 'text-success' : 'text-danger';
                                ?>
                                <tr>
                                    <td><?= $index + 1 ?></td>
                                    <td><?= date('d/m/Y', strtotime($opname['tanggal_opname'])) ?></td>
                                    <td><?= esc($opname['nama_petugas']) ?></td>
                                    <td><?= $opname['jumlah_sistem'] ?></td>
                                    <td><?= $opname['jumlah_fisik'] ?></td>
                                    <td class="<?= $selisihClass ?>">
                                        <strong><?= $selisih > 0 ? '+' : '' ?><?= $selisih ?></strong>
                                        <?php if ($selisih === 0): ?>
                                            <span class="badge bg-success">Sesuai</span>
                                        <?php elseif ($selisih > 0): ?>
                                            <span class="badge bg-warning">Lebih</span>
                                        <?php else: ?>
                                            <span class="badge bg-danger">Kurang</span>
                                        <?php endif; ?>
                                    </td>
                                    <td><?= esc($opname['catatan'] ?? '-') ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7" class="text-center">Belum ada data stok opname</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                <a href="<?= base_url('pemilik/laporan-stok-opname/pdf') ?>" class="btn btn-danger" target="_blank">
                    <i class="bi bi-file-pdf"></i> Export PDF
                </a>
                <a href="<?= base_url('pemilik/laporan-stok-opname/excel') ?>" class="btn btn-success">
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

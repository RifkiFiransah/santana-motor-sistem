<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<section class="section">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Detail Motor</h4>
                </div>
                <div class="card-body">
                    <?php if ($motor['foto']): ?>
                        <div class="mb-3">
                            <img src="<?= base_url('uploads/motorcycles/' . $motor['foto']) ?>"
                                alt="Foto Motor" class="img-fluid rounded" style="max-width: 100%; max-height: 300px; object-fit: cover;">
                        </div>
                    <?php else: ?>
                        <div class="alert alert-secondary mb-3">
                            <i class="iconly-boldImage"></i> Foto motor tidak tersedia
                        </div>
                    <?php endif; ?>

                    <table class="table table-striped">
                        <tr>
                            <th width="200">Plat Nomor</th>
                            <td><strong class="text-primary"><?= esc($motor['plat_nomor']) ?></strong></td>
                        </tr>
                        <tr>
                            <th>Merk</th>
                            <td><?= esc($motor['merk']) ?></td>
                        </tr>
                        <tr>
                            <th>Tipe</th>
                            <td><?= esc($motor['tipe']) ?></td>
                        </tr>
                        <tr>
                            <th>Warna</th>
                            <td>
                                <span class="badge bg-info"><?= esc($motor['warna']) ?></span>
                            </td>
                        </tr>
                        <tr>
                            <th>Tahun</th>
                            <td><?= esc($motor['tahun']) ?></td>
                        </tr>
                        <tr>
                            <th>Harga Jual</th>
                            <td><strong class="text-success">Rp <?= number_format($motor['harga_jual'], 0, ',', '.') ?></strong></td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>
                                <span class="badge bg-success">Tersedia</span>
                            </td>
                        </tr>
                        <tr>
                            <th>Tanggal Masuk</th>
                            <td><?= date('d/m/Y', strtotime($motor['tanggal_masuk'])) ?></td>
                        </tr>
                    </table>

                    <div class="mt-3">
                        <a href="<?= base_url('kasir/transaksi') ?>?motor_id=<?= $motor['id'] ?>" class="btn btn-primary">
                            <i class="iconly-boldBag-2"></i> Proses Transaksi
                        </a>
                        <a href="<?= base_url('kasir/motor') ?>" class="btn btn-secondary">
                            <i class="iconly-boldArrow---Left-2"></i> Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>
<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<section class="section">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Detail Motor</h4>
                </div>
                <div class="card-body">
                    <!-- Foto Motor -->
                    <?php if ($motor['foto']): ?>
                        <div class="mb-4 text-center">
                            <img src="<?= base_url('uploads/motorcycles/' . $motor['foto']) ?>" 
                                 alt="Foto Motor" class="img-fluid rounded" 
                                 style="max-width: 100%; max-height: 400px; object-fit: cover;">
                        </div>
                    <?php else: ?>
                        <div class="alert alert-secondary mb-4 text-center">
                            <i class="iconly-boldImage" style="font-size: 3rem;"></i>
                            <p class="mt-2">Foto motor tidak tersedia</p>
                        </div>
                    <?php endif; ?>

                    <!-- Info Dasar -->
                    <h5 class="mb-3">Informasi Dasar</h5>
                    <div class="table-responsive">
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
                                <th>Sumber Pembelian</th>
                                <td><?= $motor['sumber_pembelian'] ? esc($motor['sumber_pembelian']) : '-' ?></td>
                            </tr>
                        </table>
                    </div>

                    <!-- Info Harga & Status -->
                    <hr>
                    <h5 class="mb-3">Harga & Status</h5>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <tr>
                                <th>Status</th>
                                <td>
                                    <?php 
                                    $badgeColor = [
                                        'tersedia' => 'success',
                                        'terjual' => 'danger',
                                        'perbaikan' => 'warning'
                                    ];
                                    ?>
                                    <span class="badge bg-<?= $badgeColor[$motor['status']] ?? 'secondary' ?>">
                                        <?= ucfirst($motor['status']) ?>
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <th width="200">Harga Beli</th>
                                <td>
                                    <strong class="text-warning">
                                        Rp <?= number_format($motor['harga_beli'], 0, ',', '.') ?>
                                    </strong>
                                </td>
                            </tr>
                            <tr>
                                <th>Harga Jual</th>
                                <td>
                                    <strong class="text-success">
                                        Rp <?= number_format($motor['harga_jual'], 0, ',', '.') ?>
                                    </strong>
                                </td>
                            </tr>
                            <tr>
                                <th>Tanggal Masuk</th>
                                <td><?= date('d/m/Y', strtotime($motor['tanggal_masuk'])) ?></td>
                            </tr>
                        </table>
                    </div>

                    <!-- Tanggal Update -->
                    <hr>
                    <small class="text-muted">
                        <i class="iconly-boldTime-Circle"></i> 
                        Dibuat: <?= date('d/m/Y H:i', strtotime($motor['created_at'])) ?> |
                        Diupdate: <?= date('d/m/Y H:i', strtotime($motor['updated_at'])) ?>
                    </small>

                    <!-- Aksi -->
                    <div class="mt-4">
                        <a href="<?= base_url('gudang/motor/edit/' . $motor['id']) ?>" class="btn btn-warning">
                            <i class="iconly-boldEdit"></i> Edit Motor
                        </a>
                        <a href="<?= base_url('gudang/motor') ?>" class="btn btn-secondary">
                            <i class="iconly-boldArrow---Left-2"></i> Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <!-- Card Summary -->
            <div class="card bg-primary text-white mb-3">
                <div class="card-body">
                    <h5 class="card-title">Info Kendaraan</h5>
                    <p class="card-text">
                        <strong><?= esc($motor['merk']) ?> <?= esc($motor['tipe']) ?></strong><br>
                        Tahun <?= esc($motor['tahun']) ?>
                    </p>
                </div>
            </div>

            <!-- Card Status -->
            <div class="card mb-3">
                <div class="card-header bg-light">
                    <h6 class="card-title mb-0">Status Kendaraan</h6>
                </div>
                <div class="card-body">
                    <div class="text-center">
                        <?php 
                        $statusIcon = [
                            'tersedia' => 'iconly-boldCheckCircle',
                            'terjual' => 'iconly-boldClose-Square',
                            'perbaikan' => 'iconly-boldWork'
                        ];
                        ?>
                        <i class="<?= $statusIcon[$motor['status']] ?? 'iconly-boldQuestionCircle' ?>" 
                           style="font-size: 2rem; color: 
                           <?= $motor['status'] === 'tersedia' ? 'green' : ($motor['status'] === 'terjual' ? 'red' : 'orange') ?>"></i>
                        <p class="mt-2">
                            <strong><?= ucfirst($motor['status']) ?></strong>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Card Harga -->
            <div class="card">
                <div class="card-header bg-light">
                    <h6 class="card-title mb-0">Ringkasan Harga</h6>
                </div>
                <div class="card-body">
                    <div class="mb-2">
                        <small class="text-muted">Harga Beli</small>
                        <p class="h6">Rp <?= number_format($motor['harga_beli'], 0, ',', '.') ?></p>
                    </div>
                    <div class="mb-2">
                        <small class="text-muted">Harga Jual</small>
                        <p class="h6">Rp <?= number_format($motor['harga_jual'], 0, ',', '.') ?></p>
                    </div>
                    <hr>
                    <div>
                        <small class="text-muted">Margin Keuntungan</small>
                        <p class="h5 text-success">
                            <strong>Rp <?= number_format(($motor['harga_jual'] - $motor['harga_beli']), 0, ',', '.') ?></strong>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>

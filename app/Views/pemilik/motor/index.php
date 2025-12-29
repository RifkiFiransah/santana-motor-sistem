<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<section class="section">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Data Motor</h4>
            <p class="text-muted">Kelola dan pantau semua data motor</p>
        </div>
        <div class="card-body">
            <!-- Filter Section -->
            <form action="<?= base_url('pemilik/motor') ?>" method="GET" class="mb-4">
                <div class="row g-3 mb-5">
                    <!-- Search Filter -->
                    <div class="col-md-4">
                        <label class="form-label">Cari Motor</label>
                        <input type="text" name="search" class="form-control" placeholder="Cari plat nomor, merk, tipe..." value="<?= $search ?? '' ?>">
                    </div>
                    <!-- Merk Filter -->
                    <div class="col-md-4">
                        <label class="form-label">Merk</label>
                        <select name="merk" class="form-select">
                            <option value="">-- Semua Merk --</option>
                            <?php if (!empty($merks)): ?>
                                <?php foreach ($merks as $m): ?>
                                    <option value="<?= esc($m['merk']) ?>" <?= ($merk === $m['merk']) ? 'selected' : '' ?>>
                                        <?= esc($m['merk']) ?>
                                    </option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>
                    <!-- Status Filter -->
                    <div class="col-md-4">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-select">
                            <option value="">-- Semua Status --</option>
                            <option value="tersedia" <?= ($status === 'tersedia') ? 'selected' : '' ?>>Tersedia</option>
                            <option value="terjual" <?= ($status === 'terjual') ? 'selected' : '' ?>>Terjual</option>
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Proses</label>
                        <button type="submit" class="btn btn-primary form-control">
                            <i class="iconly-boldSearch"></i> Cari
                        </button>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Reset</label>
                        <a href="<?= base_url('pemilik/motor') ?>" class="btn btn-secondary form-control">
                            <i class="iconly-boldRefresh"></i> Reset
                        </a>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Katalog</label>
                        <a href="<?= base_url('pemilik/motor/catalog') ?>" class="btn btn-info ms-auto form-control">
                            <i class="iconly-boldImage"></i> Lihat Katalog
                        </a>
                    </div>
                </div>
            </form>

            <hr>

            <div class="table-responsive">
                <table class="table table-hover" id="table1">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Plat Nomor</th>
                            <th>Merk/Tipe</th>
                            <th>Warna</th>
                            <th>Tahun</th>
                            <th>Harga Beli</th>
                            <th>Harga Jual</th>
                            <th>Status</th>
                            <th>Tanggal Masuk</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($motors)): ?>
                            <?php foreach ($motors as $index => $motor): ?>
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
                                    <td>
                                        <?php if ($motor['status'] === 'tersedia'): ?>
                                            <span class="badge bg-success">Tersedia Dapat Dihapus</span>
                                        <?php else: ?>
                                            <span class="badge bg-danger">Terjual Tidak Dapat Dihapus</span>
                                        <?php endif; ?>
                                    </td>
                                    <td><?= date('d/m/Y', strtotime($motor['tanggal_masuk'])) ?></td>
                                    <td style="width: 200px;">
                                        <a href="<?= base_url('pemilik/motor/' . ($motor['id'] ?? '#')) ?>" class="btn btn-primary" title="Detail">
                                            <i class="iconly-boldShow"></i> Detail
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="10" class="text-center">Belum ada data motor</td>
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
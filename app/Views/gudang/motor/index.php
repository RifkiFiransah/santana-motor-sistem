<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<section class="section">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Data Motor</h4>
            <p class="text-muted">Kelola dan pantau data motor di gudang</p>
        </div>
        <div class="card-body">
            <!-- Filter Section -->
            <form action="<?= base_url('gudang/motor') ?>" method="GET" class="mb-4">
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
                        <label class="form-label">Status</label>
                        <button type="submit" class="btn btn-primary w-100 form-control">
                            <i class="iconly-boldSearch"></i> Cari
                        </button>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Status</label>
                        <a href="<?= base_url('gudang/motor') ?>" class="btn btn-secondary w-100 form-control">
                            <i class="iconly-boldRefresh"></i> Reset
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
                            <th>Harga Jual</th>
                            <th>Status</th>
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
                                    <td>Rp <?= number_format($motor['harga_jual'], 0, ',', '.') ?></td>
                                    <td>
                                        <?php if ($motor['status'] === 'tersedia'): ?>
                                            <span class="badge bg-success">Tersedia</span>
                                        <?php else: ?>
                                            <span class="badge bg-danger">Terjual</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <a href="<?= base_url('gudang/motor/edit/' . $motor['id']) ?>" class="btn btn-sm btn-warning" title="Edit">
                                            <i class="iconly-boldEdit"></i> Edit
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="8" class="text-center">Belum ada data motor</td>
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
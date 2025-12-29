<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<section class="section">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Cek Motor Tersedia</h4>
            <p class="text-muted">Lihat daftar motor yang tersedia untuk dijual</p>
        </div>
        <div class="card-body">
            <!-- Filter Section -->
            <form action="<?= base_url('kasir/motor') ?>" method="GET" class="mb-4">
                <div class="row g-3 mb-4">
                    <!-- Search Filter -->
                    <div class="col-md-6">
                        <label class="form-label">Cari Motor</label>
                        <input type="text" name="search" class="form-control" placeholder="Cari plat nomor, merk, tipe, atau warna..." value="<?= $search ?? '' ?>">
                    </div>

                    <!-- Merk Filter -->
                    <div class="col-md-6">
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
                </div>

                <!-- Filter Buttons -->
                <div class="d-flex gap-2 flex-wrap">
                    <button type="submit" class="btn btn-primary">
                        <i class="iconly-boldSearch"></i> Cari
                    </button>
                    <a href="<?= base_url('kasir/motor') ?>" class="btn btn-secondary">
                        <i class="iconly-boldRefresh"></i> Reset
                    </a>
                    <a href="<?= base_url('kasir/motor/catalog') ?>" class="btn btn-info ms-auto">
                        <i class="iconly-boldImage"></i> Lihat Katalog
                    </a>
                </div>
            </form>

            <hr>

            <div class="row">
                <?php if (!empty($motors)): ?>
                    <?php foreach ($motors as $motor): ?>
                        <div class="col-md-6 col-lg-4">
                            <div class="card border-4 shadow-sm mb-4">
                                <div class="card-body">
                                    <h5 class="card-title"><?= esc($motor['plat_nomor']) ?></h5>
                                    <p class="card-text">
                                        <strong><?= esc($motor['merk']) ?> <?= esc($motor['tipe']) ?></strong><br>
                                        <span class="badge bg-info"><?= esc($motor['warna']) ?></span>
                                        <span class="badge bg-secondary"><?= esc($motor['tahun']) ?></span>
                                    </p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="text-success">
                                            <strong>Rp <?= number_format($motor['harga_jual'], 0, ',', '.') ?></strong>
                                        </span>
                                        <a href="<?= base_url('kasir/motor/' . $motor['id']) ?>" class="btn btn-sm btn-primary">
                                            <i class="iconly-boldShow"></i> Detail
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="col-12">
                        <div class="alert alert-info">
                            <i class="iconly-boldInfo-Circle"></i>
                            <?php if (!empty($search) || !empty($merk)): ?>
                                Tidak ada motor yang sesuai dengan pencarian
                            <?php else: ?>
                                Belum ada motor tersedia
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>
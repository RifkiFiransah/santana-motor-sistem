<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<section class="section">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Katalog Motor Tersedia</h4>
            <p class="text-muted">Jelajahi motor yang siap dijual dengan filter yang lebih lengkap</p>
        </div>
        <div class="card-body">
            <form action="<?= base_url('kasir/motor/catalog') ?>" method="GET" class="mb-4">
                <div class="row g-3">
                    <div class="col-lg-4 col-md-6">
                        <label class="form-label">Cari Motor</label>
                        <input type="text" name="search" class="form-control" placeholder="Plat nomor, merk, tipe, atau warna" value="<?= $search ?? '' ?>">
                    </div>
                    <div class="col-lg-2 col-md-6">
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
                    <div class="col-lg-2 col-md-6">
                        <label class="form-label">Warna</label>
                        <select name="warna" class="form-select">
                            <option value="">-- Semua Warna --</option>
                            <?php if (!empty($warnas)): ?>
                                <?php foreach ($warnas as $w): ?>
                                    <option value="<?= esc($w['warna']) ?>" <?= ($warna === $w['warna']) ? 'selected' : '' ?>>
                                        <?= esc($w['warna']) ?>
                                    </option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>
                    <div class="col-lg-2 col-md-6">
                        <label class="form-label">Tahun</label>
                        <select name="tahun" class="form-select">
                            <option value="">-- Semua Tahun --</option>
                            <?php if (!empty($tahuns)): ?>
                                <?php foreach ($tahuns as $t): ?>
                                    <option value="<?= esc($t['tahun']) ?>" <?= ($tahun === $t['tahun']) ? 'selected' : '' ?>>
                                        <?= esc($t['tahun']) ?>
                                    </option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>
                    <div class="col-lg-1 col-md-6">
                        <label class="form-label">Harga Min</label>
                        <input type="number" name="harga_min" class="form-control" min="0" placeholder="Rp" value="<?= $harga_min ?? '' ?>">
                    </div>
                    <div class="col-lg-1 col-md-6">
                        <label class="form-label">Harga Max</label>
                        <input type="number" name="harga_max" class="form-control" min="0" placeholder="Rp" value="<?= $harga_max ?? '' ?>">
                    </div>
                </div>

                <div class="d-flex gap-2 flex-wrap mt-3">
                    <button type="submit" class="btn btn-primary">
                        <i class="iconly-boldSearch"></i> Terapkan Filter
                    </button>
                    <a href="<?= base_url('kasir/motor/catalog') ?>" class="btn btn-secondary">
                        <i class="iconly-boldRefresh"></i> Reset
                    </a>
                    <a href="<?= base_url('kasir/motor') ?>" class="btn btn-light ms-auto">
                        <i class="iconly-boldArrow-Left"></i> Kembali ke Daftar
                    </a>
                </div>
            </form>

            <hr>

            <div class="row">
                <?php if (!empty($motors)): ?>
                    <?php foreach ($motors as $motor): ?>
                        <div class="col-xl-3 col-lg-4 col-md-6">
                            <div class="card border-3 shadow-sm mb-4 h-100">
                                <div class="card-body d-flex flex-column">
                                    <div class="d-flex justify-content-between align-items-start mb-3">
                                        <div>
                                            <span class="badge bg-primary mb-2"><?= esc($motor['plat_nomor']) ?></span>
                                            <h5 class="card-title mb-0"><?= esc($motor['merk']) ?> <?= esc($motor['tipe']) ?></h5>
                                        </div>
                                        <span class="badge bg-success">Tersedia</span>
                                    </div>
                                    <ul class="list-unstyled small text-muted flex-grow-1">
                                        <li><i class="iconly-boldDocument"></i> Tipe: <?= esc($motor['tipe']) ?></li>
                                        <li><i class="iconly-boldColorPicker"></i> Warna: <?= esc($motor['warna']) ?></li>
                                        <li><i class="iconly-boldCalendar"></i> Tahun: <?= esc($motor['tahun']) ?></li>
                                        <li><i class="iconly-boldLightning"></i> Kilometer: <?= esc(number_format((int)($motor['kilometer'] ?? 0), 0, ',', '.')) ?> km</li>
                                    </ul>
                                    <div class="mt-3">
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <span class="text-success fw-bold">Rp <?= number_format($motor['harga_jual'], 0, ',', '.') ?></span>
                                            <span class="text-muted small">Masuk: <?= isset($motor['created_at']) ? date('d M Y', strtotime($motor['created_at'])) : '-' ?></span>
                                        </div>
                                        <div class="d-grid gap-2">
                                            <a href="<?= base_url('kasir/motor/' . $motor['id']) ?>" class="btn btn-primary">
                                                <i class="iconly-boldShow"></i> Lihat Detail
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="col-12">
                        <div class="alert alert-info d-flex align-items-center" role="alert">
                            <i class="iconly-boldInfo-Circle me-2"></i>
                            <div>
                                Tidak ada motor yang sesuai dengan filter saat ini. Silakan atur ulang filter untuk melihat motor lainnya.
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>

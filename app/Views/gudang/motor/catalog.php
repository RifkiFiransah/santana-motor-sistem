<?php
$motors = $motors ?? [];
$merks = $merks ?? [];
$warnas = $warnas ?? [];
$tahuns = $tahuns ?? [];
$search = $search ?? '';
$merk = $merk ?? '';
$warna = $warna ?? '';
$tahun = $tahun ?? '';
$status = $status ?? '';
$harga_min = $harga_min ?? '';
$harga_max = $harga_max ?? '';
?>

<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<section class="section">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Katalog Motor</h4>
            <p class="text-muted">Jelajahi dan kelola koleksi motor dengan filter yang mudah digunakan</p>
        </div>
        <div class="card-body">
            <!-- Filter Section -->
            <form action="<?= base_url('gudang/motor/catalog') ?>" method="GET" class="mb-4" id="filterForm">
                <div class="row g-3 mb-4">
                    <!-- Search Filter -->
                    <div class="col-md-12">
                        <label class="form-label">Cari Motor</label>
                        <input type="text" name="search" class="form-control" placeholder="Cari plat nomor, merk, tipe, atau warna..." value="<?= esc($search) ?>">
                    </div>

                    <!-- Merk Filter -->
                    <div class="col-md-6 col-lg-2">
                        <label class="form-label">Merk</label>
                        <select name="merk" class="form-select">
                            <option value="">-- Semua Merk --</option>
                            <?php if (!empty($merks)): ?>
                                <?php foreach ($merks as $m): ?>
                                    <?php $merkValue = $m['merk'] ?? ''; ?>
                                    <option value="<?= esc($merkValue) ?>" <?= ($merk === $merkValue) ? 'selected' : '' ?>>
                                        <?= esc($merkValue) ?>
                                    </option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>

                    <!-- Warna Filter -->
                    <div class="col-md-6 col-lg-2">
                        <label class="form-label">Warna</label>
                        <select name="warna" class="form-select">
                            <option value="">-- Semua Warna --</option>
                            <?php if (!empty($warnas)): ?>
                                <?php foreach ($warnas as $w): ?>
                                    <?php $warnaValue = $w['warna'] ?? ''; ?>
                                    <option value="<?= esc($warnaValue) ?>" <?= ($warna === $warnaValue) ? 'selected' : '' ?>>
                                        <?= esc($warnaValue) ?>
                                    </option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>

                    <!-- Tahun Filter -->
                    <div class="col-md-6 col-lg-2">
                        <label class="form-label">Tahun</label>
                        <select name="tahun" class="form-select">
                            <option value="">-- Semua Tahun --</option>
                            <?php if (!empty($tahuns)): ?>
                                <?php foreach ($tahuns as $t): ?>
                                    <?php $tahunValue = $t['tahun'] ?? ''; ?>
                                    <option value="<?= esc($tahunValue) ?>" <?= ($tahun === $tahunValue) ? 'selected' : '' ?>>
                                        <?= esc($tahunValue) ?>
                                    </option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>

                    <!-- Status Filter -->
                    <div class="col-md-6 col-lg-2">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-select">
                            <option value="">-- Semua Status --</option>
                            <option value="tersedia" <?= ($status === 'tersedia') ? 'selected' : '' ?>>Tersedia</option>
                            <option value="terjual" <?= ($status === 'terjual') ? 'selected' : '' ?>>Terjual</option>
                        </select>
                    </div>

                </div>

                <!-- Filter Buttons -->
                <div class="d-flex gap-2 flex-wrap">
                    <button type="submit" class="btn btn-primary">
                        <i class="iconly-boldSearch"></i> Cari
                    </button>
                    <a href="<?= base_url('gudang/motor/catalog') ?>" class="btn btn-secondary">
                        <i class="iconly-boldRefresh"></i> Reset Filter
                    </a>
                </div>
            </form>

            <hr>

            <!-- Motor Grid -->
            <div class="row">
                <?php if (!empty($motors)): ?>
                    <!-- Results Count -->
                    <div class="col-12 mb-3">
                        <p class="text-muted">Menampilkan <strong><?= count($motors) ?></strong> motor</p>
                    </div>

                    <?php foreach ($motors as $motor): ?>
                        <div class="col-md-6 col-lg-4 col-xl-3 mb-4">
                            <div class="card h-100 shadow-sm hover-shadow-lg transition-all" style="cursor: pointer; transition: all 0.3s ease;">
                                <!-- Motor Image -->
                                <div class="position-relative" style="height: 200px; overflow: hidden; background: #f5f5f5;">
                                    <?php if (!empty($motor['foto'])): ?>
                                        <img src="<?= base_url('uploads/motorcycles/' . $motor['foto']) ?>" 
                                             alt="<?= esc(($motor['merk'] ?? '') . ' ' . ($motor['tipe'] ?? '')) ?>"
                                             class="card-img-top w-100 h-100" 
                                             style="object-fit: cover;">
                                    <?php else: ?>
                                        <div class="d-flex align-items-center justify-content-center h-100 bg-light">
                                            <i class="iconly-boldImage" style="font-size: 48px; color: #ccc;"></i>
                                        </div>
                                    <?php endif; ?>
                                    <!-- Status Badge -->
                                    <?php if (($motor['status'] ?? '') === 'tersedia'): ?>
                                        <span class="badge bg-success position-absolute top-0 end-0 m-3">
                                            <i class="iconly-boldCheckmark"></i> Tersedia
                                        </span>
                                    <?php else: ?>
                                        <span class="badge bg-danger position-absolute top-0 end-0 m-3">
                                            <i class="iconly-boldClose-Square"></i> Terjual
                                        </span>
                                    <?php endif; ?>
                                </div>

                                <div class="card-body d-flex flex-column">
                                    <!-- Plat Nomor -->
                                    <h6 class="card-title fw-bold text-primary mb-2">
                                        <?= esc($motor['plat_nomor'] ?? 'N/A') ?>
                                    </h6>

                                    <!-- Merk & Tipe -->
                                    <p class="card-text mb-2">
                                        <strong><?= esc($motor['merk'] ?? 'N/A') ?></strong><br>
                                        <small class="text-muted"><?= esc($motor['tipe'] ?? 'N/A') ?></small>
                                    </p>

                                    <!-- Details -->
                                    <div class="mb-3">
                                        <span class="badge bg-info me-2">
                                            <i class="iconly-boldPalette"></i> <?= esc($motor['warna'] ?? 'N/A') ?>
                                        </span>
                                        <span class="badge bg-secondary">
                                            <i class="iconly-boldCalendar"></i> <?= esc($motor['tahun'] ?? 'N/A') ?>
                                        </span>
                                    </div>

                                    <!-- Price -->
                                    <div class="mb-3">
                                        <small class="text-muted">Harga Jual:</small><br>
                                        <p class="text-success fw-bold h6">
                                            Rp <?= number_format((int)($motor['harga_jual'] ?? 0), 0, ',', '.') ?>
                                        </p>
                                    </div>

                                    <!-- Action Button -->
                                    <a href="<?= base_url('gudang/motor/edit/' . ($motor['id'] ?? '')) ?>" class="btn btn-warning btn-sm w-100">
                                        <i class="iconly-boldEdit"></i> Edit
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="col-12">
                        <div class="alert alert-info text-center py-5">
                            <i class="iconly-boldInfo-Circle" style="font-size: 48px;"></i>
                            <h5 class="mt-3">Tidak ada motor ditemukan</h5>
                            <p class="text-muted">
                                <?php if (!empty($search) || !empty($merk) || !empty($warna) || !empty($tahun)): ?>
                                    Coba ubah filter pencarian Anda
                                <?php else: ?>
                                    Belum ada motor dalam sistem
                                <?php endif; ?>
                            </p>
                            <a href="<?= base_url('gudang/motor/catalog') ?>" class="btn btn-primary btn-sm mt-3">
                                <i class="iconly-boldRefresh"></i> Reset Filter
                            </a>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<style>
    .hover-shadow-lg:hover {
        box-shadow: 0 1rem 3rem rgba(0, 0, 0, 0.175) !important;
        transform: translateY(-5px);
    }

    .transition-all {
        transition: all 0.3s ease;
    }

    .form-select, .form-control {
        border-radius: 0.5rem;
    }
</style>
<?= $this->endSection() ?>

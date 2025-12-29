<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="page-heading">
    <h3>Dashboard Gudang</h3>
</div>

<section class="row">
    <div class="col-12 col-lg-9">
        <div class="row">
            <div class="col-6 col-lg-4 col-md-6">
                <div class="card">
                    <div class="card-body px-4 py-4-5">
                        <div class="row">
                            <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                                <div class="stats-icon green mb-2">
                                    <i class="iconly-boldBuy"></i>
                                </div>
                            </div>
                            <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                <h6 class="text-muted font-semibold">Motor Tersedia</h6>
                                <h6 class="font-extrabold mb-0"><?= $total_motor_tersedia ?></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-lg-4 col-md-6">
                <div class="card">
                    <div class="card-body px-4 py-4-5">
                        <div class="row">
                            <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                                <div class="stats-icon red mb-2">
                                    <i class="iconly-boldBag-2"></i>
                                </div>
                            </div>
                            <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                <h6 class="text-muted font-semibold">Motor Terjual</h6>
                                <h6 class="font-extrabold mb-0"><?= $total_motor_terjual ?></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-lg-4 col-md-6">
                <div class="card">
                    <div class="card-body px-4 py-4-5">
                        <div class="row">
                            <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                                <div class="stats-icon blue mb-2">
                                    <i class="iconly-boldDownload"></i>
                                </div>
                            </div>
                            <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                <h6 class="text-muted font-semibold">Masuk Bulan Ini</h6>
                                <h6 class="font-extrabold mb-0"><?= $motor_masuk_bulan_ini ?></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Motor Terbaru</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>Plat Nomor</th>
                                        <th>Merk/Tipe</th>
                                        <th>Tahun</th>
                                        <th class="text-end">Harga Jual</th>
                                        <th>Status</th>
                                        <th>Tanggal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($motor_terbaru)): ?>
                                        <?php foreach ($motor_terbaru as $motor): ?>
                                            <tr>
                                                <td class="text-bold-500"><?= esc($motor['plat_nomor']) ?></td>
                                                <td>
                                                    <p class="font-bold mb-0"><?= esc($motor['merk']) ?></p>
                                                    <p class="text-xs text-muted mb-0"><?= esc($motor['tipe']) ?> • <?= esc($motor['warna']) ?></p>
                                                </td>
                                                <td><?= esc($motor['tahun']) ?></td>
                                                <td class="text-end">
                                                    <span class="badge bg-light-success">Rp <?= number_format($motor['harga_jual'], 0, ',', '.') ?></span>
                                                </td>
                                                <td>
                                                    <?php if ($motor['status'] === 'tersedia'): ?>
                                                        <span class="badge bg-success">Tersedia</span>
                                                    <?php else: ?>
                                                        <span class="badge bg-danger">Terjual</span>
                                                    <?php endif; ?>
                                                </td>
                                                <td class="text-xs"><?= date('d M Y', strtotime($motor['tanggal_masuk'])) ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="6" class="text-center py-4">
                                                <div class="text-muted">
                                                    <i class="iconly-boldDocument" style="font-size: 2rem;"></i>
                                                    <p class="mt-2">Belum ada data motor</p>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 col-lg-3">
        <div class="card">
            <div class="card-body py-4 px-4">
                <div class="d-flex align-items-center my-2">
                    <div class="avatar avatar-xl">
                        <!-- <div class="avatar-content bg-success text-white">
                            <i class="iconly-boldProfile" style="font-size: 2rem;"></i>
                        </div> -->
                        <div class="stats-icon blue">
                            <i class="iconly-boldProfile" style="font-size: 2rem;"></i>
                        </div>
                    </div>
                    <div class="ms-3 name">
                        <h5 class="font-bold mb-1"><?= session()->get('fullname') ?></h5>
                        <h6 class="text-muted mb-0">
                            <span class="badge bg-light-success"><?= ucfirst(session()->get('role')) ?></span>
                        </h6>
                    </div>
                </div>
            </div>
        </div>

        <?php if (!empty($stok_opname_terakhir)): ?>
            <div class="card">
                <div class="card-header">
                    <h5>Stok Opname Terakhir</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <span class="text-sm text-muted">Tanggal</span>
                            <span class="text-sm font-bold"><?= date('d M Y', strtotime($stok_opname_terakhir['tanggal_opname'])) ?></span>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <span class="text-sm text-muted">Sistem</span>
                            <span class="badge bg-primary"><?= $stok_opname_terakhir['jumlah_sistem'] ?></span>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <span class="text-sm text-muted">Fisik</span>
                            <span class="badge bg-info"><?= $stok_opname_terakhir['jumlah_fisik'] ?></span>
                        </div>
                    </div>
                    <div>
                        <?php
                        $selisih = $stok_opname_terakhir['jumlah_fisik'] - $stok_opname_terakhir['jumlah_sistem'];
                        ?>
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <span class="text-sm text-muted">Selisih</span>
                            <span class="badge <?= $selisih === 0 ? 'bg-success' : 'bg-danger' ?>">
                                <?= $selisih > 0 ? '+' : '' ?><?= $selisih ?>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>
<?= $this->endSection() ?>
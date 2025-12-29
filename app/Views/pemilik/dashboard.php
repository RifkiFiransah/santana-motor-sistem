<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="page-heading">
    <h3>Dashboard Pemilik</h3>
</div>

<section class="row">
    <div class="col-12 col-lg-9">
        <div class="row">
            <div class="col-6 col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body px-4 py-4-5">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="stats-icon purple">
                                    <i class="iconly-boldTicket-Star"></i>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <h6 class="text-muted font-semibold">Motor Tersedia</h6>
                                <h6 class="font-extrabold mb-0"><?= $total_motor_tersedia ?></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body px-4 py-4-5">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="stats-icon blue">
                                    <i class="iconly-boldBuy"></i>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <h6 class="text-muted font-semibold">Motor Terjual</h6>
                                <h6 class="font-extrabold mb-0"><?= $total_motor_terjual ?></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body px-4 py-4-5">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="stats-icon green">
                                    <i class="iconly-boldCalendar"></i>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <h6 class="text-muted font-semibold">Penjualan Bulan Ini</h6>
                                <h6 class="font-extrabold mb-0"><?= $total_penjualan_bulan_ini ?></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body px-4 py-4-5">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="stats-icon red">
                                    <i class="iconly-boldUser"></i>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <h6 class="text-muted font-semibold">Total User</h6>
                                <h6 class="font-extrabold mb-0"><?= $total_user ?></h6>
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
                        <h4>Penjualan Terbaru</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>No Invoice</th>
                                        <th>Motor</th>
                                        <th>Pembeli</th>
                                        <th>Tanggal</th>
                                        <th class="text-end">Harga</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($penjualan_terbaru)): ?>
                                        <?php foreach ($penjualan_terbaru as $penjualan): ?>
                                            <tr>
                                                <td class="text-bold-500"><?= esc($penjualan['no_invoice']) ?></td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar bg-light-primary me-3">
                                                            <i class="iconly-boldBuy"></i>
                                                        </div>
                                                        <div>
                                                            <p class="font-bold mb-0"><?= esc($penjualan['plat_nomor']) ?></p>
                                                            <p class="text-xs text-muted mb-0"><?= esc($penjualan['merk']) ?></p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td><?= esc($penjualan['nama_pembeli']) ?></td>
                                                <td>
                                                    <span class="text-xs"><?= date('d M Y', strtotime($penjualan['tanggal_jual'])) ?></span><br>
                                                    <span class="text-xs text-muted"><?= date('H:i', strtotime($penjualan['tanggal_jual'])) ?></span>
                                                </td>
                                                <td class="text-end">
                                                    <span class="badge bg-success">Rp <?= number_format($penjualan['harga_akhir'], 0, ',', '.') ?></span>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="5" class="text-center py-4">
                                                <div class="text-muted">
                                                    <i class="iconly-boldDocument" style="font-size: 2rem;"></i>
                                                    <p class="mt-2">Belum ada data penjualan</p>
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
                        <!-- <div class="avatar-content bg-primary text-white">
                            <i class="iconly-boldProfile" style="font-size: 2rem;"></i>
                        </div> -->
                        <div class="stats-icon blue">
                            <i class="iconly-boldProfile" style="font-size: 2rem;"></i>
                        </div>
                    </div>
                    <div class="ms-3 name">
                        <h5 class="font-bold mb-1"><?= session()->get('fullname') ?></h5>
                        <h6 class="text-muted mb-0">
                            <span class="badge bg-light-primary"><?= ucfirst(session()->get('role')) ?></span>
                        </h6>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h5>Quick Stats</h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="text-sm">Motor Tersedia</span>
                        <span class="badge bg-primary"><?= $total_motor_tersedia ?></span>
                    </div>
                    <div class="progress progress-sm">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: 70%" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="text-sm">Motor Terjual</span>
                        <span class="badge bg-success"><?= $total_motor_terjual ?></span>
                    </div>
                    <div class="progress progress-sm">
                        <div class="progress-bar bg-success" role="progressbar" style="width: 30%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
                <div>
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="text-sm">Total User</span>
                        <span class="badge bg-info"><?= $total_user ?></span>
                    </div>
                    <div class="progress progress-sm">
                        <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>
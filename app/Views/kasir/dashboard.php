<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="page-heading">
    <h3>Dashboard Kasir</h3>
</div>

<section>
    <div class="row">
        <div class="col-12">
            <div class="row">
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-4 d-flex justify-content-start">
                                    <div class="stats-icon purple mb-2">
                                        <i class="iconly-boldBuy"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-8">
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
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-4 d-flex justify-content-start">
                                    <div class="stats-icon blue mb-2">
                                        <i class="iconly-boldPaper"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-8">
                                    <h6 class="text-muted font-semibold">Transaksi Hari Ini</h6>
                                    <h6 class="font-extrabold mb-0"><?= $transaksi_hari_ini ?></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-4 d-flex justify-content-start">
                                    <div class="stats-icon green mb-2">
                                        <i class="iconly-boldCalendar"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-8">
                                    <h6 class="text-muted font-semibold">Transaksi Bulan Ini</h6>
                                    <h6 class="font-extrabold mb-0"><?= $transaksi_bulan_ini ?></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-4 d-flex justify-content-start">
                                    <div class="stats-icon red mb-2">
                                        <i class="iconly-boldTicket-Star"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-8">
                                    <h6 class="text-muted font-semibold">Transaksi Saya</h6>
                                    <h6 class="font-extrabold mb-0"><?= $transaksi_saya_hari_ini ?></h6>
                                </div>
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
                            <!-- <div class="avatar-content bg-info text-white">
                            <i class="iconly-boldProfile" style="font-size: 2rem;"></i>
                        </div> -->
                            <div class="stats-icon blue">
                                <i class="iconly-boldProfile" style="font-size: 2rem;"></i>
                            </div>
                        </div>
                        <div class="ms-3 name">
                            <h5 class="font-bold mb-1"><?= session()->get('fullname') ?></h5>
                            <h6 class="text-muted mb-0">
                                <span class="badge bg-light-info"><?= ucfirst(session()->get('role')) ?></span>
                            </h6>
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
                    <h4>Transaksi Terbaru Saya</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-lg">
                            <thead>
                                <tr>
                                    <th>No Invoice</th>
                                    <th>Motor</th>
                                    <th>Pembeli</th>
                                    <th>Tanggal</th>
                                    <th>Harga</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($transaksi_terbaru)): ?>
                                    <?php foreach ($transaksi_terbaru as $transaksi): ?>
                                        <tr>
                                            <td><?= esc($transaksi['no_invoice']) ?></td>
                                            <td>
                                                <strong><?= esc($transaksi['plat_nomor']) ?></strong><br>
                                                <small class="text-muted"><?= esc($transaksi['merk']) ?></small>
                                            </td>
                                            <td><?= esc($transaksi['nama_pembeli']) ?></td>
                                            <td><?= date('d/m/Y H:i', strtotime($transaksi['tanggal_jual'])) ?></td>
                                            <td>Rp <?= number_format($transaksi['harga_akhir'], 0, ',', '.') ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="5" class="text-center">Belum ada transaksi</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>
<?php
$role = session()->get('role');
$current_url = uri_string();
?>

<div id="sidebar" class="active">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header position-relative">
            <div class="d-flex justify-content-between align-items-center">
                <div class="logo d-flex align-items-center gap-2">
                    <img src="<?= base_url('assets/static/images/logo/santana-logo.png'); ?>"
                        alt="Santana Motor Logo"
                        style="height: 50px; width: auto; object-fit: contain;">

                    <a href="<?= base_url($role . '/dashboard') ?>" class="text-decoration-none">
                        <h5 class="text-primary mb-0">Santana Motor</h5>
                    </a>
                </div>

                <div class="toggler">
                    <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                </div>
            </div>
        </div>

        <div class="sidebar-menu">
            <ul class="menu">
                <li class="sidebar-title">Menu</li>

                <li class="sidebar-item <?= $current_url === $role . '/dashboard' ? 'active' : '' ?>">
                    <a href="<?= base_url($role . '/dashboard') ?>" class='sidebar-link'>
                        <i class="iconly-boldCategory"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <?php if ($role === 'pemilik'): ?>
                    <li class="sidebar-title">Master Data</li>
                    <li class="sidebar-item  <?= strpos($current_url, 'pemilik/users') !== false ? 'active' : '' ?>">
                        <a href="<?= base_url('pemilik/users') ?>" class='sidebar-link'>
                            <i class="iconly-boldUser"></i>
                            <span>Manajemen User</span>
                        </a>
                    </li>
                    <li class="sidebar-item has-sub <?= strpos($current_url, 'pemilik/motor') !== false ? 'active' : '' ?>">
                        <a href="javascript:void(0);" class='sidebar-link d-flex' onclick="this.parentElement.classList.toggle('show')">
                            <span style="margin-left: 0px;">
                                <i class="iconly-boldBuy me-2"></i> Data Motor
                            </span>
                        </a>
                        <ul class="submenu <?= strpos($current_url, 'pemilik/motor') !== false ? 'active' : '' ?>">
                            <li class="submenu-item <?= (strpos($current_url, 'pemilik/motor') !== false && strpos($current_url, 'catalog') === false) ? 'active' : '' ?>">
                                <a href="<?= base_url('pemilik/motor') ?>">Data Tabel</a>
                            </li>
                            <li class="submenu-item <?= strpos($current_url, 'pemilik/motor/catalog') !== false ? 'active' : '' ?>">
                                <a href="<?= base_url('pemilik/motor/catalog') ?>">Katalog</a>
                            </li>
                        </ul>
                    </li>

                    <li class="sidebar-title">Laporan</li>

                    <li class="sidebar-item has-sub <?= strpos($current_url, 'pemilik/laporan') !== false ? 'active' : '' ?>">
                        <a href="javascript:void(0);" class='sidebar-link d-flex' onclick="this.parentElement.classList.toggle('show')">
                            <span style="margin-left: 0px;">
                                <i class="iconly-boldDocument me-2"></i> Laporan
                            </span>
                        </a>
                        <ul class="submenu <?= strpos($current_url, 'pemilik/laporan') !== false ? 'active' : '' ?>">
                            <li class="submenu-item <?= $current_url === 'pemilik/laporan-pembelian' ? 'active' : '' ?>">
                                <a href="<?= base_url('pemilik/laporan-pembelian') ?>">Laporan Pembelian</a>
                            </li>
                            <li class="submenu-item <?= $current_url === 'pemilik/laporan-penjualan' ? 'active' : '' ?>">
                                <a href="<?= base_url('pemilik/laporan-penjualan') ?>">Laporan Penjualan</a>
                            </li>
                            <li class="submenu-item <?= $current_url === 'pemilik/laporan-stok-opname' ? 'active' : '' ?>">
                                <a href="<?= base_url('pemilik/laporan-stok-opname') ?>">Laporan Stok Opname</a>
                            </li>
                        </ul>
                    </li>

                <?php elseif ($role === 'gudang'): ?>
                    <li class="sidebar-title">Manajemen Motor</li>
                    <li class="sidebar-item has-sub <?= strpos($current_url, 'gudang/motor') !== false ? 'active' : '' ?>">
                        <a href="javascript:void(0);" class='sidebar-link d-flex' onclick="this.parentElement.classList.toggle('show')">
                            <span style="margin-left: 0px;">
                                <i class="iconly-boldDocument me-2"></i> Data Motor
                            </span>
                        </a>
                        <ul class="submenu <?= strpos($current_url, 'gudang/motor') !== false ? 'active' : '' ?>">
                            <li class="submenu-item <?= $current_url === 'gudang/motor/masuk' ? 'active' : '' ?>">
                                <a href="<?= base_url('gudang/motor/masuk') ?>">Input Motor Masuk</a>
                            </li>
                            <li class="submenu-item <?= $current_url === 'gudang/motor' ? 'active' : '' ?>">
                                <a href="<?= base_url('gudang/motor') ?>">Data Motor</a>
                            </li>
                        </ul>
                    </li>
                    <li class="sidebar-title">Inventori</li>
                    <li class="sidebar-item <?= strpos($current_url, 'gudang/stok-opname') !== false ? 'active' : '' ?>">
                        <a href="<?= base_url('gudang/stok-opname') ?>" class='sidebar-link'>
                            <i class="iconly-boldTicket-Star"></i>
                            <span>Stok Opname</span>
                        </a>
                    </li>

                <?php elseif ($role === 'kasir'): ?>
                    <li class="sidebar-title">Transaksi</li>
                    <li class="sidebar-item has-sub <?= strpos($current_url, 'kasir/motor') !== false ? 'active' : '' ?>">
                        <a href="javascript:void(0);" class='sidebar-link d-flex justify-content-between align-items-center' onclick="this.parentElement.classList.toggle('show')">
                            <span style="margin-left: 0px;">
                                <i class="iconly-boldSearch me-2"></i> Data Motor
                            </span>
                        </a>
                        <ul class="submenu <?= strpos($current_url, 'kasir/motor') !== false ? 'active' : '' ?>">
                            <li class="submenu-item <?= strpos($current_url, 'kasir/motor/catalog') !== false ? 'active' : '' ?>">
                                <a href="<?= base_url('kasir/motor/catalog') ?>">Cek Ketersediaan</a>
                            </li>
                        </ul>
                    </li>

                    <li class="sidebar-item <?= strpos($current_url, 'kasir/transaksi') !== false ? 'active' : '' ?>">
                        <a href="<?= base_url('kasir/transaksi') ?>" class='sidebar-link'>
                            <i class="iconly-boldBag-2"></i>
                            <span>Transaksi Penjualan</span>
                        </a>
                    </li>

                <?php endif; ?>

                <li class="sidebar-title">Akun</li>

                <li class="sidebar-item">
                    <a href="<?= base_url('logout') ?>" class="sidebar-link" onclick="logoutConfirm(event)">
                        <i class="iconly-boldLogout"></i>
                        <span>Logout</span>
                    </a>
                </li>

            </ul>
        </div>
        <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
    </div>
</div>
<script>
    function logoutConfirm(e) {
        e.preventDefault();

        Swal.fire({
            title: 'Yakin ingin logout?',
            text: 'Sesi login akan diakhiri',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, Logout',
            cancelButtonText: 'Batal',
            confirmButtonColor: '#d33'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "<?= base_url('logout') ?>";
            }
        });
    }
</script>
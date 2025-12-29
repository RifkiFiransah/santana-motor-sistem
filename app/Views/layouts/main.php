<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Santana Motor' ?></title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('assets/compiled/css/bootstrap.css') ?>">

    <link rel="stylesheet" href="<?= base_url('assets/vendors/iconly/bold.css') ?>">

    <link rel="stylesheet" href="<?= base_url('assets/vendors/perfect-scrollbar/perfect-scrollbar.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/vendors/bootstrap-icons/bootstrap-icons.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/compiled/css/app.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/static/css/custom-sidebar.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/static/css/pwa.css') ?>">
    <link rel="shortcut icon" href="<?= base_url('assets/static/images/logo/santana-logo.png') ?>" type="image/png">

    <!-- PWA Manifest -->
    <link rel="manifest" href="<?= base_url('manifest.json') ?>">
    <meta name="theme-color" content="#2E7D32">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="apple-mobile-web-app-title" content="Santana Motor">
    <link rel="apple-touch-icon" href="<?= base_url('assets/static/images/logo/santana-logo.png') ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <?= $this->renderSection('styles') ?>
</head>

<body>
    <div id="app">
        <?= $this->include('partials/sidebar') ?>

        <div id="main">
            <?= $this->include('partials/header') ?>

            <div class="page-content">
                <?= $this->include('partials/alerts') ?>

                <?= $this->renderSection('content') ?>
            </div>

            <?= $this->include('partials/footer') ?>
        </div>
    </div>

    <div id="pwa-offline-indicator" class="pwa-offline-indicator" role="status" aria-live="polite">
        <span>Koneksi terputus. Beberapa data mungkin tidak terbaru.</span>
    </div>

    <!-- <div id="pwa-install-banner" class="pwa-banner" role="dialog" aria-live="polite" aria-label="Install aplikasi">
        <div class="pwa-banner__text">
            <span class="pwa-banner__title">Pasang <span data-pwa-app-name>Santana Motor</span></span>
            <span>Tambahkan ke layar utama untuk akses lebih cepat.</span>
        </div>
        <div class="pwa-banner__actions">
            <button type="button" class="btn btn-light btn-sm" data-pwa-install-confirm>Pasang</button>
            <button type="button" class="btn btn-outline-light btn-sm" data-pwa-install-dismiss>Tutup</button>
        </div>
    </div> -->

    <div id="pwa-update-banner" class="pwa-banner" role="dialog" aria-live="polite" aria-label="Pembaruan aplikasi">
        <div class="pwa-banner__text">
            <span class="pwa-banner__title">Pembaruan tersedia</span>
            <span>Muat ulang untuk mendapatkan versi terbaru.</span>
        </div>
        <div class="pwa-banner__actions">
            <button type="button" class="btn btn-light btn-sm" data-pwa-update-apply>Muat ulang</button>
            <button type="button" class="btn btn-outline-light btn-sm" data-pwa-update-dismiss>Tutup</button>
        </div>
    </div>

    <script src="<?= base_url('assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js') ?>"></script>
    <script src="<?= base_url('assets/compiled/js/bootstrap.bundle.min.js') ?>"></script>

    <script src="<?= base_url('assets/vendors/apexcharts/apexcharts.js') ?>"></script>
    <script src="<?= base_url('assets/compiled/js/pages/dashboard.js') ?>"></script>
    <script src="<?= base_url('assets/compiled/js/main.js') ?>"></script>
    <script>
        window.PWA_CONFIG = Object.assign({
            swUrl: '<?= base_url('service-worker.js') ?>',
            appName: 'Santana Motor'
        }, window.PWA_CONFIG || {});
    </script>
    <script src="<?= base_url('assets/compiled/js/pwa.js') ?>"></script>

    <?= $this->renderSection('scripts') ?>
</body>

</html>
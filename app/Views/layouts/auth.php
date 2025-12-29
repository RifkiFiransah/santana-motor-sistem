<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Login - Santana Motor' ?></title>
    
    <link rel="shortcut icon" href="<?= base_url('assets/static/images/logo/santana-logo.png') ?>" type="image/png">

    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('assets/compiled/css/bootstrap.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/vendors/bootstrap-icons/bootstrap-icons.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/compiled/css/app.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/compiled/css/pages/auth.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/static/css/pwa.css') ?>">

    <link rel="manifest" href="<?= base_url('manifest.json') ?>">
    <meta name="theme-color" content="#2E7D32">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="apple-mobile-web-app-title" content="Santana Motor">
    <link rel="apple-touch-icon" href="<?= base_url('assets/static/images/logo/santana-logo.png') ?>">
    
    <?= $this->renderSection('styles') ?>
</head>

<body>
    
    <?= $this->renderSection('content') ?>

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

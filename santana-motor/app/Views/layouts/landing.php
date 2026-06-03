<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Santana Motor</title>
    <link rel="stylesheet" href="<?= base_url('public/assets/css/pwa.css') ?>">
    <link rel="manifest" href="<?= base_url('public/manifest.webmanifest') ?>">
    <script>
        if ('serviceWorker' in navigator) {
            window.addEventListener('load', function() {
                navigator.serviceWorker.register('<?= base_url('public/service-worker.js') ?>')
                .then(function(registration) {
                    console.log('ServiceWorker registration successful with scope: ', registration.scope);
                }, function(err) {
                    console.log('ServiceWorker registration failed: ', err);
                });
            });
        }
    </script>
</head>
<body>
    <?= $this->renderSection('content') ?>
</body>
</html>
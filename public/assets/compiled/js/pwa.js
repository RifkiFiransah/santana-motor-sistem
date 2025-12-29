(function () {
    const config = window.PWA_CONFIG || {};
    const swUrl = config.swUrl || '/service-worker.js';
    const appName = config.appName || document.title || 'Aplikasi';

    const installBanner = document.getElementById('pwa-install-banner');
    const installConfirm = installBanner ? installBanner.querySelector('[data-pwa-install-confirm]') : null;
    const installDismiss = installBanner ? installBanner.querySelector('[data-pwa-install-dismiss]') : null;
    const installNameNodes = installBanner ? installBanner.querySelectorAll('[data-pwa-app-name]') : [];

    const updateBanner = document.getElementById('pwa-update-banner');
    const updateApply = updateBanner ? updateBanner.querySelector('[data-pwa-update-apply]') : null;
    const updateDismiss = updateBanner ? updateBanner.querySelector('[data-pwa-update-dismiss]') : null;

    const offlineIndicator = document.getElementById('pwa-offline-indicator');

    let deferredPrompt = null;
    let updateWorker = null;
    let isRefreshing = false;

    function showInstallBanner() {
        if (!installBanner) {
            return;
        }
        installNameNodes.forEach((node) => {
            node.textContent = appName;
        });
        installBanner.classList.add('pwa-banner--visible');
    }

    function hideInstallBanner() {
        if (!installBanner) {
            return;
        }
        installBanner.classList.remove('pwa-banner--visible');
    }

    function showUpdateBanner(worker) {
        if (!updateBanner) {
            return;
        }
        updateWorker = worker;
        updateBanner.classList.add('pwa-banner--visible');
    }

    function hideUpdateBanner() {
        if (!updateBanner) {
            return;
        }
        updateBanner.classList.remove('pwa-banner--visible');
        updateWorker = null;
    }

    function updateOnlineStatus() {
        if (!offlineIndicator) {
            return;
        }
        if (navigator.onLine) {
            offlineIndicator.classList.remove('pwa-offline-indicator--visible');
        } else {
            offlineIndicator.classList.add('pwa-offline-indicator--visible');
        }
    }

    if ('serviceWorker' in navigator) {
        window.addEventListener('load', function () {
            navigator.serviceWorker
                .register(swUrl)
                .then(function (registration) {
                    if (registration.waiting) {
                        showUpdateBanner(registration.waiting);
                    }

                    registration.addEventListener('updatefound', function () {
                        const newWorker = registration.installing;
                        if (!newWorker) {
                            return;
                        }

                        newWorker.addEventListener('statechange', function () {
                            if (newWorker.state === 'installed' && navigator.serviceWorker.controller) {
                                showUpdateBanner(newWorker);
                            }
                        });
                    });
                })
                .catch(function (error) {
                    console.warn('[PWA] Service Worker registration failed:', error);
                });
        });

        navigator.serviceWorker.addEventListener('controllerchange', function () {
            if (isRefreshing) {
                return;
            }
            isRefreshing = true;
            hideUpdateBanner();
            window.location.reload();
        });
    }

    window.addEventListener('beforeinstallprompt', function (event) {
        event.preventDefault();
        deferredPrompt = event;
        showInstallBanner();
    });

    window.addEventListener('appinstalled', function () {
        deferredPrompt = null;
        hideInstallBanner();
    });

    if (installConfirm) {
        installConfirm.addEventListener('click', function () {
            if (!deferredPrompt) {
                hideInstallBanner();
                return;
            }

            installConfirm.disabled = true;
            deferredPrompt.prompt();

            const choice = deferredPrompt.userChoice;
            const settle = function () {
                installConfirm.disabled = false;
                deferredPrompt = null;
                hideInstallBanner();
            };

            if (choice && typeof choice.then === 'function') {
                choice
                    .catch(function (error) {
                        console.warn('[PWA] Install prompt error:', error);
                    })
                    .finally(settle);
            } else {
                settle();
            }
        });
    }

    if (installDismiss) {
        installDismiss.addEventListener('click', function () {
            hideInstallBanner();
            deferredPrompt = null;
        });
    }

    if (updateApply) {
        updateApply.addEventListener('click', function () {
            if (updateWorker) {
                updateWorker.postMessage({ type: 'SKIP_WAITING' });
            }
        });
    }

    if (updateDismiss) {
        updateDismiss.addEventListener('click', function () {
            hideUpdateBanner();
        });
    }

    window.addEventListener('online', updateOnlineStatus);
    window.addEventListener('offline', updateOnlineStatus);
    updateOnlineStatus();
})();

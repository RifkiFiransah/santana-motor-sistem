const CACHE_VERSION = 'v1.1.0';
const CACHE_NAME = `santana-motor-${CACHE_VERSION}`;
const OFFLINE_URL = '/offline.html';

// Asset URLs to cache during service worker installation
const STATIC_ASSETS = [
    '/',
    '/index.php',
    '/manifest.json',
    '/offline.html',
    '/assets/compiled/css/bootstrap.css',
    '/assets/compiled/css/app.css',
    '/assets/compiled/css/pages/auth.css',
    '/assets/static/css/custom-sidebar.css',
    '/assets/compiled/js/bootstrap.bundle.min.js',
    '/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js',
    '/assets/vendors/apexcharts/apexcharts.js',
    '/assets/vendors/iconly/bold.css',
    '/assets/vendors/perfect-scrollbar/perfect-scrollbar.css',
    '/assets/vendors/bootstrap-icons/bootstrap-icons.css',
    '/assets/compiled/js/main.js',
    '/assets/compiled/js/pages/dashboard.js',
    '/assets/compiled/js/pwa.js',
    '/assets/static/css/pwa.css',
    '/assets/static/images/logo/santana-logo.png',
    // '/assets/static/images/logo/santana-logo.png',
];

// Install event - cache assets
self.addEventListener('install', (event) => {
    console.log('[Service Worker] Installing...');
    
    event.waitUntil(
        caches.open(CACHE_NAME).then((cache) => {
            console.log('[Service Worker] Caching static assets');
            return cache.addAll(STATIC_ASSETS).then(() => cache);
        }).then((cache) => {
            return cache.add(new Request(OFFLINE_URL, { cache: 'reload' })).catch((error) => {
                console.warn('[Service Worker] Offline page failed to cache', error);
            });
        }).then(() => {
            self.skipWaiting();
        })
    );
});

// Activate event - clean up old caches
self.addEventListener('activate', (event) => {
    console.log('[Service Worker] Activating...');
    
    event.waitUntil(
        caches.keys().then((cacheNames) => {
            return Promise.all(
                cacheNames
                    .filter(name => name !== CACHE_NAME)
                    .map((name) => {
                        console.log('[Service Worker] Deleting old cache:', name);
                        return caches.delete(name);
                    })
            );
        }).then(() => {
            self.clients.claim();
        })
    );
});

// Fetch event - serve from cache, fallback to network
self.addEventListener('fetch', (event) => {
    const { request } = event;
    const url = new URL(request.url);

    // Skip non-GET requests
    if (request.method !== 'GET') {
        return;
    }

    // Skip requests from different origin
    if (url.origin !== location.origin) {
        return;
    }

    // Skip API calls (let them go to network)
    if (url.pathname.includes('/api/')) {
        event.respondWith(networkFirst(request));
        return;
    }

    // For navigation requests - network first strategy
    if (request.mode === 'navigate' || request.headers.get('accept')?.includes('text/html')) {
        event.respondWith(networkFirst(request));
        return;
    }

    // For static assets - cache first strategy
    event.respondWith(cacheFirst(request));
});

/**
 * Cache first strategy - return cached version if available, fall back to network
 */
async function cacheFirst(request) {
    try {
        const cached = await caches.match(request);
        if (cached) {
            console.log('[Service Worker] Serving from cache:', request.url);
            return cached;
        }

        const response = await fetch(request);
        if (!response.ok) {
            throw new Error(`Network response was not ok: ${response.status}`);
        }

        // Cache successful responses
        const cache = await caches.open(CACHE_NAME);
        cache.put(request, response.clone());

        console.log('[Service Worker] Cached from network:', request.url);
        return response;
    } catch (error) {
        console.error('[Service Worker] Cache first failed:', error);
        
        // Return offline page if available
        const offline = await caches.match(OFFLINE_URL);
        if (offline) {
            return offline;
        }

        throw error;
    }
}

/**
 * Network first strategy - try network first, fall back to cache
 */
async function networkFirst(request) {
    try {
        const response = await fetch(request);

        // Treat redirects and auth responses as valid so we do not fall back to offline.html
        const isRedirect = response.type === 'opaqueredirect' || (response.status >= 300 && response.status < 400);
        const isAuthResponse = response.status === 401 || response.status === 403;

        if (!response.ok && !isRedirect && !isAuthResponse) {
            throw new Error(`Network response was not ok: ${response.status}`);
        }

        // Only cache successful same-origin responses
        if (response.ok && response.type === 'basic') {
            const cache = await caches.open(CACHE_NAME);
            cache.put(request, response.clone());
            console.log('[Service Worker] Fetched from network & cached:', request.url);
        } else {
            console.log('[Service Worker] Fetched from network (not cached):', request.url);
        }

        return response;
    } catch (error) {
        console.error('[Service Worker] Network fetch failed:', error);
        
        // Try to return cached version
        const cached = await caches.match(request);
        if (cached) {
            console.log('[Service Worker] Falling back to cache:', request.url);
            return cached;
        }

        // Return offline page for HTML requests
        if (request.headers.get('accept')?.includes('text/html')) {
            const offline = await caches.match(OFFLINE_URL);
            if (offline) {
                return offline;
            }
        }

        throw error;
    }
}

// Handle messages from clients
self.addEventListener('message', (event) => {
    if (event.data && event.data.type === 'SKIP_WAITING') {
        self.skipWaiting();
    }
});

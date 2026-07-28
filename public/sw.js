const CACHE_NAME = 'earthy-farms-cache-v2';
const ASSETS_TO_CACHE = [
  '/',
  '/manifest.json',
  '/pwa-icons/icon-192x192.png',
  '/pwa-icons/icon-512x512.png',
  '/pwa-icons/apple-touch-icon.png',
  '/pwa-icons/favicon-32x32.png',
  '/pwa-icons/favicon-16x16.png',
  '/favicon.ico'
];

// Install Service Worker - Resilient Caching
self.addEventListener('install', (event) => {
  event.waitUntil(
    caches.open(CACHE_NAME).then((cache) => {
      // Cache each asset individually and catch errors so a missing icon doesn't crash the PWA installation
      const cachePromises = ASSETS_TO_CACHE.map((asset) => {
        return cache.add(asset).catch((err) => {
          console.warn(`PWA pre-cache warning: Failed to cache ${asset}. Proceeding anyway.`, err);
        });
      });
      return Promise.all(cachePromises);
    }).then(() => self.skipWaiting())
  );
});

// Activate Service Worker
self.addEventListener('activate', (event) => {
  event.waitUntil(
    caches.keys().then((cacheNames) => {
      return Promise.all(
        cacheNames.map((cache) => {
          if (cache !== CACHE_NAME) {
            return caches.delete(cache);
          }
        })
      );
    }).then(() => self.clients.claim())
  );
});

// Fetch Strategy: Network First falling back to Cache
self.addEventListener('fetch', (event) => {
  // Only cache GET requests
  if (event.request.method !== 'GET') return;

  // Skip dynamic backend routes (like database entries, post actions) or API calls
  const url = new URL(event.request.url);
  if (
    url.pathname.startsWith('/livewire') || 
    url.pathname.startsWith('/api') || 
    url.pathname.includes('/logout') || 
    url.pathname.includes('/login') || 
    url.pathname.includes('/register')
  ) {
    return;
  }

  event.respondWith(
    fetch(event.request)
      .then((response) => {
        // If valid response, clone and cache it for static assets
        if (response && response.status === 200 && response.type === 'basic') {
          const responseToCache = response.clone();
          caches.open(CACHE_NAME).then((cache) => {
            cache.put(event.request, responseToCache);
          });
        }
        return response;
      })
      .catch(() => {
        // Fallback to cache if network fails
        return caches.match(event.request);
      })
  );
});

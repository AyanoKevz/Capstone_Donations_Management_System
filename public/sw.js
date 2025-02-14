const CACHE_NAME = "offline-cache";
const OFFLINE_URL = "/offline.html";

// Install event - Cache offline page
self.addEventListener("install", function (event) {
    event.waitUntil(
        caches.open(CACHE_NAME).then(function (cache) {
            return cache.addAll([OFFLINE_URL]);
        })
    );
    self.skipWaiting();
});

// Activate event - Ensure clients use service worker immediately
self.addEventListener("activate", function (event) {
    event.waitUntil(self.clients.claim());
});

// Fetch event - Serve offline.html when offline
self.addEventListener("fetch", function (event) {
    event.respondWith(
        fetch(event.request).catch(() => {
            return caches.match(OFFLINE_URL); // Serve offline.html if offline
        })
    );
});

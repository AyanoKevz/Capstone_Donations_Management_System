var phMap = L.map('map', { zoomControl: false }).setView([12.8797, 121.7740], 5);

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>'
}).addTo(phMap);

// Create a custom control for the "Zoom Out" button
var ZoomOutButton = L.Control.extend({
    onAdd: function(map) {
        var container = L.DomUtil.create('div', 'leaflet-bar leaflet-control leaflet-control-custom');
        var button = L.DomUtil.create('a', 'leaflet-bar-part', container);
        button.href = '#';
        button.innerHTML = 'Recenter'; // Text for the button
        button.title = 'Zoom Out';

        L.DomEvent.on(button, 'click', function(e) {
            L.DomEvent.stop(e); 
            phMap.setView([12.8797, 121.7740], 5);
        });

        return container;
    }
});


L.control.zoom({ position: 'topright' }).addTo(phMap);


var zoomOutButton = new ZoomOutButton({ position: 'topright' });
zoomOutButton.addTo(phMap);

var baseIconPath = "/assets/img/";

var causeIcons = {
    "Fire": "fire.png",
    "Flood": "flood.png",
    "Typhoon": "typhoon.png",
    "Earthquake": "earthquake.png",
    "Volcanic Eruption": "volcanic.png",
    "Feeding Program": "eat.png"
};

// Function to format location text
function formatLocation(region, province, city, barangay) {
    if (region === "NCR") {
        return `${barangay ? barangay + ", " : ""}${city}, Metro Manila, Philippines`;
    }
    return `${barangay ? barangay + ", " : ""}${city}, ${province}, ${region}, Philippines`;
}

var markersLayer = L.layerGroup().addTo(phMap);

// Function to add markers to the map
function addMarkers(requests) {
    markersLayer.clearLayers(); // Clear existing markers

    requests.forEach(request => {
        if (request.location) {
            var { region, province, city_municipality, barangay, latitude, longitude } = request.location;
            var iconUrl = baseIconPath + (causeIcons[request.cause] || "default.png");

            var icon = L.icon({
                iconUrl: iconUrl,
                iconSize: [25, 25], 
                iconAnchor: [16, 32],
                popupAnchor: [0, -32]
            });

            var popupContent = `
                <h4 class='mb-1'>
                    <img src="${iconUrl}" alt="${request.cause} icon" style="width: 22px; height: 22px; vertical-align: middle;"> 
                    <strong>
                    ${request.cause}
                    </strong>
                    <span class="text-muted fw-semibold fs-6 align-middle">(${request.urgency})</span>
                </h4>
                <strong>Location:</strong> ${formatLocation(region, province, city_municipality, barangay)} <br>
                <strong>Status:</strong> ${request.status} <br>
            `;

            // Add the marker to the map
            L.marker([latitude, longitude], { icon: icon })
                .addTo(markersLayer)
                .bindPopup(popupContent);
        }
    });
}

// Initial load: Show markers from the backend
addMarkers(donationRequests);

 document.getElementById('cause').addEventListener('change', function() {
        document.getElementById('filterForm').submit();
    });

    document.getElementById('urgency').addEventListener('change', function() {
        document.getElementById('filterForm').submit();
    });
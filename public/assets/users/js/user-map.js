// Initialize the map
var phMap = L.map('map', { zoomControl: false }).setView([12.8797, 121.7740], 5);

// Add the tile layer
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

// Add the default zoom control
L.control.zoom({ position: 'topright' }).addTo(phMap);

// Add the custom "Zoom Out" button control
var zoomOutButton = new ZoomOutButton({ position: 'topright' });
zoomOutButton.addTo(phMap);

// Base path for icons
var baseIconPath = "/assets/img/";

// Define cause icons
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

// Define region coordinates and zoom levels
var regionCoordinates = {
    "Ilocos Region": { center: [16.0833, 120.6667], zoom: 8 }, // Region I
    "Cagayan Valley": { center: [17.5833, 121.7167], zoom: 8 }, // Region II
    "Central Luzon": { center: [15.4833, 120.7833], zoom: 8 }, // Region III
    "CALABARZON": { center: [14.1000, 121.4167], zoom: 8 }, // Region IV-A
    "MIMAROPA Region": { center: [12.0000, 121.0000], zoom: 8 }, // MIMAROPA
    "Bicol Region": { center: [13.5833, 123.2833], zoom: 8 }, // Region V
    "Western Visayas": { center: [10.7167, 122.5667], zoom: 8 }, // Region VI
    "Central Visayas": { center: [10.3333, 123.8333], zoom: 8 }, // Region VII
    "Eastern Visayas": { center: [11.2500, 125.0000], zoom: 8 }, // Region VIII
    "Zamboanga Peninsula": { center: [8.0000, 123.0000], zoom: 8 }, // Region IX
    "Northern Mindanao": { center: [8.5000, 124.6667], zoom: 8 }, // Region X
    "Davao Region": { center: [7.0667, 125.6000], zoom: 8 }, // Region XI
    "SOCCSKSARGEN": { center: [6.5000, 124.8500], zoom: 8 }, // Region XII
    "NCR": { center: [14.5995, 120.9842], zoom: 11 }, // National Capital Region
    "CAR": { center: [16.8333, 120.8333], zoom: 8 }, // Cordillera Administrative Region
    "Caraga": { center: [8.7500, 125.5000], zoom: 8 }, // Region XIII
    "BARMM": { center: [7.2167, 124.2500], zoom: 8 }, // Bangsamoro Autonomous Region
};

// Layer group to manage markers
var markersLayer = L.layerGroup().addTo(phMap);

// Function to update the info sidebar with request details
function updateInfoSidebar(request) {
    var sidebar = document.getElementById('infoSidebar');
    var requestInfo = document.getElementById('requestInfo');

    // Generate the HTML for the sidebar
    var html = `
        <h2 class="text-center">${request.cause} (${request.urgency})</h2>
        <p class="mb-2"><strong>Location:</strong> ${formatLocation(request.location.region, request.location.province, request.location.city_municipality, request.location.barangay)}</p>
        <p class="mb-2"><strong>Status:</strong> ${request.status}</p>
        <p><strong>Description:</strong> ${request.description}</p>
        <hr>
        <h4>Requested Items</h4>
        <ul>
    `;

    // Add requested items to the HTML
    request.items.forEach(item => {
        html += `<li><strong>${item.item}:</strong> ${item.quantity}</li>`;
    });

    html += `</ul>`;

    // Add proof photos and video if available
    if (request.proof_photo_1 || request.proof_photo_2 || request.proof_video) {
        html += `<hr><h4>Proof Media</h4>`;

        // Display images side by side at the top
        if (request.proof_photo_1 || request.proof_photo_2) {
            html += `
                <div class="row">
                    <div class="col-6 mb-2">
                        ${request.proof_photo_1 ? `<img src="/storage/${request.proof_photo_1}" alt="Proof Photo 1" class="img-fluid" style="width: 100%; height: 200px; object-fit: cover;">` : ''}
                    </div>
                    <div class="col-6 mb-2">
                        ${request.proof_photo_2 ? `<img src="/storage/${request.proof_photo_2}" alt="Proof Photo 2" class="img-fluid" style="width: 100%; height: 200px; object-fit: cover;">` : ''}
                    </div>
                </div>
            `;
        }

        // Display video below the images
        if (request.proof_video) {
            html += `
                <div class="row">
                    <div class="col-12">
                        <video controls class="img-fluid" style="width: 100%; height: 200px; object-fit: cover;">
                            <source src="/storage/${request.proof_video}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    </div>
                </div>
            `;
        }
    }

    // Update the sidebar content
    requestInfo.innerHTML = html;
}

// Function to add markers to the map

function addMarkers(requests) {
    markersLayer.clearLayers(); 

    requests.forEach(request => {
        if (request.location) {
            var { region, province, city_municipality, barangay, latitude, longitude } = request.location;
            var iconUrl = baseIconPath + (causeIcons[request.cause] || "default.png");

            var icon = L.icon({
                iconUrl: iconUrl,
                iconSize: [30, 30], // Adjust marker size
                iconAnchor: [16, 32],
                popupAnchor: [0, -32]
            });

            // Generate the popup content
            var popupContent = `
                <h4 class='mb-1'>
                    <img src="${iconUrl}" alt="${request.cause} icon" style="width: 22px; height: 22px; vertical-align: middle;"> 
                    <strong>${request.cause}</strong>
                    <span class="text-muted fw-semibold fs-6 align-middle">(${request.urgency})</span>
                </h4>
                <strong>Location:</strong> ${formatLocation(region, province, city_municipality, barangay)} <br>
                <strong>Status:</strong> ${request.status} <br>
            `;

            // Add the marker to the map
            var marker = L.marker([latitude, longitude], { icon: icon })
                .addTo(markersLayer)
                .bindPopup(popupContent);

            // Add click event to update the sidebar and show the donate button
            marker.on('click', function() {
                updateInfoSidebar(request);

                // Show the donate button
                var donateBtn = document.getElementById('donateBtn');
                donateBtn.style.display = 'block';

                // Set the modal target dynamically
                donateBtn.setAttribute('data-bs-target', '#donateNow-' + request.id);
            });
        }
    });
}

// Initial load: Show markers from the backend
addMarkers(donationRequests);

// Submit the form when dropdowns change
document.getElementById('cause').addEventListener('change', function() {
    localStorage.setItem('selectedRegion', document.getElementById('region-filter').value);
    document.getElementById('filterForm').submit();
});

document.getElementById('urgency').addEventListener('change', function() {
    localStorage.setItem('selectedRegion', document.getElementById('region-filter').value);
    document.getElementById('filterForm').submit();
});

// Zoom in to the selected region
document.getElementById('region-filter').addEventListener('change', function(event) {
    var selectedRegion = event.target.value;

    if (regionCoordinates[selectedRegion]) {
        var { center, zoom } = regionCoordinates[selectedRegion];
        phMap.setView(center, zoom); // Zoom in without refreshing
    } else {
        phMap.setView([12.8797, 121.7740], 5);
    }

    filterRequests(selectedRegion);
});

function filterRequests(region) {
    // Simulate fetching filtered data (Replace this with an actual AJAX call)
    var filteredRequests = donationRequests.filter(request => request.location.region === region);
    addMarkers(filteredRequests);
}

window.addEventListener('load', function() {
    var savedRegion = localStorage.getItem('selectedRegion');

    if (savedRegion && regionCoordinates[savedRegion]) {
        var { center, zoom } = regionCoordinates[savedRegion];
        phMap.setView(center, zoom); // Restore zoom
    }
});

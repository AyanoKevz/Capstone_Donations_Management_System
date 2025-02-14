var chapterData = [];
var chapterMap = L.map('map', { zoomControl: false }).setView([12.8797, 121.7740], 6); 
var chapterLayer = L.featureGroup().addTo(chapterMap);

L.control.zoom({ position: 'topright' }).addTo(chapterMap);

var prcIcon = L.icon({
    iconUrl: prcIconUrl,
    iconSize: [20, 20],
    iconAnchor: [10, 10],
    popupAnchor: [0, -12]
});
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>'
}).addTo(chapterMap);

 function getChapterData() {
    $.ajax({
        type: 'GET',
        url: chaptersGeoJsonUrl,
        contentType: 'application/json',
        dataType: 'json',
        timeout: 10000,
        success: function (data) {
            console.log("Success!");
            chapterData = data;
            mapChapterdata();
        },
        error: function (e) {
            console.log(e);
        }
    });
}
function zoomOut() {
    var markersBounds = chapterLayer.getBounds();
    chapterMap.fitBounds(markersBounds);
}

function mapChapterdata() {
    var filteredData = {
        type: "FeatureCollection",
        features: chapterData.features.filter(function (feature) {
            return feature.properties.TYPE === "CHAPTER" || feature.properties.TYPE === "NHQ";
        })
    };

    var chapterMarkers = L.geoJson(filteredData, {
        pointToLayer: function (feature, latlng) {
            return L.marker(latlng, { icon: prcIcon }); 
        },
        onEachFeature: onEachChapter
    });
    chapterLayer.addLayer(chapterMarkers);
    var markersBounds = chapterLayer.getBounds();
    chapterMap.fitBounds(markersBounds);
}

function onEachChapter(feature, layer) {
    var popupContent = `<strong>${feature.properties.NAME}</strong><br>
                        Type: ${feature.properties.TYPE}`;
    if (feature.properties.ADDRESS) {
        popupContent += `<br>Address: ${feature.properties.ADDRESS}`;
    }
    if (feature.properties.N1) {
        popupContent += `<br>${feature.properties.N1_type}: ${feature.properties.N1}`;
    }
    if (feature.properties.N2) {
        popupContent += `<br>${feature.properties.N2_Type}: ${feature.properties.N2}`;
    }
    layer.bindPopup(popupContent);
    layer.on('click', function (e) {
        chapterClick(e);
    });
}

function chapterClick(e) {
    var chapterHtml = "";

    // Retain the search bar
    chapterHtml += `
        <div class="mb-3">
            <input type="text" id="searchChapter" class="form-control" placeholder="Search for a Chapter...">
        </div>
    `;

    var feature = e.target.feature;

    var chapterName = feature.properties.NAME || "Unknown";
    var chapterType = feature.properties.TYPE || "Unknown";
    var chapterAddress = feature.properties.ADDRESS || null;
    var chapterN1 = feature.properties.N1 || null;
    var chapterN1Type = feature.properties.N1_type || "Unknown";
    var chapterN2 = feature.properties.N2 || null;
    var chapterN2Type = feature.properties.N2_Type || "Unknown";
    var chapterImage = feature.properties.IMAGE 
        ? baseImageUrl + feature.properties.IMAGE
        : prcIconUrl;

    // Add chapter details below the search bar
    chapterHtml += `<h2>${chapterName}<small> (${chapterType})</small></h2>`;
    if (chapterAddress) {
        chapterHtml += `<p><strong>Address:</strong> ${chapterAddress}</p>`;
    }
    if (chapterN1) {
        chapterHtml += `<p><strong>${chapterN1Type}:</strong> ${chapterN1}</p>`;
    }
    if (chapterN2) {
        chapterHtml += `<p><strong>${chapterN2Type}:</strong> ${chapterN2}</p>`;
    }

    if (feature.properties.CHAIRMAN) {
        var chairman = feature.properties.CHAIRMAN;
        var chairmanTitle = feature.properties.Chairman_title || "Chairman";
        chapterHtml += `<h5>${chairman} <small class="text-muted">(${chairmanTitle})</small></h5>`;
    }

    if (feature.properties.Admin) {
        var admin = feature.properties.Admin;
        var adminTitle = feature.properties.Admin_Title || "Administrator";
        chapterHtml += `<h5>${admin} <small class="text-muted">(${adminTitle})</small></h5>`;
    }

    chapterHtml += `
        <img src="${chapterImage}" alt="${chapterName}" 
             style="width: 550px; height: 250px; object-fit: cover; margin-top: 10px;">
    `;

    // Update the sidebar with the search bar and chapter details
    $('#chapterInfo').html(chapterHtml);

    // Reattach the search functionality after updating the DOM
    attachSearchFunctionality();
}


function toTitleCase(str) {
    return str.replace(/\w\S*/g, function (txt) {
        return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();
    });
}

function attachSearchFunctionality() {
    document.getElementById('searchChapter').addEventListener('input', function () {
        var searchQuery = this.value.trim().toLowerCase();

        // Clear previous filters
        chapterLayer.clearLayers();

        // Filter chapters based on search query
        var filteredData = {
            type: "FeatureCollection",
            features: chapterData.features.filter(function (feature) {
                return feature.properties.NAME.toLowerCase().includes(searchQuery) &&
                       (feature.properties.TYPE === "CHAPTER" || feature.properties.TYPE === "NHQ");
            })
        };

        // Re-add filtered markers
        var filteredMarkers = L.geoJson(filteredData, {
            pointToLayer: function (feature, latlng) {
                return L.marker(latlng, { icon: prcIcon });
            },
            onEachFeature: onEachChapter
        });

        chapterLayer.addLayer(filteredMarkers);

        // Adjust the map view to show filtered markers
        if (filteredData.features.length > 0) {
            var bounds = chapterLayer.getBounds();
            chapterMap.fitBounds(bounds);
        }
    });
}


  attachSearchFunctionality();

getChapterData();

// Adjust map height on screen resize
$(window).resize(function () {
    mapHeight = $(window).height() - 90;
    $("#map").height(mapHeight);
});

 document.querySelector(".btn-zoom").addEventListener("click", function () {
        var markersBounds = chapterLayer.getBounds();
        chapterMap.fitBounds(markersBounds);
    });
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

var markersLayer = L.layerGroup().addTo(phMap);

// Function to update the info sidebar with request details
function updateInfoSidebar(request, isFundRequest = false) {
    var sidebar = document.getElementById('infoSidebar');
    var requestInfo = document.getElementById('requestInfo');
    let urgencyColor = "";
    if (request.urgency === "Low") {
        urgencyColor = "text-success";
    } else if (request.urgency === "Moderate") {
        urgencyColor = "text-warning";
    } else if (request.urgency === "Critical") {
        urgencyColor = "text-danger";
    }
var title = isFundRequest ? "Fund Request" : "In-Kind Request";
var image = isFundRequest ? baseIconPath + "quick-cash.png" : baseIconPath + "quick-item.png";

    var html = `
        <div class="d-flex align-items-center justify-content-center mb-4">
          <h1 class="text-center mb-0">${title}</h1>
            <img src="${image}" alt="${title}" style="width: 40px;  margin-left: 10px; vertical-align: middle">
        </div>
        <h2 class="text-center">${request.cause}
            <span class="${urgencyColor}">(${request.urgency})</span>
        </h2>
        <p class="mb-2"><strong>Location:</strong> ${formatLocation(request.location.region, request.location.province, request.location.city_municipality, request.location.barangay)}</p>
        <p class="mb-2"> <strong>Status:</strong> <span class="text-success fw-bold">${request.status}</span></p>
        <p><strong>Description:</strong> ${request.description}</p>
        <hr>
    `;

    if (isFundRequest) {
        // Add fund request details
        html += `
            <h4>Fund Details</h4>
            <p><strong>Amount Needed:</strong> ₱${request.amount_needed} / <strong>Amount Raised:</strong> ₱${request.amount_raised}</p>
        `;
    } else {
        // Add in-kind donation details
        html += `
            <h4>Requested Items</h4>
            <ul class="list-group">
                ${request.items.map(item => `
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span><strong>${item.item}:</strong> ${item.quantity}</span>
                        <span class="badge bg-success">Donated: ${item.donated_quantity || 0}</span>
                    </li>
                `).join('')}
            </ul>
        `;
    }

    // Proof media
    if (request.proof_photo_1 || request.proof_photo_2 || request.proof_video) {
        html += `<hr><h4>Proof Media</h4>`;

        if (request.proof_photo_1 || request.proof_photo_2) {
            html += `
                <div class="row">
                    <div class="col-6 mb-2">
                        ${request.proof_photo_1 ? `<img src="/storage/${request.proof_photo_1}" alt="Proof Photo 1" class="req-img">` : ''}
                    </div>
                    <div class="col-6 mb-2">
                        ${request.proof_photo_2 ? `<img src="/storage/${request.proof_photo_2}" alt="Proof Photo 2" class="req-img">` : ''}
                    </div>
                </div>
            `;
        }
        if (request.proof_video) {
            html += `
                <div class="row">
                    <div class="col-12">
                        <video controls class="img-fluid rounded">
                            <source src="/storage/${request.proof_video}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    </div>
                </div>
            `;
        }
    }

    requestInfo.innerHTML = html;
}

// Function to add markers to the map
function addMarkers(requests, isFundRequest = false) {
    markersLayer.clearLayers();

    requests.forEach(request => {
        if (request.location) {
            var { region, province, city_municipality, barangay, latitude, longitude } = request.location;
            var iconUrl = baseIconPath + (causeIcons[request.cause] || "default.png");

            var icon = L.icon({
                iconUrl: iconUrl,
                iconSize: [30, 30],
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
                updateInfoSidebar(request, isFundRequest);

                // Show the donate button
                var donateBtn = document.getElementById('donateBtn');
                donateBtn.style.display = 'block';

                // Set the modal target dynamically for the request
                donateBtn.setAttribute('data-bs-target', `#donateNow-${request.id}`);
            });
        }
    });
}

// Determine if the current view is for cash donations
var isCashView = fundRequests.length > 0;

// Initial load: Show markers based on the current view
if (isCashView) {
    addMarkers(fundRequests, true); // For cash donations
} else {
    addMarkers(donationRequests); // For in-kind donations
}

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

// Add event listener to the item-filter dropdown
document.getElementById('item-filter').addEventListener('change', function(event) {
    var selectedValue = event.target.value;

    if (selectedValue === 'cash') {
        // Redirect to the cash route
        window.location.href = "/user/donor/request-map/cash";
    } else {
        // Redirect to the default items route
        window.location.href = "/user/donor/request-map/items";
    }
});

// Function to filter requests based on region
function filterRequests(region) {
    var filteredDonationRequests = donationRequests.filter(request => request.location.region === region);
    var filteredFundRequests = fundRequests.filter(request => request.location.region === region);

    // Clear existing markers
    markersLayer.clearLayers();

    // Add filtered markers
    addMarkers(filteredDonationRequests); // For in-kind donations
    addMarkers(filteredFundRequests, true); // For cash donations
}

// Restore the selected region on page load
window.addEventListener('load', function() {
    var savedRegion = localStorage.getItem('selectedRegion');

    if (savedRegion && regionCoordinates[savedRegion]) {
        var { center, zoom } = regionCoordinates[savedRegion];
        phMap.setView(center, zoom); // Restore zoom
    }
});

 $(".cash-donation-form").each(function () {
        $(this).validate({
            rules: {
                donor_name: {
                    required: true,
                    minlength: 2
                },
                chapter_id: {
                    required: true
                },
                donation_method: {
                    required: true
                },
                payment_method: {
                    required: function (element) {
                        return $(element).closest("form").find(".donation-method").val() === "online";
                    }
                },
                amount: {
                    required: true,
                    min: 1
                }
            },
            messages: {
                donor_name: {
                    required: "Please enter your name",
                    minlength: "Your name must be at least 2 characters long"
                },
                chapter_id: {
                    required: "Please select a chapter"
                },
                donation_method: {
                    required: "Please select a donation method"
                },
                payment_method: {
                    required: "Please select a payment method for online donations"
                },
                amount: {
                    required: "Please enter a donation amount",
                    min: "Donation amount must be at least 1"
                }
            },
            highlight: function (element) {
                $(element).addClass("is-invalid").removeClass("is-valid");
            },
            unhighlight: function (element) {
                $(element).removeClass("is-invalid").addClass("is-valid");
            },
            errorPlacement: function (error, element) {
                error.insertAfter(element);
            },
            submitHandler: function (form) {
                form.submit();
            }
        });
    });

    // Handle Anonymous Checkbox Logic
    $(".anonymous-checkbox").on("change", function () {
        let form = $(this).closest("form");
        let donorNameInput = form.find(".donor-name");
        
        if ($(this).is(":checked")) {
            donorNameInput.val("Anonymous").prop("readonly", true);
        } else {
            donorNameInput.val(donorNameInput.data("original-name")).prop("readonly", false);
        }
    });

    // Show Payment Method dropdown when "Online" is selected
    $(".donation-method").on("change", function () {
        let form = $(this).closest("form");
        let paymentRow = form.find(".payment-method-row");

        if ($(this).val() === "online") {
            paymentRow.removeClass("d-none");
        } else {
            paymentRow.addClass("d-none");
            form.find("[name='payment_method']").val(""); // Reset selection
        }
    });

    $(".donation-form").each(function () {
        $(this).validate({
            rules: {
                donor_name: {
                    required: true,
                    minlength: 2
                },
                donation_method: {
                    required: true
                },
                donation_datetime: {
                    required: true
                },
                chapter_id: {
                    required: true
                },
                pickup_address: {
                    required: {
                        depends: function (element) {
                            return $(element).closest("form").find(".donation_method").val() === "pickup";
                        }
                    }
                }
            },
            messages: {
                donor_name: {
                    required: "Please enter your name",
                    minlength: "Your name must be at least 2 characters long"
                },
                donation_method: {
                    required: "Please select a donation method"
                },
                donation_datetime: {
                    required: "Please select a donation date and time"
                },
                chapter_id: {
                    required: "Please select a chapter"
                },
                pickup_address: {
                    required: "Please enter the pickup address"
                }
            },
            highlight: function (element) {
                $(element).addClass('is-invalid').removeClass('is-valid');
            },
            unhighlight: function (element) {
                $(element).addClass('is-valid').removeClass('is-invalid');
            },
            errorPlacement: function (error, element) {
                error.insertAfter(element);
            },
            submitHandler: function (form) {
                form.submit();
            }
        });
    });

    // Handle pickup address visibility dynamically for each modal
    $(document).on("change", ".donation_method", function () {
        const form = $(this).closest("form");
        const pickupAddressDiv = form.find(".pickup_address_div");
        if ($(this).val() === "pickup") {
            pickupAddressDiv.removeClass("d-none");
        } else {
            pickupAddressDiv.addClass("d-none");
            form.find(".pickup_address").val(""); // Clear the pickup address field
        }
    });

    // Function to show/hide submit button when file is selected
    function updateSubmitButtonVisibility(modalId) {
        const fileInput = $(`#imageFile-${modalId}`);
        const submitButton = $(`#donateNowButton-${modalId}`);

        if (fileInput[0].files && fileInput[0].files.length > 0) {
            submitButton.css('display', 'inline-block');
        } else {
            submitButton.css('display', 'none');
        }
    }

    // Monitor file input changes dynamically
    $(document).on('change', '[id^="imageFile-"]', function () {
        const modalId = this.id.split('-')[1]; // Extract modal ID
        updateSubmitButtonVisibility(modalId);
    });

    window.updateSubmitButtonVisibility = updateSubmitButtonVisibility;

    


function initializePhotoCapture(requestId) {
    const video = document.getElementById(`video-${requestId}`);
    const canvas = document.getElementById(`overlay-${requestId}`);
    const timerDisplay = document.getElementById(`timer-${requestId}`);
    const toggleCameraBtn = document.getElementById(`toggleCameraBtn-${requestId}`);
    const imageFileInput = document.getElementById(`imageFile-${requestId}`);
    const preview = document.getElementById(`preview-${requestId}`);
    canvas.style.background = 'black';

    let videoStream = null;
    let captureTimeout = null;
    let countdown = 2;
    let detecting = false;
    let detectionInterval = null;

    // Start webcam
    async function startVideo() {
        try {
            const stream = await navigator.mediaDevices.getUserMedia({ video: {} });
            videoStream = stream;
            video.srcObject = videoStream;
            video.style.display = 'block';
            canvas.style.background = 'none';

            video.onloadedmetadata = () => {
                adjustOverlaySize();
                detectFace();
            };

            detecting = true;
            toggleCameraBtn.textContent = 'Turn Off Camera';
        } catch (error) {
            console.error('Error accessing webcam:', error);
            alert('Unable to access the camera. Please check permissions.');
        }
    }

    // Stop webcam
    function stopVideo() {
        if (videoStream) {
            const tracks = videoStream.getTracks();
            tracks.forEach(track => track.stop());
        }
        videoStream = null;
        detecting = false;
        video.style.display = 'none';
        canvas.getContext('2d').clearRect(0, 0, canvas.width, canvas.height);
        canvas.style.background = 'black';

        if (detectionInterval) {
            clearInterval(detectionInterval);
            detectionInterval = null;
        }

        if (captureTimeout) {
            clearInterval(captureTimeout);
            captureTimeout = null;
        }

        resetCountdown();
        toggleCameraBtn.textContent = 'Turn On Camera';
    }

    // Toggle camera on/off
    toggleCameraBtn.addEventListener('click', () => {
        if (detecting) {
            stopVideo();
        } else {
            startVideo();
        }
    });

    // Load face-api models
    async function loadModels() {
        try {
            await faceapi.nets.tinyFaceDetector.loadFromUri('/lib/face-api.js/weights');
            await faceapi.nets.faceLandmark68Net.loadFromUri('/lib/face-api.js/weights');
            await faceapi.nets.faceRecognitionNet.loadFromUri('/lib/face-api.js/weights');
        } catch (error) {
            console.error('Error loading face-api models:', error);
        }
    }

    // Adjust overlay canvas size
    function adjustOverlaySize() {
        const videoDisplaySize = video.getBoundingClientRect();
        canvas.width = videoDisplaySize.width;
        canvas.height = videoDisplaySize.height;
        faceapi.matchDimensions(canvas, videoDisplaySize);
    }

    // Detect faces
    async function detectFace() {
        const displaySize = { width: video.clientWidth, height: video.clientHeight };
        faceapi.matchDimensions(canvas, displaySize);

        if (detectionInterval) {
            clearInterval(detectionInterval);
            detectionInterval = null;
        }

        detectionInterval = setInterval(async () => {
            if (!detecting) {
                clearInterval(detectionInterval);
                detectionInterval = null;
                return;
            }

            try {
                const options = new faceapi.TinyFaceDetectorOptions({
                    inputSize: 512,
                    scoreThreshold: 0.5
                });
                const detections = await faceapi.detectAllFaces(video, options);

                if (!detecting) {
                    return;
                }

                const resizedDetections = faceapi.resizeResults(detections, displaySize);
                const ctx = canvas.getContext('2d');
                if (ctx) {
                    ctx.clearRect(0, 0, canvas.width, canvas.height);
                }

                if (resizedDetections.length > 0) {
                    faceapi.draw.drawDetections(canvas, resizedDetections);
                    startCountdown();
                } else {
                    resetCountdown();
                }
            } catch (error) {
                console.error('Error during face detection:', error);
            }
        }, 100);
    }

    // Start countdown
    function startCountdown() {
        if (captureTimeout === null) {
            timerDisplay.style.display = 'block';
            countdown = 2;
            timerDisplay.textContent = `Timer: ${countdown}`;

            captureTimeout = setInterval(() => {
                countdown--;
                timerDisplay.textContent = `Timer: ${countdown}`;

                if (countdown <= 0) {
                    captureImage();
                    resetCountdown();
                }
            }, 1000);
        }
    }

    // Reset countdown
    function resetCountdown() {
        if (captureTimeout) {
            clearInterval(captureTimeout);
            captureTimeout = null;
        }
        countdown = 2;
        timerDisplay.textContent = `Timer: ${countdown}`;
        timerDisplay.style.display = 'none';
    }

    // Capture image
    function captureImage() {
        const context = canvas.getContext('2d');
        if (context) {
            context.drawImage(video, 0, 0, canvas.width, canvas.height);
        }
        const imageData = canvas.toDataURL('image/png');

        const modalPreviewImg = document.getElementById(`reviewUserImage-${requestId}`);
        if (modalPreviewImg) {
            modalPreviewImg.src = imageData;
        }

        const file = dataURLtoFile(imageData, 'captured.png');
        const dataTransfer = new DataTransfer();
        dataTransfer.items.add(file);
        imageFileInput.files = dataTransfer.files;
        if (typeof window.updateSubmitButtonVisibility === 'function') {
        window.updateSubmitButtonVisibility(requestId);
        }

        const img = document.createElement('img');
        img.src = imageData;
        img.width = 250;
        img.height = 200;
        preview.innerHTML = '';
        preview.appendChild(img);

        stopVideo();
    }

    // Convert base64 to file
    function dataURLtoFile(dataurl, filename) {
        const arr = dataurl.split(',');
        const mime = arr[0].match(/:(.*?);/)[1];
        const bstr = atob(arr[1]);
        let n = bstr.length;
        const u8arr = new Uint8Array(n);
        while (n--) {
            u8arr[n] = bstr.charCodeAt(n);
        }
        return new File([u8arr], filename, { type: mime });
    }

    loadModels();
}

donationRequests.forEach(request => {
    initializePhotoCapture(request.id);
});


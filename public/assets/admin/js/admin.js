document.addEventListener("DOMContentLoaded", function () {

var spinnerElement = document.getElementById("spinner");

    if (spinnerElement) {
        window.addEventListener("beforeunload", function () {
            spinnerElement.classList.add("show");
        });

        window.addEventListener("load", function () {
            spinnerElement.classList.remove("show");
        });
    }

  // Initialize tooltips for nav links with a title attribute
  var tooltipTriggerList = [].slice.call(
    document.querySelectorAll(".sb-sidenav .nav-link[title]")
  );
  var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl, {
      placement: "right",
      trigger: "hover",
      container: "body", 
    });
  });


  function updateTooltips() {
    var isMinimized = document.body.classList.contains("sb-sidenav-toggled");
    tooltipList.forEach(function (tooltip) {
      if (isMinimized) {
        tooltip.enable();
      } else {
        tooltip.disable();
        tooltip.hide(); 
      }
    });
  }

  updateTooltips();

  // Toggle the sidebar
  var sidebarToggle = document.getElementById("sidebarToggle");
  if (sidebarToggle) {
    sidebarToggle.addEventListener("click", function (event) {
      event.preventDefault();
      document.body.classList.toggle("sb-sidenav-toggled");
      // Update tooltips after toggling the sidebar
      updateTooltips();
    });
  }

 function updateDateTime() {
  const breadcrumbItem = document.querySelector(".breadcrumb-item.active");
  if (breadcrumbItem) {
    const now = new Date();
    const timeAndDate = `Date: ${now.toLocaleDateString()} <br>Time: ${now.toLocaleTimeString()}`;
    breadcrumbItem.innerHTML = timeAndDate;
  }
}
  updateDateTime();
  setInterval(updateDateTime, 1000);


 $(function () {
    if ($("#example1").length) {
        $("#example1").DataTable({
            responsive: true,
            lengthChange: false,
            autoWidth: false,
            buttons: ["copy", "csv", "excel", "pdf", "print"],
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    }
});


  if ($("#admin-login").length > 0) {
        $("#admin-login").validate({
            rules: {
                username: {
                    required: true,
                    minlength: 8
                },
                password: {
                    required: true,
                    minlength: 8
                },
                cpassword: {
                    required: true,
                    equalTo: "#password"
                },
                email: {
                    required: true,
                    email: true
                }
            },
            messages: {
                username: {
                    required: "Please enter a username",
                    minlength: "Your username must be at least 8 characters long"
                },
                password: {
                    required: "Please enter a password",
                    minlength: "Your password must be at least 8 characters long"
                },
                cpassword: {
                    required: "Please confirm your password",
                    equalTo: "Passwords do not match"
                },
                email: {
                    required: "Please enter a valid email address",
                    email: "Please enter a valid email address"
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
    }
       
    if ($("#compose-textarea").length > 0) {
      $('#compose-textarea').summernote({
        placeholder: 'Write your message here...',
        tabsize: 2,
        height: 300,
        toolbar: [
          ['style', ['bold', 'italic', 'underline', 'clear']],
          ['font', ['strikethrough', 'superscript', 'subscript']],
          ['fontsize', ['fontsize']],
          ['color', ['color']],
          ['para', ['ul', 'ol', 'paragraph']],
          ['height', ['height']],
        ]
      });
    }


    const toggleButton = $('.checkbox-toggle'); 
    const checkboxes = $('input[type="checkbox"][name="selected[]"]'); 
    let allChecked = false; 

    toggleButton.on('click', function () {
    allChecked = !allChecked; 
    checkboxes.prop('checked', allChecked);
    });

    setTimeout(() => {
        $('#alert-success').fadeOut();
        $('#alert-error').fadeOut();
          $('#alert-info').fadeOut();
    }, 8000);
    

     // Toggle visibility for the "current password" field
$('#toggle-opassword').on('click', function () {
  const oldpasswordInput = $('#oldPassword');
  const toggleIcon = $('#toggle-opassword-icon');

  // Toggle password type between 'password' and 'text'
  if (oldpasswordInput.attr('type') === 'password') {
    oldpasswordInput.attr('type', 'text'); // Show password
    toggleIcon.removeClass('fa-eye').addClass('fa-eye-slash'); // Change icon to eye-slash
  } else {
    oldpasswordInput.attr('type', 'password'); // Hide password
    toggleIcon.removeClass('fa-eye-slash').addClass('fa-eye'); // Change icon to eye
  }
});
        
        
     // Toggle visibility for the "password" field
$('#toggle-password').on('click', function () {
  const passwordInput = $('#password');
  const toggleIcon = $('#toggle-password-icon');

  // Toggle password type between 'password' and 'text'
  if (passwordInput.attr('type') === 'password') {
    passwordInput.attr('type', 'text'); // Show password
    toggleIcon.removeClass('fa-eye').addClass('fa-eye-slash'); // Change icon to eye-slash
  } else {
    passwordInput.attr('type', 'password'); // Hide password
    toggleIcon.removeClass('fa-eye-slash').addClass('fa-eye'); // Change icon to eye
  }
});

// Toggle visibility for the "confirm password" field
$('#toggle-cpassword').on('click', function () {
  const cpasswordInput = $('#cpassword');
  const toggleIcon = $('#toggle-cpassword-icon');

  // Toggle password type between 'password' and 'text'
  if (cpasswordInput.attr('type') === 'password') {
    cpasswordInput.attr('type', 'text'); // Show password
    toggleIcon.removeClass('fa-eye').addClass('fa-eye-slash'); // Change icon to eye-slash
  } else {
    cpasswordInput.attr('type', 'password'); // Hide password
    toggleIcon.removeClass('fa-eye-slash').addClass('fa-eye'); // Change icon to eye
  }
});

if ($("#admin_acount_form").length > 0) {

$("#admin_acount_form").validate({
            rules: {
                username: {
                    required: true,
                    minlength: 8
                },
                oldPassword: {
                    required: true,
                    minlength: 8
                },
                password: {
                    required: true,
                    minlength: 8
                },
                password_confirmation: {
                    required: true,
                    equalTo: "#password"
                },
            
            },
            messages: {
                username: {
                    required: "Please enter a username",
                    minlength: "Your username must be at least 8 characters long"
                },
                oldPassword: {
                    required: "Please enter your old password",
                    minlength: "Your password must be at least 8 characters long"
                },
                password: {
                    required: "Please enter a password",
                    minlength: "Your password must be at least 8 characters long"
                },
                password_confirmation: {
                    required: "Please confirm your password",
                    equalTo: "Passwords do not match"
                },
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

    }
        
        if ($("#admin_profile_form").length > 0) {
        
            $("#admin_profile_form").validate({
                rules: {
                    email: {
                        required: true,
                        email: true
                    },
                    name: {
                        required: true,
                    
                    }
                },
                messages: {
                    
                    email: {
                        required: "Please enter a valid email address",
                        email: "Please enter a valid email address"
                    },
                    name: {
                        required: "Please enter your name",
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

        }

        if ($("#news_form").length > 0) {

                    $("#news_form").validate({
                rules: {
                    image_url_1: {
                        required: true,
                        extension: "jpg|jpeg|png"
                    },
                    image_url_2: {
                        required: true,
                        extension: "jpg|jpeg|png"
                    },
                    subtitle: {
                        required: true,
                        maxlength: 15
                    },
                    title: {
                        required: true,
                        maxlength: 25
                    }
                
                },
                messages: {
                    image_url_1: {
                        required: "Please upload an image",
                        extension: "Please upload a valid image (jpg, jpeg, png)"
                    },
                    image_url_2: {
                        required: "Please upload an image",
                        extension: "Please upload a valid image (jpg, jpeg, png)"
                    },
                    subtitle: {
                        required: "Please enter a subtitle",
                        maxlength: "Subtitle must be less than 15 characters"
                    },
                    title: {
                        required: "Please enter a title",
                        maxlength: "Title must be less than 25 characters"
                    },
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
        }

if ($("#news_form_update").length > 0) {

                    $("#news_form_update").validate({
                rules: {
                    image_url_1: {
                        extension: "jpg|jpeg|png"
                    },
                    image_url_2: {
                        extension: "jpg|jpeg|png"
                    },
                    subtitle: {
                        required: true,
                        maxlength: 15
                    },
                    title: {
                        required: true,
                        maxlength: 25
                    }
                
                },
                messages: {
                    image_url_1: {
                        extension: "Please upload a valid image (jpg, jpeg, png)"
                    },
                    image_url_2: {
                        extension: "Please upload a valid image (jpg, jpeg, png)"
                    },
                    subtitle: {
                        required: "Please enter a subtitle",
                        maxlength: "Subtitle must be less than 15 characters"
                    },
                    title: {
                        required: "Please enter a title",
                        maxlength: "Title must be less than 25 characters"
                    },
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
        }

  if ($("#inKindForm").length > 0) {
    $("#inKindForm").validate({
        rules: {
            cause: { required: true },
            urgency: { required: true },
            region: { required: true },
            province: { required: true },
            city: { required: true },
            barangay: { required: true },
            description: {
                required: true,
                minlength: 10,
            },
            "categories[]": { required: true },
            "items[]": { required: true }
        },
        messages: {
            cause: { required: "Please select a cause." },
            urgency: { required: "Please select the urgency level." },
            region: { required: "Please select a region." },
            province: { required: "Please select a province." },
            city: { required: "Please select a city/municipality." },
            barangay: { required: "Please select a barangay." },
            description: {
                required: "Please provide a description.",
                minlength: "Description must be at least 10 characters long.",
            },
            "categories[]": { required: "Select a category." },
            "items[]": { required: "Please select an item." }
            // Removed "quantities[]" messages
        },
        highlight: function (element) {
            $(element).addClass("is-invalid").removeClass("is-valid");
        },
        unhighlight: function (element) {
            $(element).removeClass("is-invalid").addClass("is-valid");
            $(element).next(".error").remove(); 
        },
        errorPlacement: function (error, element) {
            error.insertAfter(element);
        },
        submitHandler: function (form) {
            let valid = true;
            $(".item-entry").each(function () {
                const category = $(this).find(".category-select");
                const item = $(this).find(".item-select");

                // Remove previous errors
                category.next(".error").remove();
                item.next(".error").remove();

                if (!category.val()) {
                    category.addClass("is-invalid");
                    category.after('<label class="error text-danger">Select a category</label>');
                    valid = false;
                } else {
                    category.removeClass("is-invalid").addClass("is-valid");
                }

                if (!item.val()) {
                    item.addClass("is-invalid");
                    item.after('<label class="error text-danger">Select an item</label>');
                    valid = false;
                } else {
                    item.removeClass("is-invalid").addClass("is-valid");
                }
            });

            if (valid) {
                form.submit();
            }
        },
    });
}

// Show selected file names
$(".file-input").change(function () {
    let fileInput = $(this)[0];
    let fileName = fileInput.files.length > 0 ? fileInput.files[0].name : "";
    let fileLabel = $(this).attr("id"); // Get input ID

    if (fileLabel === "proof_photo_1") {
        $("#file-name-1").text(fileName);
    } else if (fileLabel === "proof_photo_2") {
        $("#file-name-2").text(fileName);
    } else if (fileLabel === "proof_video") {
        $("#file-name-video").text(fileName);
    }
});



$('#file-input').change(function (event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                $('#imagePreview').attr('src', e.target.result);
            };
            reader.readAsDataURL(file);
        }
    });

    $('#image1').change(function (event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                $('#imagePreviewOne').attr('src', e.target.result);
            };
            reader.readAsDataURL(file);
        }
    });

     $('#image2').change(function (event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                $('#imagePreviewTwo').attr('src', e.target.result);
            };
            reader.readAsDataURL(file);
        }
    });

     $('#toggle-password-section').click(function () {
            $('#password-section').toggle();
        });

const API_BASE_URL = "https://psgc.gitlab.io/api";

initializeRegionDropdown();
$('#region').on('change', handleRegionChange);
$('#province').on('change', handleProvinceChange);
$('#city').on('change', handleCityChange);
$('#barangay').on('change', handleBarangayChange);

/**
 * Initialize the Region dropdown by fetching data from the PSGC API.
 */
function initializeRegionDropdown() {
    $.getJSON(`${API_BASE_URL}/regions/`, function(data) {
        const regionDropdown = $('#region');
        regionDropdown.empty().append('<option disabled selected value="">Select Region</option>');
        data.forEach(region => {
            regionDropdown.append(`<option value="${region.code}" data-name="${region.name}">${region.name}</option>`);
        });
    }).fail(function() {
        console.error("Failed to load regions.");
    });
}

/**
 * Handle region selection and load corresponding provinces or cities directly for NCR.
 */
function handleRegionChange() {
    const regionCode = this.value;  // Get the selected region code
    const regionName = $('option:selected', this).text(); // Get the name from the selected option
    
    if (!regionCode) return;  // Exit if no region is selected

    // Store the region name in a hidden input field
    $('#region-name').val(regionName);  // Assuming you have a hidden input field with id="region-name"
    
    // Special handling for NCR (no provinces)
    if (regionCode === "130000000") { // NCR region code
        handleNCRRegion();
    } else {
        loadProvinces(regionCode);  // Use the region code to load provinces
    }
}

/**
 * Handle NCR region by skipping the province dropdown and directly loading cities.
 */
function handleNCRRegion() {
    // Set "N/A" for province dropdown
    $('#province').empty().append('<option selected value="N/A">N/A</option>');
    
    // Set the hidden input to "N/A"
    $('#province-name').val('N/A');
    
    // Load cities directly for NCR
    loadCitiesForRegion("130000000");
}

/**
 * Load provinces for the selected region.
 * @param {string} regionCode - The region code for which to fetch provinces.
 */
function loadProvinces(regionCode) {
    $.getJSON(`${API_BASE_URL}/regions/${regionCode}/provinces/`, function(data) {
        const provinceDropdown = $('#province');
        provinceDropdown.empty().append('<option disabled selected value="">Select Province</option>');
        if (data.length > 0) {
            data.forEach(province => {
                provinceDropdown.append(`<option value="${province.code}" data-name="${province.name}">${province.name}</option>`);
            });
        } else {
            console.warn('No provinces found for this region.');
            provinceDropdown.append('<option disabled selected value="">N/A</option>');
        }

        resetDropdown('#city', 'Select City');
        resetDropdown('#barangay', 'Select Barangay');
    }).fail(function() {
        console.error("Failed to load provinces for the selected region.");
    });
}

/**
 * Handle province selection and load corresponding cities/municipalities.
 */
function handleProvinceChange() {
    const provinceCode = this.value;
    const provinceName = $('option:selected', this).text(); // Get the name from the selected option
    
    if (provinceCode) {
        $('#province-name').val(provinceName);  // Store the province name in the hidden input field
        loadCitiesForProvince(provinceCode);  // Load cities for the selected province
    }
}

/**
 * Load cities/municipalities for the selected province.
 * @param {string} provinceCode - The province code for which to fetch cities.
 */
function loadCitiesForProvince(provinceCode) {
    $.getJSON(`${API_BASE_URL}/provinces/${provinceCode}/cities-municipalities/`, function(data) {
        const cityDropdown = $('#city');
        cityDropdown.empty().append('<option disabled selected value="">Select City</option>');
        if (data.length > 0) {
            data.forEach(city => {
                cityDropdown.append(`<option value="${city.code}" data-name="${city.name}">${city.name}</option>`);
            });
        } else {
            console.warn('No cities found for this province.');
        }

        resetDropdown('#barangay', 'Select Barangay');
    }).fail(function() {
        console.error("Failed to load cities for the selected province.");
    });
}

/**
 * Load cities/municipalities for regions like NCR that don't have provinces.
 * @param {string} regionCode - The region code for which to fetch cities.
 */
function loadCitiesForRegion(regionCode) {
    $.getJSON(`${API_BASE_URL}/regions/${regionCode}/cities-municipalities/`, function(data) {
        const cityDropdown = $('#city');
        cityDropdown.empty().append('<option disabled selected value="">Select City</option>');
        if (data.length > 0) {
            data.forEach(city => {
                cityDropdown.append(`<option value="${city.code}" data-name="${city.name}">${city.name}</option>`);
            });
        } else {
            console.warn('No cities found for this region.');
        }

        resetDropdown('#barangay', 'Select Barangay');
    }).fail(function() {
        console.error("Failed to load cities for the selected region.");
    });
}

/**
 * Handle city/municipality selection and load corresponding barangays.
 */
function handleCityChange() {
    const cityCode = this.value;
    const cityName = $('option:selected', this).text(); // Get the name from the selected option
    
    if (cityCode) {
        $('#city-name').val(cityName);  // Store the city name in the hidden input field
        loadBarangays(cityCode);  // Load barangays for the selected city
    }
}

/**
 * Load barangays for the selected city/municipality.
 * @param {string} cityCode - The city/municipality code for which to fetch barangays.
 */
function loadBarangays(cityCode) {
    $.getJSON(`${API_BASE_URL}/cities-municipalities/${cityCode}/barangays/`, function(data) {
        const barangayDropdown = $('#barangay');
        barangayDropdown.empty().append('<option disabled selected value="">Select Barangay</option>');
        if (data.length > 0) {
            data.forEach(barangay => {
                barangayDropdown.append(`<option value="${barangay.code}" data-name="${barangay.name}">${barangay.name}</option>`);
            });
        } else {
            console.warn('No barangays found for this city.');
        }
    }).fail(function() {
        console.error("Failed to load barangays for the selected city.");
    });
}

/**
 * Handle barangay selection and store the barangay name.
 */
function handleBarangayChange() {
    const barangayCode = this.value;
    const barangayName = $('option:selected', this).text(); // Get the name from the selected option
    
    if (barangayCode) {
        $('#barangay-name').val(barangayName);  // Store the barangay name in the hidden input field
    }
}

/**
 * Reset a dropdown to its default option.
 * @param {string} selector - The selector of the dropdown to reset.
 * @param {string} defaultText - The default option text.
 */
function resetDropdown(selector, defaultText) {
    $(selector).empty().append(`<option disabled selected value="">${defaultText}</option>`);
}

var map = L.map("map").setView([12.8797, 121.7740], 5);
var marker, circle;
var locationCache = {}; // Store previously fetched locations

L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
  attribution: "&copy; OpenStreetMap contributors",
}).addTo(map);

var causeIcons = {
  "Fire": "fire.png",
  "Flood": "flood.png",
  "Typhoon": "typhoon.png",
  "Earthquake": "earthquake.png",
  "Volcanic Eruption": "volcanic.png",
  "Feeding Program": "eat.png",
};

function updateMap(lat, lng, cause, fullAddress) {
  if (marker) map.removeLayer(marker);
  if (circle) map.removeLayer(circle);

  var iconUrl = baseIconPath + (causeIcons[cause] || "systemLogo.png");

  var customIcon = L.icon({
    iconUrl: iconUrl,
    iconSize: [35, 35],
  });

  marker = L.marker([lat, lng], { icon: customIcon })
    .addTo(map)
    .bindPopup(`<b>${cause}</b><br>${fullAddress}`)
    .openPopup();

  var radius = 500;

  circle = L.circle([lat, lng], {
    color: "#ff0000",
    fillColor: "#ff6666",
    fillOpacity: 0.2,
    radius: radius,
  }).addTo(map);

  setTimeout(() => {
    map.setView([lat, lng], 15);
  }, 200);

  document.getElementById("latitude").value = lat;
  document.getElementById("longitude").value = lng;
}

function formatAddress(region, province, city, barangay) {
  if (region === "NCR") {
    return `${barangay ? barangay + ", " : ""}${city}, Metro Manila, Philippines`;
  }
  return `${barangay ? barangay + ", " : ""}${city}, ${province}, ${region}, Philippines`;
}

let abortController = null; // To track the current request

async function fetchAndUpdateLocation() {
  // Cancel the previous request if it exists
  if (abortController) {
    abortController.abort();
  }

  // Create a new AbortController for the current request
  abortController = new AbortController();
  const signal = abortController.signal;

  var barangay = $("#barangay option:selected").text().trim();
  var city = $("#city option:selected").text().trim();
  var province = $("#province option:selected").text().trim();
  var region = $("#region option:selected").text().trim();
  var selectedCause = $("#cause option:selected").text().trim();

  if (!city || !selectedCause) return;

  var addressFormats = [
    formatAddress(region, province, city, barangay),
    `${city}, ${province}, ${region}, Philippines`,
    `${city}, ${province}, Philippines`,
    `${city}, Philippines`,
  ];

  if (region !== "NCR") {
    addressFormats = addressFormats.filter(address => !address.includes("Metro Manila"));
  }

  for (let i = 0; i < addressFormats.length; i++) {
    try {
      let coordinates = await getCoordinates(addressFormats[i], signal);

      if (coordinates) {
        updateMap(coordinates.lat, coordinates.lon, selectedCause, addressFormats[i]);
        return;
      }
    } catch (error) {
      if (error.name === 'AbortError') {
        console.log('Request aborted');
        return; // Exit if the request was aborted
      }
      console.error("Error fetching location:", error);
    }
  }

  console.error("Location not found after multiple attempts.");
}

async function getCoordinates(address, signal) {
  if (locationCache[address]) return locationCache[address]; // Use cached data

  const url = `https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(address)}`;
  try {
    const response = await fetch(url, { signal }); // Pass the signal to the fetch request
    const data = await response.json();
    if (data.length > 0) {
      locationCache[address] = { lat: data[0].lat, lon: data[0].lon };
      return locationCache[address];
    }
  } catch (error) {
    if (error.name !== 'AbortError') {
      console.error("Error fetching location:", error);
    }
    throw error;
  }
  return null;
}

// Event listeners
$("#region, #province, #city, #barangay").on("change", fetchAndUpdateLocation);
$("#cause").on("change", fetchAndUpdateLocation);



const itemsByCategory = { 
  "Basic Needs": ["Bottled Water", "Canned Goods", "5kg Packaged Rice", "Packed Biscuits", "Instant Noodles"],
  "Clothing and Bedding": ["Blankets", "Towels", "Jackets/Sweaters", "New Clothes", "Slippers"],
  "Hygiene Kits": ["Soap", "Sachet Shampoo", "Toothpaste", "Toothbrushes", "Baby Diapers", "Hand Sanitizers"],
  "Medical Supplies": ["First Aid Kits", "Bandages and Gauze", "Alcohol/Disinfectants", "Masks (N95 or surgical)"]
};

// Function to create a new item entry
function createItemEntry(isRemovable = true) {
  const itemDiv = $("<div>").addClass("row g-2 gy-2 item-entry align-items-center");

  itemDiv.html(`
    <div class="col-12 col-md-4">
      <select class="form-select category-select" name="categories[]">
        <option selected disabled>Select Category</option>
        ${Object.keys(itemsByCategory).map(cat => `<option value="${cat}">${cat}</option>`).join("")}
      </select>
    </div>
    <div class="col-12 col-md-4">
      <select class="form-select item-select" name="items[]" disabled>
        <option selected disabled>Select Item</option>
      </select>
    </div>
    <div class="col-12 col-md-3">
      <input type="number" class="form-control quantity-input" name="quantities[]" placeholder="Quantity" min="1" disabled>
    </div>
    ${isRemovable ? `
    <div class="col-12 col-md-1 text-center">
      <button type="button" class="btn btn-danger btn-sm remove-item"><i class="fa-solid fa-x fa-lg"></i></button>
    </div>` : ""}
  `);

  // Enable item selection based on category
  itemDiv.find(".category-select").on("change", function () {
    const category = $(this).val();
    const itemSelect = itemDiv.find(".item-select");
    itemSelect.html(`<option selected disabled>Select Item</option>`);
    itemsByCategory[category].forEach(item => {
      itemSelect.append(`<option value="${item}">${item}</option>`);
    });
    itemSelect.prop("disabled", false);
  });

  // Enable quantity input when an item is selected
  itemDiv.find(".item-select").on("change", function () {
    const quantityInput = itemDiv.find(".quantity-input");
    quantityInput.prop("disabled", false);
    quantityInput.val(1); // Set the default quantity to 1
  });

  return itemDiv;
}

// Initialize with one default item (cannot be removed)
$("#requested-items").append(createItemEntry(false));

// Add Item Button Click Event
$("#add-item").on("click", function () {
  $("#requested-items").append(createItemEntry(true));
});

// Remove item when clicking "Remove"
$("#requested-items").on("click", ".remove-item", function () {
  $(this).closest(".item-entry").remove();
});

        
});



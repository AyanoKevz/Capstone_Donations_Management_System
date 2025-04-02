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

  document.getElementById('itemFilter').addEventListener('change', function() {
        const selectedItem = this.value;
        const urlParams = new URLSearchParams(window.location.search);
        urlParams.set('item', selectedItem);
        window.location.search = urlParams.toString();
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


  if ($("#inKindForm").length > 0) {
    $("#inKindForm").validate({
        rules: {
            cause: { required: true },
            urgency: { required: true },
            region: { required: true },
            province: { required: true },
            city: { required: true },
            valid_until: { required: true },
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
            valid_until: { required: "Please select a date." },
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

if ($("#cashForm").length > 0) {
    $("#cashForm").validate({
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
            casualty_cost: { required: true, min: 0 },
            valid_until: { required: true },
        },
        messages: {
            cause: { required: "Please select a cause." },
            urgency: { required: "Please select the urgency level." },
            region: { required: "Please select a region." },
            province: { required: "Please select a province." },
            city: { required: "Please select a city/municipality." },
            barangay: { required: "Please select a barangay." },
            valid_until: { required: "Please select a date." },
            description: {
                required: "Please provide a description.",
                minlength: "Description must be at least 10 characters long.",
            },
            casualty_cost: {
                required: "Please enter an amount.",
                min: "Amount must be a positive number.",
            },
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
            // Submit the form if all validations pass
            form.submit();
        },
    });

    $("input[name='casualty_cost']").closest(".col-12").hide();

    $("#cash_cause").change(function () {
      var selectedCause = $(this).val();
      
      if (selectedCause === "Feeding Program") {
        $("input[name='casualty_cost']").closest(".col-12").hide();
      } else {
        $("input[name='casualty_cost']").closest(".col-12").show();
      }
    });
}

// Show selected file names for both forms
$(".file-input").on("change", function () {
    let fileInput = $(this)[0]; // Get the file input element
    let file = fileInput.files[0]; // Get the uploaded file
    let fileLabel = $(this).attr("id"); // Get the ID of the file input

    // Show the "Uploaded Files" text
    $("#uploadText").show();

    // Validate file type based on the input ID
    if (file) {
        if (fileLabel.includes("photo")) {
            // Validate image files
            if (!file.type.startsWith("image/")) {
                alert("Please upload a valid image file (e.g., JPG, PNG).");
                $(this).val(""); // Clear the file input
                return; // Stop further execution
            }
        } else if (fileLabel.includes("video")) {
            // Validate video files
            if (!file.type.startsWith("video/")) {
                alert("Please upload a valid video file (e.g., MP4, MOV).");
                $(this).val(""); // Clear the file input
                return; // Stop further execution
            }
        }
    }

    // Map file input IDs to their corresponding file name display IDs
    const fileDisplayMap = {
        "proof_photo_1": "#file-name-1",
        "proof_photo_2": "#file-name-2",
        "proof_video": "#file-name-video",
        "cash_proof_photo_1": "#cash_file-name-1",
        "cash_proof_photo_2": "#cash_file-name-2",
        "cash_proof_video": "#cash_file-name-video"
    };

    // Update the corresponding file name display
    if (fileDisplayMap[fileLabel]) {
        $(fileDisplayMap[fileLabel]).text(file.name);
    }

    // Handle image and video previews
    if (file) {
        const reader = new FileReader();

        if (file.type.startsWith("image/")) {
            reader.onload = function (e) {
                // Update the corresponding image preview
                if (fileLabel === "proof_photo_1" || fileLabel === "cash_proof_photo_1") {
                    $("#preview-image-1").attr("src", e.target.result).show();
                } else if (fileLabel === "proof_photo_2" || fileLabel === "cash_proof_photo_2") {
                    $("#preview-image-2").attr("src", e.target.result).show();
                }
            };
            reader.readAsDataURL(file);
        } else if (file.type.startsWith("video/")) {
            // Update the video preview
            $("#preview-video").attr("src", URL.createObjectURL(file)).show();
        }
    }

    


});

const API_BASE_URL = "https://psgc.gitlab.io/api";

// Initialize dropdowns for both forms
initializeRegionDropdown();
$('#region, #cash_region').on('change', handleRegionChange);
$('#province, #cash_province').on('change', handleProvinceChange);
$('#city, #cash_city').on('change', handleCityChange);
$('#barangay, #cash_barangay').on('change', handleBarangayChange);

function initializeRegionDropdown() {
    $.getJSON(`${API_BASE_URL}/regions/`, function(data) {
        const regionDropdown = $('#region, #cash_region');
        regionDropdown.empty().append('<option disabled selected value="">Select Region</option>');
        data.forEach(region => {
            regionDropdown.append(`<option value="${region.code}" data-name="${region.name}">${region.name}</option>`);
        });
    }).fail(function() {
        console.error("Failed to load regions.");
    });
}

// Handle region selection
function handleRegionChange() {
    const regionCode = this.value;
    const regionName = $('option:selected', this).text();

    if (!regionCode) return;

    if (this.id === "region") {
        $('#region-name').val(regionName);
    } else if (this.id === "cash_region") {
        $('#cash_region-name').val(regionName);
    }

    if (regionCode === "130000000") { // NCR region code
        handleNCRRegion(this.id);
    } else {
        loadProvinces(regionCode, this.id);
    }
}

// Handle NCR region
function handleNCRRegion(formId) {
    if (formId === "region") {
        $('#province').empty().append('<option selected value="N/A">N/A</option>');
        $('#province-name').val('N/A');
        loadCitiesForRegion("130000000", formId);
    } else if (formId === "cash_region") {
        $('#cash_province').empty().append('<option selected value="N/A">N/A</option>');
        $('#cash_province-name').val('N/A');
        loadCitiesForRegion("130000000", formId);
    }
}

// Load provinces
function loadProvinces(regionCode, formId) {
    $.getJSON(`${API_BASE_URL}/regions/${regionCode}/provinces/`, function(data) {
        const provinceDropdown = formId === "region" ? $('#province') : $('#cash_province');
        provinceDropdown.empty().append('<option disabled selected value="">Select Province</option>');
        if (data.length > 0) {
            data.forEach(province => {
                provinceDropdown.append(`<option value="${province.code}" data-name="${province.name}">${province.name}</option>`);
            });
        } else {
            console.warn('No provinces found for this region.');
            provinceDropdown.append('<option disabled selected value="">N/A</option>');
        }

        if (formId === "region") {
            resetDropdown('#city', 'Select City');
            resetDropdown('#barangay', 'Select Barangay');
        } else if (formId === "cash_region") {
            resetDropdown('#cash_city', 'Select City');
            resetDropdown('#cash_barangay', 'Select Barangay');
        }
    }).fail(function() {
        console.error("Failed to load provinces for the selected region.");
    });
}

// Handle province selection
function handleProvinceChange() {
    const provinceCode = this.value;
    const provinceName = $('option:selected', this).text();

    if (provinceCode) {
        if (this.id === "province") {
            $('#province-name').val(provinceName);
            loadCitiesForProvince(provinceCode, this.id);
        } else if (this.id === "cash_province") {
            $('#cash_province-name').val(provinceName);
            loadCitiesForProvince(provinceCode, this.id);
        }
    }
}

// Load cities for province
function loadCitiesForProvince(provinceCode, formId) {
    $.getJSON(`${API_BASE_URL}/provinces/${provinceCode}/cities-municipalities/`, function(data) {
        const cityDropdown = formId === "province" ? $('#city') : $('#cash_city');
        cityDropdown.empty().append('<option disabled selected value="">Select City</option>');
        if (data.length > 0) {
            data.forEach(city => {
                cityDropdown.append(`<option value="${city.code}" data-name="${city.name}">${city.name}</option>`);
            });
        } else {
            console.warn('No cities found for this province.');
        }

        if (formId === "province") {
            resetDropdown('#barangay', 'Select Barangay');
        } else if (formId === "cash_province") {
            resetDropdown('#cash_barangay', 'Select Barangay');
        }
    }).fail(function() {
        console.error("Failed to load cities for the selected province.");
    });
}

// Load cities for region (NCR)
function loadCitiesForRegion(regionCode, formId) {
    $.getJSON(`${API_BASE_URL}/regions/${regionCode}/cities-municipalities/`, function(data) {
        const cityDropdown = formId === "region" ? $('#city') : $('#cash_city');
        cityDropdown.empty().append('<option disabled selected value="">Select City</option>');
        if (data.length > 0) {
            data.forEach(city => {
                cityDropdown.append(`<option value="${city.code}" data-name="${city.name}">${city.name}</option>`);
            });
        } else {
            console.warn('No cities found for this region.');
        }

        if (formId === "region") {
            resetDropdown('#barangay', 'Select Barangay');
        } else if (formId === "cash_region") {
            resetDropdown('#cash_barangay', 'Select Barangay');
        }
    }).fail(function() {
        console.error("Failed to load cities for the selected region.");
    });
}

// Handle city selection
function handleCityChange() {
    const cityCode = this.value;
    const cityName = $('option:selected', this).text();

    if (cityCode) {
        if (this.id === "city") {
            $('#city-name').val(cityName);
            loadBarangays(cityCode, this.id);
        } else if (this.id === "cash_city") {
            $('#cash_city-name').val(cityName);
            loadBarangays(cityCode, this.id);
        }
    }
}

// Load barangays
function loadBarangays(cityCode, formId) {
    $.getJSON(`${API_BASE_URL}/cities-municipalities/${cityCode}/barangays/`, function(data) {
        const barangayDropdown = formId === "city" ? $('#barangay') : $('#cash_barangay');
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

// Handle barangay selection
function handleBarangayChange() {
    const barangayCode = this.value;
    const barangayName = $('option:selected', this).text();

    if (barangayCode) {
        if (this.id === "barangay") {
            $('#barangay-name').val(barangayName);
        } else if (this.id === "cash_barangay") {
            $('#cash_barangay-name').val(barangayName);
        }
    }
}

// Reset dropdown
function resetDropdown(selector, defaultText) {
    $(selector).empty().append(`<option disabled selected value="">${defaultText}</option>`);
}

// Handle tab switching
$('button[data-bs-toggle="tab"]').on('shown.bs.tab', function (e) {
    const target = $(e.target).attr("href"); // Get the target tab pane ID

    if (target === "#profile-tab-pane") {
        // Reinitialize dropdowns and event listeners for the cashForm
        initializeRegionDropdown();
        $('#cash_region').on('change', handleRegionChange);
        $('#cash_province').on('change', handleProvinceChange);
        $('#cash_city').on('change', handleCityChange);
        $('#cash_barangay').on('change', handleBarangayChange);
    }
});

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

  // Update latitude and longitude for the active form
  if ($("#inKindForm").is(":visible")) {
    $("#latitude").val(lat);
    $("#longitude").val(lng);
  } else if ($("#cashForm").is(":visible")) {
    $("#cash_latitude").val(lat);
    $("#cash_longitude").val(lng);
  }
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

  // Determine which form is active
  let barangay, city, province, region, selectedCause;
  if ($("#inKindForm").is(":visible")) {
    barangay = $("#barangay option:selected").text().trim();
    city = $("#city option:selected").text().trim();
    province = $("#province option:selected").text().trim();
    region = $("#region option:selected").text().trim();
    selectedCause = $("#cause option:selected").text().trim();
  } else if ($("#cashForm").is(":visible")) {
    barangay = $("#cash_barangay option:selected").text().trim();
    city = $("#cash_city option:selected").text().trim();
    province = $("#cash_province option:selected").text().trim();
    region = $("#cash_region option:selected").text().trim();
    selectedCause = $("#cash_cause option:selected").text().trim();
  }

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

// Event listeners for inKindForm
$("#region, #province, #city, #barangay").on("change", fetchAndUpdateLocation);
$("#cause").on("change", fetchAndUpdateLocation);

// Event listeners for cashForm
$("#cash_region, #cash_province, #cash_city, #cash_barangay").on("change", fetchAndUpdateLocation);
$("#cash_cause").on("change", fetchAndUpdateLocation);



const itemsByCategory = { 
  "Basic Needs": ["Bottled Water", "Canned Goods", "5kg Packaged Rice", "Packed Biscuits", "Instant Noodles"],
  "Clothing and Bedding": ["Blankets", "Towels", "Jackets/Sweaters", "New Clothes", "Slippers"],
  "Hygiene Kits": ["Soap", "Sachet Shampoo", "Toothpaste", "Toothbrushes", "Baby Diapers"],
  "Medical Supplies": ["Adhesive Tape", "Bandages and Gauze", "Alcohol/Disinfectants", "Masks (N95 or surgical)"]
};


 const assetBaseUrl = "/assets/img/"
 const itemImages = {
        "Bottled Water": assetBaseUrl + "/r4.png",
        "Canned Goods": assetBaseUrl + "/r1.jpg",
        "5kg Packaged Rice": assetBaseUrl + "/r5.png",
        "Packed Biscuits": assetBaseUrl + "/r6.png",
        "Instant Noodles": assetBaseUrl + "/r3.png",
        "Blankets": assetBaseUrl + "/b1.png",
        "Towels": assetBaseUrl + "/t1.png",
        "Jackets/Sweaters": assetBaseUrl + "/c1.png",
        "New Clothes": assetBaseUrl + "/r8.png",
        "Slippers": assetBaseUrl + "/s1.png",
        "Soap": assetBaseUrl + "/q2.png",
        "Sachet Shampoo": assetBaseUrl + "/q3.png",
        "Toothpaste": assetBaseUrl + "/q4.png",
        "Toothbrushes": assetBaseUrl + "/q1.jpg",
        "Baby Diapers": assetBaseUrl + "/q5.png",
        "Hand Sanitizers": assetBaseUrl + "/q6.png",
        "Adhesive Tape": assetBaseUrl + "/w1.jpg",
        "Bandages and Gauze": assetBaseUrl + "/w2.png",
        "Alcohol/Disinfectants": assetBaseUrl + "/w3.png",
        "Masks (N95 or surgical)": assetBaseUrl + "/w4.png"
    };


// Function to update the displayed item image
function updateItemImage() {
  const itemImageContainer = $("#item-image-container");
  itemImageContainer.empty();
  
  // Get all selected items (not disabled)
  const selectedItems = $(".item-select option:selected").not(":disabled");
  
  if (selectedItems.length > 0) {
    // Display all selected items with their images
    selectedItems.each(function() {
      const itemName = $(this).val();
      const imagePath = itemImages[itemName];
      const quantity = $(this).closest(".item-entry").find(".quantity-input").val();
      
      if (imagePath) {
        itemImageContainer.append(`
          <div class="d-inline-block mx-2 text-center">
            <img src="${imagePath}" alt="${itemName}" class="img-fluid" style="max-height: 100px;">
            <p class="mt-1 small">${itemName} (Qty: ${quantity})</p>
          </div>
        `);
      }
    });
  }
}

// Function to create a new item entry (with image update on change)
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

  // Category change handler
  itemDiv.find(".category-select").on("change", function() {
    const category = $(this).val();
    const itemSelect = itemDiv.find(".item-select");
    itemSelect.html(`<option selected disabled>Select Item</option>`);

    itemsByCategory[category].forEach(item => {
      if (!$(`.item-select option[value="${item}"]:selected`).length) {
        itemSelect.append(`<option value="${item}">${item}</option>`);
      }
    });

    itemSelect.prop("disabled", false);
  });

  // Item and quantity change handlers
  itemDiv.find(".item-select").on("change", function() {
    const quantityInput = itemDiv.find(".quantity-input");
    quantityInput.prop("disabled", false);
    quantityInput.val(1);
    updateAvailableItems();
    updateItemImage(); // Update image when item changes
  });

  itemDiv.find(".quantity-input").on("change", updateItemImage); // Update image when quantity changes

  return itemDiv;
}


// Function to update item availability in all dropdowns
function updateAvailableItems() {
  let selectedItems = [];
  $(".item-select").each(function () {
    let selectedValue = $(this).val();
    if (selectedValue) {
      selectedItems.push(selectedValue);
    }
  });

  $(".item-select").each(function () {
    let category = $(this).closest(".item-entry").find(".category-select").val();
    if (!category) return;

    let itemSelect = $(this);
    let selectedValue = itemSelect.val();

    itemSelect.html(`<option selected disabled>Select Item</option>`);
    itemsByCategory[category].forEach(item => {
      if (!selectedItems.includes(item) || item === selectedValue) {
        itemSelect.append(`<option value="${item}" ${item === selectedValue ? "selected" : ""}>${item}</option>`);
      }
    });
  });
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
  updateAvailableItems();
  updateItemImage();
});


        
});



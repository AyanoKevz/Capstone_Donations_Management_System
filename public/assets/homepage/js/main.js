(function ($) {
    "use strict";

    setTimeout(() => {
            $('#alert-success').fadeOut();
            $('#alert-error').fadeOut();
        },3000);

       // Spinner
var spinnerElement = document.getElementById("spinner");

    if (spinnerElement) {
        window.addEventListener("beforeunload", function () {
            spinnerElement.classList.add("show");
        });

        window.addEventListener("load", function () {
            spinnerElement.classList.remove("show");
        });
    }
   //animation
const wow = new WOW({
    boxClass: 'wow',
    animateClass: 'animated',
    offset: 0,
    mobile: true,
    live: true,
});
wow.init();

WOW.prototype.addBox = function (element) {
    this.boxes.push(element);
};

$(window).on('scroll', function () {
    $('.wow').each(function () {
        const elementTop = $(this).offset().top;
        const elementBottom = elementTop + $(this).outerHeight();
        const viewportTop = $(window).scrollTop();
        const viewportBottom = viewportTop + $(window).height();

        // Check if element is out of viewport
        if (elementBottom < viewportTop || elementTop > viewportBottom) {
            $(this).css({
                'visibility': 'hidden',
                'animation-name': 'none',
            }).removeClass('animated');
            wow.addBox(this);
        }
    });
});


    // Sticky Navbar
    $(window).scroll(function () {
        if ($(this).scrollTop() > 45) {
            $('.navbar').addClass('sticky-top shadow-sm');
        } else {
            $('.navbar').removeClass('sticky-top shadow-sm');
        }
    });


    // Hero Header carousel
    $(".header-carousel").owlCarousel({
        animateOut: 'fadeOut',
        items: 1,
        margin: 0,
        stagePadding: 0,
        autoplay: true,
        smartSpeed: 350,
        dots: true,
        loop: true,
    });


    // attractions carousel
    $(".blog-carousel").owlCarousel({
        autoplay: true,
        smartSpeed: 1500,
        center: false,
        dots: false,
        loop: true,
        margin: 25,
        nav : true,
        navText : [
            '<i class="fa fa-angle-left"></i>',
            '<i class="fa fa-angle-right"></i>'
        ],
        responsiveClass: true,
        responsive: {
            0:{
                items:1
            },
            576:{
                items:1
            },
            768:{
                items:2
            },
            992:{
                items:2
            },
            1200:{
                items:3
            }
        }
    });


    // testimonial carousel
    $(".testimonial-carousel").owlCarousel({
        autoplay: true,
        smartSpeed: 1500,
        center: false,
        dots: false,
        loop: true,
        margin: 25,
        nav : true,
        navText : [
             '<i class="fa fa-angle-left"></i>',
            '<i class="fa fa-angle-right"></i>'
        ],
        responsiveClass: true,
        responsive: {
            0:{
                items:1
            },
            576:{
                items:1
            },
            768:{
                items:2
            },
            992:{
                items:2
            },
            1200:{
                items:3
            }
        }
    });


    // Facts counter
    $('[data-toggle="counter-up"]').counterUp({
        delay: 5,
        time: 2000
    });


   // Back to top button
   $(document).ready(function () {
    $('.back-to-top').hide();
    $(window).scroll(function () {
        if ($(this).scrollTop() > 800) {
            $('.back-to-top').fadeIn('slow');
        } else {
            $('.back-to-top').fadeOut('slow');
        }
    });

    $('.back-to-top').click(function () {
        $('html, body').animate({scrollTop: 0}, 100, 'easeInOutExpo');
        return false;
    });
});

// Handle Photo Option Change
 function setDisplayWithImportant(element, displayValue) {
        $(element).attr('style', `display: ${displayValue} !important;`);
    }

    // Handle Photo Option Change
    $('input[name="userPhotoOption"]').on('change', function () {
        if ($('#takePhotoOption').is(':checked')) {
            // Show Take a Photo Section and hide File Input Section
            setDisplayWithImportant('#photoCapture', 'flex');
            setDisplayWithImportant('#fileInputSection', 'none');
        } else if ($('#uploadPhotoOption').is(':checked')) {
            // Show File Input Section and hide Take a Photo Section
            setDisplayWithImportant('#photoCapture', 'none');
            setDisplayWithImportant('#fileInputSection', 'flex');
        }
    });

    // Set initial visibility based on the default selected option
    if ($('#takePhotoOption').is(':checked')) {
        setDisplayWithImportant('#photoCapture', 'flex');
        setDisplayWithImportant('#fileInputSection', 'none');
    } else if ($('#uploadPhotoOption').is(':checked')) {
        setDisplayWithImportant('#photoCapture', 'none');
        setDisplayWithImportant('#fileInputSection', 'flex');
    }

// Radio button change for individual/organization selection
$('#individual').on('change', function () {
    $('#info-title').text('Personal Details');
    $('#fname-label').html('First Name <span class="text-danger fs-6">*</span>');
    $('#fname').attr('placeholder', 'Enter your first name');
    $('#last-name,  #gender-options').css('display', 'flex');
      $('#validID').html(`
    <option disabled selected value="">Select ID</option>
    <option value="Philippine Passport">Philippine Passport</option>
    <option value="Driver's License">Driver's License</option>
    <option value="SSS ID">SSS ID</option>
    <option value="UMID">UMID</option>
    <option value="PhilHealth ID">PhilHealth ID</option>
    <option value="Voter's ID">Voter's ID</option>
    <option value="PRC ID">PRC ID</option>
    <option value="Postal ID">Postal ID</option>
    <option value="TIN ID">TIN ID</option>
    <option value="Barangay ID">Barangay ID</option>
  `);
  $('#proofUpload-label').html('Upload Selected ID <span class="text-danger fs-6">*</span>');
    $('#proof-photo').attr('src', '../assets/img/Id.png');
  $('#upload-instructions').html(`
      <li><p>Upload a valid ID (Passport, Driver's License, etc.).</p></li>
      <li><p>Ensure the ID is clear, visible, and legible.</p></li>
      <li><p>Accepted formats: JPG, JPEG, PNG (max size 5 MB).</p></li>
      <li><p>No edits or alterations to the ID.</p></li>
      <li><p>Use good lighting and avoid glare.</p></li>
  `);

    // Show instructions for individuals
    $('#ins-photo').attr('src', '../assets/img/phototake.jpg');
    $('#instructions').html(`
        <li><p>Ensure your face is clear, centered, and well-lit for photo capture.</p></li>
<li><p>Avoid accessories like sunglasses or hats that block your face.</p></li>
<li><p>If uploading, make sure the image is clear and not blurry.</p></li>
<li><p>Accepted formats for uploads: JPG, JPEG, PNG (max size 5 MB).</p></li>
<li><p>Ensure the image is properly oriented and unaltered.</p></li>

    `);

    // Enable both options for individuals
    $('#takePhotoOption').prop('disabled', false);  // Enable Take Photo
    $('#uploadPhotoOption').prop('disabled', false); // Enable Upload Photo

    // Show the Take Photo section and hide the File Input section
    setDisplayWithImportant('#photoCapture', 'flex');
    setDisplayWithImportant('#fileInputSection', 'none');
});

$('#organization').on('change', function () {
    $('#info-title').text('Organization Details');
    $('#fname-label').html('Organization Name <span class="text-danger fs-6">*</span>');
    $('#fname').attr('placeholder', 'Enter organization name');
    $('#last-name, #gender-options').css('display', 'none');
      $('#validID').html(`
    <option disabled selected value="">Select Proof Document</option>
    <option value="SEC Certificate of Registration">SEC Certificate of Registration</option>
    <option value="Mayor's Permit">Mayor's Permit</option>
    <option value="BIR 2303 Form">BIR 2303 Form</option>
    <option value="DTI Certificate">DTI Certificate</option>
    <option value="Articles of Incorporation">Articles of Incorporation</option>
    <option value="Organizational Letterhead">Organizational Letterhead</option>
  `);
  
  $('#proofUpload-label').html('Upload Selected Organization Document <span class="text-danger fs-6">*</span>');
  $('#proof-photo').attr('src', '../assets/img/document.png'); // Change image to document image
  $('#upload-instructions').html(`
      <li><p>Upload proof of organization (Certificate of Incorporation, Business Permit, etc.).</p></li>
      <li><p>Ensure the document is clear and legible.</p></li>
      <li><p>Accepted formats: PDF, JPG, JPEG, PNG (max size 10 MB).</p></li>
      <li><p>No edits or alterations to the document.</p></li>
      <li><p>Use good lighting and avoid glare if taking a photo of the document.</p></li>
  `);

    // Show instructions for organizations
    $('#ins-photo').attr('src', '../assets/img/upload.png');
    $('#instructions').html(`
        <li><p>Upload a clear image of your organization’s logo</p></li>
        <li><p>Ensure the image is clear, well-lit, and not blurry.</p></li>
        <li><p>Accepted formats: JPG, JPEG, PNG (max size 5 MB).</p></li>
        <li><p>No edits or alterations to the image.</p></li>
    `);

    // Disable Take Photo option and only allow Upload Photo for organizations
    $('#takePhotoOption').prop('disabled', true);  // Disable Take Photo
    $('#uploadPhotoOption').prop('checked', true); // Ensure Upload Photo is selected

    // Hide the Take Photo section and show the File Input section
    setDisplayWithImportant('#photoCapture', 'none');
    setDisplayWithImportant('#fileInputSection', 'flex');
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



$.validator.addMethod("mobilePH", function(value, element) {
    return this.optional(element) || /^09\d{9}$/.test(value); 
});

$("form").validate({
    rules: {
        username: {
            required: true,
            minlength: 8
        },
        password: {
            required: true,
            minlength: 8
        },
        password_confirmation: {
            required: true,
            equalTo: "[name='password']"
        },
        email: {
            required: true,
            email: true
        },
        fname: {
            required: true
        },
        lname: {
            required: true
        },
        bday: {
            required: true,
            date: true
        },
        gender: {
            required: true
        },
        contact_number: {
            required: true,
            digits: true,
            mobilePH: true, 
            maxlength: 11 
        },
        pref_services: {
            required: true
        },
        availability: {
            required: true
        },
        availability_time: {
            required: true
        },
        region: {
            required: true
        },
        province: {
            required: true
        },
        city: {
            required: true
        },
        barangay: {
            required: true
        },
        full_address: {
            required: true
        },
        validID: {
            required: true
        },
        proofUpload: {
            required: true,
            extension: "jpg|jpeg|png"
        }
    },
    messages: {
        username: {
            required: "Please enter a username",
            minlength: "Your username must be at least 8 characters long"
        },
        password: {
            required: "Please provide a password",
            minlength: "Your password must be at least 8 characters long"
        },
        password_confirmation: {
            required: "Please confirm your password",
            equalTo: "Passwords do not match"
        },
        email: {
            required: "Please enter a valid email address",
            email: "Please enter a valid email address"
        },
        contact_number: {
            required: "Please enter your mobile number",
            digits: "Please enter only digits",
            mobilePH: "Invalid Format (09xxxxxxxxx)"
        },
        proofUpload: {
            required: "Please upload your ID",
            extension: "Please upload a valid image (jpg, jpeg, png)"
        }
    },
    
    highlight: function(element) {
        $(element).addClass('is-invalid').removeClass('is-valid'); 
        $(element).closest('.input-field').find('.icon-status')
            .html('<i class="fa-solid fa-times fa-lg mx-1" style="color: #FF6B6B;"></i>');
    },
    unhighlight: function(element) {
        $(element).addClass('is-valid').removeClass('is-invalid');
        $(element).closest('.input-field').find('.icon-status')
            .html('<i class="fa-solid fa-check fa-lg mx-1" style="color: #06b400;"></i>');
    },
    errorPlacement: function(error, element) {
        error.insertAfter(element);
    },
    submitHandler: function(form) {
        form.submit(); 
    }
});


$("#login-form").validate({
    rules: {
        username: {
            required: true,
            minlength: 8
        },
        password: {
            required: true,
            minlength: 8
        }
    },
    messages: {
        username: {
            required: "Please enter a username",
            minlength: "Your username must be at least 8 characters long"
        },
        password: {
            required: "Please provide a password",
            minlength: "Your password must be at least 8 characters long"
        }
    },
    highlight: function(element) {
        $(element).addClass('is-invalid').removeClass('is-valid');
    },
    unhighlight: function(element) {
        $(element).addClass('is-valid').removeClass('is-invalid');
    },
    errorPlacement: function(error, element) {
        error.insertAfter(element);
    },
    submitHandler: function(form) {
        form.submit(); // Submit the form if valid
    }
});

   $('#login-form').on('submit', function (e) {
        // Get the values of the username and password fields
        const username = $('#username').val().trim();
        const password = $('.password-input').val().trim();

        // Prevent submission and hide spinner if validation fails
        if (username.length < 5 || password.length < 8) {
            e.preventDefault(); // Stop form submission
            if (spinnerElement) {
                spinnerElement.classList.remove("show"); // Ensure spinner is hidden
            }
            return; // Exit the function
        }

        // If validation passes, show the spinner
        if (spinnerElement) {
            spinnerElement.classList.add("show");
        }
    });

$('.toggle-password').on('click', function () {
    const passwordInput = $('.password-input'); // Target the password input
    const toggleIcon = $('.toggle-password-icon'); // Target the icon in the button

    // Toggle password type between 'password' and 'text'
    if (passwordInput.attr('type') === 'password') {
        passwordInput.attr('type', 'text'); // Show password
        toggleIcon.removeClass('fa-eye-slash').addClass('fa-eye'); // Change icon to 'eye'
    } else {
        passwordInput.attr('type', 'password'); // Hide password
        toggleIcon.removeClass('fa-eye').addClass('fa-eye-slash'); // Change icon to 'eye-slash'
    }
});

// Elements
const $uploadOption = $('#uploadOption');
const $cameraOption = $('#cameraOption');
const $fileUploadSection = $('#fileUploadSection');
const $cameraSection = $('#cameraSection');
const $proofUpload = $('#proofUpload');
const $captureBtn = $('#captureBtn');
const $myCamera = $('#my_camera');
const $capturedImageDiv = $('#capturedImage');
const $reviewIdImage = $('#reviewIdImage');

// Toggle sections based on user selection
$('input[name="photoOption"]').on('change', function () {
    if ($uploadOption.is(':checked')) {
        $fileUploadSection.show();
        $cameraSection.hide();
        $proofUpload.prop('required', true);
    } else if ($cameraOption.is(':checked')) {
        $fileUploadSection.hide();
        $cameraSection.show();
        $proofUpload.prop('required', false);
        // Initialize Webcam
        Webcam.set({
            width: 300,
            height: 250,
            image_format: 'jpeg',
            jpeg_quality: 90
        });
        Webcam.attach('#my_camera');
    }
});

// Update review image when a file is uploaded
$proofUpload.on('change', function () {
    if (this.files && this.files[0]) {
        const reader = new FileReader();
        reader.onload = function (e) {
            $reviewIdImage.attr('src', e.target.result);
        };
        reader.readAsDataURL(this.files[0]);
    }
});

// Capture Photo and toggle between camera and captured image
$captureBtn.on('click', function () {
    if ($captureBtn.text() === "Capture Photo") {
        Webcam.snap(function (dataUri) {
            // Hide camera and show captured image
            $myCamera.hide();
            $capturedImageDiv.html('<img src="' + dataUri + '" style="width: 300px; height: 250px;"/>').show();
            $captureBtn.text("Capture Again");

            // Update review image
            $reviewIdImage.attr('src', dataUri);

            // Convert Base64 to Blob and create a File object
            const blob = dataURItoBlob(dataUri);
            const file = new File([blob], "captured_id.jpg", { type: "image/jpeg" });

            // Populate the file input programmatically
            const dataTransfer = new DataTransfer();
            dataTransfer.items.add(file);
            $proofUpload[0].files = dataTransfer.files;
        });
    } else {
        // Reset to camera view
        $myCamera.show();
        $capturedImageDiv.hide();
        $captureBtn.text("Capture Photo");
    }
});

// Convert Base64 to Blob
function dataURItoBlob(dataURI) {
    const byteString = atob(dataURI.split(',')[1]);
    const mimeString = dataURI.split(',')[0].split(':')[1].split(';')[0];
    const ab = new ArrayBuffer(byteString.length);
    const ia = new Uint8Array(ab);
    for (let i = 0; i < byteString.length; i++) {
        ia[i] = byteString.charCodeAt(i);
    }
    return new Blob([ab], { type: mimeString });
}


$('#imageFile').on('change', function (event) {
    const file = event.target.files[0];

    if (file) {
        const reader = new FileReader();

        // When the file is loaded, update the src attribute
        reader.onload = function (e) {
            $('#reviewUserImage').attr('src', e.target.result);
        };

        // Read the file as a Data URL
        reader.readAsDataURL(file);
    } else {
        // If no file is selected, revert to the default image
        $('#reviewUserImage').attr('src', '{{ asset("assets/img/no_image.jpg") }}');
    }
});

// Validate inputs and show/hide Confirm button
function validateInputs() {
    let isValid = true;

    const accountType = $('input[name="accountType"]:checked').val();

    $('input, select').each(function () {
        // Skip validation for fields not required for the selected account type
        if (accountType === 'Organization') {
            if ($(this).attr('name') === 'lname') {
                return; // Skip validation for these fields
            }
            if ($(this).attr('name') === 'gender') {
                return; // Skip validation for these fields
            }
        }

        if ($(this).prop('required') && !$(this).val()) {
            isValid = false;
        }
    });

    // Toggle the "Confirm" button visibility based on validation
    $('#confirmBtn').toggle(isValid);
}


// Validate on keyup, change, or file select
$('input, select').on('keyup change', function () {
    validateInputs();
});

// Populate modal on Review and Confirm button click
$('[data-bs-target="#staticBackdrop"]').click(function () {
    validateInputs();

    const accountType = $('input[name="accountType"]:checked').val();
    $('#reviewAccountType').text(accountType);
    $('#reviewUsername').text($('input[name="username"]').val());
    $('#reviewEmail').text($('input[name="email"]').val());
    $('#reviewPassword').text($('input[name="password"]').val());
    $('#reviewFname').text($('input[name="fname"]').val());
    $('#reviewLname').text($('input[name="lname"]').val());
    $('#reviewContactNumber').text($('input[name="contact_number"]').val());
    $('#reviewRegion').text($('select[name="region"] option:selected').text());
    $('#reviewProvince').text($('select[name="province"] option:selected').text());
    $('#reviewCity').text($('select[name="city"] option:selected').text());
    $('#reviewBarangay').text($('select[name="barangay"] option:selected').text());
    $('#reviewFullAddress').text($('input[name="full_address"]').val());
    $('#reviewIdType').text($('select[name="id_type"] option:selected').text());


    // Volunteering Details (VOLUNTEER ONLY PART IN REGISTRATION)
    $('#reviewPreferredService').text($('select[name="pref_services"] option:selected').text());
    $('#reviewAvailability').text($('select[name="availability"] option:selected').text());
    $('#reviewAvailabilityTime').text($('select[name="availability_time"] option:selected').text());
    $('#reviewChapter').text($('select[name="chapter"] option:selected').text());

    // Handle visibility of other fields based on account type
    if (accountType === 'Organization') {
        $('#reviewLname').closest('p').hide();
        $('#reviewFname').prev('strong').text('Organization Name:');
        $('#reviewGender').prev('strong').hide();
    } else {
        $('#reviewLname').closest('p').show();
        $('#reviewFname').prev('strong').text('First Name:');
        $('#reviewGender').text($('select[name="gender"]').val());
    }
});


// Confirm button logic
$('#confirmBtn').click(function () {
    $('#staticBackdrop').modal('hide');
    $('[data-bs-target="#staticBackdrop"]').hide();
    $('#register').show();
});


})(jQuery);


let videoStream = null;
let captureTimeout = null;
let countdown = 2; 
let detecting = false;
let detectionInterval = null;

const video = document.getElementById('video');
const canvas = document.getElementById('overlay');
const timerDisplay = document.getElementById('timer');
const toggleCameraBtn = document.getElementById('toggleCameraBtn');
const imageFileInput = document.getElementById('imageFile');
const preview = document.getElementById('preview');
canvas.style.background = 'black';

// Start webcam
async function startVideo() {
  try {
    // Start the video stream
    videoStream = await navigator.mediaDevices.getUserMedia({ video: {} });
    video.srcObject = videoStream;
    video.style.display = 'block'; // Ensure video is visible
    canvas.style.background = 'none';

    // Once video metadata is loaded, adjust the overlay size
    video.onloadedmetadata = () => {
      adjustOverlaySize();
      detectFace(); // Start face detection when video is ready
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
  video.style.display = 'none';  // Hide the video element when camera is off
  canvas.getContext('2d').clearRect(0, 0, canvas.width, canvas.height);  // Clear the overlay canvas
  canvas.style.background = 'black';

  // Stop detection and countdown
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

// Function to adjust overlay canvas size to match the video size
function adjustOverlaySize() {
  const videoDisplaySize = video.getBoundingClientRect(); // Get actual displayed size of the video
  canvas.width = videoDisplaySize.width;
  canvas.height = videoDisplaySize.height;
  faceapi.matchDimensions(canvas, videoDisplaySize); // Match canvas to video size
}

// Detect faces and draw detection box
async function detectFace() {
  const displaySize = { width: video.clientWidth, height: video.clientHeight };
  faceapi.matchDimensions(canvas, displaySize);

  // Ensure no existing interval is running
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

      // Post-Await Check
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
        startCountdown(); // Start the timer when face is detected
      } else {
        resetCountdown();
      }
    } catch (error) {
      console.error('Error during face detection:', error);
    }
  }, 100); // Check every 100ms
}

// Start countdown timer for capture
function startCountdown() {
  if (captureTimeout === null) {
    timerDisplay.style.display = 'block'; // Show timer only when starting capture
    countdown = 2; 
    timerDisplay.textContent = `Timer: ${countdown}`;

    captureTimeout = setInterval(() => {
      countdown--;
      timerDisplay.textContent = `Timer: ${countdown}`;

      if (countdown <= 0) {
        captureImage();
        resetCountdown();
      }
    }, 1000); // Countdown every second
  }
}

// Reset countdown timer
function resetCountdown() {
  if (captureTimeout) {
    clearInterval(captureTimeout);
    captureTimeout = null;
  }
  countdown = 2;
  timerDisplay.textContent = `Timer: ${countdown}`;
  timerDisplay.style.display = 'none'; // Hide timer when not capturing
}

// Capture image from video
function captureImage() {
  const context = canvas.getContext('2d');
  if (context) {
    context.drawImage(video, 0, 0, canvas.width, canvas.height);
  }
  const imageData = canvas.toDataURL('image/png');

   const modalPreviewImg = document.getElementById('reviewUserImage');
    if (modalPreviewImg) {
        modalPreviewImg.src = imageData;
    }

  // Set captured image in input file
  const file = dataURLtoFile(imageData, 'captured.png');
  const dataTransfer = new DataTransfer();
  dataTransfer.items.add(file);
  imageFileInput.files = dataTransfer.files;

  // Update the preview
  const img = document.createElement('img');
  img.src = imageData;
  img.width = 300;
  img.height = 250; // Set image preview size
  preview.innerHTML = ''; // Clear previous previews
  preview.appendChild(img);

  stopVideo(); // Turn off the camera after capturing the image
}

// Convert base64 to file object
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



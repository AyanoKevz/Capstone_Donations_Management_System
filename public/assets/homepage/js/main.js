(function ($) {
    "use strict";

    // Spinner
    var spinner = function () {
        setTimeout(function () {
            if ($('#spinner').length > 0) {
                $('#spinner').removeClass('show');
            }
        }, 1);
    };
    spinner(0);
    
    
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

// Radio button change for individual/organization selection
$('#individual').on('change', function () {
  $('#info-title').text('Personal Details');
  $('#fname-label').html('First Name <span class="text-danger fs-6">*</span>');
  $('#fname').attr('placeholder', 'Enter your first name');
  $('#middle-name, #last-name, #gender-options').css('display', 'flex');
  $('#birth-label').html('Date of Birth <span class="text-danger fs-6">*</span>');
  $('#validID, #proofUpload').parent().css('display', 'block');
  $('#proofUpload-label').html('Upload Selected ID <span class="text-danger fs-6">*</span>');
  
  // Show individual ID upload instructions and image
  $('#ins-photo').attr('src', '../assets/img/Id.png');
  $('#upload-instructions').html(`
      <li><p>Upload a valid ID (Passport, Driver's License, etc.).</p></li>
      <li><p>Ensure the ID is clear, visible, and legible.</p></li>
      <li><p>Accepted formats: JPG, JPEG, PNG (max size 5 MB).</p></li>
      <li><p>No edits or alterations to the ID.</p></li>
      <li><p>Use good lighting and avoid glare.</p></li>
  `);

  // Show the "Take a Photo" section for individuals
  $('.take-photo-section').attr('style', 'display: block !important');
});

$('#organization').on('change', function () {
  $('#info-title').text('Organization Details');
  $('#fname-label').html('Organization Name <span class="text-danger fs-6">*</span>');
  $('#birth-label').html('Established Date <span class="text-danger fs-6">*</span>');
  $('#fname').attr('placeholder', 'Enter organization name');
  $('#middle-name, #last-name, #gender-options').css('display', 'none');
  
  // Change to organization proof instructions and image
  $('#validID').parent().css('display', 'none'); // Hide ID selection
  $('#proofUpload-label').html('Upload Organization Document <span class="text-danger fs-6">*</span>');
  $('#ins-photo').attr('src', '../assets/img/document.png'); // Change image to document image
  $('#upload-instructions').html(`
      <li><p>Upload proof of organization (Certificate of Incorporation, Business Permit, etc.).</p></li>
      <li><p>Ensure the document is clear and legible.</p></li>
      <li><p>Accepted formats: PDF, JPG, JPEG, PNG (max size 10 MB).</p></li>
      <li><p>No edits or alterations to the document.</p></li>
      <li><p>Use good lighting and avoid glare if taking a photo of the document.</p></li>
  `);

  // Hide the "Take a Photo" section for organizations with !important
  $('.take-photo-section').attr('style', 'display: none !important');
});

const API_BASE_URL = "https://psgc.gitlab.io/api";

initializeRegionDropdown();
$('#region').on('change', handleRegionChange);
$('#province').on('change', handleProvinceChange);
$('#city').on('change', handleCityChange);

/**
 * Initialize the Region dropdown by fetching data from the PSGC API.
 */
function initializeRegionDropdown() {
    $.getJSON(`${API_BASE_URL}/regions/`, function(data) {
        const regionDropdown = $('#region');
        regionDropdown.empty().append('<option disabled selected value="">Select Region</option>');
        data.forEach(region => {
            regionDropdown.append(`<option value="${region.code}">${region.name}</option>`);
        });
    }).fail(function() {
        console.error("Failed to load regions.");
    });
}

/**
 * Handle region selection and load corresponding provinces or cities directly for NCR.
 */
function handleRegionChange() {
    const regionCode = this.value;
    if (!regionCode) return;

    // Special handling for NCR (no provinces)
    if (regionCode === "130000000") { // NCR region code
        handleNCRRegion();
    } else {
        loadProvinces(regionCode);
    }
}

/**
 * Handle NCR region by skipping the province dropdown and directly loading cities.
 */
function handleNCRRegion() {
    $('#province').empty().append('<option selected value="N/A">N/A</option>'); // NCR has no provinces
    loadCitiesForRegion("130000000"); // Load cities directly for NCR
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
                provinceDropdown.append(`<option value="${province.code}">${province.name}</option>`);
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
    if (provinceCode) {
        loadCitiesForProvince(provinceCode);
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
                cityDropdown.append(`<option value="${city.code}">${city.name}</option>`);
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
                cityDropdown.append(`<option value="${city.code}">${city.name}</option>`);
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
    if (cityCode) {
        loadBarangays(cityCode);
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
                barangayDropdown.append(`<option value="${barangay.code}">${barangay.name}</option>`);
            });
        } else {
            console.warn('No barangays found for this city.');
        }
    }).fail(function() {
        console.error("Failed to load barangays for the selected city.");
    });
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
    return this.optional(element) || /^09\d{9}$/.test(value); // Regex for 09 followed by 9 digits
}, "Please enter a valid mobile number starting with 09 and 11 digits long.");

$("form").validate({
    rules: {
        username: {
            required: true,
            minlength: 5
        },
        password: {
            required: true,
            minlength: 8
        },
        cpassword: {
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
        number: {
            required: true,
            digits: true,
            mobilePH: true, 
            maxlength: 11 
        },
        educ_prof:{
            required: true
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
        cpassword: {
            required: "Please confirm your password",
            equalTo: "Passwords do not match"
        },
        email: {
            required: "Please enter a valid email address",
            email: "Please enter a valid email address"
        },
        number: {
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


// Validation for Donor Form
$("#donor-form").validate({
    rules: {
        username: {
            required: true,
            minlength: 5
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
        form.submit();
    }
});

$("#donee-form").validate({
    rules: {
        username: {
            required: true,
            minlength: 5
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
        form.submit();
    }
});


$("#vol-form").validate({
    rules: {
        username: {
            required: true,
            minlength: 5
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
        form.submit();
    }
});

})(jQuery);

/* var individualRadio = document.getElementById("individual");
var orgRadio = document.getElementById("organization");

individualRadio.addEventListener("change", function () {
    
      document.getElementById("info-title").innerText = "Personal Details";
      document.getElementById("fname-label").innerHTML = `First Name <span class="text-danger fs-6">*</span>`;
      document.getElementById("middle-name").style.display = "flex";
      document.getElementById("last-name").style.display = "flex";
      document.getElementById("gender-options").style.display = "flex";
});
orgRadio.addEventListener("change", function () {
    document.getElementById("info-title").innerText = "Organization Details";
    document.getElementById("fname-label").innerHTML = 'Organization Name <span class="text-danger fs-6">*</span>';
    document.getElementById("middle-name").style.display = "none";
    document.getElementById("last-name").style.display = "none";
    document.getElementById("gender-options").style.display = "none";
});
 */


let videoStream = null;
let captureTimeout = null;
let countdown = 3; // Updated from 4 to 3
let detecting = false;
let detectionInterval = null; // To track face detection interval

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
    countdown = 3; // Updated from 4 to 3
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
  countdown = 3;
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
// Load models and prepare the application
loadModels();

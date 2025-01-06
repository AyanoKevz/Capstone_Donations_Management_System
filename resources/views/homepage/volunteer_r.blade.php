<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Register - UniAid</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Roboto:wght@400;500;700;900&display=swap"
        rel="stylesheet">
    <!-- Libraries Stylesheet -->
    <link rel="icon" href="{{ asset ('assets/img/systemLogo.png') }}" type="image/png">
    <!-- Libraries Stylesheet -->
    <link rel="stylesheet" href="{{ asset('lib/animate/animate.min.css') }}" />
    <link href="{{ asset('lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <!-- Customized Bootstrap Stylesheet -->
    <link rel="stylesheet" href="{{ asset('lib/bootstrap/css/bootstrap.min.css') }}">
    <!-- Template Stylesheet -->
    <link href="{{ asset('assets/homepage/css/style.css') }}" rel="stylesheet">
    <!-- Face API JS -->
    <script src="{{ asset('lib/face-api.js/dist/face-api.min.js') }}"></script>
</head>

<body>

    <!-- Spinner Start -->
    <div id="spinner"
        class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="loader">
            <span class="loader-text">Loading...</span>
        </div>
    </div>
    <!-- Spinner End -->


    <!-- Navbar & Hero Start -->
    <div class="container-fluid position-relative p-0">
        <nav class="navbar navbar-expand-lg navbar-light px-4 px-lg-5 py-3 py-lg-2">
            <a href="index.htmls" class="navbar-brand p-0">
                <h1 class="m-0"><img src="../assets/img/systemLogo.png" class="me-3" alt="Logo">UniAid</h1>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="fa fa-bars"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto py-0">
                    <a href="{{ route ('home')}}" class="nav-item nav-link ">Home</a>
                    <a href="{{ route ('about')}}" class="nav-item nav-link ">About</a>
                    <a href="{{ route('home') }}#testimonials" class="nav-item nav-link">Testimonial</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link" data-bs-toggle="dropdown">
                            <span>More <i class="fa-solid fa-angle-down fa-sm dropdown-toggle"></i></span>

                        </a>
                        <div class="dropdown-menu m-0">
                            <a href="{{ route ('more_donor')}}" class="dropdown-item">Donation</a>
                            <a href="{{ route ('more_volunteer')}}" class="dropdown-item">Volunteer</a>
                        </div>
                    </div>
                    <a href="{{ route ('contact')}}" class="nav-item nav-link">Contact Us</a>
                    <a href="{{ route ('register')}}" class="nav-item nav-link active">Register</a>
                </div>
                <a href="{{ route('home') }}#portals" class="btn btn-primary rounded-pill py-2 px-4 my-3 my-lg-0 flex-shrink-0">Portal</a>
            </div>
        </nav>

        <!-- Header Start -->
        <div class="container-fluid bg-breadcrumb py-5  mb-5">
            <div class="container text-center py-5">
                <div class="row g-5 align-items-center">
                    <div class="col-lg-6">
                        <h4 class="text-white display-4 mb-4 wow fadeInDown" data-wow-delay="0.3s">Register</h4>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb d-flex justify-content-center mb-0 wow fadeInDown"
                                data-wow-delay="0.3s">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item"><a href="#">Register</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Volunteer Registration</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-lg-6 zoomIn wow" data-wow-delay="0.3s">
                        <div class="row g-3">
                            <div class="col-6">
                                <img class="p-2 w-100 h-100 img-fluid" src="{{ asset ('assets/img/c1.jpeg') }}" alt=""
                                    style="background:#ff1f1f;">
                            </div>
                            <div class="col-6">
                                <img class="p-2 w-100 h-100 img-fluid" src="{{ asset ('assets/img/c2.jpg') }}" alt=""
                                    style="background:#ff1f1f;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Header End -->
    </div>
    <!-- Navbar & Hero End -->

    <!-- Register Start -->
    <div class="container-fluid service py-5">
        <div class="container pb-3">
            <div class="card p-3 register-form">
                @if ($errors->any())
                <div class="alert alert-error">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li><i class="fa-solid fa-circle-xmark fa-xl"></i> {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <form method="POST" action="{{ route ('register.vol') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form">
                        <div class="details type" style="display: none;">
                            <span class="title">Account Type</span>
                            <div class="fields">
                                <p class="fw-semibold m-0">Register As:</p>
                                <div class="input-field">
                                    <label>
                                        <input type="radio" name="accountType" id="individual" value="Individual"
                                            checked>
                                        Individual
                                    </label>
                                    <span class="icon-status"></span>
                                </div>
                            </div>
                        </div>
                        <div class="details acct">
                            <span class="title">Account Details</span>
                            <div class="fields">
                                <div class="input-field">
                                    <label for="fname">Username <span class="text-danger fs-6">*</span>
                                        <span class="icon-status"></span>
                                    </label>
                                    <input type="text" class="r-input" placeholder="Enter username" required
                                        name="username">
                                </div>
                                <div class="input-field">
                                    <label for="password">Password <span class="text-danger fs-6">*</span>
                                        <span class="icon-status"></span>
                                    </label>
                                    <input type="password" class="r-input password-input" placeholder="Enter password" required name="password" id="password">
                                    <button type="button" class="toggle-password icon-toggle">
                                        <i class="fas fa-eye-slash toggle-password-icon"></i>
                                    </button>
                                </div>
                                <div class="input-field">
                                    <label for="password_confirmation">Confirm Password <span class="text-danger fs-6">*</span>
                                        <span class="icon-status"></span>
                                    </label>
                                    <input type="password" class="r-input password-input" placeholder="Confirm password" required name="password_confirmation">
                                    <button type="button" class="toggle-password icon-toggle">
                                        <i class="fas fa-eye-slash toggle-password-icon"></i>
                                    </button>
                                </div>
                                <div class="input-field">
                                    <label>Email <span class="text-danger fs-6">*</span> <span
                                            style="font-size: small; color: #aaa;">(Must be Active)</span>
                                        <span class="icon-status"></span>
                                    </label>
                                    <input type="email" class="r-input" placeholder="Enter your email" required
                                        name="email">
                                </div>
                            </div>
                        </div>
                        <!-- Personal/Organization Details -->
                        <div class="details personal">
                            <span class="title" id="info-title">Personal Details</span>
                            <div class="fields">
                                <!-- First Name / Organization Name -->
                                <div class="input-field">
                                    <label for="fname" id="fname-label">First Name <span
                                            class="text-danger fs-6">*</span>
                                        <span class="icon-status"></span>
                                    </label>
                                    <input type="text" class="r-input" id="fname" placeholder="Enter your first name"
                                        required name="fname">
                                </div>
                                <!-- Last Name -->
                                <div class="input-field" id="last-name">
                                    <label for="lname">Last Name <span class="text-danger fs-6">*</span>
                                        <span class="icon-status"></span>
                                    </label>
                                    <input type="text" class="r-input" placeholder="Enter your last name" required
                                        name="lname">
                                </div>

                                <!-- Mobile Number -->
                                <div class="input-field">
                                    <label>Contact Number <span class="text-danger fs-6">*</span> <span
                                            style="font-size: small; color: #aaa;">(Must be Active)</span>
                                        <span class="icon-status"></span>
                                    </label>
                                    <input type="number" class="r-input" placeholder="Enter mobile number" required
                                        name="contact_number">
                                </div>

                                <div class="input-field" id="gender-options">
                                    <label>Gender <span class="text-danger fs-6">*</span>
                                        <span class="icon-status"></span>
                                    </label>
                                    <select required name="gender">
                                        <option disabled selected value="">Select gender</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                        <option value="Others">Others</option>
                                    </select>
                                </div>

                            </div>
                        </div>

                        <div class="details address">
                            <span class="title">Address Details</span>
                            <div class="fields">
                                <div class="input-field">
                                    <label for="region">Region <span class="text-danger fs-6">*</span>
                                        <span class="icon-status"></span>
                                    </label>
                                    <select id="region" name="region" required>
                                        <option disabled selected value="">Select Region</option>
                                    </select>
                                    <input type="hidden" id="region-name" name="region_name">
                                </div>

                                <div class="input-field">
                                    <label for="province">Province <span class="text-danger fs-6">*</span>
                                        <span class="icon-status"></span>
                                    </label>
                                    <select id="province" name="province" required>
                                        <option disabled selected value="">Select Province</option>
                                    </select>
                                    <input type="hidden" id="province-name" name="province_name">
                                </div>

                                <div class="input-field">
                                    <label for="city">City/Municipality <span class="text-danger fs-6">*</span>
                                        <span class="icon-status"></span>
                                    </label>
                                    <select id="city" name="city" required>
                                        <option disabled selected value="">Select City</option>
                                    </select>
                                    <input type="hidden" id="city-name" name="city_name">
                                </div>

                                <div class="input-field">
                                    <label for="barangay">Barangay <span class="text-danger fs-6">*</span>
                                        <span class="icon-status"></span>
                                    </label>
                                    <select id="barangay" name="barangay" required>
                                        <option disabled selected value="">Select Barangay</option>
                                    </select>
                                    <input type="hidden" id="barangay-name" name="barangay_name">
                                </div>

                                <div class="input-field" id="full_address">
                                    <label for="full_address">Full Address<span class="text-danger fs-6">*</span>
                                        <span class="icon-status"></span>
                                    </label>
                                    <input type="text" class="r-input" placeholder="Full Address" required
                                        name="full_address">
                                </div>
                            </div>
                        </div>

                        <div class="details volunteering">
                            <span class="title" id="info-title">Volunteering Details</span>
                            <div class="fields">
                                <div class="input-field" id="services-option">
                                    <label>Most preferred services<span
                                            class="text-danger fs-6">*</span>
                                        <span class="icon-status"></span> <!-- Icon placeholder -->
                                    </label>
                                    <select name="pref_services">
                                        <option disabled selected value="">Select Services</option>
                                        <option value="General">General</option>
                                        <option value="Collect Donations">Collect Donations</option>
                                        <option value="Relief Operations">Relief Operations</option>
                                        <option value="Health Welfare">Health Welfare</option>
                                        <option value="Emergency Response">Emergency Response</option>
                                    </select>
                                </div>

                                <div class="input-field" id="availability-options">
                                    <label>When available as a volunteer? <span
                                            class="text-danger fs-6">*</span>
                                        <span class="icon-status"></span> <!-- Icon placeholder -->
                                    </label>
                                    <select name="availability">
                                        <option disabled selected value="">Select Availability</option>
                                        <option value="Weekday">Weekday</option>
                                        <option value="Weekend">Weekend</option>
                                        <option value="Holiday">Holiday</option>
                                        <option value="In time of Disasters">In time of disasters</option>
                                    </select>
                                </div>

                                <div class="input-field" id="availability-time-options">
                                    <label>What time available as a Volunteer? <span
                                            class="text-danger fs-6">*</span>
                                        <span class="icon-status"></span> <!-- Icon placeholder -->
                                    </label>
                                    <select name="availability_time">
                                        <option disabled selected value="">Select Availability Time</option>
                                        <option value="Morning" title="Typically between 6 AM to 12 PM">Morning</option>
                                        <option value="Afternoon" title="Typically between 12 PM to 6 PM">Afternoon
                                        </option>
                                        <option value="Night" title="Typically between 6 PM to 12 AM">Night</option>
                                        <option value="On-Call"
                                            title="Available as needed, potentially outside regular hours">On-Call
                                        </option>
                                        <option value="Whole-Day" title="Available throughout the entire day">Whole-Day
                                        </option>
                                    </select>
                                </div>

                                <div class="input-field" id="chapter-options">
                                    <label>Select Chapter <span class="text-danger fs-6">*</span>
                                        <span class="icon-status"></span>
                                    </label>
                                    <select name="chapter" required>
                                        <option disabled selected value="">Select Chapter</option>
                                        @foreach ($chapters as $chapter)
                                        <option value="{{ $chapter->id }}">{{ $chapter->chapter_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!-- Identity Details Section -->
                        <div class="details identity">

                            <span class="title">Identity Details</span>
                            <!-- Instructions for ID/Organization Proof Upload -->
                            <h4 class="m-0">ID Submission Instructions: </h4>
                            <div class="d-flex justify-content-around align-items-center flex-wrap-reverse">
                                <div>
                                    <ul id="upload-instructions" class="mt-2">
                                        <li>
                                            <p>Upload a valid ID (Passport, Driver's License, etc.).</p>
                                        </li>
                                        <li>
                                            <p>Ensure the ID is clear, visible, and legible.</p>
                                        </li>
                                        <li>
                                            <p>Accepted formats: JPG, JPEG, PNG (max size 5 MB).</p>
                                        </li>
                                        <li>
                                            <p>No edits or alterations to the ID.</p>
                                        </li>
                                        <li>
                                            <p>Use good lighting and avoid glare.</p>
                                        </li>
                                        <li>
                                            <p>Select if upload the image or take photo of the ID.</p>
                                        </li>
                                    </ul>
                                </div>
                                <div class="d-flex justify-content-center">
                                    <img src="{{ asset ('assets/img/Id.png') }}" id="proof-photo" alt="" class="w-50">
                                </div>
                            </div>
                            <div class="fields mb-5">
                                <!-- Select ID Type -->
                                <div class="input-field" id="id-select">
                                    <label for="proofOfIdentity" class="fw-medium">
                                        Select ID Type <span class="text-danger fs-6">*</span>
                                        <span class="icon-status"></span>
                                    </label>
                                    <select id="validID" name="id_type" required>
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
                                    </select>
                                </div>

                                <div class="input-field">
                                    <label class="fw-medium">Select Option:</label>
                                    <div>
                                        <input type="radio" id="uploadOption" name="photoOption" value="upload" checked>
                                        <label for="uploadOption">Upload File</label>
                                        <input type="radio" id="cameraOption" name="photoOption" value="camera">
                                        <label for="cameraOption">Take Photo</label>
                                    </div>
                                </div>
                                <!-- File Upload -->
                                <div class="input-field" id="fileUploadSection">
                                    <label for="proofUpload" id="proofUpload-label" class="fw-medium">
                                        Upload Selected ID <span class="text-danger fs-6">*</span>
                                    </label>
                                    <input type="file" id="proofUpload" name="id_image" required>
                                </div>
                                <!-- Webcam Section (Hidden by Default) -->
                                <div id="cameraSection" style="display: none; text-align: center;">
                                    <div id="my_camera" style="width: 300px; height: 250px; margin: 0 auto; "></div>
                                    <div id="capturedImage" style=" text-align: center; display: none;"></div>
                                    <br>
                                    <div class="d-flex justify-content-center align-items-center">
                                        <button type="button" id="captureBtn" class="btn btn-secondary btn-sm m-0">Capture Photo</button>
                                    </div>
                                </div>
                            </div>

                            <span class="title">User Image Submission</span>
                            <!-- Instructions for Individual/Organization Image Upload -->
                            <div class="d-flex flex-column align-items-around take-photo-section">
                                <h4 class="m-0">Instructions: </h4>
                                <div class="d-flex justify-content-around align-items-center flex-wrap-reverse">
                                    <div>
                                        <ul id="instructions" class="mt-2">
                                            <li>
                                                <p>Ensure your face is clear, centered, and well-lit for photo capture.</p>
                                            </li>
                                            <li>
                                                <p>Avoid accessories like sunglasses or hats that block your face.</p>
                                            </li>
                                            <li>
                                                <p>If uploading, make sure the image is clear and not blurry.</p>
                                            </li>
                                            <li>
                                                <p>Accepted formats for uploads: JPG, JPEG, PNG (max size 5 MB).</p>
                                            </li>
                                            <li>
                                                <p>Ensure the image is properly oriented and unaltered.</p>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="d-flex justify-content-center">
                                        <img src="{{ asset('assets/img/phototake.jpg') }}" id="ins-photo" alt="" class="w-50">
                                    </div>
                                </div>

                                <!-- Photo Option Radio Buttons -->
                                <div class="photo-option mb-3 d-flex justify-content-center">
                                    <!-- Photo Option Selection -->
                                    <label for="uploadPhotoOption" class="mx-2">
                                        <input type="radio" name="userPhotoOption" id="uploadPhotoOption" value="uploadPhoto" checked> Upload Photo
                                    </label>
                                    <label for="takePhotoOption">
                                        <input type="radio" name="userPhotoOption" id="takePhotoOption" value="takePhoto"> Take Photo
                                    </label>
                                </div>

                                <!-- Take a Photo Section -->
                                <div id="photoCapture" class="d-flex justify-content-around flex-wrap">
                                    <div class="d-flex flex-column align-items-center">
                                        <div class="video-container">
                                            <video id="video" autoplay muted></video>
                                            <canvas id="overlay"></canvas>
                                            <div id="timer"></div>
                                        </div>
                                        <button class="btn btn-secondary btn-sm my-3" type="button" id="toggleCameraBtn">Turn On Camera</button>
                                    </div>
                                    <!-- Preview of The Captured Photo -->
                                    <div id="preview" style="box-sizing: content-box;">
                                        <img src="{{ asset('assets/img/no_profile.png') }}" style="width: 300px; height:250px;" alt="">
                                    </div>
                                </div>

                                <!-- File Input Section -->
                                <div id="fileInputSection" style="display: none;" class="d-flex justify-content-center align-items-center">
                                    <input type="file" id="imageFile" name="user_photo" class="preview-file" required>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end mt-3">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                    Review and Confirm
                                </button>
                                <button type="submit" name="register" id="register" class="btn btn-success" style="display: none;">Register</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Register End -->

    <!-- Review Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Review Your Details</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h5>Account Details</h5>
                    <div class="ms-3">
                        <p><strong>Account Type:</strong> <span id="reviewAccountType"></span></p>
                        <p><strong>Username:</strong> <span id="reviewUsername"></span></p>
                        <p><strong>Email:</strong> <span id="reviewEmail"></span></p>
                        <p><strong>Password:</strong> <span id="reviewPassword"></span></p>
                    </div>
                    <hr />
                    <h5>Person Details</h5>
                    <div class="ms-3">
                        <p><strong>First Name:</strong> <span id="reviewFname"></span></p>
                        <p><strong>Last Name:</strong> <span id="reviewLname"></span></p>
                        <p><strong>Contact Number:</strong> <span id="reviewContactNumber"></span></p>
                    </div>
                    <hr>
                    <h5>Address Details</h5>
                    <div class="ms-3">
                        <p><strong>Region:</strong> <span id="reviewRegion"></span></p>
                        <p><strong>Province:</strong> <span id="reviewProvince"></span></p>
                        <p><strong>City:</strong> <span id="reviewCity"></span></p>
                        <p><strong>Barangay:</strong> <span id="reviewBarangay"></span></p>
                        <p><strong>Full Address:</strong> <span id="reviewFullAddress"></span></p>
                    </div>
                    <hr>
                    <h5>Volunteering Details</h5> <!--  for volunteer only -->
                    <div class="ms-3">
                        <p><strong>Preferred Services:</strong> <span id="reviewPreferredService"></span></p>
                        <p><strong>Availability:</strong> <span id="reviewAvailability"></span></p>
                        <p><strong>Availability Time:</strong> <span id="reviewAvailabilityTime"></span></p>
                        <p><strong>Chapter:</strong> <span id="reviewChapter"></span></p>
                    </div>
                    <hr>
                    <h5>Identity Details</h5>
                    <div class="ms-3">
                        <p><strong>ID Type:</strong> <span id="reviewIdType"></span></p>
                        <p><strong>ID Image:</strong></p>
                        <img id="reviewIdImage" class="border border-secondary" src="{{ asset ('assets/img/no_image.jpg') }}" alt="ID Image" style="width: 200px; height:200px; margin-bottom: 16px;" />
                    </div>

                    <div class="ms-3">
                        <p><strong>User Image:</strong></p>
                        <img id="reviewUserImage" class="border border-secondary" src="{{ asset ('assets/img/no_image.jpg') }}" alt="User Image" style="width: 200px; height:200px;" />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Edit</button>
                    <button type="button" id="confirmBtn" class="btn btn-success" style="display: none;">Confirm</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer Start -->
    <div class="container-fluid footer py-3 wow fadeIn" data-wow-delay="0.2s">
        <div class="container py-3 border-start-0 border-end-0"
            style="border: 1px solid; border-color: rgb(255, 255, 255, 0.08);">
            <div class="row g-5">
                <div class="col-md-2 col-lg-2 col-xl-5">
                    <div class="footer-item">
                        <h3 class="text-white"> UniAid: Community Donations
                            and Resources Distribution</h3>
                        <p class="mb-4">UniAid is a platform that bridges the gap between donors
                            and those in need. Whether you want to give, receive, or volunteer, UniAid
                            makes it simple to contribute and request resources across the Philippines.</p>
                    </div>
                </div>
                <div class="col-md-2 col-lg-2 col-xl-3">
                    <div class="footer-item">
                        <h4 class="text-white mb-4">Quick Links</h4>
                        <a href="about.html"><i class="fas fa-angle-right me-2"></i> About Us</a>
                        <a href="register.html"><i class="fas fa-angle-right me-2"></i> Register</a>
                        <a href="#portals"><i class="fas fa-angle-right me-2"></i> Portals</a>
                        <a href="#news"><i class="fas fa-angle-right me-2"></i> News</a>
                        <a href="contact.html"><i class="fas fa-angle-right me-2"></i> Contact us</a>
                    </div>
                </div>

                <div class="col-md-2 col-lg-2 col-xl-4">
                    <div class="footer-item">
                        <h4 class="text-white mb-4">Contact Info</h4>
                        <div class="d-flex align-items-center">
                            <i class="fas fa-map-marker-alt text-danger me-3"></i>
                            <p class="text-white mb-0">37 EDSA corner Boni Avenue, Barangka-Ilaya, Mandaluyong City
                                1550</p>
                        </div>

                        <div class="d-flex align-items-center">
                            <i class="fa fa-phone-alt text-danger me-3"></i>
                            <p class="text-white mb-0">(+63 2) 8790-2300</p>
                        </div>

                        <div class="d-flex align-items-center">
                            <i class="fa fa-hands-holding-child text-danger me-3"></i>
                            <p class="text-white mb-0">Donations - (+63 2) 8790-2410 / (+63 2) 8790-2413</p>
                        </div>

                        <div class="d-flex align-items-center mb-4">
                            <i class="fa fa-people-group text-danger me-3"></i>
                            <p class="text-white mb-0">Volunteer (+63 2) 8790-2373</p>
                        </div>

                        <div class="d-flex">
                            <a class="btn btn-primary btn-sm-square rounded-circle me-3"
                                href="https://www.facebook.com/phredcross" target="_blank"><i
                                    class="fab fa-facebook-f text-white"></i></a>
                            <a class="btn btn-primary btn-sm-square rounded-circle me-3"
                                href="https://x.com/philredcross?mx=2" target="_blank"><i
                                    class="fab fa-twitter text-white"></i></a>
                            <a class="btn btn-primary btn-sm-square rounded-circle me-3"
                                href="https://www.instagram.com/philredcross/" target="_blank"><i
                                    class="fab fa-instagram text-white"></i></a>
                            <a class="btn btn-primary btn-sm-square rounded-circle me-0"
                                href="https://www.linkedin.com/authwall?trk=bf&trkInfo=AQG5L29q_iR04gAAAZJD6itogdLGIBN_s1xsrE9UpfecYUEigsPKbT-qW_l8QHDO39R9u7Tdt9YtyqWKyDMAT_SdwWfWF26jNVEheyJkrIXk6gDKySM35vzHOu5wZ3nAixD8fTw=&original_referer=&sessionRedirect=https%3A%2F%2Fwww.linkedin.com%2Fcompany%2F1089054"
                                target="_blank"><i class="fab fa-linkedin-in text-white"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->

    <!-- Copyright Start -->
    <div class="container-fluid copyright p-1">
        <p class="my-3">&copy; UniAid: Community Donations and
            Resources Distribution</p>
    </div>
    <!-- Copyright End -->

    <!-- Back to Top -->
    <a href="#" class="btn btn-primary btn-lg-square rounded-circle back-to-top"><i class="fa fa-arrow-up"></i></a>
    <!-- JavaScript Libraries -->
    <script src="../lib/jquery/jquery.min.js"></script>
    <script src="../lib/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../lib/animate/wow.min.js"></script>
    <script src="../lib/jquery/easing.min.js"></script>
    <script src="../lib/jquery/counterup.min.js"></script>
    <script src="../lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="../lib/fontawesome/all.js"></script>
    <!-- My Javascript -->
    <script src="../lib/jquery/jquery.validate.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.26/webcam.min.js"></script>
    <script src="../assets/homepage/js/main.js"></script>

</body>

</html>
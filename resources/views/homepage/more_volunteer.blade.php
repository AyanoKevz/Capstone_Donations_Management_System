<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Donee - UniAid</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Roboto:wght@400;500;700;900&display=swap"
        rel="stylesheet">
    <link rel="icon" href="{{ asset ('assets/img/systemLogo.png') }}" type="image/png">
    <!-- Libraries Stylesheet -->
    <link rel="stylesheet" href="{{ asset('lib/animate/animate.min.css') }}" />
    <link href="{{ asset('lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <!-- Customized Bootstrap Stylesheet -->
    <link rel="stylesheet" href="{{ asset('lib/bootstrap/css/bootstrap.min.css') }}">
    <!-- Template Stylesheet -->
    <link href="{{ asset('assets/homepage/css/style.css') }}" rel="stylesheet">
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
            <a href="" class="navbar-brand p-0">
                <h1 class="m-0 fw-semibold"><img src="{{ asset('assets/img/systemLogo.png') }}" class="me-3" alt="Logo">UniAid</h1>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="fa fa-bars"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto py-0">
                    <a href="{{ route ('home')}}" class="nav-item nav-link ">Home</a>
                    <a href="{{ route ('about')}}" class="nav-item nav-link ">About</a>
                    <a href="{{ route('home') }}#testimonials" class="nav-item nav-link">Testimonial</a>
                    <div class="nav-item dropdown  ">
                        <a href="#" class="nav-link active" data-bs-toggle="dropdown">
                            More <i class="fa-solid fa-angle-down fa-sm dropdown-toggle"></i>

                        </a>
                        <div class="dropdown-menu m-0">
                            <a href="{{ route ('more_donor')}}" class="dropdown-item">Donation</a>
                            <a href="{{ route ('more_volunteer')}}" class="dropdown-item active">Volunteer</a>
                        </div>
                    </div>
                    <a href="{{ route ('contact')}}" class="nav-item nav-link ">Contact Us</a>
                    <a href="{{ route ('register')}}" class="nav-item nav-link">Register</a>
                </div>
                <a href="{{ route('home') }}#portals" class="btn btn-primary rounded-pill py-2 px-4 my-3 my-lg-0 flex-shrink-0">Portal</a>
            </div>
        </nav>

        <!-- Header Start -->
        <div class="container-fluid bg-breadcrumb py-5  mb-5">
            <div class="container text-center py-5">
                <div class="row g-5 align-items-center">
                    <div class="col-lg-6">
                        <h4 class="text-white display-4 mb-4 wow fadeInDown" data-wow-delay="0.3s">More About Volunteer</h4>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb d-flex justify-content-center mb-0 wow fadeInDown"
                                data-wow-delay="0.3s">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">More About Volunteer</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-lg-6 zoomIn wow" data-wow-delay="0.3s">
                        <div class="row g-3">
                            <div class="col-6">
                                <img class="p-2 w-100 h-100 img-fluid" src="{{ asset ('assets/img/rd4.jpg') }}" alt=""
                                    style="background:#ff1f1f;">
                            </div>
                            <div class="col-6">
                                <img class="p-2 w-100 h-100 img-fluid" src="{{ asset ('assets/img/rd3.jfif') }}" alt=""
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


    <section id="about" class="about p-3">
        <div class="container">

            <div class="row position-relative">

                <div class="col-lg-7 about-img wow fadeInRight" style="background-image: url({{asset('assets/img/d6.jpg') }});"></div>
                <div class="col-lg-7 wow fadeInLeft">
                    <h2>Become A Volunteer</h2>
                    <div class="our-story">
                        <h3>Donations Details</h3>
                        <p>Join our community of dedicated individuals and make a positive impact! By registering as a volunteer, you will contribute your time and skills to support our mission.
                            Whether you're helping at an event, supporting programs, or providing valuable assistance, your participation is vital to our success.</p>
                        <ul>
                            <li><i class="fas fa-handshake me-2" style="color: #ff1f1f;"></i> <span>Task and Event Participation</span></li>
                            <li><i class="fas fa-handshake me-2" style="color: #ff1f1f;"></i> <span>Assisting in Donation Collection and Distribution</span></li>
                            <li><i class="fas fa-handshake me-2" style="color: #ff1f1f;"></i> <span>Volunteer Activity Tracking</span></li>
                        </ul>
                        <p>We appreciate your interest and look forward to having you as part of our volunteer team!</p>

                        <div class="watch-video d-flex align-items-center position-relative">
                            <i class="fas fa-hand-point-right fa-2xl me-2" style="color: #ff1f1f;"></i>
                            <a href="{{ route ('register')}}" class="btn btn-primary rounded-pill py-3 px-4 px-md-5 ms-2">Register Now!</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <div class="container-fluid offer-section py-5">
        <div class="container py-5">
            <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.2s" style="max-width: 800px;">
                <h4 class="section-header"> Volunteer Service FAQs</h4>
                <h1 class="display-5 mb-4">Become A UniAid Volunteer</h1>
                <p class="mb-0">
                    The Volunteer Service Office manages programs to encourage people to volunteer for the Philippine Red Cross (PRC), offering their time and resources to alleviate human suffering.
                    It oversees volunteer recruitment, development, and mobilization both locally and nationwide.
            </div>
            <div class="row g-5 align-items-center">
                <div class="col-xl-5 wow fadeInLeft" data-wow-delay="0.2s">
                    <div class="nav nav-pills bg-light rounded p-5">
                        <a class="accordion-link p-4 active mb-4" data-bs-toggle="pill" href="#collapseOne">
                            <h5 class="mb-0">How do i start volunteering?</h5>
                        </a>
                        <a class="accordion-link p-4 mb-4" data-bs-toggle="pill" href="#collapseTwo">
                            <h5 class="mb-0">What are the requirements?</h5>
                        </a>
                        <a class="accordion-link p-4 mb-4" data-bs-toggle="pill" href="#collapseThree">
                            <h5 class="mb-0">Is there any age requirement?</h5>
                        </a>
                        <a class="accordion-link p-4 mb-0" data-bs-toggle="pill" href="#collapseFour">
                            <h5 class="mb-0">Where exactly are located?</h5>
                        </a>
                    </div>
                </div>
                <div class="col-xl-7 wow fadeInRight" data-wow-delay="0.4s">
                    <div class="tab-content">
                        <div id="collapseOne" class="tab-pane fade show p-0 active">
                            <div class="row g-4">
                                <div class="col-md-7">
                                    <img src="{{asset('assets/img/d5.jpg') }}" class="img-fluid w-100 h-100 rounded" alt="">
                                </div>
                                <div class="col-md-5">
                                    <h1 class="display-5 mb-4">How do i start volunteering?</h1>
                                    <p class="mb-4">To become a PRC volunteer, you need to fill out the online application form through redcross.ph/volunteer.
                                        You may also personally go to NHQ or at our local chapter nearest you to complete the profile form.
                                        You can inquire through our website at www.redcross.org.ph or call us at 7902300 LOCAL 945 or send us an email at volunteer@redcross.org.ph.

                                    </p>
                                    <a class="btn btn-primary rounded-pill py-2 px-4" href="#">Learn More</a>
                                </div>
                            </div>
                        </div>
                        <div id="collapseTwo" class="tab-pane fade show p-0">
                            <div class="row g-4">
                                <div class="col-md-7">
                                    <img src="{{asset('assets/img/ab3.jpg') }}" class="img-fluid w-100 h-100 rounded" alt="">
                                </div>
                                <div class="col-md-5">
                                    <h1 class="display-5 mb-4">What are the requirements?</h1>
                                    <p class="mb-4">After filling out of the application form online, wait for an invitation to be sent in your email address and know your schedule of orientation.
                                        You will be required to attend the Basic Volunteer Orientation Course (BVOC).
                                        Other requirements include: <br>
                                        <br>a. PRC membership known as Membership with Accident Assistance Benefit (MAAB)
                                        <br>b. Photocopy of two valid IDs
                                        <br>c. Copy of Resume
                                        <br>d. 2x2 ID picture
                                    </p>
                                    <a class="btn btn-primary rounded-pill py-2 px-4" href="#">Learn More</a>
                                </div>
                            </div>
                        </div>
                        <div id="collapseThree" class="tab-pane fade show p-0">
                            <div class="row g-4">
                                <div class="col-md-7">
                                    <img src="{{asset('assets/img/ab3.jpg') }}" class="img-fluid w-100  h-100 rounded" alt="">
                                </div>
                                <div class="col-md-5">
                                    <h1 class="display-5 mb-4">Is there any age requirement?</h1>
                                    <p class="mb-4">We have youth programs involving school-based Red Cross Youth volunteers in elementary, high school and college and young professionals in the community.
                                        We do not have a maximum age limit in place.As long as you are physically and mentally healthy, and willing to serve, you are welcome.
                                    </p>
                                    <a class="btn btn-primary rounded-pill py-2 px-4" href="#">Learn More</a>
                                </div>
                            </div>
                        </div>
                        <div id="collapseFour" class="tab-pane fade show p-0">
                            <div class="row g-4">
                                <div class="col-md-7">
                                    <img src="{{asset('assets/img/ab3.jpg') }}" class="img-fluid w-100  h-100 rounded" alt="">
                                </div>
                                <div class="col-md-5">
                                    <h1 class="display-5 mb-4">Where exactly are located?</h1>
                                    <p class="mb-4">PRC National Headquarters is located at 37 EDSA corner Boni Avenue, Mandaluyong City.
                                        You may call the Volunteer Service at (02)790 2300 local 945. We can also refer you to our Chapters nearest you.
                                    </p>
                                    <a class="btn btn-primary rounded-pill py-2 px-4" href="#">Learn More</a>
                                </div>
                            </div>
                        </div>
                    </div>
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
                        <a href="{{ route('about') }}"><i class="fas fa-angle-right me-2"></i> About Us</a>
                        <a href="{{ route('register') }}"><i class="fas fa-angle-right me-2"></i> Register</a>
                        <a href="{{ route('home') }}#portals"><i class="fas fa-angle-right me-2"></i> Portals</a>
                        <a href="{{ route('home') }}#news"><i class="fas fa-angle-right me-2"></i> News</a>
                        <a href="{{ route('contact') }}"><i class="fas fa-angle-right me-2"></i> Contact us</a>
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

    <script src="{{ asset('lib/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('lib/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('lib/animate/wow.min.js') }}"></script>
    <script src="{{ asset('lib/jquery/easing.min.js') }}"></script>
    <script src="{{ asset('lib/jquery/counterup.min.js') }}"></script>
    <script src="{{ asset('lib/owlcarousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('lib/fontawesome/all.js') }}"></script>

    <!-- Template JavaScript -->
    <script src="{{ asset('assets/homepage/js/main.js') }}"></script>
</body>

</html>
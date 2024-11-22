<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Donation - UniAid</title>
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
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link active" data-bs-toggle="dropdown">
                            <span>More <i class="fa-solid fa-angle-down fa-sm dropdown-toggle"></i></span>

                        </a>
                        <div class="dropdown-menu m-0">
                            <a href="{{ route ('more_donor')}}" class="dropdown-item active">Donation</a>
                            <a href="{{ route ('more_recipient')}}" class="dropdown-item">Recipient</a>
                            <a href="{{ route ('more_volunteer')}}" class="dropdown-item">Volunteer</a>
                        </div>
                    </div>
                    <a href="{{ route ('contact')}}" class="nav-item nav-link ">Contact Us</a>
                    <a href="{{ route ('register')}}" class="nav-item nav-link">Register</a>
                </div>
                <a href="{{ route('home') }}#portals" class="btn btn-primary rounded-pill py-2 px-4 my-3 my-lg-0 flex-shrink-0">Portals</a>
            </div>
        </nav>

        <!-- Header Start -->
        <div class="container-fluid bg-breadcrumb py-5  mb-5">
            <div class="container text-center py-5">
                <div class="row g-5 align-items-center">
                    <div class="col-lg-6">
                        <h4 class="text-white display-4 mb-4 wow fadeInDown" data-wow-delay="0.3s">More About Donations</h4>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb d-flex justify-content-center mb-0 wow fadeInDown"
                                data-wow-delay="0.3s">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">More About Donations</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-lg-6 zoomIn wow" data-wow-delay="0.3s">
                        <div class="row g-3">
                            <div class="col-6">
                                <img class="p-2 w-100 h-100 img-fluid" src="{{ asset ('assets/img/rd5.jfif') }}" alt=""
                                    style="background:#ff1f1f;">
                            </div>
                            <div class="col-6">
                                <img class="p-2 w-100 h-100 img-fluid" src="{{ asset ('assets/img/rd6.jpg') }}" alt=""
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

    <!-- ======= More About Donation Section ======= -->
    <section id="about" class="about p-3">
        <div class="container">

            <div class="row position-relative">

                <div class="col-lg-7 about-img wow fadeInRight" style="background-image: url({{asset('assets/img/d1.jpg') }});"></div>
                <div class="col-lg-7 wow fadeInLeft">
                    <h2>About UniAid Donations</h2>
                    <div class="our-story">
                        <h3>How to Donate?</h3>
                        <p>Here are some steps to help bridge the gap between you and others through 
                            meaningful acts of donation and support using our platform: </p>
                        <ul>
                            <li><i class="fas fa-handshake me-2" style="color: #ff1f1f;"></i> <span>Select option (Quick Donation/Donee Selection)</span></li>  
                            <li><i class="fas fa-handshake me-2" style="color: #ff1f1f;"></i> <span>Donor Options for Delivery (Pickup, Drop-Off)</span></li>
                            <li><i class="fas fa-handshake me-2" style="color: #ff1f1f;"></i> <span>Filters and Search (Resource Type, location, Urgency)</span></li>
                            <li><i class="fas fa-handshake me-2" style="color: #ff1f1f;"></i> <span>Track on-going donation</span></li>
                            <li><i class="fas fa-handshake me-2" style="color: #ff1f1f;"></i> <span>Recieve SMS notification upon completing</span></li>
                        </ul>
                        <p>
                        Join our mission to make a difference! Learn how your contributions can help change lives and support our cause.
                         Every donation matters, sign up now to learn more and become a valued supporter today.
                        </p>

                        <div class="watch-video d-flex align-items-center position-relative">
                            <i class="fas fa-hand-point-right fa-2xl me-2" style="color: #ff1f1f;"></i>
                            <a href="{{ route ('register')}}" class="btn btn-primary rounded-pill py-3 px-4 px-md-5 ms-2">Register and Donate Now!</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section id="alt-services" class="alt-services p-3 m-3">
        <div class="container">

            <div class="row justify-content-around gy-4">
                <div class="col-lg-6 img-bg wow fadeInLeft" style="background-image: url({{asset('assets/img/d2.jfif') }});"></div>

                <div class="col-lg-5 d-flex flex-column justify-content-center wow fadeInRight">
                    <h3>Others Ways to Donate: </h3>
                    <p>Choose your preferred way to contribute via Lazada donation vouchers, online banking transfers, or in-kind donations. 
                        Every contribution, big or small, helps us bring relief and hope to those in need. Together, we can make a difference!</p>

                    <div class="icon-box d-flex position-relative">
                    <i class="fa-solid fa-building-columns flex-shrink-0"></i>
                        <div>
                            <h4><a href="" class="stretched-link">Bank</a></h4>
                            <p>You can deposit your donation to any of the following bank accounts:<br> BDO (Account: 00-023-111-8977)<br>
                            Metrobank (Account: 175-3-175001-468)<br> BPI (Account: 4991-0001-44).
                            </p>
                        </div>
                    </div><!-- End Icon Box -->

                    <div class="icon-box d-flex position-relative">
                    <i class="fa-solid fa-globe flex-shrink-0"></i>
                        <div>
                            <h4><a href="" class="stretched-link">Online</a></h4>
                            <p>The Philippine Red Cross accepts donations via GCash and PayMaya. Open your app, navigate to the "Pay Bills" or "Donate" section, and search for "Philippine Red Cross.</p>
                        </div>
                    </div><!-- End Icon Box -->

                    <div class="icon-box d-flex position-relative">
                    <i class="fa-solid fa-credit-card flex-shrink-0"></i>
                        <div>
                            <h4><a href="https://www.lazada.com.ph/shop/philippine-red-cross" target="_blank" class="stretched-link">Lazada Donation Voucher</a></h4>
                            <p>Make a meaningful impact with ease, purchase our donation vouchers on Lazada and bring hope and positive change to those in need!</p>
                        </div>
                    </div><!-- End Icon Box -->

                    <div class="icon-box d-flex position-relative">
                    <i class="fa-solid fa-box-open flex-shrink-0"></i>
                        <div>
                            <h4><a href="" class="stretched-link">In-Kind</a></h4>
                            <p> &nbsp - For perishable goods, PRC only accepts goods with an expiry date of <br> &nbsp not less than six (6) months.<br>
                            &nbsp - PRC does not accept rotten, damaged, expired, or decayed goods.<br>
                            &nbsp   - The PRC also discourages donations of old clothes as we have more <br>&nbsp than enough to go around.<br>
                                 <B>ADDRESS:</B> Philippine Red Cross 37 EDSA corner Boni Ave. Mandaluyong City 1550 Philippines
                                <br> <B>EMERGENCY HOTLINE</B>: 143</p>
                        </div>
                    </div><!-- End Icon Box -->

                    <div class="icon-box d-flex position-relative">
                    <i class="fa-solid fa-capsules flex-shrink-0"></i>
                        <div>
                            <h4><a href="" class="stretched-link">Medecines and Food Donations:</a></h4>
                            <p> 1. In the case of medicines & food,  a certification from the Philippines' Department of Health and the Food & Drug Administration commodities are allowed to be imported without a prior prescription.
                                <br>2. Expiry should be at least 24 months or 2 years.
                            </p>
                        </div>
                    </div><!-- End Icon Box -->

                </div>
            </div>
        </div>
    </section>

    <!-- Accepted Donation -->
    <div class="container-fluid blog py-5 portals">
        <div class="container py-5 wow slideInLeft" data-wow-delay="0.3s">
            <div class="text-center mx-auto pb-5" style="max-width: 800px;">
                <h2 class="section-header">Types of resources</h2>
                <h1 class="display-5 mb-4">We Accept Donations of Essential Resources</h1>
                <p class="mb-0"> UniAid welcomes various types of donations to help communities in need. From monetary
                    contributions to essential resources, your generosity plays a crucial role in supporting those who
                    need it most across the Philippines.
                </p>
            </div>
            <div class="owl-carousel blog-carousel">

                <div class="blog-item text-center">
                    <div class="blog-img mb-2">
                        <img src="{{asset('assets/img/resource1.jpg') }}" class="img-fluid w-100 rounded" alt="">
                    </div>
                    <h4 class="d-inline-block m-2">Resource Type</h4>
                </div>

                <div class="blog-item text-center">
                    <div class="blog-img mb-2">
                        <img src="{{asset('assets/img/resource1.jpg') }}" class="img-fluid w-100 rounded" alt="">
                    </div>
                    <h4 class="d-inline-block m-2">Resource Type</h4>
                </div>

                <div class="blog-item text-center">
                    <div class="blog-img mb-2">
                        <img src="{{asset('assets/img/resource1.jpg') }}" class="img-fluid w-100 rounded" alt="">
                    </div>
                    <h4 class="d-inline-block m-2">Resource Type</h4>
                </div>

                <div class="blog-item text-center">
                    <div class="blog-img mb-2">
                        <img src="{{asset('assets/img/resource1.jpg') }}" class="img-fluid w-100 rounded" alt="">
                    </div>
                    <h4 class="d-inline-block m-2">Resource Type</h4>
                </div>
            </div>
        </div>
    </div>
    <!-- Accepted Donation -->

    <!-- End Section -->

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
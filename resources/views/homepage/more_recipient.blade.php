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
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link active" data-bs-toggle="dropdown">
                            <span>More <i class="fa-solid fa-angle-down fa-sm dropdown-toggle"></i></span>

                        </a>
                        <div class="dropdown-menu m-0">
                            <a href="{{ route ('more_donor')}}" class="dropdown-item">Donation</a>
                            <a href="{{ route ('more_recipient')}}" class="dropdown-item active">Recipient</a>
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
                        <h4 class="text-white display-4 mb-4 wow fadeInDown" data-wow-delay="0.3s">More About Donee (Recipient)</h4>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb d-flex justify-content-center mb-0 wow fadeInDown"
                                data-wow-delay="0.3s">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">More About Recipient</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-lg-6 zoomIn wow" data-wow-delay="0.3s">
                        <div class="row g-3">
                            <div class="col-6">
                                <img class="p-2 w-100 h-100 img-fluid" src="{{ asset ('assets/img/rd7.jfif') }}" alt=""
                                    style="background:#ff1f1f;">
                            </div>
                            <div class="col-6">
                                <img class="p-2 w-100 h-100 img-fluid" src="{{ asset ('assets/img/rd9.webp') }}" alt=""
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

    <!-- =======  Section ======= -->
    <section id="alt-services-2" class="alt-services p-3 m-3">
        <div class="container" data-aos="fade-up">

            <div class="row justify-content-around gy-4">
                <div class="col-lg-5 d-flex flex-column justify-content-center wow fadeInLeft">
                    <h3>How to Donate in UniAid?</h3>
                    <p>Esse voluptas cumque vel exercitationem. Reiciendis est hic accusamus. Non ipsam et sed minima temporibus
                        laudantium. Soluta voluptate sed facere corporis dolores excepturi</p>

                    <div class="icon-box d-flex position-relative">
                        <i class="fa-brands fa-gratipay flex-shrink-0"></i>
                        <div>
                            <h4><a href="" class="stretched-link">Lorem Ipsum</a></h4>
                            <p>Voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate
                                non provident</p>
                        </div>
                    </div><!-- End Icon Box -->

                    <div class="icon-box d-flex position-relative">
                        <i class="fa-brands fa-gratipay flex-shrink-0"></i>
                        <div>
                            <h4><a href="" class="stretched-link">Nemo Enim</a></h4>
                            <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum
                                deleniti atque</p>
                        </div>
                    </div><!-- End Icon Box -->

                    <div class="icon-box d-flex position-relative">
                        <i class="fa-brands fa-gratipay flex-shrink-0"></i>
                        <div>
                            <h4><a href="" class="stretched-link">Dine Pad</a></h4>
                            <p>Explicabo est voluptatum asperiores consequatur magnam. Et veritatis odit. Sunt aut deserunt minus
                                aut eligendi omnis</p>
                        </div>
                    </div><!-- End Icon Box -->

                    <div class="icon-box d-flex position-relative">
                        <i class="fa-brands fa-gratipay flex-shrink-0"></i>
                        <div>
                            <h4><a href="" class="stretched-link">Tride clov</a></h4>
                            <p>Est voluptatem labore deleniti quis a delectus et. Saepe dolorem libero sit non aspernatur odit amet.
                                Et eligendi</p>
                        </div>
                    </div><!-- End Icon Box -->
                </div>

                <div class="col-lg-6 img-bg wow  wow fadeInRight " style="background-image: url({{asset('assets/img/ab1.jpg') }});"></div>
            </div>
        </div>
    </section>

    <section id="alt-services" class="alt-services p-3 m-3">
        <div class="container">

            <div class="row justify-content-around gy-4">
                <div class="col-lg-6 img-bg wow fadeInLeft" style="background-image: url({{asset('assets/img/ab1.jpg') }});"></div>

                <div class="col-lg-5 d-flex flex-column justify-content-center wow fadeInRight">
                    <h3>How to Donate in UniAid?</h3>
                    <p>Esse voluptas cumque vel exercitationem. Reiciendis est hic accusamus. Non ipsam et sed minima temporibus
                        laudantium. Soluta voluptate sed facere corporis dolores excepturi</p>

                    <div class="icon-box d-flex position-relative">
                        <i class="fa-brands fa-gratipay flex-shrink-0"></i>
                        <div>
                            <h4><a href="" class="stretched-link">Lorem Ipsum</a></h4>
                            <p>Voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate
                                non provident</p>
                        </div>
                    </div><!-- End Icon Box -->

                    <div class="icon-box d-flex position-relative">
                        <i class="fa-brands fa-gratipay flex-shrink-0"></i>
                        <div>
                            <h4><a href="" class="stretched-link">Nemo Enim</a></h4>
                            <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum
                                deleniti atque</p>
                        </div>
                    </div><!-- End Icon Box -->

                    <div class="icon-box d-flex position-relative">
                        <i class="fa-brands fa-gratipay flex-shrink-0"></i>
                        <div>
                            <h4><a href="" class="stretched-link">Dine Pad</a></h4>
                            <p>Explicabo est voluptatum asperiores consequatur magnam. Et veritatis odit. Sunt aut deserunt minus
                                aut eligendi omnis</p>
                        </div>
                    </div><!-- End Icon Box -->

                    <div class="icon-box d-flex position-relative">
                        <i class="fa-brands fa-gratipay flex-shrink-0"></i>
                        <div>
                            <h4><a href="" class="stretched-link">Tride clov</a></h4>
                            <p>Est voluptatem labore deleniti quis a delectus et. Saepe dolorem libero sit non aspernatur odit amet.
                                Et eligendi</p>
                        </div>
                    </div><!-- End Icon Box -->
                </div>
            </div>
        </div>
    </section>


    <!-- End Section  -->




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
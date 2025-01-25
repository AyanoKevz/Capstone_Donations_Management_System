<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>UniAid</title>
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
    <div id="spinner" class="show bg-white position-fixed w-100 vh-100 d-flex flex-column align-items-center justify-content-center">
        <div class="text-center mb-4">
            <h1 class="m-0 fw-bold" style="color: #ff1f1f; font-size:50px;">
                <img src="{{ asset('assets/img/systemLogo.png') }}" class="me-3 w-25" alt="Logo">UniAid
            </h1>
        </div>
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
                    <a href="{{ route ('home')}}" class="nav-item nav-link active">Home</a>
                    <a href="{{ route ('about')}}" class="nav-item nav-link">About</a>
                    <a href="#testimonials" class="nav-item nav-link">Testimonial</a>
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
                    <a href="{{ route ('register')}}" class="nav-item nav-link">Register</a>
                </div>
                <a href="#portals" class="btn btn-primary rounded-pill py-2 px-4 my-3 my-lg-0 flex-shrink-0">Portal</a>
            </div>
        </nav>

        <!-- Carousel Start -->
        <div class="header-carousel owl-carousel">
            <div class="header-carousel-item">

                <img src="{{asset('assets/img/hero-2.jfif') }}" class="img-fluid w-100" alt="Image">
                <div class="carousel-caption">
                    <div class="container">
                        <div class="row gy-0 gx-5">
                            <div class="col-lg-0 col-xl-5 d-none d-xl-block wow fadeInLeft">
                                <img src="{{ asset('assets/img/systemLogo.png') }}" class="img-fluid" alt="System Logo">
                            </div>

                            <div class="col-xl-7 wow fadeInRight">
                                <div class="text-sm-center text-md-end">
                                    <h3 class="carousel-header text-uppercase mb-4">Welcome To UniAid</h4>
                                        <h2 class="display-4 text-uppercase text-white mb-4">Community Donations and
                                            Resources Distribution</h2>
                                        <p class="mb-3 fs-5">UniAid is a platform that bridges the gap between donors
                                            and those in need. Whether you want to give, receive, or volunteer, UniAid
                                            makes it simple to contribute and request resources across the Philippines.
                                        </p>
                                        <div
                                            class="d-flex justify-content-center justify-content-md-end flex-shrink-0 mb-5">
                                            <a class="btn btn-primary rounded-pill py-3 px-4 px-md-5 ms-2"
                                                href="#about">Learn
                                                More</a>
                                        </div>
                                        <div
                                            class="d-flex align-items-center justify-content-center justify-content-md-end">
                                            <h2 class="text-white me-2 mb-0">Follow Us:</h2>
                                            <div class="d-flex justify-content-center ms-2">
                                                <a class="btn btn-md-square btn-light rounded-circle me-2"
                                                    href="https://www.facebook.com/phredcross" target="_blank"><i
                                                        class="fab fa-facebook-f"></i></a>
                                                <a class="btn btn-md-square btn-light rounded-circle mx-2"
                                                    href="https://x.com/philredcross?mx=2" target="_blank"><i
                                                        class="fab fa-twitter"></i></a>
                                                <a class="btn btn-md-square btn-light rounded-circle mx-2"
                                                    href="https://www.instagram.com/philredcross/" target="_blank"><i
                                                        class="fab fa-instagram"></i></a>
                                                <a class="btn btn-md-square btn-light rounded-circle ms-2"
                                                    href="https://www.linkedin.com/authwall?trk=bf&trkInfo=AQG5L29q_iR04gAAAZJD6itogdLGIBN_s1xsrE9UpfecYUEigsPKbT-qW_l8QHDO39R9u7Tdt9YtyqWKyDMAT_SdwWfWF26jNVEheyJkrIXk6gDKySM35vzHOu5wZ3nAixD8fTw=&original_referer=&sessionRedirect=https%3A%2F%2Fwww.linkedin.com%2Fcompany%2F1089054"
                                                    target="_blank"><i class="fab fa-linkedin-in"></i></a>
                                            </div>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="header-carousel-item">
                <img src="{{asset('assets/img/hero-1.jpg') }}" class="img-fluid w-100" alt="Image">
                <div class="carousel-caption">
                    <div class="container">
                        <div class="row g-5">
                            <div class="col-12 animated fadeInUp">
                                <div class="d-flex flex-column align-items-center">
                                    <h1 class="carousel-header text-uppercase fw-bold mb-3 fs-1 d-flex align-items-center wow tada"
                                        data-wow-iteration="infinite">
                                        UniAid
                                        <img src="{{ asset('assets/img/systemLogo.png') }}"
                                            alt="System Logo"
                                            class="ms-2"
                                            style="width: 5rem;">
                                    </h1>

                                    <h2 class="display-4 text-uppercase text-white mb-4">Community Donations and
                                        Resources Distribution</h2>
                                    <p class="mb-3 fs-5"> UniAid simplifies the donation process, connecting donors,
                                        recipients, and volunteers in a transparent and efficient way. Together, we help
                                        meet the needs of communities across the Philippines.
                                    </p>
                                    <div class="d-flex justify-content-center flex-shrink-0 mb-5">
                                        <a class="btn btn-primary rounded-pill py-3 px-4 px-md-5 my-2"
                                            href="#portals">Login
                                            Now</a>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-center">
                                        <h2 class="text-white me-2 mb-0">Follow Us:</h2>
                                        <div class="d-flex justify-content-end ms-2">
                                            <a class="btn btn-md-square btn-light rounded-circle me-2"
                                                href="https://www.facebook.com/phredcross" target="_blank"><i
                                                    class="fab fa-facebook-f"></i></a>
                                            <a class="btn btn-md-square btn-light rounded-circle mx-2"
                                                href="https://x.com/philredcross?mx=2" target="_blank"><i
                                                    class="fab fa-twitter"></i></a>
                                            <a class="btn btn-md-square btn-light rounded-circle mx-2"
                                                href="https://www.instagram.com/philredcross/" target="_blank"><i
                                                    class="fab fa-instagram"></i></a>
                                            <a class="btn btn-md-square btn-light rounded-circle ms-2"
                                                href="https://www.linkedin.com/authwall?trk=bf&trkInfo=AQG5L29q_iR04gAAAZJD6itogdLGIBN_s1xsrE9UpfecYUEigsPKbT-qW_l8QHDO39R9u7Tdt9YtyqWKyDMAT_SdwWfWF26jNVEheyJkrIXk6gDKySM35vzHOu5wZ3nAixD8fTw=&original_referer=&sessionRedirect=https%3A%2F%2Fwww.linkedin.com%2Fcompany%2F1089054"
                                                target="_blank"><i class="fab fa-linkedin-in"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Carousel End -->
    </div>
    <!-- Navbar & Hero End -->


    <!-- About Start -->
    <div class="container-fluid about py-3" id="about">
        <div class="container py-3">
            <div class="row g-5 align-items-center">
                <div class="col-xl-7 wow fadeInLeft" data-wow-delay="0.2s">
                    <div>
                        <h2 class="section-header">UniAid</h2>
                        <h1 class="display-5 mb-4">Connecting Communities Through Compassion</h1>
                        <p class="mb-4">UniAid is a web-based platform that connects donors, recipients, and volunteers,
                            streamlining the donation process and resource distribution across communities. Acting as a
                            centralized hub, UniAid facilitates the donation of essentials like food, clothing, and
                            educational materials, while ensuring transparency, accountability, and easy access to those
                            in need.
                        </p>
                        <div class="row g-4">
                            <div class="col-md-6 col-lg-6 col-xl-6">
                                <div class="d-flex">
                                    <div><i class="fas fa-hand-holding-heart fa-3x me-4" style=" color: #ff1f1f;"></i>
                                    </div>
                                    <div class="ms-4">
                                        <h4>Donation Process</h4>
                                        <p>Allows individuals and organizations to make quick donations or browse
                                            specific recipient requests efficiently.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="d-flex">
                                    <i class="fas fa-users fa-3x me-4" style="color: #ff1f1f;"></i>
                                    <div>
                                        <h4>Volunteer Engagement</h4>
                                        <p>Volunteers can assist with donation collection, distribution, and participate
                                            in community events.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 col-lg-6 col-xl-6">
                                <div class="d-flex">
                                    <div><i class="fas fa-handshake-simple fa-3x me-4" style="color: #ff1f1f;"></i>
                                    </div>
                                    <div>
                                        <h4>Resource Request & Distribution</h4>
                                        <p>Enables individuals and organizations to request aid by posting specific
                                            needs or accessing available resources from the general pool.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="d-flex">
                                    <i class="fas fa-map-marked-alt fa-3x me-4" style="color: #ff1f1f;"></i>
                                    <div>
                                        <h4>Geo Mapping & Resource Management</h4>
                                        <p>Displays an interactive map showing recipients' locations and manages
                                            resources to ensure efficient allocation based on needs.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-5 wow fadeInRight" data-wow-delay="0.2s">
                    <div class="rounded position-relative overflow-hidden">
                        <img src="{{asset('assets/img/ab1.jpg') }}" class="img-fluid rounded w-100" alt="">

                    </div>
                    <div class="rounded-bottom mt-2">
                        <img src="{{asset('assets/img/ab3.jpg') }}" class="img-fluid rounded-bottom w-100" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->


    <!-- Accepted Donation -->
    <div class="container-fluid blog py-5">
        <div class="container py-5 wow slideInLeft" data-wow-delay="0.3s">
            <div class="text-center mx-auto pb-5" style="max-width: 800px;">
                <h2 class="section-header">Types of resources</h2>
                <h1 class="display-5 mb-4">We Accept Donations of Essential Resources</h1>
                <p class="mb-0"> UniAid welcomes various types of donations to help communities in need. From monetary
                    contributions to essential resources, your generosity plays a crucial role in supporting those who
                    need it most across the Philippines.
                </p>
            </div>

            <div class="text-center">
            <h3 class="mb-4">Basic Needs</h3>
             </div>

            <div class="owl-carousel blog-carousel">

                <div class="resources-item text-center">
                    <div class="resources-img mb-2">
                        <img src="{{asset('assets/img/r1.jpg') }}" class="img-fluid w-100 rounded" alt="">
                    </div>
                    <h4 class="d-inline-block m-2">Canned Goods</h4>
                </div>

                <div class="resources-item text-center">
                    <div class="resources-img mb-2">
                        <img src="{{asset('assets/img/r3.png') }}" class="img-fluid w-100 rounded" alt="">
                    </div>
                    <h4 class="d-inline-block m-2">Instant Noodles</h4>
                </div>

                <div class="resources-item text-center">
                    <div class="resources-img mb-2">
                        <img src="{{asset('assets/img/r4.png') }}" class="img-fluid w-100 rounded" alt="">
                    </div>
                    <h4 class="d-inline-block m-2">Bottled Water</h4>
                </div>

                <div class="resources-item text-center">
                    <div class="resources-img mb-2">
                        <img src="{{asset('assets/img/r5.png') }}" class="img-fluid w-100 rounded" alt="">
                    </div>
                    <h4 class="d-inline-block m-2">3KG Packaged Rice</h4>
                </div>

                <div class="resources-item text-center">
                    <div class="resources-img mb-2">
                        <img src="{{asset('assets/img/r6.png') }}" class="img-fluid w-100 rounded" alt="">
                    </div>
                    <h4 class="d-inline-block m-2">Biscuits</h4>
                </div>

            </div>
        </div>
    </div>

    <div class="container-fluid blog py-5">
        <div class="container py-5 wow slideInLeft" data-wow-delay="0.3s">
            <div class="text-center">
            <h3 class="mb-4">New Clothing and Bedding</h3>
             </div>

            <div class="owl-carousel blog-carousel">

                <div class="resources-item text-center">
                    <div class="resources-img mb-2">
                        <img src="{{asset('assets/img/b1.png') }}" class="img-fluid w-100 rounded" alt="">
                    </div>
                    <h4 class="d-inline-block m-2">Blankets</h4>
                </div>

                <div class="resources-item text-center">
                    <div class="resources-img mb-2">
                        <img src="{{asset('assets/img/t1.png') }}" class="img-fluid w-100 rounded" alt="">
                    </div>
                    <h4 class="d-inline-block m-2">Towels</h4>
                </div>

                <div class="resources-item text-center">
                    <div class="resources-img mb-2">
                        <img src="{{asset('assets/img/c1.png') }}" class="img-fluid w-100 rounded" alt="">
                    </div>
                    <h4 class="d-inline-block m-2">Jacket/Sweaters</h4>
                </div>

                <div class="resources-item text-center">
                    <div class="resources-img mb-2">
                        <img src="{{asset('assets/img/r8.png') }}" class="img-fluid w-100 rounded" alt="">
                    </div>
                    <h4 class="d-inline-block m-2">Clothes</h4>
                </div>

                <div class="resources-item text-center">
                    <div class="resources-img mb-2">
                        <img src="{{asset('assets/img/s1.png') }}" class="img-fluid w-100 rounded" alt="">
                    </div>
                    <h4 class="d-inline-block m-2">Slippers</h4>
                </div>

            </div>
        </div>
    </div>

    <div class="container-fluid blog py-5">
        <div class="container py-5 wow slideInLeft" data-wow-delay="0.3s">
            <div class="text-center">
            <h3 class="mb-4">Hygiene</h3>
             </div>

            <div class="owl-carousel blog-carousel">

                <div class="resources-item text-center">
                    <div class="resources-img mb-2">
                        <img src="{{asset('assets/img/q2.png') }}" class="img-fluid w-100 rounded" alt="">
                    </div>
                    <h4 class="d-inline-block m-2">Soap</h4>
                </div>

                <div class="resources-item text-center">
                    <div class="resources-img mb-2">
                        <img src="{{asset('assets/img/q3.png') }}" class="img-fluid w-100 rounded" alt="">
                    </div>
                    <h4 class="d-inline-block m-2">Sachet Shampoos</h4>
                </div>

                <div class="resources-item text-center">
                    <div class="resources-img mb-2">
                        <img src="{{asset('assets/img/q4.png') }}" class="img-fluid w-100 rounded" alt="">
                    </div>
                    <h4 class="d-inline-block m-2">Toothpaste</h4>
                </div>

                <div class="resources-item text-center">
                    <div class="resources-img mb-2">
                        <img src="{{asset('assets/img/q1.png') }}" class="img-fluid w-100 rounded" alt="">
                    </div>
                    <h4 class="d-inline-block m-2">Toothbrushes</h4>
                </div>

                <div class="resources-item text-center">
                    <div class="resources-img mb-2">
                        <img src="{{asset('assets/img/q5.png') }}" class="img-fluid w-100 rounded" alt="">
                    </div>
                    <h4 class="d-inline-block m-2">Baby Diapers</h4>
                </div>

                <div class="resources-item text-center">
                    <div class="resources-img mb-2">
                        <img src="{{asset('assets/img/q6.png') }}" class="img-fluid w-100 rounded" alt="">
                    </div>
                    <h4 class="d-inline-block m-2">Hand Sanitizers</h4>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid blog py-5">
        <div class="container py-5 wow slideInLeft" data-wow-delay="0.3s">
            <div class="text-center">
            <h3 class="mb-4">Medical Supplies</h3>
             </div>

            <div class="owl-carousel blog-carousel">

                <div class="resources-item text-center">
                    <div class="resources-img mb-2">
                        <img src="{{asset('assets/img/w1.png') }}" class="img-fluid w-100 rounded" alt="">
                    </div>
                    <h4 class="d-inline-block m-2">First Aid Kits</h4>
                </div>

                <div class="resources-item text-center">
                    <div class="resources-img mb-2">
                        <img src="{{asset('assets/img/w2.png') }}" class="img-fluid w-100 rounded" alt="">
                    </div>
                    <h4 class="d-inline-block m-2">Bondages and Gauze</h4>
                </div>

                <div class="resources-item text-center">
                    <div class="resources-img mb-2">
                        <img src="{{asset('assets/img/w3.png') }}" class="img-fluid w-100 rounded" alt="">
                    </div>
                    <h4 class="d-inline-block m-2">Alcohol/Disinfectants</h4>
                </div>

                <div class="resources-item text-center">
                    <div class="resources-img mb-2">
                        <img src="{{asset('assets/img/w4.png') }}" class="img-fluid w-100 rounded" alt="">
                    </div>
                    <h4 class="d-inline-block m-2">Mask(N95 or Surgical)</h4>
                </div>

            </div>
        </div>
    </div>
    <!-- Accepted Donation -->


    <!-- Portals Start -->
    <div class="container-fluid service py-5 portals" id="portals">
        <div class="container pb-5 wow zoomIn" data-wow-delay="0.3s">
            @if (session('error'))
            <div id="alert-error" class="alert alert-error wow fadeInLeft" style="position: absolute;">
                <i class=" fa-solid fa-circle-xmark me-3"></i>{{ session('error') }}
            </div>
            @elseif (session('success'))
            <div id="alert-success" class="alert alert-success wow fadeInLeft" style="position: absolute;">
                <i class=" fa-solid fa-circle-check me-3"></i>{{ session('success') }}
            </div>
            @endif
            <div class="text-center mx-auto pb-5" style="max-width: 800px;">
                <h2 class="section-header">Portals</h2>
                <h1 class="display-5 mb-4">User Login Portal</h1>
                <p class="mb-0"> Access UniAid's secure login portal tailored for donors, recipients, and volunteers.Make a dontation, request, and help the community in one platform.
                </p>
            </div>
            <div class="row g-4 align-items-center">
                <div class="col-md-5">
                    <img src="{{asset('assets/img/portal.gif') }}" class="img-fluid w-100 rounded border border-4 border-danger" alt="">
                </div>
                <div class="col-md-7">
                    <h1 class="display-5 mb-4">Access Your Portal</h1>
                    <p class="mb-4">
                        Navigate effortlessly through a secure and personalized portal. Click "Login" to explore and access your personalized portal tailored to your needs.
                    </p>
                    <a class="btn btn-primary rounded-pill py-2 px-4" data-bs-toggle="modal"
                        data-bs-target="#login">Login Now</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Portals End -->

    <!-- Modal -->

    <!--  Login -->
    <div class="modal fade" id="login" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fs-5" id="staticBackdropLabel">Login Portal</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body d-flex flex-column align-items-center">

                    <h6 class="mt-2">UnidAid: Community Donations and
                        Resources Distribution</h6>
                    <div class="my-3 d-flex justify-content-center">
                        <img src="{{asset('assets/img/systemLogo.png')  }}" alt="" class="w-25">
                    </div>
                    <form action="{{ route('login') }}" method="POST" id="login-form">
                        @csrf
                        <div class="d-flex justify-content-center mb-5">
                            <span class="me-2 my-auto"><i class="fa fa-user fa-lg" style="color: #ff1f1f;"></i></span>
                            <div class="input-group">
                                <input type="text" name="username" autocomplete="off" class="login-input" id="username" required>
                                <label class="user-label" for="username">Username</label>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center align-items-center mb-5">
                            <span class="me-2">
                                <i class="fas fa-lock fa-lg" style="color: #ff1f1f;"></i>
                            </span>
                            <div class="input-group position-relative">
                                <input type="password" name="password" autocomplete="off" class="login-input password-input" required>
                                <label class="user-label" for="password">Password</label>
                                <button type="button" class="toggle-password">
                                    <i class="fas fa-eye-slash toggle-password-icon" id=""></i>
                                </button>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button class="btn btn-primary" data-bs-target="#fpass" data-bs-toggle="modal">Forgot Password</button>
                            <button type="submit" name="userlogin" id="userlogin" class="btn btn-success">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="fpass" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content email-modal">
                <div class="card-email">
                    <div class="BG">
                        <svg
                            viewBox="0 0 512 512"
                            class="ionicon"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M256 176a80 80 0 1080 80 80.24 80.24 0 00-80-80zm172.72 80a165.53 165.53 0 01-1.64 22.34l48.69 38.12a11.59 11.59 0 012.63 14.78l-46.06 79.52a11.64 11.64 0 01-14.14 4.93l-57.25-23a176.56 176.56 0 01-38.82 22.67l-8.56 60.78a11.93 11.93 0 01-11.51 9.86h-92.12a12 12 0 01-11.51-9.53l-8.56-60.78A169.3 169.3 0 01151.05 393L93.8 416a11.64 11.64 0 01-14.14-4.92L33.6 331.57a11.59 11.59 0 012.63-14.78l48.69-38.12A174.58 174.58 0 0183.28 256a165.53 165.53 0 011.64-22.34l-48.69-38.12a11.59 11.59 0 01-2.63-14.78l46.06-79.52a11.64 11.64 0 0114.14-4.93l57.25 23a176.56 176.56 0 0138.82-22.67l8.56-60.78A11.93 11.93 0 01209.94 26h92.12a12 12 0 0111.51 9.53l8.56 60.78A169.3 169.3 0 01361 119l57.2-23a11.64 11.64 0 0114.14 4.92l46.06 79.52a11.59 11.59 0 01-2.63 14.78l-48.69 38.12a174.58 174.58 0 011.64 22.66z"></path>
                        </svg>
                    </div>
                    <div class="content">
                        <p class="heading">Forgot Password?</p>
                        <p class="sub-heading">Type your email to recover</p>
                        <p class="sub-sub-heading m-0">You will recieved an email.</p>
                        <form action="{{ route('forgot-password') }}" method="POST" id="forgot_form">
                            @csrf
                            <input class="email" name="find_email" placeholder="Email" type="email" autocomplete="offs" required />
                            <button class="card-email-btn" type="submit">Find Email</button>
                            <button type="button" class="back-login" data-bs-toggle="modal"
                                data-bs-target="#login">Back</button>
                            <button type="button" class="close-forgot" data-bs-dismiss="modal">Close</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--  Modal End -->

    <!-- Blog Start -->
    <div class="container-fluid blog py-3" id="news">
        <div class="container py-3 wow slideInRight" data-wow-delay="0.3s">
            <div class="text-center mx-auto pb-5" style="max-width: 800px;">
                <h2 class="section-header">Our Blog & News</h2>
                <h1 class="display-5 mb-4">Stay Updated with UniAid</h1>
                <p class="mb-0"> Get the latest news, stories, and updates about our mission to connect donors with
                    those in need. Explore how our platform is making a difference in communities across the
                    Philippines, and stay informed about upcoming events, success stories, and volunteer efforts.
                </p>
            </div>
            @if ($news->isEmpty())
            <!-- WALANG NEWS NA POSOTED -->
            <div class="text-center">
                <p class="h4 text-danger">No news posted at the moment. Please check back later!</p>
            </div>
            @else
            <!-- MERON -->
            <div class="owl-carousel blog-carousel">
                @foreach ($news as $item)
                <div class="blog-item p-3">
                    <div class="blog-img mb-4">
                        <img src="{{ asset('storage/' . $item->image_url_2) }}"
                            class="img-fluid w-100 rounded" alt="">
                    </div>
                    <p class="text-center mb-0"><a href="{{ route('more-news', ['id' => $item->id]) }}" class="h4 d-inline-block mb-2">{{ $item->title }}</a></p>
                    <p class="mb-4">{{ Str::limit($item->content, 150) }}</p>
                    <div class="d-flex align-items-center">
                        <img src="{{ asset('storage/' . $item->admin->profile_image) }}"
                            class="img-fluid rounded-circle" style="width: 60px; height: 60px;" alt="">
                        <div class="ms-3">
                            <h5>{{$item->admin->username}} (Admin)</h5>
                            <p class="mb-0">{{ $item->created_at->format('F j, Y') }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @endif
        </div>
    </div>

    <!-- Blog End -->


    <!-- Testimonial Start -->
    <<div class="container-fluid testimonial py-3 rev" id="testimonials">
    <div class="container py-3 wow slideInLeft" data-wow-delay="0.3s">
        <div class="text-center mx-auto pb-5" style="max-width: 800px;">
            <h2 class="section-header">Testimonial</h2>
            <h1 class="display-5 mb-4">What Our Users Say</h1>
            <p class="mb-0">
            Hear from our users—donors, recipients, and volunteers—about their experiences
                        with UniAid. Discover how their involvement has impacted lives, strengthened communities,
                        and brought people together through the power of giving and receiving.
                    </p>
            </div>
            @if($testimonials->isEmpty())
            <div class="text-center">
                <p class="h4 text-danger">No testimonials posted at the moment. Please check back later!</p>
            </div>
            @else
            <div class="owl-carousel testimonial-carousel">
                @foreach($testimonials as $testimonial)
                <div class="testimonial-item">
                    <div class="testimonial-quote-left">
                        <i class="fas fa-quote-left fa-2x"></i>
                    </div>
                    <div class="testimonial-img">
                        <img src="{{ $testimonial->user->donor->user_photo ? asset('storage/' . $testimonial->user->donor->user_photo) : ($testimonial->user->volunteer->user_photo ? asset('storage/' . $testimonial->user->volunteer->user_photo) : asset('assets/img/no_profile.png')) }}"
                            class="img-fluid"
                            alt="User Image">
                    </div>
                    <div class="testimonial-text">
                        <p>{{ $testimonial->content }}</p>
                    </div>
                    <div class="testimonial-title">
                        <div>
                            <h4 class="mb-0">{{ $testimonial->user->username }}</h4>
                            <p class="mb-0 text-muted">{{ ucfirst($testimonial->user_type) }}</p>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end mb-1">
                        <p class="m-0 fw-bold">
                            @switch($testimonial->rating)
                            @case(1)
                            <span class="text-danger">Very Bad</span>
                            @break
                            @case(2)
                            <span class="text-danger">Bad</span>
                            @break
                            @case(3)
                            <span class="text-warning">Mediocre</span>
                            @break
                            @case(4)
                            <span class="text-primary">Good</span>
                            @break
                            @case(5)
                            <span class="text-success">Very Good</span>
                            @break
                            @endswitch
                        </p>
                    </div>
                    <!-- Stars -->
                    <div class="d-flex justify-content-end mb-2">
                        <p class="m-0 fw-bold">
                            @for($i = 1; $i <= $testimonial->rating; $i++)
                                <i class="fas fa-star text-warning"></i>
                                @endfor
                                @for($i = $testimonial->rating + 1; $i <= 5; $i++)
                                    <i class="fas fa-star text-muted"></i>
                                    @endfor
                        </p>
                    </div>

                    <div class="testimonial-quote-right">
                        <i class="fas fa-quote-right fa-2x"></i>
                    </div>
                </div>
                @endforeach
            </div>
            @endif
        </div>
    </div>
</div>

    <!-- Testimonial End -->

    <!-- FAQs Start -->
    <div class="container-fluid faq-section py-3">
        <div class="container py-3 overflow-hidden">
            <div class="text-center mx-auto pb-5 wow rotateInDownLeft" style="max-width: 800px;">
                <h2 class="section-header">FAQs</h2>
                <h1 class="display-5 mb-4">Frequently Asked Questions</h1>
                <p class="mb-0">
                    Have questions about how UniAid works? Find answers to the most common queries about registration,
                    donations, receiving assistance, and volunteering. Whether you’re a donor, recipient, or volunteer,
                    our FAQs aim to guide you through every step of the process.
                </p>
            </div>
            <div class="row g-5 align-items-center flex-wrap-reverse">
                <div class="col-lg-6 wow fadeInLeft">
                    <div class="accordion accordion-flush bg-light rounded p-5" id="accordionFlushSection">
                        <div class="accordion-item rounded-top">
                            <h2 class="accordion-header" id="flush-headingOne">
                                <button class="accordion-button collapsed rounded-top" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false"
                                    aria-controls="flush-collapseOne">
                                    How to Donate using UniAid?
                            </h2>
                            <div id="flush-collapseOne" class="accordion-collapse collapse"
                                aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushSection">
                                <div class="accordion-body"> 1) <b>Quick Donation Option</b>
                                    - Donors can make quick donations without needing to browse or select specific recipients <br>
                                    2) <b>Donee Selection. </b>
                                    - Donors can browse through requests and select which resources to donate based on donee needs displayed on the platform. <br>
                                    <a href="{{ route ('more_donor')}}">Learn More.</a>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#flush-collapseThree" aria-expanded="false"
                                    aria-controls="flush-collapseThree">
                                    How to register as volunteer?
                                </button>
                            </h2>
                            <div id="flush-collapseThree" class="accordion-collapse collapse"
                                aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushSection">
                                <div class="accordion-body">
                                    Volunteers need to register first and then view admin request for help.
                                    <a href="{{ route ('more_volunteer')}}">Learn More.</a>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingFour">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#flush-collapseFour" aria-expanded="false"
                                    aria-controls="flush-collapseFour">
                                    What kind of donations UniAid accepts?
                                </button>
                            </h2>
                            <div id="flush-collapseFour" class="accordion-collapse collapse"
                                aria-labelledby="flush-headingFour" data-bs-parent="#accordionFlushSection">
                                <div class="accordion-body"> The UniAid accepts in-kind donations such as canned goods, bottled water, medecines, clothes, and other non-perishable Items.
                                    We also accept monetary doantions.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingFive">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#flush-collapseFive" aria-expanded="false"
                                    aria-controls="flush-collapseFive">
                                    Can I donate anonymously?
                                </button>
                            </h2>
                            <div id="flush-collapseFive" class="accordion-collapse collapse"
                                aria-labelledby="flush-headingFive" data-bs-parent="#accordionFlushSection">
                                <div class="accordion-body">Yes, you can choose to make your donation anonymously.
                                    Simply select the "Anonymous" option during the donation process.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item rounded-bottom">
                            <h2 class="accordion-header" id="flush-headingSix">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#flush-collapseSix" aria-expanded="false"
                                    aria-controls="flush-collapseSix">
                                    How are donees selected?
                                </button>
                            </h2>
                            <div id="flush-collapseSix" class="accordion-collapse collapse"
                                aria-labelledby="flush-headingSix" data-bs-parent="#accordionFlushSection">
                                <div class="accordion-body">Donees are selected based on specific criteria that assess their needs and
                                    eligibility. We work with local organizations, community leaders,
                                    and other partners to identify those who would benefit the most from our support.</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 wow fadeInRight" data-wow-delay="0.2s">
                    <img src="{{asset('assets/img/faq.gif') }}" class="img-fluid w-75 d-block mx-auto" alt="">
                </div>
            </div>
        </div>
    </div>
    <!-- FAQs End -->

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


    <!-- JavaScript Libraries -->
    <script src="{{ asset('lib/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('lib/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('lib/animate/wow.min.js') }}"></script>
    <script src="{{ asset('lib/jquery/easing.min.js') }}"></script>
    <script src="{{ asset('lib/jquery/counterup.min.js') }}"></script>
    <script src="{{ asset('lib/owlcarousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('lib/fontawesome/all.js') }}"></script>
    <!-- Template JavaScript -->
    <script src="{{ asset('lib/jquery/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('assets/homepage/js/main.js') }}"></script>

</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Read News</title>
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
              <a href="{{ route('home') }}#news" class="dropdown-item">News</a>
            </div>
          </div>
          <a href="{{ route ('contact')}}" class="nav-item nav-link">Contact Us</a>
          <a href="{{ route ('register')}}" class="nav-item nav-link">Register</a>
          <a href="#mobile" id="installAppLink" class="nav-item nav-link">
            Install App <i class="fa-solid fa-mobile-screen-button"></i>
          </a>
        </div>
        <a href="{{ route('home') }}#portals" class="btn btn-primary rounded-pill py-2 px-4 my-3 my-lg-0 flex-shrink-0">Portals</a>
      </div>
    </nav>

    <!-- Header Start -->
    <div class="container-fluid bg-breadcrumb py-5  mb-5">
      <div class="container text-center py-5">
        <div class="row g-5 align-items-center">
          <div class="col-lg-6">
            <h4 class="text-white display-4 mb-4 wow fadeInDown" data-wow-delay="0.3s">News Details</h4>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb d-flex justify-content-center mb-0 wow fadeInDown"
                data-wow-delay="0.3s">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">News</li>
              </ol>
            </nav>
          </div>
          <div class="col-lg-6 zoomIn wow" data-wow-delay="0.3s">
            <div class="row g-3">
              <div class="col-6">
                <img class="p-2 w-100 h-100 img-fluid" src="{{ asset ('assets/img/ab3.jpg') }}" alt=""
                  style="background:#ff1f1f;">
              </div>
              <div class="col-6">
                <img class="p-2 w-100 h-100 img-fluid" src="{{ asset ('assets/img/ab6.jpg') }}" alt=""
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

  <!-- ======= Blog Details Section ======= -->
  <section id="blog" class="blog mb-3">
    <div class="container">

      <div class="row g-5">

        <div class="col-lg-8">
          <article class="blog-details zoomIn wow">
            <div class="post-img">
              <!-- Displaying the image -->
              <img src="{{ asset('storage/' . $news->image_url_1) }}" alt="" class="img-fluid">
            </div>

            <h2 class="title">{{ $news->title }}</h2>

            <div class="meta-top mt-2">
              <ul class="d-flex justify-content-center">
                <!-- Displaying the admin's username -->
                <li class="d-flex align-items-center mx-1"><i class="far fa-user me-1"></i>{{ $news->admin->username }}</li>
                <!-- Displaying the creation date -->
                <li class="d-flex align-items-center mx-1"><i class="far fa-calendar me-1"></i>{{ $news->created_at->format('F j, Y') }}</li>
              </ul>
            </div>
            <div class="content-news">
              <blockquote>
                <p>{{ $news->subtitle }}</p>
              </blockquote>
              <p>{{ $news->content }}</p>
              <div class="d-flex justify-content-center">
                <img src="{{ asset('storage/' . $news->image_url_2) }}" class="img-fluid" alt="">
              </div>
            </div>
          </article>
        </div>

        <div class="col-lg-4">

          <div class="sidebar">

            <div class="sidebar-item recent-posts">
              <h3 class="sidebar-title">Other News</h3>

              <div class="mt-3">
                @if($otherNews->isEmpty())
                <p>No other news available at the moment.</p>
                @else
                @foreach($otherNews as $item)
                <div class="post-item mt-3">
                  <img src="{{ asset('storage/' . $item->image_url_2) }}" alt="">
                  <div>
                    <h4><a href="{{ route('more-news', ['id' => $item->id]) }}">{{ $item->title }}</a></h4>
                    <time datetime="{{ $item->created_at->format('Y-m-d') }}">{{ $item->created_at->format('F j, Y') }}</time>
                  </div>
                </div>
                @endforeach
                @endif
              </div>
            </div>
          </div>

        </div>
      </div>

    </div>
  </section><!-- End Blog Details Section -->


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
            <a href="{{ route('home') }}#portals"><i class="fas fa-angle-right me-2"></i> Portal</a>
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
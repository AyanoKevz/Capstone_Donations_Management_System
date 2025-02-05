<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>UniAid - Volunteer Portal</title>
    <link rel="icon" href="{{ asset ('assets/img/systemLogo.png') }}" type="image/png">
    <!-- Google Font-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Roboto:wght@400;500;700;900&display=swap"
        rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('lib/bootstrap/css/bootstrap.min.css') }}">
    <!-- OWL -->
    <link href="{{ asset('lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('assets/users/css/donor/testimonial.css') }}">
</head>

<!-- Spinner Start -->
<div id="spinner" class="show bg-white position-fixed w-100 vh-100 d-flex flex-column align-items-center justify-content-center">
    <div class="text-center mb-4">
        <h1 class="m-0 fw-bold" style="color: #ff1f1f; font-size:50px;">
            <img src="{{ asset('assets/img/systemLogo.png') }}" class="me-3 w-25" alt="Logo">UniAid
        </h1>
    </div>

    <div class="cssload-main">
        <div class="cssload-heart">
            <span class="cssload-heartL"></span>
            <span class="cssload-heartR"></span>
            <span class="cssload-square"></span>
        </div>
        <div class="cssload-shadow"></div>
    </div>
    <div class="loading-text mt-4">
        <p class="text-center fw-bold" style="color: #ff1f1f; font-size: 20px; margin: 0; position: absolute; bottom: 160px; left: 50%; transform: translateX(-50%); ">
            Loading....
        </p>
    </div>
</div>
<!-- Spinner End -->

<body class="hold-transition sidebar-collapse layout-top-nav">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand-lg bg-body-tertiary navbar-light navbar-white">
            <div class="container-fluid">
                <a href="#" class="navbar-brand">
                    <img src="{{ asset('assets/img/systemLogo.png') }}" alt="Logo" class="brand-image"
                        style="opacity: .8">
                    <span class="navbar-title">UniAid</span>
                </a>
                <button class="navbar-toggler order-1" type="button" class="nav-link" data-widget="pushmenu">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <ul class="navbar-nav ms-5">
                        <li class="nav-item">
                            <a class="nav-link" data-widget="pushmenu" href="#" role="button">
                                <i class="fas fa-bars fa-xl"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active rounded-pill" aria-current="page" href="{{route('volunteer.home')}}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " aria-current="page" href="{{route('prc-chapters')}}">Chapters</a>
                        </li>
                    </ul>
                </div>
                <form class="form-inline me-5">
                    <div class="input-group input-group-sm">
                        <input class="form-control form-control-navbar" type="search" placeholder="Search"
                            aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-navbar" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
                <div class="nav-item dropdown me-5 ms-2">
                    <a class="nav-link dropdown-toggle d-flex align-items-center p-2" id="navbarDropdown" href="#"
                        role="button" data-bs-toggle="dropdown" aria-expanded="false">

                        <div class="nav-profile-img">
                            <img src="{{ asset('storage/' . $User->volunteer->user_photo) }}" alt="image">
                            <span class="availability-status online"></span>
                        </div>
                        <div class="nav-profile-text">
                            <span>{{ $User->volunteer->first_name . ' ' . $User->volunteer->last_name }}</span>
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li>
                            <form action="{{ route('user.logout') }}" method="POST" id="logout-form">
                                @csrf
                                <button type="submit" class="dropdown-item d-flex justify-content-center align-items-center">
                                    Logout
                                    <i class="fas fa-right-from-bracket ms-2"></i>
                                </button>
                            </form>
                        </li>
                        <li>
                            <a class="dropdown-item d-flex justify-content-center align-items-center"
                                href="{{ route('volunteer.profile') }}">My profile
                                <i class="fas fa-user ms-2"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- /.navbar -->
        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="home.html" class="brand-link">
                <img src="{{ asset('assets/img/systemLogo.png') }}" alt="Logo" class="brand-image img-circle"
                    style="opacity: .8">
                <span class="brand-text">UniAid</span>
            </a>
            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user (optional) -->
                <div class="user-panel my-3 pb-3 d-flex flex-column align-items-center justify-content-center">
                    <img src="{{ asset('storage/' . $User->volunteer->user_photo) }}" class="img-circle elevation-2" alt="User Image">
                    <a href="{{route ('volunteer.profile') }}" class="d-block side-user mt-2" title="profile">{{ $User->username }}</a>
                    <p class="text-white m-0">Volunteer</p>
                </div>
                <!-- SidebarSearch Form -->
                <div class="form-inline">
                    <div class="input-group" data-widget="sidebar-search">
                        <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                            aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-sidebar">
                                <i class="fas fa-search fa-fw"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Home -->
                        <li class="nav-item">
                            <a href="{{ route('volunteer.home') }}" class="nav-link active">
                                <i class="nav-icon fas fa-house"></i>
                                <p>Home</p>
                            </a>
                        </li>

                        <!-- My Profile -->
                        <li class="nav-item">
                            <a href="{{ route('volunteer.profile') }}" class="nav-link">
                                <i class="nav-icon fas fa-user"></i>
                                <p>My Profile</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-hand-holding-heart"></i>
                                <p>
                                    blank
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>blank</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>blank</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <!-- Testimonials -->
                        <li class="nav-item">
                            <a href="{{route ('volunteer.testi_form') }}" class=" nav-link">
                                <i class="nav-icon fas fa-star"></i>
                                <p>Testimonials</p>
                            </a>
                        </li>

                        <!-- Feedback / Support -->
                        <li class="nav-item">
                            <a href="{{route ('volunteer.contact_form') }}" class="nav-link">
                                <i class="nav-icon fas fa-comments"></i>
                                <p>Contact / Support</p>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>


        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-6 d-flex align-items-center ms-3">
                            <img src="{{ asset('assets/img/volunteerbanner.png') }}" alt="" class="banner-img img-fluid mx-2">
                            <h1 class="m-0">
                                Volunteer Portal
                            </h1>
                        </div>
                        <div class="col-5 d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('volunteer.home') }}">Home</a>
                                </li>
                                <li class="breadcrumb-item active">Testimonials</li>
                            </ol>
                        </div>
                    </div>
                </div>
                @if(session('error'))
                <div id="alert-error" class="alert alert-error" style=" position: absolute; ; right: 10px; top: 90px;">
                    <i class=" fa-solid fa-circle-xmark fa-xl me-3"></i>{{ session('error') }}
                </div>
                @endif
                @if(session('success'))
                <div id="alert-success" class="alert alert-success" style=" position: absolute; ; right: 10px; top: 90px;">
                    <i class="fa-solid fa-circle-check fa-xl me-3"></i>{{ session('success') }}
                </div>
                @endif
            </div>

            <!-- End content-header -->

            <!-- Main content -->
            <div class="content">
                <div class="container py-3">

                    <div class="row flex-wrap-reverse  align-items-center">

                        <div class="col-md-5 d-flex flex-column justify-content-center align-items-center my-2">
                            <h1 class="mb-3">Other Testimonials</h1>
                            @if($testimonials->isEmpty())
                            <div class="text-center">
                                <p class="h4 text-danger">No testimonials available at the moment. Please check back later!</p>
                            </div>
                            @else
                            <div class="owl-carousel other-testi-carousel ">
                                @foreach($testimonials as $testimonial)
                                <div class="other-testi">
                                    <div class="header">
                                        <div class="image">
                                            <img src="{{ $testimonial->user->donor ? asset('storage/' . $testimonial->user->donor->user_photo) : asset('storage/' . $testimonial->user->volunteer->user_photo) }}" alt="User Image">
                                        </div>
                                        <div class="d-flex flex-column align-items-center">
                                            <h4 class="name">{{ $testimonial->user->username ?? 'Anonymous' }}</h4>
                                            <p class="text-muted fw-medium m-0">{{ ucfirst($testimonial->user_type) }}</p>
                                        </div>
                                    </div>

                                    <p class="message">
                                        {{ $testimonial->content }}
                                    </p>

                                    <!-- Rating Text -->
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
                                    <div class="d-flex justify-content-end">
                                        <p class="m-0 fw-bold">
                                            @for($i = 1; $i <= $testimonial->rating; $i++)
                                                <i class="fas fa-star text-warning"></i>
                                                @endfor
                                                @for($i = $testimonial->rating + 1; $i <= 5; $i++)
                                                    <i class="fas fa-star text-muted"></i>
                                                    @endfor
                                        </p>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            @endif
                        </div>

                        <div class="col-md-7 my-2">

                            @if ($userTestimonial)
                            <div class="d-flex justify-content-end me-2 mb-1">
                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $userTestimonial->id }}" title="Delete">
                                    Delete
                                </button>
                            </div>
                            <!-- Delete Modal -->
                            <div class="modal fade" id="deleteModal{{ $userTestimonial->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                    <div class="modal-content">
                                        <form action="{{ route('testimonial.delete', $userTestimonial->id) }}" method="POST">
                                            @csrf
                                            <div class="modal-header">
                                                <h5 class="modal-title">Delete Testimonial</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body text-center">
                                                Are you sure you want to delete this testimonial?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @endif
                            <div class="card shadow">
                                <div class="card-header">
                                    <h4 class="card-title text-white my-1" id="exampleModalLabel">Testimonial</h4>
                                </div>
                                <div class="card-body">
                                    <div class="text-center">
                                        <i class="far fa-comments fa-3x mb-1" style="color: #1b2a5f;"></i>
                                        <p>
                                            <strong>Your Story Experience Matters</strong>
                                        </p>
                                        <p>
                                            Share your experience to encourage the community.
                                            <strong>We value your thoughts!</strong>
                                        </p>
                                    </div>
                                    <hr />
                                    <form class="px-4"
                                        action="{{ $userTestimonial ? route('testimonials.update', $userTestimonial->id) : route('testimonials.store') }}"
                                        method="POST">
                                        @csrf
                                        @if ($userTestimonial)
                                        @method('PUT')
                                        @endif

                                        <p class="text-center"><strong>Your rating:</strong></p>
                                        <div class="d-flex align-items-center justify-content-center mb-2 flex-wrap">
                                            @for ($i = 1; $i <= 5; $i++)
                                                <div class="form-check form-check-inline">
                                                <input class="form-check-input"
                                                    type="radio"
                                                    name="rating"
                                                    id="radioRating{{ $i }}"
                                                    value="{{ $i }}"
                                                    {{ isset($userTestimonial) && $userTestimonial->rating == $i ? 'checked' : '' }}
                                                    required />
                                                <label class="form-check-label" for="radioRating{{ $i }}">
                                                    @if ($i == 1)
                                                    <i class="fas fa-angry text-dark"></i> Very bad
                                                    @elseif ($i == 2)
                                                    <i class="fas fa-frown text-danger"></i> Bad
                                                    @elseif ($i == 3)
                                                    <i class="fas fa-meh text-warning"></i> Mediocre
                                                    @elseif ($i == 4)
                                                    <i class="fas fa-smile-beam text-primary"></i> Good
                                                    @else
                                                    <i class="fas fa-smile text-success"></i> Very good
                                                    @endif
                                                </label>
                                        </div>
                                        @endfor
                                </div>

                                <p class="text-center"><strong>Your Message:</strong></p>
                                <div data-mdb-input-init class="form-outline mb-4">
                                    <textarea class="form-control"
                                        id="form4Example3"
                                        rows="4"
                                        name="content"
                                        required>{{ old('content', $userTestimonial->content ?? '') }}</textarea>
                                </div>

                                <div class="card-footer text-end">
                                    <button type="submit" class="btn primary_btn">
                                        {{ $userTestimonial ? 'Update' : 'Submit' }}
                                    </button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End content -->
            </div>

        </div>
        <!-- /.content wrapper -->

        <!-- Main Footer -->
        <footer class="main-footer">
            <strong>Copyright &copy; 2024 UniAid - Community Donations and Resource Distribution.</strong>
            All rights reserved.
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="{{ asset('lib/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 5 -->
    <script src="{{ asset('lib/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- Owl -->
    <script src="{{ asset('lib/owlcarousel/owl.carousel.min.js') }}"></script>
    <!-- Fontawesome 6 -->
    <script src="{{ asset('lib/fontawesome/all.js') }}"></script>
    <!-- User JS -->
    <script src="{{ asset('assets/users/js/user.js') }}"></script>
</body>

</html>
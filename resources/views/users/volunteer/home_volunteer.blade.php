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
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('assets/users/css/volunteer/home_volunteer.css') }}">


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

                        <!-- Volunteer Activities -->
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-hand-holding-heart"></i>
                                <p>
                                    Volunteer Tasks
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('volunteer.available_task') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Available Tasks</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('volunteer.assigned_task') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Assigned Task</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <!-- Volunteer History -->
                        <li class="nav-item">
                            <a href="{{ route('volunteer.completed_tasks') }}" class="nav-link">
                                <i class="nav-icon fas fa-pen-to-square"></i>
                                <p>Volunteer History</p>
                            </a>
                        </li>

                        <!-- Testimonials -->
                        <li class="nav-item">
                            <a href="{{ route('volunteer.testi_form') }}" class="nav-link">
                                <i class="nav-icon fas fa-star"></i>
                                <p>Testimonials</p>
                            </a>
                        </li>

                        <!-- Contact / Support -->
                        <li class="nav-item">
                            <a href="{{ route('volunteer.contact_form') }}" class="nav-link">
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
                    </div>
                </div>
                @if(session('error'))
                <div id="alert-error" class="alert alert-error" style=" position: absolute; ; right: 10px; top: 90px;">
                    <i class=" fa-solid fa-circle-xmark fa-xl me-3"></i>{{ session('error') }}
                </div>
                @endif
            </div>

            <!-- End content-header -->

            <!-- Main content -->
            <div class="content p-3">
                <div class="container-fluid">
                    <!-- Cards Section -->
                    <div class="row">
                        <div class="col-md-4 col-sm-6 col-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-info"><i class="fa-solid fa-list-check" style="color: #ffffff;"></i></span>
                                <div class="info-box-content">
                                    <h5 class="info-box-text">Assigned Task</h5>
                                    <span class="info-box-number">{{ $assignedTasks }}</span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                        <!-- /.col -->
                        <div class="col-md-4 col-sm-6 col-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-success"><i class="fa-solid fa-calendar" style="color: #ffffff;"></i></span>
                                <div class="info-box-content">
                                    <h5 class="info-box-text">Pending Task</h5>
                                    <span class="info-box-number">{{ $PendingTask }}</span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                        <!-- /.col -->
                        <div class="col-md-4 col-sm-6 col-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-warning"><i class="fa-solid fa-clock" style="color: #ffffff;"></i></span>
                                <div class="info-box-content">
                                    <h5 class="info-box-text">Total Hours</h5>
                                    <span class="info-box-number">{{ $totalHoursWorked }}</span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                        <!-- /.col -->
                    </div>

                    <!-- Calendar Section -->
                    <div class="row">
                        <h1 class="fw-bolder my-3">Your Calendar Activity</h1>
                        <div class="col-md-12">
                            <div id="calendar"></div>
                        </div>
                    </div>
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
        <!-- Fontawesome 6 -->
        <script src="{{ asset('lib/fontawesome/all.js') }}"></script>
        <!-- Full Calendar -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/6.1.15/index.global.js"></script>
        <script>
            window.calendarEvents = @json($calendarEvents ?? []);
            // Convert the JSON string back to an object if it's already encoded
            if (typeof window.calendarEvents === 'string') {
                window.calendarEvents = JSON.parse(window.calendarEvents);
            }
        </script>

        <!-- User JS -->
        <script src=" {{ asset('assets/users/js/user.js') }}"></script>
</body>

</html>
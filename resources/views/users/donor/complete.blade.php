<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>UniAid - Donor Portal</title>
    <link rel="icon" href="{{ asset ('assets/img/systemLogo.png') }}" type="image/png">
    <!-- Google Font-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Roboto:wght@400;500;700;900&display=swap"
        rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('lib/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('lib/datatables/datatables.min.css') }}">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('assets/users/css/donor/donation_status.css') }}">
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
                            <a class="nav-link rounded-pill" aria-current="page" href="{{route('donor.home')}}">Home</a>
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
                            <img src="{{ asset('storage/' . $User->donor->user_photo) }}" alt="image">
                            <span class="availability-status online"></span>
                        </div>
                        <div class="nav-profile-text">
                            <span>{{ $User->donor->first_name . ' ' . $User->donor->last_name }}</span>
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
                                href="{{ route('donor.profile') }}">My profile
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
                    <img src="{{ asset('storage/' . $User->donor->user_photo) }}" class="img-circle elevation-2" alt="User Image">
                    <a href="{{route ('donor.profile') }}" class="d-block side-user mt-2" title="profile">{{ $User->username }}</a>
                    <p class="text-white m-0">Donor</p>
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
                            <a href="{{route ('donor.home') }}" class="nav-link">
                                <i class="nav-icon fas fa-house"></i>
                                <p>Home</p>
                            </a>
                        </li>

                        <!-- My Profile -->
                        <li class="nav-item">
                            <a href="{{route ('donor.profile') }}" class="nav-link">
                                <i class="nav-icon fas fa-user"></i>
                                <p>My Profile</p>
                            </a>
                        </li>

                        <!-- Make a Donation -->
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-hand-holding-heart"></i>
                                <p>
                                    Make a Donation
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route ('donor.quick_donation') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Quick Donation</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route ('donor.request_map') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>In-Kind Request</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route ('donor.reqCash_map') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Fund Request</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <!-- Track Donations -->
                        <li class="nav-item">
                            <a href="#" class="nav-link active">
                                <i class="nav-icon fas fa-chart-line"></i>
                                <p>
                                    Track Donations
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route ('donor.donationStatus') }}" class="nav-link ">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Active Donations</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route ('donor.completeDonations') }}" class="nav-link active">
                                        <i class="fas fa-circle-arrow-right nav-icon"></i>
                                        <p>Completed Donations</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <!-- Chapters -->
                        <li class="nav-item">
                            <a href="{{route('prc-chapters')}}" class="nav-link">
                                <i class="nav-icon fas fa-map-marked-alt"></i>
                                <p>PRC Chapters</p>
                            </a>
                        </li>

                        <!-- Learn About Causes -->
                        <li class="nav-item">
                            <a href="{{route ('donor.causes') }}" class="nav-link">
                                <i class="nav-icon fas fa-info-circle"></i>
                                <p>Learn About Causes</p>
                            </a>
                        </li>

                        <!-- Testimonials -->
                        <li class="nav-item">
                            <a href="{{route ('donor.testi_form') }}" class="nav-link">
                                <i class="nav-icon fas fa-star"></i>
                                <p>Testimonials</p>
                            </a>
                        </li>

                        <!-- Feedback / Support -->
                        <li class="nav-item">
                            <a href="{{route ('donor.contact_form') }}" class="nav-link">
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
                            <img src="{{ asset('assets/img/donorbanner.png') }}" alt="" class="banner-img img-fluid mx-2">
                            <h1 class="m-0">
                                Donor Portal
                            </h1>
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
                <div class="container-fluid py-3">
                    <div class="row">
                        <div class="d-flex justify-content-between flex-wrap">
                            <div class="d-flex mb-1 align-items-center">
                                <strong class="me-2">Type:</strong>
                                <!-- Filter for Donation Type -->
                                <a href="{{ route('donor.completeDonations', ['donation_type' => 'all'] + request()->query()) }}"
                                    class="btn table-btn btn-sm {{ !request()->has('donation_type') || request('donation_type') === 'all' ? 'custom-active' : '' }}">
                                    All
                                </a>
                                <a href="{{ route('donor.completeDonations', ['donation_type' => 'in-kind'] + request()->query()) }}"
                                    class="btn table-btn btn-sm {{ request('donation_type') === 'in-kind' ? 'custom-active' : '' }}">
                                    In-Kind
                                </a>
                                <a href="{{ route('donor.completeDonations', ['donation_type' => 'cash'] + request()->query()) }}"
                                    class="btn table-btn btn-sm {{ request('donation_type') === 'cash' ? 'custom-active' : '' }}">
                                    Cash
                                </a>
                            </div>

                            <div class="d-flex align-items-center mb-1">
                                <strong class="me-2">Source:</strong>
                                <!-- Filter if they donate to request or quick -->
                                <a href="{{ route('donor.completeDonations', ['type' => 'all'] + request()->query()) }}"
                                    class="btn table-btn btn-sm {{ !request()->has('type') || request('type') === 'all' ? 'custom-active' : '' }}">
                                    All
                                </a>
                                <a href="{{ route('donor.completeDonations', ['type' => 'request'] + request()->query()) }}"
                                    class="btn table-btn btn-sm {{ request('type') === 'request' ? 'custom-active' : '' }}">
                                    From Request
                                </a>
                                <a href="{{ route('donor.completeDonations', ['type' => 'quick'] + request()->query()) }}"
                                    class="btn table-btn btn-sm {{ request('type') === 'quick' ? 'custom-active' : '' }}">
                                    From Quick
                                </a>
                            </div>

                            <div class="d-flex align-items-center mb-1">
                                <strong class="me-2">Status:</strong>
                                <!-- Filter for Status -->
                                <a href="{{ route('donor.completeDonations', ['status' => 'all'] + request()->query()) }}"
                                    class="btn table-btn btn-sm {{ !request()->has('status') || request('status') === 'all' ? 'custom-active' : '' }}">
                                    All
                                </a>
                                <a href="{{ route('donor.completeDonations', ['status' => 'received'] + request()->query()) }}"
                                    class="btn table-btn btn-sm {{ request('status') === 'received' ? 'custom-active' : '' }}">
                                    Received
                                </a>
                                <a href="{{ route('donor.completeDonations', ['status' => 'distributed'] + request()->query()) }}"
                                    class="btn table-btn btn-sm {{ request('status') === 'distributed' ? 'custom-active' : '' }}">
                                    Distributed
                                </a>
                                <a href="{{ route('donor.completeDonations', ['status' => 'unverified'] + request()->query()) }}"
                                    class="btn table-btn btn-sm {{ request('status') === 'unverified' ? 'custom-active' : '' }}">
                                    Unverified
                                </a>
                            </div>
                        </div>

                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <h3 class="card-title">Donation History</h3>
                                <div class="card-tools">
                                    <span class="text-sm text-muted">Showing all completed/inactive donations</span>
                                </div>
                            </div>
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th>Cause</th>
                                            <th>Method</th>
                                            <th>Chapter</th>
                                            <th>Type</th>
                                            <th>Status</th>
                                            <th>Source</th>
                                            <th>Transaction No.</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach($donations as $donation)
                                        <tr>
                                            <td>{{ $donation->cause }}</td>
                                            <td>
                                                {{ ucfirst($donation->donation_method) }}
                                            </td>
                                            <td>{{ $donation->chapter->chapter_name ?? 'N/A' }}</td>
                                            <td>
                                                <span class="badge bg-{{ isset($donation->transaction_id) || ($donation->donation_type ?? '') === 'cash' ? 'success' : 'warning text-dark' }}">
                                                    {{ isset($donation->transaction_id) || ($donation->donation_type ?? '') === 'cash' ? 'Cash' : 'In-Kind' }}
                                                </span>
                                            </td>
                                            <td>
                                                <span class="badge bg-{{ $donation->status === 'received' ? 'success' : ($donation->status === 'distributed' ? 'info text-dark' : 'warning text-dark') }}">
                                                    {{ ucfirst($donation->status) }}
                                                </span>
                                            </td>
                                            <td>
                                                <span class="badge bg-{{ $donation->source === 'From Request' ? 'info text-dark' : 'warning text-dark' }}">
                                                    {{ $donation->source }}
                                                </span>
                                            </td>
                                            <td>{{ $donation->transaction_id ?? $donation->tracking_number ?? 'N/A' }}</td>
                                            <td>
                                                <a href="{{ isset($donation->transaction_id) || ($donation->donation_type ?? '') === 'cash' ? route('donor.cash.donation.details', $donation->id) : route('donor.inkind.donation.details', $donation->id) }}"
                                                    class="btn btn-sm btn-success">
                                                    <i class="fa-solid fa-eye"></i> View
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
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
    <script src="{{ asset('lib/datatables/datatables.min.js') }}"></script>
    <!-- User JS -->
    <script src="{{ asset('assets/users/js/user.js') }}"></script>

</body>

</html>
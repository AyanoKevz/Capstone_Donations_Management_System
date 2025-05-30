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
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('assets/users/css/donor/donation_details.css') }}">
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
                                    <a href="{{route ('donor.donationStatus') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Active Donations</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route ('donor.completeDonations') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
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
                            <a href="{{route ('donor.contact_form') }}" class="nav-link ">
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
                    <div class="card custom-card shadow-lg rounded">
                        <div class="card-header custom-header text-white">
                            <h3 class="mb-0"><i class="far fa-clone pr-1"></i> In-Kind Donation Details</h3>
                        </div>
                        <div class="card-body">
                            <!-- Donation Details Table -->
                            <table class="table custom-table table-hover">
                                <tr>
                                    <th width="30%" class="bg-light-custom">Donor Name</th>
                                    <td width="2%">:</td>
                                    <td>{{ $inKindDonation->donor_name }}</td>
                                </tr>
                                <tr>
                                    <th width="30%" class="bg-light-custom">Contact Number</th>
                                    <td width="2%">:</td>
                                    <td>{{ $inKindDonation->donor->contact}}</td>
                                </tr>
                                <tr>
                                    <th class="bg-light-custom">Donation Method</th>
                                    <td>:</td>
                                    <td>{{ ucfirst($inKindDonation->donation_method) }}</td>
                                </tr>
                                @if(strtolower($inKindDonation->donation_method) === 'pickup')
                                <tr>
                                    <th class="bg-light-custom">Pickup Address</th>
                                    <td>:</td>
                                    <td>{{ $inKindDonation->pickup_address }}</td>
                                </tr>
                                @endif
                                <tr>
                                    <th class="bg-light-custom">Donation Date & Time</th>
                                    <td>:</td>
                                    <td>{{ \Carbon\Carbon::parse($inKindDonation->donation_datetime)->format('F d, Y \a\t g:i A') }}</td>
                                </tr>
                                <tr>
                                    <th class="bg-light-custom">Status</th>
                                    <td>:</td>
                                    <td>
                                        <span class="badge bg-{{ 
                        strtolower($inKindDonation->status) == 'pending' ? 'secondary' :
                        (strtolower($inKindDonation->status) == 'received' ? 'success' :
                        (strtolower($inKindDonation->status) == 'ongoing' ? 'warning text-dark' : 'success')) }}">
                                            {{ ucfirst($inKindDonation->status) }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="bg-light-custom">Tracking Number</th>
                                    <td>:</td>
                                    <td>{{ $inKindDonation->tracking_number }}</td>
                                </tr>
                            </table>

                            <!-- Donated Items Table -->
                            <div class="mt-4">
                                <div class="card-header custom-subheader text-white">
                                    <h3 class="mb-0"><i class="fa-solid fa-boxes-stacked"></i> Donated Items</h3>
                                </div>
                                <table class="table table-striped table-bordered text-center custom-items-table">
                                    <thead>
                                        <tr>
                                            <th>Category</th>
                                            <th>Item</th>
                                            <th>Quantity</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($inKindDonation->donationItems as $item)
                                        <tr>
                                            <td>{{ ucfirst($item->category) }}</td>
                                            <td>{{ ucfirst($item->item) }}</td>
                                            <td><strong>{{ $item->quantity }}</strong></td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <!-- Proof Image Section -->
                            <div class="mt-4 text-center">
                                <div class="card-header custom-image-header text-white">
                                    <h3 class="mb-0"><i class="fa-solid fa-images"></i> Proof of Donation</h3>
                                </div>
                                <div class="p-3 donation-proof-container">
                                    <img src="{{ asset('storage/' . $inKindDonation->proof_image) }}"
                                        alt="Proof Image"
                                        class="img-fluid donation-proof-image">
                                </div>
                            </div>
                            @if($inKindDonation->donation_method === 'pickup')
                            <div class="mt-4">
                                <div class="card-header custom-subheader text-white">
                                    <h3 class="mb-0"><i class="fa-solid fa-boxes-stacked"></i> Pickup Details</h3>
                                </div>

                                @php
                                $volunteer = $volunteerStatus['accepted'] ?? $volunteerStatus['completed'] ?? $volunteerStatus['ongoing'];
                                @endphp

                                @if($volunteer)
                                <table class="table table-striped table-bordered text-center custom-items-table">
                                    <thead>
                                        <tr>
                                            <th>Image</th>
                                            <th>Volunteer Name</th>
                                            <th>Contact No.</th>
                                            <th>Pickup Schedule</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <img src="{{ $volunteer->volunteer->user_photo ? asset('storage/'.$volunteer->volunteer->user_photo) : asset('images/default-avatar.jpg') }}"
                                                    alt="Volunteer Photo"
                                                    class="rounded-circle"
                                                    width="80"
                                                    height="80">
                                            </td>
                                            <td class="align-middle">
                                                {{ $volunteer->volunteer->first_name }}
                                                {{ $volunteer->volunteer->last_name }}
                                            </td>
                                            <td class="align-middle">
                                                {{ $volunteer->volunteer->contact }}
                                            </td>
                                            <td class="align-middle">
                                                {{ \Carbon\Carbon::parse($volunteer->activity_date)->format('M d, Y h:i A') }}
                                            </td>
                                            <td class="align-middle">
                                                <span class="badge 
        {{ $volunteer->status == 'accepted' || $volunteer->status == 'completed' ? 'bg-success' : ($volunteer->status == 'ongoing' ? 'bg-secondary' : '') }}">
                                                    {{ ucfirst($volunteer->status) }}
                                                </span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                @elseif($volunteerStatus['pending'])
                                <!-- Pending volunteer content -->
                                <div class="p-3 text-center bg-warning bg-opacity-10">
                                    <i class="fas fa-user-clock text-warning me-2"></i>
                                    <span class="text-dark">
                                        <strong> Assigned Volunteer:</strong> {{ $volunteerStatus['pending']->volunteer->first_name }} {{ $volunteerStatus['pending']->volunteer->last_name }}
                                        <strong class="text-danger">(Waiting for confirmation)</strong>
                                    </span>
                                </div>
                                @else
                                <!-- No volunteer assigned yet -->
                                <div class="p-3 text-center bg-info bg-opacity-10">
                                    <i class="fas fa-info-circle text-info me-2"></i>
                                    <span class="text-dark">
                                        Your donation is verified. We're in the process of assigning a volunteer.
                                    </span>
                                </div>
                                @endif
                            </div>
                            @endif
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
    <!-- User JS -->
    <script src="{{ asset('assets/users/js/user.js') }}"></script>
</body>

</html>
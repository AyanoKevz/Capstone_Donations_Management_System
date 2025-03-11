<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>UniAid - Donor Portal | Chapters</title>
    <link rel="icon" href="{{ asset ('assets/img/systemLogo.png') }}" type="image/png">
    <!-- Google Font-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Roboto:wght@400;500;700;900&display=swap"
        rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('lib/bootstrap/css/bootstrap.min.css') }}">
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="{{ asset('lib/leaflet/leaflet.css') }}">
    </link>
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('assets/users/css/donor/request_map.css') }}">
    <script src="{{ asset('lib/face-api.js/dist/face-api.min.js') }}"></script>
</head>

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
                            <a class="nav-link " aria-current="page" href="{{route('donor.home')}}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link rounded-pill " aria-current="page" href="{{route('prc-chapters')}}">Chapters</a>
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
                <div class="user-panel my-3 pb-3 d-flex flex-column align-items-center justify-content-center">
                    <img src="{{ asset('storage/' . $User->donor->user_photo) }}" class="img-circle elevation-2" alt="User Image">
                    <a href="{{route ('donor.profile') }}" class="d-block side-user mt-2" title="profile">{{ $User->username }}</a>
                    <p class="text-white m-0 fs-6">Donor</p>
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
                                    <a href="#" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Donation Requests</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <!-- Geo Map -->
                        <li class="nav-item">
                            <a href="#" class="nav-link active">
                                <i class="nav-icon fas fa-map-marked-alt"></i>
                                <p>
                                    Geo-mapping
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route ('donor.request_map') }}" class="nav-link active">
                                        <i class="fas fa-circle-arrow-right nav-icon "></i>
                                        <p>Donation Request Map</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('prc-chapters') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>PRC Chapters</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <!-- Track Donations -->
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-chart-line"></i>
                                <p>
                                    Track Donations
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Donation Status</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Donation History</p>
                                    </a>
                                </li>
                            </ul>
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
                            <a href="{{route ('donor.testi_form') }}" class=" nav-link">
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
                        <div class="col-5 d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('donor.home') }}">Home</a>
                                </li>
                                <li class="breadcrumb-item">
                                    Geo-mapping
                                </li>
                                <li class="breadcrumb-item active">Donation Request Map</li>
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
                <div class="container py-2">
                    <div class="row">

                        <div class="col-12 col-md-6 mb-3 mb-md-0 p-3 bg-light-subtle">
                            <form id="filterForm" method="GET" action="{{ route('donor.reqCash_map') }}">
                                <div class="row mb-3 align-items-center">
                                    <div class="col-auto">
                                        <h5 class="mb-0">Sort: </h5>
                                    </div>
                                    <div class="col">
                                        <div class="row g-3 align-items-center">
                                            <!-- Cause Dropdown -->
                                            <div class="col-12 col-md-6">
                                                <div class="d-flex flex-column flex-md-row align-items-center gap-2">
                                                    <label for="cause" class="form-label mb-0">Cause</label>
                                                    <select class="form-select" id="cause" name="cause">
                                                        <option value="General" {{ request('cause') === 'General' ? 'selected' : '' }}>General</option>
                                                        <option value="Fire" {{ request('cause') === 'Fire' ? 'selected' : '' }}>Fire</option>
                                                        <option value="Flood" {{ request('cause') === 'Flood' ? 'selected' : '' }}>Flood</option>
                                                        <option value="Typhoon" {{ request('cause') === 'Typhoon' ? 'selected' : '' }}>Typhoon</option>
                                                        <option value="Earthquake" {{ request('cause') === 'Earthquake' ? 'selected' : '' }}>Earthquake</option>
                                                        <option value="Volcanic Eruption" {{ request('cause') === 'Volcanic Eruption' ? 'selected' : '' }}>Volcanic Eruption</option>
                                                        <option value="Feeding Program" {{ request('cause') === 'Feeding Program' ? 'selected' : '' }}>Feeding Program</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <!-- Urgency Dropdown -->
                                            <div class="col-12 col-md-6">
                                                <div class="d-flex flex-column flex-md-row align-items-center gap-2">
                                                    <label for="urgency" class="form-label mb-0">Urgency</label>
                                                    <select class="form-select" id="urgency" name="urgency">
                                                        <option value="General" {{ request('urgency') === 'General' ? 'selected' : '' }}>General</option>
                                                        <option value="Low" {{ request('urgency') === 'Low' ? 'selected' : '' }}>Low</option>
                                                        <option value="Moderate" {{ request('urgency') === 'Moderate' ? 'selected' : '' }}>Moderate</option>
                                                        <option value="Critical" {{ request('urgency') === 'Critical' ? 'selected' : '' }}>Critical</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <!-- Region Dropdown -->
                                            <div class="col-12 col-md-6">
                                                <div class="d-flex flex-column flex-md-row align-items-center gap-2">
                                                    <label for="region-filter" class="form-label mb-0">Region</label>
                                                    <select class="form-select" id="region-filter" name="region">
                                                        <option value="General" {{ request('region') === 'General' ? 'selected' : '' }}>General</option>
                                                        @foreach ($regions as $region)
                                                        <option value="{{ $region }}" {{ request('region') === $region ? 'selected' : '' }}>
                                                            {{ $region }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="d-flex flex-column flex-md-row align-items-center gap-2">
                                                    <label for="item-filter" class="form-label mb-0">Donation Type</label>
                                                    <select class="form-select" id="item-filter" name="type">
                                                        <option value="item">In-Kind</option>
                                                        <option value="cash" selected>Funds</option>
                                                    </select>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div id="map"></div>
                            </form>
                            <div class="col-12 col-md-12 mt-2">
                                <button class="donate-btn w-100" id="donateBtn" data-bs-toggle="modal" style="display: none;">
                                    <div class="svg-wrapper-1">
                                        <div class="svg-wrapper">
                                            <i class="fa-solid fa-hand-holding-heart fa-lg"></i>
                                        </div>
                                    </div>
                                    <span>Donate Now</span>
                                </button>
                            </div>
                        </div>

                        <div class="col-12 col-md-6 mt-3 mt-md-0 e p-3 bg-body-secondary" id="infoSidebar">
                            <div id="requestInfo">
                                <h2>Philippine Request Map</h2>
                                <p>The Philippine Request Map is an interactive map designed to visualize donation requests across different locations. Each pin provides key details like location, needs, and urgency, helping donors quickly find and support causes.</p>
                                <hr>
                                <h5 class="text-center text-muted">Click on icon shows in the map to view details</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.content wrapper -->

        @foreach($fundRequests as $request)
        @php
        $location = $request->location; // Directly fetch location from fund request

        if ($location) {
        $formattedLocation = $location->region === "NCR" ? "{$location->full_address} {$location->barangay}, {$location->city_municipality}, Metro Manila, Philippines"
        : "{$location->full_address} {$location->barangay}, {$location->city_municipality}, {$location->province}, {$location->region}, Philippines";
        }
        @endphp
        <div class="modal fade" id="donateNow-{{ $request->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="donate-card request">
                        <label class="title">Donate to Help Those in Need
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </label>
                        <div class="p-3">

                            {{-- Donation Form --}}
                            <form id="donationForm-{{ $request->id }}"
                                method="POST"
                                action="{{ route('dropoffMap.donation') }}"
                                class="cash-donation-form"
                                data-online="{{ route('paymongoMap.checkout') }}"
                                data-dropoff="{{ route('dropoffMap.donation') }}">
                                @csrf
                                <input type="hidden" name="fund_request_id" value="{{ $request->id }}">
                                <input type="hidden" name="payment_method" id="selected_payment_method_{{ $request->id }}">
                                <input type="hidden" name="request_location" value="{{$formattedLocation}}">

                                {{-- First Row: Cause | Donor Name --}}
                                <div class="row mb-3">
                                    <div class="col">
                                        <label for="cause" class="form-label fw-bold">Cause</label>
                                        <input type="text" class="form-control" id="cause" name="cause" value="{{ $request->cause }}" readonly>
                                    </div>
                                    @php
                                    $donorFullName = "{$User->donor->first_name} {$User->donor->last_name}";
                                    @endphp
                                    <div class="col">
                                        <label for="donor_name_{{ $request->id }}" class="form-label fw-bold">Your Name</label>
                                        <input type="text" class="form-control donor-name" id="donor_name_{{ $request->id }}"
                                            name="donor_name" value="{{ $donorFullName }}" data-original-name="{{ $donorFullName }}" required>
                                        <div class="form-check mt-2">
                                            <input class="form-check-input anonymous-checkbox" type="checkbox"
                                                id="anonymous_checkbox_{{ $request->id }}" name="anonymous_checkbox" value="1">
                                            <label class="form-check-label text-muted" for="anonymous_checkbox_{{ $request->id }}">
                                                Anonymous
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                {{-- Second Row: Chapter | Donation Method --}}
                                <div class="row mb-3">
                                    <div class="col">
                                        <label for="chapter" class="form-label fw-bold">Chapter</label>
                                        <input type="text" class="form-control" id="chapter_display"
                                            value="{{ $request->admin->chapter->chapter_name }}" readonly>
                                        <input type="hidden" name="chapter_id" value="{{ $request->admin->chapter->id }}">
                                    </div>

                                    <div class="col">
                                        <label for="donation_method_{{ $request->id }}" class="form-label fw-bold">Donation Method</label>
                                        <select class="form-select donation-method_cash" id="donation_method_{{ $request->id }}" name="donation_method" required>
                                            <option selected disabled>Select an option</option>
                                            <option value="online">Online</option>
                                            <option value="drop-off">Drop-off</option>
                                        </select>
                                    </div>
                                </div>

                                {{-- Third Row: Payment Method (Only for Online Donations) --}}
                                <div class="row mb-3 payment-method-row d-none" id="payment_method_row_{{ $request->id }}">
                                    <div class="col">
                                        <label for="payment_method_{{ $request->id }}" class="form-label fw-bold">Payment Method</label>
                                        {{-- Payment Method Logos --}}
                                        <div class="d-flex justify-content-center gap-3 mb-3">
                                            <img src="{{ asset('assets/img/credit-card.jpg') }}" alt="Credit Card" class="payment-logo">
                                            <img src="{{ asset('assets/img/gcashLogo.jpg') }}" alt="GCash" class="payment-logo">
                                            <img src="{{ asset('assets/img/paymayaLogo.png') }}" alt="PayMaya" class="payment-logo">
                                        </div>
                                        <select class="form-select" id="payment_method_{{ $request->id }}" name="payment_method">
                                            <option selected disabled>Select an option</option>
                                            <option value="credit_card">Credit/Debit Card</option>
                                            <option value="gcash">GCash</option>
                                            <option value="paymaya">PayMaya</option>
                                        </select>
                                    </div>
                                </div>

                                {{-- Fourth Row: Amount --}}
                                <div class="row mb-3">
                                    <div class="col d-flex flex-column">
                                        <label for="amount_{{ $request->id }}" class="form-label fw-bold">Donation Amount</label>
                                        <input type="number" class="form-control"
                                            id="amount_{{ $request->id }}"
                                            name="amount"
                                            max="{{ $request->remaining_amount}}"
                                            required>
                                        <small class="text-muted text-center">
                                            Max donation: ₱{{ number_format($request->remaining_amount, 2) }}
                                        </small>
                                    </div>
                                </div>

                                {{-- Submit Button --}}
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary mt-3">Proceed to Payment</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach


        <!-- Main Footer -->
        <footer class="main-footer">
            <strong>Copyright &copy; 2024 UniAid - Community Donations and Resource Distribution.</strong>
            All rights reserved.
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="https://js.paymongo.com/v1"></script>
    <script src="{{ asset('lib/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('lib/jquery/jquery.validate.min.js') }}"></script>
    <!-- Bootstrap 5 -->
    <script src="{{ asset('lib/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- Fontawesome 6 -->
    <script src="{{ asset('lib/fontawesome/all.js') }}"></script>
    <!-- User JS -->
    <script src="{{ asset('assets/users/js/user.js') }}"></script>
    <!-- Leaflet -->
    <script src="{{ asset('lib/leaflet/leaflet.js') }}"></script>
    <script>
        var donationRequests = []; // Empty array for in-kind donations
        var fundRequests = @json($fundRequests); // For cash donations
    </script>

    <!-- PH MAP JS -->

    <script src="{{ asset('assets/users/js/user-map.js') }}"></script>

</body>

</html>
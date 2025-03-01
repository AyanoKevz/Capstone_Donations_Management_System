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
                            <a class="dropdown-item d-flex justify-content-center align-items-center"
                                href="logout.php">Logout
                                <i class="fas fa-right-from-bracket ms-2"></i>
                            </a>
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
                            <form id="filterForm" method="GET" action="{{ route('donor.request_map') }}">
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
                                            <div class="col-12 col-md-12">
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


        @php
        $itemImages = [
        'Bottled Water' => 'r4.jpg',
        'Canned Goods' => 'r1.jpg',
        '5kg Packaged Rice' => 'r5.png',
        'Packed Biscuits' => 'r6.png',
        'Instant Noodles' => 'r3.png',
        'Blankets' => 'b1.png',
        'Towels' => 't1.png',
        'Jackets/Sweaters' => 'c1.png',
        'New Clothes' => 'r8.png',
        'Slippers' => 's1.png',
        'Soap' => 'q2.png',
        'Sachet Shampoo' => 'q3.png',
        'Toothpaste' => 'q4.png',
        'Toothbrushes' => 'q1.jpg',
        'Baby Diapers' => 'q5.png',
        'Hand Sanitizers' => 'q6.png',
        'Adhesive Tape' => 'w1.jpg',
        'Bandages and Gauze' => 'w2.png',
        'Alcohol/Disinfectants' => 'w3.png',
        'Masks (N95 or surgical)' => 'w4.png',
        ];
        @endphp

        @foreach($donationRequests as $request)
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
                            <form method="POST" action="{{ route('donation.store') }}" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="donation_request_id" value="{{ $request->id }}">
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
                                            <input class="form-check-input anonymous-checkbox" type="checkbox" id="anonymous_checkbox_{{ $request->id }}">
                                            <label class="form-check-label text-muted" for="anonymous_checkbox_{{ $request->id }}">
                                                Anonymous
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                {{-- Second Row: Donation Method | Donation Date & Time --}}
                                <div class="row mb-3">
                                    <div class="col">
                                        <label class="form-label fw-bold">Donation Method</label>
                                        <select class="form-select donation-method" id="donation_method_{{ $request->id }}" name="donation_method" required>
                                            <option selected disabled>Select an option</option>
                                            <option value="pickup">Pickup</option>
                                            <option value="drop-off">Drop-off</option>
                                        </select>
                                    </div>
                                    <div class="col">
                                        <label for="donation_datetime_{{ $request->id }}" class="form-label fw-bold">Donation Date & Time</label>
                                        <input type="datetime-local" class="form-control" id="donation_datetime_{{ $request->id }}" name="donation_datetime" required>
                                    </div>
                                </div>
                                @php
                                $pickupAddress = $User->location->region === "NCR"
                                ? "{$User->location->full_address}, {$User->location->barangay}, {$User->location->city_municipality}, Metro Manila, Philippines"
                                : "{$User->location->full_address}, {$User->location->barangay}, {$User->location->city_municipality}, {$User->location->province}, {$User->location->region}, Philippines";
                                @endphp
                                {{-- Third Row (If Pickup Selected): Pickup Address --}}
                                <div class="mb-3 pickup-address-div d-none" id="pickup_address_div_{{ $request->id }}">
                                    <label for="pickup_address_{{ $request->id }}" class="form-label fw-bold">Pickup Address</label>
                                    <input type="text" class="form-control pickup-address" id="pickup_address_{{ $request->id }}"
                                        name="pickup_address" value="{{ $pickupAddress }}">
                                </div>
                                {{-- Chapter Selection --}}
                                <div class="mb-3">
                                    <label for="chapter" class="form-label fw-bold">Select Chapter</label>
                                    <select class="form-select" id="chapter" name="chapter_id" required>
                                        <option selected disabled>Select Chapter</option>
                                        @foreach($chapters as $chapter)
                                        <option value="{{ $chapter->id }}">{{ $chapter->chapter_name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                {{-- Items Requested --}}
                                <div class="items my-3">
                                    @foreach($request->items as $item)
                                    @php
                                    $totalDonated = $request->donationItems()->where('item', $item->item)->sum('quantity');
                                    $remainingQuantity = $item->quantity - $totalDonated;
                                    @endphp

                                    @if($remainingQuantity > 0)
                                    <div class="item">
                                        <!-- Item Image -->
                                        <img src="{{ asset('assets/img/' . $itemImages[$item->item]) }}"
                                            alt="{{ $item->item }}"
                                            class="item-img bg-body-secondary p-2 rounded">

                                        <!-- Item Details -->
                                        <div class="item-details">
                                            <span class="fw-bold">{{ $item->item }}</span>
                                            <p class="text-muted mb-1">{{ $item->category }}</p>
                                            <p class="text-success mb-0">Donated: {{ $totalDonated }}/{{ $item->quantity }}</p>
                                        </div>

                                        <!-- Quantity Input -->
                                        <div class="quantity">
                                            <input type="number" class="form-control quantity-input"
                                                name="quantity[{{ $item->id }}]"
                                                min="1"
                                                max="{{ $remainingQuantity }}"
                                                value="1"
                                                placeholder="Quantity">
                                        </div>
                                    </div>
                                    @endif
                                    @endforeach
                                </div>
                                <!-- Photo Capture Section -->
                                <div id="photoCapture-{{ $request->id }}" class="row g-3 photo-capture">
                                    <h5><strong>Proof of Donation</strong> </h5>
                                    <p class="my-0">Take a photo with your donation for verification. The system will snap a picture once it detects your face.</p>
                                    <!-- Camera Column -->
                                    <div class="col-md-6 d-flex flex-column align-items-center">
                                        <div class="video-container">
                                            <video id="video-{{ $request->id }}" class="video-stream" autoplay muted></video>
                                            <canvas id="overlay-{{ $request->id }}" class="overlay"></canvas>
                                            <div id="timer-{{ $request->id }}" class="timer"></div>
                                        </div>
                                        <button class="btn btn-secondary btn-sm my-3 toggle-camera-btn" type="button" id="toggleCameraBtn-{{ $request->id }}">Turn On Camera</button>
                                    </div>

                                    <!-- Preview Column -->
                                    <div class="col-md-6 d-flex flex-column align-items-center">
                                        <div id="preview-{{ $request->id }}" class="preview-container">
                                            <img src="{{ asset('assets/img/donating.jpg') }}" class="preview-image" alt="Captured Photo">
                                        </div>
                                        <p class="my-3"><strong>Example</strong></p>
                                        <!-- File Input Section -->
                                        <div id="fileInputSection-{{ $request->id }}" style="display: none;">
                                            <input type="file" id="imageFile-{{ $request->id }}" name="proof_image" class="preview-file">
                                        </div>
                                    </div>
                                </div>

                                <!-- Submit Button -->
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary mt-3">Donate Now</button>
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
    <script src="{{ asset('lib/jquery/jquery.min.js') }}">
    </script>
    <!-- Bootstrap 5 -->
    <script src="{{ asset('lib/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- Fontawesome 6 -->
    <script src="{{ asset('lib/fontawesome/all.js') }}"></script>
    <!-- User JS -->
    <script src="{{ asset('assets/users/js/user.js') }}"></script>
    <!-- Leaflet -->
    <script src="{{ asset('lib/leaflet/leaflet.js') }}"></script>
    <script>
        var donationRequests = @json($donationRequests);
    </script>

    <!-- PH MAP JS -->
    <script src="{{ asset('assets/users/js/user-map.js') }}"></script>

</body>

</html>
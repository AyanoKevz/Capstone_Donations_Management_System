<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>UniAid - Donor Profile</title>
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
    <link rel="stylesheet" href="{{ asset('assets/users/css/donor/donor_profile.css') }}">
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
                            <a class="nav-link" aria-current="page" href="{{route('donor.home')}}">Home</a>
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
                            <a href="{{route ('donor.profile') }}" class="nav-link active">
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
                            <a href="#" class="nav-link">
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
                                <p>PRCRChapters</p>
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
                        <div class="col-5 d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('donor.home') }}">Home</a>
                                </li>
                                <li class="breadcrumb-item active">My Profile</li>
                            </ol>
                        </div>
                    </div>
                </div>
                @if(session('success'))
                <div id="alert-success" class="alert alert-success" style=" position: absolute; ; right: 10px; top: 90px;">
                    <i class="fa-solid fa-circle-check fa-xl me-3"></i>{{ session('success') }}
                </div>
                @endif
                @if($errors->any())
                <div id="alert-error" class="alert alert-error" style="position: absolute; right: 10px; top: 90px;">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li><i class="fa-solid fa-circle-xmark fa-xl"></i> {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                @if(session('info'))
                <div id="alert-info" class="alert alert-info" style=" position: absolute; ; right: 10px; top: 90px;">
                    {{ session('info') }}
                </div>
                @endif
            </div>

            <!-- End content-header -->

            <!-- Main content -->
            <div class="content">
                <div class="container">
                    <section class="bg-light py-3 py-md-5 py-xl-8">
                        <div class="container">
                            <div class="row gy-4 gy-lg-0">
                                <div class="col-12 col-lg-5 col-xl-4">
                                    <div class="row gy-4">
                                        <div class="col-12">
                                            <div class="card widget-card border-light shadow-sm">
                                                <div class="card-header">Welcome, {{ $User->donor->first_name . " " . $User->donor->last_name }} </div>
                                                <div class="card-body">
                                                    <div class="text-center mb-3">
                                                        <img src="{{ asset('storage/' . $User->donor->user_photo) }}" class="img-fluid rounded-circle w-50" alt="Luna John">
                                                    </div>
                                                    <h5 class="text-center mb-1">{{ $User->donor->first_name . " " . $User->donor->last_name }}</h5>
                                                    <p class="text-center text-secondary mb-4">Donor</p>
                                                    <ul class="list-group list-group-flush mb-4">
                                                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                                            <h6 class="m-0">Username:</h6>
                                                            <span> {{$User->username}}</span>
                                                        </li>
                                                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap ">
                                                            <h6 class="m-0">Email:</h6>
                                                            <span>{{$User->email}}</span>
                                                        </li>
                                                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                                            <h6 class="m-0">Account Type:</h6>
                                                            <span>{{$User->account_type}}</span>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-7 col-xl-8">
                                    <div class="card widget-card border-light shadow-sm">
                                        <div class="card-body p-4">
                                            <ul class="nav nav-tabs" id="profileTab" role="tablist">
                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link profile_tab active" id="overview-tab" data-bs-toggle="tab" data-bs-target="#overview-tab-pane" type="button" role="tab" aria-controls="overview-tab-pane" aria-selected="true">Overview</button>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link profile_tab" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">Profile</button>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link profile_tab" id="password-tab" data-bs-toggle="tab" data-bs-target="#password-tab-pane" type="button" role="tab" aria-controls="password-tab-pane" aria-selected="false">Account</button>
                                                </li>
                                            </ul>
                                            <div class="tab-content pt-4" id="profileTabContent">
                                                <div class="tab-pane fade show active" id="overview-tab-pane" role="tabpanel" aria-labelledby="overview-tab" tabindex="0">
                                                    <h5 class="mb-3">Profile</h5>
                                                    <div class="row g-0">

                                                        <div class="col-5 col-md-3 bg-light border-bottom border-white border-3">
                                                            @if($User->account_type === 'Individual')
                                                            <div class="p-2"><strong>Full Name</strong> </div>
                                                            @else
                                                            <div class="p-2"><strong>Organization Name</strong> </div>
                                                            @endif
                                                        </div>
                                                        <div class="col-7 col-md-9 bg-light border-start border-bottom border-white border-3">
                                                            <div class="p-2">{{$User->donor->first_name . " ". $User->donor->last_name}}</div>
                                                        </div>
                                                        <div class="col-5 col-md-3 bg-light border-bottom border-white border-3">
                                                            <div class="p-2"><strong>Contact</strong> </div>
                                                        </div>
                                                        <div class="col-7 col-md-9 bg-light border-start border-bottom border-white border-3">
                                                            <div class="p-2">{{$User->donor->contact}}</div>
                                                        </div>
                                                        @if($User->account_type === 'Individual')
                                                        <div class="col-5 col-md-3 bg-light border-bottom border-white border-3">
                                                            <div class="p-2"><strong>Gender</strong> </div>
                                                        </div>
                                                        <div class="col-7 col-md-9 bg-light border-start border-bottom border-white border-3">
                                                            <div class="p-2">{{$User->donor->gender}}</div>
                                                        </div>
                                                        @endif
                                                        <div class="col-5 col-md-3 bg-light border-bottom border-white border-3">
                                                            <div class="p-2"><strong>Region</strong> </div>
                                                        </div>
                                                        <div class="col-7 col-md-9 bg-light border-start border-bottom border-white border-3">
                                                            <div class="p-2">{{$User->location->region}}</div>
                                                        </div>
                                                        <div class="col-5 col-md-3 bg-light border-bottom border-white border-3">
                                                            <div class="p-2"><strong>Province</strong> </div>
                                                        </div>
                                                        <div class="col-7 col-md-9 bg-light border-start border-bottom border-white border-3">
                                                            <div class="p-2">{{$User->location->province}}</div>
                                                        </div>
                                                        <div class="col-5 col-md-3 bg-light border-bottom border-white border-3">
                                                            <div class="p-2"><strong>City/Municipality</strong> </div>
                                                        </div>
                                                        <div class="col-7 col-md-9 bg-light border-start border-bottom border-white border-3">
                                                            <div class="p-2">{{$User->location->city_municipality}}</div>
                                                        </div>
                                                        <div class="col-5 col-md-3 bg-light border-bottom border-white border-3">
                                                            <div class="p-2"><strong>Barangay</strong> </div>
                                                        </div>
                                                        <div class="col-7 col-md-9 bg-light border-start border-bottom border-white border-3">
                                                            <div class="p-2">{{$User->location->barangay}}</div>
                                                        </div>
                                                        <div class="col-5 col-md-3 bg-light border-bottom border-white border-3">
                                                            <div class="p-2"><strong>Full Address</strong> </div>
                                                        </div>
                                                        <div class="col-7 col-md-9 bg-light border-start border-bottom border-white border-3">
                                                            <div class="p-2">{{$User->location->full_address}}</div>
                                                        </div>
                                                        <div class="col-5 col-md-3 bg-light border-bottom border-white border-3">
                                                            <div class="p-2"><strong>ID Type:</strong> </div>
                                                        </div>
                                                        <div class="col-7 col-md-9 bg-light border-start border-bottom border-white border-3">
                                                            <div class="p-2">{{$User->donor->id_type}}</div>
                                                        </div>
                                                        <div class="bg-light text-center p-2">
                                                            @if($User->account_type === 'Individual')
                                                            <div class="p-2"><strong>ID Image:</strong> </div>
                                                            @else
                                                            <div class="p-2"><strong>Submitted Organization Document:</strong> </div>
                                                            @endif
                                                            <img src="{{ asset('storage/' . $User->donor->id_image) }}" alt="" class="img-fluid w-25 border border-dark-subtle">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
                                                    <form method="POST" action="{{ route('donor.updateProfile', $User->id) }}" class="row gy-3 gy-xxl-4" enctype="multipart/form-data" id="user_profile_form">
                                                        @csrf
                                                        <div class="col-12">
                                                            <div class="row gy-2 justify-content-around align-items-center">
                                                                <label class="col-12 form-label m-0 text-center"><strong> Profile Image </strong></label>

                                                                <div class="form">
                                                                    <span class="form-title">Upload your file</span>
                                                                    <p class="form-paragraph">File should be an image</p>
                                                                    <img id="imagePreview" src="{{ asset('storage/' . $User->donor->user_photo) }}" class="profile_preview" alt="Profile Image">
                                                                    <label for="file-input" class="drop-container">
                                                                        <input type="file" accept="image/*" id="file-input" name="user_photo">
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @if($User->account_type === 'Individual')
                                                        <div class="col-12 col-md-6">
                                                            <label for="inputFirstName" class="form-label">First Name</label>
                                                            <input type="text" class="form-control" id="fname" name="fname" value="{{ $User->donor->first_name }}">
                                                        </div>
                                                        <div class="col-12 col-md-6">
                                                            <label for="inputFirstName" class="form-label">Last Name</label>
                                                            <input type="text" class="form-control" id="lname" name="lname" value="{{ $User->donor->last_name }}">
                                                        </div>
                                                        @else
                                                        <div class="col-12 col-md-6">
                                                            <label for="inputFirstName" class="form-label">Organization Name</label>
                                                            <input type="text" class="form-control" id="fname" name="fname" value="{{ $User->donor->first_name }}">
                                                        </div>
                                                        @endif
                                                        <div class="col-12 col-md-6">
                                                            <label for="inputLastName" class="form-label">Email</label>
                                                            <input type="text" class="form-control" id="email" name="email" value="{{  $User->email }}">
                                                        </div>
                                                        <div class="col-12 col-md-6">
                                                            <label for="inputLastName" class="form-label">Contact</label>
                                                            <input type="text" class="form-control" id="contact" name="contact" value="{{  $User->donor->contact }}">
                                                        </div>
                                                        <div class="col-12 col-md-6">
                                                            <label for="inputLastName" class="form-label">Region</label>
                                                            <select class="form-select" id="region" name="region">
                                                                <option selected value="{{$User->location->region}}" readonly>{{$User->location->region}}</option>
                                                            </select>
                                                            <input type="hidden" id="region-name" name="region_name">
                                                        </div>
                                                        <div class="col-12 col-md-6">
                                                            <label for="inputLastName" class="form-label">Province</label>
                                                            <select class="form-select" id="province" name="province">
                                                                <option selected value="{{$User->location->province}}" readonly>{{$User->location->province}}</option>
                                                            </select>
                                                            <input type="hidden" id="province-name" name="province_name">
                                                        </div>
                                                        <div class="col-12 col-md-6">
                                                            <label for="inputLastName" class="form-label">City/Municipality</label>
                                                            <select class="form-select" id="city" name="city">
                                                                <option selected value="{{$User->location->city_municipality}}" readonly>{{$User->location->city_municipality}}</option>
                                                            </select>
                                                            <input type="hidden" id="city-name" name="city_name">
                                                        </div>
                                                        <div class="col-12 col-md-6">
                                                            <label for="inputLastName" class="form-label">Barangay</label>
                                                            <select class="form-select" id="barangay" name="barangay">
                                                                <option selected value="{{$User->location->barangay}}" readonly>{{$User->location->barangay}}</option>
                                                            </select>
                                                            <input type="hidden" id="barangay-name" name="barangay_name">
                                                        </div>
                                                        <div class="col-12 col-md-12">
                                                            <label for="inputFirstName" class="form-label">Full Address</label>
                                                            <input type="text" class="form-control" id="full_address" name="full_address" value="{{ $User->location->full_address }}" required>
                                                        </div>
                                                        <div class="col-12">
                                                            <button type="submit" class="btn primary_btn">Submit</button>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="tab-pane fade" id="password-tab-pane" role="tabpanel" aria-labelledby="password-tab" tabindex="0">
                                                    <form method="POST" action="{{ route('user.updateAccount', $User->id) }}" id="user_account_form">
                                                        @csrf
                                                        <div class="row gy-3 gy-xxl-4">
                                                            <div class="col-12">
                                                                <label for="username" class="form-label">Username</label>
                                                                <input type="text" class="form-control" name="username" id="username" value="{{ $User->username }}">
                                                            </div>

                                                            <div class="col-12">
                                                                <button type="button" class="btn btn-secondary" id="toggle-password-section">Change Password</button>
                                                            </div>

                                                            <div id="password-section" style="display: none;">
                                                                <p>Change Password</p>
                                                                <div class="input-group col-12 mt-3">
                                                                    <input type="password" class="form-control" placeholder="Current Password" name="oldPassword" id="oldPassword">
                                                                    <button class="btn btn-outline-secondary" type="button" id="toggle-opassword">
                                                                        <i class="fas fa-eye" id="toggle-opassword-icon"></i>
                                                                    </button>
                                                                </div>
                                                                <div class="input-group col-12 mt-3">
                                                                    <input type="password" class="form-control" placeholder="New Password" name="password" id="password">
                                                                    <button class="btn btn-outline-secondary" type="button" id="toggle-password">
                                                                        <i class="fas fa-eye" id="toggle-password-icon"></i>
                                                                    </button>
                                                                </div>
                                                                <div class="input-group col-12 mt-3">
                                                                    <input type="password" class="form-control" placeholder="Confirm Password" name="password_confirmation" id="cpassword">
                                                                    <button class="btn btn-outline-secondary" type="button" id="toggle-cpassword">
                                                                        <i class="fas fa-eye" id="toggle-cpassword-icon"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                            <div class="col-12 mt-3">
                                                                <button type="submit" class="btn primary_btn">Submit</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

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
    <!-- Validation -->
    <script src="{{ asset('lib/jquery/jquery.validate.min.js') }}"></script>
    <!-- User JS -->
    <script src="{{ asset('assets/users/js/user.js') }}"></script>
</body>

</html>
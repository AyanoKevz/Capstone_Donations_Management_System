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
    <link rel="stylesheet" href="{{ asset('assets/users/css/volunteer/vol_profile.css') }}">
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
                            <a class="nav-link" aria-current="page" href="{{route('volunteer.home')}}">Home</a>
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
                                href="my_profile">My profile
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
                <div class="user-panel my-3 pb-3  d-flex justify-content-center">
                    <div class="image">
                        <img src="{{ asset('storage/' . $User->volunteer->user_photo) }}" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">{{ $User->username}}</a>
                    </div>
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
                            <a href="{{ route('volunteer.home') }}" class="nav-link">
                                <i class="nav-icon fas fa-house"></i>
                                <p>Home</p>
                            </a>
                        </li>

                        <!-- My Profile -->
                        <li class="nav-item">
                            <a href="{{ route('volunteer.profile') }}" class="nav-link active">
                                <i class="nav-icon fas fa-user"></i>
                                <p>My Profile</p>
                            </a>
                        </li>

                        <!-- Make A Donation -->
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-hand-holding-heart"></i>
                                <p>
                                    Make A Donation
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Quick Donation</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Browse Requests</p>
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
                                    <i class="fas fa-angle-left right"></i>
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
                                    <a href="#" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Donation History</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <!-- Feedback and Support -->
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-comments"></i>
                                <p>Feedback / Support</p>
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
                @if(session('success'))
                <div id="alert-success" class="alert alert-success" style=" position: absolute; ; right: 10px; top: 90px;">
                    <i class="fa-solid fa-circle-check fa-xl me-3"></i>{{ session('success') }}
                </div>
                @endif
                @if(session('error'))
                <div id="alert-error" class="alert alert-error" style=" position: absolute; ; right: 10px; top: 90px;">
                    <i class=" fa-solid fa-circle-xmark fa-xl me-3"></i>{{ session('error') }}
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
                                                <div class="card-header">Welcome, {{$User->volunteer->first_name . " ". $User->volunteer->last_name}} </div>
                                                <div class="card-body">
                                                    <div class="text-center mb-3">
                                                        <img src="{{ asset('storage/' . $User->volunteer->user_photo) }}" class="img-fluid rounded-circle w-50" alt="Luna John">
                                                    </div>
                                                    <h5 class="text-center mb-1">Ethan Leo</h5>
                                                    <p class="text-center text-secondary mb-4">Volunteer</p>
                                                    <ul class="list-group list-group-flush mb-4">
                                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                                            <h6 class="m-0">Username</h6>
                                                            <span> {{$User->username}}</span>
                                                        </li>
                                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                                            <h6 class="m-0">Email</h6>
                                                            <span>{{$User->email}}</span>
                                                        </li>
                                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                                            <h6 class="m-0">Account Type</h6>
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
                                                            <div class="p-2"><strong>Full Name</strong> </div>
                                                        </div>
                                                        <div class="col-7 col-md-9 bg-light border-start border-bottom border-white border-3">
                                                            <div class="p-2">{{$User->volunteer->first_name . " ".$User->volunteer->last_name}}</div>
                                                        </div>
                                                        <div class="col-5 col-md-3 bg-light border-bottom border-white border-3">
                                                            <div class="p-2"><strong>Contact</strong> </div>
                                                        </div>
                                                        <div class="col-7 col-md-9 bg-light border-start border-bottom border-white border-3">
                                                            <div class="p-2">{{$User->volunteer->contact}}</div>
                                                        </div>
                                                        <div class="col-5 col-md-3 bg-light border-bottom border-white border-3">
                                                            <div class="p-2"><strong>Gender</strong> </div>
                                                        </div>
                                                        <div class="col-7 col-md-9 bg-light border-start border-bottom border-white border-3">
                                                            <div class="p-2">{{$User->volunteer->gender}}</div>
                                                        </div>
                                                        <div class="col-5 col-md-3 bg-light border-bottom border-white border-3">
                                                            <div class="p-2"><strong>Region</strong> </div>
                                                        </div>
                                                        <div class="col-7 col-md-9 bg-light border-start border-bottom border-white border-3">
                                                            <div class="p-2">{{$User->location->region}}</div>
                                                        </div>
                                                        <div class="col-5 col-md-3 bg-light border-bottom border-white border-3">
                                                            <div class="p-2"><strong>Region</strong> </div>
                                                        </div>
                                                        <div class="col-7 col-md-9 bg-light border-start border-bottom border-white border-3">
                                                            <div class="p-2">{{$User->location->region}}</div>
                                                        </div>
                                                        <div class="col-5 col-md-3 bg-light border-bottom border-white border-3">
                                                            <div class="p-2"><strong>Region</strong> </div>
                                                        </div>
                                                        <div class="col-7 col-md-9 bg-light border-start border-bottom border-white border-3">
                                                            <div class="p-2">{{$User->location->region}}</div>
                                                        </div>
                                                        <div class="col-5 col-md-3 bg-light border-bottom border-white border-3">
                                                            <div class="p-2"><strong>Chapter</strong> </div>
                                                        </div>
                                                        <div class="col-7 col-md-9 bg-light border-start border-bottom border-white border-3">
                                                            <div class="p-2">{{$User->volunteer->chapter->chapter_name}}</div>
                                                        </div>
                                                        <div class="col-5 col-md-3 bg-light border-bottom border-white border-3">
                                                            <div class="p-2"><strong>Preferred Services</strong> </div>
                                                        </div>
                                                        <div class="col-7 col-md-9 bg-light border-start border-bottom border-white border-3">
                                                            <div class="p-2">{{$User->volunteer->pref_services}}</div>
                                                        </div>
                                                        <div class="col-5 col-md-3 bg-light border-bottom border-white border-3">
                                                            <div class="p-2"><strong>Availability</strong> </div>
                                                        </div>
                                                        <div class="col-7 col-md-9 bg-light border-start border-bottom border-white border-3">
                                                            <div class="p-2">{{$User->volunteer->availability}}</div>
                                                        </div>
                                                        <div class="col-5 col-md-3 bg-light border-bottom border-white border-3">
                                                            <div class="p-2"><strong>Availability Time</strong> </div>
                                                        </div>
                                                        <div class="col-7 col-md-9 bg-light border-start border-bottom border-white border-3">
                                                            <div class="p-2">{{$User->volunteer->availability_time}}</div>
                                                        </div>
                                                        <div class="col-5 col-md-3 bg-light border-bottom border-white border-3">
                                                            <div class="p-2"><strong>ID Type:</strong> </div>
                                                        </div>
                                                        <div class="col-7 col-md-9 bg-light border-start border-bottom border-white border-3">
                                                            <div class="p-2">{{$User->volunteer->id_type}}</div>
                                                        </div>
                                                        <div class="bg-light text-center p-2">
                                                            <div class="p-2"><strong>ID Image:</strong> </div>
                                                            <img src="{{ asset('storage/' . $User->volunteer->id_image) }}" alt="" class="img-fluid w-25 border border-dark-subtle">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
                                                    <form method="POST" action="{{ route('volunteer.updateProfile', $User->id) }}" class="row gy-3 gy-xxl-4" enctype="multipart/form-data" id="user_profile_form">
                                                        @csrf
                                                        <div class="col-12">
                                                            <div class="row gy-2 justify-content-around align-items-center">
                                                                <label class="col-12 form-label m-0 text-center"><strong> Profile Image </strong></label>
                                                                <img id="imagePreview" src="{{ asset('storage/' . $User->volunteer->user_photo) }}" class="rounded w-25 border border-dark-subtle p-0" alt="Profile Image">
                                                                <div class="form">
                                                                    <span class="form-title">Upload your file</span>
                                                                    <p class="form-paragraph">File should be an image</p>
                                                                    <label for="file-input" class="drop-container">
                                                                        <input type="file" accept="image/*" id="file-input" name="profile_image">
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-12 col-md-6">
                                                            <label for="inputFirstName" class="form-label">First Name</label>
                                                            <input type="text" class="form-control" id="inputFirstName" name="fname" value="{{ $User->volunteer->first_name }}">
                                                        </div>
                                                        <div class="col-12 col-md-6">
                                                            <label for="inputFirstName" class="form-label">Last Name</label>
                                                            <input type="text" class="form-control" id="inputFirstName" name="lname" value="{{ $User->volunteer->last_name }}">
                                                        </div>
                                                        <div class="col-12 col-md-6">
                                                            <label for="inputLastName" class="form-label">Email</label>
                                                            <input type="text" class="form-control" id="email" name="email" value="{{  $User->email }}">
                                                        </div>
                                                        <div class="col-12 col-md-6">
                                                            <label for="inputLastName" class="form-label">Contact</label>
                                                            <input type="text" class="form-control" id="email" name="contact" value="{{  $User->volunteer->contact }}">
                                                        </div>
                                                        <div class="col-12 col-md-6">
                                                            <label for="inputLastName" class="form-label">Region</label>
                                                            <select class="form-select" id="region" name="region">
                                                                <option selected value="{{$User->location->region}}" disabled>{{$User->location->region}}</option>
                                                            </select>
                                                            <input type="hidden" id="region-name" name="region_name">
                                                        </div>
                                                        <div class="col-12 col-md-6">
                                                            <label for="inputLastName" class="form-label">Province</label>
                                                            <select class="form-select" id="province" name="province">
                                                                <option selected value="{{$User->location->province}}" disabled>{{$User->location->province}}</option>
                                                            </select>
                                                            <input type="hidden" id="province-name" name="province_name">
                                                        </div>
                                                        <div class="col-12 col-md-6">
                                                            <label for="inputLastName" class="form-label">City/Municipality</label>
                                                            <select class="form-select" id="city" name="city">
                                                                <option selected value="{{$User->location->city_municipality}}" disabled>{{$User->location->city_municipality}}</option>
                                                            </select>
                                                            <input type="hidden" id="city-name" name="city_name">
                                                        </div>
                                                        <div class="col-12 col-md-6">
                                                            <label for="inputLastName" class="form-label">Barangay</label>
                                                            <select class="form-select" id="barangay" name="barangay">
                                                                <option selected value="{{$User->location->barangay}}" disabled>{{$User->location->barangay}}</option>
                                                            </select>
                                                            <input type="hidden" id="barangay-name" name="barangay_name">
                                                        </div>
                                                        <div class="col-12 col-md-6">
                                                            <label for="inputLastName" class="form-label">Chapter</label>
                                                            <select class="form-select" id="city" name="city">
                                                                <option selected value="{{$User->volunteer->chapter->id}}" disabled>{{$User->volunteer->chapter->chapter_name}}</option>
                                                                @foreach ($chapters as $chapter)
                                                                <option value="{{ $chapter->id }}">{{ $chapter->chapter_name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-12 col-md-6">
                                                            <label for="inputLastName" class="form-label">Preferred Services</label>
                                                            <select class="form-select" id="city" name="city">
                                                                <option selected value="{{$User->volunteer->pref_services}}" disabled>{{$User->volunteer->pref_services}}</option>
                                                                <option value="Collect Donations">Collect Donations</option>
                                                                <option value="Relief Operations">Relief Operations</option>
                                                                <option value="Health Welfare">Health Welfare</option>
                                                                <option value="Emergency Response">Emergency Response</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-12 col-md-6">
                                                            <label for="inputLastName" class="form-label">Availability</label>
                                                            <select class="form-select" id="city" name="city">
                                                                <option selected value="{{$User->volunteer->availability}}" disabled>{{$User->volunteer->availability}}</option>
                                                                <option value="Weekday">Weekday</option>
                                                                <option value="Weekend">Weekend</option>
                                                                <option value="Holiday">Holiday</option>
                                                                <option value="In time of Disasters">In time of disasters</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-12 col-md-6">
                                                            <label for="inputLastName" class="form-label">Availability Time</label>
                                                            <select class="form-select" id="city" name="city">
                                                                <option selected value="{{$User->volunteer->availability_time}}" disabled>{{$User->volunteer->availability_time}}</option>
                                                                <option value="Morning" title="Typically between 6 AM to 12 PM">Morning</option>
                                                                <option value="Afternoon" title="Typically between 12 PM to 6 PM">Afternoon
                                                                </option>
                                                                <option value="Night" title="Typically between 6 PM to 12 AM">Night</option>
                                                                <option value="On-Call"
                                                                    title="Available as needed, potentially outside regular hours">On-Call
                                                                </option>
                                                                <option value="Whole-Day" title="Available throughout the entire day">Whole-Day</option>
                                                                <option value="In time of Disasters">In time of disasters</option>
                                                            </select>
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
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
    <link href="{{ asset('lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/users/css/donor/causes.css') }}">
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
                            <a class="nav-link active rounded-pill" aria-current="page" href="{{route('donor.home')}}">Home</a>
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
                                    <a href="#" class="nav-link">
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
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-map-marked-alt"></i>
                                <p>
                                    Geo-mapping
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Donation Request Map</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route ('prc-chapters') }}" class="nav-link">
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
                            <a href="{{route ('donor.causes') }}" class="nav-link active">
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
                                <li class="breadcrumb-item active">Our Causes</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <!-- End content-header -->

            <!-- Main content -->
            <div class="content px-0">
                <div class="container-fluid py-2 px-0">
                    <div class="hero" style="background: url('{{ asset('assets/img/causes.jpg') }}') no-repeat center center/cover;">
                        <div class="overlay"></div>
                        <div class="hero-content">
                            <h1>OUR CAUSES</h1>
                        </div>
                    </div>

                    <div class="sub-content mb-5">
                        <h2>What does UNIAID do?</h2>
                        <p>
                            UNIAID is committed to providing urgent assistance to victims of disasters, emergencies, and humanitarian crises. Through rescue efforts, medical aid, food distribution, and recovery programs, we support those affected by fires, typhoons, and other calamities. Our mission is to bring relief, rebuild lives, and offer hope to vulnerable communities in their time of need.
                        </p>
                    </div>

                    <div class="container">
                        <div class="row justify-content-center">
                            <!-- First Row -->
                            <div class="col-md-4 mb-5 d-flex justify-content-center">
                                <div class="cause-card text-center"> <!-- Center content inside the card -->
                                    <img src="{{ asset('assets/img/q6.jpg') }}" class="img-fluid" alt="Feeding Program">
                                    <div class="card__content">
                                        <p class="card__title">Feeding Program</p>
                                        <button class="buttonc" data-bs-toggle="modal" data-bs-target="#infoModal1"
                                            data-title="Feeding Program"
                                            data-description="Flood victims need urgent assistance including shelter, food, and medical aid.">
                                            Learn More
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-5 d-flex justify-content-center">
                                <div class="cause-card text-center">
                                    <img src="{{ asset('assets/img/e3.jpg') }}" class="img-fluid" alt="Earthquake Victims">
                                    <div class="card__content">
                                        <p class="card__title">Earthquake Victims</p>
                                        <button class="buttonc" data-bs-toggle="modal" data-bs-target="#infoModal2"
                                            data-title="Earthquake Victims"
                                            data-description="The Philippines sits along the Pacific Ring of Fire, making it highly vulnerable to earthquakes. These natural disasters can strike without warning, causing destruction, displacing families, and putting lives at risk.">
                                            Learn More
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-5 d-flex justify-content-center">
                                <div class="cause-card text-center">
                                    <img src="{{ asset('assets/img/f2.jpg') }}" class="img-fluid" alt="Fire Victims">
                                    <div class="card__content">
                                        <p class="card__title">Fire Victims</p>
                                        <button class="buttonc" data-bs-toggle="modal" data-bs-target="#infoModal3"
                                            data-title="Fire Victims"
                                            data-description="Flood victims need urgent assistance including shelter, food, and medical aid.">
                                            Learn More
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Second Row -->
                            <div class="col-md-4 mb-5 d-flex justify-content-center">
                                <div class="cause-card text-center">
                                    <img src="{{ asset('assets/img/ff2.jpeg') }}" class="img-fluid" alt="Flood Victims">
                                    <div class="card__content">
                                        <p class="card__title">Flood Victims</p>
                                        <button class="buttonc" data-bs-toggle="modal" data-bs-target="#infoModal4"
                                            data-title="Flood Victims"
                                            data-description="Flood victims need urgent assistance including shelter, food, and medical aid.">
                                            Learn More
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-5 d-flex justify-content-center">
                                <div class="cause-card text-center">
                                    <img src="{{ asset('assets/img/t3.jpeg') }}" class="img-fluid" alt="Typhoon Victims">
                                    <div class="card__content">
                                        <p class="card__title">Typhoon Victims</p>
                                        <button class="buttonc" data-bs-toggle="modal" data-bs-target="#infoModal5"
                                            data-title="Typhoon Victims"
                                            data-description="Typhoon victims face loss of homes and require immediate relief supplies and assistance.">
                                            Learn More
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-5 d-flex justify-content-center">
                                <div class="cause-card text-center">
                                    <img src="{{ asset('assets/img/v4.jpg') }}" class="img-fluid" alt="Volcanic Disaster">
                                    <div class="card__content">
                                        <p class="card__title">Volcanic Disaster</p>
                                        <button class="buttonc" data-bs-toggle="modal" data-bs-target="#infoModal6"
                                            data-title="Volcanic Disaster"
                                            data-description="Volcanic eruptions lead to severe destruction, requiring evacuation and humanitarian support.">
                                            Learn More
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Footer -->
        <footer class="main-footer">
            <strong>Copyright &copy; 2024 UniAid - Community Donations and Resource Distribution.</strong>
            All rights reserved.
        </footer>
    </div>
    <!-- ./wrapper -->



    <!-- Modal 1 -->
    <div class="modal fade" id="infoModal1" tabindex="-1" aria-labelledby="infoModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="infoModalLabel">Feeding Program</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-start">
                    <strong>Your donation helps provide nutritious meals to those in need, including:</strong><br>
                    <i class="fa-solid fa-right-long"></i> Hot meals for disaster-affected families<br>
                    <i class="fa-solid fa-right-long"></i> Supplemental feeding for malnourished children<br>
                    <i class="fa-solid fa-right-long"></i> Food packs for vulnerable communities<br><br>

                    <strong>Become a volunteer and assist in:</strong><br>
                    <i class="fa-solid fa-right-long"></i> Meal preparation and distribution<br>
                    <i class="fa-solid fa-right-long"></i> Nutrition awareness and education<br>
                    <i class="fa-solid fa-right-long"></i> Packing and delivering food supplies<br>
                    <i class="fa-solid fa-right-long"></i> Supporting feeding missions in remote areas<br><br>

                    <strong>We conducts long-term programs to fight malnutrition, including:</strong><br>

                    <i class="fa-solid fa-right-long"></i> Community-based nutrition programs<br>
                    <i class="fa-solid fa-right-long"></i> School feeding initiatives<br>
                    <i class="fa-solid fa-right-long"></i> Sustainable food security projects
                </div>
            </div>
        </div>
    </div>

    <!-- Modal 2 -->
    <div class="modal fade" id="infoModal2" tabindex="-1" aria-labelledby="infoModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="infoModalLabel">Earthquake Victims</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body  text-start">
                    <strong>Your donation provides immediate relief, including:</strong><br>
                    <i class="fa-solid fa-right-long"></i> Food and clean water<br>
                    <i class="fa-solid fa-right-long"></i> Medical aid and emergency response</strong><br>
                    <i class="fa-solid fa-right-long"></i> Temporary shelter and essential supplies<br><br>

                    <strong>Become a volunteer and assist in:</strong><br>
                    <i class="fa-solid fa-right-long"></i> Emergency response teams<br>
                    <i class="fa-solid fa-right-long"></i> Shelter and relief distribution<br>
                    <i class="fa-solid fa-right-long"></i> First aid and medical missions<br><br>

                    <strong>We provide disaster preparedness programs, including:</strong><br>
                    <i class="fa-solid fa-right-long"></i> First Aid & CPR Training<br>
                    <i class="fa-solid fa-right-long"></i> Earthquake Safety Drills<br>
                    <i class="fa-solid fa-right-long"></i> Community Disaster Response Planning
                </div>
            </div>
        </div>
    </div>

    <!-- Modal 3 -->
    <div class="modal fade" id="infoModal3" tabindex="-1" aria-labelledby="infoModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="infoModalLabel">Fire Victims</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-start">
                    <strong>Your donation provides immediate relief to fire victims, including:</strong><br>
                    <i class="fa-solid fa-right-long"></i> Food and clean water<br>
                    <i class="fa-solid fa-right-long"></i> Emergency medical aid and first aid services<br>
                    <i class="fa-solid fa-right-long"></i> Temporary shelter and essential supplies<br>
                    <i class="fa-solid fa-right-long"></i> Clothing and hygiene kits for displaced families<br><br>

                    <strong>Become a volunteer and assist in:</strong><br>
                    <i class="fa-solid fa-right-long"></i> Fire response and rescue operations<br>
                    <i class="fa-solid fa-right-long"></i> Shelter and relief distribution<br>
                    <i class="fa-solid fa-right-long"></i> First aid and medical support<br>
                    <i class="fa-solid fa-right-long"></i> Community fire prevention awareness<br><br>

                    <strong>We provide fire safety and preparedness programs, including:</strong><br>
                    <i class="fa-solid fa-right-long"></i> Fire Prevention Awareness Campaigns<br>
                    <i class="fa-solid fa-right-long"></i> First Aid & Burn Injury Training<br>
                    <i class="fa-solid fa-right-long"></i> Emergency Evacuation Drills

                </div>
            </div>
        </div>
    </div>

    <!-- Modal 4 -->
    <div class="modal fade" id="infoModal4" tabindex="-1" aria-labelledby="infoModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="infoModalLabel">Flood Victims</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-start">
                    <strong>Your donation provides immediate relief to flood victims, including:</strong><br>
                    <i class="fa-solid fa-right-long"></i> Food and clean drinking water<br>
                    <i class="fa-solid fa-right-long"></i> Emergency medical aid and first aid services<br>
                    <i class="fa-solid fa-right-long"></i> Temporary shelter and essential supplies<br>
                    <i class="fa-solid fa-right-long"></i> Hygiene kits and dry clothing for displaced families<br>
                    <i class="fa-solid fa-right-long"></i> Rescue and evacuation assistance<br><br>

                    <strong>Become a volunteer and assist in:</strong><br>
                    <i class="fa-solid fa-right-long"></i> Flood rescue and evacuation operations<br>
                    <i class="fa-solid fa-right-long"></i> Shelter and relief distribution<br>
                    <i class="fa-solid fa-right-long"></i> First aid and medical support<br>
                    <i class="fa-solid fa-right-long"></i> Community flood preparedness and awareness<br><br>

                    <strong>We provide flood safety and preparedness programs, including:</strong><br>
                    <i class="fa-solid fa-right-long"></i> Flood Early Warning and Response Training<br>
                    <i class="fa-solid fa-right-long"></i> First Aid & Water Safety Training<br>
                    <i class="fa-solid fa-right-long"></i> Community Disaster Risk Reduction Programs

                </div>
            </div>
        </div>
    </div>

    <!-- Modal 5 -->
    <div class="modal fade" id="infoModal5" tabindex="-1" aria-labelledby="infoModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="infoModalLabel">Typhoon Victims</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-start">
                    <strong>Your donation provides immediate relief to typhoon victims, including:</strong><br>
                    <i class="fa-solid fa-right-long"></i> Food and clean drinking water<br>
                    <i class="fa-solid fa-right-long"></i> Emergency medical aid and first aid services<br>
                    <i class="fa-solid fa-right-long"></i> Temporary shelter and essential supplies<br>
                    <i class="fa-solid fa-right-long"></i> Hygiene kits and dry clothing for displaced families<br>
                    <i class="fa-solid fa-right-long"></i> Rescue, evacuation, and transportation assistance<br><br>

                    <strong>Become a volunteer and assist in:</strong><br>
                    <i class="fa-solid fa-right-long"></i> Typhoon rescue and evacuation operations<br>
                    <i class="fa-solid fa-right-long"></i> Shelter and relief distribution<br>
                    <i class="fa-solid fa-right-long"></i> First aid and medical support<br>
                    <i class="fa-solid fa-right-long"></i> Community disaster preparedness and awareness<br><br>

                    <strong>We provide typhoon safety and preparedness programs, including:</strong><br>
                    <i class="fa-solid fa-right-long"></i> Disaster Preparedness and Emergency Response Training<br>
                    <i class="fa-solid fa-right-long"></i> First Aid & Water Safety Training<br>
                    <i class="fa-solid fa-right-long"></i> Community Risk Reduction and Resilience Programs

                </div>
            </div>
        </div>
    </div>

    <!-- Modal 6 -->
    <div class="modal fade" id="infoModal6" tabindex="-1" aria-labelledby="infoModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="infoModalLabel">Volcanic Eruption Victims</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-start">
                    <strong>Your donation provides immediate relief to volcanic eruption victims, including:</strong><br>
                    <i class="fa-solid fa-right-long"></i> Food and clean drinking water<br>
                    <i class="fa-solid fa-right-long"></i> Emergency medical aid and respiratory protection (e.g., N95 masks)<br>
                    <i class="fa-solid fa-right-long"></i> Temporary shelter and essential supplies<br>
                    <i class="fa-solid fa-right-long"></i> Hygiene kits and protective clothing for ashfall exposure<br>
                    <i class="fa-solid fa-right-long"></i> Rescue, evacuation, and transportation assistance<br><br>

                    <strong>Become a volunteer and assist in:</strong><br>
                    <i class="fa-solid fa-right-long"></i> Evacuation and emergency response operations<br>
                    <i class="fa-solid fa-right-long"></i> Shelter and relief distribution<br>
                    <i class="fa-solid fa-right-long"></i> First aid and medical support for ash-related illnesses<br>
                    <i class="fa-solid fa-right-long"></i> Community awareness on volcanic hazards and safety measures<br><br>

                    <strong>We provide volcanic eruption safety and preparedness programs, including:</strong><br>
                    <i class="fa-solid fa-right-long"></i> Ashfall and Respiratory Safety Training<br>
                    <i class="fa-solid fa-right-long"></i> First Aid & Emergency Evacuation Drills<br>
                    <i class="fa-solid fa-right-long"></i> Community Disaster Risk Reduction and Resilience Programs

                </div>
            </div>
        </div>
    </div>

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
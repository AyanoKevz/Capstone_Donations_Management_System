<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Admin | Request Donations</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Roboto:wght@400;500;700;900&display=swap"
    rel="stylesheet">
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="icon" href="{{ asset ('assets/img/systemLogo.png') }}" type="image/png">
  <link rel="stylesheet" href="{{ asset('lib/bootstrap/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('lib/leaflet/leaflet.css') }}">
  <link rel="stylesheet" href="{{ asset ('assets/admin/css/request.css') }}">

</head>

<!-- Spinner Start -->
<div id="spinner" class="show bg-white position-fixed w-100 vh-100 d-flex flex-column align-items-center justify-content-center">
  <div class="text-center mb-4">
    <h1 class="m-0 fw-bold" style="color: #ff1f1f; font-size:50px;">
      <img src="{{ asset('assets/img/systemLogo.png') }}" class="me-3 w-25" alt="Logo">UniAid
    </h1>
  </div>
  <div class="loading">
    <div class="d1"></div>
    <div class="d2"></div>
    <span class="loading-text">Loading...</span>
  </div>
</div>
<!-- Spinner End -->

<body class="sb-nav-fixed">
  <nav class="sb-topnav navbar navbar-expand navbar-dark bg-logo1">
    <div class="container-fluid">
      <!-- Navbar Brand-->
      <a class="navbar-brand mx-5 p-0" href="#">
        <img src="{{ asset ('assets/img/systemLogo.png') }}" alt="Logo" class="d-inline-block">
        <span class="navbar-title">UniAid</span>
      </a>
      <!-- Sidebar Toggle-->
      <button class="btn btn-link btn-sm order-lg-0" id="sidebarToggle" href="#">
        <i class="fas fa-bars fa-xl"></i>
      </button>
      <!-- Navbar-->
      <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav me-lg-4 ">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle d-flex align-items-center" id="navbarDropdown" href="#" role="button"
              data-bs-toggle="dropdown" aria-expanded="false">

              <div class="nav-profile-img">
                <img src="{{ asset('storage/' . $Admin->profile_image) }}" alt="image">
                <span class="availability-status online"></span>
              </div>
              <div class="nav-profile-text ms-2">
                {{$Admin->name}}
              </div>
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
              <li>
                <form action="{{ route('admin.logout') }}" method="POST">
                  @csrf
                  <button type="submit" class="dropdown-item d-flex justify-content-center align-items-center">
                    Logout
                    <i class="fas fa-right-from-bracket ms-2"></i>
                  </button>
                </form>
              </li>
              <li>
                <a class="dropdown-item d-flex justify-content-center align-items-center" href="my_profile">My profile
                  <i class="fas fa-user ms-2"></i>
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Main layout -->
  <div id="layoutSidenav">
    <!-- Sidebar -->
    <div id="layoutSidenav_nav">
      <nav class="sb-sidenav accordion bg-logo2" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
          <div class="nav">

            <div class="d-flex justify-content-center align-items-center py-4 border-bottom border-light nav-profile">
              <div class="nav-profile-img">
                <img src="{{ asset('storage/' . $Admin->profile_image) }}" alt="image">
                <span class="availability-status online"></span>
              </div>
              <div class="nav-profile-text">
                <p> {{ $Admin->username }}</p>
              </div>
            </div>

            <!-- Dashboard -->
            <a class="nav-link" href="{{ route('admin.dashboard') }}" title="Dashboard">
              <div class="sb-nav-link-icon">
                <i class="fas fa-tachometer-alt"></i>
              </div>
              <span>Dashboard</span>
            </a>

            <!-- Admin Settings -->
            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#admin-settings"
              aria-expanded="false" aria-controls="admin-settings" title="Admin Settings">
              <div class="sb-nav-link-icon">
                <i class="fas fa-user-cog"></i>
              </div>
              <span>Admin Settings</span>
              <div class="sb-sidenav-collapse-arrow">
                <i class="fas fa-angle-down"></i>
              </div>
            </a>
            <div class="collapse" id="admin-settings" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
              <nav class="sb-sidenav-menu-nested nav">
                <a class="nav-link" href="{{route('admin.profile')}}" title="Admin Profile">
                  <div class="sb-nav-link-icon">
                    <i class="far fa-circle nav-icon"></i>
                  </div>
                  <span>Admin Profile</span>
                </a>
                <a class="nav-link" href="{{ route('admin.list') }}" title="Admin Accounts">
                  <div class="sb-nav-link-icon">
                    <i class="far fa-circle nav-icon"></i>
                  </div>
                  <span>Admin Accounts</span>
                </a>
              </nav>
            </div>

            <!-- Manage Users -->
            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#manage-users"
              aria-expanded="false" aria-controls="manage-users" title="Manage Users">
              <div class="sb-nav-link-icon">
                <i class="fas fa-users"></i>
              </div>
              <span>Manage Users</span>
              <div class="sb-sidenav-collapse-arrow">
                <i class="fas fa-angle-down"></i>
              </div>
            </a>
            <div class="collapse" id="manage-users" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
              <nav class="sb-sidenav-menu-nested nav">
                <a class="nav-link" href="{{ route('admin.donorList') }}" title="Donors">
                  <div class="sb-nav-link-icon">
                    <i class="far fa-circle nav-icon"></i>
                  </div>
                  <span>Donors</span>
                </a>
                <a class="nav-link" href="{{ route('admin.volunteerList') }}" title="Volunteers">
                  <div class="sb-nav-link-icon">
                    <i class="far fa-circle nav-icon"></i>
                  </div>
                  <span>Volunteers</span>
                </a>
                <a class="nav-link" href="{{ route('verify_account') }}" title="Verify Accounts">
                  <div class="sb-nav-link-icon">
                    <i class="far fa-circle nav-icon"></i>
                  </div>
                  <span>Verify Accounts</span>
                </a>
              </nav>
            </div>

            <!-- Manage Resources -->
            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#manage-resources"
              aria-expanded="false" aria-controls="manage-resources" title="Manage Resources">
              <div class="sb-nav-link-icon">
                <i class="fas fa-box"></i>
              </div>
              <span>Manage Resources</span>
              <div class="sb-sidenav-collapse-arrow">
                <i class="fas fa-angle-down"></i>
              </div>
            </a>
            <div class="collapse" id="manage-resources" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
              <nav class="sb-sidenav-menu-nested nav">
                <a class="nav-link" href="" title="Donated Resources">
                  <div class="sb-nav-link-icon">
                    <i class="far fa-circle nav-icon"></i>
                  </div>
                  <span>Donated Resources</span>
                </a>
                <a class="nav-link" href="" title="Distributed Resources">
                  <div class="sb-nav-link-icon">
                    <i class="far fa-circle nav-icon"></i>
                  </div>
                  <span>Distributed Resources</span>
                </a>
              </nav>
            </div>

            <!-- Manage Donation Requests -->
            <a class="nav-link collapsed active" href="#" data-bs-toggle="collapse" data-bs-target="#manage-requests"
              aria-expanded="false" aria-controls="manage-requests" title="Manage Donation Requests">
              <div class="sb-nav-link-icon">
                <i class="fas fa-clipboard-list"></i>
              </div>
              <span>Manage Donation Requests</span>
              <div class="sb-sidenav-collapse-arrow">
                <i class="fas fa-angle-down"></i>
              </div>
            </a>
            <div class="collapse" id="manage-requests" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
              <nav class="sb-sidenav-menu-nested nav">
                <a class="nav-link active" href="{{ route('admin.request_form') }}" title="Create Request">
                  <div class="sb-nav-link-icon">
                    <i class="fas fa-circle-arrow-right  nav-icon"></i>
                  </div>
                  <span>Create Request</span>
                </a>
                <a class="nav-link" href="" title="View All Requests">
                  <div class="sb-nav-link-icon">
                    <i class="far fa-circle nav-icon"></i>
                  </div>
                  <span>View All Requests</span>
                </a>
              </nav>
            </div>

            <!-- Volunteer Appointments -->
            <a class="nav-link" href="{{ route('admin.appointments') }}" title="Volunteer Appointments">
              <div class="sb-nav-link-icon">
                <i class="fas fa-calendar-alt"></i>
              </div>
              <span>Volunteer Appointments</span>
            </a>

            <!-- Chapters -->
            <a class="nav-link " href="{{ route('admin.chapters') }}" title="Chapters">
              <div class="sb-nav-link-icon">
                <i class="fas fa-map-marker-alt"></i>
              </div>
              <span>Chapters</span>
            </a>

            <!-- Inquiries -->
            <a class="nav-link" href="{{ route('admin.inquiries') }}" title="Inquiries">
              <div class="sb-nav-link-icon">
                <i class="fas fa-envelope"></i>
              </div>
              <span>Inquiries</span>
            </a>

            <!-- News -->
            <a class="nav-link" href="{{ route('admin.news') }}" title="News">
              <div class="sb-nav-link-icon">
                <i class="fas fa-newspaper"></i>
              </div>
              <span>News</span>
            </a>

            <!-- Reports -->
            <a class="nav-link" href="" title="Reports">
              <div class="sb-nav-link-icon">
                <i class="fas fa-chart-bar"></i>
              </div>
              <span>Reports</span>
            </a>
          </div>
        </div>
        <div class="sb-sidenav-footer bg-logo1">
          <div>Admin Menu</div>
        </div>
      </nav>
    </div>
    <!-- Content -->
    <div id="layoutSidenav_content">
      <main>
        @if(session('success'))
        <div id="alert-success" class="alert alert-success" style="position: absolute; right: 10px; top: 40px;">
          <i class="fa-solid fa-circle-check fa-xl me-3"></i>{{ session('success') }}
        </div>
        @endif
        @if($errors->any())
        <div id="alert-error" class="alert alert-error" style="position: absolute; right: 10px; top: 40px;">
          <ul>
            @foreach ($errors->all() as $error)
            <li><i class="fa-solid fa-circle-xmark fa-xl"></i> {{ $error }}</li>
            @endforeach
          </ul>
        </div>
        @endif
        @if(session('info'))
        <div id="alert-info" class="alert alert-info" style=" position: absolute; right: 10px; top: 40px;">
          {{ session('info') }}
        </div>
        @endif
        <div class="container-fluid px-3 py-2">
          <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active"></li>
          </ol>
          <h1 class="my-2">Request Donation</h1>
          <section class="py-3 py-md-5 py-xl-8 bg-light">
            <div class="container">
              <div class="row gy-4 gy-lg-0">
                <div class="col-12 col-lg-6 col-xl-6">
                  <div class="card widget-card border-light shadow-sm">
                    <div class="card-header">Admin Request Form</div>
                    <div class="card-body p-4">
                      <ul class="nav nav-tabs justify-content-center" id="profileTab" role="tablist">
                        <li class="nav-item" role="presentation">
                          <button class="nav-link profile_tab active" id="overview-tab" data-bs-toggle="tab" data-bs-target="#overview-tab-pane" type="button" role="tab" aria-controls="overview-tab-pane" aria-selected="true">Request In-Kind</button>
                        </li>
                        <li class="nav-item" role="presentation">
                          <button class="nav-link profile_tab" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">Request Funds</button>
                        </li>
                      </ul>
                      <div class="tab-content pt-4" id="profileTabContent">
                        <div class="tab-pane fade show active" id="overview-tab-pane" role="tabpanel" aria-labelledby="overview-tab" tabindex="0">
                          <!-- In Kind -->
                          <form method="POST" action="{{ route('admin.request.submit') }}" class="row gy-3 gy-xxl-4" enctype="multipart/form-data" id="inKindForm">
                            @csrf
                            <div class="col-12 col-md-6">
                              <label for="cause" class="form-label">Cause</label>
                              <select class="form-select" id="cause" name="cause">
                                <option selected disabled>Select Cause</option>
                                <option value="Fire">Fire</option>
                                <option value="Flood">Flood</option>
                                <option value="Typhoon">Typhoon</option>
                                <option value="Earthquake">Earthquake</option>
                                <option value="Volcanic Eruption">Volcanic Eruption</option>
                                <option value="Feeding Program">Feeding Program</option>
                              </select>
                            </div>
                            <div class="col-12 col-md-6">
                              <label for="urgency" class="form-label">Urgency</label>
                              <select class="form-select" id="urgency" name="urgency">
                                <option selected disabled>Select Urgency</option>
                                <option value="Low">Low</option>
                                <option value="Moderate">Moderate</option>
                                <option value="Critical">Critical</option>
                              </select>
                            </div>
                            <div class="col-12 col-md-6">
                              <label for="urgency" class="form-label">Region</label>
                              <select class="form-select" id="region" name="region" required>
                                <option disabled selected value="">Select Region</option>
                              </select>
                              <input type="hidden" id="region-name" name="region_name">
                            </div>
                            <div class="col-12 col-md-6">
                              <label for="province" class="form-label">Province</label>
                              <select class="form-select" id="province" name="province" required>
                                <option disabled selected value="">Select Province</option>
                              </select>
                              <input type="hidden" id="province-name" name="province_name">
                            </div>
                            <div class="col-12 col-md-6">
                              <label for="city" class="form-label">City/Municipality</label>
                              <select class="form-select" id="city" name="city" required>
                                <option disabled selected value="">Select City</option>
                              </select>
                              <input type="hidden" id="city-name" name="city_name">
                            </div>
                            <div class="col-12 col-md-6">
                              <label for="barangay" class="form-label">Barangay</label>
                              <select class="form-select" id="barangay" name="barangay" required>
                                <option disabled selected value="">Select Barangay</option>
                              </select>
                              <input type="hidden" id="barangay-name" name="barangay_name">
                            </div>
                            <input type="hidden" id="latitude" name="latitude">
                            <input type="hidden" id="longitude" name="longitude">

                            <div class="col-12 col-md-12">
                              <p class="mt-0 my-3 text-center"><strong>Upload Proof Image and Video</strong></p>
                              <div class="d-flex gap-2 flex-wrap justify-content-center">
                                <!-- Proof Photo 1 -->
                                <div>
                                  <input type="file" id="proof_photo_1" name="proof_photo_1" class="file-input" hidden>
                                  <label for="proof_photo_1" class="open-file">
                                    <span class="file-wrapper">
                                      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 71 67">
                                        <path stroke-width="5" stroke="black" d="M41.7322 11.7678L42.4645 12.5H43.5H68.5V64.5H2.5V2.5H32.4645L41.7322 11.7678Z"></path>
                                      </svg>
                                      <span class="file-front"></span>
                                    </span>
                                    Image 1
                                  </label>
                                  <!-- File name here below -->
                                  <span id="file-name-1" class="file-name"></span>
                                </div>
                                <!-- Proof Photo 2 -->
                                <div>
                                  <input type="file" id="proof_photo_2" name="proof_photo_2" class="file-input" hidden>
                                  <label for="proof_photo_2" class="open-file">
                                    <span class="file-wrapper">
                                      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 71 67">
                                        <path stroke-width="5" stroke="black" d="M41.7322 11.7678L42.4645 12.5H43.5H68.5V64.5H2.5V2.5H32.4645L41.7322 11.7678Z"></path>
                                      </svg>
                                      <span class="file-front"></span>
                                    </span>
                                    Image 2
                                  </label>
                                  <!-- File name here below -->
                                  <span id="file-name-2" class="file-name"></span>
                                </div>
                                <!-- Proof Video -->
                                <div>
                                  <input type="file" id="proof_video" name="proof_video" class="file-input" hidden>
                                  <label for="proof_video" class="open-file">
                                    <span class="file-wrapper">
                                      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 71 67">
                                        <path stroke-width="5" stroke="black" d="M41.7322 11.7678L42.4645 12.5H43.5H68.5V64.5H2.5V2.5H32.4645L41.7322 11.7678Z"></path>
                                      </svg>
                                      <span class="file-front"></span>
                                    </span>
                                    Video
                                  </label>
                                  <!-- File name here below -->
                                  <span id="file-name-video" class="file-name"></span>
                                </div>
                              </div>
                            </div>
                            <div class="col-12 col-md-12">
                              <p class="text-center"><strong>Requested Items</strong></p>
                              <div class="row g-2 gy-2" id="requested-items">
                                <!-- Default item (first item) -->
                              </div>
                              <div class="d-flex justify-content-center">
                                <button type="button" class="btn btn-success mt-2" id="add-item">Add Item</button>
                              </div>
                            </div>
                            <div class="col-12 col-md-12">
                              <label for="floatingTextarea" class="form-label">Description</label>
                              <textarea class="form-control" name="description" placeholder="Leave a details here:"></textarea>
                            </div>
                            <div class="col-12">
                              <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                          </form>
                        </div>
                        <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
                          <form method="POST" action="{{ route('admin.updateProfile', $Admin->id) }}" class="row gy-3 gy-xxl-4" enctype="multipart/form-data" id="admin_profile_form">
                            <!-- Funds -->
                            @csrf
                            <div class="col-12 col-md-6">
                              <label for="inputFirstName" class="form-label">Name</label>
                              <input type="text" class="form-control" id="inputFirstName" name="name" value="{{ $Admin->name }}">
                            </div>
                            <div class="col-12 col-md-6">
                              <label for="inputLastName" class="form-label">Email</label>
                              <input type="text" class="form-control" id="email" name="email" value="{{ $Admin->email }}">
                            </div>
                            <div class="col-12">
                              <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-12 col-lg-6 col-xl-6">
                  <div id="map"></div>
                </div>
              </div>
            </div>
          </section>
        </div>
      </main>

      <footer class="py-3 bg-dark mt-3">
        <div class="container-fluid ps-4">
          <div class="d-flex align-items-center justify-content-between">
            <div class="text-muted">&copy; R.O.Salas Construction. All rights reserved</div>
          </div>
        </div>
      </footer>
    </div>
  </div>

  <!-- Scripts -->
  <script src="{{ asset('lib/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('lib/fontawesome/all.js') }}"></script>
  <script src="{{ asset('lib/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('lib/leaflet/leaflet.js') }}"></script>
  <script src="{{ asset('lib/jquery/jquery.validate.min.js') }}"></script>
  <script>
    var baseIconPath = "{{ asset('assets/img/') }}/";
  </script>
  <script src="{{ asset('assets/admin/js/admin.js') }}"></script>
</body>

</html>
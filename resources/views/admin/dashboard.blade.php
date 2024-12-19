<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Admin | Dashboard</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Roboto:wght@400;500;700;900&display=swap"
    rel="stylesheet">
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="icon" href="{{ asset ('assets/img/systemLogo.png') }}" type="image/png">
  <link rel="stylesheet" href="{{ asset('lib/bootstrap/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset ('assets/admin/css/dashboard.css') }}">

</head>

<!-- Spinner Start -->
<div id="spinner"
  class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
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
                <img src="{{ asset ('assets/img/no_profile.png') }}" alt="image">
                <span class="availability-status online"></span>
              </div>
              <div class="nav-profile-text ms-2">
                Username
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
            <!-- Profile Section -->
            <div class="d-flex justify-content-center align-items-center py-4 border-bottom border-light nav-profile">
              <div class="nav-profile-img">
                <img src="{{ asset ('assets/img/no_profile.png') }}" alt="image">
                <span class="availability-status online"></span>
              </div>
              <div class="nav-profile-text">
                <p>Username</p>
              </div>
            </div>

            <!-- Nav Links -->
            <a class="nav-link active" href="{{ route('admin.dashboard') }}" title="Dashboard">
              <div class="sb-nav-link-icon">
                <i class="fas fa-tachometer-alt"></i>
              </div>
              <span>Dashboard</span>
            </a>

            <!-- Admin Settings -->
            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#admin"
              aria-expanded="false" aria-controls="admin" title="Admin Settings">
              <div class="sb-nav-link-icon">
                <i class="fas fa-user"></i>
              </div>
              <span>Admin Settings</span>
              <div class="sb-sidenav-collapse-arrow">
                <i class="fas fa-angle-down"></i>
              </div>
            </a>
            <div class="collapse" id="admin" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
              <nav class="sb-sidenav-menu-nested nav">
                <a class="nav-link" href="#" title="Admin Profile">
                  <i class="far fa-circle nav-icon"></i> Admin Profile
                </a>
                <a class="nav-link" href="#" title="Admin Accounts">
                  <i class="far fa-circle nav-icon"></i> Admin Accounts
                </a>
              </nav>
            </div>

            <!-- Manage Users -->
            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#user"
              aria-expanded="false" aria-controls="user" title="Manage Users">
              <div class="sb-nav-link-icon">
                <i class="fas fa-users"></i>
              </div>
              <span>Manage Users</span>
              <div class="sb-sidenav-collapse-arrow">
                <i class="fas fa-angle-down"></i>
              </div>
            </a>
            <div class="collapse" id="user" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
              <nav class="sb-sidenav-menu-nested nav">
                <a class="nav-link" href="#" title="Donors">
                  <i class="far fa-circle nav-icon"></i> Donors
                </a>
                <a class="nav-link" href="#" title="Volunteers">
                  <i class="far fa-circle nav-icon"></i> Volunteers
                </a>
              </nav>
            </div>

            <!-- Manage Resources -->
            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#resources"
              aria-expanded="false" aria-controls="resources" title="Manage Resources">
              <div class="sb-nav-link-icon">
                <i class="fas fa-list-check"></i>
              </div>
              <span>Manage Resources</span>
              <div class="sb-sidenav-collapse-arrow">
                <i class="fas fa-angle-down"></i>
              </div>
            </a>
            <div class="collapse" id="resources" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
              <nav class="sb-sidenav-menu-nested nav">
                <a class="nav-link" href="#" title="Donated Resources">
                  <i class="far fa-circle nav-icon"></i> Donated Resources
                </a>
                <a class="nav-link" href="#" title="Distributed Resources">
                  <i class="far fa-circle nav-icon"></i> Distributed Resources
                </a>
              </nav>
            </div>

            <!-- Manage Donations -->
            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#donation"
              aria-expanded="false" aria-controls="donation" title="Manage Donations">
              <div class="sb-nav-link-icon">
                <i class="fas fa-hand-holding-heart"></i>
              </div>
              <span>Manage Donations</span>
              <div class="sb-sidenav-collapse-arrow">
                <i class="fas fa-angle-down"></i>
              </div>
            </a>
            <div class="collapse" id="donation" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
              <nav class="sb-sidenav-menu-nested nav">
                <a class="nav-link" href="#" title="Quick Donations">
                  <i class="far fa-circle nav-icon"></i> Quick Donations
                </a>
                <a class="nav-link" href="#" title="Specific Requests">
                  <i class="far fa-circle nav-icon"></i> Specific Requests
                </a>
              </nav>
            </div>

            <!-- Manage Requests -->
            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#request"
              aria-expanded="false" aria-controls="request" title="Manage Requests">
              <div class="sb-nav-link-icon">
                <i class="fas fa-clipboard-list"></i>
              </div>
              <span>Manage Requests</span>
              <div class="sb-sidenav-collapse-arrow">
                <i class="fas fa-angle-down"></i>
              </div>
            </a>
            <div class="collapse" id="request" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
              <nav class="sb-sidenav-menu-nested nav">
                <a class="nav-link" href="#" title="Available Resources">
                  <i class="far fa-circle nav-icon"></i> Available Resources
                </a>
                <a class="nav-link" href="#" title="Post a Request">
                  <i class="far fa-circle nav-icon"></i> Submitted Posts
                </a>
              </nav>
            </div>

            <!-- Additional Links -->
            <a class="nav-link" href="{{ route('admin.inquiries') }}" title="Inquiries">
              <div class="sb-nav-link-icon">
                <i class="fas fa-envelope"></i>
              </div>
              <span>Inquiries</span>
            </a>
            <a class="nav-link" href="#" title="News">
              <div class="sb-nav-link-icon">
                <i class="fas fa-newspaper"></i>
              </div>
              <span>News</span>
            </a>
            <a class="nav-link" href="#" title="Reports">
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
        <div class="container-fluid px-3 py-2">
          <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Dashboard</li>
          </ol>
          <h1 class="my-2">Dashboard</h1>
          <!-- /.DITO IINSERT CONTENT -->
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
  <script src="{{ asset('assets/admin/js/admin.js') }}"></script>

  <script>

  </script>
</body>

</html>
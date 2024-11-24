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
  <link rel="stylesheet" href="{{ asset('lib/datatables/datatables.min.css') }}">
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
                <a class="dropdown-item d-flex justify-content-center align-items-center" href="logout.php">Logout
                  <i class="fas fa-right-from-bracket ms-2"></i>
                </a>
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
            <a class="nav-link active" href="dashboard.php" title="Dashboard">
              <div class="sb-nav-link-icon">
                <i class="fas fa-tachometer-alt"></i>
              </div>
              <span>Dashboard</span>
            </a>
            <a class="nav-link" href="#" title="Users">
              <div class="sb-nav-link-icon">
                <i class="fas fa-users"></i>
              </div>
              <span>Users</span>
            </a>
            <a class="nav-link" href="#" title="Users">
              <div class="sb-nav-link-icon">
                <i class="fas fa-message"></i>
              </div>
              <span>Inquiries</span>
            </a>
            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#appointment"
              aria-expanded="false" aria-controls="appointment" title="Appointment">
              <div class="sb-nav-link-icon">
                <i class="fas fa-calendar-check"></i>
              </div>
              <span>Dropdown</span>
              <div class="sb-sidenav-collapse-arrow">
                <i class="fas fa-angle-down"></i>
              </div>
            </a>

            <div class="collapse" id="appointment" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
              <nav class="sb-sidenav-menu-nested nav">
                <a class="nav-link" href="appointment.php" title="Appointment Scheduled">
                  <div class="sb-nav-link-icon">
                    <i class="far fa-circle nav-icon"></i>
                  </div>
                  <span>Dropdown 1</span>
                </a>
                <a class="nav-link" href="inquiries.php" title="Inquiries">
                  <div class="sb-nav-link-icon">
                    <i class="far fa-circle nav-icon"></i>
                  </div>
                  <span>Dropdown 2</span>
                </a>
              </nav>
            </div>
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
        <div class="container-fluid p-4">
          <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Dashboard</li>
          </ol>
          <h1 class="mt-3 mb-4">Dashboard</h1>

        </div>
      </main>
      <footer class="py-3 bg-dark mt-auto">
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
  <script src="{{ asset('lib/datatables/datatables.min.js') }}"></script>
  <script src="{{ asset('assets/admin/js/admin.js') }}"></script>

  <script>

  </script>
</body>

</html>
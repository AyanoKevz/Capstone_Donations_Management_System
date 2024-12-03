<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Admin | Inquiries</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Roboto:wght@400;500;700;900&display=swap"
    rel="stylesheet">
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="icon" href="{{ asset ('assets/img/systemLogo.png') }}" type="image/png">
  <link rel="stylesheet" href="{{ asset('lib/bootstrap/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset ('assets/admin/css/inquiries.css') }}">

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
            <a class="nav-link" href="{{ route ('admin.dashboard')}}" title="Dashboard">
              <div class="sb-nav-link-icon">
                <i class="fas fa-tachometer-alt"></i>
              </div>
              <span>Dashboard</span>
            </a>
            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#admin"
              aria-expanded="false" aria-controls="admin" title="Manage Admin">
              <div class="sb-nav-link-icon">
                <i class="fas fa-user"></i>
              </div>
              <span>Admin Settings </span>
              <div class="sb-sidenav-collapse-arrow">
                <i class="fas fa-angle-down"></i>
              </div>
            </a>
            <div class="collapse" id="admin" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
              <nav class="sb-sidenav-menu-nested nav">
                <a class="nav-link" href="#" title="Admin Profile">
                  <div class="sb-nav-link-icon">
                    <i class="far fa-circle nav-icon"></i>
                  </div>
                  <span>Admin Profile</span>
                </a>
                <a class="nav-link" href="#" title="Admin Accounts">
                  <div class="sb-nav-link-icon">
                    <i class="far fa-circle nav-icon"></i>
                  </div>
                  <span>Admin Accounts</span>
                </a>
              </nav>
            </div>

            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#user"
              aria-expanded="false" aria-controls="user" title="Manage User">
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
                  <div class="sb-nav-link-icon">
                    <i class="far fa-circle nav-icon"></i>
                  </div>
                  <span>Donors</span>
                </a>
                <a class="nav-link" href="#" title="Donee">
                  <div class="sb-nav-link-icon">
                    <i class="far fa-circle nav-icon"></i>
                  </div>
                  <span>Donee</span>
                </a>
                <a class="nav-link" href="#" title="Volunteer">
                  <div class="sb-nav-link-icon">
                    <i class="far fa-circle nav-icon"></i>
                  </div>
                  <span>Volunteer</span>
                </a>
              </nav>
              <a class="nav-link" href="#" title="Verify Accounts">
                <div class="sb-nav-link-icon">
                  <i class="far fa-circle nav-icon"></i>
                </div>
                <span>Verify Accounts</span>
              </a>
            </div>
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
                  <div class="sb-nav-link-icon">
                    <i class="far fa-circle nav-icon"></i>
                  </div>
                  <span>Donated Resources</span>
                </a>
                <a class="nav-link" href="#" title="Distributed Resources">
                  <div class="sb-nav-link-icon">
                    <i class="far fa-circle nav-icon"></i>
                  </div>
                  <span>Distributed Resources</span>
                </a>
              </nav>
            </div>
            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#donation"
              aria-expanded="false" aria-controls="donation" title="Manage Donation">
              <div class="sb-nav-link-icon">
                <i class="fas fa-hand-holding-heart"></i>
              </div>
              <span>Manage Donation</span>
              <div class="sb-sidenav-collapse-arrow">
                <i class="fas fa-angle-down"></i>
              </div>
            </a>
            <div class="collapse" id="donation" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
              <nav class="sb-sidenav-menu-nested nav">
                <a class="nav-link" href="#" title="Quick Donations">
                  <div class="sb-nav-link-icon">
                    <i class="far fa-circle nav-icon"></i>
                  </div>
                  <span>Quick Donations</span>
                </a>
                <a class="nav-link" href="#" title="Donee Selections">
                  <div class="sb-nav-link-icon">
                    <i class="far fa-circle nav-icon"></i>
                  </div>
                  <span>Donee Selection</span>
                </a>
              </nav>
            </div>
            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#request"
              aria-expanded="false" aria-controls="request" title="Verify Donee Request">
              <div class="sb-nav-link-icon">
                <i class="fas fa-handshake"></i>
              </div>
              <span>Verify Donee Request</span>
              <div class="sb-sidenav-collapse-arrow">
                <i class="fas fa-angle-down"></i>
              </div>
            </a>
            <div class="collapse" id="request" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
              <nav class="sb-sidenav-menu-nested nav">
                <a class="nav-link" href="#" title="Available Resources">
                  <div class="sb-nav-link-icon">
                    <i class="far fa-circle nav-icon"></i>
                  </div>
                  <span>Available Resources</span>
                </a>
                <a class="nav-link" href="#" title="Post A Request">
                  <div class="sb-nav-link-icon">
                    <i class="far fa-circle nav-icon"></i>
                  </div>
                  <span>Post A Request</span>
                </a>
              </nav>
            </div>
            <a class="nav-link active" href="{{ route ('admin.inquiries')}}" title="Inquiries">
              <div class="sb-nav-link-icon">
                <i class="fas fa-message"></i>
              </div>
              <span>Inquiries</span>
            </a>
            <a class="nav-link" href="#" title="News">
              <div class="sb-nav-link-icon">
                <i class="fas fa-newspaper"></i>
              </div>
              <span>News</span>
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
          @if (session('success'))
          <div id="alert-success" class="alert alert-success wow fadeInLeft">
            <i class="fa-solid fa-circle-check me-3"></i>{{ session('success') }}
          </div>
          @endif

          @if (session('error'))
          <div id="alert-error" class="alert alert-error wow fadeInLeft">
            <i class="fa-solid fa-circle-xmark me-3"></i>{{ session('error') }}
          </div>
          @endif
          <h1 class="my-2">Inquiries Inbox</h1>
          <!-- /. CONTENT -->
          <section class="content mb-2">
            <div class="container-fluid ps-0">
              <div class="card card-primary card-outline">
                <div class="card-header">
                  <h3 class="card-title">Inbox</h3>
                </div>
                <div class="card-body p-0">
                  <form method="POST" action="{{ route('inquiries.delete') }}">
                    @csrf
                    <div class="mailbox-controls d-flex justify-content-between align-items-center border-bottom border-secondary-subtle border-2">
                      <div>
                        <button type="button" class="btn email-btn btn-sm checkbox-toggle" title="Check All">
                          <i class="far fa-square"></i>
                        </button>
                        <button type="submit" class="btn email-btn btn-sm" title="Delete">
                          <i class="far fa-trash-alt"></i>
                        </button>
                      </div>
                      <div>
                        <a href="{{ route('admin.inquiries', ['status' => 'all']) }}"
                          class="btn email-btn btn-sm {{ $status === 'all' ? 'custom-active' : '' }}">
                          All
                        </a>
                        <a href="{{ route('admin.inquiries', ['status' => 'unread']) }}"
                          class="btn email-btn btn-sm {{ $status === 'unread' ? 'custom-active' : '' }}">
                          Unread
                        </a>
                        <a href="{{ route('admin.inquiries', ['status' => 'read']) }}"
                          class="btn email-btn btn-sm {{ $status === 'read' ? 'custom-active' : '' }}">
                          Read
                        </a>
                      </div>
                    </div>
                    <div class="table-responsive mailbox-messages">
                      <table class="table table-hover table-striped">
                        <tbody>
                          @forelse($inquiries as $inquiry)
                          <tr>
                            <td>
                              <div class="icheck-primary">
                                <input type="checkbox" name="selected[]" value="{{ $inquiry->id }}" id="check{{ $inquiry->id }}">
                                <label for="check{{ $inquiry->id }}"></label>
                              </div>
                            </td>
                            <td class="mailbox-name">
                              <a href="{{ route('inquiries.read', $inquiry->id) }}" class="{{ $inquiry->status === 'unread' ? 'fw-bold' : 'text-secondary' }}">{{ $inquiry->name }}</a>
                            </td>
                            <td class="mailbox-subject {{ $inquiry->status === 'unread' ? 'fw-bold' : 'text-secondary' }}">{{ $inquiry->subject }}</td>
                            <td class="mailbox-date">{{ $inquiry->submitted_at->format('d M Y h:i A') }}</td>
                            <td class="{{ $inquiry->status === 'unread' ? 'fw-bold' : 'text-secondary' }}">
                              {{ ucfirst($inquiry->status) }}
                            </td>
                          </tr>
                          @empty
                          <tr>
                            <td colspan="6" class="text-center">No inquiries available for {{ ucfirst($status ?? 'All') }}.</td>
                          </tr>
                          @endforelse
                        </tbody>
                      </table>
                    </div>
                  </form>
                </div>
                <div class="card-footer px-2">
                  <div class="mailbox-controls d-flex justify-content-between align-items-center">
                    Total Inquiries: {{ $total }}
                    <div class="mt-2"> {{ $inquiries->links() }}</div>
                  </div>
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
  <script src="{{ asset('assets/admin/js/admin.js') }}"></script>

  <script>

  </script>
</body>

</html>
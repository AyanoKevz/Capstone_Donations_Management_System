<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Admin | All Volunteers</title>
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
  <link rel="stylesheet" href="{{ asset ('assets/admin/css/list.css') }}">

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
                <a class="dropdown-item d-flex justify-content-center align-items-center" href="{{route('admin.profile')}}">My profile
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
              <div class="nav-profile-text text-center">
                <p>{{ $Admin->username }}</p>
                <small class="text-white">{{ $Admin->chapter->chapter_name }}</small>
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
            <a class="nav-link collapsed active" href="#" data-bs-toggle="collapse" data-bs-target="#manage-users"
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
                <a class="nav-link active" href="{{ route('admin.volunteerList') }}" title="Volunteers">
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
                <a class="nav-link" href="{{ route('admin.received_donation') }}" title="Received Donations">
                  <div class="sb-nav-link-icon">
                    <i class="far fa-circle nav-icon"></i>
                  </div>
                  <span>Received Donations</span>
                </a>
                <a class="nav-link " href="{{ route('admin.distributed_donation') }}" title="Distributed Resources">
                  <div class="sb-nav-link-icon">
                    <i class="far fa-circle nav-icon"></i>
                  </div>
                  <span>Distributed Resources</span>
                </a>
              </nav>
            </div>

            <!-- Manage Donation Requests -->
            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#manage-requests"
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
                <a class="nav-link" href="{{ route('admin.request_form') }}" title="Create Request">
                  <div class="sb-nav-link-icon">
                    <i class="far fa-circle nav-icon"></i>
                  </div>
                  <span>Create Request</span>
                </a>
                <a class="nav-link" href="{{ route('admin.requestList') }}" title="View All Requests">
                  <div class="sb-nav-link-icon">
                    <i class="far fa-circle nav-icon"></i>
                  </div>
                  <span>View All Requests</span>
                </a>
              </nav>
            </div>

            <a class="nav-link" href="{{ route('admin.quickDonation') }}" title="Volunteer Appointments">
              <div class="sb-nav-link-icon">
                <i class="fa-solid fa-handshake-angle"></i>
              </div>
              <span>Quick Donations</span>
            </a>


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
        @if(session('error'))
        <div id="alert-error" class="alert alert-danger" style=" position: absolute; right: 10px; top: 40px;">
          <i class=" fa-solid fa-circle-xmark fa-xl me-3"></i>{{ session('error') }}
        </div>
        @endif
        <div class="container-fluid px-3 py-2">
          <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active"></li>
          </ol>
          <h1 class="my-2">Our Volunteer</h1>
          <div class="d-flex justify-content-end mb-1">
            <a href="{{ route('admin.volunteerList', ['status' => 'all']) }}"
              class="btn table-btn btn-sm {{ $statusFilter === 'all' ? 'custom-active' : '' }}">
              All
            </a>
            <a href="{{ route('admin.volunteerList', ['status' => 'active']) }}"
              class="btn table-btn btn-sm {{ $statusFilter === 'active' ? 'custom-active' : '' }}">
              Active
            </a>
            <a href="{{ route('admin.volunteerList', ['status' => 'inactive']) }}"
              class="btn table-btn btn-sm {{ $statusFilter === 'inactive' ? 'custom-active' : '' }}">
              Inactive
            </a>
          </div>
          <div class="card card-primary card-outline">
            <div class="card-header">
              <h3 class="card-title">Volunteer List</h3>
            </div>
            <div class="card-body">
              <table id="example1" class="table table-bordered table-hover table-striped">
                <thead>
                  <tr>
                    <th>Role</th>
                    <th>Username</th>
                    <th>Chapter</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse($volunteers as $volunteer)
                  <tr>
                    <td>{{ $volunteer->role_name }}</td>
                    <td>{{ $volunteer->username }}</td>
                    <td>{{ $volunteer->volunteer->chapter->chapter_name ?? 'No Chapter' }}</td>
                    <td>
                      @if($volunteer->is_verified)
                      <p class="bg-success-subtle text-success-emphasis m-0 p-1 fw-bold">Active</p>
                      @else
                      <p class="bg-danger-subtle text-danger-emphasis m-0 p-1 fw-bold">Inactive</p>
                      @endif
                    </td>
                    <td>
                      <!-- Action Buttons -->
                      <button type="button" class="btn btn-success btn-sm me-2" title="View Details">
                        <a href="{{ route('view_details', $volunteer->id) }}" style="color: white; text-decoration:none;">View</a>
                      </button>
                      @if($volunteer->is_verified)
                      <button type="button" class="btn btn-danger btn-sm ms-2" data-bs-toggle="modal" data-bs-target="#deactivateModal{{ $volunteer->id }}" title="Deactivate">
                        Deactivate
                      </button>
                      @endif
                    </td>
                  </tr>

                  <!-- Deactivate Modal -->
                  <div class="modal fade" id="deactivateModal{{ $volunteer->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                      <div class="modal-content">
                        <form action="{{ route('volunteers.deactivate', $volunteer->id) }}" method="POST">
                          @csrf
                          <div class="modal-header">
                            <h5 class="modal-title">Deactivate Volunteer</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body text-center">
                            Are you sure you want to deactivate this volunteer?
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-danger">Deactivate</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                  @empty
                  <tr>
                    <td colspan="5" class="text-center">No Volunteers Available</td>
                  </tr>
                  @endforelse
                </tbody>
              </table>
            </div>
          </div>
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
  <script src="{{ asset('lib/datatables/datatables.min.js') }}"></script>
  <script src="{{ asset('assets/admin/js/admin.js') }}"></script>

  <script>

  </script>
</body>

</html>
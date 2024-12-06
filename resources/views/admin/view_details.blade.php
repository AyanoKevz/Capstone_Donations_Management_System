<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Admin | Read Inquiries</title>
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
  <link rel="stylesheet" href="{{ asset ('assets/admin/css/verify.css') }}">

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

            <a class="nav-link collapsed active" href="#" data-bs-toggle="collapse" data-bs-target="#user"
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
              <a class="nav-link active" href="{{route ('verify_account')}}" title="Verify Accounts">
                <div class="sb-nav-link-icon">
                  <i class="fas fa-circle nav-icon"></i>
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
            <a class="nav-link " href="{{ route ('admin.inquiries')}}" title="Inquiries">
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
            <li class="breadcrumb-item active"></li>
          </ol>

          <h1 class="my-2">User Information</h1>

          <div class="row">
            <div class="col-md-12">
              <div class="card p-4">
                <div class="row">
                  <!-- First Column: Details -->
                  <div class="col-md-8">
                    <h4>Account Details</h4>
                    <div class="ms-3 mt-3">
                      <p><strong>Account Type:</strong> {{ ucfirst($user->account_type) }}</p>
                      <p><strong>Role:</strong> {{ $role }}</p>
                      <p><strong>Username:</strong> {{ $user->username }}</p>
                      <p><strong>Email:</strong> {{ $user->email }}</p>
                    </div>
                    <hr />
                    <h4>Person Details</h4>
                    <div class="ms-3 mt-3">
                      <p><strong>First Name:</strong> {{ $details->first_name }}</p>
                      <p><strong>Middle Name:</strong> {{ $details->middle_name ?? 'N/A' }}</p>
                      <p><strong>Last Name:</strong> {{ $details->last_name }}</p>
                      <p><strong>Contact:</strong> {{ $details->contact }}</p>
                      <p><strong>Birthday:</strong> {{ $details->birthday }}</p>
                      <p><strong>Gender:</strong> {{ ucfirst($details->gender ?? 'N/A') }}</p>
                    </div>
                    <hr />
                    @if($role === 'volunteer')
                    <h4>Volunteer Details</h4>
                    <div class="ms-3 mt-3">
                      <p><strong>Preferred Services:</strong> {{ ucfirst($details->pref_services) }}</p>
                      <p><strong>Availability:</strong> {{ ucfirst($details->availability) }}</p>
                      <p><strong>Availability Time:</strong> {{ ucfirst($details->availability_time) }}</p>
                    </div>
                    <hr>
                    <h4>Educational Attainment</h4>
                    <div class="ms-3 mt-3">
                      <p><strong>Educational Attainment:</strong> {{ str_replace('_', ' ', ucfirst($details->educational_attainment)) }}</p>
                      <p><strong>Currently Studying:</strong> {{ $details->is_studying ? 'Yes' : 'No' }}</p>
                      <p><strong>Currently Employed:</strong> {{ $details->is_employed ? 'Yes' : 'No' }}</p>
                    </div>
                    @endif
                    <h4>Address Details</h4>
                    <div class="ms-3 mt-3">
                      <p><strong>Region:</strong> {{ $details->location->region ?? 'N/A' }}</p>
                      <p><strong>Province:</strong> {{ $details->location->province ?? 'N/A' }}</p>
                      <p><strong>City:</strong> {{ $details->location->city_municipality ?? 'N/A' }}</p>
                      <p><strong>Barangay:</strong> {{ $details->location->barangay ?? 'N/A' }}</p>
                    </div>
                    <hr />
                    <h4>Identity Details</h4>
                    <div class="ms-3 mt-3 mb-3">
                      <p><strong>ID Type Submitted:</strong> {{ $details->id_type ?? 'N/A' }}</p>
                    </div>
                  </div>
                  <!-- Second Column: Images -->
                  <div class="col-md-4 text-center">
                    <h4>Submitted Images</h4>
                    <div class="mb-4">
                      <label for="userPicture" class="form-label">User ID</label>
                      <div class="image-container border rounded mx-auto d-flex align-items-center justify-content-center">
                        <img src="{{ asset('storage/' . $details->id_image) }}" alt="ID Image">
                      </div>
                    </div>
                    <div>
                      <label for="userID" class="form-label">User Photo</label>
                      <div class="image-container border rounded mx-auto d-flex align-items-center justify-content-center">
                        <img src="{{ asset('storage/' . $details->user_photo) }}" alt="User Photo">
                      </div>
                    </div>
                  </div>
                </div>
                <!-- Buttons -->
                <div class="row mt-4">
                  <div class="col text-center">
                    <button type="button" class="btn btn-success me-3" data-bs-toggle="modal" data-bs-target="#verify" data-user-id="{{ $user->id }}">
                      Verify
                    </button>
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#unverify" data-user-id="{{ $user->id }}">
                      Not Verify
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </main>

      <!-- Verify Modal -->
      <div class="modal fade" id="verify" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-4">Do you want to verify?</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
              <p class="m-0">Verify this account? This account will be active.</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>

              <!-- Traditional Form for Verify -->
              <form action="{{ route('process_verification', $user->id) }}" method="POST">
                @csrf
                <input type="hidden" name="action" value="verify">
                <button type="submit" class="btn btn-success">Yes</button>
              </form>
            </div>
          </div>
        </div>
      </div>

      <!-- Unverify Modal -->
      <div class="modal fade" id="unverify" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
          <div class="modal-content">
            <div class="modal-header text-center">
              <h1 class="modal-title fs-4">Do you want to unverify?</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
              <p class="m-0">Unverify this account? This account will be unused and removed from the account list.</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>

              <!-- Traditional Form for Not Verify -->
              <form action="{{ route('process_verification', $user->id) }}" method="POST">
                @csrf
                <input type="hidden" name="action" value="not_verify">
                <button type="submit" class="btn btn-danger">Yes</button>
              </form>
            </div>
          </div>
        </div>
      </div>


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

</body>

</html>
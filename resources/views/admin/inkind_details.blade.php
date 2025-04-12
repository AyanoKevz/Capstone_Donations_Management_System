<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Admin | In-Kind Donation Details</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Roboto:wght@400;500;700;900&display=swap"
    rel="stylesheet">
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="icon" href="{{ asset ('assets/img/systemLogo.png') }}" type="image/png">
  <link rel="stylesheet" href="{{ asset('lib/bootstrap/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset ('assets/admin/css/inkind_details.css') }}">

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
            <a class="nav-link collapsed " href="#" data-bs-toggle="collapse" data-bs-target="#manage-requests"
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
          <h1 class="my-2">In-Kind Donations Details</h1>
          <div class="card custom-card shadow-lg rounded">
            <div class="card-header custom-header text-white">
              <h3 class="mb-0"><i class="far fa-clone pr-1"></i> In-Kind Donation Details</h3>
            </div>
            <div class="card-body">
              <!-- Donation Details Table -->
              <table class="table custom-table table-hover">
                <tr>
                  <th width="30%" class="bg-light-custom">Donor Name</th>
                  <td width="2%">:</td>
                  <td>{{ $inKindDonation->donor_name }}</td>
                </tr>
                <tr>
                  <th width="30%" class="bg-light-custom">Contact Number</th>
                  <td width="2%">:</td>
                  <td>{{ $inKindDonation->donor->contact}}</td>
                </tr>
                <tr>
                  <th class="bg-light-custom">Donation Method</th>
                  <td>:</td>
                  <td>{{ ucfirst($inKindDonation->donation_method) }}</td>
                </tr>
                @if(strtolower($inKindDonation->donation_method) === 'pickup')
                <tr>
                  <th class="bg-light-custom">Pickup Address</th>
                  <td>:</td>
                  <td>{{ $inKindDonation->pickup_address }}</td>
                </tr>
                @endif
                <tr>
                  <th class="bg-light-custom">Donation Date & Time</th>
                  <td>:</td>
                  <td>{{ \Carbon\Carbon::parse($inKindDonation->donation_datetime)->format('F d, Y \a\t g:i A') }}</td>

                </tr>
                <tr>
                  <th class="bg-light-custom">Status</th>
                  <td>:</td>
                  <td>
                    <span class="badge bg-{{ 
                        strtolower($inKindDonation->status) == 'pending' ? 'secondary' :
                        (strtolower($inKindDonation->status) == 'received' ? 'success' :
                        (strtolower($inKindDonation->status) == 'ongoing' ? 'warning text-dark' : 'success')) }}">
                      {{ ucfirst($inKindDonation->status) }}
                    </span>
                  </td>
                </tr>
                <tr>
                  <th class="bg-light-custom">Donated At</th>
                  <td>:</td>
                  <td>
                    @if($inKindDonation->donationRequest)
                    <a href="{{ route('request_details', ['id' => $inKindDonation->donationRequest->id, 'type' => 'in-kind']) }}">
                      Request
                    </a>
                    @else
                    Quick
                    @endif
                  </td>
                </tr>
                <tr>
                  <th class="bg-light-custom">Tracking Number</th>
                  <td>:</td>
                  <td>{{ $inKindDonation->tracking_number }}</td>
                </tr>
              </table>

              <!-- Donated Items Table -->
              <div class="mt-4">
                <div class="card-header custom-subheader text-white">
                  <h3 class="mb-0"><i class="fa-solid fa-boxes-stacked"></i> Donated Items</h3>
                </div>
                <table class="table table-striped table-bordered text-center custom-items-table">
                  <thead>
                    <tr>
                      <th>Category</th>
                      <th>Item</th>
                      <th>Quantity</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($inKindDonation->donationItems as $item)
                    <tr>
                      <td>{{ ucfirst($item->category) }}</td>
                      <td>{{ ucfirst($item->item) }}</td>
                      <td><strong>{{ $item->quantity }}</strong></td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>

              <!-- Proof Image Section -->
              <div class="mt-4 text-center">
                <div class="card-header custom-subheader text-white">
                  <h3 class="mb-0"><i class="fa-solid fa-images"></i> Proof of Donation</h3>
                </div>
                <div class="p-3 donation-proof-container">
                  <img src="{{ asset('storage/' . $inKindDonation->proof_image) }}"
                    alt="Proof Image"
                    class="img-fluid donation-proof-image">
                </div>
              </div>

              <!-- Volunteer Section -->
              @if($inKindDonation->volunteerActivities()->exists())
              <div class="mt-4">
                <div class="card-header custom-subheader text-white">
                  <h3 class="mb-0"><i class="fa-solid fa-boxes-stacked"></i> Volunteers to Pickup</h3>
                </div>
                <table class="table table-striped table-bordered text-center custom-items-table">
                  <thead>
                    <tr>
                      <th>Image</th>
                      <th>Full Name</th>
                      <th>Contact No.</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($inKindDonation->volunteerActivities as $activity)
                    <tr>
                      <td>
                        <img src="{{ asset('storage/' . $activity->volunteer->user_photo) }}"
                          alt="Volunteer Photo" class="img-fluid" width="80" height="80">
                      </td>
                      <td class="align-middle">{{ $activity->volunteer->first_name }} {{ $activity->volunteer->last_name }}</td>
                      <td class="align-middle">{{ $activity->volunteer->contact }}</td>
                      <td class="align-middle">
                        @if($activity->status === 'accepted')
                        <span class=" badge bg-success">Accepted</span>
                        @elseif($activity->status === 'declined')
                        <span class="badge bg-danger">Declined</span>
                        @elseif($activity->status === 'ongoing')
                        <span class="badge bg-info text-dark">Ongoing (Active)</span>
                        @elseif($activity->status === 'pending')
                        <span class="badge bg-warning text-dark">Pending</span>
                        @else
                        <span class=" badge bg-success">Completed</span>
                        @endif
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              @endif

              <!-- Verify/Decline Buttons -->
              @if(strtolower($inKindDonation->status) === 'pending')
              <div class="mt-4 d-flex justify-content-end">
                <button type="button" class="btn btn-verify mx-2" data-bs-toggle="modal" data-bs-target="#verifyModal">
                  <i class="fas fa-check-circle"></i> Verify
                </button>
                <button type="button" class="btn btn-decline mx-2" data-bs-toggle="modal" data-bs-target="#declineModal">
                  <i class="fas fa-times-circle"></i> Decline
                </button>
              </div>
              @endif

              <!-- Recieved  // ASSIGN -->
              @if(strtolower($inKindDonation->status) === 'ongoing')
              @if($inKindDonation->donation_method === 'drop-off')
              <!-- Drop-off donations -->
              <div class="mt-4 d-flex justify-content-end">
                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#confirmCompletionModal">
                  <i class="fas fa-check-circle me-2"></i> Mark as Received
                </button>
              </div>
              @elseif($inKindDonation->volunteerActivities->where('status', 'ongoing')->isNotEmpty())
              <!-- Active pickup donations -->
              <div class="mt-4 d-flex justify-content-end">
                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#confirmCompletionModal">
                  <i class="fas fa-check-circle me-2"></i> Mark as Received
                </button>
              </div>
              @elseif(!$inKindDonation->volunteerActivities()->whereIn('status', ['pending', 'accepted', 'ongoing'])->exists())
              <!-- No volunteer assigned -->
              <div class="mt-4 d-flex justify-content-end">
                <button class="btn btn-verify" data-bs-toggle="modal" data-bs-target="#assignVolunteersModal">
                  <i class="fas fa-user-plus me-2"></i> Assign Volunteers
                </button>
              </div>
              @endif
              @endif
            </div>
          </div>
      </main>

      <!-- Verify Modal -->
      <div class="modal fade" id="verifyModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-4">Verify Donation</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
              <p class="my-1 fw-bold">Are you sure you want to verify this donation?</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
              <form action="{{ route('inkind.donation.verify', $inKindDonation->id) }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-success">Verify</button>
              </form>
            </div>
          </div>
        </div>
      </div>

      <!-- Decline Modal -->
      <div class="modal fade" id="declineModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-4">Decline Donation</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <p>Are you sure you want to decline this donation?</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
              <form action="{{ route('inkind.donation.decline', $inKindDonation->id) }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-danger">Decline</button>
              </form>
            </div>
          </div>
        </div>
      </div>

      <!-- Assign Volunteer Modal -->
      <div class="modal fade" id="assignVolunteersModal" tabindex="-1" aria-labelledby="assignVolunteersModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="assignVolunteersModalLabel">Assign Volunteer</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="assignVolunteerForm" action="{{ route('admin.assign.volunteer') }}" method="POST">
              @csrf
              <input type="hidden" name="donation_id" value="{{ $inKindDonation->id }}">
              <div class="modal-body">
                <div class="mb-3">
                  <label for="volunteer_id" class="form-label">Select Volunteer</label>
                  <select class="form-select" id="volunteer_id" name="volunteer_id" required>
                    <option value="" selected disabled>Choose volunteer</option>
                    @foreach($availableVolunteers as $volunteer)
                    <option value="{{ $volunteer->id }}">
                      {{ $volunteer->first_name }} {{ $volunteer->last_name }}
                    </option>
                    @endforeach
                  </select>
                </div>
                <div class="mb-3">
                  <label for="task_description" class="form-label">Task Description</label>
                  <textarea class="form-control" id="task_description" name="task_description" rows="3" required></textarea>
                </div>
                <div class="mb-3">
                  <label for="activity_date" class="form-label">Activity Date</label>
                  <input type="date" class="form-control" id="activity_date" name="activity_date" required>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Assign Volunteer</button>
              </div>
            </form>
          </div>
        </div>
      </div>



      <!-- Recieve Modal -->
      <div class="modal fade" id="confirmCompletionModal" tabindex="-1" aria-labelledby="confirmCompletionModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <form action="{{ route('admin.donations.mark-received', $inKindDonation->id) }}" method="POST">
              @csrf
              <div class="modal-header">
                <h5 class="modal-title">Confirm Donation Receive</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body text-center">
                <p class="fw-bold text-success">Are you sure you want to mark this donation as received?</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-success">Confirm</button>
              </div>
            </form>
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
  <script src="{{ asset('assets/admin/js/admin.js') }}"></script>

  <script>

  </script>
</body>

</html>
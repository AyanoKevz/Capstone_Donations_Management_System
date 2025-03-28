<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Admin | All Request</title>
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
                <a class="nav-link" href="{{ route('admin.request_form') }}" title="Create Request">
                  <div class="sb-nav-link-icon">
                    <i class="far fa-circle nav-icon"></i>
                  </div>
                  <span>Create Request</span>
                </a>
                <a class="nav-link active" href="{{ route('admin.requestList') }}" title="View All Requests">
                  <div class="sb-nav-link-icon">
                    <i class="fas fa-circle-arrow-right nav-icon"></i>
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
          <h1 class="my-2">Request Details</h1>
          <div class="container mb-3">
            <div class="row">
              <!-- Request Information Card -->
              <div class="col-md-6">
                <div class="card shadow-sm">
                  <div class="card-header bg-transparent border-0">
                    <h3 class="mb-0"><i class="far fa-clone pr-1"></i> Request Information</h3>
                  </div>
                  <div class="card-body pt-0">
                    <table class="table table-bordered">
                      <tr>
                        <th width="30%">Cause</th>
                        <td width="2%">:</td>
                        <td>{{ $request->cause }}</td>
                      </tr>
                      <tr>
                        <th width="30%">Urgency</th>
                        <td width="2%">:</td>
                        <td>
                          <span class="badge bg-{{ $request->urgency == 'Critical' ? 'danger' : 'warning' }}">
                            {{ $request->urgency }}
                          </span>
                        </td>
                      </tr>
                      <tr>
                        <th width="30%">Description</th>
                        <td width="2%">:</td>
                        <td>{{ $request->description }}</td>
                      </tr>
                      <tr>
                        <th width="30%">Status</th>
                        <td width="2%">:</td>
                        <td>
                          <span class="badge bg-{{ $request->status == 'Pending' ? 'success' : ($request->status == 'Unfulfilled' ? 'danger' : 'secondary') }}">
                            {{ ucfirst($request->status) }}
                          </span>
                        </td>
                      </tr>
                      <tr>
                        <th width="30%">Location</th>
                        <td width="2%">:</td>
                        <td>{{ $formattedLocation }}</td>
                      </tr>
                      @if($request->casualty_cost !== null)
                      <tr>
                        <th width="30%">Casualty Cost</th>
                        <td width="2%">:</td>
                        <td>₱{{ number_format( $request->casualty_cost, 2) }}</td>
                      </tr>
                      @endif
                      <tr>
                        <th width="30%">Valid Until</th>
                        <td width="2%">:</td>
                        <td>{{ \Carbon\Carbon::parse($request->valid_until)->format('F d, Y') }}</td>
                      </tr>
                    </table>

                    @if ($isCashRequest)
                    <div class="card-header bg-transparent border-0">
                      <h3 class="mb-0"><i class="far fa-clone pr-1"></i> Cash Request</h3>
                    </div>
                    <table class="table table-bordered">
                      <thead class="table-warning">
                        <tr>
                          <th width="50%">Total Donated</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td class="text-success">₱{{ number_format($totalCashDonated, 2) }}</td>
                        </tr>
                      </tbody>
                    </table>
                    @else
                    <div class="card-header bg-transparent border-0">
                      <h3 class="mb-0"><i class="far fa-clone pr-1"></i> Requested Items</h3>
                    </div>
                    <table class="table table-bordered">
                      <thead class="table-warning">
                        <tr>
                          <th>Category</th>
                          <th>Item</th>
                          <th>Quantity</th>
                          <th>Donated</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($requestedItems as $item)
                        <tr>
                          <td>{{ $item->category }}</td>
                          <td>{{ $item->item }}</td>
                          <td>{{ $item->quantity }}</td>
                          <td>{{ $donatedQuantities[$item->item] ?? 0 }}</td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                    @endif
                  </div>
                </div>
              </div>

              <!-- Proof Media Card -->
              <div class="col-md-6">
                <div class="card shadow-sm">
                  <div class="card-header bg-transparent border-0">
                    <h3 class="mb-0"><i class="far fa-clone pr-1"></i> Proof Media</h3>
                  </div>
                  <div class="card-body pt-0">
                    <div class="row mb-3">
                      <div class="col-md-6 mb-2">
                        <img src="{{ asset('storage/' . $request->proof_photo_1) }}" alt="Proof Photo 1" class="img-fluid rounded" style="width: 100%; height: 150px; object-fit: cover;">
                      </div>
                      <div class="col-md-6 mb-2">
                        <img src="{{ asset('storage/' . $request->proof_photo_2) }}" alt="Proof Photo 2" class="img-fluid rounded" style="width: 100%; height: 150px; object-fit: cover;">
                      </div>
                      <div class="col-md-12">
                        <video controls class="rounded" style="width: 100%; height: 200px; object-fit: cover;">
                          <source src="{{ asset('storage/' . $request->proof_video) }}" type="video/mp4">
                          Your browser does not support the video tag.
                        </video>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>


          <!-- Table who donated to the request -->
          <div class="container ">
            <div class="row">
              <div class="d-flex justify-content-end align-items-center mb-1">
                <strong class="me-2">Status:</strong>
                <a href="{{ route('request_details', ['id' => $id, 'type' => $isCashRequest ? 'cash' : 'in-kind']) }}?status=all"
                  class="btn table-btn btn-sm {{ $status === 'all' ? 'custom-active' : '' }}">
                  All
                </a>

                <a href="{{ route('request_details', ['id' => $id, 'type' => $isCashRequest ? 'cash' : 'in-kind']) }}?status=pending"
                  class="btn table-btn btn-sm {{ $status === 'pending' ? 'custom-active' : '' }}">
                  Pending
                </a>

                <a href="{{ route('request_details', ['id' => $id, 'type' => $isCashRequest ? 'cash' : 'in-kind']) }}?status=received"
                  class="btn table-btn btn-sm {{ $status === 'received' ? 'custom-active' : '' }}">
                  Received
                </a>

                <a href="{{ route('request_details', ['id' => $id, 'type' => $isCashRequest ? 'cash' : 'in-kind']) }}?status=ongoing"
                  class="btn table-btn btn-sm {{ $status === 'ongoing' ? 'custom-active' : '' }}">
                  Ongoing
                </a>
              </div>

              <div class="card card-primary card-outline">
                <div class="card-header">
                  <h3 class="card-title">Donors for This Request</h3>
                </div>
                <div class="card-body">
                  <table id="example1" class="table table-bordered table-hover table-striped">
                    <thead>
                      <tr>
                        <th>Name</th>
                        <th>Method</th>
                        @if($isCashRequest)
                        <th>Amount</th>
                        {{-- Show "Payment Method" column only if any donation is online --}}
                        @if($cashDonations->contains('donation_method', 'online'))
                        <th>Payment Method</th>
                        @endif
                        @endif
                        <th>Date & Time</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      {{-- Show cash donations if request type is cash --}}
                      @if($isCashRequest)
                      @foreach($cashDonations as $cashDonation)
                      <tr>
                        <td>{{ $cashDonation->donor_name }}</td>
                        <td>{{ ucfirst($cashDonation->donation_method) }}</td>
                        <td>₱{{ number_format($cashDonation->amount, 2) }}</td>
                        {{-- Show payment method only if donation method is online --}}
                        @if($cashDonations->contains('donation_method', 'online'))
                        <td>
                          @if($cashDonation->donation_method == 'online')
                          {{ $cashDonation->payment_method }}
                          @else
                          N/A
                          @endif
                        </td>
                        @endif
                        <td>{{ \Carbon\Carbon::parse($cashDonation->created_at)->format('M d, Y h:i A') }}</td>
                        <td>
                          <span class="badge bg-{{
        $cashDonation->status === 'received' ? 'success' :
        ($cashDonation->status === 'pending' ? 'secondary' :
        ($cashDonation->status === 'ongoing' ? 'warning text-dark' : 'danger'))
    }}">
                            {{ ucfirst($cashDonation->status) }}
                          </span>
                        </td>
                        <td>
                          <a href="{{ route('cash.donation.details', $cashDonation->id) }}" class="btn btn-sm btn-primary">View</a>
                        </td>
                      </tr>
                      @endforeach
                      @else
                      {{-- Show in-kind donations if request type is in-kind --}}
                      @foreach($inKindDonations as $inKindDonation)
                      <tr>
                        <td>{{ $inKindDonation->donor_name }}</td>
                        <td>{{ ucfirst($inKindDonation->donation_method) }}</td>
                        <td>{{ \Carbon\Carbon::parse($inKindDonation->donation_datetime)->format('M d, Y h:i A') }}</td>
                        <td>
                          <span class="badge bg-{{
        $inKindDonation->status === 'received' ? 'success' :
        ($inKindDonation->status === 'pending' ? 'secondary' :
        ($inKindDonation->status === 'ongoing' ? 'warning text-dark' : 'danger'))
    }}">
                            {{ ucfirst($inKindDonation->status) }}
                          </span>
                        </td>
                        <td>
                          <a href="{{ route('inkind.donation.details', $inKindDonation->id) }}" class="btn btn-sm btn-success">
                            <i class="fa-solid fa-eye"></i> View
                        </td>
                      </tr>
                      @endforeach
                      @endif
                    </tbody>
                  </table>
                </div>
              </div>
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
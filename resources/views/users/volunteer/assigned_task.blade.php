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
    <link rel="stylesheet" href="{{ asset('lib/datatables/datatables.min.css') }}">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('assets/users/css/volunteer/vol_table.css') }}">
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
                            <a class="nav-link active rounded-pill" aria-current="page" href="{{route('volunteer.home')}}">Home</a>
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
                                href="{{ route('volunteer.profile') }}">My profile
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
                    <img src="{{ asset('storage/' . $User->volunteer->user_photo) }}" class="img-circle elevation-2" alt="User Image">
                    <a href="{{route ('volunteer.profile') }}" class="d-block side-user mt-2" title="profile">{{ $User->username }}</a>
                    <p class="text-white m-0">Volunteer</p>
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
                            <a href="{{ route('volunteer.profile') }}" class="nav-link">
                                <i class="nav-icon fas fa-user"></i>
                                <p>My Profile</p>
                            </a>
                        </li>

                        <!-- Volunteer Activities -->
                        <li class="nav-item">
                            <a href="#" class="nav-link active">
                                <i class="nav-icon fas fa-hand-holding-heart"></i>
                                <p>
                                    Volunteer Tasks
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('volunteer.available_task') }}" class="nav-link ">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Available Tasks</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('volunteer.assigned_task') }}" class="nav-link active">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Assigned Task</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <!-- Volunteer History -->
                        <li class="nav-item">
                            <a href="{{ route('volunteer.completed_tasks') }}" class="nav-link">
                                <i class="nav-icon fas fa-pen-to-square"></i>
                                <p>Volunteer History</p>
                            </a>
                        </li>
                        <!-- Testimonials -->
                        <li class="nav-item">
                            <a href="{{ route('volunteer.testi_form') }}" class="nav-link">
                                <i class="nav-icon fas fa-star"></i>
                                <p>Testimonials</p>
                            </a>
                        </li>

                        <!-- Contact / Support -->
                        <li class="nav-item">
                            <a href="{{ route('volunteer.contact_form') }}" class="nav-link">
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
                            <img src="{{ asset('assets/img/volunteerbanner.png') }}" alt="" class="banner-img img-fluid mx-2">
                            <h1 class="m-0">
                                Volunteer Portal
                            </h1>
                        </div>
                        <div class="col-5 d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('volunteer.home') }}">Home</a>
                                </li>
                                <li class="breadcrumb-item">Volunteer Task</li>
                                <li class="breadcrumb-item active">Assigned Tasks</li>
                            </ol>
                        </div>
                    </div>
                </div>
                @if(session('error'))
                <div id="alert-error" class="alert alert-error" style=" position: absolute; ; right: 10px; top: 90px;">
                    <i class=" fa-solid fa-circle-xmark fa-xl me-3"></i>{{ session('error') }}
                </div>
                @endif
                @if(session('success'))
                <div id="alert-success" class="alert alert-success" style=" position: absolute; ; right: 10px; top: 90px;">
                    <i class="fa-solid fa-circle-check fa-xl me-3"></i>{{ session('success') }}
                </div>
                @endif
            </div>

            <!-- End content-header -->

            <!-- Main content -->
            <div class="content">
                <div class="container-fluid py-3">
                    <div class="row">
                        <div class="card card-primary card-outline">
                            <div class="card-header mb-0">
                                <h3 class="card-title">Assigned Tasks</h3>
                            </div>
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th>Type</th>
                                            <th>Activity Date</th>
                                            <th>Description</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($assignedTasks as $task)
                                        <tr>
                                            <td>
                                                @if($task->donation_id)
                                                Pickup
                                                @elseif($task->distribution_id)
                                                Distribution
                                                @else
                                                Other
                                                @endif
                                            </td>
                                            <td>{{ \Carbon\Carbon::parse($task->activity_date)->format('M j, Y') }}</td>
                                            <td>{{ $task->task_description }}</td>
                                            <td>
                                                @php
                                                $statusBadges = [
                                                'ongoing' => ['class' => 'bg-primary', 'text' => 'Ongoing'],
                                                'accepted' => ['class' => 'bg-warning', 'text' => 'Scheduled'],
                                                'completed' => ['class' => 'bg-success', 'text' => 'Completed']
                                                ];
                                                @endphp

                                                @if(isset($statusBadges[$task->status]))
                                                <span class="badge {{ $statusBadges[$task->status]['class'] }}">
                                                    {{ $statusBadges[$task->status]['text'] }}
                                                    @if($task->status == 'ongoing' && \Carbon\Carbon::parse($task->activity_date)->isToday())
                                                    (Today)
                                                    @endif
                                                </span>
                                                @endif
                                            </td>
                                            <td>
                                                <!-- View Button -->
                                                <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#viewTaskModal{{ $task->id }}">
                                                    <i class="fas fa-eye"></i> View
                                                </button>
                                        </tr>

                                        <!-- View Task Modal -->
                                        <div class="modal fade" id="viewTaskModal{{ $task->id }}" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-primary text-white">
                                                        <h5 class="modal-title">
                                                            <i class="fas fa-tasks me-2"></i>Task Details
                                                        </h5>
                                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <!-- Proof Image Section -->
                                                        @if($task->proof_image)
                                                        <div class="text-center mb-4">
                                                            <img src="{{ asset('storage/' . $task->proof_image) }}" alt="Task Proof" class="img-thumbnail rounded-3" style="max-height: 200px; object-fit: cover;">
                                                            <p class="text-muted mt-2 small">Task Image</p>
                                                        </div>
                                                        @endif

                                                        <div class="row g-4">
                                                            <!-- Activity Details Column -->
                                                            <div class="col-md-6">
                                                                <div class="card h-100 border-0 shadow-sm">
                                                                    <div class="card-header bg-light">
                                                                        <h6 class="mb-0">
                                                                            <i class="fas fa-info-circle me-2"></i>Activity Details
                                                                        </h6>
                                                                    </div>
                                                                    <div class="card-body">
                                                                        <ul class="list-group list-group-flush">
                                                                            <li class="list-group-item">
                                                                                <span class="fw-bold">Type:</span>
                                                                                <span>
                                                                                    @if($task->donation_id)
                                                                                    <span class="badge bg-info">Pickup</span>
                                                                                    @elseif($task->distribution_id)
                                                                                    <span class="badge bg-success">Distribution</span>
                                                                                    @else
                                                                                    <span class="badge bg-secondary">Other</span>
                                                                                    @endif
                                                                                </span>
                                                                            </li>
                                                                            <li class="list-group-item">
                                                                                <span class="fw-bold">Date:</span>
                                                                                <span>{{ \Carbon\Carbon::parse($task->activity_date)->format('F j, Y h:i A') }}</span>
                                                                            </li>
                                                                            <li class="list-group-item">
                                                                                <div class="fw-bold">Description:</div>
                                                                                <div class="mt-1">{{ $task->task_description }}</div>
                                                                            </li>
                                                                            <li class="list-group-item">
                                                                                <span class="fw-bold">Status:</span>
                                                                                @if(isset($statusBadges[$task->status]))
                                                                                <span class="badge {{ $statusBadges[$task->status]['class'] }}">
                                                                                    {{ $statusBadges[$task->status]['text'] }}
                                                                                    @if($task->status == 'ongoing' && \Carbon\Carbon::parse($task->activity_date)->isToday())
                                                                                    (Today)
                                                                                    @endif
                                                                                </span>
                                                                                @endif
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <!-- Location Details Column -->
                                                            <div class="col-md-6">
                                                                <div class="card h-100 border-0 shadow-sm">
                                                                    <div class="card-header bg-light">
                                                                        <h6 class="mb-0">
                                                                            <i class="fas fa-map-marker-alt me-2"></i>Location Details
                                                                        </h6>
                                                                    </div>
                                                                    <div class="card-body">
                                                                        @if($task->donation_id && $task->donation)
                                                                        <ul class="list-group list-group-flush">
                                                                            <li class="list-group-item">
                                                                                <div class="fw-bold">Pickup Address:</div>
                                                                                <div class="mt-1">{{ $task->donation->pickup_address }}</div>
                                                                            </li>
                                                                            <li class="list-group-item">
                                                                                <div class="fw-bold">Donor Contact:</div>
                                                                                <div class="mt-1">{{ $task->donation->donor->contact ?? 'N/A' }}</div>
                                                                            </li>
                                                                        </ul>
                                                                        @elseif($task->distribution_id && $task->distribution && $task->distribution->location)
                                                                        <ul class="list-group list-group-flush">
                                                                            <li class="list-group-item">
                                                                                <div class="fw-bold">Distribution Location:</div>
                                                                                <div class="mt-1">
                                                                                    @php
                                                                                    $location = $task->distribution->location;
                                                                                    $formattedLocation = $location->region === "NCR"
                                                                                    ? "{$location->barangay}, {$location->city_municipality}, Metro Manila, Philippines"
                                                                                    : "{$location->barangay}, {$location->city_municipality}, {$location->province}, {$location->region}, Philippines";
                                                                                    @endphp
                                                                                    {{ $formattedLocation }}
                                                                                </div>
                                                                            </li>
                                                                        </ul>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- Donation Items Section -->
                                                        @if($task->donation_id && $task->donation)
                                                        <div class="card mt-3 border-0 shadow-sm">
                                                            <div class="card-header bg-light d-flex justify-content-between align-items-center">
                                                                <h6 class="mb-0">
                                                                    <i class="fas fa-boxes me-2"></i>Donation Items
                                                                </h6>
                                                                <span class="text-muted small">(Item • Quantity)</span>
                                                            </div>
                                                            <div class="card-body p-3">
                                                                <div class="row row-cols-1 row-cols-md-2 g-2" style="max-height: 200px; overflow-y: auto;">
                                                                    @foreach($task->donation->donationItems as $item)
                                                                    <div class="col">
                                                                        <div class="border rounded p-2 h-100 d-flex justify-content-between align-items-center">
                                                                            <span class="text-truncate">{{ $item->item }}</span>
                                                                            <span class="badge bg-primary rounded-pill ms-2">{{ $item->quantity }}</span>
                                                                        </div>
                                                                    </div>
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @endif
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                                            <i class="fas fa-times me-1"></i> Close
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
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
    <script src="{{ asset('lib/datatables/datatables.min.js') }}"></script>
    <!-- User JS -->
    <script src="{{ asset('assets/users/js/user.js') }}"></script>
</body>

</html>
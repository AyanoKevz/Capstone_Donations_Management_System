<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!--   Bootstrap -->
  <link rel="icon" href="{{ asset ('assets/img/systemLogo.png') }}" type="image/png">
  <link rel="stylesheet" href="{{ asset('lib/bootstrap/css/bootstrap.min.css') }}">
  <!-- StyleSheet -->
  <link rel="stylesheet" href="{{ asset ('assets/admin/css/admin_login.css') }}">
  <title>Admin Login</title>
</head>

<body>

  <section class="vh-100 login-section">
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col col-xl-10">
          <div class="card login-card">
            <div class="row g-0">
              <div class="col-md-6 col-lg-5 d-none d-md-block container-fluid banner text-center">
                <div class="logo">
                  <img src="{{ asset('assets/img/systemLogo.png') }}" alt="">
                </div>
                <h2>UniAid</h2>
                <p>Community Donations and Resources Distribution</p>
              </div>

              <div class="col-md-6 col-lg-7 d-flex align-items-center">
                <div class="card-body p-4 p-lg-4 text-black">
                  <form action="{{ route('admin.login.submit') }}" method="POST" id="admin-login">
                    @csrf
                    <div class="d-flex align-items-center justify-content-center mb-3 pb-1">
                      <i class="fa-solid fa-user-tie fa-3x" style="color: #000000;"></i>
                      <span class="h1 fw-bold my-2 mx-4">Admin Login</span>
                    </div>
                    @if ($errors->any())
                    <div id="alert-error" class="alert alert-error wow fadeInLeft">
                      @foreach ($errors->all() as $error)
                      <i class="fa-solid fa-circle-xmark me-2"></i> {{ $error }}
                      @endforeach
                    </div>
                    @endif
                    <div class="input-group mb-4">
                      <input type="text" name="username" autocomplete="off" class="input" id="username" required>
                      <label class="user-label" for="username">Username</label>
                    </div>
                    <div class="input-group mb-4">
                      <input type="password" name="password" autocomplete="off" class="input" id="password" required>
                      <button type="button" id="toggle-password" class="btn-toggle">
                        <i class="fas fa-eye" id="toggle-password-icon"></i>
                      </button>
                      <label class="user-label" for="password">Password</label>
                    </div>
                    <div class="pt-1 mb-2 d-grid">
                      <button type="submit" class="btn btn-success">Login</button>
                    </div>
                    <div class="d-flex justify-content-center links">
                      <a class="small text-muted ms-2" href="{{ route('admin.reset_password') }}">Forgot password?</a>
                      <a class="small text-muted ms-2" href="{{ route('home') }}">View Page</a>
                    </div>
                  </form>
                </div>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <script src="{{ asset('lib/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('lib/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('lib/jquery/jquery.validate.min.js') }}"></script>
  <script src="{{ asset('lib/fontawesome/all.js') }}"></script>
  <script src="{{ asset('assets/admin/js/admin.js') }}"></script>
</body>

</html>
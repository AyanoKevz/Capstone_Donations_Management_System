<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="{{ asset ('assets/img/systemLogo.png') }}" type="image/png">
  <!--   Bootstrap -->
  <link rel="stylesheet" href="{{ asset('lib/bootstrap/css/bootstrap.min.css') }}">
  <!-- StyleSheet -->
  <link rel="stylesheet" href="{{ asset ('assets/admin/css/admin_login.css') }}">
  <title>Admin Login</title>
</head>

<body>

  <section class="vh-100 login-section">
    <div class="container h-100">
      <div class="row d-flex justify-content-center align-items-center h-100 flex-wrap">
        <div class="col d-flex justify-content-center">
          <div class="card forgot-card">
            <div class="card-body p-4 p-lg-4 text-black d-flex justify-content-center">
              <form id="admin-login">
                <div class="d-flex align-items-center justify-content-center  mb-2 pb-1 flex-wrap">
                  <img src="{{ asset('assets/img/systemLogo.png') }}" alt="" class="me-3 forgotlogo-icon">
                  <span class="h1 fw-bold mb-1">Find Your Account</span>
                </div>
                <h5 class="fw-normal mb-3 text-center">Enter your email address to search for your account.
                </h5>
                <div class="input-group mb-3">
                  <input type="text" name="email" autocomplete="off" class="input" id="email" required>
                  <label class="user-label" for="email">Email Address</label>
                </div>
            </div>

            <div class="card-footer d-flex justify-content-end mb-2">
              <a class="btn btn-secondary ms-2" href="{{route('admin.login')}}">Cancel</a>
              <button class="btn btn-success ms-2" type="submit">Search</button>
            </div>

            </form>
          </div>
        </div>
      </div>
    </div>
  </section>



  <script src="{{ asset('lib/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('lib/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('lib/jquery/jquery.validate.min.js') }}"></script>
  <script src="{{ asset('assets/admin/js/admin.js') }}"></script>
</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Login - UniAid</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="keywords">
  <meta content="" name="description">
  <!-- Google Web Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Roboto:wght@400;500;700;900&display=swap"
    rel="stylesheet">
  <link rel="icon" href="{{ asset ('assets/img/systemLogo.png') }}" type="image/png">
  <!-- Customized Bootstrap Stylesheet -->
  <link rel="stylesheet" href="{{ asset('lib/bootstrap/css/bootstrap.min.css') }}">
  <!-- Template Stylesheet -->
  <link href="{{ asset('assets/homepage/css/mobile-login.css') }}" rel="stylesheet">
</head>

<body>

  <!-- Spinner Start -->
  <div id="spinner" class="show bg-white position-fixed w-100 vh-100 d-flex flex-column align-items-center justify-content-center">
    <div class="text-center mb-4">
      <h1 class="m-0 fw-bold" style="color: #ff1f1f; font-size:50px;">
        <img src="{{ asset('assets/img/systemLogo.png') }}" class="me-3 w-25" alt="Logo">UniAid
      </h1>
    </div>
    <div class="loader">
      <span class="loader-text">Loading...</span>
    </div>
  </div>
  <!-- Spinner End -->
  <div class="background">
    <div class="wrapper">
      <div class="logo">
        <img src="{{ asset('assets/img/systemLogo.png') }}" alt="">
      </div>
      <div class="text-center mt-4 name">
        UniAid
      </div>
      <p class="mb-0  name fs-6 text-center">
        Community Donations and
        Resources Distribution</p>

      @if (session('error'))
      <div id="alert-error" class="alert alert-error wow fadeInLeft">
        <i class=" fa-solid fa-circle-xmark me-3"></i>{{ session('error') }}
      </div>
      @elseif (session('success'))
      <div id="alert-success" class="alert alert-success wow fadeInLeft">
        <i class=" fa-solid fa-circle-check me-3"></i>{{ session('success') }}
      </div>
      @endif
      <form class="p-3 mt-3" id="login-form" method="POST" action="{{ route('mlogin-submit') }}">
        @csrf
        <div class="form-field d-flex align-items-center">
          <span class="far fa-user"></span>
          <input type="text" name="username" id="username" placeholder="username">
        </div>
        <div class="form-field d-flex align-items-center">
          <span class="fas fa-key"></span>
          <input type="password" name="password" class="password-input" placeholder="Password">
          <button type="button" class="toggle-password">
            <i class="fas fa-eye-slash toggle-password-icon"></i>
          </button>
        </div>
        <button class="btn mt-3" type="submit">Login</button>
      </form>
      <div class="text-center fs-6">
        <a href="#">Forget password? /</a>
        <a href="#" data-bs-target="#register" data-bs-toggle="modal">Register /</a>
        <a href="{{ route('home') }}">Visit Home</a>
      </div>
    </div>
  </div>


  <!--  <div class="modal fade" id="fpass" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content email-modal">
        <div class="card-email">
          <div class="BG">
            <svg
              viewBox="0 0 512 512"
              class="ionicon"
              xmlns="http://www.w3.org/2000/svg">
              <path
                d="M256 176a80 80 0 1080 80 80.24 80.24 0 00-80-80zm172.72 80a165.53 165.53 0 01-1.64 22.34l48.69 38.12a11.59 11.59 0 012.63 14.78l-46.06 79.52a11.64 11.64 0 01-14.14 4.93l-57.25-23a176.56 176.56 0 01-38.82 22.67l-8.56 60.78a11.93 11.93 0 01-11.51 9.86h-92.12a12 12 0 01-11.51-9.53l-8.56-60.78A169.3 169.3 0 01151.05 393L93.8 416a11.64 11.64 0 01-14.14-4.92L33.6 331.57a11.59 11.59 0 012.63-14.78l48.69-38.12A174.58 174.58 0 0183.28 256a165.53 165.53 0 011.64-22.34l-48.69-38.12a11.59 11.59 0 01-2.63-14.78l46.06-79.52a11.64 11.64 0 0114.14-4.93l57.25 23a176.56 176.56 0 0138.82-22.67l8.56-60.78A11.93 11.93 0 01209.94 26h92.12a12 12 0 0111.51 9.53l8.56 60.78A169.3 169.3 0 01361 119l57.2-23a11.64 11.64 0 0114.14 4.92l46.06 79.52a11.59 11.59 0 01-2.63 14.78l-48.69 38.12a174.58 174.58 0 011.64 22.66z"></path>
            </svg>
          </div>
          <div class="content">
            <p class="heading">Forgot Password?</p>
            <p class="sub-heading">Type your email to recover</p>
            <p class="sub-sub-heading m-0">You will recieved an email.</p>
            <form action="{{ route('forgot-password') }}" method="POST" id="forgot_form">
              @csrf
              <input class="email" name="find_email" placeholder="Email" type="email" autocomplete="offs" required />
              <button class="card-email-btn" type="submit">Find Email</button>
              <button type="button" class="back-login" data-bs-toggle="modal"
                data-bs-target="#login">Back</button>
              <button type="button" class="close-forgot" data-bs-dismiss="modal">Close</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div> -->



  <div class="modal fade" id="register" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="radio-input">
          <div class="reg-info">
            <span class="question">Register As?</span>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <a href="{{ route('donor.register') }}" id="value-1" class="reg-link" name="value-radio" value="value-1">
            <label for="value-1"> <i class="fa-solid fa-hand-holding-heart fa-lg me-2"></i> Donor</label>
            <a href="{{ route('vol.register') }}" id="value-2" class="reg-link" name="value-radio" value="value-2">
              <label for="value-2"> <i class="fas fa-users fa-lg me-2"></i> Volunteer</label>
        </div>

      </div>
    </div>
  </div>




  <script src="{{ asset('lib/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('lib/jquery/jquery.validate.min.js') }}"></script>
  <script>
    $('.toggle-password').on('click', function() {
      const passwordInput = $('.password-input');
      const toggleIcon = $('.toggle-password-icon');
      if (passwordInput.attr('type') === 'password') {
        passwordInput.attr('type', 'text');
        toggleIcon.removeClass('fa-eye-slash').addClass('fa-eye');
      } else {
        passwordInput.attr('type', 'password');
        toggleIcon.removeClass('fa-eye').addClass('fa-eye-slash');
      }
    });

    $("#login-form").validate({
      rules: {
        username: {
          required: true,
          minlength: 8
        },
        password: {
          required: true,
          minlength: 8
        }
      },
      messages: {
        username: {
          required: "Please enter a username",
          minlength: "Username must be at least 8 characters long"
        },
        password: {
          required: "Please provide a password",
          minlength: "Password must be at least 8 characters long"
        }
      },
      highlight: function(element) {
        $(element).addClass('is-invalid').removeClass('is-valid');
      },
      unhighlight: function(element) {
        $(element).addClass('is-valid').removeClass('is-invalid');
      },
      errorPlacement: function(error, element) {
        error.insertAfter(element);
      },
      submitHandler: function(form) {
        form.submit();
      }
    });
  </script>
  <script src="{{ asset('lib/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('lib/fontawesome/all.js') }}"></script>

  <!-- Template JavaScript -->
  <script src="{{ asset('assets/homepage/js/main.js') }}"></script>

</body>

</html>
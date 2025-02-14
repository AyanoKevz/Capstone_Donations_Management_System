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
        <a href="{{ route('home') }}">Visit Home</a>
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
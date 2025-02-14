<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>UniAid | User Reset Password</title>
  <link rel="icon" href="{{ asset ('assets/img/systemLogo.png') }}" type="image/png">
  <link rel="stylesheet" href="{{ asset('lib/bootstrap/css/bootstrap.min.css') }}">
  <style>
    @import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap');

    input {
      border-radius: 5px;
      border: 1px solid #aaa !important;
    }

    input:focus {
      outline: none;
      box-shadow: none !important;
      border: 1.5px solid #1a73e8 !important;
    }

    input.is-valid,
    select.is-valid {
      border: 1.5px solid #06b400 !important;
    }

    input.is-invalid,
    select.is-invalid {
      border: 1.5px solid #ff0000 !important;
    }

    .error {
      color: red !important;
      font-size: 12px !important;
      font-weight: 500;
      margin: 0;
      position: absolute;
      top: 100%;
      width: 100%;
      text-align: center;
    }

    #password-error,
    #cpassword-error {
      position: static;
      margin-top: 10px;
    }

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Poppins', sans-serif;
    }

    html,
    body {
      display: grid;
      height: 100%;
      width: 100%;
      place-items: center;
      background: #f2f2f2;
    }

    .wrapper {
      width: 380px;
      background: #fff;
      border-radius: 15px;
      box-shadow: 0px 15px 20px rgba(0, 0, 0, 0.1);
    }

    .wrapper .title {
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 24px;
      font-weight: 600;
      line-height: 50px;
      color: #fff;
      user-select: none;
      border-radius: 15px 15px 0 0;
      background: #b92f2f;
      padding: 10px;
    }

    .wrapper .title .logo {
      width: 40px;
      height: 40px;
      margin-right: 10px;
    }

    .wrapper form {
      padding: 30px;
    }

    .wrapper form .field {
      height: 50px;
      width: 100%;
      margin: 10px 0 40px 0;
      position: relative;
    }

    .wrapper form .field input {
      height: 100%;
      width: 100%;
      outline: none;
      font-size: 17px;
      padding-left: 20px;
      border: 1px solid lightgrey;
      border-radius: 25px;
      transition: all 0.3s ease;
      padding-right: 50px;
      /* Space for the button */
    }

    .wrapper form .field input:focus,
    .wrapper form .field input:valid {
      border-color: #4158d0;
    }

    .wrapper form .field label {
      position: absolute;
      top: 50%;
      left: 20px;
      color: #999999;
      font-weight: 400;
      font-size: 17px;
      pointer-events: none;
      transform: translateY(-50%);
      transition: all 0.3s ease;
    }

    .wrapper form .field input:focus~label,
    .wrapper form .field input:valid~label {
      top: -10px;
      font-size: 12px;
      color: #4158d0;
      background: #fff;
      padding: 0 5px;
    }

    .wrapper form .field button {
      border: none;
      color: #ff1f1f;
      background: #fff;
      top: 50%;
      right: 10px;
      transform: translateY(-50%);
      position: absolute;
      cursor: pointer;
      transition: color 0.3s ease;
    }

    .wrapper form .field button:hover {
      color: #4158d0;
    }

    .wrapper form .w-100 button {
      height: 50px;
      font-size: 18px;
      border-radius: 25px;
      background: #ff1f1f;
      color: #fff;
      border: none;
      transition: all 0.3s ease;
    }

    .wrapper form .w-100 button:hover {
      color: #ff1f1f;
      background: #fff;
    }

    .wrapper form .w-100 button:active {
      transform: scale(0.95);
    }

    .container-fluid {
      width: 100%;
      height: 100%;
      --color: #E1E1E1;
      background-color: #F3F3F3;
      background-image: linear-gradient(0deg, transparent 24%, var(--color) 25%, var(--color) 26%, transparent 27%, transparent 74%, var(--color) 75%, var(--color) 76%, transparent 77%, transparent),
        linear-gradient(90deg, transparent 24%, var(--color) 25%, var(--color) 26%, transparent 27%, transparent 74%, var(--color) 75%, var(--color) 76%, transparent 77%, transparent);
      background-size: 55px 55px;
      display: flex;
      align-items: center;
      justify-content: center;

    }

    #expiredMessage {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      color: red;
      font-weight: bold;
      width: 100%;
    }
  </style>
</head>

<body>
  <div class="container-fluid">
    <div class="wrapper">
      <div id="formContent">
        <div class="title">
          <img src="{{ asset('assets/img/systemLogo.png') }}" alt="Logo" class="logo">
          Change Password
        </div>
        <form action="{{ route('reset-password.submit') }}" method="POST" id="forgot_form">
          @csrf
          <div id="timer" class="text-center mb-4">
            <p>This link will expire in <strong id="countdown" class="text-danger"></strong></p>
          </div>

          <input type="hidden" name="token" value="{{ $token }}">
          <div class="field position-relative">
            <input type="password" name="password" id="password" class="form-control" required>
            <label>New Password</label>
            <button class="btn btn-outline-secondary position-absolute" type="button" id="toggle-password">
              <i class="fas fa-eye" id="toggle-password-icon"></i>
            </button>
          </div>
          <div class="field position-relative">
            <input type="password" name="cpassword" id="cpassword" class="form-control" required>
            <label>Confirm New Password</label>
            <button class="btn btn-outline-secondary position-absolute" type="button" id="toggle-cpassword">
              <i class="fas fa-eye" id="toggle-cpassword-icon"></i>
            </button>
          </div>
          <div class="w-100 text-center">
            <button type="submit" name="submit" class="btn btn-primary w-100">Submit</button>
          </div>
        </form>
      </div>
    </div>
    <!-- Expired Link Message -->
    <div id="expiredMessage" style="display:none;" class="text-center">
      <h2>Link Expired</h2>
    </div>
  </div>
  <script src="{{ asset('lib/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('lib/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('lib/fontawesome/all.js') }}"></script>
  <script src="{{ asset('lib/jquery/jquery.validate.min.js') }}"></script>



  <script>
    // Toggle password visibility for password
    $('#toggle-password').on('click', function() {
      const passwordInput = $('#password');
      const toggleIcon = $('#toggle-password-icon');
      if (passwordInput.attr('type') === 'password') {
        passwordInput.attr('type', 'text');
        toggleIcon.removeClass('fa-eye').addClass('fa-eye-slash');
      } else {
        passwordInput.attr('type', 'password');
        toggleIcon.removeClass('fa-eye-slash').addClass('fa-eye');
      }
    });

    // Toggle password visibility for confirm password
    $('#toggle-cpassword').on('click', function() {
      const cpasswordInput = $('#cpassword');
      const toggleIcon = $('#toggle-cpassword-icon');
      if (cpasswordInput.attr('type') === 'password') {
        cpasswordInput.attr('type', 'text');
        toggleIcon.removeClass('fa-eye').addClass('fa-eye-slash');
      } else {
        cpasswordInput.attr('type', 'password');
        toggleIcon.removeClass('fa-eye-slash').addClass('fa-eye');
      }
    });

    // Form validation
    $("#forgot_form").validate({
      rules: {
        password: {
          required: true,
          minlength: 8
        },
        cpassword: {
          required: true,
          equalTo: "#password"
        },
      },
      messages: {
        password: {
          required: "Please enter a password",
          minlength: "Your password must be at least 8 characters long"
        },
        cpassword: {
          required: "Please confirm your password",
          equalTo: "Passwords do not match"
        },
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

    let remainingTime = @json($remainingTime);
    const countdownElement = document.getElementById('countdown');
    const content = document.getElementById('formContent');
    const expiredMessage = document.getElementById('expiredMessage');

    function updateCountdown() {
      if (remainingTime > 0) {
        const minutes = Math.floor(remainingTime / 60);
        const seconds = Math.floor(remainingTime % 60);
        countdownElement.textContent = `${minutes}m ${seconds}s`;
        remainingTime--;
        setTimeout(updateCountdown, 1000);
      } else {
        content.style.display = 'none';
        expiredMessage.style.display = 'block';
        setTimeout(() => {
          location.reload();
        }, 3000);
      }
    }

    updateCountdown();
  </script>

</body>

</html>
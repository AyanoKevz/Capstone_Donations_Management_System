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
          <div class="card forgot-card" id="forgot-card">
            <div class="card-body p-4 p-lg-4 text-black d-flex justify-content-center">
              <form id="admin-login" action="{{ route('admin.resetPassword') }}" method="POST">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">
                <div class="d-flex align-items-center justify-content-center  mb-2 pb-1 flex-wrap">
                  <img src="{{ asset('assets/img/systemLogo.png') }}" alt="" class="me-3 forgotlogo-icon">
                  <span class="h1 fw-bold mb-1">New Password</span>
                </div>
                 <div id="timer" class="text-center mb-2">
                  <p>This link will expire in <strong id="countdown" class="text-danger"></strong></p>
                </div>
                <h5 class="fw-normal mb-3 text-center">Please enter a new password.
                </h5>
                <div class="input-group mb-5">
                  <input type="password" name="password" autocomplete="off" class="input" id="password" required>
                  <button type="button" id="toggle-password" class="btn-toggle">
                    <i class="fas fa-eye" id="toggle-password-icon"></i>
                  </button>
                  <label class="user-label" for="password">New Password</label>
                </div>
                <div class="input-group mb-4">
                  <input type="password" name="cpassword" autocomplete="off" class="input" id="cpassword" required>
                  <button type="button" id="toggle-cpassword" class="btn-toggle">
                    <i class="fas fa-eye" id="toggle-cpassword-icon"></i>
                  </button>
                  <label class="user-label" for="cpassword">Confirm Password</label>
                </div>
            </div>
            <div class="card-footer d-flex justify-content-end mb-2">
              <a class="btn btn-secondary ms-2" href="{{route('admin.login')}}">Cancel</a>
              <button class="btn btn-success ms-2" type="submit">Submit</button>
            </div>
            </form>
          </div>
            <div id="expiredMessage" style="display:none;">
            <h2 class="text-white fw-semibold">Link Expired</h2>
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

<script>
let remainingTime = @json($remainingTime);
const countdownElement = document.getElementById('countdown');
const content = document.getElementById('forgot-card');
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
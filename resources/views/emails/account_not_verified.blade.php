<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Account Verification Failed</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
    }

    .email-body {
      padding: 20px;
      background-color: #f4f4f9;
    }

    .container {
      border-radius: 12px;
      max-width: 700px;
      margin: auto;
      overflow: hidden;
      background-color: #ffffff;
      box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.1);
    }

    .navbar {
      background-color: #b92f2f;
      color: white;
      padding: 15px 20px;
      text-align: center;
    }

    .navbar img {
      height: 50px;
      vertical-align: middle;
      margin-right: 10px;
      width: auto;
    }

    .navbar h1 {
      display: inline;
      font-size: 28px;
      margin: 0;
      vertical-align: middle;
    }

    .card {
      padding: 30px;
      text-align: center;
    }

    .card h1 {
      font-size: 24px;
      margin: 0 0 10px;
      color: #333;
    }

    .card p {
      font-size: 16px;
      margin: 0 0 20px;
      color: #555;
    }


    .footer {
      background-color: #212529;
      color: white;
      text-align: center;
      padding: 10px;
      font-size: 14px;
    }

    .footer a {
      color: #007bff;
      text-decoration: none;
    }

    .footer a:hover {
      text-decoration: underline;
    }
  </style>
</head>

<body>

  <div class="email-body">
    <!-- Main Container -->
    <div class="container">
      <!-- Navbar -->
      <div class="navbar">
        <img src="{{ $message->embed($logoPath) }}" alt="Logo">
        <h1>UniAid</h1>
      </div>

      <!-- Card Body -->
      <div class="card">
        <h1>Account Verification Failed</h1>
        <p>Unfortunately, we were unable to verify your account due to unmatched credentials submitted during registration.</p>
        <p>If you believe this is an error, please contact our support team.</p>
      </div>

      <!-- Footer -->
      <div class="footer">
        <p>&copy; 2024 UniAid. All Rights Reserved. <a href="{{ route('home') }}">Visit our website</a></p>
      </div>
    </div>
  </div>

</body>

</html>
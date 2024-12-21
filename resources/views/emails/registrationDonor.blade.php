<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Email Template</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
    }

    .email-body {
      padding: 20px;
      background-color: #e3e3e3;
    }

    .container {
      border-radius: 12px;
      max-width: 700px;
      margin: auto;
      overflow: hidden;
    }

    .navbar {
      background-color: #b92f2f;
      color: white;
      padding: 10px 20px;
      text-align: center;
    }

    .navbar img {
      height: 55px;
      vertical-align: middle;
      margin-right: 10px;
      width: 60px;
    }

    .navbar h1 {
      display: inline;
      font-size: 24px;
      margin: 0;
    }

    .card {
      background-color: #ffffff;
      border-radius: 10px;
      box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
      margin: 20px auto;
      max-width: 600px;
      padding: 20px;
      text-align: center;
    }

    .card h1 {
      margin-top: 0;
      font-size: 24px;
      color: #333;
    }

    .card p {
      font-size: 16px;
      line-height: 1.6;
      color: #555;
      margin: 10px 0;
    }

    .container-body {
      background-color: #1b2a5f;
      color: white;
      padding: 25px;
      text-align: center;
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

    .button {
      background-color: #b92f2f;
      color: white !important;
      text-decoration: none;
      padding: 10px 20px;
      border-radius: 5px;
      font-size: 16px;
      display: inline-block;
    }

    .button a {
      color: white !important;
    }

    .button:hover {
      background-color: #9f2727;
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
      <div class="container-body">
        <div class="card">
          <h1>Welcome to UniAid, {{ $username }}!</h1>
          <p>Thank you for registering as a <b>{{ $role }}</b>. We're thrilled to have you as part of our community!</p>
          <p> You can now login and access the {{ $role }} portal. Thank you for joining us!</p>
          <a href="{{ route('home') }}" class="button">Get Started</a>
        </div>
      </div>

      <!-- Footer -->
      <div class="footer">
        <p>&copy; 2024 UniAid. All Rights Reserved. <a href="{{ route('home') }}">Visit our website</a></p>
      </div>
    </div>
  </div>

</body>

</html>
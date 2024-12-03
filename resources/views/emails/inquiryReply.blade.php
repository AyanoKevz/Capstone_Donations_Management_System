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
      background-color: #fff;
      padding: 20px;
      text-align: center;
      border-radius: 8px;
      width: 400px;
      border: 1px solid black;
      margin: auto;
    }

    .container-body {
      background-color: #1b2a5f;
      padding: 25px;
    }

    .card h2 {
      margin-top: 0;
      color: #333;
    }

    .card p {
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
          <h2>Dear {{ $inquiry -> name }},</h2>
          <p>{!! $messageContent !!}</p>
        </div>
      </div>

      <!-- Footer -->
      <div class="footer">
        <p>&copy; 2024 Your Company. All Rights Reserved. <a href="{{route ('home') }}">Visit our website</a> </p>
      </div>
    </div>
  </div>

</body>

</html>
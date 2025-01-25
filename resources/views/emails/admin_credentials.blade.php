<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Account Verified</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
    }

    .email-body {
      padding: 20px;
      background: #f4f4f9;
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
      font-size: 27px;
      margin: 0 0 10px;
      color: #333;
    }

    .card p {
      font-size: 16px;
      margin: 20px 0;
      color: #555;
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

    ul {
      margin: 0;
      padding: 0;
      list-style-type: none;
    }

    li {
      margin: 0;
      padding: 0;
    }
  </style>
</head>

<body>

  <div class="email-body">
    <!-- Main Container -->
    <div class="container">
      <!-- Navbar -->
      <div class="navbar">
        <img src="{{ $message->embed($logoPath) }}" alt="System Logo">
        <h1>UniAid</h1>
      </div>

      <!-- Card Body -->
      <div class="card">
        <h2>Welcome to UniAid, {{ $name }}!</h2>
        <p>Your admin account has been created successfully. Below are your credentials:</p>
        <ul>
          <li><strong>Username:</strong> {{ $username }}</li>
          <li><strong>Password:</strong> {{ $password }}</li>
        </ul>
        <p><strong>Note:</strong> Please log in and change your username and password immediately for security purposes.</p>
        <p>Thank you!</p>
      </div>
      <!-- Footer -->
      <div class="footer">
        <p>&copy; 2024 UniAid. All Rights Reserved. <a href="{{ route('home') }}">Visit our website</a></p>
      </div>
    </div>
  </div>

</body>

</html>
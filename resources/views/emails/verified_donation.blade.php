<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Account Verification Failed</title>
  <style>
    /* General Styles */
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f4f4f9;
      color: #333;
      line-height: 1.6;
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
      box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.1);
    }

    /* Navbar Styles */
    .navbar {
      background-color: #b92f2f;
      color: white;
      padding: 20px;
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
      font-weight: bold;
    }

    /* Card Styles */
    .card {
      padding: 30px;
      text-align: center;
    }

    .card h1 {
      font-size: 24px;
      margin: 0 0 15px;
      color: #333;
      font-weight: bold;
    }

    .card p {
      font-size: 16px;
      margin: 0 0 20px;
    }

    /* Receipt Styles */
    .receipt {
      max-width: 100%;
      background: #b92f2f;
      border: 2px dashed #ccc;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      margin: 0 auto;
      color: white;
    }

    .shop-name {
      font-size: 1.5rem;
      font-weight: bold;
      margin-bottom: 15px;
      color: white;
    }

    .info {
      font-size: 0.9rem;
      margin-bottom: 20px;
      color: white;
      line-height: 1.4;
    }

    .receipt table {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 20px;
      font-size: 0.9rem;
      background: white;
      color: #333;
    }

    .receipt table th {
      font-weight: bold;
      background-color: #f8f9fa;
      color: #333;
      padding: 10px;
    }

    .receipt table td {
      padding: 10px;
      text-align: center;
      border-bottom: 1px solid #eee;
    }

    .total {
      font-size: 1.1rem;
      font-weight: bold;
      margin-bottom: 20px;
      color: white;
    }

    .thanks {
      font-size: 0.9rem;
      color: white !important;
      margin-top: 15px;
      font-style: italic;
    }

    /* Footer Styles */
    .footer {
      background-color: #212529;
      color: white;
      text-align: center;
      padding: 15px;
      font-size: 14px;
    }

    .footer a {
      color: #007bff;
      text-decoration: none;
      transition: color 0.3s ease;
    }

    .footer a:hover {
      color: #0056b3;
      text-decoration: underline;
    }

    .receipt-logo {
      width: 60px;
      height: auto;
      margin-bottom: 10px;
      display: block;
      margin-left: auto;
      margin-right: auto;
    }

    .message {
      color: black;
    }

    /* Responsive Styles */
    @media (max-width: 600px) {
      .navbar h1 {
        font-size: 24px;
      }

      .card {
        padding: 20px;
      }

      .receipt {
        max-width: 100%;
        padding: 15px;
      }

      .receipt table {
        font-size: 0.8rem;
      }

      .receipt table th,
      .receipt table td {
        padding: 8px;
      }

      .shop-name {
        font-size: 1.2rem;
      }

      .info {
        font-size: 0.8rem;
      }

      .total {
        font-size: 1rem;
      }

      .thanks {
        font-size: 0.8rem;
      }
    }

    @media (max-width: 400px) {
      .receipt table {
        display: block;
        overflow-x: auto;
        white-space: nowrap;
      }

      .receipt table th,
      .receipt table td {
        white-space: nowrap;
      }
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
        <div class="message">
          <p>{{ $emailMessage }}</p> <!-- Updated variable name -->
        </div>
        <div class="receipt text-center">
          <!-- Add the logo here -->
          <img src="{{ $message->embed($logoPath) }}" alt="UniAid Logo" class="receipt-logo">
          <p class="shop-name">UniAid</p>
          <p class="info">
            Community Donations and Resources Distribution<br />
            Date: {{ now()->format('m/d/Y') }}<br />
            Time: {{ now()->format('h:i A') }}
          </p>

          <h4 class="my-3">Donation Details:</h4>
          @if($type === 'cash')
          <!-- Cash Donation Details -->
          <div style="background-color: #ffffff; padding: 4px;">
            <p style="margin: 0; color: black;"><strong>Amount:</strong> ₱{{ number_format($donation->amount, 2) }}</p>
          </div>
          @else
          <!-- In-Kind Donation Details -->
          <div class="table-responsive">
            <table class="table table-borderless">
              <thead>
                <tr>
                  <th>Category</th>
                  <th>Item</th>
                  <th>Quantity</th>
                </tr>
              </thead>
              <tbody>
                @foreach($donationItems as $item)
                <tr>
                  <td>{{ $item->category }}</td>
                  <td>{{ $item->item }}</td>
                  <td>{{ $item->quantity }}</td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
          @endif

          <p class="thanks">Thank you for your donation!</p>
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
<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="title" content="InfyBonus">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="manifest" href="{{ asset('manifest.json') }}">
    <link rel="stylesheet" href="{{ asset('lib/bootstrap/css/bootstrap.min.css') }}">

    <style>
        * {
            border: 0;
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            display: flex;
            height: 100vh;
            background: linear-gradient(135deg, #b92f2f, #1B2A5F);
            font-family: 'Arial', sans-serif;
            color: #fff;
        }

        .container-fluid {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 15px;
            padding: 2rem;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(10px);
        }

        h1 {
            color: #fff;
            font-size: 3.5rem;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
        }

        h2 {
            color: #fff;
            font-size: 2rem;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
        }

        .fa-heart {
            animation: float 3s ease-in-out infinite;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(10px);
            }
        }
    </style>
</head>

<body>
    <div class="container-fluid d-flex flex-column align-items-center justify-content-center">
        <div class="text-center mb-4">
            <h1 class="m-0 fw-bold">
                <img src="assets/img/systemLogo.png" class="me-3" alt="Logo" style="width: 80px;">UniAid
            </h1>
        </div>

        <h2 class="fw-bold text-center">
            Thank You For Installing UniAid! <br> <i class="fa-solid fa-heart fa-2xl" style="color:rgb(248, 16, 16);"></i>
        </h2>
        <p class="text-center fw-semibold">Let’s unite to share resources and support those in need.</p>
    </div>

    <script src=" {{ asset('lib/fontawesome/all.js') }}">
    </script>
    <script src="{{ asset('lib/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>
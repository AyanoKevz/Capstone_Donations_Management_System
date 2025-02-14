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
        }

        .btn.btn-primary {
            color: #fff;
            border: none;
            background: #ff1f1f;
        }

        .btn.btn-primary:hover {
            color: #ff1f1f;
            background: #fff;
        }


        /* From Uiverse.io by Artahs */
        .card {
            position: relative;
            width: 190px;
            height: 254px;
            background-color: #fff;
            border-radius: 20px;
            overflow: hidden;
        }

        .top-card {
            border-top-left-radius: 20px;
            border-top-right-radius: 20px;
            height: 65%;
            transition: height 0.3s ease;
        }

        .bottom-card {
            border-top-right-radius: 20px;
            border-bottom-left-radius: 20px;
            border-bottom-right-radius: 20px;
            height: 35%;
            transition: height 0.3s ease;
            background-color: #b92f2f;
        }

        .bottom-card::before {
            content: "";
            position: absolute;
            background-color: transparent;
            bottom: 89px;
            height: 50px;
            width: 175px;
            transition: bottom 0.3s ease;
            border-bottom-left-radius: 20px;
            box-shadow: 0 30px 0 0 #b92f2f;
        }

        .card-content {
            padding-top: 13%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: #fff;
        }

        .card-title {
            font-weight: 700;
            font-size: 18px;
        }

        .card-txt {
            font-size: 14px;
        }

        .card-btn {
            font-size: 13px;
            text-decoration: none;
            color: white;
            background-color: #ff1f1f;
            border: solid 2px #ff1f1f;
            border-radius: 15px;
            padding: 5%;
        }

        .card:hover {
            box-shadow: 0px 2px 2px #131b39c4;
            border: solid 3px #1B2A5F;
        }

        .card:hover .top-card {
            height: 35%;
            transition: height 0.3s ease;
        }

        .card:hover .bottom-card {
            height: 65%;
            transition: height 0.3s ease;
        }

        .card:hover .bottom-card::before {
            bottom: 164px;
            transition: bottom 0.3s ease;
        }

        .card-btn:hover {
            color: black;
            background-color: #fff;
            transition: background-color 0.4s ease;
        }

        .install-modal {
            background: transparent;
            border: none;
            align-items: center;
        }
    </style>
</head>

<body>
    <div class="container-fluid d-flex flex-column align-items-center justify-content-center">
        <div class="text-center mb-4">
            <h1 class="m-0 fw-bold" style="color: #ff1f1f; font-size:50px;">
                <img src="assets/img/systemLogo.png" class="me-3 w-25" alt="Logo">UniAid
            </h1>
        </div>
        <p class="fw-bold text-center">Install the app from your devices for easy access.</p>
        <div>
            <button id="cancelBtn" class="btn btn-secondary rounded-pill">Cancel</button>
            <button class="btn btn-primary rounded-pill" data-bs-target="#install" data-bs-toggle="modal">Install
                App</button>
        </div>

        <!--    Modal -->
        <div class="modal fade" id="install" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content install-modal">
                    <div class="card">
                        <div class="top-card">
                            <div class="d-flex align-items-center justify-content-center w-100 overflow-hidden py-2">
                                <img src="assets/img/systemLogo.png" class="w-75 h-75 object-fit-cover" alt="Logo">
                            </div>
                        </div>
                        <div class="bottom-card">
                            <div class="card-content">
                                <span class="card-title">UniAid</span>
                                <p class="card-txt">Install UniAid?</p>
                                <button id="installbtn" class="card-btn">Install</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="{{ asset('lib/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script>
        let deferredPrompt;

        window.addEventListener('beforeinstallprompt', (e) => {
            e.preventDefault();
            deferredPrompt = e;
        });


        document.getElementById('installbtn').addEventListener('click', (e) => {
            if (deferredPrompt) {
                deferredPrompt.prompt();

                deferredPrompt.userChoice.then((choiceResult) => {
                    if (choiceResult.outcome === 'accepted') {
                        localStorage.setItem("appInstalled", "true");
                        window.location.href = "/thankyou-install";
                    }
                    deferredPrompt = null;
                });
            }
        });

        document.getElementById('cancelBtn').addEventListener('click', (e) => {
            localStorage.setItem("installDismissed", "true");
            if (window.close) {
                window.close();
            } else {
                window.location.href = "/";
            }
        });
    </script>
</body>

</html>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Becademy</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        #full {
            height: 100vh;
            width: 100vw;
        }
        .container {
            height: 100%;
            width: 100%;
        }
        .brand-medium {
            height: 2rem;
        }
    </style>
  </head>
  <body>
    <div id="full">
        <div class="container d-flex">
            <div class="row my-auto mx-auto">
                <div class="col-12 text-center card">
                    <div class="card-body p-5">
                        <i class="fa-regular fa-face-sad-tear fa-shake display-1 text-danger"></i>
                        <h1>Wrong credential</h1>
                        <p>Make sure you use the button or link in your email inbox</p>
                        <p>Or <a href="{{ url('/email/verify/resend') }}">click here</a> to resent your verification email</p>
                        <img src="{{ url('/assets/brand/logo-text.png') }}" alt="Becademy Logo" class="brand-medium mt-5">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://kit.fontawesome.com/876b175893.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
  </body>
</html>
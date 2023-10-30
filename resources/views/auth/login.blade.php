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
    <div id="full" class="bg-primary">
        <div class="container d-flex">
            <div class="row my-auto mx-auto">
                <div class="col-12 text-start card">
                    <div class="card-body p-4">
                        <h1>Login</h1>
                        <?php
                            if ($errors->all() != null) {
                                echo '<div class="alert alert-danger" role="alert">
                                    Wrong credentials!
                                </div>';
                            }
                        ?>
                        <p>Fill form below with your credential</p>
                        <form action="{{ url('/login/authenticate') }}" method="post">
                            @csrf
                            <div class="mb-2">
                                <label for="email">Email</label>
                                <input type="text" name="email" id="email" class="form-control" placeholder="yours@email.com">
                            </div>
                            <div class="mb-2">
                                <label for="password">Password</label>
                                <input type="password" name="password" id="password" class="form-control" placeholder="your password">
                            </div>
                            <button type="submit" class="btn btn-primary w-100 mb-2">Login</button>
                            <p>You don't have an account? <a href="{{ url('/register') }}">Register here</a></p>
                        </form>
                        <div class="row">
                            <div class="col-12 text-center">
                                <img src="{{ url('/assets/brand/logo-text.png') }}" alt="Becademy Logo" class="brand-medium mt-5">
                            </div>
                        </div>
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
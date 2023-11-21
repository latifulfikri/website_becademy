<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    {{-- Bootstrap CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    {{-- Bootstrap Icons --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    {{-- Cutom CSS --}}
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

</head>

<body>
    <nav class="navbar navbar-expand-lg py-3 sticky-top bg-white">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="{{ asset('assets/brand/logo.png') }}" alt="becademy-logo" class="img-fluid">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <div class="navbar-nav ms-auto me-auto mb-2 mb-lg-0">
                    <a class="nav-link mx-3" href="/">Beranda</a>
                    <a class="nav-link mx-3" href="#">Kelas</a>
                    <a class="nav-link mx-3" href="#">Hubungi Kami</a>
                </div>
                <button type="button" class="btn button-primary px-3 py-2">Mulai Belajar</button>
            </div>
        </div>
    </nav>

    @yield('content')

    <div class="footer container-fluid row px-3 py-5 m-0 d-flex justify-content-center">
        <div class="col-lg-3 col-md-12 d-flex flex-column justify-content-center py-3">
            <img src="{{ asset('assets/brand/logo-text-white.png') }}" class="img-fluid" alt="logo-becademy">
            <h6>Since 2023</h6>
        </div>
        <div class="col-lg-4 col-md-6 d-flex flex-column justify-content-center py-3">
            <h2>Tentang becademy</h2>
            <p>Araya, Tirtomoyo, Malang, Jawa Timur, Indonesia</p>
            <span>
                <button type="button" class="btn button-secondary px-3 py-2">Chat Whatsapp</button>
            </span>
        </div>
        <div class="col-lg-5 col-md-6 d-flex flex-column justify-content-center py-3">
            <h2>Dapatkan promo menarik</h2>
            <p>Cukup ketik email mu disini dan dapatkan penawaran promo menarik</p>
            <div class="input-group">
                <input type="text" class="form-control" aria-label="Recipient's username"
                    aria-describedby="button-addon2">
                <button class="btn" type="button" id="button-addon2">Button</button>
            </div>
        </div>
    </div>

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>

    {{-- Custom JS --}}
    <script src="{{ asset('js/index.js') }}"></script>

</body>

</html>

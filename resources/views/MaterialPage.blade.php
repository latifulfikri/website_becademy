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

    {{-- Title Header --}}
    <div class="container-fluid py-3 module-title">
        <div class="row container">
            <div class="col-1 d-flex justify-content-center">
                <i class="bi bi-arrow-left"></i>
            </div>
            <div class="col-10 d-flex justify-content-center">
                <h5>Dasar pemrograman menggunakan bahasa C</h5>
            </div>
            <div class="col-1 d-flex justify-content-center">
                <button class="navbar-toggler d-md-none collapsed" type="button" data-bs-toggle="offcanvas"
                    data-bs-target="#offcanvasWithBothOptions" aria-controls="offcanvasWithBothOptions">
                    <i class="bi bi-list"></i>
                </button>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">

            {{-- Main --}}
            <main class="col-md-8 col-lg-9">
                <div class="container pt-3">
                    <h1>Title</h1>
                    <div class="container d-flex justify-content-center my-3">
                        <iframe width="560" height="315"
                            class=""
                            src="https://www.youtube.com/embed/fkIvmfqX-t0?si=uV98dA8lBhjttzqY"
                            title="YouTube video player" frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            allowfullscreen></iframe>
                    </div>
                    <div class="container">
                        <h1>Requirement</h1>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Odit corporis recusandae
                            voluptatibus ducimus facere adipisci natus repellat voluptates molestias in est aspernatur
                            soluta, obcaecati nisi facilis deserunt voluptatum inventore libero. Temporibus, rem aut?
                            Adipisci aspernatur tempore a possimus. Eveniet blanditiis quaerat nostrum aspernatur aut
                            quae placeat. Eligendi, culpa. Tenetur, similique?</p>
                        <ul>
                            <li>First</li>
                            <li>Second</li>
                            <li>Third</li>
                        </ul>
                        <h1>Requirement</h1>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Odit corporis recusandae
                            voluptatibus ducimus facere adipisci natus repellat voluptates molestias in est aspernatur
                            soluta, obcaecati nisi facilis deserunt voluptatum inventore libero. Temporibus, rem aut?
                            Adipisci aspernatur tempore a possimus. Eveniet blanditiis quaerat nostrum aspernatur aut
                            quae placeat. Eligendi, culpa. Tenetur, similique?</p>
                    </div>
                </div>
            </main>

            {{-- SideNav --}}
            <nav class="col-md-4 col-lg-3 d-md-block collapse">
                <div class="position-sticky pt-3 d-flex flex-column justify-content-between h-100">
                    <button type="button" class="btn button-primary">Buka discord server</button>
                    @for ($i = 1; $i <= 3; $i++)
                        <ul class="mt-3 p-0">
                            <h6 class="mb-3">Pengenalan dan Persiapan</h6>
                            <li class="nav-items d-flex">
                                <div class="col-2">
                                    <i class="bi bi-play-circle-fill"></i>
                                </div>
                                <div class="col-10">
                                    <a href="#" class="nav-link">Apa itu Algoritma?</a>
                                </div>
                            </li>
                            <li class="nav-items d-flex">
                                <div class="col-2">
                                    <i class="bi bi-play-circle-fill"></i>
                                </div>
                                <div class="col-10">
                                    <a href="#" class="nav-link">Apa itu Algoritma?</a>
                                </div>
                            </li>
                            <li class="nav-items d-flex">
                                <div class="col-2">
                                    <i class="bi bi-play-circle-fill"></i>
                                </div>
                                <div class="col-10">
                                    <a href="#" class="nav-link">Apa itu Algoritma?</a>
                                </div>
                            </li>
                        </ul>
                    @endfor
                </div>
            </nav>

            <nav class="offcanvas offcanvas-end" data-bs-scroll="true" tabindex="-1" id="offcanvasWithBothOptions"
                aria-labelledby="offcanvasWithBothOptionsLabel">
                <div class="offcanvas-header d-flex justify-content-end">
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body d-flex flex-column align-items-center">
                    <button type="button" class="btn button-primary">Buka discord server</button>
                    @for ($i = 1; $i <= 3; $i++)
                        <ul class="mt-3 p-0">
                            <h6 class="mb-3">Pengenalan dan Persiapan</h6>
                            <li class="nav-items d-flex">
                                <div class="col-2">
                                    <i class="bi bi-play-circle-fill"></i>
                                </div>
                                <div class="col-10">
                                    <a href="#" class="nav-link">Apa itu Algoritma?</a>
                                </div>
                            </li>
                            <li class="nav-items d-flex">
                                <div class="col-2">
                                    <i class="bi bi-play-circle-fill"></i>
                                </div>
                                <div class="col-10">
                                    <a href="#" class="nav-link">Apa itu Algoritma?</a>
                                </div>
                            </li>
                            <li class="nav-items d-flex">
                                <div class="col-2">
                                    <i class="bi bi-play-circle-fill"></i>
                                </div>
                                <div class="col-10">
                                    <a href="#" class="nav-link">Apa itu Algoritma?</a>
                                </div>
                            </li>
                        </ul>
                    @endfor
                </div>
            </nav>

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

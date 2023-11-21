@extends('layouts.LandingPageTemplate')

@section('content')
    <div class="beranda-view mt-5 d-flex flex-column align-items-center justify-content-center">

        <!-- Hero -->
        <div class="row container hero">
            <div class="col-12 text-center my-3">
                <h1>Mau jadi jago ngoding? <br> ya belajar di sini </h1>
            </div>
            <div class="col-lg-3 col-md-2 col-1"></div>
            <div class="col-lg-6 col-md-8 col-10 text-center my-3">
                <p>Kelas berisi modul lengkap dengan video pembelajaran dan sesi belajar bareng tiap minggu biar makin jago
                </p>
            </div>
            <div class="col-lg-3 col-md-2 col-1"></div>
            <div class="col-12 col-sm-6 d-flex justify-content-sm-end justify-content-center my-1">
                <button type="button" class="btn button-primary px-3 py-2">Coba gratis</button>
            </div>
            <div class="col-12 col-sm-6 d-flex justify-content-sm-start justify-content-center my-1">
                <button type="button" class="btn button-secondary px-3 py-2">Lihat semua kelas</button>
            </div>
        </div>

        <!-- Banner-1 -->
        <div class="row container my-5 banner-1 p-5 mx-1 position-relative">
            <div class="col-md-3"></div>
            <div class="col-md-6 col-12 d-flex text-center align-items-center">
                <h1>Ga perlu takut susah, ada Learning Session</h1>
            </div>
            <div class="col-md-3"></div>
        </div>

        <!-- Learning Session -->
        <div class="row container learning-session my-5 py-5">
            <div class="col-md-6 text-center align-self-center">
                <div class="container">
                    <h1 class="header">Learning Season</h1>
                </div>
                <div class="container">
                    <h5>Jadi ga bosen</h5>
                </div>
            </div>
            <div class="col-md-6">
                <div class="container">
                    <p><strong>Learning Session</strong> adalah sesi belajar bersama yang diadakan setiap minggu untuk
                        membahas secara lebih dalam dan interaktif</p>
                </div>
                <div class="container">
                    <p>Semua modul pembelajaran dalam kelas akan dibahas pada <strong>Learning Session</strong> dalam 1x
                        pertemuan setiap modul</p>
                </div>
                <div class="container">
                    <button type="button" class="btn button-primary px-3 py-2">Coba gratis</button>
                </div>
            </div>
        </div>

        <!-- Daftar Kelas -->
        <div class="daftar-kelas container">
            <div class="row">
                <div class="col-6">
                    <h1 class="header">Daftar Kelas</h1>
                </div>
                <div class="d-flex col-6 d-flex justify-content-end">
                    <div class="d-flex align-items-center">
                        <button type="button" class="btn button-secondary px-3 py-2">Lihat semua kelas</button>
                    </div>
                </div>
            </div>
            <div class="row justify-content-evenly my-4">
                <div class="col-lg-4 col-sm-6 my-3">
                    {{-- <CourseCard></CourseCard> --}}
                    <div class="card course-card">
                        <img src="{{ asset('assets/landingPage/course-1.png') }}" class="card-img-top" alt="Couse Image">
                        <div class="card-body">
                            <span class="badge px-3 my-2 text-bg-primary">CLI</span>
                            <h5 class="card-title my-2">Dasar Pemrograman menggunakan bahasa C</h5>
                            <div class="row my-2">
                                <div class="col-6 detail-info">
                                    <i class="bi bi-bookmark-dash-fill me-2"></i> 16 Modul
                                </div>
                                <div class="col-6 detail-info">
                                    <i class="bi bi-clock-fill me-2"></i> 72 Jam
                                </div>
                            </div>
                            <a class="btn button-primary my-3 px-3 py-2 d-block" href="#">Coba Gratis</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6 my-3">
                    {{-- <CourseCard></CourseCard> --}}
                    <div class="card course-card">
                        <img src="{{ asset('assets/landingPage/course-1.png') }}" class="card-img-top" alt="Couse Image">
                        <div class="card-body">
                            <span class="badge px-3 my-2 text-bg-primary">CLI</span>
                            <h5 class="card-title my-2">Dasar Pemrograman menggunakan bahasa C</h5>
                            <div class="row my-2">
                                <div class="col-6 detail-info">
                                    <i class="bi bi-bookmark-dash-fill me-2"></i> 16 Modul
                                </div>
                                <div class="col-6 detail-info">
                                    <i class="bi bi-clock-fill me-2"></i> 72 Jam
                                </div>
                            </div>
                            <a class="btn button-primary my-3 px-3 py-2 d-block" href="#">Coba Gratis</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6 my-3">
                    {{-- <CourseCard></CourseCard> --}}
                    <div class="card course-card">
                        <img src="{{ asset('assets/landingPage/course-1.png') }}" class="card-img-top" alt="Couse Image">
                        <div class="card-body">
                            <span class="badge px-3 my-2 text-bg-primary">CLI</span>
                            <h5 class="card-title my-2">Dasar Pemrograman menggunakan bahasa C</h5>
                            <div class="row my-2">
                                <div class="col-6 detail-info">
                                    <i class="bi bi-bookmark-dash-fill me-2"></i> 16 Modul
                                </div>
                                <div class="col-6 detail-info">
                                    <i class="bi bi-clock-fill me-2"></i> 72 Jam
                                </div>
                            </div>
                            <a class="btn button-primary my-3 px-3 py-2 d-block" href="#">Coba Gratis</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Banner-2 -->
        <div
            class="banner-2 py-5 container-fluid text-center position-relative d-flex flex-column justify-content-center mt-5">
            <div class="container my-3 position-relative">
                <h1>Tunggu apa lagi?</h1>
                <h1>langsung belajar sekarang</h1>
            </div>
            <div class="container my-3 position-relative">
                Kamu bisa pake kode referal untuk dibagikan ke temanmu kemudian dapet kelas gratis
            </div>
            <span>
                <button type="button" class="btn position-relative button-secondary px-3 py-2">Buat akun</button>
            </span>
        </div>

    </div>
@endsection

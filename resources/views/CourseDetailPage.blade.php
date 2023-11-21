@extends('layouts.LandingPageTemplate')

@section('content')
    <div class="detail-kelas-view d-flex flex-column align-items-center justify-content-center">
        <div class="container-fluid rounded box"></div>
        <div class="section-1 container d-flex justify-content-evenly p-0 row mt-3">
            <div class="col-3 class-img">
                <img src="{{ asset('assets/landingPage/course-1.png') }}" class="card-img-top" alt="Couse Image">
            </div>
            <div class="col-5 class-desc">
                <span class="badge px-3 my-2 text-bg-primary">CLI</span>
                <h5 class="my-2">Dasar Pemrograman menggunakan bahasa C</h5>
                <p>Belajar tentang bangaimana melakukan dasar pemrograman menggunakan bahasa C. Mulai dari input dan output
                    sederhana sampai dengan penerapan algoritma ke dalam program komputer</p>
                <div class="row my-2">
                    <div class="col-6 detail-info">
                        <i class="bi bi-bookmark-dash-fill me-2"></i> 16 Modul
                    </div>
                    <div class="col-6 detail-info">
                        <i class="bi bi-clock-fill me-2"></i> 72 Jam
                    </div>
                </div>
            </div>
            <div class="col-3 class-tutor">
                <h5>Rp 50,000</h5>
                <p class="fs-6 mb-1">Tutor</p>
                <div class="row">
                    <div class="col-3 d-flex align-items-center">
                        <div class="account-img w-100">
                            <img src="{{ asset('account/img/inGvRMqkqQXkTlJzxyGVCAuVuciZg2a26AE2qRpg.jpg') }}"
                            alt="tutor-profile" class="img-fluid">
                        </div>
                    </div>
                    <div class="col-9 tutor ps-0">
                        <h6 class="m-0">Nick Nelson</h6>
                        <p class="m-0">Teaching Team at Binus</p>
                    </div>
                </div>
                <router-link class="btn button-primary my-3 px-4 py-2 d-block" to="/kelas/detail">Beli Kelas</router-link>
            </div>
        </div>
        <div class="section-2 row container my-5">
            <div class="col-9">
                <h3>Materi Belajar</h3>

                {{-- <ModuleCard /> --}}
                @for ($i = 1; $i <= 3; $i++)
                    <div class="card my-3">
                        <div class="card-body">
                            <h5 class="card-title">Pengenalan dan Persiapan</h5>
                            <div>
                                <i class="bi bi-play-circle-fill"></i>
                                <span class="ms-3 card-text">Apa itu Algoritma?</span>
                            </div>
                            <div>
                                <i class="bi bi-play-circle-fill"></i>
                                <span class="ms-3 card-text">Instalasi dan Pengenalan Visual Studio Code</span>
                            </div>
                        </div>
                    </div>
                @endfor
            </div>
            <div class="col-3">
                <h3 class="3">Alat Belajar</h3>
                <div class="row my-2">
                    <div class="col-3 d-flex justify-content-center align-items-center tool-icon">
                        <i class="bi bi-cpu-fill"></i>
                    </div>
                    <div class="col-9 p-0 tool-desc">
                        <div class="h6 m-0">Processor</div>
                        <p class="m-0">Intel core i3 / Apple M1</p>
                    </div>
                </div>
                <div class="row my-2">
                    <div class="col-3 d-flex justify-content-center align-items-center tool-icon">
                        <i class="bi bi-window"></i>
                    </div>
                    <div class="col-9 p-0 tool-desc">
                        <div class="h6 m-0">Operating System</div>
                        <p class="m-0">Windows, Linux, MacOS</p>
                    </div>
                </div>
                <div class="row my-2">
                    <div class="col-3 d-flex justify-content-center align-items-center tool-icon">
                        <i class="bi bi-floppy-fill"></i>
                    </div>
                    <div class="col-9 p-0 tool-desc">
                        <div class="h6 m-0">Storage</div>
                        <p class="m-0">10 GB</p>
                    </div>
                </div>
                <div class="row my-2">
                    <div class="col-3 d-flex justify-content-center align-items-center tool-icon">
                        <i class="bi bi-memory"></i>
                    </div>
                    <div class="col-9 p-0 tool-desc">
                        <div class="h6 m-0">RAM</div>
                        <p class="m-0">4 GB</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

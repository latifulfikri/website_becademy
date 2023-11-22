@extends('layouts.LandingPageTemplate')

@section('content')
    <div class="kelas-view d-flex flex-column align-items-center justify-content-center">

        <!-- Hero -->
        <div class="hero container my-5 d-flex flex-column align-items-center text-center">
            <h1 class="header my-3">Mau belajar apa nih?</h1>
            <h6 class="sub-header mb-5">Temukan kelas yang kamu ingin pelajari disini. Kamu juga bisa request kelas yang lain
                nya di sini</h6>
            <div class="d-grid gap-2 d-sm-block">
                <button class="btn button-primary mx-3" type="button">All</button>
                @foreach ($categories as $category)
                    <button class="btn button-primary mx-3" type="button">{{ $category->name }}</button>
                @endforeach
            </div>
        </div>

        <div class="container">
            <div class="row my-4">
                {{-- <CourseCard></CourseCard> --}}
                @foreach ($courses as $course)
                <div class="col-lg-4 col-sm-6 my-3">
                    <div class="card course-card">
                        <img src="{{ asset('assets/landingPage/course-1.png') }}" class="card-img-top"
                            alt="Couse Image">
                        <div class="card-body">
                            <span class="badge px-3 my-2 text-bg-primary">{{ $course->category->name }}</span>
                            <h5 class="card-title my-2">{{ $course->name }}</h5>
                            <div class="row my-2">
                                <div class="col-6 detail-info">
                                    <i class="bi bi-bookmark-dash-fill me-2"></i> 16 Modul
                                </div>
                                <div class="col-6 detail-info">
                                    <i class="bi bi-clock-fill me-2"></i> 72 Jam
                                </div>
                            </div>
                            <a class="btn button-primary my-3 px-3 py-2 d-block" href="/course/{{ $course->slug }}">Mulai Belajar</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

    </div>
@endsection

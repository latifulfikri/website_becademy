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
            overflow: hidden;
        }
        .h-100{
            height: 100%;
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
  <body class="bg-primary">
    <div id="full" class="container p-5">
        <div class="row p-5 h-100">
            <div class="col-md-12 h-100">
                <div class="card p-5 h-100">
                    <div class="row h-100">
                        <div class="col-xl-6 m-auto d-none d-xl-block">
                            <div class="row">
                                <div class="col-12 text-center">
                                    <img src="{{ url('/assets/brand/logo-text.png') }}" alt="Becademy Logo" class="brand-medium mt-5">
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 card-body h-100 overflow-y-scroll">
                            <h1>Register</h1>
                            <p>Fill form below with your credential</p>
                            <form action="{{ url('register/submit') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-2">
                                    <label for="name">name</label>
                                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" placeholder="Rich Brian" required value="{{ old('name') }}">
                                    @error('name')
                                    <div id="validationServer03Feedback" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="mb-2">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" placeholder="yours@email.com" required value="{{ old('email') }}">
                                    @error('email')
                                    <div id="validationServer03Feedback" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="row">
                                    <div class="col mb-2">
                                        <label for="password">Password</label>
                                        <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" placeholder="your password" required>
                                        @error('password')
                                        <div id="validationServer03Feedback" class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="col mb-2">
                                        <label for="password_confirmation">Password Confirmation</label>
                                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Password Confirmation" required>
                                    </div>
                                </div>
                                <div class="mb-2">
                                    <label for="gender">Gender</label>
                                    <select class="form-select @error('gender') is-invalid @enderror" aria-label="Default select example" name="gender" id="gender" required>
                                        <option @if (old('gender') == "") selected @endif value="" >Open this select menu</option>
                                        <option @if (old('gender') == 'Male') selected @endif value="Male">Male</option>
                                        <option @if (old('gender') == 'Female') selected @endif value="Female">Female</option>
                                    </select>
                                    @error('gender')
                                    <div id="validationServer03Feedback" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="mb-2">
                                    <label for="school">School</label>
                                    <input type="text" name="school" id="school" class="form-control @error('school') is-invalid @enderror" placeholder="BINUS University" required value="{{ old('school') }}">
                                    @error('school')
                                    <div id="validationServer03Feedback" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="mb-2">
                                    <label for="degree">Degree</label>
                                    <select class="form-select @error('degree') is-invalid @enderror" aria-label="Default select example" name="degree" id="degree" required>
                                        <option @if (old('degree') == '') selected @endif value="">Open this select menu</option>
                                        <option @if (old('degree') == 'S1') selected @endif value="S1">S1/Undergraduate</option>
                                        <option @if (old('degree') == 'S2') selected @endif value="S2">S2/Postgraduate</option>
                                        <option @if (old('degree') == 'S3') selected @endif value="S3">S3/Phd</option>
                                    </select>
                                    @error('degree')
                                    <div id="validationServer03Feedback" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="mb-2">
                                    <label for="field_of_study">Field of study</label>
                                    <input type="text" name="field_of_study" id="field_of_study" class="form-control @error('field_of_study') is-invalid @enderror" placeholder="Computer Science" required value="{{ old('field_of_study') }}">
                                    @error('field_of_study')
                                    <div id="validationServer03Feedback" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="picture" class="form-label">Picture</label>
                                    <input class="form-control" type="file" id="picture" name="picture" required>
                                </div>
                                <button type="submit" class="btn btn-primary w-100 mb-2">Register</button>
                                <p>Already have an account? <a href="{{ url('/login') }}">Login here</a></p>
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
    </div>
    <script src="https://kit.fontawesome.com/876b175893.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
  </body>
</html>
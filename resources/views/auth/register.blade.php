<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{ asset('theme/css/bootstrap.min.css') }}" rel="stylesheet">
    <title>@yield('title', 'E-Apartman')</title>
</head>

<body>
    <div id="app">
        <div class="container-fluid d-flex justify-content-center align-items-center vh-100">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="card bg-dark" style="color: #4eb3ac;">
                        <div class="card-header d-flex justify-content-center align-items-center">
                            <a class="dropdown-item d-flex justify-content-center align-items-center" href="/kalendar">
                                <i class="fa-brands fa-squarespace fa-2xl"
                                    style="color: #4eb3ac; margin-right: 10px;"></i>
                                <span class="fs-4">E-Apartmani</span>
                            </a>
                        </div>

                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-8">
                                    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                                        @csrf

                                        <div class="row mb-3 mt-5">
                                            <label for="name"
                                                class="col-md-4 col-form-label text-md-end">{{ __('Ime') }}</label>

                                            <div class="col-md-6">
                                                <input id="name" type="text"
                                                    class="form-control @error('name') is-invalid @enderror"
                                                    name="name" value="{{ old('name') }}" required
                                                    autocomplete="name" autofocus placeholder="Unseite ime korisnika">

                                                @error('name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="surname"
                                                class="col-md-4 col-form-label text-md-end">{{ __('Prezime') }}</label>

                                            <div class="col-md-6">
                                                <input id="surname" type="text"
                                                    class="form-control @error('surname') is-invalid @enderror"
                                                    name="surname" value="{{ old('surname') }}" required
                                                    autocomplete="surname" placeholder="Unseite prezime korisnika">

                                                @error('surname')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="email"
                                                class="col-md-4 col-form-label text-md-end">{{ __('Email adresa') }}</label>

                                            <div class="col-md-6">
                                                <input id="email" type="email"
                                                    class="form-control @error('email') is-invalid @enderror"
                                                    name="email" value="{{ old('email') }}" required
                                                    autocomplete="email" placeholder="Unseite email korisnika">

                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="password"
                                                class="col-md-4 col-form-label text-md-end">{{ __('Šifra') }}</label>

                                            <div class="col-md-6">
                                                <input id="password" type="password"
                                                    class="form-control @error('password') is-invalid @enderror"
                                                    name="password" required autocomplete="new-password"
                                                    placeholder="Unseite šifru korisnika">

                                                @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="password-confirm"
                                                class="col-md-4 col-form-label text-md-end">{{ __('Ponovite šifru') }}</label>

                                            <div class="col-md-6">
                                                <input id="password-confirm" type="password" class="form-control"
                                                    name="password_confirmation" required autocomplete="new-password"
                                                    placeholder="Ponovo unesite šifru korisnika">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="role"
                                                class="col-md-4 col-form-label text-md-end">{{ __('Nivo pristupa') }}</label>

                                            <div class="col-md-6">
                                                <div class="select-wrapper">
                                                    <select id="role"
                                                        class="form-control @error('role') is-invalid @enderror"
                                                        name="role" required>
                                                        <option value="" disabled selected>
                                                            {{ __('Odaberite nivo pristupa') }}</option>
                                                        <option value="USER">Korisnik</option>
                                                        <option value="ADMIN">Administrator</option>
                                                        <option value="SUPERADMIN">Super Administrator</option>
                                                    </select>
                                                    <div class="select-arrow"></div>
                                                </div>
                                                @error('role')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        {{-- <div class="row mb-3">
                                        <label for="image"
                                            class="col-md-4 col-form-label text-md-end">{{ __('Image') }}</label>
        
                                        <div class="col-md-6">
                                            <input id="image" type="file"
                                                class="form-control @error('image') is-invalid @enderror" name="image">
        
                                            @error('image')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div> --}}

                                    <div class="row mt-3">
                                        <div class="col-md-6 offset-md-4">
                                            <button type="button" class="btn btn-primary" id="confirmButton">
                                                {{ __('Registrujte novog korisnika') }}
                                            </button>
                                        </div>
                                    </div>
                                    </form>
                                </div>
                                <div class="col-md-4">
                                    <img src="theme/images/budva.jpg" class="img-fluid rounded" alt="...">
                                </div>
                            </div>
                        </div>

                        <div class="card-footer d-flex justify-content-center align-items-center">
                            <p class="mt-3 mb-3">E-Apartmani - aplikacija za vođenje privatnog smestaja.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('theme/js/jQuery.min.js') }}"></script>
    <script src="{{ asset('theme/js/popper.min.js') }}"></script>
    <script src="{{ asset('theme/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('theme/js/bootstrap.bundle.min.js') }}"></script>
    <script src="https://kit.fontawesome.com/bc0adc73e3.js" crossorigin="anonymous"></script>
    <script src="{{ mix('js/app.js') }}" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


</body>
<script>
    document.getElementById('confirmButton').addEventListener('click', function() {
        Swal.fire({
            title: 'Da li ste sigurni?',
            text: "Da li želite da registrujete novog korisnika?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#4eb3ac',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Potvrdi',
            cancelButtonText: 'Otkaži'
        }).then((result) => {
            if (result.isConfirmed) {
                // Ovde možete staviti kod za registraciju korisnika ili druge akcije
                Swal.fire(
                    'Registrovano!',
                    'Novi korisnik je uspešno registrovan.',
                    'success'
                );
            }
        });
    });
</script>
<style>
    input[type="email"],
    input[type="password"] {
        color: black;
    }

    .select-wrapper {
        position: relative;
    }

    .select-arrow {
        position: absolute;
        top: 50%;
        right: 10px;
        /* Prilagodite prema potrebi */
        transform: translateY(-50%);
        pointer-events: none;
        width: 0;
        height: 0;
        border-left: 5px solid transparent;
        border-right: 5px solid transparent;
        border-top: 5px solid #000;
        /* Promijenite boju prema potrebi */
    }
</style>

</html>

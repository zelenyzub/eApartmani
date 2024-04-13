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
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card bg-dark" style="color: #4eb3ac;">
                            <div class="card-header d-flex justify-content-center align-items-center">
                                <i class="fa-brands fa-squarespace fa-2xl"
                                    style="color: #4eb3ac; margin-right: 10px;"></i>
                                <span class="fs-4">E-Apartmani</span>
                            </div>

                            {{-- <div class="card-body">
                            <form method="POST" action="{{ route('login') }}">
                                @csrf

                                <div class="row mb-3">
                                    <label for="email"
                                        class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                                    <div class="col-md-6">
                                        <input id="email" type="email"
                                            class="form-control @error('email') is-invalid @enderror" name="email"
                                            value="{{ old('email') }}" required autocomplete="email" autofocus>

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="password"
                                        class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                                    <div class="col-md-6">
                                        <input id="password" type="password"
                                            class="form-control @error('password') is-invalid @enderror" name="password"
                                            required autocomplete="current-password">

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6 offset-md-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="remember"
                                                id="remember" {{ old('remember') ? 'checked' : '' }}>

                                            <label class="form-check-label" for="remember">
                                                {{ __('Remember Me') }}
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-0">
                                    <div class="col-md-8 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Login') }}
                                        </button>

                                        @if (Route::has('password.request'))
                                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                                {{ __('Forgot Your Password?') }}
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </form>
                        </div> --}}
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <form method="POST" action="{{ route('login') }}">
                                            @csrf

                                            <div class="mb-3 mt-5">
                                                <label for="email"
                                                    class="form-label">{{ __('Email adresa') }}</label>
                                                <input id="email" type="email"
                                                    class="form-control @error('email') is-invalid @enderror"
                                                    name="email" value="{{ old('email') }}" required autofocus
                                                    placeholder="Unesite Vašu email adresu">
                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                <label for="password" class="form-label">{{ __('Šifra') }}</label>
                                                <input id="password" type="password"
                                                    class="form-control @error('password') is-invalid @enderror"
                                                    name="password" required autocomplete="current-password" autofocus
                                                    placeholder="Unesite Vašu šufru">
                                                @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                            <div class="mb-5">
                                                {{-- <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="remember"
                                                    id="remember" {{ old('remember') ? 'checked' : '' }}>
                                                <label class="form-check-label" for="remember">
                                                    {{ __('Zapamti me') }}
                                                </label>
                                            </div> --}}
                                            </div>

                                            <div class="mt-5 mb-3">
                                                <button type="submit" class="btn btn-primary">
                                                    {{ __('Prijavite se') }}
                                                </button>
                                                {{-- @if (Route::has('password.request'))
                                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                                    {{ __('Zaboravili ste šifru?') }}
                                                </a>
                                            @endif --}}
                                            </div>
                                        </form>
                                    </div>
                                    <div class="col-md-6">
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
    </div>
    <script src="{{ asset('theme/js/jQuery.min.js') }}"></script>
    <script src="{{ asset('theme/js/popper.min.js') }}"></script>
    <script src="{{ asset('theme/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('theme/js/bootstrap.bundle.min.js') }}"></script>
    <script src="https://kit.fontawesome.com/bc0adc73e3.js" crossorigin="anonymous"></script>
    <script src="{{ mix('js/app.js') }}" type="text/javascript"></script>

</body>
<style>
    input[type="email"],
    input[type="password"] {
        color: black;
    }
</style>

</html>
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{ asset('theme/css/bootstrap.min.css') }}" rel="stylesheet">
    <title>@yield('title', 'E-Apartman')</title>
</head>

<body>
    {{-- <div id="app">
        @include('layouts.sections.nav')
        <div class="row">
            <div class="col-2">
                @include('layouts.sections.sidebar')
            </div>
            <div class="col-8">
                @yield('content')
            </div>
        </div>


    </div> --}}

    @include('layouts.sections.nav')
    <div id="app">
        <div id="layoutSidenav">
            @include('layouts.sections.sidebar')
            <div id="layoutSidenav_content">
                @yield('content')
                {{-- @include('layouts.sections.footer') --}}
            </div>
        </div>
    </div>
    <script src="{{ asset('theme/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('theme/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('theme/js/popper.min.js') }}"></script>
    <script src="{{ asset('theme/js/jQuery.min.js') }}"></script>
    <script src="https://kit.fontawesome.com/bc0adc73e3.js" crossorigin="anonymous"></script>
    <script src="{{ mix('js/app.js') }}" type="text/javascript"></script>
    <style>
        #layoutSidenav {
    display: flex;
    height: 100%;
}

#layoutSidenav_content {
    flex: 1; /* Take remaining space */
    padding: 20px; /* Adjust padding as needed */
}

#layoutSidenav_sidebar {
    /* Add styling for sidebar as needed */
    width: 250px; /* Adjust width as needed */
}

    </style>
</body>

</html>

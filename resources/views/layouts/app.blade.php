<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('theme/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('theme/css/datatable.min.css') }}" rel="stylesheet">
    <link href="{{ asset('theme/css/sweetalert2.min.css') }}" rel="stylesheet">
    <title>@yield('title', 'E-Apartmani')</title>
</head>

<body>
    @include('layouts.sections.layout')
    <script src="{{ asset('theme/js/jQuery.min.js') }}"></script>
    <script src="{{ asset('theme/js/popper.min.js') }}"></script>
    <script src="{{ asset('theme/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('theme/js/bootstrap.bundle.min.js') }}"></script>
    <script src="https://kit.fontawesome.com/bc0adc73e3.js" crossorigin="anonymous"></script>
    <script src="{{ asset('theme/js/datatable.min.js') }}"></script>
    <script src="{{ asset('theme/js/sweetalert2.all.min.js') }}"></script>
    <script src="{{ mix('js/app.js') }}" type="text/javascript"></script>

</body>

</html>

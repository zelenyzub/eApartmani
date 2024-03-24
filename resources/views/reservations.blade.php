@extends('layouts.app')
@section('title', 'E-Apartman')
@section('content')
<reservations-page :user-role="{{ json_encode(session('user')->role) }}"></reservations-page>
@endsection

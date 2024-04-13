@extends('layouts.app')
@section('title', 'E-Apartmani')
@section('content')
<apartmentlist-page :user-role="{{ json_encode(session('user')->role) }}"></apartmentlist-page>
@endsection

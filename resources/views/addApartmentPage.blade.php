@extends('layouts.app')
@section('title', 'E-Apartmani')
@section('content')
<add-apartment-page :user-role="{{ json_encode(session('user')->role) }}"></add-apartment-page>
@endsection

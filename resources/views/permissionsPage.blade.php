@extends('layouts.app')
@section('title', 'E-Apartmani')
@section('content')
<permissions-page :user="{{ $user }}" :permissions="{{ $permissions }}"></permissions-page>
@endsection

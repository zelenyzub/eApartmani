@extends('layouts.app')
@section('title', 'E-Apartmani')
@section('content')
<reservations-page :user-role="{{ json_encode(session('user')->role) }}" :can-edit-reservations="{{ json_encode($canEditReservations) }}" :can-delete-reservations="{{ json_encode($canDeleteReservations) }}" :can-allow-reservations="{{ json_encode($canAllowReservations ) }}" :can-add-reservations="{{ json_encode($canAddReservations ) }}"></reservations-page>
@endsection

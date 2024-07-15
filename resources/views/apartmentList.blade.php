@extends('layouts.app')
@section('title', 'E-Apartmani')
@section('content')
<apartmentlist-page :user-role="{{ json_encode(session('user')->role) }}" :can-add-apartments="{{ json_encode($canAddApartments) }}" :can-edit-apartments="{{ json_encode($canEditApartments) }}" :can-delete-apartments="{{ json_encode($canDeleteApartments) }}"></apartmentlist-page>
@endsection

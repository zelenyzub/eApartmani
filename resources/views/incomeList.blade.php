@extends('layouts.app')
@section('title', 'E-Apartmani')
@section('content')
<income-component :income-data="{{ json_encode($incomeData) }}"></income-component>
@endsection

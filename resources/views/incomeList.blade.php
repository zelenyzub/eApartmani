@extends('layouts.app')
@section('title', 'E-Apartmani')
@section('content')
<income-component :income-data="{{ json_encode($incomeData) }}" :can-manage-percentage="{{ json_encode($canManagePercentage) }}" :can-manage-additional-expences="{{ json_encode($canManageAdditionalExpences) }}" :can-export-expences="{{ json_encode($canExportExpences) }}"></income-component>
@endsection

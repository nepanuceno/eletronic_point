@extends('adminlte::page')

@section('title', 'Servidores')

@section('content_header')
    <h1>{{ __('employee.lable-employees') }}</h1>
@stop

@section('breadcrumb')
    {{ Breadcrumbs::render('employees.index') }}
@stop

@section('content')
    @if (session('danger'))
        <div class="alert alert-danger alert-dismiss">
            {{ session('danger') }}
        </div>
    @endif
@stop

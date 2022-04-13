@extends('adminlte::page')

@section('title', 'Informações do Servidor')

@section('breadcrumb')
    {{ Breadcrumbs::render('employees.show', $employee) }}
@stop

@section('content_header')
    <h1>{{ __('employee.employee-details') }}</h1>
@stop

@section('content')
    <div class="col-md-5">
        <!-- Profile Image -->
        <div class="card card-primary card-outline">
            <div class="card-body box-profile">
                <div class="text-center">
                    <img class="profile-user-img img-fluid img-circle"
                        src="{{ $employee->user->adminlte_image() }}"
                        alt="User profile picture">
                </div>

                <h3 class="profile-username text-center">{{ $employee->name }}</h3>

                <p class="text-muted text-center">{!! $employee->deleted_at != NULL ? "<span class=\"badge bg-success\">Ativo</span>":"<span class=\"badge bg-danger\">Inativo</span>" !!} </p>

                <ul class="list-group list-group-unbordered mb-3">
                    <li class="list-group-item">
                        <b>Cargo</b>
                        <a class="float-right"> {{ $employee->responsibility->name }}</a>
                    </li>
                    <li class="list-group-item">
                        <b>Departamento</b>
                        <a class="float-right">{{ $employee->departament->name }}</a>
                    </li>
                    <li class="list-group-item">
                        <b>Matrícula</b> <a class="float-right">{{ $employee->matriculation }}</a>
                    </li>
                </ul>

                <a href="{{ route('employees.index') }}" class="btn btn-primary btn-block"><b>Voltar</b></a>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
@stop

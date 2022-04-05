@extends('adminlte::page')
@section('plugins.Sweetalert2', true)

@section('title', 'Departamentos')

@section('content_header')
    <h1>Departamentos {{ $status==1?' Desativados':'' }}</h1>
@stop
@section('breadcrumb')
    {{ Breadcrumbs::render('departaments.index') }}
@stop
@section('content')
    @if (session('danger'))
        <div class="alert alert-danger">
            {{ session('danger') }}
        </div>
    @endif

    @can('servidor-create')
        <div class="row">
            <div class="col">
                <a class="btn btn-secondary mb-4 float-right" href="{{ route('departaments.create') }}">
                    <span class="fas fa-plus mr-1"></span>Novo
                </a>
                <a class="btn btn-secondary mb-4 float-left" href="{{ route('departaments.index', ['status' => $status]) }}">
                    <span class="fas fa-eye mr-1"></span> {{ $status ? 'Mostrar Ativos':'Mostrar Inativos' }}
                </a>
        </div>
    </div>
@endcan
@if (count($departaments) > 0)
    <div class="card">
        <div class="card-body table-responsive p-0">
            <table class="table table-bordered table-sm table-striped table-hover table-valign-middle">
                <thead class="thead-dark ">
                    <tr>
                        <th>Departamentos</th>
                        @can(['servidor-edit', 'servidor-delete'])
                            <th class="text-center">Ações</th>
                        @endcan
                    </tr>
                </thead>
                <tbody>
                    @foreach ($departaments as $departament)
                        <tr class="{{ $departament->status==0?'table-danger':''}}">
                            <td style="width: 78%">{{ $departament->name }}</td>
                            @can(['servidor-edit', 'servidor-delete'])
                                <td>
                                    <div class="btn-group float-right">
                                        <button type="button" class="btn btn-default">Ações</button>
                                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"
                                            aria-expanded="false">
                                            <span class="sr-only">Toggle Dropdown</span>
                                        </button>
                                        <div class="dropdown-menu" role="menu" style="">
                                            @can('servidor-edit')
                                                {!! Form::open(['method' => 'DELETE','route' => [
                                                        $status==0?'departaments.destroy':'departament.restore', $departament->id],
                                                        'style'=>'display:inline'
                                                    ]) !!}
                                                {!! Form::button("<i class=\"fas fa-trash\"></i> ".
                                                   ( ($departament->deleted_at)===NULL ? __('users.user_button_disable'):__('users.user_button_enable')),
                                                    [
                                                        'type'=>'submit',
                                                        'type-icon' => 'question',
                                                        'data-title'=> ($departament->deleted_at===NULL ? __('users.user_button_disable'): __('users.user_button_enable')).' '.$departament->name.'?',
                                                        'class' => 'dropdown-item disable-button',
                                                        'type'=>'submit',
                                                        'data-text'=> __('users.are-you-sure'),
                                                        'confirm-button-text'=>__('users.btn-yes'),
                                                        'cancel-button-text'=>__('users.btn-not'),
                                                    ]
                                                    ) !!}
                                                {!! Form::close() !!}
                                            @endcan
                                            @can('servidor-edit')
                                                <a class="dropdown-item" href="departaments/{{ $departament->id }}/edit">
                                                    <i class="fas fa-edit"></i> Editar</a>
                                            @endcan
                                            @can('servidor-list')
                                                <a class="dropdown-item"
                                                    href="{{ route('departaments.show', $departament->id) }}">
                                                    <i class="fas fa-info"></i> Informações</a>
                                            @endcan
                                        </div>
                                    </div>
                                </td>
                            @endcan
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $departaments->links() }}
    </div>
@else
    <div class="alert alert-info">Não existem departamentos cadastrados</div>
@endif
@stop
@section('js')
    @alertSuccess(Session::get('success'));
@stop

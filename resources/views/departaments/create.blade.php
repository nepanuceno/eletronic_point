@extends('adminlte::page')

@section('title', 'Dashboard')
@section('plugins.Select2', true)
@section('plugins.Sweetalert2', true)
@section('content_header')
    <h1>Cadastro de Departamentos</h1>
@stop
@section('breadcrumb')
@if (isset($departament))
{{ Breadcrumbs::render('departaments.edit', $departament) }}
@else
{{ Breadcrumbs::render('departaments.create') }}
@endif
@stop
@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if (session('danger'))
        <div class="alert alert-danger">
            {{ session('danger') }}
        </div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="card card-info">
        <form action="{{ isset($departament) ? url('departaments/' . $departament->id) : url('departaments') }}"
            method="POST">
            <div class="card-body">
                @csrf
                @if (isset($departament))
                    @method('PUT')
                @endif

                <div class="form-group">
                    <div class="input-form">
                        <label class="form-label" for="name">Departamento</label>
                        <input class="form-control" name="name" id="name"
                            value="{{ isset($departament) ? $departament->name : '' }}" />
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-form">
                        <label class="form-label" for="departament">Departamento pai</label>
                        <select class="form-control select2" name="parent_id">
                            <option value="">Nenhum</option>
                            @foreach ($departaments as $item)
                                <option value="{{ $item->id }}"
                                    {{ isset($departament) ? ($departament->parent_id == $item->id ? 'selected=selected' : '') : '' }}>
                                    {{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button class="btn btn-primary" type="submit">
                    <i class="fas fa-save mr-1"></i>
                    {{ isset($departament) ? 'Salvar' : 'Cadastrar' }}
                </button>
                <a class="btn btn-secondary float-right" href="{{ route('departaments.index') }}">
                    <i class="fas fa-arrow-left mr-1"></i>Voltar
                </a>
            </div>
        </form>
    </div>
@stop
@section('js')
    <script>
        $('document').ready(function(){
            $('.select2').select2({
                placeholder: 'Nenhum'
            });
        });
    </script>
@stop

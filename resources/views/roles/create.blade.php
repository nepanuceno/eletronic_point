@extends('adminlte::page')
@section('content')
@section('plugins.icheckBootstrap', true)
@section('breadcrumb')
    {{ Breadcrumbs::render('roles.create') }}
@stop

<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>{{ __('roles.label_new_role') }}</h2>
        </div>
        <div class="float-right">
            <a class="btn btn-default" href="{{ route('roles.index') }}"> {{ __('roles.role_button_back_page') }}</a>
        </div>
    </div>
</div>
@if (count($errors) > 0)
    <div class="alert alert-danger">
        <strong>{{ __('roles.whoops') }}</strong> {{ __('roles.whoops_text') }}<br><br>
        <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
        </ul>
    </div>
@endif
{!! Form::open(array('route' => 'roles.store','method'=>'POST')) !!}
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>{{ __('roles.label_name') }}:</strong>
            {!! Form::text('name', null, array('placeholder' => __('roles.label_name'),'class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <table class="table table-sm table-stratch" >
                <caption><strong>{{ __('roles.label_permissions') }}</strong></caption>
                <thead>
                    <tr>
                        <th>Role</th>
                        <th>Guard</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($permissions as $value)
                        <tr>
                            <td class="icheck-primary">
                                <div class="icheck-primary icheck-inline">
                                    {{ Form::checkbox('permission[]', $value->id, false, array('id'=> $value->id)) }}
                                    {{ Form::label($value->id, $value->name) }}
                                </div>
                            </td>
                            <td>{{ $value->guard_name }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <button type="submit" class="btn btn-primary">{{ __('roles.role_button_save') }}</button>
    </div>
</div>
{!! Form::close() !!}
<p class="text-center text-primary"><small>{{ __('app.interprise_name') }}</small></p>
@endsection

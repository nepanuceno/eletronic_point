@extends('adminlte::page')
@section('content')
@section('plugins.bootstrap4DualListbox', true)

@section('breadcrumb')
    {{ Breadcrumbs::render('roles.edit', $role) }}
@stop
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>{{ __('roles.label_edit_role') }}</h2>
        </div>
        <div class="float-right">
            <a class="btn btn-default" href="{{ route('roles.index') }}"> {{ __('roles.role_button_back_page') }}</a>
        </div>
    </div>
</div>
@if (count($errors) > 0)
    <div class="alert alert-danger">
        <strong>Whoops!</strong> {{ __('label_error_edit_role') }}
        <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
        </ul>
    </div>
@endif
{!! Form::model($role, ['method' => 'PATCH','route' => ['roles.update', $role->id]]) !!}
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>{{ __('roles.label_name') }}:</strong>
            {!! Form::text('name', null, array('placeholder' => __('roles.label_name'),'class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <select class="dualListBox" multiple="multiple" size="10" name="permissions[]" id="permissions">
                @foreach($permissions as $value)
                    <option value={{ $value->id }} {{in_array($value->id, $rolePermissions) ? 'selected' : '' }}>{{ $value->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <button type="submit" class="btn btn-primary">{{ __('roles.role_button_save') }}</button>
    </div>
</div>
{!! Form::close() !!}
<p class="text-center text-primary"><small>{{ __('app.interprise.name') }}</small></p>
@endsection

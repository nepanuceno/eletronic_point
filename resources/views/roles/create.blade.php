@extends('adminlte::page')
@section('content')
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
        <strong>{{ __('whoops') }}</strong> {{ __('whoops_text') }}<br><br>
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
            <strong>{{ __('roles.label_permissions') }}:</strong>
            <br/>
            @foreach($permission as $value)
                <label>{{ Form::checkbox('permission[]', $value->id, false, array('class' => 'name')) }}
                {{ $value->name }}</label>
            <br/>
            @endforeach
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <button type="submit" class="btn btn-primary">{{ __('roles.role_button_save') }}</button>
    </div>
</div>
{!! Form::close() !!}
<p class="text-center text-primary"><small>{{ __('app.interprise.name') }}</small></p>
@endsection

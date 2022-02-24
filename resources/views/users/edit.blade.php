@extends('adminlte::page')
@section('plugins.Select2', true)
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>{{ __('users.label_edit_user') }}</h2>
        </div>
        <div class="float-right">
            <a class="btn btn-default" href="{{ route('users.index') }}"> {{ __('users.user_button_back_page')}}</a>
        </div>
    </div>
</div>
@if (count($errors) > 0)
  <div class="alert alert-danger">
    <strong>Whoops!</strong> There were some problems with your input.<br><br>
    <ul>
       @foreach ($errors->all() as $error)
         <li>{{ $error }}</li>
       @endforeach
    </ul>
  </div>
@endif
{!! Form::model($user, ['method' => 'PATCH','route' => ['users.update', $user->id]]) !!}
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>{{ __('users.label_name') }}:</strong>
            {!! Form::text('name', null, array('placeholder' => __('users.label_name'),'class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>{{ __('users.label_email') }}:</strong>
            {!! Form::text('email', null, array('placeholder' => __('users.label_email'),'class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>{{ __('users.label_password') }}:</strong>
            {!! Form::password('password', array('placeholder' => __('users.label_password'),'class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>{{ __('users.label_confirm_password') }}:</strong>
            {!! Form::password('confirm-password', array('placeholder' => __('users.label_confirm_password'),'class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>{{ __('users.label_roles') }}:</strong>
            {!! Form::select('roles[]', $roles,$userRole, array('class' => 'form-control select2','multiple')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <button type="submit" class="btn btn-primary">{{ __('users.user_button_save') }}</button>
    </div>
</div>
{!! Form::close() !!}
<p class="text-center text-primary"><small>{{ __('app.interprise_name') }}</small></p>
@endsection

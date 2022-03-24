@extends('adminlte::page')
@section('plugins.Select2', true)
@section('content')
@section('breadcrumb')
    {{ Breadcrumbs::render('users.create') }}
@stop
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>{{ __('users.label_create_user') }}</h2>
        </div>
        <div class="float-right">
            <a class="btn btn-default" href="{{ route('users.index') }}"> {{ __('users.user_button_back_page')}}</a>
        </div>
    </div>
</div>
@if (count($errors) > 0)
  <div class="alert alert-danger">
    <strong>{{ __('users.whoops') }}</strong> {{ __('users.whoops_text') }}<br><br>
    <ul>
       @foreach ($errors->all() as $error)
         <li>{{ $error }}</li>
       @endforeach
    </ul>
  </div>
@endif
{!! Form::open(array('route' => 'users.store','method'=>'POST')) !!}
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>{{ __('users.label_name') }}:</strong>
            {!! Form::text('name', null, array('placeholder' =>  __('users.label_name'),'class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>{{ __('users.label_email') }}:</strong>
            {!! Form::text('email', null, array('placeholder' =>  __('users.label_email'),'class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <button type="submit" class="btn btn-primary">{{ __('users.user_button_save') }}</button>
    </div>
</div>
{!! Form::close() !!}
<p class="text-center text-primary"><small>{{ __('app.interprise_name') }}</small></p>
@endsection

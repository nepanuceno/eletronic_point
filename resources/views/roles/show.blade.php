@extends('adminlte::page')
@section('content')
@section('breadcrumb')
    {{ Breadcrumbs::render('roles.show', $role) }}
@stop
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>{{ __('roles.label_role_show') }}</h2>
        </div>
        <div class="float-right">
            <a class="btn btn-default" href="{{ route('roles.index') }}">{{ __('roles.role_button_back_page')}}</a>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>{{ __('roles.label_role_name') }}:</strong>
            {{ $role->name }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>{{ __('roles.label_permissions') }}:</strong>
            @if(!empty($rolePermissions))
                <ul>
                @foreach($rolePermissions as $v)
                    <li><label class="label label-success">{{ $v->name }},</label></li>
                @endforeach
                </ul>
            @endif
        </div>
    </div>
</div>
@endsection

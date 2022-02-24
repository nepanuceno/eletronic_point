@extends('adminlte::page')
@section('content')
@section('plugins.Datatables', true)

<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="">
            <h2>{{ __('roles.role_management') }}</h2>
        </div>
        <div class="float-right mb-2">
        @can('role-create')
            <a class="btn btn-success" href="{{ route('roles.create') }}">{{ __('roles.role_button_new') }}</a>
            @endcan
        </div>
    </div>
</div>
@if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
@endif
<table class="table table-striped table-sm">
    <thead class="thead-dark">
        <tr>
     <th>No</th>
     <th>{{ __('roles.label_role_name') }}</th>
     <th width="280px">{{ __('roles.label_role_action') }}</th>
  </tr>
</thead>
<tbody>
    @foreach ($roles as $key => $role)
    <tr>
        <td>{{ ++$i }}</td>
        <td>{{ $role->name }}</td>
        <td>
            <a class="btn btn-info" href="{{ route('roles.show',$role->id) }}">{{ __('roles.button_role_show') }}</a>
            @can('role-edit')
                <a class="btn btn-primary" href="{{ route('roles.edit',$role->id) }}">{{ __('roles.button_role_edit') }}</a>
            @endcan
            @can('role-delete')
                {!! Form::open(['method' => 'DELETE','route' => ['roles.destroy', $role->id],'style'=>'display:inline']) !!}
                    {!! Form::button( __('roles.button_role_disable'), ['class' => 'btn btn-danger', 'type'=>'submit']) !!}
                {!! Form::close() !!}
            @endcan
        </td>
    </tr>
    @endforeach
</tbody>
</table>
{!! $roles->render() !!}
<p class="text-center text-primary"><small>{{ __('app.interprise_name') }}</small></p>
@endsection

@extends('adminlte::page')
@section('content')
@section('plugins.Datatables', true)
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>{{ __('users.users_management') }}</h2>
        </div>
        <div class="float-right mb-2">
            <a class="btn btn-success" href="{{ route('users.create') }}">{{ __('users.user_button_new') }}</a>
        </div>
    </div>
</div>
@if ($message = Session::get('success'))
<div class="alert alert-success">
  <p>{{ $message }}</p>
</div>
@endif
<table class="table table-striped table-sm" id="table_users">
    <thead class="thead-dark">
        <tr>
            <th>No</th>
            <th>{{ __('users.user_name') }}</th>
            <th>{{ __('users.user_email') }}</th>
            <th>{{ __('users.user_roles') }}</th>
            <th width="280px">{{ __('users.user_action') }}</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $key => $user)
        <tr>
            <td class="align-middle">{{ ++$i }}</td>
            <td class="align-middle">{{ $user->name }}</td>
            <td class="align-middle">{{ $user->email }}</td>
            <td class="align-middle">
            @if(!empty($user->getRoleNames()))
                @foreach($user->getRoleNames() as $v)
                <label class="badge badge-success">{{ $v }}</label>
                @endforeach
            @endif
            </td>
            <td class="align-middle">
            <a class="btn btn-info" href="{{ route('users.show',$user->id) }}">{{ __('users.user_button_show') }}</a>
            <a class="btn btn-primary" href="{{ route('users.edit',$user->id) }}">{{ __('users.user_button_edit') }}</a>
                {!! Form::open(['method' => 'DELETE','route' => ['users.destroy', $user->id],'style'=>'display:inline']) !!}
                    {!! Form::button(__('users.user_button_disable'),['class' => 'btn btn-danger', 'type'=>'submit']) !!}
                {!! Form::close() !!}
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
{!! $data->render() !!}
<p class="text-center text-primary"><small>{{ __('app.interprise_name') }}</small></p>
@endsection

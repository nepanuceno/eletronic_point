@extends('adminlte::page')
@section('content')
@section('plugins.Datatables', true)
@section('plugins.Sweetalert2', true)
@section('breadcrumb')
    {{ Breadcrumbs::render('roles.index') }}
@stop
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="">
            <h2>{{ __('roles.role_management') }}</h2>
        </div>
        <div class="float-right mb-2">
            @can('role-create')
                <a class="btn btn-success" href="{{ route('roles.create') }}">
                    <i class="fas fa-plus"></i>
                    {{ __('roles.role_button_new') }}</a>
            @endcan
        </div>
    </div>
</div>

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
                <div class="d-flex justify-content-end">
                    <div class="p-1">
                        <a class="btn btn-info ml-20" href="{{ route('roles.show',$role->id) }}">{{ __('roles.button_role_show') }}</a>
                    </div>
                    <div class="p-1">
                        @can('role-edit')
                        <a class="btn btn-primary" href="{{ route('roles.edit',$role->id) }}">{{ __('roles.button_role_edit') }}</a>
                        @endcan
                    </div>
                    <div class="p-1">
                        @can('role-delete')
                        {!! Form::open(['method' => 'DELETE','route' => ['roles.destroy', $role->id],'style'=>'display:inline']) !!}
                            {!! Form::button( __('roles.button_role_disable'),
                            [
                                'class' => 'btn btn-danger disable-button',
                                'type'=>'submit',
                                'data-title'=>'Desativar o Perfil '.$role->name,
                                'data-text'=>'Tem certeza desta ação?',
                                'confirm-button-text'=>'Sim',
                                'cancel-button-text'=>'Não',
                                'type-icon' => 'question',
                            ]) !!}
                        {!! Form::close() !!}
                        @endcan
                    </div>
                  </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{!! $roles->render() !!}

<p class="text-center text-primary"><small>{{ __('app.interprise_name') }}</small></p>
@endsection

@section('js')
    @if ($message = Session::get('success'))
        <script>MessageAlert(['{{ $message }}', 'success', '{{ __('app.msg_success') }}']);</script>
    @endif

    @if ($message = Session::get('error'))
        <script>MessageAlert(['{{ $message }}', 'error', '{{ __('app.msg_error') }}']);</script>
    @endif
@endsection

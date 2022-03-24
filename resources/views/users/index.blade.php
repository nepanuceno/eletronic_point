@extends('adminlte::page')
@section('content')

@section('plugins.Datatables', true)
@section('plugins.Sweetalert2', true)
@section('plugins.GeneralScripts', true)
@section('plugins.BootstrapSwitch', true)

@section('breadcrumb')
    {{ Breadcrumbs::render('users.index') }}
@stop
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>{{ __('users.users_management') }} {{ (session()->has('active') && session('active')==0) ?__('users.label_users_status_disable'):'' }}</h2>
        </div>
    </div>
</div>

<div class="row mb-3">
    <nav class="col-lg-12 margin-tb bg-light pt-3 shadow-sm rounded">
        <div class="float-left mb-2">
            <a
                class="btn {{ (session('active')==1 || !session()->has('active'))?'btn-success':'btn-warning' }}"
                href="{{ url('users/switch-active') }}" >
                <i class="fas fa-filter pr-1"></i>
                {{ (session('active')==1 || !session()->has('active'))? __('users.button_users_status_disable') : __('users.button_users_status_enable') }}
            </a>
        </div>
        <div class="float-right mb-2">
            <a class="btn btn-success" href="{{ route('users.create') }}">
                <i class="fas fa-user-plus pr-1"></i>
                {{ __('users.user_button_new') }}
            </a>
        </div>
    </nav>
</div>

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
                    {!! Form::button(
                        ($user->active===1) ? __('users.user_button_disable'):__('users.user_button_enable'),
                        [
                            'type'=>'submit',
                            'type-icon' => 'question',
                            'data-title'=> ($user->active==1 ? __('users.user_button_disable'): __('users.user_button_enable')).' '.$user->name.'?',
                            'class' => 'btn btn-danger disable-button',
                            'type'=>'submit',
                            'data-text'=> __('users.ara-you-sure'),
                            'confirm-button-text'=>__('users.btn-yes'),
                            'cancel-button-text'=>__('users.btn-not'),
                        ]
                    ) !!}
                {!! Form::close() !!}
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@if ($data->render())
    {!! $data->render() !!}
@endif
<p class="text-center text-primary"><small>{{ __('app.interprise_name') }}</small></p>

@stop

@section('js')
    @if ($message = Session::get('success'))
        <script>MessageAlert(['{{ $message }}', 'success', '{{ __('app.msg_success') }}']);</script>
    @endif
@endsection

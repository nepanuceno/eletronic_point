@extends('adminlte::page')
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>{{ __('users.label_show_user') }}</h2>
        </div>
        <div class="float-right">
            <a class="btn btn-default" href="{{ route('users.index') }}"> {{ __('users.user_button_back_page')}}</a>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-3">
        <div class="card card-primary card-outline">
            <div class="card-body box-profile">
                <div class="text-center">
                    <img class="profile-user-img img-fluid img-circle" src="https://s16.picofile.com/file/8414366276/105_1055656_account_user_profile_avatar_avatar_user_profile_icon.png" alt="User profile picture">
                </div>
                <h3 class="profile-username text-center">{{ $user->name }}</h3>
                <p class="text-muted text-center">{{ $user->email }}</p>
                <ul class="list-group list-group-unbordered mb-3">
                    <strong>{{ __('users.label_roles') }}:</strong>
                    @if(!empty($user->getRoleNames()))
                        @foreach($user->getRoleNames() as $v)
                            <li class="list-group-item">
                                <label class="float-right badge badge-success">{{ $v }}</label>
                            </li>
                        @endforeach
                    @endif
                </ul>
            </div>
        </div>
    </div>
</div>

<p class="text-center text-primary"><small>{{ __('app.interprise_name') }}</small></p>
@endsection

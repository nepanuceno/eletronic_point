@extends('adminlte::page')
@section('plugins.Select2', true)
@section('plugins.Sweetalert2', true)
@section('plugins.bootstrap4DualListbox', true)

@section('content')
@section('breadcrumb')
    {{ Breadcrumbs::render('role_user.index') }}
@stop
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>{{ __('roles_user.whoops') }}!</strong> {{ __('roles_user.problem_with_data') }}.
            <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
            </ul>
        </div>
    @endif
    <div class="card">
        <h5 class="card-header bg-dark">{{ __('roles_user.profiles_assing_user') }}</h5>
        <div class="card-body">
            <form action="{{ route('role_user.store') }}" method="post">
                {!! csrf_field() !!}
                <div class="form-group">
                    <label>{{ __('roles_user.user') }}</label>
                    <select class="select2bs4 select_input_users select2" id="user" name="user" data-placeholder="{{ __('roles_user.search_user') }}" style="width: 100%;">
                        <option value="null">{{ __('roles_user.search_user') }}</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>{{ __('roles_user.associate_profile') }}</label>
                    <select class="select2 select_input_roles"  multiple="multiple" size="10" name="roles[]" id="roles" data-placeholder="{{ __('roles_user.select_profiles') }}" style="width: 100%;">
                    @foreach ($roles as $role)
                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                    @endforeach
                    </select>
                </div>
                <hr>
                <button class="btn btn-secondary" type="submit"><i class="fas fa-sitemap"></i> {{ __('roles_user.associate_profile') }}</button>
            </form>
        </div>
    </div>
@endsection

@section('js')
<script src="js/custom/confirmeUrlExcludeRoleUserAlert.js"></script>
<script>
    $(document).ready(function() {
        $('.select_input_users').on('select2:select', function (e) {
            var user = $('.select_input_users').val();
            $.ajax({
                url: "/roles_user/"+user,
                dataType: 'json',
                success: function(result){
                    $("#roles").empty();
                    $.each(result, function(key, value) {
                        $('#roles').append(`<option value="${value.id}" ${value.selected==true?'selected':''}>${value.role}</option>`)
                    });
                }
            });
            dualListBox.bootstrapDualListbox('refresh');
        });
    });
</script>

@if ($message = Session::get('success'))
    <script>MessageAlert(['{{ $message }}', 'success', '{{ __('app.msg_success') }}']);</script>
@endif

@if ($message = Session::get('error'))
    <script>MessageAlert(['{{ $message }}', 'error', '{{ __('app.msg_error') }}']);</script>
@endif

@endsection

@extends('adminlte::page')
@section('plugins.Select2', true)
@section('plugins.Sweetalert2', true)
@section('content')
    @if ($message = Session::get('success'))
        <p id="message" style="display: none;">{{ $message }}</p>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>{{ __('roles_user.whoops') }}!</strong> {{ __('roles_user.problem_with_data') }}.<br><br>
            <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
            </ul>
        </div>
    @endif
    <div class="row pt-4">
        <div class="col-md-8 mx-auto">
            <div class="card">
                <h5 class="card-header bg-dark">{{ __('roles_user.profiles_assing_user') }}</h5>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <form action="{{ route('role_user.store') }}" method="post">
                                {!! csrf_field() !!}
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>{{ __('roles_user.user') }}</label>
                                                <select class="select2bs4 select_input_users" id="user" name="user" data-placeholder="{{ __('roles_user.search_user') }}" style="width: 100%;">
                                                <option value="null">{{ __('roles_user.search_user') }}</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>{{ __('roles_user.profiles_assing_user') }}</label>
                                                <select class="select2 select_input_roles" multiple name="roles[]" id="roles" data-placeholder="{{ __('roles_user.select_profiles') }}" style="width: 100%;">
                                                @foreach ($roles as $role)
                                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                                @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                <hr>
                                <button class="btn btn-secondary" type="submit"><i class="fas fa-sitemap"></i> {{ __('roles_user.associate_profile') }}</button>
                            </form>
                        </div>
                        <div class="col-md-4 roles border-left shadow-sm p-3 mb-5 bg-white rounded"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')
<script src="js/custom/confirmeUrlExcludeRoleUserAlert.js"></script>
<script>
    function buttonComponent(value, data) {
        var $button = document.createElement("button");
        var label = document.createTextNode(value);
        var $span = document.createElement("span");

        $button.setAttribute('class','btn btn-info text-white btn-sm mx-2');
        $button.setAttribute('onclick',`confirmeUrlExcludeRoleUserAlert(this, [${data}])`);
        $span.setAttribute('class','fas fa-trash text-white pl-2');

        $button.appendChild(label);
        $button.appendChild($span);
        return $button;
    }

    $(document).ready(function() {
        $('.select_input_users').select2({
            placeholder: 'Selecione um usuário',
            ajax: {
                url: '/get_all_users_active',
                dataType: 'json',
                delay: 250,
                processResults: function (data) {
                    return {
                        results:  $.map(data, function (item) {
                            return {
                                text: item.name,
                                id: item.id
                            }
                        })
                    };
                },
                cache: true
            }
        });

        $('.select_input_users').on('select2:select', function (e) {
            var user = $('.select_input_users').val();
            $(".roles").html('');
            $.ajax({
                url: "/roles_user/"+user,
                dataType: 'json',
                success: function(result){
                    let are_you_sure = '{{ __('roles_user.are_you_sure') }}';
                    let after_positive = '{{ __('roles_user.after_positive') }}';
                    let confirmation_unlink = '{{ __('roles_user.confirmation_unlink') }}';
                    let unlinked = '{{ __('roles_user.unlinked') }}';
                    let user_unlinked = '{{ __('roles_user.user_unlinked') }}';
                    let error_unlinked = '{{ __('roles_user.error_unlinked') }}';
                    let user_not_unlinked = '{{ __('roles_user.user_not_unlinked') }}';
                    let cancel = '{{ __('roles_user.cancel') }}';
                    $.each(result, function(key, value) {
                        let data=
                            `${user},
                            '${value}',
                            '${are_you_sure}',
                            '${after_positive}',
                            '${confirmation_unlink}',
                            '${unlinked}',
                            '${user_unlinked}',
                            '${error_unlinked}',
                            '${user_not_unlinked}',
                            '${cancel}'`;

                        $button = buttonComponent(value, data);
                        $(".roles").append($button);
                    });
                }
            });
        });
    });
</script>

@if ($message = Session::get('success'))
    <script>MessageAlert(['message','success']);</script>
@endif

@if ($message = Session::get('error'))
    <script>MessageAlert(['message','error']);</script>
@endif

@endsection

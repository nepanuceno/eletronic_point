<div class="row">
    <div class="col-md-6 mx-auto">
        <div class="card card-primary card-outline">
            <div class="card-body box-profile">
                <div class="text-center">
                    <img id='profile-user-image' class="profile-user-img img-fluid img-circle"  style="cursor: pointer;" src="{{ $user->adminlte_image() }}" alt="{{ __('users.alt-profile-picture') }}">
                    <input type="file" name="image" id="image-file" class="image d-none d-print-block">
                </div>
                <h3 class="profile-username text-center">{{ $user->name }}</h3>
                <p class="text-muted text-center">{{ $user->email }}</p>
                <p class="text-muted text-center">
                    <button type="button" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap"><i class="fas fa-key">{{ __('users.change-password') }}</i></button>
                <hr>
                <div class="float-none">
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
</div>

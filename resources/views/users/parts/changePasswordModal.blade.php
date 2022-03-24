<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">{{ __('users.change-password') }}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        {!! Form::model($user, ['method' => 'PATCH','route' => ['users.update', $user->id]]) !!}
            <div class="modal-body">
                <div class="form-group">
                    <strong>{{ __('users.label_password') }}:</strong>
                    {!! Form::password('password', array('placeholder' => __('users.label_password'),'class' => 'form-control')) !!}
                </div>
                <div class="form-group">
                    <strong>{{ __('users.label_confirm_password') }}:</strong>
                    {!! Form::password('confirm-password', array('placeholder' => __('users.label_confirm_password'),'class' => 'form-control')) !!}
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('app.btn-cancel') }}</button>
                <button class="btn btn-primary">{{ __('app.btn-confirm-change') }}</button>
            </div>
        {!! Form::close() !!}
      </div>
    </div>
</div>

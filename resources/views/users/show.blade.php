@extends('adminlte::page')
@section('content')
@section('plugins.cropperJs', true)

@section('breadcrumb')
    {{ Breadcrumbs::render('users.show', $user) }}
@stop

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

@if (count($errors) > 0)
  <div class="alert alert-danger">
    <strong>{{ __('users.whoops') }}</strong> {{ __('users.whoops_text') }}<br><br>
    <ul>
       @foreach ($errors->all() as $error)
         <li>{{ $error }}</li>
       @endforeach
    </ul>
  </div>
@endif

@include('users.parts.cardUserProfile')
@include('users.parts.changePasswordModal')
@include('users.parts.cropPictureUser')

<p class="text-center text-primary"><small>{{ __('app.interprise_name') }}</small></p>
@endsection

@section('js')
<script>
    $('#profile-user-image').on('click', function(e) {
        e.preventDefault();
        $('#image-file').trigger('click');
    });

    var $modal = $('#modal');
    var image = document.getElementById('image');
    var cropper;
    $("body").on("change", ".image", function(e){
        var files = e.target.files;
        var done = function (url) {
            image.src = url;
            $modal.modal('show');
        };

        var reader;
        var file;
        var url;
        if (files && files.length > 0) {
            file = files[0];
            if (URL) {
                done(URL.createObjectURL(file));
            } else if (FileReader) {
                reader = new FileReader();
                reader.onload = function (e) {
                    done(reader.result);
                };
                reader.readAsDataURL(file);
            }
        }
    });

    $modal.on('shown.bs.modal', function () {
        cropper = new Cropper(image, {
            aspectRatio: 1,
            viewMode: 2,
            preview: '.preview'
        });
    }).on('hidden.bs.modal', function () {
        cropper.destroy();
        cropper = null;
    });

    $("#crop").click(function(){
        canvas = cropper.getCroppedCanvas({
            width: 160,
            height: 160,
        });

        let user_id = this.getAttribute("data-user-id");

        canvas.toBlob(function(blob) {
            url = URL.createObjectURL(blob);
            var reader = new FileReader();
            reader.readAsDataURL(blob);
            reader.onloadend = function() {
                var base64data = reader.result;
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "/crop-image-upload",
                    data: {'_token': $('meta[name="csrf-token"]').attr('content'), 'image': base64data, 'user_id': user_id},
                    success: function(data){
                        console.log(data);
                        $modal.modal('hide');
                        alert(data.message);
                    }
                });
            }
        });
    });
    </script>
@stop

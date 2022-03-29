@extends('adminlte::page')
@section('content')
@section('plugins.cropperJs', true)
@section('plugins.Sweetalert2', true)

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
                        Swal.fire({
                            position: 'top-end',
                            icon: data.status,
                            title: data.message,
                            showConfirmButton: false,
                            timer: 2500
                        });
                    }
                });
            }
        });
    });
    </script>
@stop

@section('css')
<style>
.button {
    display: block;
    position: relative;
    margin: 50px auto 0;
    padding: 10px 0;
    width: 110px;
    /* color: #fff; */
    text-align: center;
    text-transform: uppercase;
    /* background-color: #0099cc; */
    border: none;
  }
  .button.one:after {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 0;
    height: 100%;
    background-color: rgba(255,255,255,0.4);
      -webkit-transition: none;
         -moz-transition: none;
              transition: none;
  }
  .button.one:hover:after {
    width: 120%;
    background-color: rgba(255,255,255,0);

      -webkit-transition: all 0.4s ease-in-out;
         -moz-transition: all 0.4s ease-in-out;
              transition: all 0.4s ease-in-out;
  }

  /* Two */
  .button.two {
    background-repeat: no-repeat;
    background-position: -120px -120px, 0 0;

    background-image: -webkit-linear-gradient(
      top left,
      rgba(255, 255, 255, 0.2) 0%,
      rgba(255, 255, 255, 0.2) 37%,
      rgba(255, 255, 255, 0.8) 45%,
      rgba(255, 255, 255, 0.0) 50%
    );
    background-image: -moz-linear-gradient(
      0 0,
      rgba(255, 255, 255, 0.2) 0%,
      rgba(255, 255, 255, 0.2) 37%,
      rgba(255, 255, 255, 0.8) 45%,
      rgba(255, 255, 255, 0.0) 50%
    );
    background-image: -o-linear-gradient(
      0 0,
      rgba(255, 255, 255, 0.2) 0%,
      rgba(255, 255, 255, 0.2) 37%,
      rgba(255, 255, 255, 0.8) 45%,
      rgba(255, 255, 255, 0.0) 50%
    );
    background-image: linear-gradient(
      0 0,
      rgba(255, 255, 255, 0.2) 0%,
      rgba(255, 255, 255, 0.2) 37%,
      rgba(255, 255, 255, 0.8) 45%,
      rgba(255, 255, 255, 0.0) 50%
    );

    -moz-background-size: 250% 250%, 100% 100%;
         background-size: 250% 250%, 100% 100%;

    -webkit-transition: background-position 0s ease;
       -moz-transition: background-position 0s ease;
         -o-transition: background-position 0s ease;
            transition: background-position 0s ease;
  }

  .button.two:hover {
    background-position: 0 0, 0 0;

    -webkit-transition-duration: 0.5s;
       -moz-transition-duration: 0.5s;
            transition-duration: 0.5s;
  }
  </style>
@stop

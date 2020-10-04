@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
          <div class="avatar-handle-container" style="background:#fff; padding:15px;">
          @php
            $avatarExists = $user->avatar();
            if($avatarExists){
              $avatar = (Storage::disk('public')->has('avatars/'.$user->avatar) ? Storage::disk('public')->url('avatars/'.$user->avatar) : Storage::disk('public')->url('avatars/avatar-default.png'));
            }else{
              $avatar = Storage::disk('public')->url('avatars/avatar-default.png');
            }
          @endphp
          <form method="POST" action="{{route('user.avatar.update')}}" enctype="multipart/form-data">
          <div data-attr="{{asset($user->avatar())}}" class="avatar-image-preview-container" style="background-image:  url( {{ asset($user->avatar())}})">
          </div>
          <div class="avatar-actions-line">
          <div class="avatar-actions-inner">
            <div class="upload-media">
              <div class="image-upload">
                <i class="fa fa-cloud-upload"></i>
                <input data-required="image" type="file" accept="image/*" name="avatar_image" id="avatar-file_upload" class="image-input" data-traget-resolution="image_resolution" value="" >
              </div>
              <span style="" id="avatar-image-preview-remove"><i class="fa fa-remove"></i></span>

            </div>
          </div>

          </div>
          <div class="avatar-submit  pull-right">
            <button type="submit" class="">Update</button>
          </div>
          @csrf
        </form>
        </div>
      </div>
    </div>
</div>


@endsection

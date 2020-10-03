<div class="peep-card container">

  <div class="card-header peep-card-header row">
    <div class="col-md-2">
      <a href='#' target="_blank" class="peep-avatar ">
        <div class="avatar-container ">
          <img class="avatar"src="https://api.adorable.io/avatars/50/abott@adorable.png"/>
        </div>
      </a>
    </div>
    <div class="peep-user-head col-md-10">
      <div class="peep-user-info">
        <span class= "peep-user-title">{{$peep->user->name}}</span>
        <span class= "peep-user-peepname">{{$peep->user->email}}</span>
      </div>
    </div>

  </div>

  <div class="card-body peep-card-body row">

    <!--    <div class="avatar-container col-md-2">
    <img class="avatar" src="https://api.adorable.io/avatars/50/abott@adorable.png"/>
    <div class="spacer-140"></div>
    <div class="peep-image-preview-container">
    <img src="" alt="" id="peep-image-preview"/>
    <span style="display:none" id="peep-image-preview-remove"><i class="fa fa-remove"></i></span>
  </div>
</div>-->

<div class="peep-body col-md-12">
  <form method="POST" action="{{route('peep.update',$peep->id)}}" enctype="multipart/form-data">
    {{ method_field('PUT') }}
    @csrf
    <div class="form-group">
      <label for="peep-text"></label>
      <textarea name="peep-text" type="text" class="form-control" id="peep-text" aria-describedby="peep-help" placeholder="What's happening..."
      cols="40" rows="5" maxlength="140" style="resize:none; border:none; outline:none">{{$peep->text}}</textarea>

      @php
      $imageExists = $peep->image()->exists();
      @endphp
      <div class="peep-card-body-image-bg"  style="background-image:  url( {{ ($imageExists ?asset(Storage::disk('public')->url('images/'.$peep->image->image_name)) : '' )}})">
        <img class="peep-card-body-image"   src="{{ ($imageExists ? $peep->image->encodeToBase64() : '') }}">
      </div>

      <small id="peep-help" class="form-text text-muted">
        <hr/>
      </small>
      <div class="peep-actions-line">
        <div class="peep-actions-inner">
          <div class="upload-media">
            <div class="image-upload">
              <i class="fa fa-cloud-upload"></i>
              <input data-attr="  {{ ($peep->image()->exists() ? asset(\Storage::disk('public')->url('images/'.$peep->image->image_name)) : '' )}}" data-required="image" type="file" accept="image/*" name="peep_image" id="peep-file_upload" class="image-input" data-traget-resolution="image_resolution" value="" >
              <div class="peep-image-preview-container">

                <img src="" alt="" id="peep-image-preview"/>
                <span style="display:none" id="peep-image-preview-remove"><i class="fa fa-remove"></i></span>



              </div>
            </div>

          </div>
        </div>
        <div class="peep-action-post  pull-right">
          <button type="submit" class="btn">Save</button>
        </div>
      </div>
    </div>
  </form>
  @error('peep-text')
  <div class="alert alert-danger">{{ $message }}</div>
  @enderror
  @error('peep_image')
  <div class="alert alert-danger">{{ $message }}</div>
  @enderror


</div>

</div>

</div>

<div class="peep-card container">

    <div class="card-body peep-card-body row">
      <div class="avatar-container col-md-2">
        <img class="avatar" src="{{\Auth::user()->avatar()}}"/>
        <div class="spacer-140"></div>
        <div class="peep-image-preview-container">
        <img src="" alt="" id="peep-image-preview"/>
        <span style="display:none" id="peep-image-preview-remove"><i class="fa fa-remove"></i></span>
        </div>
      </div>

      <div class="peep-body col-md-10">
        <form method="POST" action="{{route('peep.store')}}" enctype="multipart/form-data">
          @csrf
          <div class="form-group">
            <label for="peep-text"></label>
            <textarea name="peep-text" type="text" class="form-control" id="peep-text" aria-describedby="peep-help" placeholder="What's happening..."
            cols="40" rows="5" maxlength="140" style="resize:none; border:none; outline:none"></textarea>
            <small id="peep-help" class="form-text text-muted">
              <hr/>
            </small>
            <div class="peep-actions-line">
            <div class="peep-actions-inner">
              <div class="upload-media">
                <div class="image-upload">
                  <i class="fa fa-cloud-upload"></i>
                  <input data-required="image" type="file" accept="image/*" name="peep_image" id="peep-file_upload" class="image-input" data-traget-resolution="image_resolution" value="" >
                </div>

              </div>
            </div>
            <div class="peep-action-post  pull-right">
            <button type="submit" class="btn">Peep</button>
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

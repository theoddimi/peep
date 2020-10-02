<div class="peep-card container">

    <div class="card-body peep-card-body row">
      <div class="avatar-container col-md-2">
        <img class="avatar" src="https://api.adorable.io/avatars/50/abott@adorable.png"/>
        <div class="peep-image-preview-container"><img src="" alt="" id="peep-image-preview">
          <span style="display:none" id="peep-image-preview-remove">Remove</span>
        </div>
      </div>

      <div class="peep-body col-md-10">
        <form method="POST" action="{{route('peep.store')}}" enctype="multipart/form-data">
          @csrf
          <div class="form-group">
            <label for="peep-text"></label>
            <textarea name="peep-text" type="text" class="form-control" id="peep-text" aria-describedby="peep-help" placeholder="What are you thinking..."
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






    <!--    <p class="peep-card-body-text">
          <span class="">Test PeeP Text!!</span>
          <span class="peep-mention"></span>
          <span class="peep-tag"></span>
        </p>
        <div class="peep-card-body-media">
        </div>
      <div class="peep-date-info">
        1:09 AM · May 6, 2014

      </div>-->

      </div>

    </div>

</div>

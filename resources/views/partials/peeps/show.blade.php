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
          <span class= "peep-user-name">{{$peep->user->name}}</span>
          <span class= "peep-user-username"><a href="{{url('/profile/'.$peep->user->username)}}">{{$peep->user->username}}</a></span>
        </div>
      </div>

    </div>

    <div class="card-body peep-card-body">
      <a href="{{route('peep.edit',$peep->id)}}"><i class="fa fa-pencil" aria-hidden="true"></i></a>
      <div class="peep-body">
        <p class="peep-card-body-text">
          <span class="">{{$peep->text}}</span>
          <span class="peep-mention"></span>
          <span class="peep-tag"></span>
        </p>

        @if($peep->image()->exists())
        <div class="peep-card-body-media">
          <div class="peep-card-body-image-bg" style="background-image: url({{asset(\Storage::disk('public')->url('images/'.$peep->image->image_name))}})">
            <img class="peep-card-body-image" src="{{$peep->image->encodeToBase64()}}">
          </div>

        </div>
        @endif
        <hr/>
      <div class="peep-date-info">
        {!!$peep->created_at!!}
      </div>

      </div>

    </div>

</div>
